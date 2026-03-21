<?php
/**
 * Template Name: Resume Builder
 *
 * Page template for Resume Builder feature
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
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 16px;">Resume Builder</h1>
            <p style="font-size: 18px; color: #64748b;">Create a professional resume in minutes with our drag-and-drop builder</p>
        </div>

        <!-- Resume Builder Shortcode -->
        <div class="resume-builder-container">
            <?php echo do_shortcode('[jobportal_resume_builder]'); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
