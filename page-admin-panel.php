<?php
/**
 * Template Name: Admin Panel
 *
 * Frontend Admin Dashboard for theme management
 *
 * @package JobPortal
 */

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_redirect(home_url());
    exit;
}

get_header();

$stats = jobportal_get_dashboard_stats();
$users = jobportal_get_all_users_details();
$recent_jobs = jobportal_get_recent_jobs(20);
$recent_applications = jobportal_get_recent_applications(20);
$recent_posts = jobportal_get_recent_posts(20);
$traffic_stats = jobportal_get_traffic_stats();
$theme_settings = jobportal_get_theme_settings();
$resume_analytics = jobportal_get_resume_analytics();
$seo_overview = jobportal_get_seo_overview();
?>

<style>
.admin-panel-container {
    max-width: 1600px;
    margin: 0 auto;
    padding: 40px 20px;
}

.admin-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 32px;
    border-bottom: 2px solid #e5e7eb;
    overflow-x: auto;
    padding-bottom: 0;
}

.admin-tab {
    padding: 14px 24px;
    background: transparent;
    border: none;
    color: #64748b;
    font-weight: 600;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s;
    white-space: nowrap;
    font-size: 15px;
}

.admin-tab:hover {
    color: #4facfe;
    background: #f8fafc;
}

.admin-tab.active {
    color: #4facfe;
    border-bottom-color: #4facfe;
    background: #eff6ff;
}

.admin-tab-content {
    display: none;
}

.admin-tab-content.active {
    display: block;
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border-left: 4px solid;
}

.admin-table {
    width: 100%;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.admin-table table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th {
    padding: 16px;
    text-align: left;
    background: #f8fafc;
    font-weight: 700;
    color: #64748b;
    font-size: 13px;
    text-transform: uppercase;
    border-bottom: 2px solid #e5e7eb;
}

.admin-table td {
    padding: 16px;
    border-bottom: 1px solid #e5e7eb;
    color: #1e293b;
}

.admin-table tr:last-child td {
    border-bottom: none;
}

.admin-table tr:hover {
    background: #f8fafc;
}

.badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 700;
}

