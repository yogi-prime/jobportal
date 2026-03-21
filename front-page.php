<?php
/**
 * JobPortal Elite - EXPANDED Homepage Template
 * Full-Featured Job Portal Homepage with LOTS of content
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

get_header();
?>

<div class="jobportal-homepage">

<!-- Hero Section -->
<section class="jp-hero" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 100px 20px; text-align: center;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 56px; margin-bottom: 20px; font-weight: 800;">Find Your Dream Job Today</h1>
        <p style="font-size: 22px; margin-bottom: 50px; opacity: 0.95;">Discover thousands of job opportunities from top companies worldwide</p>

        <!-- Job Search Form -->
        <form action="<?php echo esc_url(home_url('/jobs')); ?>" method="get" style="max-width: 900px; margin: 0 auto 40px; display: flex; gap: 12px; background: white; padding: 12px; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
            <input type="text" name="s" placeholder="Job title, keywords, or company..." style="flex: 1; padding: 16px 20px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
            <input type="text" name="location" placeholder="City or remote..." style="flex: 1; padding: 16px 20px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 16px;">
            <button type="submit" style="padding: 16px 40px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; border-radius: 8px; font-weight: 700; font-size: 16px; cursor: pointer; white-space: nowrap;">Search Jobs</button>
        </form>

        <!-- Quick Links -->
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 40px;">
            <span style="padding: 8px 16px; background: rgba(255,255,255,0.2); border-radius: 20px; font-size: 14px;">Popular: </span>
            <a href="#" style="padding: 8px 16px; background: rgba(255,255,255,0.15); border-radius: 20px; font-size: 14px; color: white; text-decoration: none;">Remote Jobs</a>
            <a href="#" style="padding: 8px 16px; background: rgba(255,255,255,0.15); border-radius: 20px; font-size: 14px; color: white; text-decoration: none;">Developer</a>
            <a href="#" style="padding: 8px 16px; background: rgba(255,255,255,0.15); border-radius: 20px; font-size: 14px; color: white; text-decoration: none;">Designer</a>
            <a href="#" style="padding: 8px 16px; background: rgba(255,255,255,0.15); border-radius: 20px; font-size: 14px; color: white; text-decoration: none;">Marketing</a>
            <a href="#" style="padding: 8px 16px; background: rgba(255,255,255,0.15); border-radius: 20px; font-size: 14px; color: white; text-decoration: none;">Sales</a>
        </div>

        <!-- Stats -->
        <div style="display: flex; gap: 60px; justify-content: center; font-size: 16px; flex-wrap: wrap;">
            <div><strong style="font-size: 32px; display: block; margin-bottom: 4px;">10,245</strong> Active Jobs</div>
            <div><strong style="font-size: 32px; display: block; margin-bottom: 4px;">8,500+</strong> Companies</div>
            <div><strong style="font-size: 32px; display: block; margin-bottom: 4px;">2M+</strong> Job Seekers</div>
            <div><strong style="font-size: 32px; display: block; margin-bottom: 4px;">95%</strong> Success Rate</div>
        </div>
    </div>
</section>

<!-- Job Categories -->
<section style="padding: 80px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">Browse by Category</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Find jobs that match your skills and interests</p>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php
            $categories = array(
                array('icon' => 'laptop', 'name' => 'Technology', 'jobs' => '2,845'),
                array('icon' => 'palette', 'name' => 'Design', 'jobs' => '1,234'),
                array('icon' => 'megaphone', 'name' => 'Marketing', 'jobs' => '987'),
                array('icon' => 'briefcase', 'name' => 'Business', 'jobs' => '1,567'),
                array('icon' => 'monitor', 'name' => 'Mobile Dev', 'jobs' => '654'),
                array('icon' => 'shield', 'name' => 'Cybersecurity', 'jobs' => '432'),
                array('icon' => 'trending-up', 'name' => 'Sales', 'jobs' => '876'),
                array('icon' => 'graduation-cap', 'name' => 'Education', 'jobs' => '543'),
            );
            foreach ($categories as $cat) : ?>
                <a href="#" style="background: #f8fafc; padding: 32px 24px; border-radius: 12px; text-align: center; text-decoration: none; border: 2px solid #e2e8f0; transition: all 0.3s;">
                    <div style="color: #4facfe; margin-bottom: 12px; display: flex; justify-content: center;"><?php echo jobportal_get_icon($cat['icon'], 48); ?></div>
                    <h3 style="font-size: 18px; margin-bottom: 8px; color: #1e293b; font-weight: 700;"><?php echo esc_html($cat['name']); ?></h3>
                    <div style="color: #64748b; font-size: 14px;"><?php echo esc_html($cat['jobs']); ?> jobs</div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Jobs -->
<section style="padding: 80px 20px; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">Featured Jobs</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Top opportunities from leading companies</p>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-bottom: 40px;">
            <?php
            $jobs = array(
                array('title' => 'Senior Frontend Developer', 'company' => 'TechCorp Inc.', 'location' => 'Remote', 'salary' => '$120K - $160K', 'type' => 'Full-Time', 'posted' => '2 days ago'),
                array('title' => 'Product Designer', 'company' => 'DesignHub', 'location' => 'New York, NY', 'salary' => '$100K - $140K', 'type' => 'Full-Time', 'posted' => '1 week ago'),
                array('title' => 'Marketing Manager', 'company' => 'GrowthCo', 'location' => 'San Francisco', 'salary' => '$90K - $120K', 'type' => 'Full-Time', 'posted' => '3 days ago'),
                array('title' => 'Data Scientist', 'company' => 'DataLabs AI', 'location' => 'Remote', 'salary' => '$130K - $170K', 'type' => 'Full-Time', 'posted' => '5 days ago'),
                array('title' => 'DevOps Engineer', 'company' => 'CloudSystems', 'location' => 'Seattle, WA', 'salary' => '$140K - $180K', 'type' => 'Contract', 'posted' => '1 day ago'),
                array('title' => 'Full Stack Developer', 'company' => 'StartupXYZ', 'location' => 'Remote', 'salary' => '$110K - $150K', 'type' => 'Full-Time', 'posted' => '4 days ago'),
                array('title' => 'UX Researcher', 'company' => 'ResearchPro', 'location' => 'Boston, MA', 'salary' => '$95K - $125K', 'type' => 'Full-Time', 'posted' => '1 week ago'),
                array('title' => 'Sales Director', 'company' => 'SalesForce Pro', 'location' => 'Chicago, IL', 'salary' => '$150K - $200K', 'type' => 'Full-Time', 'posted' => '2 days ago'),
                array('title' => 'Content Strategist', 'company' => 'MediaHub', 'location' => 'Remote', 'salary' => '$80K - $110K', 'type' => 'Part-Time', 'posted' => '6 days ago'),
            );

            foreach ($jobs as $job) : ?>
                <div style="background: white; padding: 28px; border-radius: 12px; border: 2px solid #e2e8f0; transition: all 0.3s;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                        <div>
                            <h3 style="font-size: 20px; margin-bottom: 8px; font-weight: 700;">
                                <a href="<?php echo esc_url(home_url('/job/' . sanitize_title($job['title']))); ?>" style="color: #1e293b; text-decoration: none;"><?php echo esc_html($job['title']); ?></a>
                            </h3>
                            <div style="color: #64748b; font-size: 15px; margin-bottom: 12px;"><?php echo esc_html($job['company']); ?></div>
                        </div>
                        <button style="width: 36px; height: 36px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 18px; cursor: pointer;">♡</button>
                    </div>
                    <div style="display: flex; gap: 20px; margin-bottom: 16px; font-size: 14px; color: #64748b; flex-wrap: wrap;">
                        <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('map-pin', 16); ?> <?php echo esc_html($job['location']); ?></span>
                        <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('dollar-sign', 16); ?> <?php echo esc_html($job['salary']); ?></span>
                        <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('clock', 16); ?> <?php echo esc_html($job['posted']); ?></span>
                    </div>
                    <div style="display: flex; gap: 8px; margin-bottom: 16px;">
                        <span style="padding: 4px 12px; background: #e0f2fe; color: #0369a1; border-radius: 6px; font-size: 13px; font-weight: 600;"><?php echo esc_html($job['type']); ?></span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/job/' . sanitize_title($job['title']))); ?>" style="display: block; text-align: center; padding: 12px; background: #4facfe; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">Apply Now</a>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center;">
            <a href="<?php echo esc_url(home_url('/jobs')); ?>" style="display: inline-block; padding: 14px 40px; background: #4facfe; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 16px;">View All 10,245 Jobs →</a>
        </div>
    </div>
</section>

<!-- Top Companies -->
<section style="padding: 80px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">Top Companies Hiring</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Join teams at world-class organizations</p>

        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 24px;">
            <?php
            $companies = array('Google', 'Microsoft', 'Amazon', 'Meta', 'Apple', 'Netflix', 'Tesla', 'Spotify', 'Airbnb', 'Uber');
            foreach ($companies as $company) : ?>
                <a href="#" style="background: #f8fafc; padding: 40px 20px; border-radius: 12px; text-align: center; border: 2px solid #e2e8f0; text-decoration: none; transition: all 0.3s;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; color: white;"><?php echo substr($company, 0, 1); ?></div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 4px;"><?php echo esc_html($company); ?></h4>
                    <div style="color: #64748b; font-size: 13px;"><?php echo rand(10, 50); ?> open jobs</div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- How It Works -->
<section style="padding: 80px 20px; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">How It Works</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Find your dream job in 3 simple steps</p>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;">
            <div style="text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; color: white;">1</div>
                <h3 style="font-size: 24px; margin-bottom: 12px; font-weight: 700;">Create Your Profile</h3>
                <p style="color: #64748b; line-height: 1.7;">Build your professional profile and upload your resume. Use our Resume Builder for a stunning CV.</p>
            </div>
            <div style="text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; color: white;">2</div>
                <h3 style="font-size: 24px; margin-bottom: 12px; font-weight: 700;">Search & Apply</h3>
                <p style="color: #64748b; line-height: 1.7;">Browse thousands of jobs, get personalized matches, and apply with one click.</p>
            </div>
            <div style="text-align: center;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; color: white;">3</div>
                <h3 style="font-size: 24px; margin-bottom: 12px; font-weight: 700;">Get Hired</h3>
                <p style="color: #64748b; line-height: 1.7;">Schedule interviews with our Interview Scheduler and land your dream job!</p>
            </div>
        </div>
    </div>
</section>

<!-- Elite Tools -->
<section style="padding: 80px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">Free Career Tools</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Powerful tools to accelerate your job search</p>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;">
            <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); padding: 40px; border-radius: 16px; text-align: center; color: white;">
                <div style="margin-bottom: 20px; display: flex; justify-content: center; opacity: 0.95;"><?php echo jobportal_get_icon('file-text', 64); ?></div>
                <h3 style="font-size: 26px; margin-bottom: 16px; font-weight: 800;">Resume Builder</h3>
                <p style="margin-bottom: 24px; opacity: 0.95; line-height: 1.6;">Drag-and-drop resume builder with live preview. Create professional resumes in minutes.</p>
                <a href="<?php echo esc_url(home_url('/resume-builder')); ?>" style="display: inline-block; padding: 12px 32px; background: white; color: #4facfe; text-decoration: none; border-radius: 8px; font-weight: 700;">Build Resume →</a>
            </div>
            <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 40px; border-radius: 16px; text-align: center; color: white;">
                <div style="margin-bottom: 20px; display: flex; justify-content: center; opacity: 0.95;"><?php echo jobportal_get_icon('target', 64); ?></div>
                <h3 style="font-size: 26px; margin-bottom: 16px; font-weight: 800;">Job Matcher</h3>
                <p style="margin-bottom: 24px; opacity: 0.95; line-height: 1.6;">AI-powered job matching algorithm. Take a 4-question quiz for personalized recommendations.</p>
                <a href="<?php echo esc_url(home_url('/job-matcher')); ?>" style="display: inline-block; padding: 12px 32px; background: white; color: #43e97b; text-decoration: none; border-radius: 8px; font-weight: 700;">Find Match →</a>
            </div>
            <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); padding: 40px; border-radius: 16px; text-align: center; color: white;">
                <div style="margin-bottom: 20px; display: flex; justify-content: center; opacity: 0.95;"><?php echo jobportal_get_icon('dollar-sign', 64); ?></div>
                <h3 style="font-size: 26px; margin-bottom: 16px; font-weight: 800;">Salary Calculator</h3>
                <p style="margin-bottom: 24px; opacity: 0.95; line-height: 1.6;">Know your market value. Get industry benchmarks and negotiation tips.</p>
                <a href="<?php echo esc_url(home_url('/salary-calculator')); ?>" style="display: inline-block; padding: 12px 32px; background: white; color: #fa709a; text-decoration: none; border-radius: 8px; font-weight: 700;">Calculate →</a>
            </div>
            <div style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); padding: 40px; border-radius: 16px; text-align: center; color: #1e293b;">
                <div style="margin-bottom: 20px; display: flex; justify-content: center; opacity: 0.85;"><?php echo jobportal_get_icon('chart', 64); ?></div>
                <h3 style="font-size: 26px; margin-bottom: 16px; font-weight: 800;">ATS Dashboard</h3>
                <p style="margin-bottom: 24px; line-height: 1.6;">For employers: Track applications, manage candidates, and hire faster.</p>
                <a href="<?php echo esc_url(home_url('/ats-dashboard')); ?>" style="display: inline-block; padding: 12px 32px; background: #1e293b; color: white; text-decoration: none; border-radius: 8px; font-weight: 700;">Access Dashboard →</a>
            </div>
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px; border-radius: 16px; text-align: center; color: white;">
                <div style="margin-bottom: 20px; display: flex; justify-content: center; opacity: 0.95;"><?php echo jobportal_get_icon('calendar', 64); ?></div>
                <h3 style="font-size: 26px; margin-bottom: 16px; font-weight: 800;">Interview Scheduler</h3>
                <p style="margin-bottom: 24px; opacity: 0.95; line-height: 1.6;">Schedule interviews with built-in calendar. Automatic reminders and timezone support.</p>
                <a href="<?php echo esc_url(home_url('/interview-scheduler')); ?>" style="display: inline-block; padding: 12px 32px; background: white; color: #667eea; text-decoration: none; border-radius: 8px; font-weight: 700;">Schedule →</a>
            </div>
            <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 40px; border-radius: 16px; text-align: center; color: white;">
                <div style="margin-bottom: 20px; display: flex; justify-content: center; opacity: 0.95;"><?php echo jobportal_get_icon('mail', 64); ?></div>
                <h3 style="font-size: 26px; margin-bottom: 16px; font-weight: 800;">Job Alerts</h3>
                <p style="margin-bottom: 24px; opacity: 0.95; line-height: 1.6;">Get notified when new jobs matching your criteria are posted.</p>
                <a href="#" style="display: inline-block; padding: 12px 32px; background: white; color: #f5576c; text-decoration: none; border-radius: 8px; font-weight: 700;">Set Alert →</a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section style="padding: 80px 20px; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">Success Stories</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Hear from job seekers who found their dream careers</p>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;">
            <?php
            $testimonials = array(
                array('name' => 'Sarah Johnson', 'role' => 'Software Engineer at Google', 'text' => 'Found my dream job in just 2 weeks! The resume builder and job matcher made everything so easy.'),
                array('name' => 'Michael Chen', 'role' => 'Product Designer at Airbnb', 'text' => 'The salary calculator helped me negotiate a 20% higher offer. Best job portal I have used!'),
                array('name' => 'Emily Rodriguez', 'role' => 'Marketing Manager at Shopify', 'text' => 'Interview scheduler saved me so much time. Got 5 interviews in one week and landed my dream role!'),
            );
            foreach ($testimonials as $test) : ?>
                <div style="background: white; padding: 32px; border-radius: 12px; border: 2px solid #e2e8f0;">
                    <div style="color: #fbbf24; font-size: 24px; margin-bottom: 16px;">★★★★★</div>
                    <p style="color: #475569; line-height: 1.7; margin-bottom: 20px; font-size: 15px;">"<?php echo esc_html($test['text']); ?>"</p>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; color: white;"><?php echo substr($test['name'], 0, 1); ?></div>
                        <div>
                            <div style="font-weight: 700; color: #1e293b;"><?php echo esc_html($test['name']); ?></div>
                            <div style="font-size: 13px; color: #64748b;"><?php echo esc_html($test['role']); ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Browse by Location -->
<section style="padding: 80px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 40px; margin-bottom: 16px; text-align: center; font-weight: 800;">Browse Jobs by Location</h2>
        <p style="text-align: center; color: #64748b; margin-bottom: 48px; font-size: 18px;">Find opportunities in your city or work remotely</p>

        <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 16px;">
            <?php
            $locations = array(
                array('city' => 'Remote', 'jobs' => '3,456'),
                array('city' => 'San Francisco', 'jobs' => '1,234'),
                array('city' => 'New York', 'jobs' => '2,345'),
                array('city' => 'Austin', 'jobs' => '876'),
                array('city' => 'Seattle', 'jobs' => '987'),
                array('city' => 'Boston', 'jobs' => '654'),
                array('city' => 'Chicago', 'jobs' => '543'),
                array('city' => 'Los Angeles', 'jobs' => '1,098'),
                array('city' => 'Denver', 'jobs' => '432'),
                array('city' => 'Miami', 'jobs' => '321'),
                array('city' => 'Portland', 'jobs' => '298'),
                array('city' => 'Atlanta', 'jobs' => '567'),
            );
            foreach ($locations as $loc) : ?>
                <a href="#" style="background: #f8fafc; padding: 20px 16px; border-radius: 10px; text-align: center; text-decoration: none; border: 2px solid #e2e8f0; transition: all 0.3s;">
                    <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: center;"><?php echo jobportal_get_icon('map-pin', 28); ?></div>
                    <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 4px;"><?php echo esc_html($loc['city']); ?></h4>
                    <div style="color: #64748b; font-size: 12px;"><?php echo esc_html($loc['jobs']); ?> jobs</div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section style="padding: 80px 20px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
    <div style="max-width: 800px; margin: 0 auto; text-align: center;">
        <h2 style="font-size: 40px; margin-bottom: 16px; font-weight: 800;">Never Miss an Opportunity</h2>
        <p style="font-size: 18px; margin-bottom: 40px; opacity: 0.95;">Subscribe to get weekly job alerts, career tips, and exclusive opportunities</p>

        <form style="max-width: 600px; margin: 0 auto; display: flex; gap: 12px;">
            <input type="email" placeholder="Enter your email address..." style="flex: 1; padding: 16px 20px; border: none; border-radius: 8px; font-size: 16px;">
            <button type="submit" style="padding: 16px 40px; background: #1e293b; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; white-space: nowrap;">Subscribe</button>
        </form>

        <p style="font-size: 14px; margin-top: 16px; opacity: 0.8;">Join 100,000+ subscribers. Unsubscribe anytime.</p>
    </div>
</section>

<!-- For Employers CTA -->
<section style="padding: 80px 20px; background: white;">
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <h2 style="font-size: 40px; margin-bottom: 16px; font-weight: 800;">Hiring? We've Got You Covered</h2>
        <p style="color: #64748b; margin-bottom: 40px; font-size: 18px;">Post jobs, track applications, and find the perfect candidates with our ATS</p>

        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo esc_url(home_url('/post-job')); ?>" style="padding: 16px 40px; background: #4facfe; color: white; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 16px;">Post a Job</a>
            <a href="<?php echo esc_url(home_url('/ats-dashboard')); ?>" style="padding: 16px 40px; background: transparent; color: #4facfe; border: 2px solid #4facfe; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 16px;">Access ATS Dashboard</a>
        </div>
    </div>
</section>

</div>

<?php get_footer(); ?>
