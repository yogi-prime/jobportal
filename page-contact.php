<?php
/**
 * Template Name: Contact Us
 * Description: Contact page template with form
 *
 * @package JobPortal
 */

get_header();
?>

<section class="jobportal-page-hero jobportal-page-hero-small">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('Contact Us', 'jobportal'); ?></span>
            <h1 class="jobportal-page-hero-title">
                <?php esc_html_e('Get in Touch', 'jobportal'); ?>
            </h1>
            <p class="jobportal-page-hero-description">
                <?php esc_html_e('Have a question or need help? We\'d love to hear from you.', 'jobportal'); ?>
            </p>
        </div>
    </div>
</section>

<section class="jobportal-contact-section">
    <div class="jobportal-container">
        <div class="jobportal-contact-grid">
            <div class="jobportal-contact-info" data-aos="fade-right">
                <h2 class="jobportal-contact-info-title"><?php esc_html_e('Let\'s Talk', 'jobportal'); ?></h2>
                <p class="jobportal-contact-info-description">
                    <?php esc_html_e('Fill out the form and our team will get back to you within 24 hours. You can also reach us through the following channels.', 'jobportal'); ?>
                </p>

                <div class="jobportal-contact-methods">
                    <div class="jobportal-contact-method">
                        <div class="jobportal-contact-method-icon">
                            <?php jobportal_icon('mail', 24); ?>
                        </div>
                        <div class="jobportal-contact-method-content">
                            <h3><?php esc_html_e('Email Us', 'jobportal'); ?></h3>
                            <p><?php echo esc_html(get_theme_mod('jobportal_contact_email', 'hello@yourcompany.com')); ?></p>
                        </div>
                    </div>

                    <div class="jobportal-contact-method">
                        <div class="jobportal-contact-method-icon">
                            <?php jobportal_icon('phone', 24); ?>
                        </div>
                        <div class="jobportal-contact-method-content">
                            <h3><?php esc_html_e('Call Us', 'jobportal'); ?></h3>
                            <p><?php echo esc_html(get_theme_mod('jobportal_contact_phone', '+1 (555) 123-4567')); ?></p>
                        </div>
                    </div>

                    <div class="jobportal-contact-method">
                        <div class="jobportal-contact-method-icon">
                            <?php jobportal_icon('map-pin', 24); ?>
                        </div>
                        <div class="jobportal-contact-method-content">
                            <h3><?php esc_html_e('Visit Us', 'jobportal'); ?></h3>
                            <p><?php echo esc_html(get_theme_mod('jobportal_contact_address', '123 Business Street, San Francisco, CA 94102')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="jobportal-contact-social">
                    <h3><?php esc_html_e('Follow Us', 'jobportal'); ?></h3>
                    <div class="jobportal-social-links">
                        <?php if ($twitter = get_theme_mod('jobportal_social_twitter', '#')) : ?>
                        <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <?php jobportal_icon('twitter', 20); ?>
                        </a>
                        <?php endif; ?>
                        <?php if ($facebook = get_theme_mod('jobportal_social_facebook', '#')) : ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <?php jobportal_icon('facebook', 20); ?>
                        </a>
                        <?php endif; ?>
                        <?php if ($linkedin = get_theme_mod('jobportal_social_linkedin', '#')) : ?>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <?php jobportal_icon('linkedin', 20); ?>
                        </a>
                        <?php endif; ?>
                        <?php if ($instagram = get_theme_mod('jobportal_social_instagram', '#')) : ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <?php jobportal_icon('instagram', 20); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="jobportal-contact-form-wrapper" data-aos="fade-left">
                <form class="jobportal-contact-form" id="contact-form">
                    <div class="jobportal-form-row">
                        <div class="jobportal-form-group">
                            <label for="contact-name"><?php esc_html_e('Full Name', 'jobportal'); ?> <span class="required">*</span></label>
                            <input type="text" id="contact-name" name="name" class="jobportal-input" required placeholder="<?php esc_attr_e('John Doe', 'jobportal'); ?>">
                        </div>
                        <div class="jobportal-form-group">
                            <label for="contact-email"><?php esc_html_e('Email Address', 'jobportal'); ?> <span class="required">*</span></label>
                            <input type="email" id="contact-email" name="email" class="jobportal-input" required placeholder="<?php esc_attr_e('john@example.com', 'jobportal'); ?>">
                        </div>
                    </div>

                    <div class="jobportal-form-group">
                        <label for="contact-subject"><?php esc_html_e('Subject', 'jobportal'); ?></label>
                        <select id="contact-subject" name="subject" class="jobportal-input">
                            <option value=""><?php esc_html_e('Select a topic', 'jobportal'); ?></option>
                            <option value="General Inquiry"><?php esc_html_e('General Inquiry', 'jobportal'); ?></option>
                            <option value="Sales"><?php esc_html_e('Sales', 'jobportal'); ?></option>
                            <option value="Support"><?php esc_html_e('Technical Support', 'jobportal'); ?></option>
                            <option value="Partnership"><?php esc_html_e('Partnership', 'jobportal'); ?></option>
                            <option value="Other"><?php esc_html_e('Other', 'jobportal'); ?></option>
                        </select>
                    </div>

                    <div class="jobportal-form-group">
                        <label for="contact-message"><?php esc_html_e('Message', 'jobportal'); ?> <span class="required">*</span></label>
                        <textarea id="contact-message" name="message" class="jobportal-textarea" rows="5" required placeholder="<?php esc_attr_e('How can we help you?', 'jobportal'); ?>"></textarea>
                    </div>

                    <div class="jobportal-form-group jobportal-form-consent">
                        <label class="jobportal-checkbox-label">
                            <input type="checkbox" name="consent" required>
                            <span><?php printf(esc_html__('I agree to the %sPrivacy Policy%s and %sTerms of Service%s', 'jobportal'), '<a href="' . esc_url(home_url('/privacy-policy')) . '">', '</a>', '<a href="' . esc_url(home_url('/terms')) . '">', '</a>'); ?></span>
                        </label>
                    </div>

                    <button type="submit" class="jobportal-btn jobportal-btn-primary jobportal-btn-lg jobportal-btn-block">
                        <?php esc_html_e('Send Message', 'jobportal'); ?>
                        <?php jobportal_icon('send', 20); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="jobportal-map-section">
    <div class="jobportal-map-container">
        <?php $map_embed = get_theme_mod('jobportal_contact_map', ''); ?>
        <?php if (!empty($map_embed)) : ?>
            <?php echo $map_embed; ?>
        <?php else : ?>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0977939457576!2d-122.39997548439026!3d37.78779657975745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085807f619a62df%3A0x491ce2f73977af35!2sSalesforce%20Tower!5e0!3m2!1sen!2sus!4v1698000000000!5m2!1sen!2sus"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="<?php esc_attr_e('Office Location', 'jobportal'); ?>">
            </iframe>
        <?php endif; ?>
    </div>
</section>

<section class="jobportal-faq-section jobportal-faq-contact">
    <div class="jobportal-container">
        <div class="jobportal-section-header" data-aos="fade-up">
            <span class="jobportal-section-label"><?php esc_html_e('FAQ', 'jobportal'); ?></span>
            <h2 class="jobportal-section-title"><?php esc_html_e('Common Questions', 'jobportal'); ?></h2>
        </div>

        <div class="jobportal-faq-list" data-aos="fade-up">
            <?php
            $faqs = array(
                array('q' => __('What is your response time?', 'jobportal'), 'a' => __('We typically respond to all inquiries within 24 hours during business days. Priority support customers receive responses within 2 hours.', 'jobportal')),
                array('q' => __('Do you offer phone support?', 'jobportal'), 'a' => __('Yes! Phone support is available for Pro and Enterprise customers. You can also schedule a call with our team at any time.', 'jobportal')),
                array('q' => __('Where are you located?', 'jobportal'), 'a' => __('Our headquarters is in San Francisco, but we have team members around the world to provide 24/7 support.', 'jobportal')),
            );
            foreach ($faqs as $faq) :
            ?>
            <div class="jobportal-faq-item">
                <button class="jobportal-faq-question" aria-expanded="false">
                    <span><?php echo esc_html($faq['q']); ?></span>
                    <?php jobportal_icon('chevron-down', 20); ?>
                </button>
                <div class="jobportal-faq-answer">
                    <p><?php echo esc_html($faq['a']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
get_footer();
