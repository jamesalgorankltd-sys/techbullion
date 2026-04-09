<?php
/**
 * Main Template File
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main">
    
    <?php if (is_home() && !is_front_page()) : ?>
        <header class="page-header">
            <div class="page-header-inner container">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
                <p class="page-description"><?php echo esc_html__('Latest news, insights, and updates from our team.', 'wacus'); ?></p>
            </div>
        </header>
    <?php endif; ?>

    <div class="content-sidebar-wrapper">
        <div class="main-content">
            
            <?php if (have_posts()) : ?>
                
                <div class="blog-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card reveal'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-card-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('wacus-blog-thumb', array('loading' => 'lazy')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="blog-card-content">
                                <div class="blog-card-meta">
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) :
                                        echo '<span class="blog-card-category">' . esc_html($categories[0]->name) . '</span>';
                                    endif;
                                    ?>
                                    <span class="blog-card-date"><?php echo get_the_date(); ?></span>
                                </div>
                                
                                <h2 class="blog-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="blog-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <?php
                // Pagination
                the_posts_pagination(array(
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                    'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                    'class'     => 'pagination',
                ));
                ?>
                
            <?php else : ?>
                
                <div class="no-posts">
                    <h2><?php esc_html_e('No Posts Found', 'wacus'); ?></h2>
                    <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'wacus'); ?></p>
                    <?php get_search_form(); ?>
                </div>
                
            <?php endif; ?>
            
        </div>
        
        <?php get_sidebar(); ?>
    </div>
    
</main>

<?php
get_footer();
