<?php
/**
 * Front Page Template
 *
 * @package JobPortal
 */

get_header();
?>

<section id="hero" class="jobportal-hero">
    <div class="jobportal-hero-bg">
        <div class="jobportal-hero-gradient"></div>
        <div class="jobportal-hero-pattern"></div>
    </div>

    <div class="jobportal-container">
        <div class="jobportal-hero-grid">
            <div class="jobportal-hero-content" data-aos="fade-up">

                <?php $badge = get_theme_mod('jobportal_hero_badge', __('New Features Available', 'jobportal')); ?>
                <?php if (!empty($badge)) : ?>
                <div class="jobportal-hero-badge">
                    <span class="jobportal-badge-dot"></span>
                    <?php echo esc_html($badge); ?>
                    <?php jobportal_icon('arrow-right', 16); ?>
                </div>
                <?php endif; ?>

                <h1 class="jobportal-hero-title">
                    <?php echo esc_html(get_theme_mod('jobportal_hero_title', __('Build Something Amazing With Our Platform', 'jobportal'))); ?>
                </h1>

                <p class="jobportal-hero-description">
                    <?php echo esc_html(get_theme_mod('jobportal_hero_subtitle', __('The all-in-one platform that helps startups and businesses scale faster with powerful tools.', 'jobportal'))); ?>
                </p>

                <div class="jobportal-hero-buttons">
                    <?php
                    $btn_primary_text = get_theme_mod('jobportal_hero_btn_primary_text', __('Start Free Trial', 'jobportal'));
                    $btn_primary_url = get_theme_mod('jobportal_hero_btn_primary_url', '#');
                    $btn_secondary_text = get_theme_mod('jobportal_hero_btn_secondary_text', __('Watch Demo', 'jobportal'));
                    $btn_secondary_url = get_theme_mod('jobportal_hero_btn_secondary_url', '#');
                    ?>

                    <?php if (!empty($btn_primary_text)) : ?>
                    <a href="<?php echo esc_url($btn_primary_url); ?>" class="jobportal-btn jobportal-btn-primary jobportal-btn-lg">
                        <?php echo esc_html($btn_primary_text); ?>
                        <?php jobportal_icon('arrow-right', 20); ?>
                    </a>
                    <?php endif; ?>

                    <?php if (!empty($btn_secondary_text)) : ?>
                    <a href="<?php echo esc_url($btn_secondary_url); ?>" class="jobportal-btn jobportal-btn-outline jobportal-btn-lg">
                        <?php jobportal_icon('play', 20); ?>
                        <?php echo esc_html($btn_secondary_text); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="jobportal-hero-stats" data-aos="fade-up" data-aos-delay="200">
                    <div class="jobportal-hero-stat">
                        <div class="jobportal-hero-stat-number" data-count="10000">10,000+</div>
                        <div class="jobportal-hero-stat-label"><?php esc_html_e('Happy Customers', 'jobportal'); ?></div>
                    </div>
                    <div class="jobportal-hero-stat">
                        <div class="jobportal-hero-stat-number" data-count="99">99%</div>
                        <div class="jobportal-hero-stat-label"><?php esc_html_e('Uptime', 'jobportal'); ?></div>
                    </div>
                    <div class="jobportal-hero-stat">
                        <div class="jobportal-hero-stat-number" data-count="24">24/7</div>
                        <div class="jobportal-hero-stat-label"><?php esc_html_e('Support', 'jobportal'); ?></div>
                    </div>
                </div>
            </div>

        <?php $hero_image = get_theme_mod('jobportal_hero_image', ''); ?>
        <?php if (!empty($hero_image)) : ?>
        <div class="jobportal-hero-image" data-aos="fade-up" data-aos-delay="300">
            <div class="jobportal-hero-image-wrapper">
                <img src="<?php echo esc_url($hero_image); ?>" alt="<?php esc_attr_e('Hero Image', 'jobportal'); ?>">
                <div class="jobportal-hero-image-glow"></div>
            </div>
        </div>
        <?php else : ?>
        <div class="jobportal-hero-image jobportal-hero-placeholder">
            <div class="jobportal-hero-image-wrapper">
                <div class="jobportal-dashboard-mockup">
                    <div class="jobportal-mockup-header">
                        <div class="jobportal-mockup-dots">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="jobportal-mockup-tabs">
                            <span class="active">Dashboard</span>
                            <span>Analytics</span>
                            <span>Settings</span>
                        </div>
                    </div>
                    <div class="jobportal-mockup-body">
                        <div class="jobportal-mockup-sidebar">
                            <div class="jobportal-mockup-logo">
                                <?php jobportal_icon('layers', 24); ?>
                            </div>
                            <div class="jobportal-mockup-nav">
                                <div class="jobportal-mockup-nav-item active"><?php jobportal_icon('chart', 18); ?></div>
                                <div class="jobportal-mockup-nav-item"><?php jobportal_icon('users', 18); ?></div>
                                <div class="jobportal-mockup-nav-item"><?php jobportal_icon('mail', 18); ?></div>
                                <div class="jobportal-mockup-nav-item"><?php jobportal_icon('settings', 18); ?></div>
                            </div>
                        </div>
                        <div class="jobportal-mockup-content">
                            <div class="jobportal-mockup-stats">
                                <div class="jobportal-mockup-stat-card">
                                    <div class="jobportal-mockup-stat-icon"><?php jobportal_icon('users', 20); ?></div>
                                    <div class="jobportal-mockup-stat-info">
                                        <span class="jobportal-mockup-stat-value">12,456</span>
                                        <span class="jobportal-mockup-stat-label">Total Users</span>
                                    </div>
                                    <span class="jobportal-mockup-stat-badge up">+12%</span>
                                </div>
                                <div class="jobportal-mockup-stat-card">
                                    <div class="jobportal-mockup-stat-icon green"><?php jobportal_icon('chart', 20); ?></div>
                                    <div class="jobportal-mockup-stat-info">
                                        <span class="jobportal-mockup-stat-value">$48,290</span>
                                        <span class="jobportal-mockup-stat-label">Revenue</span>
                                    </div>
                                    <span class="jobportal-mockup-stat-badge up">+24%</span>
                                </div>
                                <div class="jobportal-mockup-stat-card">
                                    <div class="jobportal-mockup-stat-icon orange"><?php jobportal_icon('zap', 20); ?></div>
                                    <div class="jobportal-mockup-stat-info">
                                        <span class="jobportal-mockup-stat-value">98.5%</span>
                                        <span class="jobportal-mockup-stat-label">Performance</span>
                                    </div>
                                    <span class="jobportal-mockup-stat-badge up">+5%</span>
                                </div>
                            </div>
                            <div class="jobportal-mockup-chart">
                                <div class="jobportal-mockup-chart-header">
                                    <span>Revenue Analytics</span>
                                    <span class="jobportal-mockup-chart-period">Last 7 days</span>
                                </div>
                                <div class="jobportal-mockup-chart-bars">
                                    <div class="jobportal-chart-bar" style="--height: 60%"><span>Mon</span></div>
                                    <div class="jobportal-chart-bar" style="--height: 80%"><span>Tue</span></div>
                                    <div class="jobportal-chart-bar" style="--height: 45%"><span>Wed</span></div>
                                    <div class="jobportal-chart-bar" style="--height: 90%"><span>Thu</span></div>
                                    <div class="jobportal-chart-bar" style="--height: 75%"><span>Fri</span></div>
                                    <div class="jobportal-chart-bar" style="--height: 85%"><span>Sat</span></div>
                                    <div class="jobportal-chart-bar active" style="--height: 95%"><span>Sun</span></div>
                                </div>
                            </div>
                            <div class="jobportal-mockup-cards">
                                <div class="jobportal-mockup-card"></div>
                                <div class="jobportal-mockup-card"></div>
                                <div class="jobportal-mockup-card"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        </div>
    </div>
