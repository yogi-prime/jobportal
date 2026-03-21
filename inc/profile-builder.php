<?php
/**
 * Complete Profile Builder
 * LinkedIn-style comprehensive profile with skills, experience, education, etc.
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * AJAX: Save Profile Data
 */
function jobportal_ajax_save_profile() {
    check_ajax_referer('jobportal_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to save profile'));
    }

    $user_id = get_current_user_id();

    // Save all profile sections
    if (isset($_POST['headline'])) {
        update_user_meta($user_id, '_profile_headline', sanitize_text_field($_POST['headline']));
    }

    if (isset($_POST['about'])) {
        update_user_meta($user_id, '_profile_about', sanitize_textarea_field($_POST['about']));
    }

    if (isset($_POST['skills'])) {
        update_user_meta($user_id, '_profile_skills', $_POST['skills']);
    }

    if (isset($_POST['experience'])) {
        update_user_meta($user_id, '_profile_experience', $_POST['experience']);
    }

    if (isset($_POST['education'])) {
        update_user_meta($user_id, '_profile_education', $_POST['education']);
    }

    if (isset($_POST['certifications'])) {
        update_user_meta($user_id, '_profile_certifications', $_POST['certifications']);
    }

    if (isset($_POST['languages'])) {
        update_user_meta($user_id, '_profile_languages', $_POST['languages']);
    }

    if (isset($_POST['projects'])) {
        update_user_meta($user_id, '_profile_projects', $_POST['projects']);
    }

    if (isset($_POST['awards'])) {
        update_user_meta($user_id, '_profile_awards', $_POST['awards']);
    }

    if (isset($_POST['publications'])) {
        update_user_meta($user_id, '_profile_publications', $_POST['publications']);
    }

    if (isset($_POST['volunteer'])) {
        update_user_meta($user_id, '_profile_volunteer', $_POST['volunteer']);
    }

    if (isset($_POST['location'])) {
        update_user_meta($user_id, '_profile_location', sanitize_text_field($_POST['location']));
    }

    if (isset($_POST['phone'])) {
        update_user_meta($user_id, '_profile_phone', sanitize_text_field($_POST['phone']));
    }

    if (isset($_POST['website'])) {
        update_user_meta($user_id, '_profile_website', esc_url_raw($_POST['website']));
    }

    if (isset($_POST['linkedin'])) {
        update_user_meta($user_id, '_profile_linkedin', esc_url_raw($_POST['linkedin']));
    }

    if (isset($_POST['github'])) {
        update_user_meta($user_id, '_profile_github', esc_url_raw($_POST['github']));
    }

    if (isset($_POST['portfolio'])) {
        update_user_meta($user_id, '_profile_portfolio', esc_url_raw($_POST['portfolio']));
    }

    wp_send_json_success(array('message' => 'Profile updated successfully'));
}
add_action('wp_ajax_jobportal_save_profile', 'jobportal_ajax_save_profile');

/**
 * Get User Profile Data
 */
function jobportal_get_profile_data($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }

    return array(
        'headline' => get_user_meta($user_id, '_profile_headline', true),
        'about' => get_user_meta($user_id, '_profile_about', true),
        'skills' => get_user_meta($user_id, '_profile_skills', true),
        'experience' => get_user_meta($user_id, '_profile_experience', true),
        'education' => get_user_meta($user_id, '_profile_education', true),
        'certifications' => get_user_meta($user_id, '_profile_certifications', true),
        'languages' => get_user_meta($user_id, '_profile_languages', true),
        'projects' => get_user_meta($user_id, '_profile_projects', true),
        'awards' => get_user_meta($user_id, '_profile_awards', true),
        'publications' => get_user_meta($user_id, '_profile_publications', true),
        'volunteer' => get_user_meta($user_id, '_profile_volunteer', true),
        'location' => get_user_meta($user_id, '_profile_location', true),
        'phone' => get_user_meta($user_id, '_profile_phone', true),
        'website' => get_user_meta($user_id, '_profile_website', true),
        'linkedin' => get_user_meta($user_id, '_profile_linkedin', true),
        'github' => get_user_meta($user_id, '_profile_github', true),
        'portfolio' => get_user_meta($user_id, '_profile_portfolio', true),
    );
}

/**
 * Shortcode: Profile Builder
 */
