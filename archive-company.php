<?php
/**
 * Template for displaying company archive
 *
 * @package JobPortal
 */

get_header();
?>

<div class="jobportal-container" style="padding: 60px 20px;">
    <!-- Page Header -->
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 56px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
            Browse Companies
        </h1>
        <p style="font-size: 20px; color: #64748b; max-width: 700px; margin: 0 auto;">
            Discover amazing companies and find your dream job
        </p>
    </div>

    <?php if (have_posts()) : ?>
        <!-- Companies Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 32px; max-width: 1400px; margin: 0 auto;">
            <?php while (have_posts()) : the_post();
                $company_id = get_the_ID();
                $location = get_post_meta($company_id, '_company_location', true);
                $employees = get_post_meta($company_id, '_company_employees', true);
                $website = get_post_meta($company_id, '_company_website', true);
                $logo = get_the_post_thumbnail_url($company_id, 'medium');

                // Get company jobs count
                $jobs = get_posts(array(
                    'post_type' => 'job',
                    'meta_query' => array(
                        array(
                            'key' => '_company',
                            'value' => $company_id,
                        ),
                    ),
                    'posts_per_page' => -1,
                    'fields' => 'ids',
                ));
                $jobs_count = count($jobs);

                $industries = get_the_terms($company_id, 'company_industry');
            ?>
                <div class="jobportal-company-card" style="
                    background: white;
                    padding: 32px;
                    border-radius: 20px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                    transition: all 0.3s ease;
                " data-animate="fade-up">
                    <!-- Company Header -->
                    <div style="display: flex; gap: 20px; margin-bottom: 24px; align-items: start;">
                        <?php if ($logo) : ?>
                            <div style="
                                width: 80px;
                                height: 80px;
                                border-radius: 12px;
                                overflow: hidden;
                                background: #f8fafc;
                                padding: 12px;
                                flex-shrink: 0;
                            ">
                                <img src="<?php echo esc_url($logo); ?>"
                                     alt="<?php echo esc_attr(get_the_title()); ?>"
                                     style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                        <?php else : ?>
                            <div style="
                                width: 80px;
                                height: 80px;
                                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 36px;
                                color: white;
                                font-weight: 800;
                                flex-shrink: 0;
                            ">
                                <?php echo substr(get_the_title(), 0, 1); ?>
                            </div>
                        <?php endif; ?>

                        <div style="flex: 1; min-width: 0;">
                            <h2 style="font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">
                                <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <?php if ($industries) : ?>
                                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                    <?php foreach (array_slice($industries, 0, 2) as $industry) : ?>
                                        <span style="
                                            padding: 4px 12px;
                                            background: #eff6ff;
                                            color: #4facfe;
                                            border-radius: 12px;
                                            font-size: 12px;
                                            font-weight: 600;
                                        ">
                                            <?php echo esc_html($industry->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Company Meta -->
                    <div style="display: flex; flex-wrap: wrap; gap: 16px; font-size: 14px; color: #64748b; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #e5e7eb;">
                        <?php if ($location) : ?>
                            <span>📍 <?php echo esc_html($location); ?></span>
                        <?php endif; ?>
                        <?php if ($employees) : ?>
                            <span>👥 <?php echo esc_html($employees); ?></span>
                        <?php endif; ?>
                        <?php if ($jobs_count > 0) : ?>
                            <span style="color: #10b981; font-weight: 600;">💼 <?php echo $jobs_count; ?> jobs</span>
                        <?php endif; ?>
                    </div>

                    <!-- Company Description -->
                    <p style="color: #64748b; line-height: 1.6; margin-bottom: 20px;">
                        <?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 18); ?>
                    </p>

                    <!-- Actions -->
                    <div style="display: flex; gap: 12px;">
                        <a href="<?php the_permalink(); ?>"
                           class="jobportal-btn jobportal-btn-primary"
                           style="flex: 1; text-align: center; text-decoration: none; padding: 12px;">
                            View Profile
                        </a>
                        <?php if ($website) : ?>
                            <a href="<?php echo esc_url($website); ?>"
                               target="_blank"
                               rel="noopener"
                               style="
                                   width: 44px;
                                   height: 44px;
                                   background: #f8fafc;
                                   border: 2px solid #e2e8f0;
                                   border-radius: 8px;
                                   display: flex;
                                   align-items: center;
                                   justify-content: center;
                                   font-size: 18px;
                                   text-decoration: none;
                                   transition: all 0.3s;
                               "
                               title="Visit Website">
                                🌐
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 60px; text-align: center;">
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('← Previous', 'jobportal'),
                'next_text' => __('Next →', 'jobportal'),
            ));
            ?>
        </div>

    <?php else : ?>
        <!-- No Companies Found -->
        <div style="text-align: center; padding: 80px 20px;">
            <div style="font-size: 80px; margin-bottom: 24px;">🏢</div>
            <h2 style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
                No Companies Found
            </h2>
            <p style="font-size: 18px; color: #64748b; margin-bottom: 32px;">
                We couldn't find any companies. Check back later for new additions!
            </p>
            <a href="<?php echo home_url('/jobs'); ?>" class="jobportal-btn jobportal-btn-primary">
                Browse Jobs Instead
            </a>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
