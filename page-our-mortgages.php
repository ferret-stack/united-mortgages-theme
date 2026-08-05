<?php
/**
 * Template Name: Our Mortgages
 *
 * @package UnitedMortgages
 */
/*V2.0 — Option 2a redesign*/
get_header(); ?>

<main id="primary" class="site-main">

    <!-- Our Mortgages Hero -->
    <section class="um-mortgages-hero">
        <div class="hp-container">
            <h1 class="um-mortgages-hero__title">Our Mortgages</h1>
            <p class="um-mortgages-hero__subtitle">Find and apply for the right mortgage with our expert support. Whether you're buying your first home or planning your next move, it all starts here.</p>
        </div>
    </section>

    <!-- Mortgage Types Grid -->
    <section class="um-mortgages-grid-wrap">
        <div class="hp-container">
            <div class="mortgage-services-grid">
                <!-- First Time Buyers -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/first-time-buyers.svg" alt="First Time Buyers">
                    </div>
                    <h3>FIRST TIME BUYERS</h3>
                    <p>Take that exciting step onto the property ladder. Let us help you buy the right mortgage deal and secure that first set of keys.</p>
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

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/self-employed.svg" alt="Entrepreneurs, Founders, and Self-Employed">
                    </div>
                    <h3>Entrepreneurs, Founders, and Self-Employed</h3>
                    <p>Traditional lenders don't understand your business model. We do. Whether you're
                    a contractor on day rates, a director taking dividends, or a founder with equity
                    compensation, we know how to present your income in a way that gets you approved.</p>
                    <a href="<?php echo home_url('/efse'); ?>" class="btn-service">I'M SELF EMPLOYED</a>
                </div>

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/handshake.svg" alt="Expats">
                    </div>
                    <h3>EXPATS</h3>
                    <p>You've put in the miles, and we'll go the distance. A mortgage in the UK shouldn't feel out of reach; we understand which lenders offer expat mortgages and their expat mortgage criteria</p>
                    <a href="<?php echo home_url('/expats'); ?>" class="btn-service">I'M AN EXPAT</a>
                </div>

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/other-mortgages.svg" alt="BtL Investors">
                    </div>
                    <h3>Buy-to-Let Investors</h3>
                    <p>Building a property portfolio requires lenders who understand rental yields,
                    stress tests, and portfolio strategies. We work with specialist BTL lenders
                    who see investment properties as business assets, not consumer purchases.</p>
                    <a href="<?php echo home_url('/buy-to-let'); ?>" class="btn-service">I'M AN INVESTOR</a>
                </div>
            </div>
        </div>
    </section>

    <div class="hp-team-wrap">
        <?php get_template_part('template-parts/team-contact'); ?>
    </div>

</main>
<?php
get_footer();