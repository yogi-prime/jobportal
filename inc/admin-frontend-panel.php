<?php
/**
 * Frontend Admin Panel
 * Complete theme management from frontend
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get Dashboard Statistics
 */
function jobportal_get_dashboard_stats() {
    // Jobs
    $total_jobs = wp_count_posts('job')->publish;
    $pending_jobs = wp_count_posts('job')->pending;

    // Applications
    $total_applications = wp_count_posts('job_application')->publish;

    // Users
    $users = count_users();
    $total_users = $users['total_users'];

    // Companies
    $total_companies = wp_count_posts('company')->publish;

    // Posts/Blogs
    $total_posts = wp_count_posts('post')->publish;

    // Comments
    $total_comments = wp_count_comments();
    $approved_comments = $total_comments->approved;
    $pending_comments = $total_comments->moderated;

    // Recent activity (last 7 days)
    global $wpdb;

    $jobs_this_week = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->posts}
        WHERE post_type = 'job'
        AND post_status = 'publish'
        AND post_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");

    $apps_this_week = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->posts}
        WHERE post_type = 'job_application'
        AND post_status = 'publish'
        AND post_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");

    $users_this_week = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->users}
        WHERE user_registered >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");

    return array(
        'jobs' => array(
            'total' => $total_jobs,
            'pending' => $pending_jobs,
            'this_week' => $jobs_this_week,
        ),
        'applications' => array(
            'total' => $total_applications,
            'this_week' => $apps_this_week,
        ),
        'users' => array(
            'total' => $total_users,
            'this_week' => $users_this_week,
        ),
        'companies' => array(
            'total' => $total_companies,
        ),
        'posts' => array(
            'total' => $total_posts,
        ),
        'comments' => array(
            'approved' => $approved_comments,
            'pending' => $pending_comments,
        ),
    );
}

/**
 * Get Recent Jobs
 */
