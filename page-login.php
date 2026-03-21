<?php
/**
 * Template Name: Login Page
 * Frontend login page with modern design
 *
 * @package JobPortal
 */

// Redirect if already logged in
if (is_user_logged_in()) {
    wp_redirect(home_url('/dashboard'));
    exit;
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
    background: linear-gradient(135deg, #1B3A5F 0%, #00B4D8 50%, #00C896 100%);
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

.jobportal-form-group input {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s;
    font-family: inherit;
}

.jobportal-form-group input:focus {
    outline: none;
    border-color: #00B4D8;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.jobportal-form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    font-size: 14px;
}

.jobportal-checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.jobportal-checkbox-wrapper input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.jobportal-forgot-link {
    color: #00B4D8;
    text-decoration: none;
    font-weight: 600;
}

.jobportal-forgot-link:hover {
    text-decoration: underline;
}

.jobportal-submit-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1B3A5F 0%, #00B4D8 50%, #00C896 100%);
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
    border-color: #00B4D8;
    color: #00B4D8;
}

.jobportal-auth-footer {
    text-align: center;
    color: #64748b;
    font-size: 14px;
}

.jobportal-auth-footer a {
    color: #00B4D8;
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

@media (max-width: 480px) {
    .jobportal-auth-card {
        padding: 32px 24px;
    }

    .jobportal-social-login {
        flex-direction: column;
    }
}
</style>

<div class="jobportal-auth-page">
    <div class="jobportal-auth-container">
        <div class="jobportal-auth-card">
            <!-- Logo/Header -->
            <div class="jobportal-auth-logo">
                <h1><?php _e('Welcome Back', 'jobportal'); ?></h1>
                <p><?php _e('Login to access your account', 'jobportal'); ?></p>
            </div>

            <!-- Login Error Messages -->
            <?php if (isset($_GET['login']) && $_GET['login'] == 'failed') : ?>
                <div class="jobportal-auth-message error">
                    <?php _e('Invalid username or password. Please try again.', 'jobportal'); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['login']) && $_GET['login'] == 'empty') : ?>
                <div class="jobportal-auth-message error">
                    <?php _e('Please enter both username and password.', 'jobportal'); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['registered']) && $_GET['registered'] == 'success') : ?>
                <div class="jobportal-auth-message success">
                    <?php _e('Registration successful! Please login.', 'jobportal'); ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form class="jobportal-auth-form" method="post" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>">
                <div class="jobportal-form-group">
                    <label for="user_login"><?php _e('Username or Email', 'jobportal'); ?></label>
                    <input type="text" name="log" id="user_login" required>
                </div>

                <div class="jobportal-form-group">
                    <label for="user_pass"><?php _e('Password', 'jobportal'); ?></label>
                    <input type="password" name="pwd" id="user_pass" required>
                </div>

                <div class="jobportal-form-options">
                    <div class="jobportal-checkbox-wrapper">
                        <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                        <label for="rememberme" style="margin: 0; font-weight: 400;"><?php _e('Remember me', 'jobportal'); ?></label>
                    </div>
                    <a href="<?php echo wp_lostpassword_url(); ?>" class="jobportal-forgot-link">
                        <?php _e('Forgot Password?', 'jobportal'); ?>
                    </a>
                </div>

                <input type="hidden" name="redirect_to" value="<?php echo home_url('/dashboard'); ?>">

                <button type="submit" class="jobportal-submit-btn">
                    <?php _e('Login', 'jobportal'); ?>
                </button>
            </form>

            <!-- Divider -->
            <div class="jobportal-auth-divider">
                <span><?php _e('Or continue with', 'jobportal'); ?></span>
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
                <?php _e("Don't have an account?", 'jobportal'); ?>
                <a href="<?php echo home_url('/register'); ?>">
                    <?php _e('Sign up', 'jobportal'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
