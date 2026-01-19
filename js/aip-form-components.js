// Applicant Details Component
const ApplicantDetails = {
    props: ['applicant', 'applicantNumber'],
    emits: ['update'],
    template: `
        <div class="form-section-card">
            <div class="section-header-with-label">
                <h2 class="section-title">{{ applicantNumber === '1' ? 'Your' : 'Second Applicant' }} Details</h2>
                <span class="applicant-label">Applicant {{ applicantNumber }}</span>
            </div>
            
            <div class="form-fields">
                <div class="form-row">
                    <div class="form-field">
                        <label>First name *</label>
                        <input type="text" v-model="applicant.first_name" placeholder="Enter first name" @input="update" />
                    </div>
                    <div class="form-field">
                        <label>Last name *</label>
                        <input type="text" v-model="applicant.last_name" placeholder="Enter last name" @input="update" />
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label>Email *</label>
                        <input type="email" v-model="applicant.email" placeholder="your.email@example.com" @input="update" />
                        <span v-if="!isValidEmail && applicant.email" class="error-text">Invalid email format</span>
                    </div>
                    <div class="form-field">
                        <label>Phone *</label>
                        <input type="tel" v-model="applicant.phone" placeholder="07123 456789" @input="update" />
                        <span v-if="!isValidPhone && applicant.phone" class="error-text">Invalid UK phone format</span>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label>Date of Birth *</label>
                        <input type="date" v-model="applicant.date_of_birth" @input="update" />
                    </div>
                    <div class="form-field">
                        <label>Marital Status *</label>
                        <select v-model="applicant.marital_status" @change="update">
                            <option value="">Select...</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Engaged">Engaged</option>
                            <option value="Civil Partnership">Civil Partnership</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label>Nationality *</label>
                        <input type="text" v-model="applicant.nationality" placeholder="e.g. British" @input="update" />
                    </div>
                    <div class="form-field">
                        <label>National Insurance Number *</label>
                        <input type="text" v-model="applicant.national_insurance_number" 
                               placeholder="AB123456C" 
                               @input="update" 
                               maxlength="9" />
                        <span v-if="!isValidNI && applicant.national_insurance_number" class="error-text">Invalid NI format (e.g. AB123456C)</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-section-card">
            <h3 class="section-subtitle">Current Address</h3>
            <div class="form-fields">
                <div class="form-field">
                    <label>Street Address *</label>
                    <input type="text" v-model="applicant.current_address_street" placeholder="Enter street address" @input="update" />
                </div>

                
                <div class="form-row">
                    <div class="form-field">
                        <label>Town/City *</label>
                        <input type="text" v-model="applicant.current_address_town" placeholder="Enter town/city" @input="update" />
                    </div>
                    <div class="form-field">
                        <label>County</label>
                        <input type="text" v-model="applicant.current_address_county" placeholder="Enter county" @input="update" />
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label>Postcode *</label>
                        <input type="text" v-model="applicant.current_address_postcode" 
                               placeholder="SW1A 1AA" 
                               @input="update" 
                               style="text-transform: uppercase" />
                        <span v-if="!isValidPostcode && applicant.current_address_postcode" class="error-text">Invalid UK postcode</span>
                    </div>
                    <div class="form-field">
                        <label>Months at this address *</label>
                        <input type="number" v-model="applicant.months_at_address" min="0" placeholder="0" @input="update" />
                    </div>
                </div>
                
                <div class="form-field">
                    <label>Electoral Register *</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'electoral_register_' + applicantNumber" value="Yes" v-model="applicant.electoral_register" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'electoral_register_' + applicantNumber" value="No" v-model="applicant.electoral_register" @change="update" />
                            <span>No</span>
                        </label>
                    </div>
            </div>
        </div>
        
        <!-- Previous Address (conditional) -->
        <div v-if="showPreviousAddress" class="form-section-card">
            <h3 class="section-subtitle">Previous Address</h3>
            <p class="helper-text">You've lived at your current address for less than 3 years, please provide your previous address</p>
            <div class="form-fields">
                <div class="form-field">
                    <label>Street Address *</label>
                    <input type="text" v-model="applicant.previous_address_street" placeholder="Enter street address" @input="update" />
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label>Town/City *</label>
                        <input type="text" v-model="applicant.previous_address_town" placeholder="Enter town/city" @input="update" />
                    </div>
                    <div class="form-field">
                        <label>County</label>
                        <input type="text" v-model="applicant.previous_address_county" placeholder="Enter county" @input="update" />
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-field">
                        <label>Postcode *</label>
                        <input type="text" v-model="applicant.previous_address_postcode" 
                               placeholder="SW1A 1AA" 
                               @input="update"
                               style="text-transform: uppercase" />
                    </div>
                    <div class="form-field">
                        <label>Months at previous address *</label>
                        <input type="number" v-model="applicant.months_at_previous_address" min="0" placeholder="0" @input="update" />
                    </div>
                </div>
            </div>
        </div>
        </div>

        
        <div class="form-section-card">
            <h3 class="section-subtitle">Dependents</h3>
            <div class="form-fields">
                <div class="form-field">
                    <label>Number of dependents</label>
                    <input type="number" v-model="applicant.number_of_dependents" min="0" placeholder="0" @input="update" />
                </div>
                
                <div v-if="applicant.number_of_dependents > 0" class="form-field">
                    <label>Ages of dependents (comma-separated)</label>
                    <input type="text" v-model="applicant.ages_of_dependents" placeholder="e.g. 5, 8, 12" @input="update" />
                    <span class="helper-text">Enter ages separated by commas</span>
                </div>
            </div>
        </div>
    `,
    computed: {
        showPreviousAddress() {
            return this.applicant.months_at_address && parseInt(this.applicant.months_at_address) < 36;
        },
        isValidEmail() {
            if (!this.applicant.email) return true;
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.applicant.email);
        },
        isValidPhone() {
            if (!this.applicant.phone) return true;
            return /^(\+44|0)[0-9]{10}$/.test(this.applicant.phone.replace(/\s/g, ''));
        },
        isValidNI() {
            if (!this.applicant.national_insurance_number) return true;
            return /^[A-Z]{2}[0-9]{6}[A-Z]$/i.test(this.applicant.national_insurance_number.replace(/\s/g, ''));
        },
        isValidPostcode() {
            if (!this.applicant.current_address_postcode) return true;
            return /^[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}$/i.test(this.applicant.current_address_postcode);
        }
    },
    methods: {
        update() {
            this.$emit('update', this.applicant);
        }
    }
};

