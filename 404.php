<?php
/**
 * 404 Error Page Template
 *
 * @package JobPortal
 */

get_header();
?>

<div class="jobportal-404-page">
    <div class="jobportal-container">
        <div class="jobportal-404-content">
            <div class="jobportal-404-illustration">
                <span class="jobportal-404-number">404</span>
                <div class="jobportal-404-circles">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <h1 class="jobportal-404-title">
                <?php echo esc_html(get_theme_mod('jobportal_404_title', __('Page Not Found', 'jobportal'))); ?>
            </h1>

            <p class="jobportal-404-text">
                <?php echo esc_html(get_theme_mod('jobportal_404_text', __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'jobportal'))); ?>
            </p>

            <div class="jobportal-404-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="jobportal-btn jobportal-btn-primary jobportal-btn-lg">
                    <?php jobportal_icon('arrow-left', 20); ?>
                    <?php esc_html_e('Back to Home', 'jobportal'); ?>
                </a>
            </div>

            <div class="jobportal-404-search">
                <p class="jobportal-404-search-label"><?php esc_html_e('Or try searching:', 'jobportal'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
