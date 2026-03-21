<?php
/**
 * Admin Page Creator - Simple Button in WordPress Admin
 *
 * @package JobPortal
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add admin notice with button to create pages
 * Only shows if pages are missing
 */
function jobportal_admin_create_pages_notice() {
    // Only show to admins
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check if key pages actually exist
    $key_pages = array('resume-builder', 'job-matcher', 'salary-calculator', 'interview-scheduler', 'ats-dashboard');
    $missing_pages = array();

    foreach ($key_pages as $slug) {
        if (!get_page_by_path($slug)) {
            $missing_pages[] = $slug;
        }
    }

    // If all pages exist, don't show notice
    if (empty($missing_pages)) {
        return;
    }

    // Handle page creation
    if (isset($_GET['jobportal_create_all_pages']) && check_admin_referer('jobportal_create_pages', 'jobportal_nonce')) {
        jobportal_force_create_all_pages();

        echo '<div class="notice notice-success is-dismissible">
            <h2>✅ Success! All Pages Created!</h2>
            <p><strong>JobPortal pages have been created successfully.</strong></p>
            <p>
                <a href="' . home_url('/resume-builder') . '" target="_blank" class="button">View Resume Builder</a>
                <a href="' . home_url('/job-matcher') . '" target="_blank" class="button">View Job Matcher</a>
                <a href="' . home_url('/salary-calculator') . '" target="_blank" class="button">View Salary Calculator</a>
                <a href="' . home_url('/jobs') . '" target="_blank" class="button">View Jobs Archive</a>
            </p>
        </div>';
        return;
    }

    // Show the create pages notice
    $nonce = wp_create_nonce('jobportal_create_pages');
    $create_url = add_query_arg(array(
        'jobportal_create_all_pages' => '1',
        'jobportal_nonce' => $nonce
    ), admin_url('index.php'));

    $missing_count = count($missing_pages);
    ?>
    <div class="notice notice-warning is-dismissible" style="padding: 20px; border-left: 4px solid #4facfe;">
        <h2 style="margin-top: 0;">⚠️ Missing Pages Detected</h2>
        <p style="font-size: 14px;"><strong><?php echo $missing_count; ?> JobPortal page(s) are missing.</strong> Click the button below to create them:</p>
        <ul style="list-style: disc; margin-left: 20px; font-size: 14px;">
            <li><strong>Resume Builder</strong> - /resume-builder</li>
            <li><strong>Job Matcher</strong> - /job-matcher</li>
            <li><strong>Salary Calculator</strong> - /salary-calculator</li>
            <li><strong>Interview Scheduler</strong> - /interview-scheduler</li>
            <li><strong>ATS Dashboard</strong> - /ats-dashboard</li>
            <li><strong>Browse Jobs</strong> - /jobs (Job Archive)</li>
            <li><strong>Post a Job</strong> - /post-job</li>
            <li><strong>About, Contact, Blog</strong> pages</li>
        </ul>
        <p>
            <a href="<?php echo esc_url($create_url); ?>" class="button button-primary button-hero" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; text-shadow: none; box-shadow: 0 4px 12px rgba(79, 172, 254, 0.3);">
                ✨ Create All Pages Now
            </a>
        </p>
        <p style="font-size: 12px; color: #666;">
            <em>Note: This is safe to run multiple times. Existing pages won't be duplicated.</em>
        </p>
    </div>
    <?php
}
add_action('admin_notices', 'jobportal_admin_create_pages_notice');

/**
 * Force create all pages
 */
function jobportal_force_create_all_pages() {
    // Delete the option to allow re-creation
    delete_option('jobportal_pages_created');

    // Include the page seeder if not already loaded
    if (!function_exists('jobportal_create_essential_pages')) {
        require_once get_template_directory() . '/inc/page-seeder.php';
    }

    // Create pages
    jobportal_create_essential_pages();

    // Flush rewrite rules
    flush_rewrite_rules();

    return true;
}

/**
 * Add a menu item in WordPress admin
 */
function jobportal_add_create_pages_menu() {
    add_theme_page(
        'Create Pages',
        'Create Pages',
        'manage_options',
        'jobportal-create-pages',
        'jobportal_create_pages_admin_page'
    );
}
add_action('admin_menu', 'jobportal_add_create_pages_menu');

