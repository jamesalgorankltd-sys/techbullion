<?php
/**
 * Default Page Template
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <header class="page-header">
            <div class="page-header-inner container">
                <h1 class="page-title reveal"><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="page-description reveal"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>
            </div>
        </header>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="page-featured-image reveal image-reveal">
                <div class="container">
                    <?php the_post_thumbnail('wacus-hero', array('loading' => 'lazy')); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="page-content">
            <div class="page-content-inner container">
                <article id="page-<?php the_ID(); ?>" <?php post_class('reveal'); ?>>
                    <div class="entry-content">
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
                    
                    <?php if (get_edit_post_link()) : ?>
                        <footer class="entry-footer">
                            <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        __('Edit <span class="screen-reader-text">%s</span>', 'wacus'),
                                        array('span' => array('class' => array()))
                                    ),
                                    get_the_title()
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>
                    <?php endif; ?>
                </article>
                
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>
        
    <?php endwhile; ?>
    
</main>

<?php
get_footer();
