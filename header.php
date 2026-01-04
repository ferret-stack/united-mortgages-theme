<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Under Construction Popup !-->
<!--<div id="construction-popup" class="popup-overlay">
    <div class="popup-content">
        <div class="popup-header">
            <h2>🚧 Website Under Construction</h2>
            <button class="popup-close" onclick="closeConstructionPopup()">&times;</button>
        </div>
        <div class="popup-body">
            <p>Welcome to United Mortgages!</p>
            <p>We're currently working hard to improve your experience. While we're building our new website, some features and functionality may be limited.</p>
            <p>For immediate assistance, please contact us at:</p>
            <ul>
                <li>📞 <a href="tel:02034517973">0203 451 7973</a></li>
                <li>✉️ <a href="mailto:hello@united-mortgages.com">hello@united-mortgages.com</a></li>
            </ul>
            <p>Thank you for your patience!<br>- David & Daniel</p>
        </div>
        <div class="popup-footer">
            <button class="popup-button" onclick="closeConstructionPopup()">I Understand</button>
        </div>
    </div>
</div>!-->

<header id="masthead" class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="contact-info">
                <a href="mailto:hello@united-mortgages.com" class="contact-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/mail.svg" class="contact-icon" alt="Email">
                    hello@united-mortgages.com
                </a>
                <a href="tel:02034517973" class="contact-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/phone.svg" class="contact-icon" alt="Phone">
                    0203 451 7973
                </a>
            </div>
          <div class="header-actions">
                <a href="https://api.whatsapp.com/send?phone=447451201210">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/chat.svg" class="contact-icon" alt="Chat">
                    <span style="color:grey;">Chat now</span>
                </a>
                <a href="<?php echo home_url('/aip-overview'); ?>" class="btn-primary">Start your journey</a>
            </div>
        </div>
    </div>
    
    <nav class="main-navigation">
        <div class="container">
            <div class="nav-wrapper">
                <div class="site-branding">
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/united-logo.png" alt="United Mortgages" class="site-logo">
                        </a>
                    </h1>
                </div>
                
                <div class="nav-menu-wrapper">
                    <ul id="primary-menu">
                        <li><a href="<?php echo home_url('/our-story/'); ?>">Our Story</a></li>
                        <li><a href="<?php echo home_url('/blog/'); ?>">Blog</a></li>
                        <li><a href="<?php echo home_url('/our-mortgages/'); ?>">Our Mortgages</a></li>
                        <li><a href="<?php echo home_url('/calculators/'); ?>">Calculators</a></li>
                        <!-- <li><a href="/login">Login</a></li> -->
                    </ul>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-toggle-icon"></span>
                        <span class="menu-toggle-icon"></span>
                        <span class="menu-toggle-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>