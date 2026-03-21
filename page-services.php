<?php
/**
 * Template Name: Services
 * Description: Services page template
 *
 * @package JobPortal
 */

get_header();
?>

<section class="jobportal-page-hero">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Services', 'jobportal'); ?></span>
            <h1 class="jobportal-page-hero-title">
                <?php esc_html_e('Solutions That Drive Results', 'jobportal'); ?>
            </h1>
            <p class="jobportal-page-hero-description">
                <?php esc_html_e('Comprehensive tools and services designed to accelerate your business growth.', 'jobportal'); ?>
            </p>
        </div>
    </div>
</section>

<section class="jobportal-services-main">
    <div class="jobportal-container">
        <div class="jobportal-services-grid">
            <?php
            $services = new WP_Query(array(
                'post_type'      => 'jobportal_service',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            if ($services->have_posts()) :
                $index = 0;
                while ($services->have_posts()) : $services->the_post();
                    $icon = get_post_meta(get_the_ID(), '_jobportal_service_icon', true) ?: 'zap';
            ?>
            <div class="jobportal-service-card-large" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-service-icon-large">
                    <?php jobportal_icon($icon, 40); ?>
                </div>
                <div class="jobportal-service-content">
                    <h3 class="jobportal-service-title"><?php the_title(); ?></h3>
                    <div class="jobportal-service-description">
                        <?php the_excerpt(); ?>
                    </div>
                    <ul class="jobportal-service-features">
                        <li><?php jobportal_icon('check', 16); ?> <?php esc_html_e('Feature benefit one', 'jobportal'); ?></li>
                        <li><?php jobportal_icon('check', 16); ?> <?php esc_html_e('Feature benefit two', 'jobportal'); ?></li>
                        <li><?php jobportal_icon('check', 16); ?> <?php esc_html_e('Feature benefit three', 'jobportal'); ?></li>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="jobportal-btn jobportal-btn-primary">
                        <?php esc_html_e('Learn More', 'jobportal'); ?>
                        <?php jobportal_icon('arrow-right', 16); ?>
                    </a>
                </div>
            </div>
            <?php
                    $index++;
                endwhile;
                wp_reset_postdata();
            else :
                $default_services = array(
                    array(
                        'icon' => 'chart',
                        'title' => __('Analytics & Insights', 'jobportal'),
                        'desc' => __('Get real-time analytics and actionable insights to make data-driven decisions.', 'jobportal'),
                        'features' => array(__('Real-time dashboards', 'jobportal'), __('Custom reports', 'jobportal'), __('AI-powered insights', 'jobportal'))
                    ),
                    array(
                        'icon' => 'code',
                        'title' => __('API Integration', 'jobportal'),
                        'desc' => __('Seamlessly connect with your existing tools through our powerful API.', 'jobportal'),
                        'features' => array(__('RESTful API', 'jobportal'), __('Webhooks', 'jobportal'), __('SDK libraries', 'jobportal'))
                    ),
                    array(
                        'icon' => 'shield',
                        'title' => __('Security Suite', 'jobportal'),
                        'desc' => __('Enterprise-grade security to protect your data and your customers.', 'jobportal'),
                        'features' => array(__('End-to-end encryption', 'jobportal'), __('2FA authentication', 'jobportal'), __('Compliance ready', 'jobportal'))
                    ),
                    array(
                        'icon' => 'users',
                        'title' => __('Team Collaboration', 'jobportal'),
                        'desc' => __('Work together seamlessly with real-time collaboration tools.', 'jobportal'),
                        'features' => array(__('Shared workspaces', 'jobportal'), __('Role management', 'jobportal'), __('Activity tracking', 'jobportal'))
                    ),
                    array(
                        'icon' => 'globe',
                        'title' => __('Global Infrastructure', 'jobportal'),
                        'desc' => __('Deploy worldwide with our distributed cloud infrastructure.', 'jobportal'),
                        'features' => array(__('99.99% uptime', 'jobportal'), __('Auto-scaling', 'jobportal'), __('CDN included', 'jobportal'))
                    ),
                    array(
                        'icon' => 'headphones',
                        'title' => __('24/7 Support', 'jobportal'),
                        'desc' => __('Get help whenever you need it from our dedicated support team.', 'jobportal'),
                        'features' => array(__('Live chat', 'jobportal'), __('Email support', 'jobportal'), __('Priority queue', 'jobportal'))
                    ),
                );
                foreach ($default_services as $index => $service) :
            ?>
            <div class="jobportal-service-card-large" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-service-icon-large">
                    <?php jobportal_icon($service['icon'], 40); ?>
                </div>
                <div class="jobportal-service-content">
                    <h3 class="jobportal-service-title"><?php echo esc_html($service['title']); ?></h3>
                    <p class="jobportal-service-description"><?php echo esc_html($service['desc']); ?></p>
                    <ul class="jobportal-service-features">
                        <?php foreach ($service['features'] as $feature) : ?>
                        <li><?php jobportal_icon('check', 16); ?> <?php echo esc_html($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/jobs')); ?>" class="jobportal-btn jobportal-btn-primary">
                        <?php esc_html_e('Browse Jobs', 'jobportal'); ?>
                        <?php jobportal_icon('arrow-right', 16); ?>
                    </a>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<section class="jobportal-process-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('How It Works', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title"><?php esc_html_e('Simple Steps to Success', 'jobportal'); ?></h2>
            <p class="jobportal-section-description"><?php esc_html_e('Get started in minutes with our streamlined process', 'jobportal'); ?></p>
        </div>

        <div class="jobportal-process-grid">
            <?php
            $steps = array(
                array('num' => '01', 'title' => __('Sign Up', 'jobportal'), 'desc' => __('Create your free account in less than 2 minutes. No credit card required.', 'jobportal')),
                array('num' => '02', 'title' => __('Configure', 'jobportal'), 'desc' => __('Set up your workspace and customize settings to match your workflow.', 'jobportal')),
                array('num' => '03', 'title' => __('Integrate', 'jobportal'), 'desc' => __('Connect your existing tools and import your data seamlessly.', 'jobportal')),
                array('num' => '04', 'title' => __('Launch', 'jobportal'), 'desc' => __('Go live and start seeing results from day one.', 'jobportal')),
            );
            foreach ($steps as $index => $step) :
            ?>
            <div class="jobportal-process-step" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-process-number"><?php echo esc_html($step['num']); ?></div>
                <h3 class="jobportal-process-title"><?php echo esc_html($step['title']); ?></h3>
                <p class="jobportal-process-description"><?php echo esc_html($step['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="jobportal-cta-section">
    <div class="jobportal-container">
        <div class="jobportal-cta-inner" data-aos="fade-up">
            <div class="jobportal-cta-content">
                <h2 class="jobportal-cta-title"><?php esc_html_e('Ready to Transform Your Business?', 'jobportal'); ?></h2>
                <p class="jobportal-cta-description"><?php esc_html_e('Start your free 14-day trial today. No credit card required.', 'jobportal'); ?></p>
                <div class="jobportal-cta-buttons">
                    <a href="#" class="jobportal-btn jobportal-btn-white jobportal-btn-lg">
                        <?php esc_html_e('Start Free Trial', 'jobportal'); ?>
                        <?php jobportal_icon('arrow-right', 20); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="jobportal-btn jobportal-btn-outline-white jobportal-btn-lg">
                        <?php esc_html_e('Talk to Sales', 'jobportal'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
