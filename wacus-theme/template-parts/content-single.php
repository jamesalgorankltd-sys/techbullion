<?php
/**
 * Template part for displaying single posts
 * 
 * @package WACUS
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <header class="post-header">
        <div class="post-meta">
            <?php
            $cats = get_the_category();
            if ($cats) :
            ?>
                <div class="post-categories">
                    <?php foreach ($cats as $cat) : ?>
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="category-tag">
                            <?php echo esc_html($cat->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="post-info">
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
                <span class="post-comments">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <?php comments_number('0', '1', '%'); ?>
                </span>
            </div>
        </div>
        
        <h1 class="post-title split-text"><?php the_title(); ?></h1>
        
        <div class="post-author-box fade-up">
            <div class="author-avatar">
                <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
            </div>
            <div class="author-info">
                <span class="author-name"><?php the_author(); ?></span>
                <span class="author-role"><?php echo get_the_author_meta('description') ? wp_trim_words(get_the_author_meta('description'), 10) : esc_html__('Author', 'wacus'); ?></span>
            </div>
        </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="post-featured-image clip-reveal">
            <?php the_post_thumbnail('wacus-hero', array('class' => 'featured-image')); ?>
        </div>
    <?php endif; ?>

    <div class="post-content fade-up">
        <?php
        the_content(sprintf(
            wp_kses(
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'wacus'),
                array('span' => array('class' => array()))
            ),
            get_the_title()
        ));

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'wacus'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <footer class="post-footer">
        <?php
        $tags = get_the_tags();
        if ($tags) :
        ?>
            <div class="post-tags">
                <span class="tags-label">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <?php esc_html_e('Tags:', 'wacus'); ?>
                </span>
                <div class="tags-list">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-link">
                            <?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="post-share">
            <span class="share-label"><?php esc_html_e('Share:', 'wacus'); ?></span>
            <div class="share-links">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="share-link magnetic" target="_blank" rel="noopener noreferrer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" class="share-link magnetic" target="_blank" rel="noopener noreferrer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" class="share-link magnetic" target="_blank" rel="noopener noreferrer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                <button class="share-link copy-link magnetic" data-url="<?php echo esc_url(get_permalink()); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                </button>
            </div>
        </div>
    </footer>
</article>

<!-- Author Bio -->
<div class="author-bio-box fade-up">
    <div class="author-avatar">
        <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
    </div>
    <div class="author-details">
        <h3 class="author-name"><?php the_author(); ?></h3>
        <?php if (get_the_author_meta('description')) : ?>
            <p class="author-bio"><?php echo esc_html(get_the_author_meta('description')); ?></p>
        <?php endif; ?>
        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link">
            <?php esc_html_e('View all posts', 'wacus'); ?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>
</div>

<!-- Post Navigation -->
<nav class="post-navigation">
    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    
    <?php if ($prev_post) : ?>
        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="nav-link nav-prev magnetic">
            <span class="nav-label">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <?php esc_html_e('Previous Post', 'wacus'); ?>
            </span>
            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
        </a>
    <?php else : ?>
        <div class="nav-link nav-prev empty"></div>
    <?php endif; ?>
    
    <?php if ($next_post) : ?>
        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-link nav-next magnetic">
            <span class="nav-label">
                <?php esc_html_e('Next Post', 'wacus'); ?>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </span>
            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
        </a>
    <?php else : ?>
        <div class="nav-link nav-next empty"></div>
    <?php endif; ?>
</nav>

<!-- Related Posts -->
<?php
$related_args = array(
    'post__not_in'        => array(get_the_ID()),
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'category__in'        => wp_get_post_categories(get_the_ID()),
);
$related_query = new WP_Query($related_args);

if ($related_query->have_posts()) :
?>
    <div class="related-posts">
        <h2 class="section-title split-text"><?php esc_html_e('Related Posts', 'wacus'); ?></h2>
        <div class="related-posts-grid grid-stagger">
            <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                <?php get_template_part('template-parts/content'); ?>
            <?php endwhile; ?>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<script>
// Copy link functionality
document.querySelectorAll('.copy-link').forEach(btn => {
    btn.addEventListener('click', function() {
        const url = this.dataset.url;
        navigator.clipboard.writeText(url).then(() => {
            this.classList.add('copied');
            setTimeout(() => this.classList.remove('copied'), 2000);
        });
    });
});
</script>
