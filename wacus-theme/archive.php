<?php
/**
 * Archive Template
 * 
 * @package WACUS
 */

get_header();
?>

<main id="main" class="site-main">
    <!-- Page Hero -->
    <section class="page-hero">
        <div class="three-container particles-container" data-count="1000"></div>
        <div class="container">
            <div class="page-hero-content">
                <h1 class="page-title hero-title char-reveal">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_author()) {
                        the_author();
                    } elseif (is_day()) {
                        echo get_the_date();
                    } elseif (is_month()) {
                        echo get_the_date('F Y');
                    } elseif (is_year()) {
                        echo get_the_date('Y');
                    } elseif (is_post_type_archive()) {
                        post_type_archive_title();
                    } else {
                        esc_html_e('Archives', 'wacus');
                    }
                    ?>
                </h1>
                
                <?php the_archive_description('<div class="archive-description fade-up">', '</div>'); ?>
                
                <div class="breadcrumb fade-up">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'wacus'); ?></a>
                    <span class="separator">/</span>
                    <span class="current"><?php
                        if (is_category()) {
                            single_cat_title();
                        } elseif (is_tag()) {
                            single_tag_title();
                        } elseif (is_author()) {
                            the_author();
                        } else {
                            esc_html_e('Archives', 'wacus');
                        }
                    ?></span>
                </div>
            </div>
        </div>
        <div class="page-hero-overlay"></div>
    </section>

    <!-- Archive Content -->
    <section class="archive-section section-padding">
        <div class="container">
            <?php if (have_posts()) : ?>
                
                <!-- Filter Bar -->
                <div class="filter-bar fade-up">
                    <div class="filter-categories">
                        <?php
                        $categories = get_categories(array('hide_empty' => true));
                        if ($categories) :
                        ?>
                            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="filter-btn <?php echo !is_category() ? 'active' : ''; ?>">
                                <?php esc_html_e('All', 'wacus'); ?>
                            </a>
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="filter-btn <?php echo is_category($category->term_id) ? 'active' : ''; ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="view-toggle">
                        <button class="view-btn grid-view active" data-view="grid">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </button>
                        <button class="view-btn list-view" data-view="list">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Posts Grid -->
                <div class="posts-grid grid-stagger" id="posts-container">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card animated-card tilt-card grid-item'); ?>>
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
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper fade-up">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                
                <div class="no-results">
                    <div class="no-results-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <h2><?php esc_html_e('No Posts Found', 'wacus'); ?></h2>
                    <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'wacus'); ?></p>
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Toggle
    const viewBtns = document.querySelectorAll('.view-btn');
    const postsContainer = document.getElementById('posts-container');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const view = this.dataset.view;
            postsContainer.classList.remove('grid-view', 'list-view');
            postsContainer.classList.add(view + '-view');
        });
    });
});
</script>

<?php get_footer(); ?>
