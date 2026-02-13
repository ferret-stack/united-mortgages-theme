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
                        <select v-model="applicant.nationality" placeholder="e.g. British" @input="update" >
                        <option value="">Select nationality</option>
                            <option value="United Kingdom">British</option>
                            <option value="Ireland">Irish</option>
                            <option value="Afghanistan">Afghan</option>
                            <option value="Albania">Albanian</option>
                            <option value="Algeria">Algerian</option>
                            <option value="Argentina">Argentinian</option>
                            <option value="Australia">Australian</option>
                            <option value="Austria">Austrian</option>
                            <option value="Bangladesh">Bangladeshi</option>
                            <option value="Belgium">Belgian</option>
                            <option value="Brazil">Brazilian</option>
                            <option value="Bulgaria">Bulgarian</option>
                            <option value="Canada">Canadian</option>
                            <option value="Chile">Chilean</option>
                            <option value="China">Chinese</option>
                            <option value="Colombia">Colombian</option>
                            <option value="Croatia">Croatian</option>
                            <option value="Cyprus">Cypriot</option>
                            <option value="Czechia">Czech</option>
                            <option value="Denmark">Danish</option>
                            <option value="Egypt">Egyptian</option>
                            <option value="Estonia">Estonian</option>
                            <option value="Ethiopia">Ethiopian</option>
                            <option value="Finland">Finnish</option>
                            <option value="France">French</option>
                            <option value="Germany">German</option>
                            <option value="Ghana">Ghanaian</option>
                            <option value="Greece">Greek</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungarian</option>
                            <option value="Iceland">Icelandic</option>
                            <option value="India">Indian</option>
                            <option value="Indonesia">Indonesian</option>
                            <option value="Iran, Islamic Republic of">Iranian</option>
                            <option value="Iraq">Iraqi</option>
                            <option value="Israel">Israeli</option>
                            <option value="Italy">Italian</option>
                            <option value="Jamaica">Jamaican</option>
                            <option value="Japan">Japanese</option>
                            <option value="Jordan">Jordanian</option>
                            <option value="Kenya">Kenyan</option>
                            <option value="Korea, Republic of">South Korean</option>
                            <option value="Kuwait">Kuwaiti</option>
                            <option value="Latvia">Latvian</option>
                            <option value="Lebanon">Lebanese</option>
                            <option value="Lithuania">Lithuanian</option>
                            <option value="Luxembourg">Luxembourgish</option>
                            <option value="Malaysia">Malaysian</option>
                            <option value="Malta">Maltese</option>
                            <option value="Mexico">Mexican</option>
                            <option value="Morocco">Moroccan</option>
                            <option value="Nepal">Nepalese</option>
                            <option value="Netherlands">Dutch</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nigeria">Nigerian</option>
                            <option value="Norway">Norwegian</option>
                            <option value="Pakistan">Pakistani</option>
                            <option value="Peru">Peruvian</option>
                            <option value="Philippines">Filipino</option>
                            <option value="Poland">Polish</option>
                            <option value="Portugal">Portuguese</option>
                            <option value="Qatar">Qatari</option>
                            <option value="Romania">Romanian</option>
                            <option value="Russian Federation">Russian</option>
                            <option value="Saudi Arabia">Saudi Arabian</option>
                            <option value="Serbia">Serbian</option>
                            <option value="Singapore">Singaporean</option>
                            <option value="Slovakia">Slovak</option>
                            <option value="Slovenia">Slovenian</option>
                            <option value="Somalia">Somali</option>
                            <option value="South Africa">South African</option>
                            <option value="South Sudan">South Sudanese</option>
                            <option value="Spain">Spanish</option>
                            <option value="Sri Lanka">Sri Lankan</option>
                            <option value="Sudan">Sudanese</option>
                            <option value="Sweden">Swedish</option>
                            <option value="Switzerland">Swiss</option>
                            <option value="Syrian Arab Republic">Syrian</option>
                            <option value="Taiwan">Taiwanese</option>
                            <option value="Thailand">Thai</option>
                            <option value="Trinidad and Tobago">Trinidadian/Tobagonian</option>
                            <option value="Tunisia">Tunisian</option>
                            <option value="Turkey">Turkish</option>
                            <option value="Uganda">Ugandan</option>
                            <option value="Ukraine">Ukrainian</option>
                            <option value="United Arab Emirates">Emirati</option>
                            <option value="United States">American</option>
                            <option value="Vietnam">Vietnamese</option>
                            <option value="Yemen">Yemeni</option>
                            <option value="Zimbabwe">Zimbabwean</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>National Insurance Number *</label>
                        <input type="text" v-model="applicant.national__insurance__number" 
                               placeholder="AB123456C" 
                               @input="update" 
                               maxlength="9" />
                        <span v-if="!isValidNI && applicant.national__insurance__number" class="error-text">Invalid NI format (e.g. AB123456C)</span>
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
                        <input type="text" v-model="applicant.address_postcode" 
                               placeholder="SW1A 1AA" 
                               @input="update" 
                               style="text-transform: uppercase" />
                        <span v-if="!isValidPostcode && applicant.address_postcode" class="error-text">Invalid UK postcode</span>
                    </div>
                    <div class="form-field">
                        <label>Months at this address *</label>
                        <input type="number" v-model="applicant.months_at_address" min="0" placeholder="0" @input="update" />
                    </div>
                </div>
                
                <div class="form-field">
                    <label>Are you on the Electoral Register at this address?*</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'electoral_register_' + applicantNumber" value="yes" v-model="applicant.electoral_register" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'electoral_register_' + applicantNumber" value="no" v-model="applicant.electoral_register" @change="update" />
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
            if (!this.applicant.national__insurance__number) return true;
            return /^[A-Z]{2}[0-9]{6}[A-Z]$/i.test(this.applicant.national__insurance__number.replace(/\s/g, ''));
        },
        isValidPostcode() {
            if (!this.applicant.address_postcode) return true;
            return /^[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}$/i.test(this.applicant.address_postcode);
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
                        <option value="employed-ft">Employed – Permanent Full-Time</option>
                        <option value="employed-pt">Employed – Permanent Part-Time</option>
                        <option value="employed-ftc">Employed – Fixed-Term Contract</option>
                        <option value="sole-trader">Self-Employed – Sole Trader</option>
                        <option value="partnership">Self-Employed – Partnership</option>
                        <option value="limited-director">Self-Employed – Limited Company Director</option>
                        <option value="contract">Contract / Agency Worker</option>
                        <option value="retired">Retired</option>
                        <option value="high-net-worth">High Net-Worth Individual (HNWI)</option>
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
                            <input type="text" v-model="applicant.employer_address_city" placeholder="Enter town/city" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Employer County</label>
                            <input type="text" v-model="applicant.employer_county" placeholder="Enter county" @input="update" />
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label>Employer Postcode *</label>
                        <input type="text" v-model="applicant.employer_postcode" placeholder="SW1A 1AA" @input="update" style="text-transform: uppercase" />
                    </div>
                    
                    <div class="form-field">
                        <label>Basic Annual Salary (£) *</label>
                        <input type="number" v-model="applicant.total_annual_salary" min="0" placeholder="50000" @input="update" />
                        <span class="helper-text">Your base salary before bonuses/overtime</span>
                    </div>
                    
                    <div class="form-field">
                        <label>Annual Bonus (£)</label>
                        <input type="number" v-model="applicant.annual_bonus" min="0" placeholder="0" @input="update" />
                        <span class="helper-text">Guaranteed or regular bonuses</span>
                    </div>
                    
                    <div class="form-field">
                        <label>Annual Overtime (£)</label>
                        <input type="number" v-model="applicant.annual_overtime" min="0" placeholder="0" @input="update" />
                        <span class="helper-text">Regular overtime earnings</span>
                    </div>
                    
                    <div class="form-field">
                        <label>Annual Commission (£)</label>
                        <input type="number" v-model="applicant.annual_commission" min="0" placeholder="0" @input="update" />
                        <span class="helper-text">Commission or variable pay</span>
                    </div>
                    
                    <div class="form-field">
                        <label>Other Regular Income (£)</label>
                        <input type="number" v-model="applicant.other_annual_income" min="0" placeholder="0" @input="update" />
                        <span class="helper-text">Car allowance, benefits, etc.</span>
                    </div>
                </template>
                
                <!-- Contract Worker Fields -->
                <template v-if="isContract">
                    <div class="form-field">
                        <label>Job Title/Role *</label>
                        <input type="text" v-model="applicant.occupation_job_title" placeholder="Enter job title" @input="update" />
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label>Day Rate (£) *</label>
                            <input type="number" v-model="applicant.contract_day_rate" min="0" placeholder="500" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Average Days per Month *</label>
                            <input type="number" v-model="applicant.contract_days_per_month" min="0" max="31" placeholder="20" @input="update" />
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label>Contract End Date</label>
                        <input type="date" v-model="applicant.contract_end_date" @input="update" />
                        <span class="helper-text">Leave blank if ongoing</span>
                    </div>
                </template>
                
                <!-- Self-Employed Fields -->
                <template v-if="isSelfEmployed">
                    <div class="form-field">
                        <label>Business Name / Trading As *</label>
                        <input type="text" v-model="applicant.business_name" placeholder="Enter business name" @input="update" />
                    </div>
                    
                    <div class="form-field">
                        <label>Nature of Business *</label>
                        <input type="text" v-model="applicant.occupation_job_title" placeholder="e.g. Freelance Designer, Plumbing Services" @input="update" />
                    </div>
                    
                    <h4 class="section-subtitle" style="margin-top: 20px;">Latest Financial Year</h4>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Net Profit (£) *</label>
                            <input type="number" v-model="applicant.latest_fy_net_profit" min="0" placeholder="50000" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Year End Date *</label>
                            <input type="date" v-model="applicant.latest_fy_end" @input="update" />
                        </div>
                    </div>
                    
                    <div v-if="isLimitedDirector" class="form-field">
                        <label>Salary Drawn (£)</label>
                        <input type="number" v-model="applicant.latest_fy_salary" min="0" placeholder="12500" @input="update" />
                        <span class="helper-text">Director's salary from the company</span>
                    </div>
                    
                    <div v-if="isLimitedDirector" class="form-field">
                        <label>Dividends Taken (£)</label>
                        <input type="number" v-model="applicant.latest_fy_dividends" min="0" placeholder="30000" @input="update" />
                    </div>
                    
                    <h4 class="section-subtitle" style="margin-top: 20px;">Previous Financial Year</h4>
                    <div class="form-row">
                        <div class="form-field">
                            <label>Net Profit (£) *</label>
                            <input type="number" v-model="applicant.previous_fy_net_profit" min="0" placeholder="45000" @input="update" />
                        </div>
                        <div class="form-field">
                            <label>Year End Date *</label>
                            <input type="date" v-model="applicant.previous_fy_end" @input="update" />
                        </div>
                    </div>
                    
                    <div v-if="isLimitedDirector" class="form-field">
                        <label>Salary Drawn (£)</label>
                        <input type="number" v-model="applicant.previous_fy_salary" min="0" placeholder="12500" @input="update" />
                    </div>
                    
                    <div v-if="isLimitedDirector" class="form-field">
                        <label>Dividends Taken (£)</label>
                        <input type="number" v-model="applicant.previous_fy_dividends" min="0" placeholder="28000" @input="update" />
                    </div>
                </template>
                
                <!-- Retired Fields -->
                <template v-if="isRetired">
                    <div class="form-field">
                        <label>State Pension (£ per year) *</label>
                        <input type="number" v-model="applicant.state_pension_annual" min="0" placeholder="11500" @input="update" />
                    </div>
                    
                    <div class="form-field">
                        <label>Private Pension(s) (£ per year)</label>
                        <input type="number" v-model="applicant.private_pension_annual" min="0" placeholder="0" @input="update" />
                    </div>
                    
                    <div class="form-field">
                        <label>Other Retirement Income (£ per year)</label>
                        <input type="number" v-model="applicant.other_retirement_income" min="0" placeholder="0" @input="update" />
                        <span class="helper-text">Rental income, investments, etc.</span>
                    </div>
                </template>
                
                <!-- High Net Worth Fields -->
                <template v-if="isHighNetWorth">
                    <div class="form-field">
                        <label>Total Net Worth (£) *</label>
                        <input type="number" v-model="applicant.total_assets_liabilities" min="0" placeholder="3000000" @input="update" />
                        <span class="helper-text">Assets minus liabilities</span>
                    </div>
                    
                    <div class="form-field">
                        <label>Annual Income (£) *</label>
                        <input type="number" v-model="applicant.hnw_annual_income" min="0" placeholder="300000" @input="update" />
                        <span class="helper-text">From all sources</span>
                    </div>
                    
                    <div class="form-field">
                        <label>Primary Income Source *</label>
                        <select v-model="applicant.hnw_income_source" @change="update">
                            <option value="">Select...</option>
                            <option value="investments">Investments & Dividends</option>
                            <option value="property">Property Portfolio</option>
                            <option value="business">Business Ownership</option>
                            <option value="inheritance">Inheritance / Trust</option>
                            <option value="mixed">Mixed Sources</option>
                        </select>
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
                            <input type="radio" :name="'has_loans_' + applicantNumber" value="yes" v-model="applicant.has_outstanding_loans" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_loans_' + applicantNumber" value="no" v-model="applicant.has_outstanding_loans" @change="update" />
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
                                <label>Loan Type *</label>
                                <select v-model="loan.type" @input="update">
                                    <option value="">Select...</option>
                                    <option value="personal-loan">Personal Loan</option>
                                    <option value="car-finance">Car Finance / HP</option>
                                    <option value="student-loan">Student Loan</option>
                                    <option value="credit-card">Credit Card</option>
                                    <option value="overdraft">Overdraft</option>
                                    <option value="payday-loan">Payday Loan</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-field">
                                <label>Lender Name *</label>
                                <input type="text" v-model="loan.provider" placeholder="Enter lender name" @input="update" />
                            </div>
                            
                            <div class="form-row">
                                <div class="form-field">
                                    <label>Outstanding Balance (£) *</label>
                                    <input type="number" v-model="loan.outstanding_balance" min="0" placeholder="5000" @input="update" />
                                </div>
                                <div class="form-field">
                                    <label>Monthly Payment (£) *</label>
                                    <input type="number" v-model="loan.monthly_payment" min="0" placeholder="250" @input="update" />
                                </div>
                            </div>
                            
                            <div class="form-field">
                                <label>When does this end?</label>
                                <input type="date" v-model="loan.end_date" @input="update" />
                                <span class="helper-text">Leave blank if ongoing (e.g. credit card)</span>
                            </div>
                            
                            <div class="form-field">
                                <label class="checkbox-label">
                                    <input type="checkbox" v-model="loan.will_be_settled" @change="update" />
                                    This loan will be settled before mortgage application
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
                            <input type="radio" :name="'has_cards_' + applicantNumber" value="yes" v-model="applicant.has_credit_cards" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'has_cards_' + applicantNumber" value="no" v-model="applicant.has_credit_cards" @change="update" />
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
                                <input type="text" v-model="card.provider" placeholder="e.g. Barclaycard, Amex" @input="update" />
                            </div>
                            
                            <div class="form-row">
                                <div class="form-field">
                                    <label>Credit Limit (£) *</label>
                                    <input type="number" v-model="card.credit_limit" min="0" placeholder="5000" @input="update" />
                                </div>
                                <div class="form-field">
                                    <label>Current Balance (£) *</label>
                                    <input type="number" v-model="card.current_balance" min="0" placeholder="1500" @input="update" />
                                </div>
                            </div>
                            
                            <div class="form-field">
                                <label>Typical Monthly Payment (£) *</label>
                                <input type="number" v-model="card.monthly_payment" min="0" placeholder="100" @input="update" />
                                <span class="helper-text">What you usually pay each month</span>
                            </div>
                            
                            <div class="form-field">
                                <label class="checkbox-label">
                                    <input type="checkbox" v-model="card.will_be_settled" @change="update" />
                                    This balance will be settled before mortgage application
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
                <div class="form-field">
                    <label>Deposit Amount (£) *</label>
                    <input 
                        type="number" 
                        v-model="applicant.deposit_amount" 
                        min="0" 
                        placeholder="50000" 
                        @input="update" 
                    />
                    <span class="helper-text">Enter 0 if you don't have a deposit yet</span>
                </div>
                
                <div v-if="applicant.deposit_amount > 0" class="form-field">
                    <label>Source of Deposit *</label>
                    <select v-model="applicant.deposit_source" @change="update">
                        <option value="">Select...</option>
                        <option value="personal-savings">Personal Savings</option>
                        <option value="gifted-family">Gifted Deposit – Family</option>
                        <option value="gifted-non-family">Gifted Deposit – Non-Family</option>
                        <option value="inheritance">Inheritance</option>
                        <option value="property-sale">Sale of Existing Property</option>
                        <option value="asset-sale">Sale of Other Assets</option>
                        <option value="equity-release">Equity from Remortgage</option>
                        <option value="help-to-buy">Help to Buy / Shared Ownership</option>
                        <option value="company-bonus">Company Bonus / Share Options</option>
                        <option value="savings-abroad">Savings from Abroad</option>
                        <option value="loan-family">Loan from Family/Friends</option>
                        <option value="loan-institution">Loan from Financial Institution</option>
                        <option value="combination">Combination of Sources</option>
                    </select>
                </div>
                
                <div class="radio-group radio-group-inline">
                    <label>Do you have any credit history issues? *</label>
                    <div class="radio-row">
                        <label class="radio-option-inline">
                            <input type="radio" :name="'credit_issues_' + applicantNumber" value="yes" v-model="applicant.credit_history_issues" @change="update" />
                            <span>Yes</span>
                        </label>
                        <label class="radio-option-inline">
                            <input type="radio" :name="'credit_issues_' + applicantNumber" value="no" v-model="applicant.credit_history_issues" @change="update" />
                            <span>No</span>
                        </label>
                    </div>
                    <span class="helper-text">CCJs, defaults, bankruptcy, missed payments, etc.</span>
                </div>
            </div>
        </div>
    `,
    computed: {
        isEmployed() {
            return ['employed-ft', 'employed-pt', 'employed-ftc'].includes(this.applicant.employment_type);
        },
        isContract() {
            return this.applicant.employment_type === 'contract';
        },
        isSelfEmployed() {
            return ['sole-trader', 'partnership', 'limited-director'].includes(this.applicant.employment_type);
        },
        isLimitedDirector() {
            return this.applicant.employment_type === 'limited-director';
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
                type: '',
                provider: '',
                outstanding_balance: '',
                monthly_payment: '',
                end_date: '',
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
                credit_limit: '',
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

// ============================================================================
// DOCUMENT UPLOAD COMPONENT
// Handles conditional document requirements based on employment type
// ============================================================================

const DocumentUploads = {
    props: {
        applicant: {
            type: Object,
            required: true
        },
        applicantNumber: {
            type: Number,
            required: true
        }
    },
    emits: ['update'],
    data() {
        return {
            // Track which files have been uploaded
            uploadedFiles: {
                // Universal documents (ALL applicants)
                proof_of_identity: null,
                proof_of_address: null,
                bank_statement_1: null,
                bank_statement_2: null,
                bank_statement_3: null,
                proof_of_deposit: null,
                
                // Conditional documents
                payslip_1: null,
                payslip_2: null,
                payslip_3: null,
                sa302_current_year: null,
                sa302_previous_year: null
            },
            
            // Track upload progress
            uploadProgress: {},
            
            // Track if user answered the follow-up question
            hasAdditionalSelfEmployedIncome: null
        };
    },
    
    computed: {
        // Check if employment type requires payslips
        requiresPayslips() {
            const type = this.applicant.employment_type;
            return ['employed-ft', 'employed-pt', 'employed-ftc', 'limited-director', 'contract'].includes(type);
        },
        
        // Check if employment type ALWAYS requires SA302s
        requiresSA302Mandatory() {
            const type = this.applicant.employment_type;
            return ['sole-trader', 'partnership', 'limited-director', 'retired', 'high-net-worth'].includes(type);
        },
        
        // Check if we should show the "additional self-employed income" question
        showAdditionalIncomeQuestion() {
            const type = this.applicant.employment_type;
            return ['employed-ft', 'employed-pt', 'employed-ftc', 'contract'].includes(type);
        },
        
        // Check if SA302s are required based on employment + user answer
        requiresSA302() {
            // Always required for these types
            if (this.requiresSA302Mandatory) {
                return true;
            }
            
            // Conditionally required if user said "yes" to additional income
            if (this.showAdditionalIncomeQuestion && this.hasAdditionalSelfEmployedIncome === 'yes') {
                return true;
            }
            
            return false;
        },
        
        // For retired, only previous year SA302 is needed
        isRetired() {
            return this.applicant.employment_type === 'retired';
        },
        
        // Validation: check all required documents are uploaded
        allRequiredDocumentsUploaded() {
            // Universal documents
            const universalDocs = [
                'proof_of_identity',
                'proof_of_address',
                'bank_statement_1',
                'bank_statement_2',
                'bank_statement_3',
                'proof_of_deposit'
            ];
            
            for (let doc of universalDocs) {
                if (!this.uploadedFiles[doc]) return false;
            }
            
            // Payslips (if required)
            if (this.requiresPayslips) {
                if (!this.uploadedFiles.payslip1 || !this.uploadedFiles.payslip2 || !this.uploadedFiles.payslip3) {
                    return false;
                }
            }
            
            // SA302s (if required)
            if (this.requiresSA302()) {
                if (this.isRetired) {
                    // Retired only needs previous year
                    if (!this.uploadedFiles.sa302_previous_year) return false;
                } else {
                    // Everyone else needs both years
                    if (!this.uploadedFiles.sa302_current_year || !this.uploadedFiles.sa302_previous_year) {
                        return false;
                    }
                }
            }
            
            return true;
        }
    },
    
    methods: {
        handleFileUpload(event, documentType) {
            const file = event.target.files[0];
            
            if (!file) return;
            
            // Validate file type (PDF, JPG, PNG)
            const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please upload PDF, JPG, or PNG files only');
                event.target.value = ''; // Clear the input
                return;
            }
            
            // Validate file size (max 10MB)
            const maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (file.size > maxSize) {
                alert('File size must be less than 10MB');
                event.target.value = '';
                return;
            }
            
            // Store the file
            this.uploadedFiles[documentType] = file;
            
            // Emit update to parent
            this.$emit('update', {
                documents: this.uploadedFiles,
                hasAdditionalSelfEmployedIncome: this.hasAdditionalSelfEmployedIncome
            });
        },
        
        removeFile(documentType) {
            this.uploadedFiles[documentType] = null;
            
            // Clear the file input
            const input = this.$refs[documentType];
            if (input) {
                input.value = '';
            }
            
            // Emit update
            this.$emit('update', {
                documents: this.uploadedFiles,
                hasAdditionalSelfEmployedIncome: this.hasAdditionalSelfEmployedIncome
            });
        },
        
        updateAdditionalIncomeAnswer(value) {
            this.hasAdditionalSelfEmployedIncome = value;
            
            // If user says "no", clear any SA302s they might have uploaded
            if (value === 'no') {
                this.uploadedFiles.sa302_current_year = null;
                this.uploadedFiles.sa302_previous_year = null;
            }
            
            // Emit update
            this.$emit('update', {
                documents: this.uploadedFiles,
                hasAdditionalSelfEmployedIncome: this.hasAdditionalSelfEmployedIncome
            });
        },
        
        getFileName(file) {
            if (!file) return '';
            return file.name;
        },
        
        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }
    },
    
    template: `
        <div class="form-section-card">
            <div class="section-header">
                <h2 class="section-title">{{ applicantNumber === 1 ? 'Your' : 'Second Applicant' }} Documents</h2>
                <span class="applicant-label">Applicant {{ applicantNumber }}</span>
            </div>
            
            <div class="document-upload-section">
                <!-- UNIVERSAL DOCUMENTS (ALL APPLICANTS) -->
                <div class="document-category">
                    <h3 class="category-title">Required Documents <span class="required-badge">Required for all applicants</span></h3>
                    
                    <!-- Proof of Identity -->
                    <div class="document-upload-field">
                        <label>Proof of Identity *</label>
                        <p class="helper-text">Passport or UK driving licence (both sides)</p>
                        <div class="file-upload-wrapper">
                            <input 
                                type="file" 
                                :ref="'proof_of_identity'"
                                @change="handleFileUpload($event, 'proof_of_identity')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'proof_of_identity_' + applicantNumber"
                            />
                            <label :for="'proof_of_identity_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.proof_of_identity">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.proof_of_identity) }} 
                                    ({{ formatFileSize(uploadedFiles.proof_of_identity.size) }})
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.proof_of_identity" 
                                @click.prevent="removeFile('proof_of_identity')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                    
                    <!-- Proof of Address -->
                    <div class="document-upload-field">
                        <label>Proof of Address *</label>
                        <p class="helper-text">Recent utility bill, council tax, or bank statement (dated within 3 months)</p>
                        <div class="file-upload-wrapper">
                            <input 
                                type="file" 
                                :ref="'proof_of_address'"
                                @change="handleFileUpload($event, 'proof_of_address')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'proof_of_address_' + applicantNumber"
                            />
                            <label :for="'proof_of_address_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.proof_of_address">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.proof_of_address) }} 
                                    ({{ formatFileSize(uploadedFiles.proof_of_address.size) }})
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.proof_of_address" 
                                @click.prevent="removeFile('proof_of_address')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                    
                    <!-- Bank Statements (3 months) -->
                    <div class="document-upload-field">
                        <label>Bank Statements (Last 3 Months) *</label>
                        <p class="helper-text">Upload 3 consecutive months of bank statements</p>
                        
                        <!-- Month 1 -->
                        <div class="file-upload-wrapper" style="margin-bottom: 10px;">
                            <span class="month-label">Month 1 (Most Recent)</span>
                            <input 
                                type="file" 
                                :ref="'bank_statement_1'"
                                @change="handleFileUpload($event, 'bank_statement_1')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'bank_statement_1_' + applicantNumber"
                            />
                            <label :for="'bank_statement_1_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.bank_statement_1">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.bank_statement_1) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.bank_statement_1" 
                                @click.prevent="removeFile('bank_statement_1')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                        
                        <!-- Month 2 -->
                        <div class="file-upload-wrapper" style="margin-bottom: 10px;">
                            <span class="month-label">Month 2</span>
                            <input 
                                type="file" 
                                :ref="'bank_statement_2'"
                                @change="handleFileUpload($event, 'bank_statement_2')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'bank_statement_2_' + applicantNumber"
                            />
                            <label :for="'bank_statement_2_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.bank_statement_2">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.bank_statement_2) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.bank_statement_2" 
                                @click.prevent="removeFile('bank_statement_2')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                        
                        <!-- Month 3 -->
                        <div class="file-upload-wrapper">
                            <span class="month-label">Month 3 (Oldest)</span>
                            <input 
                                type="file" 
                                :ref="'bank_statement_3'"
                                @change="handleFileUpload($event, 'bank_statement_3')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'bank_statement_3_' + applicantNumber"
                            />
                            <label :for="'bank_statement_3_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.bank_statement_3">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.bank_statement_3) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.bank_statement_3" 
                                @click.prevent="removeFile('bank_statement_3')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                    
                    <!-- Proof of Deposit -->
                    <div class="document-upload-field">
                        <label>Proof of Deposit *</label>
                        <p class="helper-text">Recent bank statement or savings account statement showing your deposit funds</p>
                        <div class="file-upload-wrapper">
                            <input 
                                type="file" 
                                :ref="'proof_of_deposit'"
                                @change="handleFileUpload($event, 'proof_of_deposit')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'proof_of_deposit_' + applicantNumber"
                            />
                            <label :for="'proof_of_deposit_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.proof_of_deposit">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.proof_of_deposit) }} 
                                    ({{ formatFileSize(uploadedFiles.proof_of_deposit.size) }})
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.proof_of_deposit" 
                                @click.prevent="removeFile('proof_of_deposit')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- CONDITIONAL DOCUMENTS -->
                <div class="document-category" v-if="requiresPayslips || requiresSA302 || showAdditionalIncomeQuestion">
                    <h3 class="category-title">Income Verification Documents</h3>
                    <p class="helper-text">Based on your employment type, the following documents are required:</p>
                    
                    <!-- PAYSLIPS (if required) -->
                    <div v-if="requiresPayslips" class="document-upload-field">
                        <label>Payslips (Last 3 Months) *</label>
                        <p class="helper-text">Upload your 3 most recent payslips</p>
                        
                        <!-- Payslip 1 -->
                        <div class="file-upload-wrapper" style="margin-bottom: 10px;">
                            <span class="month-label">Payslip 1 (Most Recent)</span>
                            <input 
                                type="file" 
                                :ref="'payslip1'"
                                @change="handleFileUpload($event, 'payslip1')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'payslip1_' + applicantNumber"
                            />
                            <label :for="'payslip1_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.payslip1">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.payslip1) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.payslip1" 
                                @click.prevent="removeFile('payslip1')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                        
                        <!-- Payslip 2 -->
                        <div class="file-upload-wrapper" style="margin-bottom: 10px;">
                            <span class="month-label">Payslip 2</span>
                            <input 
                                type="file" 
                                :ref="'payslip2'"
                                @change="handleFileUpload($event, 'payslip2')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'payslip2_' + applicantNumber"
                            />
                            <label :for="'payslip2_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.payslip2">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.payslip2) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.payslip2" 
                                @click.prevent="removeFile('payslip2')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                        
                        <!-- Payslip 3 -->
                        <div class="file-upload-wrapper">
                            <span class="month-label">Payslip 3 (Oldest)</span>
                            <input 
                                type="file" 
                                :ref="'payslip3'"
                                @change="handleFileUpload($event, 'payslip3')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'payslip3_' + applicantNumber"
                            />
                            <label :for="'payslip3_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.payslip3">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.payslip3) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.payslip3" 
                                @click.prevent="removeFile('payslip3')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                    
                    <!-- ADDITIONAL INCOME QUESTION (for employed/contractors) -->
                    <div v-if="showAdditionalIncomeQuestion" class="document-upload-field">
                        <label>Do you have any additional self-employed income? *</label>
                        <p class="helper-text">This includes rental income, freelance work, business income, or any other self-employed earnings</p>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input 
                                    type="radio" 
                                    name="additional_income"
                                    value="yes"
                                    :checked="hasAdditionalSelfEmployedIncome === 'yes'"
                                    @change="updateAdditionalIncomeAnswer('yes')"
                                />
                                <span>Yes - I have additional self-employed income</span>
                            </label>
                            <label class="radio-option">
                                <input 
                                    type="radio" 
                                    name="additional_income"
                                    value="no"
                                    :checked="hasAdditionalSelfEmployedIncome === 'no'"
                                    @change="updateAdditionalIncomeAnswer('no')"
                                />
                                <span>No - My only income is from employment</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- SA302 DOCUMENTS (if required) -->
                    <div v-if="requiresSA302" class="document-upload-field">
                        <label>SA302 Tax Calculations *</label>
                        <p class="helper-text" v-if="isRetired">Upload your most recent SA302 tax calculation</p>
                        <p class="helper-text" v-else>Upload SA302 tax calculations for the current and previous tax year</p>
                        
                        <!-- Current Year SA302 (not needed for retired) -->
                        <div v-if="!isRetired" class="file-upload-wrapper" style="margin-bottom: 10px;">
                            <span class="month-label">Current Tax Year SA302</span>
                            <input 
                                type="file" 
                                :ref="'sa302_current_year'"
                                @change="handleFileUpload($event, 'sa302_current_year')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'sa302_current_year_' + applicantNumber"
                            />
                            <label :for="'sa302_current_year_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.sa302_current_year">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.sa302_current_year) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.sa302_current_year" 
                                @click.prevent="removeFile('sa302_current_year')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                        
                        <!-- Previous Year SA302 -->
                        <div class="file-upload-wrapper">
                            <span class="month-label">Previous Tax Year SA302</span>
                            <input 
                                type="file" 
                                :ref="'sa302_previous_year'"
                                @change="handleFileUpload($event, 'sa302_previous_year')"
                                accept=".pdf,.jpg,.jpeg,.png"
                                :id="'sa302_previous_year_' + applicantNumber"
                            />
                            <label :for="'sa302_previous_year_' + applicantNumber" class="file-upload-label">
                                <span v-if="!uploadedFiles.sa302_previous_year">Choose file</span>
                                <span v-else class="file-uploaded">
                                    ✓ {{ getFileName(uploadedFiles.sa302_previous_year) }}
                                </span>
                            </label>
                            <button 
                                v-if="uploadedFiles.sa302_previous_year" 
                                @click.prevent="removeFile('sa302_previous_year')"
                                class="remove-file-btn"
                                type="button"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- VALIDATION WARNING -->
                <div v-if="applicant.employment_type && !allRequiredDocumentsUploaded" class="warning-box">
                    <p><strong>⚠️ Document Upload Incomplete</strong></p>
                    <p>Please upload all required documents before proceeding to the next step.</p>
                </div>
                
                <!-- SUCCESS MESSAGE -->
                <div v-if="applicant.employment_type && allRequiredDocumentsUploaded" class="success-box">
                    <p><strong>✓ All Required Documents Uploaded</strong></p>
                    <p>You can now proceed to the next step.</p>
                </div>
            </div>
        </div>
    `
};