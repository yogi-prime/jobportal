<?php
/**
 * AJAX Job Filters Handler
 * Real-time job filtering system
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle AJAX Job Filtering
 */
function jobportal_ajax_filter_jobs() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'jobportal_ajax_nonce')) {
        wp_send_json_error(array('message' => __('Security check failed', 'jobportal')));
    }

    // Get filter parameters
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $location = isset($_POST['location']) ? sanitize_text_field($_POST['location']) : '';
    $job_type = isset($_POST['job_type']) ? sanitize_text_field($_POST['job_type']) : '';
    $experience_level = isset($_POST['experience_level']) ? sanitize_text_field($_POST['experience_level']) : '';
    $salary_min = isset($_POST['salary_min']) ? intval($_POST['salary_min']) : 0;
    $remote = isset($_POST['remote']) ? sanitize_text_field($_POST['remote']) : '0';
    $categories = isset($_POST['categories']) ? sanitize_text_field($_POST['categories']) : '';

    // Build query args
    $args = array(
        'post_type' => 'job',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Search query
    if (!empty($search)) {
        $args['s'] = $search;
    }

    // Meta query for filters
    $meta_query = array('relation' => 'AND');

    if (!empty($location)) {
        $meta_query[] = array(
            'key' => '_location',
            'value' => $location,
            'compare' => 'LIKE',
        );
    }

    if (!empty($job_type)) {
        $meta_query[] = array(
            'key' => '_job_type',
            'value' => $job_type,
            'compare' => '=',
        );
    }

    if (!empty($experience_level)) {
        $meta_query[] = array(
            'key' => '_experience_level',
            'value' => $experience_level,
            'compare' => '=',
        );
    }

    if ($salary_min > 0) {
        $meta_query[] = array(
            'key' => '_salary_min',
            'value' => $salary_min,
            'type' => 'NUMERIC',
            'compare' => '>=',
        );
    }

    if ($remote === '1') {
        $meta_query[] = array(
            'key' => '_remote_ok',
            'value' => '1',
            'compare' => '=',
        );
    }

    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    // Category filter
    if (!empty($categories)) {
        $category_ids = explode(',', $categories);
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'job_category',
                'field' => 'term_id',
                'terms' => $category_ids,
            ),
        );
    }

    // Execute query
    $jobs = new WP_Query($args);

    // Generate HTML
    ob_start();

    if ($jobs->have_posts()) :
        while ($jobs->have_posts()) : $jobs->the_post();
            $job_id = get_the_ID();
            $company = get_post_meta($job_id, '_company', true) ?: 'Company Name';
            $location = get_post_meta($job_id, '_location', true) ?: 'Location';
            $job_type = get_post_meta($job_id, '_job_type', true) ?: 'Full-Time';
            $salary = get_post_meta($job_id, '_salary', true) ?: 'Competitive';
            ?>
            <div class="jobportal-job-card" data-animate="fade-up">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                    <h3 class="jobportal-job-title" style="font-size: 20px; font-weight: 700; margin: 0;">
                        <a href="<?php the_permalink(); ?>" style="color: #1e293b; text-decoration: none;">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <span style="font-size: 11px; padding: 4px 10px; background: #dbeafe; color: #1e40af; border-radius: 12px; font-weight: 700; text-transform: uppercase;">
                        New
                    </span>
                </div>

                <p style="color: #64748b; margin-bottom: 16px; font-weight: 600;">
                    <?php echo esc_html($company); ?>
                </p>

                <div style="display: flex; gap: 16px; flex-wrap: wrap; font-size: 14px; color: #64748b; margin-bottom: 20px;">
                    <span style="display: flex; align-items: center; gap: 6px;">
                        📍 <?php echo esc_html($location); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px;">
                        💼 <?php echo esc_html($job_type); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px;">
                        💰 <?php echo esc_html($salary); ?>
                    </span>
                </div>

                <div style="display: flex; gap: 12px;">
                    <a href="<?php the_permalink(); ?>" style="flex: 1; padding: 12px; text-align: center; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s;">
                        <?php _e('Apply Now', 'jobportal'); ?>
                    </a>
                    <button onclick="saveJob(<?php echo $job_id; ?>)" style="width: 44px; height: 44px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                        ❤️
                    </button>
                </div>
            </div>
            <?php
        endwhile;
    else :
        ?>
        <div class="jobportal-no-results" style="text-align: center; padding: 80px 20px;">
            <div style="font-size: 64px; margin-bottom: 24px;">🔍</div>
            <h3 style="font-size: 24px; font-weight: 800; color: #1e293b; margin-bottom: 12px;">
                <?php _e('No Jobs Found', 'jobportal'); ?>
            </h3>
            <p style="color: #64748b; font-size: 16px; max-width: 400px; margin: 0 auto 24px;">
                <?php _e('Try adjusting your filters or search terms to find more opportunities.', 'jobportal'); ?>
            </p>
            <button onclick="document.getElementById('clear-filters').click()" style="padding: 12px 24px; background: #00B4D8; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                <?php _e('Clear All Filters', 'jobportal'); ?>
            </button>
        </div>
        <?php
    endif;

    $html = ob_get_clean();
    wp_reset_postdata();

    // Return response
    wp_send_json_success(array(
        'html' => $html,
        'count' => $jobs->found_posts,
    ));
}
add_action('wp_ajax_filter_jobs', 'jobportal_ajax_filter_jobs');
add_action('wp_ajax_nopriv_filter_jobs', 'jobportal_ajax_filter_jobs');

/**
 * Enqueue AJAX script with localized data
 */
function jobportal_enqueue_ajax_scripts() {
    wp_localize_script('jobportal-main', 'jobportalAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobportal_ajax_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'jobportal_enqueue_ajax_scripts');
