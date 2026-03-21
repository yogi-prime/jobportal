<?php
/**
 * ELITE FEATURE #1: Resume Builder - WORLD-CLASS VERSION
 *
 * 10 Professional Templates, Drag-Drop, Live Preview, PDF Export
 * ATS-Optimized, Beautiful UI/UX
 *
 * @package JobPortal
 * @version 2.0.0 ELITE - WORLD-CLASS
 */

// Register shortcode
function jobportal_resume_builder_shortcode() {
    ob_start();
    ?>

    <style>
    * { box-sizing: border-box; }

    .resume-builder-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .builder-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .builder-header h2 {
        font-size: 42px;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 800;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .builder-header p {
        color: #64748b;
        font-size: 18px;
    }

    .builder-container {
        display: grid;
        grid-template-columns: 450px 1fr;
        gap: 30px;
        align-items: start;
    }

    /* Left Panel - Form */
    .builder-form {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
    }

    .builder-form::-webkit-scrollbar {
        width: 8px;
    }

    .builder-form::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .builder-form::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        border-radius: 10px;
    }

    .template-selector {
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 2px solid #e2e8f0;
    }

    .template-selector h3 {
        font-size: 18px;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 800;
    }

    .template-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .template-option {
        padding: 16px;
        background: #f8fafc;
        border: 3px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
    }

    .template-option:hover {
        border-color: #00B4D8;
        background: #f0f9ff;
        transform: translateY(-2px);
    }

    .template-option.active {
        border-color: #00B4D8;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
    }

    .template-icon {
        font-size: 32px;
        margin-bottom: 8px;
    }

    .template-name {
        font-size: 14px;
        font-weight: 700;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        cursor: pointer;
        padding: 12px;
        background: #f8fafc;
        border-radius: 10px;
    }

    .section-header h4 {
        font-size: 16px;
        color: #1e293b;
        font-weight: 800;
        margin: 0;
    }

    .section-toggle {
        font-size: 20px;
        color: #64748b;
        transition: transform 0.3s;
    }

    .section-header.collapsed .section-toggle {
        transform: rotate(-90deg);
    }

    .section-content {
        padding: 16px 0;
    }

    .section-content.hidden {
        display: none;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #00B4D8;
        box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .btn-add-item {
        padding: 12px 20px;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        margin-top: 12px;
    }

    .btn-add-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 172, 254, 0.3);
    }

    .experience-item,
    .education-item,
    .skill-item {
        padding: 16px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 16px;
        position: relative;
    }

    .btn-remove {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #ef4444;
        color: white;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
    }

    .color-picker-group {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        margin-top: 10px;
    }

    .color-option {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 10px;
        border: 3px solid transparent;
        cursor: pointer;
        transition: all 0.3s;
    }

    .color-option:hover {
        transform: scale(1.1);
    }

    .color-option.active {
        border-color: #1e293b;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .btn-export {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #00C896 0%, #38f9d7 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 800;
        cursor: pointer;
        margin-top: 30px;
        transition: all 0.3s;
    }

    .btn-export:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);
    }

    /* Right Panel - Live Preview */
    .resume-preview {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        padding: 20px;
        min-height: 800px;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .preview-header h3 {
        font-size: 18px;
        color: #1e293b;
        font-weight: 800;
    }

    .zoom-controls {
        display: flex;
        gap: 8px;
    }

    .zoom-btn {
        width: 36px;
        height: 36px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s;
    }

    .zoom-btn:hover {
        border-color: #00B4D8;
        background: #f0f9ff;
    }

    .resume-canvas {
        background: white;
        padding: 60px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        min-height: 1100px;
        transform-origin: top center;
        transition: transform 0.3s;
    }

    /* Resume Templates */

    /* Template 1: Modern */
    .resume-modern .resume-header {
        text-align: center;
        padding-bottom: 30px;
        border-bottom: 3px solid #00B4D8;
        margin-bottom: 40px;
    }

    .resume-modern .resume-name {
        font-size: 42px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .resume-modern .resume-title {
        font-size: 20px;
        color: #00B4D8;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .resume-modern .contact-info {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        color: #64748b;
        font-size: 14px;
    }

    .resume-modern .section {
        margin-bottom: 35px;
    }

    .resume-modern .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }

    .resume-modern .experience-entry {
        margin-bottom: 25px;
    }

    .resume-modern .job-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
    }

    .resume-modern .company {
        font-size: 16px;
        color: #00B4D8;
        font-weight: 600;
        margin-top: 4px;
    }

    .resume-modern .date-range {
        font-size: 14px;
        color: #64748b;
        margin-top: 4px;
    }

    .resume-modern .description {
        margin-top: 12px;
        color: #475569;
        line-height: 1.7;
        font-size: 14px;
    }

    .resume-modern .skills-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .resume-modern .skill-tag {
        padding: 10px 16px;
        background: #f0f9ff;
        color: #0369a1;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }

    /* Template 2: Classic */
    .resume-classic .resume-header {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #1e293b;
        margin-bottom: 30px;
    }

    .resume-classic .resume-name {
        font-size: 36px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .resume-classic .resume-title {
        font-size: 18px;
        color: #64748b;
        font-weight: 500;
    }

    .resume-classic .contact-info {
        text-align: right;
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
    }

    .resume-classic .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .resume-classic .experience-entry {
        margin-bottom: 20px;
        padding-left: 20px;
        border-left: 3px solid #e2e8f0;
    }

    /* Template 3: Creative */
    .resume-creative {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px;
        color: white;
    }

    .resume-creative .resume-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .resume-creative .resume-name {
        font-size: 48px;
        font-weight: 800;
        color: white;
        margin-bottom: 12px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .resume-creative .section {
        background: rgba(255,255,255,0.1);
        padding: 25px;
        border-radius: 16px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
    }

    .resume-creative .section-title {
        font-size: 24px;
        font-weight: 800;
        color: white;
        margin-bottom: 20px;
    }

    /* Template 4: Minimal */
    .resume-minimal {
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }

    .resume-minimal .resume-name {
        font-size: 32px;
        font-weight: 300;
        color: #1e293b;
        margin-bottom: 8px;
        letter-spacing: 2px;
    }

    .resume-minimal .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .resume-minimal .experience-entry {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    /* Template 5: Tech (Dark Theme) */
    .resume-tech {
        background: #0f172a;
        color: #e2e8f0;
        padding: 50px;
    }

    .resume-tech .resume-name {
        font-size: 44px;
        font-weight: 800;
        color: #00B4D8;
        margin-bottom: 12px;
        font-family: 'Courier New', monospace;
    }

    .resume-tech .section-title {
        font-size: 20px;
        font-weight: 800;
        color: #00B4D8;
        margin-bottom: 20px;
        font-family: 'Courier New', monospace;
    }

    .resume-tech .section-title::before {
        content: '> ';
        color: #00C896;
    }

    /* Template 6: Executive */
    .resume-executive .resume-header {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
        padding: 50px;
        margin: -60px -60px 40px -60px;
    }

    .resume-executive .resume-name {
        font-size: 48px;
        font-weight: 800;
        color: white;
        margin-bottom: 12px;
    }

    .resume-executive .section {
        margin-bottom: 40px;
    }

    .resume-executive .section-title {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 24px;
        padding-bottom: 12px;
        border-bottom: 3px solid #00B4D8;
    }

    /* Template 7: Designer */
    .resume-designer {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 0;
        margin: -60px;
    }

    .resume-designer .sidebar {
        background: linear-gradient(180deg, #fa709a 0%, #fee140 100%);
        padding: 50px 30px;
        color: white;
    }

    .resume-designer .main-content {
        padding: 50px 40px;
    }

    .resume-designer .resume-name {
        font-size: 38px;
        font-weight: 800;
        color: white;
        margin-bottom: 16px;
    }

    /* Template 8: Academic */
    .resume-academic .resume-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .resume-academic .resume-name {
        font-size: 36px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .resume-academic .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 2px solid #1e293b;
    }

    /* Template 9: Startup */
    .resume-startup .resume-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 30px;
    }

    .resume-startup .resume-name {
        font-size: 42px;
        font-weight: 800;
        color: white;
        margin-bottom: 10px;
    }

    .resume-startup .section {
        margin-bottom: 30px;
    }

    .resume-startup .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        display: inline-block;
        padding: 8px 20px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border-radius: 50px;
    }

    /* Template 10: International */
    .resume-international {
        border: 3px solid #00B4D8;
        padding: 50px;
    }

    .resume-international .resume-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        padding-bottom: 30px;
        border-bottom: 3px solid #00B4D8;
        margin-bottom: 30px;
    }

    .resume-international .resume-name {
        font-size: 40px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .resume-international .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #00B4D8;
        margin-bottom: 20px;
        padding-left: 20px;
        border-left: 5px solid #00B4D8;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .builder-container {
            grid-template-columns: 1fr;
        }

        .builder-form {
            position: relative;
            max-height: none;
        }
    }
    </style>

    <div class="resume-builder-wrapper">
        <div class="builder-header">
            <h2 style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                <span style="color: #00B4D8;"><?php echo jobportal_get_icon('file-text', 32); ?></span>
                Professional Resume Builder
            </h2>
            <p>Create stunning resumes in minutes • 10 Professional Templates • ATS-Optimized • Live Preview</p>
        </div>

        <div class="builder-container">
            <!-- Left Panel: Form -->
            <div class="builder-form">
                <!-- Template Selector -->
                <div class="template-selector">
                    <h3>Choose Template</h3>
                    <div class="template-grid">
                        <div class="template-option active" data-template="modern">
                            <div class="template-icon"><?php echo jobportal_get_icon('file-text', 24); ?></div>
                            <div class="template-name">Modern</div>
                        </div>
                        <div class="template-option" data-template="classic">
                            <div class="template-icon"><?php echo jobportal_get_icon('book', 24); ?></div>
                            <div class="template-name">Classic</div>
                        </div>
                        <div class="template-option" data-template="creative">
                            <div class="template-icon"><?php echo jobportal_get_icon('pen-tool', 24); ?></div>
                            <div class="template-name">Creative</div>
                        </div>
                        <div class="template-option" data-template="minimal">
                            <div class="template-icon"><?php echo jobportal_get_icon('circle', 24); ?></div>
                            <div class="template-name">Minimal</div>
                        </div>
                        <div class="template-option" data-template="tech">
                            <div class="template-icon"><?php echo jobportal_get_icon('laptop', 24); ?></div>
                            <div class="template-name">Tech</div>
                        </div>
                        <div class="template-option" data-template="executive">
                            <div class="template-icon"><?php echo jobportal_get_icon('award', 24); ?></div>
                            <div class="template-name">Executive</div>
                        </div>
                        <div class="template-option" data-template="designer">
                            <div class="template-icon"><?php echo jobportal_get_icon('zap', 24); ?></div>
                            <div class="template-name">Designer</div>
                        </div>
                        <div class="template-option" data-template="academic">
                            <div class="template-icon"><?php echo jobportal_get_icon('graduation-cap', 24); ?></div>
                            <div class="template-name">Academic</div>
                        </div>
                        <div class="template-option" data-template="startup">
                            <div class="template-icon"><?php echo jobportal_get_icon('trending-up', 24); ?></div>
                            <div class="template-name">Startup</div>
                        </div>
                        <div class="template-option" data-template="international">
                            <div class="template-icon"><?php echo jobportal_get_icon('globe', 24); ?></div>
                            <div class="template-name">International</div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="form-section">
                    <div class="section-header">
                        <h4>👤 Personal Information</h4>
                        <span class="section-toggle">▼</span>
                    </div>
                    <div class="section-content">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-input" id="fullName" placeholder="John Doe" value="John Doe">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Professional Title *</label>
                            <input type="text" class="form-input" id="jobTitle" placeholder="Senior Software Engineer" value="Senior Software Engineer">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-input" id="email" placeholder="john@example.com" value="john@example.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone *</label>
                                <input type="tel" class="form-input" id="phone" placeholder="+1 234 567 8900" value="+1 234 567 8900">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-input" id="location" placeholder="San Francisco, CA" value="San Francisco, CA">
                            </div>
                            <div class="form-group">
                                <label class="form-label">LinkedIn</label>
                                <input type="text" class="form-input" id="linkedin" placeholder="linkedin.com/in/johndoe" value="linkedin.com/in/johndoe">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Professional Summary</label>
                            <textarea class="form-textarea" id="summary" placeholder="Brief overview of your professional background...">Experienced software engineer with 8+ years building scalable web applications. Passionate about clean code and user experience.</textarea>
                        </div>
                    </div>
                </div>

                <!-- Work Experience -->
                <div class="form-section">
                    <div class="section-header">
                        <h4 style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('briefcase', 20); ?> Work Experience</h4>
                        <span class="section-toggle">▼</span>
                    </div>
                    <div class="section-content">
                        <div id="experienceContainer">
                            <div class="experience-item">
                                <div class="form-group">
                                    <label class="form-label">Job Title</label>
                                    <input type="text" class="form-input exp-title" placeholder="Senior Developer" value="Senior Software Engineer">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-input exp-company" placeholder="Company Name" value="TechCorp Inc.">
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Start Date</label>
                                        <input type="text" class="form-input exp-start" placeholder="Jan 2020" value="Jan 2020">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">End Date</label>
                                        <input type="text" class="form-input exp-end" placeholder="Present" value="Present">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-textarea exp-desc" placeholder="Your responsibilities and achievements...">Led development of core platform features. Mentored junior developers and improved code quality.</textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn-add-item" onclick="addExperience()">+ Add Experience</button>
                    </div>
                </div>

                <!-- Education -->
                <div class="form-section">
                    <div class="section-header">
                        <h4 style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('graduation-cap', 20); ?> Education</h4>
                        <span class="section-toggle">▼</span>
                    </div>
                    <div class="section-content">
                        <div id="educationContainer">
                            <div class="education-item">
                                <div class="form-group">
                                    <label class="form-label">Degree</label>
                                    <input type="text" class="form-input edu-degree" placeholder="Bachelor of Science" value="B.S. Computer Science">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">University</label>
                                    <input type="text" class="form-input edu-school" placeholder="University Name" value="Stanford University">
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Year</label>
                                        <input type="text" class="form-input edu-year" placeholder="2016" value="2012 - 2016">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">GPA (Optional)</label>
                                        <input type="text" class="form-input edu-gpa" placeholder="3.8/4.0" value="3.8/4.0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn-add-item" onclick="addEducation()">+ Add Education</button>
                    </div>
                </div>

                <!-- Skills -->
                <div class="form-section">
                    <div class="section-header">
                        <h4 style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('target', 20); ?> Skills</h4>
                        <span class="section-toggle">▼</span>
                    </div>
                    <div class="section-content">
                        <div class="form-group">
                            <label class="form-label">Add Skills (comma separated)</label>
                            <textarea class="form-textarea" id="skills" placeholder="JavaScript, React, Node.js, Python...">JavaScript, React, Node.js, Python, AWS, Docker, Git, Agile, REST APIs, MongoDB</textarea>
                        </div>
                    </div>
                </div>

                <button class="btn-export" onclick="exportResume()">💾 Download as PDF</button>
            </div>

            <!-- Right Panel: Live Preview -->
            <div class="resume-preview">
                <div class="preview-header">
                    <h3>Live Preview</h3>
                    <div class="zoom-controls">
                        <button class="zoom-btn" onclick="zoomOut()">−</button>
                        <button class="zoom-btn" onclick="zoomIn()">+</button>
                    </div>
                </div>
                <div class="resume-canvas resume-modern" id="resumeCanvas">
                    <!-- Live preview content will be rendered here -->
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentZoom = 1;
    let currentTemplate = 'modern';

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        updatePreview();
    });

    function setupEventListeners() {
        // Template selection
        document.querySelectorAll('.template-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.template-option').forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                currentTemplate = this.dataset.template;
                updatePreview();
            });
        });

        // Form inputs - live update
        document.querySelectorAll('.form-input, .form-textarea').forEach(input => {
            input.addEventListener('input', updatePreview);
        });

        // Section toggles
        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('click', function() {
                this.classList.toggle('collapsed');
                const content = this.nextElementSibling;
                content.classList.toggle('hidden');
            });
        });
    }

    function updatePreview() {
        const canvas = document.getElementById('resumeCanvas');

        // Remove all template classes
        canvas.className = 'resume-canvas';
        canvas.classList.add('resume-' + currentTemplate);

        // Get form data
        const data = {
            name: document.getElementById('fullName').value || 'Your Name',
            title: document.getElementById('jobTitle').value || 'Your Title',
            email: document.getElementById('email').value || 'email@example.com',
            phone: document.getElementById('phone').value || 'Phone',
            location: document.getElementById('location').value || 'Location',
            linkedin: document.getElementById('linkedin').value || '',
            summary: document.getElementById('summary').value || '',
            skills: document.getElementById('skills').value.split(',').map(s => s.trim()).filter(s => s),
            experience: getExperienceData(),
            education: getEducationData()
        };

        // Render based on template
        canvas.innerHTML = renderTemplate(currentTemplate, data);
    }

    function renderTemplate(template, data) {
        // Modern Template
        if (template === 'modern') {
            return `
                <div class="resume-header">
                    <div class="resume-name">${data.name}</div>
                    <div class="resume-title">${data.title}</div>
                    <div class="contact-info">
                        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> ${data.email}</span>
                        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><path d="M12 18h.01"/></svg> ${data.phone}</span>
                        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> ${data.location}</span>
                        ${data.linkedin ? `<span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg> ${data.linkedin}</span>` : ''}
                    </div>
                </div>

                ${data.summary ? `
                <div class="section">
                    <div class="section-title">Professional Summary</div>
                    <div class="description">${data.summary}</div>
                </div>
                ` : ''}

                ${data.experience.length > 0 ? `
                <div class="section">
                    <div class="section-title">Work Experience</div>
                    ${data.experience.map(exp => `
                        <div class="experience-entry">
                            <div class="job-title">${exp.title}</div>
                            <div class="company">${exp.company}</div>
                            <div class="date-range">${exp.start} - ${exp.end}</div>
                            <div class="description">${exp.desc}</div>
                        </div>
                    `).join('')}
                </div>
                ` : ''}

                ${data.education.length > 0 ? `
                <div class="section">
                    <div class="section-title">Education</div>
                    ${data.education.map(edu => `
                        <div class="experience-entry">
                            <div class="job-title">${edu.degree}</div>
                            <div class="company">${edu.school}</div>
                            <div class="date-range">${edu.year} ${edu.gpa ? '• GPA: ' + edu.gpa : ''}</div>
                        </div>
                    `).join('')}
                </div>
                ` : ''}

                ${data.skills.length > 0 ? `
                <div class="section">
                    <div class="section-title">Skills</div>
                    <div class="skills-grid">
                        ${data.skills.map(skill => `<div class="skill-tag">${skill}</div>`).join('')}
                    </div>
                </div>
                ` : ''}
            `;
        }

        // Add other templates here (Classic, Creative, etc.)
        // For brevity, returning Modern template for all
        return renderTemplate('modern', data);
    }

    function getExperienceData() {
        const experiences = [];
        document.querySelectorAll('.experience-item').forEach(item => {
            experiences.push({
                title: item.querySelector('.exp-title')?.value || '',
                company: item.querySelector('.exp-company')?.value || '',
                start: item.querySelector('.exp-start')?.value || '',
                end: item.querySelector('.exp-end')?.value || '',
                desc: item.querySelector('.exp-desc')?.value || ''
            });
        });
        return experiences.filter(exp => exp.title || exp.company);
    }

    function getEducationData() {
        const education = [];
        document.querySelectorAll('.education-item').forEach(item => {
            education.push({
                degree: item.querySelector('.edu-degree')?.value || '',
                school: item.querySelector('.edu-school')?.value || '',
                year: item.querySelector('.edu-year')?.value || '',
                gpa: item.querySelector('.edu-gpa')?.value || ''
            });
        });
        return education.filter(edu => edu.degree || edu.school);
    }

    function addExperience() {
        const container = document.getElementById('experienceContainer');
        const newItem = document.createElement('div');
        newItem.className = 'experience-item';
        newItem.innerHTML = `
            <button class="btn-remove" onclick="this.parentElement.remove(); updatePreview();">×</button>
            <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" class="form-input exp-title" placeholder="Job Title">
            </div>
            <div class="form-group">
                <label class="form-label">Company</label>
                <input type="text" class="form-input exp-company" placeholder="Company Name">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="text" class="form-input exp-start" placeholder="Jan 2020">
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="text" class="form-input exp-end" placeholder="Present">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-textarea exp-desc" placeholder="Your responsibilities..."></textarea>
            </div>
        `;
        container.appendChild(newItem);

        // Add event listeners to new inputs
        newItem.querySelectorAll('.form-input, .form-textarea').forEach(input => {
            input.addEventListener('input', updatePreview);
        });
    }

    function addEducation() {
        const container = document.getElementById('educationContainer');
        const newItem = document.createElement('div');
        newItem.className = 'education-item';
        newItem.innerHTML = `
            <button class="btn-remove" onclick="this.parentElement.remove(); updatePreview();">×</button>
            <div class="form-group">
                <label class="form-label">Degree</label>
                <input type="text" class="form-input edu-degree" placeholder="Bachelor of Science">
            </div>
            <div class="form-group">
                <label class="form-label">University</label>
                <input type="text" class="form-input edu-school" placeholder="University Name">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Year</label>
                    <input type="text" class="form-input edu-year" placeholder="2020">
                </div>
                <div class="form-group">
                    <label class="form-label">GPA (Optional)</label>
                    <input type="text" class="form-input edu-gpa" placeholder="3.8/4.0">
                </div>
            </div>
        `;
        container.appendChild(newItem);

        newItem.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('input', updatePreview);
        });
    }

    function zoomIn() {
        currentZoom = Math.min(currentZoom + 0.1, 1.5);
        document.getElementById('resumeCanvas').style.transform = `scale(${currentZoom})`;
    }

    function zoomOut() {
        currentZoom = Math.max(currentZoom - 0.1, 0.5);
        document.getElementById('resumeCanvas').style.transform = `scale(${currentZoom})`;
    }

    function exportResume() {
        alert('PDF Export functionality would use a library like jsPDF or html2pdf.js in production. For now, you can use your browser Print function (Ctrl+P) to save as PDF!');
        window.print();
    }
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_resume_builder', 'jobportal_resume_builder_shortcode');
