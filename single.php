<?php
/**
 * Single Post Template - Premium Professional Design
 *
 * @package JobPortal
 */

get_header();

$sidebar = get_theme_mod('jobportal_blog_sidebar', 'right');
?>

<style>
/* Premium Single Post Design */
.jobportal-single-post {
    background: #ffffff;
    width: 100%;
    max-width: 100%;
    margin: 0;
    padding: 0;
}

/* Hero Header with Gradient - FULL WIDTH */
.jobportal-single-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 120px 0 50px;
    position: relative;
    overflow: hidden;
    width: 100%;
    margin: 0;
}

.jobportal-single-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    pointer-events: none;
}

.jobportal-single-hero-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 30px;
    position: relative;
    z-index: 1;
}

/* Post Meta */
.jobportal-single-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}

.jobportal-single-category {
    display: inline-flex;
    align-items: center;
    padding: 8px 18px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    border-radius: 25px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s;
}

.jobportal-single-category:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.jobportal-single-date,
.jobportal-single-read-time {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

.jobportal-single-date svg,
.jobportal-single-read-time svg {
    opacity: 0.8;
}

/* Post Title */
.jobportal-single-title {
    font-size: 38px;
    font-weight: 800;
    line-height: 1.3;
    color: white;
    margin: 0 0 28px 0;
    letter-spacing: -0.01em;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
}

/* Author Info */
.jobportal-single-author {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 24px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: inline-flex;
}

.jobportal-single-author img {
    border-radius: 50%;
    width: 48px;
    height: 48px;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.jobportal-single-author-info {
    display: flex;
    flex-direction: column;
}

.jobportal-single-author-label {
    font-size: 11px;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}

.jobportal-single-author-name {
    font-weight: 700;
    font-size: 16px;
    color: white;
}

/* Featured Image */
.jobportal-single-featured {
    margin-top: -60px;
    margin-bottom: 50px;
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 30px;
}

.jobportal-single-featured img {
    width: 100%;
    height: auto;
    border-radius: 16px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    display: block;
}

/* Content Area */
.jobportal-single-content-area {
    padding: 0 0 60px;
    background: #f8fafc;
    width: 100%;
}

.jobportal-single-wrapper {
    display: grid;
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 30px;
}

.jobportal-single-wrapper.has-sidebar {
    grid-template-columns: 1fr 340px;
}

.jobportal-single-wrapper.no-sidebar {
    grid-template-columns: 1fr;
    max-width: 900px;
}

/* Post Content */
.jobportal-single-main {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
}

.jobportal-entry-content {
    font-size: 16px;
    line-height: 1.7;
    color: #334155;
    margin-bottom: 40px;
}

.jobportal-entry-content p {
    margin-bottom: 24px;
}

.jobportal-entry-content h2 {
    font-size: 26px;
    font-weight: 700;
    color: #1e293b;
    margin: 36px 0 18px 0;
    line-height: 1.4;
    position: relative;
    padding-bottom: 12px;
}

.jobportal-entry-content h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.jobportal-entry-content h3 {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin: 28px 0 16px 0;
}

.jobportal-entry-content ul,
.jobportal-entry-content ol {
    margin: 24px 0;
    padding-left: 30px;
}

.jobportal-entry-content li {
    margin-bottom: 12px;
}

.jobportal-entry-content blockquote {
    margin: 32px 0;
    padding: 20px 24px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-left: 4px solid #667eea;
    border-radius: 0 10px 10px 0;
    font-size: 16px;
    font-style: italic;
    color: #475569;
}

.jobportal-entry-content a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    transition: all 0.3s;
}

.jobportal-entry-content a:hover {
    border-bottom-color: #667eea;
}

.jobportal-entry-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 32px 0;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

/* Tags */
.jobportal-post-tags {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    padding: 28px;
    background: #f8fafc;
    border-radius: 16px;
    margin-bottom: 30px;
}

.jobportal-tags-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
}

.jobportal-tag {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    background: white;
    color: #667eea;
    text-decoration: none;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    border: 2px solid #667eea;
    transition: all 0.3s;
}

.jobportal-tag:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

/* Share Section */
.jobportal-post-share {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 28px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    margin-bottom: 40px;
}

