<?php
/**
 * 404 Error Page Template
 * 
 * @package WACUS
 */

get_header();
?>

<main id="main" class="site-main error-page">
    <section class="error-section">
        <div class="three-container particles-container" data-count="1500"></div>
        
        <div class="container">
            <div class="error-content">
                <!-- Animated 404 -->
                <div class="error-number">
                    <span class="digit char-reveal" data-speed="0.1">4</span>
                    <span class="digit zero">
                        <div class="globe-container" data-color="0x00ff88"></div>
                    </span>
                    <span class="digit char-reveal" data-speed="0.1">4</span>
                </div>
                
                <h1 class="error-title split-text"><?php esc_html_e('Page Not Found', 'wacus'); ?></h1>
                
                <p class="error-description fade-up">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'wacus'); ?>
                </p>
                
                <!-- Search Form -->
                <div class="error-search fade-up">
                    <?php get_search_form(); ?>
                </div>
                
                <!-- Action Buttons -->
                <div class="error-actions fade-up">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary magnetic btn-ripple">
                        <span><?php esc_html_e('Back to Home', 'wacus'); ?></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </a>
                    <button onclick="history.back()" class="btn btn-secondary magnetic btn-ripple">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        <span><?php esc_html_e('Go Back', 'wacus'); ?></span>
                    </button>
                </div>
                
                <!-- Quick Links -->
                <div class="quick-links stagger-container">
                    <h3 class="quick-links-title"><?php esc_html_e('Quick Links', 'wacus'); ?></h3>
                    <div class="quick-links-grid">
                        <?php
                        $quick_links = array(
                            array(
                                'title' => __('Home', 'wacus'),
                                'url' => home_url('/'),
                                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>'
                            ),
                            array(
                                'title' => __('About', 'wacus'),
                                'url' => home_url('/about'),
                                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>'
                            ),
                            array(
                                'title' => __('Services', 'wacus'),
                                'url' => home_url('/services'),
                                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>'
                            ),
                            array(
                                'title' => __('Contact', 'wacus'),
                                'url' => home_url('/contact'),
                                'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>'
                            )
                        );
                        
                        foreach ($quick_links as $link) :
                        ?>
                            <a href="<?php echo esc_url($link['url']); ?>" class="quick-link-item stagger-item magnetic">
                                <span class="quick-link-icon"><?php echo $link['icon']; ?></span>
                                <span class="quick-link-title"><?php echo esc_html($link['title']); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Objects -->
        <div class="floating-elements">
            <div class="float-element mouse-move" data-speed="0.03"></div>
            <div class="float-element mouse-move" data-speed="0.05"></div>
            <div class="float-element mouse-move" data-speed="0.02"></div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