// Financial Details Component
const FinancialDetails = {
    props: ['applicant', 'applicantNumber'],
    emits: ['update'],
    template: `
        <div class="form-section-card">
            <div class="section-header-with-label">
                <h2 class="section-title">{{ applicantNumber === '1' ? 'Your' : 'Second Applicant' }} Financial Details</h2>
                <span class="applicant-label">Applicant {{ applicantNumber }}</span>
            </div>
            
            <div class="form-fields">
                <div class="form-field">
                    <label>Employment Type *</label>
                    <select v-model="applicant.employment_type" @change="update">
                        <option value="">Select...</option>
                            <option value="Employed â€“ Permanent Full-Time">Employed â€“ Permanent Full-Time</option>
                            <option value="Employed â€“ Permanent Part-Time">Employed â€“ Permanent Part-Time</option>
                            <option value="Employed â€“ Fixed-Term Contract">Employed â€“ Fixed-Term Contract</option>
                            <option value="Self-Employed â€“ Sole Trader">Self-Employed â€“ Sole Trader</option>
                            <option value="Self-Employed â€“ Partnership">Self-Employed â€“ Partnership</option>
                            <option value="Self-Employed â€“ Limited Company Director">Self-Employed â€“ Limited Company Director</option>
                            <option value="Agency Worker / Zero-Hour Contract">Agency Worker / Zero-Hour Contract</option>
                            <option value="Retired">Retired</option>
                            <option value="High Net-Worth Individual (HNWI)">High Net-Worth Individual (HNWI)</option>
                    </select>
                </div>
                
                <!-- Employed Fields -->
                <template v-if="isEmployed">
                    <div class="form-field">
                        <label>Job Title *</label>
                        <input type="text" v-model="applicant.occupation_job_title" placeholder="Enter job title" @input="update" />
                    </div>
                    
                    <div class="form-field">
                        <label>Employer Name *</label>
                        <input type="text" v-model="applicant.employer_name" placeholder="Enter employer name" @input="update" />
                    </div>
                    
                    <div class="form-field">
                        <label>Employer Street Address *</label>
                        <input type="text" v-model="applicant.employer_address_street" placeholder="Enter employer address" @input="update" />
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label>Employer Town/City *</label>
                            <input type="text" v-model="applicant.employer_address_town" placeholder="Enter town/city" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Employer County</label>
                            <input type="text" v-model="applicant.employer_county" placeholder="Enter county" @input="update" />
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label>Employer Postcode *</label>
                            <input type="text" v-model="applicant.employer_postcode" placeholder="SW1A 1AA" @input="update" style="text-transform: uppercase" />
                        </div>
                        <div class="form-field">
                            <label>Total Annual Salary (Â£) *</label>
                            <input type="number" v-model="applicant.total_annual_salary" min="0" placeholder="50000" @input="update" />
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label>Annual Additional Income (Â£)</label>
                        <input type="number" v-model="applicant.annual_additional_income" min="0" placeholder="0" @input="update" />
                        <span class="helper-text">Bonuses, commission, overtime, etc.</span>
                    </div>
                </template>
                
                <!-- Self-Employed Fields -->
                <template v-if="isSelfEmployed">
                    <div class="form-field">
                        <label>Occupation/Job Title *</label>
                        <input type="text" v-model="applicant.occupation_job_title" placeholder="Enter occupation" @input="update" />
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label>Latest Financial Year Net Profit (Â£) *</label>
                            <input type="number" v-model="applicant.latest_fy_net_profit" min="0" placeholder="50000" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Latest Financial Year End *</label>
                            <input type="date" v-model="applicant.latest_fy_end" @input="update" />
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label>Previous Financial Year Net Profit (Â£) *</label>
                            <input type="number" v-model="applicant.previous_fy_net_profit" min="0" placeholder="45000" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Previous Financial Year End *</label>
                            <input type="date" v-model="applicant.previous_fy_end" @input="update" />
                        </div>
                    </div>
                </template>
                
                <!-- Retired Fields -->
                <template v-if="isRetired">
                    <div class="form-field">
                        <label>Annual Retirement Income (Â£) *</label>
                        <input type="number" v-model="applicant.annual_retirement_income" min="0" placeholder="20000" @input="update" />
                    </div>
                </template>
                
                <!-- High Net Worth Fields -->
                <template v-if="isHighNetWorth">
                    <div class="form-field">
                        <label>Total Value of Assets and Liabilities (Â£) *</label>
                        <input type="number" v-model="applicant.total_assets_liabilities" min="0" placeholder="1000000" @input="update" />
                    </div>
                    
                    <div class="form-field">
                        <label>Annual Income (Â£) *</label>
                        <input type="number" v-model="applicant.annual_income_hnw" min="0" placeholder="100000" @input="update" />
                    </div>
                </template>
            </div>
        </div>
        
        <!-- Loans Section -->
        <div class="form-section-card">
            <h3 class="section-subtitle">Outstanding Loans</h3>
            <div class="form-fields">
                <div class="radio-group radio-group-inline">
                    <label>Do you have any outstanding loans? *</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_loans_' + applicantNumber" value="Yes" v-model="applicant.has_outstanding_loans" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_loans_' + applicantNumber" value="No" v-model="applicant.has_outstanding_loans" @change="update" />
                            <span>No</span>
                        </label>
                    </div>
                </div>
                
                <template v-if="applicant.has_outstanding_loans === 'yes'">
                    <div v-for="(loan, index) in applicant.loans" :key="index" class="nested-card">
                        <div class="nested-card-header">
                            <h4>Loan {{ index + 1 }}</h4>
                            <button type="button" @click="removeLoan(index)" class="btn-remove">Remove</button>
                        </div>
                        <div class="form-fields">
                            <div class="form-field">
                                <label>Loan Provider *</label>
                                <input type="text" v-model="loan.provider" placeholder="Enter provider name" @input="update" />
                            </div>
                            <div class="form-field">
                                <label>Monthly Payment (Â£) *</label>
                                <input type="number" v-model="loan.monthly_payment" min="0" placeholder="250" @input="update" />
                            </div>
                            <div class="form-field">
                                <label class="checkbox-label">
                                    <input type="checkbox" v-model="loan.will_be_settled" @change="update" />
                                    This loan will be settled before application
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="button" @click="addLoan" class="btn-add">+ Add Another Loan</button>
                </template>
            </div>
        </div>
        
        <!-- Credit Cards Section -->
        <div class="form-section-card">
            <h3 class="section-subtitle">Credit Cards</h3>
            <div class="form-fields">
                <div class="radio-group radio-group-inline">
                    <label>Do you have any credit cards? *</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_cards_' + applicantNumber" value="Yes" v-model="applicant.has_credit_cards" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_cards_' + applicantNumber" value="No" v-model="applicant.has_credit_cards" @change="update" />
                            <span>No</span>
                        </label>
                    </div>
                </div>
                
                <template v-if="applicant.has_credit_cards === 'yes'">
                    <div v-for="(card, index) in applicant.credit_cards" :key="index" class="nested-card">
                        <div class="nested-card-header">
                            <h4>Credit Card {{ index + 1 }}</h4>
                            <button type="button" @click="removeCreditCard(index)" class="btn-remove">Remove</button>
                        </div>
                        <div class="form-fields">
                            <div class="form-field">
                                <label>Card Provider *</label>
                                <input type="text" v-model="card.provider" placeholder="Enter provider name" @input="update" />
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label>Current Balance (Â£) *</label>
                                    <input type="number" v-model="card.current_balance" min="0" placeholder="1500" @input="update" />
                                </div>
                                <div class="form-field">
                                    <label>Monthly Payment (Â£) *</label>
                                    <input type="number" v-model="card.monthly_payment" min="0" placeholder="100" @input="update" />
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="checkbox-label">
                                    <input type="checkbox" v-model="card.will_be_settled" @change="update" />
                                    This balance will be settled before application
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="button" @click="addCreditCard" class="btn-add">+ Add Another Credit Card</button>
                </template>
            </div>
        </div>
        
        <!-- Deposit and Credit History -->
        <div class="form-section-card">
            <h3 class="section-subtitle">Deposit & Credit History</h3>
            <div class="form-fields">
                <div class="radio-group radio-group-inline">
                    <label>Do you have a deposit? *</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_deposit_' + applicantNumber" value="Yes" v-model="applicant.has_deposit" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_deposit_' + applicantNumber" value="No" v-model="applicant.has_deposit" @change="update" />
                            <span>No</span>
                        </label>
                    </div>
                </div>
                
                <div v-if="applicant.has_deposit === 'yes'" class="form-field">
                    <label>Source of Deposit *</label>
                    <select v-model="applicant.deposit_source" @change="update">
                        <option value="">Select...</option>
                            <option value="Personal Savings">Personal Savings</option>
                            <option value="Gifted Deposit - family">Gifted Deposit - family</option>
                            <option value="Gifted Deposit - non family">Gifted Deposit - non family</option>
                            <option value="Inheritance">Inheritance</option>
                            <option value="Sale of existing property">Sale of existing property</option>
                            <option value="Sale of other assets">Sale of other assets</option>
                            <option value="Equity from remortgage">Equity from remortgage</option>
                            <option value="Help to buy">Help to buy</option>
                            <option value="Company bonus or shares">Company bonus or shares</option>
                            <option value="Savings from abroad">Savings from abroad</option>
                            <option value="Loan from family/friends">Loan from family/friends</option>
                            <option value="Loan from financial institution">Loan from financial institution</option>
                            <option value="Combination of sources">Combination of sources</option>
                    </select>
                </div>
                
                <div class="radio-group radio-group-inline">
                    <label>Do you have any credit history issues? *</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'credit_issues_' + applicantNumber" value="Yes" v-model="applicant.credit_history_issues" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'credit_issues_' + applicantNumber" value="No" v-model="applicant.credit_history_issues" @change="update" />
                            <span>No</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    `,
    computed: {
        isEmployed() {
            return ['employed-ft', 'employed-pt', 'employed-ftc'].includes(this.applicant.employment_type);
        },
        isSelfEmployed() {
            return ['sole-trader', 'partnership', 'limited-director'].includes(this.applicant.employment_type);
        },
        isRetired() {
            return this.applicant.employment_type === 'retired';
        },
        isHighNetWorth() {
            return this.applicant.employment_type === 'high-net-worth';
        }
    },
    methods: {
        update() {
            this.$emit('update', this.applicant);
        },
        addLoan() {
            this.applicant.loans.push({
                provider: '',
                monthly_payment: '',
                will_be_settled: false
            });
            this.update();
        },
        removeLoan(index) {
            this.applicant.loans.splice(index, 1);
            this.update();
        },
        addCreditCard() {
            this.applicant.credit_cards.push({
                provider: '',
                current_balance: '',
                monthly_payment: '',
                will_be_settled: false
            });
            this.update();
        },
        removeCreditCard(index) {
            this.applicant.credit_cards.splice(index, 1);
            this.update();
        }
    }
};