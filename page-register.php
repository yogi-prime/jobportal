<?php
/**
 * Template Name: Register Page
 * Frontend registration page with modern design
 *
 * @package JobPortal
 */

// Redirect if already logged in
if (is_user_logged_in()) {
    wp_redirect(home_url('/dashboard'));
    exit;
}

// Handle registration
if (isset($_POST['jobportal_register'])) {
    $errors = array();

    // Get form data
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = sanitize_text_field($_POST['user_type']);

    // Validation
    if (empty($username)) {
        $errors[] = __('Username is required', 'jobportal');
    } elseif (username_exists($username)) {
        $errors[] = __('Username already exists', 'jobportal');
    }

    if (empty($email) || !is_email($email)) {
        $errors[] = __('Valid email is required', 'jobportal');
    } elseif (email_exists($email)) {
        $errors[] = __('Email already registered', 'jobportal');
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = __('Password must be at least 6 characters', 'jobportal');
    } elseif ($password !== $confirm_password) {
        $errors[] = __('Passwords do not match', 'jobportal');
    }

    // If no errors, create user
    if (empty($errors)) {
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            // Set user role based on type
            $user = new WP_User($user_id);
            if ($user_type === 'employer') {
                $user->set_role('contributor'); // You can create custom role
            } else {
                $user->set_role('subscriber');
            }

            // Set additional user meta
            update_user_meta($user_id, 'user_type', $user_type);

            // Redirect to login with success message
            wp_redirect(home_url('/login?registered=success'));
            exit;
        } else {
            $errors[] = $user_id->get_error_message();
        }
    }
}

get_header();
?>

<style>
.jobportal-auth-page {
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 140px 20px 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.jobportal-auth-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    pointer-events: none;
}

.jobportal-auth-container {
    max-width: 480px;
    width: 100%;
    position: relative;
    z-index: 1;
}

.jobportal-auth-card {
    background: white;
    border-radius: 20px;
    padding: 48px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.jobportal-auth-logo {
    text-align: center;
    margin-bottom: 32px;
}

.jobportal-auth-logo h1 {
    font-size: 32px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 8px;
}

.jobportal-auth-logo p {
    color: #64748b;
    font-size: 15px;
}

.jobportal-auth-form {
    margin-bottom: 24px;
}

.jobportal-form-group {
    margin-bottom: 20px;
}

.jobportal-form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.jobportal-form-group input,
.jobportal-form-group select {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s;
    font-family: inherit;
}

.jobportal-form-group input:focus,
.jobportal-form-group select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.jobportal-user-type-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 20px;
}

.jobportal-user-type-option {
    position: relative;
}

.jobportal-user-type-option input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.jobportal-user-type-label {
    display: block;
    padding: 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
}

.jobportal-user-type-option input[type="radio"]:checked + .jobportal-user-type-label {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    font-weight: 700;
}

.jobportal-user-type-label .icon {
    font-size: 24px;
    margin-bottom: 4px;
}

.jobportal-submit-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
}

.jobportal-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
}

.jobportal-auth-divider {
    text-align: center;
    margin: 24px 0;
    position: relative;
}

.jobportal-auth-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e2e8f0;
}

.jobportal-auth-divider span {
    background: white;
    padding: 0 16px;
    color: #64748b;
    font-size: 14px;
    position: relative;
}

.jobportal-social-login {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
}

.jobportal-social-btn {
    flex: 1;
    padding: 12px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    background: white;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-weight: 600;
    color: #64748b;
}

.jobportal-social-btn:hover {
    border-color: #667eea;
    color: #667eea;
}

.jobportal-auth-footer {
    text-align: center;
    color: #64748b;
    font-size: 14px;
}

.jobportal-auth-footer a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
}

.jobportal-auth-footer a:hover {
    text-decoration: underline;
}

.jobportal-auth-message {
    padding: 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}

.jobportal-auth-message.error {
    background: #fef2f2;
    color: #991b1b;
    border: 2px solid #ef4444;
}

.jobportal-auth-message.success {
    background: #ecfdf5;
    color: #065f46;
    border: 2px solid #10b981;
}

