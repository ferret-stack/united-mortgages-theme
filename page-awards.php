<?php
/**
 * Template Name: Awards
 * Description: United Mortgages Awards — self-nomination programme for estate agents.
 */

// Nomination form consent line (field 16). Approved wording: edit it here only.
$um_awards_consent = sprintf(
    'If I\'m nominating someone else, I confirm they know about this nomination and are happy for me to share their details. I understand United Mortgages&reg; will use the details on this form to run the awards and to contact me and the nominee about this nomination, in line with its %s.',
    '<a href="' . esc_url( home_url( '/privacy-policy' ) ) . '" target="_blank" rel="noopener">Privacy Policy</a>'
);

// Field 1 options, verbatim and in this order. The backend accepts only these
// nine values (AWARD_OPTIONS in app.py): change both together.
$um_awards_options = array(
    'London',
    'South of England (South East & South West)',
    'Midlands & East of England',
    'North of England',
    'Nations Award: Scotland, Wales, & Northern Ireland',
    'National Agency of the Year (25+ branches)',
    'Estate Agency of the Year',
    'Social & Environmental Impact Award',
    'Rising Star of the Year',
);

get_header(); ?>

<main id="primary" class="site-main">

    <!-- ============================================================
         Section 1: Hero + Why Enter
         ============================================================ -->
    <section class="um-awards-hero">
        <div class="hp-container">
            <div class="um-awards-hero__top">
                <h1 class="um-awards-hero__title bold-text"><span class="bold-text">United Mortgages&reg;</span> Estate Agency Awards 2027</h1>
                <p class="um-awards-hero__subtitle">
                    We didn't build United to be another mortgage broker doing things the old way. No call centres. No queue of "whoever's free". Just one adviser with real availability offering honest advice from first message to completion.
                    Our awards recognise those in the industry who, like us, refuse to do things by default.
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
                <div class="um-section-header um-awards-section-header">
                    <h2 class="um-section-title"><span class="bold-text">Award Categories</span></h2>
                    <p class="um-section-subtitle">
                        Seven regional titles, two nation-wide awards, and three headline honours.<br>Judged by a panel of independent property journalists, a consumer advocate, and agents from outside the region.
                    </p>
                </div>

                <ul class="um-awards-eligibility__list">
                    <li>
                        <h3>Regional Agency of the Year - England</h3>
                        <p>London &middot; South of England &middot; Midlands &amp; East of England &middot; North of England.</p>
                    </li>
                    <li>
                        <h3>Nations Award</h3>
                        <p>Estate Agency of the Year - Scotland, Wales, and Northern Ireland.</p>
                    </li>
                    <li>
                        <h3>Scale Award</h3>
                        <p>For estate agencies with 25+ branches.</p>
                    </li>
                    <li>
                        <h3>Headline Awards</h3>
                        <p><strong>Agency of the Year</strong> - chosen from the seven regional winners, plus the Nations and National winners.</p>
                        <p><strong>Social &amp; Environmental Impact Award</strong> - for leadership in sustainability, community investment, and social value.</p>
                        <p><strong>Rising Star of the Year</strong> - under 30, or under two years in the industry.</p>
                    </li>
                </ul>

                <div class="spacer"></div>

                <div class="um-awards-section-header">
                    <h2 class="um-section-title"><span class="bold-text">Key Dates</span></h2>
                </div>
                <ul class="um-awards-dates" style="margin-left:50px;">
                    <li><span class="um-awards-dates__label">Nominations open: </span><span class="um-awards-dates__value">1 October 2026</span></li>
                    <li><span class="um-awards-dates__label">Nominations close: </span><span class="um-awards-dates__value">30 November 2026</span></li>
                    <li><span class="um-awards-dates__label">Shortlists announced: </span><span class="um-awards-dates__value">7 December 2026</span></li>
                    <li><span class="um-awards-dates__label">Winners revealed: </span><span class="um-awards-dates__value">4 January 2027</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ============================================================
         Section 3: Nomination Form
         ============================================================ -->
    <section class="um-awards-form-section">
        <div class="hp-container">
            <div class="um-awards-form-shell">
                <div class="um-section-header" style="text-align:left; margin: 0 0 -30px;">
                    <h2 class="um-section-title"><span class="bold-text">Nomination Form</span></h2>
                    <p class="um-section-subtitle" style="margin-bottom:-40px;">
                        Nominate yourself, a colleague, or someone in the industry you rate.
                    </p>
                </div>

                <!-- Nomination form. Posts JSON to the Flask backend (js/awards-form.js);
                     the details are emailed to United Mortgages. method="post" so
                     that, if the script ever fails to load, nothing typed here is
                     put in the page address. -->
                <form class="um-awards-form" method="post" novalidate data-um-awards>

                    <fieldset class="um-awards-form__group">
                        <legend class="um-awards-form__legend">Which Award Are You Nominating For</legend>
                        <div class="um-awards-form__field" data-field="awards">
                            <p class="um-awards-form__label" id="um-aw-awards-label">Select up to four awards <span class="um-awards-form__req" aria-hidden="true">*</span></p>
                            <div class="um-awards-form__checks" role="group" aria-labelledby="um-aw-awards-label" aria-describedby="um-aw-awards-error">
                                <?php foreach ( $um_awards_options as $i => $um_award ) : ?>
                                    <label class="um-awards-form__check" for="um-aw-award-<?php echo (int) $i; ?>">
                                        <input type="checkbox" id="um-aw-award-<?php echo (int) $i; ?>" name="awards" value="<?php echo esc_attr( $um_award ); ?>">
                                        <span><?php echo esc_html( $um_award ); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <p class="um-awards-form__error" id="um-aw-awards-error" data-error-for="awards" hidden></p>
                        </div>
                    </fieldset>

                    <fieldset class="um-awards-form__group">
                        <legend class="um-awards-form__legend">About You</legend>
                        <div class="um-awards-form-shell__row">
                            <div class="um-awards-form__field" data-field="first_name">
                                <label for="um-aw-first_name">First Name <span class="um-awards-form__req" aria-hidden="true">*</span></label>
                                <input type="text" id="um-aw-first_name" name="first_name" autocomplete="given-name" maxlength="100" required aria-describedby="um-aw-first_name-error">
                                <p class="um-awards-form__error" id="um-aw-first_name-error" data-error-for="first_name" hidden></p>
                            </div>
                            <div class="um-awards-form__field" data-field="last_name">
                                <label for="um-aw-last_name">Last Name <span class="um-awards-form__req" aria-hidden="true">*</span></label>
                                <input type="text" id="um-aw-last_name" name="last_name" autocomplete="family-name" maxlength="100" required aria-describedby="um-aw-last_name-error">
                                <p class="um-awards-form__error" id="um-aw-last_name-error" data-error-for="last_name" hidden></p>
                            </div>
                        </div>
                        <div class="um-awards-form-shell__row">
                            <div class="um-awards-form__field" data-field="phone">
                                <label for="um-aw-phone">Phone Number <span class="um-awards-form__req" aria-hidden="true">*</span></label>
                                <input type="tel" id="um-aw-phone" name="phone" autocomplete="tel" maxlength="30" required aria-describedby="um-aw-phone-error">
                                <p class="um-awards-form__error" id="um-aw-phone-error" data-error-for="phone" hidden></p>
                            </div>
                            <div class="um-awards-form__field" data-field="email">
                                <label for="um-aw-email">Email <span class="um-awards-form__req" aria-hidden="true">*</span></label>
                                <input type="email" id="um-aw-email" name="email" autocomplete="email" maxlength="254" required aria-describedby="um-aw-email-error">
                                <p class="um-awards-form__error" id="um-aw-email-error" data-error-for="email" hidden></p>
                            </div>
                        </div>
                        <div class="um-awards-form-shell__row">
                            <div class="um-awards-form__field" data-field="company">
                                <label for="um-aw-company">Company</label>
                                <input type="text" id="um-aw-company" name="company" autocomplete="organization" maxlength="100">
                            </div>
                            <div class="um-awards-form__field" data-field="job_title">
                                <label for="um-aw-job_title">Job Title</label>
                                <input type="text" id="um-aw-job_title" name="job_title" autocomplete="organization-title" maxlength="100">
                            </div>
                        </div>
                        <div class="um-awards-form__field" data-field="nominating">
                            <label for="um-aw-nominating">I'm nominating... <span class="um-awards-form__req" aria-hidden="true">*</span></label>
                            <select id="um-aw-nominating" name="nominating" required aria-describedby="um-aw-nominating-error">
                                <option value="">Please select</option>
                                <option value="Myself">Myself</option>
                                <option value="Someone else">Someone else</option>
                            </select>
                            <p class="um-awards-form__error" id="um-aw-nominating-error" data-error-for="nominating" hidden></p>
                        </div>
                    </fieldset>

                    <fieldset class="um-awards-form__group">
                        <legend class="um-awards-form__legend">The Nominee</legend>
                        <p class="um-awards-form__note">Ignore this section if you're nominating yourself</p>
                        <div class="um-awards-form-shell__row">
                            <div class="um-awards-form__field" data-field="nominee_first_name">
                                <label for="um-aw-nominee_first_name">Nominee First Name <span class="um-awards-form__req" aria-hidden="true" data-required-for-someone-else hidden>*</span></label>
                                <input type="text" id="um-aw-nominee_first_name" name="nominee_first_name" autocomplete="off" maxlength="100" aria-describedby="um-aw-nominee_first_name-error">
                                <p class="um-awards-form__error" id="um-aw-nominee_first_name-error" data-error-for="nominee_first_name" hidden></p>
                            </div>
                            <div class="um-awards-form__field" data-field="nominee_last_name">
                                <label for="um-aw-nominee_last_name">Nominee Last Name <span class="um-awards-form__req" aria-hidden="true" data-required-for-someone-else hidden>*</span></label>
                                <input type="text" id="um-aw-nominee_last_name" name="nominee_last_name" autocomplete="off" maxlength="100" aria-describedby="um-aw-nominee_last_name-error">
                                <p class="um-awards-form__error" id="um-aw-nominee_last_name-error" data-error-for="nominee_last_name" hidden></p>
                            </div>
                        </div>
                        <div class="um-awards-form__field" data-field="nominee_email">
                            <label for="um-aw-nominee_email">Nominee Email <span class="um-awards-form__req" aria-hidden="true" data-required-for-someone-else hidden>*</span></label>
                            <input type="email" id="um-aw-nominee_email" name="nominee_email" autocomplete="off" maxlength="254" aria-describedby="um-aw-nominee_email-error">
                            <p class="um-awards-form__error" id="um-aw-nominee_email-error" data-error-for="nominee_email" hidden></p>
                        </div>
                        <div class="um-awards-form-shell__row">
                            <div class="um-awards-form__field" data-field="nominee_job_title">
                                <label for="um-aw-nominee_job_title">Nominee Job Title</label>
                                <input type="text" id="um-aw-nominee_job_title" name="nominee_job_title" autocomplete="off" maxlength="100">
                            </div>
                            <div class="um-awards-form__field" data-field="nominee_company">
                                <label for="um-aw-nominee_company">Nominee Company</label>
                                <input type="text" id="um-aw-nominee_company" name="nominee_company" autocomplete="off" maxlength="100">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="um-awards-form__group">
                        <legend class="um-awards-form__legend">Why They Deserve To Win</legend>
                        <div class="um-awards-form__field" data-field="why_deserve">
                            <label for="um-aw-why_deserve">Tell us why this nominee deserves to win (max 500 characters)</label>
                            <textarea id="um-aw-why_deserve" name="why_deserve" maxlength="500" aria-describedby="um-aw-why_deserve-count um-aw-why_deserve-error"></textarea>
                            <p class="um-awards-form__count" id="um-aw-why_deserve-count" data-count-for="why_deserve" aria-live="polite">0 / 500</p>
                            <p class="um-awards-form__error" id="um-aw-why_deserve-error" data-error-for="why_deserve" hidden></p>
                        </div>
                        <div class="um-awards-form__field" data-field="example_story">
                            <label for="um-aw-example_story">Give one specific example or story that best illustrates this (max 500 characters)</label>
                            <textarea id="um-aw-example_story" name="example_story" maxlength="500" aria-describedby="um-aw-example_story-count um-aw-example_story-error"></textarea>
                            <p class="um-awards-form__count" id="um-aw-example_story-count" data-count-for="example_story" aria-live="polite">0 / 500</p>
                            <p class="um-awards-form__error" id="um-aw-example_story-error" data-error-for="example_story" hidden></p>
                        </div>
                        <div class="um-awards-form__field" data-field="anything_else">
                            <label for="um-aw-anything_else">Is there anything else you'd like to tell us about the nominee?</label>
                            <textarea id="um-aw-anything_else" name="anything_else" maxlength="3000" aria-describedby="um-aw-anything_else-error"></textarea>
                            <p class="um-awards-form__error" id="um-aw-anything_else-error" data-error-for="anything_else" hidden></p>
                        </div>
                    </fieldset>

                    <div class="um-awards-form__field um-awards-form__consent" data-field="consent">
                        <label class="um-awards-form__check" for="um-aw-consent">
                            <input type="checkbox" id="um-aw-consent" name="consent" value="1" required aria-describedby="um-aw-consent-error">
                            <span><?php echo wp_kses_post( $um_awards_consent ); ?> <span class="um-awards-form__req" aria-hidden="true">*</span></span>
                        </label>
                        <p class="um-awards-form__error" id="um-aw-consent-error" data-error-for="consent" hidden></p>
                    </div>

                    <!-- Spam honeypot: off-screen and skipped by keyboard and screen
                         readers. People leave it empty; the server silently
                         discards any nomination where it is filled. -->
                    <div class="um-awards-form__hp" aria-hidden="true">
                        <label for="um-aw-hp">Leave this field empty</label>
                        <input type="text" id="um-aw-hp" name="um_hp" tabindex="-1" autocomplete="off" value="">
                    </div>

                    <p class="um-awards-form__status" role="alert" data-um-awards-error hidden></p>

                    <button type="submit" class="um-awards-form-shell__submit" data-um-awards-submit>Submit nomination</button>

                    <noscript>
                        <p class="um-awards-form__note">Please turn on JavaScript to send a nomination, or call us on <a href="tel:03330914776">0333 091 4776</a>.</p>
                    </noscript>
                </form>

                <div class="um-awards-form__success" role="status" tabindex="-1" data-um-awards-success hidden>
                    <p><strong>Thank you, your nomination is in.</strong> We've sent it to the United Mortgages&reg; awards team. If you have any questions, call us on <a href="tel:03330914776">0333 091 4776</a>.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
