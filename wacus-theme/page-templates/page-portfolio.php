<?php
/**
 * Template Name: Portfolio Page
 * Template Post Type: page
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main portfolio-page">
    
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-inner container">
            <span class="section-badge reveal"><?php esc_html_e('Our Works', 'wacus'); ?></span>
            <h1 class="page-title reveal"><?php the_title(); ?></h1>
            <p class="page-description reveal"><?php esc_html_e('Explore our latest projects and see how we help businesses grow through innovative digital solutions.', 'wacus'); ?></p>
        </div>
    </header>
    
    <!-- Portfolio Filter -->
    <section class="section portfolio-filter-section">
        <div class="container">
            <div class="portfolio-filters reveal">
                <button class="filter-btn active" data-filter="*"><?php esc_html_e('All', 'wacus'); ?></button>
                <?php
                $categories = get_terms(array(
                    'taxonomy'   => 'portfolio_category',
                    'hide_empty' => true,
                ));
                
                if ($categories && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                        ?>
                        <button class="filter-btn" data-filter=".<?php echo esc_attr($category->slug); ?>">
                            <?php echo esc_html($category->name); ?>
                        </button>
                        <?php
                    endforeach;
                else :
                    // Fallback categories
                    $fallback_cats = array('Web', 'Marketing', 'Medical', 'E-commerce', 'Corporate');
                    foreach ($fallback_cats as $cat) :
                        ?>
                        <button class="filter-btn" data-filter=".<?php echo esc_attr(sanitize_title($cat)); ?>">
                            <?php echo esc_html($cat); ?>
                        </button>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
            
            <!-- Portfolio Grid -->
            <div class="portfolio-grid-masonry" id="portfolio-grid">
                <?php
                $portfolio_query = new WP_Query(array(
                    'post_type'      => 'portfolio',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));
                
                if ($portfolio_query->have_posts()) :
                    $count = 0;
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $count++;
                        $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                        $category_classes = '';
                        $category_name = '';
                        
                        if ($categories && !is_wp_error($categories)) {
                            $category_classes = implode(' ', wp_list_pluck($categories, 'slug'));
                            $category_name = $categories[0]->name;
                        }
                        
                        $featured_class = ($count % 5 === 1) ? 'featured' : '';
                        ?>
                        <div class="portfolio-item <?php echo esc_attr($category_classes . ' ' . $featured_class); ?> reveal">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('wacus-portfolio', array('loading' => 'lazy')); ?>
                                <?php else : ?>
                                    <div class="portfolio-placeholder"></div>
                                <?php endif; ?>
                                
                                <div class="portfolio-overlay">
                                    <?php if ($category_name) : ?>
                                        <span class="portfolio-category"><?php echo esc_html($category_name); ?></span>
                                    <?php endif; ?>
                                    <h3 class="portfolio-title"><?php the_title(); ?></h3>
                                    <p class="portfolio-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                    <span class="portfolio-link">
                                        <?php esc_html_e('View Project', 'wacus'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback portfolio items
                    $fallback_items = array(
                        array('title' => 'The Youth Clinic', 'category' => 'Medical', 'slug' => 'medical'),
                        array('title' => 'The One Seoul Eye Clinic', 'category' => 'Healthcare', 'slug' => 'medical'),
                        array('title' => 'YES EYE CLINIC', 'category' => 'Medical', 'slug' => 'medical'),
                        array('title' => 'ERGO-CORPORATION', 'category' => 'Corporate', 'slug' => 'corporate'),
                        array('title' => 'HYEYUM', 'category' => 'Brand', 'slug' => 'web'),
                        array('title' => 'NSON', 'category' => 'E-commerce', 'slug' => 'e-commerce'),
                        array('title' => 'Tech Startup Landing', 'category' => 'Web', 'slug' => 'web'),
                        array('title' => 'Fashion Brand Store', 'category' => 'E-commerce', 'slug' => 'e-commerce'),
                        array('title' => 'Healthcare Platform', 'category' => 'Medical', 'slug' => 'medical'),
                    );
                    
                    $count = 0;
                    foreach ($fallback_items as $item) :
                        $count++;
                        $featured_class = ($count % 5 === 1) ? 'featured' : '';
                        ?>
                        <div class="portfolio-item <?php echo esc_attr($item['slug'] . ' ' . $featured_class); ?> reveal">
                            <div class="portfolio-placeholder"></div>
                            <div class="portfolio-overlay">
                                <span class="portfolio-category"><?php echo esc_html($item['category']); ?></span>
                                <h3 class="portfolio-title"><?php echo esc_html($item['title']); ?></h3>
                                <span class="portfolio-link">
                                    <?php esc_html_e('View Project', 'wacus'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-xl reveal">
                <button class="btn btn-secondary load-more-btn magnetic" id="load-more-portfolio">
                    <span class="magnetic-btn-inner">
                        <?php esc_html_e('Load More', 'wacus'); ?>
                    </span>
                </button>
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="section experience-section">
        <div class="container">
            <div class="experience-stats">
                <div class="stat-item reveal">
                    <div class="stat-number">
                        <span class="count" data-target="<?php echo esc_attr(get_theme_mod('wacus_stat_web', '194')); ?>">0</span>
                        <span class="suffix">+</span>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Websites Built', 'wacus'); ?></div>
                </div>
                
                <div class="stat-item reveal">
                    <div class="stat-number">
                        <span class="count" data-target="<?php echo esc_attr(get_theme_mod('wacus_stat_marketing', '680')); ?>">0</span>
                        <span class="suffix">+</span>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Marketing Campaigns', 'wacus'); ?></div>
                </div>
                
                <div class="stat-item reveal">
                    <div class="stat-number">
                        <span class="count" data-target="500">0</span>
                        <span class="suffix">+</span>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Happy Clients', 'wacus'); ?></div>
                </div>
                
                <div class="stat-item reveal">
                    <div class="stat-number">
                        <span class="count" data-target="98">0</span>
                        <span class="suffix">%</span>
                    </div>
                    <div class="stat-label"><?php esc_html_e('Client Satisfaction', 'wacus'); ?></div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title reveal"><?php esc_html_e('Have a project in mind?', 'wacus'); ?></h2>
                <p class="cta-description reveal"><?php esc_html_e('Let\'s work together to create something amazing. Contact us to discuss your project.', 'wacus'); ?></p>
                <div class="reveal">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-large magnetic">
                        <span class="magnetic-btn-inner">
                            <?php esc_html_e('Start Your Project', 'wacus'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
