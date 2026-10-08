const { createApp } = Vue;

// Gunsling: new key. Drafts under the old key can hold NI numbers and other
// fields the form no longer asks for, so they are deleted on load, unread.
const STORAGE_KEY = 'united_mortgages_aip_draft_v2';
const OLD_STORAGE_KEYS = ['united_mortgages_aip_draft'];
const PHONE_FALLBACK = '0333 091 4776';
// Saved drafts older than this are discarded on load (7 days).
const DRAFT_MAX_AGE_MS = 7 * 24 * 60 * 60 * 1000;

/**
 * Situation deep-link support (added for the triage flow).
 *
 * The triage flow links here with ?situation=<value>. This is the ONLY
 * addition to this form: no field was added, removed or renamed, and the
 * submission payload and its Flask handling are untouched. All this does is
 * pre-select one radio the visitor would otherwise click themselves.
 *
 * The whitelist is the form's own existing step-1 values, verbatim. Anything
 * not on it is ignored, so a bad or stale link can never inject a value the
 * form doesn't already offer.
 */
const VALID_SITUATIONS = [
    'First-time-buyer',
    'Remortgage',
    'Shared ownership/help to buy',
    'Buy to Let',
    'Guarantor',
    'Commercial'
];

function getSituationFromUrl() {
    try {
        const value = new URLSearchParams(window.location.search).get('situation');
        return VALID_SITUATIONS.includes(value) ? value : '';
    } catch (error) {
        return '';
    }
}

