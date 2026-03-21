<?php
/**
 * Template Name: About Us
 * Description: About Us page template
 *
 * @package JobPortal
 */

get_header();
?>

<section class="jobportal-page-hero">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('About Us', 'jobportal'); ?></span>
            <h1 class="jobportal-page-hero-title">
                <?php echo esc_html(get_theme_mod('jobportal_about_title', __('We\'re on a Mission to Transform How Businesses Grow', 'jobportal'))); ?>
            </h1>
            <p class="jobportal-page-hero-description">
                <?php echo esc_html(get_theme_mod('jobportal_about_subtitle', __('Founded in 2020, we\'ve helped thousands of companies scale their operations and achieve their goals.', 'jobportal'))); ?>
            </p>
        </div>
    </div>
</section>

<section class="jobportal-about-story">
    <div class="jobportal-container">
        <div class="jobportal-about-grid">
            <div class="jobportal-about-content" data-aos="fade-right">
                <span class="jobportal-section-label"><?php esc_html_e('Our Story', 'jobportal'); ?></span>
                <h2 class="jobportal-section-title"><?php esc_html_e('From Startup to Industry Leader', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We started with a simple idea: make powerful business tools accessible to everyone. What began as a small team of passionate developers has grown into a global company serving customers in over 50 countries.', 'jobportal'); ?></p>
                <p><?php esc_html_e('Our platform combines cutting-edge technology with intuitive design, ensuring that businesses of all sizes can leverage enterprise-grade features without the complexity.', 'jobportal'); ?></p>
                <div class="jobportal-about-stats-inline">
                    <div class="jobportal-stat-item">
                        <span class="jobportal-stat-number" data-count="50">50+</span>
                        <span class="jobportal-stat-label"><?php esc_html_e('Countries', 'jobportal'); ?></span>
                    </div>
                    <div class="jobportal-stat-item">
                        <span class="jobportal-stat-number" data-count="10000">10K+</span>
                        <span class="jobportal-stat-label"><?php esc_html_e('Customers', 'jobportal'); ?></span>
                    </div>
                    <div class="jobportal-stat-item">
                        <span class="jobportal-stat-number" data-count="99">99%</span>
                        <span class="jobportal-stat-label"><?php esc_html_e('Satisfaction', 'jobportal'); ?></span>
                    </div>
                </div>
            </div>
            <div class="jobportal-about-image" data-aos="fade-left">
                <div class="jobportal-about-image-wrapper">
                    <?php $about_image = get_theme_mod('jobportal_about_image', ''); ?>
                    <?php if (!empty($about_image)) : ?>
                        <img src="<?php echo esc_url($about_image); ?>" alt="<?php esc_attr_e('About Us', 'jobportal'); ?>">
                    <?php else : ?>
                        <div class="jobportal-placeholder-image">
                            <?php jobportal_icon('users', 64); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="jobportal-values-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Our Values', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title"><?php esc_html_e('What Drives Us Forward', 'jobportal'); ?></h2>
            <p class="jobportal-section-description"><?php esc_html_e('These core principles guide everything we do', 'jobportal'); ?></p>
        </div>

        <div class="jobportal-values-grid">
            <?php
            $values = array(
                array('icon' => 'zap', 'title' => __('Innovation', 'jobportal'), 'desc' => __('We constantly push boundaries to deliver cutting-edge solutions that keep you ahead of the competition.', 'jobportal')),
                array('icon' => 'shield', 'title' => __('Trust', 'jobportal'), 'desc' => __('Security and transparency are at the heart of everything we build. Your data is always protected.', 'jobportal')),
                array('icon' => 'users', 'title' => __('Customer First', 'jobportal'), 'desc' => __('Every decision we make starts with one question: How does this benefit our customers?', 'jobportal')),
                array('icon' => 'heart', 'title' => __('Passion', 'jobportal'), 'desc' => __('We love what we do, and it shows in every feature, every update, and every interaction.', 'jobportal')),
            );
            foreach ($values as $index => $value) :
            ?>
            <div class="jobportal-value-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-value-icon">
                    <?php jobportal_icon($value['icon'], 32); ?>
                </div>
                <h3 class="jobportal-value-title"><?php echo esc_html($value['title']); ?></h3>
                <p class="jobportal-value-description"><?php echo esc_html($value['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="jobportal-team-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Our Team', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title"><?php esc_html_e('Meet the People Behind the Magic', 'jobportal'); ?></h2>
            <p class="jobportal-section-description"><?php esc_html_e('A diverse team of experts passionate about helping you succeed', 'jobportal'); ?></p>
        </div>

        <div class="jobportal-team-grid">
            <?php
            $team = array(
                array('name' => 'Alex Johnson', 'role' => __('CEO & Founder', 'jobportal'), 'image' => ''),
                array('name' => 'Sarah Williams', 'role' => __('CTO', 'jobportal'), 'image' => ''),
                array('name' => 'Michael Chen', 'role' => __('Head of Design', 'jobportal'), 'image' => ''),
                array('name' => 'Emily Davis', 'role' => __('Head of Marketing', 'jobportal'), 'image' => ''),
            );
            foreach ($team as $index => $member) :
            ?>
            <div class="jobportal-team-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-team-avatar">
                    <?php if (!empty($member['image'])) : ?>
                        <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                    <?php else : ?>
                        <div class="jobportal-avatar-placeholder">
                            <?php jobportal_icon('user', 40); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <h3 class="jobportal-team-name"><?php echo esc_html($member['name']); ?></h3>
                <p class="jobportal-team-role"><?php echo esc_html($member['role']); ?></p>
                <div class="jobportal-team-social">
                    <a href="#" aria-label="Twitter"><?php jobportal_icon('twitter', 18); ?></a>
                    <a href="#" aria-label="LinkedIn"><?php jobportal_icon('linkedin', 18); ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="jobportal-cta-section">
    <div class="jobportal-container">
        <div class="jobportal-cta-inner" data-aos="fade-up">
            <div class="jobportal-cta-content">
                <h2 class="jobportal-cta-title"><?php esc_html_e('Ready to Get Started?', 'jobportal'); ?></h2>
                <p class="jobportal-cta-description"><?php esc_html_e('Join thousands of companies already growing with our platform.', 'jobportal'); ?></p>
                <div class="jobportal-cta-buttons">
                    <a href="<?php echo esc_url(get_theme_mod('jobportal_cta_primary_url', '#')); ?>" class="jobportal-btn jobportal-btn-white jobportal-btn-lg">
                        <?php esc_html_e('Start Free Trial', 'jobportal'); ?>
                        <?php jobportal_icon('arrow-right', 20); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="jobportal-btn jobportal-btn-outline-white jobportal-btn-lg">
                        <?php esc_html_e('Contact Sales', 'jobportal'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
