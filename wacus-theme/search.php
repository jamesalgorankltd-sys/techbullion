<?php
/**
 * Search Results Template
 * 
 * @package WACUS
 */

get_header();
?>

<main id="main" class="site-main">
    <!-- Search Hero -->
    <section class="page-hero search-hero">
        <div class="three-container particles-container" data-count="800"></div>
        <div class="container">
            <div class="page-hero-content">
                <h1 class="page-title hero-title char-reveal">
                    <?php esc_html_e('Search Results', 'wacus'); ?>
                </h1>
                <p class="search-query fade-up">
                    <?php
                    printf(
                        esc_html__('Results for: "%s"', 'wacus'),
                        '<span class="highlight">' . get_search_query() . '</span>'
                    );
                    ?>
                </p>
                
                <!-- Search Form -->
                <div class="search-form-wrapper fade-up">
                    <form role="search" method="get" class="search-form hero-search" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-input-wrapper">
                            <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search again...', 'wacus'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="search-submit magnetic">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="breadcrumb fade-up">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'wacus'); ?></a>
                    <span class="separator">/</span>
                    <span class="current"><?php esc_html_e('Search', 'wacus'); ?></span>
                </div>
            </div>
        </div>
        <div class="page-hero-overlay"></div>
    </section>

    <!-- Search Results -->
    <section class="search-results-section section-padding">
        <div class="container">
            <?php if (have_posts()) : ?>
                
                <div class="search-stats fade-up">
                    <p>
                        <?php
                        printf(
                            esc_html(_n('Found %d result', 'Found %d results', $wp_query->found_posts, 'wacus')),
                            $wp_query->found_posts
                        );
                        ?>
                    </p>
                </div>

                <!-- Results Grid -->
                <div class="search-results-grid stagger-container">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item stagger-item'); ?>>
                            <div class="result-content">
                                <div class="result-type">
                                    <?php
                                    $post_type = get_post_type();
                                    $post_type_obj = get_post_type_object($post_type);
                                    echo esc_html($post_type_obj->labels->singular_name);
                                    ?>
                                </div>
                                
                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="result-meta">
                                    <span class="result-date">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <?php if (get_post_type() === 'post') : ?>
                                        <span class="result-author">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <?php the_author(); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="result-excerpt">
                                    <?php
                                    $excerpt = get_the_excerpt();
                                    $search_term = get_search_query();
                                    $excerpt = preg_replace('/(' . preg_quote($search_term, '/') . ')/i', '<mark>$1</mark>', $excerpt);
                                    echo wp_kses_post($excerpt);
                                    ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="result-link magnetic">
                                    <?php esc_html_e('View', 'wacus'); ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="result-thumbnail img-zoom">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
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
                        <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            <line x1="8" y1="8" x2="14" y2="14"></line>
                            <line x1="14" y1="8" x2="8" y2="14"></line>
                        </svg>
                    </div>
                    <h2><?php esc_html_e('No Results Found', 'wacus'); ?></h2>
                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wacus'); ?></p>
                    
                    <div class="search-suggestions">
                        <h3><?php esc_html_e('Suggestions:', 'wacus'); ?></h3>
                        <ul>
                            <li><?php esc_html_e('Check your spelling', 'wacus'); ?></li>
                            <li><?php esc_html_e('Try more general keywords', 'wacus'); ?></li>
                            <li><?php esc_html_e('Try different keywords', 'wacus'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="popular-searches">
                        <h3><?php esc_html_e('Popular Searches:', 'wacus'); ?></h3>
                        <div class="popular-tags">
                            <?php
                            $popular_tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => 8));
                            if ($popular_tags) {
                                foreach ($popular_tags as $tag) {
                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="popular-tag">' . esc_html($tag->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
