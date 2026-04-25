<?php
// STYLING
function mytheme_enqueue_scripts() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );

// SITE UNDER CONSTRUCTION POP UP
function united_mortgages_popup_script() {
    wp_enqueue_script( 'construction-popup', get_template_directory_uri() . '/js/popup.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'united_mortgages_popup_script' );

// For creating AIP form
function united_enqueue_vue() {
    if (is_page('aip-form')) { // Only load on AIP form
        wp_enqueue_script('vue-js', 'https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js', array(), '3.0', false);
    }
}
add_action('wp_enqueue_scripts', 'united_enqueue_vue');

// PAGE CREATION
function united_mortgages_create_pages() {
    $pages = array(
        // Page slug => Page details
        'privacy-policy' => array(
            'title' => 'Privacy Policy',
            'template' => 'page-privacy-policy.php'
        ),
        'our-services' => array(
            'title' => 'Our Services',
            'template' => 'page-our-services.php'
        ),
        'calculators' => array(
            'title' => 'Mortgage Calculators',
            'template' => 'page-calculators.php'
        ),
        'our-story' => array(
            'title' => 'Our Story',
            'template' => 'page-our-story.php'
        ),
        'our-mortgages' => array(
            'title' => 'Our Mortgages',
            'template' => 'page-our-mortgages.php'
        ),
        'first-time-buyers' => array(
            'title' => 'First Time Buyers',
            'template' => 'page-first-time-buyers.php'
        ),
        'remortgaging' => array(
            'title' => 'Remortgaging',
            'template' => 'page-remortgaging.php'
        ),
        'moving-home' => array(
            'title' => 'Moving Home',
            'template' => 'page-moving-home.php'
        ),
        'entrepreneurs-founders-self-employed' => array(
            'title' => 'Entrepreneurs, Founders & Self Employed',
            'template' => 'page-efse.php'
        ),
        'other-mortgages' => array(
            'title' => 'Other Mortgages',
            'template' => 'page-other-mortgages.php'
        ),
    );

    foreach ($pages as $slug => $page) {
        $existing_page = get_page_by_path($slug);
        
        if (!$existing_page) {
            $page_data = array(
                'post_title'   => $page['title'],
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $slug,
            );

            // Insert the page and get the ID
            $page_id = wp_insert_post($page_data);

            // Assign the template if provided
            if (!empty($page['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page['template']);
            }
        }
    }
}

add_action('after_switch_theme', 'united_mortgages_create_pages');


// SMOOTH SCROLL FUNCTION
function united_mortgages_smooth_scroll() {
    wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/smooth_scroll.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'united_mortgages_smooth_scroll' );

// HEADER TRANSFORM
function united_mortgages_header_scroll() {
    wp_enqueue_script( 'header-scroll', get_template_directory_uri() . '/js/header_scroll.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'united_mortgages_header_scroll' );

// ANALYTICS
function add_google_analytics() {
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T9B4GW2XP9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-T9B4GW2XP9');
    </script>
    <?php
}
add_action('wp_head', 'add_google_analytics');

/**
 * Enqueue calculator scripts
 */
function um_enqueue_calculator_scripts() {
    if (is_page_template('page-calculators.php')) {
        wp_enqueue_script(
            'um-calculators',
            get_template_directory_uri() . '/assets/js/calculators.js',
            array(), // No dependencies
            '1.0.0',
            true // Load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'um_enqueue_calculator_scripts');

// Make WordPress use archive.php for the blog page
function um_blog_page_redirect() {
    if (is_page('blog')) {
        // Prevent infinite loops
        remove_action('template_redirect', 'um_blog_page_redirect');
        
        // Load the archive template
        include(get_template_directory() . '/archive.php');
        exit;
    }
}
add_action('template_redirect', 'um_blog_page_redirect', 1);

// Enable post thumbnails if not already enabled
add_theme_support( 'post-thumbnails' );

// Add custom image sizes for blog
add_image_size( 'blog-thumbnail', 600, 400, true ); // For blog grid
add_image_size( 'blog-hero', 1920, 600, true ); // For single post hero

// Custom excerpt length
function um_custom_excerpt_length( $length ) {
    return 20; // 20 words
}
add_filter( 'excerpt_length', 'um_custom_excerpt_length' );

// Custom excerpt more
function um_custom_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'um_custom_excerpt_more' );

// Reading time calculator
function reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil($word_count / 200); // 200 words per minute
    
    return $reading_time;
}

// Add blog to main menu
function um_add_blog_menu_item( $items, $args ) {
    if ( $args->theme_location == 'primary' ) {
        // Add blog menu item before the last item (Contact)
        $blog_item = '<li class="menu-item"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">Blog</a></li>';
        
        // Insert before the last </ul>
        $items = str_replace( '</ul>', $blog_item . '</ul>', $items );
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'um_add_blog_menu_item', 10, 2 );

// Register blog sidebar
function um_blog_widgets_init() {
    register_sidebar( array(
        'name'          => 'Blog Sidebar',
        'id'            => 'blog-sidebar',
        'description'   => 'Sidebar for blog pages',
        'before_widget' => '<div class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'um_blog_widgets_init' );

// Customize comment form
function um_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $fields['author'] = '<div class="comment-form-author"><input id="author" name="author" type="text" placeholder="Your Name *" value="' . esc_attr( $commenter['comment_author'] ) . '" required /></div>';
    
    $fields['email'] = '<div class="comment-form-email"><input id="email" name="email" type="email" placeholder="Your Email *" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required /></div>';
    
    $fields['url'] = '<div class="comment-form-url"><input id="url" name="url" type="url" placeholder="Website (optional)" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>';
    
    return $fields;
}
add_filter( 'comment_form_default_fields', 'um_comment_form_fields' );

// Add categories for blog organization
function um_create_blog_categories() {
    $categories = array(
        'Mortgage Advice' => 'Expert tips and guidance on mortgages',
        'First Time Buyers' => 'Information for first-time property buyers',
        'Property Market' => 'Latest property market news and trends',
        'Financial Planning' => 'Financial advice and planning tips',
        'Case Studies' => 'Success stories from our clients',
    );
    
    foreach ( $categories as $cat_name => $cat_desc ) {
        if ( !term_exists( $cat_name, 'category' ) ) {
            wp_insert_term(
                $cat_name,
                'category',
                array(
                    'description' => $cat_desc,
                    'slug' => sanitize_title( $cat_name )
                )
            );
        }
    }
}
add_action( 'init', 'um_create_blog_categories' );

// Add Open Graph tags for better social sharing
function um_add_open_graph_tags() {
    if ( is_single() ) {
        global $post;
        
        $og_title = get_the_title();
        $og_description = get_the_excerpt();
        $og_image = get_the_post_thumbnail_url( $post->ID, 'large' );
        $og_url = get_permalink();
        
        ?>
        <meta property="og:title" content="<?php echo esc_attr( $og_title ); ?>" />
        <meta property="og:description" content="<?php echo esc_attr( $og_description ); ?>" />
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
        <meta property="og:url" content="<?php echo esc_url( $og_url ); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="United Mortgages" />
        
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="<?php echo esc_attr( $og_title ); ?>" />
        <meta name="twitter:description" content="<?php echo esc_attr( $og_description ); ?>" />
        <meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>" />
        <?php
    }
}
add_action( 'wp_head', 'um_add_open_graph_tags' );

// Ajax load more posts (optional - for infinite scroll)
function um_load_more_posts() {
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $paged,
        'post_status' => 'publish'
    );
    
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            // Output post card HTML
            get_template_part( 'template-parts/content', 'blog-card' );
        endwhile;
    endif;
    
    wp_die();
}
add_action( 'wp_ajax_load_more_posts', 'um_load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'um_load_more_posts' );

// Blog post views counter (optional)
function um_set_post_views( $post_id ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

function um_track_post_views( $post_id ) {
    if ( !is_single() ) return;
    if ( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    }
    um_set_post_views( $post_id );
}
add_action( 'wp_head', 'um_track_post_views' );

// Get post views
function um_get_post_views( $post_id ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( $count == '' ) {
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
        return "0 Views";
    }
    
    return $count . ' Views';
}

function um_aip_overview_og_tags() {
    if ( is_page_template( 'page-aip-overview.php' ) ) {
        $og_image = get_site_url() . '/wp-content/uploads/2026/04/um-fav.jpg';
        ?>
        <meta property="og:title" content="Get Your Agreement in Principle | United Mortgages®" />
        <meta property="og:description" content="Know how much you can borrow before you fall in love with a property. Takes less than 10 minutes. No impact on your credit score." />
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>" />
        <meta property="og:type" content="website" />
        <?php
    }
}
add_action( 'wp_head', 'um_aip_overview_og_tags' );

function um_calculator_og_tags() {
    if ( is_page_template( 'page-aip-calculators.php' ) ) {
        $og_image = get_site_url() . '/wp-content/uploads/2026/04/um-fav.jpg';
        ?>
        <meta property="og:title" content="Calculators | United Mortgages®" />
        <meta property="og:description" content="Our calculators can help you plan for how much you can borrow, overpayment rates, and stamp duty. No impact on your credit score." />
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>" />
        <meta property="og:type" content="website" />
        <?php
    }
}
add_action( 'wp_head', 'um_calculator_og_tags' );

function um_nhs_og_tags() {
    if ( is_page_template( 'page-nhs-mortgage.php' ) ) {
        $og_image = get_site_url() . '/wp-content/uploads/2026/04/nhs-hero.png';
        ?>
        <meta property="og:title" content="Mortgages for the 24/7 Hero | United Mortgages®" />
        <meta property="og:description" content="You work the hours no one else will. So do we." />
        <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>" />
        <meta property="og:type" content="website" />
        <?php
    }
}
add_action( 'wp_head', 'um_nhs_og_tags' );


function united_enqueue_aip_exit_popup() {
    if ( is_page( 'aip-form' ) ) {
        wp_enqueue_script(
            'aip-exit-popup',
            get_template_directory_uri() . '/js/aip-exit-popup.js',
            array(),    // No dependencies — runs independently of Vue
            '1.0.0',
            true        // Load in footer
        );
    }
}
add_action( 'wp_enqueue_scripts', 'united_enqueue_aip_exit_popup' );

function um_enqueue_faq_accordion() {
    wp_enqueue_script(
        'faq-accordion',
        get_template_directory_uri() . '/js/faq-accordion.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'um_enqueue_faq_accordion' );

?>