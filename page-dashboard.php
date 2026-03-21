<?php
/**
 * Template Name: Candidate Dashboard
 * User dashboard for job seekers
 *
 * @package JobPortal
 */

// Check if user is logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Get user's applications
$applications = get_posts(array(
    'post_type' => 'job_application',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => '_applicant_email',
            'value' => $current_user->user_email,
        ),
    ),
    'orderby' => 'date',
    'order' => 'DESC',
));

// Get saved jobs (from user meta)
$saved_jobs = get_user_meta($user_id, 'saved_jobs', true) ?: array();

get_header();
?>

<style>
.jobportal-dashboard {
    min-height: calc(100vh - 80px);
    padding: 140px 20px 60px;
    background: #f8fafc;
}

.jobportal-dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
}

.jobportal-dashboard-header {
    margin-bottom: 40px;
    display: flex;
    justify-content: space-between;
    align-items: start;
    flex-wrap: wrap;
    gap: 20px;
}

.jobportal-dashboard-welcome h1 {
    font-size: 36px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 8px;
}

.jobportal-dashboard-welcome p {
    color: #64748b;
    font-size: 16px;
}

.jobportal-dashboard-actions {
    display: flex;
    gap: 12px;
}

.jobportal-btn {
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.jobportal-btn-primary {
    background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
    color: white;
    border: none;
    box-shadow: 0 4px 16px rgba(79, 172, 254, 0.3);
}

.jobportal-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(79, 172, 254, 0.4);
}

.jobportal-btn-secondary {
    background: white;
    color: #1e293b;
    border: 2px solid #e2e8f0;
}

.jobportal-btn-secondary:hover {
    border-color: #00B4D8;
    color: #00B4D8;
}

/* Stats Cards */
.jobportal-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.jobportal-stat-card {
    background: white;
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.jobportal-stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    font-size: 24px;
}

.jobportal-stat-value {
    font-size: 32px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 4px;
}

.jobportal-stat-label {
    color: #64748b;
    font-size: 14px;
    font-weight: 600;
}

/* Tab Navigation */
.jobportal-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 32px;
    border-bottom: 2px solid #e2e8f0;
}

.jobportal-tab {
    padding: 14px 24px;
    background: none;
    border: none;
    color: #64748b;
    font-weight: 600;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s;
    font-size: 15px;
}

.jobportal-tab.active {
    color: #00B4D8;
    border-bottom-color: #00B4D8;
}

.jobportal-tab-content {
    display: none;
}

.jobportal-tab-content.active {
    display: block;
}