.badge-success { background: #d1fae5; color: #065f46; }
.badge-warning { background: #fef3c7; color: #92400e; }
.badge-danger { background: #fee2e2; color: #991b1b; }
.badge-info { background: #dbeafe; color: #1e40af; }

.action-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.action-btn-primary {
    background: #4facfe;
    color: white;
}

.action-btn-danger {
    background: #ef4444;
    color: white;
}

.action-btn-success {
    background: #10b981;
    color: white;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.settings-form {
    background: white;
    padding: 32px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 15px;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #4facfe;
    outline: none;
}
</style>

<div class="admin-panel-container">
    <!-- Header -->
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 42px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
            ⚡ Admin Control Panel
        </h1>
        <p style="font-size: 18px; color: #64748b;">
            Complete theme management from frontend
        </p>
    </div>

    <!-- Tabs -->
    <div class="admin-tabs">
        <button class="admin-tab active" data-tab="overview">📊 Overview</button>
        <button class="admin-tab" data-tab="users">👥 Users (<?php echo number_format($stats['users']['total']); ?>)</button>
        <button class="admin-tab" data-tab="jobs">💼 Jobs (<?php echo number_format($stats['jobs']['total']); ?>)</button>
        <button class="admin-tab" data-tab="applications">📄 Applications (<?php echo number_format($stats['applications']['total']); ?>)</button>
        <button class="admin-tab" data-tab="resumes">📋 Resumes (<?php echo number_format($resume_analytics['total']); ?>)</button>
        <button class="admin-tab" data-tab="blogs">📝 Blogs (<?php echo number_format($stats['posts']['total']); ?>)</button>
        <button class="admin-tab" data-tab="traffic">📈 Traffic</button>
        <button class="admin-tab" data-tab="seo">🎯 SEO (<?php echo $seo_overview['average_score']; ?>%)</button>
        <button class="admin-tab" data-tab="settings">⚙️ Settings</button>
    </div>

    <!-- Overview Tab -->
    <div class="admin-tab-content active" id="tab-overview">
        <!-- Stats Cards -->
        <div class="stat-grid">
            <div class="stat-card" style="border-left-color: #4facfe;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Jobs
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($stats['jobs']['total']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    +<?php echo number_format($stats['jobs']['this_week']); ?> this week
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #10b981;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Applications
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($stats['applications']['total']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    +<?php echo number_format($stats['applications']['this_week']); ?> this week
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #f59e0b;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Users
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($stats['users']['total']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    +<?php echo number_format($stats['users']['this_week']); ?> this week
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #8b5cf6;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Companies
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($stats['companies']['total']); ?>
                </div>
                <div style="color: #64748b; font-size: 13px; font-weight: 600;">
                    Active profiles
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #ec4899;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Blog Posts
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($stats['posts']['total']); ?>
                </div>
                <div style="color: #64748b; font-size: 13px; font-weight: 600;">
                    Published
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #ef4444;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Resumes
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($resume_analytics['total']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    <?php echo number_format($resume_analytics['today']); ?> created today
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #10b981;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    SEO Score
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo $seo_overview['average_score']; ?>%
                </div>
                <div style="color: <?php echo $seo_overview['critical'] > 0 ? '#ef4444' : '#10b981'; ?>; font-size: 13px; font-weight: 600;">
                    <?php echo $seo_overview['critical']; ?> need attention
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #06b6d4;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Comments
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($stats['comments']['approved']); ?>
                </div>
                <div style="color: #f59e0b; font-size: 13px; font-weight: 600;">
                    <?php echo number_format($stats['comments']['pending']); ?> pending
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <a href="<?php echo admin_url('post-new.php?post_type=job'); ?>" style="
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                padding: 32px;
                border-radius: 16px;
                color: white;
                text-decoration: none;
                text-align: center;
                box-shadow: 0 8px 24px rgba(79, 172, 254, 0.3);
                transition: all 0.3s;
            ">
                <div style="font-size: 48px; margin-bottom: 12px;">➕</div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0; color: white;">Post New Job</h3>
            </a>

            <a href="<?php echo admin_url('post-new.php'); ?>" style="
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                padding: 32px;
                border-radius: 16px;
                color: white;
                text-decoration: none;
                text-align: center;
                box-shadow: 0 8px 24px rgba(240, 147, 251, 0.3);
                transition: all 0.3s;
            ">
                <div style="font-size: 48px; margin-bottom: 12px;">📝</div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0; color: white;">Write Blog Post</h3>
            </a>

            <a href="<?php echo admin_url('post-new.php?post_type=company'); ?>" style="
                background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
                padding: 32px;
                border-radius: 16px;
                color: white;
                text-decoration: none;
                text-align: center;
                box-shadow: 0 8px 24px rgba(250, 112, 154, 0.3);
                transition: all 0.3s;
            ">
                <div style="font-size: 48px; margin-bottom: 12px;">🏢</div>
                <h3 style="font-size: 20px; font-weight: 700; margin: 0; color: white;">Add Company</h3>
            </a>
        </div>

        <!-- Recent Activity -->
        <h2 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 20px;">Recent Jobs</h2>
        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Applications</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($recent_jobs, 0, 10) as $job) :
                        $company_id = get_post_meta($job->ID, '_company', true);
                        $company_name = $company_id ? get_the_title($company_id) : 'N/A';

                        $apps = get_posts(array(
                            'post_type' => 'job_application',
                            'meta_key' => '_job_id',
                            'meta_value' => $job->ID,
                            'fields' => 'ids',
                            'posts_per_page' => -1,
                        ));
                    ?>
                        <tr>
                            <td>
                                <strong><?php echo esc_html($job->post_title); ?></strong>
                            </td>
                            <td><?php echo esc_html($company_name); ?></td>
                            <td>
                                <?php if ($job->post_status === 'publish') : ?>
                                    <span class="badge badge-success">Published</span>
                                <?php else : ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo count($apps); ?> applications</td>
                            <td><?php echo human_time_diff(strtotime($job->post_date), current_time('timestamp')); ?> ago</td>
                            <td>
                                <a href="<?php echo get_permalink($job->ID); ?>" target="_blank" class="action-btn action-btn-primary">View</a>
                                <a href="<?php echo admin_url('post.php?post=' . $job->ID . '&action=edit'); ?>" class="action-btn action-btn-success">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Users Tab -->
    <div class="admin-tab-content" id="tab-users">
        <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
            All Users (<?php echo count($users); ?>)
        </h2>

        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Role</th>
                        <th>Activity</th>
                        <th>Points</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr data-user-id="<?php echo $user['id']; ?>">
                            <td><strong><?php echo esc_html($user['name']); ?></strong></td>
                            <td><?php echo esc_html($user['email']); ?></td>
                            <td>
                                <?php if ($user['user_type'] === 'employer') : ?>
                                    <span class="badge badge-info">Employer</span>
                                <?php else : ?>
                                    <span class="badge badge-success">Candidate</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo esc_html($user['role']); ?></td>
                            <td>
                                <?php if ($user['user_type'] === 'employer') : ?>
                                    <?php echo $user['jobs_count']; ?> jobs posted
                                <?php else : ?>
                                    <?php echo $user['applications_count']; ?> applications
                                <?php endif; ?>
                            </td>
                            <td><?php echo number_format($user['referral_points']); ?> pts</td>
                            <td><?php echo date('M d, Y', strtotime($user['registered'])); ?></td>
                            <td>
                                <a href="<?php echo admin_url('user-edit.php?user_id=' . $user['id']); ?>" class="action-btn action-btn-primary">Edit</a>
                                <?php if ($user['id'] !== get_current_user_id()) : ?>
                                    <button class="action-btn action-btn-danger delete-user-btn" data-user-id="<?php echo $user['id']; ?>">Delete</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Jobs Tab -->
    <div class="admin-tab-content" id="tab-jobs">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0;">
                All Jobs (<?php echo count($recent_jobs); ?>)
            </h2>
            <a href="<?php echo admin_url('post-new.php?post_type=job'); ?>" class="jobportal-btn jobportal-btn-primary">
                ➕ Add New Job
            </a>
        </div>

        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Applications</th>
                        <th>Views</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_jobs as $job) :
                        $location = get_post_meta($job->ID, '_location', true);
                        $job_type = get_post_meta($job->ID, '_job_type', true);
                        $salary = get_post_meta($job->ID, '_salary', true);
                        $views = get_post_meta($job->ID, '_job_views', true) ?: 0;

                        $apps = get_posts(array(
                            'post_type' => 'job_application',
                            'meta_key' => '_job_id',
                            'meta_value' => $job->ID,
                            'fields' => 'ids',
                            'posts_per_page' => -1,
                        ));
                    ?>
                        <tr data-job-id="<?php echo $job->ID; ?>">
                            <td><strong><?php echo esc_html($job->post_title); ?></strong></td>
                            <td><?php echo esc_html($location); ?></td>
                            <td><?php echo esc_html($job_type); ?></td>
                            <td><?php echo esc_html($salary); ?></td>
                            <td>
                                <?php if ($job->post_status === 'publish') : ?>
                                    <span class="badge badge-success">Published</span>
                                <?php elseif ($job->post_status === 'pending') : ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php else : ?>
                                    <span class="badge badge-info"><?php echo ucfirst($job->post_status); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo count($apps); ?></td>
                            <td><?php echo number_format($views); ?></td>
                            <td><?php echo human_time_diff(strtotime($job->post_date), current_time('timestamp')); ?> ago</td>
                            <td>
                                <a href="<?php echo get_permalink($job->ID); ?>" target="_blank" class="action-btn action-btn-primary">View</a>
                                <a href="<?php echo admin_url('post.php?post=' . $job->ID . '&action=edit'); ?>" class="action-btn action-btn-success">Edit</a>
                                <button class="action-btn action-btn-danger delete-job-btn" data-job-id="<?php echo $job->ID; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Applications Tab -->
    <div class="admin-tab-content" id="tab-applications">
        <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
            All Applications (<?php echo count($recent_applications); ?>)
        </h2>

        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Email</th>
                        <th>Job Applied</th>
                        <th>Status</th>
                        <th>Applied</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_applications as $app) :
                        $applicant_name = get_post_meta($app->ID, '_applicant_name', true);
                        $applicant_email = get_post_meta($app->ID, '_applicant_email', true);
                        $job_id = get_post_meta($app->ID, '_job_id', true);
                        $job_title = $job_id ? get_the_title($job_id) : 'N/A';
                        $status = get_post_meta($app->ID, '_application_status', true) ?: 'pending';
                    ?>
                        <tr>
                            <td><strong><?php echo esc_html($applicant_name); ?></strong></td>
                            <td><?php echo esc_html($applicant_email); ?></td>
                            <td><?php echo esc_html($job_title); ?></td>
                            <td>
                                <?php
                                $status_badges = array(
                                    'pending' => 'warning',
                                    'reviewing' => 'info',
                                    'shortlisted' => 'info',
                                    'interview' => 'info',
                                    'offered' => 'success',
                                    'rejected' => 'danger',
                                );
                                $badge_class = isset($status_badges[$status]) ? $status_badges[$status] : 'info';
                                ?>
                                <span class="badge badge-<?php echo $badge_class; ?>">
                                    <?php echo ucfirst($status); ?>
                                </span>
                            </td>
                            <td><?php echo human_time_diff(strtotime($app->post_date), current_time('timestamp')); ?> ago</td>
                            <td>
                                <a href="<?php echo admin_url('post.php?post=' . $app->ID . '&action=edit'); ?>" class="action-btn action-btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Resumes Tab -->
    <div class="admin-tab-content" id="tab-resumes">
        <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
            Resume Analytics
        </h2>

        <!-- Resume Stats Grid -->
        <div class="stat-grid" style="margin-bottom: 40px;">
            <div class="stat-card" style="border-left-color: #ef4444;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Created Today
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b;">
                    <?php echo number_format($resume_analytics['today']); ?>
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #f59e0b;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Created Yesterday
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b;">
                    <?php echo number_format($resume_analytics['yesterday']); ?>
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #10b981;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    This Week
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b;">
                    <?php echo number_format($resume_analytics['this_week']); ?>
                </div>
            </div>

            <div class="stat-card" style="border-left-color: #667eea;">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Resumes
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b;">
                    <?php echo number_format($resume_analytics['total']); ?>
                </div>
            </div>
        </div>

        <!-- Top Resume Creators -->
        <?php if (!empty($resume_analytics['top_creators'])): ?>
        <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
            <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">
                🏆 Top Resume Creators
            </h3>
            <div class="admin-table">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>User ID</th>
                            <th>Resume Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resume_analytics['top_creators'] as $creator): ?>
                        <tr>
                            <td><strong><?php echo esc_html($creator->display_name); ?></strong></td>
                            <td><?php echo esc_html($creator->post_author); ?></td>
                            <td>
                                <span class="badge badge-success">
                                    <?php echo number_format($creator->resume_count); ?> resumes
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Blogs Tab -->
    <div class="admin-tab-content" id="tab-blogs">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0;">
                Blog Posts (<?php echo count($recent_posts); ?>)
            </h2>
            <a href="<?php echo admin_url('post-new.php'); ?>" class="jobportal-btn jobportal-btn-primary">
                ➕ Add New Post
            </a>
        </div>

        <div class="admin-table">
            <table>
                <thead>
                    <tr>
                        <th>Post Title</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Comments</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_posts as $post) :
                        $author = get_user_by('id', $post->post_author);
                        $categories = get_the_category($post->ID);
                        $comments_count = wp_count_comments($post->ID);
                    ?>
                        <tr>
                            <td><strong><?php echo esc_html($post->post_title); ?></strong></td>
                            <td><?php echo esc_html($author->display_name); ?></td>
                            <td>
                                <?php
                                if (!empty($categories)) {
                                    echo esc_html($categories[0]->name);
                                    if (count($categories) > 1) {
                                        echo ' +' . (count($categories) - 1);
                                    }
                                } else {
                                    echo 'Uncategorized';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($post->post_status === 'publish') : ?>
                                    <span class="badge badge-success">Published</span>
                                <?php else : ?>
                                    <span class="badge badge-warning"><?php echo ucfirst($post->post_status); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $comments_count->approved; ?> comments</td>
                            <td><?php echo human_time_diff(strtotime($post->post_date), current_time('timestamp')); ?> ago</td>
                            <td>
                                <a href="<?php echo get_permalink($post->ID); ?>" target="_blank" class="action-btn action-btn-primary">View</a>
                                <a href="<?php echo admin_url('post.php?post=' . $post->ID . '&action=edit'); ?>" class="action-btn action-btn-success">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Traffic Tab -->
    <div class="admin-tab-content" id="tab-traffic">
        <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
            Traffic & Analytics
        </h2>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px;">
            <!-- Most Viewed Jobs -->
            <div class="admin-table">
                <h3 style="padding: 20px; margin: 0; background: #f8fafc; font-size: 18px; font-weight: 700; color: #1e293b;">
                    🔥 Most Viewed Jobs
                </h3>
                <table>
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($traffic_stats['jobs'] as $job) : ?>
                            <tr>
                                <td>
                                    <a href="<?php echo get_permalink($job->ID); ?>" target="_blank" style="color: #4facfe; text-decoration: none; font-weight: 600;">
                                        <?php echo esc_html($job->post_title); ?>
                                    </a>
                                </td>
                                <td>
                                    <strong><?php echo number_format($job->views ?: 0); ?></strong> views
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Most Viewed Companies -->
            <div class="admin-table">
                <h3 style="padding: 20px; margin: 0; background: #f8fafc; font-size: 18px; font-weight: 700; color: #1e293b;">
                    🏆 Most Viewed Companies
                </h3>
                <table>
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($traffic_stats['companies'] as $company) : ?>
                            <tr>
                                <td>
                                    <a href="<?php echo get_permalink($company->ID); ?>" target="_blank" style="color: #4facfe; text-decoration: none; font-weight: 600;">
                                        <?php echo esc_html($company->post_title); ?>
                                    </a>
                                </td>
                                <td>
                                    <strong><?php echo number_format($company->views ?: 0); ?></strong> views
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SEO Tab -->
    <div class="admin-tab-content" id="tab-seo">
        <?php echo jobportal_seo_dashboard_content(); ?>
    </div>

    <!-- Settings Tab -->
    <div class="admin-tab-content" id="tab-settings">
        <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
            Theme Settings
        </h2>

        <form id="theme-settings-form" class="settings-form">
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" id="site_name" name="site_name" value="<?php echo esc_attr($theme_settings['site_name']); ?>">
            </div>

            <div class="form-group">
                <label for="site_description">Site Description</label>
                <textarea id="site_description" name="site_description" rows="3"><?php echo esc_textarea($theme_settings['site_description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="contact_email">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr($theme_settings['contact_email']); ?>">
            </div>

            <h3 style="margin: 32px 0 20px; font-size: 20px; font-weight: 700; color: #1e293b;">Social Media</h3>

            <div class="form-group">
                <label for="social_facebook">Facebook URL</label>
                <input type="url" id="social_facebook" name="social_facebook" value="<?php echo esc_url($theme_settings['social_facebook']); ?>" placeholder="https://facebook.com/yourpage">
            </div>

            <div class="form-group">
                <label for="social_twitter">Twitter URL</label>
                <input type="url" id="social_twitter" name="social_twitter" value="<?php echo esc_url($theme_settings['social_twitter']); ?>" placeholder="https://twitter.com/yourusername">
            </div>

            <div class="form-group">
                <label for="social_linkedin">LinkedIn URL</label>
                <input type="url" id="social_linkedin" name="social_linkedin" value="<?php echo esc_url($theme_settings['social_linkedin']); ?>" placeholder="https://linkedin.com/company/yourcompany">
            </div>

            <h3 style="margin: 32px 0 20px; font-size: 20px; font-weight: 700; color: #1e293b;">Display Settings</h3>

            <div class="form-group">
                <label for="jobs_per_page">Jobs Per Page</label>
                <input type="number" id="jobs_per_page" name="jobs_per_page" value="<?php echo esc_attr($theme_settings['jobs_per_page']); ?>" min="1" max="100">
            </div>

            <button type="submit" class="jobportal-btn jobportal-btn-primary" style="padding: 14px 32px; font-size: 16px;">
                💾 Save Settings
            </button>
        </form>

        <div id="settings-message" style="display: none; margin-top: 20px; padding: 16px; border-radius: 8px;"></div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Tab switching
    $('.admin-tab').on('click', function() {
        var tab = $(this).data('tab');

        $('.admin-tab').removeClass('active');
        $(this).addClass('active');

        $('.admin-tab-content').removeClass('active');
        $('#tab-' + tab).addClass('active');
    });

    // Delete user
    $('.delete-user-btn').on('click', function() {
        if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            return;
        }

        var userId = $(this).data('user-id');
        var row = $(this).closest('tr');

        $.ajax({
            url: jobportalAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'jobportal_delete_user',
                nonce: jobportalAjax.nonce,
                user_id: userId
            },
            success: function(response) {
                if (response.success) {
                    row.fadeOut(300, function() {
                        $(this).remove();
                    });
                    alert('User deleted successfully');
                } else {
                    alert('Error: ' + response.data.message);
                }
            }
        });
    });

    // Delete job
    $('.delete-job-btn').on('click', function() {
        if (!confirm('Are you sure you want to delete this job? This action cannot be undone.')) {
            return;
        }

        var jobId = $(this).data('job-id');
        var row = $(this).closest('tr');

        $.ajax({
            url: jobportalAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'jobportal_delete_job',
                nonce: jobportalAjax.nonce,
                job_id: jobId
            },
            success: function(response) {
                if (response.success) {
                    row.fadeOut(300, function() {
                        $(this).remove();
                    });
                    alert('Job deleted successfully');
                } else {
                    alert('Error: ' + response.data.message);
                }
            }
        });
    });

    // Save settings
    $('#theme-settings-form').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            action: 'jobportal_update_theme_settings',
            nonce: jobportalAjax.nonce,
            site_name: $('#site_name').val(),
            site_description: $('#site_description').val(),
            contact_email: $('#contact_email').val(),
            social_facebook: $('#social_facebook').val(),
            social_twitter: $('#social_twitter').val(),
            social_linkedin: $('#social_linkedin').val(),
            jobs_per_page: $('#jobs_per_page').val()
        };

        $.ajax({
            url: jobportalAjax.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                var message = $('#settings-message');
                if (response.success) {
                    message.css('background', '#d1fae5')
                           .css('color', '#065f46')
                           .html('✅ ' + response.data.message)
                           .fadeIn();
                } else {
                    message.css('background', '#fee2e2')
                           .css('color', '#991b1b')
                           .html('❌ ' + response.data.message)
                           .fadeIn();
                }

                setTimeout(function() {
                    message.fadeOut();
                }, 3000);
            }
        });
    });
});
</script>

<?php
get_footer();