.jobportal-share-label {
    font-weight: 700;
    color: white;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.jobportal-share-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.jobportal-share-links {
    display: flex;
    gap: 10px;
}

.jobportal-share-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all 0.3s;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.jobportal-share-link:hover {
    background: white;
    color: #667eea;
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Post Navigation */
.jobportal-post-nav {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 50px;
}

.jobportal-nav-link {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    text-decoration: none;
    transition: all 0.3s;
}

.jobportal-nav-link:hover {
    border-color: #667eea;
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15);
    transform: translateY(-4px);
}

.jobportal-nav-link svg {
    flex-shrink: 0;
    color: #667eea;
}

.jobportal-nav-content {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.jobportal-nav-label {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.jobportal-nav-title {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.4;
}

/* Comments */
.jobportal-comments-section {
    padding: 40px;
    background: #f8fafc;
    border-radius: 16px;
}

/* Responsive */
@media (max-width: 1023px) {
    .jobportal-single-wrapper.has-sidebar {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .jobportal-single-hero {
        padding: 100px 0 40px;
    }

    .jobportal-single-hero-inner {
        padding: 0 20px;
    }

    .jobportal-single-title {
        font-size: 26px;
    }

    .jobportal-single-main {
        padding: 24px 20px;
    }

    .jobportal-entry-content {
        font-size: 15px;
    }

    .jobportal-entry-content h2 {
        font-size: 22px;
    }

    .jobportal-entry-content h3 {
        font-size: 18px;
    }

    .jobportal-post-nav {
        grid-template-columns: 1fr;
    }

    .jobportal-post-share {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .jobportal-single-hero {
        padding: 90px 0 30px;
    }

    .jobportal-single-title {
        font-size: 22px;
    }

    .jobportal-entry-content {
        font-size: 14px;
    }
}
</style>

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('jobportal-single-post'); ?>>

    <!-- Hero Header -->
    <div class="jobportal-single-hero">
        <div class="jobportal-single-hero-inner">
            <div class="jobportal-single-meta">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                ?>
                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="jobportal-single-category">
                    <?php echo esc_html($categories[0]->name); ?>
                </a>
                <?php endif; ?>

                <span class="jobportal-single-date">
                    <?php echo jobportal_get_icon('calendar', 16); ?>
                    <?php echo get_the_date(); ?>
                </span>

                <span class="jobportal-single-read-time">
                    <?php echo jobportal_get_icon('clock', 16); ?>
                    <?php
                    $content = get_the_content();
                    $word_count = str_word_count(strip_tags($content));
                    $reading_time = ceil($word_count / 200);
                    printf(esc_html__('%d min read', 'jobportal'), $reading_time);
                    ?>
                </span>
            </div>

            <h1 class="jobportal-single-title"><?php the_title(); ?></h1>

            <div class="jobportal-single-author">
                <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
                <div class="jobportal-single-author-info">
                    <span class="jobportal-single-author-label"><?php esc_html_e('Written by', 'jobportal'); ?></span>
                    <span class="jobportal-single-author-name"><?php the_author(); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
    <div class="jobportal-single-featured">
        <?php the_post_thumbnail('jobportal-hero'); ?>
    </div>
    <?php endif; ?>

    <!-- Content Area -->
    <div class="jobportal-single-content-area">
        <div class="jobportal-single-wrapper <?php echo $sidebar !== 'none' ? 'has-sidebar' : 'no-sidebar'; ?>">

                <div class="jobportal-single-main">
                    <!-- Post Content -->
                    <div class="jobportal-entry-content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                    ?>
                    <div class="jobportal-post-tags">
                        <div class="jobportal-tags-icon">
                            🏷️
                        </div>
                        <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="jobportal-tag">
                            <?php echo esc_html($tag->name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Share -->
                    <div class="jobportal-post-share">
                        <div class="jobportal-share-label">
                            <div class="jobportal-share-icon">
                                <?php echo jobportal_get_icon('share-2', 20); ?>
                            </div>
                            <?php esc_html_e('Share Article', 'jobportal'); ?>
                        </div>
                        <div class="jobportal-share-links">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="jobportal-share-link">
                                <?php echo jobportal_get_icon('twitter', 20); ?>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="jobportal-share-link">
                                <?php echo jobportal_get_icon('facebook', 20); ?>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="jobportal-share-link">
                                <?php echo jobportal_get_icon('linkedin', 20); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Post Navigation -->
                    <nav class="jobportal-post-nav">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        <?php if ($prev_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="jobportal-nav-link">
                            <?php echo jobportal_get_icon('arrow-left', 24); ?>
                            <div class="jobportal-nav-content">
                                <span class="jobportal-nav-label"><?php esc_html_e('Previous', 'jobportal'); ?></span>
                                <span class="jobportal-nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                            </div>
                        </a>
                        <?php endif; ?>

                        <?php if ($next_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="jobportal-nav-link">
                            <div class="jobportal-nav-content">
                                <span class="jobportal-nav-label"><?php esc_html_e('Next', 'jobportal'); ?></span>
                                <span class="jobportal-nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                            </div>
                            <?php echo jobportal_get_icon('arrow-right', 24); ?>
                        </a>
                        <?php endif; ?>
                    </nav>

                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="jobportal-comments-section">
                        <?php comments_template(); ?>
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
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
