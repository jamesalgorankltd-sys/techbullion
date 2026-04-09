<?php
/**
 * Single Post Template
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <header class="single-post-header">
                <?php
                $categories = get_the_category();
                if ($categories) :
                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="single-post-category reveal">' . esc_html($categories[0]->name) . '</a>';
                endif;
                ?>
                
                <h1 class="single-post-title reveal"><?php the_title(); ?></h1>
                
                <div class="single-post-meta reveal">
                    <span class="post-author">
                        <?php esc_html_e('By', 'wacus'); ?> <?php the_author(); ?>
                    </span>
                    <span class="post-date">
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="post-reading-time">
                        <?php echo wacus_reading_time(); ?> <?php esc_html_e('min read', 'wacus'); ?>
                    </span>
                </div>
            </header>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="single-post-featured-image reveal image-reveal">
                    <?php the_post_thumbnail('wacus-blog-featured', array('loading' => 'lazy')); ?>
                </div>
            <?php endif; ?>
            
            <div class="single-post-content reveal">
                <?php
                the_content();
                
                wp_link_pages(array(
                    'before'      => '<div class="page-links">' . esc_html__('Pages:', 'wacus'),
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ));
                ?>
            </div>
            
            <footer class="single-post-footer">
                <?php
                // Tags
                $tags = get_the_tags();
                if ($tags) :
                    ?>
                    <div class="post-tags reveal">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="post-tag">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Share Buttons -->
                <div class="post-share reveal">
                    <span class="share-label"><?php esc_html_e('Share:', 'wacus'); ?></span>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-twitter" aria-label="Share on Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" aria-label="Share on Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-linkedin" aria-label="Share on LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                    </a>
                </div>
            </footer>
            
            <!-- Post Navigation -->
            <nav class="post-navigation reveal">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                
                if ($prev_post) :
                    ?>
                    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="nav-prev">
                        <span class="nav-subtitle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                            <?php esc_html_e('Previous', 'wacus'); ?>
                        </span>
                        <span class="nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
                    </a>
                <?php else : ?>
                    <span></span>
                <?php endif; ?>
                
                <?php if ($next_post) : ?>
                    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-next">
                        <span class="nav-subtitle">
                            <?php esc_html_e('Next', 'wacus'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </span>
                        <span class="nav-title"><?php echo esc_html($next_post->post_title); ?></span>
                    </a>
                <?php endif; ?>
            </nav>
            
            <!-- Author Box -->
            <div class="author-box reveal">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                </div>
                <div class="author-info">
                    <h4 class="author-name"><?php the_author(); ?></h4>
                    <p class="author-bio"><?php echo esc_html(get_the_author_meta('description')); ?></p>
                </div>
            </div>
            
            <!-- Related Posts -->
            <?php
            $related_posts = new WP_Query(array(
                'category__in'   => wp_get_post_categories(get_the_ID()),
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            ));
            
            if ($related_posts->have_posts()) :
                ?>
                <div class="related-posts reveal">
                    <h3 class="related-posts-title"><?php esc_html_e('Related Articles', 'wacus'); ?></h3>
                    <div class="blog-grid">
                        <?php
                        while ($related_posts->have_posts()) : $related_posts->the_post();
                            ?>
                            <article class="blog-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="blog-card-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('wacus-blog-thumb', array('loading' => 'lazy')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-card-content">
                                    <h4 class="blog-card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <span class="blog-card-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
            
        </article>
        
    <?php endwhile; ?>
    
</main>

<?php
get_footer();
