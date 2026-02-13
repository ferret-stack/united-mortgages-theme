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
        national__insurance__number: '',
        current_address_street: '',
        current_address_town: '',
        current_address_county: '',
        address_postcode: '',
        electoral_register: '',
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
        employer_address_city: '',
        employer_county: '',
        employer_postcode: '',
        total_annual_salary: '',
        annual_bonus: '',
        annual_overtime: '',
        annual_commission: '',
        other_annual_income: '',
        // Contract fields
        contract_day_rate: '',
        contract_days_per_month: '',
        contract_end_date: '',
        // Self-employed fields
        business_name: '',
        latest_fy_net_profit: '',
        latest_fy_end: '',
        latest_fy_salary: '',
        latest_fy_dividends: '',
        previous_fy_net_profit: '',
        previous_fy_end: '',
        previous_fy_salary: '',
        previous_fy_dividends: '',
        // Retired
        state_pension_annual: '',
        private_pension_annual: '',
        other_retirement_income: '',
        // High net worth
        total_assets_liabilities: '',
        hnw_annual_income: '',
        hnw_income_source: '',
        // Financial
        has_outstanding_loans: '',
        loans: [],
        has_credit_cards: '',
        credit_cards: [],
        deposit_amount: '',
        deposit_source: '',
        credit_history_issues: '',
        documents: {
            proof_of_identity: null,
            proof_of_address: null,
            bank_statement_1: null,
            bank_statement_2: null,
            bank_statement_3: null,
            proof_of_deposit: null,
            payslip_1: null,
            payslip_2: null,
            payslip_3: null,
            sa302_current_year: null,
            sa302_previous_year: null
        },
        hasAdditionalSelfEmployedIncome: null
    };
}

