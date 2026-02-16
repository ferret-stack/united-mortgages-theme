<?php
/**
 * The main template file
 *
 * @package UnitedMortgages
 */
/*V3.0*/
get_header(); ?>

<main id="primary" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
            <!-- Review Widgets Container -->
                <div class="review-widgets-container">
                    <!-- Trustpilot Widget -->
                    <div class="trustpilot-widget">
                        <a href="https://uk.trustpilot.com/review/united-mortgages.com" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/trustpilot.png" 
                                alt="Trustpilot Rating" 
                                class="trustpilot-image">
                        </a>
                    </div>

                    <!-- Bark Widget -->
                    <div class="bark-widget">
                        <a href="https://www.bark.com/en/gb/company/united-mortgages/wJpeGP/" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/barklogo.png" 
                                alt="Bark Reviews" 
                                class="bark-image">
                        </a>
                    </div>
                </div>

                <h1 class="hero-title">Expert Mortgage Advice Available Nationaide <strong>365 Days a Year</strong></h1>
                <p class="hero-subtitle">
                    Specialists in first-time buyers, movers, and remortgaging with access to 100+ lenders.<br>
                    Trusted by homebuyers from London to Manchester and everywhere in between.<br>
                    <strong>No jargon. No fax machines. No taking a day off work to sign forms... Because it's not 1997 anymore.</strong>
                </p>
            </div>
            <div class="button-group">
                <a href="#contact-form" class="btn-callback btn-transparent">Request a call back</a>
                <a href="<?php echo home_url('/aip-overview'); ?>" class="btn-callback btn-primary">Start now</a>
            </div>
        </div>
    </section>

    <!-- Our Mortgages Section -->
    <section class="hero-section our-mortgages-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Our Mortgages</h1>
            <p class="hero-subtitle">Find and apply for the right mortgage with our expert support. Whether you're buying your first home or planning your next move, it all starts here.</p>
        </div>

        <!-- Mortgage Types Grid -->
        <div class="container">
            <?php get_template_part('template-parts/mortgage-type-grid'); ?>
        </div>
    </section>

    <!-- Run the Numbers - Calculator Section -->
    <!-- Desktop: Embedded borrow calculator | Mobile: CTA card linking to /calculators#borrow -->
    <?php get_template_part('template-parts/calculator-borrow-embed'); ?>

    <!-- Speak to Our Team Section -->
    <?php get_template_part('template-parts/team-contact'); ?>

    <!-- Partners Section -->
    <section class="partnership-section">
        <div class="container" style="margin-bottom: 50px;">
            <h1 style="color: white; font-size: 3.5rem; transform:translateY(3rem); margin-bottom:50px;">Our Partners</h1>
            <div class="spacer"></div>
            <div class="partnership-grid">
                <?php
                    $directory = get_template_directory() . '/assets/partners/';
                    $url = get_template_directory_uri() . '/assets/partners/';
                    $files = scandir($directory);
                                    
                    $partner_links = [
                        '1charterwells.svg' => 'https://www.charterwells.co.uk/',
                        'xfortress.svg' => 'https://2eys75.share-eu1.hsforms.com/2TSSmWsJnRJCGLQHLexp-mw',
                        '4key-conveyencing.svg' => 'https://www.keyconveyancing.co.uk/',
                        '2thomas-legal.svg' => 'https://thomaslegal.co.uk/',
                        '5david-charles.svg' => 'https://david-charles.co.uk/',
                        '3drifthome.svg' => 'https://drifthome.ai/',
                        '6mn-eXp.svg' => 'https://marknewton.exp.uk.com/',
                        '5fiberpay.svg' => 'https://fiberpay.com/',
                        '7pb-exp.png' => 'https://paulberg.exp.uk.com/',
                        '8novello.svg' => 'https://novellosurveyors.co.uk/',
                        'xplap.png' => 'https://www.propertylikeapro.co.uk/',
                        '9mortgage-direct.svg' => 'https://mortgagedirectsl.com/initial-enquiry/',
                    ];
                    
                    foreach($files as $file) {
                        // Check for hidden files and only image files
                        if($file !== "." && $file !== ".." && !str_starts_with($file, '.')) {
                            $link = isset($partner_links[$file]) ? $partner_links[$file] : '#';
                            echo "<a href='" . $link . "' target='_blank' rel='noopener noreferrer'>";
                            echo "<img src='" . $url . $file . "' alt='Partner logo' />";
                            echo "</a>";
                        }
                    }
                ?>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>