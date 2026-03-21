<?php
/**
 * Advanced Analytics Dashboard
 * Comprehensive analytics and insights
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get Job Statistics
 */
function jobportal_get_job_stats() {
    $total_jobs = wp_count_posts('job')->publish;
    $total_applications = wp_count_posts('job_application')->publish;
    $total_companies = wp_count_posts('company')->publish;

    // Get jobs posted in last 30 days
    $recent_jobs = get_posts(array(
        'post_type' => 'job',
        'post_status' => 'publish',
        'date_query' => array(
            array(
                'after' => '30 days ago',
            ),
        ),
        'fields' => 'ids',
        'posts_per_page' => -1,
    ));

    // Get applications in last 30 days
    $recent_applications = get_posts(array(
        'post_type' => 'job_application',
        'post_status' => 'publish',
        'date_query' => array(
            array(
                'after' => '30 days ago',
            ),
        ),
        'fields' => 'ids',
        'posts_per_page' => -1,
    ));

    return array(
        'total_jobs' => $total_jobs,
        'total_applications' => $total_applications,
        'total_companies' => $total_companies,
        'jobs_this_month' => count($recent_jobs),
        'applications_this_month' => count($recent_applications),
        'avg_applications_per_job' => $total_jobs > 0 ? round($total_applications / $total_jobs, 1) : 0,
    );
}

/**
 * Get User Growth Stats
 */
