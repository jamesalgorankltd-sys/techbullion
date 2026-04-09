<?php
/**
 * WACUS Theme Functions
 *
 * @package WACUS
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('WACUS_VERSION', '1.0.0');
define('WACUS_DIR', get_template_directory());
define('WACUS_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function wacus_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');

    // Custom image sizes
    add_image_size('wacus-hero', 1920, 1080, true);
    add_image_size('wacus-portfolio', 800, 600, true);
    add_image_size('wacus-blog-thumb', 600, 400, true);
    add_image_size('wacus-blog-featured', 1200, 675, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'wacus'),
        'footer'    => esc_html__('Footer Menu', 'wacus'),
        'footer-2'  => esc_html__('Footer Menu 2', 'wacus'),
        'footer-3'  => esc_html__('Footer Menu 3', 'wacus'),
        'social'    => esc_html__('Social Menu', 'wacus'),
    ));

    // Load text domain
    load_theme_textdomain('wacus', WACUS_DIR . '/languages');
}
add_action('after_setup_theme', 'wacus_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function wacus_enqueue_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'wacus-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap',
        array(),
        null
    );

    // Main Stylesheet
    wp_enqueue_style(
        'wacus-style',
        get_stylesheet_uri(),
        array(),
        WACUS_VERSION
    );

    // Custom Animations CSS
    wp_enqueue_style(
        'wacus-animations',
        WACUS_URI . '/assets/css/animations.css',
        array('wacus-style'),
        WACUS_VERSION
    );

    // GSAP CDN
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );

    // GSAP ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array('gsap'),
        '3.12.5',
        true
    );

    // GSAP ScrollSmoother (Club GreenSock - using alternative)
    wp_enqueue_script(
        'gsap-scrollsmoother',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollSmoother.min.js',
        array('gsap', 'gsap-scrolltrigger'),
        '3.12.5',
        true
    );

    // Lenis Smooth Scroll
    wp_enqueue_script(
        'lenis',
        'https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js',
        array(),
        '1.0.42',
        true
    );

    // Three.js
    wp_enqueue_script(
        'three-js',
        'https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js',
        array(),
        'r134',
        true
    );

    // Split Type for text animations
    wp_enqueue_script(
        'split-type',
        'https://unpkg.com/split-type@0.3.3/umd/index.min.js',
        array(),
        '0.3.3',
        true
    );

    // Main Theme JS
    wp_enqueue_script(
        'wacus-main',
        WACUS_URI . '/assets/js/main.js',
        array('jquery', 'gsap', 'gsap-scrolltrigger', 'lenis', 'three-js'),
        WACUS_VERSION,
        true
    );

    // Cursor Effects JS
    wp_enqueue_script(
        'wacus-cursor',
        WACUS_URI . '/assets/js/cursor.js',
        array('jquery', 'gsap'),
        WACUS_VERSION,
        true
    );

    // 3D Effects JS
    wp_enqueue_script(
        'wacus-3d',
        WACUS_URI . '/assets/js/3d-effects.js',
        array('three-js'),
        WACUS_VERSION,
        true
    );

    // Animations JS
    wp_enqueue_script(
        'wacus-animations',
        WACUS_URI . '/assets/js/animations.js',
        array('gsap', 'gsap-scrolltrigger', 'split-type'),
        WACUS_VERSION,
        true
    );

    // Localize script
    wp_localize_script('wacus-main', 'wacusData', array(
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('wacus_nonce'),
        'themeUri'  => WACUS_URI,
        'homeUrl'   => home_url(),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wacus_enqueue_scripts');

/**
 * Enqueue Admin Scripts
 */
function wacus_admin_scripts() {
    wp_enqueue_style(
        'wacus-admin',
        WACUS_URI . '/assets/css/admin.css',
        array(),
        WACUS_VERSION
    );
}
add_action('admin_enqueue_scripts', 'wacus_admin_scripts');

/**
 * Register Sidebars and Widgets
 */
