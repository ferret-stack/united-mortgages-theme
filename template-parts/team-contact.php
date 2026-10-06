<!-- Speak to Our Team Section -->
    <section class="team-contact-section" id="contact-form">
        <div class="container">
            <div class="team-contact-wrapper">
                <div class="team-info">
                    <div class="team-avatars">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/daniel-team-2.png" alt="Team Member" class="team-avatar" style="object-position: center -2.5%">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/muki-team.png" alt="Team Member" class="team-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/david-team.png" alt="Team Member" class="team-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/jeff-team.png" alt="Team Member" class="team-avatar">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/michael-team.png" alt="Team Member" class="team-avatar">
                    </div>
      
                    <h2 class="team-title"><span class="bold-text">One adviser. </span>Evenings, weekends, and bank holidays included.</span></h2>
                    
                    <p class="team-description">
                        Whether you're just starting to explore your options or partway through a case, you'll deal with one named adviser - <strong>not whoever's free.</strong><br>Book a time and that's who you'll speak to, right through to completion.
                    </p>
                    
                    <div class="trustpilot-widget">
                        <!-- Trustpilot widget placeholder -->
                    </div>
                </div>
                
               <div class="contact-form um-contact-cta">
                    <?php
                    // Inline Calendly booking calendar (V4.3.0), same team link as page-triage.php.
                    // js/calendly-contact.js mounts Calendly's inline widget when this section
                    // scrolls near the viewport. The link inside is the no-JS / load-failure fallback.
                    $um_contact_calendly_url = 'https://calendly.com/unitedmortgages/15min';
                    ?>
                    <h3 class="um-contact-cta__title">Pick a time with your adviser</h3>
                    <div class="um-calendly-inline" data-calendly-url="<?php echo esc_url( $um_contact_calendly_url ); ?>">
                        <a class="hp-btn um-calendly-fallback" href="<?php echo esc_url( $um_contact_calendly_url . '?utm_source=team_contact' ); ?>">Book a call with an adviser</a>
                        <p class="um-calendly-loading" hidden>Loading available times…</p>
                    </div>
                    <p class="um-contact-alt">
                        Prefer to talk now? Call <a href="tel:03330914776">0333 091 4776</a> or email <a href="mailto:hello@united-mortgages.com">hello@united-mortgages.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>