function jobportal_get_user_growth_stats() {
    global $wpdb;

    $total_users = count_users();
    $total_count = $total_users['total_users'];

    // Users this month
    $users_this_month = $wpdb->get_var("
        SELECT COUNT(*)
        FROM {$wpdb->users}
        WHERE user_registered >= DATE_SUB(NOW(), INTERVAL 30 DAY)
    ");

    // Users this week
    $users_this_week = $wpdb->get_var("
        SELECT COUNT(*)
        FROM {$wpdb->users}
        WHERE user_registered >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");

    // Get user growth by month (last 6 months)
    $monthly_growth = array();
    for ($i = 5; $i >= 0; $i--) {
        $month_start = date('Y-m-01', strtotime("-$i months"));
        $month_end = date('Y-m-t', strtotime("-$i months"));

        $count = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(*)
            FROM {$wpdb->users}
            WHERE user_registered >= %s AND user_registered <= %s
        ", $month_start, $month_end . ' 23:59:59'));

        $monthly_growth[] = array(
            'month' => date('M Y', strtotime($month_start)),
            'count' => intval($count),
        );
    }

    return array(
        'total_users' => $total_count,
        'users_this_month' => intval($users_this_month),
        'users_this_week' => intval($users_this_week),
        'monthly_growth' => $monthly_growth,
    );
}

/**
 * Get Top Performing Jobs
 */
function jobportal_get_top_jobs($limit = 10) {
    $jobs = get_posts(array(
        'post_type' => 'job',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ));

    $job_stats = array();

    foreach ($jobs as $job) {
        $applications = get_posts(array(
            'post_type' => 'job_application',
            'meta_query' => array(
                array(
                    'key' => '_job_id',
                    'value' => $job->ID,
                ),
            ),
            'fields' => 'ids',
            'posts_per_page' => -1,
        ));

        $views = get_post_meta($job->ID, '_job_views', true) ?: 0;

        $job_stats[] = array(
            'id' => $job->ID,
            'title' => $job->post_title,
            'applications' => count($applications),
            'views' => intval($views),
            'conversion_rate' => $views > 0 ? round((count($applications) / $views) * 100, 1) : 0,
            'posted_date' => $job->post_date,
        );
    }

    // Sort by applications
    usort($job_stats, function($a, $b) {
        return $b['applications'] - $a['applications'];
    });

    return array_slice($job_stats, 0, $limit);
}

/**
 * Get Application Status Breakdown
 */
function jobportal_get_application_status_breakdown() {
    $statuses = array('pending', 'reviewing', 'shortlisted', 'interview', 'offered', 'rejected');
    $breakdown = array();

    foreach ($statuses as $status) {
        $count = get_posts(array(
            'post_type' => 'job_application',
            'meta_query' => array(
                array(
                    'key' => '_application_status',
                    'value' => $status,
                ),
            ),
            'fields' => 'ids',
            'posts_per_page' => -1,
        ));

        $breakdown[$status] = count($count);
    }

    return $breakdown;
}

/**
 * Shortcode: Analytics Dashboard
 */
function jobportal_analytics_dashboard_shortcode() {
    if (!is_user_logged_in() || !current_user_can('manage_options')) {
        return '<p style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 12px;">You do not have permission to view analytics.</p>';
    }

    $job_stats = jobportal_get_job_stats();
    $user_stats = jobportal_get_user_growth_stats();
    $top_jobs = jobportal_get_top_jobs(10);
    $status_breakdown = jobportal_get_application_status_breakdown();

    ob_start();
    ?>
    <div class="jobportal-analytics-dashboard">
        <!-- Header -->
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 42px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                📊 Analytics Dashboard
            </h1>
            <p style="font-size: 18px; color: #64748b;">
                Comprehensive insights and metrics for your job portal
            </p>
        </div>

        <!-- Key Metrics -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <!-- Total Jobs -->
            <div style="
                background: white;
                padding: 28px;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #4facfe;
            ">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Jobs
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($job_stats['total_jobs']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    +<?php echo number_format($job_stats['jobs_this_month']); ?> this month
                </div>
            </div>

            <!-- Total Applications -->
            <div style="
                background: white;
                padding: 28px;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #10b981;
            ">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Applications
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($job_stats['total_applications']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    +<?php echo number_format($job_stats['applications_this_month']); ?> this month
                </div>
            </div>

            <!-- Total Users -->
            <div style="
                background: white;
                padding: 28px;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #f59e0b;
            ">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Users
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($user_stats['total_users']); ?>
                </div>
                <div style="color: #10b981; font-size: 13px; font-weight: 600;">
                    +<?php echo number_format($user_stats['users_this_month']); ?> this month
                </div>
            </div>

            <!-- Total Companies -->
            <div style="
                background: white;
                padding: 28px;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border-left: 4px solid #8b5cf6;
            ">
                <div style="color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                    Total Companies
                </div>
                <div style="font-size: 36px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                    <?php echo number_format($job_stats['total_companies']); ?>
                </div>
                <div style="color: #64748b; font-size: 13px; font-weight: 600;">
                    <?php echo number_format($job_stats['avg_applications_per_job'], 1); ?> apps/job avg
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px; margin-bottom: 40px;">
            <!-- User Growth Chart -->
            <div style="
                background: white;
                padding: 32px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            ">
                <h2 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                    User Growth (Last 6 Months)
                </h2>
                <div style="position: relative; height: 300px;">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>

            <!-- Application Status -->
            <div style="
                background: white;
                padding: 32px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            ">
                <h2 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                    Application Status
                </h2>
                <div style="display: grid; gap: 12px;">
                    <?php
                    $status_config = array(
                        'pending' => array('label' => 'Pending', 'color' => '#64748b'),
                        'reviewing' => array('label' => 'Reviewing', 'color' => '#3b82f6'),
                        'shortlisted' => array('label' => 'Shortlisted', 'color' => '#f59e0b'),
                        'interview' => array('label' => 'Interview', 'color' => '#8b5cf6'),
                        'offered' => array('label' => 'Offered', 'color' => '#10b981'),
                        'rejected' => array('label' => 'Rejected', 'color' => '#ef4444'),
                    );

                    $total_apps = array_sum($status_breakdown);

                    foreach ($status_config as $status => $config) :
                        $count = $status_breakdown[$status] ?? 0;
                        $percentage = $total_apps > 0 ? round(($count / $total_apps) * 100) : 0;
                    ?>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f8fafc; border-radius: 8px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 12px; height: 12px; border-radius: 50%; background: <?php echo $config['color']; ?>;"></div>
                                <span style="font-weight: 600; color: #1e293b;"><?php echo $config['label']; ?></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-weight: 700; color: #1e293b;"><?php echo $count; ?></span>
                                <span style="color: #64748b; font-size: 13px;">(<?php echo $percentage; ?>%)</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Top Performing Jobs -->
        <div style="
            background: white;
            padding: 32px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        ">
            <h2 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                Top Performing Jobs
            </h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e5e7eb;">
                            <th style="padding: 16px; text-align: left; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase;">Rank</th>
                            <th style="padding: 16px; text-align: left; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase;">Job Title</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase;">Applications</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase;">Views</th>
                            <th style="padding: 16px; text-align: center; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase;">Conversion</th>
                            <th style="padding: 16px; text-align: left; font-weight: 700; color: #64748b; font-size: 13px; text-transform: uppercase;">Posted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top_jobs as $index => $job) : ?>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px;">
                                    <div style="
                                        width: 32px;
                                        height: 32px;
                                        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                                        border-radius: 50%;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        font-weight: 800;
                                        color: white;
                                    ">
                                        <?php echo $index + 1; ?>
                                    </div>
                                </td>
                                <td style="padding: 16px;">
                                    <a href="<?php echo get_permalink($job['id']); ?>" style="font-weight: 600; color: #1e293b; text-decoration: none;">
                                        <?php echo esc_html($job['title']); ?>
                                    </a>
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <span style="
                                        padding: 6px 12px;
                                        background: #d1fae5;
                                        color: #065f46;
                                        border-radius: 12px;
                                        font-weight: 700;
                                        font-size: 13px;
                                    ">
                                        <?php echo $job['applications']; ?>
                                    </span>
                                </td>
                                <td style="padding: 16px; text-align: center; font-weight: 600; color: #64748b;">
                                    <?php echo number_format($job['views']); ?>
                                </td>
                                <td style="padding: 16px; text-align: center; font-weight: 700; color: #4facfe;">
                                    <?php echo $job['conversion_rate']; ?>%
                                </td>
                                <td style="padding: 16px; color: #64748b; font-size: 14px;">
                                    <?php echo human_time_diff(strtotime($job['posted_date']), current_time('timestamp')); ?> ago
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js for visualizations -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
    (function() {
        // User Growth Chart
        var userGrowthCtx = document.getElementById('userGrowthChart');

        if (userGrowthCtx) {
            var monthlyData = <?php echo json_encode($user_stats['monthly_growth']); ?>;

            new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: monthlyData.map(function(item) { return item.month; }),
                    datasets: [{
                        label: 'New Users',
                        data: monthlyData.map(function(item) { return item.count; }),
                        borderColor: '#4facfe',
                        backgroundColor: 'rgba(79, 172, 254, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#4facfe',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('analytics_dashboard', 'jobportal_analytics_dashboard_shortcode');

/**
 * Track Job Views
 */
function jobportal_track_job_views() {
    if (is_singular('job') && !is_user_logged_in()) {
        $job_id = get_the_ID();
        $views = get_post_meta($job_id, '_job_views', true) ?: 0;
        $views++;
        update_post_meta($job_id, '_job_views', $views);
    }
}
add_action('wp_head', 'jobportal_track_job_views');
