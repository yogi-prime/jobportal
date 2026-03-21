<?php
/**
 * Login/Register Modal Popup
 * Shows on first visit to encourage registration
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Login Modal to Footer
 */
function jobportal_login_modal() {
    // Don't show if user is already logged in
    if (is_user_logged_in()) {
        return;
    }

    // Check if modal was already shown (session/cookie)
    $modal_shown = isset($_COOKIE['jobportal_modal_shown']);

    // Show modal after 3 seconds for first-time visitors
    ?>
    <div id="jobportal-login-modal" class="jobportal-modal" style="display: <?php echo $modal_shown ? 'none' : 'none'; ?>;">
        <div class="jobportal-modal-overlay"></div>
        <div class="jobportal-modal-content">
            <button class="jobportal-modal-close" id="close-login-modal">×</button>

            <div class="jobportal-modal-tabs">
                <button class="jobportal-modal-tab active" data-tab="login">Login</button>
                <button class="jobportal-modal-tab" data-tab="register">Register</button>
            </div>

            <!-- Login Form -->
            <div class="jobportal-modal-tab-content active" id="modal-login">
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="font-size: 64px; margin-bottom: 12px;">👋</div>
                    <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                        Welcome Back!
                    </h2>
                    <p style="color: #64748b;">Sign in to continue your job search</p>
                </div>

                <form id="modal-login-form">
                    <div class="form-group">
                        <label for="modal_login_email">Email Address</label>
                        <input type="email" id="modal_login_email" name="email" required placeholder="your@email.com">
                    </div>

                    <div class="form-group">
                        <label for="modal_login_password">Password</label>
                        <input type="password" id="modal_login_password" name="password" required placeholder="Enter password">
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #64748b; font-size: 14px;">
                            <input type="checkbox" name="remember" style="width: auto;">
                            Remember me
                        </label>
                        <a href="<?php echo wp_lostpassword_url(); ?>" style="color: #00B4D8; text-decoration: none; font-size: 14px; font-weight: 600;">
                            Forgot Password?
                        </a>
                    </div>

                    <button type="submit" class="jobportal-btn jobportal-btn-primary" style="width: 100%; padding: 14px;">
                        🔑 Sign In
                    </button>

                    <div id="modal-login-message" style="margin-top: 16px; display: none;"></div>
                </form>

                <!-- Social Login -->
                <?php jobportal_display_social_login_buttons(); ?>

                <p style="text-align: center; margin-top: 20px; color: #64748b; font-size: 14px;">
                    Don't have an account?
                    <button class="switch-modal-tab" data-tab="register" style="background: none; border: none; color: #00B4D8; font-weight: 700; cursor: pointer;">
                        Register Now
                    </button>
                </p>
            </div>

            <!-- Register Form -->
            <div class="jobportal-modal-tab-content" id="modal-register">
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="font-size: 64px; margin-bottom: 12px;">🚀</div>
                    <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                        Create Account
                    </h2>
                    <p style="color: #64748b;">Join thousands of job seekers</p>
                </div>

                <form id="modal-register-form">
                    <div class="form-group">
                        <label for="modal_register_name">Full Name</label>
                        <input type="text" id="modal_register_name" name="name" required placeholder="John Doe">
                    </div>

                    <div class="form-group">
                        <label for="modal_register_email">Email Address</label>
                        <input type="email" id="modal_register_email" name="email" required placeholder="your@email.com">
                    </div>

                    <div class="form-group">
                        <label for="modal_register_password">Password</label>
                        <input type="password" id="modal_register_password" name="password" required placeholder="Minimum 6 characters">
                    </div>

                    <div class="form-group">
                        <label>I am a:</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <label style="
                                padding: 16px;
                                border: 2px solid #e5e7eb;
                                border-radius: 12px;
                                cursor: pointer;
                                text-align: center;
                                transition: all 0.3s;
                            " class="user-type-option">
                                <input type="radio" name="user_type" value="candidate" checked style="display: none;">
                                <div style="font-size: 32px; margin-bottom: 8px;">🧑‍💼</div>
                                <div style="font-weight: 700; color: #1e293b;">Job Seeker</div>
                            </label>
                            <label style="
                                padding: 16px;
                                border: 2px solid #e5e7eb;
                                border-radius: 12px;
                                cursor: pointer;
                                text-align: center;
                                transition: all 0.3s;
                            " class="user-type-option">
                                <input type="radio" name="user_type" value="employer" style="display: none;">
                                <div style="font-size: 32px; margin-bottom: 8px;">🏢</div>
                                <div style="font-weight: 700; color: #1e293b;">Employer</div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="jobportal-btn jobportal-btn-primary" style="width: 100%; padding: 14px;">
                        ✨ Create Account
                    </button>

                    <div id="modal-register-message" style="margin-top: 16px; display: none;"></div>
                </form>

                <!-- Social Login -->
                <?php jobportal_display_social_login_buttons(); ?>

                <p style="text-align: center; margin-top: 20px; color: #64748b; font-size: 14px;">
                    Already have an account?
                    <button class="switch-modal-tab" data-tab="login" style="background: none; border: none; color: #00B4D8; font-weight: 700; cursor: pointer;">
                        Sign In
                    </button>
                </p>
            </div>
        </div>
    </div>

    <style>
    .jobportal-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 999999;
        animation: fadeIn 0.3s;
    }

    .jobportal-modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(8px);
    }

    .jobportal-modal-content {
        position: relative;
        max-width: 480px;
        width: 90%;
        background: white;
        border-radius: 24px;
        padding: 40px;
        margin: 50px auto;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .jobportal-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border: none;
        background: #f8fafc;
        border-radius: 50%;
        font-size: 28px;
        color: #64748b;
        cursor: pointer;
        transition: all 0.3s;
        line-height: 1;
    }

    .jobportal-modal-close:hover {
        background: #ef4444;
        color: white;
        transform: rotate(90deg);
    }

    .jobportal-modal-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 32px;
        background: #f8fafc;
        padding: 6px;
        border-radius: 12px;
    }

    .jobportal-modal-tab {
        flex: 1;
        padding: 12px;
        border: none;
        background: transparent;
        color: #64748b;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .jobportal-modal-tab.active {
        background: white;
        color: #00B4D8;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .jobportal-modal-tab-content {
        display: none;
    }

    .jobportal-modal-tab-content.active {
        display: block;
        animation: fadeIn 0.3s;
    }

    .jobportal-modal .form-group {
        margin-bottom: 20px;
    }

    .jobportal-modal .form-group label {
        display: block;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .jobportal-modal .form-group input[type="text"],
    .jobportal-modal .form-group input[type="email"],
    .jobportal-modal .form-group input[type="password"] {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .jobportal-modal .form-group input:focus {
        border-color: #00B4D8;
        outline: none;
        box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
    }

    .user-type-option input:checked ~ * {
        color: #00B4D8 !important;
    }

    .user-type-option:has(input:checked) {
        background: #eff6ff;
        border-color: #00B4D8 !important;
    }

    .user-type-option:hover {
        border-color: #bfdbfe !important;
        background: #f8fafc;
    }

    /* Laptop screens - reduce height and spacing */
    @media (max-height: 800px) {
        .jobportal-modal-content {
            padding: 24px 32px;
            margin: 30px auto;
            max-height: 85vh;
        }

        .jobportal-modal-content > div[style*="text-align: center"] {
            margin-bottom: 16px !important;
        }

        .jobportal-modal-content > div[style*="text-align: center"] > div[style*="font-size: 64px"] {
            font-size: 48px !important;
            margin-bottom: 8px !important;
        }

        .jobportal-modal-content h2 {
            font-size: 22px !important;
            margin-bottom: 4px !important;
        }

        .jobportal-modal .form-group {
            margin-bottom: 14px;
        }

        .jobportal-modal .form-group input[type="text"],
        .jobportal-modal .form-group input[type="email"],
        .jobportal-modal .form-group input[type="password"] {
            padding: 10px 14px;
            font-size: 14px;
        }
    }

    @media (max-width: 640px) {
        .jobportal-modal-content {
            padding: 24px;
            margin: 20px auto;
        }
    }
    </style>

    <script>
    jQuery(document).ready(function($) {
        // Show modal after 3 seconds for first-time visitors
        <?php if (!$modal_shown) : ?>
        setTimeout(function() {
            $('#jobportal-login-modal').fadeIn();
        }, 3000);
        <?php endif; ?>

        // Close modal
        $('#close-login-modal, .jobportal-modal-overlay').on('click', function() {
            $('#jobportal-login-modal').fadeOut();
            // Set cookie to not show again for 7 days
            document.cookie = 'jobportal_modal_shown=1; max-age=' + (7 * 24 * 60 * 60) + '; path=/';
        });

        // Switch tabs
        $('.jobportal-modal-tab, .switch-modal-tab').on('click', function() {
            var tab = $(this).data('tab');

            $('.jobportal-modal-tab').removeClass('active');
            $('.jobportal-modal-tab[data-tab="' + tab + '"]').addClass('active');

            $('.jobportal-modal-tab-content').removeClass('active');
            $('#modal-' + tab).addClass('active');
        });

        // Modal Login Form
        $('#modal-login-form').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                action: 'jobportal_modal_login',
                nonce: jobportalAjax.nonce,
                email: $('#modal_login_email').val(),
                password: $('#modal_login_password').val(),
                remember: $('input[name="remember"]').is(':checked')
            };

            $.ajax({
                url: jobportalAjax.ajaxurl,
                type: 'POST',
                data: formData,
                success: function(response) {
                    var message = $('#modal-login-message');
                    if (response.success) {
                        message.html('<div style="padding: 12px; background: #d1fae5; color: #065f46; border-radius: 8px; text-align: center;">✅ Login successful! Redirecting...</div>').fadeIn();
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        message.html('<div style="padding: 12px; background: #fee2e2; color: #991b1b; border-radius: 8px; text-align: center;">❌ ' + response.data.message + '</div>').fadeIn();
                    }
                }
            });
        });

        // Modal Register Form
        $('#modal-register-form').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                action: 'jobportal_modal_register',
                nonce: jobportalAjax.nonce,
                name: $('#modal_register_name').val(),
                email: $('#modal_register_email').val(),
                password: $('#modal_register_password').val(),
                user_type: $('input[name="user_type"]:checked').val()
            };

            $.ajax({
                url: jobportalAjax.ajaxurl,
                type: 'POST',
                data: formData,
                success: function(response) {
                    var message = $('#modal-register-message');
                    if (response.success) {
                        message.html('<div style="padding: 12px; background: #d1fae5; color: #065f46; border-radius: 8px; text-align: center;">✅ Account created! Redirecting...</div>').fadeIn();
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        message.html('<div style="padding: 12px; background: #fee2e2; color: #991b1b; border-radius: 8px; text-align: center;">❌ ' + response.data.message + '</div>').fadeIn();
                    }
                }
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'jobportal_login_modal');

/**
 * AJAX: Modal Login
 */
function jobportal_ajax_modal_login() {
    check_ajax_referer('jobportal_ajax_nonce', 'nonce');

    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) && $_POST['remember'] === 'true';

    $user = wp_authenticate($email, $password);

    if (is_wp_error($user)) {
        wp_send_json_error(array('message' => 'Invalid email or password'));
    }

    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, $remember);

    wp_send_json_success(array('message' => 'Login successful'));
}
add_action('wp_ajax_nopriv_jobportal_modal_login', 'jobportal_ajax_modal_login');

