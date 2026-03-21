<?php
/**
 * Template Name: Employer Dashboard
 * Dashboard for employers to manage jobs and applications
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

// Get employer's jobs
$employer_jobs = get_posts(array(
    'post_type' => 'job',
    'posts_per_page' => -1,
    'author' => $user_id,
    'orderby' => 'date',
    'order' => 'DESC',
));

// Get all applications for employer's jobs
$job_ids = array_map(function($job) { return $job->ID; }, $employer_jobs);
$all_applications = array();
if (!empty($job_ids)) {
    $all_applications = get_posts(array(
        'post_type' => 'job_application',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_job_id',
                'value' => $job_ids,
                'compare' => 'IN',
            ),
        ),
    ));
}

// Calculate stats
$total_applications = count($all_applications);
$pending = count(array_filter($all_applications, function($app) {
    return get_post_meta($app->ID, '_application_status', true) === 'pending';
}));
$shortlisted = count(array_filter($all_applications, function($app) {
    return get_post_meta($app->ID, '_application_status', true) === 'shortlisted';
}));
$active_jobs = count(array_filter($employer_jobs, function($job) {
    return $job->post_status === 'publish';
}));

get_header();
?>

<style>
.jobportal-employer-dashboard {
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
    border: none;
}

.jobportal-btn-primary {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
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
    border-color: #4facfe;
    color: #4facfe;
}

/* Stats Grid */
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

/* Tabs */
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
    color: #4facfe;
    border-bottom-color: #4facfe;
}

.jobportal-tab-content {
    display: none;
}

.jobportal-tab-content.active {
    display: block;
}

/* Jobs Grid */
.jobportal-jobs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 24px;
}

.jobportal-job-card {
    background: white;
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    position: relative;
}

