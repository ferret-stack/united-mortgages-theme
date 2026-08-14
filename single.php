<?php
/**
 * Template Name: Blog
 *
 * @package UnitedMortgages
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <!-- Post Hero Section -->
        <section class="um-post-hero<?php echo has_post_thumbnail() ? '' : ' um-post-hero--flat'; ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="um-post-hero__media">
                    <?php the_post_thumbnail('full'); ?>
                </div>
                <div class="um-post-hero__overlay"></div>
            <?php endif; ?>

            <div class="hp-container">
                <div class="um-post-hero__inner">
                    <div class="um-post-hero__meta">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) : ?>
                            <span class="um-post-hero__category"><?php echo esc_html( $categories[0]->name ); ?></span>
                        <?php endif; ?>
                        <span class="um-post-hero__date"><?php echo get_the_date('F j, Y'); ?></span>
                    </div>

                    <h1 class="um-post-hero__title"><?php the_title(); ?></h1>

                    <div class="um-post-hero__author-row">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
                        <div>
                            <span class="um-post-hero__author-name">By <?php the_author(); ?></span>
                            <span class="um-post-hero__read-time"><?php echo reading_time(); ?> min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Post Content -->
        <section class="um-post-content-section">
            <div class="hp-container">
                <div class="um-blog-layout">

                    <!-- Main Content -->
                    <article class="um-post-main">

                        <!-- Share Buttons -->
                        <div class="um-share">
                            <span>Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="um-share__icon" aria-label="Share on Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode("Just read this article: " . get_the_title() . "\n\nGreat mortgage insights #Mortgages #UKProperty\n\n"); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="um-share__icon" aria-label="Share on X">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="um-share__icon" aria-label="Share on LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Post Content -->
                        <div class="um-post-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Post Tags -->
                        <?php if ( has_tag() ) : ?>
                            <div class="um-post-tags">
                                <span>Tags:</span>
                                <?php the_tags('', '', ''); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Author Bio -->
                        <div class="um-author-bio">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 76 ); ?>
                            <div>
                                <h3>About <?php the_author(); ?></h3>
                                <p>United Mortgages&reg; is here 365 days for the next generation of homeowners. We specialise in young professionals and first-time buyers, making mortgages fast, modern, and stress-free. No fax machines. No endless email chains. Just a smarter way to <strong>unlocking your next home.</strong></p>
                            </div>
                        </div>

                        <!-- Related Posts -->
                        <?php
                        $related = get_posts( array(
                            'category__in' => wp_get_post_categories($post->ID),
                            'numberposts' => 3,
                            'post__not_in' => array($post->ID)
                        ) );

                        if( $related ) : ?>
                            <div class="um-related">
                                <h2>Related Articles</h2>
                                <div class="um-related-grid">
                                    <?php
                                    foreach( $related as $post ) :
                                        setup_postdata($post); ?>

                                        <article class="um-blog-card">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <a href="<?php the_permalink(); ?>" class="um-blog-card__thumb">
                                                    <?php the_post_thumbnail('medium'); ?>
                                                </a>
                                            <?php else : ?>
                                                <a href="<?php the_permalink(); ?>" class="um-blog-card__thumb um-blog-card__thumb--placeholder">
                                                    <span>United Mortgages&reg;</span>
                                                </a>
                                            <?php endif; ?>
                                            <div class="um-blog-card__body">
                                                <h4 class="um-blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <span class="um-blog-card__date"><?php echo get_the_date(); ?></span>
                                            </div>
                                        </article>

                                    <?php endforeach;
                                    wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </article>

                    <!-- Sidebar -->
                    <aside class="um-blog-sidebar">

                        <!-- Table of Contents (for long posts) -->
                        <div class="um-sidebar-widget" id="toc-widget">
                            <h3 class="um-sidebar-widget__title">In This Article</h3>
                            <nav class="um-toc-nav">
                                <!-- Populated by js/toc.js from the article's h2/h3 tags -->
                            </nav>
                        </div>

                        <!-- CTA Widget -->
                        <div class="um-sidebar-cta">
                            <h3>Ready to Get Started?</h3>
                            <p>Let our mortgage experts help you find the perfect solution.</p>
                            <a href="#contact-form" class="hp-btn">Request a Call Back</a>
                            <span class="um-sidebar-cta__phone">Or call us: <a href="tel:03330914776">0333 091 4776</a></span>
                        </div>

                    </aside>

                </div>
            </div>
        </section>

        <!-- Comments Section -->
        <section class="um-comments">
            <div class="hp-container">
                <div class="um-comments-inner">
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

    <!-- Speak to Our Team Section -->
    <div class="hp-team-wrap">
        <?php get_template_part('template-parts/team-contact'); ?>
    </div>

</main>

<?php get_footer(); ?>
