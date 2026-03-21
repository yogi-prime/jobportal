<?php
/**
 * SEO Dashboard & Analysis
 * Complete SEO overview for all pages, posts, jobs, etc.
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Analyze SEO for a post
 */
function jobportal_analyze_post_seo($post_id) {
    $post = get_post($post_id);
    if (!$post) return null;

    $content = $post->post_content;
    $title = $post->post_title;
    $excerpt = $post->post_excerpt;

    $issues = array();
    $warnings = array();
    $passed = array();
    $score = 100;

    // 1. Meta Title Check
    $meta_title = get_post_meta($post_id, '_yoast_wpseo_title', true) ?: $title;
    $title_length = strlen($meta_title);

    if ($title_length < 30) {
        $issues[] = 'Meta title too short (less than 30 characters)';
        $score -= 10;
    } elseif ($title_length > 60) {
        $warnings[] = 'Meta title too long (more than 60 characters)';
        $score -= 5;
    } else {
        $passed[] = 'Meta title length is optimal';
    }

    // 2. Meta Description Check
    $meta_desc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true) ?: $excerpt;
    $desc_length = strlen($meta_desc);

    if (empty($meta_desc)) {
        $issues[] = 'Meta description is missing';
        $score -= 15;
    } elseif ($desc_length < 120) {
        $warnings[] = 'Meta description too short (less than 120 characters)';
        $score -= 5;
    } elseif ($desc_length > 160) {
        $warnings[] = 'Meta description too long (more than 160 characters)';
        $score -= 5;
    } else {
        $passed[] = 'Meta description length is optimal';
    }

    // 3. Content Length Check
    $word_count = str_word_count(strip_tags($content));

    if ($word_count < 300) {
        $issues[] = "Content too short ($word_count words). Aim for at least 300 words.";
        $score -= 15;
    } elseif ($word_count < 600) {
        $warnings[] = "Content length is acceptable but could be longer ($word_count words)";
        $score -= 5;
    } else {
        $passed[] = "Content length is good ($word_count words)";
    }

    // 4. Image Alt Text Check
    $images_without_alt = 0;
    preg_match_all('/<img[^>]+>/i', $content, $images);
    foreach ($images[0] as $img) {
        if (!preg_match('/alt=["\'](.+?)["\']/i', $img)) {
            $images_without_alt++;
        }
    }

    if ($images_without_alt > 0) {
        $issues[] = "$images_without_alt images missing alt text";
        $score -= ($images_without_alt * 2);
    } else if (count($images[0]) > 0) {
        $passed[] = 'All images have alt text';
    }

    // 5. Heading Structure Check
    $has_h1 = preg_match('/<h1/i', $content);
    $h2_count = preg_match_all('/<h2/i', $content);

    if (!$has_h1) {
        $warnings[] = 'No H1 heading found in content';
        $score -= 5;
    } else {
        $passed[] = 'H1 heading present';
    }

    if ($h2_count < 2 && $word_count > 500) {
        $warnings[] = 'Consider adding more H2 headings for better structure';
        $score -= 3;
    }

    // 6. Internal Links Check
    $internal_links = preg_match_all('/href=["\']' . preg_quote(home_url(), '/') . '/i', $content);

    if ($internal_links < 2) {
        $warnings[] = 'Add more internal links to other pages';
        $score -= 5;
    } else {
        $passed[] = "Good internal linking ($internal_links links)";
    }

    // 7. External Links Check
    $external_links = preg_match_all('/<a[^>]+href=["\'](https?:\/\/(?!' . preg_quote(home_url(), '/') . '))/i', $content);

    if ($external_links > 10) {
        $warnings[] = 'Too many external links might affect SEO';
        $score -= 3;
    }

    // 8. Keyword in Title
    $focus_keyword = get_post_meta($post_id, '_yoast_wpseo_focuskw', true);
    if ($focus_keyword && stripos($title, $focus_keyword) === false) {
        $warnings[] = 'Focus keyword not found in title';
        $score -= 5;
    } elseif ($focus_keyword) {
        $passed[] = 'Focus keyword present in title';
    }

    // 9. Readability - Sentence Length
    $sentences = preg_split('/[.!?]+/', strip_tags($content));
    $long_sentences = 0;
    foreach ($sentences as $sentence) {
        if (str_word_count($sentence) > 25) {
            $long_sentences++;
        }
    }

    if ($long_sentences > count($sentences) * 0.3) {
        $warnings[] = 'Many sentences are too long. Aim for 20 words or less.';
        $score -= 5;
    } else {
        $passed[] = 'Sentence length is good for readability';
    }

    // 10. Permalink Structure
    $permalink = get_permalink($post_id);
    $slug = basename(parse_url($permalink, PHP_URL_PATH));

    if (strlen($slug) > 75) {
        $warnings[] = 'URL slug is too long';
        $score -= 3;
    } else {
        $passed[] = 'URL slug length is optimal';
    }

    // 11. Last Modified Date
    $last_modified = strtotime($post->post_modified);
    $days_old = (time() - $last_modified) / (60 * 60 * 24);

    if ($days_old > 365) {
        $warnings[] = 'Content is over 1 year old. Consider updating it.';
    }

    // Calculate final score
    $score = max(0, min(100, $score));

    // Determine grade
    if ($score >= 90) {
        $grade = 'A';
        $grade_class = 'excellent';
    } elseif ($score >= 75) {
        $grade = 'B';
        $grade_class = 'good';
    } elseif ($score >= 60) {
        $grade = 'C';
        $grade_class = 'average';
    } elseif ($score >= 40) {
        $grade = 'D';
        $grade_class = 'poor';
    } else {
        $grade = 'F';
        $grade_class = 'critical';
    }

    return array(
        'score' => $score,
        'grade' => $grade,
        'grade_class' => $grade_class,
        'issues' => $issues,
        'warnings' => $warnings,
        'passed' => $passed,
        'word_count' => $word_count,
        'internal_links' => $internal_links,
        'external_links' => $external_links,
        'images_count' => count($images[0]),
        'images_without_alt' => $images_without_alt,
        'title_length' => $title_length,
        'desc_length' => $desc_length,
    );
}

