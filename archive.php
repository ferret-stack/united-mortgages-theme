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
    <section class="um-product-hero">
        <div class="hp-container">
            <div class="um-product-hero__content">
                <span class="hp-pill">Insights &amp; Advice</span>
                <h1 class="um-product-hero__title"><span class="bold-text">United Mortgages&reg;</span> Blog</h1>
                <p class="um-product-hero__subtitle">Expert insights, mortgage tips, and property market updates.</p>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="um-blog-content">
        <div class="hp-container">
            <div class="um-blog-layout">

                <!-- Main Blog Content -->
                <div class="um-blog-main">

                    <?php if ( have_posts() ) : ?>

                        <!-- Blog Categories Filter -->
                        <div class="um-blog-filter">
                            <h3>Browse by Category</h3>
                            <div class="um-pill-nav">
                                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="um-pill-nav__item is-active">All Posts</a>
                                <?php
                                $categories = get_categories();
                                foreach($categories as $category) {
                                    echo '<a href="' . get_category_link($category->term_id) . '" class="um-pill-nav__item">' . esc_html( $category->name ) . '</a>';
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Blog Posts Grid -->
                        <div class="um-blog-grid">
                            <?php while ( have_posts() ) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('um-blog-card'); ?>>
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>" class="um-blog-card__thumb">
                                            <?php the_post_thumbnail('medium_large'); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>" class="um-blog-card__thumb um-blog-card__thumb--placeholder">
                                            <span>United Mortgages&reg;</span>
                                        </a>
                                    <?php endif; ?>

                                    <div class="um-blog-card__body">
                                        <div class="um-blog-card__meta">
                                            <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) : ?>
                                                <span class="um-blog-card__category"><?php echo esc_html( $categories[0]->name ); ?></span>
                                            <?php endif; ?>
                                            <span class="um-blog-card__date"><?php echo get_the_date(); ?></span>
                                        </div>

                                        <h2 class="um-blog-card__title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>

                                        <div class="um-blog-card__excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <div class="um-blog-card__footer">
                                            <div class="um-blog-card__author">
                                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 26 ); ?>
                                                <span><?php the_author(); ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="um-blog-card__readmore">Read More &rarr;</a>
                                        </div>
                                    </div>
                                </article>

                            <?php endwhile; ?>
                        </div>

                        <!-- Pagination -->
                        <div class="um-blog-pagination">
                            <?php
                            the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' => __( '&larr; Previous', 'textdomain' ),
                                'next_text' => __( 'Next &rarr;', 'textdomain' ),
                            ) );
                            ?>
                        </div>

                    <?php else : ?>

                        <!-- No Posts Found -->
                        <div class="um-blog-empty">
                            <h2>Coming Soon!</h2>
                            <p>We're working on bringing you valuable content about mortgages, property insights, and financial tips. Check back soon!</p>
                            <a href="/" class="hp-btn">Return Home</a>
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
                <aside class="um-blog-sidebar">

                    <!-- Recent Posts -->
                    <div class="um-sidebar-widget">
                        <h3 class="um-sidebar-widget__title">Recent Posts</h3>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        if($recent_posts) : ?>
                            <ul class="um-sidebar-list">
                                <?php foreach($recent_posts as $post) : ?>
                                    <li>
                                        <a href="<?php echo get_permalink($post['ID']); ?>">
                                            <?php echo $post['post_title']; ?>
                                            <span class="um-sidebar-list__date"><?php echo date('F j, Y', strtotime($post['post_date'])); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Popular Categories -->
                    <div class="um-sidebar-widget">
                        <h3 class="um-sidebar-widget__title">Categories</h3>
                        <ul class="um-sidebar-list um-sidebar-list--categories">
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
                    <div class="um-sidebar-cta">
                        <h3>Need Mortgage Advice?</h3>
                        <p>Our expert advisors are here to help you find the perfect mortgage solution.</p>
                        <a href="/contact" class="hp-btn">Get In Touch</a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
