<?php
/**
 * Custom Widgets
 * 
 * @package WACUS
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Recent Posts Widget
 */
class Wacus_Recent_Posts_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wacus_recent_posts',
            __('WACUS - Recent Posts', 'wacus'),
            array('description' => __('Display recent posts with thumbnails', 'wacus'))
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $query = new WP_Query(array(
            'posts_per_page' => $number,
            'no_found_rows' => true,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true
        ));

        if ($query->have_posts()) :
            echo '<ul class="wacus-recent-posts">';
            while ($query->have_posts()) : $query->the_post();
                ?>
                <li class="recent-post-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="recent-post-thumb img-zoom">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="recent-post-content">
                        <h4 class="recent-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <span class="recent-post-date"><?php echo get_the_date(); ?></span>
                    </div>
                </li>
                <?php
            endwhile;
            echo '</ul>';
            wp_reset_postdata();
        endif;

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent Posts', 'wacus');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts:', 'wacus'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = absint($new_instance['number']);
        return $instance;
    }
}

/**
 * Social Links Widget
 */
class Wacus_Social_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wacus_social',
            __('WACUS - Social Links', 'wacus'),
            array('description' => __('Display social media links', 'wacus'))
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $socials = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github');
        
        echo '<div class="social-links">';
        foreach ($socials as $social) {
            if (!empty($instance[$social])) {
                echo '<a href="' . esc_url($instance[$social]) . '" class="social-link magnetic" target="_blank" rel="noopener noreferrer">';
                echo '<span class="social-icon">' . wacus_get_social_icon($social) . '</span>';
                echo '</a>';
            }
        }
        echo '</div>';

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Follow Us', 'wacus');
        $socials = array(
            'facebook' => __('Facebook URL', 'wacus'),
            'twitter' => __('Twitter URL', 'wacus'),
            'instagram' => __('Instagram URL', 'wacus'),
            'linkedin' => __('LinkedIn URL', 'wacus'),
            'youtube' => __('YouTube URL', 'wacus'),
            'github' => __('GitHub URL', 'wacus')
        );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
        foreach ($socials as $key => $label) :
            $value = !empty($instance[$key]) ? $instance[$key] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id($key)); ?>"><?php echo esc_html($label); ?>:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="url" value="<?php echo esc_url($value); ?>">
        </p>
        <?php
        endforeach;
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $socials = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github');
        foreach ($socials as $social) {
            $instance[$social] = esc_url_raw($new_instance[$social]);
        }
        return $instance;
    }
}

/**
 * About Widget
 */
