<?php
/**
 * Template Name: Buy-to-Let
 * 
 * @package UnitedMortgages
 */
/*V1.1*/
get_header(); ?>

<main id="primary" class="site-main">
    <!-- First Time Buyers Hero Section -->
    <section class="hero-section other-mortgages-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content-split">
                <!-- Left side - Text content -->
                <div class="hero-text-content">
                    <h1 class="hero-title mortgage">Buy-to-Let Investors</h1>
                    <p class="hero-description mortgage">
                        Building a property portfolio requires lenders who understand rental yields, stress tests, and portfolio strategies. We work with specialist BTL lenders who see investment properties as business assets, not consumer purchases.
                </div>
                
                <!-- Right side - Contact Form -->
                <div class="hero-form-wrapper mortgage">
                    <div class="contact-form hero-contact-form">
                        <!-- HubSpot Form Embed -->
                        <script src="https://js-eu1.hsforms.net/forms/embed/146069825.js" defer></script>
                        <div class="hs-form-frame" data-region="eu1" data-form-id="056e70dd-777c-46b3-8804-c2345bae99f9" data-portal-id="146069825"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_template_part('template-parts/team-contact'); ?>

<?php
get_footer();