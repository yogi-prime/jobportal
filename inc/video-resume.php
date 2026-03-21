<?php
/**
 * Video Resume Upload System
 * Allow candidates to upload video resumes
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Video Resume to User Profile
 */
function jobportal_add_video_resume_field($user) {
    if (!current_user_can('edit_user', $user->ID)) {
        return false;
    }

    $video_resume_url = get_user_meta($user->ID, '_video_resume_url', true);
    $video_resume_id = get_user_meta($user->ID, '_video_resume_id', true);
    ?>
    <h2><?php _e('Video Resume', 'jobportal'); ?></h2>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="video_resume"><?php _e('Video Resume', 'jobportal'); ?></label></th>
            <td>
                <div id="video-resume-upload-section">
                    <?php if ($video_resume_url) : ?>
                        <div style="margin-bottom: 16px;">
                            <video controls style="max-width: 100%; max-height: 400px; border-radius: 12px;">
                                <source src="<?php echo esc_url($video_resume_url); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <p>
                            <button type="button" class="button" id="remove-video-resume">
                                <?php _e('Remove Video Resume', 'jobportal'); ?>
                            </button>
                        </p>
                        <input type="hidden" name="video_resume_id" id="video_resume_id" value="<?php echo esc_attr($video_resume_id); ?>">
                        <input type="hidden" name="video_resume_url" id="video_resume_url" value="<?php echo esc_attr($video_resume_url); ?>">
                    <?php else : ?>
                        <p>
                            <button type="button" class="button" id="upload-video-resume">
                                <?php _e('Upload Video Resume', 'jobportal'); ?>
                            </button>
                        </p>
                        <input type="hidden" name="video_resume_id" id="video_resume_id" value="">
                        <input type="hidden" name="video_resume_url" id="video_resume_url" value="">
                        <p class="description">
                            <?php _e('Upload a video resume (MP4, WebM, or OGG format). Max size: 50MB. Recommended: 1-2 minutes.', 'jobportal'); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <script>
                jQuery(document).ready(function($) {
                    var videoFrame;

                    // Upload video resume
                    $('#upload-video-resume').on('click', function(e) {
                        e.preventDefault();

                        if (videoFrame) {
                            videoFrame.open();
                            return;
                        }

                        videoFrame = wp.media({
                            title: '<?php _e('Select Video Resume', 'jobportal'); ?>',
                            button: {
                                text: '<?php _e('Use This Video', 'jobportal'); ?>'
                            },
                            library: {
                                type: 'video'
                            },
                            multiple: false
                        });

                        videoFrame.on('select', function() {
                            var attachment = videoFrame.state().get('selection').first().toJSON();

                            $('#video_resume_id').val(attachment.id);
                            $('#video_resume_url').val(attachment.url);

                            var videoHTML = '<div style="margin-bottom: 16px;">' +
                                '<video controls style="max-width: 100%; max-height: 400px; border-radius: 12px;">' +
                                '<source src="' + attachment.url + '" type="' + attachment.mime + '">' +
                                'Your browser does not support the video tag.' +
                                '</video>' +
                                '</div>' +
                                '<p>' +
                                '<button type="button" class="button" id="remove-video-resume"><?php _e('Remove Video Resume', 'jobportal'); ?></button>' +
                                '</p>';

                            $('#video-resume-upload-section').html(videoHTML);
                            $('#video-resume-upload-section').append($('#video_resume_id, #video_resume_url'));
                        });

                        videoFrame.open();
                    });

                    // Remove video resume
                    $(document).on('click', '#remove-video-resume', function(e) {
                        e.preventDefault();

                        if (!confirm('<?php _e('Are you sure you want to remove your video resume?', 'jobportal'); ?>')) {
                            return;
                        }

                        $('#video_resume_id').val('');
                        $('#video_resume_url').val('');

                        var uploadHTML = '<p>' +
                            '<button type="button" class="button" id="upload-video-resume"><?php _e('Upload Video Resume', 'jobportal'); ?></button>' +
                            '</p>' +
                            '<p class="description"><?php _e('Upload a video resume (MP4, WebM, or OGG format). Max size: 50MB. Recommended: 1-2 minutes.', 'jobportal'); ?></p>';

                        $('#video-resume-upload-section').html(uploadHTML);
                        $('#video-resume-upload-section').append($('#video_resume_id, #video_resume_url'));
                    });
                });
                </script>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'jobportal_add_video_resume_field');
