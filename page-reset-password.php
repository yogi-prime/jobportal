<?php
/**
 * Template Name: Reset Password
 * Frontend password reset page
 *
 * @package JobPortal
 */

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
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
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

.jobportal-auth-message.info {
    background: #f0f9ff;
    color: #075985;
    border: 2px solid #0ea5e9;
}

@media (max-width: 480px) {
    .jobportal-auth-card {
        padding: 32px 24px;
    }
}
</style>

<div class="jobportal-auth-page">
    <div class="jobportal-auth-container">
        <div class="jobportal-auth-card">
            <!-- Logo/Header -->
            <div class="jobportal-auth-logo">
                <h1><?php _e('Reset Password', 'jobportal'); ?></h1>
                <p><?php _e('Enter your email to receive reset instructions', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-auth-message info">
                <?php _e('We will send you an email with password reset instructions.', 'jobportal'); ?>
            </div>

            <!-- Reset Form -->
            <form class="jobportal-auth-form" method="post" action="<?php echo wp_lostpassword_url(); ?>">
                <div class="jobportal-form-group">
                    <label for="user_login"><?php _e('Username or Email', 'jobportal'); ?></label>
                    <input type="text" name="user_login" id="user_login" required>
                </div>

                <button type="submit" class="jobportal-submit-btn">
                    <?php _e('Send Reset Link', 'jobportal'); ?>
                </button>
            </form>

            <!-- Footer -->
            <div class="jobportal-auth-footer">
                <a href="<?php echo home_url('/login'); ?>">
                    <?php _e('← Back to Login', 'jobportal'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
