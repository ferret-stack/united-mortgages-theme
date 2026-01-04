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
        <section class="post-hero">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-hero-image">
                    <?php the_post_thumbnail('full'); ?>
                    <div class="hero-overlay"></div>
                </div>
            <?php else : ?>
                <div class="post-hero-gradient"></div>
            <?php endif; ?>
            
            <div class="container">
                <div class="post-hero-content">
                    <div class="post-meta-top">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) : ?>
                            <span class="post-category"><?php echo esc_html( $categories[0]->name ); ?></span>
                        <?php endif; ?>
                        <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
                    </div>
                    
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <div class="post-author-info">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                        <div class="author-details">
                            <span class="author-name">By <?php the_author(); ?></span>
                            <span class="read-time"><?php echo reading_time(); ?> min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Post Content -->
        <section class="post-content-section">
            <div class="container">
                <div class="post-wrapper">
                    
                    <!-- Main Content -->
                    <article class="post-main">
                        
                        <!-- Share Buttons -->
                        <div class="share-buttons">
                            <span>Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn facebook">
                                <i class="dashicons dashicons-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode("Just read this article: " . get_the_title() . "\n\nGreat mortgage insights #Mortgages #UKProperty\n\n"); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn linkedin">
                                <i class="dashicons dashicons-linkedin"></i>
                            </a>
                        </div>
                        
                        <!-- Post Content -->
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- Post Tags -->
                        <?php if ( has_tag() ) : ?>
                            <div class="post-tags">
                                <span>Tags:</span>
                                <?php the_tags('', ', ', ''); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Author Bio -->
                        <div class="author-bio">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
                            <div class="author-bio-content">
                                <h3>About <?php the_author(); ?></h3>
                                <p><?php the_author_meta('description'); ?></p>
                            </div>
                        </div>
                        
                        <!-- Related Posts -->
                        <div class="related-posts">
                            <h2>Related Articles</h2>
                            <div class="related-posts-grid">
                                <?php
                                $related = get_posts( array(
                                    'category__in' => wp_get_post_categories($post->ID),
                                    'numberposts' => 3,
                                    'post__not_in' => array($post->ID)
                                ) );
                                
                                if( $related ) :
                                    foreach( $related as $post ) :
                                        setup_postdata($post); ?>
                                        
                                        <div class="related-post-card">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <div class="related-post-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <span class="post-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                        
                                    <?php endforeach;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                        
                    </article>
                    
                    <!-- Sidebar -->
                    <aside class="post-sidebar">
                        
                        <!-- Table of Contents (for long posts) -->
                        <div class="sidebar-widget toc-widget" id="toc-widget">
                            <h3>In This Article</h3>
                            <nav class="toc-nav">
                                <!-- Will be populated by JavaScript based on h2/h3 tags -->
                            </nav>
                        </div>
                        
                        <!-- CTA Widget -->
                        <div class="sidebar-widget cta-widget sticky-widget">
                            <h3>Ready to Get Started?</h3>
                            <p>Let our mortgage experts help you find the perfect solution</p>
                            <a href="/contact" class="btn-secondary">Book Consultation</a>
                            <p class="cta-phone">Or call us: <a href="tel:02034889773">0203 488 9773</a></p>
                        </div>
                        
                    </aside>
                    
                </div>
            </div>
        </section>
        
        <!-- Comments Section -->
        <section class="comments-section">
            <div class="container">
                <div class="comments-wrapper">
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

</main>

<?php get_footer(); ?>