const app = createApp({
    components: {
        'applicant-details': ApplicantDetails,
        'financial-details': FinancialDetails,
        'document-uploads': DocumentUploads
    },
    data() {
        return {
            currentStep: 1,
            isSubmitting: false,
            validationErrors: [], // NEW: Array to store current validation errors
            fieldErrors: {}, // NEW: Object to store field-specific errors for inline display
            formData: {
                applicant_type: '',
                applicant_situation: '',
                privacy_accepted: false,
                applicant1: createEmptyApplicant(),
                applicant2: createEmptyApplicant()
            }
        };
    },
    computed: {
        // NEW: Check if submit should be enabled
        isSubmitEnabled() {
            return this.formData.privacy_accepted;
        }
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
        
        updateApplicant1Documents(data) {
            this.formData.applicant1.documents = data.documents;
            this.formData.applicant1.hasAdditionalSelfEmployedIncome = data.hasAdditionalSelfEmployedIncome;
            this.saveDraft();
        },

        updateApplicant2Documents(data) {
            this.formData.applicant2.documents = data.documents;
            this.formData.applicant2.hasAdditionalSelfEmployedIncome = data.hasAdditionalSelfEmployedIncome;
            this.saveDraft();
        },

        areAllRequiredDocumentsUploaded(applicant) {
            const docs = applicant.documents;
            
            // Universal documents
            if (!docs.proof_of_identity || !docs.proof_of_address || 
                !docs.bank_statement_1 || !docs.bank_statement_2 || 
                !docs.bank_statement_3 || !docs.proof_of_deposit) {
                return false;
            }
            
            // Check payslips requirement
            const employmentType = applicant.employment_type;
            const requiresPayslips = ['employed-ft', 'employed-pt', 'employed-ftc', 'limited-director', 'contract'].includes(employmentType);
            
            if (requiresPayslips) {
                if (!docs.payslip_1 || !docs.payslip_2 || !docs.payslip_3) {
                    return false;
                }
            }
            
            // Check SA302 requirement
            const requiresSA302Mandatory = ['sole-trader', 'partnership', 'limited-director', 'retired', 'high-net-worth'].includes(employmentType);
            const showAdditionalIncomeQuestion = ['employed-ft', 'employed-pt', 'employed-ftc', 'contract'].includes(employmentType);
            
            let requiresSA302 = requiresSA302Mandatory;
            if (showAdditionalIncomeQuestion && applicant.hasAdditionalSelfEmployedIncome === 'yes') {
                requiresSA302 = true;
            }
            
            if (requiresSA302) {
                const isRetired = employmentType === 'retired';
                
                if (isRetired) {
                    if (!docs.sa302_previous_year) return false;
                } else {
                    if (!docs.sa302_current_year || !docs.doucment_sa302_previous_year) return false;
                }
            }
            
            return true;
        },

        // Validation
        validateCurrentStep() {
            // For now, allow progression without strict validation
            // Full validation will happen on final submit
            return true;
        },
        
        // NEW: Comprehensive validation that returns structured errors
        validateFinalForm() {
            const errors = [];
            
            // Step 1 validation
            if (!this.formData.applicant_type) {
                errors.push({
                    field: 'applicant_type',
                    message: 'Please select whether you are buying alone or with someone else',
                    step: 1
                });
            }
            if (!this.formData.applicant_situation) {
                errors.push({
                    field: 'applicant_situation',
                    message: 'Please select your situation',
                    step: 1
                });
            }
            
            if (!this.formData.privacy_accepted) {
                errors.push({
                    field: 'privacy_accepted',
                    message: 'You must accept the Privacy Policy to continue',
                    step: 3
                });
            }
            
            // Step 2 validation (Applicant 1)
            errors.push(...this.validateApplicant(this.formData.applicant1, '1'));
            
            // Step 2 validation (Applicant 2 if joint)
            if (this.formData.applicant_type === 'Joint applicant') {
                errors.push(...this.validateApplicant(this.formData.applicant2, '2'));
            }

            // Document validation for applicant 1
                if (!this.areAllRequiredDocumentsUploaded(this.formData.applicant1)) {
                    errors.push({
                        field: 'applicant1_documents',
                        message: 'Primary Applicant: Please upload all required documents',
                        step: 2
                    });
                }

                // Document validation for applicant 2 (if joint)
                if (this.formData.applicant_type === 'Joint applicant') {
                    if (!this.areAllRequiredDocumentsUploaded(this.formData.applicant2)) {
                        errors.push({
                            field: 'applicant2_documents',
                            message: 'Second Applicant: Please upload all required documents',
                            step: 2
                        });
                    }
                }
            
            return errors;
        },
        
        // NEW: Enhanced validation that returns structured error objects
        validateApplicant(applicant, number) {
            const errors = [];
            const label = `Applicant ${number}`;
            const step = number === '1' ? 2 : 2; // Both applicants on step 2
            
            // Helper function to add error
            const addError = (field, message) => {
                errors.push({
                    field: `applicant${number}_${field}`,
                    message: `${label}: ${message}`,
                    step: step
                });
            };
            
            // Basic details
            if (!applicant.first_name) addError('first_name', 'First name is required');
            if (!applicant.last_name) addError('last_name', 'Last name is required');
            if (!applicant.email) addError('email', 'Email is required');
            if (!applicant.phone) addError('phone', 'Phone is required');
            if (!applicant.date_of_birth) addError('date_of_birth', 'Date of birth is required');
            if (!applicant.marital_status) addError('marital_status', 'Marital status is required');
            if (!applicant.nationality) addError('nationality', 'Nationality is required');
            if (!applicant.national__insurance__number) addError('national__insurance__number', 'National Insurance number is required');
            
            // Address
            if (!applicant.current_address_street) addError('current_address_street', 'Current address street is required');
            if (!applicant.current_address_town) addError('current_address_town', 'Current address town is required');
            if (!applicant.address_postcode) addError('address_postcode', 'Current address postcode is required');
            if (!applicant.months_at_address) addError('months_at_address', 'Months at current address is required');
            if (!applicant.electoral_register) addError('electoral_register', 'Please indicate if you are on the electoral register');
            
            // Previous address if < 36 months
            if (parseInt(applicant.months_at_address) < 36) {
                if (!applicant.previous_address_street) addError('previous_address_street', 'Previous address street is required');
                if (!applicant.previous_address_town) addError('previous_address_town', 'Previous address town is required');
                if (!applicant.previous_address_postcode) addError('previous_address_postcode', 'Previous address postcode is required');
                if (!applicant.months_at_previous_address) addError('months_at_previous_address', 'Months at previous address is required');
            }
            
            // Employment
            if (!applicant.employment_type) addError('employment_type', 'Employment type is required');
            
            const employmentType = applicant.employment_type;
            
            // Employed validation
            if (['employed-ft', 'employed-pt', 'employed-ftc'].includes(employmentType)) {
                if (!applicant.occupation_job_title) addError('occupation_job_title', 'Job title is required');
                if (!applicant.employer_name) addError('employer_name', 'Employer name is required');
                if (!applicant.employer_address_street) addError('employer_address_street', 'Employer address is required');
                if (!applicant.employer_address_city) addError('employer_address_city', 'Employer town is required');
                if (!applicant.employer_postcode) addError('employer_postcode', 'Employer postcode is required');
                if (!applicant.total_annual_salary) addError('total_annual_salary', 'Annual salary is required');
            }
            
            // Contract validation
            if (employmentType === 'contract') {
                if (!applicant.occupation_job_title) addError('occupation_job_title', 'Job title is required');
                if (!applicant.contract_day_rate) addError('contract_day_rate', 'Day rate is required');
                if (!applicant.contract_days_per_month) addError('contract_days_per_month', 'Days per month is required');
            }
            
            // Self-employed validation
            if (['sole-trader', 'partnership', 'limited-director'].includes(employmentType)) {
                if (!applicant.business_name) addError('business_name', 'Business name is required');
                if (!applicant.occupation_job_title) addError('occupation_job_title', 'Nature of business is required');
                if (!applicant.latest_fy_net_profit) addError('latest_fy_net_profit', 'Latest year net profit is required');
                if (!applicant.latest_fy_end) addError('latest_fy_end', 'Latest year end date is required');
                if (!applicant.previous_fy_net_profit) addError('previous_fy_net_profit', 'Previous year net profit is required');
                if (!applicant.previous_fy_end) addError('previous_fy_end', 'Previous year end date is required');
            }
            
            // Retired validation
            if (employmentType === 'retired') {
                if (!applicant.state_pension_annual) addError('state_pension_annual', 'State pension income is required');
            }
            
            // High net worth validation
            if (employmentType === 'high-net-worth') {
                if (!applicant.total_assets_liabilities) addError('total_assets_liabilities', 'Total net worth is required');
                if (!applicant.hnw_annual_income) addError('hnw_annual_income', 'Annual income is required');
                if (!applicant.hnw_income_source) addError('hnw_income_source', 'Income source is required');
            }
            
            // Financial validation
            if (!applicant.has_outstanding_loans) addError('has_outstanding_loans', 'Please indicate if you have outstanding loans');
            if (!applicant.has_credit_cards) addError('has_credit_cards', 'Please indicate if you have credit cards');
            if (applicant.deposit_amount === '') addError('deposit_amount', 'Please enter deposit amount (0 if none)');
            if (!applicant.credit_history_issues) addError('credit_history_issues', 'Please indicate if you have credit history issues');
            
            // Loans validation - CONDITIONAL
            if (applicant.has_outstanding_loans === 'yes') {
                if (applicant.loans.length === 0) {
                    addError('loans', 'Please add at least one loan or select "No" for outstanding loans');
                } else {
                    applicant.loans.forEach((loan, index) => {
                        if (!loan.type) addError(`loan_${index}_type`, `Loan ${index + 1}: Type is required`);
                        if (!loan.provider) addError(`loan_${index}_provider`, `Loan ${index + 1}: Provider is required`);
                        if (!loan.outstanding_balance) addError(`loan_${index}_balance`, `Loan ${index + 1}: Outstanding balance is required`);
                        if (!loan.monthly_payment) addError(`loan_${index}_payment`, `Loan ${index + 1}: Monthly payment is required`);
                    });
                }
            }
            
            // Credit cards validation - CONDITIONAL
            if (applicant.has_credit_cards === 'yes') {
                if (applicant.credit_cards.length === 0) {
                    addError('credit_cards', 'Please add at least one credit card or select "No" for credit cards');
                } else {
                    applicant.credit_cards.forEach((card, index) => {
                        if (!card.provider) addError(`card_${index}_provider`, `Card ${index + 1}: Provider is required`);
                        if (!card.credit_limit) addError(`card_${index}_limit`, `Card ${index + 1}: Credit limit is required`);
                        if (!card.current_balance) addError(`card_${index}_balance`, `Card ${index + 1}: Current balance is required`);
                        if (!card.monthly_payment) addError(`card_${index}_payment`, `Card ${index + 1}: Monthly payment is required`);
                    });
                }
            }
            
            // Deposit source validation - CONDITIONAL
            if (applicant.deposit_amount > 0 && !applicant.deposit_source) {
                addError('deposit_source', 'Please select deposit source');
            }
            
            return errors;
        },
        
        // NEW: Scroll to first error and highlight it
        scrollToFirstError() {
            if (this.validationErrors.length === 0) return;
            
            // Get the first error's step
            const firstError = this.validationErrors[0];
            
            // If not on the right step, navigate there
            if (this.currentStep !== firstError.step) {
                this.currentStep = firstError.step;
            }
            
            // Wait for DOM update, then scroll to first error field
            this.$nextTick(() => {
                // Try to find the field by various selectors
                const fieldSelectors = [
                    `[name="${firstError.field}"]`,
                    `#${firstError.field}`,
                    `.form-field:has([name*="${firstError.field.split('_').pop()}"])`
                ];
                
                let errorElement = null;
                for (const selector of fieldSelectors) {
                    errorElement = document.querySelector(selector);
                    if (errorElement) break;
                }
                
                if (errorElement) {
                    // Scroll with offset for header
                    const yOffset = -100;
                    const y = errorElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({ top: y, behavior: 'smooth' });
                    
                    // Focus the field
                    errorElement.focus();
                } else {
                    // Fallback: just scroll to top of form
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        },
        
        // Submit
        async submitForm() {
            // Validate before submitting
            this.validationErrors = this.validateFinalForm();
            
            if (this.validationErrors.length > 0) {
                console.log('Validation errors:', this.validationErrors);
                this.scrollToFirstError();
                return;
            }
            
            this.isSubmitting = true;
            
            try {
                // Create FormData for file uploads
                const formData = new FormData();
                
                // Prepare JSON data (WITHOUT documents - they'll be sent as files)
                const jsonData = {
                    applicant_type: this.formData.applicant_type,
                    applicant_situation: this.formData.applicant_situation,
                    applicant1: this.flattenApplicantData(this.formData.applicant1),
                };
                
                // Remove documents from JSON (sent separately as files)
                delete jsonData.applicant1.documents;
                delete jsonData.applicant1.hasAdditionalSelfEmployedIncome; // Will be sent in FormData
                
                // Add applicant 2 if joint
                if (this.formData.applicant_type === 'Joint applicant') {
                    jsonData.applicant2 = this.flattenApplicantData(this.formData.applicant2);
                    delete jsonData.applicant2.documents;
                    delete jsonData.applicant2.hasAdditionalSelfEmployedIncome;
                }
                
                // Add JSON data to FormData
                formData.append('data', JSON.stringify(jsonData));
                
                // Append applicant1 documents as files
                const app1Docs = this.formData.applicant1.documents;
                Object.keys(app1Docs).forEach(key => {
                    if (app1Docs[key]) {
                        formData.append(`applicant1_${key}`, app1Docs[key]);
                    }
                });
                
                // Add applicant1's hasAdditionalSelfEmployedIncome
                if (this.formData.applicant1.hasAdditionalSelfEmployedIncome) {
                    formData.append('applicant1_hasAdditionalSelfEmployedIncome', this.formData.applicant1.hasAdditionalSelfEmployedIncome);
                }
                
                // Append applicant2 documents (if joint)
                if (this.formData.applicant_type === 'Joint applicant') {
                    const app2Docs = this.formData.applicant2.documents;
                    Object.keys(app2Docs).forEach(key => {
                        if (app2Docs[key]) {
                            formData.append(`applicant2_${key}`, app2Docs[key]);
                        }
                    });
                    
                    // Add applicant2's hasAdditionalSelfEmployedIncome
                    if (this.formData.applicant2.hasAdditionalSelfEmployedIncome) {
                        formData.append('applicant2_hasAdditionalSelfEmployedIncome', this.formData.applicant2.hasAdditionalSelfEmployedIncome);
                    }
                }
                
                console.log('Submitting to Flask with documents...');
                
                // Determine which URL to use (localhost for local dev, pythonanywhere for production)
                const isLocalhost = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1' || window.location.hostname === 'united-mortgages.local';
                const apiUrl = isLocalhost 
                    ? 'http://localhost:5000/api/submit-aip'
                    : 'https://unitedmortgages.eu.pythonanywhere.com/api/submit-aip';
                
                // Submit to Flask backend with FormData (no Content-Type header - browser sets it with boundary)
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    body: formData
                    // NOTE: Don't set Content-Type header - browser will set it automatically with multipart boundary
                });
                
                const result = await response.json();
                console.log('Flask response:', result);
                
                if (response.ok && result.success) {
                    console.log('Success! Contacts:', result.contacts_created);
                    this.clearDraft();
                    this.validationErrors = []; // Clear errors on success
                    this.currentStep = 4; // Move to success step
                } else {
                    // Show user-friendly error message
                    let errorMessage = result.error || 'We couldn\'t process your submission. Please contact our team directly.';
                    
                    // Handle specific error types
                    if (errorMessage.includes('email')) {
                        errorMessage = 'There was an issue with the email address provided. Please check and try again.';
                    } else if (errorMessage.includes('HubSpot') || errorMessage.includes('API')) {
                        errorMessage = 'We\'re experiencing technical difficulties. Please try again in a few minutes.';
                    } else if (errorMessage.includes('network') || errorMessage.includes('connection')) {
                        errorMessage = 'Please check your internet and try again.';
                    }
                    
                    alert(errorMessage + '\n\nIf the problem persists, please contact us at:\n📞 0208 446 4488\n✉️ hello@united-mortgages.com');
                }
            } catch (error) {
                console.error('Submission error:', error);
                alert('Unable to submit your application. Please check your internet connection and try again, or contact our team directly.');
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
            
            if (this.formData.applicant_type === 'Joint applicant') {
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
                    data: JSON.parse(JSON.stringify(this.formData, (key, value) => {
                        return value instanceof File ? null : value;
                    })),
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