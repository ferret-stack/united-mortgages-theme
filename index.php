<?php
/**
 * The main template file
 *
 * @package UnitedMortgages
 */
/*V3.4 — Homepage redesign: Option 2a (warm & balanced, blue)*/
get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="hp-hero">
        <div class="hp-container hp-hero__grid">
            <div>
                <div class="review-widgets-container hp-hero__reviews">
                    <div class="trustpilot-widget">
                        <a href="https://uk.trustpilot.com/review/united-mortgages.com" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/trustpilot.svg"
                                alt="Trustpilot Rating"
                                class="trustpilot-image">
                        </a>
                    </div>
                    <div class="bark-widget">
                        <a href="https://share.google/lrCoqIgJxYIiv6Biu" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/greviews.svg"
                                alt="Google Reviews"
                                class="bark-image">
                        </a>
                    </div>
                </div>

                <h1>Most mortgage advice happens 9&#8209;to&#8209;5.<br><span>Ours doesn't.</span></h1>

                <p class="hp-hero__lead">One named adviser from your first conversation through to completion - reachable evenings and weekends, not just office hours.</p>

                <div class="hp-hero__cta-row">
                    <a href="#calculator" class="hp-btn">Check what you could borrow</a>
                    <span class="hp-hero__note">Takes 3 minutes &middot; soft search, no credit impact</span>
                </div>
                <p class="hp-hero__secondary">Prefer to talk it through first? <a href="#contact-form">Request a call back</a>.</p>
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/herov4_ph.png" style="width:100%;aspect-ratio:4/3.2;object-fit:cover;border-radius:20px;">
        </div>
    </section>

    <section class="hp-usp">
        <div class="hp-container hp-usp__grid">
            <div class="hp-usp__item">
                <div class="hp-usp__num">01 &middot; One adviser</div>
                <p>The same person handles your case from first enquiry to completion - not whoever's free that day.</p>
            </div>
            <div class="hp-usp__item">
                <div class="hp-usp__num">02 &middot; Real availability</div>
                <p>Reachable evenings and weekends, not just 9&#8209;to&#8209;5.</p>
            </div>
            <div class="hp-usp__item">
                <div class="hp-usp__num">03 &middot; Beyond the mortgage</div>
                <p>We don't disappear after completion. Our network of conveyancers, surveyors and partners is there for what comes next.</p>
            </div>
        </div>
    </section>

    <section class="hp-mortgages-wrap">
        <div class="hp-container">
            <div class="hp-head">
                <h2>Our Mortgages</h2>
                <p>Find and apply for the right mortgage with our expert support. Whether you're buying your first home or planning your next move, it all starts here.</p>
            </div>
            <?php get_template_part('template-parts/mortgage-type-grid'); ?>
        </div>
    </section>

    <!-- What you could borrow — honestly -->
    <section class="hp-borrow">
        <div class="hp-container">
            <h2>What you could borrow — honestly</h2>
            <p class="hp-borrow__lead">The number below is what most lenders will actually offer. We won't show you a bigger one just to soften the click.</p>
            <div class="hp-borrow__card">
                <div>
                    <div class="hp-label">Combined income</div>
                    <div class="hp-value">&pound;58,000</div>
                </div>
                <div>
                    <div class="hp-label">Deposit</div>
                    <div class="hp-value">&pound;32,000</div>
                </div>
                <div>
                    <div class="hp-label">Typical</div>
                    <div class="hp-value hp-value--range">&pound;261,000</div>
                </div>
                <div>
                    <div class="hp-label">Enhanced <button type="button" class="range-info-trigger" onclick="openHpBorrowRangePopup()" aria-label="What does Enhanced mean?">&#9432;</button></div>
                    <div class="hp-value hp-value--range">&pound;348,000</div>
                </div>
            </div>
            <p class="hp-borrow__example-note">Based on 4.5&times;&ndash;6.0&times; joint income, standard affordability rules. Your actual offer depends on credit history, existing debt and each lender's own criteria — an advisor will confirm your real range before you apply.</p>

            <!-- Mandatory popup: Typical vs Enhanced (compliance-approved copy, reused verbatim from the embedded calculator) -->
            <div id="hp-borrow-range-popup" class="popup-overlay">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Typical vs Enhanced</h2>
                        <button type="button" class="popup-close" onclick="closeHpBorrowRangePopup()" aria-label="Close">&times;</button>
                    </div>
                    <div class="popup-body">
                        <p>These figures are estimates only. They are not guaranteed and actual lending depends on individual lender criteria, your credit history and full financial circumstances.</p>
                        <p>The <strong>Enhanced</strong> figure reflects income multiples of up to 6x now offered by a number of UK lenders. This tier is generally only available to higher earners &mdash; commonly &pound;75,000+ income &mdash; and is subject to lender-specific eligibility criteria. Most borrowers will not qualify for the Enhanced figure even though it is a real, current market rate. Your <strong>Typical</strong> figure is a more representative starting point for most applicants.</p>
                    </div>
                    <div class="popup-footer">
                        <button type="button" class="popup-button" onclick="closeHpBorrowRangePopup()">Got it</button>
                    </div>
                </div>
            </div>
            <script>
            (function() {
                'use strict';
                window.openHpBorrowRangePopup = function() {
                    const popup = document.getElementById('hp-borrow-range-popup');
                    if (popup) {
                        popup.classList.add('show');
                        document.body.style.overflow = 'hidden';
                    }
                };
                window.closeHpBorrowRangePopup = function() {
                    const popup = document.getElementById('hp-borrow-range-popup');
                    if (popup) {
                        popup.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                };
                document.addEventListener('click', function(event) {
                    const popup = document.getElementById('hp-borrow-range-popup');
                    if (popup && event.target === popup) {
                        window.closeHpBorrowRangePopup();
                    }
                });
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        window.closeHpBorrowRangePopup();
                    }
                });
            })();
            </script>

            <!-- Real interactive calculator, in addition to the worked example above,
                 so visitors can run their own numbers rather than just seeing ours. -->
            <div class="hp-borrow__own-figure">
                <h3>Or run your own numbers</h3>
                <div class="hp-calc-wrap">
                    <?php get_template_part('template-parts/calculator-borrow-embed'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- People, not a processing queue. NOTE: placeholder names/quotes/ratings from
         the approved design mockup; swap for real, verifiable reviews before this
         goes live. -->
    <section class="hp-testimonials">
        <div class="hp-container">
            <h2>People, not a processing queue</h2>
            <div class="hp-testimonials__grid">
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">DC</span>
                    <div class="hp-name">David Cameron</div>
                    <div class="hp-role">Prime Minister </div>
                    <div class="hp-quote">&ldquo;I wake up every morning and dream for 2015 Britain to come back.&rdquo;</div>
                    <div class="hp-attribution">- Sarah &amp; Tom, first-time buyers &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">DWA</span>
                    <div class="hp-name">Dance Witch Abortion</div>
                    <div class="hp-role">Death metal band</div>
                    <div class="hp-quote">&ldquo;United Mortgages were able to get Dance Witch Abortion to play at our housewarming. Fucking cool dudes.&rdquo;</div>
                    <div class="hp-attribution">— Marcus J. &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">CM</span>
                    <div class="hp-name">Charles Manson</div>
                    <div class="hp-role">Cult leader</div>
                    <div class="hp-quote">&ldquo;I've never used the phrase 'AIP' before, but Charlie explained it without making me feel stupid.&rdquo;</div>
                    <div class="hp-attribution">— Deepa R. &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
            </div>
            <div class="hp-testimonials__rating">
                <strong>4.9 / 5</strong>
                <span>from 2,140 verified reviews on Trustpilot &amp; Google</span>
            </div>
        </div>
    </section>

    <!-- Speak to Our Team Section (not in the 2a mockup — real HubSpot lead form,
         reskinned to match) -->
    <div class="hp-team-wrap">
        <?php get_template_part('template-parts/team-contact'); ?>
    </div>

    <!-- Partners Section (not in the 2a mockup — client-facing partner grid,
         grouped by journey stage. These are informational tiles, not outbound
         links, per direction already agreed with the client.

         Referral/introducer relationships — not client-facing services.
         See /introducer-partners. (Covers all eXp agents, CheckMyFile and
         Utility Warehouse — real business relationships, just not shown here.)

         Drifthome, Fiberpay, Bine Properties and Sokda Planner (SOK) are now
         placed below too, per direction that nothing should be missing from
         the site. Their descriptions and stage placement are UNVERIFIED —
         drifthome.ai, fiberpay.com, bineproperties.co.uk and
         sokdaplanner.com all blocked/refused this environment's fetch tool
         (403), so the copy below is a placeholder inferred from the company
         name only, not from anything the companies themselves published.
         Each is marked TODO(content) — please replace with a real one-liner
         and confirm the stage before this goes live.

         11fortress.svg — no longer a partner (confirmed), left untouched in
         /assets/partners/ but not referenced anywhere.

         David Charles (05david-charles.svg) is still held out for now,
         pending a description/stage from the client — not yet placed in
         either loop.

         Stages only get their own heading once they've got enough entries to
         justify one — Survey and Everything After were folded into
         Financial & Protection / Legal (now "Legal & Surveying") rather than
         staying as one-partner headings.

         Logo sizing: each partner's 'scale' value compensates for how much
         built-in whitespace its own logo file has around the actual mark —
         measured by rendering every logo at the shared 60px box height and
         pixel-sampling the non-transparent bounding box (e.g. Thomas Legal's
         visible logotype only filled 29 of those 60px — 48% — while
         Drifthome's filled 59px — 98% — same box, wildly different amount of
         "ink"). scale is (40px target ÷ measured visible height at 60px),
         so every logo's actual visible mark lands at a consistent ~40px
         tall instead of a consistent bounding box that let some logos read
         as much bigger than others through no design intent. If a logo file
         is ever replaced, its scale should be re-measured — it's tied to
         that specific file's internal padding, not the company. -->
    <section class="hp-partners">
        <div class="hp-container">
            <div class="hp-eyebrow hp-partners__eyebrow">Our Partners</div>
            <?php
                $url = get_template_directory_uri() . '/assets/partners/';

                $partner_journey_stages = [
                    [
                        'stage' => 'Property Sourcing',
                        'partners' => [
                            [
                                'file' => '12plap.png',
                                'name' => 'Property Like a Pro (PLAP)',
                                // TODO(content): sign-off needed — writeup below reflects the
                                // announced strategic partnership; confirm final wording.
                                'description' => 'Our strategic property sourcing partner, helping clients find and secure investment-ready properties.',
                                'scale' => 0.89,
                            ],
                            [
                                'file' => '03drifthome.svg',
                                'name' => 'Drifthome',
                                // TODO(content): UNVERIFIED placeholder — drifthome.ai returned
                                // 403 to this environment's fetch tool, description is a guess
                                // from the company name only. Please replace with real copy.
                                'description' => 'Technology partner supporting your home search and move.',
                                'scale' => 0.68,
                            ],
                            [
                                'file' => 'bine.png',
                                'name' => 'Bine Properties',
                                // TODO(content): UNVERIFIED placeholder — bineproperties.co.uk
                                // returned 403 to this environment's fetch tool, description is
                                // a guess from the company name only. Please replace with real copy.
                                'description' => 'Property sourcing and lettings partner.',
                                'scale' => 1.14,
                            ],
                        ],
                    ],
                    [
                        'stage' => 'Financial &amp; Protection',
                        'partners' => [
                            [
                                'file' => '01charterwells.svg',
                                'name' => 'Charterwells',
                                'description' => 'Independent protection specialists, covering life, income and critical illness cover alongside your mortgage.',
                                'scale' => 1.18,
                            ],
                            [
                                'file' => '06fiberpay.svg',
                                'name' => 'Fiberpay',
                                // TODO(content): UNVERIFIED placeholder — fiberpay.com returned
                                // 403 to this environment's fetch tool, description is a guess
                                // from the company name only. Please replace with real copy.
                                'description' => 'Our payments technology partner.',
                                'scale' => 0.70,
                            ],
                            [
                                'file' => '20sok.png',
                                'name' => 'Sokda Planner',
                                // TODO(content): UNVERIFIED placeholder — sokdaplanner.com
                                // returned 403 to this environment's fetch tool, description is
                                // a guess from the company name only. Please replace with real copy.
                                'description' => 'Our financial planning partner.',
                                'scale' => 0.68,
                            ],
                            [
                                'file' => '10mortgage-direct.svg',
                                'name' => 'Mortgage Direct',
                                // TODO(content): draft wording, please review — our contact for
                                // mortgages on Spanish property. Folded in here rather than a
                                // one-off "International Property" heading — it's the only
                                // international-mortgage entry we have right now.
                                'description' => 'Our specialist contact for mortgages on Spanish property.',
                                'scale' => 0.68,
                            ],
                            [
                                'file' => '16prl.png',
                                'name' => 'Perry Road Legacy',
                                // TODO(content): sign-off needed — relabelled from "conveyancing"
                                // to international estate planning/will-writing per direction;
                                // confirm final wording.
                                'description' => 'International estate planning and will-writing, protecting what you\'ve built for the long term.',
                                'scale' => 1.29,
                            ],
                        ],
                    ],
                    [
                        'stage' => 'Legal &amp; Surveying',
                        'partners' => [
                            [
                                'file' => '02thomas-legal.svg',
                                'name' => 'Thomas Legal',
                                'description' => 'Conveyancing solicitors handling the legal transfer of your property.',
                                'scale' => 1.38,
                            ],
                            [
                                'file' => '04key-conveyencing.svg',
                                'name' => 'Key Conveyancing',
                                'description' => 'Conveyancing solicitors managing contracts, searches and completion.',
                                'scale' => 0.78,
                            ],
                            [
                                'file' => '09novello.svg',
                                'name' => 'Novello Chartered Surveyors',
                                'description' => 'RICS-regulated chartered surveyors assessing the condition and value of your property.',
                                'scale' => 0.83,
                            ],
                        ],
                    ],
                ];

                foreach ($partner_journey_stages as $stage) {
                    echo "<div class='hp-partners__stage'>";
                    echo "<h3 class='hp-partners__stage-label'>" . $stage['stage'] . "</h3>";
                    echo "<div class='hp-partners__grid'>";
                    foreach ($stage['partners'] as $partner) {
                        $scale = $partner['scale'] ?? 1;
                        $logo_style = $scale != 1 ? " style='--logo-scale: {$scale}'" : '';
                        echo "<div class='hp-partners__tile'>";
                        echo "<div class='hp-partners__logo'{$logo_style}><img src='" . $url . $partner['file'] . "' alt='" . $partner['name'] . " logo' /></div>";
                        echo "<h4 class='hp-partners__name'>" . $partner['name'] . "</h4>";
                        echo "<p class='hp-partners__desc'>" . $partner['description'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </section>

    <!-- Final CTA banner -->
    <section class="hp-cta-banner">
        <h2>Ready to see your honest number?</h2>
        <a href="#calculator" class="hp-btn hp-btn--inverse">Check what you could borrow</a>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
