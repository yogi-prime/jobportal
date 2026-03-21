<?php
/**
 * Template part for displaying posts
 *
 * @package JobPortal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('jobportal-post-card'); ?>>
    <div class="jobportal-post-card-image">
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('jobportal-card'); ?>
            <?php else : ?>
                <div class="jobportal-post-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                </div>
            <?php endif; ?>
        </a>
    </div>

    <div class="jobportal-post-card-content">
        <div class="jobportal-post-card-meta">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) :
            ?>
            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="jobportal-post-card-category">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
            <?php endif; ?>
            <span class="jobportal-post-card-date">
                <?php jobportal_icon('clock', 14); ?>
                <?php echo get_the_date(); ?>
            </span>
        </div>

        <h2 class="jobportal-post-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <p class="jobportal-post-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

        <div class="jobportal-post-card-footer">
            <div class="jobportal-post-card-author">
                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                <span><?php the_author(); ?></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="jobportal-post-card-link">
                <?php esc_html_e('Read More', 'jobportal'); ?>
                <?php jobportal_icon('arrow-right', 16); ?>
            </a>
        </div>
    </div>
</article>
