<?php
/**
 * Footer Template
 *
 * @package WACUS
 */
?>

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-grid">
            
            <!-- Footer Brand -->
            <div class="footer-brand">
                <?php if (has_custom_logo()) : ?>
                    <div class="footer-logo-image">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
                
                <p><?php echo esc_html(get_theme_mod('wacus_footer_description', 'We bridge the gap between Korean innovation and U.S. market needs. Building brands on the web - that\'s our way.')); ?></p>
                
                <!-- Social Links -->
                <div class="footer-social">
                    <?php
                    $social_links = array(
                        'facebook'  => get_theme_mod('wacus_facebook_url', ''),
                        'twitter'   => get_theme_mod('wacus_twitter_url', ''),
                        'instagram' => get_theme_mod('wacus_instagram_url', ''),
                        'linkedin'  => get_theme_mod('wacus_linkedin_url', ''),
                        'youtube'   => get_theme_mod('wacus_youtube_url', ''),
                    );
                    
                    foreach ($social_links as $network => $url) :
                        if (!empty($url)) :
                            ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
                                <?php echo wacus_get_social_icon($network); ?>
                            </a>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
            
            <!-- Footer Column 1 - About Us -->
            <div class="footer-column">
                <h4><?php esc_html_e('About Us', 'wacus'); ?></h4>
                <?php
                if (has_nav_menu('footer')) :
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-links',
                        'container'      => false,
                        'depth'          => 1,
                    ));
                else :
                    ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('Story', 'wacus'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/company')); ?>"><?php esc_html_e('Company', 'wacus'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/team')); ?>"><?php esc_html_e('Team', 'wacus'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/careers')); ?>"><?php esc_html_e('Careers', 'wacus'); ?></a></li>
                    </ul>
                <?php endif; ?>
            </div>
            
            <!-- Footer Column 2 - Services -->
            <div class="footer-column">
                <h4><?php esc_html_e('Services', 'wacus'); ?></h4>
                <?php
                if (has_nav_menu('footer-2')) :
                    wp_nav_menu(array(
                        'theme_location' => 'footer-2',
                        'menu_class'     => 'footer-links',
                        'container'      => false,
                        'depth'          => 1,
                    ));
                else :
                    ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/services/web-development')); ?>"><?php esc_html_e('Web Development', 'wacus'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/services/digital-marketing')); ?>"><?php esc_html_e('Digital Marketing', 'wacus'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/services/performance-marketing')); ?>"><?php esc_html_e('Performance Marketing', 'wacus'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/services/video-production')); ?>"><?php esc_html_e('Video Production', 'wacus'); ?></a></li>
                    </ul>
                <?php endif; ?>
            </div>
            
            <!-- Footer Column 3 - Contact -->
            <div class="footer-column">
                <h4><?php esc_html_e('Contact', 'wacus'); ?></h4>
                <ul class="footer-links footer-contact">
                    <?php
                    $email = get_theme_mod('wacus_email', 'hello@wacusglobal.com');
                    $phone = get_theme_mod('wacus_phone', '+82-70-4288-0067');
                    $address = get_theme_mod('wacus_address', '4F, 467, Songpa-daero, Songpa-gu, Seoul, South Korea');
                    ?>
                    
                    <?php if ($email) : ?>
                        <li>
                            <a href="mailto:<?php echo esc_attr($email); ?>">
                                <?php echo esc_html($email); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ($phone) : ?>
                        <li>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>">
                                <?php echo esc_html($phone); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ($address) : ?>
                        <li>
                            <span><?php echo esc_html($address); ?></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="footer-copyright">
                &copy; <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('wacus_copyright_text', 'WACUS Global. All rights reserved.')); ?>
            </p>
            
            <div class="footer-legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"><?php esc_html_e('Privacy Policy', 'wacus'); ?></a>
                <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>"><?php esc_html_e('Terms of Service', 'wacus'); ?></a>
            </div>
        </div>
        
    </div>
</footer>

</div><!-- #smooth-content -->
</div><!-- #smooth-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
