<?php
/**
 * Theme Options Admin Page
 * 
 * @package WACUS
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Theme Options Menu
 */
function wacus_add_admin_menu() {
    add_theme_page(
        __('WACUS Theme Options', 'wacus'),
        __('Theme Options', 'wacus'),
        'manage_options',
        'wacus-options',
        'wacus_options_page'
    );
}
add_action('admin_menu', 'wacus_add_admin_menu');

/**
 * Register Settings
 */
function wacus_settings_init() {
    register_setting('wacus_options', 'wacus_options');

    // General Section
    add_settings_section(
        'wacus_general_section',
        __('General Settings', 'wacus'),
        'wacus_general_section_callback',
        'wacus_options'
    );

    // Google Analytics
    add_settings_field(
        'wacus_google_analytics',
        __('Google Analytics ID', 'wacus'),
        'wacus_google_analytics_render',
        'wacus_options',
        'wacus_general_section'
    );

    // Custom CSS
    add_settings_field(
        'wacus_custom_css',
        __('Custom CSS', 'wacus'),
        'wacus_custom_css_render',
        'wacus_options',
        'wacus_general_section'
    );

    // Custom JavaScript
    add_settings_field(
        'wacus_custom_js',
        __('Custom JavaScript', 'wacus'),
        'wacus_custom_js_render',
        'wacus_options',
        'wacus_general_section'
    );

    // Performance Section
    add_settings_section(
        'wacus_performance_section',
        __('Performance', 'wacus'),
        'wacus_performance_section_callback',
        'wacus_options'
    );

    // Minify CSS
    add_settings_field(
        'wacus_minify_css',
        __('Minify CSS', 'wacus'),
        'wacus_minify_css_render',
        'wacus_options',
        'wacus_performance_section'
    );

    // Minify JS
    add_settings_field(
        'wacus_minify_js',
        __('Minify JavaScript', 'wacus'),
        'wacus_minify_js_render',
        'wacus_options',
        'wacus_performance_section'
    );

    // Lazy Load
    add_settings_field(
        'wacus_lazy_load',
        __('Lazy Load Images', 'wacus'),
        'wacus_lazy_load_render',
        'wacus_options',
        'wacus_performance_section'
    );
}
add_action('admin_init', 'wacus_settings_init');

/**
 * Section Callbacks
 */
function wacus_general_section_callback() {
    echo '<p>' . esc_html__('Configure general theme settings.', 'wacus') . '</p>';
}

function wacus_performance_section_callback() {
    echo '<p>' . esc_html__('Optimize theme performance.', 'wacus') . '</p>';
}

/**
 * Field Render Callbacks
 */
function wacus_google_analytics_render() {
    $options = get_option('wacus_options');
    ?>
    <input type="text" name="wacus_options[google_analytics]" value="<?php echo isset($options['google_analytics']) ? esc_attr($options['google_analytics']) : ''; ?>" class="regular-text" placeholder="G-XXXXXXXXXX">
    <p class="description"><?php esc_html_e('Enter your Google Analytics 4 Measurement ID.', 'wacus'); ?></p>
    <?php
}

function wacus_custom_css_render() {
    $options = get_option('wacus_options');
    ?>
    <textarea name="wacus_options[custom_css]" rows="10" class="large-text code"><?php echo isset($options['custom_css']) ? esc_textarea($options['custom_css']) : ''; ?></textarea>
    <p class="description"><?php esc_html_e('Add custom CSS. Do not include &lt;style&gt; tags.', 'wacus'); ?></p>
    <?php
}

function wacus_custom_js_render() {
    $options = get_option('wacus_options');
    ?>
    <textarea name="wacus_options[custom_js]" rows="10" class="large-text code"><?php echo isset($options['custom_js']) ? esc_textarea($options['custom_js']) : ''; ?></textarea>
    <p class="description"><?php esc_html_e('Add custom JavaScript. Do not include &lt;script&gt; tags.', 'wacus'); ?></p>
    <?php
}

function wacus_minify_css_render() {
    $options = get_option('wacus_options');
    ?>
    <label>
        <input type="checkbox" name="wacus_options[minify_css]" value="1" <?php checked(isset($options['minify_css']) ? $options['minify_css'] : 0, 1); ?>>
        <?php esc_html_e('Enable CSS minification', 'wacus'); ?>
    </label>
    <?php
}

function wacus_minify_js_render() {
    $options = get_option('wacus_options');
    ?>
    <label>
        <input type="checkbox" name="wacus_options[minify_js]" value="1" <?php checked(isset($options['minify_js']) ? $options['minify_js'] : 0, 1); ?>>
        <?php esc_html_e('Enable JavaScript minification', 'wacus'); ?>
    </label>
    <?php
}

