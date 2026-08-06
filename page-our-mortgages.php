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
            <?php get_template_part('template-parts/mortgage-type-grid'); ?>
        </div>
    </section>

    <div class="hp-team-wrap">
        <?php get_template_part('template-parts/team-contact'); ?>
    </div>

</main>
<?php
get_footer();