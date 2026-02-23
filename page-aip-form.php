<?php
/**
 * Template Name: AIP Form
 * Description: Agreement in Principle application form
 */

get_header(); ?>

<main class="aip-form-page">
    <div class="aip-form-container">
        
        <div class="aip-form-header">
            <h1>Your <strong>Agreement in Principle</strong></h1>
            
            <!-- Progress Indicator -->
            <div class="progress-indicator" v-if="currentStep <= 3">
                <div class="progress-steps">
                    <div class="progress-step" :class="{ active: currentStep === 1, completed: currentStep > 1 }">
                        <div class="step-number">1</div>
                        <div class="step-label">Getting Started</div>
                    </div>
                    <div class="progress-line" :class="{ active: currentStep > 1 }"></div>
                    <div class="progress-step" :class="{ active: currentStep === 2, completed: currentStep > 2 }">
                        <div class="step-number">2</div>
                        <div class="step-label">Your Details</div>
                    </div>
                    <div class="progress-line" :class="{ active: currentStep > 2 }"></div>
                    <div class="progress-step" :class="{ active: currentStep === 3, completed: currentStep > 3 }">
                        <div class="step-number">3</div>
                        <div class="step-label">Review & Submit</div>
                    </div>
                </div>
            </div>
        </div>



        
        <div id="aip-app">
            <!-- VALIDATION ERROR BOX - Shows only when user tries to submit with errors -->
            <div v-if="validationErrors.length > 0 && currentStep === validationErrors[0].step" class="validation-error-box">
                <div class="error-header">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="9" stroke="#dc2626" stroke-width="2"/>
                        <path d="M10 6V11" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="10" cy="14" r="1" fill="#dc2626"/>
                    </svg>
                    <h3>Please complete the following required fields:</h3>
                </div>
                <ul class="error-list">
                    <li v-for="error in validationErrors.filter(e => e.step === currentStep)" :key="error.field">
                        {{ error.message }}
                    </li>
                </ul>
            </div>
            <!-- STEP 1: Application Type -->
            <div v-if="currentStep === 1" class="step-content">
                <div class="form-section-card">
                    <h2 class="section-title">I am</h2>
                    <div class="radio-group">
                        <label class="radio-option" :class="{ 'selected': formData.applicant_type === 'Single applicant' }">
                            <input type="radio" name="applicant_type" value="Single applicant" v-model="formData.applicant_type" />
                            <span class="radio-label">Buying on my own</span>
                        </label>
                        <label class="radio-option" :class="{ 'selected': formData.applicant_type === 'Joint applicant' }">
                            <input type="radio" name="applicant_type" value="Joint applicant" v-model="formData.applicant_type" />
                            <span class="radio-label">Buying with someone else</span>
                        </label>
                    </div>
                </div>
                
                <div class="form-section-card">
                    <h2 class="section-title">My situation</h2>
                    <div class="radio-group radio-group-multi">
                        <label class="radio-option" :class="{ 'selected': formData.applicant_situation === 'First-time-buyer' }">
                            <input type="radio" name="applicant_situation" value="First-time-buyer" v-model="formData.applicant_situation" />
                            <span class="radio-label">First-time Buyer</span>
                        </label>
                        <label class="radio-option" :class="{ 'selected': formData.applicant_situation === 'Remortgage' }">
                            <input type="radio" name="applicant_situation" value="Remortgage" v-model="formData.applicant_situation" />
                            <span class="radio-label">Remortgage</span>
                        </label>
                        <label class="radio-option" :class="{ 'selected': formData.applicant_situation === 'Shared ownership/help to buy' }">
                            <input type="radio" name="applicant_situation" value="Shared ownership/help to buy" v-model="formData.applicant_situation" />
                            <span class="radio-label">Shared ownership/Help to Buy</span>
                        </label>
                        <label class="radio-option" :class="{ 'selected': formData.applicant_situation === 'buy to Let' }">
                            <input type="radio" name="applicant_situation" value="Buy to Let" v-model="formData.applicant_situation" />
                            <span class="radio-label">Buy to Let</span>
                        </label>
                        <label class="radio-option" :class="{ 'selected': formData.applicant_situation === 'Guarantor' }">
                            <input type="radio" name="applicant_situation" value="Guarantor" v-model="formData.applicant_situation" />
                            <span class="radio-label">Guarantor</span>
                        </label>
                        <label class="radio-option" :class="{ 'selected': formData.applicant_situation === 'Commercial' }">
                            <input type="radio" name="applicant_situation" value="Commercial" v-model="formData.applicant_situation" />
                            <span class="radio-label">Commercial</span>
                        </label>
                    </div>
                </div>
            </div>


            
            
