<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * @package WACUS
 */

get_header();
?>

<main id="main-content" class="site-main about-page">
    
    <!-- Page Header -->
    <header class="page-header">
        <div class="page-header-inner container">
            <span class="section-badge reveal"><?php esc_html_e('About Us', 'wacus'); ?></span>
            <h1 class="page-title reveal"><?php the_title(); ?></h1>
            <p class="page-description reveal"><?php esc_html_e('Brand value begins on the web—and connects to the world. At WACUS, we build brands on the web. That\'s our way.', 'wacus'); ?></p>
        </div>
    </header>
    
    <!-- Story Section -->
    <section class="section story-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image reveal image-reveal" data-speed="0.9">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('wacus-hero', array('loading' => 'lazy')); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(WACUS_URI . '/assets/images/about-story.jpg'); ?>" alt="<?php esc_attr_e('WACUS Story', 'wacus'); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
                
                <div class="about-content">
                    <span class="section-badge reveal"><?php esc_html_e('Our Story', 'wacus'); ?></span>
                    <h2 class="reveal"><?php esc_html_e('WACUS Story', 'wacus'); ?></h2>
                    <div class="reveal">
                        <?php the_content(); ?>
                    </div>
                    
                    <p class="reveal"><?php esc_html_e('We bridge the gap between Korean innovation and U.S. market needs. Our team of experts combines cutting-edge technology with deep market understanding to deliver results that matter.', 'wacus'); ?></p>
                    
                    <div class="about-highlights stagger-children">
                        <div class="highlight-item">
                            <span class="highlight-number">2018</span>
                            <span class="highlight-label"><?php esc_html_e('Founded', 'wacus'); ?></span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-number">50+</span>
                            <span class="highlight-label"><?php esc_html_e('Team Members', 'wacus'); ?></span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-number">500+</span>
                            <span class="highlight-label"><?php esc_html_e('Projects', 'wacus'); ?></span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-number">98%</span>
                            <span class="highlight-label"><?php esc_html_e('Satisfaction', 'wacus'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Mission & Vision Section -->
    <section class="section mission-section">
        <div class="container">
            <div class="mission-grid">
                <div class="mission-card reveal">
                    <div class="mission-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Our Mission', 'wacus'); ?></h3>
                    <p><?php esc_html_e('To empower businesses with innovative digital solutions that drive growth, enhance brand identity, and create meaningful connections with their audiences worldwide.', 'wacus'); ?></p>
                </div>
                
                <div class="mission-card reveal">
                    <div class="mission-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Our Vision', 'wacus'); ?></h3>
                    <p><?php esc_html_e('To be the leading digital agency that bridges Korean innovation with global markets, setting new standards in web development, marketing, and brand building.', 'wacus'); ?></p>
                </div>
                
                <div class="mission-card reveal">
                    <div class="mission-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Our Values', 'wacus'); ?></h3>
                    <p><?php esc_html_e('Innovation, integrity, excellence, and customer-centricity guide everything we do. We believe in building lasting partnerships based on trust and mutual success.', 'wacus'); ?></p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Team Section -->
    <section class="section team-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge reveal"><?php esc_html_e('Our Team', 'wacus'); ?></span>
                <h2 class="section-title reveal"><?php esc_html_e('Meet the Experts', 'wacus'); ?></h2>
                <p class="section-description reveal"><?php esc_html_e('Talented professionals dedicated to bringing your vision to life.', 'wacus'); ?></p>
            </div>
            
            <div class="team-grid stagger-children">
                <?php
                $team_query = new WP_Query(array(
                    'post_type'      => 'team',
                    'posts_per_page' => 8,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ));
                
                if ($team_query->have_posts()) :
                    while ($team_query->have_posts()) : $team_query->the_post();
                        $position = get_post_meta(get_the_ID(), 'team_position', true);
                        ?>
                        <div class="team-card reveal">
                            <div class="team-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                <?php endif; ?>
                            </div>
                            <div class="team-info">
                                <h4 class="team-name"><?php the_title(); ?></h4>
                                <?php if ($position) : ?>
                                    <span class="team-position"><?php echo esc_html($position); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback team members
                    $fallback_team = array(
                        array('name' => 'John Kim', 'position' => 'CEO & Founder'),
                        array('name' => 'Sarah Park', 'position' => 'Creative Director'),
                        array('name' => 'Michael Lee', 'position' => 'Technical Lead'),
                        array('name' => 'Emily Chen', 'position' => 'Marketing Director'),
                    );
                    
                    foreach ($fallback_team as $member) :
                        ?>
                        <div class="team-card reveal">
                            <div class="team-image">
                                <div class="team-placeholder"></div>
                            </div>
                            <div class="team-info">
                                <h4 class="team-name"><?php echo esc_html($member['name']); ?></h4>
                                <span class="team-position"><?php echo esc_html($member['position']); ?></span>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- Offices Section -->
    <section class="section offices-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge reveal"><?php esc_html_e('Our Offices', 'wacus'); ?></span>
                <h2 class="section-title reveal"><?php esc_html_e('Global Presence', 'wacus'); ?></h2>
            </div>
            
            <div class="offices-grid stagger-children">
                <div class="office-card reveal">
                    <h3><?php esc_html_e('Lake Office', 'wacus'); ?></h3>
                    <p><?php esc_html_e('4F, 467, Songpa-daero, Songpa-gu, Seoul, South Korea', 'wacus'); ?></p>
                    <a href="tel:+82-70-4288-0067">+82-70-4288-0067</a>
                </div>
                
                <div class="office-card reveal">
                    <h3><?php esc_html_e('Tower Office', 'wacus'); ?></h3>
                    <p><?php esc_html_e('Lotte World Tower, 30F, Workflex #3035 300, Olympic-ro, Songpa-gu, Seoul, South Korea', 'wacus'); ?></p>
                    <a href="tel:+82-70-4288-0067">+82-70-4288-0067</a>
                </div>
                
                <div class="office-card reveal">
                    <h3><?php esc_html_e('Busan Office', 'wacus'); ?></h3>
                    <p><?php esc_html_e('2F, 9, Godonggol-ro 18beon-gil, Nam-gu, Busan, South Korea', 'wacus'); ?></p>
                    <a href="tel:+82-51-805-8245">+82-51-805-8245</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title reveal"><?php esc_html_e('Ready to work with us?', 'wacus'); ?></h2>
                <p class="cta-description reveal"><?php esc_html_e('Let\'s create something amazing together. Get in touch with our team today.', 'wacus'); ?></p>
                <div class="reveal">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-large magnetic">
                        <span class="magnetic-btn-inner">
                            <?php esc_html_e('Get In Touch', 'wacus'); ?>
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