.jobportal-terms {
    font-size: 13px;
    color: #64748b;
    text-align: center;
    margin-top: 16px;
}

.jobportal-terms a {
    color: #667eea;
    text-decoration: none;
}

@media (max-width: 480px) {
    .jobportal-auth-card {
        padding: 32px 24px;
    }

    .jobportal-social-login,
    .jobportal-user-type-selector {
        flex-direction: column;
        grid-template-columns: 1fr;
    }
}
</style>

<div class="jobportal-auth-page">
    <div class="jobportal-auth-container">
        <div class="jobportal-auth-card">
            <!-- Logo/Header -->
            <div class="jobportal-auth-logo">
                <h1><?php _e('Create Account', 'jobportal'); ?></h1>
                <p><?php _e('Join us and start your journey', 'jobportal'); ?></p>
            </div>

            <!-- Error Messages -->
            <?php if (!empty($errors)) : ?>
                <div class="jobportal-auth-message error">
                    <?php foreach ($errors as $error) : ?>
                        <div><?php echo esc_html($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- User Type Selection -->
            <div class="jobportal-user-type-selector">
                <div class="jobportal-user-type-option">
                    <input type="radio" name="user_type_display" id="type_candidate" value="candidate" checked>
                    <label for="type_candidate" class="jobportal-user-type-label">
                        <div class="icon">👤</div>
                        <div><?php _e('Candidate', 'jobportal'); ?></div>
                    </label>
                </div>
                <div class="jobportal-user-type-option">
                    <input type="radio" name="user_type_display" id="type_employer" value="employer">
                    <label for="type_employer" class="jobportal-user-type-label">
                        <div class="icon">💼</div>
                        <div><?php _e('Employer', 'jobportal'); ?></div>
                    </label>
                </div>
            </div>

            <!-- Registration Form -->
            <form class="jobportal-auth-form" method="post">
                <input type="hidden" name="user_type" id="user_type_hidden" value="candidate">

                <div class="jobportal-form-group">
                    <label for="username"><?php _e('Username', 'jobportal'); ?></label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div class="jobportal-form-group">
                    <label for="email"><?php _e('Email Address', 'jobportal'); ?></label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="jobportal-form-group">
                    <label for="password"><?php _e('Password', 'jobportal'); ?></label>
                    <input type="password" name="password" id="password" required minlength="6">
                </div>

                <div class="jobportal-form-group">
                    <label for="confirm_password"><?php _e('Confirm Password', 'jobportal'); ?></label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>

                <button type="submit" name="jobportal_register" class="jobportal-submit-btn">
                    <?php _e('Create Account', 'jobportal'); ?>
                </button>

                <div class="jobportal-terms">
                    <?php _e('By signing up, you agree to our', 'jobportal'); ?>
                    <a href="<?php echo home_url('/terms'); ?>"><?php _e('Terms', 'jobportal'); ?></a>
                    <?php _e('and', 'jobportal'); ?>
                    <a href="<?php echo home_url('/privacy'); ?>"><?php _e('Privacy Policy', 'jobportal'); ?></a>
                </div>
            </form>

            <!-- Divider -->
            <div class="jobportal-auth-divider">
                <span><?php _e('Or register with', 'jobportal'); ?></span>
            </div>

            <!-- Social Login -->
            <div class="jobportal-social-login">
                <button type="button" class="jobportal-social-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <?php _e('Google', 'jobportal'); ?>
                </button>
                <button type="button" class="jobportal-social-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#0077B5">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    <?php _e('LinkedIn', 'jobportal'); ?>
                </button>
            </div>

            <!-- Footer -->
            <div class="jobportal-auth-footer">
                <?php _e('Already have an account?', 'jobportal'); ?>
                <a href="<?php echo home_url('/login'); ?>">
                    <?php _e('Login', 'jobportal'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Sync user type selection
document.querySelectorAll('input[name="user_type_display"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('user_type_hidden').value = this.value;
    });
});
</script>

<?php get_footer(); ?>
