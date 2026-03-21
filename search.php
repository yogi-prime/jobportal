<?php
/**
 * Search Results Template
 *
 * @package JobPortal
 */

get_header();
?>

<style>
/* Universal Hero - Consistent Across All Pages */
.jobportal-page-hero-small {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    padding: 140px 0 50px;
    position: relative;
    overflow: hidden;
}

.jobportal-page-hero-small::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    pointer-events: none;
}

.jobportal-page-hero-small .jobportal-section-label {
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

.jobportal-page-hero-small .jobportal-page-hero-title {
    color: white;
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 12px;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

.jobportal-page-hero-small .jobportal-page-hero-description {
    color: rgba(255, 255, 255, 0.95);
    font-size: 16px;
    line-height: 1.6;
    max-width: 600px;
}

/* Search Results Section */
.jobportal-search-results {
    padding: 80px 0;
    background: #f8fafc;
}

/* Responsive */
@media (max-width: 768px) {
    .jobportal-page-hero-small {
        padding: 110px 0 40px;
    }

    .jobportal-page-hero-small .jobportal-page-hero-title {
        font-size: 32px;
    }

    .jobportal-page-hero-small .jobportal-page-hero-description {
        font-size: 15px;
    }

    .jobportal-search-results {
        padding: 50px 0;
    }
}

@media (max-width: 480px) {
    .jobportal-page-hero-small {
        padding: 100px 0 35px;
    }

    .jobportal-page-hero-small .jobportal-page-hero-title {
        font-size: 28px;
    }
}
</style>

<section class="jobportal-page-hero jobportal-page-hero-small">
    <div class="jobportal-container">
        <div class="jobportal-page-hero-content">
            <span class="jobportal-section-label"><?php esc_html_e('Search Results', 'jobportal'); ?></span>
            <h1 class="jobportal-page-hero-title">
                <?php printf(esc_html__('Results for: "%s"', 'jobportal'), get_search_query()); ?>
            </h1>
            <p class="jobportal-page-hero-description">
                <?php
                global $wp_query;
                printf(
                    esc_html(_n('%d result found', '%d results found', $wp_query->found_posts, 'jobportal')),
                    $wp_query->found_posts
                );
                ?>
            </p>
        </div>
    </div>
</section>

<section class="jobportal-search-results">
    <div class="jobportal-container">
        <div class="jobportal-search-form-wrapper">
            <?php get_search_form(); ?>
        </div>

        <?php if (have_posts()) : ?>
        <div class="jobportal-search-grid">
            <?php while (have_posts()) : the_post(); ?>
            <article class="jobportal-search-result">
                <div class="jobportal-search-result-type">
                    <?php
                    $post_type = get_post_type();
                    $post_type_obj = get_post_type_object($post_type);
                    echo esc_html($post_type_obj->labels->singular_name);
                    ?>
                </div>

                <?php if (has_post_thumbnail()) : ?>
                <div class="jobportal-search-result-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('jobportal-thumbnail'); ?>
                    </a>
                </div>
                <?php endif; ?>

                <div class="jobportal-search-result-content">
                    <h2 class="jobportal-search-result-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="jobportal-search-result-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                    </p>
                    <div class="jobportal-search-result-meta">
                        <span class="jobportal-search-result-date">
                            <?php echo get_the_date(); ?>
                        </span>
                        <a href="<?php the_permalink(); ?>" class="jobportal-search-result-link">
                            <?php esc_html_e('Read More', 'jobportal'); ?>
                            <?php jobportal_icon('arrow-right', 16); ?>
                        </a>
                    </div>
                </div>
            </article>
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

        <!-- Modern No Results Section -->
        <style>
        .jobportal-no-results-modern {
            max-width: 800px;
            margin: 60px auto;
            text-align: center;
        }

        .jobportal-no-results-icon-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto 32px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .jobportal-no-results-icon-wrapper svg {
            color: #64748b;
        }

        .jobportal-no-results-modern h2 {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .jobportal-no-results-modern > p {
            font-size: 18px;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .jobportal-search-query-display {
            display: inline-block;
            padding: 8px 20px;
            background: #f1f5f9;
            border-radius: 20px;
            font-weight: 600;
            color: #4facfe;
            margin: 0 4px;
        }

        /* Suggestions Grid */
        .jobportal-suggestions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 48px;
            text-align: left;
        }

        .jobportal-suggestion-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            border: 2px solid #f1f5f9;
            transition: all 0.3s;
        }

        .jobportal-suggestion-card:hover {
            border-color: #4facfe;
            box-shadow: 0 8px 24px rgba(79, 172, 254, 0.15);
            transform: translateY(-4px);
        }

        .jobportal-suggestion-card-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: white;
        }

        .jobportal-suggestion-card h4 {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .jobportal-suggestion-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .jobportal-suggestion-card li {
            padding: 8px 0;
            color: #64748b;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .jobportal-suggestion-card li::before {
            content: '✓';
            color: #4facfe;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Popular Categories */
        .jobportal-popular-categories {
            margin-top: 48px;
            padding-top: 48px;
            border-top: 2px solid #f1f5f9;
        }

        .jobportal-popular-categories h3 {
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 24px;
            text-align: center;
        }

        .jobportal-categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .jobportal-category-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            transition: all 0.3s;
        }

        .jobportal-category-link:hover {
            background: white;
            border-color: #4facfe;
            color: #4facfe;
            transform: translateX(4px);
        }

        .jobportal-category-icon {
            flex-shrink: 0;
        }

        /* CTA Button */
        .jobportal-no-results-cta {
            margin-top: 40px;
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .jobportal-no-results-cta a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
        }

        .jobportal-no-results-cta .primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            box-shadow: 0 4px 16px rgba(79, 172, 254, 0.3);
        }

        .jobportal-no-results-cta .primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(79, 172, 254, 0.4);
        }

        .jobportal-no-results-cta .secondary {
            background: white;
            color: #4facfe;
            border: 2px solid #4facfe;
        }

        .jobportal-no-results-cta .secondary:hover {
            background: #4facfe;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .jobportal-no-results-modern h2 {
                font-size: 24px;
            }

            .jobportal-no-results-modern > p {
                font-size: 16px;
            }

            .jobportal-suggestions-grid {
                grid-template-columns: 1fr;
            }

            .jobportal-categories-grid {
                grid-template-columns: 1fr;
            }

            .jobportal-no-results-cta {
                flex-direction: column;
                align-items: stretch;
            }

            .jobportal-no-results-cta a {
                justify-content: center;
            }
        }
        </style>

        <div class="jobportal-no-results-modern">
            <!-- Icon -->
            <div class="jobportal-no-results-icon-wrapper">
                <?php echo jobportal_get_icon('search', 48); ?>
            </div>

            <!-- Main Message -->
            <h2><?php esc_html_e('No Results Found', 'jobportal'); ?></h2>
            <p>
                <?php esc_html_e('We couldn\'t find any matches for', 'jobportal'); ?>
                <span class="jobportal-search-query-display">"<?php echo esc_html(get_search_query()); ?>"</span>
                <br>
                <?php esc_html_e('But don\'t worry, we\'re here to help!', 'jobportal'); ?>
            </p>

            <!-- Suggestions Grid -->
            <div class="jobportal-suggestions-grid">
                <div class="jobportal-suggestion-card">
                    <div class="jobportal-suggestion-card-icon">
                        <?php echo jobportal_get_icon('check', 24); ?>
                    </div>
                    <h4><?php esc_html_e('Check Your Spelling', 'jobportal'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Make sure all words are spelled correctly', 'jobportal'); ?></li>
                        <li><?php esc_html_e('Try removing quotes from your search', 'jobportal'); ?></li>
                    </ul>
                </div>

                <div class="jobportal-suggestion-card">
                    <div class="jobportal-suggestion-card-icon">
                        <?php echo jobportal_get_icon('compass', 24); ?>
                    </div>
                    <h4><?php esc_html_e('Broaden Your Search', 'jobportal'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Try more general keywords', 'jobportal'); ?></li>
                        <li><?php esc_html_e('Use fewer keywords', 'jobportal'); ?></li>
                    </ul>
                </div>

                <div class="jobportal-suggestion-card">
                    <div class="jobportal-suggestion-card-icon">
                        <?php echo jobportal_get_icon('zap', 24); ?>
                    </div>
                    <h4><?php esc_html_e('Try Alternatives', 'jobportal'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Try different or similar keywords', 'jobportal'); ?></li>
                        <li><?php esc_html_e('Use synonyms or related terms', 'jobportal'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="jobportal-no-results-cta">
                <a href="<?php echo home_url('/jobs'); ?>" class="primary">
                    <?php echo jobportal_get_icon('briefcase', 20); ?>
                    <?php esc_html_e('Browse All Jobs', 'jobportal'); ?>
                </a>
                <a href="<?php echo home_url('/job-matcher'); ?>" class="secondary">
                    <?php echo jobportal_get_icon('target', 20); ?>
                    <?php esc_html_e('Find Jobs for Me', 'jobportal'); ?>
                </a>
            </div>

            <!-- Popular Categories -->
            <div class="jobportal-popular-categories">
                <h3><?php esc_html_e('Explore Popular Categories', 'jobportal'); ?></h3>
                <div class="jobportal-categories-grid">
                    <a href="<?php echo home_url('/jobs?category=technology'); ?>" class="jobportal-category-link">
                        <span class="jobportal-category-icon"><?php echo jobportal_get_icon('laptop', 20); ?></span>
                        <?php esc_html_e('Technology', 'jobportal'); ?>
                    </a>
                    <a href="<?php echo home_url('/jobs?category=design'); ?>" class="jobportal-category-link">
                        <span class="jobportal-category-icon"><?php echo jobportal_get_icon('palette', 20); ?></span>
                        <?php esc_html_e('Design', 'jobportal'); ?>
                    </a>
                    <a href="<?php echo home_url('/jobs?category=marketing'); ?>" class="jobportal-category-link">
                        <span class="jobportal-category-icon"><?php echo jobportal_get_icon('trending-up', 20); ?></span>
                        <?php esc_html_e('Marketing', 'jobportal'); ?>
                    </a>
                    <a href="<?php echo home_url('/jobs?category=business'); ?>" class="jobportal-category-link">
                        <span class="jobportal-category-icon"><?php echo jobportal_get_icon('briefcase', 20); ?></span>
                        <?php esc_html_e('Business', 'jobportal'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