function wacus_widgets_init() {
    // Main Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', 'wacus'),
        'id'            => 'sidebar-main',
        'description'   => esc_html__('Add widgets here for the main sidebar.', 'wacus'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Footer Widget Areas
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Widget %d', 'wacus'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Add widgets here for footer column %d.', 'wacus'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'wacus_widgets_init');

/**
 * Custom Nav Walker Class
 */
class Wacus_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id_attr = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';
        
        $output .= $indent . '<li' . $id_attr . $class_names . '>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        if (in_array('current-menu-item', $classes)) {
            $atts['class'] = 'active';
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom Excerpt Length
 */
function wacus_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'wacus_excerpt_length');

/**
 * Custom Excerpt More
 */
function wacus_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'wacus_excerpt_more');

/**
 * Add SVG Support
 */
function wacus_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'wacus_mime_types');

/**
 * Preloader Function
 */
function wacus_preloader() {
    ?>
    <div class="wacus-loader" id="wacus-loader">
        <div class="loader-logo">WACUS</div>
        <div class="loader-progress">
            <div class="loader-progress-bar" id="loader-progress-bar"></div>
        </div>
        <div class="loader-text">Loading...</div>
    </div>
    <?php
}

/**
 * Custom Cursor Function
 */
function wacus_custom_cursor() {
    ?>
    <div class="custom-cursor" id="custom-cursor"></div>
    <div class="custom-cursor-dot" id="custom-cursor-dot"></div>
    <?php
}

/**
 * Register Custom Post Types
 */
