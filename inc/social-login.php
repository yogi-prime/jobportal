<?php
/**
 * Social Login Integration
 * Google and LinkedIn OAuth authentication
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Social Login Settings Page
 */
function jobportal_social_login_settings_page() {
    add_submenu_page(
        'options-general.php',
        __('Social Login Settings', 'jobportal'),
        __('Social Login', 'jobportal'),
        'manage_options',
        'jobportal-social-login',
        'jobportal_social_login_settings_page_html'
    );
}
add_action('admin_menu', 'jobportal_social_login_settings_page');

/**
 * Social Login Settings Page HTML
 */
function jobportal_social_login_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Save settings
    if (isset($_POST['jobportal_social_login_nonce']) &&
        wp_verify_nonce($_POST['jobportal_social_login_nonce'], 'jobportal_social_login_save')) {

        update_option('jobportal_google_client_id', sanitize_text_field($_POST['google_client_id']));
        update_option('jobportal_google_client_secret', sanitize_text_field($_POST['google_client_secret']));
        update_option('jobportal_linkedin_client_id', sanitize_text_field($_POST['linkedin_client_id']));
        update_option('jobportal_linkedin_client_secret', sanitize_text_field($_POST['linkedin_client_secret']));
        update_option('jobportal_social_login_enabled', isset($_POST['social_login_enabled']) ? '1' : '0');

        echo '<div class="notice notice-success"><p>' . __('Settings saved!', 'jobportal') . '</p></div>';
    }

    $google_client_id = get_option('jobportal_google_client_id', '');
    $google_client_secret = get_option('jobportal_google_client_secret', '');
    $linkedin_client_id = get_option('jobportal_linkedin_client_id', '');
    $linkedin_client_secret = get_option('jobportal_linkedin_client_secret', '');
    $social_login_enabled = get_option('jobportal_social_login_enabled', '0');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <div style="max-width: 800px;">
            <div style="background: white; padding: 24px; border-radius: 8px; margin: 20px 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h2 style="margin-top: 0;">📱 Social Login Configuration</h2>
                <p style="color: #666;">Allow users to register and login using their Google or LinkedIn accounts. This feature requires API credentials from each provider.</p>
            </div>

            <form method="post" action="">
                <?php wp_nonce_field('jobportal_social_login_save', 'jobportal_social_login_nonce'); ?>

                <!-- Enable/Disable -->
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="social_login_enabled"><?php _e('Enable Social Login', 'jobportal'); ?></label>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox"
                                       name="social_login_enabled"
                                       id="social_login_enabled"
                                       value="1"
                                       <?php checked($social_login_enabled, '1'); ?>>
                                <?php _e('Enable social login buttons on login and registration pages', 'jobportal'); ?>
                            </label>
                        </td>
                    </tr>
                </table>

                <!-- Google OAuth -->
                <h2 style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd;">🔵 Google OAuth Settings</h2>
                <p style="color: #666;">
                    To enable Google login, create credentials at:
                    <a href="https://console.developers.google.com/" target="_blank" rel="noopener">Google Cloud Console</a>
                </p>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="google_client_id"><?php _e('Google Client ID', 'jobportal'); ?></label>
                        </th>
                        <td>
                            <input type="text"
                                   name="google_client_id"
                                   id="google_client_id"
                                   value="<?php echo esc_attr($google_client_id); ?>"
                                   class="regular-text"
                                   placeholder="Your Google Client ID">
                            <p class="description">
                                <?php _e('OAuth 2.0 Client ID from Google Cloud Console', 'jobportal'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="google_client_secret"><?php _e('Google Client Secret', 'jobportal'); ?></label>
                        </th>
                        <td>
                            <input type="password"
                                   name="google_client_secret"
                                   id="google_client_secret"
                                   value="<?php echo esc_attr($google_client_secret); ?>"
                                   class="regular-text"
                                   placeholder="Your Google Client Secret">
                            <p class="description">
                                <?php _e('OAuth 2.0 Client Secret from Google Cloud Console', 'jobportal'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Authorized Redirect URI', 'jobportal'); ?></th>
                        <td>
                            <code style="background: #f5f5f5; padding: 8px 12px; border-radius: 4px; display: inline-block;">
                                <?php echo home_url('/wp-admin/admin-ajax.php?action=jobportal_google_callback'); ?>
                            </code>
                            <p class="description">
                                <?php _e('Add this URL to "Authorized redirect URIs" in Google Cloud Console', 'jobportal'); ?>
                            </p>
                        </td>
                    </tr>
                </table>

                <!-- LinkedIn OAuth -->
                <h2 style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd;">🔷 LinkedIn OAuth Settings</h2>
                <p style="color: #666;">
                    To enable LinkedIn login, create an app at:
                    <a href="https://www.linkedin.com/developers/" target="_blank" rel="noopener">LinkedIn Developers</a>
                </p>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="linkedin_client_id"><?php _e('LinkedIn Client ID', 'jobportal'); ?></label>
                        </th>
                        <td>
                            <input type="text"
                                   name="linkedin_client_id"
                                   id="linkedin_client_id"
                                   value="<?php echo esc_attr($linkedin_client_id); ?>"
                                   class="regular-text"
                                   placeholder="Your LinkedIn Client ID">
                            <p class="description">
                                <?php _e('Client ID from LinkedIn App Settings', 'jobportal'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="linkedin_client_secret"><?php _e('LinkedIn Client Secret', 'jobportal'); ?></label>
                        </th>
                        <td>
                            <input type="password"
                                   name="linkedin_client_secret"
                                   id="linkedin_client_secret"
                                   value="<?php echo esc_attr($linkedin_client_secret); ?>"
                                   class="regular-text"
                                   placeholder="Your LinkedIn Client Secret">
                            <p class="description">
                                <?php _e('Client Secret from LinkedIn App Settings', 'jobportal'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php _e('Authorized Redirect URL', 'jobportal'); ?></th>
                        <td>
                            <code style="background: #f5f5f5; padding: 8px 12px; border-radius: 4px; display: inline-block;">
                                <?php echo home_url('/wp-admin/admin-ajax.php?action=jobportal_linkedin_callback'); ?>
                            </code>
                            <p class="description">
                                <?php _e('Add this URL to "Authorized redirect URLs" in LinkedIn App Settings', 'jobportal'); ?>
                            </p>
                        </td>
                    </tr>
                </table>

                <?php submit_button(__('Save Settings', 'jobportal')); ?>
            </form>

            <!-- Setup Instructions -->
            <div style="background: #ecfdf5; border-left: 4px solid #10b981; padding: 20px; border-radius: 4px; margin-top: 40px;">
                <h3 style="margin-top: 0; color: #065f46;">💡 Setup Instructions</h3>

                <h4 style="color: #065f46;">Google OAuth Setup:</h4>
                <ol style="color: #064e3b; line-height: 1.8;">
                    <li>Visit <a href="https://console.developers.google.com/" target="_blank">Google Cloud Console</a></li>
                    <li>Create a new project or select existing one</li>
                    <li>Enable "Google+ API"</li>
                    <li>Go to "Credentials" → "Create Credentials" → "OAuth client ID"</li>
                    <li>Select "Web application"</li>
                    <li>Add the Authorized Redirect URI shown above</li>
                    <li>Copy Client ID and Client Secret to the fields above</li>
                </ol>

                <h4 style="color: #065f46; margin-top: 24px;">LinkedIn OAuth Setup:</h4>
                <ol style="color: #064e3b; line-height: 1.8;">
                    <li>Visit <a href="https://www.linkedin.com/developers/" target="_blank">LinkedIn Developers</a></li>
                    <li>Click "Create app"</li>
                    <li>Fill in app details and verify company page</li>
                    <li>Go to "Auth" tab</li>
                    <li>Add the Authorized Redirect URL shown above</li>
                    <li>Request "Sign In with LinkedIn" product</li>
                    <li>Copy Client ID and Client Secret to the fields above</li>
                </ol>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Display Social Login Buttons
 */
function jobportal_display_social_login_buttons($redirect_url = '') {
    $enabled = get_option('jobportal_social_login_enabled', '0');

    if ($enabled !== '1') {
        return;
    }

    $google_client_id = get_option('jobportal_google_client_id', '');
    $linkedin_client_id = get_option('jobportal_linkedin_client_id', '');

    if (empty($google_client_id) && empty($linkedin_client_id)) {
        return;
    }

    if (empty($redirect_url)) {
        $redirect_url = home_url('/dashboard');
    }

    $google_auth_url = '';
    if (!empty($google_client_id)) {
        $google_redirect_uri = admin_url('admin-ajax.php?action=jobportal_google_callback');
        $google_auth_url = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query(array(
            'client_id' => $google_client_id,
            'redirect_uri' => $google_redirect_uri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'state' => base64_encode($redirect_url),
        ));
    }

    $linkedin_auth_url = '';
    if (!empty($linkedin_client_id)) {
        $linkedin_redirect_uri = admin_url('admin-ajax.php?action=jobportal_linkedin_callback');
        $linkedin_auth_url = 'https://www.linkedin.com/oauth/v2/authorization?' . http_build_query(array(
            'client_id' => $linkedin_client_id,
            'redirect_uri' => $linkedin_redirect_uri,
            'response_type' => 'code',
            'scope' => 'r_liteprofile r_emailaddress',
            'state' => base64_encode($redirect_url),
        ));
    }
    ?>
    <div class="jobportal-social-login" style="margin: 24px 0;">
        <div style="
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        ">
            <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
            <span style="color: #64748b; font-size: 14px; font-weight: 600;">OR CONTINUE WITH</span>
            <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
        </div>

        <div style="display: grid; gap: 12px;">
            <?php if (!empty($google_auth_url)) : ?>
                <a href="<?php echo esc_url($google_auth_url); ?>"
                   class="jobportal-social-login-btn google"
                   style="
                       display: flex;
                       align-items: center;
                       justify-content: center;
                       gap: 12px;
                       padding: 14px 24px;
                       background: white;
                       border: 2px solid #e5e7eb;
                       border-radius: 12px;
                       color: #1e293b;
                       font-weight: 600;
                       text-decoration: none;
                       transition: all 0.3s;
                   ">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M19.8 10.2273C19.8 9.51818 19.7364 8.83636 19.6182 8.18182H10V12.05H15.5091C15.2909 13.3 14.6091 14.3591 13.5818 15.0682V17.5773H16.8273C18.7091 15.8409 19.8 13.2727 19.8 10.2273Z" fill="#4285F4"/>
                        <path d="M10 20C12.7 20 14.9636 19.1045 16.8273 17.5773L13.5818 15.0682C12.7182 15.6682 11.6091 16.0227 10 16.0227C7.39545 16.0227 5.19091 14.2682 4.40455 11.9H1.06364V14.4909C2.91818 18.1682 6.20909 20 10 20Z" fill="#34A853"/>
                        <path d="M4.40455 11.9C4.22727 11.3 4.11818 10.6591 4.11818 10C4.11818 9.34091 4.22727 8.7 4.40455 8.1V5.50909H1.06364C0.386364 6.85909 0 8.38636 0 10C0 11.6136 0.386364 13.1409 1.06364 14.4909L4.40455 11.9Z" fill="#FBBC04"/>
                        <path d="M10 3.97727C11.7591 3.97727 13.3364 4.58182 14.5864 5.76818L17.4636 2.89091C15.9591 1.48636 12.6955 0 10 0C6.20909 0 2.91818 1.83182 1.06364 5.50909L4.40455 8.1C5.19091 5.73182 7.39545 3.97727 10 3.97727Z" fill="#EA4335"/>
                    </svg>
                    <span>Continue with Google</span>
                </a>
            <?php endif; ?>

            <?php if (!empty($linkedin_auth_url)) : ?>
                <a href="<?php echo esc_url($linkedin_auth_url); ?>"
                   class="jobportal-social-login-btn linkedin"
                   style="
                       display: flex;
                       align-items: center;
                       justify-content: center;
                       gap: 12px;
                       padding: 14px 24px;
                       background: #0A66C2;
                       border: 2px solid #0A66C2;
                       border-radius: 12px;
                       color: white;
                       font-weight: 600;
                       text-decoration: none;
                       transition: all 0.3s;
                   ">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="white">
                        <path d="M4.5 2.5C4.5 3.88 3.38 5 2 5S-.5 3.88-.5 2.5 .62 0 2 0s2.5 1.12 2.5 2.5zM0 7h4v13H0V7zm6 0h4v1.75c.56-.87 1.93-2.06 4.45-2.06C18 6.69 20 8.94 20 12.94V20h-4v-6.4c0-2.15-.77-3.6-2.7-3.6-1.47 0-2.35.99-2.74 1.94-.14.35-.17.83-.17 1.32V20H6V7z"/>
                    </svg>
                    <span>Continue with LinkedIn</span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <style>
    .jobportal-social-login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .jobportal-social-login-btn.google:hover {
        background: #f8fafc;
    }

    .jobportal-social-login-btn.linkedin:hover {
        background: #094d92;
    }
    </style>
    <?php
}

/**
 * Google OAuth Callback
 */
function jobportal_google_callback() {
    if (!isset($_GET['code'])) {
        wp_die('Invalid Google callback');
    }

    $code = sanitize_text_field($_GET['code']);
    $redirect_url = isset($_GET['state']) ? base64_decode($_GET['state']) : home_url('/dashboard');

    $client_id = get_option('jobportal_google_client_id', '');
    $client_secret = get_option('jobportal_google_client_secret', '');
    $redirect_uri = admin_url('admin-ajax.php?action=jobportal_google_callback');

    // Exchange code for access token
    $token_response = wp_remote_post('https://oauth2.googleapis.com/token', array(
        'body' => array(
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code',
        ),
    ));

    if (is_wp_error($token_response)) {
        wp_die('Error getting access token');
    }

    $token_data = json_decode(wp_remote_retrieve_body($token_response), true);

    if (!isset($token_data['access_token'])) {
        wp_die('Invalid access token response');
    }

    // Get user info
    $user_response = wp_remote_get('https://www.googleapis.com/oauth2/v2/userinfo', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token_data['access_token'],
        ),
    ));

    if (is_wp_error($user_response)) {
        wp_die('Error getting user info');
    }

    $user_data = json_decode(wp_remote_retrieve_body($user_response), true);

    // Create or login user
    $user = jobportal_process_social_login($user_data['email'], $user_data['name'], 'google', $user_data);

    if ($user) {
        wp_set_auth_cookie($user->ID);
        wp_redirect($redirect_url);
        exit;
    }

    wp_die('Error processing social login');
}
add_action('wp_ajax_nopriv_jobportal_google_callback', 'jobportal_google_callback');
add_action('wp_ajax_jobportal_google_callback', 'jobportal_google_callback');

/**
 * LinkedIn OAuth Callback
 */
function jobportal_linkedin_callback() {
    if (!isset($_GET['code'])) {
        wp_die('Invalid LinkedIn callback');
    }

    $code = sanitize_text_field($_GET['code']);
    $redirect_url = isset($_GET['state']) ? base64_decode($_GET['state']) : home_url('/dashboard');

    $client_id = get_option('jobportal_linkedin_client_id', '');
    $client_secret = get_option('jobportal_linkedin_client_secret', '');
    $redirect_uri = admin_url('admin-ajax.php?action=jobportal_linkedin_callback');

    // Exchange code for access token
    $token_response = wp_remote_post('https://www.linkedin.com/oauth/v2/accessToken', array(
        'body' => array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
        ),
    ));

    if (is_wp_error($token_response)) {
        wp_die('Error getting access token');
    }

    $token_data = json_decode(wp_remote_retrieve_body($token_response), true);

    if (!isset($token_data['access_token'])) {
        wp_die('Invalid access token response');
    }

    // Get user email
    $email_response = wp_remote_get('https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token_data['access_token'],
        ),
    ));

    $email_data = json_decode(wp_remote_retrieve_body($email_response), true);
    $email = $email_data['elements'][0]['handle~']['emailAddress'] ?? '';

    // Get user profile
    $profile_response = wp_remote_get('https://api.linkedin.com/v2/me', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token_data['access_token'],
        ),
    ));

    $profile_data = json_decode(wp_remote_retrieve_body($profile_response), true);
    $name = ($profile_data['localizedFirstName'] ?? '') . ' ' . ($profile_data['localizedLastName'] ?? '');

    // Create or login user
    $user = jobportal_process_social_login($email, trim($name), 'linkedin', $profile_data);

    if ($user) {
        wp_set_auth_cookie($user->ID);
        wp_redirect($redirect_url);
        exit;
    }

    wp_die('Error processing social login');
}
add_action('wp_ajax_nopriv_jobportal_linkedin_callback', 'jobportal_linkedin_callback');
add_action('wp_ajax_jobportal_linkedin_callback', 'jobportal_linkedin_callback');

