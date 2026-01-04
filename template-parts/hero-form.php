<?php
/**
 * Template Part: Hero with Form
 * 
 * Usage: get_template_part('template-parts/hero-form', null, array(
 *     'hero_class' => 'first-time-buyers-hero',
 *     'title' => 'First Time Buyers',
 *     'description' => 'Your description here...'
 * ));
 * 
 * @package UnitedMortgages
 */

// Get passed arguments with defaults
$hero_class = isset($args['hero_class']) ? $args['hero_class'] : '';
$title = isset($args['title']) ? $args['title'] : 'Default Title';
$description = isset($args['description']) ? $args['description'] : 'Default description text.';
?>

<section class="hero-section hero-with-form <?php echo esc_attr($hero_class); ?>">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content-split">
            <!-- Left side - Text content -->
            <div class="hero-text-content">
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
                <p class="hero-description"><?php echo esc_html($description); ?></p>
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