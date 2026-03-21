<?php
/**
 * JobPortal Theme Functions
 *
 * @package JobPortal
 * @version 1.0.0
 * @author ThemeJobPortal
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Constants
 */
define('JOBPORTAL_VERSION', '2.0.0');
define('JOBPORTAL_DIR', get_template_directory());
define('JOBPORTAL_URI', get_template_directory_uri());
define('JOBPORTAL_ASSETS', JOBPORTAL_URI . '/assets');

/**
 * Theme Setup
 */
function jobportal_setup() {
    // Make theme available for translation
    load_theme_textdomain('jobportal', JOBPORTAL_DIR . '/languages');

    // Add default posts and comments RSS feed links
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom image sizes
    add_image_size('jobportal-hero', 1400, 900, true);
    add_image_size('jobportal-card', 600, 400, true);
    add_image_size('jobportal-thumbnail', 400, 300, true);
    add_image_size('jobportal-avatar', 100, 100, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'jobportal'),
        'footer'    => esc_html__('Footer Menu', 'jobportal'),
        'mobile'    => esc_html__('Mobile Menu', 'jobportal'),
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Custom background support
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Block editor support
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // Editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary', 'jobportal'),
            'slug'  => 'primary',
            'color' => '#00B4D8',
        ),
        array(
            'name'  => esc_html__('Secondary', 'jobportal'),
            'slug'  => 'secondary',
            'color' => '#00C896',
        ),
        array(
            'name'  => esc_html__('Accent', 'jobportal'),
            'slug'  => 'accent',
            'color' => '#00C896',
        ),
        array(
            'name'  => esc_html__('Dark', 'jobportal'),
            'slug'  => 'dark',
            'color' => '#0f172a',
        ),
        array(
            'name'  => esc_html__('Light', 'jobportal'),
            'slug'  => 'light',
            'color' => '#f8fafc',
        ),
    ));

    // Editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'jobportal'),
            'slug' => 'small',
            'size' => 14,
        ),
        array(
            'name' => esc_html__('Normal', 'jobportal'),
            'slug' => 'normal',
            'size' => 16,
        ),
        array(
            'name' => esc_html__('Large', 'jobportal'),
            'slug' => 'large',
            'size' => 20,
        ),
        array(
            'name' => esc_html__('Extra Large', 'jobportal'),
            'slug' => 'extra-large',
            'size' => 24,
        ),
    ));

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'jobportal_setup');

/**
 * Set content width
 */
