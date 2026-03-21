<?php
/**
 * Resume Builder & Management System
 * Create, manage, and attach up to 5 resumes to user profile
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create Resume custom post type
 */
function jobportal_register_resume_post_type() {
    $labels = array(
        'name'               => 'Resumes',
        'singular_name'      => 'Resume',
        'menu_name'          => 'Resumes',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Resume',
        'edit_item'          => 'Edit Resume',
        'new_item'           => 'New Resume',
        'view_item'          => 'View Resume',
        'search_items'       => 'Search Resumes',
        'not_found'          => 'No resumes found',
        'not_found_in_trash' => 'No resumes found in trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'resume'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-media-document',
        'supports'            => array('title', 'author'),
    );

    register_post_type('resume', $args);
}
add_action('init', 'jobportal_register_resume_post_type');

/**
 * Get user resumes
 */
function jobportal_get_user_resumes($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }

    return get_posts(array(
        'post_type' => 'resume',
        'author' => $user_id,
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
}

/**
 * Get resume data
 */
function jobportal_get_resume_data($resume_id) {
    return array(
        'personal_info' => get_post_meta($resume_id, '_resume_personal_info', true),
        'summary' => get_post_meta($resume_id, '_resume_summary', true),
        'experience' => get_post_meta($resume_id, '_resume_experience', true),
        'education' => get_post_meta($resume_id, '_resume_education', true),
        'skills' => get_post_meta($resume_id, '_resume_skills', true),
        'certifications' => get_post_meta($resume_id, '_resume_certifications', true),
        'languages' => get_post_meta($resume_id, '_resume_languages', true),
    );
}

/**
 * AJAX: Save Resume
 */
function jobportal_ajax_save_resume() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to save resume'));
    }

    $user_id = get_current_user_id();
    $resume_id = isset($_POST['resume_id']) ? intval($_POST['resume_id']) : 0;
    $resume_title = isset($_POST['resume_title']) ? sanitize_text_field($_POST['resume_title']) : 'My Resume';

    // Check resume limit (max 5)
    if (!$resume_id) {
        $existing_resumes = jobportal_get_user_resumes($user_id);
        if (count($existing_resumes) >= 5) {
            wp_send_json_error(array('message' => 'Maximum 5 resumes allowed. Please delete one to create a new resume.'));
        }
    }

    // Create or update resume
    $post_data = array(
        'post_title' => $resume_title,
        'post_type' => 'resume',
        'post_status' => 'publish',
        'post_author' => $user_id,
    );

    if ($resume_id) {
        $post_data['ID'] = $resume_id;
        $resume_id = wp_update_post($post_data);
    } else {
        $resume_id = wp_insert_post($post_data);
    }

    if (is_wp_error($resume_id)) {
        wp_send_json_error(array('message' => 'Failed to save resume'));
    }

    // Save resume data
    if (isset($_POST['personal_info'])) {
        update_post_meta($resume_id, '_resume_personal_info', $_POST['personal_info']);
    }

    if (isset($_POST['summary'])) {
        update_post_meta($resume_id, '_resume_summary', sanitize_textarea_field($_POST['summary']));
    }

    if (isset($_POST['experience'])) {
        update_post_meta($resume_id, '_resume_experience', $_POST['experience']);
    }

    if (isset($_POST['education'])) {
        update_post_meta($resume_id, '_resume_education', $_POST['education']);
    }

    if (isset($_POST['skills'])) {
        update_post_meta($resume_id, '_resume_skills', $_POST['skills']);
    }

    if (isset($_POST['certifications'])) {
        update_post_meta($resume_id, '_resume_certifications', $_POST['certifications']);
    }

    if (isset($_POST['languages'])) {
        update_post_meta($resume_id, '_resume_languages', $_POST['languages']);
    }

    wp_send_json_success(array(
        'message' => 'Resume saved successfully',
        'resume_id' => $resume_id,
    ));
}
add_action('wp_ajax_jobportal_save_resume', 'jobportal_ajax_save_resume');