<!-- STEP 2: Financial Details -->
<div v-if="currentStep === 2" class="step-content">
    <!-- Existing Applicant 1 Details -->
    <applicant-details 
        :applicant="formData.applicant1"
        applicant-number="1"
        @update="updateApplicant1">
    </applicant-details>
    
    <!-- Existing Applicant 1 Financial Details -->
    <financial-details 
        :applicant="formData.applicant1"
        applicant-number="1"
        @update="updateApplicant1">
    </financial-details>
    
    <!-- NEW: Applicant 1 Document Uploads -->
    <document-uploads
        :applicant="formData.applicant1"
        :applicant-number="1"
        @update="updateApplicant1Documents">
    </document-uploads> 
    
    <!-- Applicant 2 (if joint) -->
    <template v-if="formData.applicant_type === 'Joint applicant'">
        <applicant-details 
            :applicant="formData.applicant2"
            applicant-number="2"
            @update="updateApplicant2">
        </applicant-details>
        
        <financial-details 
            :applicant="formData.applicant2"
            applicant-number="2"
            @update="updateApplicant2">
        </financial-details>
        
        <!-- NEW: Applicant 2 Document Uploads -->
        <document-uploads
            :applicant="formData.applicant2"
            :applicant-number="2"
            @update="updateApplicant2Documents">
        </document-uploads>

    </template>
</div>

