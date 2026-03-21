<?php
/**
 * Social Feed System - LinkedIn Style
 * Users can create posts, like, comment, use hashtags
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Social Post Custom Post Type
 */
function jobportal_register_social_post_type() {
    $labels = array(
        'name'               => 'Social Posts',
        'singular_name'      => 'Social Post',
        'menu_name'          => 'Social Feed',
        'add_new'            => 'Create Post',
        'add_new_item'       => 'Create New Post',
        'edit_item'          => 'Edit Post',
        'new_item'           => 'New Post',
        'view_item'          => 'View Post',
        'search_items'       => 'Search Posts',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'feed'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 27,
        'menu_icon'           => 'dashicons-megaphone',
        'supports'            => array('title', 'editor', 'author', 'thumbnail', 'comments'),
    );

    register_post_type('social_post', $args);
}
add_action('init', 'jobportal_register_social_post_type');

/**
 * Register Hashtag Taxonomy
 */
function jobportal_register_hashtag_taxonomy() {
    $labels = array(
        'name'              => 'Hashtags',
        'singular_name'     => 'Hashtag',
        'search_items'      => 'Search Hashtags',
        'all_items'         => 'All Hashtags',
        'edit_item'         => 'Edit Hashtag',
        'update_item'       => 'Update Hashtag',
        'add_new_item'      => 'Add New Hashtag',
        'new_item_name'     => 'New Hashtag Name',
        'menu_name'         => 'Hashtags',
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'hashtag'),
    );

    register_taxonomy('hashtag', array('social_post'), $args);
}
add_action('init', 'jobportal_register_hashtag_taxonomy');

/**
 * AJAX: Create Social Post
 */
function jobportal_ajax_create_social_post() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to post'));
    }

    $content = isset($_POST['content']) ? wp_kses_post($_POST['content']) : '';
    $image = isset($_POST['image']) ? esc_url_raw($_POST['image']) : '';

    if (empty($content)) {
        wp_send_json_error(array('message' => 'Post content cannot be empty'));
    }

    // Extract hashtags
    preg_match_all('/#(\w+)/', $content, $matches);
    $hashtags = $matches[1];

    // Create post
    $post_data = array(
        'post_type'    => 'social_post',
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_author'  => get_current_user_id(),
    );

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => 'Failed to create post'));
    }

    // Add hashtags
    if (!empty($hashtags)) {
        wp_set_post_terms($post_id, $hashtags, 'hashtag');
    }

    // Save image if provided
    if ($image) {
        update_post_meta($post_id, '_post_image', $image);
    }

    wp_send_json_success(array(
        'message' => 'Post created successfully',
        'post_id' => $post_id,
    ));
}
add_action('wp_ajax_jobportal_create_social_post', 'jobportal_ajax_create_social_post');

/**
 * AJAX: Like Post
 */
function jobportal_ajax_like_post() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to like'));
    }

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    // Get current likes
    $likes = get_post_meta($post_id, '_post_likes', true);
    if (!is_array($likes)) {
        $likes = array();
    }

    // Toggle like
    if (in_array($user_id, $likes)) {
        // Unlike
        $likes = array_diff($likes, array($user_id));
        $action = 'unliked';
    } else {
        // Like
        $likes[] = $user_id;
        $action = 'liked';
    }

    update_post_meta($post_id, '_post_likes', $likes);

    wp_send_json_success(array(
        'action' => $action,
        'count' => count($likes),
    ));
}
add_action('wp_ajax_jobportal_like_post', 'jobportal_ajax_like_post');

/**
 * AJAX: Add Comment
 */