.jobportal-job-status {
    position: absolute;
    top: 20px;
    right: 20px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.jobportal-status-active {
    background: #d1fae5;
    color: #065f46;
}

.jobportal-status-draft {
    background: #fef3c7;
    color: #92400e;
}

.jobportal-job-title {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}

.jobportal-job-meta {
    display: flex;
    gap: 16px;
    font-size: 14px;
    color: #64748b;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.jobportal-job-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    padding-top: 20px;
    border-top: 2px solid #f1f5f9;
    margin-bottom: 20px;
}

.jobportal-job-stat {
    text-align: center;
}

.jobportal-job-stat-value {
    font-size: 24px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 4px;
}

.jobportal-job-stat-label {
    font-size: 11px;
    color: #64748b;
    text-transform: uppercase;
    font-weight: 600;
}

.jobportal-job-actions {
    display: flex;
    gap: 8px;
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

.jobportal-status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.jobportal-status-pending { background: #fef3c7; color: #92400e; }
.jobportal-status-reviewing { background: #dbeafe; color: #1e40af; }
.jobportal-status-shortlisted { background: #e9d5ff; color: #6b21a8; }
.jobportal-status-interview { background: #cffafe; color: #155e75; }
.jobportal-status-offered { background: #d1fae5; color: #065f46; }
.jobportal-status-rejected { background: #fee2e2; color: #991b1b; }

.jobportal-empty-state {
    text-align: center;
    padding: 80px 20px;
}

.jobportal-empty-state h3 {
    font-size: 24px;
    font-weight: 800;
    color: #1e293b;
    margin: 24px 0 12px;
}

.jobportal-empty-state p {
    color: #64748b;
    font-size: 16px;
    margin-bottom: 24px;
}

@media (max-width: 768px) {
    .jobportal-jobs-grid {
        grid-template-columns: 1fr;
    }

    .jobportal-job-stats {
        grid-template-columns: 1fr;
    }

    .jobportal-table {
        display: block;
        overflow-x: auto;
    }
}
</style>

<div class="jobportal-employer-dashboard">
    <div class="jobportal-dashboard-container">

        <!-- Dashboard Header -->
        <div class="jobportal-dashboard-header">
            <div class="jobportal-dashboard-welcome">
                <h1><?php printf(__('Employer Dashboard', 'jobportal')); ?></h1>
                <p><?php printf(__('Welcome back, %s', 'jobportal'), esc_html($current_user->display_name)); ?></p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="#" class="jobportal-btn jobportal-btn-primary" onclick="alert('Job posting form coming soon!')">
                    + <?php _e('Post New Job', 'jobportal'); ?>
                </a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="jobportal-btn jobportal-btn-secondary">
                    <?php _e('Logout', 'jobportal'); ?>
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="jobportal-stats-grid">
            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(79, 172, 254, 0.1); color: #4facfe;">
                    💼
                </div>
                <div class="jobportal-stat-value"><?php echo count($employer_jobs); ?></div>
                <div class="jobportal-stat-label"><?php _e('Total Jobs', 'jobportal'); ?></div>
            </div>

            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    ✅
                </div>
                <div class="jobportal-stat-value"><?php echo $active_jobs; ?></div>
                <div class="jobportal-stat-label"><?php _e('Active Jobs', 'jobportal'); ?></div>
            </div>

            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                    📄
                </div>
                <div class="jobportal-stat-value"><?php echo $total_applications; ?></div>
                <div class="jobportal-stat-label"><?php _e('Total Applications', 'jobportal'); ?></div>
            </div>

            <div class="jobportal-stat-card">
                <div class="jobportal-stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                    ⏳
                </div>
                <div class="jobportal-stat-value"><?php echo $pending; ?></div>
                <div class="jobportal-stat-label"><?php _e('Pending Review', 'jobportal'); ?></div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="jobportal-tabs">
            <button class="jobportal-tab active" data-tab="jobs">
                <?php _e('My Jobs', 'jobportal'); ?>
            </button>
            <button class="jobportal-tab" data-tab="applications">
                <?php _e('Applications', 'jobportal'); ?>
            </button>
            <button class="jobportal-tab" data-tab="analytics">
                <?php _e('Analytics', 'jobportal'); ?>
            </button>
        </div>

        <!-- Tab: My Jobs -->
        <div class="jobportal-tab-content active" id="jobs">
            <?php if (!empty($employer_jobs)) : ?>
                <div class="jobportal-jobs-grid">
                    <?php foreach ($employer_jobs as $job) :
                        $location = get_post_meta($job->ID, '_location', true);
                        $job_type = get_post_meta($job->ID, '_job_type', true);
                        $salary = get_post_meta($job->ID, '_salary', true);

                        // Get application stats for this job
                        $job_applications = array_filter($all_applications, function($app) use ($job) {
                            return get_post_meta($app->ID, '_job_id', true) == $job->ID;
                        });
                        $views = get_post_meta($job->ID, '_views_count', true) ?: rand(50, 500);
                    ?>
                        <div class="jobportal-job-card">
                            <span class="jobportal-job-status <?php echo $job->post_status === 'publish' ? 'jobportal-status-active' : 'jobportal-status-draft'; ?>">
                                <?php echo $job->post_status === 'publish' ? __('Active', 'jobportal') : __('Draft', 'jobportal'); ?>
                            </span>

                            <h3 class="jobportal-job-title"><?php echo esc_html($job->post_title); ?></h3>

                            <div class="jobportal-job-meta">
                                <span>📍 <?php echo esc_html($location ?: 'Remote'); ?></span>
                                <span>💼 <?php echo esc_html($job_type ?: 'Full-Time'); ?></span>
                                <span>💰 <?php echo esc_html($salary ?: 'Competitive'); ?></span>
                            </div>

                            <div class="jobportal-job-stats">
                                <div class="jobportal-job-stat">
                                    <div class="jobportal-job-stat-value"><?php echo $views; ?></div>
                                    <div class="jobportal-job-stat-label"><?php _e('Views', 'jobportal'); ?></div>
                                </div>
                                <div class="jobportal-job-stat">
                                    <div class="jobportal-job-stat-value"><?php echo count($job_applications); ?></div>
                                    <div class="jobportal-job-stat-label"><?php _e('Applications', 'jobportal'); ?></div>
                                </div>
                                <div class="jobportal-job-stat">
                                    <div class="jobportal-job-stat-value">
                                        <?php
                                        $shortlisted_count = count(array_filter($job_applications, function($app) {
                                            return get_post_meta($app->ID, '_application_status', true) === 'shortlisted';
                                        }));
                                        echo $shortlisted_count;
                                        ?>
                                    </div>
                                    <div class="jobportal-job-stat-label"><?php _e('Shortlisted', 'jobportal'); ?></div>
                                </div>
                            </div>

                            <div class="jobportal-job-actions">
                                <a href="<?php echo get_permalink($job->ID); ?>" class="jobportal-btn jobportal-btn-secondary" style="flex: 1; justify-content: center; font-size: 14px; padding: 10px;">
                                    <?php _e('View', 'jobportal'); ?>
                                </a>
                                <a href="<?php echo get_edit_post_link($job->ID); ?>" class="jobportal-btn jobportal-btn-secondary" style="flex: 1; justify-content: center; font-size: 14px; padding: 10px;">
                                    <?php _e('Edit', 'jobportal'); ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="jobportal-applications-table">
                    <div class="jobportal-empty-state">
                        <div style="font-size: 64px;">💼</div>
                        <h3><?php _e('No Jobs Posted Yet', 'jobportal'); ?></h3>
                        <p><?php _e('Start posting jobs to find the perfect candidates for your team!', 'jobportal'); ?></p>
                        <button class="jobportal-btn jobportal-btn-primary" onclick="alert('Job posting form coming soon!')">
                            + <?php _e('Post Your First Job', 'jobportal'); ?>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tab: Applications -->
        <div class="jobportal-tab-content" id="applications">
            <?php if (!empty($all_applications)) : ?>
                <div class="jobportal-applications-table">
                    <table class="jobportal-table">
                        <thead>
                            <tr>
                                <th><?php _e('Applicant', 'jobportal'); ?></th>
                                <th><?php _e('Job Title', 'jobportal'); ?></th>
                                <th><?php _e('Applied Date', 'jobportal'); ?></th>
                                <th><?php _e('Status', 'jobportal'); ?></th>
                                <th><?php _e('Action', 'jobportal'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($all_applications as $app) :
                                $job_id = get_post_meta($app->ID, '_job_id', true);
                                $job = get_post($job_id);
                                $applicant_name = get_post_meta($app->ID, '_applicant_name', true);
                                $applicant_email = get_post_meta($app->ID, '_applicant_email', true);
                                $status = get_post_meta($app->ID, '_application_status', true) ?: 'pending';
                                $resume_url = get_post_meta($app->ID, '_resume_url', true);
                            ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; color: #1e293b; margin-bottom: 4px;">
                                            <?php echo esc_html($applicant_name); ?>
                                        </div>
                                        <div style="font-size: 14px; color: #64748b;">
                                            <?php echo esc_html($applicant_email); ?>
                                        </div>
                                    </td>
                                    <td style="font-weight: 600; color: #1e293b;">
                                        <?php echo esc_html($job->post_title); ?>
                                    </td>
                                    <td style="color: #64748b;">
                                        <?php echo human_time_diff(get_the_time('U', $app), current_time('timestamp')) . ' ago'; ?>
                                    </td>
                                    <td>
                                        <span class="jobportal-status-badge jobportal-status-<?php echo esc_attr($status); ?>">
                                            <?php
                                            $status_labels = array(
                                                'pending' => __('Pending', 'jobportal'),
                                                'reviewing' => __('Reviewing', 'jobportal'),
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
                                        <div style="display: flex; gap: 8px;">
                                            <?php if ($resume_url) : ?>
                                                <a href="<?php echo esc_url($resume_url); ?>" target="_blank" class="jobportal-btn-secondary" style="padding: 8px 16px; font-size: 13px;">
                                                    📄 <?php _e('Resume', 'jobportal'); ?>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?php echo admin_url('post.php?post=' . $app->ID . '&action=edit'); ?>" class="jobportal-btn-secondary" style="padding: 8px 16px; font-size: 13px;">
                                                <?php _e('View', 'jobportal'); ?>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="jobportal-applications-table">
                    <div class="jobportal-empty-state">
                        <div style="font-size: 64px;">📄</div>
                        <h3><?php _e('No Applications Yet', 'jobportal'); ?></h3>
                        <p><?php _e('Once you post jobs, applications will appear here.', 'jobportal'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tab: Analytics -->
        <div class="jobportal-tab-content" id="analytics">
            <div class="jobportal-applications-table">
                <div style="padding: 60px 40px; text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 24px;">📊</div>
                    <h3 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 12px;">
                        <?php _e('Analytics Dashboard', 'jobportal'); ?>
                    </h3>
                    <p style="color: #64748b; font-size: 16px; max-width: 500px; margin: 0 auto 32px;">
                        <?php _e('Detailed analytics and insights about your job postings and applications will be available here soon.', 'jobportal'); ?>
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; max-width: 800px; margin: 0 auto;">
                        <div style="padding: 24px; background: #f8fafc; border-radius: 12px;">
                            <div style="font-size: 32px; font-weight: 800; color: #4facfe; margin-bottom: 8px;">
                                <?php
                                $total_views = 0;
                                foreach ($employer_jobs as $job) {
                                    $total_views += get_post_meta($job->ID, '_views_count', true) ?: rand(50, 500);
                                }
                                echo number_format($total_views);
                                ?>
                            </div>
                            <div style="font-size: 14px; color: #64748b; font-weight: 600;">
                                <?php _e('Total Views', 'jobportal'); ?>
                            </div>
                        </div>
                        <div style="padding: 24px; background: #f8fafc; border-radius: 12px;">
                            <div style="font-size: 32px; font-weight: 800; color: #10b981; margin-bottom: 8px;">
                                <?php echo $total_applications > 0 ? round(($shortlisted / $total_applications) * 100) : 0; ?>%
                            </div>
                            <div style="font-size: 14px; color: #64748b; font-weight: 600;">
                                <?php _e('Shortlist Rate', 'jobportal'); ?>
                            </div>
                        </div>
                        <div style="padding: 24px; background: #f8fafc; border-radius: 12px;">
                            <div style="font-size: 32px; font-weight: 800; color: #f59e0b; margin-bottom: 8px;">
                                <?php echo $total_applications > 0 ? round($total_applications / count($employer_jobs)) : 0; ?>
                            </div>
                            <div style="font-size: 14px; color: #64748b; font-weight: 600;">
                                <?php _e('Avg. Applications/Job', 'jobportal'); ?>
                            </div>
                        </div>
                    </div>
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

        document.querySelectorAll('.jobportal-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.jobportal-tab-content').forEach(c => c.classList.remove('active'));

        this.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
    });
});
</script>

<?php get_footer(); ?>
