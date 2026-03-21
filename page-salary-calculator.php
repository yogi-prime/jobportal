<?php
/**
 * Template Name: Salary Calculator
 *
 * Page template for Salary Calculator
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
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 16px;">Salary Calculator</h1>
            <p style="font-size: 18px; color: #64748b;">Calculate your market value based on role, experience, location, and skills</p>
        </div>

        <!-- Salary Calculator Shortcode -->
        <div class="salary-calculator-container">
            <?php echo do_shortcode('[jobportal_salary_calculator]'); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
