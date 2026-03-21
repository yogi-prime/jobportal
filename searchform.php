<?php
/**
 * Search Form Template
 *
 * @package JobPortal
 */

$unique_id = wp_unique_id('search-');
?>

<form role="search" method="get" class="jobportal-search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo esc_attr($unique_id); ?>" class="screen-reader-text">
        <?php esc_html_e('Search for:', 'jobportal'); ?>
    </label>
    <div class="jobportal-search-input-wrapper">
        <input type="search" id="<?php echo esc_attr($unique_id); ?>" class="jobportal-search-input" placeholder="<?php esc_attr_e('Search...', 'jobportal'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="jobportal-search-button" aria-label="<?php esc_attr_e('Search', 'jobportal'); ?>">
            <?php jobportal_icon('search', 20); ?>
        </button>
    </div>
</form>