/**
 * AJAX: Delete Resume
 */
function jobportal_ajax_delete_resume() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $resume_id = intval($_POST['resume_id']);
    $resume = get_post($resume_id);

    // Check if user owns this resume
    if (!$resume || $resume->post_author != get_current_user_id()) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    if (wp_delete_post($resume_id, true)) {
        wp_send_json_success(array('message' => 'Resume deleted successfully'));
    } else {
        wp_send_json_error(array('message' => 'Failed to delete resume'));
    }
}
add_action('wp_ajax_jobportal_delete_resume', 'jobportal_ajax_delete_resume');

/**
 * AJAX: Attach Resume to Profile
 */
function jobportal_ajax_attach_resume_to_profile() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $user_id = get_current_user_id();
    $resume_id = intval($_POST['resume_id']);

    // Get current attached resumes
    $attached_resumes = get_user_meta($user_id, '_attached_resumes', true);
    if (!is_array($attached_resumes)) {
        $attached_resumes = array();
    }

    // Check if already attached
    if (in_array($resume_id, $attached_resumes)) {
        wp_send_json_error(array('message' => 'Resume already attached to profile'));
    }

    // Check limit (max 5)
    if (count($attached_resumes) >= 5) {
        wp_send_json_error(array('message' => 'Maximum 5 resumes can be attached to profile'));
    }

    $attached_resumes[] = $resume_id;
    update_user_meta($user_id, '_attached_resumes', $attached_resumes);

    wp_send_json_success(array('message' => 'Resume attached to profile'));
}
add_action('wp_ajax_jobportal_attach_resume_to_profile', 'jobportal_ajax_attach_resume_to_profile');

/**
 * AJAX: Detach Resume from Profile
 */
function jobportal_ajax_detach_resume_from_profile() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Unauthorized'));
    }

    $user_id = get_current_user_id();
    $resume_id = intval($_POST['resume_id']);

    $attached_resumes = get_user_meta($user_id, '_attached_resumes', true);
    if (!is_array($attached_resumes)) {
        $attached_resumes = array();
    }

    $attached_resumes = array_diff($attached_resumes, array($resume_id));
    update_user_meta($user_id, '_attached_resumes', array_values($attached_resumes));

    wp_send_json_success(array('message' => 'Resume detached from profile'));
}
add_action('wp_ajax_jobportal_detach_resume_from_profile', 'jobportal_ajax_detach_resume_from_profile');

/**
 * Get Resume Analytics for Admin
 */
function jobportal_get_resume_analytics() {
    global $wpdb;

    // Total resumes
    $total_resumes = wp_count_posts('resume')->publish;

    // Resumes created today
    $today_resumes = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->posts}
        WHERE post_type = 'resume'
        AND post_status = 'publish'
        AND DATE(post_date) = CURDATE()
    ");

    // Resumes created yesterday
    $yesterday_resumes = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->posts}
        WHERE post_type = 'resume'
        AND post_status = 'publish'
        AND DATE(post_date) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
    ");

    // Resumes created this week
    $week_resumes = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->posts}
        WHERE post_type = 'resume'
        AND post_status = 'publish'
        AND post_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");

    // Resumes created this month
    $month_resumes = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->posts}
        WHERE post_type = 'resume'
        AND post_status = 'publish'
        AND MONTH(post_date) = MONTH(CURDATE())
        AND YEAR(post_date) = YEAR(CURDATE())
    ");

    // Most active users (users with most resumes)
    $top_resume_creators = $wpdb->get_results("
        SELECT p.post_author, u.display_name, COUNT(*) as resume_count
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->users} u ON p.post_author = u.ID
        WHERE p.post_type = 'resume'
        AND p.post_status = 'publish'
        GROUP BY p.post_author
        ORDER BY resume_count DESC
        LIMIT 10
    ");

    return array(
        'total' => $total_resumes,
        'today' => $today_resumes,
        'yesterday' => $yesterday_resumes,
        'this_week' => $week_resumes,
        'this_month' => $month_resumes,
        'top_creators' => $top_resume_creators,
    );
}

