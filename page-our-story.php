<?php
/**
 * Template Name: Our Story
 */
get_header(); ?>

<main id="primary" class="site-main">
    
    <!-- Our Story Hero Section -->
    <section class="story-hero">
        <div class="story-hero-overlay"></div>
        <div class="container">
            <div class="story-hero-content">
                <h1 class="story-hero-title">The Mortgage Process Is Broken.<br><span style="font-weight:600;">We're here to fix it.</span></h1>
                
                <div class="story-hero-text">
                    <p>Founded by David Woodford and Daniel Holloway, United Mortgages&reg; was built with a clear mission: to revolutionise the mortgage process and put their clients first. No theatre. No fluff. Just a faster, cleaner way to help you secure your dream home.</p>
                    <p style="font-weight:600;">Welcome to the future of mortgages</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Founding Team Section -->
    <section id="founders" class="founding-team-section">
        <div class="container">
            <div class="section-header">
                <h2 class="team-section-title">Our <span class="bold-text">Founding Team</span></h2>
                <p class="team-section-subtitle">Meet the changemakers responsible for leading the United Mortgages&reg; mission</p>
            </div>
            
            <div class="founders-grid">
                <!-- David -->
                <div class="founder-card">
                    <div class="founder-image-wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/david-bw.png?v=3" alt="David Woodford" class="founder-image bw-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/david-col.png" alt="David Woodford" class="founder-image color-image">
                    </div>
                    <div class="founder-info">
                        <h3 class="founder-name">DAVID WOODFORD <a href="https://www.linkedin.com/in/davidwoodforduk" target="_blank" class="linkedin-link">in</a></h3>
                        <p class="founder-title">Chief Executive Officer</p>
                        <div class="founder-bio">
                            <p>Co-Founder and Chief Executive Officer of United Mortgages&reg;  with responsibility for overall leadership, GTM, and strategy, in addition to adeptly leading the firm's commercial advisory operations.</p>
                            <p>A tech and customer experience evangelist, David has spent nearly a decade working at the intersection of innovation, sustainability, and growth. Before co-founding United, he held management roles at two Fortune 500 firms (Renault Group and Geely), and later helped scale Deloitte Fast 50 and Fast 500 recipients, Hypervolt, where he built enterprise and partnership channels with a relentless focus on the customer journey. </p>
                            <p>An alumnus of Edinburgh Business School, David's penchant for thinking in the long-term, energetic leadership, and relentless focus on the customer experience enables him to build and scale high-performance teams, and mutually profitable partnerships.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Daniel -->
                <div class="founder-card">
                    <div class="founder-image-wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/daniel-bw.png?v=2" alt="Daniel Holloway" class="founder-image bw-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/daniel-col.png" alt="Daniel Holloway" class="founder-image color-image">
                    </div>
                    <div class="founder-info">
                        <h3 class="founder-name">DANIEL HOLLOWAY <a href="https://www.linkedin.com/in/boolean-daniel" target="_blank" class="linkedin-link">in</a></h3>
                        <p class="founder-title">Chief Technical Officer</p>
                        <div class="founder-bio">
                            <p>Co-founder and Chief Technical Officer, Daniel leads the engineering, build, and implementation of our suite of proprietary software.</p>
							<p>As passionate about streamlining the mortgage process as he is the Oxford comma, he approaches each development challenge with the systematic rigor of a quantitative analyst and the curiosity of a philosopher asking "why?"</p>
							<p>With a Master's in Economics and Finance from King's College London and a Bachelor's in Philosophy, Politics &amp; Economics, Daniel views software development as much an art as a science and combines deep financial industry knowledge with technical expertise.</p>
                            <p>His experience spans algorithmic systems development, full-stack web engineering, and five years in finance, bringing a unique perspective to mortgage technology that treats every line of code as both a technical solution and a bet on better outcomes for our clients.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="who-we-help-section">
    <div class="container">
        <div class="section-header">
            <h2 class="team-section-title">Who We <span class="bold-text">Help</span></h2>
            <p class="team-section-subtitle">We work with ambitious professionals, entrepreneurs, and families across London and the Home Counties<br><span class="team-section-subtitle strong">who refuse to accept that mortgages have to be complicated</span></p>
            <p class="team-section-subtitle"><br>We don't just arrange mortgages; we build relationships with people who value clarity, speed, and expertise.</p>
        </div>
        <div class="spacer"></div>