function jobportal_get_recent_jobs($limit = 10) {
    return get_posts(array(
        'post_type' => 'job',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

/**
 * Get Recent Applications
 */
function jobportal_get_recent_applications($limit = 10) {
    return get_posts(array(
        'post_type' => 'job_application',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

/**
 * Get All Users with Details
 */
function jobportal_get_all_users_details() {
    $users = get_users(array(
        'orderby' => 'registered',
        'order' => 'DESC',
    ));

    $users_data = array();

    foreach ($users as $user) {
        $user_type = get_user_meta($user->ID, '_user_type', true) ?: 'candidate';
        $referral_points = get_user_meta($user->ID, '_referral_points', true) ?: 0;

        // Count applications for candidates
        $applications_count = 0;
        if ($user_type === 'candidate') {
            $applications = get_posts(array(
                'post_type' => 'job_application',
                'meta_key' => '_applicant_email',
                'meta_value' => $user->user_email,
                'fields' => 'ids',
                'posts_per_page' => -1,
            ));
            $applications_count = count($applications);
        }

        // Count jobs for employers
        $jobs_count = 0;
        if ($user_type === 'employer') {
            $jobs = get_posts(array(
                'post_type' => 'job',
                'author' => $user->ID,
                'fields' => 'ids',
                'posts_per_page' => -1,
            ));
            $jobs_count = count($jobs);
        }

        $users_data[] = array(
            'id' => $user->ID,
            'name' => $user->display_name,
            'email' => $user->user_email,
            'role' => implode(', ', $user->roles),
            'user_type' => $user_type,
            'registered' => $user->user_registered,
            'applications_count' => $applications_count,
            'jobs_count' => $jobs_count,
            'referral_points' => $referral_points,
        );
    }

    return $users_data;
}

/**
 * Get Site Traffic Stats (Basic)
 */
function jobportal_get_traffic_stats() {
    global $wpdb;

    // Get most viewed jobs
    $most_viewed_jobs = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm.meta_value as views
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_job_views'
        WHERE p.post_type = 'job' AND p.post_status = 'publish'
        ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
        LIMIT 10
    ");

    // Get most viewed companies
    $most_viewed_companies = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm.meta_value as views
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_company_views'
        WHERE p.post_type = 'company' AND p.post_status = 'publish'
        ORDER BY CAST(pm.meta_value AS UNSIGNED) DESC
        LIMIT 10
    ");

    return array(
        'jobs' => $most_viewed_jobs,
        'companies' => $most_viewed_companies,
    );
}

/**
 * Get Recent Posts/Blogs
 */
function jobportal_get_recent_posts($limit = 10) {
    return get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

/**
 * AJAX: Delete User
 */
function jobportal_ajax_delete_user() {
    check_ajax_referer('jobportal_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $user_id = intval($_POST['user_id']);

    if (!$user_id) {
        wp_send_json_error(array('message' => 'Invalid user ID'));
    }

    require_once(ABSPATH . 'wp-admin/includes/user.php');

    if (wp_delete_user($user_id)) {
        wp_send_json_success(array('message' => 'User deleted successfully'));
    } else {
        wp_send_json_error(array('message' => 'Failed to delete user'));
    }
}
add_action('wp_ajax_jobportal_delete_user', 'jobportal_ajax_delete_user');

/**
 * AJAX: Change User Role
 */
function jobportal_ajax_change_user_role() {
    check_ajax_referer('jobportal_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $user_id = intval($_POST['user_id']);
    $new_role = sanitize_text_field($_POST['role']);

    $user = new WP_User($user_id);
    $user->set_role($new_role);

    wp_send_json_success(array('message' => 'Role updated successfully'));
}
add_action('wp_ajax_jobportal_change_user_role', 'jobportal_ajax_change_user_role');

/**
 * AJAX: Approve/Reject Job
 */
function jobportal_ajax_update_job_status() {
    check_ajax_referer('jobportal_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $job_id = intval($_POST['job_id']);
    $status = sanitize_text_field($_POST['status']);

    $allowed_statuses = array('publish', 'pending', 'draft', 'trash');

    if (!in_array($status, $allowed_statuses)) {
        wp_send_json_error(array('message' => 'Invalid status'));
    }

    wp_update_post(array(
        'ID' => $job_id,
        'post_status' => $status,
    ));

    wp_send_json_success(array('message' => 'Job status updated'));
}
add_action('wp_ajax_jobportal_update_job_status', 'jobportal_ajax_update_job_status');

/**
 * AJAX: Delete Job
 */
function jobportal_ajax_delete_job() {
    check_ajax_referer('jobportal_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $job_id = intval($_POST['job_id']);

    if (wp_delete_post($job_id, true)) {
        wp_send_json_success(array('message' => 'Job deleted successfully'));
    } else {
        wp_send_json_error(array('message' => 'Failed to delete job'));
    }
}
add_action('wp_ajax_jobportal_delete_job', 'jobportal_ajax_delete_job');

/**
 * AJAX: Update Theme Settings
 */
function jobportal_ajax_update_theme_settings() {
    check_ajax_referer('jobportal_admin_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $settings = array(
        'site_name' => sanitize_text_field($_POST['site_name']),
        'site_description' => sanitize_text_field($_POST['site_description']),
        'contact_email' => sanitize_email($_POST['contact_email']),
        'social_facebook' => esc_url_raw($_POST['social_facebook']),
        'social_twitter' => esc_url_raw($_POST['social_twitter']),
        'social_linkedin' => esc_url_raw($_POST['social_linkedin']),
        'jobs_per_page' => intval($_POST['jobs_per_page']),
    );

    foreach ($settings as $key => $value) {
        update_option('jobportal_' . $key, $value);
    }

    wp_send_json_success(array('message' => 'Settings saved successfully'));
}
add_action('wp_ajax_jobportal_update_theme_settings', 'jobportal_ajax_update_theme_settings');

/**
 * Get Theme Settings
 */
function jobportal_get_theme_settings() {
    return array(
        'site_name' => get_option('jobportal_site_name', get_bloginfo('name')),
        'site_description' => get_option('jobportal_site_description', get_bloginfo('description')),
        'contact_email' => get_option('jobportal_contact_email', get_option('admin_email')),
        'social_facebook' => get_option('jobportal_social_facebook', ''),
        'social_twitter' => get_option('jobportal_social_twitter', ''),
        'social_linkedin' => get_option('jobportal_social_linkedin', ''),
        'jobs_per_page' => get_option('jobportal_jobs_per_page', 12),
    );
}
