<?php
/**
 * Template Name: Blog Page
 * 
 * @package WACUS
 */

get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$blog_query = new WP_Query(array(
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
));
?>

<main id="main" class="site-main">
    <!-- Page Hero -->
    <section class="page-hero">
        <div class="three-container particles-container" data-count="1000"></div>
        <div class="container">
            <div class="page-hero-content">
                <span class="hero-label fade-up"><?php esc_html_e('Our Blog', 'wacus'); ?></span>
                <h1 class="page-title hero-title char-reveal"><?php the_title(); ?></h1>
                <p class="hero-subtitle fade-up"><?php esc_html_e('Insights, news, and industry updates from our team', 'wacus'); ?></p>
                
                <div class="breadcrumb fade-up">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'wacus'); ?></a>
                    <span class="separator">/</span>
                    <span class="current"><?php the_title(); ?></span>
                </div>
            </div>
        </div>
        <div class="page-hero-overlay"></div>
    </section>

    <!-- Featured Post -->
    <?php
    $featured = new WP_Query(array(
        'posts_per_page' => 1,
        'meta_key'       => '_is_featured',
        'meta_value'     => '1',
    ));

    if ($featured->have_posts()) :
        while ($featured->have_posts()) : $featured->the_post();
    ?>
        <section class="featured-post section-padding">
            <div class="container">
                <div class="featured-post-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-image clip-reveal">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('wacus-hero'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="featured-content">
                        <span class="featured-label"><?php esc_html_e('Featured Post', 'wacus'); ?></span>
                        
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
                        
                        <h2 class="featured-title split-text">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="featured-excerpt fade-up">
                            <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                        </div>
                        
                        <div class="featured-meta fade-up">
                            <div class="post-author">
                                <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                                <div class="author-info">
                                    <span class="author-name"><?php the_author(); ?></span>
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary magnetic btn-ripple">
                                <span><?php esc_html_e('Read Article', 'wacus'); ?></span>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>

    <!-- Blog Posts -->
    <section class="blog-section section-padding">
        <div class="container">
            <!-- Categories Filter -->
            <div class="blog-filter fade-up">
                <div class="filter-categories">
                    <button class="filter-btn active" data-category="all"><?php esc_html_e('All', 'wacus'); ?></button>
                    <?php
                    $categories = get_categories(array('hide_empty' => true, 'number' => 6));
                    foreach ($categories as $category) :
                    ?>
                        <button class="filter-btn" data-category="<?php echo esc_attr($category->slug); ?>">
                            <?php echo esc_html($category->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                
                <div class="blog-search">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" name="s" placeholder="<?php esc_attr_e('Search posts...', 'wacus'); ?>">
                        <button type="submit">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <?php if ($blog_query->have_posts()) : ?>
                <!-- Posts Grid -->
                <div class="blog-grid grid-stagger">
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article <?php post_class('blog-card animated-card tilt-card grid-item'); ?> data-category="<?php 
                            $cats = get_the_category();
                            if ($cats) {
                                echo esc_attr(implode(' ', wp_list_pluck($cats, 'slug')));
                            }
                        ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-image img-zoom cursor-view">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('wacus-card'); ?>
                                    </a>
                                    <div class="card-overlay">
                                        <span class="view-text"><?php esc_html_e('Read More', 'wacus'); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-content">
                                <div class="card-meta">
                                    <?php
                                    $first_cat = get_the_category();
                                    if ($first_cat) :
                                    ?>
                                        <a href="<?php echo esc_url(get_category_link($first_cat[0]->term_id)); ?>" class="category-tag">
                                            <?php echo esc_html($first_cat[0]->name); ?>
                                        </a>
                                    <?php endif; ?>
                                    <span class="post-date"><?php echo get_the_date('M d, Y'); ?></span>
                                </div>
                                
                                <h3 class="card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <p class="card-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                                
                                <div class="card-footer">
                                    <div class="author">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 30); ?>
                                        <span><?php the_author(); ?></span>
                                    </div>
                                    <span class="read-time"><?php echo wacus_reading_time(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper fade-up">
                    <?php
                    echo paginate_links(array(
                        'total'     => $blog_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="no-posts">
                    <p><?php esc_html_e('No posts found.', 'wacus'); ?></p>
                </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="newsletter-cta section-padding">
        <div class="container">
            <div class="newsletter-card">
                <div class="newsletter-content">
                    <h2 class="split-text"><?php esc_html_e('Subscribe to Our Newsletter', 'wacus'); ?></h2>
                    <p class="fade-up"><?php esc_html_e('Get the latest articles and insights delivered straight to your inbox.', 'wacus'); ?></p>
                </div>
                <form class="newsletter-form fade-up" action="#" method="post">
                    <div class="form-row">
                        <input type="email" name="email" placeholder="<?php esc_attr_e('Enter your email', 'wacus'); ?>" required>
                        <button type="submit" class="btn btn-primary magnetic btn-ripple">
                            <span><?php esc_html_e('Subscribe', 'wacus'); ?></span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>
                    <p class="form-note"><?php esc_html_e('We respect your privacy. Unsubscribe at any time.', 'wacus'); ?></p>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const blogCards = document.querySelectorAll('.blog-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;

            blogCards.forEach(card => {
                if (category === 'all' || card.dataset.category.includes(category)) {
                    card.style.display = 'block';
                    gsap.to(card, { opacity: 1, y: 0, duration: 0.3 });
                } else {
                    gsap.to(card, { 
                        opacity: 0, 
                        y: 20, 
                        duration: 0.3,
                        onComplete: () => card.style.display = 'none'
                    });
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
