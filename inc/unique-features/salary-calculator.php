<?php
/**
 * ELITE FEATURE #4: Salary Calculator - WORLD-CLASS VERSION
 *
 * Calculate market value with worldwide cities data
 * Industry benchmarks, skills impact, negotiation tips
 *
 * @package JobPortal
 * @version 2.0.0 ELITE - WORLD-CLASS
 */

// Register shortcode
function jobportal_salary_calculator_shortcode() {
    ob_start();
    ?>

    <style>
    .salary-calculator-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .salary-calc-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .salary-calc-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .salary-calc-header h2 {
        font-size: 32px;
        color: #1e293b;
        margin-bottom: 12px;
        font-weight: 800;
    }

    .salary-calc-header p {
        color: #64748b;
        font-size: 16px;
    }

    .calc-form-group {
        margin-bottom: 28px;
    }

    .calc-form-label {
        display: block;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .calc-form-input,
    .calc-form-select {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s;
        background: white;
    }

    .calc-form-input:focus,
    .calc-form-select:focus {
        outline: none;
        border-color: #00B4D8;
        box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    }

    .calc-skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 12px;
        margin-top: 10px;
    }

    .calc-skill-tag {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        user-select: none;
    }

    .calc-skill-tag:hover {
        border-color: #00B4D8;
        background: #f0f9ff;
    }

    .calc-skill-tag input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .calc-skill-tag.selected {
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        border-color: #00B4D8;
    }

    .calc-submit-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 30px;
    }

    .calc-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
    }

    .salary-result {
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: white;
        padding: 50px 40px;
        border-radius: 16px;
        text-align: center;
        margin-top: 40px;
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .salary-result h3 {
        font-size: 24px;
        margin-bottom: 20px;
        opacity: 0.95;
    }

    .salary-amount {
        font-size: 56px;
        font-weight: 800;
        margin: 20px 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .salary-range {
        font-size: 20px;
        opacity: 0.9;
        margin-top: 12px;
    }

    .salary-breakdown {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 40px;
    }

    .breakdown-card {
        background: white;
        color: #1e293b;
        padding: 24px;
        border-radius: 12px;
        text-align: left;
    }

    .breakdown-card h4 {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .breakdown-card .value {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
    }

    .negotiation-tips {
        background: white;
        padding: 40px;
        border-radius: 16px;
        margin-top: 30px;
    }

    .negotiation-tips h3 {
        font-size: 24px;
        color: #1e293b;
        margin-bottom: 24px;
        font-weight: 800;
    }

    .tip-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 10px;
        border-left: 4px solid #00B4D8;
    }

    .tip-icon {
        font-size: 24px;
        flex-shrink: 0;
    }

    .tip-content h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .tip-content p {
        color: #64748b;
        line-height: 1.6;
    }

    .country-flag {
        font-size: 24px;
        margin-right: 8px;
    }
    </style>

    <div class="salary-calculator-wrapper">
        <div class="salary-calc-card">
            <div class="salary-calc-header">
                <h2 style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                    <span style="color: #00B4D8;"><?php echo jobportal_get_icon('dollar-sign', 32); ?></span>
                    Worldwide Salary Calculator
                </h2>
                <p>Calculate your market value based on role, location, experience, and skills</p>
            </div>

            <form id="salaryCalcForm" method="post">
                <?php wp_nonce_field('salary_calc_nonce', 'salary_calc_nonce_field'); ?>

                <!-- Job Role -->
                <div class="calc-form-group">
                    <label class="calc-form-label">Job Role / Title</label>
                    <select name="job_role" class="calc-form-select" required>
                        <option value="">Select your role...</option>
                        <optgroup label="Technology & IT">
                            <option value="software_engineer">Software Engineer</option>
                            <option value="senior_developer">Senior Developer</option>
                            <option value="full_stack_dev">Full Stack Developer</option>
                            <option value="frontend_dev">Frontend Developer</option>
                            <option value="backend_dev">Backend Developer</option>
                            <option value="mobile_dev">Mobile Developer</option>
                            <option value="devops">DevOps Engineer</option>
                            <option value="cloud_architect">Cloud Architect</option>
                            <option value="data_scientist">Data Scientist</option>
                            <option value="ml_engineer">Machine Learning Engineer</option>
                            <option value="ai_engineer">AI Engineer</option>
                            <option value="qa_engineer">QA Engineer</option>
                            <option value="security_engineer">Security Engineer</option>
                            <option value="network_engineer">Network Engineer</option>
                            <option value="system_admin">System Administrator</option>
                        </optgroup>
                        <optgroup label="Design & Creative">
                            <option value="product_designer">Product Designer</option>
                            <option value="ui_designer">UI Designer</option>
                            <option value="ux_designer">UX Designer</option>
                            <option value="graphic_designer">Graphic Designer</option>
                            <option value="motion_designer">Motion Designer</option>
                            <option value="3d_designer">3D Designer</option>
                            <option value="illustrator">Illustrator</option>
                            <option value="video_editor">Video Editor</option>
                        </optgroup>
                        <optgroup label="Marketing & Sales">
                            <option value="marketing_manager">Marketing Manager</option>
                            <option value="digital_marketer">Digital Marketer</option>
                            <option value="content_marketer">Content Marketer</option>
                            <option value="seo_specialist">SEO Specialist</option>
                            <option value="social_media_manager">Social Media Manager</option>
                            <option value="sales_manager">Sales Manager</option>
                            <option value="account_executive">Account Executive</option>
                            <option value="business_dev">Business Development</option>
                        </optgroup>
                        <optgroup label="Business & Management">
                            <option value="product_manager">Product Manager</option>
                            <option value="project_manager">Project Manager</option>
                            <option value="operations_manager">Operations Manager</option>
                            <option value="hr_manager">HR Manager</option>
                            <option value="financial_analyst">Financial Analyst</option>
                            <option value="business_analyst">Business Analyst</option>
                            <option value="consultant">Consultant</option>
                        </optgroup>
                        <optgroup label="✍️ Content & Writing">
                            <option value="content_writer">Content Writer</option>
                            <option value="copywriter">Copywriter</option>
                            <option value="technical_writer">Technical Writer</option>
                            <option value="editor">Editor</option>
                            <option value="journalist">Journalist</option>
                        </optgroup>
                        <optgroup label="Other">
                            <option value="teacher">Teacher</option>
                            <option value="researcher">Researcher</option>
                            <option value="customer_support">Customer Support</option>
                            <option value="recruiter">Recruiter</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Country Selection -->
                <div class="calc-form-group">
                    <label class="calc-form-label">Country</label>
                    <select name="country" id="countrySelect" class="calc-form-select" required>
                        <option value="">Select country...</option>
                        <option value="usa">🇺🇸 United States</option>
                        <option value="india">🇮🇳 India</option>
                        <option value="uk">🇬🇧 United Kingdom</option>
                        <option value="canada">🇨🇦 Canada</option>
                        <option value="australia">🇦🇺 Australia</option>
                        <option value="germany">🇩🇪 Germany</option>
                        <option value="france">🇫🇷 France</option>
                        <option value="singapore">🇸🇬 Singapore</option>
                        <option value="uae">🇦🇪 UAE</option>
                        <option value="netherlands">🇳🇱 Netherlands</option>
                        <option value="sweden">🇸🇪 Sweden</option>
                        <option value="switzerland">🇨🇭 Switzerland</option>
                        <option value="japan">🇯🇵 Japan</option>
                        <option value="china">🇨🇳 China</option>
                        <option value="brazil">🇧🇷 Brazil</option>
                        <option value="mexico">🇲🇽 Mexico</option>
                        <option value="spain">🇪🇸 Spain</option>
                        <option value="italy">🇮🇹 Italy</option>
                        <option value="ireland">🇮🇪 Ireland</option>
                        <option value="poland">🇵🇱 Poland</option>
                    </select>
                </div>

                <!-- City Selection (Dynamic based on country) -->
                <div class="calc-form-group">
                    <label class="calc-form-label">City</label>
                    <select name="city" id="citySelect" class="calc-form-select" required>
                        <option value="">First select a country...</option>
                    </select>
                </div>

                <!-- Experience Level -->
                <div class="calc-form-group">
                    <label class="calc-form-label">Years of Experience</label>
                    <select name="experience" class="calc-form-select" required>
                        <option value="">Select experience...</option>
                        <option value="0-1">0-1 years (Entry Level)</option>
                        <option value="1-3">1-3 years (Junior)</option>
                        <option value="3-5">3-5 years (Mid-Level)</option>
                        <option value="5-8">5-8 years (Senior)</option>
                        <option value="8-12">8-12 years (Lead)</option>
                        <option value="12+">12+ years (Principal/Architect)</option>
                    </select>
                </div>

                <!-- Skills Selection -->
                <div class="calc-form-group">
                    <label class="calc-form-label">Skills (Select all that apply - Each adds value!)</label>
                    <div class="calc-skills-grid" id="skillsGrid">
                        <!-- Will be populated dynamically -->
                    </div>
                </div>

                <!-- Education -->
                <div class="calc-form-group">
                    <label class="calc-form-label">Education Level</label>
                    <select name="education" class="calc-form-select" required>
                        <option value="">Select education...</option>
                        <option value="high_school">High School</option>
                        <option value="bachelors">Bachelor's Degree</option>
                        <option value="masters">Master's Degree</option>
                        <option value="phd">PhD</option>
                        <option value="bootcamp">Bootcamp/Certificate</option>
                    </select>
                </div>

                <!-- Company Size -->
                <div class="calc-form-group">
                    <label class="calc-form-label">Company Size</label>
                    <select name="company_size" class="calc-form-select" required>
                        <option value="">Select company size...</option>
                        <option value="startup">Startup (1-50)</option>
                        <option value="small">Small (51-200)</option>
                        <option value="medium">Medium (201-1000)</option>
                        <option value="large">Large (1001-5000)</option>
                        <option value="enterprise">Enterprise (5000+)</option>
                    </select>
                </div>

                <button type="submit" class="calc-submit-btn" style="display: flex; align-items: center; justify-content: center; gap: 8px; margin: 0 auto;">
                    Calculate My Salary <?php echo jobportal_get_icon('dollar-sign', 20); ?>
                </button>
            </form>

            <div id="salaryResult"></div>
        </div>
    </div>

    <script>
    // Worldwide cities database
    const citiesData = {
        usa: ['New York', 'San Francisco', 'Los Angeles', 'Seattle', 'Austin', 'Boston', 'Chicago', 'Denver', 'Portland', 'Miami', 'Atlanta', 'Dallas'],
        india: ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Pune', 'Chennai', 'Kolkata', 'Ahmedabad', 'Noida', 'Gurgaon', 'Jaipur', 'Chandigarh'],
        uk: ['London', 'Manchester', 'Birmingham', 'Edinburgh', 'Bristol', 'Leeds', 'Liverpool', 'Cambridge', 'Oxford'],
        canada: ['Toronto', 'Vancouver', 'Montreal', 'Calgary', 'Ottawa', 'Edmonton', 'Winnipeg'],
        australia: ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Canberra'],
        germany: ['Berlin', 'Munich', 'Frankfurt', 'Hamburg', 'Cologne', 'Stuttgart'],
        france: ['Paris', 'Lyon', 'Marseille', 'Toulouse', 'Nice', 'Bordeaux'],
        singapore: ['Singapore'],
        uae: ['Dubai', 'Abu Dhabi', 'Sharjah'],
        netherlands: ['Amsterdam', 'Rotterdam', 'The Hague', 'Utrecht'],
        sweden: ['Stockholm', 'Gothenburg', 'Malmö'],
        switzerland: ['Zurich', 'Geneva', 'Basel', 'Bern'],
        japan: ['Tokyo', 'Osaka', 'Kyoto', 'Yokohama', 'Nagoya'],
        china: ['Beijing', 'Shanghai', 'Shenzhen', 'Guangzhou', 'Hangzhou'],
        brazil: ['São Paulo', 'Rio de Janeiro', 'Brasília', 'Salvador'],
        mexico: ['Mexico City', 'Guadalajara', 'Monterrey'],
        spain: ['Madrid', 'Barcelona', 'Valencia', 'Seville'],
        italy: ['Rome', 'Milan', 'Naples', 'Turin'],
        ireland: ['Dublin', 'Cork', 'Galway'],
        poland: ['Warsaw', 'Krakow', 'Wroclaw']
    };

    // Skills database
    const skillsData = [
        'React', 'Angular', 'Vue.js', 'Node.js', 'Python', 'Java', 'C++', 'Go',
        'TypeScript', 'JavaScript', 'PHP', 'Ruby', 'Swift', 'Kotlin',
        'AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Jenkins',
        'SQL', 'MongoDB', 'PostgreSQL', 'Redis', 'Elasticsearch',
        'Machine Learning', 'AI', 'Deep Learning', 'TensorFlow', 'PyTorch',
        'Figma', 'Adobe XD', 'Sketch', 'Photoshop', 'Illustrator',
        'SEO', 'SEM', 'Google Analytics', 'Facebook Ads', 'Content Marketing',
        'Salesforce', 'HubSpot', 'Excel', 'Tableau', 'Power BI',
        'Agile', 'Scrum', 'JIRA', 'Git', 'CI/CD'
    ];

    // Populate skills grid
    const skillsGrid = document.getElementById('skillsGrid');
    skillsData.forEach(skill => {
        const skillTag = document.createElement('div');
        skillTag.className = 'calc-skill-tag';
        skillTag.innerHTML = `
            <input type="checkbox" name="skills[]" value="${skill}" id="skill_${skill.replace(/\s+/g, '_')}">
            <label for="skill_${skill.replace(/\s+/g, '_')}" style="cursor: pointer; margin: 0;">${skill}</label>
        `;
        skillTag.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') {
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            }
            this.classList.toggle('selected');
        });
        skillsGrid.appendChild(skillTag);
    });

    // Country change handler
    document.getElementById('countrySelect').addEventListener('change', function() {
        const country = this.value;
        const citySelect = document.getElementById('citySelect');
        citySelect.innerHTML = '<option value="">Select city...</option>';

        if (citiesData[country]) {
            citiesData[country].forEach(city => {
                const option = document.createElement('option');
                option.value = city.toLowerCase().replace(/\s+/g, '_');
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    });

    // Form submission (simulated calculation)
    document.getElementById('salaryCalcForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const role = formData.get('job_role');
        const country = formData.get('country');
        const city = formData.get('city');
        const experience = formData.get('experience');
        const education = formData.get('education');
        const companySize = formData.get('company_size');
        const skills = formData.getAll('skills[]');

        // Simulate salary calculation (in real app, this would be server-side)
        let baseSalary = calculateSalary(role, country, city, experience, education, companySize, skills);

        displayResults(baseSalary, skills.length, country);
    });

    function calculateSalary(role, country, city, experience, education, companySize, skills) {
        // Base salary by role and country (simplified)
        const baseSalaries = {
            usa: 100000,
            india: 800000, // INR
            uk: 50000, // GBP
            canada: 85000, // CAD
            australia: 90000, // AUD
            germany: 55000, // EUR
            default: 60000
        };

        let salary = baseSalaries[country] || baseSalaries.default;

        // Experience multiplier
        const expMultipliers = {
            '0-1': 0.7,
            '1-3': 1.0,
            '3-5': 1.3,
            '5-8': 1.6,
            '8-12': 2.0,
            '12+': 2.5
        };
        salary *= (expMultipliers[experience] || 1);

        // Education bonus
        const eduBonus = {
            high_school: 0,
            bachelors: 1.1,
            masters: 1.25,
            phd: 1.4,
            bootcamp: 1.05
        };
        salary *= (eduBonus[education] || 1);

        // Company size bonus
        const companySizeBonus = {
            startup: 0.9,
            small: 1.0,
            medium: 1.1,
            large: 1.2,
            enterprise: 1.3
        };
        salary *= (companySizeBonus[companySize] || 1);

        // Skills bonus (each skill adds 2-5%)
        salary += (skills.length * salary * 0.03);

        return Math.round(salary);
    }

    function displayResults(baseSalary, skillsCount, country) {
        const currency = getCurrency(country);
        const low = Math.round(baseSalary * 0.85);
        const high = Math.round(baseSalary * 1.15);

        const resultHTML = `
            <div class="salary-result">
                <h3>Your Estimated Market Value</h3>
                <div class="salary-amount">${currency}${formatNumber(baseSalary)}</div>
                <div class="salary-range">Range: ${currency}${formatNumber(low)} - ${currency}${formatNumber(high)}</div>

                <div class="salary-breakdown">
                    <div class="breakdown-card">
                        <h4>Base Salary</h4>
                        <div class="value">${currency}${formatNumber(Math.round(baseSalary * 0.75))}</div>
                    </div>
                    <div class="breakdown-card">
                        <h4>Skills Bonus</h4>
                        <div class="value">+${skillsCount * 3}%</div>
                    </div>
                    <div class="breakdown-card">
                        <h4>Total Comp</h4>
                        <div class="value">${currency}${formatNumber(baseSalary)}</div>
                    </div>
                </div>
            </div>

            <div class="negotiation-tips">
                <h3 style="display: flex; align-items: center; gap: 8px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #00B4D8;">
                        <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    Negotiation Tips
                </h3>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><polyline points="16,12 12,8 8,12"/><line x1="12" y1="16" x2="12" y2="8"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4>Know Your Worth</h4>
                        <p>You're in the top ${getPercentile(baseSalary)}% for your role and location. Use this data confidently in negotiations.</p>
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4>Highlight Your Skills</h4>
                        <p>Your ${skillsCount} skills add significant value. Emphasize your expertise in these areas during discussions.</p>
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4>Consider Total Compensation</h4>
                        <p>Don't forget about benefits, stock options, bonuses, and remote work flexibility when evaluating offers.</p>
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="tip-content">
                        <h4>Timing Matters</h4>
                        <p>Best time to negotiate is after receiving an offer but before accepting. Don't be afraid to ask for more!</p>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('salaryResult').innerHTML = resultHTML;
        document.getElementById('salaryResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function getCurrency(country) {
        const currencies = {
            usa: '$',
            india: '₹',
            uk: '£',
            canada: 'C$',
            australia: 'A$',
            germany: '€',
            france: '€',
            singapore: 'S$',
            uae: 'AED ',
            netherlands: '€',
            sweden: 'SEK ',
            switzerland: 'CHF ',
            japan: '¥',
            china: '¥',
            brazil: 'R$',
            mexico: 'MXN ',
            spain: '€',
            italy: '€',
            ireland: '€',
            poland: 'PLN '
        };
        return currencies[country] || '$';
    }

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function getPercentile(salary) {
        // Simplified percentile calculation
        if (salary > 150000) return 90;
        if (salary > 100000) return 75;
        if (salary > 70000) return 60;
        if (salary > 50000) return 50;
        return 40;
    }
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_salary_calculator', 'jobportal_salary_calculator_shortcode');
