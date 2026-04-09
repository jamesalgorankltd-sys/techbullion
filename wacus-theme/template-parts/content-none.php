<?php
/**
 * Template part for displaying a message when posts cannot be found
 * 
 * @package WACUS
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title split-text"><?php esc_html_e('Nothing Found', 'wacus'); ?></h1>
    </header>

    <div class="page-content fade-up">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>
            <p>
                <?php
                printf(
                    wp_kses(
                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wacus'),
                        array(
                            'a' => array(
                                'href' => array(),
                            ),
                        )
                    ),
                    esc_url(admin_url('post-new.php'))
                );
                ?>
            </p>
        <?php elseif (is_search()) : ?>
            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wacus'); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wacus'); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>
