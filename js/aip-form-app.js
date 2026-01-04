const { createApp } = Vue;

const STORAGE_KEY = 'united_mortgages_aip_draft';

// Create empty applicant template
function createEmptyApplicant() {
    return {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        date_of_birth: '',
        marital_status: '',
        nationality: '',
        national_insurance_number: '',
        current_address_street: '',
        current_address_town: '',
        current_address_county: '',
        current_address_postcode: '',
        electoral_register: false,
        months_at_address: '',
        previous_address_street: '',
        previous_address_town: '',
        previous_address_county: '',
        previous_address_postcode: '',
        months_at_previous_address: '',
        number_of_dependents: 0,
        ages_of_dependents: '',
        employment_type: '',
        // Employed fields
        occupation_job_title: '',
        employer_name: '',
        employer_address_street: '',
        employer_address_town: '',
        employer_county: '',
        employer_postcode: '',
        total_annual_salary: '',
        annual_additional_income: '',
        // Self-employed fields
        latest_fy_net_profit: '',
        latest_fy_end: '',
        previous_fy_net_profit: '',
        previous_fy_end: '',
        // Retired
        annual_retirement_income: '',
        // High net worth
        total_assets_liabilities: '',
        hnw_annual_income: '',
        // Financial
        has_outstanding_loans: '',
        loans: [],
        has_credit_cards: '',
        credit_cards: [],
        has_deposit: '',
        deposit_source: '',
        credit_history_issues: ''
    };
}

