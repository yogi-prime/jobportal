<?php
/**
 * Job Application Modal Template
 * AJAX-based application form with resume upload
 *
 * @package JobPortal
 */
?>

<!-- Application Modal Styles -->
<style>
.jobportal-apply-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(8px);
    z-index: 999999;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
}

.jobportal-apply-modal.active {
    display: flex;
}

.jobportal-modal-content {
    background: white;
    border-radius: 20px;
    max-width: 700px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideUp 0.4s ease;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.jobportal-modal-header {
    padding: 32px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border-radius: 20px 20px 0 0;
    color: white;
    position: relative;
}

.jobportal-modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    color: white;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.jobportal-modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.jobportal-modal-title {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 8px;
}

.jobportal-modal-subtitle {
    font-size: 16px;
    opacity: 0.95;
}

.jobportal-modal-body {
    padding: 32px;
}

.jobportal-form-row {
    margin-bottom: 24px;
}

.jobportal-form-row label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.jobportal-form-row label .required {
    color: #ef4444;
    margin-left: 4px;
}

.jobportal-form-row input[type="text"],
.jobportal-form-row input[type="email"],
.jobportal-form-row input[type="tel"],
.jobportal-form-row input[type="url"],
.jobportal-form-row input[type="number"],
.jobportal-form-row textarea,
.jobportal-form-row select {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s;
    font-family: inherit;
}

.jobportal-form-row input:focus,
.jobportal-form-row textarea:focus,
.jobportal-form-row select:focus {
    outline: none;
    border-color: #4facfe;
    box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
}

.jobportal-form-row textarea {
    min-height: 120px;
    resize: vertical;
}

.jobportal-file-upload {
    position: relative;
    border: 2px dashed #cbd5e1;
    border-radius: 10px;
    padding: 32px;
    text-align: center;
    background: #f8fafc;
    transition: all 0.3s;
    cursor: pointer;
}

.jobportal-file-upload:hover {
    border-color: #4facfe;
    background: #f0f9ff;
}

.jobportal-file-upload input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    cursor: pointer;
}

.jobportal-file-upload-icon {
    font-size: 48px;
    color: #cbd5e1;
    margin-bottom: 12px;
}

.jobportal-file-upload-text {
    font-size: 15px;
    color: #64748b;
    margin-bottom: 4px;
}

.jobportal-file-upload-hint {
    font-size: 13px;
    color: #94a3b8;
}

.jobportal-file-selected {
    display: none;
    margin-top: 12px;
    padding: 12px 16px;
    background: #ecfdf5;
    border: 2px solid #10b981;
    border-radius: 8px;
    color: #065f46;
    font-size: 14px;
    font-weight: 600;
}

.jobportal-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.jobportal-submit-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 16px rgba(79, 172, 254, 0.3);
}

.jobportal-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(79, 172, 254, 0.4);
}

.jobportal-submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.jobportal-submit-btn .spinner {
    display: none;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto;
}

.jobportal-submit-btn.loading .spinner {
    display: block;
}

