<?php
/**
 * Template Name: Awards
 * Description: United Mortgages Awards — self-nomination programme for estate agents.
 */
get_header(); ?>

<main id="primary" class="site-main">

    <!-- ============================================================
         Section 1: Hero + Why Enter
         Trophy artwork (assets/UM-awards-27.png) as a framed image below the
         copy. Tried first as a full-bleed hero background with a dark
         overlay (matching .um-story-hero/.um-charter), but the trophy's
         own engraved lettering read through the overlay and duplicated
         the heading sitting on top of it — moved to a plain framed <img>
         instead of chasing an overlay dark enough to hide it.
         ============================================================ -->
    <section class="um-awards-hero">
        <div class="hp-container">
            <div class="um-awards-hero__top">
                <h1 class="um-awards-hero__title">United Mortgages <span class="bold-text">Estate Agency Awards</span></h1>
                <div class="um-awards-hero__text">
                    <p>We didn't build United Mortgages to be another broker doing things the old way — no call centres, no queue of "whoever's free", just one adviser with real availability and honest advice from first message to completion.</p>
                    <p>Our awards recognise the people in the industry doing the same: the independents outworking the chains, the teams raising the bar on client care instead of chasing volume, and the agents who'd rather be brilliant at five branches than average at fifty.</p>
                    <p>Nominate yourself, or someone you rate.</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/UM-awards-27.png" alt="United Mortgages Estate Agency Awards 2027 trophy" class="um-awards-hero__image">
            </div>
        </div>
    </section>

    <!-- ============================================================
         Section 2: Award Categories & Key Dates
         David's copy here covers award categories and the entry timeline,
         not eligibility criteria (who's allowed to enter) — heading and
         subtitle renamed to match what the section actually contains
         rather than promise something it doesn't answer.
         ============================================================ -->
    <section class="um-awards-eligibility">
        <div class="hp-container">
            <div class="um-awards-eligibility__inner">
                <div class="um-section-header um-awards-section-header">
                    <h2 class="um-section-title">Award <span class="bold-text">Categories</span></h2>
                    <p class="um-section-subtitle">
                        Seven regional titles, two nation-wide awards, and three headline honours chosen from them all.
                    </p>
                </div>

                <ul class="um-awards-eligibility__list">
                    <li>
                        <h3>Regional Agency of the Year &mdash; England</h3>
                        <p>London &middot; South of England &middot; Midlands &amp; East of England &middot; North of England.</p>
                    </li>
                    <li>
                        <h3>Nations Award</h3>
                        <p>Estate Agency of the Year &mdash; Scotland, Wales, and Northern Ireland.</p>
                    </li>
                    <li>
                        <h3>National / Scale Award</h3>
                        <p>For estate agencies with 25+ branches.</p>
                    </li>
                    <li>
                        <h3>Headline Awards</h3>
                        <p><strong>Agency of the Year</strong> &mdash; chosen from the seven regional winners, plus the Nations and National winners.</p>
                        <p><strong>Social &amp; Environmental Impact Award</strong> &mdash; for leadership in sustainability, community investment, and social value.</p>
                        <p><strong>Rising Star of the Year</strong> &mdash; under 30, or under two years in the industry.</p>
                    </li>
                </ul>

                <div class="um-awards-section-header um-awards-section-header--dates">
                    <h2 class="um-section-title">Key <span class="bold-text">Dates</span></h2>
                </div>
                <ul class="um-awards-dates">
                    <li><span class="um-awards-dates__label">Nominations open</span><span class="um-awards-dates__value">1 October 2026</span></li>
                    <li><span class="um-awards-dates__label">Nominations close</span><span class="um-awards-dates__value">30 November 2026</span></li>
                    <li><span class="um-awards-dates__label">Shortlists announced</span><span class="um-awards-dates__value">7 December 2026</span></li>
                    <li><span class="um-awards-dates__label">Winners revealed</span><span class="um-awards-dates__value">4 January 2027</span></li>
                </ul>
                <p class="um-awards-deadline">Winners are revealed right as the industry's setting its goals for the year ahead.</p>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Section 3: Nomination Form
         Live HubSpot embed (David's form, portal 146069825 / form
         212983cf-522f-412e-9042-701399415af1). Card/input/button chrome
         is the .hs-form-frame styling in style.css, matching the HubSpot
         form on template-parts/team-contact.php.
         ============================================================ -->
    <section class="um-awards-form-section">
        <div class="hp-container">
            <div class="um-awards-form-shell">
                <div class="um-section-header um-awards-section-header um-awards-section-header--form">
                    <h2 class="um-section-title">Nominate <span class="bold-text">Now</span></h2>
                    <p class="um-section-subtitle">
                        Takes two minutes. Tell us who deserves it, and why.
                    </p>
                </div>

                <?php
                // TODO(hubspot-embed): Replace the static markup below with David's
                // HubSpot embed (script src + data-portal-id/data-form-id, per the
                // pattern in template-parts/team-contact.php) once it's ready.
                // Everything in this block is a non-functional visual placeholder —
                // no name attributes, no <form> element, all fields disabled.
                ?>
<script src="https://js-eu1.hsforms.net/forms/embed/146069825.js" defer></script> <div class="hs-form-frame" data-region="eu1" data-form-id="212983cf-522f-412e-9042-701399415af1" data-portal-id="146069825"></div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