class Wacus_About_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wacus_about',
            __('WACUS - About', 'wacus'),
            array('description' => __('Display about information with logo', 'wacus'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <div class="about-widget">
            <?php if (!empty($instance['logo'])) : ?>
                <div class="about-logo">
                    <img src="<?php echo esc_url($instance['logo']); ?>" alt="<?php echo esc_attr($instance['title']); ?>">
                </div>
            <?php endif; ?>
            
            <?php if (!empty($instance['title'])) : ?>
                <h4 class="about-title"><?php echo esc_html($instance['title']); ?></h4>
            <?php endif; ?>
            
            <?php if (!empty($instance['description'])) : ?>
                <p class="about-description"><?php echo esc_html($instance['description']); ?></p>
            <?php endif; ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $logo = !empty($instance['logo']) ? $instance['logo'] : '';
        $description = !empty($instance['description']) ? $instance['description'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo')); ?>"><?php esc_html_e('Logo URL:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('logo')); ?>" name="<?php echo esc_attr($this->get_field_name('logo')); ?>" type="url" value="<?php echo esc_url($logo); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php esc_html_e('Description:', 'wacus'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" rows="4"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['logo'] = esc_url_raw($new_instance['logo']);
        $instance['description'] = sanitize_textarea_field($new_instance['description']);
        return $instance;
    }
}

/**
 * Contact Info Widget
 */
class Wacus_Contact_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wacus_contact',
            __('WACUS - Contact Info', 'wacus'),
            array('description' => __('Display contact information', 'wacus'))
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
        ?>
        <ul class="contact-info-list">
            <?php if (!empty($instance['address'])) : ?>
                <li class="contact-item">
                    <span class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </span>
                    <span class="contact-text"><?php echo esc_html($instance['address']); ?></span>
                </li>
            <?php endif; ?>
            
            <?php if (!empty($instance['phone'])) : ?>
                <li class="contact-item">
                    <span class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </span>
                    <a href="tel:<?php echo esc_attr($instance['phone']); ?>" class="contact-text"><?php echo esc_html($instance['phone']); ?></a>
                </li>
            <?php endif; ?>
            
            <?php if (!empty($instance['email'])) : ?>
                <li class="contact-item">
                    <span class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <a href="mailto:<?php echo esc_attr($instance['email']); ?>" class="contact-text"><?php echo esc_html($instance['email']); ?></a>
                </li>
            <?php endif; ?>
            
            <?php if (!empty($instance['hours'])) : ?>
                <li class="contact-item">
                    <span class="contact-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </span>
                    <span class="contact-text"><?php echo esc_html($instance['hours']); ?></span>
                </li>
            <?php endif; ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Contact Info', 'wacus');
        $address = !empty($instance['address']) ? $instance['address'] : '';
        $phone = !empty($instance['phone']) ? $instance['phone'] : '';
        $email = !empty($instance['email']) ? $instance['email'] : '';
        $hours = !empty($instance['hours']) ? $instance['hours'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_attr($address); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="tel" value="<?php echo esc_attr($phone); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="email" value="<?php echo esc_attr($email); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('hours')); ?>"><?php esc_html_e('Business Hours:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('hours')); ?>" name="<?php echo esc_attr($this->get_field_name('hours')); ?>" type="text" value="<?php echo esc_attr($hours); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['address'] = sanitize_text_field($new_instance['address']);
        $instance['phone'] = sanitize_text_field($new_instance['phone']);
        $instance['email'] = sanitize_email($new_instance['email']);
        $instance['hours'] = sanitize_text_field($new_instance['hours']);
        return $instance;
    }
}

/**
 * Newsletter Widget
 */
class Wacus_Newsletter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wacus_newsletter',
            __('WACUS - Newsletter', 'wacus'),
            array('description' => __('Display newsletter subscription form', 'wacus'))
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];
        ?>
        <div class="newsletter-widget">
            <?php if ($title) : ?>
                <h4 class="newsletter-title"><?php echo esc_html($title); ?></h4>
            <?php endif; ?>
            
            <?php if (!empty($instance['description'])) : ?>
                <p class="newsletter-description"><?php echo esc_html($instance['description']); ?></p>
            <?php endif; ?>
            
            <form class="newsletter-form" action="#" method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="<?php esc_attr_e('Enter your email', 'wacus'); ?>" required>
                    <button type="submit" class="btn btn-primary magnetic btn-ripple">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>
            </form>
            
            <?php if (!empty($instance['note'])) : ?>
                <p class="newsletter-note"><?php echo esc_html($instance['note']); ?></p>
            <?php endif; ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Subscribe', 'wacus');
        $description = !empty($instance['description']) ? $instance['description'] : '';
        $note = !empty($instance['note']) ? $instance['note'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php esc_html_e('Description:', 'wacus'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" rows="3"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('note')); ?>"><?php esc_html_e('Note (privacy text):', 'wacus'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('note')); ?>" name="<?php echo esc_attr($this->get_field_name('note')); ?>" type="text" value="<?php echo esc_attr($note); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['description'] = sanitize_textarea_field($new_instance['description']);
        $instance['note'] = sanitize_text_field($new_instance['note']);
        return $instance;
    }
}

/**
 * Register Widgets
 */
function wacus_register_widgets() {
    register_widget('Wacus_Recent_Posts_Widget');
    register_widget('Wacus_Social_Widget');
    register_widget('Wacus_About_Widget');
    register_widget('Wacus_Contact_Widget');
    register_widget('Wacus_Newsletter_Widget');
}
add_action('widgets_init', 'wacus_register_widgets');

/**
 * Get Social Icon
 */
function wacus_get_social_icon($social) {
    $icons = array(
        'facebook' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
        'twitter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
        'instagram' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
        'linkedin' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
        'youtube' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#fff"></polygon></svg>',
        'github' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"></path></svg>'
    );

    return isset($icons[$social]) ? $icons[$social] : '';
}