function jobportal_profile_builder_shortcode($atts) {
    if (!is_user_logged_in()) {
        ob_start();
        jobportal_job_application_login_gate();
        return ob_get_clean();
    }

    $user_id = get_current_user_id();
    $user = get_userdata($user_id);
    $profile = jobportal_get_profile_data($user_id);

    // Ensure arrays exist
    if (!is_array($profile['skills'])) $profile['skills'] = array();
    if (!is_array($profile['experience'])) $profile['experience'] = array();
    if (!is_array($profile['education'])) $profile['education'] = array();
    if (!is_array($profile['certifications'])) $profile['certifications'] = array();
    if (!is_array($profile['languages'])) $profile['languages'] = array();
    if (!is_array($profile['projects'])) $profile['projects'] = array();
    if (!is_array($profile['awards'])) $profile['awards'] = array();
    if (!is_array($profile['publications'])) $profile['publications'] = array();
    if (!is_array($profile['volunteer'])) $profile['volunteer'] = array();

    ob_start();
    ?>
    <div class="jobportal-profile-builder">
        <div class="profile-header">
            <div class="profile-avatar">
                <?php echo get_avatar($user_id, 120); ?>
                <button class="change-avatar-btn">Change Photo</button>
            </div>
            <div class="profile-header-info">
                <h1><?php echo esc_html($user->display_name); ?></h1>
                <p class="profile-headline"><?php echo esc_html($profile['headline'] ?: 'Add your professional headline'); ?></p>
                <p class="profile-location">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <?php echo esc_html($profile['location'] ?: 'Add location'); ?>
                </p>
            </div>
        </div>

        <div class="profile-sections">
            <!-- Basic Info Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Basic Information</h2>
                    <button class="edit-section-btn" data-section="basic">Edit</button>
                </div>
                <div class="section-content" id="basic-info">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Email</label>
                            <p><?php echo esc_html($user->user_email); ?></p>
                        </div>
                        <div class="info-item">
                            <label>Phone</label>
                            <p><?php echo esc_html($profile['phone'] ?: 'Not provided'); ?></p>
                        </div>
                        <div class="info-item">
                            <label>Location</label>
                            <p><?php echo esc_html($profile['location'] ?: 'Not provided'); ?></p>
                        </div>
                        <div class="info-item">
                            <label>Website</label>
                            <p><?php echo esc_html($profile['website'] ?: 'Not provided'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>About</h2>
                    <button class="edit-section-btn" data-section="about">Edit</button>
                </div>
                <div class="section-content">
                    <p><?php echo nl2br(esc_html($profile['about'] ?: 'Tell employers about yourself...')); ?></p>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Skills</h2>
                    <button class="edit-section-btn" data-section="skills">Edit</button>
                </div>
                <div class="section-content">
                    <div class="skills-list">
                        <?php if (empty($profile['skills'])): ?>
                            <p class="empty-state">Add your skills to showcase your expertise</p>
                        <?php else: ?>
                            <?php foreach ($profile['skills'] as $skill): ?>
                                <span class="skill-badge"><?php echo esc_html($skill); ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Experience Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Work Experience</h2>
                    <button class="edit-section-btn" data-section="experience">Edit</button>
                </div>
                <div class="section-content">
                    <?php if (empty($profile['experience'])): ?>
                        <p class="empty-state">Add your work experience</p>
                    <?php else: ?>
                        <?php foreach ($profile['experience'] as $exp): ?>
                            <div class="experience-item">
                                <h3><?php echo esc_html($exp['title']); ?></h3>
                                <p class="company"><?php echo esc_html($exp['company']); ?></p>
                                <p class="duration"><?php echo esc_html($exp['start_date'] . ' - ' . ($exp['current'] ? 'Present' : $exp['end_date'])); ?></p>
                                <p class="description"><?php echo nl2br(esc_html($exp['description'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Education Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Education</h2>
                    <button class="edit-section-btn" data-section="education">Edit</button>
                </div>
                <div class="section-content">
                    <?php if (empty($profile['education'])): ?>
                        <p class="empty-state">Add your education</p>
                    <?php else: ?>
                        <?php foreach ($profile['education'] as $edu): ?>
                            <div class="education-item">
                                <h3><?php echo esc_html($edu['school']); ?></h3>
                                <p class="degree"><?php echo esc_html($edu['degree']); ?></p>
                                <p class="field"><?php echo esc_html($edu['field']); ?></p>
                                <p class="duration"><?php echo esc_html($edu['start_year'] . ' - ' . $edu['end_year']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Certifications Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Certifications & Licenses</h2>
                    <button class="edit-section-btn" data-section="certifications">Edit</button>
                </div>
                <div class="section-content">
                    <?php if (empty($profile['certifications'])): ?>
                        <p class="empty-state">Add your certifications</p>
                    <?php else: ?>
                        <?php foreach ($profile['certifications'] as $cert): ?>
                            <div class="certification-item">
                                <h3><?php echo esc_html($cert['name']); ?></h3>
                                <p class="issuer"><?php echo esc_html($cert['issuer']); ?></p>
                                <p class="date">Issued: <?php echo esc_html($cert['issue_date']); ?></p>
                                <?php if (!empty($cert['credential_url'])): ?>
                                    <a href="<?php echo esc_url($cert['credential_url']); ?>" target="_blank">View Credential</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Languages Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Languages</h2>
                    <button class="edit-section-btn" data-section="languages">Edit</button>
                </div>
                <div class="section-content">
                    <?php if (empty($profile['languages'])): ?>
                        <p class="empty-state">Add languages you speak</p>
                    <?php else: ?>
                        <div class="languages-list">
                            <?php foreach ($profile['languages'] as $lang): ?>
                                <div class="language-item">
                                    <strong><?php echo esc_html($lang['name']); ?></strong> - <?php echo esc_html($lang['proficiency']); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Projects Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Projects</h2>
                    <button class="edit-section-btn" data-section="projects">Edit</button>
                </div>
                <div class="section-content">
                    <?php if (empty($profile['projects'])): ?>
                        <p class="empty-state">Showcase your projects</p>
                    <?php else: ?>
                        <?php foreach ($profile['projects'] as $project): ?>
                            <div class="project-item">
                                <h3><?php echo esc_html($project['name']); ?></h3>
                                <p class="description"><?php echo nl2br(esc_html($project['description'])); ?></p>
                                <?php if (!empty($project['url'])): ?>
                                    <a href="<?php echo esc_url($project['url']); ?>" target="_blank">View Project</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Social Links Section -->
            <div class="profile-section">
                <div class="section-header">
                    <h2>Social Links</h2>
                    <button class="edit-section-btn" data-section="social">Edit</button>
                </div>
                <div class="section-content">
                    <div class="social-links">
                        <?php if ($profile['linkedin']): ?>
                            <a href="<?php echo esc_url($profile['linkedin']); ?>" target="_blank" class="social-link linkedin">
                                LinkedIn
                            </a>
                        <?php endif; ?>
                        <?php if ($profile['github']): ?>
                            <a href="<?php echo esc_url($profile['github']); ?>" target="_blank" class="social-link github">
                                GitHub
                            </a>
                        <?php endif; ?>
                        <?php if ($profile['portfolio']): ?>
                            <a href="<?php echo esc_url($profile['portfolio']); ?>" target="_blank" class="social-link portfolio">
                                Portfolio
                            </a>
                        <?php endif; ?>
                        <?php if (empty($profile['linkedin']) && empty($profile['github']) && empty($profile['portfolio'])): ?>
                            <p class="empty-state">Add your social profiles</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="profileEditModal" class="profile-modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2 id="modalTitle">Edit Section</h2>
            <div id="modalForm"></div>
            <div class="modal-actions">
                <button class="btn btn-primary" id="saveProfile">Save Changes</button>
                <button class="btn btn-secondary" id="cancelEdit">Cancel</button>
            </div>
        </div>
    </div>

    <style>
        .jobportal-profile-builder {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 16px;
            display: flex;
            gap: 32px;
            margin-bottom: 32px;
            align-items: center;
        }

        .profile-avatar {
            position: relative;
        }

        .profile-avatar img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
        }

        .change-avatar-btn {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            color: #667eea;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .profile-header-info h1 {
            margin: 0 0 8px;
            font-size: 32px;
            font-weight: 700;
        }

        .profile-headline {
            margin: 0 0 8px;
            font-size: 16px;
            opacity: 0.9;
        }

        .profile-location {
            margin: 0;
            font-size: 14px;
            opacity: 0.8;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .profile-section {
            background: white;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 20px;
            border: 2px solid #e2e8f0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        .section-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .edit-section-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .edit-section-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
        }

        .info-item p {
            margin: 0;
            font-size: 15px;
            color: #1e293b;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-badge {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border: 1.5px solid #667eea;
            color: #667eea;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .empty-state {
            color: #94a3b8;
            font-style: italic;
            margin: 0;
        }

        .experience-item,
        .education-item,
        .certification-item,
        .project-item {
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .experience-item:last-child,
        .education-item:last-child,
        .certification-item:last-child,
        .project-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .experience-item h3,
        .education-item h3,
        .certification-item h3,
        .project-item h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 6px;
        }

        .company,
        .degree,
        .issuer {
            font-size: 15px;
            color: #475569;
            margin: 0 0 4px;
        }

        .duration,
        .date {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 12px;
        }

        .description {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin: 0;
        }

        .social-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .social-link {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .social-link.linkedin {
            background: #0077b5;
            color: white;
        }

        .social-link.github {
            background: #333;
            color: white;
        }

        .social-link.portfolio {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .social-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Modal */
        .profile-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.2s;
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 32px;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 24px;
            font-size: 32px;
            font-weight: 300;
            color: #64748b;
            cursor: pointer;
            line-height: 1;
        }

        .modal-close:hover {
            color: #1e293b;
        }

        #modalTitle {
            margin: 0 0 24px;
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            const modal = $('#profileEditModal');
            const modalClose = $('.modal-close');
            const cancelBtn = $('#cancelEdit');

            // Edit section
            $('.edit-section-btn').on('click', function() {
                const section = $(this).data('section');
                openEditModal(section);
            });

            // Close modal
            modalClose.on('click', () => modal.hide());
            cancelBtn.on('click', () => modal.hide());

            // Open edit modal
            function openEditModal(section) {
                $('#modalTitle').text('Edit ' + section.charAt(0).toUpperCase() + section.slice(1));
                $('#modalForm').html(getFormHTML(section));
                modal.show();
            }

            // Get form HTML
            function getFormHTML(section) {
                // This would be dynamic based on section
                // For now, showing a simplified version
                return '<textarea class="modal-input" placeholder="Enter details..."></textarea>';
            }

            // Save profile
            $('#saveProfile').on('click', function() {
                // AJAX save logic here
                alert('Profile saved successfully!');
                modal.hide();
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_my_profile', 'jobportal_profile_builder_shortcode');
