<?php
/**
 * Template Name: Services Page
 * Template Post Type: page
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main services-page">
    
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-inner container">
            <span class="section-badge reveal"><?php esc_html_e('Our Services', 'wacus'); ?></span>
            <h1 class="page-title reveal"><?php the_title(); ?></h1>
            <p class="page-description reveal"><?php esc_html_e('WACUS professionals from each field conduct thorough analysis to propose the most optimized solutions for your business.', 'wacus'); ?></p>
        </div>
    </header>
    
    <!-- Services Overview -->
    <section class="section services-overview">
        <div class="container">
            <div class="services-grid-large stagger-children">
                
                <!-- Web & Homepage -->
                <div class="service-card-large reveal" id="web-development">
                    <div class="service-card-inner">
                        <div class="service-card-content">
                            <div class="service-number">01</div>
                            <h2><?php esc_html_e('Web & Homepage', 'wacus'); ?></h2>
                            <p class="service-tagline"><?php esc_html_e('High-quality websites built with the latest trends and technologies', 'wacus'); ?></p>
                            <p><?php esc_html_e('Your website is the face of your brand. First impressions matter—trustworthy design and user-centric structure are essential. At WACUS, we create websites that showcase your brand at its best, combining trend-savvy creativity with technical expertise.', 'wacus'); ?></p>
                            
                            <ul class="service-features">
                                <li><?php esc_html_e('Custom Web Design', 'wacus'); ?></li>
                                <li><?php esc_html_e('Responsive Development', 'wacus'); ?></li>
                                <li><?php esc_html_e('E-commerce Solutions', 'wacus'); ?></li>
                                <li><?php esc_html_e('CMS Integration', 'wacus'); ?></li>
                                <li><?php esc_html_e('SEO Optimization', 'wacus'); ?></li>
                            </ul>
                            
                            <div class="service-tags">
                                <span class="tag">#WebBranding</span>
                                <span class="tag">#WebDesign</span>
                                <span class="tag">#Homepage</span>
                            </div>
                            
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary magnetic">
                                <span class="magnetic-btn-inner">
                                    <?php esc_html_e('Get Started', 'wacus'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        
                        <div class="service-card-visual">
                            <div class="service-3d-container" id="service-3d-1"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Digital Marketing -->
                <div class="service-card-large reveal" id="digital-marketing">
                    <div class="service-card-inner">
                        <div class="service-card-content">
                            <div class="service-number">02</div>
                            <h2><?php esc_html_e('Digital Marketing', 'wacus'); ?></h2>
                            <p class="service-tagline"><?php esc_html_e('The Basics of Digital Marketing! The Fastest Way to Promote Yourself', 'wacus'); ?></p>
                            <p><?php esc_html_e('Viral marketing allows you to reach more consumers faster and more effectively. It helps expose your brand to a wider audience. Promote your brand with multiple keywords in a short amount of time. WACUS is ready to be your partner.', 'wacus'); ?></p>
                            
                            <ul class="service-features">
                                <li><?php esc_html_e('Social Media Marketing', 'wacus'); ?></li>
                                <li><?php esc_html_e('Content Marketing', 'wacus'); ?></li>
                                <li><?php esc_html_e('Email Campaigns', 'wacus'); ?></li>
                                <li><?php esc_html_e('Brand Strategy', 'wacus'); ?></li>
                                <li><?php esc_html_e('Influencer Marketing', 'wacus'); ?></li>
                            </ul>
                            
                            <div class="service-tags">
                                <span class="tag">#IMC</span>
                                <span class="tag">#Consulting</span>
                                <span class="tag">#CreativeVideoSolutions</span>
                            </div>
                            
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary magnetic">
                                <span class="magnetic-btn-inner">
                                    <?php esc_html_e('Get Started', 'wacus'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        
                        <div class="service-card-visual">
                            <div class="service-3d-container" id="service-3d-2"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Performance Marketing -->
                <div class="service-card-large reveal" id="performance-marketing">
                    <div class="service-card-inner">
                        <div class="service-card-content">
                            <div class="service-number">03</div>
                            <h2><?php esc_html_e('Performance Marketing', 'wacus'); ?></h2>
                            <p class="service-tagline"><?php esc_html_e('Marketing is an information war powered by data!', 'wacus'); ?></p>
                            <p><?php esc_html_e('Set up the perfect ads tailored to you. We analyze visitor behavior, clicks, bounce rates, and conversions to drive smarter marketing and optimize web strategies. Data-driven decisions lead to better results.', 'wacus'); ?></p>
                            
                            <ul class="service-features">
                                <li><?php esc_html_e('PPC Advertising', 'wacus'); ?></li>
                                <li><?php esc_html_e('Google Ads Management', 'wacus'); ?></li>
                                <li><?php esc_html_e('Analytics & Reporting', 'wacus'); ?></li>
                                <li><?php esc_html_e('Conversion Optimization', 'wacus'); ?></li>
                                <li><?php esc_html_e('A/B Testing', 'wacus'); ?></li>
                            </ul>
                            
                            <div class="service-tags">
                                <span class="tag">#DataDriven</span>
                                <span class="tag">#ROI</span>
                                <span class="tag">#Optimization</span>
                            </div>
                            
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary magnetic">
                                <span class="magnetic-btn-inner">
                                    <?php esc_html_e('Get Started', 'wacus'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        
                        <div class="service-card-visual">
                            <div class="service-3d-container" id="service-3d-3"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Creative Video Solutions -->
                <div class="service-card-large reveal" id="video-production">
                    <div class="service-card-inner">
                        <div class="service-card-content">
                            <div class="service-number">04</div>
                            <h2><?php esc_html_e('Creative Video Solutions', 'wacus'); ?></h2>
                            <p class="service-tagline"><?php esc_html_e('It\'s time to promote yourself through video!', 'wacus'); ?></p>
                            <p><?php esc_html_e('The beginning of advertising and branding through visuals. Video content is the most engaging format today. Our creative team produces compelling video content that tells your story and connects with your audience.', 'wacus'); ?></p>
                            
                            <ul class="service-features">
                                <li><?php esc_html_e('Commercial Videos', 'wacus'); ?></li>
                                <li><?php esc_html_e('Brand Films', 'wacus'); ?></li>
                                <li><?php esc_html_e('Social Media Content', 'wacus'); ?></li>
                                <li><?php esc_html_e('Animation & Motion Graphics', 'wacus'); ?></li>
                                <li><?php esc_html_e('Video Editing', 'wacus'); ?></li>
                            </ul>
                            
                            <div class="service-tags">
                                <span class="tag">#VideoProduction</span>
                                <span class="tag">#Branding</span>
                                <span class="tag">#Creative</span>
                            </div>
                            
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary magnetic">
                                <span class="magnetic-btn-inner">
                                    <?php esc_html_e('Get Started', 'wacus'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        
                        <div class="service-card-visual">
                            <div class="service-3d-container" id="service-3d-4"></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Process Section -->
    <section class="section process-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge reveal"><?php esc_html_e('Our Process', 'wacus'); ?></span>
                <h2 class="section-title reveal"><?php esc_html_e('How We Work', 'wacus'); ?></h2>
                <p class="section-description reveal"><?php esc_html_e('Our structured approach ensures quality results and client satisfaction.', 'wacus'); ?></p>
            </div>
            
            <div class="process-timeline stagger-children">
                <div class="process-step reveal">
                    <div class="process-step-number">01</div>
                    <div class="process-step-content">
                        <h3><?php esc_html_e('Discovery', 'wacus'); ?></h3>
                        <p><?php esc_html_e('We start by understanding your business, goals, and target audience through detailed consultations and research.', 'wacus'); ?></p>
                    </div>
                </div>
                
                <div class="process-step reveal">
                    <div class="process-step-number">02</div>
                    <div class="process-step-content">
                        <h3><?php esc_html_e('Strategy', 'wacus'); ?></h3>
                        <p><?php esc_html_e('Based on our findings, we develop a comprehensive strategy tailored to your specific needs and objectives.', 'wacus'); ?></p>
                    </div>
                </div>
                
                <div class="process-step reveal">
                    <div class="process-step-number">03</div>
                    <div class="process-step-content">
                        <h3><?php esc_html_e('Design & Development', 'wacus'); ?></h3>
                        <p><?php esc_html_e('Our creative and technical teams bring the strategy to life with stunning designs and robust development.', 'wacus'); ?></p>
                    </div>
                </div>
                
                <div class="process-step reveal">
                    <div class="process-step-number">04</div>
                    <div class="process-step-content">
                        <h3><?php esc_html_e('Launch & Optimize', 'wacus'); ?></h3>
                        <p><?php esc_html_e('After launch, we continuously monitor, analyze, and optimize to ensure sustained success and growth.', 'wacus'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Technologies Section -->
    <section class="section tech-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge reveal"><?php esc_html_e('Technologies', 'wacus'); ?></span>
                <h2 class="section-title reveal"><?php esc_html_e('Tools We Use', 'wacus'); ?></h2>
            </div>
            
            <div class="tech-grid stagger-children">
                <div class="tech-category reveal">
                    <h3><?php esc_html_e('Development', 'wacus'); ?></h3>
                    <ul>
                        <li>React / Next.js</li>
                        <li>Vue.js / Nuxt</li>
                        <li>WordPress</li>
                        <li>PHP / Laravel</li>
                        <li>Node.js</li>
                    </ul>
                </div>
                
                <div class="tech-category reveal">
                    <h3><?php esc_html_e('Design', 'wacus'); ?></h3>
                    <ul>
                        <li>Figma</li>
                        <li>Adobe XD</li>
                        <li>Photoshop</li>
                        <li>Illustrator</li>
                        <li>After Effects</li>
                    </ul>
                </div>
                
                <div class="tech-category reveal">
                    <h3><?php esc_html_e('Marketing', 'wacus'); ?></h3>
                    <ul>
                        <li>Google Analytics</li>
                        <li>Google Ads</li>
                        <li>Meta Ads</li>
                        <li>SEMrush</li>
                        <li>HubSpot</li>
                    </ul>
                </div>
                
                <div class="tech-category reveal">
                    <h3><?php esc_html_e('Video', 'wacus'); ?></h3>
                    <ul>
                        <li>Premiere Pro</li>
                        <li>DaVinci Resolve</li>
                        <li>Cinema 4D</li>
                        <li>Blender</li>
                        <li>Motion Graphics</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title reveal"><?php esc_html_e('Ready to get started?', 'wacus'); ?></h2>
                <p class="cta-description reveal"><?php esc_html_e('Let\'s discuss how we can help your business grow. Contact us for a free consultation.', 'wacus'); ?></p>
                <div class="reveal">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-large magnetic">
                        <span class="magnetic-btn-inner">
                            <?php esc_html_e('Contact Us', 'wacus'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
