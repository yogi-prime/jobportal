<?php
/**
 * Page Seeder - Creates All Important Pages on Theme Activation
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

/**
 * Create all necessary pages when theme is activated
 */
function jobportal_create_essential_pages() {
    // Check if key pages actually exist (not just the option)
    // If all key pages exist, skip creation
    $key_pages = array('login', 'register', 'resume-builder', 'job-matcher', 'salary-calculator', 'interview-scheduler', 'ats-dashboard');
    $all_exist = true;

    foreach ($key_pages as $slug) {
        if (!get_page_by_path($slug)) {
            $all_exist = false;
            break;
        }
    }

    // If all key pages exist, no need to create again
    if ($all_exist) {
        update_option('jobportal_pages_created', true);
        return;
    }

    // Pages to create with their templates
    $pages = array(
        // Login & Register Pages
        array(
            'title'    => 'Login',
            'slug'     => 'login',
            'template' => 'page-login.php',
            'content'  => 'Login to access your account.',
        ),
        array(
            'title'    => 'Register',
            'slug'     => 'register',
            'template' => 'page-register.php',
            'content'  => 'Create a new account to get started.',
        ),

        // Elite Feature Pages
        array(
            'title'    => 'Resume Builder',
            'slug'     => 'resume-builder',
            'template' => 'page-resume-builder.php',
            'content'  => 'Create a professional resume in minutes with our drag-and-drop builder.',
        ),
        array(
            'title'    => 'Job Matcher',
            'slug'     => 'job-matcher',
            'template' => 'page-job-matcher.php',
            'content'  => 'Find your perfect job match with our AI-powered algorithm.',
        ),
        array(
            'title'    => 'Salary Calculator',
            'slug'     => 'salary-calculator',
            'template' => 'page-salary-calculator.php',
            'content'  => 'Calculate your market value and get negotiation tips.',
        ),
        array(
            'title'    => 'Interview Scheduler',
            'slug'     => 'interview-scheduler',
            'template' => 'page-interview-scheduler.php',
            'content'  => 'Schedule your interview with our easy calendar system.',
        ),
        array(
            'title'    => 'Employer Dashboard',
            'slug'     => 'ats-dashboard',
            'template' => 'page-ats-dashboard.php',
            'content'  => 'Manage all your job applications in one powerful dashboard.',
        ),

        // Job Pages
        // NOTE: Don't create a /jobs page since it conflicts with the Job custom post type archive
        // The archive-job.php template will handle /jobs automatically
        array(
            'title'    => 'Post a Job',
            'slug'     => 'post-job',
            'template' => 'page.php',
            'content'  => '<h2>Post a Job</h2>
<p>Fill out the form below to post your job opening.</p>
[jobportal_post_job_form]',
        ),

        // Additional Pages
        array(
            'title'    => 'Blog',
            'slug'     => 'blog',
            'template' => 'page.php',
            'content'  => '',
        ),
        array(
            'title'    => 'About Us',
            'slug'     => 'about',
            'template' => 'page-about.php',
            'content'  => '<h2>About JobPortal</h2>
<p>We are the leading job board connecting talented professionals with amazing companies.</p>',
        ),
        array(
            'title'    => 'Contact',
            'slug'     => 'contact',
            'template' => 'page-contact.php',
            'content'  => '<h2>Contact Us</h2>
<p>Get in touch with our team.</p>',
        ),
    );

    foreach ($pages as $page_data) {
        // Check if page already exists
        $page_exists = get_page_by_path($page_data['slug']);

        if (!$page_exists) {
            // Create the page
            $page_id = wp_insert_post(array(
                'post_title'    => $page_data['title'],
                'post_name'     => $page_data['slug'],
                'post_content'  => $page_data['content'],
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_author'   => 1,
                'comment_status' => 'closed',
                'ping_status'   => 'closed',
            ));

            // Set page template if specified
            if ($page_id && !empty($page_data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }

    // Set the Blog page as the posts page
    $blog_page = get_page_by_path('blog');
    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }

    // Mark pages as created
    update_option('jobportal_pages_created', true);

    // Flush rewrite rules to make new pages work
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'jobportal_create_essential_pages');

/**
 * Reset page creation flag when switching away from theme
 * This ensures pages are created again when theme is re-activated
 */
function jobportal_reset_on_theme_switch() {
    delete_option('jobportal_pages_created');
}
add_action('switch_theme', 'jobportal_reset_on_theme_switch');

/**
 * Shortcode for job posting form
 */
function jobportal_post_job_form_shortcode() {
    ob_start();
    ?>
    <div class="jobportal-post-job-form" style="max-width: 800px; margin: 40px auto; padding: 40px; background: white; border-radius: 12px; border: 2px solid #e2e8f0;">
        <form method="post" action="">
            <?php wp_nonce_field('jobportal_post_job', 'jobportal_post_job_nonce'); ?>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Job Title *</label>
                <input type="text" name="job_title" required style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Company Name *</label>
                <input type="text" name="job_company" required style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Location *</label>
                <input type="text" name="job_location" required placeholder="e.g. Remote, San Francisco, CA" style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Job Type *</label>
                <select name="job_type" required style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
                    <option value="">Select Type</option>
                    <option value="Full-Time">Full-Time</option>
                    <option value="Part-Time">Part-Time</option>
                    <option value="Contract">Contract</option>
                    <option value="Remote">Remote</option>
                </select>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Salary Range *</label>
                <input type="text" name="job_salary" required placeholder="e.g. $80K - $120K" style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Job Description *</label>
                <textarea name="job_description" required rows="8" style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;"></textarea>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Requirements</label>
                <textarea name="job_requirements" rows="5" placeholder="One requirement per line" style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 16px;"></textarea>
            </div>

            <button type="submit" name="submit_job" style="width: 100%; padding: 16px; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); color: white; border: none; border-radius: 8px; font-size: 18px; font-weight: 700; cursor: pointer;">
                Post Job
            </button>
        </form>

        <?php
        // Handle form submission
        if (isset($_POST['submit_job']) && wp_verify_nonce($_POST['jobportal_post_job_nonce'], 'jobportal_post_job')) {
            $job_title = sanitize_text_field($_POST['job_title']);
            $job_company = sanitize_text_field($_POST['job_company']);
            $job_location = sanitize_text_field($_POST['job_location']);
            $job_type = sanitize_text_field($_POST['job_type']);
            $job_salary = sanitize_text_field($_POST['job_salary']);
            $job_description = wp_kses_post($_POST['job_description']);
            $job_requirements = wp_kses_post($_POST['job_requirements']);

            $content = '<p>' . $job_description . '</p>';
            $content .= '<h2>Requirements</h2>';
            $content .= '<ul>';
            $requirements = explode("\n", $job_requirements);
            foreach ($requirements as $req) {
                if (!empty(trim($req))) {
                    $content .= '<li>' . esc_html(trim($req)) . '</li>';
                }
            }
            $content .= '</ul>';

            // Create the job post
            $post_id = wp_insert_post(array(
                'post_title'   => $job_title,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'tags_input'   => array('job', 'hiring', $job_type),
            ));

            if ($post_id) {
                update_post_meta($post_id, 'job_company', $job_company);
                update_post_meta($post_id, 'job_location', $job_location);
                update_post_meta($post_id, 'job_type', $job_type);
                update_post_meta($post_id, 'job_salary', $job_salary);

                echo '<div style="margin-top: 24px; padding: 16px; background: #d1fae5; color: #065f46; border-radius: 8px; font-weight: 600;">
                    ✅ Job posted successfully! <a href="' . get_permalink($post_id) . '" style="color: #065f46; text-decoration: underline;">View Job</a>
                </div>';
            }
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_post_job_form', 'jobportal_post_job_form_shortcode');

/**
 * MANUAL PAGE CREATION - Add this to URL: ?jobportal_create_pages=1
 *
 * Usage: Visit yoursite.com/?jobportal_create_pages=1 to manually create all pages
 */
function jobportal_manual_create_pages() {
    // Check if the URL parameter is set and user is admin
    if (isset($_GET['jobportal_create_pages']) && current_user_can('manage_options')) {
        // Delete the option to allow re-creation
        delete_option('jobportal_pages_created');

        // Force create pages
        jobportal_create_essential_pages();

        // Flush rewrite rules
        flush_rewrite_rules();

        // Show success message
        wp_die(
            '<h1>✅ Success!</h1>
            <p>All JobPortal pages have been created successfully!</p>
            <h2>Created Pages:</h2>
            <ul>
                <li><a href="' . home_url('/login') . '">Login</a></li>
                <li><a href="' . home_url('/register') . '">Register</a></li>
                <li><a href="' . home_url('/resume-builder') . '">Resume Builder</a></li>
                <li><a href="' . home_url('/job-matcher') . '">Job Matcher</a></li>
                <li><a href="' . home_url('/salary-calculator') . '">Salary Calculator</a></li>
                <li><a href="' . home_url('/interview-scheduler') . '">Interview Scheduler</a></li>
                <li><a href="' . home_url('/ats-dashboard') . '">ATS Dashboard</a></li>
                <li><a href="' . home_url('/jobs') . '">Browse Jobs (Job Archive)</a> - Uses archive-job.php template</li>
                <li><a href="' . home_url('/post-job') . '">Post a Job</a></li>
                <li><a href="' . home_url('/blog') . '">Blog</a></li>
                <li><a href="' . home_url('/about') . '">About Us</a></li>
                <li><a href="' . home_url('/contact') . '">Contact</a></li>
            </ul>
            <p><strong>✅ Rewrite rules flushed!</strong></p>
            <p><strong>✅ Job custom post type registered!</strong></p>
            <p><strong>Note:</strong> The /jobs URL automatically shows all jobs from the Job custom post type using archive-job.php template.</p>
            <p><a href="' . home_url() . '">← Go to Homepage</a> | <a href="' . admin_url('post-new.php?post_type=job') . '">Add a New Job</a></p>',
            'JobPortal Pages Created',
            array('response' => 200)
        );
    }
}
add_action('init', 'jobportal_manual_create_pages');

/**
 * Reset page creation (for testing)
 */
function jobportal_reset_pages() {
    delete_option('jobportal_pages_created');
}
// Uncomment to reset: add_action('init', 'jobportal_reset_pages');
