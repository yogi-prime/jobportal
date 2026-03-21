<?php
/**
 * Referral & Rewards Program
 * Viral growth system with points and rewards
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate Referral Code for User
 */
function jobportal_generate_referral_code($user_id) {
    $existing_code = get_user_meta($user_id, '_referral_code', true);

    if ($existing_code) {
        return $existing_code;
    }

    $user = get_user_by('id', $user_id);
    $code = strtoupper(substr($user->user_login, 0, 3) . rand(1000, 9999));

    // Ensure unique code
    while (jobportal_get_user_by_referral_code($code)) {
        $code = strtoupper(substr($user->user_login, 0, 3) . rand(1000, 9999));
    }

    update_user_meta($user_id, '_referral_code', $code);
    update_user_meta($user_id, '_referral_points', 0);
    update_user_meta($user_id, '_referral_count', 0);

    return $code;
}

/**
 * Get User by Referral Code
 */
function jobportal_get_user_by_referral_code($code) {
    $users = get_users(array(
        'meta_key' => '_referral_code',
        'meta_value' => $code,
        'number' => 1,
    ));

    return !empty($users) ? $users[0] : null;
}

/**
 * Process Referral on User Registration
 */
function jobportal_process_referral_on_registration($user_id) {
    // Check if user was referred
    $referral_code = isset($_COOKIE['jobportal_ref']) ? sanitize_text_field($_COOKIE['jobportal_ref']) : '';

    if (empty($referral_code)) {
        return;
    }

    $referrer = jobportal_get_user_by_referral_code($referral_code);

    if (!$referrer) {
        return;
    }

    // Don't allow self-referrals
    if ($referrer->ID === $user_id) {
        return;
    }

    // Record referral
    update_user_meta($user_id, '_referred_by', $referrer->ID);
    update_user_meta($user_id, '_referred_by_code', $referral_code);

    // Award points to referrer
    jobportal_award_referral_points($referrer->ID, $user_id, 'registration');

    // Clear cookie
    setcookie('jobportal_ref', '', time() - 3600, '/');
}
add_action('user_register', 'jobportal_process_referral_on_registration');

/**
 * Award Referral Points
 */
function jobportal_award_referral_points($referrer_id, $referred_user_id, $action = 'registration') {
    $points_config = array(
        'registration' => 100,  // Points for successful registration
        'job_application' => 50,  // Points when referred user applies for job
        'premium_purchase' => 500,  // Points when referred user buys premium
        'job_post' => 200,  // Points when referred user posts a job
    );

    $points = isset($points_config[$action]) ? $points_config[$action] : 0;

    if ($points <= 0) {
        return;
    }

    // Update referrer points
    $current_points = get_user_meta($referrer_id, '_referral_points', true) ?: 0;
    $new_points = $current_points + $points;
    update_user_meta($referrer_id, '_referral_points', $new_points);

    // Update referral count
    if ($action === 'registration') {
        $referral_count = get_user_meta($referrer_id, '_referral_count', true) ?: 0;
        update_user_meta($referrer_id, '_referral_count', $referral_count + 1);
    }

    // Record transaction
    $transactions = get_user_meta($referrer_id, '_referral_transactions', true) ?: array();
    $transactions[] = array(
        'action' => $action,
        'points' => $points,
        'referred_user' => $referred_user_id,
        'date' => current_time('mysql'),
    );
    update_user_meta($referrer_id, '_referral_transactions', $transactions);

    // Send email notification
    jobportal_send_referral_notification($referrer_id, $points, $action);
}

/**
 * Send Referral Notification Email
 */
function jobportal_send_referral_notification($user_id, $points, $action) {
    $user = get_user_by('id', $user_id);

    if (!$user) {
        return;
    }

    $action_labels = array(
        'registration' => 'signed up',
        'job_application' => 'applied for a job',
        'premium_purchase' => 'purchased premium',
        'job_post' => 'posted a job',
    );

    $action_label = isset($action_labels[$action]) ? $action_labels[$action] : 'completed an action';

    $subject = sprintf('[%s] You earned %d points!', get_bloginfo('name'), $points);

    $message = sprintf(
        "Hi %s,\n\n" .
        "Great news! Someone you referred has %s and you've earned %d reward points!\n\n" .
        "Your total points: %d\n\n" .
        "Keep sharing your referral link to earn more rewards!\n" .
        "Your referral link: %s\n\n" .
        "View your rewards: %s\n\n" .
        "Best regards,\n" .
        "%s Team",
        $user->display_name,
        $action_label,
        $points,
        get_user_meta($user_id, '_referral_points', true),
        home_url('/?ref=' . get_user_meta($user_id, '_referral_code', true)),
        home_url('/referrals'),
        get_bloginfo('name')
    );

    wp_mail($user->user_email, $subject, $message);
}

/**
 * Set Referral Cookie
 */