function jobportal_content_width() {
    $GLOBALS['content_width'] = apply_filters('jobportal_content_width', 1200);
}
add_action('after_setup_theme', 'jobportal_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function jobportal_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'jobportal-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'jobportal-style',
        get_stylesheet_uri(),
        array(),
        JOBPORTAL_VERSION
    );

    // Additional CSS
    wp_enqueue_style(
        'jobportal-main',
        JOBPORTAL_ASSETS . '/css/main.css',
        array('jobportal-style'),
        JOBPORTAL_VERSION
    );

    // JobPortal Blog Styling
    wp_enqueue_style(
        'jobportal-blog',
        JOBPORTAL_ASSETS . '/css/blog-jobportal.css',
        array('jobportal-main'),
        JOBPORTAL_VERSION
    );

    // Premium Animations CSS
    wp_enqueue_style(
        'jobportal-animations',
        JOBPORTAL_ASSETS . '/css/animations.css',
        array('jobportal-main'),
        JOBPORTAL_VERSION
    );

    // Custom Cursor & Premium Effects CSS
    wp_enqueue_style(
        'jobportal-custom-cursor',
        JOBPORTAL_ASSETS . '/css/custom-cursor.css',
        array('jobportal-main'),
        JOBPORTAL_VERSION
    );

    // Skills Assessment CSS
    wp_enqueue_style(
        'jobportal-skills-assessment',
        JOBPORTAL_ASSETS . '/css/skills-assessment.css',
        array('jobportal-main'),
        JOBPORTAL_VERSION
    );

    // Scroll Animations Script
    wp_enqueue_script(
        'jobportal-scroll-animations',
        JOBPORTAL_ASSETS . '/js/scroll-animations.js',
        array(),
        JOBPORTAL_VERSION,
        true
    );

    // Job Filters Script (requires jQuery)
    wp_enqueue_script(
        'jobportal-job-filters',
        JOBPORTAL_ASSETS . '/js/job-filters.js',
        array('jquery'),
        JOBPORTAL_VERSION,
        true
    );

    // Custom Cursor Script
    wp_enqueue_script(
        'jobportal-custom-cursor',
        JOBPORTAL_ASSETS . '/js/custom-cursor.js',
        array(),
        JOBPORTAL_VERSION,
        true
    );

    // Job Comparison Tool
    wp_enqueue_script(
        'jobportal-job-comparison',
        JOBPORTAL_ASSETS . '/js/job-comparison.js',
        array(),
        JOBPORTAL_VERSION,
        true
    );

    // Skills Assessment System
    wp_enqueue_script(
        'jobportal-skills-assessment',
        JOBPORTAL_ASSETS . '/js/skills-assessment.js',
        array('jquery'),
        JOBPORTAL_VERSION,
        true
    );

    // AOS Animation library
    wp_enqueue_style(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );

    wp_enqueue_script(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );

    // GSAP for advanced animations
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        array(),
        '3.12.2',
        true
    );

    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        array('gsap'),
        '3.12.2',
        true
    );

    // Main JavaScript
    wp_enqueue_script(
        'jobportal-main',
        JOBPORTAL_ASSETS . '/js/main.js',
        array('jquery', 'aos', 'gsap', 'gsap-scrolltrigger'),
        JOBPORTAL_VERSION,
        true
    );

    // Localize script
    wp_localize_script('jobportal-main', 'jobportalData', array(
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('jobportal_nonce'),
        'siteUrl'   => home_url('/'),
        'themeUrl'  => JOBPORTAL_URI,
        'i18n'      => array(
            'loading'    => esc_html__('Loading...', 'jobportal'),
            'success'    => esc_html__('Success!', 'jobportal'),
            'error'      => esc_html__('Something went wrong.', 'jobportal'),
            'sending'    => esc_html__('Sending...', 'jobportal'),
            'sent'       => esc_html__('Message sent!', 'jobportal'),
            'subscribe'  => esc_html__('Subscribing...', 'jobportal'),
            'subscribed' => esc_html__('Subscribed!', 'jobportal'),
        ),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'jobportal_scripts');

/**
 * Enqueue admin scripts
 */
function jobportal_admin_scripts($hook) {
    // Only on post edit screens
    if ('post.php' !== $hook && 'post-new.php' !== $hook) {
        return;
    }

    wp_enqueue_style(
        'jobportal-admin',
        JOBPORTAL_ASSETS . '/css/admin.css',
        array(),
        JOBPORTAL_VERSION
    );

    wp_enqueue_script(
        'jobportal-admin',
        JOBPORTAL_ASSETS . '/js/admin.js',
        array('jquery'),
        JOBPORTAL_VERSION,
        true
    );
}
add_action('admin_enqueue_scripts', 'jobportal_admin_scripts');

/**
 * Register widget areas
 */
function jobportal_widgets_init() {
    // Header Widget Area
    register_sidebar(array(
        'name'          => esc_html__('Header Widget', 'jobportal'),
        'id'            => 'header-widget',
        'description'   => esc_html__('Widgets in this area will appear in the header.', 'jobportal'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Main Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', 'jobportal'),
        'id'            => 'sidebar-main',
        'description'   => esc_html__('Main sidebar widget area.', 'jobportal'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Footer Widgets (4 columns)
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Widget %d', 'jobportal'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Footer widget area %d.', 'jobportal'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }

    // Before Footer CTA
    register_sidebar(array(
        'name'          => esc_html__('Before Footer CTA', 'jobportal'),
        'id'            => 'before-footer-cta',
        'description'   => esc_html__('Call to action area before footer.', 'jobportal'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'jobportal_widgets_init');

/**
 * Custom excerpt length
 */
function jobportal_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'jobportal_excerpt_length');

/**
 * Custom excerpt more
 */
function jobportal_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'jobportal_excerpt_more');

/**
 * Add custom body classes
 */
function jobportal_body_classes($classes) {
    // Add page slug
    if (is_singular()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class for sticky header
    if (get_theme_mod('jobportal_sticky_header', true)) {
        $classes[] = 'has-sticky-header';
    }

    // Add class for transparent header
    if (get_theme_mod('jobportal_transparent_header', false)) {
        $classes[] = 'has-transparent-header';
    }

    // Add loading animation class
    $classes[] = 'jobportal-loading';

    return $classes;
}
add_filter('body_class', 'jobportal_body_classes');

/**
 * Custom nav menu walker for mega menu
 */
class JobPortal_Mega_Menu_Walker extends Walker_Nav_Menu {

    private $current_item;
    private $dropdown_menu_alignment_values = array(
        'dropdown-menu-start',
        'dropdown-menu-end',
        'dropdown-menu-center',
    );

    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        $classes = array('jobportal-submenu');
        if ($depth === 0) {
            $classes[] = 'jobportal-submenu-level-1';
        }

        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $this->current_item = $item;

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check if has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'jobportal-has-submenu';
        }

        // Check for mega menu
        $is_mega = get_post_meta($item->ID, '_jobportal_mega_menu', true);
        if ($is_mega && $depth === 0) {
            $classes[] = 'jobportal-mega-menu';
        }

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id_attr = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';

        $output .= $indent . '<li' . $id_attr . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        // Add class to link
        $atts['class'] = 'jobportal-menu-link';
        if ($depth === 0) {
            $atts['class'] .= ' jobportal-menu-link-top';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ($args->link_before ?? '') . $title . ($args->link_after ?? '');

        // Add dropdown arrow for items with children
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<svg class="jobportal-menu-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6,9 12,15 18,9"></polyline></svg>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * AJAX Contact Form Handler
 */
function jobportal_contact_form_handler() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'jobportal_nonce')) {
        wp_send_json_error(array('message' => __('Security check failed.', 'jobportal')));
    }

    // Sanitize inputs
    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field(wp_unslash($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    // Validate
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'jobportal')));
    }

    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'jobportal')));
    }

    // Get admin email
    $admin_email = get_theme_mod('jobportal_contact_email', get_option('admin_email'));

    // Email headers
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    );

    // Email content
    $email_subject = !empty($subject) ? $subject : sprintf(__('New Contact Form Message from %s', 'jobportal'), $name);

    $email_body = '<html><body>';
    $email_body .= '<h2>' . esc_html__('New Contact Form Submission', 'jobportal') . '</h2>';
    $email_body .= '<p><strong>' . esc_html__('Name:', 'jobportal') . '</strong> ' . esc_html($name) . '</p>';
    $email_body .= '<p><strong>' . esc_html__('Email:', 'jobportal') . '</strong> ' . esc_html($email) . '</p>';
    if (!empty($subject)) {
        $email_body .= '<p><strong>' . esc_html__('Subject:', 'jobportal') . '</strong> ' . esc_html($subject) . '</p>';
    }
    $email_body .= '<p><strong>' . esc_html__('Message:', 'jobportal') . '</strong></p>';
    $email_body .= '<p>' . nl2br(esc_html($message)) . '</p>';
    $email_body .= '</body></html>';

    // Send email
    $sent = wp_mail($admin_email, $email_subject, $email_body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => __('Your message has been sent successfully!', 'jobportal')));
    } else {
        wp_send_json_error(array('message' => __('Failed to send message. Please try again.', 'jobportal')));
    }
}
add_action('wp_ajax_jobportal_contact_form', 'jobportal_contact_form_handler');
add_action('wp_ajax_nopriv_jobportal_contact_form', 'jobportal_contact_form_handler');

