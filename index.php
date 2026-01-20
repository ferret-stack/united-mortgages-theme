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

                <h1 class="hero-title">The Mortgage Process Has <span class="highlight">Never Been Simpler</span></h1>
                <p class="hero-subtitle">
                    Working with 100+ lenders and <strong>available 365 days a year.</strong><br>No jargon. No paperwork theatre. No pretending it's still 1997.<br>Just a straightforward path to <strong>unlocking your next home</strong>
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
            <div class="mortgage-services-grid">
                <!-- First Time Buyers -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/first-time-buyers.svg" alt="First Time Buyers">
                    </div>
                    <h3>FIRST TIME BUYERS</h3>
                    <p>Take that exciting step onto the property ladder. Let us help you find the right mortgage deal and secure that first set of keys.</p>
                    <a href="<?php echo home_url('/first-time-buyers'); ?>" class="btn-service">I'M A FIRST TIME BUYER</a>
                </div>

                <!-- Moving Home -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/moving-home.svg" alt="Moving Home">
                    </div>
                    <h3>MOVING HOME</h3>
                    <p>Need more room or ready to downsize? No matter what your next move looks like, we're here to help you find the right mortgage to make it happen.</p>
                    <a href="<?php echo home_url('/moving-home'); ?>" class="btn-service">I'M MOVING HOME</a>
                </div>

                <!-- Remortgaging -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/remortgaging.svg" alt="Remortgaging">
                    </div>
                    <h3>REMORTGAGING</h3>
                    <p>Time for a better deal? Whether your fixed rate is ending or you want to release equity, we'll find the right remortgage to save you money.</p>
                    <a href="<?php echo home_url('/remortgaging'); ?>" class="btn-service">I'M REMORTGAGING</a>
                </div>
            </div>
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
            <h1 style="color: white; font-size: 3.5rem; transform:translateY(3rem);">Our Partners</h1>
            <div class="spacer"></div>
            <div class="partnership-grid">
                <?php
                    $directory = get_template_directory() . '/assets/partners/';
                    $url = get_template_directory_uri() . '/assets/partners/';
                    $files = scandir($directory);
                                    
                    $partner_links = [
                        '9charterwells.svg' => 'https://www.charterwells.co.uk/',
                        '8fortress.svg' => 'https://2eys75.share-eu1.hsforms.com/2TSSmWsJnRJCGLQHLexp-mw',
                        '3key-conveyencing.svg' => 'https://www.keyconveyancing.co.uk/',
                        '2thomas-legal.svg' => 'https://thomaslegal.co.uk/',
                        '4david-charles.svg' => 'https://david-charles.co.uk/',
                        '1drifthome.svg' => 'https://drifthome.ai/',
                        '6mn-eXp.svg' => 'https://marknewton.exp.uk.com/',
                        '5fiberpay.svg' => 'https://fiberpay.com/',
                        '7pb-exp.png' => 'https://paulberg.exp.uk.com/',
                        '99novello.svg' => 'https://novellosurveyors.co.uk/',
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