function wacus_register_post_types() {
    // Portfolio Post Type
    register_post_type('portfolio', array(
        'labels' => array(
            'name'               => esc_html__('Portfolio', 'wacus'),
            'singular_name'      => esc_html__('Project', 'wacus'),
            'add_new'            => esc_html__('Add New Project', 'wacus'),
            'add_new_item'       => esc_html__('Add New Project', 'wacus'),
            'edit_item'          => esc_html__('Edit Project', 'wacus'),
            'new_item'           => esc_html__('New Project', 'wacus'),
            'view_item'          => esc_html__('View Project', 'wacus'),
            'search_items'       => esc_html__('Search Projects', 'wacus'),
            'not_found'          => esc_html__('No projects found', 'wacus'),
            'not_found_in_trash' => esc_html__('No projects found in Trash', 'wacus'),
            'menu_name'          => esc_html__('Portfolio', 'wacus'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'portfolio'),
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'           => 'dashicons-portfolio',
        'show_in_rest'        => true,
    ));

    // Services Post Type
    register_post_type('service', array(
        'labels' => array(
            'name'               => esc_html__('Services', 'wacus'),
            'singular_name'      => esc_html__('Service', 'wacus'),
            'add_new'            => esc_html__('Add New Service', 'wacus'),
            'add_new_item'       => esc_html__('Add New Service', 'wacus'),
            'edit_item'          => esc_html__('Edit Service', 'wacus'),
            'new_item'           => esc_html__('New Service', 'wacus'),
            'view_item'          => esc_html__('View Service', 'wacus'),
            'search_items'       => esc_html__('Search Services', 'wacus'),
            'not_found'          => esc_html__('No services found', 'wacus'),
            'not_found_in_trash' => esc_html__('No services found in Trash', 'wacus'),
            'menu_name'          => esc_html__('Services', 'wacus'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'services'),
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'           => 'dashicons-admin-generic',
        'show_in_rest'        => true,
    ));

    // Team Post Type
    register_post_type('team', array(
        'labels' => array(
            'name'               => esc_html__('Team', 'wacus'),
            'singular_name'      => esc_html__('Team Member', 'wacus'),
            'add_new'            => esc_html__('Add New Member', 'wacus'),
            'add_new_item'       => esc_html__('Add New Team Member', 'wacus'),
            'edit_item'          => esc_html__('Edit Team Member', 'wacus'),
            'new_item'           => esc_html__('New Team Member', 'wacus'),
            'view_item'          => esc_html__('View Team Member', 'wacus'),
            'search_items'       => esc_html__('Search Team Members', 'wacus'),
            'not_found'          => esc_html__('No team members found', 'wacus'),
            'not_found_in_trash' => esc_html__('No team members found in Trash', 'wacus'),
            'menu_name'          => esc_html__('Team', 'wacus'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'team'),
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'           => 'dashicons-groups',
        'show_in_rest'        => true,
    ));

    // Testimonials Post Type
    register_post_type('testimonial', array(
        'labels' => array(
            'name'               => esc_html__('Testimonials', 'wacus'),
            'singular_name'      => esc_html__('Testimonial', 'wacus'),
            'add_new'            => esc_html__('Add New Testimonial', 'wacus'),
            'add_new_item'       => esc_html__('Add New Testimonial', 'wacus'),
            'edit_item'          => esc_html__('Edit Testimonial', 'wacus'),
            'new_item'           => esc_html__('New Testimonial', 'wacus'),
            'view_item'          => esc_html__('View Testimonial', 'wacus'),
            'search_items'       => esc_html__('Search Testimonials', 'wacus'),
            'not_found'          => esc_html__('No testimonials found', 'wacus'),
            'not_found_in_trash' => esc_html__('No testimonials found in Trash', 'wacus'),
            'menu_name'          => esc_html__('Testimonials', 'wacus'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'testimonials'),
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon'           => 'dashicons-format-quote',
        'show_in_rest'        => true,
    ));

    // FAQ Post Type
    register_post_type('faq', array(
        'labels' => array(
            'name'               => esc_html__('FAQs', 'wacus'),
            'singular_name'      => esc_html__('FAQ', 'wacus'),
            'add_new'            => esc_html__('Add New FAQ', 'wacus'),
            'add_new_item'       => esc_html__('Add New FAQ', 'wacus'),
            'edit_item'          => esc_html__('Edit FAQ', 'wacus'),
            'new_item'           => esc_html__('New FAQ', 'wacus'),
            'view_item'          => esc_html__('View FAQ', 'wacus'),
            'search_items'       => esc_html__('Search FAQs', 'wacus'),
            'not_found'          => esc_html__('No FAQs found', 'wacus'),
            'not_found_in_trash' => esc_html__('No FAQs found in Trash', 'wacus'),
            'menu_name'          => esc_html__('FAQs', 'wacus'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'faq'),
        'supports'            => array('title', 'editor', 'custom-fields'),
        'menu_icon'           => 'dashicons-editor-help',
        'show_in_rest'        => true,
    ));
}
add_action('init', 'wacus_register_post_types');

/**
 * Register Custom Taxonomies
 */
function wacus_register_taxonomies() {
    // Portfolio Categories
    register_taxonomy('portfolio_category', 'portfolio', array(
        'labels' => array(
            'name'              => esc_html__('Portfolio Categories', 'wacus'),
            'singular_name'     => esc_html__('Portfolio Category', 'wacus'),
            'search_items'      => esc_html__('Search Categories', 'wacus'),
            'all_items'         => esc_html__('All Categories', 'wacus'),
            'parent_item'       => esc_html__('Parent Category', 'wacus'),
            'parent_item_colon' => esc_html__('Parent Category:', 'wacus'),
            'edit_item'         => esc_html__('Edit Category', 'wacus'),
            'update_item'       => esc_html__('Update Category', 'wacus'),
            'add_new_item'      => esc_html__('Add New Category', 'wacus'),
            'new_item_name'     => esc_html__('New Category Name', 'wacus'),
            'menu_name'         => esc_html__('Categories', 'wacus'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => array('slug' => 'portfolio-category'),
        'show_in_rest'      => true,
    ));

    // Service Categories
    register_taxonomy('service_category', 'service', array(
        'labels' => array(
            'name'              => esc_html__('Service Categories', 'wacus'),
            'singular_name'     => esc_html__('Service Category', 'wacus'),
            'search_items'      => esc_html__('Search Categories', 'wacus'),
            'all_items'         => esc_html__('All Categories', 'wacus'),
            'edit_item'         => esc_html__('Edit Category', 'wacus'),
            'update_item'       => esc_html__('Update Category', 'wacus'),
            'add_new_item'      => esc_html__('Add New Category', 'wacus'),
            'new_item_name'     => esc_html__('New Category Name', 'wacus'),
            'menu_name'         => esc_html__('Categories', 'wacus'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => array('slug' => 'service-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'wacus_register_taxonomies');

/**
 * Theme Customizer
 */
function wacus_customize_register($wp_customize) {
    // Theme Options Panel
    $wp_customize->add_panel('wacus_theme_options', array(
        'title'       => esc_html__('WACUS Theme Options', 'wacus'),
        'description' => esc_html__('Customize your WACUS theme', 'wacus'),
        'priority'    => 30,
    ));

    // General Settings Section
    $wp_customize->add_section('wacus_general_settings', array(
        'title'    => esc_html__('General Settings', 'wacus'),
        'panel'    => 'wacus_theme_options',
        'priority' => 10,
    ));

    // Preloader Setting
    $wp_customize->add_setting('wacus_enable_preloader', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));
    $wp_customize->add_control('wacus_enable_preloader', array(
        'label'   => esc_html__('Enable Preloader', 'wacus'),
        'section' => 'wacus_general_settings',
        'type'    => 'checkbox',
    ));

    // Custom Cursor Setting
    $wp_customize->add_setting('wacus_enable_cursor', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));
    $wp_customize->add_control('wacus_enable_cursor', array(
        'label'   => esc_html__('Enable Custom Cursor', 'wacus'),
        'section' => 'wacus_general_settings',
        'type'    => 'checkbox',
    ));

    // Smooth Scroll Setting
    $wp_customize->add_setting('wacus_enable_smooth_scroll', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));
    $wp_customize->add_control('wacus_enable_smooth_scroll', array(
        'label'   => esc_html__('Enable Smooth Scroll', 'wacus'),
        'section' => 'wacus_general_settings',
        'type'    => 'checkbox',
    ));

    // Header Section
    $wp_customize->add_section('wacus_header_settings', array(
        'title'    => esc_html__('Header Settings', 'wacus'),
        'panel'    => 'wacus_theme_options',
        'priority' => 20,
    ));

    // Header CTA Text
    $wp_customize->add_setting('wacus_header_cta_text', array(
        'default'           => 'Contact Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('wacus_header_cta_text', array(
        'label'   => esc_html__('Header CTA Text', 'wacus'),
        'section' => 'wacus_header_settings',
        'type'    => 'text',
    ));

    // Header CTA Link
    $wp_customize->add_setting('wacus_header_cta_link', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('wacus_header_cta_link', array(
        'label'   => esc_html__('Header CTA Link', 'wacus'),
        'section' => 'wacus_header_settings',
        'type'    => 'url',
    ));

    // Footer Section
    $wp_customize->add_section('wacus_footer_settings', array(
        'title'    => esc_html__('Footer Settings', 'wacus'),
        'panel'    => 'wacus_theme_options',
        'priority' => 30,
    ));

    // Footer Description
    $wp_customize->add_setting('wacus_footer_description', array(
        'default'           => 'We bridge the gap between Korean innovation and U.S. market needs.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('wacus_footer_description', array(
        'label'   => esc_html__('Footer Description', 'wacus'),
        'section' => 'wacus_footer_settings',
        'type'    => 'textarea',
    ));

    // Copyright Text
    $wp_customize->add_setting('wacus_copyright_text', array(
        'default'           => 'WACUS Global. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('wacus_copyright_text', array(
        'label'   => esc_html__('Copyright Text', 'wacus'),
        'section' => 'wacus_footer_settings',
        'type'    => 'text',
    ));

    // Social Links Section
    $wp_customize->add_section('wacus_social_links', array(
        'title'    => esc_html__('Social Links', 'wacus'),
        'panel'    => 'wacus_theme_options',
        'priority' => 40,
    ));

    $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube');
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('wacus_' . $network . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('wacus_' . $network . '_url', array(
            'label'   => sprintf(esc_html__('%s URL', 'wacus'), ucfirst($network)),
            'section' => 'wacus_social_links',
            'type'    => 'url',
        ));
    }

    // Contact Section
    $wp_customize->add_section('wacus_contact_info', array(
        'title'    => esc_html__('Contact Information', 'wacus'),
        'panel'    => 'wacus_theme_options',
        'priority' => 50,
    ));

    // Email
    $wp_customize->add_setting('wacus_email', array(
        'default'           => 'hello@wacusglobal.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('wacus_email', array(
        'label'   => esc_html__('Email Address', 'wacus'),
        'section' => 'wacus_contact_info',
        'type'    => 'email',
    ));

    // Phone
    $wp_customize->add_setting('wacus_phone', array(
        'default'           => '+82-70-4288-0067',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('wacus_phone', array(
        'label'   => esc_html__('Phone Number', 'wacus'),
        'section' => 'wacus_contact_info',
        'type'    => 'text',
    ));

    // Address
    $wp_customize->add_setting('wacus_address', array(
        'default'           => '4F, 467, Songpa-daero, Songpa-gu, Seoul, South Korea',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('wacus_address', array(
        'label'   => esc_html__('Office Address', 'wacus'),
        'section' => 'wacus_contact_info',
        'type'    => 'textarea',
    ));

    // Stats Section
    $wp_customize->add_section('wacus_stats', array(
        'title'    => esc_html__('Statistics', 'wacus'),
        'panel'    => 'wacus_theme_options',
        'priority' => 60,
    ));

    $stats = array(
        'web'         => array('label' => 'Web Projects', 'default' => '194'),
        'marketing'   => array('label' => 'Marketing Campaigns', 'default' => '680'),
        'performance' => array('label' => 'Performance Projects', 'default' => '163'),
        'video'       => array('label' => 'Video Productions', 'default' => '387'),
    );

    foreach ($stats as $key => $stat) {
        $wp_customize->add_setting('wacus_stat_' . $key, array(
            'default'           => $stat['default'],
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control('wacus_stat_' . $key, array(
            'label'   => sprintf(esc_html__('%s Count', 'wacus'), $stat['label']),
            'section' => 'wacus_stats',
            'type'    => 'number',
        ));
    }
}
add_action('customize_register', 'wacus_customize_register');

/**
 * Sanitize Checkbox
 */
function wacus_sanitize_checkbox($input) {
    return (isset($input) && $input === true) ? true : false;
}

/**
 * AJAX Contact Form Handler
 */
function wacus_contact_form_handler() {
    check_ajax_referer('wacus_nonce', 'nonce');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'wacus')));
    }

    $to = get_option('admin_email');
    $subject = sprintf(__('New Contact Form Submission from %s', 'wacus'), $name);
    
    $body = sprintf(
        __("Name: %s\nEmail: %s\nCompany: %s\nPhone: %s\n\nMessage:\n%s", 'wacus'),
        $name,
        $email,
        $company,
        $phone,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    );

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => __('Thank you for your message. We will get back to you soon!', 'wacus')));
    } else {
        wp_send_json_error(array('message' => __('Failed to send message. Please try again.', 'wacus')));
    }
}
add_action('wp_ajax_wacus_contact_form', 'wacus_contact_form_handler');
add_action('wp_ajax_nopriv_wacus_contact_form', 'wacus_contact_form_handler');

/**
 * Body Class Filter
 */
function wacus_body_class($classes) {
    // Add preloader class
    if (get_theme_mod('wacus_enable_preloader', true)) {
        $classes[] = 'has-preloader';
    }

    // Add custom cursor class
    if (get_theme_mod('wacus_enable_cursor', true)) {
        $classes[] = 'has-custom-cursor';
    }

    // Add smooth scroll class
    if (get_theme_mod('wacus_enable_smooth_scroll', true)) {
        $classes[] = 'has-smooth-scroll';
    }

    return $classes;
}
add_filter('body_class', 'wacus_body_class');

/**
 * Include Template Parts
 */
require_once WACUS_DIR . '/inc/template-tags.php';
require_once WACUS_DIR . '/inc/template-functions.php';
require_once WACUS_DIR . '/inc/customizer.php';
require_once WACUS_DIR . '/inc/widgets.php';

/**
 * Register Block Patterns
 */
function wacus_register_block_patterns() {
    register_block_pattern_category('wacus', array(
        'label' => __('WACUS Patterns', 'wacus'),
    ));
}
add_action('init', 'wacus_register_block_patterns');

/**
 * Disable WordPress Emoji
 */
function wacus_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'wacus_disable_emojis');

/**
 * Add Async/Defer to Scripts
 */
function wacus_script_loader_tag($tag, $handle) {
    $async_scripts = array('gsap', 'gsap-scrolltrigger', 'three-js', 'lenis');
    $defer_scripts = array('wacus-main', 'wacus-cursor', 'wacus-3d', 'wacus-animations');
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'wacus_script_loader_tag', 10, 2);

/**
 * Add Preconnect for External Resources
 */
function wacus_resource_hints($urls, $relation_type) {
    if ($relation_type === 'preconnect') {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'wacus_resource_hints', 10, 2);
