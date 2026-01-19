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
                        <div class="step-label">Application Type</div>
                    </div>
                    <div class="progress-line" :class="{ active: currentStep > 1 }"></div>
                    <div class="progress-step" :class="{ active: currentStep === 2, completed: currentStep > 2 }">
                        <div class="step-number">2</div>
                        <div class="step-label">Details</div>
                    </div>
                    <div class="progress-line" :class="{ active: currentStep > 2 }"></div>
                    <div class="progress-step" :class="{ active: currentStep === 3, completed: currentStep > 3 }">
                        <div class="step-number">3</div>
                        <div class="step-label">Financial</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div id="aip-app">
            
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
            
            <!-- STEP 2: Applicant Details -->
            <div v-if="currentStep === 2" class="step-content">
                <!-- Applicant 1 Details -->
                <applicant-details 
                    :applicant="formData.applicant1" 
                    applicant-number="1"
                    @update="updateApplicant1">
                </applicant-details>
                
                <!-- Applicant 2 Details (conditional) -->
                <applicant-details 
                    v-if="formData.applicant_type === 'joint'"
                    :applicant="formData.applicant2" 
                    applicant-number="2"
                    @update="updateApplicant2">
                </applicant-details>
            </div>
            
            <!-- STEP 3: Financial Details -->
            <div v-if="currentStep === 3" class="step-content">
                <financial-details 
                    :applicant="formData.applicant1"
                    applicant-number="1"
                    @update="updateApplicant1">
                </financial-details>
                
                <financial-details 
                    v-if="formData.applicant_type === 'joint'"
                    :applicant="formData.applicant2"
                    applicant-number="2"
                    @update="updateApplicant2">
                </financial-details>
				<div v-if="currentStep === 3" class="form-section-card">
					
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
                        Congratulations, you're one step closer to your next home! A member of the United Mortgages™ will be in touch within 24 hours
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
                <button @click="submitForm" class="btn-submit" v-if="currentStep === 3" :disabled="isSubmitting || !formData.privacy_accepted">
                    {{ isSubmitting ? 'Submitting...' : 'Submit Application' }}
                </button>
            </div>
            
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/aip-form-components.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/aip-form-app.js"></script>

<?php get_footer(); ?>