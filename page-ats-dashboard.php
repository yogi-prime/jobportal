<?php
/**
 * Template Name: ATS Dashboard
 *
 * Page template for Applicant Tracking System Dashboard
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

get_header();
?>

<div class="jobportal-page-content">
    <div class="container" style="max-width: 1400px; margin: 40px auto; padding: 0 20px;">

        <!-- Page Header -->
        <div class="page-header" style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 16px;">Employer Dashboard</h1>
            <p style="font-size: 18px; color: #64748b;">Manage all your job applications in one place</p>
        </div>

        <!-- ATS Dashboard Shortcode -->
        <div class="ats-dashboard-container">
            <?php echo do_shortcode('[jobportal_ats_dashboard]'); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
