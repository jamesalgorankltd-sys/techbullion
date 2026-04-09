<?php
/**
 * Header Template
 *
 * @package WACUS
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Preloader
if (get_theme_mod('wacus_enable_preloader', true)) :
    wacus_preloader();
endif;

// Custom Cursor
if (get_theme_mod('wacus_enable_cursor', true)) :
    wacus_custom_cursor();
endif;
?>

<div id="smooth-wrapper">
<div id="smooth-content">

<a class="skip-link screen-reader-text" href="#main-content">
    <?php esc_html_e('Skip to content', 'wacus'); ?>
</a>

<header id="masthead" class="site-header">
    <div class="header-inner">
        
        <!-- Logo -->
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>
        
        <!-- Navigation -->
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'wacus'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'walker'         => new Wacus_Nav_Walker(),
                'fallback_cb'    => function() {
                    echo '<ul class="nav-menu">';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/about')) . '">About</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/services')) . '">Services</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/portfolio')) . '">Portfolio</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/blog')) . '">Blog</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/contact')) . '">Contact</a></li>';
                    echo '</ul>';
                },
            ));
            ?>
            
            <?php
            $cta_text = get_theme_mod('wacus_header_cta_text', 'Contact Us');
            $cta_link = get_theme_mod('wacus_header_cta_link', '/contact');
            if ($cta_text && $cta_link) :
            ?>
                <a href="<?php echo esc_url($cta_link); ?>" class="header-cta magnetic">
                    <span class="magnetic-btn-inner">
                        <?php echo esc_html($cta_text); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                </a>
            <?php endif; ?>
        </nav>
        
        <!-- Mobile Menu Toggle -->
        <button class="menu-toggle" id="menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'wacus'); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
    </div>
</header>
