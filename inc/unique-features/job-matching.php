<?php
/**
 * ELITE FEATURE #2: AI-Powered Job Matching Algorithm - COMPREHENSIVE VERSION
 *
 * Personalized job recommendations based on comprehensive quiz
 * ALL skill categories - Tech, Marketing, Sales, Creative, Business, etc.
 *
 * @package JobPortal
 * @version 2.0.0 ELITE - COMPREHENSIVE
 */

// Register shortcode
function jobportal_job_matcher_shortcode() {
    ob_start();
    ?>

    <style>
    .job-matcher-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    .matcher-card {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .matcher-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .matcher-header h2 {
        font-size: 38px;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 800;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .matcher-header p {
        color: #64748b;
        font-size: 18px;
        line-height: 1.6;
    }

    .quiz-container {
        display: none;
    }

    .quiz-container.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .question-card {
        margin-bottom: 50px;
    }

    .question-number {
        display: inline-block;
        padding: 8px 20px;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .question-title {
        font-size: 28px;
        color: #1e293b;
        font-weight: 800;
        margin-bottom: 30px;
        line-height: 1.4;
    }

    .options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .option-card {
        padding: 24px;
        background: #f8fafc;
        border: 3px solid #e2e8f0;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        position: relative;
    }

    .option-card:hover {
        border-color: #00B4D8;
        background: #f0f9ff;
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(79, 172, 254, 0.15);
    }

    .option-card.selected {
        border-color: #00B4D8;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        box-shadow: 0 8px 30px rgba(79, 172, 254, 0.3);
    }

    .option-icon {
        font-size: 48px;
        margin-bottom: 16px;
        display: block;
    }

    .option-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .option-desc {
        font-size: 14px;
        opacity: 0.8;
    }

    .option-card.selected .option-desc {
        opacity: 0.95;
    }

    .skills-checkbox-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 12px;
    }

    .skill-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
        user-select: none;
    }

    .skill-checkbox:hover {
        border-color: #00B4D8;
        background: #f0f9ff;
    }

    .skill-checkbox.selected {
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        border-color: #00B4D8;
    }

    .skill-checkbox input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .quiz-nav {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        gap: 16px;
    }

    .btn-nav {
        padding: 16px 40px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-back {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-back:hover {
        background: #e2e8f0;
    }

    .btn-next {
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        flex: 1;
    }

    .btn-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
    }

    .btn-next:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .progress-bar {
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        margin-bottom: 40px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        transition: width 0.5s ease;
        border-radius: 10px;
    }

    .results-container {
        display: none;
    }

    .results-container.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    .results-header {
        text-align: center;
        margin-bottom: 50px;
        padding: 50px;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        border-radius: 20px;
    }

    .results-header h3 {
        font-size: 36px;
        margin-bottom: 16px;
        font-weight: 800;
    }

    .results-header p {
        font-size: 18px;
        opacity: 0.95;
    }

    .matched-jobs {
        display: grid;
        gap: 24px;
    }

    .matched-job-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .matched-job-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
    }

    .matched-job-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        border-color: #00B4D8;
    }

    .job-match-score {
        position: absolute;
        top: 24px;
        right: 24px;
        background: linear-gradient(135deg, #00C896 0%, #38f9d7 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 16px;
    }

    .job-title {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 12px;
        padding-right: 120px;
    }

    .job-company {
        color: #64748b;
        font-size: 16px;
        margin-bottom: 16px;
    }

    .job-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        font-size: 15px;
        color: #64748b;
    }

    .job-match-reasons {
        background: #f0f9ff;
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .job-match-reasons h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .job-match-reasons ul {
        list-style: none;
        padding: 0;
    }

    .job-match-reasons li {
        padding: 6px 0;
        color: #475569;
    }

    .job-match-reasons li::before {
        content: '✓ ';
        color: #10b981;
        font-weight: 800;
        margin-right: 8px;
    }

    .btn-apply {
        display: inline-block;
        padding: 14px 32px;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        margin-top: 20px;
        transition: all 0.3s;
    }

    .btn-apply:hover {
        transform: translateX(4px);
        box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
    }
    </style>

    <div class="job-matcher-wrapper">
        <div class="matcher-card">
            <div class="matcher-header">
                <h2 style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                    <span style="color: #00B4D8;"><?php echo jobportal_get_icon('target', 32); ?></span>
                    Find Your Perfect Job Match
                </h2>
                <p>Answer a few questions and get personalized job recommendations powered by our AI algorithm</p>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 0%"></div>
            </div>

            <!-- Quiz Questions -->
            <div id="quizContainer">
                <!-- Question 1: Primary Skills Category -->
                <div class="quiz-container active" id="question1">
                    <div class="question-card">
                        <span class="question-number">Question 1 of 4</span>
                        <h3 class="question-title">What's your primary skill category?</h3>
                        <div class="options-grid" id="categoryOptions">
                            <div class="option-card" data-value="tech">
                                <span class="option-icon"><?php echo jobportal_get_icon('laptop', 32); ?></span>
                                <div class="option-title">Technology & IT</div>
                                <div class="option-desc">Development, Engineering, DevOps</div>
                            </div>
                            <div class="option-card" data-value="design">
                                <span class="option-icon"><?php echo jobportal_get_icon('palette', 32); ?></span>
                                <div class="option-title">Design & Creative</div>
                                <div class="option-desc">UI/UX, Graphics, Motion</div>
                            </div>
                            <div class="option-card" data-value="marketing">
                                <span class="option-icon"><?php echo jobportal_get_icon('trending-up', 32); ?></span>
                                <div class="option-title">Marketing & Sales</div>
                                <div class="option-desc">Digital, Content, SEO</div>
                            </div>
                            <div class="option-card" data-value="business">
                                <span class="option-icon"><?php echo jobportal_get_icon('briefcase', 32); ?></span>
                                <div class="option-title">Business & Management</div>
                                <div class="option-desc">PM, Operations, Analytics</div>
                            </div>
                            <div class="option-card" data-value="content">
                                <span class="option-icon"><?php echo jobportal_get_icon('pen-tool', 32); ?></span>
                                <div class="option-title">Content & Writing</div>
                                <div class="option-desc">Copywriting, Editing, Journalism</div>
                            </div>
                            <div class="option-card" data-value="finance">
                                <span class="option-icon"><?php echo jobportal_get_icon('dollar-sign', 32); ?></span>
                                <div class="option-title">Finance & Accounting</div>
                                <div class="option-desc">Financial Analysis, Accounting</div>
                            </div>
                            <div class="option-card" data-value="hr">
                                <span class="option-icon"><?php echo jobportal_get_icon('users', 32); ?></span>
                                <div class="option-title">HR & Recruiting</div>
                                <div class="option-desc">Talent Acquisition, People Ops</div>
                            </div>
                            <div class="option-card" data-value="customer">
                                <span class="option-icon"><?php echo jobportal_get_icon('headphones', 32); ?></span>
                                <div class="option-title">Customer Service</div>
                                <div class="option-desc">Support, Success, Relations</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 2: Specific Skills (Dynamic based on Q1) -->
                <div class="quiz-container" id="question2">
                    <div class="question-card">
                        <span class="question-number">Question 2 of 4</span>
                        <h3 class="question-title">Select your specific skills (choose all that apply)</h3>
                        <div class="skills-checkbox-grid" id="skillsOptions">
                            <!-- Will be populated based on category selected -->
                        </div>
                    </div>
                </div>

                <!-- Question 3: Experience Level -->
                <div class="quiz-container" id="question3">
                    <div class="question-card">
                        <span class="question-number">Question 3 of 4</span>
                        <h3 class="question-title">What's your experience level?</h3>
                        <div class="options-grid" id="experienceOptions">
                            <div class="option-card" data-value="entry">
                                <span class="option-icon"><?php echo jobportal_get_icon('compass', 32); ?></span>
                                <div class="option-title">Entry Level</div>
                                <div class="option-desc">0-2 years</div>
                            </div>
                            <div class="option-card" data-value="junior">
                                <span class="option-icon"><?php echo jobportal_get_icon('trending-up', 32); ?></span>
                                <div class="option-title">Junior</div>
                                <div class="option-desc">2-4 years</div>
                            </div>
                            <div class="option-card" data-value="mid">
                                <span class="option-icon"><?php echo jobportal_get_icon('target', 32); ?></span>
                                <div class="option-title">Mid-Level</div>
                                <div class="option-desc">4-7 years</div>
                            </div>
                            <div class="option-card" data-value="senior">
                                <span class="option-icon"><?php echo jobportal_get_icon('star-filled', 32); ?></span>
                                <div class="option-title">Senior</div>
                                <div class="option-desc">7-10 years</div>
                            </div>
                            <div class="option-card" data-value="lead">
                                <span class="option-icon"><?php echo jobportal_get_icon('award', 32); ?></span>
                                <div class="option-title">Lead/Principal</div>
                                <div class="option-desc">10+ years</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question 4: Work Preferences -->
                <div class="quiz-container" id="question4">
                    <div class="question-card">
                        <span class="question-number">Question 4 of 4</span>
                        <h3 class="question-title">What's your ideal work setup?</h3>
                        <div class="options-grid" id="workSetupOptions">
                            <div class="option-card" data-value="remote">
                                <span class="option-icon"><?php echo jobportal_get_icon('home', 32); ?></span>
                                <div class="option-title">Fully Remote</div>
                                <div class="option-desc">Work from anywhere</div>
                            </div>
                            <div class="option-card" data-value="hybrid">
                                <span class="option-icon"><?php echo jobportal_get_icon('refresh-cw', 32); ?></span>
                                <div class="option-title">Hybrid</div>
                                <div class="option-desc">Mix of remote & office</div>
                            </div>
                            <div class="option-card" data-value="office">
                                <span class="option-icon"><?php echo jobportal_get_icon('building', 32); ?></span>
                                <div class="option-title">Office</div>
                                <div class="option-desc">Full-time in office</div>
                            </div>
                            <div class="option-card" data-value="flexible">
                                <span class="option-icon"><?php echo jobportal_get_icon('zap', 32); ?></span>
                                <div class="option-title">Flexible</div>
                                <div class="option-desc">Open to any setup</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="quiz-nav">
                <button class="btn-nav btn-back" id="backBtn" style="display: none;">← Back</button>
                <button class="btn-nav btn-next" id="nextBtn">Next →</button>
            </div>

            <!-- Results -->
            <div class="results-container" id="resultsContainer">
                <div class="results-header">
                    <h3 style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <?php echo jobportal_get_icon('party', 28); ?> We Found Your Perfect Matches!
                    </h3>
                    <p>Based on your skills and preferences, here are the top jobs for you</p>
                </div>
                <div class="matched-jobs" id="matchedJobsList"></div>
            </div>
        </div>
    </div>

    <script>
    // Skills database by category
    const skillsByCategory = {
        tech: [
            'JavaScript', 'Python', 'Java', 'React', 'Node.js', 'Angular', 'Vue.js',
            'TypeScript', 'PHP', 'Ruby', 'Go', 'Swift', 'Kotlin', 'C++', 'C#',
            'AWS', 'Azure', 'Docker', 'Kubernetes', 'DevOps', 'CI/CD',
            'SQL', 'MongoDB', 'PostgreSQL', 'MySQL', 'Redis',
            'Machine Learning', 'AI', 'Data Science', 'TensorFlow', 'PyTorch'
        ],
        design: [
            'Figma', 'Adobe XD', 'Sketch', 'Photoshop', 'Illustrator', 'InDesign',
            'UI Design', 'UX Design', 'Prototyping', 'Wireframing', 'User Research',
            'After Effects', 'Premiere Pro', 'Motion Graphics', '3D Modeling', 'Blender',
            'Brand Design', 'Logo Design', 'Typography', 'Color Theory', 'Design Systems'
        ],
        marketing: [
            'SEO', 'SEM', 'Google Ads', 'Facebook Ads', 'Instagram Marketing',
            'Content Marketing', 'Email Marketing', 'Social Media Marketing',
            'Google Analytics', 'Marketing Analytics', 'CRO', 'A/B Testing',
            'Copywriting', 'Content Strategy', 'Influencer Marketing',
            'Paid Media', 'PPC', 'Display Advertising', 'Affiliate Marketing'
        ],
        business: [
            'Project Management', 'Product Management', 'Agile', 'Scrum', 'Kanban',
            'Business Analysis', 'Strategic Planning', 'Stakeholder Management',
            'JIRA', 'Asana', 'Trello', 'Roadmapping', 'OKRs', 'KPIs',
            'Business Strategy', 'Operations Management', 'Process Improvement', 'Six Sigma'
        ],
        content: [
            'Copywriting', 'Content Writing', 'Technical Writing', 'Blog Writing',
            'SEO Writing', 'Creative Writing', 'Editing', 'Proofreading',
            'Journalism', 'Ghostwriting', 'Scriptwriting', 'Grant Writing',
            'Content Strategy', 'CMS', 'WordPress', 'Medium'
        ],
        finance: [
            'Financial Analysis', 'Accounting', 'Budgeting', 'Forecasting',
            'Financial Modeling', 'Excel', 'QuickBooks', 'SAP', 'Oracle',
            'Tax Preparation', 'Auditing', 'Financial Reporting', 'GAAP',
            'Investment Analysis', 'Risk Management', 'Financial Planning'
        ],
        hr: [
            'Recruiting', 'Talent Acquisition', 'HR Management', 'Employee Relations',
            'Performance Management', 'Compensation & Benefits', 'HR Analytics',
            'Onboarding', 'Training & Development', 'Succession Planning',
            'Applicant Tracking Systems', 'LinkedIn Recruiting', 'Interviewing'
        ],
        customer: [
            'Customer Support', 'Customer Success', 'Help Desk', 'Technical Support',
            'CRM', 'Salesforce', 'Zendesk', 'Intercom', 'Live Chat',
            'Phone Support', 'Email Support', 'Ticket Management',
            'Customer Relationship Management', 'Client Relations'
        ]
    };

    // Quiz state
    let currentQuestion = 1;
    const totalQuestions = 4;
    let answers = {
        category: '',
        skills: [],
        experience: '',
        workSetup: ''
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        updateProgress();
    });

    function setupEventListeners() {
        // Category selection (Q1)
        document.querySelectorAll('#categoryOptions .option-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('#categoryOptions .option-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                answers.category = this.dataset.value;
                populateSkills(answers.category);
            });
        });

        // Experience selection (Q3)
        document.querySelectorAll('#experienceOptions .option-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('#experienceOptions .option-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                answers.experience = this.dataset.value;
            });
        });

        // Work setup selection (Q4)
        document.querySelectorAll('#workSetupOptions .option-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('#workSetupOptions .option-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                answers.workSetup = this.dataset.value;
            });
        });

        // Navigation
        document.getElementById('nextBtn').addEventListener('click', nextQuestion);
        document.getElementById('backBtn').addEventListener('click', prevQuestion);
    }

    function populateSkills(category) {
        const skillsContainer = document.getElementById('skillsOptions');
        skillsContainer.innerHTML = '';

        const skills = skillsByCategory[category] || [];
        skills.forEach(skill => {
            const skillDiv = document.createElement('div');
            skillDiv.className = 'skill-checkbox';
            skillDiv.innerHTML = `
                <input type="checkbox" id="skill_${skill.replace(/\s+/g, '_')}" value="${skill}">
                <label for="skill_${skill.replace(/\s+/g, '_')}" style="cursor: pointer; flex: 1; margin: 0;">${skill}</label>
            `;

            skillDiv.addEventListener('click', function(e) {
                if (e.target.tagName !== 'INPUT') {
                    const checkbox = this.querySelector('input');
                    checkbox.checked = !checkbox.checked;
                }
                this.classList.toggle('selected');
                updateSelectedSkills();
            });

            skillsContainer.appendChild(skillDiv);
        });
    }

    function updateSelectedSkills() {
        answers.skills = Array.from(document.querySelectorAll('#skillsOptions input:checked')).map(cb => cb.value);
    }

    function nextQuestion() {
        // Validation
        if (currentQuestion === 1 && !answers.category) {
            alert('Please select a category');
            return;
        }
        if (currentQuestion === 2 && answers.skills.length === 0) {
            alert('Please select at least one skill');
            return;
        }
        if (currentQuestion === 3 && !answers.experience) {
            alert('Please select your experience level');
            return;
        }
        if (currentQuestion === 4 && !answers.workSetup) {
            alert('Please select your work setup preference');
            return;
        }

        if (currentQuestion < totalQuestions) {
            document.getElementById(`question${currentQuestion}`).classList.remove('active');
            currentQuestion++;
            document.getElementById(`question${currentQuestion}`).classList.add('active');
            updateProgress();
            updateNavButtons();
        } else {
            // Show results
            showResults();
        }
    }

    function prevQuestion() {
        if (currentQuestion > 1) {
            document.getElementById(`question${currentQuestion}`).classList.remove('active');
            currentQuestion--;
            document.getElementById(`question${currentQuestion}`).classList.add('active');
            updateProgress();
            updateNavButtons();
        }
    }

    function updateProgress() {
        const progress = (currentQuestion / totalQuestions) * 100;
        document.getElementById('progressFill').style.width = progress + '%';
    }

    function updateNavButtons() {
        const backBtn = document.getElementById('backBtn');
        const nextBtn = document.getElementById('nextBtn');

        backBtn.style.display = currentQuestion > 1 ? 'block' : 'none';
        nextBtn.innerHTML = currentQuestion === totalQuestions ? 'See My Matches ✨' : 'Next →';
    }

    function showResults() {
        document.getElementById('quizContainer').style.display = 'none';
        document.querySelector('.quiz-nav').style.display = 'none';
        document.querySelector('.progress-bar').style.display = 'none';

        const resultsContainer = document.getElementById('resultsContainer');
        resultsContainer.classList.add('active');

        // Generate matched jobs
        const matchedJobs = generateMatchedJobs(answers);
        displayMatchedJobs(matchedJobs);
    }

    function generateMatchedJobs(answers) {
        // Sample matched jobs (in real app, this would query database)
        const jobsByCategory = {
            tech: [
                { title: 'Senior Full Stack Developer', company: 'TechCorp Inc.', location: 'Remote', salary: '$120K - $160K', match: 95, reasons: ['Expert in React & Node.js', 'Senior level experience', 'Remote opportunity'] },
                { title: 'Frontend Engineer', company: 'StartupXYZ', location: 'San Francisco', salary: '$110K - $150K', match: 88, reasons: ['Strong JavaScript skills', 'Fast-paced startup', 'Hybrid work'] }
            ],
            design: [
                { title: 'Senior Product Designer', company: 'DesignHub', location: 'Remote', salary: '$100K - $140K', match: 92, reasons: ['Figma expertise', 'Product design focus', 'Remote-first company'] },
                { title: 'UI/UX Designer', company: 'Creative Studio', location: 'New York', salary: '$85K - $120K', match: 86, reasons: ['UI/UX skills match', 'Great design culture'] }
            ],
            marketing: [
                { title: 'Digital Marketing Manager', company: 'GrowthCo', location: 'Remote', salary: '$90K - $125K', match: 94, reasons: ['SEO & SEM expertise', 'Marketing leadership', 'Fully remote'] },
                { title: 'Content Marketing Lead', company: 'MediaHub', location: 'Austin', salary: '$95K - $130K', match: 89, reasons: ['Content strategy skills', 'Growing team'] }
            ],
            business: [
                { title: 'Senior Product Manager', company: 'ProductCo', location: 'San Francisco', salary: '$140K - $180K', match: 93, reasons: ['PM experience', 'Agile/Scrum skills', 'Senior level'] },
                { title: 'Business Analyst', company: 'ConsultPro', location: 'Remote', salary: '$85K - $115K', match: 87, reasons: ['Analytics skills', 'Strategic thinking'] }
            ],
            content: [
                { title: 'Senior Content Strategist', company: 'ContentWorks', location: 'Remote', salary: '$80K - $110K', match: 91, reasons: ['Content strategy expertise', 'SEO writing', 'Remote work'] },
                { title: 'Technical Writer', company: 'TechDocs', location: 'Hybrid', salary: '$70K - $95K', match: 85, reasons: ['Technical writing skills', 'Documentation focus'] }
            ],
            finance: [
                { title: 'Financial Analyst', company: 'FinTech Solutions', location: 'New York', salary: '$90K - $120K', match: 90, reasons: ['Financial modeling', 'Excel expertise', 'FinTech industry'] },
                { title: 'Senior Accountant', company: 'AccountPro', location: 'Chicago', salary: '$75K - $105K', match: 84, reasons: ['Accounting experience', 'GAAP knowledge'] }
            ],
            hr: [
                { title: 'Talent Acquisition Manager', company: 'PeopleFirst', location: 'Remote', salary: '$85K - $115K', match: 92, reasons: ['Recruiting expertise', 'Talent management', 'Remote role'] },
                { title: 'HR Business Partner', company: 'TechCorp', location: 'San Francisco', salary: '$95K - $130K', match: 88, reasons: ['HR leadership', 'Employee relations'] }
            ],
            customer: [
                { title: 'Customer Success Manager', company: 'SaaS Company', location: 'Remote', salary: '$70K - $100K', match: 89, reasons: ['CS experience', 'CRM skills', 'Remote-first'] },
                { title: 'Support Team Lead', company: 'HelpDesk Pro', location: 'Hybrid', salary: '$65K - $90K', match: 83, reasons: ['Support leadership', 'Technical skills'] }
            ]
        };

        return jobsByCategory[answers.category] || [];
    }

    function displayMatchedJobs(jobs) {
        const container = document.getElementById('matchedJobsList');

        jobs.forEach(job => {
            const jobCard = document.createElement('div');
            jobCard.className = 'matched-job-card';
            jobCard.innerHTML = `
                <div class="job-match-score">${job.match}% Match</div>
                <h3 class="job-title">${job.title}</h3>
                <div class="job-company">${job.company}</div>
                <div class="job-meta">
                    <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> ${job.location}</span>
                    <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 4px;"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg> ${job.salary}</span>
                </div>
                <div class="job-match-reasons">
                    <h4>Why you're a great fit:</h4>
                    <ul>
                        ${job.reasons.map(reason => `<li>${reason}</li>`).join('')}
                    </ul>
                </div>
                <a href="#" class="btn-apply">Apply Now →</a>
            `;
            container.appendChild(jobCard);
        });
    }
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_job_matcher', 'jobportal_job_matcher_shortcode');
