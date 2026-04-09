<?php
/**
 * Comments Template
 * 
 * @package WACUS
 */

// Don't load if password required
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title split-text">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('1 Comment', 'wacus')
                );
            } else {
                printf(
                    esc_html(_n('%s Comment', '%s Comments', $comment_count, 'wacus')),
                    number_format_i18n($comment_count)
                );
            }
            ?>
        </h2>

        <ol class="comment-list stagger-container">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'wacus_comment_callback',
            ));
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation">
                <div class="nav-links">
                    <div class="nav-previous">
                        <?php previous_comments_link(esc_html__('&larr; Older Comments', 'wacus')); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_comments_link(esc_html__('Newer Comments &rarr;', 'wacus')); ?>
                    </div>
                </div>
            </nav>
        <?php endif; ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'wacus'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    // Comment Form
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $fields = array(
        'author' => '<div class="comment-form-author form-group">
                        <label for="author">' . esc_html__('Name', 'wacus') . ($req ? ' <span class="required">*</span>' : '') . '</label>
                        <input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />
                    </div>',
        'email'  => '<div class="comment-form-email form-group">
                        <label for="email">' . esc_html__('Email', 'wacus') . ($req ? ' <span class="required">*</span>' : '') . '</label>
                        <input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />
                    </div>',
        'url'    => '<div class="comment-form-url form-group">
                        <label for="url">' . esc_html__('Website', 'wacus') . '</label>
                        <input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" />
                    </div>',
    );

    $comments_args = array(
        'title_reply'          => __('Leave a Comment', 'wacus'),
        'title_reply_to'       => __('Reply to %s', 'wacus'),
        'cancel_reply_link'    => __('Cancel Reply', 'wacus'),
        'label_submit'         => __('Post Comment', 'wacus'),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary magnetic btn-ripple"><span>%4$s</span></button>',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
        'comment_field'        => '<div class="comment-form-comment form-group">
                                    <label for="comment">' . esc_html__('Comment', 'wacus') . ' <span class="required">*</span></label>
                                    <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                  </div>',
        'fields'               => apply_filters('comment_form_default_fields', $fields),
        'class_form'           => 'comment-form fade-up',
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title split-text">',
        'title_reply_after'    => '</h3>',
    );

    comment_form($comments_args);
    ?>
</div>

<?php
/**
 * Custom Comment Callback
 */
if (!function_exists('wacus_comment_callback')) {
    function wacus_comment_callback($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('stagger-item'); ?>>
            <article class="comment-body">
                <div class="comment-meta">
                    <div class="comment-author vcard">
                        <?php echo get_avatar($comment, 60, '', '', array('class' => 'avatar')); ?>
                        <div class="author-info">
                            <span class="fn"><?php comment_author_link(); ?></span>
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    esc_html__('%1$s at %2$s', 'wacus'),
                                    get_comment_date(),
                                    get_comment_time()
                                );
                                ?>
                            </time>
                        </div>
                    </div>
                </div>

                <div class="comment-content">
                    <?php if ($comment->comment_approved == '0') : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'wacus'); ?></p>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>

                <div class="comment-actions">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<span class="reply-link">',
                        'after'     => '</span>',
                    )));
                    
                    edit_comment_link(esc_html__('Edit', 'wacus'), '<span class="edit-link">', '</span>');
                    ?>
                </div>
            </article>
        <?php
    }
}
?>
