<?php
/**
 * The template for displaying comments
 *
 * @package JobPortal
 */

if (post_password_required()) {
    return;
}

$commenter = wp_get_current_commenter();
?>

<div id="comments" class="jobportal-comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="jobportal-comments-title">
            <?php
            $jobportal_comment_count = get_comments_number();
            if ('1' === $jobportal_comment_count) {
                printf(
                    esc_html__('1 Comment', 'jobportal')
                );
            } else {
                printf(
                    esc_html(_n('%s Comment', '%s Comments', $jobportal_comment_count, 'jobportal')),
                    number_format_i18n($jobportal_comment_count)
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(array(
            'prev_text' => jobportal_get_icon('arrow-left', 16) . ' ' . esc_html__('Older Comments', 'jobportal'),
            'next_text' => esc_html__('Newer Comments', 'jobportal') . ' ' . jobportal_get_icon('arrow-right', 16),
        )); ?>

        <ol class="jobportal-comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => 'jobportal_comment_callback',
            ));
            ?>
        </ol>

        <?php the_comments_navigation(array(
            'prev_text' => jobportal_get_icon('arrow-left', 16) . ' ' . esc_html__('Older Comments', 'jobportal'),
            'next_text' => esc_html__('Newer Comments', 'jobportal') . ' ' . jobportal_get_icon('arrow-right', 16),
        )); ?>

        <?php if (!comments_open()) : ?>
            <p class="jobportal-comments-closed"><?php esc_html_e('Comments are closed.', 'jobportal'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'class_form'         => 'jobportal-comment-form',
        'title_reply'        => esc_html__('Leave a Comment', 'jobportal'),
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'comment_field'      => '<div class="jobportal-form-group comment-form-comment"><label for="comment">' . esc_html__('Comment', 'jobportal') . ' <span class="required">*</span></label><textarea id="comment" name="comment" class="jobportal-textarea" rows="5" required></textarea></div>',
        'fields'             => array(
            'author' => '<div class="jobportal-form-group comment-form-author"><label for="author">' . esc_html__('Name', 'jobportal') . ' <span class="required">*</span></label><input id="author" name="author" type="text" class="jobportal-input" value="' . esc_attr($commenter['comment_author']) . '" required /></div>',
            'email'  => '<div class="jobportal-form-group comment-form-email"><label for="email">' . esc_html__('Email', 'jobportal') . ' <span class="required">*</span></label><input id="email" name="email" type="email" class="jobportal-input" value="' . esc_attr($commenter['comment_author_email']) . '" required /></div>',
            'url'    => '<div class="jobportal-form-group comment-form-url"><label for="url">' . esc_html__('Website', 'jobportal') . '</label><input id="url" name="url" type="url" class="jobportal-input" value="' . esc_attr($commenter['comment_author_url']) . '" /></div>',
        ),
        'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s jobportal-btn jobportal-btn-primary">' . esc_html__('Post Comment', 'jobportal') . ' ' . jobportal_get_icon('send', 18) . '</button>',
        'submit_field'       => '<div class="form-submit">%1$s %2$s</div>',
    ));
    ?>

</div>
