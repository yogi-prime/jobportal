<?php
/**
 * Login Gates
 * Require login for specific actions like applying to jobs and downloading resumes
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if user can apply to jobs
 */
function jobportal_can_apply_to_jobs() {
    return is_user_logged_in();
}

/**
 * Check if user can download resumes
 */
function jobportal_can_download_resume() {
    return is_user_logged_in();
}

/**
 * Display login gate message for job applications
 */
function jobportal_job_application_login_gate() {
    if (jobportal_can_apply_to_jobs()) {
        return;
    }
    ?>
    <div class="jobportal-login-gate">
        <div class="login-gate-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>
        <h3>Login Required</h3>
        <p>Please login to apply for this job. Create a free account to start applying!</p>
        <div class="login-gate-actions">
            <button class="btn btn-primary" onclick="showLoginModal()">
                Login / Register
            </button>
            <a href="<?php echo esc_url(home_url('/register')); ?>" class="btn btn-outline">
                Create Free Account
            </a>
        </div>
    </div>

    <style>
        .jobportal-login-gate {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border: 2px dashed #667eea;
            border-radius: 16px;
            padding: 48px 32px;
            text-align: center;
            margin: 32px 0;
        }

        .login-gate-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
        }

        .jobportal-login-gate h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 12px;
        }

        .jobportal-login-gate p {
            font-size: 16px;
            color: #64748b;
            margin: 0 0 24px;
        }

        .login-gate-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .login-gate-actions .btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .login-gate-actions .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .login-gate-actions .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .login-gate-actions .btn-outline {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
        }

        .login-gate-actions .btn-outline:hover {
            background: #667eea;
            color: white;
        }
    </style>

    <script>
        function showLoginModal() {
            jQuery('#jobportal-login-modal').fadeIn();
        }
    </script>
    <?php
}

/**
 * Display login gate for resume download
 */
function jobportal_resume_download_login_gate($resume_id = null) {
    if (jobportal_can_download_resume()) {
        return;
    }
    ?>
    <div class="jobportal-resume-login-gate">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
        <span>Login to download</span>
    </div>
    <?php
}

/**
 * AJAX: Check if user can apply
 */
function jobportal_ajax_check_can_apply() {
    $can_apply = jobportal_can_apply_to_jobs();

    if ($can_apply) {
        wp_send_json_success(array(
            'can_apply' => true,
            'message' => 'You can apply to this job',
        ));
    } else {
        wp_send_json_error(array(
            'can_apply' => false,
            'message' => 'Please login to apply for this job',
            'login_required' => true,
        ));
    }
}
add_action('wp_ajax_jobportal_check_can_apply', 'jobportal_ajax_check_can_apply');
add_action('wp_ajax_nopriv_jobportal_check_can_apply', 'jobportal_ajax_check_can_apply');

/**
 * Add login gate to job application form
 */
function jobportal_maybe_show_application_gate() {
    if (!jobportal_can_apply_to_jobs()) {
        // Hide the actual apply button
        echo '<style>.job-apply-form { display: none !important; }</style>';
        jobportal_job_application_login_gate();
    }
}
add_action('jobportal_before_job_application', 'jobportal_maybe_show_application_gate');

/**
 * Add JavaScript for login gate enforcement
 */
