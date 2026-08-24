<?php
/**
 * The main template file
 *
 * @package UnitedMortgages
 */
/*V4 — Homepage redesign: Option 2a (warm & balanced, blue)*/
get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="hp-hero">
        <div class="hp-container hp-hero__grid">
            <div>
                <div class="review-widgets-container hp-hero__reviews">
                    <div class="trustpilot-widget">
                        <a href="https://uk.trustpilot.com/review/united-mortgages.com" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/trustpilot-blue.svg"
                                alt="Trustpilot Rating"
                                class="trustpilot-image">
                        </a>
                    </div>
                    <div class="bark-widget">
                        <a href="https://share.google/lrCoqIgJxYIiv6Biu" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/google-blue.svg"
                                alt="Google Reviews"
                                class="bark-image">
                        </a>
                    </div>
                </div>

               <h1>One adviser. Every chapter.<br><span>United together.</span></h1>

<p class="hp-hero__lead">Your personal adviser, with you as your story unfolds.</p>

                <div class="hp-hero__cta-row">
                    <a href="/aip-form" class="hp-btn">Start your AIP</a>
                    <span class="hp-hero__note">Takes 3 minutes &middot; soft search, no credit impact</span>
                </div>
                <p class="hp-hero__secondary">Prefer to talk it through first? <a href="https://calendly.com/unitedmortgages/15min">Book a time to chat with us</a>.</p>
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/hero-v2.png" style="width:130%; height:80%; margin-top:120px; aspect-ratio:4/3.2;object-fit:cover;border-radius:20px;">
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
            <div style="text-align:center; transform: translateY(25px);"><a class="more-mortgages" href="/our-mortgages">See more mortgage options</a></div>
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
                <span class="hp-testimonials__avatar">JA</span>
                <div class="hp-name">JA</div>
                <div class="hp-role"> </div>
                <div class="hp-quote">&ldquo;United has been very helpful and knowledgeable in advising my fiance and I around contractor mortgages and a situation involving multiple income streams.&rdquo;</div>
                <div class="hp-attribution">June 2026 &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
            </div>
            <div class="hp-testimonials__card">
                <span class="hp-testimonials__avatar">H</span>
                <div class="hp-name">Hannah</div>
                <div class="hp-role"> </div>
                <div class="hp-quote">&ldquo;After a frustrating start elsewhere, and stuck with a mortgage that didn't suit us, David turned things around. He spotted that a holiday let mortgage was actually the right fit, releasing more equity than we expected&hellip; This was the foundation of our dream to build a life abroad, and they treated it that way.&rdquo;</div>
                <div class="hp-attribution">April 2026 &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
            </div>
            <div class="hp-testimonials__card">
                <span class="hp-testimonials__avatar">RC</span>
                <div class="hp-name">Rose Crosby</div>
                <div class="hp-role"> </div>
                <div class="hp-quote">&ldquo;United Mortgages have been advising us on our second house move. United have been incredibly helpful and proactive, guiding us through every step&hellip; They have made the process of getting our agreement in principle completely stress-free. Their communication is excellent!&rdquo;</div>
                <div class="hp-attribution">October 2025 &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
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

    <!-- Partners -->
    <section class="hp-partners">
        <div class="hp-container">
            <div class="hp-eyebrow hp-partners__eyebrow">Our Partners</div>
            <?php
                $url = get_template_directory_uri() . '/assets/partners/';

                // Every partner link carries rel="sponsored" by default: there's a
                // commission relationship behind all of them (confirmed), and
                // Google's `sponsored` rel is about that paid/compensated
                // relationship, not which way referrals flow. See the render loops
                // below — rel is applied uniformly, no per-entry flag needed.
                $partner_journey_stages = [
                    [
                        'stage' => 'Property Sourcing',
                        'partners' => [
                            [
                                'file' => 'bine.png',
                                'name' => 'Bine Properties',
                                'description' => 'Property consultancy focused on sourcing and managing off-market real estate in Prime Central London.',
                                'url' => 'https://bineproperties.co.uk/',
                            ],
                                [
                                'file' => '03drifthome.svg',
                                'name' => 'Drifthome',
                                'description' => 'A smart UK home finder app making property search fun, fast, and personalised.',
                                'url' => 'https://drifthome.ai/',
                            ],
                            [
                                'file' => '12plap.png',
                                'name' => 'Property Like a Pro',
                                'description' => 'UK property investment advice and sourcing for residential investors seeking strategic acquisitions and long-term portfolio growth.',
                                'url' => 'https://www.propertylikeapro.co.uk/',
                            ],
                            [
                                'file' => '20sok.png',
                                'name' => 'Sokda Planner',
                                'description' => 'Handles property coordination and home setup after you\'ve got the keys.',
                                'url' => '#', // TODO(content): URL not confirmed for Sokda Planner
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
                                'url' => 'https://www.charterwells.co.uk/',
                            ],
                            [
                                'file' => '13cmf.png',
                                'name' => 'Check My File',
                                'description' => 'Check your credit score across major scoring companies in one single place.',
                                'url' => 'https://www.checkmyfile.partners/GZBMKJ9/FGXLG/',
                            ],
                            [
                                'file' => '06fiberpay.svg',
                                'name' => 'Fiberpay',
                                'description' => 'Making cross-border money transfers simple, fast, and secure.',
                                'url' => 'https://fiberpay.com/',
                            ],
                                [
                                'file' => '10mortgage-direct.svg',
                                'name' => 'Mortgage Direct',
                                'description' => 'Our specialist contact for mortgages on Spanish property.',
                                'url' => 'https://mortgagedirectsl.com/initial-enquiry/',
                            ],
                                [
                                'file' => '16prl.png',
                                'name' => 'Perry Road Legacy',
                                'description' => 'Estate planning and will-writing, protecting what you\'ve built for the long term.',
                                'url' => 'https://www.perryroadlegacy.com/',
                            ],
                            [
                                'file' => '15uw.png',
                                'name' => 'Utility Warehouse',
                                'description' => 'Get all your home and utility services, including gas, electricity, broadband, mobile and home insurance from one company.',
                                'url' => 'http://connectors.uw.co.uk/CN-ZM82',
                            ],
                        ],
                    ],
                    [
                        'stage' => 'Legal &amp; Surveying',
                        'partners' => [
                            [
                                'file' => '04key-conveyencing.svg',
                                'name' => 'Key Conveyancing',
                                'description' => 'Conveyancing solicitors managing contracts, searches, and completion.',
                                'url' => 'https://www.keyconveyancing.co.uk/',
                            ],
                            [
                                'file' => '09novello.svg',
                                'name' => 'Novello Chartered Surveyors',
                                'description' => 'Chartered surveyors assessing the condition and value of your property.',
                                'url' => 'https://novellosurveyors.co.uk/',
                            ],
                            [
                                'file' => '02thomas-legal.svg',
                                'name' => 'Thomas Legal',
                                'description' => 'Conveyancing solicitors handling the legal transfer of your property.',
                                'url' => 'https://thomaslegal.co.uk/',
                            ],
                            [
                                'file' => 'YouConvey.png',
                                'name' => 'YouConvey',
                                'description' => 'Guiding you through the home buying journey, minimising stress and reducing moving times by up to 8 weeks',
                                'url' => 'https://you-convey.co.uk/',
                            ],  
                        ],
                    ],
                ];

                foreach ($partner_journey_stages as $stage) {
                    echo "<div class='hp-partners__stage'>";
                    echo "<h3 class='hp-partners__stage-label'>" . $stage['stage'] . "</h3>";
                    echo "<div class='hp-partners__grid'>";
                    foreach ($stage['partners'] as $partner) {
                        echo "<a class='hp-partners__tile' href='" . esc_url($partner['url']) . "' target='_blank' rel='noopener noreferrer sponsored'>";
                        echo "<div class='hp-partners__logo'><img src='" . $url . $partner['file'] . "' alt='" . $partner['name'] . " logo' /></div>";
                        echo "<h4 class='hp-partners__name'>" . $partner['name'] . "</h4>";
                        echo "<p class='hp-partners__desc'>" . $partner['description'] . "</p>";
                        echo "</a>";
                    }
                    echo "</div>";
                    // TODO(content): fee/commission disclosure copy for this B2C tier is
                    // not yet confirmed — placeholder only, no visible text added here.
                    // Wording to go here (near the B2C grid only) once confirmed.
                    echo "</div>";
                }

                // B2B referral network. The eXp agents are one network under one
                // brand, so they get a single eXp wordmark as a group label rather
                // than the same eXp logo repeated once per agent (five/six repeats
                // of the identical mark read as a placeholder/stock image to
                // visitors unfamiliar with eXp). Agent names are listed underneath
                // as plain live links — all visible on load, no accordion/expand.
                // Same default-sponsored rel as the B2C tier above.
                $exp_agents = [
                    ['name' => 'Richard Aves', 'url' => 'https://richardaves.exp.uk.com/'],
                    ['name' => 'Paul Berg', 'url' => 'https://paulberg.exp.uk.com/'],
                    ['name' => 'Grant Boonzaier', 'url' => 'https://grantboonzaier.exp.uk.com/'],
                    ['name' => 'Benn Colling', 'url' => 'https://benncolling.exp.uk.com/'],
                    ['name' => 'Mark Newton', 'url' => 'https://marknewton.exp.uk.com/'],
                    ['name' => 'Michal Sikora', 'url' => 'https://michalsikora.exp.uk.com/'],                    
                ];

                $iad_agents = [
                    ['name' => 'Stuart Aimer', 'url' => 'https://www.iad.uk.com/staff/stuart-aimer'],
                    ['name' => 'Robert Roze', 'url' => 'https://www.iad.uk.com/staff/robert-roze'],
                ];

                // Not eXp — kept in the original per-agent logo tile treatment,
                // untouched by the eXp consolidation above.
                $other_estate_agents = [
                    ['file' => 'wheal.png?v=2', 'name' => 'Wilson Heal', 'url' => 'https://www.wilsonheal.co.uk/'],
                    ['file' => '05david-charles.svg?v=2', 'name' => 'David Charles', 'url' => 'https://davidcharles.co.uk/'],
                ];

                echo "<div class='hp-partners__b2b'>";
                echo "<h3 class='hp-partners__stage-label'>" . "Estate Agents" . "</h3>";

                // Wilson Heal / David Charles lead the section — distinct branded
                // logos of their own, not part of the eXp network — so they're
                // shown first to avoid any visual ambiguity that they might be
                // eXp-affiliated before the eXp group appears below.
                echo "<div class='hp-partners__b2b-grid'>";
                foreach ($other_estate_agents as $agent) {
                    echo "<a class='hp-partners__b2b-logo' href='" . esc_url($agent['url']) . "' target='_blank' rel='noopener noreferrer sponsored'><img src='" . $url . $agent['file'] . "' alt='" . $agent['name'] . " logo' /></a>";
                }
                echo "</div>";

                echo "<div class='hp-partners__b2b-exp'>";
                echo "<div class='hp-partners__b2b-exp-logo'>eXp agents</div>";
                echo "<div class='hp-partners__b2b-exp-names'>";
                foreach ($exp_agents as $agent) {
                    echo "<a class='hp-partners__b2b-exp-name' href='" . esc_url($agent['url']) . "' target='_blank' rel='noopener noreferrer sponsored'>" . $agent['name'] . "</a>";
                }
                echo "</div>";
                                echo "<div class='hp-partners__b2b-exp'>";
                echo "<div class='hp-partners__b2b-exp-logo'>IAD agents</div>";
                echo "<div class='hp-partners__b2b-exp-names'>";
                foreach ($iad_agents as $agent) {
                    echo "<a class='hp-partners__b2b-exp-name' href='" . esc_url($agent['url']) . "' target='_blank' rel='noopener noreferrer sponsored'>" . $agent['name'] . "</a>";
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