</section>

<section class="jobportal-logos-section">
    <div class="jobportal-container">
        <p class="jobportal-logos-title"><?php esc_html_e('Trusted by leading companies worldwide', 'jobportal'); ?></p>
        <div class="jobportal-logos-grid">
            <div class="jobportal-logo-item">
                <svg viewBox="0 0 124 34" fill="currentColor" height="32">
                    <path d="M16.85 3.2c-5.1 0-8.4 2.7-9.9 8.1 2-2.7 4.3-3.7 7-3 1.5.4 2.6 1.5 3.8 2.8 1.9 2.1 4.2 4.5 9.1 4.5 5.1 0 8.4-2.7 9.9-8.1-2 2.7-4.3 3.7-7 3-1.5-.4-2.6-1.5-3.8-2.8-1.9-2.1-4.2-4.5-9.1-4.5zM6.95 15.6c-5.1 0-8.4 2.7-9.9 8.1 2-2.7 4.3-3.7 7-3 1.5.4 2.6 1.5 3.8 2.8 1.9 2.1 4.2 4.5 9.1 4.5 5.1 0 8.4-2.7 9.9-8.1-2 2.7-4.3 3.7-7 3-1.5-.4-2.6-1.5-3.8-2.8-1.9-2.1-4.2-4.5-9.1-4.5z"/>
                    <text x="42" y="24" font-family="system-ui" font-weight="700" font-size="18">Tailwind</text>
                </svg>
            </div>
            <div class="jobportal-logo-item">
                <svg viewBox="0 0 120 34" fill="currentColor" height="32">
                    <path d="M17 4L2 17l15 13V4zm3.2 0v26l15-13-15-13z"/>
                    <text x="42" y="24" font-family="system-ui" font-weight="700" font-size="18">Vercel</text>
                </svg>
            </div>
            <div class="jobportal-logo-item">
                <svg viewBox="0 0 120 34" fill="currentColor" height="32">
                    <circle cx="17" cy="17" r="15" fill="none" stroke="currentColor" stroke-width="2"/>
                    <path d="M17 6v11l8 5"/>
                    <text x="40" y="24" font-family="system-ui" font-weight="700" font-size="18">Linear</text>
                </svg>
            </div>
            <div class="jobportal-logo-item">
                <svg viewBox="0 0 120 34" fill="currentColor" height="32">
                    <rect x="2" y="8" width="30" height="18" rx="3" fill="none" stroke="currentColor" stroke-width="2"/>
                    <path d="M10 15h14M10 19h10"/>
                    <text x="40" y="24" font-family="system-ui" font-weight="700" font-size="18">Stripe</text>
                </svg>
            </div>
            <div class="jobportal-logo-item">
                <svg viewBox="0 0 120 34" fill="currentColor" height="32">
                    <path d="M17 2c-8.3 0-15 6.7-15 15s6.7 15 15 15c3.7 0 7.1-1.4 9.7-3.6l-4.5-4.5c-1.5 1.2-3.3 1.9-5.2 1.9-4.7 0-8.5-3.8-8.5-8.5s3.8-8.5 8.5-8.5c2.3 0 4.4.9 6 2.5l4.5-4.5C24.8 4 21.1 2 17 2z"/>
                    <text x="38" y="24" font-family="system-ui" font-weight="700" font-size="18">Google</text>
                </svg>
            </div>
            <div class="jobportal-logo-item">
                <svg viewBox="0 0 120 34" fill="currentColor" height="32">
                    <path d="M6 8h6v18H6V8zm12 6h6v12h-6V14zm12-10h6v22h-6V4z"/>
                    <text x="42" y="24" font-family="system-ui" font-weight="700" font-size="18">Notion</text>
                </svg>
            </div>
        </div>
    </div>
