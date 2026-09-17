<?php
/**
 * Template Name: Awards
 * Description: United Mortgages Awards — self-nomination programme for estate agents.
 * Mock-up for local demo only: hero/why-enter/eligibility copy is placeholder
 * pending final wording, and the nomination form is a styled shell awaiting
 * the HubSpot embed from David. See inline PLACEHOLDER and TODO(hubspot-embed)
 * comments below.
 */
get_header(); ?>

<main id="primary" class="site-main">

    <!-- ============================================================
         Section 1: Hero + Why Enter
         The "why enter" beat the brief calls for is carried as prose in the
         standfirst rather than a card grid. PLACEHOLDER COPY throughout —
         award name and standfirst are provisional pending final copy.
         ============================================================ -->
    <section class="um-awards-hero">
        <div class="hp-container">
            <div class="um-awards-hero__top">
                <h1 class="um-awards-hero__title">United <span class="bold-text">Mortgages</span> Awards</h1>
                <p class="um-awards-hero__subtitle">
                    <!-- PLACEHOLDER COPY: standing in for the real award strapline, and
                         for the "why enter / what winners get" line pending real detail -->
                    Recognising the estate agents who go above and beyond for their clients.
                    Nominate yourself or your team — entry is free, and winners are recognised
                    across United Mortgages' channels and partner network.
                </p>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Section 2: Eligibility & Deadline
         All criteria and the deadline shown are PLACEHOLDER — no dates or
         numbers here are confirmed; do not treat as real copy.
         ============================================================ -->
    <section class="um-awards-eligibility">
        <div class="hp-container">
            <div class="um-awards-eligibility__inner">
                <div class="um-section-header" style="text-align:left; margin: 0;">
                    <h2 class="um-section-title">Eligibility <span class="bold-text">&amp; Deadline</span></h2>
                    <p class="um-section-subtitle">
                        <!-- PLACEHOLDER COPY -->
                        Who can enter, and by when — final wording pending.
                    </p>
                </div>

                <!-- PLACEHOLDER CRITERIA: illustrative only, not confirmed eligibility rules -->
                <ul class="um-awards-eligibility__list">
                    <li>Placeholder — open to UK-based estate agents and agency teams.</li>
                    <li>Placeholder — nominee must be currently practising as an estate agent.</li>
                    <li>Placeholder — self-nominations and third-party nominations both accepted.</li>
                    <li>Placeholder — one entry per nominee for this award cycle.</li>
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
                <div class="um-awards-form-shell__row">
                    <div>
                        <label for="um-awards-mock-first-name">First name</label>
                        <input type="text" id="um-awards-mock-first-name" placeholder="First name" disabled aria-disabled="true">
                    </div>
                    <div>
                        <label for="um-awards-mock-last-name">Last name</label>
                        <input type="text" id="um-awards-mock-last-name" placeholder="Last name" disabled aria-disabled="true">
                    </div>
                </div>

                <label for="um-awards-mock-agency">Agency name</label>
                <input type="text" id="um-awards-mock-agency" placeholder="Agency name" disabled aria-disabled="true">

                <label for="um-awards-mock-email">Email address</label>
                <input type="email" id="um-awards-mock-email" placeholder="you@agency.com" disabled aria-disabled="true">

                <label for="um-awards-mock-reason">Why should they win?</label>
                <textarea id="um-awards-mock-reason" placeholder="Tell us why this nomination stands out&hellip;" disabled aria-disabled="true"></textarea>

                <button type="button" class="um-awards-form-shell__submit" disabled aria-disabled="true">Submit Nomination</button>
                <!-- END TODO(hubspot-embed) placeholder block -->
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
