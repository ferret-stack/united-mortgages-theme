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
                    <p>Buying your first home is a lot of "what happens next." You'll have one adviser from application to completion who actually knows your file - not a call centre rotation.</p>
                    <a href="<?php echo home_url('/first-time-buyers'); ?>" class="btn-service">I'M A FIRST TIME BUYER</a>
                </div>

                <!-- Moving Home -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/moving-home.svg" alt="Moving Home">
                    </div>
                    <h3>MOVING HOME</h3>
                    <p>Whether you need more space or less, we source the right deal for your next move and manage the process end&#8209;to&#8209;end, alongside your existing mortgage where relevant.</p>
                    <a href="<?php echo home_url('/moving-home'); ?>" class="btn-service">I'M MOVING HOME</a>
                </div>

                <!-- Remortgaging -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/remortgaging.svg" alt="Remortgaging">
                    </div>
                    <h3>REMORTGAGING</h3>
                    <p>If your fixed rate is ending or you want to release equity, we'll compare the market and tell you honestly whether moving is worth it &#8209; not just find you a deal.</p>
                    <a href="<?php echo home_url('/remortgaging'); ?>" class="btn-service">I'M REMORTGAGING</a>
                </div>

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/self-employed.svg" alt="Entrepreneurs, Founders, and Self-Employed">
                    </div>
                    <h3>Entrepreneurs, Founders, and Self-Employed</h3>
                    <p>We started United as founders ourselves, so we know business income doesn't look like a payslip. Our advisers know which lenders read dividends, day rates, and equity comp properly &#8209; and how to present yours the way they want to see it.</p>
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
                    <p>Portfolio lending runs on rental yield and stress-test maths, not personal income. We work with specialist BTL lenders who assess it that way.</p>
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