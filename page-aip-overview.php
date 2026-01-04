<?php
/**
 * Template Name: AIP Overview
 * 
 * @package UnitedMortgages
 */

get_header(); ?>

<!-- Hero Section -->
<section class="aip-overview-hero">
    <div class="aip-hero-overlay"></div>
    
    <div class="aip-hero-content">
        <h1 class="aip-hero-title">Secure Your <strong>Agreement in Principle</strong></h1>
        
        <p class="aip-hero-description">
            Your Agreement in Principle (AIP) gives you a <strong>stress</strong> <strong>how much you may be able to borrow</strong> before you 
            apply for a mortgage, and will enable you to make an offer on your dream home.
        </p>
        
        <p class="aip-hero-description">
            Once you've got your AIP, you can make a full application with United Mortgages&trade; when you're ready.
        </p>
        
        <p class="aip-hero-time">
            It only takes <strong>5 minutes</strong> to begin your journey - quicker than brewing a cuppa!
        </p>
        
        <a href="<?php echo home_url('/aip-form'); ?>" class="btn-secondary">Start now</a>
    </div>
</section>

<!-- Why You Need AIP Section -->
<section class="why-aip-section">
    <div class="container">
        <h2 class="why-aip-title">Why You Need An <strong>Agreement in Principle</strong></h2>
        
        <div class="aip-benefits-grid">
            <!-- Benefit 1 -->
            <div class="aip-benefit-card">
                <div class="benefit-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/scale.png" alt="Borrowing ability icon">
                </div>
                <h3>Gives you an idea of your borrowing ability</h3>
                <p>Whilst not the same as a mortgage offer, it's helpful in setting your purchase budget</p>
            </div>
            
            <!-- Benefit 2 -->
            <div class="aip-benefit-card">
                <div class="benefit-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/thumb.png" alt="Serious buyer icon">
                </div>
                <h3>Shows sellers and agents you're serious</h3>
                <p>Often you won't be able to place an offer on your dream home without an AIP</p>
            </div>
            
            <!-- Benefit 3 -->
            <div class="aip-benefit-card">
                <div class="benefit-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/speed.png" alt="Ready for application icon">
                </div>
                <h3>Gets you ready for the full application</h3>
                <p>It gives our team a head start when it's time to complete the full application</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>