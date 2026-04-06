<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
  <meta name="google-site-verification" content="qvL_aHS-0u8HrMAqG_jGjvmnKhphU4tMajW0ZbW6Zkc"/>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="contact-info">
                <a href="mailto:hello@united-mortgages.com" class="contact-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/mail.svg" class="contact-icon" alt="Email">
                    hello@united-mortgages.com
                </a>
                <a href="tel:02046349315" class="contact-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/phone.svg" class="contact-icon" alt="Phone">
                    0204 634 9315
                </a>
            </div>
                    <a href="https://api.whatsapp.com/send?phone=447451201210&text=Hi%2C%20I%27d%20like%20to%20discuss%20a%20mortgage" 
            target="_blank" 
            rel="noopener noreferrer" 
            class="whatsapp-header-link">
                <svg width="20" height="20" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="whatsapp-icon">
                    <circle cx="16" cy="16" r="16" fill="#25D366"/>
                    <path d="M25.308 22.796c-.376 1.06-1.864 1.944-3.048 2.204-.816.172-1.88.308-5.464-1.172-4.596-1.896-7.56-6.548-7.788-6.844-.224-.296-1.832-2.44-1.832-4.656 0-2.216 1.16-3.304 1.572-3.752.412-.448.9-.56 1.2-.56.3 0 .6.004.864.016.276.012.648-.104.972.744.412 1.068 1.416 3.456 1.54 3.708.124.252.208.548.044.844-.164.3-.248.488-.492.752-.244.264-.512.588-.732.788-.244.224-.496.464-.212.912.284.444 1.264 2.084 2.712 3.376 1.864 1.664 3.436 2.18 3.924 2.428.488.248.772.208 1.056-.124.284-.332 1.216-1.42 1.54-1.908.324-.488.648-.408 1.096-.244.448.164 2.848 1.344 3.336 1.588.488.244.812.368.928.572.116.204.116 1.176-.26 2.236z" fill="#fff"/>
                </svg>
                <span class="whatsapp-text">WhatsApp</span>
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
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/united-2.png" alt="United Mortgages" class="site-logo">
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