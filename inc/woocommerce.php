<?php
/**
 * WooCommerce Compatibility
 *
 * @package JobPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register WooCommerce sidebar
 */
function jobportal_woocommerce_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'jobportal'),
        'id'            => 'sidebar-shop',
        'description'   => esc_html__('Widgets in this area will appear on shop pages.', 'jobportal'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'jobportal_woocommerce_widgets_init');

/**
 * Remove default WooCommerce wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrappers
 */
function jobportal_woocommerce_wrapper_start() {
    echo '<div class="jobportal-woocommerce-wrapper"><div class="jobportal-container">';
}
add_action('woocommerce_before_main_content', 'jobportal_woocommerce_wrapper_start', 10);

function jobportal_woocommerce_wrapper_end() {
    echo '</div></div>';
}
add_action('woocommerce_after_main_content', 'jobportal_woocommerce_wrapper_end', 10);

/**
 * Products per page
 */
function jobportal_woocommerce_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'jobportal_woocommerce_products_per_page', 20);

/**
 * Product gallery thumbnail columns
 */
function jobportal_woocommerce_thumbnail_columns() {
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'jobportal_woocommerce_thumbnail_columns');

/**
 * Related products count
 */
function jobportal_woocommerce_related_products_args($args) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'jobportal_woocommerce_related_products_args');
