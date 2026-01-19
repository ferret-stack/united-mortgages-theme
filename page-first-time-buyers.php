<?php
/**
 * Template Name: First Time Buyers
 * 
 * @package UnitedMortgages
 */
/*V1.1*/
get_header(); ?>

<main id="primary" class="site-main">
    <!-- First Time Buyers Hero Section -->
    <section class="hero-section first-time-buyers-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content-split">
                <!-- Left side - Text content -->
                <div class="hero-text-content">
                    <h1 class="hero-title mortgage">First Time Buyers</h1>
                    <p class="hero-description mortgage">
                        Taking your first step onto the property ladder is a big move, but you don't have to do it alone. With our expert guidance, smart digital tools, and a wide range of first-time buyer mortgages, we're here to help you make that move into your new home.
                    </p>
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