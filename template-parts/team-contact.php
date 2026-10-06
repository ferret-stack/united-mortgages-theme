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
                        Whether you're just starting to explore your options or partway through a case, you'll deal with one named adviser - <strong>not whoever's free.</strong><br>Reach out below and that's who you'll speak to, right through to completion.
                    </p>
                    
                    <div class="trustpilot-widget">
                        <!-- Trustpilot widget placeholder -->
                    </div>
                </div>
                
               <div class="contact-form um-contact-cta">
                    <?php
                    // Calendly booking replaces the HubSpot form embed (Gunslinger, V4.2.0).
                    // Same team link as page-triage.php. The href is the no-JS fallback;
                    // js/calendly-contact.js lazy-loads Calendly's popup on first click.
                    $um_contact_calendly_url = 'https://calendly.com/unitedmortgages/15min?utm_source=team_contact';
                    ?>
                    <a class="hp-btn um-calendly-btn" href="<?php echo esc_url( $um_contact_calendly_url ); ?>" data-calendly-url="<?php echo esc_url( $um_contact_calendly_url ); ?>">Book a call with an adviser</a>
                    <p class="um-contact-alt">
                        Prefer to talk now? Call <a href="tel:03330914776">0333 091 4776</a> or email <a href="mailto:hello@united-mortgages.com">hello@united-mortgages.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>