/**
 * Admin page for creating pages
 */
function jobportal_create_pages_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Handle form submission
    if (isset($_POST['create_pages']) && check_admin_referer('jobportal_create_pages_action', 'jobportal_create_pages_nonce')) {
        jobportal_force_create_all_pages();
        echo '<div class="notice notice-success"><p><strong>✅ All pages created successfully!</strong></p></div>';
    }

    ?>
    <div class="wrap" style="max-width: 1200px;">
        <h1 style="font-size: 32px; margin-bottom: 20px;">🚀 JobPortal - Create Essential Pages</h1>

        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <h2 style="margin-top: 0;">📋 Pages That Will Be Created</h2>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 30px 0;">
                <div style="padding: 20px; background: #f0f9ff; border-left: 4px solid #4facfe; border-radius: 4px;">
                    <h3 style="margin-top: 0; color: #4facfe;">🎯 Elite Feature Pages</h3>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li><strong>Resume Builder</strong> - Professional resume creator</li>
                        <li><strong>Job Matcher</strong> - AI-powered job matching</li>
                        <li><strong>Salary Calculator</strong> - Market value estimator</li>
                        <li><strong>Interview Scheduler</strong> - Calendar booking system</li>
                        <li><strong>ATS Dashboard</strong> - Applicant tracking system</li>
                    </ul>
                </div>

                <div style="padding: 20px; background: #f0fdf4; border-left: 4px solid #10b981; border-radius: 4px;">
                    <h3 style="margin-top: 0; color: #10b981;">📄 Essential Pages</h3>
                    <ul style="margin: 0; padding-left: 20px;">
                        <li><strong>Browse Jobs</strong> - Job archive (/jobs)</li>
                        <li><strong>Post a Job</strong> - Job submission form</li>
                        <li><strong>Blog</strong> - Blog page</li>
                        <li><strong>About Us</strong> - Company info</li>
                        <li><strong>Contact</strong> - Contact form</li>
                    </ul>
                </div>
            </div>

            <form method="post" action="">
                <?php wp_nonce_field('jobportal_create_pages_action', 'jobportal_create_pages_nonce'); ?>

                <p style="background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;">
                    <strong>⚠️ Important:</strong> This will create all pages. If a page already exists, it won't be duplicated.
                </p>

                <p>
                    <button type="submit" name="create_pages" class="button button-primary button-hero" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; padding: 15px 40px; font-size: 16px; height: auto; box-shadow: 0 4px 12px rgba(79, 172, 254, 0.3);">
                        ✨ Create All Pages Now
                    </button>
                </p>
            </form>
        </div>

        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0;">🔧 Troubleshooting</h2>

            <h3>Pages showing 404 error?</h3>
            <ol>
                <li>Go to <strong>Settings → Permalinks</strong></li>
                <li>Click <strong>Save Changes</strong> (don't change anything)</li>
                <li>This will flush rewrite rules and fix 404 errors</li>
            </ol>

            <h3>Want to recreate pages?</h3>
            <p>Click the button above - it will safely create any missing pages without duplicating existing ones.</p>

            <h3>Check if pages exist:</h3>
            <ul style="list-style: none; padding: 0;">
                <li>✅ <a href="<?php echo home_url('/resume-builder'); ?>" target="_blank">Resume Builder</a></li>
                <li>✅ <a href="<?php echo home_url('/job-matcher'); ?>" target="_blank">Job Matcher</a></li>
                <li>✅ <a href="<?php echo home_url('/salary-calculator'); ?>" target="_blank">Salary Calculator</a></li>
                <li>✅ <a href="<?php echo home_url('/interview-scheduler'); ?>" target="_blank">Interview Scheduler</a></li>
                <li>✅ <a href="<?php echo home_url('/ats-dashboard'); ?>" target="_blank">ATS Dashboard</a></li>
                <li>✅ <a href="<?php echo home_url('/jobs'); ?>" target="_blank">Browse Jobs</a></li>
                <li>✅ <a href="<?php echo home_url('/post-job'); ?>" target="_blank">Post a Job</a></li>
            </ul>
        </div>
    </div>
    <?php
}
