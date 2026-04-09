<?php
/**
 * Template part for displaying posts
 * 
 * @package WACUS
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card animated-card tilt-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail img-zoom cursor-view">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('wacus-card', array('class' => 'card-image')); ?>
            </a>
            <div class="post-categories">
                <?php
                $cats = get_the_category();
                if ($cats) {
                    foreach ($cats as $cat) {
                        echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="category-tag">' . esc_html($cat->name) . '</a>';
                    }
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="post-content">
        <div class="post-meta">
            <span class="post-date">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <?php echo get_the_date(); ?>
            </span>
            <span class="post-read-time">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <?php echo wacus_reading_time(); ?>
            </span>
        </div>
        
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        
        <div class="post-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
        </div>
        
        <div class="post-footer">
            <div class="post-author">
                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                <span><?php the_author(); ?></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="read-more magnetic">
                <?php esc_html_e('Read More', 'wacus'); ?>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</article>
