<?php
/**
 * Template for displaying single company profiles
 *
 * @package JobPortal
 */

get_header();

while (have_posts()) : the_post();
    $company_id = get_the_ID();
    $location = get_post_meta($company_id, '_company_location', true);
    $headquarters = get_post_meta($company_id, '_company_headquarters', true);
    $founded = get_post_meta($company_id, '_company_founded', true);
    $website = get_post_meta($company_id, '_company_website', true);
    $email = get_post_meta($company_id, '_company_email', true);
    $phone = get_post_meta($company_id, '_company_phone', true);
    $employees = get_post_meta($company_id, '_company_employees', true);

    // Social links
    $linkedin = get_post_meta($company_id, '_company_linkedin', true);
    $twitter = get_post_meta($company_id, '_company_twitter', true);
    $facebook = get_post_meta($company_id, '_company_facebook', true);
    $instagram = get_post_meta($company_id, '_company_instagram', true);
    $youtube = get_post_meta($company_id, '_company_youtube', true);
    $github = get_post_meta($company_id, '_company_github', true);

    $logo = get_the_post_thumbnail_url($company_id, 'large');
    $banner = get_the_post_thumbnail_url($company_id, 'full');

    // Get company jobs
    $jobs = get_posts(array(
        'post_type' => 'job',
        'meta_query' => array(
            array(
                'key' => '_company',
                'value' => $company_id,
            ),
        ),
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ));

    $industries = get_the_terms($company_id, 'company_industry');
    ?>

    <!-- Company Hero Section -->
    <div style="
        background: <?php echo $banner ? 'url(' . esc_url($banner) . ') center/cover' : 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)'; ?>;
        padding: 80px 20px;
        position: relative;
        color: white;
    ">
        <?php if ($banner) : ?>
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(79, 172, 254, 0.9) 0%, rgba(0, 242, 254, 0.9) 100%);"></div>
        <?php endif; ?>

        <div class="jobportal-container" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
            <div style="display: flex; gap: 32px; align-items: start; flex-wrap: wrap;">
                <!-- Company Logo -->
                <?php if ($logo) : ?>
                    <div style="
                        width: 150px;
                        height: 150px;
                        background: white;
                        border-radius: 20px;
                        padding: 20px;
                        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                    ">
                        <img src="<?php echo esc_url($logo); ?>"
                             alt="<?php echo esc_attr(get_the_title()); ?>"
                             style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                <?php else : ?>
                    <div style="
                        width: 150px;
                        height: 150px;
                        background: white;
                        border-radius: 20px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 72px;
                        font-weight: 800;
                        color: #4facfe;
                        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                    ">
                        <?php echo substr(get_the_title(), 0, 1); ?>
                    </div>
                <?php endif; ?>

                <!-- Company Info -->
                <div style="flex: 1;">
                    <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 16px; color: white;">
                        <?php the_title(); ?>
                    </h1>

                    <?php if ($industries) : ?>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
                            <?php foreach ($industries as $industry) : ?>
                                <span style="
                                    padding: 6px 16px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 20px;
                                    font-size: 13px;
                                    font-weight: 600;
                                    backdrop-filter: blur(10px);
                                ">
                                    <?php echo esc_html($industry->name); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div style="display: flex; flex-wrap: wrap; gap: 24px; font-size: 16px; margin-bottom: 24px; opacity: 0.95;">
                        <?php if ($location) : ?>
                            <span>📍 <?php echo esc_html($location); ?></span>
                        <?php endif; ?>
                        <?php if ($employees) : ?>
                            <span>👥 <?php echo esc_html($employees); ?> employees</span>
                        <?php endif; ?>
                        <?php if ($founded) : ?>
                            <span>📅 Founded in <?php echo esc_html($founded); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($jobs)) : ?>
                            <span style="background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 12px; font-weight: 600;">
                                💼 <?php echo count($jobs); ?> Open Positions
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        <?php if ($website) : ?>
                            <a href="<?php echo esc_url($website); ?>"
                               target="_blank"
                               rel="noopener"
                               style="
                                   padding: 14px 28px;
                                   background: white;
                                   color: #4facfe;
                                   border-radius: 12px;
                                   font-weight: 700;
                                   text-decoration: none;
                                   display: inline-block;
                                   box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
                               ">
                                🌐 Visit Website
                            </a>
                        <?php endif; ?>
                        <?php if ($email) : ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>"
                               style="
                                   padding: 14px 28px;
                                   background: rgba(255, 255, 255, 0.2);
                                   color: white;
                                   border: 2px solid rgba(255, 255, 255, 0.5);
                                   border-radius: 12px;
                                   font-weight: 700;
                                   text-decoration: none;
                                   display: inline-block;
                                   backdrop-filter: blur(10px);
                               ">
                                ✉️ Contact Us
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Social Links -->
                    <?php if ($linkedin || $twitter || $facebook || $instagram || $youtube || $github) : ?>
                        <div style="display: flex; gap: 12px; margin-top: 24px;">
                            <?php if ($linkedin) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" style="
                                    width: 44px;
                                    height: 44px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 20px;
                                    text-decoration: none;
                                    backdrop-filter: blur(10px);
                                    transition: all 0.3s;
                                " title="LinkedIn">🔗</a>
                            <?php endif; ?>
                            <?php if ($twitter) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener" style="
                                    width: 44px;
                                    height: 44px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 20px;
                                    text-decoration: none;
                                    backdrop-filter: blur(10px);
                                    transition: all 0.3s;
                                " title="Twitter">🐦</a>
                            <?php endif; ?>
                            <?php if ($facebook) : ?>
                                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" style="
                                    width: 44px;
                                    height: 44px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 20px;
                                    text-decoration: none;
                                    backdrop-filter: blur(10px);
                                    transition: all 0.3s;
                                " title="Facebook">📘</a>
                            <?php endif; ?>
                            <?php if ($instagram) : ?>
                                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" style="
                                    width: 44px;
                                    height: 44px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 20px;
                                    text-decoration: none;
                                    backdrop-filter: blur(10px);
                                    transition: all 0.3s;
                                " title="Instagram">📷</a>
                            <?php endif; ?>
                            <?php if ($youtube) : ?>
                                <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener" style="
                                    width: 44px;
                                    height: 44px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 20px;
                                    text-decoration: none;
                                    backdrop-filter: blur(10px);
                                    transition: all 0.3s;
                                " title="YouTube">📺</a>
                            <?php endif; ?>
                            <?php if ($github) : ?>
                                <a href="<?php echo esc_url($github); ?>" target="_blank" rel="noopener" style="
                                    width: 44px;
                                    height: 44px;
                                    background: rgba(255, 255, 255, 0.2);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 20px;
                                    text-decoration: none;
                                    backdrop-filter: blur(10px);
                                    transition: all 0.3s;
                                " title="GitHub">💻</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Content -->
    <div class="jobportal-container" style="max-width: 1200px; margin: 0 auto; padding: 60px 20px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Main Content -->
            <div>
                <!-- About Section -->
                <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); margin-bottom: 32px;">
                    <h2 style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                        About <?php the_title(); ?>
                    </h2>
                    <div style="color: #64748b; line-height: 1.8; font-size: 16px;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Open Positions -->
                <?php if (!empty($jobs)) : ?>
                    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                        <h2 style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                            Open Positions (<?php echo count($jobs); ?>)
                        </h2>
                        <div style="display: grid; gap: 20px;">
                            <?php foreach ($jobs as $job) :
                                $job_type = get_post_meta($job->ID, '_job_type', true);
                                $job_location = get_post_meta($job->ID, '_location', true);
                                $salary = get_post_meta($job->ID, '_salary', true);
                                $posted_date = get_the_date('', $job->ID);
                            ?>
                                <div style="
                                    padding: 24px;
                                    background: #f8fafc;
                                    border-radius: 16px;
                                    border: 2px solid #e2e8f0;
                                    transition: all 0.3s;
                                ">
                                    <div style="display: flex; justify-content: space-between; align-items: start; gap: 20px;">
                                        <div style="flex: 1;">
                                            <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
                                                <a href="<?php echo get_permalink($job->ID); ?>" style="color: inherit; text-decoration: none;">
                                                    <?php echo esc_html($job->post_title); ?>
                                                </a>
                                            </h3>
                                            <div style="display: flex; flex-wrap: wrap; gap: 16px; font-size: 14px; color: #64748b; margin-bottom: 16px;">
                                                <?php if ($job_type) : ?>
                                                    <span>💼 <?php echo esc_html($job_type); ?></span>
                                                <?php endif; ?>
                                                <?php if ($job_location) : ?>
                                                    <span>📍 <?php echo esc_html($job_location); ?></span>
                                                <?php endif; ?>
                                                <?php if ($salary) : ?>
                                                    <span>💰 <?php echo esc_html($salary); ?></span>
                                                <?php endif; ?>
                                                <span>🕒 Posted <?php echo human_time_diff(strtotime($posted_date), current_time('timestamp')); ?> ago</span>
                                            </div>
                                            <p style="color: #64748b; line-height: 1.6;">
                                                <?php echo wp_trim_words($job->post_excerpt ?: $job->post_content, 20); ?>
                                            </p>
                                        </div>
                                        <a href="<?php echo get_permalink($job->ID); ?>" class="jobportal-btn jobportal-btn-primary" style="text-decoration: none; white-space: nowrap;">
                                            View Job
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div style="background: white; padding: 60px 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); text-align: center;">
                        <div style="font-size: 64px; margin-bottom: 16px;">📋</div>
                        <h3 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
                            No Open Positions
                        </h3>
                        <p style="color: #64748b;">
                            There are currently no open positions at <?php the_title(); ?>. Check back later for new opportunities!
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Company Details Card -->
                <div style="background: white; padding: 32px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); margin-bottom: 24px; position: sticky; top: 20px;">
                    <h3 style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 24px;">
                        Company Details
                    </h3>
                    <div style="display: grid; gap: 16px;">
                        <?php if ($headquarters) : ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px;">
                                <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 6px;">HEADQUARTERS</div>
                                <div style="color: #1e293b; font-weight: 600;">🏢 <?php echo esc_html($headquarters); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($founded) : ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px;">
                                <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 6px;">FOUNDED</div>
                                <div style="color: #1e293b; font-weight: 600;">📅 <?php echo esc_html($founded); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($employees) : ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px;">
                                <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 6px;">EMPLOYEES</div>
                                <div style="color: #1e293b; font-weight: 600;">👥 <?php echo esc_html($employees); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($phone) : ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px;">
                                <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 6px;">PHONE</div>
                                <div style="color: #1e293b; font-weight: 600;">
                                    <a href="tel:<?php echo esc_attr($phone); ?>" style="color: inherit; text-decoration: none;">
                                        📞 <?php echo esc_html($phone); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($email) : ?>
                            <div style="padding: 16px; background: #f8fafc; border-radius: 12px;">
                                <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 6px;">EMAIL</div>
                                <div style="color: #1e293b; font-weight: 600; word-break: break-all;">
                                    <a href="mailto:<?php echo esc_attr($email); ?>" style="color: inherit; text-decoration: none;">
                                        ✉️ <?php echo esc_html($email); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
endwhile;

get_footer();