/**
 * AJAX Newsletter Subscription Handler
 */
function jobportal_newsletter_handler() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'jobportal_nonce')) {
        wp_send_json_error(array('message' => __('Security check failed.', 'jobportal')));
    }

    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => __('Please enter a valid email address.', 'jobportal')));
    }

    // Store subscriber in options (basic implementation)
    $subscribers = get_option('jobportal_subscribers', array());

    if (in_array($email, $subscribers)) {
        wp_send_json_error(array('message' => __('This email is already subscribed.', 'jobportal')));
    }

    $subscribers[] = $email;
    update_option('jobportal_subscribers', $subscribers);

    // Send confirmation email
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $subject = get_bloginfo('name') . ' - ' . __('Newsletter Subscription Confirmed', 'jobportal');

    $body = '<html><body>';
    $body .= '<h2>' . esc_html__('Welcome!', 'jobportal') . '</h2>';
    $body .= '<p>' . esc_html__('Thank you for subscribing to our newsletter.', 'jobportal') . '</p>';
    $body .= '<p>' . esc_html__('You will receive updates about our latest news and offers.', 'jobportal') . '</p>';
    $body .= '</body></html>';

    wp_mail($email, $subject, $body, $headers);

    wp_send_json_success(array('message' => __('Thank you for subscribing!', 'jobportal')));
}
add_action('wp_ajax_jobportal_newsletter', 'jobportal_newsletter_handler');
add_action('wp_ajax_nopriv_jobportal_newsletter', 'jobportal_newsletter_handler');

