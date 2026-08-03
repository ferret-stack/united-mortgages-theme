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

                <div class="hp-pill">Whole of market &middot; 100+ lenders</div>

                <h1>Most mortgage advice happens 9-to-5.<br><span>Ours doesn't.</span></h1>

                <!-- DRAFT COPY — NOT FINAL, needs sign-off before this ships live -->
                <p class="hp-hero__lead">One named adviser from your first conversation through to completion — reachable evenings and weekends, not just office hours.</p>

                <div class="hp-hero__cta-row">
                    <a href="#calculator" class="hp-btn">Check what you could borrow</a>
                    <span class="hp-hero__note">Takes 3 minutes &middot; soft search, no credit impact</span>
                </div>
                <p class="hp-hero__secondary">Prefer to talk it through first? <a href="#contact-form">Request a call back</a>.</p>
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/herov4_ph.png" style="width:100%;aspect-ratio:4/3.2;object-fit:cover;border-radius:20px;">
        </div>
    </section>

    <!-- USP block -->
    <!-- DRAFT COPY — NOT FINAL, needs sign-off before this ships live -->
    <section class="hp-usp">
        <div class="hp-container hp-usp__grid">
            <div class="hp-usp__item">
                <div class="hp-usp__num">01 &middot; One adviser</div>
                <p>The same person handles your case from first enquiry to completion — not whoever's free that day.</p>
            </div>
            <div class="hp-usp__item">
                <div class="hp-usp__num">02 &middot; Real availability</div>
                <p>Reachable evenings and weekends, not just 9-to-5.</p>
            </div>
            <div class="hp-usp__item">
                <div class="hp-usp__num">03 &middot; Honest numbers</div>
                <p>Search 100+ lenders at once. We show the realistic figure first, not an "enhanced" one we'll walk back later.</p>
            </div>
        </div>
    </section>

    <!-- Our Mortgages (not in the 2a mockup — carried over from the current site's
         existing "Our Mortgages" section/copy, reskinned to match) -->
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
                <div style="text-align:right">
                    <div class="hp-label">Typical borrowing</div>
                    <div class="hp-value hp-value--lg">&pound;243,600</div>
                </div>
            </div>
            <p class="hp-borrow__example-note">Based on 4.2&times; joint income, standard affordability rules. Your actual offer depends on credit history, existing debt and each lender's own criteria — an advisor will confirm your real range before you apply.</p>

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
                    <span class="hp-testimonials__avatar">P</span>
                    <div class="hp-name">Priya Shah</div>
                    <div class="hp-role">Senior mortgage advisor</div>
                    <div class="hp-quote">&ldquo;Priya walked us through every fee before we signed anything — nothing appeared later that we hadn't already seen.&rdquo;</div>
                    <div class="hp-attribution">— Sarah &amp; Tom, first-time buyers &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">A</span>
                    <div class="hp-name">Andy Okafor</div>
                    <div class="hp-role">Remortgage specialist</div>
                    <div class="hp-quote">&ldquo;Andy messaged us two months before our fixed rate ended. We'd have missed it otherwise.&rdquo;</div>
                    <div class="hp-attribution">— Marcus J. &middot; &#9733;&#9733;&#9733;&#9733;&#9733; Verified review</div>
                </div>
                <div class="hp-testimonials__card">
                    <span class="hp-testimonials__avatar">E</span>
                    <div class="hp-name">Elly Fraser</div>
                    <div class="hp-role">First-time buyer advisor</div>
                    <div class="hp-quote">&ldquo;I've never used the phrase 'AIP' before and Elly explained it without making me feel stupid.&rdquo;</div>
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

    <!-- Partners Section (not in the 2a mockup — real partner loop, reskinned to match) -->
    <section class="hp-partners">
        <div class="hp-container">
            <div class="hp-eyebrow hp-partners__eyebrow">Our Partners</div>
            <div class="hp-partners__grid">
                <?php
                    $directory = get_template_directory() . '/assets/partners/';
                    $url = get_template_directory_uri() . '/assets/partners/';
                    $files = scandir($directory);

                    $partner_links = [
                        '01charterwells.svg' => 'https://www.charterwells.co.uk/',
                        '11fortress.svg' => 'https://2eys75.share-eu1.hsforms.com/2TSSmWsJnRJCGLQHLexp-mw',
                        '04key-conveyencing.svg' => 'https://www.keyconveyancing.co.uk/',
                        '02thomas-legal.svg' => 'https://thomaslegal.co.uk/',
                        '05david-charles.svg' => 'https://david-charles.co.uk/',
                        '03drifthome.svg' => 'https://drifthome.ai/',
                        '07mn-eXp.svg' => 'https://marknewton.exp.uk.com/',
                        '06fiberpay.svg' => 'https://fiberpay.com/',
                        '08pb-exp.png' => 'https://paulberg.exp.uk.com/',
                        '09novello.svg' => 'https://novellosurveyors.co.uk/',
                        '12plap.png' => 'https://www.propertylikeapro.co.uk/',
                        '10mortgage-direct.svg' => 'https://mortgagedirectsl.com/initial-enquiry/',
                        '13cmf.png' => 'https://www.checkmyfile.partners/GZBMKJ9/FGXLG/',
                        '14bc-exp.png' => 'https://benncolling.exp.uk.com/',
                        '15uw.png' => 'http://connectors.uw.co.uk/CN-ZM82',
                        '16prl.png' => 'https://www.perryroadlegacy.com/',
                        '17ms-exp.png' => 'https://michalsikora.exp.uk.com/',
                        '18gb-exp.png' => 'https://grantboonzaier.exp.uk.com/',
                        '19ra-exp.png' => 'https://richardaves.exp.uk.com/',
                        '20sok.png' => 'https://www.sokdaplanner.com/',
                        'bine.png' => 'https://bineproperties.co.uk/'
                    ];

                    foreach($files as $file) {
                        // Check for hidden files and only image files
                        if($file !== "." && $file !== ".." && !str_starts_with($file, '.')) {
                            $link = isset($partner_links[$file]) ? $partner_links[$file] : '#';
                            echo "<a class='hp-partners__tile' href='" . $link . "' target='_blank' rel='noopener noreferrer'>";
                            echo "<img src='" . $url . $file . "' alt='Partner logo' />";
                            echo "</a>";
                        }
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Final CTA banner -->
    <section class="hp-cta-banner">
        <h2>Ready to see your honest number?</h2>
        <a href="#calculator" class="hp-btn hp-btn--inverse">Check what you could borrow</a>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