/**
 * Add Resume Analytics to Admin Dashboard Stats
 */
function jobportal_add_resume_analytics_to_dashboard($stats) {
    $resume_analytics = jobportal_get_resume_analytics();

    $stats['resumes'] = array(
        'total' => $resume_analytics['total'],
        'today' => $resume_analytics['today'],
        'yesterday' => $resume_analytics['yesterday'],
        'this_week' => $resume_analytics['this_week'],
        'this_month' => $resume_analytics['this_month'],
    );

    return $stats;
}
add_filter('jobportal_dashboard_stats', 'jobportal_add_resume_analytics_to_dashboard');

/**
 * Display Resume Analytics Widget for Admin
 */
function jobportal_resume_analytics_widget() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $analytics = jobportal_get_resume_analytics();
    ?>
    <div class="jobportal-resume-analytics-widget">
        <h3>📄 Resume Analytics</h3>
        <div class="analytics-grid">
            <div class="analytics-card">
                <div class="analytics-value"><?php echo esc_html($analytics['today']); ?></div>
                <div class="analytics-label">Created Today</div>
            </div>
            <div class="analytics-card">
                <div class="analytics-value"><?php echo esc_html($analytics['yesterday']); ?></div>
                <div class="analytics-label">Created Yesterday</div>
            </div>
            <div class="analytics-card">
                <div class="analytics-value"><?php echo esc_html($analytics['this_week']); ?></div>
                <div class="analytics-label">This Week</div>
            </div>
            <div class="analytics-card">
                <div class="analytics-value"><?php echo esc_html($analytics['total']); ?></div>
                <div class="analytics-label">Total Resumes</div>
            </div>
        </div>

        <?php if (!empty($analytics['top_creators'])): ?>
        <div class="top-creators">
            <h4>Top Resume Creators</h4>
            <table class="analytics-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Resumes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($analytics['top_creators'] as $creator): ?>
                    <tr>
                        <td><?php echo esc_html($creator->display_name); ?></td>
                        <td><span class="badge"><?php echo esc_html($creator->resume_count); ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <style>
        .jobportal-resume-analytics-widget {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin: 24px 0;
        }

        .jobportal-resume-analytics-widget h3 {
            margin: 0 0 20px;
            font-size: 20px;
            color: #1e293b;
        }

        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .analytics-card {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border: 2px solid #667eea;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .analytics-value {
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 8px;
        }

        .analytics-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        .top-creators {
            margin-top: 24px;
        }

        .top-creators h4 {
            font-size: 16px;
            margin: 0 0 12px;
            color: #1e293b;
        }

        .analytics-table {
            width: 100%;
            border-collapse: collapse;
        }

        .analytics-table th {
            text-align: left;
            padding: 12px;
            background: #f8fafc;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }

        .analytics-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #1e293b;
        }

        .analytics-table .badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
    <?php
}

/**
 * Shortcode: Resume Builder
 */