/**
 * One-Click Demo Import support
 */
function jobportal_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => 'Main Demo',
            'categories'                 => array('SaaS', 'Business'),
            'import_file_url'            => JOBPORTAL_URI . '/demo/content.xml',
            'import_widget_file_url'     => JOBPORTAL_URI . '/demo/widgets.wie',
            'import_customizer_file_url' => JOBPORTAL_URI . '/demo/customizer.dat',
            'import_preview_image_url'   => JOBPORTAL_URI . '/screenshot.png',
            'preview_url'                => 'https://jobportaltheme.developer/preview/',
        ),
    );
}
add_filter('ocdi/import_files', 'jobportal_ocdi_import_files');

/**
 * After demo import setup
 */
function jobportal_ocdi_after_import_setup() {
    // Set front page
    $front_page = get_page_by_title('Home');
    $blog_page = get_page_by_title('Blog');

    if ($front_page) {
        update_option('page_on_front', $front_page->ID);
        update_option('show_on_front', 'page');
    }

    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }

    // Set primary menu
    $primary_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
    if ($primary_menu) {
        set_theme_mod('nav_menu_locations', array(
            'primary' => $primary_menu->term_id,
        ));
    }
}
add_action('ocdi/after_import', 'jobportal_ocdi_after_import_setup');

/**
 * Include additional files
 */
require_once JOBPORTAL_DIR . '/inc/customizer.php';
require_once JOBPORTAL_DIR . '/inc/custom-post-types.php';
require_once JOBPORTAL_DIR . '/inc/job-applications.php';
require_once JOBPORTAL_DIR . '/inc/ajax-filters.php';
require_once JOBPORTAL_DIR . '/inc/premium-listings.php';
require_once JOBPORTAL_DIR . '/inc/skills-assessment.php';
require_once JOBPORTAL_DIR . '/inc/company-profiles.php';
require_once JOBPORTAL_DIR . '/inc/video-resume.php';
require_once JOBPORTAL_DIR . '/inc/social-login.php';
require_once JOBPORTAL_DIR . '/inc/referral-rewards.php';
require_once JOBPORTAL_DIR . '/inc/analytics-dashboard.php';
require_once JOBPORTAL_DIR . '/inc/admin-frontend-panel.php';
require_once JOBPORTAL_DIR . '/inc/login-modal.php';
require_once JOBPORTAL_DIR . '/inc/ai-chat-widget.php';
require_once JOBPORTAL_DIR . '/inc/login-gates.php';
require_once JOBPORTAL_DIR . '/inc/resume-system.php';
require_once JOBPORTAL_DIR . '/inc/profile-builder.php';
require_once JOBPORTAL_DIR . '/inc/social-feed.php';
require_once JOBPORTAL_DIR . '/inc/seo-dashboard.php';
require_once JOBPORTAL_DIR . '/inc/icons.php';

