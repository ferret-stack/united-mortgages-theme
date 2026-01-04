<?php
/**
 * The main template file
 *
 * @package UnitedMortgages
 */
/*V2.1*/
get_header(); ?>

<main id="primary" class="site-main">
    
    <!-- Hero Section with Background Image -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Your Home, <span class="highlight">Our Commitment</span></h1>
                <p class="hero-subtitle">
                    Your trusted <strong>mortgage experts</strong>. We don't just help secure your next home, or investment, we work collaboratively to help build your stronger financial future.
                </p>
                
                <!-- Placeholder for Trustpilot -->
                <div class="trustpilot-placeholder">
                    <!-- Trustpilot integration will go here -->
                </div>
            </div>

    <!-- Feature Cards Section -->
            <div class="features-section">
        <div class="container">
            <div class="features-grid">
                
                <!-- Our Mortgages Card -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/home-icon.svg" alt="Home Icon">
                    </div>
                    <h3>OUR MORTGAGES</h3>
                    <p>Powering your future, regardless of your plans or circumstances</p>
                    <a href="<?php echo home_url('/our-mortgages'); ?>" class="feature-link">Learn more</a>
                </div>

                <!-- Mortgage Calculators Card -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/calculator-icon.svg" alt="Calculator Icon">
                    </div>
                    <h3>MORTGAGE CALCULATORS</h3>
                    <p>Plan and budget better with our handy mortgage calculators</p>
					<a href="<?php echo home_url('/calculators'); ?>" class="feature-link">Learn more</a>
                </div>

                <!-- Get Your Mortgage in Principle Card -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/handshake-icon.svg" alt="Handshake Icon">
                    </div>
                    <h3>GET YOUR<br>MORTGAGE IN PRINCIPLE</h3>
                    <p>Confirm how much you may be eligible to borrow with impact on your credit score</p>
                    <a href="<?php echo home_url('/aip-overview'); ?>" class="feature-link">Learn more</a>
                </div>

                <!-- Start Your Journey Card -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/arrow-icon.svg" alt="Arrow Icon">
                    </div>
                    <h3>START YOUR JOURNEY</h3>
                    <p>Our expert team are on hand 365 days a year to support your property goals</p>
                    <a href="#contact-form" class="feature-link smooth-scroll">Learn more</a>
                </div>

            </div>
        </div>
    </section>
    
    <!-- Page Two - Think Differently Section -->
    <section class="think-different">
        <div class="container">
            <div class="think-different-header">
                <h2 class="think-different-title">Think differently <span class="light-text">about mortgages</span></h2>
                <p class="think-different-subtitle">Whatever your situation, or future goals, we can help.</p>
            </div>
            
            <div class="mortgage-types-grid">
                <!-- First Time Buyers -->
                <div class="mortgage-type-card">
                    <div class="card-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/first-icon.svg" alt="First Time Buyers">
                    </div>
                    <h3>FIRST TIME BUYERS</h3>
                    <p>Take that exciting step onto the property ladder. Let us help find you the right mortgage deal and secure that first set of keys</p>
                    <a href="<?php echo home_url('/first-time-buyers'); ?>"class="btn-secondary">I'M A FIRST TIME BUYER</a>
                </div>
                
                <!-- Moving Home -->
                <div class="mortgage-type-card">
                    <div class="card-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/moving-icon.svg" alt="Moving Home">
                    </div>
                    <h3>MOVING HOME</h3>
                    <p>Outgrowing your space, or looking to scale down? ‘Whatever your next chapter looks like, we’re here to help find you the right mortgage to help make it happen</p>
                    <a href="<?php echo home_url('/moving-home'); ?>"class="btn-secondary">I'M MOVING HOME</a>
                </div>
                
                <!-- Remortgaging -->
                <div class="mortgage-type-card">
                    <div class="card-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/remortgage-icon.svg" alt="Remortgaging">
                    </div>
                    <h3>REMORTGAGING?</h3>
                    <p>Whether you’re looking to save on monthly payments, or your deal is coming to an end, trust us to find the right remortgage option that suits your needs and helps you make the most out of your home</p>
                    <a href="<?php echo home_url('/remortgaging'); ?>" class="btn-secondary">I'M REMORTGAGING</a>
                </div>
                
                <!-- Yuppies -->
                <div class="mortgage-type-card">
                    <div class="card-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/coffee-icon.svg" alt="Other Mortgages">
                    </div>
                    <h3>YOUNG PROFESSIONALS</h3>
                    <p>Tailored mortgage solutions for the next generation of high achievers. Discreet, strategic, and built around your ambitions</p>
                    <a href="#contact-form" class="btn-secondary smooth-scroll">YOUNG PROFESSIONALS</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Unique Quote Section -->
    <section class="unique-section">
        <div class="container">
            <div class="quote-wrapper">
                <div class="quote-image">
                    <a href="<?php echo home_url('/our-story/'); ?>#founders"><img src="<?php echo get_template_directory_uri(); ?>/assets/david-unique.png?v=3" alt="Every client, and their goals, are unique, and that's exactly how we approach the mortgage process"></a>
                </div>
                <div class="quote-content">
                    <blockquote>
                        <p class="quote-text">'Every client, and their goals, are <span class="highlight-unique">unique</span>, and that's exactly how we approach<br>the mortgage process'</p>
                        <footer class="quote-attribution">
                            <span class="quote-name">DAVID WOODFORD,</span>
                            <span class="quote-title">Co-Founder &amp; CEO</span>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

 <?php get_template_part('template-parts/um-way'); ?>

    <!-- US Property Section 
    <section class="us-property-section" id="us-property">
        <div class="property-overlay"></div>
        <div class="container">
            <div class="property-content">
                <h2 class="property-title">Your Gateway to<br><span class="bold-text">U.S. Property Ownership</span></h2>
                <p class="property-description">
                    We offer a bespoke programme helping British citizens <strong>secure property in the United States</strong>. 
                    Whether you're buying a holiday home or investing abroad, we've partnered with the leading US 
                    firm and their expert team to handle the complexities so you don't have to.
                </p>
                
                <a href="https://2eys75.share-eu1.hsforms.com/2TSSmWsJnRJCGLQHLexp-mw" class="btn-explore">EXPLORE U.S. PROPERTY</a>
                
                <div class="partnership-info">
                    <p>In partnership with</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/fortress-logo.png" alt="Fortress Mortgage Advisors" class="partner-logo">
                </div>
            </div>
        </div>
    </section>-->

<!-- Partner Section -->
<section class="partnership-section">
    <div class="container">
        <h1 style="color: white;  font-size: 3.5rem; transform:translateY(3rem);">Our <span class="highlight">Partners</span></h1>
        <div class="spacer"></div>
        <div class="partnership-grid">
            <?php
                $directory = get_template_directory() . '/assets/partners/';
                $url = get_template_directory_uri() . '/assets/partners/';
                $files = scandir($directory);
                                
                $partner_links = [
                    'charterwells.svg' => 'https://www.charterwells.co.uk/',
                    'fortress.svg' => 'https://2eys75.share-eu1.hsforms.com/2TSSmWsJnRJCGLQHLexp-mw',
                    'key-conveyencing.svg' => 'https://www.keyconveyancing.co.uk/',
                    'thomas-legal.svg' => 'https://thomaslegal.co.uk/',
                    'x-david-charles.svg' => 'https://david-charles.co.uk/',
                    'x-drifthome.svg' => 'https://drifthome.ai/',
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
<?php get_template_part('template-parts/team-contact'); ?>

</main><!-- #primary -->

<?php get_footer(); ?>

