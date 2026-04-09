<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main contact-page">
    
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-inner container">
            <span class="section-badge reveal"><?php esc_html_e('Contact', 'wacus'); ?></span>
            <h1 class="page-title reveal"><?php the_title(); ?></h1>
            <p class="page-description reveal"><?php esc_html_e('Contact Us About Your Project. We\'re ready to help you build something amazing.', 'wacus'); ?></p>
        </div>
    </header>
    
    <!-- Contact Section -->
    <section class="section contact-section">
        <div class="container">
            <div class="contact-grid">
                
                <!-- Contact Info -->
                <div class="contact-info">
                    <h2 class="reveal"><?php esc_html_e('Get in touch', 'wacus'); ?></h2>
                    <p class="reveal"><?php esc_html_e('Have a project in mind? We\'d love to hear about it. Send us a message and we\'ll get back to you as soon as possible.', 'wacus'); ?></p>
                    
                    <div class="contact-details stagger-children">
                        <?php
                        $email = get_theme_mod('wacus_email', 'hello@wacusglobal.com');
                        $phone = get_theme_mod('wacus_phone', '+82-70-4288-0067');
                        $address = get_theme_mod('wacus_address', '4F, 467, Songpa-daero, Songpa-gu, Seoul, South Korea');
                        ?>
                        
                        <div class="contact-detail reveal">
                            <div class="contact-detail-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div class="contact-detail-content">
                                <h4><?php esc_html_e('Email', 'wacus'); ?></h4>
                                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </div>
                        </div>
                        
                        <div class="contact-detail reveal">
                            <div class="contact-detail-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </div>
                            <div class="contact-detail-content">
                                <h4><?php esc_html_e('Phone', 'wacus'); ?></h4>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            </div>
                        </div>
                        
                        <div class="contact-detail reveal">
                            <div class="contact-detail-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="contact-detail-content">
                                <h4><?php esc_html_e('Address', 'wacus'); ?></h4>
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="contact-social reveal">
                        <h4><?php esc_html_e('Follow Us', 'wacus'); ?></h4>
                        <div class="footer-social">
                            <?php
                            $social_links = array(
                                'facebook'  => get_theme_mod('wacus_facebook_url', ''),
                                'twitter'   => get_theme_mod('wacus_twitter_url', ''),
                                'instagram' => get_theme_mod('wacus_instagram_url', ''),
                                'linkedin'  => get_theme_mod('wacus_linkedin_url', ''),
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
                </div>
                
                <!-- Contact Form -->
                <div class="contact-form reveal">
                    <h3><?php esc_html_e('Send us a message', 'wacus'); ?></h3>
                    
                    <form id="wacus-contact-form" class="ajax-contact-form">
                        <?php wp_nonce_field('wacus_nonce', 'contact_nonce'); ?>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name" class="form-label"><?php esc_html_e('Name', 'wacus'); ?> *</label>
                                <input type="text" id="contact-name" name="name" class="form-input" required placeholder="<?php esc_attr_e('Your name', 'wacus'); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="contact-email" class="form-label"><?php esc_html_e('Email', 'wacus'); ?> *</label>
                                <input type="email" id="contact-email" name="email" class="form-input" required placeholder="<?php esc_attr_e('Your email', 'wacus'); ?>">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-company" class="form-label"><?php esc_html_e('Company', 'wacus'); ?></label>
                                <input type="text" id="contact-company" name="company" class="form-input" placeholder="<?php esc_attr_e('Your company name', 'wacus'); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="contact-phone" class="form-label"><?php esc_html_e('Phone', 'wacus'); ?></label>
                                <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="<?php esc_attr_e('Your phone number', 'wacus'); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-service" class="form-label"><?php esc_html_e('Service Interested In', 'wacus'); ?></label>
                            <select id="contact-service" name="service" class="form-input">
                                <option value=""><?php esc_html_e('Select a service', 'wacus'); ?></option>
                                <option value="web-development"><?php esc_html_e('Website Development', 'wacus'); ?></option>
                                <option value="marketing"><?php esc_html_e('Marketing', 'wacus'); ?></option>
                                <option value="video-production"><?php esc_html_e('Video Production', 'wacus'); ?></option>
                                <option value="performance-marketing"><?php esc_html_e('Performance Marketing', 'wacus'); ?></option>
                                <option value="other"><?php esc_html_e('Other', 'wacus'); ?></option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-budget" class="form-label"><?php esc_html_e('Estimated Budget', 'wacus'); ?></label>
                            <select id="contact-budget" name="budget" class="form-input">
                                <option value=""><?php esc_html_e('Select budget range', 'wacus'); ?></option>
                                <option value="under-7500"><?php esc_html_e('Under $7,500', 'wacus'); ?></option>
                                <option value="under-15000"><?php esc_html_e('Under $15,000', 'wacus'); ?></option>
                                <option value="under-22500"><?php esc_html_e('Under $22,500', 'wacus'); ?></option>
                                <option value="under-37000"><?php esc_html_e('Under $37,000', 'wacus'); ?></option>
                                <option value="over-37000"><?php esc_html_e('Over $37,000', 'wacus'); ?></option>
                                <option value="undecided"><?php esc_html_e('Undecided', 'wacus'); ?></option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-message" class="form-label"><?php esc_html_e('Message', 'wacus'); ?> *</label>
                            <textarea id="contact-message" name="message" class="form-textarea" required placeholder="<?php esc_attr_e('Tell us about your project...', 'wacus'); ?>" rows="5"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-submit magnetic">
                                <span class="magnetic-btn-inner">
                                    <span class="btn-text"><?php esc_html_e('Send Message', 'wacus'); ?></span>
                                    <span class="btn-loading" style="display: none;">
                                        <svg class="spinner" viewBox="0 0 50 50">
                                            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                                        </svg>
                                        <?php esc_html_e('Sending...', 'wacus'); ?>
                                    </span>
                                </span>
                            </button>
                        </div>
                        
                        <div class="form-message" id="form-message" style="display: none;"></div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Offices Section -->
    <section class="section offices-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge reveal"><?php esc_html_e('Our Offices', 'wacus'); ?></span>
                <h2 class="section-title reveal"><?php esc_html_e('Visit Us', 'wacus'); ?></h2>
            </div>
            
            <div class="offices-grid stagger-children">
                <div class="office-card reveal">
                    <div class="office-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Lake Office', 'wacus'); ?></h3>
                    <p><?php esc_html_e('4F, 467, Songpa-daero, Songpa-gu, Seoul, South Korea', 'wacus'); ?></p>
                    <a href="tel:+82-70-4288-0067" class="office-phone">+82-70-4288-0067</a>
                    <div class="office-links">
                        <a href="#" class="btn btn-secondary btn-small"><?php esc_html_e('Naver Map', 'wacus'); ?></a>
                        <a href="#" class="btn btn-secondary btn-small"><?php esc_html_e('Kakao Map', 'wacus'); ?></a>
                    </div>
                </div>
                
                <div class="office-card reveal">
                    <div class="office-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                            <line x1="12" y1="18" x2="12.01" y2="18"></line>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Tower Office', 'wacus'); ?></h3>
                    <p><?php esc_html_e('Lotte World Tower, 30F, Workflex #3035 300, Olympic-ro, Songpa-gu, Seoul, South Korea', 'wacus'); ?></p>
                    <a href="tel:+82-70-4288-0067" class="office-phone">+82-70-4288-0067</a>
                    <div class="office-links">
                        <a href="#" class="btn btn-secondary btn-small"><?php esc_html_e('Naver Map', 'wacus'); ?></a>
                        <a href="#" class="btn btn-secondary btn-small"><?php esc_html_e('Kakao Map', 'wacus'); ?></a>
                    </div>
                </div>
                
                <div class="office-card reveal">
                    <div class="office-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Busan Office', 'wacus'); ?></h3>
                    <p><?php esc_html_e('2F, 9, Godonggol-ro 18beon-gil, Nam-gu, Busan, South Korea', 'wacus'); ?></p>
                    <a href="tel:+82-51-805-8245" class="office-phone">+82-51-805-8245</a>
                    <div class="office-links">
                        <a href="#" class="btn btn-secondary btn-small"><?php esc_html_e('Naver Map', 'wacus'); ?></a>
                        <a href="#" class="btn btn-secondary btn-small"><?php esc_html_e('Kakao Map', 'wacus'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