</section>

<?php if (get_theme_mod('jobportal_features_enable', true)) : ?>
<section id="features" class="jobportal-features-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Features', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title">
                <?php echo esc_html(get_theme_mod('jobportal_features_title', __('Powerful Features', 'jobportal'))); ?>
            </h2>
            <p class="jobportal-section-description">
                <?php echo esc_html(get_theme_mod('jobportal_features_subtitle', __('Everything you need to grow your business', 'jobportal'))); ?>
            </p>
        </div>

        <div class="jobportal-features-grid">
            <?php
            $services = new WP_Query(array(
                'post_type'      => 'jobportal_service',
                'posts_per_page' => 6,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $icon = get_post_meta(get_the_ID(), '_jobportal_service_icon', true);
                    $link = get_post_meta(get_the_ID(), '_jobportal_service_link', true);
                    $link_text = get_post_meta(get_the_ID(), '_jobportal_service_link_text', true);
            ?>
            <div class="jobportal-feature-card">
                <div class="jobportal-feature-icon">
                    <?php jobportal_icon($icon ?: 'zap', 28); ?>
                </div>
                <h3 class="jobportal-feature-title"><?php the_title(); ?></h3>
                <p class="jobportal-feature-description"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                <?php if (!empty($link)) : ?>
                <a href="<?php echo esc_url($link); ?>" class="jobportal-feature-link">
                    <?php echo esc_html($link_text ?: __('Learn More', 'jobportal')); ?>
                    <?php jobportal_icon('arrow-right', 16); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $default_features = array(
                    array('icon' => 'zap', 'title' => __('Lightning Fast', 'jobportal'), 'desc' => __('Optimized for speed with sub-second response times.', 'jobportal')),
                    array('icon' => 'shield', 'title' => __('Secure by Default', 'jobportal'), 'desc' => __('Enterprise-grade security with end-to-end encryption.', 'jobportal')),
                    array('icon' => 'chart', 'title' => __('Advanced Analytics', 'jobportal'), 'desc' => __('Gain insights with powerful analytics and reporting.', 'jobportal')),
                    array('icon' => 'globe', 'title' => __('Global Scale', 'jobportal'), 'desc' => __('Deploy globally with our distributed infrastructure.', 'jobportal')),
                    array('icon' => 'code', 'title' => __('Developer Friendly', 'jobportal'), 'desc' => __('Clean APIs and comprehensive documentation.', 'jobportal')),
                    array('icon' => 'users', 'title' => __('Team Collaboration', 'jobportal'), 'desc' => __('Built for teams with real-time collaboration.', 'jobportal')),
                );
                foreach ($default_features as $feature) :
            ?>
            <div class="jobportal-feature-card">
                <div class="jobportal-feature-icon">
                    <?php jobportal_icon($feature['icon'], 28); ?>
                </div>
                <h3 class="jobportal-feature-title"><?php echo esc_html($feature['title']); ?></h3>
                <p class="jobportal-feature-description"><?php echo esc_html($feature['desc']); ?></p>
                <a href="#" class="jobportal-feature-link">
                    <?php esc_html_e('Learn More', 'jobportal'); ?>
                    <?php jobportal_icon('arrow-right', 16); ?>
                </a>
            </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_theme_mod('jobportal_pricing_enable', true)) : ?>
<section id="pricing" class="jobportal-pricing-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Pricing', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title">
                <?php echo esc_html(get_theme_mod('jobportal_pricing_title', __('Simple, Transparent Pricing', 'jobportal'))); ?>
            </h2>
            <p class="jobportal-section-description">
                <?php echo esc_html(get_theme_mod('jobportal_pricing_subtitle', __('Choose the perfect plan for your needs', 'jobportal'))); ?>
            </p>
        </div>

        <div class="jobportal-pricing-toggle" data-aos="fade-up">
            <span class="jobportal-pricing-label active" data-period="monthly"><?php esc_html_e('Monthly', 'jobportal'); ?></span>
            <button class="jobportal-toggle-switch" id="pricing-toggle" aria-pressed="false">
                <span class="jobportal-toggle-slider"></span>
            </button>
            <span class="jobportal-pricing-label" data-period="yearly">
                <?php esc_html_e('Yearly', 'jobportal'); ?>
                <span class="jobportal-save-badge"><?php esc_html_e('Save 20%', 'jobportal'); ?></span>
            </span>
        </div>

        <div class="jobportal-pricing-grid">
            <?php
            $currency = get_theme_mod('jobportal_pricing_currency', '$');
            $pricing_plans = new WP_Query(array(
                'post_type'      => 'jobportal_pricing',
                'posts_per_page' => 3,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            if ($pricing_plans->have_posts()) :
                while ($pricing_plans->have_posts()) : $pricing_plans->the_post();
                    $monthly = get_post_meta(get_the_ID(), '_jobportal_pricing_monthly', true);
                    $yearly = get_post_meta(get_the_ID(), '_jobportal_pricing_yearly', true);
                    $features = get_post_meta(get_the_ID(), '_jobportal_pricing_features', true);
                    $is_popular = get_post_meta(get_the_ID(), '_jobportal_pricing_popular', true);
                    $btn_text = get_post_meta(get_the_ID(), '_jobportal_pricing_button_text', true) ?: __('Get Started', 'jobportal');
                    $btn_url = get_post_meta(get_the_ID(), '_jobportal_pricing_button_url', true) ?: '#';
            ?>
            <div class="jobportal-pricing-card <?php echo $is_popular ? 'jobportal-pricing-popular' : ''; ?>" data-aos="fade-up">
                <?php if ($is_popular) : ?>
                <div class="jobportal-popular-badge"><?php esc_html_e('Most Popular', 'jobportal'); ?></div>
                <?php endif; ?>

                <div class="jobportal-pricing-header">
                    <h3 class="jobportal-pricing-name"><?php the_title(); ?></h3>
                    <div class="jobportal-pricing-price">
                        <span class="jobportal-price-currency"><?php echo esc_html($currency); ?></span>
                        <span class="jobportal-price-amount" data-monthly="<?php echo esc_attr($monthly); ?>" data-yearly="<?php echo esc_attr($yearly); ?>">
                            <?php echo esc_html($monthly); ?>
                        </span>
                        <span class="jobportal-price-period">/<?php esc_html_e('month', 'jobportal'); ?></span>
                    </div>
                </div>

                <ul class="jobportal-pricing-features">
                    <?php
                    if (!empty($features)) {
                        $features_list = explode("\n", $features);
                        foreach ($features_list as $feature) {
                            $feature = trim($feature);
                            if (!empty($feature)) {
                                echo '<li>';
                                jobportal_icon('check', 18);
                                echo '<span>' . esc_html($feature) . '</span></li>';
                            }
                        }
                    }
                    ?>
                </ul>

                <a href="<?php echo esc_url($btn_url); ?>" class="jobportal-btn <?php echo $is_popular ? 'jobportal-btn-primary' : 'jobportal-btn-outline'; ?> jobportal-btn-block">
                    <?php echo esc_html($btn_text); ?>
                </a>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $default_plans = array(
                    array('name' => 'Basic', 'monthly' => '29', 'yearly' => '290', 'popular' => false, 'features' => array('5 Projects', '10GB Storage', 'Basic Analytics', 'Email Support')),
                    array('name' => 'Professional', 'monthly' => '79', 'yearly' => '790', 'popular' => true, 'features' => array('Unlimited Projects', '100GB Storage', 'Advanced Analytics', 'Priority Support', 'API Access', 'Team Collaboration')),
                    array('name' => 'Enterprise', 'monthly' => '199', 'yearly' => '1990', 'popular' => false, 'features' => array('Everything in Pro', 'Unlimited Storage', 'Custom Integrations', 'Dedicated Manager', 'SLA Guarantee', 'White Label')),
                );
                foreach ($default_plans as $plan) :
            ?>
            <div class="jobportal-pricing-card <?php echo $plan['popular'] ? 'jobportal-pricing-popular' : ''; ?>" data-aos="fade-up">
                <?php if ($plan['popular']) : ?>
                <div class="jobportal-popular-badge"><?php esc_html_e('Most Popular', 'jobportal'); ?></div>
                <?php endif; ?>

                <div class="jobportal-pricing-header">
                    <h3 class="jobportal-pricing-name"><?php echo esc_html($plan['name']); ?></h3>
                    <div class="jobportal-pricing-price">
                        <span class="jobportal-price-currency"><?php echo esc_html($currency); ?></span>
                        <span class="jobportal-price-amount" data-monthly="<?php echo esc_attr($plan['monthly']); ?>" data-yearly="<?php echo esc_attr($plan['yearly']); ?>">
                            <?php echo esc_html($plan['monthly']); ?>
                        </span>
                        <span class="jobportal-price-period">/<?php esc_html_e('month', 'jobportal'); ?></span>
                    </div>
                </div>

                <ul class="jobportal-pricing-features">
                    <?php foreach ($plan['features'] as $feature) : ?>
                    <li>
                        <?php jobportal_icon('check', 18); ?>
                        <span><?php echo esc_html($feature); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <a href="#" class="jobportal-btn <?php echo $plan['popular'] ? 'jobportal-btn-primary' : 'jobportal-btn-outline'; ?> jobportal-btn-block">
                    <?php esc_html_e('Get Started', 'jobportal'); ?>
                </a>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_theme_mod('jobportal_testimonials_enable', true)) : ?>
<section id="testimonials" class="jobportal-testimonials-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Testimonials', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title">
                <?php echo esc_html(get_theme_mod('jobportal_testimonials_title', __('What Our Customers Say', 'jobportal'))); ?>
            </h2>
            <p class="jobportal-section-description"><?php esc_html_e('Join thousands of satisfied customers who trust us', 'jobportal'); ?></p>
        </div>

        <div class="jobportal-testimonials-modern">
            <?php
            $testimonials = new WP_Query(array(
                'post_type'      => 'jobportal_testimonial',
                'posts_per_page' => 3,
                'orderby'        => 'rand',
            ));

            if ($testimonials->have_posts()) :
                $index = 0;
                while ($testimonials->have_posts()) : $testimonials->the_post();
                    $author = get_post_meta(get_the_ID(), '_jobportal_testimonial_author', true);
                    $position = get_post_meta(get_the_ID(), '_jobportal_testimonial_position', true);
                    $company = get_post_meta(get_the_ID(), '_jobportal_testimonial_company', true);
                    $rating = get_post_meta(get_the_ID(), '_jobportal_testimonial_rating', true) ?: 5;
            ?>
            <div class="jobportal-testimonial-modern <?php echo $index === 1 ? 'featured' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-testimonial-modern-inner">
                    <div class="jobportal-testimonial-quote-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.192 15.757c0-.88-.23-1.618-.69-2.217-.326-.412-.768-.683-1.327-.812-.55-.128-1.07-.137-1.54-.028-.16-.95.1-1.956.76-3.022.66-1.065 1.515-1.867 2.558-2.403L9.373 5c-.8.396-1.56.898-2.26 1.505-.71.607-1.34 1.305-1.9 2.094s-.98 1.68-1.25 2.69-.346 2.04-.217 3.1c.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368l.002.003zm9.124 0c0-.88-.23-1.618-.69-2.217-.326-.42-.768-.695-1.327-.825-.55-.13-1.07-.14-1.54-.03-.16-.94.09-1.95.75-3.02.66-1.06 1.514-1.86 2.557-2.4L18.49 5c-.8.396-1.555.898-2.26 1.505-.708.607-1.34 1.305-1.894 2.094-.556.79-.97 1.68-1.24 2.69-.273 1-.345 2.04-.217 3.1.165 1.4.615 2.52 1.35 3.35.732.833 1.646 1.25 2.742 1.25.967 0 1.768-.29 2.402-.876.627-.576.942-1.365.942-2.368v.01z"/>
                        </svg>
                    </div>
                    <div class="jobportal-testimonial-rating">
                        <?php echo jobportal_render_stars($rating, 18); ?>
                    </div>
                    <blockquote class="jobportal-testimonial-text">
                        <?php the_content(); ?>
                    </blockquote>
                    <div class="jobportal-testimonial-author-modern">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="jobportal-testimonial-avatar-modern">
                            <?php the_post_thumbnail('jobportal-avatar'); ?>
                        </div>
                        <?php else : ?>
                        <div class="jobportal-testimonial-avatar-modern jobportal-avatar-initials">
                            <?php echo esc_html(substr($author ?: get_the_title(), 0, 1)); ?>
                        </div>
                        <?php endif; ?>
                        <div class="jobportal-testimonial-meta">
                            <strong class="jobportal-testimonial-name-modern"><?php echo esc_html($author ?: get_the_title()); ?></strong>
                            <?php if ($position || $company) : ?>
                            <span class="jobportal-testimonial-role-modern">
                                <?php echo esc_html($position); ?>
                                <?php if ($position && $company) echo ' at '; ?>
                                <?php echo esc_html($company); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    $index++;
                endwhile;
                wp_reset_postdata();
            else :
                $default_testimonials = array(
                    array('quote' => 'This platform has completely transformed how we operate. The features are incredible and the support team is always there when we need them.', 'author' => 'Sarah Johnson', 'role' => 'CEO', 'company' => 'TechCorp', 'initial' => 'S'),
                    array('quote' => 'We saw a 300% increase in productivity since switching to this platform. Best decision we ever made for our business. The ROI has been phenomenal.', 'author' => 'Michael Chen', 'role' => 'CTO', 'company' => 'StartupX', 'initial' => 'M'),
                    array('quote' => 'The ease of use combined with powerful features makes this the perfect solution for any business looking to scale efficiently.', 'author' => 'Emily Davis', 'role' => 'Founder', 'company' => 'GrowthLab', 'initial' => 'E'),
                );
                foreach ($default_testimonials as $index => $testimonial) :
            ?>
            <div class="jobportal-testimonial-modern <?php echo $index === 1 ? 'featured' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="jobportal-testimonial-modern-inner">
                    <div class="jobportal-testimonial-quote-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.192 15.757c0-.88-.23-1.618-.69-2.217-.326-.412-.768-.683-1.327-.812-.55-.128-1.07-.137-1.54-.028-.16-.95.1-1.956.76-3.022.66-1.065 1.515-1.867 2.558-2.403L9.373 5c-.8.396-1.56.898-2.26 1.505-.71.607-1.34 1.305-1.9 2.094s-.98 1.68-1.25 2.69-.346 2.04-.217 3.1c.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368l.002.003zm9.124 0c0-.88-.23-1.618-.69-2.217-.326-.42-.768-.695-1.327-.825-.55-.13-1.07-.14-1.54-.03-.16-.94.09-1.95.75-3.02.66-1.06 1.514-1.86 2.557-2.4L18.49 5c-.8.396-1.555.898-2.26 1.505-.708.607-1.34 1.305-1.894 2.094-.556.79-.97 1.68-1.24 2.69-.273 1-.345 2.04-.217 3.1.165 1.4.615 2.52 1.35 3.35.732.833 1.646 1.25 2.742 1.25.967 0 1.768-.29 2.402-.876.627-.576.942-1.365.942-2.368v.01z"/>
                        </svg>
                    </div>
                    <div class="jobportal-testimonial-rating">
                        <?php echo jobportal_render_stars(5, 18); ?>
                    </div>
                    <blockquote class="jobportal-testimonial-text">
                        <p><?php echo esc_html($testimonial['quote']); ?></p>
                    </blockquote>
                    <div class="jobportal-testimonial-author-modern">
                        <div class="jobportal-testimonial-avatar-modern jobportal-avatar-initials">
                            <?php echo esc_html($testimonial['initial']); ?>
                        </div>
                        <div class="jobportal-testimonial-meta">
                            <strong class="jobportal-testimonial-name-modern"><?php echo esc_html($testimonial['author']); ?></strong>
                            <span class="jobportal-testimonial-role-modern"><?php echo esc_html($testimonial['role'] . ' at ' . $testimonial['company']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section id="faq" class="jobportal-faq-section">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('FAQ', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title"><?php esc_html_e('Frequently Asked Questions', 'jobportal'); ?></h2>
            <p class="jobportal-section-description"><?php esc_html_e('Find answers to common questions about our platform', 'jobportal'); ?></p>
        </div>

        <div class="jobportal-faq-list" data-aos="fade-up">
            <?php
            $faqs = new WP_Query(array(
                'post_type'      => 'jobportal_faq',
                'posts_per_page' => 6,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            if ($faqs->have_posts()) :
                while ($faqs->have_posts()) : $faqs->the_post();
            ?>
            <div class="jobportal-faq-item">
                <button class="jobportal-faq-question" aria-expanded="false">
                    <span><?php the_title(); ?></span>
                    <?php jobportal_icon('chevron-down', 20); ?>
                </button>
                <div class="jobportal-faq-answer">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $default_faqs = array(
                    array('q' => 'How do I get started?', 'a' => 'Simply sign up for a free trial and you can start using all features immediately. No credit card required.'),
                    array('q' => 'Can I cancel anytime?', 'a' => 'Yes, you can cancel your subscription at any time. There are no long-term contracts or cancellation fees.'),
                    array('q' => 'Is there a free trial?', 'a' => 'Yes! We offer a 14-day free trial with full access to all features. No credit card required to start.'),
                    array('q' => 'Do you offer refunds?', 'a' => 'We offer a 30-day money-back guarantee. If you are not satisfied, contact us for a full refund.'),
                );
                foreach ($default_faqs as $faq) :
            ?>
            <div class="jobportal-faq-item">
                <button class="jobportal-faq-question" aria-expanded="false">
                    <span><?php echo esc_html($faq['q']); ?></span>
                    <?php jobportal_icon('chevron-down', 20); ?>
                </button>
                <div class="jobportal-faq-answer">
                    <p><?php echo esc_html($faq['a']); ?></p>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
