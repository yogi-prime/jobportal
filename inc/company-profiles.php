<?php
/**
 * Company Profiles System
 * Dedicated company pages with branding and job listings
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Company Custom Post Type
 */
function jobportal_register_company_post_type() {
    $labels = array(
        'name'                  => _x('Companies', 'Post type general name', 'jobportal'),
        'singular_name'         => _x('Company', 'Post type singular name', 'jobportal'),
        'menu_name'             => _x('Companies', 'Admin Menu text', 'jobportal'),
        'name_admin_bar'        => _x('Company', 'Add New on Toolbar', 'jobportal'),
        'add_new'               => __('Add New', 'jobportal'),
        'add_new_item'          => __('Add New Company', 'jobportal'),
        'new_item'              => __('New Company', 'jobportal'),
        'edit_item'             => __('Edit Company', 'jobportal'),
        'view_item'             => __('View Company', 'jobportal'),
        'all_items'             => __('All Companies', 'jobportal'),
        'search_items'          => __('Search Companies', 'jobportal'),
        'parent_item_colon'     => __('Parent Companies:', 'jobportal'),
        'not_found'             => __('No companies found.', 'jobportal'),
        'not_found_in_trash'    => __('No companies found in Trash.', 'jobportal'),
        'featured_image'        => _x('Company Logo', 'Overrides the "Featured Image" phrase', 'jobportal'),
        'set_featured_image'    => _x('Set company logo', 'Overrides the "Set featured image" phrase', 'jobportal'),
        'remove_featured_image' => _x('Remove company logo', 'Overrides the "Remove featured image" phrase', 'jobportal'),
        'use_featured_image'    => _x('Use as company logo', 'Overrides the "Use as featured image" phrase', 'jobportal'),
        'archives'              => _x('Company archives', 'The post type archive label', 'jobportal'),
        'insert_into_item'      => _x('Insert into company', 'Overrides the "Insert into post" phrase', 'jobportal'),
        'uploaded_to_this_item' => _x('Uploaded to this company', 'Overrides the "Uploaded to this post" phrase', 'jobportal'),
        'filter_items_list'     => _x('Filter companies list', 'Screen reader text', 'jobportal'),
        'items_list_navigation' => _x('Companies list navigation', 'Screen reader text', 'jobportal'),
        'items_list'            => _x('Companies list', 'Screen reader text', 'jobportal'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'company'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('company', $args);
}
add_action('init', 'jobportal_register_company_post_type');

/**
 * Register Company Taxonomies
 */
function jobportal_register_company_taxonomies() {
    // Industry taxonomy
    $industry_labels = array(
        'name'              => _x('Industries', 'taxonomy general name', 'jobportal'),
        'singular_name'     => _x('Industry', 'taxonomy singular name', 'jobportal'),
        'search_items'      => __('Search Industries', 'jobportal'),
        'all_items'         => __('All Industries', 'jobportal'),
        'parent_item'       => __('Parent Industry', 'jobportal'),
        'parent_item_colon' => __('Parent Industry:', 'jobportal'),
        'edit_item'         => __('Edit Industry', 'jobportal'),
        'update_item'       => __('Update Industry', 'jobportal'),
        'add_new_item'      => __('Add New Industry', 'jobportal'),
        'new_item_name'     => __('New Industry Name', 'jobportal'),
        'menu_name'         => __('Industries', 'jobportal'),
    );

    register_taxonomy('company_industry', array('company'), array(
        'hierarchical'      => true,
        'labels'            => $industry_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'industry'),
        'show_in_rest'      => true,
    ));

    // Company Size taxonomy
    $size_labels = array(
        'name'              => _x('Company Sizes', 'taxonomy general name', 'jobportal'),
        'singular_name'     => _x('Company Size', 'taxonomy singular name', 'jobportal'),
        'search_items'      => __('Search Company Sizes', 'jobportal'),
        'all_items'         => __('All Company Sizes', 'jobportal'),
        'edit_item'         => __('Edit Company Size', 'jobportal'),
        'update_item'       => __('Update Company Size', 'jobportal'),
        'add_new_item'      => __('Add New Company Size', 'jobportal'),
        'new_item_name'     => __('New Company Size Name', 'jobportal'),
        'menu_name'         => __('Company Sizes', 'jobportal'),
    );

    register_taxonomy('company_size', array('company'), array(
        'hierarchical'      => true,
        'labels'            => $size_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'company-size'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'jobportal_register_company_taxonomies');

/**
 * Add Company Meta Boxes
 */
function jobportal_add_company_meta_boxes() {
    add_meta_box(
        'jobportal_company_details',
        __('Company Details', 'jobportal'),
        'jobportal_company_details_callback',
        'company',
        'normal',
        'high'
    );

    add_meta_box(
        'jobportal_company_social',
        __('Social Media & Links', 'jobportal'),
        'jobportal_company_social_callback',
        'company',
        'normal',
        'default'
    );

    add_meta_box(
        'jobportal_company_stats',
        __('Company Statistics', 'jobportal'),
        'jobportal_company_stats_callback',
        'company',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'jobportal_add_company_meta_boxes');

/**
 * Company Details Meta Box Callback
 */
function jobportal_company_details_callback($post) {
    wp_nonce_field('jobportal_company_meta', 'jobportal_company_nonce');

    $location = get_post_meta($post->ID, '_company_location', true);
    $headquarters = get_post_meta($post->ID, '_company_headquarters', true);
    $founded = get_post_meta($post->ID, '_company_founded', true);
    $website = get_post_meta($post->ID, '_company_website', true);
    $email = get_post_meta($post->ID, '_company_email', true);
    $phone = get_post_meta($post->ID, '_company_phone', true);
    $employees = get_post_meta($post->ID, '_company_employees', true);
    $revenue = get_post_meta($post->ID, '_company_revenue', true);
    ?>
    <style>
        .jobportal-meta-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .jobportal-meta-field {
            display: flex;
            flex-direction: column;
        }
        .jobportal-meta-field label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e293b;
        }
        .jobportal-meta-field input,
        .jobportal-meta-field select {
            padding: 10px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
        }
        .jobportal-meta-field input:focus,
        .jobportal-meta-field select:focus {
            border-color: #00B4D8;
            outline: none;
        }
    </style>

    <div class="jobportal-company-meta">
        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_location"><?php _e('Location', 'jobportal'); ?></label>
                <input type="text" id="company_location" name="company_location" value="<?php echo esc_attr($location); ?>" placeholder="e.g., San Francisco, CA">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_headquarters"><?php _e('Headquarters', 'jobportal'); ?></label>
                <input type="text" id="company_headquarters" name="company_headquarters" value="<?php echo esc_attr($headquarters); ?>" placeholder="e.g., New York, NY">
            </div>
        </div>

        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_founded"><?php _e('Founded Year', 'jobportal'); ?></label>
                <input type="number" id="company_founded" name="company_founded" value="<?php echo esc_attr($founded); ?>" placeholder="e.g., 2010" min="1800" max="<?php echo date('Y'); ?>">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_employees"><?php _e('Number of Employees', 'jobportal'); ?></label>
                <input type="text" id="company_employees" name="company_employees" value="<?php echo esc_attr($employees); ?>" placeholder="e.g., 50-200">
            </div>
        </div>

        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_website"><?php _e('Website URL', 'jobportal'); ?></label>
                <input type="url" id="company_website" name="company_website" value="<?php echo esc_attr($website); ?>" placeholder="https://example.com">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_email"><?php _e('Contact Email', 'jobportal'); ?></label>
                <input type="email" id="company_email" name="company_email" value="<?php echo esc_attr($email); ?>" placeholder="contact@example.com">
            </div>
        </div>

        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_phone"><?php _e('Phone Number', 'jobportal'); ?></label>
                <input type="tel" id="company_phone" name="company_phone" value="<?php echo esc_attr($phone); ?>" placeholder="+1 (555) 123-4567">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_revenue"><?php _e('Annual Revenue (Optional)', 'jobportal'); ?></label>
                <input type="text" id="company_revenue" name="company_revenue" value="<?php echo esc_attr($revenue); ?>" placeholder="e.g., $10M - $50M">
            </div>
        </div>
    </div>
    <?php
}

/**
 * Company Social Media Meta Box Callback
 */
function jobportal_company_social_callback($post) {
    $linkedin = get_post_meta($post->ID, '_company_linkedin', true);
    $twitter = get_post_meta($post->ID, '_company_twitter', true);
    $facebook = get_post_meta($post->ID, '_company_facebook', true);
    $instagram = get_post_meta($post->ID, '_company_instagram', true);
    $youtube = get_post_meta($post->ID, '_company_youtube', true);
    $github = get_post_meta($post->ID, '_company_github', true);
    ?>
    <div class="jobportal-company-meta">
        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_linkedin">🔗 <?php _e('LinkedIn URL', 'jobportal'); ?></label>
                <input type="url" id="company_linkedin" name="company_linkedin" value="<?php echo esc_attr($linkedin); ?>" placeholder="https://linkedin.com/company/...">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_twitter">🐦 <?php _e('Twitter URL', 'jobportal'); ?></label>
                <input type="url" id="company_twitter" name="company_twitter" value="<?php echo esc_attr($twitter); ?>" placeholder="https://twitter.com/...">
            </div>
        </div>

        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_facebook">📘 <?php _e('Facebook URL', 'jobportal'); ?></label>
                <input type="url" id="company_facebook" name="company_facebook" value="<?php echo esc_attr($facebook); ?>" placeholder="https://facebook.com/...">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_instagram">📷 <?php _e('Instagram URL', 'jobportal'); ?></label>
                <input type="url" id="company_instagram" name="company_instagram" value="<?php echo esc_attr($instagram); ?>" placeholder="https://instagram.com/...">
            </div>
        </div>

        <div class="jobportal-meta-row">
            <div class="jobportal-meta-field">
                <label for="company_youtube">📺 <?php _e('YouTube URL', 'jobportal'); ?></label>
                <input type="url" id="company_youtube" name="company_youtube" value="<?php echo esc_attr($youtube); ?>" placeholder="https://youtube.com/...">
            </div>
            <div class="jobportal-meta-field">
                <label for="company_github">💻 <?php _e('GitHub URL', 'jobportal'); ?></label>
                <input type="url" id="company_github" name="company_github" value="<?php echo esc_attr($github); ?>" placeholder="https://github.com/...">
            </div>
        </div>
    </div>
    <?php
}

/**
 * Company Stats Meta Box Callback
 */
function jobportal_company_stats_callback($post) {
    // Get job count for this company
    $job_count = get_posts(array(
        'post_type' => 'job',
        'meta_query' => array(
            array(
                'key' => '_company',
                'value' => $post->ID,
            ),
        ),
        'posts_per_page' => -1,
        'fields' => 'ids',
    ));

    $total_jobs = count($job_count);
    $views = get_post_meta($post->ID, '_company_views', true) ?: 0;
    ?>
    <div style="padding: 16px; background: #f8fafc; border-radius: 8px; margin-bottom: 16px;">
        <h4 style="margin: 0 0 12px; color: #1e293b; font-size: 16px;">📊 Company Statistics</h4>
        <div style="display: grid; gap: 12px;">
            <div style="display: flex; justify-content: space-between; padding: 12px; background: white; border-radius: 6px;">
                <span style="color: #64748b; font-weight: 600;">Total Jobs:</span>
                <strong style="color: #00B4D8;"><?php echo $total_jobs; ?></strong>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 12px; background: white; border-radius: 6px;">
                <span style="color: #64748b; font-weight: 600;">Profile Views:</span>
                <strong style="color: #10b981;"><?php echo number_format($views); ?></strong>
            </div>
        </div>
    </div>

    <div style="padding: 16px; background: #ecfdf5; border-left: 4px solid #10b981; border-radius: 8px;">
        <p style="margin: 0; font-size: 13px; color: #065f46;">
            <strong>💡 Tip:</strong> Add a company logo via the Featured Image to improve visibility and brand recognition.
        </p>
    </div>
    <?php
}

/**
 * Save Company Meta Data
 */
function jobportal_save_company_meta($post_id) {
    if (!isset($_POST['jobportal_company_nonce']) ||
        !wp_verify_nonce($_POST['jobportal_company_nonce'], 'jobportal_company_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Company details
    $fields = array(
        'company_location',
        'company_headquarters',
        'company_founded',
        'company_website',
        'company_email',
        'company_phone',
        'company_employees',
        'company_revenue',
        'company_linkedin',
        'company_twitter',
        'company_facebook',
        'company_instagram',
        'company_youtube',
        'company_github',
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_company', 'jobportal_save_company_meta');

/**
 * Track Company Profile Views
 */
function jobportal_track_company_views() {
    if (is_singular('company')) {
        $post_id = get_the_ID();
        $views = get_post_meta($post_id, '_company_views', true) ?: 0;
        $views++;
        update_post_meta($post_id, '_company_views', $views);
    }
}
add_action('wp_head', 'jobportal_track_company_views');

/**
 * Add Company Field to Job Post Type
 */
function jobportal_add_company_to_job() {
    add_meta_box(
        'jobportal_job_company',
        __('Company', 'jobportal'),
        'jobportal_job_company_callback',
        'job',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'jobportal_add_company_to_job');

/**
 * Job Company Meta Box Callback
 */
function jobportal_job_company_callback($post) {
    wp_nonce_field('jobportal_job_company_meta', 'jobportal_job_company_nonce');

    $company_id = get_post_meta($post->ID, '_company', true);

    $companies = get_posts(array(
        'post_type' => 'company',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
    ?>
    <div style="padding: 12px 0;">
        <label for="job_company" style="display: block; margin-bottom: 8px; font-weight: 600;">
            <?php _e('Select Company', 'jobportal'); ?>
        </label>
        <select id="job_company" name="job_company" style="width: 100%; padding: 8px; border: 2px solid #e2e8f0; border-radius: 6px;">
            <option value=""><?php _e('-- Select Company --', 'jobportal'); ?></option>
            <?php foreach ($companies as $company) : ?>
                <option value="<?php echo $company->ID; ?>" <?php selected($company_id, $company->ID); ?>>
                    <?php echo esc_html($company->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p style="margin-top: 8px; font-size: 12px; color: #64748b;">
            Link this job to a company profile. <a href="<?php echo admin_url('post-new.php?post_type=company'); ?>" target="_blank">Create new company</a>
        </p>
    </div>
    <?php
}

/**
 * Save Job Company Meta
 */
function jobportal_save_job_company_meta($post_id) {
    if (!isset($_POST['jobportal_job_company_nonce']) ||
        !wp_verify_nonce($_POST['jobportal_job_company_nonce'], 'jobportal_job_company_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['job_company'])) {
        update_post_meta($post_id, '_company', intval($_POST['job_company']));
    }
}
add_action('save_post_job', 'jobportal_save_job_company_meta');

/**
 * Get Company by Job ID
 */
function jobportal_get_job_company($job_id) {
    $company_id = get_post_meta($job_id, '_company', true);

    if (!$company_id) {
        return null;
    }

    return get_post($company_id);
}

/**
 * Display Company Card
 */
function jobportal_display_company_card($company_id, $show_jobs = true) {
    $company = get_post($company_id);

    if (!$company) {
        return;
    }

    $location = get_post_meta($company_id, '_company_location', true);
    $employees = get_post_meta($company_id, '_company_employees', true);
    $website = get_post_meta($company_id, '_company_website', true);
    $logo = get_the_post_thumbnail_url($company_id, 'medium');

    // Get company jobs
    $jobs_count = 0;
    if ($show_jobs) {
        $jobs = get_posts(array(
            'post_type' => 'job',
            'meta_query' => array(
                array(
                    'key' => '_company',
                    'value' => $company_id,
                ),
            ),
            'posts_per_page' => -1,
            'fields' => 'ids',
        ));
        $jobs_count = count($jobs);
    }
    ?>
    <div class="jobportal-company-card" style="
        background: white;
        padding: 32px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    ">
        <div style="display: flex; gap: 24px; align-items: start; margin-bottom: 24px;">
            <?php if ($logo) : ?>
                <img src="<?php echo esc_url($logo); ?>"
                     alt="<?php echo esc_attr($company->post_title); ?>"
                     style="width: 100px; height: 100px; object-fit: contain; border-radius: 12px; background: #f8fafc; padding: 12px;">
            <?php else : ?>
                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px; color: white; font-weight: 800;">
                    <?php echo substr($company->post_title, 0, 1); ?>
                </div>
            <?php endif; ?>

            <div style="flex: 1;">
                <h3 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <a href="<?php echo get_permalink($company_id); ?>" style="color: inherit; text-decoration: none;">
                        <?php echo esc_html($company->post_title); ?>
                    </a>
                </h3>
                <div style="display: flex; flex-wrap: wrap; gap: 16px; font-size: 14px; color: #64748b; margin-bottom: 16px;">
                    <?php if ($location) : ?>
                        <span>📍 <?php echo esc_html($location); ?></span>
                    <?php endif; ?>
                    <?php if ($employees) : ?>
                        <span>👥 <?php echo esc_html($employees); ?> employees</span>
                    <?php endif; ?>
                    <?php if ($show_jobs && $jobs_count > 0) : ?>
                        <span style="color: #00B4D8; font-weight: 600;">💼 <?php echo $jobs_count; ?> open positions</span>
                    <?php endif; ?>
                </div>
                <p style="color: #64748b; line-height: 1.6; margin-bottom: 16px;">
                    <?php echo wp_trim_words($company->post_excerpt ?: $company->post_content, 20); ?>
                </p>
                <div style="display: flex; gap: 12px;">
                    <a href="<?php echo get_permalink($company_id); ?>"
                       class="jobportal-btn jobportal-btn-primary"
                       style="text-decoration: none; padding: 10px 20px; font-size: 14px;">
                        View Company Profile
                    </a>
                    <?php if ($website) : ?>
                        <a href="<?php echo esc_url($website); ?>"
                           class="jobportal-btn"
                           style="background: #f8fafc; color: #1e293b; border: 2px solid #e2e8f0; text-decoration: none; padding: 10px 20px; font-size: 14px;"
                           target="_blank" rel="noopener">
                            🌐 Website
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Shortcode: Companies List
 */
function jobportal_companies_list_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => 12,
        'industry' => '',
        'orderby' => 'title',
        'order' => 'ASC',
    ), $atts);

    $args = array(
        'post_type' => 'company',
        'posts_per_page' => intval($atts['number']),
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
    );

    if (!empty($atts['industry'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'company_industry',
                'field' => 'slug',
                'terms' => $atts['industry'],
            ),
        );
    }

    $companies = new WP_Query($args);

    if (!$companies->have_posts()) {
        return '<p>' . __('No companies found.', 'jobportal') . '</p>';
    }

    ob_start();
    ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 32px; margin: 40px 0;">
        <?php while ($companies->have_posts()) : $companies->the_post(); ?>
            <?php jobportal_display_company_card(get_the_ID(), true); ?>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('companies_list', 'jobportal_companies_list_shortcode');
