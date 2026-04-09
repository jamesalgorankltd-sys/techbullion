<?php
/**
 * Theme Customizer
 * 
 * @package WACUS
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Customizer Settings
 */
function wacus_customize_register($wp_customize) {
    
    // =====================================================
    // GENERAL SETTINGS
    // =====================================================
    $wp_customize->add_panel('wacus_general_panel', array(
        'title'       => __('General Settings', 'wacus'),
        'priority'    => 10,
    ));

    // Site Identity
    $wp_customize->add_section('wacus_site_identity', array(
        'title'       => __('Site Identity', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 10,
    ));

    // Light Logo
    $wp_customize->add_setting('wacus_logo_light', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wacus_logo_light', array(
        'label'       => __('Light Logo', 'wacus'),
        'description' => __('Logo for dark backgrounds', 'wacus'),
        'section'     => 'wacus_site_identity',
    )));

    // Dark Logo
    $wp_customize->add_setting('wacus_logo_dark', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wacus_logo_dark', array(
        'label'       => __('Dark Logo', 'wacus'),
        'description' => __('Logo for light backgrounds', 'wacus'),
        'section'     => 'wacus_site_identity',
    )));

    // Favicon
    $wp_customize->add_setting('wacus_favicon', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wacus_favicon', array(
        'label'       => __('Favicon', 'wacus'),
        'section'     => 'wacus_site_identity',
    )));

    // =====================================================
    // COLORS
    // =====================================================
    $wp_customize->add_section('wacus_colors', array(
        'title'       => __('Theme Colors', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 20,
    ));

    // Primary Color
    $wp_customize->add_setting('wacus_primary_color', array(
        'default'           => '#00ff88',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wacus_primary_color', array(
        'label'       => __('Primary Color', 'wacus'),
        'section'     => 'wacus_colors',
    )));

    // Secondary Color
    $wp_customize->add_setting('wacus_secondary_color', array(
        'default'           => '#ff0055',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wacus_secondary_color', array(
        'label'       => __('Secondary Color', 'wacus'),
        'section'     => 'wacus_colors',
    )));

    // Accent Color
    $wp_customize->add_setting('wacus_accent_color', array(
        'default'           => '#00aaff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wacus_accent_color', array(
        'label'       => __('Accent Color', 'wacus'),
        'section'     => 'wacus_colors',
    )));

    // Background Color
    $wp_customize->add_setting('wacus_bg_color', array(
        'default'           => '#0a0a0f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wacus_bg_color', array(
        'label'       => __('Background Color', 'wacus'),
        'section'     => 'wacus_colors',
    )));

    // Text Color
    $wp_customize->add_setting('wacus_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wacus_text_color', array(
        'label'       => __('Text Color', 'wacus'),
        'section'     => 'wacus_colors',
    )));

    // =====================================================
    // HEADER SETTINGS
    // =====================================================
    $wp_customize->add_section('wacus_header', array(
        'title'       => __('Header Settings', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 30,
    ));

    // Sticky Header
    $wp_customize->add_setting('wacus_sticky_header', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_sticky_header', array(
        'label'       => __('Enable Sticky Header', 'wacus'),
        'section'     => 'wacus_header',
        'type'        => 'checkbox',
    ));

    // Transparent Header
    $wp_customize->add_setting('wacus_transparent_header', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_transparent_header', array(
        'label'       => __('Enable Transparent Header', 'wacus'),
        'section'     => 'wacus_header',
        'type'        => 'checkbox',
    ));

    // Header CTA Button Text
    $wp_customize->add_setting('wacus_header_cta_text', array(
        'default'           => __('Get Started', 'wacus'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('wacus_header_cta_text', array(
        'label'       => __('CTA Button Text', 'wacus'),
        'section'     => 'wacus_header',
        'type'        => 'text',
    ));

    // Header CTA Button URL
    $wp_customize->add_setting('wacus_header_cta_url', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('wacus_header_cta_url', array(
        'label'       => __('CTA Button URL', 'wacus'),
        'section'     => 'wacus_header',
        'type'        => 'url',
    ));

    // =====================================================
    // FOOTER SETTINGS
    // =====================================================
    $wp_customize->add_section('wacus_footer', array(
        'title'       => __('Footer Settings', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 40,
    ));

    // Footer Logo
    $wp_customize->add_setting('wacus_footer_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wacus_footer_logo', array(
        'label'       => __('Footer Logo', 'wacus'),
        'section'     => 'wacus_footer',
    )));

    // Footer Description
    $wp_customize->add_setting('wacus_footer_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('wacus_footer_description', array(
        'label'       => __('Footer Description', 'wacus'),
        'section'     => 'wacus_footer',
        'type'        => 'textarea',
    ));

    // Copyright Text
    $wp_customize->add_setting('wacus_copyright_text', array(
        'default'           => sprintf(__('&copy; %s WACUS. All rights reserved.', 'wacus'), date('Y')),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('wacus_copyright_text', array(
        'label'       => __('Copyright Text', 'wacus'),
        'section'     => 'wacus_footer',
        'type'        => 'textarea',
    ));

    // =====================================================
    // SOCIAL LINKS
    // =====================================================
    $wp_customize->add_section('wacus_social', array(
        'title'       => __('Social Links', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 50,
    ));

    $social_networks = array(
        'facebook'  => __('Facebook', 'wacus'),
        'twitter'   => __('Twitter', 'wacus'),
        'instagram' => __('Instagram', 'wacus'),
        'linkedin'  => __('LinkedIn', 'wacus'),
        'youtube'   => __('YouTube', 'wacus'),
        'github'    => __('GitHub', 'wacus'),
    );

    foreach ($social_networks as $key => $label) {
        $wp_customize->add_setting('wacus_social_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('wacus_social_' . $key, array(
            'label'       => $label . ' URL',
            'section'     => 'wacus_social',
            'type'        => 'url',
        ));
    }

    // =====================================================
    // PRELOADER SETTINGS
    // =====================================================
    $wp_customize->add_section('wacus_preloader', array(
        'title'       => __('Preloader', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 60,
    ));

    // Enable Preloader
    $wp_customize->add_setting('wacus_enable_preloader', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_enable_preloader', array(
        'label'       => __('Enable Preloader', 'wacus'),
        'section'     => 'wacus_preloader',
        'type'        => 'checkbox',
    ));

    // Preloader Logo
    $wp_customize->add_setting('wacus_preloader_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wacus_preloader_logo', array(
        'label'       => __('Preloader Logo', 'wacus'),
        'section'     => 'wacus_preloader',
    )));

    // =====================================================
    // CURSOR SETTINGS
    // =====================================================
    $wp_customize->add_section('wacus_cursor', array(
        'title'       => __('Custom Cursor', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 70,
    ));

    // Enable Custom Cursor
    $wp_customize->add_setting('wacus_enable_cursor', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_enable_cursor', array(
        'label'       => __('Enable Custom Cursor', 'wacus'),
        'section'     => 'wacus_cursor',
        'type'        => 'checkbox',
    ));

    // Cursor Color
    $wp_customize->add_setting('wacus_cursor_color', array(
        'default'           => '#00ff88',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wacus_cursor_color', array(
        'label'       => __('Cursor Color', 'wacus'),
        'section'     => 'wacus_cursor',
    )));

    // =====================================================
    // TYPOGRAPHY
    // =====================================================
    $wp_customize->add_section('wacus_typography', array(
        'title'       => __('Typography', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 80,
    ));

    // Heading Font
    $wp_customize->add_setting('wacus_heading_font', array(
        'default'           => 'Poppins',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('wacus_heading_font', array(
        'label'       => __('Heading Font Family', 'wacus'),
        'section'     => 'wacus_typography',
        'type'        => 'select',
        'choices'     => wacus_get_google_fonts(),
    ));

    // Body Font
    $wp_customize->add_setting('wacus_body_font', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('wacus_body_font', array(
        'label'       => __('Body Font Family', 'wacus'),
        'section'     => 'wacus_typography',
        'type'        => 'select',
        'choices'     => wacus_get_google_fonts(),
    ));

    // =====================================================
    // ANIMATION SETTINGS
    // =====================================================
    $wp_customize->add_section('wacus_animations', array(
        'title'       => __('Animations', 'wacus'),
        'panel'       => 'wacus_general_panel',
        'priority'    => 90,
    ));

    // Enable Animations
    $wp_customize->add_setting('wacus_enable_animations', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_enable_animations', array(
        'label'       => __('Enable Scroll Animations', 'wacus'),
        'section'     => 'wacus_animations',
        'type'        => 'checkbox',
    ));

    // Enable Smooth Scroll
    $wp_customize->add_setting('wacus_enable_smooth_scroll', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_enable_smooth_scroll', array(
        'label'       => __('Enable Smooth Scroll', 'wacus'),
        'section'     => 'wacus_animations',
        'type'        => 'checkbox',
    ));

    // Enable 3D Effects
    $wp_customize->add_setting('wacus_enable_3d_effects', array(
        'default'           => true,
        'sanitize_callback' => 'wacus_sanitize_checkbox',
    ));

    $wp_customize->add_control('wacus_enable_3d_effects', array(
        'label'       => __('Enable 3D Effects', 'wacus'),
        'section'     => 'wacus_animations',
        'type'        => 'checkbox',
    ));

    // =====================================================
    // 404 PAGE SETTINGS
    // =====================================================
    $wp_customize->add_section('wacus_404', array(
        'title'       => __('404 Page', 'wacus'),
        'priority'    => 100,
    ));

    // 404 Title
    $wp_customize->add_setting('wacus_404_title', array(
        'default'           => __('Page Not Found', 'wacus'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('wacus_404_title', array(
        'label'       => __('404 Title', 'wacus'),
        'section'     => 'wacus_404',
        'type'        => 'text',
    ));

    // 404 Description
    $wp_customize->add_setting('wacus_404_description', array(
        'default'           => __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'wacus'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('wacus_404_description', array(
        'label'       => __('404 Description', 'wacus'),
        'section'     => 'wacus_404',
        'type'        => 'textarea',
    ));

    // 404 Background Image
    $wp_customize->add_setting('wacus_404_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wacus_404_bg_image', array(
        'label'       => __('404 Background Image', 'wacus'),
        'section'     => 'wacus_404',
    )));
}
add_action('customize_register', 'wacus_customize_register');

/**
 * Sanitize Checkbox
 */
function wacus_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Get Google Fonts
 */
function wacus_get_google_fonts() {
    return array(
        'Poppins'       => 'Poppins',
        'Inter'         => 'Inter',
        'Roboto'        => 'Roboto',
        'Open Sans'     => 'Open Sans',
        'Montserrat'    => 'Montserrat',
        'Playfair Display' => 'Playfair Display',
        'Lato'          => 'Lato',
        'Oswald'        => 'Oswald',
        'Raleway'       => 'Raleway',
        'Ubuntu'        => 'Ubuntu',
        'Merriweather'  => 'Merriweather',
        'Nunito'        => 'Nunito',
        'Source Sans Pro' => 'Source Sans Pro',
        'PT Sans'       => 'PT Sans',
        'Rubik'         => 'Rubik',
        'Work Sans'     => 'Work Sans',
        'Quicksand'     => 'Quicksand',
        'Josefin Sans'  => 'Josefin Sans',
        'Mulish'        => 'Mulish',
        'DM Sans'       => 'DM Sans',
    );
}

/**
 * Output Customizer CSS
 */
function wacus_customizer_css() {
    $primary_color = get_theme_mod('wacus_primary_color', '#00ff88');
    $secondary_color = get_theme_mod('wacus_secondary_color', '#ff0055');
    $accent_color = get_theme_mod('wacus_accent_color', '#00aaff');
    $bg_color = get_theme_mod('wacus_bg_color', '#0a0a0f');
    $text_color = get_theme_mod('wacus_text_color', '#ffffff');
    $heading_font = get_theme_mod('wacus_heading_font', 'Poppins');
    $body_font = get_theme_mod('wacus_body_font', 'Inter');
    $cursor_color = get_theme_mod('wacus_cursor_color', '#00ff88');

    $css = "
        :root {
            --color-primary: {$primary_color};
            --color-secondary: {$secondary_color};
            --color-accent: {$accent_color};
            --color-bg: {$bg_color};
            --color-text: {$text_color};
            --font-heading: '{$heading_font}', sans-serif;
            --font-body: '{$body_font}', sans-serif;
            --cursor-color: {$cursor_color};
        }
    ";

    wp_add_inline_style('wacus-style', $css);
}
add_action('wp_enqueue_scripts', 'wacus_customizer_css', 20);

/**
 * Customizer Preview JS
 */
function wacus_customize_preview_js() {
    wp_enqueue_script(
        'wacus-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('customize-preview'),
        WACUS_VERSION,
        true
    );
}
add_action('customize_preview_init', 'wacus_customize_preview_js');