/* Applications Table */
.jobportal-applications-table {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.jobportal-table {
    width: 100%;
    border-collapse: collapse;
}

.jobportal-table thead {
    background: #f8fafc;
}

.jobportal-table th {
    padding: 16px 20px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.jobportal-table td {
    padding: 20px;
    border-top: 1px solid #f1f5f9;
}

.jobportal-job-title {
    font-weight: 700;
    color: #1e293b;
    font-size: 15px;
    margin-bottom: 4px;
}

.jobportal-company-name {
    color: #64748b;
    font-size: 14px;
}

.jobportal-status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.jobportal-status-pending {
    background: #fef3c7;
    color: #92400e;
}

.jobportal-status-reviewing {
    background: #dbeafe;
    color: #1e40af;
}

.jobportal-status-shortlisted {
    background: #e9d5ff;
    color: #6b21a8;
}

.jobportal-status-interview {
    background: #cffafe;
    color: #155e75;
}

.jobportal-status-offered {
    background: #d1fae5;
    color: #065f46;
}

.jobportal-status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.jobportal-empty-state {
    text-align: center;
    padding: 80px 20px;
}

.jobportal-empty-state svg {
    width: 120px;
    height: 120px;
    margin-bottom: 24px;
    color: #cbd5e1;
}

.jobportal-empty-state h3 {
    font-size: 24px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 12px;
}

.jobportal-empty-state p {
    color: #64748b;
    font-size: 16px;
    margin-bottom: 24px;
}

/* Saved Jobs Grid */
.jobportal-jobs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

.jobportal-job-card {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s;
}

.jobportal-job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .jobportal-dashboard-header {
        flex-direction: column;
    }

    .jobportal-stats-grid {
        grid-template-columns: 1fr;
    }

    .jobportal-tabs {
        overflow-x: auto;
    }

    .jobportal-table {
        display: block;
        overflow-x: auto;
    }
}
</style>

<div class="jobportal-dashboard">
    <div class="jobportal-dashboard-container">

        <!-- Dashboard Header -->
        <div class="jobportal-dashboard-header">
            <div class="jobportal-dashboard-welcome">
                <h1><?php printf(__('Welcome back, %s!', 'jobportal'), esc_html($current_user->display_name)); ?></h1>
                <p><?php _e('Here\'s your job search activity', 'jobportal'); ?></p>
            </div>
            <div class="jobportal-dashboard-actions">
                <a href="<?php echo home_url('/jobs'); ?>" class="jobportal-btn jobportal-btn-secondary">
                    <?php _e('Browse Jobs', 'jobportal'); ?>
                </a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="jobportal-btn jobportal-btn-secondary">
                    <?php _e('Logout', 'jobportal'); ?>
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="jobportal-stats-grid">
            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(79, 172, 254, 0.1); color: #00B4D8;">
                    📄
                </div>
                <div class="jobportal-stat-value"><?php echo count($applications); ?></div>
                <div class="jobportal-stat-label"><?php _e('Total Applications', 'jobportal'); ?></div>
            </div>

            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                    ⭐
                </div>
                <div class="jobportal-stat-value">
                    <?php
                    $shortlisted = array_filter($applications, function($app) {
                        return get_post_meta($app->ID, '_application_status', true) === 'shortlisted';
                    });
                    echo count($shortlisted);
                    ?>
                </div>
                <div class="jobportal-stat-label"><?php _e('Shortlisted', 'jobportal'); ?></div>
            </div>

            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    📅
                </div>
                <div class="jobportal-stat-value">
                    <?php
                    $interviews = array_filter($applications, function($app) {
                        return get_post_meta($app->ID, '_application_status', true) === 'interview';
                    });
                    echo count($interviews);
                    ?>
                </div>
                <div class="jobportal-stat-label"><?php _e('Interviews', 'jobportal'); ?></div>
            </div>

            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    💾
                </div>
                <div class="jobportal-stat-value"><?php echo count($saved_jobs); ?></div>
                <div class="jobportal-stat-label"><?php _e('Saved Jobs', 'jobportal'); ?></div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="jobportal-tabs">
            <button class="jobportal-tab active" data-tab="applications">
                <?php _e('My Applications', 'jobportal'); ?>
            </button>
            <button class="jobportal-tab" data-tab="saved">
                <?php _e('Saved Jobs', 'jobportal'); ?>
            </button>
            <button class="jobportal-tab" data-tab="profile">
                <?php _e('Profile Settings', 'jobportal'); ?>
            </button>
        </div>

        <!-- Tab Content: Applications -->
        <div class="jobportal-tab-content active" id="applications">
            <?php if (!empty($applications)) : ?>
                <div class="jobportal-applications-table">
                    <table class="jobportal-table">
                        <thead>
                            <tr>
                                <th><?php _e('Job Title', 'jobportal'); ?></th>
                                <th><?php _e('Applied Date', 'jobportal'); ?></th>
                                <th><?php _e('Status', 'jobportal'); ?></th>
                                <th><?php _e('Action', 'jobportal'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applications as $app) :
                                $job_id = get_post_meta($app->ID, '_job_id', true);
                                $job = get_post($job_id);
                                $company = get_post_meta($job_id, '_company', true);
                                $status = get_post_meta($app->ID, '_application_status', true) ?: 'pending';
                            ?>
                                <tr>
                                    <td>
                                        <div class="jobportal-job-title"><?php echo esc_html($job->post_title); ?></div>
                                        <div class="jobportal-company-name"><?php echo esc_html($company); ?></div>
                                    </td>
                                    <td style="color: #64748b;">
                                        <?php echo human_time_diff(get_the_time('U', $app), current_time('timestamp')) . ' ago'; ?>
                                    </td>
                                    <td>
                                        <span class="jobportal-status-badge jobportal-status-<?php echo esc_attr($status); ?>">
                                            <?php
                                            $status_labels = array(
                                                'pending' => __('Pending', 'jobportal'),
                                                'reviewing' => __('Under Review', 'jobportal'),
                                                'shortlisted' => __('Shortlisted', 'jobportal'),
                                                'interview' => __('Interview', 'jobportal'),
                                                'offered' => __('Offered', 'jobportal'),
                                                'rejected' => __('Rejected', 'jobportal'),
                                            );
                                            echo $status_labels[$status] ?? ucfirst($status);
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo get_permalink($job_id); ?>" class="jobportal-btn-secondary" style="padding: 8px 16px; font-size: 14px;">
                                            <?php _e('View Job', 'jobportal'); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="jobportal-applications-table">
                    <div class="jobportal-empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3><?php _e('No Applications Yet', 'jobportal'); ?></h3>
                        <p><?php _e('You haven\'t applied to any jobs yet. Start browsing and apply to your dream jobs!', 'jobportal'); ?></p>
                        <a href="<?php echo home_url('/jobs'); ?>" class="jobportal-btn jobportal-btn-primary">
                            <?php _e('Browse Jobs', 'jobportal'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tab Content: Saved Jobs -->
        <div class="jobportal-tab-content" id="saved">
            <?php if (!empty($saved_jobs)) :
                $saved_job_posts = get_posts(array(
                    'post_type' => 'job',
                    'post__in' => $saved_jobs,
                    'posts_per_page' => -1,
                ));
            ?>
                <div class="jobportal-jobs-grid">
                    <?php foreach ($saved_job_posts as $job) :
                        $company = get_post_meta($job->ID, '_company', true);
                        $location = get_post_meta($job->ID, '_location', true);
                        $salary = get_post_meta($job->ID, '_salary', true);
                    ?>
                        <div class="jobportal-job-card">
                            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">
                                <a href="<?php echo get_permalink($job->ID); ?>" style="color: #1e293b; text-decoration: none;">
                                    <?php echo esc_html($job->post_title); ?>
                                </a>
                            </h3>
                            <p style="color: #64748b; margin-bottom: 12px;"><?php echo esc_html($company); ?></p>
                            <div style="display: flex; gap: 16px; font-size: 14px; color: #64748b; margin-bottom: 16px;">
                                <span>📍 <?php echo esc_html($location); ?></span>
                                <span>💰 <?php echo esc_html($salary); ?></span>
                            </div>
                            <a href="<?php echo get_permalink($job->ID); ?>" class="jobportal-btn jobportal-btn-primary" style="width: 100%; justify-content: center;">
                                <?php _e('View & Apply', 'jobportal'); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="jobportal-applications-table">
                    <div class="jobportal-empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <h3><?php _e('No Saved Jobs', 'jobportal'); ?></h3>
                        <p><?php _e('Save jobs you\'re interested in to easily find them later.', 'jobportal'); ?></p>
                        <a href="<?php echo home_url('/jobs'); ?>" class="jobportal-btn jobportal-btn-primary">
                            <?php _e('Browse Jobs', 'jobportal'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tab Content: Profile -->
        <div class="jobportal-tab-content" id="profile">
            <div class="jobportal-applications-table">
                <div style="padding: 40px;">
                    <h2 style="font-size: 24px; font-weight: 800; margin-bottom: 24px;"><?php _e('Profile Settings', 'jobportal'); ?></h2>
                    <form method="post">
                        <div class="jobportal-form-group" style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px;"><?php _e('Display Name', 'jobportal'); ?></label>
                            <input type="text" value="<?php echo esc_attr($current_user->display_name); ?>" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px;">
                        </div>
                        <div class="jobportal-form-group" style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px;"><?php _e('Email', 'jobportal'); ?></label>
                            <input type="email" value="<?php echo esc_attr($current_user->user_email); ?>" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px;">
                        </div>
                        <button type="submit" class="jobportal-btn jobportal-btn-primary">
                            <?php _e('Update Profile', 'jobportal'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
// Tab switching
document.querySelectorAll('.jobportal-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        const targetTab = this.dataset.tab;

        // Remove active class from all tabs and contents
        document.querySelectorAll('.jobportal-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.jobportal-tab-content').forEach(c => c.classList.remove('active'));

        // Add active class to clicked tab and corresponding content
        this.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
    });
});
</script>

<?php get_footer(); ?>