add_action('edit_user_profile', 'jobportal_add_video_resume_field');

/**
 * Save Video Resume
 */
function jobportal_save_video_resume($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    if (isset($_POST['video_resume_id'])) {
        update_user_meta($user_id, '_video_resume_id', sanitize_text_field($_POST['video_resume_id']));
    }

    if (isset($_POST['video_resume_url'])) {
        update_user_meta($user_id, '_video_resume_url', esc_url_raw($_POST['video_resume_url']));
    }
}
add_action('personal_options_update', 'jobportal_save_video_resume');
add_action('edit_user_profile_update', 'jobportal_save_video_resume');

/**
 * Add Video Resume to Job Application
 */
function jobportal_add_video_resume_to_application($post) {
    $application_id = $post->ID;
    $video_resume_url = get_post_meta($application_id, '_video_resume_url', true);
    $video_resume_id = get_post_meta($application_id, '_video_resume_id', true);
    ?>
    <div class="jobportal-meta-field" style="margin-top: 20px;">
        <label><strong><?php _e('Video Resume (Optional)', 'jobportal'); ?></strong></label>
        <div id="video-resume-application-section">
            <?php if ($video_resume_url) : ?>
                <div style="margin: 12px 0;">
                    <video controls style="max-width: 100%; max-height: 300px; border-radius: 8px;">
                        <source src="<?php echo esc_url($video_resume_url); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <p style="margin-top: 8px; color: #10b981; font-weight: 600;">✓ Video resume attached</p>
            <?php else : ?>
                <p style="color: #64748b; font-style: italic;">No video resume attached to this application.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Display Video Resume in Application Meta Box
 */
function jobportal_display_video_resume_in_application($post) {
    $applicant_email = get_post_meta($post->ID, '_applicant_email', true);

    if (!$applicant_email) {
        return;
    }

    $user = get_user_by('email', $applicant_email);

    if (!$user) {
        // Check application-specific video resume
        jobportal_add_video_resume_to_application($post);
        return;
    }

    $video_resume_url = get_user_meta($user->ID, '_video_resume_url', true);

    if ($video_resume_url) {
        ?>
        <div style="margin-top: 20px; padding: 16px; background: #f8fafc; border-radius: 8px;">
            <h4 style="margin: 0 0 12px; color: #1e293b;">🎥 Video Resume</h4>
            <video controls style="width: 100%; max-height: 400px; border-radius: 8px; background: #000;">
                <source src="<?php echo esc_url($video_resume_url); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <p style="margin-top: 12px; font-size: 13px; color: #64748b;">
                <a href="<?php echo esc_url($video_resume_url); ?>" download style="color: #00B4D8; text-decoration: none; font-weight: 600;">
                    ⬇️ Download Video Resume
                </a>
            </p>
        </div>
        <?php
    } else {
        jobportal_add_video_resume_to_application($post);
    }
}

/**
 * AJAX: Upload Video Resume from Frontend
 */
function jobportal_ajax_upload_video_resume() {
    check_ajax_referer('jobportal_ajax_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to upload video resume'));
    }

    if (!isset($_FILES['video_resume']) || $_FILES['video_resume']['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error(array('message' => 'No video file uploaded or upload error'));
    }

    $user_id = get_current_user_id();

    // Validate file type
    $allowed_types = array('video/mp4', 'video/webm', 'video/ogg');
    $file_type = $_FILES['video_resume']['type'];

    if (!in_array($file_type, $allowed_types)) {
        wp_send_json_error(array('message' => 'Invalid file type. Please upload MP4, WebM, or OGG video.'));
    }

    // Validate file size (50MB max)
    $max_size = 50 * 1024 * 1024; // 50MB in bytes
    if ($_FILES['video_resume']['size'] > $max_size) {
        wp_send_json_error(array('message' => 'File size exceeds 50MB limit.'));
    }

    // Upload file
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attachment_id = media_handle_upload('video_resume', 0);

    if (is_wp_error($attachment_id)) {
        wp_send_json_error(array('message' => $attachment_id->get_error_message()));
    }

    $video_url = wp_get_attachment_url($attachment_id);

    // Save to user meta
    update_user_meta($user_id, '_video_resume_id', $attachment_id);
    update_user_meta($user_id, '_video_resume_url', $video_url);

    wp_send_json_success(array(
        'message' => 'Video resume uploaded successfully',
        'video_url' => $video_url,
        'attachment_id' => $attachment_id,
    ));
}
add_action('wp_ajax_jobportal_upload_video_resume', 'jobportal_ajax_upload_video_resume');