/**
 * Get All Content SEO Overview
 */
function jobportal_get_seo_overview() {
    $post_types = array('post', 'page', 'job', 'company');
    $overview = array(
        'total_content' => 0,
        'excellent' => 0,
        'good' => 0,
        'needs_improvement' => 0,
        'critical' => 0,
        'average_score' => 0,
        'total_issues' => 0,
        'by_type' => array(),
    );

    $total_score = 0;

    foreach ($post_types as $post_type) {
        $posts = get_posts(array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ));

        $type_data = array(
            'total' => count($posts),
            'average_score' => 0,
            'issues' => 0,
        );

        $type_score = 0;

        foreach ($posts as $post) {
            $seo = jobportal_analyze_post_seo($post->ID);
            $total_score += $seo['score'];
            $type_score += $seo['score'];

            if ($seo['score'] >= 90) {
                $overview['excellent']++;
            } elseif ($seo['score'] >= 75) {
                $overview['good']++;
            } elseif ($seo['score'] >= 60) {
                $overview['needs_improvement']++;
            } else {
                $overview['critical']++;
            }

            $type_data['issues'] += count($seo['issues']);
            $overview['total_issues'] += count($seo['issues']);
        }

        if (count($posts) > 0) {
            $type_data['average_score'] = round($type_score / count($posts), 1);
        }

        $overview['by_type'][$post_type] = $type_data;
        $overview['total_content'] += count($posts);
    }

    if ($overview['total_content'] > 0) {
        $overview['average_score'] = round($total_score / $overview['total_content'], 1);
    }

    return $overview;
}

/**
 * SEO Dashboard Page Content
 */