function jobportal_set_referral_cookie() {
    if (isset($_GET['ref']) && !is_user_logged_in()) {
        $ref_code = sanitize_text_field($_GET['ref']);
        $referrer = jobportal_get_user_by_referral_code($ref_code);

        if ($referrer) {
            setcookie('jobportal_ref', $ref_code, time() + (30 * 24 * 60 * 60), '/'); // 30 days
        }
    }
}
add_action('init', 'jobportal_set_referral_cookie');

/**
 * Get Top Referrers
 */
function jobportal_get_top_referrers($limit = 10) {
    $users = get_users(array(
        'meta_key' => '_referral_points',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'number' => $limit,
    ));

    return $users;
}

/**
 * Shortcode: Referral Dashboard
 */
function jobportal_referral_dashboard_shortcode() {
    if (!is_user_logged_in()) {
        return '<p style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 12px;">Please <a href="' . wp_login_url() . '">login</a> to view your referral dashboard.</p>';
    }

    $user_id = get_current_user_id();
    $referral_code = jobportal_generate_referral_code($user_id);
    $referral_link = home_url('/?ref=' . $referral_code);
    $points = get_user_meta($user_id, '_referral_points', true) ?: 0;
    $referral_count = get_user_meta($user_id, '_referral_count', true) ?: 0;
    $transactions = get_user_meta($user_id, '_referral_transactions', true) ?: array();

    ob_start();
    ?>
    <div class="jobportal-referral-dashboard">
        <!-- Header -->
        <div style="
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 60px 40px;
            border-radius: 20px;
            color: white;
            margin-bottom: 40px;
            text-align: center;
        ">
            <div style="font-size: 72px; margin-bottom: 16px;">🎁</div>
            <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 16px; color: white;">
                Refer & Earn Rewards
            </h1>
            <p style="font-size: 20px; opacity: 0.95; max-width: 600px; margin: 0 auto;">
                Invite friends to join JobPortal and earn points for every successful referral!
            </p>
        </div>

        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <!-- Total Points -->
            <div style="
                background: white;
                padding: 32px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                text-align: center;
            ">
                <div style="font-size: 48px; margin-bottom: 12px;">⭐</div>
                <div style="font-size: 42px; font-weight: 800; color: #4facfe; margin-bottom: 8px;">
                    <?php echo number_format($points); ?>
                </div>
                <div style="color: #64748b; font-weight: 600;">Total Points</div>
            </div>

            <!-- Total Referrals -->
            <div style="
                background: white;
                padding: 32px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                text-align: center;
            ">
                <div style="font-size: 48px; margin-bottom: 12px;">👥</div>
                <div style="font-size: 42px; font-weight: 800; color: #10b981; margin-bottom: 8px;">
                    <?php echo number_format($referral_count); ?>
                </div>
                <div style="color: #64748b; font-weight: 600;">Successful Referrals</div>
            </div>

            <!-- Rank -->
            <?php
            $top_referrers = jobportal_get_top_referrers(100);
            $rank = 0;
            foreach ($top_referrers as $index => $referrer) {
                if ($referrer->ID === $user_id) {
                    $rank = $index + 1;
                    break;
                }
            }
            ?>
            <div style="
                background: white;
                padding: 32px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                text-align: center;
            ">
                <div style="font-size: 48px; margin-bottom: 12px;">🏆</div>
                <div style="font-size: 42px; font-weight: 800; color: #f59e0b; margin-bottom: 8px;">
                    #<?php echo $rank > 0 ? $rank : '-'; ?>
                </div>
                <div style="color: #64748b; font-weight: 600;">Your Rank</div>
            </div>
        </div>

        <!-- Referral Link Section -->
        <div style="
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        ">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
                Your Referral Link
            </h2>
            <p style="color: #64748b; margin-bottom: 24px;">
                Share this link with friends. When they sign up using your link, you'll earn points!
            </p>

            <div style="display: flex; gap: 12px; margin-bottom: 24px;">
                <input type="text"
                       id="referral-link"
                       value="<?php echo esc_attr($referral_link); ?>"
                       readonly
                       style="
                           flex: 1;
                           padding: 16px 20px;
                           border: 2px solid #e2e8f0;
                           border-radius: 12px;
                           font-size: 16px;
                           font-weight: 600;
                           color: #4facfe;
                       ">
                <button type="button"
                        id="copy-referral-link"
                        class="jobportal-btn jobportal-btn-primary"
                        style="padding: 16px 32px; white-space: nowrap;">
                    📋 Copy Link
                </button>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('Join me on JobPortal! '); ?>&url=<?php echo urlencode($referral_link); ?>"
                   target="_blank"
                   class="jobportal-btn"
                   style="background: #1DA1F2; color: white; border: none; text-decoration: none;">
                    🐦 Share on Twitter
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($referral_link); ?>"
                   target="_blank"
                   class="jobportal-btn"
                   style="background: #1877F2; color: white; border: none; text-decoration: none;">
                    📘 Share on Facebook
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($referral_link); ?>"
                   target="_blank"
                   class="jobportal-btn"
                   style="background: #0A66C2; color: white; border: none; text-decoration: none;">
                    💼 Share on LinkedIn
                </a>
            </div>
        </div>

        <!-- How It Works -->
        <div style="
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        ">
            <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                How It Works
            </h2>
            <div style="display: grid; gap: 24px;">
                <div style="display: flex; gap: 20px; align-items: start;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 28px;
                        flex-shrink: 0;
                    ">1️⃣</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
                            Share Your Link
                        </h3>
                        <p style="color: #64748b; line-height: 1.6;">
                            Copy your unique referral link and share it with friends via social media, email, or messaging apps.
                        </p>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; align-items: start;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 28px;
                        flex-shrink: 0;
                    ">2️⃣</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
                            Friends Sign Up
                        </h3>
                        <p style="color: #64748b; line-height: 1.6;">
                            When someone clicks your link and creates an account, they'll be tracked as your referral.
                        </p>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; align-items: start;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 28px;
                        flex-shrink: 0;
                    ">3️⃣</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
                            Earn Rewards
                        </h3>
                        <p style="color: #64748b; line-height: 1.6; margin-bottom: 12px;">
                            You'll earn points for each action your referrals take:
                        </p>
                        <ul style="color: #64748b; line-height: 1.8; margin: 0; padding-left: 24px;">
                            <li><strong style="color: #4facfe;">100 points</strong> - Friend signs up</li>
                            <li><strong style="color: #4facfe;">50 points</strong> - Friend applies for a job</li>
                            <li><strong style="color: #4facfe;">200 points</strong> - Friend posts a job</li>
                            <li><strong style="color: #4facfe;">500 points</strong> - Friend purchases premium</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <?php if (!empty($transactions)) : ?>
            <div style="
                background: white;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                margin-bottom: 40px;
            ">
                <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                    Recent Activity
                </h2>
                <div style="display: grid; gap: 16px;">
                    <?php foreach (array_reverse(array_slice($transactions, -10)) as $transaction) :
                        $referred_user = get_user_by('id', $transaction['referred_user']);
                        $action_labels = array(
                            'registration' => '✅ signed up',
                            'job_application' => '📄 applied for a job',
                            'premium_purchase' => '💎 purchased premium',
                            'job_post' => '📝 posted a job',
                        );
                        $action_label = isset($action_labels[$transaction['action']]) ? $action_labels[$transaction['action']] : 'completed an action';
                    ?>
                        <div style="
                            padding: 20px;
                            background: #f8fafc;
                            border-radius: 12px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        ">
                            <div>
                                <strong style="color: #1e293b;">
                                    <?php echo $referred_user ? esc_html($referred_user->display_name) : 'User'; ?>
                                </strong>
                                <span style="color: #64748b;"><?php echo $action_label; ?></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <span style="
                                    padding: 6px 16px;
                                    background: #10b981;
                                    color: white;
                                    border-radius: 20px;
                                    font-weight: 700;
                                    font-size: 14px;
                                ">
                                    +<?php echo $transaction['points']; ?> points
                                </span>
                                <span style="color: #9ca3af; font-size: 13px;">
                                    <?php echo human_time_diff(strtotime($transaction['date']), current_time('timestamp')); ?> ago
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Leaderboard -->
        <?php
        $top_referrers = jobportal_get_top_referrers(10);
        if (!empty($top_referrers)) :
        ?>
            <div style="
                background: white;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            ">
                <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                    🏆 Top Referrers
                </h2>
                <div style="display: grid; gap: 12px;">
                    <?php foreach ($top_referrers as $index => $referrer) :
                        $ref_points = get_user_meta($referrer->ID, '_referral_points', true) ?: 0;
                        $ref_count = get_user_meta($referrer->ID, '_referral_count', true) ?: 0;
                        $is_current_user = $referrer->ID === $user_id;
                    ?>
                        <div style="
                            padding: 20px;
                            background: <?php echo $is_current_user ? 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)' : '#f8fafc'; ?>;
                            border: 2px solid <?php echo $is_current_user ? '#4facfe' : '#e5e7eb'; ?>;
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            gap: 20px;
                        ">
                            <div style="
                                width: 48px;
                                height: 48px;
                                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: 800;
                                color: white;
                                font-size: 20px;
                            ">
                                #<?php echo $index + 1; ?>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 16px;">
                                    <?php echo $is_current_user ? 'You' : esc_html($referrer->display_name); ?>
                                </div>
                                <div style="color: #64748b; font-size: 14px;">
                                    <?php echo $ref_count; ?> referrals
                                </div>
                            </div>
                            <div style="
                                padding: 8px 16px;
                                background: #10b981;
                                color: white;
                                border-radius: 20px;
                                font-weight: 700;
                            ">
                                <?php echo number_format($ref_points); ?> pts
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#copy-referral-link').on('click', function() {
            var linkInput = document.getElementById('referral-link');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999); // For mobile

            try {
                document.execCommand('copy');
                $(this).text('✓ Copied!');
                setTimeout(function() {
                    $('#copy-referral-link').text('📋 Copy Link');
                }, 2000);
            } catch (err) {
                alert('Failed to copy link');
            }
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('referral_dashboard', 'jobportal_referral_dashboard_shortcode');
