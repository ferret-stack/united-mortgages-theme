<?php
/**
 * Template Name: Awards
 * Description: United Mortgages Awards — self-nomination programme for estate agents.
 */
get_header(); ?>

<main id="primary" class="site-main">

    <!-- ============================================================
         Section 1: Hero + Why Enter
         ============================================================ -->
    <section class="um-awards-hero">
        <div class="hp-container">
            <div class="um-awards-hero__top">
                <h1 class="um-awards-hero__title bold-text"><span class="bold-text">United Mortgages&reg;</span> Awards</h1>
                <p class="um-awards-hero__subtitle">
                    We didn't build United Mortgages to be another mortgag broker doing things the old way. No call centres. No queue of "whoever's free". Just one adviser with real availability offering honest advice from first message to completion.
                    Our awards recognise those in the industry who, like us, refuse to do things by default.<br><br>
                    We're here to shoutout the independents outworking the chains; the teams raising the bar on client care, not just chasing volume; the people who'd rather be brilliant at five branches than average at 50.
                </p>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Section 2: Eligibility & Deadline
         ============================================================ -->
    <section class="um-awards-eligibility">
        <div class="hp-container">
            <div class="um-awards-eligibility__inner">
                <div class="um-section-header" style="text-align:left; margin: 0;">
                    <h2 class="um-section-title">Eligibility &amp; Categories</h2>
                    <p class="um-section-subtitle">
                        Read here to find the category best suited to you.
                    </p>
                </div>

                <!-- PLACEHOLDER CRITERIA: illustrative only, not confirmed eligibility rules -->
                <ul class="um-awards-eligibility__list">
                    <li><span style="font-weight:700;">Regional Agency of the Year (England)</span><br>
                    - London<br>
                    - South of England<br>
                    - Midlands &amp; East of England<br>
                    - North of England
                    </li>
                    <li><span style="font-weight:700;">Nations Award</span><br>
                    Estate Agency of the Year, Scotland, Wales, and Northern Ireland.
                    </li>
                    <li><span style="font-weight: 700;">National / Scale Award</span><br>
                    Estate agencies with 25+ branches.
                </li>
                    <li><span style="font-weight:700;">The Headline</span><br>
                        <span style="font-weight:700;">Agency of the Year:</span> Chosen from seven regional winners plus the Nations and National winners<br>
                        <span style="font-weight: 700;">Social &amp; Environmental Impact Award:</span> Leadership in sustainability, community investment, and social value.<br>
                        <span style="font-weight: 700;">Rising Star of the Year:</span> Under 30 <em>or</em> under 2 years in the industry.
                </li>
                </ul>

                <!-- PLACEHOLDER DEADLINE: no real date has been confirmed -->
                <p class="um-awards-deadline">Entries close <strong>[placeholder date]</strong>.</p>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Section 3: Form Embed Slot
         Styled shell only — matches the HubSpot contact form visual treatment
         from template-parts/team-contact.php (.contact-form card + .hs-form-frame
         field styling in style.css), translated into this page's card/input/
         button tokens. All fields below are disabled: no name attributes, no
         <form> tag, no JS, no submission target. Zero functional form logic.
         ============================================================ -->
    <section class="um-awards-form-section">
        <div class="hp-container">
            <div class="um-awards-form-shell">
                <div class="um-section-header" style="text-align:left; margin: 0 0 28px;">
                    <h2 class="um-section-title">Nominate <span class="bold-text">Now</span></h2>
                    <p class="um-section-subtitle">
                        <!-- PLACEHOLDER COPY -->
                        Placeholder — nomination form intro copy goes here.
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