const app = createApp({
    components: {
        'applicant-details': ApplicantDetails,
        'financial-details': FinancialDetails
    },
    data() {
        return {
            currentStep: 1,
            isSubmitting: false,
            formData: {
                applicant_type: '',
                applicant_situation: '',
				privacy_accepted: false,
                applicant1: createEmptyApplicant(),
                applicant2: createEmptyApplicant()
            }
        };
    },
    mounted() {
        console.log('✓ AIP Form Vue app mounted');
        this.loadDraft();
    },
    watch: {
        formData: {
            deep: true,
            handler() {
                this.saveDraft();
            }
        }
    },
    methods: {
        // Navigation
        nextStep() {
            if (this.validateCurrentStep()) {
                this.currentStep++;
                window.scrollTo(0, 0);
            } else {
                alert('Please complete all required fields before continuing');
            }
        },
        
        previousStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                window.scrollTo(0, 0);
            }
        },
        
        // Validation
        validateCurrentStep() {
            // For now, allow progression without strict validation
            // Full validation will happen on final submit
            return true;
        },
        
        validateFinalForm() {
            const errors = [];
            
            // Step 1 validation
            if (!this.formData.applicant_type) {
                errors.push('Please select whether you are buying alone or with someone else');
            }
            if (!this.formData.applicant_situation) {
                errors.push('Please select your situation');
            }
			
			if (!this.formData.privacy_accepted) {
        		errors.push('You must accept the Privacy Policy to continue');
    		}
            
            // Step 2 validation (Applicant 1)
            errors.push(...this.validateApplicant(this.formData.applicant1, '1'));
            
            // Step 2 validation (Applicant 2 if joint)
            if (this.formData.applicant_type === 'joint') {
                errors.push(...this.validateApplicant(this.formData.applicant2, '2'));
            }
            
            return errors;
        },
        
        validateApplicant(applicant, number) {
            const errors = [];
            const label = `Applicant ${number}`;
            
            // Basic details
            if (!applicant.first_name) errors.push(`${label}: First name is required`);
            if (!applicant.last_name) errors.push(`${label}: Last name is required`);
            if (!applicant.email) errors.push(`${label}: Email is required`);
            if (!applicant.phone) errors.push(`${label}: Phone is required`);
            if (!applicant.date_of_birth) errors.push(`${label}: Date of birth is required`);
            if (!applicant.marital_status) errors.push(`${label}: Marital status is required`);
            if (!applicant.nationality) errors.push(`${label}: Nationality is required`);
            if (!applicant.national_insurance_number) errors.push(`${label}: National Insurance number is required`);
            
            // Address
            if (!applicant.current_address_street) errors.push(`${label}: Current address street is required`);
            if (!applicant.current_address_town) errors.push(`${label}: Current address town is required`);
            if (!applicant.current_address_postcode) errors.push(`${label}: Current address postcode is required`);
            if (!applicant.months_at_address) errors.push(`${label}: Months at current address is required`);
            
            // Previous address if < 36 months
            if (parseInt(applicant.months_at_address) < 36) {
                if (!applicant.previous_address_street) errors.push(`${label}: Previous address street is required`);
                if (!applicant.previous_address_town) errors.push(`${label}: Previous address town is required`);
                if (!applicant.previous_address_postcode) errors.push(`${label}: Previous address postcode is required`);
                if (!applicant.months_at_previous_address) errors.push(`${label}: Months at previous address is required`);
            }
            
            // Employment
            if (!applicant.employment_type) errors.push(`${label}: Employment type is required`);
            
            const employmentType = applicant.employment_type;
            
            // Employed validation
            if (['employed-ft', 'employed-pt', 'employed-ftc'].includes(employmentType)) {
                if (!applicant.occupation_job_title) errors.push(`${label}: Job title is required`);
                if (!applicant.employer_name) errors.push(`${label}: Employer name is required`);
                if (!applicant.employer_address_street) errors.push(`${label}: Employer address is required`);
                if (!applicant.employer_address_town) errors.push(`${label}: Employer town is required`);
                if (!applicant.employer_postcode) errors.push(`${label}: Employer postcode is required`);
                if (!applicant.total_annual_salary) errors.push(`${label}: Annual salary is required`);
            }
            
            // Self-employed validation
            if (['sole-trader', 'partnership', 'limited-director'].includes(employmentType)) {
                if (!applicant.occupation_job_title) errors.push(`${label}: Occupation is required`);
                if (!applicant.latest_fy_net_profit) errors.push(`${label}: Latest year net profit is required`);
                if (!applicant.latest_fy_end) errors.push(`${label}: Latest year end date is required`);
                if (!applicant.previous_fy_net_profit) errors.push(`${label}: Previous year net profit is required`);
                if (!applicant.previous_fy_end) errors.push(`${label}: Previous year end date is required`);
            }
            
            // Retired validation
            if (employmentType === 'retired') {
                if (!applicant.annual_retirement_income) errors.push(`${label}: Annual retirement income is required`);
            }
            
            // High net worth validation
            if (employmentType === 'high-net-worth') {
                if (!applicant.total_assets_liabilities) errors.push(`${label}: Total assets/liabilities is required`);
                if (!applicant.annual_income_hnw) errors.push(`${label}: Annual income is required`);
            }
            
            // Financial validation
            if (!applicant.has_outstanding_loans) errors.push(`${label}: Please indicate if you have outstanding loans`);
            if (!applicant.has_credit_cards) errors.push(`${label}: Please indicate if you have credit cards`);
            if (!applicant.has_deposit) errors.push(`${label}: Please indicate if you have a deposit`);
            if (!applicant.credit_history_issues) errors.push(`${label}: Please indicate if you have credit history issues`);
            
            // Loans validation
            if (applicant.has_outstanding_loans === 'yes') {
                if (applicant.loans.length === 0) {
                    errors.push(`${label}: Please add at least one loan or select 'No' for outstanding loans`);
                } else {
                    applicant.loans.forEach((loan, index) => {
                        if (!loan.provider) errors.push(`${label} Loan ${index + 1}: Provider is required`);
                        if (!loan.monthly_payment) errors.push(`${label} Loan ${index + 1}: Monthly payment is required`);
                    });
                }
            }
            
            // Credit cards validation
            if (applicant.has_credit_cards === 'yes') {
                if (applicant.credit_cards.length === 0) {
                    errors.push(`${label}: Please add at least one credit card or select 'No' for credit cards`);
                } else {
                    applicant.credit_cards.forEach((card, index) => {
                        if (!card.provider) errors.push(`${label} Card ${index + 1}: Provider is required`);
                        if (!card.current_balance) errors.push(`${label} Card ${index + 1}: Current balance is required`);
                        if (!card.monthly_payment) errors.push(`${label} Card ${index + 1}: Monthly payment is required`);
                    });
                }
            }
            
            // Deposit source validation
            if (applicant.has_deposit === 'yes' && !applicant.deposit_source) {
                errors.push(`${label}: Please select deposit source`);
            }
            
            return errors;
        },
        
        // Submit
        async submitForm() {
            this.isSubmitting = true;
            
            try {
                const hubspotData = this.prepareHubSpotData();
                
                console.log('Submitting to Flask:', hubspotData); // Debug log
                
                const response = await fetch('https://unitedmortgages.eu.pythonanywhere.com/api/submit-aip', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(hubspotData)
                });
                
                const result = await response.json();
                console.log('Flask response:', result); // Debug log
                
                if (response.ok && result.success) {
                    console.log('Success! Contacts:', result.contacts_created);
                    this.currentStep = 4; // Show success screen
                } else {
                    console.error('Submission failed:', result);
                    alert('Submission failed: ' + (result.error || 'Unknown error'));
                }
            } catch (error) {
                console.error('Network error:', error);
                alert('Failed to connect to server. Is Flask running?');
            } finally {
                this.isSubmitting = false;
            }
        },


        
        prepareHubSpotData() {
            const data = {
                applicant_type: this.formData.applicant_type,
                applicant_situation: this.formData.applicant_situation,
                applicant1: this.flattenApplicantData(this.formData.applicant1)
            };
            
            if (this.formData.applicant_type === 'joint') {
                data.applicant2 = this.flattenApplicantData(this.formData.applicant2);
            }
            
            return data;
        },
        
        flattenApplicantData(applicant) {
            // Convert arrays to JSON strings for HubSpot
            return {
                ...applicant,
                loans: JSON.stringify(applicant.loans),
                credit_cards: JSON.stringify(applicant.credit_cards)
            };
        },
        
        // Update methods for components
        updateApplicant1(data) {
            this.formData.applicant1 = data;
        },
        
        updateApplicant2(data) {
            this.formData.applicant2 = data;
        },
        
        // localStorage
        saveDraft() {
            try {
                const draft = {
                    timestamp: new Date().toISOString(),
                    data: this.formData,
                    currentStep: this.currentStep
                };
                localStorage.setItem(STORAGE_KEY, JSON.stringify(draft));
            } catch (error) {
                console.error('Error saving draft:', error);
            }
        },
        
        loadDraft() {
            try {
                const draft = localStorage.getItem(STORAGE_KEY);
                if (draft) {
                    const parsed = JSON.parse(draft);
                    this.formData = parsed.data;
                    this.currentStep = parsed.currentStep || 1;
                    console.log('✓ Draft loaded from', parsed.timestamp);
                }
            } catch (error) {
                console.error('Error loading draft:', error);
            }
        },
        
        clearDraft() {
            try {
                localStorage.removeItem(STORAGE_KEY);
                console.log('✓ Draft cleared');
            } catch (error) {
                console.error('Error clearing draft:', error);
            }
        }
    }
});

app.mount('#aip-app');