<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (get_theme_mod('jobportal_enable_preloader', true)) : ?>
<div class="jobportal-preloader" id="preloader">
    <div class="jobportal-preloader-inner">
        <?php $preloader_style = get_theme_mod('jobportal_preloader_style', 'spinner'); ?>
        <?php if ($preloader_style === 'spinner') : ?>
            <div class="jobportal-spinner"></div>
        <?php elseif ($preloader_style === 'dots') : ?>
            <div class="jobportal-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        <?php elseif ($preloader_style === 'progress') : ?>
            <div class="jobportal-progress-bar"></div>
        <?php else : ?>
            <?php if (has_custom_logo()) : ?>
                <div class="jobportal-logo-preloader">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <div class="jobportal-spinner"></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<a class="skip-link screen-reader-text" href="#primary">
    <?php esc_html_e('Skip to content', 'jobportal'); ?>
</a>

<header id="masthead" class="jobportal-header <?php echo esc_attr(get_theme_mod('jobportal_header_style', 'default')); ?>">
    <div class="jobportal-header-wrapper">
        <div class="jobportal-container">
            <div class="jobportal-header-inner">

                <div class="jobportal-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="jobportal-site-logo-link" rel="home">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" height="50">
                        </a>
                    <?php endif; ?>
                </div>

                <nav id="site-navigation" class="jobportal-navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'jobportal'); ?>">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'jobportal-menu',
                            'container'      => false,
                            'walker'         => new JobPortal_Mega_Menu_Walker(),
                            'fallback_cb'    => false,
                        ));
                    } else {
                        // Default menu if no menu is set
                        ?>
                        <ul id="primary-menu" class="jobportal-menu">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url(home_url('/jobs')); ?>">Browse Jobs</a></li>
                            <li><a href="<?php echo esc_url(home_url('/resume-builder')); ?>">Resume Builder</a></li>
                            <li><a href="<?php echo esc_url(home_url('/job-matcher')); ?>">Job Matcher</a></li>
                            <li><a href="<?php echo esc_url(home_url('/salary-calculator')); ?>">Salary Calculator</a></li>
                            <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </nav>

                <div class="jobportal-header-actions">
                    <?php
                    $cta_text = get_theme_mod('jobportal_header_cta_text', __('Post a Job', 'jobportal'));
                    $cta_url = get_theme_mod('jobportal_header_cta_url', home_url('/post-job'));
                    if (!empty($cta_text)) :
                    ?>
                    <a href="<?php echo esc_url($cta_url); ?>" class="jobportal-btn jobportal-btn-primary jobportal-header-cta">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                    <?php endif; ?>

                    <button class="jobportal-mobile-toggle" id="mobile-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle mobile menu', 'jobportal'); ?>">
                        <span class="jobportal-hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="jobportal-mobile-menu" id="mobile-menu" aria-hidden="true">
        <div class="jobportal-mobile-menu-inner">
            <div class="jobportal-mobile-menu-header">
                <div class="jobportal-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="jobportal-site-title" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <button class="jobportal-mobile-close" id="mobile-close" aria-label="<?php esc_attr_e('Close menu', 'jobportal'); ?>">
                    <?php jobportal_icon('x', 24); ?>
                </button>
            </div>

            <nav class="jobportal-mobile-nav" aria-label="<?php esc_attr_e('Mobile Navigation', 'jobportal'); ?>">
                <?php
                if (has_nav_menu('mobile')) {
                    wp_nav_menu(array(
                        'theme_location' => 'mobile',
                        'menu_id'        => 'mobile-nav-menu',
                        'menu_class'     => 'jobportal-mobile-menu-list',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                } elseif (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-nav-menu',
                        'menu_class'     => 'jobportal-mobile-menu-list',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                }
                ?>
            </nav>

            <?php if (!empty($cta_text)) : ?>
            <div class="jobportal-mobile-menu-footer">
                <a href="<?php echo esc_url($cta_url); ?>" class="jobportal-btn jobportal-btn-primary jobportal-btn-block">
                    <?php echo esc_html($cta_text); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="jobportal-mobile-overlay" id="mobile-overlay"></div>
</header>

<main id="primary" class="jobportal-main">