<div class="mortgage-services-grid who-we-help">
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
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/self-employed.svg" alt="Remortgaging">
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
    <section class="founding-team-section">
        <div class="container">
            <div class="section-header">
                <h2 class="team-section-title">Our <span class="bold-text">Team</span></h2>
                <p class="team-section-subtitle">Bringing together visionary strategists dedicated to shaping the future of home financing</p>
            </div>
            
            <div class="founders-grid">
                <!-- Muki -->
                <div class="founder-card">
                    <div class="founder-image-wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/muki-bw.png" alt="Muki Liu" class="founder-image bw-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/muki-col.png" alt="Muki Liu" class="founder-image color-image">
                    </div>
                    <div class="founder-info">
                        <h3 class="founder-name">MUKI LIU <a href="https://www.linkedin.com/in/muki-liu-844444193" target="_blank" class="linkedin-link">in</a></h3>
                        <p class="founder-title">Technical Advisor</p>
                        <div class="founder-bio">
                            <p>A visionary and empathetic communicator, Muki built her career in communications across the green energy sector, working with Evident, Drax Group, and National Grid.</p>
                            <p>Educated at Beijing International Studies University and the University of Edinburgh, Muki embraces diverse voices and believes in the power of listening: communication comes after understanding what is truly desired.</p>
                            <p>As Technical Advisor at United Mortgages&reg;, she creatively leads the firm's marketing and communications strategy.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Sarina -->
                <div class="founder-card">
                    <div class="founder-image-wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/sarina-bw-1.png" alt="Sarina Kiayani" class="founder-image bw-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/sarina-col.png" alt="Sarina Kiayani" class="founder-image color-image sarina">
                    </div>
                    <div class="founder-info">
                        <h3 class="founder-name">Sarina Kiayani <a href="https:linkedin.com/in/sarinakiayani" target="_blank" class="linkedin-link">in</a></h3>
                        <p class="founder-title">Non-Executive Director &amp; Policy Advisor</p>
                        <div class="founder-bio">
                            <p>Sarina, an alumna of the London School of Economics, brings a thoughtful, people-centred approach to policy development in her role as Policy and External Affairs Manager at ARCO (Associated Retirement Community Operators), the UK's leading trade body for Housing-with-Care.</p>
                            <p>A natural communicator, she regularly contributes to public debates on housing through media appearances and written commentary, translating complex policy into accessible, human-focused narratives.</p>
                            <p>Policy Advisor at United Mortgages&reg;, she helps shape the organisation's vision around ethical and accessible housing finance, bringing both her collaborative mindset and advocacy for inclusive, sustainable housing solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- Integrity Charter Section -->
    <section class="integrity-charter" id="tegridy">
        <div class="charter-overlay"></div>
        <div class="container">
            <div class="charter-content">
                <h2 class="charter-title">The <span class="bold-text">Integrity Charter</span></h2>
                <div class="charter-text">
                    <p class="charter-intro">
                        In line with our overarching mission to become Britain's most trusted team of mortgage advisors, we commit to upholding the highest standards of integrity, professionalism, and ethical conduct in all our interactions with clients, lenders, and partners.
                    </p>
                    
                    <p class="charter-purpose">
                        Our purpose is to guide clients through the mortgage process with clarity, transparency, and honesty, ensuring that their financial decisions align with their best interests and long term goals.
                    </p>
                </div>
                
                <div class="charter-signatures">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/dw-sig.png" alt="David Woodford Signature" class="signature">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/our-story/dholly-sig.png" alt="Daniel Holloway Signature" class="signature" style="transform: scale(1.7);">
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>