/**
 * Process Social Login (Create or Login User)
 */
function jobportal_process_social_login($email, $name, $provider, $profile_data) {
    if (empty($email)) {
        return false;
    }

    // Check if user exists
    $user = get_user_by('email', $email);

    if ($user) {
        // User exists, update social login meta
        update_user_meta($user->ID, '_social_login_provider', $provider);
        update_user_meta($user->ID, '_social_login_profile', $profile_data);
        return $user;
    }

    // Create new user
    $username = sanitize_user(str_replace(' ', '', strtolower($name)));

    // Make username unique
    $base_username = $username;
    $counter = 1;
    while (username_exists($username)) {
        $username = $base_username . $counter;
        $counter++;
    }

    $user_id = wp_create_user($username, wp_generate_password(), $email);

    if (is_wp_error($user_id)) {
        return false;
    }

    // Update user data
    wp_update_user(array(
        'ID' => $user_id,
        'display_name' => $name,
        'first_name' => $name,
    ));

    // Set user role
    $user = new WP_User($user_id);
    $user->set_role('subscriber');

    // Save social login meta
    update_user_meta($user_id, '_social_login_provider', $provider);
    update_user_meta($user_id, '_social_login_profile', $profile_data);
    update_user_meta($user_id, '_user_type', 'candidate'); // Default to candidate

    return $user;
}
