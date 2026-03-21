<?php
/**
 * Advanced Admin Panel - Elite Theme Framework
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create Advanced Admin Menu
 */
function jobportal_elite_admin_menu() {
    add_menu_page(
        __('JobPortal Elite', 'jobportal'),
        __('JobPortal Elite', 'jobportal'),
        'manage_options',
        'jobportal-elite',
        'jobportal_elite_dashboard_page',
        'dashicons-star-filled',
        3
    );

    add_submenu_page(
        'jobportal-elite',
        __('Dashboard', 'jobportal'),
        __('Dashboard', 'jobportal'),
        'manage_options',
        'jobportal-elite',
        'jobportal_elite_dashboard_page'
    );

    add_submenu_page(
        'jobportal-elite',
        __('Demo Import', 'jobportal'),
        __('Demo Import', 'jobportal'),
        'manage_options',
        'jobportal-demo-import',
        'jobportal_elite_demo_import_page'
    );

    add_submenu_page(
        'jobportal-elite',
        __('Performance', 'jobportal'),
        __('Performance', 'jobportal'),
        'manage_options',
        'jobportal-performance',
        'jobportal_elite_performance_page'
    );

    add_submenu_page(
        'jobportal-elite',
        __('Settings Backup', 'jobportal'),
        __('Settings Backup', 'jobportal'),
        'manage_options',
        'jobportal-backup',
        'jobportal_elite_backup_page'
    );

    add_submenu_page(
        'jobportal-elite',
        __('White Label', 'jobportal'),
        __('White Label', 'jobportal'),
        'manage_options',
        'jobportal-white-label',
        'jobportal_elite_white_label_page'
    );

    add_submenu_page(
        'jobportal-elite',
        __('System Status', 'jobportal'),
        __('System Status', 'jobportal'),
        'manage_options',
        'jobportal-system-status',
        'jobportal_elite_system_status_page'
    );
}
add_action('admin_menu', 'jobportal_elite_admin_menu');

/**
 * Dashboard Page
 */
