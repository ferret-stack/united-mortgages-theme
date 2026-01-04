<?php
/**
 * Template Name: Remortgaging
 * 
 * @package UnitedMortgages
 */
/*V1.1*/
get_header(); ?>

<main id="primary" class="site-main">
    <!-- First Time Buyers Hero Section -->
    <section class="hero-section remortgaging-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content-split">
                <!-- Left side - Text content -->
                <div class="hero-text-content">
                    <h1 class="hero-title">First Time Buyers</h1>
                    <p class="hero-description">
                       Whether you're looking to save on monthly payments, release equity, or switch deals, we'll find your optimal remortgage option suited to your needs.
                    </p>
                </div>
                
                <!-- Right side - Contact Form -->
                <div class="hero-form-wrapper">
                    <div class="contact-form hero-contact-form">
                        <!-- HubSpot Form Embed -->
                        <script src="https://js-eu1.hsforms.net/forms/embed/146069825.js" defer></script>
                        <div class="hs-form-frame" data-region="eu1" data-form-id="056e70dd-777c-46b3-8804-c2345bae99f9" data-portal-id="146069825"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_template_part('template-parts/process'); ?>
<?php get_template_part('template-parts/UM-way'); ?>
<?php get_template_part('template-parts/team-contact'); ?>

<?php
get_footer();