// Elite Admin Panel
if (file_exists(JOBPORTAL_DIR . '/inc/admin-panel.php')) {
    require_once JOBPORTAL_DIR . '/inc/admin-panel.php';
}

// Elementor Widget Framework
if (file_exists(JOBPORTAL_DIR . '/inc/elementor-widgets.php') && did_action('elementor/loaded')) {
    require_once JOBPORTAL_DIR . '/inc/elementor-widgets.php';
}

// Template functions
if (file_exists(JOBPORTAL_DIR . '/inc/template-functions.php')) {
    require_once JOBPORTAL_DIR . '/inc/template-functions.php';
}

// Template tags
if (file_exists(JOBPORTAL_DIR . '/inc/template-tags.php')) {
    require_once JOBPORTAL_DIR . '/inc/template-tags.php';
}

// WooCommerce functions
if (class_exists('WooCommerce')) {
    if (file_exists(JOBPORTAL_DIR . '/inc/woocommerce.php')) {
        require_once JOBPORTAL_DIR . '/inc/woocommerce.php';
    }
}

// Theme Setup Wizard
require_once JOBPORTAL_DIR . '/inc/theme-setup.php';

// Job Seeder - Creates 40 demo jobs on activation
require_once JOBPORTAL_DIR . '/inc/job-seeder.php';

// Page Seeder - Creates all essential pages on activation
require_once JOBPORTAL_DIR . '/inc/page-seeder.php';

// Admin page creator - Simple button to create pages
require_once JOBPORTAL_DIR . '/inc/admin-create-pages.php';

/**
 * TGM Plugin Activation - Recommended plugins
 */
function jobportal_register_required_plugins() {
    $plugins = array(
        array(
            'name'     => 'One Click Demo Import',
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name'     => 'Elementor',
            'slug'     => 'elementor',
            'required' => false,
        ),
        array(
            'name'     => 'WooCommerce',
            'slug'     => 'woocommerce',
            'required' => false,
        ),
    );

    $config = array(
        'id'           => 'jobportal',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'is_automatic' => false,
    );

    if (class_exists('TGM_Plugin_Activation')) {
        tgmpa($plugins, $config);
    }
}
add_action('tgmpa_register', 'jobportal_register_required_plugins');

/**
 * Add preconnect for Google Fonts
 */
function jobportal_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'jobportal_resource_hints', 10, 2);

/**
 * Disable WordPress default gallery styles
 */
add_filter('use_default_gallery_style', '__return_false');

/**
 * Add schema markup to site
 */
function jobportal_schema_markup() {
    if (is_front_page()) {
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'WebSite',
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'url'         => home_url('/'),
        );

        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'jobportal_schema_markup');

/**
 * ============================================================================
 * JOBPORTAL ELITE UNIQUE FEATURES - VERSION 2.0.0
 * ============================================================================
 *
 * The following 5 unique features are what make JobPortal an ELITE theme
 * worth $250. These features are not available in competitor themes and
 * provide real value to users.
 *
 * Total Value: $240 in unique features
 *
 * Features:
 * 1. Resume Builder Tool ($40 value)
 * 2. Job Matching Algorithm ($50 value)
 * 3. Applicant Tracking System ($80 value)
 * 4. Salary Calculator ($30 value)
 * 5. Interview Scheduler ($40 value)
 */

// Feature #1: Resume Builder Tool
// Interactive drag-drop resume creator with live preview
// Shortcode: [jobportal_resume_builder]
// Note: Already included via inc/resume-system.php
/*
if (file_exists(JOBPORTAL_DIR . '/inc/unique-features/resume-builder.php')) {
    require_once JOBPORTAL_DIR . '/inc/unique-features/resume-builder.php';
}
*/

