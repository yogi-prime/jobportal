<?php
/**
 * Job Applications System
 * Handles job applications with resume upload and tracking
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Job Application Custom Post Type
 */
function jobportal_register_application_cpt() {
    $labels = array(
        'name'               => __('Applications', 'jobportal'),
        'singular_name'      => __('Application', 'jobportal'),
        'menu_name'          => __('Applications', 'jobportal'),
        'add_new'            => __('Add New', 'jobportal'),
        'add_new_item'       => __('Add New Application', 'jobportal'),
        'edit_item'          => __('Edit Application', 'jobportal'),
        'new_item'           => __('New Application', 'jobportal'),
        'view_item'          => __('View Application', 'jobportal'),
        'search_items'       => __('Search Applications', 'jobportal'),
        'not_found'          => __('No applications found', 'jobportal'),
        'not_found_in_trash' => __('No applications found in trash', 'jobportal'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-businessman',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'             => false,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_in_rest'        => false,
    );

    register_post_type('job_application', $args);
}
add_action('init', 'jobportal_register_application_cpt');

/**
 * Add Application Meta Boxes
 */
function jobportal_application_meta_boxes() {
    add_meta_box(
        'jobportal_application_details',
        __('Application Details', 'jobportal'),
        'jobportal_application_details_callback',
        'job_application',
        'normal',
        'high'
    );

    add_meta_box(
        'jobportal_application_status',
        __('Application Status', 'jobportal'),
        'jobportal_application_status_callback',
        'job_application',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'jobportal_application_meta_boxes');

/**
 * Application Details Meta Box Callback
 */
function jobportal_application_details_callback($post) {
    wp_nonce_field('jobportal_application_details', 'jobportal_application_nonce');

    $job_id = get_post_meta($post->ID, '_job_id', true);
    $applicant_name = get_post_meta($post->ID, '_applicant_name', true);
    $applicant_email = get_post_meta($post->ID, '_applicant_email', true);
    $applicant_phone = get_post_meta($post->ID, '_applicant_phone', true);
    $cover_letter = get_post_meta($post->ID, '_cover_letter', true);
    $resume_url = get_post_meta($post->ID, '_resume_url', true);
    $applicant_id = get_post_meta($post->ID, '_applicant_id', true);
    $portfolio_url = get_post_meta($post->ID, '_portfolio_url', true);
    $linkedin_url = get_post_meta($post->ID, '_linkedin_url', true);
    $experience_years = get_post_meta($post->ID, '_experience_years', true);

    ?>
    <style>
        .jobportal-meta-row {
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 15px;
            align-items: start;
        }
        .jobportal-meta-row label {
            font-weight: 600;
            padding-top: 8px;
        }
        .jobportal-meta-row input[type="text"],
        .jobportal-meta-row input[type="email"],
        .jobportal-meta-row input[type="url"],
        .jobportal-meta-row input[type="number"],
        .jobportal-meta-row textarea {
            width: 100%;
            padding: 8px 12px;
        }
        .jobportal-meta-row textarea {
            min-height: 120px;
        }
        .jobportal-resume-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #00B4D8;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 8px;
        }
        .jobportal-resume-link:hover {
            background: #4f46e5;
            color: white;
        }
        .jobportal-applicant-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #00C896;
            color: white;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            margin-left: 10px;
        }
    </style>

    <div class="jobportal-application-meta">
        <!-- Job Applied For -->
        <div class="jobportal-meta-row">
            <label><?php _e('Job Applied For:', 'jobportal'); ?></label>
            <div>
                <?php if ($job_id) :
                    $job = get_post($job_id);
                    if ($job) : ?>
                        <strong><?php echo esc_html($job->post_title); ?></strong>
                        <a href="<?php echo get_edit_post_link($job_id); ?>" target="_blank" style="margin-left: 10px;">
                            <?php _e('View Job', 'jobportal'); ?>
                        </a>
                    <?php endif;
                endif; ?>
            </div>
        </div>

        <!-- Applicant Name -->
        <div class="jobportal-meta-row">
            <label for="applicant_name"><?php _e('Applicant Name:', 'jobportal'); ?></label>
            <div>
                <input type="text" id="applicant_name" name="applicant_name"
                       value="<?php echo esc_attr($applicant_name); ?>" readonly />
                <?php if ($applicant_id) : ?>
                    <span class="jobportal-applicant-badge"><?php _e('Registered User', 'jobportal'); ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Email -->
        <div class="jobportal-meta-row">
            <label for="applicant_email"><?php _e('Email:', 'jobportal'); ?></label>
            <input type="email" id="applicant_email" name="applicant_email"
                   value="<?php echo esc_attr($applicant_email); ?>" readonly />
        </div>

        <!-- Phone -->
        <div class="jobportal-meta-row">
            <label for="applicant_phone"><?php _e('Phone:', 'jobportal'); ?></label>
            <input type="text" id="applicant_phone" name="applicant_phone"
                   value="<?php echo esc_attr($applicant_phone); ?>" readonly />
        </div>

        <!-- Experience -->
        <div class="jobportal-meta-row">
            <label for="experience_years"><?php _e('Experience (Years):', 'jobportal'); ?></label>
            <input type="number" id="experience_years" name="experience_years"
                   value="<?php echo esc_attr($experience_years); ?>" readonly />
        </div>

        <!-- Portfolio URL -->
        <?php if ($portfolio_url) : ?>
        <div class="jobportal-meta-row">
            <label for="portfolio_url"><?php _e('Portfolio:', 'jobportal'); ?></label>
            <div>
                <input type="url" id="portfolio_url" name="portfolio_url"
                       value="<?php echo esc_url($portfolio_url); ?>" readonly />
                <a href="<?php echo esc_url($portfolio_url); ?>" target="_blank" class="button button-small">
                    <?php _e('Visit Portfolio', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- LinkedIn URL -->
        <?php if ($linkedin_url) : ?>
        <div class="jobportal-meta-row">
            <label for="linkedin_url"><?php _e('LinkedIn:', 'jobportal'); ?></label>
            <div>
                <input type="url" id="linkedin_url" name="linkedin_url"
                       value="<?php echo esc_url($linkedin_url); ?>" readonly />
                <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" class="button button-small">
                    <?php _e('View Profile', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Cover Letter -->
        <div class="jobportal-meta-row">
            <label for="cover_letter"><?php _e('Cover Letter:', 'jobportal'); ?></label>
            <textarea id="cover_letter" name="cover_letter" readonly><?php echo esc_textarea($cover_letter); ?></textarea>
        </div>

        <!-- Resume Download -->
        <?php if ($resume_url) : ?>
        <div class="jobportal-meta-row">
            <label><?php _e('Resume:', 'jobportal'); ?></label>
            <div>
                <a href="<?php echo esc_url($resume_url); ?>" target="_blank" class="jobportal-resume-link">
                    <span class="dashicons dashicons-media-document"></span>
                    <?php _e('Download Resume', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Application Status Meta Box Callback
 */
function jobportal_application_status_callback($post) {
    wp_nonce_field('jobportal_application_status', 'jobportal_status_nonce');

    $status = get_post_meta($post->ID, '_application_status', true);
    if (!$status) {
        $status = 'pending';
    }

    $statuses = array(
        'pending'     => __('Pending Review', 'jobportal'),
        'reviewing'   => __('Under Review', 'jobportal'),
        'shortlisted' => __('Shortlisted', 'jobportal'),
        'interview'   => __('Interview Scheduled', 'jobportal'),
        'offered'     => __('Offer Extended', 'jobportal'),
        'rejected'    => __('Rejected', 'jobportal'),
        'withdrawn'   => __('Withdrawn', 'jobportal'),
    );

    ?>
    <style>
        .jobportal-status-select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        .jobportal-status-info {
            margin-top: 15px;
            padding: 12px;
            background: #f0f9ff;
            border-left: 4px solid #00B4D8;
            font-size: 12px;
            line-height: 1.6;
        }
    </style>

    <div class="jobportal-status-meta">
        <label for="application_status" style="display: block; margin-bottom: 8px; font-weight: 600;">
            <?php _e('Change Status:', 'jobportal'); ?>
        </label>
        <select id="application_status" name="application_status" class="jobportal-status-select">
            <?php foreach ($statuses as $key => $label) : ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($status, $key); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="jobportal-status-info">
            <strong><?php _e('Note:', 'jobportal'); ?></strong>
            <?php _e('Changing the status will notify the applicant via email.', 'jobportal'); ?>
        </div>
    </div>
    <?php
}

/**
 * Save Application Meta Data
 */
function jobportal_save_application_meta($post_id) {
    // Check nonce
    if (!isset($_POST['jobportal_status_nonce']) ||
        !wp_verify_nonce($_POST['jobportal_status_nonce'], 'jobportal_application_status')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save application status
    if (isset($_POST['application_status'])) {
        $old_status = get_post_meta($post_id, '_application_status', true);
        $new_status = sanitize_text_field($_POST['application_status']);

        update_post_meta($post_id, '_application_status', $new_status);

        // Send email notification if status changed
        if ($old_status !== $new_status) {
            jobportal_send_status_change_email($post_id, $new_status);
        }
    }
}
add_action('save_post_job_application', 'jobportal_save_application_meta');

/**
 * Handle Application Form Submission (AJAX)
 */
function jobportal_submit_application() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'jobportal_apply_nonce')) {
        wp_send_json_error(array('message' => __('Security check failed', 'jobportal')));
    }

    // Get and sanitize data
    $job_id = intval($_POST['job_id']);
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $experience = intval($_POST['experience']);
    $cover_letter = sanitize_textarea_field($_POST['cover_letter']);
    $portfolio_url = esc_url_raw($_POST['portfolio_url']);
    $linkedin_url = esc_url_raw($_POST['linkedin_url']);

    // Validate required fields
    if (!$job_id || !$name || !$email || !$phone) {
        wp_send_json_error(array('message' => __('Please fill all required fields', 'jobportal')));
    }

    // Check if already applied
    $existing = get_posts(array(
        'post_type' => 'job_application',
        'meta_query' => array(
            array('key' => '_job_id', 'value' => $job_id),
            array('key' => '_applicant_email', 'value' => $email),
        ),
    ));

    if (!empty($existing)) {
        wp_send_json_error(array('message' => __('You have already applied for this job', 'jobportal')));
    }

    // Handle resume upload
    $resume_url = '';
    if (!empty($_FILES['resume']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $file = $_FILES['resume'];
        $upload = wp_handle_upload($file, array('test_form' => false));

        if (isset($upload['error'])) {
            wp_send_json_error(array('message' => $upload['error']));
        }

        $resume_url = $upload['url'];
    }

    // Create application post
    $job = get_post($job_id);
    $application_data = array(
        'post_title'  => sprintf(__('Application for %s by %s', 'jobportal'), $job->post_title, $name),
        'post_type'   => 'job_application',
        'post_status' => 'publish',
    );

    $application_id = wp_insert_post($application_data);

    if (is_wp_error($application_id)) {
        wp_send_json_error(array('message' => __('Failed to submit application', 'jobportal')));
    }

    // Save meta data
    update_post_meta($application_id, '_job_id', $job_id);
    update_post_meta($application_id, '_applicant_name', $name);
    update_post_meta($application_id, '_applicant_email', $email);
    update_post_meta($application_id, '_applicant_phone', $phone);
    update_post_meta($application_id, '_experience_years', $experience);
    update_post_meta($application_id, '_cover_letter', $cover_letter);
    update_post_meta($application_id, '_resume_url', $resume_url);
    update_post_meta($application_id, '_portfolio_url', $portfolio_url);
    update_post_meta($application_id, '_linkedin_url', $linkedin_url);
    update_post_meta($application_id, '_application_status', 'pending');

    if (is_user_logged_in()) {
        update_post_meta($application_id, '_applicant_id', get_current_user_id());
    }

    // Send confirmation email to applicant
    jobportal_send_application_confirmation_email($application_id);

    // Send notification to employer
    jobportal_send_employer_notification_email($application_id);

    wp_send_json_success(array(
        'message' => __('Application submitted successfully! We will contact you soon.', 'jobportal'),
        'application_id' => $application_id,
    ));
}
add_action('wp_ajax_submit_job_application', 'jobportal_submit_application');
add_action('wp_ajax_nopriv_submit_job_application', 'jobportal_submit_application');

/**
 * Send Application Confirmation Email to Applicant
 */
function jobportal_send_application_confirmation_email($application_id) {
    $applicant_email = get_post_meta($application_id, '_applicant_email', true);
    $applicant_name = get_post_meta($application_id, '_applicant_name', true);
    $job_id = get_post_meta($application_id, '_job_id', true);
    $job = get_post($job_id);

    $subject = sprintf(__('Application Received - %s', 'jobportal'), $job->post_title);

    $message = sprintf(
        __("Dear %s,\n\nThank you for applying for the position of %s.\n\nWe have received your application and our team will review it shortly. We will contact you if your profile matches our requirements.\n\nBest regards,\n%s", 'jobportal'),
        $applicant_name,
        $job->post_title,
        get_bloginfo('name')
    );

    wp_mail($applicant_email, $subject, $message);
}

/**
 * Send New Application Notification to Employer
 */
function jobportal_send_employer_notification_email($application_id) {
    $admin_email = get_option('admin_email');
    $applicant_name = get_post_meta($application_id, '_applicant_name', true);
    $job_id = get_post_meta($application_id, '_job_id', true);
    $job = get_post($job_id);

    $subject = sprintf(__('New Application - %s', 'jobportal'), $job->post_title);

    $edit_link = admin_url('post.php?post=' . $application_id . '&action=edit');

    $message = sprintf(
        __("A new application has been submitted.\n\nJob: %s\nApplicant: %s\n\nView application: %s", 'jobportal'),
        $job->post_title,
        $applicant_name,
        $edit_link
    );

    wp_mail($admin_email, $subject, $message);
}

/**
 * Send Status Change Email to Applicant
 */
function jobportal_send_status_change_email($application_id, $new_status) {
    $applicant_email = get_post_meta($application_id, '_applicant_email', true);
    $applicant_name = get_post_meta($application_id, '_applicant_name', true);
    $job_id = get_post_meta($application_id, '_job_id', true);
    $job = get_post($job_id);

    $status_messages = array(
        'reviewing'   => __('Your application is currently under review.', 'jobportal'),
        'shortlisted' => __('Congratulations! You have been shortlisted for the next round.', 'jobportal'),
        'interview'   => __('Congratulations! You have been selected for an interview. We will contact you with details soon.', 'jobportal'),
        'offered'     => __('Congratulations! We are pleased to offer you this position. Please check your email for details.', 'jobportal'),
        'rejected'    => __('Thank you for your interest. Unfortunately, we have decided to move forward with other candidates.', 'jobportal'),
    );

    if (!isset($status_messages[$new_status])) {
        return;
    }

    $subject = sprintf(__('Application Update - %s', 'jobportal'), $job->post_title);

    $message = sprintf(
        __("Dear %s,\n\n%s\n\nPosition: %s\n\nBest regards,\n%s", 'jobportal'),
        $applicant_name,
        $status_messages[$new_status],
        $job->post_title,
        get_bloginfo('name')
    );

    wp_mail($applicant_email, $subject, $message);
}

/**
 * Add custom columns to Applications list
 */
function jobportal_application_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = __('Applicant', 'jobportal');
    $new_columns['job'] = __('Job', 'jobportal');
    $new_columns['email'] = __('Email', 'jobportal');
    $new_columns['status'] = __('Status', 'jobportal');
    $new_columns['date'] = __('Applied Date', 'jobportal');

    return $new_columns;
}
add_filter('manage_job_application_posts_columns', 'jobportal_application_columns');

/**
 * Display custom column data
 */
function jobportal_application_column_data($column, $post_id) {
    switch ($column) {
        case 'job':
            $job_id = get_post_meta($post_id, '_job_id', true);
            if ($job_id) {
                $job = get_post($job_id);
                if ($job) {
                    echo '<a href="' . get_edit_post_link($job_id) . '">' . esc_html($job->post_title) . '</a>';
                }
            }
            break;

        case 'email':
            $email = get_post_meta($post_id, '_applicant_email', true);
            echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            break;

        case 'status':
            $status = get_post_meta($post_id, '_application_status', true);
            $status_labels = array(
                'pending'     => '<span style="color: #f59e0b;">⏳ Pending</span>',
                'reviewing'   => '<span style="color: #3b82f6;">👀 Reviewing</span>',
                'shortlisted' => '<span style="color: #8b5cf6;">⭐ Shortlisted</span>',
                'interview'   => '<span style="color: #06b6d4;">📅 Interview</span>',
                'offered'     => '<span style="color: #10b981;">✅ Offered</span>',
                'rejected'    => '<span style="color: #ef4444;">❌ Rejected</span>',
                'withdrawn'   => '<span style="color: #6b7280;">↩ Withdrawn</span>',
            );
            echo isset($status_labels[$status]) ? $status_labels[$status] : $status;
            break;
    }
}
add_action('manage_job_application_posts_custom_column', 'jobportal_application_column_data', 10, 2);

/**
 * Make status column sortable
 */
function jobportal_application_sortable_columns($columns) {
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-job_application_sortable_columns', 'jobportal_application_sortable_columns');
