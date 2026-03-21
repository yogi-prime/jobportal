<?php
/**
 * Template Name: Interview Scheduler
 *
 * Page template for Interview Scheduler
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
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 16px;">Schedule Your Interview</h1>
            <p style="font-size: 18px; color: #64748b;">Pick a time that works for you from our available slots</p>
        </div>

        <!-- Interview Scheduler Shortcode -->
        <div class="interview-scheduler-container">
            <?php echo do_shortcode('[jobportal_interview_scheduler]'); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