function jobportal_resume_builder_shortcode($atts) {
    if (!is_user_logged_in()) {
        ob_start();
        jobportal_job_application_login_gate();
        return ob_get_clean();
    }

    $user_id = get_current_user_id();
    $resumes = jobportal_get_user_resumes($user_id);
    $attached_resumes = get_user_meta($user_id, '_attached_resumes', true);
    if (!is_array($attached_resumes)) {
        $attached_resumes = array();
    }

    ob_start();
    ?>
    <div class="jobportal-resume-builder">
        <div class="resume-builder-header">
            <h2>My Resumes</h2>
            <button class="btn btn-primary" id="createNewResume">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create New Resume
            </button>
        </div>

        <div class="resume-limit-info">
            <p>You have <strong><?php echo count($resumes); ?>/5</strong> resumes. You can attach up to 5 resumes to your profile.</p>
        </div>

        <div class="resumes-grid">
            <?php if (empty($resumes)): ?>
                <div class="no-resumes">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                    <h3>No Resumes Yet</h3>
                    <p>Create your first professional resume to start applying for jobs!</p>
                </div>
            <?php else: ?>
                <?php foreach ($resumes as $resume): ?>
                    <?php
                    $is_attached = in_array($resume->ID, $attached_resumes);
                    ?>
                    <div class="resume-card" data-resume-id="<?php echo esc_attr($resume->ID); ?>">
                        <?php if ($is_attached): ?>
                            <span class="attached-badge">Attached to Profile</span>
                        <?php endif; ?>

                        <div class="resume-card-icon">📄</div>
                        <h3><?php echo esc_html($resume->post_title); ?></h3>
                        <p class="resume-date">Created: <?php echo get_the_date('', $resume); ?></p>

                        <div class="resume-card-actions">
                            <a href="<?php echo esc_url(home_url('/resume-builder?edit=' . $resume->ID)); ?>" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <button class="btn btn-sm btn-success download-resume" data-resume-id="<?php echo esc_attr($resume->ID); ?>">
                                Download
                            </button>
                            <?php if ($is_attached): ?>
                                <button class="btn btn-sm btn-warning detach-resume" data-resume-id="<?php echo esc_attr($resume->ID); ?>">
                                    Detach
                                </button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-outline attach-resume" data-resume-id="<?php echo esc_attr($resume->ID); ?>">
                                    Attach
                                </button>
                            <?php endif; ?>
                            <button class="btn btn-sm btn-danger delete-resume" data-resume-id="<?php echo esc_attr($resume->ID); ?>">
                                Delete
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .jobportal-resume-builder {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .resume-builder-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .resume-builder-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .resume-limit-info {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border-left: 4px solid #667eea;
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 32px;
        }

        .resume-limit-info p {
            margin: 0;
            font-size: 14px;
            color: #475569;
        }

        .resumes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .resume-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            position: relative;
            transition: all 0.3s ease;
        }

        .resume-card:hover {
            border-color: #667eea;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.2);
            transform: translateY(-4px);
        }

        .attached-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .resume-card-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .resume-card h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 8px;
        }

        .resume-date {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 20px;
        }

        .resume-card-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn {
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 12px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: #22c55e;
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-outline {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
        }

        .no-resumes {
            grid-column: 1 / -1;
            text-align: center;
            padding: 64px 32px;
            color: #64748b;
        }

        .no-resumes svg {
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .no-resumes h3 {
            font-size: 20px;
            color: #475569;
            margin: 0 0 8px;
        }

        .no-resumes p {
            font-size: 14px;
            margin: 0;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            // Create new resume
            $('#createNewResume').on('click', function() {
                window.location.href = '<?php echo esc_url(home_url('/resume-builder?new=1')); ?>';
            });

            // Attach resume
            $('.attach-resume').on('click', function() {
                const resumeId = $(this).data('resume-id');
                const btn = $(this);

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_attach_resume_to_profile',
                        nonce: jobportalData.nonce,
                        resume_id: resumeId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Resume attached to profile successfully!');
                            location.reload();
                        } else {
                            alert(response.data.message);
                        }
                    }
                });
            });

            // Detach resume
            $('.detach-resume').on('click', function() {
                const resumeId = $(this).data('resume-id');

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_detach_resume_from_profile',
                        nonce: jobportalData.nonce,
                        resume_id: resumeId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Resume detached from profile');
                            location.reload();
                        }
                    }
                });
            });

            // Delete resume
            $('.delete-resume').on('click', function() {
                if (!confirm('Are you sure you want to delete this resume?')) {
                    return;
                }

                const resumeId = $(this).data('resume-id');

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_delete_resume',
                        nonce: jobportalData.nonce,
                        resume_id: resumeId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Resume deleted successfully');
                            location.reload();
                        } else {
                            alert(response.data.message);
                        }
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_my_resumes', 'jobportal_resume_builder_shortcode');
