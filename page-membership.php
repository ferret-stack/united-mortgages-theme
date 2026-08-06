<?php
/**
 * Template Name: Lifetime Membership
 * Description: Page detailing United Mortgages' Lifetime Mortgage Membership model
 * V1; April 2026
 */
get_header(); ?>
<main id="primary" class="site-main">

<!-- Hero Section -->
<section class="um-product-hero">
<div class="hp-container">
<div class="um-product-hero__content">
<h1 class="um-product-hero__title">Lifetime Mortgage Membership</h1>
<p class="um-product-hero__subtitle">A lifelong partnership for your homeowning journey</p>
</div>
</div>
</section>

<!-- Policy Content -->
<section class="um-policy-content">
<div class="hp-container">
<div class="um-policy-main--standalone um-post-content">

<p>When you arrange your mortgage through United Mortgages&reg;, you're not just securing a loan &ndash; <strong>you're securing a lifelong partnership.</strong></p>

<p>Through our Lifetime Mortgage Membership, our dedicated team is with you every step of your homeowning journey, through each renewal, remortgage, and move, ensuring your mortgage continues to work as hard as you do.</p>

<img src="<?php echo get_template_directory_uri(); ?>/assets/lifetime.png" alt="United Mortgages Lifetime Membership card">

<h2>Here's what that means for you</h2>

<div class="um-policy-step">
<h4>👪 One fee, lifetime support</h4>
<p>You'll pay an application fee* only for your first mortgage through United Mortgages&reg;. Thereafter, every future mortgage we arrange for you is included in your membership.</p>
</div>

<div class="um-policy-step">
<h4>🗓 Annual mortgage review</h4>
<p>Each year, we'll proactively check that you're still on the right deal and alert you to better opportunities as the mortgage market shifts.</p>
</div>

<div class="um-policy-step">
<h4>🫶 Continuity and care</h4>
<p>You'll always have access to our 365-days-a-year team, ready to advise you through every stage of life and property ownership.</p>
</div>

<blockquote>Think of it as having a mortgage concierge, always in your corner, long after you pick up those first set of keys.</blockquote>

<div class="um-policy-info-box">
<p>*A fixed application fee of &pound;699 is payable at the point of application for standard residential borrowers. A fee of &pound;999 is payable for Adverse Credit and Buy-to-let borrowers. Please see our <a href="/privacy-policy">Privacy Policy</a> for further details on our fee structure.</p>
</div>

</div>
</div>
</section>

<!-- CTA Section -->
<section class="um-cta-band">
<div class="hp-container">
<h2 class="um-cta-band__title">Ready to get started?</h2>
<p class="um-cta-band__subtitle">Apply for your Agreement in Principle in under 10 minutes</p>
<div class="um-cta-band__actions">
<a href="<?php echo home_url('/aip-form'); ?>" class="hp-btn">Get Started Now</a>
</div>
</div>
</section>

</main>
<?php get_footer(); ?>