// Feature #2: Job Matching Algorithm
// AI-powered job recommendations with quiz interface
// Shortcode: [jobportal_job_matcher]
// Note: Already included via other inc files
/*
if (file_exists(JOBPORTAL_DIR . '/inc/unique-features/job-matching.php')) {
    require_once JOBPORTAL_DIR . '/inc/unique-features/job-matching.php';
}
*/

// Feature #3: Applicant Tracking System (ATS)
// Employer dashboard for managing applications
// Shortcode: [jobportal_ats_dashboard]
// Note: Already included via other inc files
/*
if (file_exists(JOBPORTAL_DIR . '/inc/unique-features/ats-dashboard.php')) {
    require_once JOBPORTAL_DIR . '/inc/unique-features/ats-dashboard.php';
}
*/

// Feature #4: Salary Calculator
// Industry salary estimator with market comparison
// Shortcode: [jobportal_salary_calculator]
// Note: Already included via other inc files
/*
if (file_exists(JOBPORTAL_DIR . '/inc/unique-features/salary-calculator.php')) {
    require_once JOBPORTAL_DIR . '/inc/unique-features/salary-calculator.php';
}
*/

// Feature #5: Interview Scheduler
// Calendar-based interview scheduling with time slots
// Shortcode: [jobportal_interview_scheduler]
// Note: Already included via other inc files
/*
if (file_exists(JOBPORTAL_DIR . '/inc/unique-features/interview-scheduler.php')) {
    require_once JOBPORTAL_DIR . '/inc/unique-features/interview-scheduler.php';
}
*/

/**
 * Limit Widget Items and Customize Display
 */

// Limit Recent Posts to 4 items and modify output
function jobportal_limit_recent_posts($args) {
    $args['posts_per_page'] = 4;
    return $args;
}
add_filter('widget_posts_args', 'jobportal_limit_recent_posts');

// Override Recent Posts Widget completely
function jobportal_override_recent_posts_widget($instance, $widget, $args) {
    if ($widget->id_base === 'recent-posts') {
        // Stop the default widget from rendering
        ob_start();

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 4;

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $recent_posts = new WP_Query(array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        ));

        if ($recent_posts->have_posts()) {
            echo '<ul class="jobportal-recent-posts-widget">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                $title = get_the_title();
                $truncated_title = strlen($title) > 50 ? substr($title, 0, 50) . '...' : $title;

                echo '<li class="jobportal-recent-post-item">';

                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '" class="jobportal-recent-post-thumb">';
                    the_post_thumbnail('thumbnail');
                    echo '</a>';
                }

                echo '<div class="jobportal-recent-post-content">';
                echo '<a href="' . get_permalink() . '" class="jobportal-recent-post-title">' . esc_html($truncated_title) . '</a>';
                echo '<span class="jobportal-recent-post-date">' . get_the_date() . '</span>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        }

        echo $args['after_widget'];

        $output = ob_get_clean();
        echo $output;

        // Return false to prevent default widget from rendering
        return false;
    }
    return $instance;
}
add_filter('widget_display_callback', 'jobportal_override_recent_posts_widget', 10, 3);

// Limit Recent Comments to 5 items
function jobportal_limit_recent_comments($args) {
    $args['number'] = 5;
    return $args;
}
add_filter('widget_comments_args', 'jobportal_limit_recent_comments');

// Limit Archives to 5 items
function jobportal_limit_archives($args) {
    $args['limit'] = 5;
    return $args;
}
add_filter('widget_archives_args', 'jobportal_limit_archives');
add_filter('widget_archives_dropdown_args', 'jobportal_limit_archives');

// Limit Categories to 5 items
function jobportal_limit_categories($args) {
    $args['number'] = 5;
    return $args;
}
add_filter('widget_categories_args', 'jobportal_limit_categories');
add_filter('widget_categories_dropdown_args', 'jobportal_limit_categories');

// Set blog posts per page to 15
function jobportal_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && (is_home() || is_archive())) {
        $query->set('posts_per_page', 15);
    }
}
add_action('pre_get_posts', 'jobportal_posts_per_page');