// Create empty applicant template
function createEmptyApplicant() {
    return {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        marital_status: '',
        nationality: '',
        current_address_town: '',
        address_postcode: '',
        electoral_register: '',
        months_at_address: '',
        previous_address_town: '',
        previous_address_postcode: '',
        months_at_previous_address: '',
        number_of_dependents: 0,
        ages_of_dependents: '',
        employment_type: '',
        // Employed fields
        occupation_job_title: '',
        employer_name: '',
        total_annual_salary: '',
        annual_bonus: '',
        annual_overtime: '',
        annual_commission: '',
        other_annual_income: '',
        employment_start_date: '',
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
        credit_history_info: ''
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
            validationErrors: [], // NEW: Array to store current validation errors
            fieldErrors: {}, // NEW: Object to store field-specific errors for inline display
            draftSaved: false,    // true only after a successful localStorage write
            draftRestored: false, // true only when a saved draft was restored on load
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
        // Must run AFTER loadDraft(): loadDraft() replaces formData wholesale,
        // so a returning visitor's saved draft would otherwise silently
        // overwrite the situation the branch link just asked for.
        this.applySituationFromUrl();
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
        // Apply ?situation= from a triage deep-link. No-op when absent or
        // unrecognised — see VALID_SITUATIONS above.
        applySituationFromUrl() {
            const situation = getSituationFromUrl();
            if (situation) {
                this.formData.applicant_situation = situation;
            }
        },

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
            if (!applicant.marital_status) addError('marital_status', 'Marital status is required');
            if (!applicant.nationality) addError('nationality', 'Nationality is required');
            
            // Address
            if (!applicant.current_address_town) addError('current_address_town', 'Current address town is required');
            if (!applicant.address_postcode) addError('address_postcode', 'Current address postcode is required');
            if (!applicant.months_at_address) addError('months_at_address', 'Months at current address is required');
            if (!applicant.electoral_register) addError('electoral_register', 'Please indicate if you are on the electoral register');
            
            // Previous address if < 36 months
            if (parseInt(applicant.months_at_address) < 36) {
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
                if (!applicant.total_annual_salary) addError('total_annual_salary', 'Annual salary is required');
                if (!applicant.employment_start_date) addError('employment_start_date', 'Employment start date is required');
            }
            
            // Contract validation
            if (employmentType === 'contract') {
                if (!applicant.occupation_job_title) addError('occupation_job_title', 'Job title is required');
                if (!applicant.contract_day_rate) addError('contract_day_rate', 'Day rate is required');
                if (!applicant.contract_days_per_month) addError('contract_days_per_month', 'Days per month is required');
                if (!applicant.employment_start_date) addError('employment_start_date', 'employment start date is required');
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
            // Credit history details validation - CONDITIONAL
            if (applicant.credit_history_issues === 'yes' && !applicant.credit_history_info) {
                addError('credit_history_info', 'Please provide details of your credit history issues');
            }

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
        
        // Scroll to first error and highlight it
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
                // Multipart with one JSON 'data' field: a CORS "simple request",
                // so no preflight. No files: the form no longer asks for any.
                const formData = new FormData();
                const jsonData = {
                    applicant_type: this.formData.applicant_type,
                    applicant_situation: this.formData.applicant_situation,
                    privacy_accepted: this.formData.privacy_accepted,
                    applicant1: this.flattenApplicantData(this.formData.applicant1),
                };
                if (this.formData.applicant_type === 'Joint applicant') {
                    jsonData.applicant2 = this.flattenApplicantData(this.formData.applicant2);
                }
                formData.append('data', JSON.stringify(jsonData));

                // Spam honeypot: off-screen, left empty by people.
                const honeypot = document.getElementById('um-aip-hp');
                formData.append('um_hp', honeypot ? honeypot.value : '');
                
                // Determine which URL to use (localhost for local dev, pythonanywhere for production)
                const isLocalhost = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1' || window.location.hostname === 'united-mortgages.local';
                const apiUrl = isLocalhost 
                    ? 'http://localhost:5000/api/submit-aip'
                    : 'https://unitedmortgages.eu.pythonanywhere.com/api/submit-aip';
                
                // No Content-Type header: the browser sets it with the multipart boundary.
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    body: formData
                });
                
                let result = {};
                try {
                    result = await response.json();
                } catch (parseError) {
                    result = {};
                }
                
                if (response.ok && result.success) {
                    this.clearDraft();
                    this.validationErrors = []; // Clear errors on success
                    this.currentStep = 4; // Move to success step
                } else if ((response.status === 400 || response.status === 429) && result.error) {
                    // The server writes these messages for visitors; they
                    // already end with the phone number where relevant.
                    alert(result.error);
                } else {
                    alert('Sorry, we couldn\'t send your application just now. Please try again in a few minutes, or call us on ' + PHONE_FALLBACK + '.');
                }
            } catch (error) {
                console.error('Submission error:', error.name);
                alert('We couldn\'t reach our server. Please check your internet connection and try again, or call us on ' + PHONE_FALLBACK + '.');
            } finally {
                this.isSubmitting = false;
            }
        },
        
        flattenApplicantData(applicant) {
            // loans and credit_cards travel as JSON strings, as before.
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
                    data: JSON.parse(JSON.stringify(this.formData)),
                    currentStep: this.currentStep
                };
                localStorage.setItem(STORAGE_KEY, JSON.stringify(draft));
                this.draftSaved = true;
            } catch (error) {
                this.draftSaved = false;
                console.error('Error saving draft:', error);
            }
        },
        
        // Delete drafts saved under any old key without reading them.
        removeOldDrafts() {
            OLD_STORAGE_KEYS.forEach(key => {
                try {
                    localStorage.removeItem(key);
                } catch (error) {
                    // Storage unavailable: nothing to remove.
                }
            });
        },

        loadDraft() {
            this.removeOldDrafts();
            try {
                const draft = localStorage.getItem(STORAGE_KEY);
                if (draft) {
                    const parsed = JSON.parse(draft);
                    const savedAt = Date.parse(parsed && parsed.timestamp);
                    if (!parsed || !parsed.data || isNaN(savedAt) || Date.now() - savedAt > DRAFT_MAX_AGE_MS) {
                        this.clearDraft();
                        return;
                    }
                    this.formData = parsed.data;
                    this.currentStep = parsed.currentStep || 1;
                    this.draftRestored = true;
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
        },

        // "Start over" on the restored-answers banner. Reloads rather than
        // resetting formData in place, so every component starts fresh.
        // Clearing storage doesn't touch formData, so the watcher can't
        // re-save first. The query string is kept so a ?situation=
        // deep-link still applies.
        startOver() {
            this.clearDraft();
            window.location.replace(window.location.pathname + window.location.search);
        }
    }
});

app.mount('#aip-app');