<!-- STEP 3: Review & Submit -->
<div v-if="currentStep === 3" class="step-content">
    <div class="form-section-card">
        <h2 class="section-title">Review Your Application</h2>
        
        <div class="review-section">
            <h3 class="review-subtitle">Application Details</h3>
            <p class="review-item"><strong>Type:</strong> {{ formData.applicant_type }}</p>
            <p class="review-item"><strong>Situation:</strong> {{ formData.applicant_situation }}</p>
        </div>
        
        <!-- Applicant 1 -->
        <div class="review-section">
            <h3 class="review-subtitle">Primary Applicant</h3>
            <p class="review-item"><strong>Name:</strong> {{ formData.applicant1.first_name }} {{ formData.applicant1.last_name }}</p>
            <p class="review-item"><strong>Email:</strong> {{ formData.applicant1.email }}</p>
            <p class="review-item"><strong>Phone:</strong> {{ formData.applicant1.phone }}</p>
            <p class="review-item"><strong>Address:</strong> {{ formData.applicant1.current_address_street }}, {{ formData.applicant1.current_address_town }}, {{ formData.applicant1.address_postcode }}</p>
            <p class="review-item"><strong>Employment:</strong> {{ formData.applicant1.employment_type.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase()) }}</p>
            <p class="review-item" v-if="formData.applicant1.total_annual_salary">
                <strong>Annual Salary:</strong> £{{ Number(formData.applicant1.total_annual_salary).toLocaleString() }}
            </p>
            <p class="review-item"><strong>Deposit:</strong> £{{ Number(formData.applicant1.deposit_amount).toLocaleString() }}</p>
            <p class="review-item" v-if="formData.applicant1.has_credit_cards === 'yes'">
                <strong>Credit Cards:</strong> {{ formData.applicant1.credit_cards.length }} card(s)
            </p>
            <p class="review-item" v-if="formData.applicant1.has_outstanding_loans === 'yes'">
                <strong>Outstanding Loans:</strong> {{ formData.applicant1.loans.length }} loan(s)
            </p>
        </div>
        
        <!-- Applicant 2 (if joint) -->
        <div v-if="formData.applicant_type === 'Joint applicant'" class="review-section">
            <h3 class="review-subtitle">Second Applicant</h3>
            <p class="review-item"><strong>Name:</strong> {{ formData.applicant2.first_name }} {{ formData.applicant2.last_name }}</p>
            <p class="review-item"><strong>Email:</strong> {{ formData.applicant2.email }}</p>
            <p class="review-item"><strong>Phone:</strong> {{ formData.applicant2.phone }}</p>
            <p class="review-item"><strong>Address:</strong> {{ formData.applicant2.current_address_street }}, {{ formData.applicant2.current_address_town }}, {{ formData.applicant2.address_postcode }}</p>
            <p class="review-item"><strong>Employment:</strong> {{ formData.applicant2.employment_type.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase()) }}</p>
            <p class="review-item" v-if="formData.applicant2.total_annual_salary">
                <strong>Annual Salary:</strong> £{{ Number(formData.applicant2.total_annual_salary).toLocaleString() }}
            </p>
            <p class="review-item"><strong>Deposit:</strong> £{{ Number(formData.applicant2.deposit_amount).toLocaleString() }}</p>
            <p class="review-item" v-if="formData.applicant2.has_credit_cards === 'yes'">
                <strong>Credit Cards:</strong> {{ formData.applicant2.credit_cards.length }} card(s)
            </p>
            <p class="review-item" v-if="formData.applicant2.has_outstanding_loans === 'yes'">
                <strong>Outstanding Loans:</strong> {{ formData.applicant2.loans.length }} loan(s)
            </p>
        </div>
    </div>
    
    <!-- Privacy Policy & Terms -->
        <div class="form-section-card">
            <h2 class="section-title">Terms & Conditions</h2>
            <div class="form-fields">
                <label class="checkbox-label">
                    <input 
                        type="checkbox" 
                        v-model="formData.privacy_accepted" 
                        required 
                    />
                    <span>
                        I have read and agree to the 
                        <a href="<?php echo home_url('/privacy-policy'); ?>" 
                        target="_blank" 
                        class="privacy-link">
                            Privacy Policy
                        </a> and 						
                        <a href="<?php echo home_url('/fee-structure'); ?>" 
                        target="_blank" 
                        class="privacy-link">
                            Fee Structure
                        </a> *
                    </span>
                </label>
            </div>
        </div>
    </div>


            
            <!-- STEP 4: Success View -->
            <div v-if="currentStep === 4" class="success-view">
                <div class="success-card">
                    <div class="success-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/aip-success.png" alt="Success">
                    </div>
                    <h2 class="success-title">What <strong>Happens Next?</strong></h2>
                    <p class="success-message">
                        Congratulations, you're one step closer to your next home! A member of the United Mortgages&reg; will be in touch within 24 hours
                    </p>
                    <p class="success-submessage">
                        Should you have any questions in the meantime, please don't hesitate to reach out
                    </p>
                    <div class="contact-options">
                        <a href="tel:02084464488" class="contact-link">
                            <span class="contact-icon">📞</span>
                            0208 446 4488
                        </a>
                        <a href="mailto:hello@united-mortgages.com" class="contact-link">
                            <span class="contact-icon">✉️</span>
                            hello@united-mortgages.com
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="form-navigation" v-if="currentStep <= 3">
                <button @click="previousStep" class="btn-back" v-if="currentStep > 1">
                    Back
                </button>
                <button @click="nextStep" class="btn-continue" v-if="currentStep < 3">
                    Continue
                </button>
                <button 
                    @click="submitForm" 
                    class="btn-submit" 
                    v-if="currentStep === 3" 
                    :disabled="isSubmitting || !isSubmitEnabled"
                    :class="{ 'btn-disabled': !isSubmitEnabled }">
                    {{ isSubmitting ? 'Submitting...' : 'Submit Application' }}
                </button>
            </div>
            
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/aip-form-components-v2.js?v=3.2.2"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/aip-form-app-v2.js?v=3.2.2"></script>

<?php get_footer(); ?>