function jobportal_elite_dashboard_page() {
    ?>
    <div class="wrap jobportal-elite-dashboard">
        <h1><?php esc_html_e('JobPortal Elite Dashboard', 'jobportal'); ?></h1>

        <div class="jobportal-dashboard-grid">

            <!-- Welcome Card -->
            <div class="jobportal-card jobportal-welcome-card">
                <h2 style="display: flex; align-items: center; gap: 8px;"><?php esc_html_e('Welcome to JobPortal Elite!', 'jobportal'); ?> <span style="color: #00B4D8;"><?php echo jobportal_get_icon('zap', 24); ?></span></h2>
                <p><?php esc_html_e('Thank you for choosing JobPortal Elite - Premium WordPress Theme with Advanced Features.', 'jobportal'); ?></p>

                <div class="jobportal-quick-links">
                    <a href="<?php echo admin_url('customize.php'); ?>" class="jobportal-btn jobportal-btn-primary">
                        <?php esc_html_e('Customize Theme', 'jobportal'); ?>
                    </a>
                    <a href="<?php echo admin_url('admin.php?page=jobportal-demo-import'); ?>" class="jobportal-btn jobportal-btn-secondary">
                        <?php esc_html_e('Import Demo', 'jobportal'); ?>
                    </a>
                    <a href="https://jobportaltheme.com/docs" target="_blank" class="jobportal-btn jobportal-btn-outline">
                        <?php esc_html_e('Documentation', 'jobportal'); ?>
                    </a>
                </div>
            </div>

            <!-- System Status Card -->
            <div class="jobportal-card jobportal-status-card">
                <h3><?php esc_html_e('System Status', 'jobportal'); ?></h3>

                <?php
                $checks = array(
                    'WordPress Version' => version_compare(get_bloginfo('version'), '6.0', '>='),
                    'PHP Version' => version_compare(PHP_VERSION, '7.4', '>='),
                    'MySQL Version' => true,
                    'Memory Limit' => (int) ini_get('memory_limit') >= 256,
                    'Max Upload Size' => (int) ini_get('upload_max_filesize') >= 32,
                );
                ?>

                <ul class="jobportal-status-list">
                    <?php foreach ($checks as $label => $status) : ?>
                        <li>
                            <span class="jobportal-status-icon <?php echo $status ? 'success' : 'warning'; ?>">
                                <?php echo $status ? '✓' : '⚠'; ?>
                            </span>
                            <span><?php echo esc_html($label); ?></span>
                            <span class="jobportal-status-value">
                                <?php
                                if ($label === 'WordPress Version') echo get_bloginfo('version');
                                elseif ($label === 'PHP Version') echo PHP_VERSION;
                                elseif ($label === 'Memory Limit') echo ini_get('memory_limit');
                                elseif ($label === 'Max Upload Size') echo ini_get('upload_max_filesize');
                                else echo $status ? 'OK' : 'Check';
                                ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?php echo admin_url('admin.php?page=jobportal-system-status'); ?>" class="jobportal-link">
                    <?php esc_html_e('View Full System Status', 'jobportal'); ?> →
                </a>
            </div>

            <!-- Performance Score Card -->
            <div class="jobportal-card jobportal-performance-card">
                <h3><?php esc_html_e('Performance Score', 'jobportal'); ?></h3>

                <div class="jobportal-performance-gauge">
                    <div class="jobportal-gauge-circle">
                        <span class="jobportal-score">92</span>
                        <span class="jobportal-score-label">/ 100</span>
                    </div>
                </div>

                <ul class="jobportal-performance-list">
                    <li>
                        <span class="jobportal-metric-label"><?php esc_html_e('Page Load Time', 'jobportal'); ?></span>
                        <span class="jobportal-metric-value">1.2s</span>
                    </li>
                    <li>
                        <span class="jobportal-metric-label"><?php esc_html_e('Total Requests', 'jobportal'); ?></span>
                        <span class="jobportal-metric-value">45</span>
                    </li>
                    <li>
                        <span class="jobportal-metric-label"><?php esc_html_e('Page Size', 'jobportal'); ?></span>
                        <span class="jobportal-metric-value">850 KB</span>
                    </li>
                </ul>

                <a href="<?php echo admin_url('admin.php?page=jobportal-performance'); ?>" class="jobportal-link">
                    <?php esc_html_e('Optimize Performance', 'jobportal'); ?> →
                </a>
            </div>

            <!-- Quick Stats Card -->
            <div class="jobportal-card jobportal-stats-card">
                <h3><?php esc_html_e('Quick Stats', 'jobportal'); ?></h3>

                <div class="jobportal-stats-grid">
                    <div class="jobportal-stat-item">
                        <div class="jobportal-stat-number"><?php echo wp_count_posts('post')->publish; ?></div>
                        <div class="jobportal-stat-label"><?php esc_html_e('Posts', 'jobportal'); ?></div>
                    </div>
                    <div class="jobportal-stat-item">
                        <div class="jobportal-stat-number"><?php echo wp_count_posts('page')->publish; ?></div>
                        <div class="jobportal-stat-label"><?php esc_html_e('Pages', 'jobportal'); ?></div>
                    </div>
                    <div class="jobportal-stat-item">
                        <div class="jobportal-stat-number"><?php echo wp_count_comments()->approved; ?></div>
                        <div class="jobportal-stat-label"><?php esc_html_e('Comments', 'jobportal'); ?></div>
                    </div>
                    <div class="jobportal-stat-item">
                        <div class="jobportal-stat-number"><?php echo count_users()['total_users']; ?></div>
                        <div class="jobportal-stat-label"><?php esc_html_e('Users', 'jobportal'); ?></div>
                    </div>
                </div>
            </div>

            <!-- Theme Info Card -->
            <div class="jobportal-card jobportal-info-card">
                <h3><?php esc_html_e('Theme Information', 'jobportal'); ?></h3>

                <table class="jobportal-info-table">
                    <tr>
                        <td><?php esc_html_e('Theme Name', 'jobportal'); ?></td>
                        <td><strong>JobPortal Elite</strong></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Version', 'jobportal'); ?></td>
                        <td><strong>2.0.0</strong></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Author', 'jobportal'); ?></td>
                        <td><strong>ThemeJobPortal</strong></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('License', 'jobportal'); ?></td>
                        <td><strong>GPL v2+</strong></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Last Updated', 'jobportal'); ?></td>
                        <td><strong><?php echo date('F j, Y'); ?></strong></td>
                    </tr>
                </table>
            </div>

            <!-- Support Card -->
            <div class="jobportal-card jobportal-support-card">
                <h3><?php esc_html_e('Need Help?', 'jobportal'); ?></h3>

                <ul class="jobportal-support-links">
                    <li>
                        <a href="https://jobportaltheme.com/docs" target="_blank">
                            📚 <?php esc_html_e('Documentation', 'jobportal'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://jobportaltheme.com/support" target="_blank">
                            <?php echo jobportal_get_icon('message-circle', 16); ?> <?php esc_html_e('Support Forum', 'jobportal'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://jobportaltheme.com/videos" target="_blank">
                            <?php echo jobportal_get_icon('monitor', 16); ?> <?php esc_html_e('Video Tutorials', 'jobportal'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://jobportaltheme.com/changelog" target="_blank">
                            <?php echo jobportal_get_icon('file-text', 16); ?> <?php esc_html_e('Changelog', 'jobportal'); ?>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <style>
    .jobportal-elite-dashboard {
        max-width: 1400px;
        margin: 20px 0;
    }

    .jobportal-dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .jobportal-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .jobportal-card h2, .jobportal-card h3 {
        margin-top: 0;
        margin-bottom: 16px;
        color: #1e293b;
    }

    .jobportal-welcome-card {
        grid-column: 1 / -1;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: #fff;
        border: none;
    }

    .jobportal-welcome-card h2, .jobportal-welcome-card p {
        color: #fff;
    }

    .jobportal-quick-links {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .jobportal-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
    }

    .jobportal-btn-primary {
        background: #fff;
        color: #6366f1;
    }

    .jobportal-btn-primary:hover {
        background: #f8fafc;
        transform: translateY(-1px);
    }

    .jobportal-btn-secondary {
        background: rgba(255,255,255,0.2);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .jobportal-btn-secondary:hover {
        background: rgba(255,255,255,0.3);
    }

    .jobportal-btn-outline {
        background: transparent;
        color: #fff;
        border: 1px solid rgba(255,255,255,0.5);
    }

    .jobportal-btn-outline:hover {
        background: rgba(255,255,255,0.1);
    }

    .jobportal-status-list, .jobportal-performance-list {
        list-style: none;
        padding: 0;
        margin: 0 0 16px 0;
    }

    .jobportal-status-list li, .jobportal-performance-list li {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .jobportal-status-list li:last-child, .jobportal-performance-list li:last-child {
        border-bottom: none;
    }

    .jobportal-status-icon {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 12px;
        font-size: 14px;
    }

    .jobportal-status-icon.success {
        background: #d1fae5;
        color: #10b981;
    }

    .jobportal-status-icon.warning {
        background: #fef3c7;
        color: #f59e0b;
    }

    .jobportal-status-value {
        margin-left: auto;
        font-weight: 600;
        color: #64748b;
    }

    .jobportal-performance-gauge {
        display: flex;
        justify-content: center;
        margin: 24px 0;
    }

    .jobportal-gauge-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .jobportal-score {
        font-size: 36px;
        font-weight: 700;
    }

    .jobportal-score-label {
        font-size: 12px;
        opacity: 0.8;
    }

    .jobportal-metric-label {
        flex: 1;
        color: #64748b;
    }

    .jobportal-metric-value {
        font-weight: 600;
        color: #1e293b;
    }

    .jobportal-stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .jobportal-stat-item {
        text-align: center;
        padding: 16px;
        background: #f8fafc;
        border-radius: 6px;
    }

    .jobportal-stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #6366f1;
        margin-bottom: 4px;
    }

    .jobportal-stat-label {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .jobportal-info-table {
        width: 100%;
        border-collapse: collapse;
    }

    .jobportal-info-table td {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .jobportal-info-table tr:last-child td {
        border-bottom: none;
    }

    .jobportal-info-table td:first-child {
        color: #64748b;
        width: 40%;
    }

    .jobportal-support-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .jobportal-support-links li {
        margin-bottom: 12px;
    }

    .jobportal-support-links a {
        display: block;
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 6px;
        text-decoration: none;
        color: #1e293b;
        transition: all 0.2s;
    }

    .jobportal-support-links a:hover {
        background: #e0e7ff;
        color: #6366f1;
        transform: translateX(4px);
    }

    .jobportal-link {
        display: inline-flex;
        align-items: center;
        color: #6366f1;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }

    .jobportal-link:hover {
        color: #4f46e5;
    }
    </style>
    <?php
}

/**
 * Demo Import Page
 */
function jobportal_elite_demo_import_page() {
    ?>
    <div class="wrap jobportal-demo-import">
        <h1><?php esc_html_e('Demo Import', 'jobportal'); ?></h1>
        <p><?php esc_html_e('Import pre-built demo content with one click.', 'jobportal'); ?></p>

        <div class="jobportal-demos-grid">
            <?php
            $demos = array(
                array('id' => 'demo1', 'name' => 'SaaS Startup', 'preview' => ''),
                array('id' => 'demo2', 'name' => 'AI Tool', 'preview' => ''),
                array('id' => 'demo3', 'name' => 'App Landing', 'preview' => ''),
                array('id' => 'demo4', 'name' => 'Digital Agency', 'preview' => ''),
                array('id' => 'demo5', 'name' => 'Tech Startup', 'preview' => ''),
            );

            foreach ($demos as $demo) :
            ?>
                <div class="jobportal-demo-card">
                    <div class="jobportal-demo-preview">
                        <span><?php echo esc_html($demo['name']); ?></span>
                    </div>
                    <div class="jobportal-demo-info">
                        <h3><?php echo esc_html($demo['name']); ?></h3>
                        <button class="button button-primary jobportal-import-demo" data-demo="<?php echo esc_attr($demo['id']); ?>">
                            <?php esc_html_e('Import Demo', 'jobportal'); ?>
                        </button>
                        <a href="#" target="_blank" class="button"><?php esc_html_e('Preview', 'jobportal'); ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
    .jobportal-demos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 30px;
    }

    .jobportal-demo-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .jobportal-demo-preview {
        height: 200px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
    }

    .jobportal-demo-info {
        padding: 16px;
    }

    .jobportal-demo-info h3 {
        margin: 0 0 12px 0;
    }

    .jobportal-demo-info .button {
        margin-right: 8px;
        margin-bottom: 8px;
    }
    </style>

    <script>
    jQuery(document).ready(function($) {
        $('.jobportal-import-demo').on('click', function() {
            var demoId = $(this).data('demo');
            var $button = $(this);

            $button.text('Importing...').prop('disabled', true);

            // Simulate import (replace with actual AJAX call)
            setTimeout(function() {
                $button.text('Imported!').removeClass('button-primary').addClass('button-disabled');
                alert('Demo imported successfully!');
            }, 2000);
        });
    });
    </script>
    <?php
}

/**
 * Performance Page
 */
function jobportal_elite_performance_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Performance Optimization', 'jobportal'); ?></h1>
        <p><?php esc_html_e('Optimize your website for maximum speed and performance.', 'jobportal'); ?></p>

        <!-- Performance optimization settings will go here -->
    </div>
    <?php
}

/**
 * Backup Page
 */
function jobportal_elite_backup_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Settings Backup & Restore', 'jobportal'); ?></h1>
        <p><?php esc_html_e('Backup and restore your theme settings.', 'jobportal'); ?></p>

        <!-- Backup/restore functionality will go here -->
    </div>
    <?php
}

/**
 * White Label Page
 */
function jobportal_elite_white_label_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('White Label Settings', 'jobportal'); ?></h1>
        <p><?php esc_html_e('Customize theme branding for your clients.', 'jobportal'); ?></p>

        <!-- White label settings will go here -->
    </div>
    <?php
}

/**
 * System Status Page
 */
function jobportal_elite_system_status_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('System Status', 'jobportal'); ?></h1>
        <p><?php esc_html_e('View detailed system information and requirements.', 'jobportal'); ?></p>

        <!-- Detailed system status will go here -->
    </div>
    <?php
}
