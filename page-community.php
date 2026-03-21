<?php
/**
 * Template Name: Community Feed
 *
 * Social feed page - LinkedIn-style networking
 *
 * @package JobPortal
 */

get_header();
?>

<div class="community-page-header">
    <div class="container">
        <h1>🌐 Community Feed</h1>
        <p>Connect with professionals, share insights, and grow your network</p>
    </div>
</div>

<style>
    .community-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 20px;
        text-align: center;
        margin-bottom: 40px;
    }

    .community-page-header h1 {
        font-size: 48px;
        font-weight: 800;
        margin: 0 0 12px;
    }

    .community-page-header p {
        font-size: 20px;
        margin: 0;
        opacity: 0.95;
    }

    .community-page-header .container {
        max-width: 800px;
        margin: 0 auto;
    }
</style>

<?php
// Display social feed
echo do_shortcode('[jobportal_social_feed]');

get_footer();
