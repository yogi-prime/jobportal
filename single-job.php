<?php
/**
 * Single Job Template - Individual Job Details Page
 * Fully Dynamic with Application System Integration
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

get_header();

while (have_posts()) : the_post();
    $job_id = get_the_ID();
    $job_title = get_the_title();

    // Get job meta data
    $company = get_post_meta($job_id, '_company', true) ?: 'Company Name';
    $location = get_post_meta($job_id, '_location', true) ?: 'Location';
    $job_type = get_post_meta($job_id, '_job_type', true) ?: 'Full-Time';
    $salary = get_post_meta($job_id, '_salary', true) ?: 'Competitive';
    $posted_date = human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
?>

<div class="jobportal-single-job">

<!-- Job Header -->
<section style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 140px 20px 60px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: start; gap: 24px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <h1 style="font-size: 42px; margin-bottom: 12px; font-weight: 800;"><?php echo esc_html($job_title); ?></h1>
                <div style="font-size: 20px; opacity: 0.95; margin-bottom: 16px;"><?php echo esc_html($company); ?></div>
                <div style="display: flex; gap: 20px; flex-wrap: wrap; font-size: 16px;">
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <?php echo jobportal_get_icon('map-pin', 18); ?> <?php echo esc_html($location); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <?php echo jobportal_get_icon('briefcase', 18); ?> <?php echo esc_html($job_type); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <?php echo jobportal_get_icon('dollar-sign', 18); ?> <?php echo esc_html($salary); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <?php echo jobportal_get_icon('clock', 18); ?> <?php echo esc_html($posted_date); ?>
                    </span>
                </div>
            </div>
            <div style="display: flex; gap: 12px; align-items: center;">
                <button onclick="jobportalOpenApplyModal(<?php echo $job_id; ?>, '<?php echo esc_js($job_title); ?>')"
                        style="padding: 16px 40px; background: white; color: #4facfe; border: none; border-radius: 10px; font-size: 18px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
                    <?php _e('Apply Now', 'jobportal'); ?>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Job Content -->
<section style="padding: 60px 20px; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">

        <!-- Main Content -->
        <div>
            <!-- Job Description -->
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php _e('Job Description', 'jobportal'); ?>
                </h2>
                <div style="color: #475569; line-height: 1.8; font-size: 16px;">
                    <?php the_content(); ?>
                </div>
            </div>

            <?php
            // Get custom fields for responsibilities, requirements, benefits
            $responsibilities = get_post_meta($job_id, '_responsibilities', true);
            $requirements = get_post_meta($job_id, '_requirements', true);
            $nice_to_have = get_post_meta($job_id, '_nice_to_have', true);
            $benefits = get_post_meta($job_id, '_benefits', true);

            // Display Responsibilities
            if ($responsibilities && is_array($responsibilities)) :
            ?>
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php _e('Key Responsibilities', 'jobportal'); ?>
                </h2>
                <ul style="color: #475569; line-height: 2; font-size: 16px; padding-left: 24px;">
                    <?php foreach ($responsibilities as $item) : ?>
                        <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php
            // Display Requirements
            if ($requirements && is_array($requirements)) :
            ?>
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php _e('Requirements', 'jobportal'); ?>
                </h2>
                <ul style="color: #475569; line-height: 2; font-size: 16px; padding-left: 24px;">
                    <?php foreach ($requirements as $item) : ?>
                        <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php
            // Display Nice to Have
            if ($nice_to_have && is_array($nice_to_have)) :
            ?>
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php _e('Nice to Have', 'jobportal'); ?>
                </h2>
                <ul style="color: #475569; line-height: 2; font-size: 16px; padding-left: 24px;">
                    <?php foreach ($nice_to_have as $item) : ?>
                        <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php
            // Display Benefits
            if ($benefits && is_array($benefits)) :
            ?>
            <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php _e('Benefits & Perks', 'jobportal'); ?>
                </h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                    <?php foreach ($benefits as $benefit) : ?>
                        <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                            <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;">
                                <?php echo jobportal_get_icon('check-circle', 24); ?>
                            </div>
                            <div style="font-weight: 600; color: #1e293b;"><?php echo esc_html($benefit); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Apply Card -->
            <div style="background: white; padding: 32px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); position: sticky; top: 140px;">
                <h3 style="font-size: 22px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php _e('Apply for this Job', 'jobportal'); ?>
                </h3>
                <button onclick="jobportalOpenApplyModal(<?php echo $job_id; ?>, '<?php echo esc_js($job_title); ?>')"
                        style="width: 100%; padding: 16px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; margin-bottom: 12px; box-shadow: 0 4px 16px rgba(79,172,254,0.3);">
                    <?php _e('Apply Now', 'jobportal'); ?>
                </button>

                <div style="margin-top: 24px; padding-top: 24px; border-top: 2px solid #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; margin-bottom: 8px;"><?php _e('Share this job:', 'jobportal'); ?></div>
                    <div style="display: flex; gap: 8px;">
                        <button onclick="navigator.clipboard.writeText(window.location.href)" title="<?php _e('Copy Link', 'jobportal'); ?>"
                                style="flex: 1; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b;">
                            <?php echo jobportal_get_icon('link', 18); ?>
                        </button>
                        <button onclick="window.open('mailto:?subject=<?php echo urlencode($job_title); ?>&body=<?php echo urlencode(get_permalink()); ?>', '_blank')" title="<?php _e('Share via Email', 'jobportal'); ?>"
                                style="flex: 1; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b;">
                            <?php echo jobportal_get_icon('mail', 18); ?>
                        </button>
                        <button onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>', '_blank')" title="<?php _e('Share on LinkedIn', 'jobportal'); ?>"
                                style="flex: 1; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b;">
                            <?php echo jobportal_get_icon('linkedin', 18); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Company Info -->
            <?php
            $company_website = get_post_meta($job_id, '_company_website', true);
            $company_industry = get_post_meta($job_id, '_company_industry', true);
            $company_size = get_post_meta($job_id, '_company_size', true);
            $company_description = get_post_meta($job_id, '_company_description', true);
            ?>
            <div style="background: white; padding: 32px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                <h3 style="font-size: 22px; margin-bottom: 20px; color: #1e293b; font-weight: 800;">
                    <?php printf(__('About %s', 'jobportal'), esc_html($company)); ?>
                </h3>
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; color: white;">
                    <?php echo strtoupper(substr($company, 0, 2)); ?>
                </div>
                <?php if ($company_description) : ?>
                <p style="color: #475569; line-height: 1.7; font-size: 15px; margin-bottom: 16px;">
                    <?php echo esc_html($company_description); ?>
                </p>
                <?php endif; ?>
                <div style="font-size: 14px; color: #64748b; line-height: 2;">
                    <?php if ($company_industry) : ?>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <?php echo jobportal_get_icon('building', 16); ?>
                        <strong><?php _e('Industry:', 'jobportal'); ?></strong> <?php echo esc_html($company_industry); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($company_size) : ?>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <?php echo jobportal_get_icon('users', 16); ?>
                        <strong><?php _e('Company Size:', 'jobportal'); ?></strong> <?php echo esc_html($company_size); ?>
                    </div>
                    <?php endif; ?>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <?php echo jobportal_get_icon('map-pin', 16); ?>
                        <strong><?php _e('Location:', 'jobportal'); ?></strong> <?php echo esc_html($location); ?>
                    </div>
                    <?php if ($company_website) : ?>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <?php echo jobportal_get_icon('globe', 16); ?>
                        <strong><?php _e('Website:', 'jobportal'); ?></strong>
                        <a href="<?php echo esc_url($company_website); ?>" target="_blank" style="color: #4facfe;">
                            <?php echo esc_html(parse_url($company_website, PHP_URL_HOST)); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Similar Jobs -->
<?php
$similar_jobs = get_posts(array(
    'post_type' => 'job',
    'posts_per_page' => 3,
    'post__not_in' => array($job_id),
    'orderby' => 'rand',
));

if ($similar_jobs) :
?>
<section style="padding: 60px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 32px; margin-bottom: 32px; text-align: center; font-weight: 800;">
            <?php _e('Similar Jobs', 'jobportal'); ?>
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px;">
            <?php foreach ($similar_jobs as $similar_job) :
                $similar_company = get_post_meta($similar_job->ID, '_company', true) ?: 'Company';
                $similar_location = get_post_meta($similar_job->ID, '_location', true) ?: 'Location';
                $similar_salary = get_post_meta($similar_job->ID, '_salary', true) ?: 'Competitive';
            ?>
            <div style="background: white; padding: 28px; border-radius: 12px; border: 2px solid #e2e8f0; transition: all 0.3s;">
                <h3 style="font-size: 20px; margin-bottom: 8px;">
                    <a href="<?php echo get_permalink($similar_job->ID); ?>" style="color: #1e293b; text-decoration: none;">
                        <?php echo esc_html($similar_job->post_title); ?>
                    </a>
                </h3>
                <div style="color: #64748b; margin-bottom: 12px; font-weight: 600;">
                    <?php echo esc_html($similar_company); ?>
                </div>
                <div style="font-size: 14px; color: #64748b; margin-bottom: 16px; display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <?php echo jobportal_get_icon('map-pin', 14); ?> <?php echo esc_html($similar_location); ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <?php echo jobportal_get_icon('dollar-sign', 14); ?> <?php echo esc_html($similar_salary); ?>
                    </span>
                </div>
                <a href="<?php echo get_permalink($similar_job->ID); ?>"
                   style="display: inline-block; padding: 10px 24px; background: #4facfe; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                    <?php _e('View Job', 'jobportal'); ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

</div>

<style>
@media (max-width: 1023px) {
    section[style*="grid-template-columns: 2fr 1fr"] > div {
        grid-template-columns: 1fr !important;
    }
}

@media (max-width: 768px) {
    section[style*="padding: 140px 20px 60px"] {
        padding: 110px 20px 40px !important;
    }

    h1[style*="font-size: 42px"] {
        font-size: 28px !important;
    }

    section[style*="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr))"] > div {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php
endwhile;
get_footer();
?>