function jobportal_seo_dashboard_content() {
    if (!current_user_can('manage_options')) {
        return '<p>You do not have permission to access this page.</p>';
    }

    $overview = jobportal_get_seo_overview();

    // Get all content with SEO analysis
    $post_types = array('post', 'page', 'job', 'company');
    $all_content = array();

    foreach ($post_types as $post_type) {
        $posts = get_posts(array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ));

        foreach ($posts as $post) {
            $seo = jobportal_analyze_post_seo($post->ID);
            $all_content[] = array(
                'post' => $post,
                'seo' => $seo,
                'type' => $post_type,
            );
        }
    }

    // Sort by SEO score (worst first)
    usort($all_content, function($a, $b) {
        return $a['seo']['score'] - $b['seo']['score'];
    });

    ob_start();
    ?>
    <div class="seo-dashboard">
        <div class="seo-header">
            <h1>🎯 SEO Dashboard</h1>
            <p>Complete SEO analysis for all your content</p>
        </div>

        <!-- Overview Stats -->
        <div class="seo-overview-grid">
            <div class="seo-stat-card excellent">
                <div class="stat-icon">📈</div>
                <div class="stat-value"><?php echo $overview['average_score']; ?>%</div>
                <div class="stat-label">Average SEO Score</div>
            </div>

            <div class="seo-stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-value"><?php echo $overview['total_content']; ?></div>
                <div class="stat-label">Total Content</div>
            </div>

            <div class="seo-stat-card critical">
                <div class="stat-icon">⚠️</div>
                <div class="stat-value"><?php echo $overview['total_issues']; ?></div>
                <div class="stat-label">Total Issues</div>
            </div>

            <div class="seo-stat-card excellent">
                <div class="stat-icon">✅</div>
                <div class="stat-value"><?php echo $overview['excellent']; ?></div>
                <div class="stat-label">Excellent (90+)</div>
            </div>

            <div class="seo-stat-card good">
                <div class="stat-icon">👍</div>
                <div class="stat-value"><?php echo $overview['good']; ?></div>
                <div class="stat-label">Good (75-89)</div>
            </div>

            <div class="seo-stat-card average">
                <div class="stat-icon">⚡</div>
                <div class="stat-value"><?php echo $overview['needs_improvement']; ?></div>
                <div class="stat-label">Needs Work (60-74)</div>
            </div>

            <div class="seo-stat-card critical">
                <div class="stat-icon">🔴</div>
                <div class="stat-value"><?php echo $overview['critical']; ?></div>
                <div class="stat-label">Critical (<60)</div>
            </div>
        </div>

        <!-- Content Type Breakdown -->
        <div class="seo-section">
            <h2>📊 By Content Type</h2>
            <div class="type-breakdown-grid">
                <?php foreach ($overview['by_type'] as $type => $data): ?>
                    <div class="type-card">
                        <h3><?php echo ucfirst($type); ?>s</h3>
                        <div class="type-stats">
                            <div class="type-stat">
                                <span class="stat-label">Total</span>
                                <span class="stat-value"><?php echo $data['total']; ?></span>
                            </div>
                            <div class="type-stat">
                                <span class="stat-label">Avg Score</span>
                                <span class="stat-value"><?php echo $data['average_score']; ?>%</span>
                            </div>
                            <div class="type-stat">
                                <span class="stat-label">Issues</span>
                                <span class="stat-value"><?php echo $data['issues']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- All Content Table -->
        <div class="seo-section">
            <h2>🔍 All Content Analysis (Worst First)</h2>
            <div class="seo-table-container">
                <table class="seo-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Score</th>
                            <th>Issues</th>
                            <th>Warnings</th>
                            <th>Words</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_content as $item): ?>
                            <tr class="seo-row">
                                <td>
                                    <strong><?php echo esc_html($item['post']->post_title); ?></strong>
                                </td>
                                <td>
                                    <span class="type-badge"><?php echo esc_html($item['type']); ?></span>
                                </td>
                                <td>
                                    <div class="score-badge score-<?php echo $item['seo']['grade_class']; ?>">
                                        <?php echo $item['seo']['score']; ?>% (<?php echo $item['seo']['grade']; ?>)
                                    </div>
                                </td>
                                <td>
                                    <span class="issue-count"><?php echo count($item['seo']['issues']); ?></span>
                                </td>
                                <td>
                                    <span class="warning-count"><?php echo count($item['seo']['warnings']); ?></span>
                                </td>
                                <td><?php echo number_format($item['seo']['word_count']); ?></td>
                                <td>
                                    <button class="view-details-btn" data-post-id="<?php echo $item['post']->ID; ?>">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                            <tr class="seo-details" id="details-<?php echo $item['post']->ID; ?>" style="display: none;">
                                <td colspan="7">
                                    <div class="details-content">
                                        <?php if (!empty($item['seo']['issues'])): ?>
                                            <div class="details-section issues-section">
                                                <h4>🔴 Critical Issues</h4>
                                                <ul>
                                                    <?php foreach ($item['seo']['issues'] as $issue): ?>
                                                        <li><?php echo esc_html($issue); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($item['seo']['warnings'])): ?>
                                            <div class="details-section warnings-section">
                                                <h4>⚠️ Warnings</h4>
                                                <ul>
                                                    <?php foreach ($item['seo']['warnings'] as $warning): ?>
                                                        <li><?php echo esc_html($warning); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($item['seo']['passed'])): ?>
                                            <div class="details-section passed-section">
                                                <h4>✅ What's Good</h4>
                                                <ul>
                                                    <?php foreach ($item['seo']['passed'] as $passed): ?>
                                                        <li><?php echo esc_html($passed); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <div class="details-actions">
                                            <a href="<?php echo get_edit_post_link($item['post']->ID); ?>" class="btn-edit">Edit Content</a>
                                            <a href="<?php echo get_permalink($item['post']->ID); ?>" class="btn-view" target="_blank">View Page</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SEO Best Practices -->
        <div class="seo-section">
            <h2>💡 SEO Best Practices</h2>
            <div class="best-practices-grid">
                <div class="practice-card">
                    <div class="practice-icon">📝</div>
                    <h3>Meta Titles</h3>
                    <p>Keep titles between 30-60 characters. Include focus keyword.</p>
                </div>
                <div class="practice-card">
                    <div class="practice-icon">📄</div>
                    <h3>Meta Descriptions</h3>
                    <p>Write 120-160 character descriptions that entice clicks.</p>
                </div>
                <div class="practice-card">
                    <div class="practice-icon">✍️</div>
                    <h3>Content Length</h3>
                    <p>Aim for 600+ words for better rankings. Quality over quantity.</p>
                </div>
                <div class="practice-card">
                    <div class="practice-icon">🖼️</div>
                    <h3>Image Alt Text</h3>
                    <p>Always add descriptive alt text to all images.</p>
                </div>
                <div class="practice-card">
                    <div class="practice-icon">🔗</div>
                    <h3>Internal Links</h3>
                    <p>Link to 2-5 related pages within your site.</p>
                </div>
                <div class="practice-card">
                    <div class="practice-icon">📱</div>
                    <h3>Mobile Friendly</h3>
                    <p>Ensure all content works well on mobile devices.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .seo-dashboard {
            max-width: 1600px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .seo-header {
            margin-bottom: 40px;
        }

        .seo-header h1 {
            font-size: 42px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 8px;
        }

        .seo-header p {
            font-size: 18px;
            color: #64748b;
            margin: 0;
        }

        .seo-overview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .seo-stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #667eea;
            text-align: center;
        }

        .seo-stat-card.excellent {
            border-left-color: #10b981;
        }

        .seo-stat-card.good {
            border-left-color: #3b82f6;
        }

        .seo-stat-card.average {
            border-left-color: #f59e0b;
        }

        .seo-stat-card.critical {
            border-left-color: #ef4444;
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
        }

        .seo-section {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 32px;
        }

        .seo-section h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 24px;
        }

        .type-breakdown-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .type-card {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #667eea;
        }

        .type-card h3 {
            font-size: 18px;
            margin: 0 0 16px;
            color: #667eea;
        }

        .type-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .type-stat {
            text-align: center;
        }

        .type-stat .stat-label {
            display: block;
            font-size: 11px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .type-stat .stat-value {
            display: block;
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
        }

        .seo-table-container {
            overflow-x: auto;
        }

        .seo-table {
            width: 100%;
            border-collapse: collapse;
        }

        .seo-table th {
            background: #f8fafc;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }

        .seo-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .type-badge {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .score-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 13px;
            display: inline-block;
        }

        .score-excellent {
            background: #d1fae5;
            color: #065f46;
        }

        .score-good {
            background: #dbeafe;
            color: #1e40af;
        }

        .score-average {
            background: #fef3c7;
            color: #92400e;
        }

        .score-poor, .score-critical {
            background: #fee2e2;
            color: #991b1b;
        }

        .issue-count, .warning-count {
            background: #fecaca;
            color: #991b1b;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .warning-count {
            background: #fef3c7;
            color: #92400e;
        }

        .view-details-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
        }

        .seo-details .details-content {
            background: #f8fafc;
            padding: 24px;
            border-radius: 8px;
        }

        .details-section {
            margin-bottom: 20px;
        }

        .details-section h4 {
            font-size: 16px;
            margin: 0 0 12px;
        }

        .details-section ul {
            margin: 0;
            padding-left: 20px;
        }

        .details-section li {
            margin-bottom: 8px;
            color: #475569;
        }

        .issues-section h4 {
            color: #dc2626;
        }

        .warnings-section h4 {
            color: #f59e0b;
        }

        .passed-section h4 {
            color: #10b981;
        }

        .details-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-edit, .btn-view {
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-edit {
            background: #667eea;
            color: white;
        }

        .btn-view {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .best-practices-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .practice-card {
            padding: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .practice-card:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .practice-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .practice-card h3 {
            font-size: 16px;
            margin: 0 0 8px;
            color: #1e293b;
        }

        .practice-card p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
            line-height: 1.6;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            $('.view-details-btn').on('click', function() {
                const postId = $(this).data('post-id');
                $('#details-' + postId).toggle();
                $(this).text($(this).text() === 'View Details' ? 'Hide Details' : 'View Details');
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

/**
 * Add SEO Dashboard to Admin Panel
 */
function jobportal_add_seo_to_admin_stats($stats) {
    $seo_overview = jobportal_get_seo_overview();

    $stats['seo'] = array(
        'average_score' => $seo_overview['average_score'],
        'total_content' => $seo_overview['total_content'],
        'critical_issues' => $seo_overview['critical'],
        'needs_improvement' => $seo_overview['needs_improvement'],
    );

    return $stats;
}
add_filter('jobportal_dashboard_stats', 'jobportal_add_seo_to_admin_stats');

/**
 * Shortcode for SEO Dashboard
 */
function jobportal_seo_dashboard_shortcode() {
    return jobportal_seo_dashboard_content();
}
add_shortcode('jobportal_seo_dashboard', 'jobportal_seo_dashboard_shortcode');
