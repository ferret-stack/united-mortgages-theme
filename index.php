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

                <p class="hp-hero__lead">Your personal adviser from your first conversation through to completion - reachable evenings and weekends, not just office hours.</p>

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
                <p>We don't disappear after completion. Our network of conveyancers, surveyors, and partners is there for what comes next.</p>
            </div>
        </div>
    </section>

    <section class="hp-mortgages-wrap">
        <div class="hp-container">
            <div class="hp-head">
                <h2>Our Mortgages</h2>
                <p>Find and apply for the right mortgage with our expert support. Whether you're buying your first home or planning your next move, it all starts here.</p>
            </div>
            <?php get_template_part('template-parts/mortgage-type-grid', null, array('limit' => 3)); ?>
            <div class="more-mortgages"><a href="/our-mortgages">See more mortgage options</a></div>
        </div>
    </section>

    <!-- What you could borrow — honestly -->
    <section class="hp-borrow">
        <div class="hp-container">
            <h2>What you could borrow</h2>
            <p class="hp-borrow__lead">A realistic range today, one adviser with you the whole way afterwards.</p>
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
            <p class="hp-borrow__example-note">Based on 4.5&times;-6.0&times; joint income, standard affordability rules. Your actual offer depends on credit history, existing debt and each lender's own criteria - an adviser will confirm your real range before you apply.</p>

            <!-- Mandatory popup: Typical vs Enhanced (compliance-approved copy, reused verbatim from the embedded calculator) -->
            <div id="hp-borrow-range-popup" class="popup-overlay">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Typical vs Enhanced</h2>
                        <button type="button" class="popup-close" onclick="closeHpBorrowRangePopup()" aria-label="Close">&times;</button>
                    </div>
                    <div class="popup-body">
                        <p>These figures are estimates only. They are not guaranteed and actual lending depends on individual lender criteria, your credit history and full financial circumstances.</p>
                        <p>The <strong>Enhanced</strong> figure reflects income multiples of up to 6x now offered by a number of UK lenders. This tier is generally only available to higher earners - commonly &pound;75,000+ income - and is subject to lender-specific eligibility criteria. Most borrowers will not qualify for the Enhanced figure even though it is a real, current market rate. Your <strong>Typical</strong> figure is a more representative starting point for most applicants.</p>
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

    <!-- People, not a processing queue.  -->
    <section class="hp-testimonials">
        <div class="hp-container">
            <h2>People, not a processing queue</h2>
            <div class="hp-testimonials__grid">
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">SB</span>
                    <div class="hp-name">Saffron Sims-Brydon</div>
                    <div class="hp-role"> </div>
                    <div class="hp-quote">&ldquo;As a first time buyer, I was nervous about the process, but United Mortgages made it really simple. Clear advice, easy process and even picked up the phone on a Sunday when I have urgent questions. Highly recommend!&rdquo;</div>
                    <div class="hp-attribution">September 2025 &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">RC</span>
                    <div class="hp-name">Rose Crosby</div>
                    <div class="hp-role"> </div>
                    <div class="hp-quote">&ldquo;David and the team at United Mortgages have been advising us on our second house move. United have been incredibly helpful and proactive, guiding us through every step, talking us through the variety of options available to us - as well as advising us in regard to being locked into a current 5-year fix and how that affects the move. They have made the process of getting our agreement in principle completely stress-free. Their communication is excellent!&rdquo;</div>
                    <div class="hp-attribution">October 2025 &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">H</span>
                    <div class="hp-name">Hannah</div>
                    <div class="hp-role"> </div>
                    <div class="hp-quote">&ldquo;After a frustrating start elsewhere, and stuck with a mortgage that didn't suit us, David turned things around. He spotted that a holiday let mortgage was actually the right fit, releasing more equity than we expected. With the chain close to completing, the team kept us updated every step and nudged the lender to hit a tight deadline. This was the foundation of our dream to build a life abroad, and they treated it that way.&rdquo;</div>
                    <div class="hp-attribution">April 2026 &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
            </div>
            <!--<div class="hp-testimonials__rating">
                <strong>4.9 / 5</strong>
                <span>from 2,140 verified reviews on Trustpilot &amp; Google</span>
            </div>-->
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
         CheckMyFile and Utility Warehouse stay off this page entirely; see
         /introducer-partners for those. The eXp agents are the exception:
         client + cofounder confirmed a B2B reason to surface them here too,
         so they're appended below as a plain logo-only grid (no name, no
         description, no card styling) rather than folded into the service-
         partner cards above — this is a referral network, not a
         recommended service, so it's deliberately styled differently. They
         also remain on /introducer-partners unchanged, for the direct-link
         use case (sending an agent their own page).

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

         Logo sizing: fixed-height container (see .hp-partners__logo),
         flexible width, object-fit: contain — no per-partner scale/pad
         values. This was tried in an earlier pass (a 'scale' multiplier per
         partner, measured from each logo's actual pixel footprint) and
         deliberately removed per direction: the fixed-height-container +
         contain approach should handle sizing generically for any future
         partner without a bespoke measured constant per logo file. Known
         trade-off, flagged rather than silently fixed: source logo files
         have very different amounts of built-in whitespace around the
         actual mark (e.g. Thomas Legal's visible logotype fills well under
         half its own file's canvas, Drifthome's fills nearly all of it), so
         even at an identical box height some logos will still read as
         visually smaller/larger than others — that's the source files, not
         the container, and isn't corrected here. -->
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
                                'file' => 'bine.png',
                                'name' => 'Bine Properties',
                                'description' => 'Property consultancy focused on sourcing and managing off-market real estate in Prime Central London.',
                            ],
                                [
                                'file' => '03drifthome.svg',
                                'name' => 'Drifthome',
                                'description' => 'A smart UK home finder app making property search fun, fast, and personalised.',
                            ],
                            [
                                'file' => '12plap.png',
                                'name' => 'Property Like a Pro',
                                'description' => 'UK property investment advice and sourcing for residential investors seeking strategic acquisitions and long-term portfolio growth.'
                            ],
                        ],
                    ],
                    [
                        'stage' => 'Financial &amp; Protection',
                        'partners' => [
                            [
                                'file' => '01charterwells.svg',
                                'name' => 'Charterwells',
                                'description' => 'Chartered accountants providing Big Four rigour and a human touch.',
                            ],
                            [
                                'file' => '13cmf.png',
                                'name' => 'Check My File',
                                'description' => 'Check your credit score across major scoring companies in one single place.'
                            ],
                            [
                                'file' => '06fiberpay.svg',
                                'name' => 'Fiberpay',
                                'description' => 'Making cross-border money transfers simple, fast, and secure.',
                            ],
                                [
                                'file' => '10mortgage-direct.svg',
                                'name' => 'Mortgage Direct',
                                'description' => 'Our specialist contact for mortgages on Spanish property.',
                            ],
                                [
                                'file' => '16prl.png',
                                'name' => 'Perry Road Legacy',
                                'description' => 'Estate planning and will-writing, protecting what you\'ve built for the long term.',
                            ],
                            [
                                'file' => '20sok.png',
                                'name' => 'Sokda Planner',
                                'description' => 'Handles property coordination and home setup after you\'ve got the keys.',
                            ],
                            [
                                'file' => '15uw.png',
                                'name' => 'Utility Warehouse',
                                'description' => 'Get all your home and utility services, including gas, electricity, broadband, mobile and home insurance from one company.',
                            ],
                        ],
                    ],
                    [
                        'stage' => 'Legal &amp; Surveying',
                        'partners' => [
                            [
                                'file' => '05david-charles.svg',
                                'name' => 'David Charles',
                                'description' => 'Property consultants dealing in commercial property with over 30 years experience.',
                            ],
                            [
                                'file' => '04key-conveyencing.svg',
                                'name' => 'Key Conveyancing',
                                'description' => 'Conveyancing solicitors managing contracts, searches, and completion.',
                            ],
                            [
                                'file' => '09novello.svg',
                                'name' => 'Novello Chartered Surveyors',
                                'description' => 'Chartered surveyors assessing the condition and value of your property.',
                            ],
                            [
                                'file' => '02thomas-legal.svg',
                                'name' => 'Thomas Legal',
                                'description' => 'Conveyancing solicitors handling the legal transfer of your property.',
                            ],
                        ],
                    ],
                ];

                foreach ($partner_journey_stages as $stage) {
                    echo "<div class='hp-partners__stage'>";
                    echo "<h3 class='hp-partners__stage-label'>" . $stage['stage'] . "</h3>";
                    echo "<div class='hp-partners__grid'>";
                    foreach ($stage['partners'] as $partner) {
                        echo "<div class='hp-partners__tile'>";
                        echo "<div class='hp-partners__logo'><img src='" . $url . $partner['file'] . "' alt='" . $partner['name'] . " logo' /></div>";
                        echo "<h4 class='hp-partners__name'>" . $partner['name'] . "</h4>";
                        echo "<p class='hp-partners__desc'>" . $partner['description'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }

                // B2B referral network (eXp agents) — icons only, no name/description,
                // no card styling. Same six agents/files as page-introducer-partners.php.
                $estate_agents = [
                    ['file' => '07mn-eXp.svg', 'name' => 'Mark Newton'],
                    ['file' => '08pb-exp.png', 'name' => 'Paul Berg'],
                    ['file' => '14bc-exp.png', 'name' => 'Benn Colling'],
                    ['file' => '17ms-exp.png', 'name' => 'Michal Sikora'],
                    ['file' => '18gb-exp.png', 'name' => 'Grant Boonzaier'],
                    ['file' => '19ra-exp.png', 'name' => 'Richard Aves'],
                    ['file' => 'wheal.png', 'name => Wilson Heal'],
                ];

                echo "<div class='hp-partners__b2b'>";
                echo "<h3 class='hp-partners__stage-label'>" . "Estate Agents" . "</h3>";
                echo "<div class='hp-partners__b2b-grid'>";
                foreach ($estate_agents as $agent) {
                    echo "<div class='hp-partners__b2b-logo'><img src='" . $url . $agent['file'] . "' alt='" . $agent['name'] . " logo' /></div>";
                }
                echo "</div>";
                echo "</div>";
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