function jobportal_login_gate_scripts() {
    if (is_user_logged_in()) {
        return;
    }
    ?>
    <script>
        jQuery(document).ready(function($) {
            // Intercept job application attempts
            $(document).on('click', '.apply-job-btn, .job-apply-button, [href*="apply"]', function(e) {
                <?php if (!is_user_logged_in()): ?>
                // Check if this is a job apply link
                const href = $(this).attr('href');
                if (href && (href.includes('apply') || href.includes('job-application'))) {
                    e.preventDefault();
                    $('#jobportal-login-modal').fadeIn();
                    return false;
                }

                // Check if this is an apply button
                if ($(this).hasClass('apply-job-btn') || $(this).hasClass('job-apply-button')) {
                    e.preventDefault();
                    $('#jobportal-login-modal').fadeIn();
                    return false;
                }
                <?php endif; ?>
            });

            // Intercept resume download attempts
            $(document).on('click', '.download-resume-btn, .resume-download, [href*="download-resume"]', function(e) {
                <?php if (!is_user_logged_in()): ?>
                e.preventDefault();

                // Show custom message for resume downloads
                const originalModal = $('#jobportal-login-modal');
                originalModal.find('.modal-header h2').text('Login to Download Resume');
                originalModal.fadeIn();

                // Reset header after modal closes
                setTimeout(function() {
                    originalModal.find('.modal-header h2').text('Welcome Back!');
                }, 5000);

                return false;
                <?php endif; ?>
            });

            // Add login gate overlay to job cards
            $('.job-card, .single-job').each(function() {
                const applyBtn = $(this).find('.apply-job-btn, .job-apply-button');

                <?php if (!is_user_logged_in()): ?>
                if (applyBtn.length > 0) {
                    applyBtn.html('<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Login to Apply');
                    applyBtn.addClass('login-required-btn');
                }
                <?php endif; ?>
            });
        });
    </script>

    <style>
        .login-required-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none !important;
            position: relative;
            overflow: hidden;
        }

        .login-required-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .login-required-btn:hover::before {
            left: 100%;
        }

        .login-required-btn svg {
            display: inline-block;
            vertical-align: middle;
        }

        .jobportal-resume-login-gate {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .jobportal-resume-login-gate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Preview mode styling */
        .job-preview-mode {
            position: relative;
        }

        .job-preview-mode::after {
            content: 'Preview Mode - Login to Apply';
            position: absolute;
            top: 0;
            right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 0 0 0 8px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
    <?php
}
add_action('wp_footer', 'jobportal_login_gate_scripts', 999);

/**
 * Filter job application form to show login gate
 */
function jobportal_filter_job_application_form($form_html, $job_id) {
    if (!jobportal_can_apply_to_jobs()) {
        ob_start();
        jobportal_job_application_login_gate();
        return ob_get_clean();
    }
    return $form_html;
}
add_filter('jobportal_job_application_form', 'jobportal_filter_job_application_form', 10, 2);

/**
 * Add preview badge to job listings for non-logged-in users
 */
function jobportal_add_preview_badge() {
    if (!is_user_logged_in() && (is_singular('job') || is_post_type_archive('job'))) {
        ?>
        <style>
            .job-preview-badge {
                position: fixed;
                bottom: 80px;
                left: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 24px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 600;
                box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
                z-index: 9998;
                display: flex;
                align-items: center;
                gap: 8px;
                animation: slideInLeft 0.5s ease;
            }

            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-100px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .job-preview-badge svg {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }

            @media (max-width: 768px) {
                .job-preview-badge {
                    bottom: 70px;
                    left: 10px;
                    font-size: 12px;
                    padding: 10px 16px;
                }
            }
        </style>
        <div class="job-preview-badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
            Preview Mode - Login to Apply
        </div>
        <?php
    }
}
add_action('wp_footer', 'jobportal_add_preview_badge');

/**
 * Prevent job application submission for non-logged-in users
 */
function jobportal_validate_job_application_login() {
    if (!is_user_logged_in()) {
        wp_send_json_error(array(
            'message' => 'Please login to apply for this job',
            'login_required' => true,
        ));
    }
}
add_action('jobportal_before_process_application', 'jobportal_validate_job_application_login', 1);

/**
 * Prevent resume download for non-logged-in users
 */
function jobportal_validate_resume_download() {
    if (!is_user_logged_in()) {
        wp_die(
            '<h1>Login Required</h1><p>Please login to download resumes.</p>',
            'Login Required',
            array('response' => 403)
        );
    }
}
add_action('jobportal_before_resume_download', 'jobportal_validate_resume_download', 1);