/**
 * AJAX: Modal Register
 */
function jobportal_ajax_modal_register() {
    check_ajax_referer('jobportal_ajax_nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $user_type = sanitize_text_field($_POST['user_type']);

    // Validate
    if (empty($name) || empty($email) || empty($password)) {
        wp_send_json_error(array('message' => 'Please fill all fields'));
    }

    if (email_exists($email)) {
        wp_send_json_error(array('message' => 'Email already registered'));
    }

    if (strlen($password) < 6) {
        wp_send_json_error(array('message' => 'Password must be at least 6 characters'));
    }

    // Create user
    $username = sanitize_user(str_replace(' ', '', strtolower($name)));

    // Make username unique
    $base_username = $username;
    $counter = 1;
    while (username_exists($username)) {
        $username = $base_username . $counter;
        $counter++;
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error(array('message' => 'Registration failed'));
    }

    // Update user data
    wp_update_user(array(
        'ID' => $user_id,
        'display_name' => $name,
        'first_name' => $name,
    ));

    // Set user type
    update_user_meta($user_id, '_user_type', $user_type);

    // Generate referral code
    jobportal_generate_referral_code($user_id);

    // Login user
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);

    wp_send_json_success(array('message' => 'Account created successfully'));
}
add_action('wp_ajax_nopriv_jobportal_modal_register', 'jobportal_ajax_modal_register');

/**
 * Show Login Modal for Specific Actions
 */
function jobportal_show_login_required_modal() {
    if (is_user_logged_in()) {
        return;
    }
    ?>
    <script>
    function showLoginModal() {
        jQuery('#jobportal-login-modal').fadeIn();
    }
    </script>
    <?php
}
add_action('wp_footer', 'jobportal_show_login_required_modal');
