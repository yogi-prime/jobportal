<?php
/**
 * Job Seeder - Creates 40 Demo Jobs on Theme Activation
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

/**
 * Seed 40 demo jobs when theme is activated
 */
function jobportal_seed_demo_jobs() {
    // Check if jobs have already been seeded
    if (get_option('jobportal_jobs_seeded')) {
        return;
    }

    // Sample job data - 40 jobs
    $demo_jobs = array(
        array('title' => 'Senior Frontend Developer', 'company' => 'TechCorp Inc.', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$120K - $160K', 'description' => 'We are looking for a talented Frontend Developer to join our team.'),
        array('title' => 'Product Designer', 'company' => 'DesignHub', 'location' => 'New York, NY', 'type' => 'Full-Time', 'salary' => '$100K - $140K', 'description' => 'Create beautiful user experiences for our products.'),
        array('title' => 'Marketing Manager', 'company' => 'GrowthCo', 'location' => 'San Francisco, CA', 'type' => 'Full-Time', 'salary' => '$90K - $120K', 'description' => 'Lead our marketing team to drive growth.'),
        array('title' => 'Data Scientist', 'company' => 'DataLabs AI', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$130K - $170K', 'description' => 'Analyze data and build machine learning models.'),
        array('title' => 'DevOps Engineer', 'company' => 'CloudSystems', 'location' => 'Seattle, WA', 'type' => 'Contract', 'salary' => '$140K - $180K', 'description' => 'Manage our cloud infrastructure and deployment pipelines.'),
        array('title' => 'Content Writer', 'company' => 'MediaCo', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$50K - $70K', 'description' => 'Create engaging content for our blog and social media.'),
        array('title' => 'Full Stack Developer', 'company' => 'StartupXYZ', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$110K - $150K', 'description' => 'Build full-stack web applications.'),
        array('title' => 'UX Researcher', 'company' => 'ResearchPro', 'location' => 'Boston, MA', 'type' => 'Full-Time', 'salary' => '$95K - $125K', 'description' => 'Conduct user research to improve product UX.'),
        array('title' => 'Sales Director', 'company' => 'SalesForce Pro', 'location' => 'Chicago, IL', 'type' => 'Full-Time', 'salary' => '$150K - $200K', 'description' => 'Lead our sales team to achieve targets.'),
        array('title' => 'Content Strategist', 'company' => 'MediaHub', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$80K - $110K', 'description' => 'Develop content strategy for multiple brands.'),

        array('title' => 'Backend Developer', 'company' => 'CodeFactory', 'location' => 'Austin, TX', 'type' => 'Full-Time', 'salary' => '$115K - $145K', 'description' => 'Build scalable backend systems using Node.js and Python.'),
        array('title' => 'Mobile App Developer', 'company' => 'AppWorks', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$120K - $155K', 'description' => 'Develop native mobile apps for iOS and Android.'),
        array('title' => 'Product Manager', 'company' => 'ProductHub', 'location' => 'San Francisco, CA', 'type' => 'Full-Time', 'salary' => '$140K - $180K', 'description' => 'Define product roadmap and prioritize features.'),
        array('title' => 'Graphic Designer', 'company' => 'Creative Studio', 'location' => 'Los Angeles, CA', 'type' => 'Full-Time', 'salary' => '$70K - $95K', 'description' => 'Create stunning visual designs for brands.'),
        array('title' => 'QA Engineer', 'company' => 'TestLab', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$85K - $115K', 'description' => 'Ensure quality through comprehensive testing.'),
        array('title' => 'Cybersecurity Analyst', 'company' => 'SecureNet', 'location' => 'Washington DC', 'type' => 'Full-Time', 'salary' => '$110K - $145K', 'description' => 'Protect our systems from cyber threats.'),
        array('title' => 'Account Executive', 'company' => 'SalesPro', 'location' => 'New York, NY', 'type' => 'Full-Time', 'salary' => '$95K - $130K', 'description' => 'Manage client relationships and drive revenue.'),
        array('title' => 'HR Manager', 'company' => 'PeopleFirst', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$90K - $120K', 'description' => 'Lead HR initiatives and talent acquisition.'),
        array('title' => 'Business Analyst', 'company' => 'ConsultCo', 'location' => 'Chicago, IL', 'type' => 'Full-Time', 'salary' => '$95K - $125K', 'description' => 'Analyze business processes and recommend improvements.'),
        array('title' => 'Video Editor', 'company' => 'VideoWorks', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$60K - $85K', 'description' => 'Edit videos for marketing and social media.'),

        array('title' => 'System Administrator', 'company' => 'TechOps', 'location' => 'Denver, CO', 'type' => 'Full-Time', 'salary' => '$85K - $110K', 'description' => 'Maintain and optimize IT infrastructure.'),
        array('title' => 'Social Media Manager', 'company' => 'SocialBuzz', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$75K - $100K', 'description' => 'Manage social media presence across platforms.'),
        array('title' => 'SEO Specialist', 'company' => 'SearchMasters', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$70K - $95K', 'description' => 'Optimize websites for search engines.'),
        array('title' => 'Customer Success Manager', 'company' => 'ClientCare', 'location' => 'Austin, TX', 'type' => 'Full-Time', 'salary' => '$80K - $110K', 'description' => 'Ensure customer satisfaction and retention.'),
        array('title' => 'Cloud Architect', 'company' => 'CloudPro', 'location' => 'Seattle, WA', 'type' => 'Full-Time', 'salary' => '$150K - $190K', 'description' => 'Design cloud infrastructure and solutions.'),
        array('title' => 'Financial Analyst', 'company' => 'FinTech Solutions', 'location' => 'New York, NY', 'type' => 'Full-Time', 'salary' => '$90K - $120K', 'description' => 'Analyze financial data and create reports.'),
        array('title' => 'UI Designer', 'company' => 'DesignLab', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$85K - $115K', 'description' => 'Design beautiful user interfaces.'),
        array('title' => 'Technical Writer', 'company' => 'DocuWorks', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$65K - $90K', 'description' => 'Write technical documentation and guides.'),
        array('title' => 'Project Manager', 'company' => 'ProjectPro', 'location' => 'San Francisco, CA', 'type' => 'Full-Time', 'salary' => '$110K - $145K', 'description' => 'Manage projects from start to finish.'),
        array('title' => 'Network Engineer', 'company' => 'NetSystems', 'location' => 'Boston, MA', 'type' => 'Full-Time', 'salary' => '$95K - $125K', 'description' => 'Design and maintain network infrastructure.'),

        array('title' => 'AI Engineer', 'company' => 'AI Labs', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$140K - $180K', 'description' => 'Develop AI and machine learning solutions.'),
        array('title' => 'Brand Manager', 'company' => 'BrandWorks', 'location' => 'Los Angeles, CA', 'type' => 'Full-Time', 'salary' => '$100K - $135K', 'description' => 'Manage brand identity and strategy.'),
        array('title' => 'Copywriter', 'company' => 'ContentCraft', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$55K - $80K', 'description' => 'Write compelling copy for marketing campaigns.'),
        array('title' => 'Recruiter', 'company' => 'TalentFind', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$70K - $95K', 'description' => 'Source and recruit top talent.'),
        array('title' => 'Operations Manager', 'company' => 'OpsCo', 'location' => 'Chicago, IL', 'type' => 'Full-Time', 'salary' => '$105K - $140K', 'description' => 'Optimize business operations and processes.'),
        array('title' => 'Blockchain Developer', 'company' => 'CryptoTech', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$130K - $170K', 'description' => 'Build blockchain applications and smart contracts.'),
        array('title' => 'Email Marketing Specialist', 'company' => 'EmailPro', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$65K - $90K', 'description' => 'Create and manage email marketing campaigns.'),
        array('title' => 'Game Developer', 'company' => 'GameStudio', 'location' => 'Austin, TX', 'type' => 'Full-Time', 'salary' => '$95K - $130K', 'description' => 'Develop games for mobile and desktop.'),
        array('title' => 'Legal Counsel', 'company' => 'LegalTech', 'location' => 'New York, NY', 'type' => 'Full-Time', 'salary' => '$140K - $185K', 'description' => 'Provide legal advice and manage compliance.'),
        array('title' => 'Virtual Assistant', 'company' => 'VA Services', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$35K - $50K', 'description' => 'Provide administrative support remotely.'),
    );

    // Create jobs as regular posts (since custom post type may not be registered yet)
    foreach ($demo_jobs as $job_data) {
        $post_content = '<p>' . $job_data['description'] . '</p>

<h2>Job Details</h2>
<ul>
<li><strong>Company:</strong> ' . $job_data['company'] . '</li>
<li><strong>Location:</strong> ' . $job_data['location'] . '</li>
<li><strong>Type:</strong> ' . $job_data['type'] . '</li>
<li><strong>Salary:</strong> ' . $job_data['salary'] . '</li>
</ul>

<h2>Requirements</h2>
<ul>
<li>3+ years of relevant experience</li>
<li>Strong communication skills</li>
<li>Team player with leadership qualities</li>
<li>Bachelor\'s degree or equivalent</li>
</ul>

<h2>Benefits</h2>
<ul>
<li>Health, dental, and vision insurance</li>
<li>401(k) with company match</li>
<li>Unlimited PTO</li>
<li>Remote work options</li>
<li>Professional development budget</li>
</ul>';

        $post_id = wp_insert_post(array(
            'post_title'    => $job_data['title'],
            'post_content'  => $post_content,
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_category' => array(1), // Default category
            'tags_input'    => array('job', 'hiring', $job_data['type']),
        ));

        // Add post meta for job details
        if ($post_id) {
            update_post_meta($post_id, 'job_company', $job_data['company']);
            update_post_meta($post_id, 'job_location', $job_data['location']);
            update_post_meta($post_id, 'job_type', $job_data['type']);
            update_post_meta($post_id, 'job_salary', $job_data['salary']);
            update_post_meta($post_id, 'is_featured_job', ($post_id % 5 === 0) ? '1' : '0'); // Mark every 5th job as featured
        }
    }

    // Mark jobs as seeded
    update_option('jobportal_jobs_seeded', true);
}
add_action('after_switch_theme', 'jobportal_seed_demo_jobs');

/**
 * Reset job seeding option (for testing)
 */
function jobportal_reset_job_seeder() {
    delete_option('jobportal_jobs_seeded');
}
// Uncomment to reset: add_action('init', 'jobportal_reset_job_seeder');
