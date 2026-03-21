<?php
/**
 * Template Name: Privacy Policy
 * Description: Privacy Policy page template
 *
 * @package JobPortal
 */

get_header();
?>

<section class="jobportal-page-hero jobportal-page-hero-small">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content" data-aos="fade-up">
            <h1 class="jobportal-page-hero-title"><?php esc_html_e('Privacy Policy', 'jobportal'); ?></h1>
            <p class="jobportal-page-hero-description">
                <?php esc_html_e('Last updated:', 'jobportal'); ?> <?php echo date('F j, Y'); ?>
            </p>
        </div>
    </div>
</section>

<section class="jobportal-legal-content">
    <div class="jobportal-container jobportal-container-narrow">
        <div class="jobportal-legal-body" data-aos="fade-up">

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('1. Introduction', 'jobportal'); ?></h2>
                <p><?php esc_html_e('Welcome to our Privacy Policy. Your privacy is critically important to us. This Privacy Policy document contains types of information that is collected and recorded by our platform and how we use it.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('2. Information We Collect', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.', 'jobportal'); ?></p>
                <h3><?php esc_html_e('Personal Information', 'jobportal'); ?></h3>
                <ul>
                    <li><?php esc_html_e('Name and email address', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Billing address and payment information', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Phone number (optional)', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Company name (if applicable)', 'jobportal'); ?></li>
                </ul>
                <h3><?php esc_html_e('Usage Information', 'jobportal'); ?></h3>
                <ul>
                    <li><?php esc_html_e('Log data (IP address, browser type, pages visited)', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Device information', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Cookies and similar technologies', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('3. How We Use Your Information', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We use the information we collect to:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('Provide, maintain, and improve our services', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Process transactions and send related information', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Send promotional communications (with your consent)', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Respond to your comments and questions', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Monitor and analyze trends and usage', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Detect and prevent fraudulent transactions', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('4. Information Sharing', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('With service providers who assist in our operations', 'jobportal'); ?></li>
                    <li><?php esc_html_e('To comply with legal obligations', 'jobportal'); ?></li>
                    <li><?php esc_html_e('To protect our rights and prevent fraud', 'jobportal'); ?></li>
                    <li><?php esc_html_e('In connection with a merger or acquisition', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('5. Data Security', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('6. Your Rights', 'jobportal'); ?></h2>
                <p><?php esc_html_e('You have the right to:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('Access your personal information', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Correct inaccurate information', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Request deletion of your data', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Opt-out of marketing communications', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Data portability', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('7. Cookies', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We use cookies and similar tracking technologies to track activity on our service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('8. Contact Us', 'jobportal'); ?></h2>
                <p><?php printf(esc_html__('If you have any questions about this Privacy Policy, please contact us at %s or through our %scontact page%s.', 'jobportal'), esc_html(get_theme_mod('jobportal_contact_email', 'privacy@yourcompany.com')), '<a href="' . esc_url(home_url('/contact')) . '">', '</a>'); ?></p>
            </div>

        </div>
    </div>
</section>

<?php
get_footer();