/**
 * AJAX: Delete Video Resume
 */
function jobportal_ajax_delete_video_resume() {
    check_ajax_referer('jobportal_ajax_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to delete video resume'));
    }

    $user_id = get_current_user_id();
    $attachment_id = get_user_meta($user_id, '_video_resume_id', true);

    // Delete attachment
    if ($attachment_id) {
        wp_delete_attachment($attachment_id, true);
    }

    // Remove user meta
    delete_user_meta($user_id, '_video_resume_id');
    delete_user_meta($user_id, '_video_resume_url');

    wp_send_json_success(array('message' => 'Video resume deleted successfully'));
}
add_action('wp_ajax_jobportal_delete_video_resume', 'jobportal_ajax_delete_video_resume');

/**
 * Get User's Video Resume URL
 */
function jobportal_get_user_video_resume($user_id) {
    return get_user_meta($user_id, '_video_resume_url', true);
}

/**
 * Display Video Resume Player
 */
function jobportal_display_video_resume_player($video_url, $show_download = true) {
    if (!$video_url) {
        return;
    }
    ?>
    <div class="jobportal-video-resume-player" style="
        background: #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        margin: 20px 0;
    ">
        <video controls controlsList="nodownload" style="width: 100%; max-height: 600px; display: block;">
            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <?php if ($show_download) : ?>
            <div style="padding: 16px; background: #1e293b;">
                <a href="<?php echo esc_url($video_url); ?>"
                   download
                   style="
                       display: inline-block;
                       padding: 10px 20px;
                       background: #00B4D8;
                       color: white;
                       border-radius: 8px;
                       text-decoration: none;
                       font-weight: 600;
                       font-size: 14px;
                   ">
                    ⬇️ Download Video Resume
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Shortcode: Video Resume Upload Form
 */
function jobportal_video_resume_upload_form_shortcode() {
    if (!is_user_logged_in()) {
        return '<p style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 12px;">Please <a href="' . wp_login_url() . '">login</a> to upload your video resume.</p>';
    }

    $user_id = get_current_user_id();
    $video_resume_url = get_user_meta($user_id, '_video_resume_url', true);

    ob_start();
    ?>
    <div class="jobportal-video-resume-upload" style="
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    ">
        <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
            🎥 Video Resume
        </h2>
        <p style="color: #64748b; margin-bottom: 32px;">
            Stand out from other candidates by adding a video resume. Introduce yourself, highlight your skills, and explain why you're the perfect fit.
        </p>

        <div id="video-resume-frontend-section">
            <?php if ($video_resume_url) : ?>
                <div style="margin-bottom: 24px;">
                    <?php jobportal_display_video_resume_player($video_resume_url, true); ?>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button type="button"
                            class="jobportal-btn"
                            id="replace-video-resume"
                            style="background: #f8fafc; color: #1e293b; border: 2px solid #e2e8f0;">
                        Replace Video
                    </button>
                    <button type="button"
                            class="jobportal-btn"
                            id="delete-video-resume"
                            style="background: #fee2e2; color: #991b1b; border: 2px solid #fecaca;">
                        Delete Video
                    </button>
                </div>
            <?php else : ?>
                <div style="
                    padding: 60px 40px;
                    background: #f8fafc;
                    border: 2px dashed #e2e8f0;
                    border-radius: 16px;
                    text-align: center;
                ">
                    <div style="font-size: 64px; margin-bottom: 16px;">🎬</div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
                        Upload Your Video Resume
                    </h3>
                    <p style="color: #64748b; margin-bottom: 24px;">
                        Maximum size: 50MB • Recommended length: 1-2 minutes<br>
                        Supported formats: MP4, WebM, OGG
                    </p>
                    <input type="file"
                           id="video-resume-input"
                           accept="video/mp4,video/webm,video/ogg"
                           style="display: none;">
                    <button type="button"
                            class="jobportal-btn jobportal-btn-primary"
                            id="select-video-btn">
                        Choose Video File
                    </button>
                </div>

                <div id="upload-progress" style="display: none; margin-top: 24px;">
                    <div style="background: #f8fafc; padding: 24px; border-radius: 12px;">
                        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px;">
                            <div class="jobportal-spinner" style="width: 24px; height: 24px;"></div>
                            <span style="font-weight: 600; color: #1e293b;">Uploading video...</span>
                        </div>
                        <div style="background: #e5e7eb; height: 8px; border-radius: 4px; overflow: hidden;">
                            <div id="upload-progress-bar" style="
                                height: 100%;
                                background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
                                width: 0%;
                                transition: width 0.3s ease;
                            "></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 32px; padding: 20px; background: #ecfdf5; border-left: 4px solid #10b981; border-radius: 8px;">
            <h4 style="margin: 0 0 12px; color: #065f46; font-weight: 700;">💡 Tips for a Great Video Resume:</h4>
            <ul style="margin: 0; padding-left: 20px; color: #064e3b; line-height: 1.8;">
                <li>Keep it professional yet personable</li>
                <li>Dress professionally and ensure good lighting</li>
                <li>Speak clearly and maintain eye contact with the camera</li>
                <li>Highlight your key skills and achievements</li>
                <li>Keep it concise - aim for 60-90 seconds</li>
                <li>Show enthusiasm and personality</li>
            </ul>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Select video file
        $('#select-video-btn, #replace-video-resume').on('click', function() {
            $('#video-resume-input').click();
        });

        // Upload video
        $('#video-resume-input').on('change', function(e) {
            var file = e.target.files[0];

            if (!file) {
                return;
            }

            // Validate file type
            var allowedTypes = ['video/mp4', 'video/webm', 'video/ogg'];
            if (allowedTypes.indexOf(file.type) === -1) {
                alert('Invalid file type. Please upload MP4, WebM, or OGG video.');
                return;
            }

            // Validate file size (50MB)
            var maxSize = 50 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('File size exceeds 50MB limit.');
                return;
            }

            // Show upload progress
            $('#upload-progress').show();
            $('#upload-progress-bar').css('width', '0%');

            // Upload via AJAX
            var formData = new FormData();
            formData.append('action', 'jobportal_upload_video_resume');
            formData.append('nonce', jobportalAjax.nonce);
            formData.append('video_resume', file);

            $.ajax({
                url: jobportalAjax.ajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            var percent = (e.loaded / e.total) * 100;
                            $('#upload-progress-bar').css('width', percent + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + response.data.message);
                        $('#upload-progress').hide();
                    }
                },
                error: function() {
                    alert('Upload failed. Please try again.');
                    $('#upload-progress').hide();
                }
            });
        });

        // Delete video
        $('#delete-video-resume').on('click', function() {
            if (!confirm('Are you sure you want to delete your video resume?')) {
                return;
            }

            $.ajax({
                url: jobportalAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'jobportal_delete_video_resume',
                    nonce: jobportalAjax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + response.data.message);
                    }
                },
                error: function() {
                    alert('Delete failed. Please try again.');
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('video_resume_upload', 'jobportal_video_resume_upload_form_shortcode');
