<?php
/**
 * JobPortal Theme Customizer
 *
 * @package JobPortal
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Customizer settings
 */
function jobportal_customize_register($wp_customize) {

    // =====================================================
    // GENERAL SETTINGS PANEL
    // =====================================================
    $wp_customize->add_panel('jobportal_general_panel', array(
        'title'       => __('General Settings', 'jobportal'),
        'description' => __('Configure general theme settings.', 'jobportal'),
        'priority'    => 10,
    ));

    // Site Identity Section Enhancement
    $wp_customize->add_setting('jobportal_logo_height', array(
        'default'           => 50,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('jobportal_logo_height', array(
        'type'        => 'number',
        'section'     => 'title_tagline',
        'label'       => __('Logo Height (px)', 'jobportal'),
        'input_attrs' => array(
            'min'  => 20,
            'max'  => 200,
            'step' => 1,
        ),
    ));

    // Preloader Settings Section
    $wp_customize->add_section('jobportal_preloader_section', array(
        'title'    => __('Preloader', 'jobportal'),
        'panel'    => 'jobportal_general_panel',
        'priority' => 10,
    ));

    $wp_customize->add_setting('jobportal_enable_preloader', array(
        'default'           => true,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_enable_preloader', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_preloader_section',
        'label'   => __('Enable Page Preloader', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_preloader_style', array(
        'default'           => 'spinner',
        'sanitize_callback' => 'jobportal_sanitize_select',
    ));

    $wp_customize->add_control('jobportal_preloader_style', array(
        'type'    => 'select',
        'section' => 'jobportal_preloader_section',
        'label'   => __('Preloader Style', 'jobportal'),
        'choices' => array(
            'spinner'  => __('Spinner', 'jobportal'),
            'dots'     => __('Bouncing Dots', 'jobportal'),
            'progress' => __('Progress Bar', 'jobportal'),
            'logo'     => __('Logo Fade', 'jobportal'),
        ),
    ));

    // =====================================================
    // HEADER PANEL
    // =====================================================
    $wp_customize->add_panel('jobportal_header_panel', array(
        'title'       => __('Header Settings', 'jobportal'),
        'description' => __('Configure header appearance and behavior.', 'jobportal'),
        'priority'    => 20,
    ));

    // Header Layout Section
    $wp_customize->add_section('jobportal_header_layout', array(
        'title'    => __('Header Layout', 'jobportal'),
        'panel'    => 'jobportal_header_panel',
        'priority' => 10,
    ));

    $wp_customize->add_setting('jobportal_header_style', array(
        'default'           => 'default',
        'sanitize_callback' => 'jobportal_sanitize_select',
    ));

    $wp_customize->add_control('jobportal_header_style', array(
        'type'    => 'select',
        'section' => 'jobportal_header_layout',
        'label'   => __('Header Style', 'jobportal'),
        'choices' => array(
            'default'     => __('Default', 'jobportal'),
            'centered'    => __('Centered Logo', 'jobportal'),
            'minimal'     => __('Minimal', 'jobportal'),
            'fullwidth'   => __('Full Width', 'jobportal'),
        ),
    ));

    $wp_customize->add_setting('jobportal_sticky_header', array(
        'default'           => true,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_sticky_header', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_header_layout',
        'label'   => __('Enable Sticky Header', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_transparent_header', array(
        'default'           => false,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_transparent_header', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_header_layout',
        'label'   => __('Transparent Header (Home only)', 'jobportal'),
    ));

    // Header Colors Section
    $wp_customize->add_section('jobportal_header_colors', array(
        'title'    => __('Header Colors', 'jobportal'),
        'panel'    => 'jobportal_header_panel',
        'priority' => 20,
    ));

    $wp_customize->add_setting('jobportal_header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_header_bg_color', array(
        'label'   => __('Header Background Color', 'jobportal'),
        'section' => 'jobportal_header_colors',
    )));

    $wp_customize->add_setting('jobportal_header_text_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_header_text_color', array(
        'label'   => __('Header Text Color', 'jobportal'),
        'section' => 'jobportal_header_colors',
    )));

    // Header CTA Button Section
    $wp_customize->add_section('jobportal_header_cta', array(
        'title'    => __('Header CTA Button', 'jobportal'),
        'panel'    => 'jobportal_header_panel',
        'priority' => 30,
    ));

    $wp_customize->add_setting('jobportal_header_cta_text', array(
        'default'           => __('Get Started', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_header_cta_text', array(
        'type'    => 'text',
        'section' => 'jobportal_header_cta',
        'label'   => __('CTA Button Text', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_header_cta_url', array(
        'default'           => '#pricing',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('jobportal_header_cta_url', array(
        'type'    => 'url',
        'section' => 'jobportal_header_cta',
        'label'   => __('CTA Button URL', 'jobportal'),
    ));

    // =====================================================
    // COLORS PANEL
    // =====================================================
    $wp_customize->add_panel('jobportal_colors_panel', array(
        'title'       => __('Theme Colors', 'jobportal'),
        'description' => __('Customize your theme colors.', 'jobportal'),
        'priority'    => 30,
    ));

    // Primary Colors Section
    $wp_customize->add_section('jobportal_primary_colors', array(
        'title'    => __('Primary Colors', 'jobportal'),
        'panel'    => 'jobportal_colors_panel',
        'priority' => 10,
    ));

    $wp_customize->add_setting('jobportal_primary_color', array(
        'default'           => '#00B4D8', // Cyan - Career Hub brand color
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_primary_color', array(
        'label'   => __('Primary Color (Cyan)', 'jobportal'),
        'section' => 'jobportal_primary_colors',
    )));

    $wp_customize->add_setting('jobportal_secondary_color', array(
        'default'           => '#00C896', // Teal Green - Career Hub accent
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_secondary_color', array(
        'label'   => __('Secondary Color (Teal)', 'jobportal'),
        'section' => 'jobportal_primary_colors',
    )));

    $wp_customize->add_setting('jobportal_accent_color', array(
        'default'           => '#1B3A5F', // Navy Blue - Career Hub dark
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_accent_color', array(
        'label'   => __('Accent Color (Navy)', 'jobportal'),
        'section' => 'jobportal_primary_colors',
    )));

    // Text Colors Section
    $wp_customize->add_section('jobportal_text_colors', array(
        'title'    => __('Text Colors', 'jobportal'),
        'panel'    => 'jobportal_colors_panel',
        'priority' => 20,
    ));

    $wp_customize->add_setting('jobportal_heading_color', array(
        'default'           => '#1B3A5F', // Navy Blue for headings
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_heading_color', array(
        'label'   => __('Heading Color', 'jobportal'),
        'section' => 'jobportal_text_colors',
    )));

    $wp_customize->add_setting('jobportal_body_color', array(
        'default'           => '#475569',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_body_color', array(
        'label'   => __('Body Text Color', 'jobportal'),
        'section' => 'jobportal_text_colors',
    )));

    // =====================================================
    // HERO SECTION PANEL
    // =====================================================
    $wp_customize->add_panel('jobportal_hero_panel', array(
        'title'       => __('Hero Section', 'jobportal'),
        'description' => __('Configure the hero section.', 'jobportal'),
        'priority'    => 40,
    ));

    // Hero Content Section
    $wp_customize->add_section('jobportal_hero_content', array(
        'title'    => __('Hero Content', 'jobportal'),
        'panel'    => 'jobportal_hero_panel',
        'priority' => 10,
    ));

    $wp_customize->add_setting('jobportal_hero_badge', array(
        'default'           => __('New Features Available', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_hero_badge', array(
        'type'    => 'text',
        'section' => 'jobportal_hero_content',
        'label'   => __('Badge Text', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_hero_title', array(
        'default'           => __('Build Something Amazing With Our Platform', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_hero_title', array(
        'type'    => 'text',
        'section' => 'jobportal_hero_content',
        'label'   => __('Hero Title', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_hero_subtitle', array(
        'default'           => __('The all-in-one platform that helps startups and businesses scale faster with powerful tools.', 'jobportal'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('jobportal_hero_subtitle', array(
        'type'    => 'textarea',
        'section' => 'jobportal_hero_content',
        'label'   => __('Hero Subtitle', 'jobportal'),
    ));

    // Hero Buttons Section
    $wp_customize->add_section('jobportal_hero_buttons', array(
        'title'    => __('Hero Buttons', 'jobportal'),
        'panel'    => 'jobportal_hero_panel',
        'priority' => 20,
    ));

    $wp_customize->add_setting('jobportal_hero_btn_primary_text', array(
        'default'           => __('Start Free Trial', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_hero_btn_primary_text', array(
        'type'    => 'text',
        'section' => 'jobportal_hero_buttons',
        'label'   => __('Primary Button Text', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_hero_btn_primary_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('jobportal_hero_btn_primary_url', array(
        'type'    => 'url',
        'section' => 'jobportal_hero_buttons',
        'label'   => __('Primary Button URL', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_hero_btn_secondary_text', array(
        'default'           => __('Watch Demo', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_hero_btn_secondary_text', array(
        'type'    => 'text',
        'section' => 'jobportal_hero_buttons',
        'label'   => __('Secondary Button Text', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_hero_btn_secondary_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('jobportal_hero_btn_secondary_url', array(
        'type'    => 'url',
        'section' => 'jobportal_hero_buttons',
        'label'   => __('Secondary Button URL', 'jobportal'),
    ));

    // Hero Image Section
    $wp_customize->add_section('jobportal_hero_image', array(
        'title'    => __('Hero Image', 'jobportal'),
        'panel'    => 'jobportal_hero_panel',
        'priority' => 30,
    ));

    $wp_customize->add_setting('jobportal_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jobportal_hero_image', array(
        'label'   => __('Hero Image', 'jobportal'),
        'section' => 'jobportal_hero_image',
    )));

    // =====================================================
    // FEATURES SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_features_section', array(
        'title'       => __('Features Section', 'jobportal'),
        'priority'    => 50,
    ));

    $wp_customize->add_setting('jobportal_features_enable', array(
        'default'           => true,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_features_enable', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_features_section',
        'label'   => __('Enable Features Section', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_features_title', array(
        'default'           => __('Powerful Features', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_features_title', array(
        'type'    => 'text',
        'section' => 'jobportal_features_section',
        'label'   => __('Section Title', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_features_subtitle', array(
        'default'           => __('Everything you need to grow your business', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_features_subtitle', array(
        'type'    => 'text',
        'section' => 'jobportal_features_section',
        'label'   => __('Section Subtitle', 'jobportal'),
    ));

    // =====================================================
    // PRICING SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_pricing_section', array(
        'title'    => __('Pricing Section', 'jobportal'),
        'priority' => 60,
    ));

    $wp_customize->add_setting('jobportal_pricing_enable', array(
        'default'           => true,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_pricing_enable', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_pricing_section',
        'label'   => __('Enable Pricing Section', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_pricing_title', array(
        'default'           => __('Simple, Transparent Pricing', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_pricing_title', array(
        'type'    => 'text',
        'section' => 'jobportal_pricing_section',
        'label'   => __('Section Title', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_pricing_subtitle', array(
        'default'           => __('Choose the perfect plan for your needs', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_pricing_subtitle', array(
        'type'    => 'text',
        'section' => 'jobportal_pricing_section',
        'label'   => __('Section Subtitle', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_pricing_currency', array(
        'default'           => '$',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_pricing_currency', array(
        'type'    => 'text',
        'section' => 'jobportal_pricing_section',
        'label'   => __('Currency Symbol', 'jobportal'),
    ));

    // =====================================================
    // TESTIMONIALS SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_testimonials_section', array(
        'title'    => __('Testimonials Section', 'jobportal'),
        'priority' => 70,
    ));

    $wp_customize->add_setting('jobportal_testimonials_enable', array(
        'default'           => true,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_testimonials_enable', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_testimonials_section',
        'label'   => __('Enable Testimonials Section', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_testimonials_title', array(
        'default'           => __('What Our Customers Say', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_testimonials_title', array(
        'type'    => 'text',
        'section' => 'jobportal_testimonials_section',
        'label'   => __('Section Title', 'jobportal'),
    ));

    // =====================================================
    // CTA SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_cta_section', array(
        'title'    => __('CTA Section', 'jobportal'),
        'priority' => 80,
    ));

    $wp_customize->add_setting('jobportal_cta_enable', array(
        'default'           => true,
        'sanitize_callback' => 'jobportal_sanitize_checkbox',
    ));

    $wp_customize->add_control('jobportal_cta_enable', array(
        'type'    => 'checkbox',
        'section' => 'jobportal_cta_section',
        'label'   => __('Enable CTA Section', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_cta_title', array(
        'default'           => __('Ready to Get Started?', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_cta_title', array(
        'type'    => 'text',
        'section' => 'jobportal_cta_section',
        'label'   => __('CTA Title', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_cta_text', array(
        'default'           => __('Join thousands of satisfied customers today.', 'jobportal'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('jobportal_cta_text', array(
        'type'    => 'textarea',
        'section' => 'jobportal_cta_section',
        'label'   => __('CTA Description', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_cta_button_text', array(
        'default'           => __('Start Your Free Trial', 'jobportal'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_cta_button_text', array(
        'type'    => 'text',
        'section' => 'jobportal_cta_section',
        'label'   => __('Button Text', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_cta_button_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('jobportal_cta_button_url', array(
        'type'    => 'url',
        'section' => 'jobportal_cta_section',
        'label'   => __('Button URL', 'jobportal'),
    ));

    // =====================================================
    // FOOTER PANEL
    // =====================================================
    $wp_customize->add_panel('jobportal_footer_panel', array(
        'title'       => __('Footer Settings', 'jobportal'),
        'priority'    => 90,
    ));

    // Footer Layout Section
    $wp_customize->add_section('jobportal_footer_layout', array(
        'title'    => __('Footer Layout', 'jobportal'),
        'panel'    => 'jobportal_footer_panel',
        'priority' => 10,
    ));

    $wp_customize->add_setting('jobportal_footer_style', array(
        'default'           => 'default',
        'sanitize_callback' => 'jobportal_sanitize_select',
    ));

    $wp_customize->add_control('jobportal_footer_style', array(
        'type'    => 'select',
        'section' => 'jobportal_footer_layout',
        'label'   => __('Footer Style', 'jobportal'),
        'choices' => array(
            'default'  => __('Default (4 Columns)', 'jobportal'),
            'centered' => __('Centered', 'jobportal'),
            'minimal'  => __('Minimal', 'jobportal'),
        ),
    ));

    $wp_customize->add_setting('jobportal_footer_bg_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_footer_bg_color', array(
        'label'   => __('Footer Background Color', 'jobportal'),
        'section' => 'jobportal_footer_layout',
    )));

    $wp_customize->add_setting('jobportal_footer_text_color', array(
        'default'           => '#94a3b8',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'jobportal_footer_text_color', array(
        'label'   => __('Footer Text Color', 'jobportal'),
        'section' => 'jobportal_footer_layout',
    )));

    // Footer Copyright Section
    $wp_customize->add_section('jobportal_footer_copyright', array(
        'title'    => __('Copyright', 'jobportal'),
        'panel'    => 'jobportal_footer_panel',
        'priority' => 20,
    ));

    $wp_customize->add_setting('jobportal_copyright_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('jobportal_copyright_text', array(
        'type'    => 'textarea',
        'section' => 'jobportal_footer_copyright',
        'label'   => __('Copyright Text', 'jobportal'),
    ));

    // =====================================================
    // SOCIAL MEDIA SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_social_section', array(
        'title'    => __('Social Media', 'jobportal'),
        'priority' => 100,
    ));

    $social_networks = array(
        'facebook'  => __('Facebook URL', 'jobportal'),
        'twitter'   => __('Twitter/X URL', 'jobportal'),
        'instagram' => __('Instagram URL', 'jobportal'),
        'linkedin'  => __('LinkedIn URL', 'jobportal'),
        'youtube'   => __('YouTube URL', 'jobportal'),
        'github'    => __('GitHub URL', 'jobportal'),
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('jobportal_social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('jobportal_social_' . $network, array(
            'type'    => 'url',
            'section' => 'jobportal_social_section',
            'label'   => $label,
        ));
    }

    // =====================================================
    // TYPOGRAPHY SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_typography_section', array(
        'title'    => __('Typography', 'jobportal'),
        'priority' => 110,
    ));

    $wp_customize->add_setting('jobportal_heading_font', array(
        'default'           => 'Plus Jakarta Sans',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_heading_font', array(
        'type'    => 'select',
        'section' => 'jobportal_typography_section',
        'label'   => __('Heading Font', 'jobportal'),
        'choices' => array(
            'Plus Jakarta Sans' => 'Plus Jakarta Sans',
            'Inter'             => 'Inter',
            'Poppins'           => 'Poppins',
            'Roboto'            => 'Roboto',
            'Montserrat'        => 'Montserrat',
        ),
    ));

    $wp_customize->add_setting('jobportal_body_font', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_body_font', array(
        'type'    => 'select',
        'section' => 'jobportal_typography_section',
        'label'   => __('Body Font', 'jobportal'),
        'choices' => array(
            'Inter'     => 'Inter',
            'Roboto'    => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato'      => 'Lato',
            'Nunito'    => 'Nunito',
        ),
    ));

    // =====================================================
    // BLOG SETTINGS SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_blog_section', array(
        'title'    => __('Blog Settings', 'jobportal'),
        'priority' => 120,
    ));

    $wp_customize->add_setting('jobportal_blog_layout', array(
        'default'           => 'grid',
        'sanitize_callback' => 'jobportal_sanitize_select',
    ));

    $wp_customize->add_control('jobportal_blog_layout', array(
        'type'    => 'select',
        'section' => 'jobportal_blog_section',
        'label'   => __('Blog Layout', 'jobportal'),
        'choices' => array(
            'grid'    => __('Grid', 'jobportal'),
            'list'    => __('List', 'jobportal'),
            'masonry' => __('Masonry', 'jobportal'),
        ),
    ));

    $wp_customize->add_setting('jobportal_blog_sidebar', array(
        'default'           => 'right',
        'sanitize_callback' => 'jobportal_sanitize_select',
    ));

    $wp_customize->add_control('jobportal_blog_sidebar', array(
        'type'    => 'select',
        'section' => 'jobportal_blog_section',
        'label'   => __('Sidebar Position', 'jobportal'),
        'choices' => array(
            'none'  => __('No Sidebar', 'jobportal'),
            'left'  => __('Left Sidebar', 'jobportal'),
            'right' => __('Right Sidebar', 'jobportal'),
        ),
    ));

    // =====================================================
    // CONTACT INFO SECTION
    // =====================================================
    $wp_customize->add_section('jobportal_contact_section', array(
        'title'    => __('Contact Information', 'jobportal'),
        'priority' => 130,
    ));

    $wp_customize->add_setting('jobportal_contact_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('jobportal_contact_email', array(
        'type'    => 'email',
        'section' => 'jobportal_contact_section',
        'label'   => __('Email Address', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_contact_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobportal_contact_phone', array(
        'type'    => 'text',
        'section' => 'jobportal_contact_section',
        'label'   => __('Phone Number', 'jobportal'),
    ));

    $wp_customize->add_setting('jobportal_contact_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('jobportal_contact_address', array(
        'type'    => 'textarea',
        'section' => 'jobportal_contact_section',
        'label'   => __('Address', 'jobportal'),
    ));
}
add_action('customize_register', 'jobportal_customize_register');

/**
 * Sanitize checkbox
 */
function jobportal_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Sanitize select
 */
function jobportal_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Output Customizer CSS
 */
function jobportal_customizer_css() {
    $primary_color   = get_theme_mod('jobportal_primary_color', '#00B4D8');
    $secondary_color = get_theme_mod('jobportal_secondary_color', '#00C896');
    $accent_color    = get_theme_mod('jobportal_accent_color', '#00C896');
    $heading_color   = get_theme_mod('jobportal_heading_color', '#0f172a');
    $body_color      = get_theme_mod('jobportal_body_color', '#475569');
    $header_bg       = get_theme_mod('jobportal_header_bg_color', '#ffffff');
    $header_text     = get_theme_mod('jobportal_header_text_color', '#0f172a');
    $footer_bg       = get_theme_mod('jobportal_footer_bg_color', '#0f172a');
    $footer_text     = get_theme_mod('jobportal_footer_text_color', '#94a3b8');
    $logo_height     = get_theme_mod('jobportal_logo_height', 50);

    $css = "
    :root {
        --jobportal-primary: {$primary_color};
        --jobportal-secondary: {$secondary_color};
        --jobportal-accent: {$accent_color};
        --jobportal-heading: {$heading_color};
        --jobportal-body: {$body_color};
        --jobportal-header-bg: {$header_bg};
        --jobportal-header-text: {$header_text};
        --jobportal-footer-bg: {$footer_bg};
        --jobportal-footer-text: {$footer_text};
        --jobportal-logo-height: {$logo_height}px;
    }
    ";

    wp_add_inline_style('jobportal-style', $css);
}
add_action('wp_enqueue_scripts', 'jobportal_customizer_css', 20);