function jobportal_ajax_add_comment() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to comment'));
    }

    $post_id = intval($_POST['post_id']);
    $comment_text = sanitize_textarea_field($_POST['comment']);

    if (empty($comment_text)) {
        wp_send_json_error(array('message' => 'Comment cannot be empty'));
    }

    $comment_data = array(
        'comment_post_ID' => $post_id,
        'comment_author' => wp_get_current_user()->display_name,
        'comment_author_email' => wp_get_current_user()->user_email,
        'comment_content' => $comment_text,
        'comment_approved' => 1,
        'user_id' => get_current_user_id(),
    );

    $comment_id = wp_insert_comment($comment_data);

    if ($comment_id) {
        wp_send_json_success(array(
            'message' => 'Comment added',
            'comment_id' => $comment_id,
        ));
    } else {
        wp_send_json_error(array('message' => 'Failed to add comment'));
    }
}
add_action('wp_ajax_jobportal_add_comment', 'jobportal_ajax_add_comment');

/**
 * Get Social Feed
 */
function jobportal_get_social_feed($args = array()) {
    $defaults = array(
        'post_type' => 'social_post',
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $args = wp_parse_args($args, $defaults);
    return get_posts($args);
}

/**
 * Get Trending Hashtags
 */
function jobportal_get_trending_hashtags($limit = 10) {
    $hashtags = get_terms(array(
        'taxonomy' => 'hashtag',
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => $limit,
    ));

    return $hashtags;
}

/**
 * Social Feed Shortcode
 */
function jobportal_social_feed_shortcode($atts) {
    if (!is_user_logged_in()) {
        ob_start();
        jobportal_job_application_login_gate();
        return ob_get_clean();
    }

    $current_user = wp_get_current_user();
    $posts = jobportal_get_social_feed();
    $trending_hashtags = jobportal_get_trending_hashtags(5);

    ob_start();
    ?>
    <div class="jobportal-social-feed">
        <div class="social-feed-container">
            <!-- Create Post Section -->
            <div class="create-post-card">
                <div class="create-post-header">
                    <div class="user-avatar">
                        <?php echo get_avatar($current_user->ID, 48); ?>
                    </div>
                    <input type="text"
                           id="createPostInput"
                           class="create-post-input"
                           placeholder="Share your thoughts, <?php echo esc_attr($current_user->display_name); ?>...">
                </div>
            </div>

            <!-- Create Post Modal -->
            <div id="createPostModal" class="social-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Create a post</h3>
                        <span class="modal-close">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="post-author-info">
                            <?php echo get_avatar($current_user->ID, 48); ?>
                            <div>
                                <strong><?php echo esc_html($current_user->display_name); ?></strong>
                                <p>Posting to JobPortal Community</p>
                            </div>
                        </div>
                        <textarea id="postContent" placeholder="What do you want to talk about? Use #hashtags to reach more people..."></textarea>
                        <div class="post-tools">
                            <button class="tool-btn" title="Add emoji">😊</button>
                            <button class="tool-btn" title="Add image">📷</button>
                            <button class="tool-btn" title="Add hashtag">#</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="publishPost" class="btn-publish">Publish</button>
                    </div>
                </div>
            </div>

            <!-- Social Feed -->
            <div class="social-posts">
                <?php if (empty($posts)): ?>
                    <div class="no-posts">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <h3>No posts yet</h3>
                        <p>Be the first to share something with the community!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($posts as $post):
                        $author = get_userdata($post->post_author);
                        $likes = get_post_meta($post->ID, '_post_likes', true);
                        if (!is_array($likes)) $likes = array();
                        $like_count = count($likes);
                        $is_liked = in_array(get_current_user_id(), $likes);
                        $comments = get_comments(array('post_id' => $post->ID));
                        $hashtags = wp_get_post_terms($post->ID, 'hashtag');
                    ?>
                        <div class="social-post-card" data-post-id="<?php echo esc_attr($post->ID); ?>">
                            <div class="post-header">
                                <div class="post-author">
                                    <?php echo get_avatar($post->post_author, 48); ?>
                                    <div class="author-info">
                                        <strong><?php echo esc_html($author->display_name); ?></strong>
                                        <span class="post-meta">
                                            <?php
                                            $user_type = get_user_meta($post->post_author, '_user_type', true);
                                            echo esc_html($user_type === 'employer' ? 'Employer' : 'Job Seeker');
                                            ?> •
                                            <?php echo human_time_diff(strtotime($post->post_date), current_time('timestamp')); ?> ago
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="post-content">
                                <?php echo wpautop(make_clickable($post->post_content)); ?>

                                <?php if (!empty($hashtags)): ?>
                                    <div class="post-hashtags">
                                        <?php foreach ($hashtags as $hashtag): ?>
                                            <a href="<?php echo get_term_link($hashtag); ?>" class="hashtag-link">
                                                #<?php echo esc_html($hashtag->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="post-stats">
                                <span class="stat-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    <?php echo $like_count; ?>
                                </span>
                                <span class="stat-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    <?php echo count($comments); ?>
                                </span>
                            </div>

                            <div class="post-actions">
                                <button class="action-btn like-btn <?php echo $is_liked ? 'liked' : ''; ?>" data-post-id="<?php echo esc_attr($post->ID); ?>">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    Like
                                </button>
                                <button class="action-btn comment-btn" data-post-id="<?php echo esc_attr($post->ID); ?>">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    Comment
                                </button>
                                <button class="action-btn share-btn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="18" cy="5" r="3"></circle>
                                        <circle cx="6" cy="12" r="3"></circle>
                                        <circle cx="18" cy="19" r="3"></circle>
                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                    </svg>
                                    Share
                                </button>
                            </div>

                            <!-- Comments Section -->
                            <div class="comments-section" style="display: none;">
                                <div class="comments-list">
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="comment-item">
                                            <div class="comment-author">
                                                <?php echo get_avatar($comment->user_id, 32); ?>
                                                <div class="comment-content">
                                                    <strong><?php echo esc_html($comment->comment_author); ?></strong>
                                                    <p><?php echo esc_html($comment->comment_content); ?></p>
                                                    <span class="comment-time"><?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp')); ?> ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="add-comment">
                                    <?php echo get_avatar($current_user->ID, 32); ?>
                                    <input type="text" class="comment-input" placeholder="Add a comment..." data-post-id="<?php echo esc_attr($post->ID); ?>">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="social-sidebar">
            <!-- Trending Hashtags -->
            <div class="sidebar-card">
                <h3>🔥 Trending Hashtags</h3>
                <div class="trending-hashtags">
                    <?php foreach ($trending_hashtags as $hashtag): ?>
                        <a href="<?php echo get_term_link($hashtag); ?>" class="trending-tag">
                            <span class="hashtag-name">#<?php echo esc_html($hashtag->name); ?></span>
                            <span class="hashtag-count"><?php echo number_format($hashtag->count); ?> posts</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Who to Follow -->
            <div class="sidebar-card">
                <h3>👥 Active Members</h3>
                <?php
                $active_users = get_users(array(
                    'number' => 5,
                    'orderby' => 'post_count',
                    'order' => 'DESC',
                ));
                foreach ($active_users as $user):
                ?>
                    <div class="user-suggestion">
                        <?php echo get_avatar($user->ID, 40); ?>
                        <div class="user-info">
                            <strong><?php echo esc_html($user->display_name); ?></strong>
                            <span><?php echo esc_html(get_user_meta($user->ID, '_profile_headline', true) ?: 'Member'); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <style>
        .jobportal-social-feed {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
        }

        .create-post-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .create-post-header {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .user-avatar img {
            border-radius: 50%;
        }

        .create-post-input {
            flex: 1;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 12px 20px;
            font-size: 14px;
            outline: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .create-post-input:hover {
            background: #f8fafc;
        }

        .social-post-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .post-author {
            display: flex;
            gap: 12px;
        }

        .author-info strong {
            display: block;
            font-size: 15px;
            color: #1e293b;
        }

        .post-meta {
            font-size: 12px;
            color: #64748b;
        }

        .post-content {
            margin-bottom: 16px;
            font-size: 14px;
            line-height: 1.6;
            color: #1e293b;
        }

        .post-hashtags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .hashtag-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .post-stats {
            display: flex;
            gap: 16px;
            padding: 12px 0;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 8px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
        }

        .stat-item svg {
            color: #94a3b8;
        }

        .post-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            flex: 1;
            padding: 10px;
            border: none;
            background: transparent;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background: #f8fafc;
        }

        .like-btn.liked {
            color: #ef4444;
        }

        .like-btn.liked svg {
            fill: currentColor;
        }

        .comments-section {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
        }

        .comment-item {
            margin-bottom: 12px;
        }

        .comment-author {
            display: flex;
            gap: 10px;
        }

        .comment-content {
            flex: 1;
            background: #f8fafc;
            padding: 10px 14px;
            border-radius: 12px;
        }

        .comment-content strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .comment-content p {
            margin: 0;
            font-size: 14px;
            color: #1e293b;
        }

        .comment-time {
            font-size: 11px;
            color: #94a3b8;
        }

        .add-comment {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 12px;
        }

        .comment-input {
            flex: 1;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 10px 16px;
            font-size: 13px;
            outline: none;
        }

        .social-sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .sidebar-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-card h3 {
            font-size: 16px;
            margin: 0 0 16px;
            color: #1e293b;
        }

        .trending-tag {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s;
        }

        .trending-tag:hover {
            background: #f8fafc;
            padding-left: 8px;
        }

        .hashtag-name {
            color: #667eea;
            font-weight: 600;
        }

        .hashtag-count {
            color: #94a3b8;
            font-size: 12px;
        }

        .user-suggestion {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .user-info strong {
            display: block;
            font-size: 14px;
            color: #1e293b;
        }

        .user-info span {
            font-size: 12px;
            color: #64748b;
        }

        /* Modal */
        .social-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }

        .social-modal .modal-content {
            background: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .modal-close {
            font-size: 28px;
            cursor: pointer;
            color: #64748b;
        }

        .modal-body {
            padding: 20px 24px;
        }

        .post-author-info {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .post-author-info strong {
            display: block;
        }

        .post-author-info p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        #postContent {
            width: 100%;
            min-height: 120px;
            border: none;
            outline: none;
            font-size: 15px;
            resize: none;
            font-family: inherit;
        }

        .post-tools {
            display: flex;
            gap: 8px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
        }

        .tool-btn {
            border: none;
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 20px;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            text-align: right;
        }

        .btn-publish {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .jobportal-social-feed {
                grid-template-columns: 1fr;
            }

            .social-sidebar {
                position: static;
            }
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            // Open create post modal
            $('#createPostInput').on('click', function() {
                $('#createPostModal').show();
                $('#postContent').focus();
            });

            // Close modal
            $('.modal-close').on('click', function() {
                $('#createPostModal').hide();
            });

            // Publish post
            $('#publishPost').on('click', function() {
                const content = $('#postContent').val();

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_create_social_post',
                        nonce: jobportalData.nonce,
                        content: content
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Post published successfully!');
                            location.reload();
                        } else {
                            alert(response.data.message);
                        }
                    }
                });
            });

            // Like post
            $('.like-btn').on('click', function() {
                const btn = $(this);
                const postId = btn.data('post-id');

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_like_post',
                        nonce: jobportalData.nonce,
                        post_id: postId
                    },
                    success: function(response) {
                        if (response.success) {
                            btn.toggleClass('liked');
                            const statItem = btn.closest('.social-post-card').find('.stat-item:first');
                            statItem.find('span:last').text(response.data.count);
                        }
                    }
                });
            });

            // Toggle comments
            $('.comment-btn').on('click', function() {
                const postCard = $(this).closest('.social-post-card');
                postCard.find('.comments-section').slideToggle();
            });

            // Add comment
            $('.comment-input').on('keypress', function(e) {
                if (e.which === 13) {
                    const input = $(this);
                    const postId = input.data('post-id');
                    const comment = input.val();

                    $.ajax({
                        url: jobportalData.ajaxUrl,
                        type: 'POST',
                        data: {
                            action: 'jobportal_add_comment',
                            nonce: jobportalData.nonce,
                            post_id: postId,
                            comment: comment
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                alert(response.data.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_social_feed', 'jobportal_social_feed_shortcode');
