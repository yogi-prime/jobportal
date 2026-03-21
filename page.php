<?php
/**
 * Page Template
 *
 * @package JobPortal
 */

get_header();
?>

<style>
/* Universal Hero - Consistent Across All Pages */
.jobportal-page-hero-default {
    background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
    padding: 140px 0 50px;
    position: relative;
    overflow: hidden;
}

.jobportal-page-hero-default::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    pointer-events: none;
}

.jobportal-page-hero-default .jobportal-page-hero-title {
    color: white;
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 0;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

/* Page Content Section */
.jobportal-page-content-section {
    padding: 80px 0;
    background: #f8fafc;
}

/* Responsive */
@media (max-width: 768px) {
    .jobportal-page-hero-default {
        padding: 110px 0 40px;
    }

    .jobportal-page-hero-default .jobportal-page-hero-title {
        font-size: 32px;
    }

    .jobportal-page-content-section {
        padding: 50px 0;
    }
}

@media (max-width: 480px) {
    .jobportal-page-hero-default {
        padding: 100px 0 35px;
    }

    .jobportal-page-hero-default .jobportal-page-hero-title {
        font-size: 28px;
    }
}
</style>

<?php while (have_posts()) : the_post(); ?>

<!-- Universal Hero Section -->
<section class="jobportal-page-hero jobportal-page-hero-default">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content">
            <h1 class="jobportal-page-hero-title"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<section class="jobportal-page-content-section">
<article id="post-<?php the_ID(); ?>" <?php post_class('jobportal-page'); ?>>

    <div class="jobportal-container">
        <div class="jobportal-page-content">
            <?php if (has_post_thumbnail()) : ?>
            <div class="jobportal-featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <?php endif; ?>

            <div class="jobportal-entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'jobportal'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <?php if (comments_open() || get_comments_number()) : ?>
            <div class="jobportal-comments-section">
                <?php comments_template(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</article>
</section>

<?php endwhile; ?>

<?php
get_footer();
