<?php
/**
 * Custom Post Types for JobPortal Theme
 *
 * @package JobPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Types
 */
function jobportal_register_post_types() {

    // ===========================================
    // JOB POST TYPE (MAIN FEATURE!)
    // ===========================================
    register_post_type('job', array(
        'labels' => array(
            'name'               => _x('Jobs', 'post type general name', 'jobportal'),
            'singular_name'      => _x('Job', 'post type singular name', 'jobportal'),
            'menu_name'          => _x('Jobs', 'admin menu', 'jobportal'),
            'add_new'            => _x('Add New', 'job', 'jobportal'),
            'add_new_item'       => __('Add New Job', 'jobportal'),
            'edit_item'          => __('Edit Job', 'jobportal'),
            'new_item'           => __('New Job', 'jobportal'),
            'view_item'          => __('View Job', 'jobportal'),
            'search_items'       => __('Search Jobs', 'jobportal'),
            'not_found'          => __('No jobs found', 'jobportal'),
            'not_found_in_trash' => __('No jobs found in Trash', 'jobportal'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'jobs'),
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
        'menu_icon'           => 'dashicons-businessperson',
        'show_in_rest'        => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'capability_type'     => 'post',
        'taxonomies'          => array('category', 'post_tag'),
    ));

    // ===========================================
    // SERVICES/FEATURES POST TYPE
    // ===========================================
    register_post_type('jobportal_service', array(
        'labels' => array(
            'name'               => _x('Services', 'post type general name', 'jobportal'),
            'singular_name'      => _x('Service', 'post type singular name', 'jobportal'),
            'menu_name'          => _x('Services', 'admin menu', 'jobportal'),
            'add_new'            => _x('Add New', 'service', 'jobportal'),
            'add_new_item'       => __('Add New Service', 'jobportal'),
            'edit_item'          => __('Edit Service', 'jobportal'),
            'new_item'           => __('New Service', 'jobportal'),
            'view_item'          => __('View Service', 'jobportal'),
            'search_items'       => __('Search Services', 'jobportal'),
            'not_found'          => __('No services found', 'jobportal'),
            'not_found_in_trash' => __('No services found in Trash', 'jobportal'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'service'),
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'           => 'dashicons-star-filled',
        'show_in_rest'        => true,
        'hierarchical'        => false,
    ));

    // ===========================================
    // TESTIMONIALS POST TYPE
    // ===========================================
    register_post_type('jobportal_testimonial', array(
        'labels' => array(
            'name'               => _x('Testimonials', 'post type general name', 'jobportal'),
            'singular_name'      => _x('Testimonial', 'post type singular name', 'jobportal'),
            'menu_name'          => _x('Testimonials', 'admin menu', 'jobportal'),
            'add_new'            => _x('Add New', 'testimonial', 'jobportal'),
            'add_new_item'       => __('Add New Testimonial', 'jobportal'),
            'edit_item'          => __('Edit Testimonial', 'jobportal'),
            'new_item'           => __('New Testimonial', 'jobportal'),
            'view_item'          => __('View Testimonial', 'jobportal'),
            'search_items'       => __('Search Testimonials', 'jobportal'),
            'not_found'          => __('No testimonials found', 'jobportal'),
            'not_found_in_trash' => __('No testimonials found in Trash', 'jobportal'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'testimonial'),
        'supports'            => array('title', 'editor', 'thumbnail'),
        'menu_icon'           => 'dashicons-format-quote',
        'show_in_rest'        => true,
    ));

    // ===========================================
    // PRICING PLANS POST TYPE
    // ===========================================
    register_post_type('jobportal_pricing', array(
        'labels' => array(
            'name'               => _x('Pricing Plans', 'post type general name', 'jobportal'),
            'singular_name'      => _x('Pricing Plan', 'post type singular name', 'jobportal'),
            'menu_name'          => _x('Pricing', 'admin menu', 'jobportal'),
            'add_new'            => _x('Add New', 'pricing', 'jobportal'),
            'add_new_item'       => __('Add New Plan', 'jobportal'),
            'edit_item'          => __('Edit Plan', 'jobportal'),
            'new_item'           => __('New Plan', 'jobportal'),
            'view_item'          => __('View Plan', 'jobportal'),
            'search_items'       => __('Search Plans', 'jobportal'),
            'not_found'          => __('No plans found', 'jobportal'),
            'not_found_in_trash' => __('No plans found in Trash', 'jobportal'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'pricing'),
        'supports'            => array('title', 'page-attributes'),
        'menu_icon'           => 'dashicons-money-alt',
        'show_in_rest'        => true,
    ));

    // ===========================================
    // FAQ POST TYPE
    // ===========================================
    register_post_type('jobportal_faq', array(
        'labels' => array(
            'name'               => _x('FAQs', 'post type general name', 'jobportal'),
            'singular_name'      => _x('FAQ', 'post type singular name', 'jobportal'),
            'menu_name'          => _x('FAQs', 'admin menu', 'jobportal'),
            'add_new'            => _x('Add New', 'faq', 'jobportal'),
            'add_new_item'       => __('Add New FAQ', 'jobportal'),
            'edit_item'          => __('Edit FAQ', 'jobportal'),
            'new_item'           => __('New FAQ', 'jobportal'),
            'view_item'          => __('View FAQ', 'jobportal'),
            'search_items'       => __('Search FAQs', 'jobportal'),
            'not_found'          => __('No FAQs found', 'jobportal'),
            'not_found_in_trash' => __('No FAQs found in Trash', 'jobportal'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'faq'),
        'supports'            => array('title', 'editor', 'page-attributes'),
        'menu_icon'           => 'dashicons-editor-help',
        'show_in_rest'        => true,
    ));
}
add_action('init', 'jobportal_register_post_types');

/**
 * Add Meta Boxes
 */
function jobportal_add_meta_boxes() {
    // Service meta box
    add_meta_box(
        'jobportal_service_details',
        __('Service Details', 'jobportal'),
        'jobportal_service_meta_box_callback',
        'jobportal_service',
        'normal',
        'high'
    );

    // Testimonial meta box
    add_meta_box(
        'jobportal_testimonial_details',
        __('Testimonial Details', 'jobportal'),
        'jobportal_testimonial_meta_box_callback',
        'jobportal_testimonial',
        'normal',
        'high'
    );

    // Pricing meta box
    add_meta_box(
        'jobportal_pricing_details',
        __('Pricing Details', 'jobportal'),
        'jobportal_pricing_meta_box_callback',
        'jobportal_pricing',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'jobportal_add_meta_boxes');

/**
 * Service Meta Box Callback
 */
function jobportal_service_meta_box_callback($post) {
    wp_nonce_field('jobportal_service_save', 'jobportal_service_nonce');

    $icon = get_post_meta($post->ID, '_jobportal_service_icon', true);
    $link = get_post_meta($post->ID, '_jobportal_service_link', true);
    $link_text = get_post_meta($post->ID, '_jobportal_service_link_text', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="jobportal_service_icon"><?php esc_html_e('Icon Name', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_service_icon" name="jobportal_service_icon" value="<?php echo esc_attr($icon); ?>" class="regular-text">
                <p class="description"><?php esc_html_e('Enter icon name (e.g., rocket, shield, zap, code, layers)', 'jobportal'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_service_link"><?php esc_html_e('Link URL', 'jobportal'); ?></label></th>
            <td>
                <input type="url" id="jobportal_service_link" name="jobportal_service_link" value="<?php echo esc_url($link); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_service_link_text"><?php esc_html_e('Link Text', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_service_link_text" name="jobportal_service_link_text" value="<?php echo esc_attr($link_text); ?>" class="regular-text">
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Testimonial Meta Box Callback
 */
function jobportal_testimonial_meta_box_callback($post) {
    wp_nonce_field('jobportal_testimonial_save', 'jobportal_testimonial_nonce');

    $author = get_post_meta($post->ID, '_jobportal_testimonial_author', true);
    $position = get_post_meta($post->ID, '_jobportal_testimonial_position', true);
    $company = get_post_meta($post->ID, '_jobportal_testimonial_company', true);
    $rating = get_post_meta($post->ID, '_jobportal_testimonial_rating', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="jobportal_testimonial_author"><?php esc_html_e('Author Name', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_testimonial_author" name="jobportal_testimonial_author" value="<?php echo esc_attr($author); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_testimonial_position"><?php esc_html_e('Position', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_testimonial_position" name="jobportal_testimonial_position" value="<?php echo esc_attr($position); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_testimonial_company"><?php esc_html_e('Company', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_testimonial_company" name="jobportal_testimonial_company" value="<?php echo esc_attr($company); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_testimonial_rating"><?php esc_html_e('Rating (1-5)', 'jobportal'); ?></label></th>
            <td>
                <select id="jobportal_testimonial_rating" name="jobportal_testimonial_rating">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <option value="<?php echo esc_attr($i); ?>" <?php selected($rating, $i); ?>><?php echo esc_html($i); ?> <?php echo esc_html($i === 1 ? 'Star' : 'Stars'); ?></option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Pricing Meta Box Callback
 */
function jobportal_pricing_meta_box_callback($post) {
    wp_nonce_field('jobportal_pricing_save', 'jobportal_pricing_nonce');

    $price_monthly = get_post_meta($post->ID, '_jobportal_pricing_monthly', true);
    $price_yearly = get_post_meta($post->ID, '_jobportal_pricing_yearly', true);
    $features = get_post_meta($post->ID, '_jobportal_pricing_features', true);
    $is_popular = get_post_meta($post->ID, '_jobportal_pricing_popular', true);
    $button_text = get_post_meta($post->ID, '_jobportal_pricing_button_text', true);
    $button_url = get_post_meta($post->ID, '_jobportal_pricing_button_url', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="jobportal_pricing_monthly"><?php esc_html_e('Monthly Price', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_pricing_monthly" name="jobportal_pricing_monthly" value="<?php echo esc_attr($price_monthly); ?>" class="regular-text">
                <p class="description"><?php esc_html_e('Enter number only (e.g., 29)', 'jobportal'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_pricing_yearly"><?php esc_html_e('Yearly Price', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_pricing_yearly" name="jobportal_pricing_yearly" value="<?php echo esc_attr($price_yearly); ?>" class="regular-text">
                <p class="description"><?php esc_html_e('Enter number only (e.g., 290)', 'jobportal'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_pricing_features"><?php esc_html_e('Features', 'jobportal'); ?></label></th>
            <td>
                <textarea id="jobportal_pricing_features" name="jobportal_pricing_features" rows="6" class="large-text"><?php echo esc_textarea($features); ?></textarea>
                <p class="description"><?php esc_html_e('Enter one feature per line', 'jobportal'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_pricing_popular"><?php esc_html_e('Popular Plan', 'jobportal'); ?></label></th>
            <td>
                <label>
                    <input type="checkbox" id="jobportal_pricing_popular" name="jobportal_pricing_popular" value="1" <?php checked($is_popular, '1'); ?>>
                    <?php esc_html_e('Mark as popular/recommended plan', 'jobportal'); ?>
                </label>
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_pricing_button_text"><?php esc_html_e('Button Text', 'jobportal'); ?></label></th>
            <td>
                <input type="text" id="jobportal_pricing_button_text" name="jobportal_pricing_button_text" value="<?php echo esc_attr($button_text); ?>" class="regular-text" placeholder="Get Started">
            </td>
        </tr>
        <tr>
            <th><label for="jobportal_pricing_button_url"><?php esc_html_e('Button URL', 'jobportal'); ?></label></th>
            <td>
                <input type="url" id="jobportal_pricing_button_url" name="jobportal_pricing_button_url" value="<?php echo esc_url($button_url); ?>" class="regular-text">
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save Service Meta Box
 */
function jobportal_save_service_meta($post_id) {
    if (!isset($_POST['jobportal_service_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['jobportal_service_nonce'])), 'jobportal_service_save')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'jobportal_service_icon'      => '_jobportal_service_icon',
        'jobportal_service_link'      => '_jobportal_service_link',
        'jobportal_service_link_text' => '_jobportal_service_link_text',
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            $value = $field === 'jobportal_service_link'
                ? esc_url_raw(wp_unslash($_POST[$field]))
                : sanitize_text_field(wp_unslash($_POST[$field]));
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('save_post_jobportal_service', 'jobportal_save_service_meta');

/**
 * Save Testimonial Meta Box
 */
function jobportal_save_testimonial_meta($post_id) {
    if (!isset($_POST['jobportal_testimonial_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['jobportal_testimonial_nonce'])), 'jobportal_testimonial_save')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'jobportal_testimonial_author'   => '_jobportal_testimonial_author',
        'jobportal_testimonial_position' => '_jobportal_testimonial_position',
        'jobportal_testimonial_company'  => '_jobportal_testimonial_company',
        'jobportal_testimonial_rating'   => '_jobportal_testimonial_rating',
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field(wp_unslash($_POST[$field])));
        }
    }
}
add_action('save_post_jobportal_testimonial', 'jobportal_save_testimonial_meta');

/**
 * Save Pricing Meta Box
 */
function jobportal_save_pricing_meta($post_id) {
    if (!isset($_POST['jobportal_pricing_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['jobportal_pricing_nonce'])), 'jobportal_pricing_save')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $text_fields = array(
        'jobportal_pricing_monthly'     => '_jobportal_pricing_monthly',
        'jobportal_pricing_yearly'      => '_jobportal_pricing_yearly',
        'jobportal_pricing_features'    => '_jobportal_pricing_features',
        'jobportal_pricing_button_text' => '_jobportal_pricing_button_text',
    );

    foreach ($text_fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            if ($field === 'jobportal_pricing_features') {
                update_post_meta($post_id, $meta_key, sanitize_textarea_field(wp_unslash($_POST[$field])));
            } else {
                update_post_meta($post_id, $meta_key, sanitize_text_field(wp_unslash($_POST[$field])));
            }
        }
    }

    if (isset($_POST['jobportal_pricing_button_url'])) {
        update_post_meta($post_id, '_jobportal_pricing_button_url', esc_url_raw(wp_unslash($_POST['jobportal_pricing_button_url'])));
    }

    $is_popular = isset($_POST['jobportal_pricing_popular']) ? '1' : '0';
    update_post_meta($post_id, '_jobportal_pricing_popular', $is_popular);
}
add_action('save_post_jobportal_pricing', 'jobportal_save_pricing_meta');

/**
 * Add admin columns for Services
 */
function jobportal_service_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['icon'] = __('Icon', 'jobportal');
        }
    }
    return $new_columns;
}
add_filter('manage_jobportal_service_posts_columns', 'jobportal_service_columns');

function jobportal_service_column_content($column, $post_id) {
    if ($column === 'icon') {
        $icon = get_post_meta($post_id, '_jobportal_service_icon', true);
        echo esc_html($icon ? $icon : '—');
    }
}
add_action('manage_jobportal_service_posts_custom_column', 'jobportal_service_column_content', 10, 2);

/**
 * Add admin columns for Testimonials
 */
function jobportal_testimonial_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['author_name'] = __('Author', 'jobportal');
            $new_columns['company'] = __('Company', 'jobportal');
            $new_columns['rating'] = __('Rating', 'jobportal');
        }
    }
    return $new_columns;
}
add_filter('manage_jobportal_testimonial_posts_columns', 'jobportal_testimonial_columns');

function jobportal_testimonial_column_content($column, $post_id) {
    switch ($column) {
        case 'author_name':
            echo esc_html(get_post_meta($post_id, '_jobportal_testimonial_author', true) ?: '—');
            break;
        case 'company':
            echo esc_html(get_post_meta($post_id, '_jobportal_testimonial_company', true) ?: '—');
            break;
        case 'rating':
            $rating = get_post_meta($post_id, '_jobportal_testimonial_rating', true);
            echo esc_html($rating ? $rating . '/5' : '—');
            break;
    }
}
add_action('manage_jobportal_testimonial_posts_custom_column', 'jobportal_testimonial_column_content', 10, 2);

/**
 * Add admin columns for Pricing
 */
function jobportal_pricing_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['price'] = __('Price', 'jobportal');
            $new_columns['popular'] = __('Popular', 'jobportal');
        }
    }
    return $new_columns;
}
add_filter('manage_jobportal_pricing_posts_columns', 'jobportal_pricing_columns');

function jobportal_pricing_column_content($column, $post_id) {
    $currency = get_theme_mod('jobportal_pricing_currency', '$');
    switch ($column) {
        case 'price':
            $monthly = get_post_meta($post_id, '_jobportal_pricing_monthly', true);
            echo esc_html($monthly ? $currency . $monthly . '/mo' : '—');
            break;
        case 'popular':
            $is_popular = get_post_meta($post_id, '_jobportal_pricing_popular', true);
            echo $is_popular ? '<span class="dashicons dashicons-yes" style="color:green;"></span>' : '—';
            break;
    }
}
add_action('manage_jobportal_pricing_posts_custom_column', 'jobportal_pricing_column_content', 10, 2);
