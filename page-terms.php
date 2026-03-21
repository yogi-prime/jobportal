<?php
/**
 * Template Name: Terms of Service
 * Description: Terms of Service page template
 *
 * @package JobPortal
 */

get_header();
?>

<section class="jobportal-page-hero jobportal-page-hero-small">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content" data-aos="fade-up">
            <h1 class="jobportal-page-hero-title"><?php esc_html_e('Terms of Service', 'jobportal'); ?></h1>
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
                <h2><?php esc_html_e('1. Agreement to Terms', 'jobportal'); ?></h2>
                <p><?php esc_html_e('By accessing or using our service, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('2. Use License', 'jobportal'); ?></h2>
                <p><?php esc_html_e('Permission is granted to temporarily access the materials on our platform for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('Modify or copy the materials', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Use the materials for any commercial purpose', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Attempt to reverse engineer any software', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Remove any copyright or proprietary notations', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Transfer the materials to another person', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('3. Account Terms', 'jobportal'); ?></h2>
                <p><?php esc_html_e('To access certain features, you must register for an account. When you register, you agree to:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('Provide accurate and complete information', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Maintain the security of your password', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Accept responsibility for all activities under your account', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Notify us immediately of any unauthorized use', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('4. Payment Terms', 'jobportal'); ?></h2>
                <p><?php esc_html_e('For paid services:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('All fees are exclusive of taxes unless stated otherwise', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Subscriptions renew automatically unless cancelled', 'jobportal'); ?></li>
                    <li><?php esc_html_e('Refunds are provided according to our refund policy', 'jobportal'); ?></li>
                    <li><?php esc_html_e('We may change pricing with 30 days notice', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('5. Prohibited Uses', 'jobportal'); ?></h2>
                <p><?php esc_html_e('You may not use our service:', 'jobportal'); ?></p>
                <ul>
                    <li><?php esc_html_e('For any unlawful purpose', 'jobportal'); ?></li>
                    <li><?php esc_html_e('To harass, abuse, or harm another person', 'jobportal'); ?></li>
                    <li><?php esc_html_e('To impersonate any person or entity', 'jobportal'); ?></li>
                    <li><?php esc_html_e('To interfere with or circumvent security features', 'jobportal'); ?></li>
                    <li><?php esc_html_e('To transmit malware or viruses', 'jobportal'); ?></li>
                </ul>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('6. Limitation of Liability', 'jobportal'); ?></h2>
                <p><?php esc_html_e('In no event shall we be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('7. Termination', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('8. Changes to Terms', 'jobportal'); ?></h2>
                <p><?php esc_html_e('We reserve the right to modify or replace these Terms at any time. We will provide notice of any changes by posting the new Terms on this page.', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-legal-section">
                <h2><?php esc_html_e('9. Contact Us', 'jobportal'); ?></h2>
                <p><?php printf(esc_html__('If you have any questions about these Terms, please contact us at %s.', 'jobportal'), esc_html(get_theme_mod('jobportal_contact_email', 'legal@yourcompany.com'))); ?></p>
            </div>

        </div>
    </div>
</section>

<?php
get_footer();
