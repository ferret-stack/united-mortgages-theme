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