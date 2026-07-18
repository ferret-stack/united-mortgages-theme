<?php
/**
 * The main template file
 *
 * @package UnitedMortgages
 */
/*V3.4 — Homepage redesign: Option 2b (restrained & editorial, blue)*/
get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="hp-hero">
        <div class="hp-container">
            <div class="hp-hero__inner">
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

                <div class="hp-eyebrow">Whole&#8209;of&#8209;market &middot; 100+ lenders &middot; FCA regulated</div>

                <h1>A mortgage relationship that runs from saving to owning.</h1>

                <p class="hp-hero__lead">Most brokers treat this as one transaction. We treat it as three: the deposit, the mortgage itself, and the years of remortgaging after. One advisor, one number you can trust, at each stage.</p>

                <div class="hp-hero__cta-row">
                    <a href="#calculator" class="hp-btn">Check what you could borrow</a>
                    <span class="hp-hero__note">3 minutes &middot; soft search only</span>
                </div>
                <p class="hp-hero__secondary">Prefer to talk it through first? <a href="#contact-form">Request a call back</a>.</p>
            </div>
        </div>
    </section>

    <!-- USP block -->
    <section class="hp-usp">
        <div class="hp-usp__grid">
            <div class="hp-usp__item">
                <div class="hp-usp__num">I. Save</div>
                <p>Deposit planning that counts only what lenders will actually accept.</p>
            </div>
            <div class="hp-usp__item">
                <div class="hp-usp__num">II. Borrow</div>
                <p>The realistic borrowing figure, shown first — not an inflated one we later withdraw.</p>
            </div>
            <div class="hp-usp__item">
                <div class="hp-usp__num">III. Own</div>
                <p>Your remortgage date, tracked and flagged well ahead of the lender's standard rate.</p>
            </div>
        </div>
    </section>

    <!-- Our Mortgages -->
    <section class="hp-mortgages-wrap">
        <div class="hp-container">
            <div class="hp-head">
                <h2>Our Mortgages</h2>
                <p>Find and apply for the right mortgage with our expert support. Whether you're buying your first home or planning your next move, it all starts here.</p>
            </div>
            <?php get_template_part('template-parts/mortgage-type-grid'); ?>
        </div>
    </section>

    <!-- Run the Numbers - Calculator Section -->
    <!-- Desktop: Embedded borrow calculator | Mobile: CTA card linking to /calculators#borrow -->
    <div class="hp-calc-wrap">
        <?php get_template_part('template-parts/calculator-borrow-embed'); ?>
    </div>

    <!-- On the record — testimonials. NOTE: placeholder names/quotes/ratings from the
         approved design mockup; swap for real, verifiable reviews before this goes live. -->
    <section class="hp-testimonials">
        <div class="hp-container">
            <h2>On the record</h2>
            <div class="hp-testimonials__grid">
                <div class="hp-testimonials__card">
                    <p>&ldquo;Every fee was on the table before we signed. Priya didn't wait for us to ask.&rdquo;</p>
                    <div class="hp-testimonials__who">
                        <span class="hp-testimonials__avatar">P</span>
                        <span>Sarah &amp; Tom &middot; Priya Shah, advisor</span>
                    </div>
                </div>
                <div class="hp-testimonials__card">
                    <p>&ldquo;Andy flagged our remortgage two months out. We'd have missed it otherwise.&rdquo;</p>
                    <div class="hp-testimonials__who">
                        <span class="hp-testimonials__avatar">A</span>
                        <span>Marcus J. &middot; Andy Okafor, advisor</span>
                    </div>
                </div>
                <div class="hp-testimonials__card">
                    <p>&ldquo;Elly explained AIP and LTV without a hint of condescension.&rdquo;</p>
                    <div class="hp-testimonials__who">
                        <span class="hp-testimonials__avatar">E</span>
                        <span>Deepa R. &middot; Elly Fraser, advisor</span>
                    </div>
                </div>
            </div>
            <div class="hp-testimonials__rating"><strong>4.9 / 5</strong> — 2,140 verified reviews, Trustpilot &amp; Google</div>
        </div>
    </section>

    <!-- Speak to Our Team Section -->
    <div class="hp-team-wrap">
        <?php get_template_part('template-parts/team-contact'); ?>
    </div>

    <!-- Partners Section -->
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
        <h2>See your honest borrowing figure</h2>
        <a href="#calculator" class="hp-btn hp-btn--inverse">Check what you could borrow</a>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