function wacus_lazy_load_render() {
    $options = get_option('wacus_options');
    ?>
    <label>
        <input type="checkbox" name="wacus_options[lazy_load]" value="1" <?php checked(isset($options['lazy_load']) ? $options['lazy_load'] : 1, 1); ?>>
        <?php esc_html_e('Enable lazy loading for images', 'wacus'); ?>
    </label>
    <?php
}

/**
 * Options Page HTML
 */
function wacus_options_page() {
    ?>
    <div class="wrap wacus-admin-wrap">
        <h1>
            <span class="dashicons dashicons-admin-customizer"></span>
            <?php esc_html_e('WACUS Theme Options', 'wacus'); ?>
        </h1>

        <div class="wacus-admin-header">
            <div class="wacus-admin-info">
                <p><?php esc_html_e('Configure your theme settings below. For more options, visit the Customizer.', 'wacus'); ?></p>
                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-secondary">
                    <span class="dashicons dashicons-admin-appearance"></span>
                    <?php esc_html_e('Open Customizer', 'wacus'); ?>
                </a>
            </div>
        </div>

        <div class="wacus-admin-tabs">
            <nav class="nav-tab-wrapper">
                <a href="#general" class="nav-tab nav-tab-active"><?php esc_html_e('General', 'wacus'); ?></a>
                <a href="#performance" class="nav-tab"><?php esc_html_e('Performance', 'wacus'); ?></a>
                <a href="#import-export" class="nav-tab"><?php esc_html_e('Import/Export', 'wacus'); ?></a>
                <a href="#support" class="nav-tab"><?php esc_html_e('Support', 'wacus'); ?></a>
            </nav>
        </div>

        <form action="options.php" method="post" class="wacus-ajax-form">
            <?php
            settings_fields('wacus_options');
            ?>

            <div id="general" class="wacus-tab-content active">
                <?php do_settings_sections('wacus_options'); ?>
            </div>

            <div id="performance" class="wacus-tab-content">
                <h2><?php esc_html_e('Performance Settings', 'wacus'); ?></h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php esc_html_e('Minify CSS', 'wacus'); ?></th>
                        <td><?php wacus_minify_css_render(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Minify JavaScript', 'wacus'); ?></th>
                        <td><?php wacus_minify_js_render(); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Lazy Load Images', 'wacus'); ?></th>
                        <td><?php wacus_lazy_load_render(); ?></td>
                    </tr>
                </table>
            </div>

            <div id="import-export" class="wacus-tab-content">
                <h2><?php esc_html_e('Import/Export Settings', 'wacus'); ?></h2>
                
                <div class="wacus-import-export-box">
                    <h3><?php esc_html_e('Export Settings', 'wacus'); ?></h3>
                    <p><?php esc_html_e('Export your theme settings to a JSON file.', 'wacus'); ?></p>
                    <button type="button" id="wacus-export-settings" class="button button-primary">
                        <span class="dashicons dashicons-download"></span>
                        <?php esc_html_e('Export Settings', 'wacus'); ?>
                    </button>
                </div>

                <div class="wacus-import-export-box">
                    <h3><?php esc_html_e('Import Settings', 'wacus'); ?></h3>
                    <p><?php esc_html_e('Import theme settings from a JSON file.', 'wacus'); ?></p>
                    <input type="file" id="wacus-import-file" accept=".json">
                </div>
            </div>

            <div id="support" class="wacus-tab-content">
                <h2><?php esc_html_e('Theme Support', 'wacus'); ?></h2>
                
                <div class="wacus-support-boxes">
                    <div class="wacus-support-box">
                        <h3>
                            <span class="dashicons dashicons-book"></span>
                            <?php esc_html_e('Documentation', 'wacus'); ?>
                        </h3>
                        <p><?php esc_html_e('Read the theme documentation for setup guides and tutorials.', 'wacus'); ?></p>
                        <a href="#" class="button button-secondary" target="_blank">
                            <?php esc_html_e('View Documentation', 'wacus'); ?>
                        </a>
                    </div>

                    <div class="wacus-support-box">
                        <h3>
                            <span class="dashicons dashicons-format-video"></span>
                            <?php esc_html_e('Video Tutorials', 'wacus'); ?>
                        </h3>
                        <p><?php esc_html_e('Watch video tutorials to learn how to use the theme.', 'wacus'); ?></p>
                        <a href="#" class="button button-secondary" target="_blank">
                            <?php esc_html_e('Watch Videos', 'wacus'); ?>
                        </a>
                    </div>

                    <div class="wacus-support-box">
                        <h3>
                            <span class="dashicons dashicons-sos"></span>
                            <?php esc_html_e('Support Ticket', 'wacus'); ?>
                        </h3>
                        <p><?php esc_html_e('Need help? Submit a support ticket.', 'wacus'); ?></p>
                        <a href="#" class="button button-secondary" target="_blank">
                            <?php esc_html_e('Get Support', 'wacus'); ?>
                        </a>
                    </div>

                    <div class="wacus-support-box">
                        <h3>
                            <span class="dashicons dashicons-star-filled"></span>
                            <?php esc_html_e('Rate Theme', 'wacus'); ?>
                        </h3>
                        <p><?php esc_html_e('Enjoying the theme? Leave a rating!', 'wacus'); ?></p>
                        <a href="#" class="button button-secondary" target="_blank">
                            <?php esc_html_e('Rate Now', 'wacus'); ?>
                        </a>
                    </div>
                </div>

                <div class="wacus-system-info">
                    <h3><?php esc_html_e('System Information', 'wacus'); ?></h3>
                    <table class="widefat">
                        <tr>
                            <td><?php esc_html_e('Theme Version', 'wacus'); ?></td>
                            <td><?php echo WACUS_VERSION; ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e('WordPress Version', 'wacus'); ?></td>
                            <td><?php echo get_bloginfo('version'); ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e('PHP Version', 'wacus'); ?></td>
                            <td><?php echo phpversion(); ?></td>
                        </tr>
                        <tr>
                            <td><?php esc_html_e('Memory Limit', 'wacus'); ?></td>
                            <td><?php echo ini_get('memory_limit'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>

    <style>
        .wacus-admin-wrap {
            max-width: 1200px;
        }
        .wacus-admin-header {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .wacus-admin-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .wacus-admin-tabs .nav-tab-wrapper {
            margin-bottom: 20px;
        }
        .wacus-tab-content {
            display: none;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .wacus-tab-content.active {
            display: block;
        }
        .wacus-import-export-box {
            background: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .wacus-support-boxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .wacus-support-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .wacus-support-box .dashicons {
            font-size: 40px;
            width: 40px;
            height: 40px;
            color: #0073aa;
        }
        .wacus-system-info table {
            background: #fff;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            $('.wacus-admin-tabs .nav-tab').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                
                $('.nav-tab').removeClass('nav-tab-active');
                $(this).addClass('nav-tab-active');
                
                $('.wacus-tab-content').removeClass('active');
                $(target).addClass('active');
            });
        });
    </script>
    <?php
}

/**
 * AJAX Export Settings
 */
function wacus_export_settings() {
    check_ajax_referer('wacus_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => __('Unauthorized', 'wacus')));
    }

    $settings = array(
        'theme_mods' => get_theme_mods(),
        'options'    => get_option('wacus_options'),
    );

    wp_send_json_success($settings);
}
add_action('wp_ajax_wacus_export_settings', 'wacus_export_settings');

/**
 * AJAX Import Settings
 */
function wacus_import_settings() {
    check_ajax_referer('wacus_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => __('Unauthorized', 'wacus')));
    }

    $settings = json_decode(stripslashes($_POST['settings']), true);

    if (empty($settings)) {
        wp_send_json_error(array('message' => __('Invalid settings file', 'wacus')));
    }

    // Import theme mods
    if (isset($settings['theme_mods'])) {
        foreach ($settings['theme_mods'] as $key => $value) {
            set_theme_mod($key, $value);
        }
    }

    // Import options
    if (isset($settings['options'])) {
        update_option('wacus_options', $settings['options']);
    }

    wp_send_json_success();
}
add_action('wp_ajax_wacus_import_settings', 'wacus_import_settings');

/**
 * Output Custom CSS and JS
 */
function wacus_output_custom_code() {
    $options = get_option('wacus_options');

    // Custom CSS
    if (!empty($options['custom_css'])) {
        echo '<style id="wacus-custom-css">' . wp_strip_all_tags($options['custom_css']) . '</style>';
    }

    // Custom JS
    if (!empty($options['custom_js'])) {
        echo '<script id="wacus-custom-js">' . $options['custom_js'] . '</script>';
    }
}
add_action('wp_head', 'wacus_output_custom_code', 999);

/**
 * Output Google Analytics
 */
function wacus_output_google_analytics() {
    $options = get_option('wacus_options');

    if (!empty($options['google_analytics'])) {
        $ga_id = esc_attr($options['google_analytics']);
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_id; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo $ga_id; ?>');
        </script>
        <?php
    }
}
add_action('wp_head', 'wacus_output_google_analytics', 1);
