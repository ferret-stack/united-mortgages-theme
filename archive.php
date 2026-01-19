<?php
/**
 * Template Name: Archive
 * @package UnitedMortgages
 */

get_header();
// Force query posts when coming from blog page
if (is_page('blog')) {
    query_posts(array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
    ));
}
?>

<main id="primary" class="site-main">
    
    <!-- Blog Hero Section -->
    <section class="blog-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="blog-title"><span style="font-weight:500;">United Mortgages&reg;</span> Blog</h1>
                <p class="blog-subtitle">Expert insights, mortgage tips, and property market updates</p>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="blog-content">
        <div class="container">
            <div class="blog-wrapper">
                
                <!-- Main Blog Content -->
                <div class="blog-main">
                    
                    <?php if ( have_posts() ) : ?>
                        
                        <!-- Blog Categories Filter -->
                        <div class="blog-filter">
                            <h3>Browse by Category</h3>
                            <div class="category-pills">
                                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="category-pill active">All Posts</a>
                                <?php
                                $categories = get_categories();
                                foreach($categories as $category) {
                                    echo '<a href="' . get_category_link($category->term_id) . '" class="category-pill">' . $category->name . '</a>';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <!-- Blog Posts Grid -->
                        <div class="blog-posts-grid">
                            <?php while ( have_posts() ) : the_post(); ?>
                                
                                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-card'); ?>>
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium_large'); ?>
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <div class="post-thumbnail placeholder">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/blog-placeholder.png" alt="<?php the_title(); ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span class="post-category">
                                                <?php
                                                $categories = get_the_category();
                                                if ( ! empty( $categories ) ) {
                                                    echo esc_html( $categories[0]->name );
                                                }
                                                ?>
                                            </span>
                                            <span class="post-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                        
                                        <h2 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        
                                        <div class="post-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        
                                        <div class="post-footer">
                                            <div class="post-author">
                                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
                                                <span><?php the_author(); ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
                                        </div>
                                    </div>
                                </article>
                                
                            <?php endwhile; ?>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="blog-pagination">
                            <?php
                            the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' => __( '← Previous', 'textdomain' ),
                                'next_text' => __( 'Next →', 'textdomain' ),
                            ) );
                            ?>
                        </div>
                        
                    <?php else : ?>
                        
                        <!-- No Posts Found -->
                        <div class="no-posts-found">
                            <h2>Coming Soon!</h2>
                            <p>We're working on bringing you valuable content about mortgages, property insights, and financial tips. Check back soon!</p>
                            <a href="/" class="btn-primary">Return Home</a>
                        </div>
                        
                    <?php endif; ?>
                    
                    <?php 
                    // Reset query if we forced it
                    if (is_page('blog')) {
                        wp_reset_query();
                    }
                    ?>
                    
                </div>
                
                <!-- Sidebar -->
                <aside class="blog-sidebar">
                    
                    <!-- Newsletter Signup 
                    <div class="sidebar-widget newsletter-widget">
                        <h3>Stay Updated</h3>
                        <p>Get the latest mortgage news and tips delivered to your inbox</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Your email address" required>
                            <button type="submit" class="btn-primary">Subscribe</button>
                        </form>
                    </div> -->
                    
                    <!-- Recent Posts -->
                    <div class="sidebar-widget recent-posts-widget">
                        <h3>Recent Posts</h3>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        if($recent_posts) : ?>
                            <ul class="recent-posts-list">
                                <?php foreach($recent_posts as $post) : ?>
                                    <li>
                                        <a href="<?php echo get_permalink($post['ID']); ?>">
                                            <?php echo $post['post_title']; ?>
                                        </a>
                                        <span class="post-date"><?php echo date('F j, Y', strtotime($post['post_date'])); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Popular Categories -->
                    <div class="sidebar-widget categories-widget">
                        <h3>Categories</h3>
                        <ul class="categories-list">
                            <?php
                            wp_list_categories(array(
                                'orderby' => 'name',
                                'title_li' => '',
                                'show_count' => true
                            ));
                            ?>
                        </ul>
                    </div>
                    
                    <!-- CTA Widget -->
                    <div class="sidebar-widget cta-widget">
                        <h3>Need Mortgage Advice?</h3>
                        <p>Our expert advisors are here to help you find the perfect mortgage solution</p>
                        <a href="/contact" class="btn-primary">Get In Touch</a>
                    </div>
                    
                </aside>
                
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>