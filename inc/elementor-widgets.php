<?php
/**
 * Elementor Custom Widgets - Elite Theme
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Elementor Widget Category
 */
function jobportal_elementor_widget_categories($elements_manager) {
    $elements_manager->add_category(
        'jobportal-elite',
        array(
            'title' => __('JobPortal Elite', 'jobportal'),
            'icon' => 'fa fa-plug',
        )
    );
}
add_action('elementor/elements/categories_registered', 'jobportal_elementor_widget_categories');

/**
 * Register Elementor Widgets
 */
function jobportal_register_elementor_widgets($widgets_manager) {

    // Widget 1: Advanced Hero Section
    require_once FLAVOR_DIR . '/inc/elementor/widgets/hero-section.php';
    $widgets_manager->register(new \JobPortal_Elementor_Hero_Widget());

    // Widget 2: Pricing Table Advanced
    require_once FLAVOR_DIR . '/inc/elementor/widgets/pricing-table.php';
    $widgets_manager->register(new \JobPortal_Elementor_Pricing_Widget());

    // Widget 3: Testimonial Carousel
    require_once FLAVOR_DIR . '/inc/elementor/widgets/testimonials.php';
    $widgets_manager->register(new \JobPortal_Elementor_Testimonials_Widget());

    // Widget 4: Feature Grid
    require_once FLAVOR_DIR . '/inc/elementor/widgets/features.php';
    $widgets_manager->register(new \JobPortal_Elementor_Features_Widget());

    // Widget 5: Advanced Counter
    require_once FLAVOR_DIR . '/inc/elementor/widgets/counter.php';
    $widgets_manager->register(new \JobPortal_Elementor_Counter_Widget());

    // Widget 6: Team Member Card
    require_once FLAVOR_DIR . '/inc/elementor/widgets/team-member.php';
    $widgets_manager->register(new \JobPortal_Elementor_Team_Widget());

    // Widget 7: FAQ Accordion
    require_once FLAVOR_DIR . '/inc/elementor/widgets/faq.php';
    $widgets_manager->register(new \JobPortal_Elementor_FAQ_Widget());

    // Widget 8: CTA Section
    require_once FLAVOR_DIR . '/inc/elementor/widgets/cta.php';
    $widgets_manager->register(new \JobPortal_Elementor_CTA_Widget());

    // Widget 9: Logo Carousel
    require_once FLAVOR_DIR . '/inc/elementor/widgets/logo-carousel.php';
    $widgets_manager->register(new \JobPortal_Elementor_Logo_Carousel_Widget());

    // Widget 10: Animated Heading
    require_once FLAVOR_DIR . '/inc/elementor/widgets/animated-heading.php';
    $widgets_manager->register(new \JobPortal_Elementor_Animated_Heading_Widget());
}
add_action('elementor/widgets/register', 'jobportal_register_elementor_widgets');

/**
 * Enqueue Elementor Widget Scripts
 */
function jobportal_elementor_widget_scripts() {
    wp_enqueue_script(
        'jobportal-elementor-widgets',
        FLAVOR_ASSETS . '/js/elementor-widgets.js',
        array('jquery', 'elementor-frontend'),
        FLAVOR_VERSION,
        true
    );

    wp_enqueue_style(
        'jobportal-elementor-widgets',
        FLAVOR_ASSETS . '/css/elementor-widgets.css',
        array(),
        FLAVOR_VERSION
    );
}
add_action('elementor/frontend/after_enqueue_scripts', 'jobportal_elementor_widget_scripts');
