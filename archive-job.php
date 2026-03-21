<?php
/**
 * Job Archive Template - Job Listings Page
 *
 * Displays all jobs with search and filters
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

get_header();
?>

<div class="jobportal-jobs-archive">

<!-- Page Header -->
<section class="jobs-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 60px 20px; text-align: center;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 42px; margin-bottom: 16px;">Browse All Jobs</h1>
        <p style="font-size: 18px; opacity: 0.9;">Find your next opportunity from thousands of jobs</p>
    </div>
</section>

<!-- Search & Filter -->
<section style="padding: 40px 20px; background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <form method="get" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <input type="text" name="s" placeholder="Search jobs..." value="<?php echo esc_attr(get_search_query()); ?>" style="flex: 1; min-width: 250px; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px;">
            <input type="text" name="location" placeholder="Location..." value="<?php echo esc_attr(isset($_GET['location']) ? $_GET['location'] : ''); ?>" style="flex: 1; min-width: 200px; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px;">
            <select name="job_type" style="padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px;">
                <option value="">All Types</option>
                <option value="full-time" <?php selected(isset($_GET['job_type']) ? $_GET['job_type'] : '', 'full-time'); ?>>Full-Time</option>
                <option value="part-time" <?php selected(isset($_GET['job_type']) ? $_GET['job_type'] : '', 'part-time'); ?>>Part-Time</option>
                <option value="remote" <?php selected(isset($_GET['job_type']) ? $_GET['job_type'] : '', 'remote'); ?>>Remote</option>
                <option value="contract" <?php selected(isset($_GET['job_type']) ? $_GET['job_type'] : '', 'contract'); ?>>Contract</option>
            </select>
            <button type="submit" style="padding: 12px 32px; background: #4facfe; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Search</button>
        </form>
    </div>
</section>

<!-- Job Listings -->
<section style="padding: 60px 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <?php
        // Sample jobs - In real theme, this would be WP_Query with custom post type 'job'
        $sample_jobs = array(
            array('title' => 'Senior Frontend Developer', 'company' => 'TechCorp', 'location' => 'San Francisco, CA', 'type' => 'Full-Time', 'salary' => '$120K - $160K', 'posted' => '2 days ago'),
            array('title' => 'Product Designer', 'company' => 'DesignHub', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$100K - $140K', 'posted' => '1 week ago'),
            array('title' => 'Marketing Manager', 'company' => 'GrowthCo', 'location' => 'New York, NY', 'type' => 'Full-Time', 'salary' => '$90K - $120K', 'posted' => '3 days ago'),
            array('title' => 'Data Scientist', 'company' => 'DataLabs', 'location' => 'Austin, TX', 'type' => 'Full-Time', 'salary' => '$130K - $170K', 'posted' => '5 days ago'),
            array('title' => 'DevOps Engineer', 'company' => 'CloudSys', 'location' => 'Seattle, WA', 'type' => 'Contract', 'salary' => '$140K - $180K', 'posted' => '1 day ago'),
            array('title' => 'Content Writer', 'company' => 'MediaCo', 'location' => 'Remote', 'type' => 'Part-Time', 'salary' => '$50K - $70K', 'posted' => '2 weeks ago'),
            array('title' => 'Full Stack Developer', 'company' => 'StartupXYZ', 'location' => 'Remote', 'type' => 'Full-Time', 'salary' => '$110K - $150K', 'posted' => '4 days ago'),
            array('title' => 'UX Researcher', 'company' => 'ResearchPro', 'location' => 'Boston, MA', 'type' => 'Full-Time', 'salary' => '$95K - $125K', 'posted' => '1 week ago'),
        );

        if (count($sample_jobs) > 0) :
        ?>
            <div class="jobs-count" style="margin-bottom: 24px; color: #64748b;">
                <strong><?php echo count($sample_jobs); ?></strong> jobs found
            </div>

            <div class="jobs-list" style="display: flex; flex-direction: column; gap: 20px;">
                <?php foreach ($sample_jobs as $job) : ?>
                    <div class="job-listing-card" style="background: white; padding: 32px; border-radius: 12px; border: 2px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s;">
                        <div class="job-info" style="flex: 1;">
                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 8px;">
                                <a href="<?php echo esc_url(home_url('/job/' . sanitize_title($job['title']))); ?>" style="color: #1e293b; text-decoration: none;">
                                    <?php echo esc_html($job['title']); ?>
                                </a>
                            </h3>
                            <div style="color: #64748b; margin-bottom: 12px; font-size: 16px;">
                                <?php echo esc_html($job['company']); ?>
                            </div>
                            <div style="display: flex; gap: 24px; flex-wrap: wrap; font-size: 14px; color: #64748b;">
                                <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('map-pin', 16); ?> <?php echo esc_html($job['location']); ?></span>
                                <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('briefcase', 16); ?> <?php echo esc_html($job['type']); ?></span>
                                <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('dollar-sign', 16); ?> <?php echo esc_html($job['salary']); ?></span>
                                <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('clock', 16); ?> <?php echo esc_html($job['posted']); ?></span>
                            </div>
                        </div>
                        <div class="job-actions" style="display: flex; gap: 12px;">
                            <button style="width: 44px; height: 44px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer; font-size: 18px;">♡</button>
                            <a href="<?php echo esc_url(home_url('/job/' . sanitize_title($job['title']))); ?>" style="padding: 12px 32px; background: #4facfe; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; white-space: nowrap;">Apply Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="jobs-pagination" style="margin-top: 40px; text-align: center;">
                <div style="display: inline-flex; gap: 8px;">
                    <button style="padding: 10px 16px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer;">← Previous</button>
                    <button style="padding: 10px 16px; background: #4facfe; color: white; border: none; border-radius: 6px; font-weight: 600;">1</button>
                    <button style="padding: 10px 16px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer;">2</button>
                    <button style="padding: 10px 16px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer;">3</button>
                    <button style="padding: 10px 16px; background: white; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer;">Next →</button>
                </div>
            </div>

        <?php else : ?>
            <div style="text-align: center; padding: 60px 20px;">
                <h2 style="font-size: 24px; margin-bottom: 12px;">No jobs found</h2>
                <p style="color: #64748b;">Try adjusting your search criteria</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA -->
<section style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; text-align: center; padding: 60px 20px;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 32px; margin-bottom: 16px;">Don't see what you're looking for?</h2>
        <p style="font-size: 18px; margin-bottom: 24px; opacity: 0.9;">Set up job alerts and we'll notify you when matching positions are posted</p>
        <a href="#" style="padding: 14px 32px; background: white; color: #4facfe; text-decoration: none; border-radius: 8px; font-weight: 600; display: inline-block;">Create Job Alert</a>
    </div>
</section>

</div>

<?php get_footer(); ?>
