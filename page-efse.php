<?php
/**
 * Template Name: EFSE
 * 
 * @package UnitedMortgages
 */
/*V1.1*/
get_header(); ?>

<main id="primary" class="site-main">
    <section class="hero-section efse-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content-split">
                <!-- Left side - Text content -->
                <div class="hero-text-content">
                    <h1 class="hero-title">Entrepreneurs, Founders & Self Employed</h1>
                    <p class="hero-description">
                        Supporting your next financial move, whether you're:
                        <ul class="checklist">
                            <li>Self employed</li>
                            <li>Start-up founders</li>
                            <li> Freelancers</li>
                        </ul>
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