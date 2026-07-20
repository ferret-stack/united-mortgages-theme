<?php
/**
 * Template Name: Our Story
 */
get_header(); ?>

<main id="primary" class="site-main">

    <!-- Our Story Hero Section -->
    <section class="um-story-hero">
        <div class="um-story-hero__overlay"></div>
        <div class="hp-container">
            <div class="um-story-hero__content">
                <h1 class="um-story-hero__title">The Mortgage Process Is Broken.<br><strong>We're here to fix it.</strong></h1>

                <div class="um-story-hero__text">
                    <p>Founded by David Woodford and Daniel Oakey, United Mortgages&reg; was built with a clear mission: to revolutionise the mortgage process and put their clients first.<br>No theatre. No fluff. Just a faster, cleaner way to help you secure your dream home.</p>
                    <p>Welcome to the future of mortgages</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Founding Team Section -->
    <section id="founders" class="um-founders">
        <div class="hp-container">
            <div class="um-section-header">
                <h2 class="um-section-title">Our <span class="bold-text">Founding Team</span></h2>
                <p class="um-section-subtitle">Meet the changemakers responsible for leading the United Mortgages&reg; mission</p>
            </div>

            <div class="um-founders-grid">
                <!-- David -->
                <div class="um-founder-card">
                    <div class="um-founder-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/david-bw.png?v=3" alt="David Woodford" class="um-founder-image um-founder-image--bw">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/david-col.png" alt="David Woodford" class="um-founder-image um-founder-image--color">
                    </div>
                    <div class="um-founder-header">
                        <h3 class="um-founder-name">DAVID WOODFORD <a href="https://www.linkedin.com/in/davidwoodforduk" target="_blank" class="um-founder-link">in</a><a href="mailto:david@united-mortgages.com" class="um-founder-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/advisor-mail.svg" alt="Email"></a></h3>
                        <p class="um-founder-title">Chief Executive Officer<span class="postnom"> &middot; CeMAP</span></p>
                    </div>
                    <div class="um-founder-bio">
                        <p>Co-Founder and Chief Executive Officer of United Mortgages&reg;  with responsibility for overall leadership, GTM, and strategy, in addition to adeptly leading the firm's commercial advisory operations.</p>
                        <p>Before co-founding United, he held management roles at two Fortune 500 firms (Renault Group and Geely), and later helped scale Deloitte Fast 50 and Fast 500 recipients, Hypervolt, where he built enterprise and partnership channels with a relentless focus on the customer journey. </p>
                        <p>An alumnus of Edinburgh Business School, David's energetic leadership, and relentless focus on the customer experience enables him to build and scale high-performance teams, and mutually profitable partnerships.</p>
                    </div>
                </div>

                <!-- Daniel -->
                <div class="um-founder-card">
                    <div class="um-founder-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/daniel-bw.png?v=2" alt="Daniel Oakey" class="um-founder-image um-founder-image--bw">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/daniel-col.png" alt="Daniel Oakey" class="um-founder-image um-founder-image--color">
                    </div>
                    <div class="um-founder-header">
                        <h3 class="um-founder-name">DANIEL OAKEY <a href="https://www.linkedin.com/in/boolean-daniel" target="_blank" class="um-founder-link">in</a></h3>
                        <p class="um-founder-title">Chief Technical Officer</p>
                    </div>
                    <div class="um-founder-bio">
                        <p>Co-founder and Chief Technical Officer, Daniel leads the engineering, build, and implementation of our suite of proprietary software.</p>
                        <p>With a Master's in Economics and Finance from King's College London and a Bachelor's in Philosophy, Politics &amp; Economics, Daniel views software development as much an art as a science and combines deep financial industry knowledge with technical expertise.</p>
                        <p>His experience spans algorithmic systems development, full-stack web engineering, and five years in finance, bringing a unique perspective to mortgage technology that treats every line of code as both a technical solution and a bet on better outcomes for our clients.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Who We Help -->
    <section class="um-who-we-help">
        <div class="hp-container">
            <div class="um-section-header">
                <h2 class="um-section-title">Who We <span class="bold-text">Help</span></h2>
                <p class="um-section-subtitle">We work with ambitious professionals, entrepreneurs, and families across London and the Home Counties <span class="strong">who refuse to accept that mortgages have to be complicated</span>.<br><br>We don't just arrange mortgages; we build relationships with people who value clarity, speed, and expertise.</p>
            </div>

            <div class="mortgage-services-grid">
                <!-- First Time Buyers -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/first-time-buyers.svg" alt="First Time Buyers">
                    </div>
                    <h3>FIRST TIME BUYERS</h3>
                    <p>Taking your first step onto the property ladder shouldn't feel like decoding
                    ancient hieroglyphics. We translate the jargon, explain what actually matters,
                    and make sure you're equipped with a mortgage that sets you up for success - not
                    just approval.</p>
                    <a href="<?php echo home_url('/first-time-buyers'); ?>" class="btn-service">I'M A FIRST TIME BUYER</a>
                </div>

                <!-- Moving Home -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/moving-home.svg" alt="Moving Home">
                    </div>
                    <h3>MOVING HOME</h3>
                    <p>Outgrowing your flat? Ready for that extra bedroom or garden? We help you
                    navigate the remortgage-or-port decision, find better rates, and move without
                    the mortgage becoming the stressful part of the process.</p>
                    <a href="<?php echo home_url('/moving-home'); ?>" class="btn-service">I'M MOVING HOME</a>
                </div>

                <!-- Remortgaging -->
                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/remortgaging.svg" alt="Remortgaging">
                    </div>
                    <h3>REMORTGAGING</h3>
                    <p>Your fixed rate is ending and you're facing a payment jump. Or maybe your
                    property's increased in value and you want to release equity. Either way, we'll
                    find you a better deal than your current lender's retention offer.</p>
                    <a href="<?php echo home_url('/remortgaging'); ?>" class="btn-service">I'M REMORTGAGING</a>
                </div>

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/self-employed.svg" alt="Entrepreneurs, Founders, and Self-Employed">
                    </div>
                    <h3>Entrepreneurs, Founders, and Self-Employed</h3>
                    <p>Traditional lenders don't understand your business model. We do. Whether you're
                    a contractor on day rates, a director taking dividends, or a founder with equity
                    compensation, we know how to present your income in a way that gets you approved.</p>
                    <a href="<?php echo home_url('/efse'); ?>" class="btn-service">I'M SELF EMPLOYED</a>
                </div>

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/handshake.svg" alt="Expats">
                    </div>
                    <h3>EXPATS</h3>
                    <p>You've put in the miles, and we'll go the distance. A mortgage in the UK shouldn't feel out of reach; we understand which lenders offer expat mortgages and their expat mortgage criteria</p>
                    <a href="<?php echo home_url('/expats'); ?>" class="btn-service">I'M AN EXPAT</a>
                </div>

                <div class="mortgage-service-card">
                    <div class="service-icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/other-mortgages.svg" alt="BtL Investors">
                    </div>
                    <h3>Buy-to-Let Investors</h3>
                    <p>Building a property portfolio requires lenders who understand rental yields,
                    stress tests, and portfolio strategies. We work with specialist BTL lenders
                    who see investment properties as business assets, not consumer purchases.</p>
                    <a href="<?php echo home_url('/buy-to-let'); ?>" class="btn-service">I'M AN INVESTOR</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Advisory Board Section -->
    <section class="um-founders um-founders--advisory">
        <div class="hp-container">
            <div class="um-section-header">
                <h2 class="um-section-title">Our <span class="bold-text">Team</span></h2>
                <p class="um-section-subtitle">Bringing together visionary strategists dedicated to shaping the future of home financing</p>
            </div>

            <div class="um-founders-grid um-founders-grid--advisory">
                <!-- Mike -->
                <div class="um-founder-card">
                    <div class="um-founder-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/mike-bw.png" alt="Mike Buttigieg" class="um-founder-image um-founder-image--bw">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/mike-col.png" alt="Mike Buttigieg" class="um-founder-image um-founder-image--color">
                    </div>
                    <div class="um-founder-header">
                        <h3 class="um-founder-name">MIKE BUTTIGIEG<a href="https://www.linkedin.com/in/michaelbuttigieg/" target="_blank" class="um-founder-link">in</a><a href="mailto:mike@united-mortgages.com" class="um-founder-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/advisor-mail.svg" alt="Email"></a></h3>
                        <p class="um-founder-title">Senior Mortgage Advisor<span class="postnom"> &middot; CeMAP</span></p>
                    </div>
                    <div class="um-founder-bio">
                        <p>Having qualified as a Mortgage Consultant after years of hands-on experience developing property projects, he understands both the financial and real-world considerations involved in buying, investing and building wealth through property.</p>
                        <p>Before moving into financial services, Mike built and led businesses, opened international markets and generated multi-million-pound revenue growth through strategic partnerships and commercial leadership.</p>
                    </div>
                </div>

                <!-- Muki -->
                <div class="um-founder-card">
                    <div class="um-founder-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/muki-bw.png" alt="Muki Liu" class="um-founder-image um-founder-image--bw">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/muki-col.png" alt="Muki Liu" class="um-founder-image um-founder-image--color">
                    </div>
                    <div class="um-founder-header">
                        <h3 class="um-founder-name">MUKI LIU <a href="https://www.linkedin.com/in/muki-liu-844444193" target="_blank" class="um-founder-link">in</a></h3>
                        <p class="um-founder-title">Technical Advisor<span class="postnom"> &middot; CeMAP</span></p>
                    </div>
                    <div class="um-founder-bio">
                        <p>Muki built her career in communications across the green energy sector, working with Evident, Drax Group, and National Grid.</p>
                        <p>Educated at Beijing International Studies University and the University of Edinburgh, Muki embraces diverse voices and believes in the power of listening: communication comes after understanding what is truly desired.</p>
                        <p>As Technical Advisor at United Mortgages&reg;, she creatively leads the firm's marketing and communications strategy.</p>
                    </div>
                </div>

                <!-- DeAndre -->
                <div class="um-founder-card">
                    <div class="um-founder-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/deandre-bw.png" alt="DeAndre Bruce" class="um-founder-image um-founder-image--bw">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/deandre-col.png" alt="DeAndre Bruce" class="um-founder-image um-founder-image--color">
                    </div>
                    <div class="um-founder-header">
                        <h3 class="um-founder-name">DEANDRE BRUCE<a href="https://www.linkedin.com/in/deandregoocho/" target="_blank" class="um-founder-link">in</a></h3>
                        <p class="um-founder-title">Board Advisor<span class="postnom"> &middot; CeMAP CeRER</span></p>
                    </div>
                    <div class="um-founder-bio">
                        <p>As the founder of GooCho Mortgages, DeAndre brings over a decade of industry expertise and has successfully guided over 500 clients through the complexities of the UK property market.</p>
                        <p>As an advisor to the board, DeAndre leverages his deep understanding of the buyer's journey to champion United Mortgages&reg; A+ service and ethical lending. His advisory focus centres on creating inclusive and tailor-made strategies that streamline the mortgage process.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Integrity Charter Section -->
    <section class="um-charter">
        <div class="um-charter__overlay"></div>
        <div class="hp-container">
            <div class="um-charter__content">
                <h2 class="um-charter__title">The <span class="bold-text">Integrity Charter</span></h2>

                <p class="um-charter__intro">
                    In line with our overarching mission to become Britain's most trusted team of mortgage advisors, we commit to upholding the highest standards of integrity, professionalism, and ethical conduct in all our interactions with clients, lenders, and partners.
                </p>

                <p class="um-charter__purpose">
                    Our purpose is to guide clients through the mortgage process with clarity, transparency, and honesty, ensuring that their financial decisions align with their best interests and long term goals.
                </p>

                <div class="um-charter__signatures">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/david-sig.png" alt="David Woodford Signature" class="um-charter__signature">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/daniel-sig.png" alt="Daniel Oakey Signature" class="um-charter__signature">
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
