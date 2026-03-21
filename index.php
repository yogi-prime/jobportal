<?php
/**
 * Main Index Template (Blog Page)
 *
 * @package JobPortal
 */

get_header();

$layout = get_theme_mod('jobportal_blog_layout', 'grid');
$sidebar = get_theme_mod('jobportal_blog_sidebar', 'right');
?>

<style>
/* Universal Professional Hero - Consistent Across All Pages */
.jobportal-page-hero-blog {
    background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
    padding: 140px 0 50px;
    position: relative;
    overflow: hidden;
    min-height: auto;
}

.jobportal-page-hero-blog::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    pointer-events: none;
}

.jobportal-page-hero-blog .jobportal-section-label {
    color: rgba(255, 255, 255, 0.95);
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 16px;
}

.jobportal-page-hero-blog .jobportal-page-hero-title {
    color: white;
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 12px;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

.jobportal-page-hero-blog .jobportal-page-hero-description {
    color: rgba(255, 255, 255, 0.95);
    font-size: 16px;
    line-height: 1.6;
    max-width: 600px;
}

/* Blog Section */
.jobportal-blog-section {
    padding: 80px 0;
    background: #f8fafc;
}

.jobportal-content-wrapper {
    display: grid;
    gap: 50px;
}

.jobportal-content-wrapper.jobportal-sidebar-right {
    grid-template-columns: 1fr 380px;
}

.jobportal-content-wrapper.jobportal-sidebar-left {
    grid-template-columns: 380px 1fr;
}

.jobportal-content-wrapper.jobportal-sidebar-none {
    grid-template-columns: 1fr;
    max-width: 900px;
    margin: 0 auto;
}

/* Posts Grid */
.jobportal-posts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
    margin-bottom: 50px;
}

.jobportal-posts-list {
    display: flex;
    flex-direction: column;
    gap: 32px;
    margin-bottom: 50px;
}

/* No Posts Found */
.jobportal-no-posts {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.jobportal-no-posts-icon {
    margin-bottom: 24px;
    color: #cbd5e1;
}

.jobportal-no-posts h2 {
    font-size: 32px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 16px;
}

.jobportal-no-posts p {
    font-size: 18px;
    color: #64748b;
    margin-bottom: 32px;
}

/* Responsive */
@media (max-width: 1023px) {
    .jobportal-content-wrapper.jobportal-sidebar-right,
    .jobportal-content-wrapper.jobportal-sidebar-left {
        grid-template-columns: 1fr;
    }

    .jobportal-posts-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .jobportal-page-hero-blog {
        padding: 110px 0 40px;
    }

    .jobportal-page-hero-blog .jobportal-page-hero-title {
        font-size: 32px;
    }

    .jobportal-page-hero-blog .jobportal-page-hero-description {
        font-size: 15px;
    }

    .jobportal-blog-section {
        padding: 50px 0;
    }

    .jobportal-content-wrapper {
        gap: 40px;
    }

    .jobportal-posts-grid {
        gap: 24px;
    }
}

@media (max-width: 480px) {
    .jobportal-page-hero-blog {
        padding: 100px 0 35px;
    }

    .jobportal-page-hero-blog .jobportal-page-hero-title {
        font-size: 28px;
    }
}
</style>

<section class="jobportal-page-hero jobportal-page-hero-blog">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content">
            <span class="jobportal-section-label"><?php esc_html_e('Our Blog', 'jobportal'); ?></span>
            <h1 class="jobportal-page-hero-title">
                <?php
                if (is_home() && !is_front_page()) {
                    single_post_title();
                } else {
                    esc_html_e('Latest Articles', 'jobportal');
                }
                ?>
            </h1>
            <p class="jobportal-page-hero-description">
                <?php esc_html_e('Stay updated with our latest news, insights, and stories from the world of technology and innovation.', 'jobportal'); ?>
            </p>
        </div>
    </div>
</section>

<section class="jobportal-blog-section">
    <div class="jobportal-container">
        <div class="jobportal-content-wrapper <?php echo esc_attr('jobportal-sidebar-' . $sidebar); ?>">

            <div class="jobportal-content-main">
                <?php if (have_posts()) : ?>

                <div class="jobportal-posts-<?php echo esc_attr($layout); ?>">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                    <?php endwhile; ?>
                </div>

                <div class="jobportal-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => jobportal_get_icon('arrow-left', 20) . '<span>' . esc_html__('Previous', 'jobportal') . '</span>',
                        'next_text' => '<span>' . esc_html__('Next', 'jobportal') . '</span>' . jobportal_get_icon('arrow-right', 20),
                    ));
                    ?>
                </div>

                <?php else : ?>

                <div class="jobportal-no-posts">
                    <div class="jobportal-no-posts-icon">
                        <?php jobportal_icon('search', 64); ?>
                    </div>
                    <h2><?php esc_html_e('No posts found', 'jobportal'); ?></h2>
                    <p><?php esc_html_e('It seems we cannot find what you are looking for. Perhaps searching can help.', 'jobportal'); ?></p>
                    <?php get_search_form(); ?>
                </div>

                <?php endif; ?>
            </div>

            <?php if ($sidebar !== 'none') : ?>
            <aside class="jobportal-sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php
get_footer();
