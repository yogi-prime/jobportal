<?php
/**
 * Template Name: Job Matcher
 *
 * Page template for Job Matching Algorithm
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

get_header();
?>

<div class="jobportal-page-content">
    <div class="container" style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">

        <!-- Page Header -->
        <div class="page-header" style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 16px;">Find Your Perfect Job Match</h1>
            <p style="font-size: 18px; color: #64748b;">Answer 4 quick questions and get personalized job recommendations</p>
        </div>

        <!-- Job Matcher Shortcode -->
        <div class="job-matcher-container">
            <?php echo do_shortcode('[jobportal_job_matcher]'); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
