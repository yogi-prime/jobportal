<?php
/**
 * Premium Job Listings with WooCommerce
 * Monetization system for featured job placements
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create WooCommerce Products for Job Packages
 */
function jobportal_create_job_packages() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Check if products already exist
    if (get_option('jobportal_packages_created')) {
        return;
    }

    // Package 1: Featured Job (30 days)
    $featured_product = array(
        'post_title'   => 'Featured Job Listing - 30 Days',
        'post_content' => 'Make your job listing stand out! Featured jobs appear at the top of search results with a special badge.',
        'post_status'  => 'publish',
        'post_type'    => 'product',
    );

    $featured_id = wp_insert_post($featured_product);
    if ($featured_id) {
        update_post_meta($featured_id, '_regular_price', '49');
        update_post_meta($featured_id, '_price', '49');
        update_post_meta($featured_id, '_virtual', 'yes');
        update_post_meta($featured_id, '_jobportal_package_type', 'featured');
        update_post_meta($featured_id, '_jobportal_package_duration', '30');
        wp_set_object_terms($featured_id, 'simple', 'product_type');
    }

    // Package 2: Premium Job (60 days)
    $premium_product = array(
        'post_title'   => 'Premium Job Listing - 60 Days',
        'post_content' => 'Maximum visibility! Premium jobs get featured placement, highlighted design, and priority in search results for 60 days.',
        'post_status'  => 'publish',
        'post_type'    => 'product',
    );

    $premium_id = wp_insert_post($premium_product);
    if ($premium_id) {
        update_post_meta($premium_id, '_regular_price', '99');
        update_post_meta($premium_id, '_price', '99');
        update_post_meta($premium_id, '_virtual', 'yes');
        update_post_meta($premium_id, '_jobportal_package_type', 'premium');
        update_post_meta($premium_id, '_jobportal_package_duration', '60');
        wp_set_object_terms($premium_id, 'simple', 'product_type');
    }

    // Package 3: Job Bundle (5 jobs)
    $bundle_product = array(
        'post_title'   => 'Job Bundle - 5 Listings',
        'post_content' => 'Save 20%! Post 5 standard job listings. Perfect for companies with multiple openings.',
        'post_status'  => 'publish',
        'post_type'    => 'product',
    );

    $bundle_id = wp_insert_post($bundle_product);
    if ($bundle_id) {
        update_post_meta($bundle_id, '_regular_price', '199');
        update_post_meta($bundle_id, '_price', '199');
        update_post_meta($bundle_id, '_virtual', 'yes');
        update_post_meta($bundle_id, '_jobportal_package_type', 'bundle');
        update_post_meta($bundle_id, '_jobportal_package_credits', '5');
        wp_set_object_terms($bundle_id, 'simple', 'product_type');
    }

    update_option('jobportal_packages_created', true);
}
add_action('after_setup_theme', 'jobportal_create_job_packages');

/**
 * Add Premium Fields to Job Post Type
 */
