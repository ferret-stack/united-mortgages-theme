<?php
/**
 * Template Name: AIP Overview
 * 
 * @package UnitedMortgages
 */

get_header(); ?>

<!-- Hero Section with Benefits -->
<section class="aip-overview-hero">
    <div class="aip-hero-overlay"></div>
    
    <div class="aip-hero-content">
        <!-- Time Badge -->

        
        <h1 class="aip-hero-title">Secure Your <strong>Agreement in Principle</strong></h1>
        
        <p class="aip-hero-description">
            Know how much you can borrow before you fall in love with a property. It gives you 
            clarity on your budget and shows sellers you're serious.
        </p>

                <div class="time-badge">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
                <path d="M8 4V8L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            Takes less than 10 minutes
        </div>
        
        <!-- Benefits Grid -->
        <div class="aip-benefits-inline">
            <!-- Benefit 1 -->
            <div class="aip-benefit-inline">
                <div class="benefit-icon-inline">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/scale.png" alt="Know your budget">
                </div>
                <h3>Know your budget</h3>
                <p>Get a clear idea of your borrowing ability before you start looking</p>
            </div>
            
            <!-- Benefit 2 -->
            <div class="aip-benefit-inline">
                <div class="benefit-icon-inline">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/thumb.png" alt="Show you're serious">
                </div>
                <h3>Show you're serious</h3>
                <p>Estate agents and sellers take you seriously with an AIP in hand</p>
            </div>
            
            <!-- Benefit 3 -->
            <div class="aip-benefit-inline">
                <div class="benefit-icon-inline">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/speed.png" alt="Speeds things up">
                </div>
                <h3>Speeds things up</h3>
                <p>Our team gets a head start when you find your dream home</p>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="aip-cta-section">
            <!-- Credit Score Badge -->
            <div class="credit-score-badge">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="10" r="9" stroke="#4CAF50" stroke-width="2"/>
                    <path d="M6 10L9 13L14 7" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                No impact on your credit score
            </div>
            
            <!-- Start Now Button -->
            <a href="<?php echo home_url('/aip-form'); ?>" class="btn-aip-start">Start now</a>
            
            <!-- Terms Text -->
            <p class="terms-text">
                By continuing, you agree to our <a href="<?php echo home_url('/privacy-policy'); ?>">terms and conditions</a>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>