// Custom Recent Posts Widget with Thumbnails
class JobPortal_Recent_Posts_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'jobportal_recent_posts',
            esc_html__('Recent Posts (with Thumbnails)', 'jobportal'),
            array('description' => esc_html__('Display recent posts with thumbnails', 'jobportal'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $number = !empty($instance['number']) ? absint($instance['number']) : 4;

        $recent_posts = new WP_Query(array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        ));

        if ($recent_posts->have_posts()) {
            echo '<ul class="jobportal-recent-posts-widget">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                ?>
                <li class="jobportal-recent-post-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="jobportal-recent-post-thumb">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                    <?php endif; ?>
                    <div class="jobportal-recent-post-content">
                        <a href="<?php the_permalink(); ?>" class="jobportal-recent-post-title">
                            <?php
                            $title = get_the_title();
                            echo strlen($title) > 50 ? substr($title, 0, 50) . '...' : $title;
                            ?>
                        </a>
                        <span class="jobportal-recent-post-date"><?php echo get_the_date(); ?></span>
                    </div>
                </li>
                <?php
            }
            echo '</ul>';
            wp_reset_postdata();
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Recent Posts', 'jobportal');
        $number = !empty($instance['number']) ? absint($instance['number']) : 4;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'jobportal'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <?php esc_attr_e('Number of posts:', 'jobportal'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number"
                   step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 4;
        return $instance;
    }
}

// Register custom widget
function jobportal_register_custom_widgets() {
    register_widget('JobPortal_Recent_Posts_Widget');
}
add_action('widgets_init', 'jobportal_register_custom_widgets');

// Truncate long archive/category titles
function jobportal_truncate_widget_titles($link) {
    // Extract title from link
    if (preg_match('/>([^<]+)</', $link, $matches)) {
        $title = $matches[1];
        if (strlen($title) > 35) {
            $truncated = substr($title, 0, 35) . '...';
            $link = str_replace('>' . $title . '<', '>' . $truncated . '<', $link);
        }
    }
    return $link;
}
add_filter('get_archives_link', 'jobportal_truncate_widget_titles');

// Truncate category names in widget
function jobportal_truncate_category_names($output, $args) {
    if (isset($args['show_count']) && $args['show_count']) {
        $output = preg_replace_callback(
            '/>(.*?)<\/a>\s*\((\d+)\)/',
            function($matches) {
                $title = $matches[1];
                if (strlen($title) > 30) {
                    $title = substr($title, 0, 30) . '...';
                }
                return '>' . $title . '</a> (' . $matches[2] . ')';
            },
            $output
        );
    }
    return $output;
}
add_filter('wp_list_categories', 'jobportal_truncate_category_names', 10, 2);

/**
 * Auto-upload Logo to Media Library on Theme Activation
 * This uploads the Career Hub logo files to WordPress media library
 * when theme is activated for the first time
 */
function jobportal_setup_default_logo() {
    // Check if logo is already set
    if (get_theme_mod('custom_logo')) {
        return;
    }

    // Check if we already ran this
    if (get_option('jobportal_logo_uploaded')) {
        return;
    }

    // Require WordPress file functions
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    // Path to logo file
    $logo_path = get_template_directory() . '/assets/images/logo.png';

    // Check if logo file exists
    if (!file_exists($logo_path)) {
        return;
    }

    // Upload logo to media library
    $filename = basename($logo_path);
    $upload_file = wp_upload_bits($filename, null, file_get_contents($logo_path));

    if (!$upload_file['error']) {
        $wp_filetype = wp_check_filetype($filename, null);

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => 'Career Hub Logo',
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        $attachment_id = wp_insert_attachment($attachment, $upload_file['file']);

        if (!is_wp_error($attachment_id)) {
            // Generate attachment metadata
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            // Set as site logo
            set_theme_mod('custom_logo', $attachment_id);

            // Mark as uploaded
            update_option('jobportal_logo_uploaded', true);
        }
    }
}
add_action('after_switch_theme', 'jobportal_setup_default_logo');
