<?php
/**
 * Template Name: AIP Overview
 *
 * @package UnitedMortgages
 */
/*V2.0 — Option 2a redesign*/
get_header(); ?>

<main id="primary" class="site-main">

    <section class="um-aip-hero">
        <div class="hp-container">
            <div class="um-aip-hero__content">
                <div class="hp-pill">Takes less than 10 minutes</div>
                <h1 class="um-aip-hero__title">Secure Your <span class="um-aip-hero__accent">Agreement in Principle</span></h1>
                <p class="um-aip-hero__subtitle">Know how much you can borrow before you fall in love with a property. It gives you clarity on your budget and shows sellers you're serious.</p>
            </div>

            <div class="um-aip-benefits">
                <div class="um-aip-benefit">
                    <div class="um-aip-benefit__icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/scale.png" alt="Know your budget">
                    </div>
                    <h3>Know your budget</h3>
                    <p>Get a clear idea of your borrowing ability before you start looking</p>
                </div>

                <div class="um-aip-benefit">
                    <div class="um-aip-benefit__icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/thumb.png" alt="Show you're serious">
                    </div>
                    <h3>Show you're serious</h3>
                    <p>Estate agents and sellers take you seriously with an AIP in hand</p>
                </div>

                <div class="um-aip-benefit">
                    <div class="um-aip-benefit__icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/speed.png" alt="Speeds things up">
                    </div>
                    <h3>Speeds things up</h3>
                    <p>Our team gets a head start when you find your dream home</p>
                </div>
            </div>

            <div class="um-aip-cta">
                <div class="um-aip-cta__badge">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="9" stroke="#4CAF50" stroke-width="2"/>
                        <path d="M6 10L9 13L14 7" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    No impact on your credit score
                </div>

                <a href="<?php echo home_url('/aip-form'); ?>" class="hp-btn um-aip-cta__start">Start now</a>

                <p class="um-aip-cta__terms">
                    By continuing, you agree to our <a href="<?php echo home_url('/privacy-policy'); ?>">terms and conditions</a>
                </p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