function jobportal_add_premium_meta_boxes() {
    add_meta_box(
        'jobportal_premium_settings',
        __('Premium Listing Settings', 'jobportal'),
        'jobportal_premium_meta_box_callback',
        'job',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'jobportal_add_premium_meta_boxes');

/**
 * Premium Meta Box Callback
 */
function jobportal_premium_meta_box_callback($post) {
    wp_nonce_field('jobportal_premium_meta', 'jobportal_premium_nonce');

    $is_featured = get_post_meta($post->ID, '_is_featured', true);
    $is_premium = get_post_meta($post->ID, '_is_premium', true);
    $featured_until = get_post_meta($post->ID, '_featured_until', true);
    $order_id = get_post_meta($post->ID, '_premium_order_id', true);

    ?>
    <style>
        .jobportal-premium-option {
            margin-bottom: 15px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .jobportal-premium-badge {
            display: inline-block;
            padding: 4px 10px;
            background: #fbbf24;
            color: #78350f;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            margin-left: 8px;
        }
        .jobportal-premium-info {
            margin-top: 10px;
            padding: 10px;
            background: #ecfdf5;
            border-left: 4px solid #10b981;
            font-size: 12px;
        }
    </style>

    <div class="jobportal-premium-settings">
        <!-- Featured Listing -->
        <div class="jobportal-premium-option">
            <label>
                <input type="checkbox" name="is_featured" value="1" <?php checked($is_featured, '1'); ?>>
                <strong><?php _e('Featured Listing', 'jobportal'); ?></strong>
                <?php if ($is_featured) : ?>
                    <span class="jobportal-premium-badge"><?php _e('ACTIVE', 'jobportal'); ?></span>
                <?php endif; ?>
            </label>
            <p style="margin: 8px 0 0; font-size: 12px; color: #6b7280;">
                <?php _e('Show at top of search results with badge', 'jobportal'); ?>
            </p>
        </div>

        <!-- Premium Listing -->
        <div class="jobportal-premium-option">
            <label>
                <input type="checkbox" name="is_premium" value="1" <?php checked($is_premium, '1'); ?>>
                <strong><?php _e('Premium Listing', 'jobportal'); ?></strong>
                <?php if ($is_premium) : ?>
                    <span class="jobportal-premium-badge" style="background: #8b5cf6; color: white;"><?php _e('PREMIUM', 'jobportal'); ?></span>
                <?php endif; ?>
            </label>
            <p style="margin: 8px 0 0; font-size: 12px; color: #6b7280;">
                <?php _e('Highlighted design + priority placement', 'jobportal'); ?>
            </p>
        </div>

        <?php if ($featured_until) : ?>
            <div class="jobportal-premium-info">
                <strong><?php _e('Featured Until:', 'jobportal'); ?></strong>
                <?php echo date('M d, Y', strtotime($featured_until)); ?>
            </div>
        <?php endif; ?>

        <?php if ($order_id) : ?>
            <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                <a href="<?php echo admin_url('post.php?post=' . $order_id . '&action=edit'); ?>" target="_blank" style="font-size: 12px;">
                    <?php _e('View Order #', 'jobportal'); ?><?php echo $order_id; ?>
                </a>
            </div>
        <?php endif; ?>

        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
            <p style="font-size: 11px; color: #6b7280;">
                <?php _e('Users can purchase premium placement via WooCommerce.', 'jobportal'); ?>
            </p>
        </div>
    </div>
    <?php
}

/**
 * Save Premium Meta Data
 */
function jobportal_save_premium_meta($post_id) {
    if (!isset($_POST['jobportal_premium_nonce']) ||
        !wp_verify_nonce($_POST['jobportal_premium_nonce'], 'jobportal_premium_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save featured status
    $is_featured = isset($_POST['is_featured']) ? '1' : '0';
    update_post_meta($post_id, '_is_featured', $is_featured);

    // Save premium status
    $is_premium = isset($_POST['is_premium']) ? '1' : '0';
    update_post_meta($post_id, '_is_premium', $is_premium);
}
add_action('save_post_job', 'jobportal_save_premium_meta');

/**
 * Handle WooCommerce Order Completion
 */
function jobportal_handle_premium_purchase($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        $package_type = get_post_meta($product_id, '_jobportal_package_type', true);

        if (!$package_type) continue;

        // Get user's job or create credit
        $user_id = $order->get_user_id();

        if ($package_type === 'bundle') {
            // Add credits for bundle
            $credits = get_post_meta($product_id, '_jobportal_package_credits', true);
            $current_credits = get_user_meta($user_id, '_jobportal_job_credits', true) ?: 0;
            update_user_meta($user_id, '_jobportal_job_credits', $current_credits + $credits);
        } else {
            // Add premium package to user's account
            $packages = get_user_meta($user_id, '_jobportal_premium_packages', true) ?: array();
            $packages[] = array(
                'type' => $package_type,
                'duration' => get_post_meta($product_id, '_jobportal_package_duration', true),
                'order_id' => $order_id,
                'purchased' => current_time('mysql'),
            );
            update_user_meta($user_id, '_jobportal_premium_packages', $packages);
        }
    }
}
add_action('woocommerce_order_status_completed', 'jobportal_handle_premium_purchase');

/**
 * Modify Job Query to Show Featured Jobs First
 */
function jobportal_prioritize_featured_jobs($query) {
    if (!is_admin() && $query->is_main_query() && $query->get('post_type') === 'job') {
        $meta_query = $query->get('meta_query') ?: array();

        $query->set('orderby', array(
            'meta_value_num' => 'DESC',
            'date' => 'DESC',
        ));

        $query->set('meta_key', '_is_premium');
    }
}
add_action('pre_get_posts', 'jobportal_prioritize_featured_jobs');

/**
 * Add Premium Badge to Job Cards
 */
function jobportal_add_premium_badge($job_id) {
    $is_featured = get_post_meta($job_id, '_is_featured', true);
    $is_premium = get_post_meta($job_id, '_is_premium', true);

    if ($is_premium) {
        echo '<span class="jobportal-premium-badge" style="position: absolute; top: 20px; right: 20px; padding: 6px 14px; background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%); color: white; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);">⭐ Premium</span>';
    } elseif ($is_featured) {
        echo '<span class="jobportal-featured-badge" style="position: absolute; top: 20px; right: 20px; padding: 6px 14px; background: #fbbf24; color: #78350f; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;">✨ Featured</span>';
    }
}

/**
 * Shortcode: Job Pricing Packages
 */
function jobportal_pricing_packages_shortcode() {
    if (!class_exists('WooCommerce')) {
        return '<p>' . __('WooCommerce is required for premium listings.', 'jobportal') . '</p>';
    }

    ob_start();
    ?>
    <style>
    .jobportal-pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 32px;
        margin: 40px 0;
    }
    .jobportal-pricing-card {
        background: white;
        border-radius: 20px;
        padding: 40px 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .jobportal-pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(79, 172, 254, 0.2);
    }
    .jobportal-pricing-card.featured {
        border: 3px solid #4facfe;
    }
    .jobportal-pricing-card.featured::before {
        content: 'POPULAR';
        position: absolute;
        top: 20px;
        right: -35px;
        background: #4facfe;
        color: white;
        padding: 6px 40px;
        font-size: 11px;
        font-weight: 700;
        transform: rotate(45deg);
    }
    .jobportal-price {
        font-size: 48px;
        font-weight: 800;
        color: #1e293b;
        margin: 20px 0;
    }
    .jobportal-price-currency {
        font-size: 24px;
        vertical-align: super;
    }
    .jobportal-pricing-features {
        list-style: none;
        padding: 0;
        margin: 24px 0;
    }
    .jobportal-pricing-features li {
        padding: 12px 0;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #64748b;
    }
    .jobportal-pricing-features li::before {
        content: '✓';
        color: #10b981;
        font-weight: 700;
        font-size: 18px;
    }
    </style>

    <div class="jobportal-pricing-grid">
        <?php
        // Get job package products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => '_jobportal_package_type',
                    'compare' => 'EXISTS',
                ),
            ),
        );

        $products = get_posts($args);

        foreach ($products as $product) :
            $product_obj = wc_get_product($product->ID);
            $package_type = get_post_meta($product->ID, '_jobportal_package_type', true);
            $is_featured = ($package_type === 'premium');
        ?>
            <div class="jobportal-pricing-card <?php echo $is_featured ? 'featured' : ''; ?>">
                <h3 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo esc_html($product->post_title); ?>
                </h3>
                <div class="jobportal-price">
                    <span class="jobportal-price-currency">$</span><?php echo $product_obj->get_price(); ?>
                </div>
                <p style="color: #64748b; margin-bottom: 24px;">
                    <?php echo wp_trim_words($product->post_content, 15); ?>
                </p>
                <a href="<?php echo $product_obj->add_to_cart_url(); ?>" class="jobportal-btn jobportal-btn-primary" style="width: 100%; justify-content: center; text-decoration: none;">
                    <?php _e('Get Started', 'jobportal'); ?>
                </a>
                <ul class="jobportal-pricing-features">
                    <?php
                    if ($package_type === 'featured') {
                        echo '<li>Top placement in search</li>';
                        echo '<li>Featured badge</li>';
                        echo '<li>30 days visibility</li>';
                        echo '<li>Email support</li>';
                    } elseif ($package_type === 'premium') {
                        echo '<li>Maximum visibility</li>';
                        echo '<li>Premium badge & highlight</li>';
                        echo '<li>60 days visibility</li>';
                        echo '<li>Priority support</li>';
                        echo '<li>Social media promotion</li>';
                    } elseif ($package_type === 'bundle') {
                        echo '<li>5 standard job postings</li>';
                        echo '<li>Save 20%</li>';
                        echo '<li>Use anytime</li>';
                        echo '<li>Never expires</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_pricing', 'jobportal_pricing_packages_shortcode');