.jobportal-submit-btn.loading .text {
    display: none;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.jobportal-form-message {
    padding: 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
    display: none;
}

.jobportal-form-message.success {
    background: #ecfdf5;
    color: #065f46;
    border: 2px solid #10b981;
}

.jobportal-form-message.error {
    background: #fef2f2;
    color: #991b1b;
    border: 2px solid #ef4444;
}

@media (max-width: 768px) {
    .jobportal-modal-content {
        width: 95%;
        max-height: 95vh;
    }

    .jobportal-modal-header,
    .jobportal-modal-body {
        padding: 24px;
    }

    .jobportal-modal-title {
        font-size: 24px;
    }

    .jobportal-form-grid {
        grid-template-columns: 1fr;
        gap: 0;
    }
}
</style>

<!-- Application Modal HTML -->
<div id="jobportal-apply-modal" class="jobportal-apply-modal">
    <div class="jobportal-modal-content">
        <!-- Header -->
        <div class="jobportal-modal-header">
            <button class="jobportal-modal-close" onclick="jobportalCloseApplyModal()">&times;</button>
            <h3 class="jobportal-modal-title"><?php _e('Apply for this Job', 'jobportal'); ?></h3>
            <p class="jobportal-modal-subtitle" id="jobportal-modal-job-title"></p>
        </div>

        <!-- Body -->
        <div class="jobportal-modal-body">
            <!-- Message Area -->
            <div id="jobportal-form-message" class="jobportal-form-message"></div>

            <!-- Application Form -->
            <form id="jobportal-application-form" enctype="multipart/form-data">
                <input type="hidden" name="job_id" id="apply-job-id" value="">

                <!-- Personal Information -->
                <div class="jobportal-form-grid">
                    <div class="jobportal-form-row">
                        <label for="apply-name">
                            <?php _e('Full Name', 'jobportal'); ?>
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="apply-name" name="name" required>
                    </div>

                    <div class="jobportal-form-row">
                        <label for="apply-email">
                            <?php _e('Email Address', 'jobportal'); ?>
                            <span class="required">*</span>
                        </label>
                        <input type="email" id="apply-email" name="email" required>
                    </div>
                </div>

                <div class="jobportal-form-grid">
                    <div class="jobportal-form-row">
                        <label for="apply-phone">
                            <?php _e('Phone Number', 'jobportal'); ?>
                            <span class="required">*</span>
                        </label>
                        <input type="tel" id="apply-phone" name="phone" required>
                    </div>

                    <div class="jobportal-form-row">
                        <label for="apply-experience">
                            <?php _e('Years of Experience', 'jobportal'); ?>
                            <span class="required">*</span>
                        </label>
                        <input type="number" id="apply-experience" name="experience" min="0" max="50" required>
                    </div>
                </div>

                <!-- Optional Fields -->
                <div class="jobportal-form-grid">
                    <div class="jobportal-form-row">
                        <label for="apply-portfolio">
                            <?php _e('Portfolio URL', 'jobportal'); ?>
                            <span style="color: #94a3b8; font-weight: 400;"><?php _e('(Optional)', 'jobportal'); ?></span>
                        </label>
                        <input type="url" id="apply-portfolio" name="portfolio_url" placeholder="https://">
                    </div>

                    <div class="jobportal-form-row">
                        <label for="apply-linkedin">
                            <?php _e('LinkedIn Profile', 'jobportal'); ?>
                            <span style="color: #94a3b8; font-weight: 400;"><?php _e('(Optional)', 'jobportal'); ?></span>
                        </label>
                        <input type="url" id="apply-linkedin" name="linkedin_url" placeholder="https://linkedin.com/in/">
                    </div>
                </div>

                <!-- Cover Letter -->
                <div class="jobportal-form-row">
                    <label for="apply-cover-letter">
                        <?php _e('Cover Letter', 'jobportal'); ?>
                        <span class="required">*</span>
                    </label>
                    <textarea id="apply-cover-letter" name="cover_letter" required
                              placeholder="<?php _e('Tell us why you\'re a great fit for this position...', 'jobportal'); ?>"></textarea>
                </div>

                <!-- Resume Upload -->
                <div class="jobportal-form-row">
                    <label>
                        <?php _e('Upload Resume', 'jobportal'); ?>
                        <span class="required">*</span>
                    </label>
                    <div class="jobportal-file-upload">
                        <input type="file" id="apply-resume" name="resume" accept=".pdf,.doc,.docx" required onchange="jobportalHandleFileSelect(this)">
                        <div class="jobportal-file-upload-icon">📄</div>
                        <div class="jobportal-file-upload-text"><?php _e('Click to upload or drag and drop', 'jobportal'); ?></div>
                        <div class="jobportal-file-upload-hint"><?php _e('PDF, DOC, DOCX (Max 5MB)', 'jobportal'); ?></div>
                    </div>
                    <div class="jobportal-file-selected" id="file-selected-message"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="jobportal-submit-btn">
                    <span class="spinner"></span>
                    <span class="text"><?php _e('Submit Application', 'jobportal'); ?></span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Application Modal JavaScript -->
<script>
function jobportalOpenApplyModal(jobId, jobTitle) {
    const modal = document.getElementById('jobportal-apply-modal');
    const jobTitleElement = document.getElementById('jobportal-modal-job-title');
    const jobIdInput = document.getElementById('apply-job-id');

    jobTitleElement.textContent = jobTitle;
    jobIdInput.value = jobId;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // Pre-fill if user is logged in
    <?php if (is_user_logged_in()) :
        $current_user = wp_get_current_user(); ?>
        document.getElementById('apply-name').value = '<?php echo esc_js($current_user->display_name); ?>';
        document.getElementById('apply-email').value = '<?php echo esc_js($current_user->user_email); ?>';
    <?php endif; ?>
}

function jobportalCloseApplyModal() {
    const modal = document.getElementById('jobportal-apply-modal');
    modal.classList.remove('active');
    document.body.style.overflow = '';

    // Reset form
    document.getElementById('jobportal-application-form').reset();
    document.getElementById('file-selected-message').style.display = 'none';
    document.getElementById('jobportal-form-message').style.display = 'none';
}

function jobportalHandleFileSelect(input) {
    const fileName = input.files[0]?.name;
    const messageEl = document.getElementById('file-selected-message');

    if (fileName) {
        messageEl.textContent = '✓ ' + fileName;
        messageEl.style.display = 'block';
    } else {
        messageEl.style.display = 'none';
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('jobportal-apply-modal');
    if (e.target === modal) {
        jobportalCloseApplyModal();
    }
});

// Handle form submission
document.getElementById('jobportal-application-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const submitBtn = this.querySelector('.jobportal-submit-btn');
    const messageEl = document.getElementById('jobportal-form-message');

    // Disable submit button
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;

    // Prepare form data
    const formData = new FormData(this);
    formData.append('action', 'submit_job_application');
    formData.append('nonce', '<?php echo wp_create_nonce('jobportal_apply_nonce'); ?>');

    // Submit via AJAX
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;

        if (data.success) {
            messageEl.textContent = data.data.message;
            messageEl.className = 'jobportal-form-message success';
            messageEl.style.display = 'block';

            // Reset form
            document.getElementById('jobportal-application-form').reset();
            document.getElementById('file-selected-message').style.display = 'none';

            // Close modal after 3 seconds
            setTimeout(jobportalCloseApplyModal, 3000);
        } else {
            messageEl.textContent = data.data.message;
            messageEl.className = 'jobportal-form-message error';
            messageEl.style.display = 'block';
        }
    })
    .catch(error => {
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;

        messageEl.textContent = '<?php _e('An error occurred. Please try again.', 'jobportal'); ?>';
        messageEl.className = 'jobportal-form-message error';
        messageEl.style.display = 'block';
    });
});
</script>
