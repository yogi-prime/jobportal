<?php
/**
 * JobPortal Theme Setup Wizard
 *
 * Handles theme activation, page creation, and setup wizard
 *
 * @package JobPortal
 */

if (!defined('ABSPATH')) {
    exit;
}

class JobPortal_Theme_Setup {

    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('after_switch_theme', array($this, 'theme_activation'));
        add_action('admin_menu', array($this, 'add_setup_menu'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        add_action('wp_ajax_jobportal_setup_step', array($this, 'ajax_setup_step'));
        add_action('admin_notices', array($this, 'setup_notice'));
        add_action('wp_ajax_jobportal_dismiss_notice', array($this, 'dismiss_notice'));
    }

    /**
     * Theme activation hook
     */
    public function theme_activation() {
        // Set flag to show setup wizard
        set_transient('jobportal_activation_redirect', true, 30);
        update_option('jobportal_setup_complete', false);

        // Redirect to setup wizard
        add_action('admin_init', array($this, 'activation_redirect'));
    }

    /**
     * Redirect to setup wizard after activation
     */
    public function activation_redirect() {
        if (get_transient('jobportal_activation_redirect')) {
            delete_transient('jobportal_activation_redirect');

            if (!isset($_GET['activate-multi'])) {
                wp_safe_redirect(admin_url('themes.php?page=jobportal-setup'));
                exit;
            }
        }
    }

    /**
     * Add setup menu
     */
    public function add_setup_menu() {
        add_theme_page(
            __('JobPortal Setup', 'jobportal'),
            __('JobPortal Setup', 'jobportal'),
            'edit_theme_options',
            'jobportal-setup',
            array($this, 'setup_page')
        );
    }

    /**
     * Admin scripts for setup wizard
     */
    public function admin_scripts($hook) {
        if ('appearance_page_jobportal-setup' !== $hook) {
            return;
        }

        wp_enqueue_style('jobportal-setup', JOBPORTAL_ASSETS . '/css/setup.css', array(), JOBPORTAL_VERSION);
        wp_enqueue_script('jobportal-setup', JOBPORTAL_ASSETS . '/js/setup.js', array('jquery'), JOBPORTAL_VERSION, true);

        wp_localize_script('jobportal-setup', 'jobportalSetup', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('jobportal_setup_nonce'),
            'strings' => array(
                'installing' => __('Installing...', 'jobportal'),
                'creating' => __('Creating...', 'jobportal'),
                'complete' => __('Complete!', 'jobportal'),
                'error' => __('Error occurred', 'jobportal'),
            ),
        ));
    }

    /**
     * Setup notice
     */
    public function setup_notice() {
        if (get_option('jobportal_setup_complete')) {
            return;
        }

        if (get_option('jobportal_dismiss_setup_notice')) {
            return;
        }

        $screen = get_current_screen();
        if ('appearance_page_jobportal-setup' === $screen->id) {
            return;
        }
        ?>
        <div class="notice notice-info is-dismissible jobportal-setup-notice">
            <p>
                <strong><?php esc_html_e('Welcome to JobPortal Theme!', 'jobportal'); ?></strong>
                <?php esc_html_e('Run the setup wizard to get started quickly.', 'jobportal'); ?>
                <a href="<?php echo esc_url(admin_url('themes.php?page=jobportal-setup')); ?>" class="button button-primary" style="margin-left: 10px;">
                    <?php esc_html_e('Run Setup Wizard', 'jobportal'); ?>
                </a>
            </p>
        </div>
        <?php
    }

    /**
     * Dismiss notice
     */
    public function dismiss_notice() {
        update_option('jobportal_dismiss_setup_notice', true);
        wp_die();
    }

    /**
     * Setup wizard page
     */
    public function setup_page() {
        $current_step = isset($_GET['step']) ? sanitize_text_field($_GET['step']) : 'welcome';
        ?>
        <div class="jobportal-setup-wrap">
            <div class="jobportal-setup-header">
                <h1 class="jobportal-setup-logo">
                    <span class="jobportal-logo-icon">F</span>
                    <?php esc_html_e('JobPortal Theme Setup', 'jobportal'); ?>
                </h1>
                <p class="jobportal-setup-tagline"><?php esc_html_e('Let\'s get your website ready in minutes!', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-setup-steps">
                <ul class="jobportal-steps-list">
                    <li class="<?php echo $current_step === 'welcome' ? 'active' : ''; ?>" data-step="welcome">
                        <span class="step-number">1</span>
                        <span class="step-name"><?php esc_html_e('Welcome', 'jobportal'); ?></span>
                    </li>
                    <li class="<?php echo $current_step === 'plugins' ? 'active' : ''; ?>" data-step="plugins">
                        <span class="step-number">2</span>
                        <span class="step-name"><?php esc_html_e('Plugins', 'jobportal'); ?></span>
                    </li>
                    <li class="<?php echo $current_step === 'pages' ? 'active' : ''; ?>" data-step="pages">
                        <span class="step-number">3</span>
                        <span class="step-name"><?php esc_html_e('Pages', 'jobportal'); ?></span>
                    </li>
                    <li class="<?php echo $current_step === 'demo' ? 'active' : ''; ?>" data-step="demo">
                        <span class="step-number">4</span>
                        <span class="step-name"><?php esc_html_e('Demo Content', 'jobportal'); ?></span>
                    </li>
                    <li class="<?php echo $current_step === 'done' ? 'active' : ''; ?>" data-step="done">
                        <span class="step-number">5</span>
                        <span class="step-name"><?php esc_html_e('Done!', 'jobportal'); ?></span>
                    </li>
                </ul>
            </div>

            <div class="jobportal-setup-content">
                <?php $this->render_step($current_step); ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render setup step
     */
    private function render_step($step) {
        switch ($step) {
            case 'welcome':
                $this->step_welcome();
                break;
            case 'plugins':
                $this->step_plugins();
                break;
            case 'pages':
                $this->step_pages();
                break;
            case 'demo':
                $this->step_demo();
                break;
            case 'done':
                $this->step_done();
                break;
            default:
                $this->step_welcome();
        }
    }

    /**
     * Step 1: Welcome
     */
    private function step_welcome() {
        ?>
        <div class="jobportal-step-content jobportal-step-welcome">
            <div class="jobportal-welcome-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
            </div>
            <h2><?php esc_html_e('Welcome to JobPortal Theme!', 'jobportal'); ?></h2>
            <p class="jobportal-welcome-desc">
                <?php esc_html_e('Thank you for choosing JobPortal - the premium SaaS & Startup theme. This wizard will help you set up your website in just a few minutes.', 'jobportal'); ?>
            </p>

            <div class="jobportal-features-preview">
                <h3><?php esc_html_e('What you\'ll get:', 'jobportal'); ?></h3>
                <ul class="jobportal-feature-list">
                    <li>
                        <span class="feature-icon">&#10003;</span>
                        <?php esc_html_e('Professional landing page', 'jobportal'); ?>
                    </li>
                    <li>
                        <span class="feature-icon">&#10003;</span>
                        <?php esc_html_e('About, Services, Contact pages', 'jobportal'); ?>
                    </li>
                    <li>
                        <span class="feature-icon">&#10003;</span>
                        <?php esc_html_e('Blog section ready', 'jobportal'); ?>
                    </li>
                    <li>
                        <span class="feature-icon">&#10003;</span>
                        <?php esc_html_e('Working contact form', 'jobportal'); ?>
                    </li>
                    <li>
                        <span class="feature-icon">&#10003;</span>
                        <?php esc_html_e('50+ customization options', 'jobportal'); ?>
                    </li>
                    <li>
                        <span class="feature-icon">&#10003;</span>
                        <?php esc_html_e('Mobile responsive design', 'jobportal'); ?>
                    </li>
                </ul>
            </div>

            <div class="jobportal-step-actions">
                <a href="<?php echo esc_url(admin_url('themes.php?page=jobportal-setup&step=plugins')); ?>" class="jobportal-btn-primary">
                    <?php esc_html_e('Let\'s Get Started', 'jobportal'); ?>
                    <span class="btn-arrow">&rarr;</span>
                </a>
                <a href="<?php echo esc_url(admin_url('themes.php')); ?>" class="jobportal-btn-skip">
                    <?php esc_html_e('Skip Setup', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php
    }

    /**
     * Step 2: Plugins
     */
    private function step_plugins() {
        $plugins = $this->get_required_plugins();
        ?>
        <div class="jobportal-step-content jobportal-step-plugins">
            <h2><?php esc_html_e('Install Recommended Plugins', 'jobportal'); ?></h2>
            <p><?php esc_html_e('These plugins enhance your theme experience. Select which ones to install.', 'jobportal'); ?></p>

            <div class="jobportal-plugins-list">
                <?php foreach ($plugins as $plugin) : ?>
                <div class="jobportal-plugin-item" data-slug="<?php echo esc_attr($plugin['slug']); ?>">
                    <label class="jobportal-plugin-checkbox">
                        <input type="checkbox" name="plugins[]" value="<?php echo esc_attr($plugin['slug']); ?>" <?php echo $plugin['required'] ? 'checked' : ''; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <div class="jobportal-plugin-info">
                        <h4><?php echo esc_html($plugin['name']); ?></h4>
                        <p><?php echo esc_html($plugin['description']); ?></p>
                        <?php if ($plugin['required']) : ?>
                            <span class="plugin-badge required"><?php esc_html_e('Recommended', 'jobportal'); ?></span>
                        <?php endif; ?>
                        <?php if ($this->is_plugin_active($plugin['slug'])) : ?>
                            <span class="plugin-badge active"><?php esc_html_e('Active', 'jobportal'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="jobportal-plugin-status">
                        <span class="status-icon"></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="jobportal-step-actions">
                <button type="button" class="jobportal-btn-primary" id="jobportal-install-plugins">
                    <?php esc_html_e('Install Selected Plugins', 'jobportal'); ?>
                    <span class="btn-arrow">&rarr;</span>
                </button>
                <a href="<?php echo esc_url(admin_url('themes.php?page=jobportal-setup&step=pages')); ?>" class="jobportal-btn-skip">
                    <?php esc_html_e('Skip This Step', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php
    }

    /**
     * Step 3: Pages
     */
    private function step_pages() {
        $pages = $this->get_default_pages();
        ?>
        <div class="jobportal-step-content jobportal-step-pages">
            <h2><?php esc_html_e('Create Essential Pages', 'jobportal'); ?></h2>
            <p><?php esc_html_e('We\'ll create these pages with beautiful templates. You can customize them later.', 'jobportal'); ?></p>

            <div class="jobportal-pages-list">
                <?php foreach ($pages as $page) : ?>
                <div class="jobportal-page-item" data-page="<?php echo esc_attr($page['slug']); ?>">
                    <label class="jobportal-page-checkbox">
                        <input type="checkbox" name="pages[]" value="<?php echo esc_attr($page['slug']); ?>" checked>
                        <span class="checkmark"></span>
                    </label>
                    <div class="jobportal-page-info">
                        <h4><?php echo esc_html($page['title']); ?></h4>
                        <p><?php echo esc_html($page['description']); ?></p>
                        <span class="page-template"><?php echo esc_html($page['template_name']); ?></span>
                    </div>
                    <div class="jobportal-page-status">
                        <span class="status-icon"></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="jobportal-step-actions">
                <button type="button" class="jobportal-btn-primary" id="jobportal-create-pages">
                    <?php esc_html_e('Create Selected Pages', 'jobportal'); ?>
                    <span class="btn-arrow">&rarr;</span>
                </button>
                <a href="<?php echo esc_url(admin_url('themes.php?page=jobportal-setup&step=demo')); ?>" class="jobportal-btn-skip">
                    <?php esc_html_e('Skip This Step', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php
    }

    /**
     * Step 4: Demo Content
     */
    private function step_demo() {
        ?>
        <div class="jobportal-step-content jobportal-step-demo">
            <h2><?php esc_html_e('Import Demo Content', 'jobportal'); ?></h2>
            <p><?php esc_html_e('Import sample content to see how your site will look with real data.', 'jobportal'); ?></p>

            <div class="jobportal-demo-options">
                <div class="jobportal-demo-item" data-demo="full">
                    <div class="demo-preview">
                        <div class="demo-preview-img">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg>
                        </div>
                        <h4><?php esc_html_e('Full Demo', 'jobportal'); ?></h4>
                        <p><?php esc_html_e('Complete website with all content, images, and settings', 'jobportal'); ?></p>
                        <ul class="demo-includes">
                            <li><?php esc_html_e('6 Sample Pages', 'jobportal'); ?></li>
                            <li><?php esc_html_e('5 Blog Posts', 'jobportal'); ?></li>
                            <li><?php esc_html_e('6 Services', 'jobportal'); ?></li>
                            <li><?php esc_html_e('3 Testimonials', 'jobportal'); ?></li>
                            <li><?php esc_html_e('3 Pricing Plans', 'jobportal'); ?></li>
                            <li><?php esc_html_e('Navigation Menus', 'jobportal'); ?></li>
                        </ul>
                    </div>
                    <button type="button" class="jobportal-btn-secondary" data-import="full">
                        <?php esc_html_e('Import Full Demo', 'jobportal'); ?>
                    </button>
                </div>

                <div class="jobportal-demo-item" data-demo="minimal">
                    <div class="demo-preview">
                        <div class="demo-preview-img">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <h4><?php esc_html_e('Starter Content', 'jobportal'); ?></h4>
                        <p><?php esc_html_e('Basic content to get started quickly', 'jobportal'); ?></p>
                        <ul class="demo-includes">
                            <li><?php esc_html_e('Home Page Setup', 'jobportal'); ?></li>
                            <li><?php esc_html_e('Primary Menu', 'jobportal'); ?></li>
                            <li><?php esc_html_e('Theme Settings', 'jobportal'); ?></li>
                        </ul>
                    </div>
                    <button type="button" class="jobportal-btn-secondary" data-import="minimal">
                        <?php esc_html_e('Import Starter', 'jobportal'); ?>
                    </button>
                </div>
            </div>

            <div class="jobportal-import-progress" style="display: none;">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <p class="progress-text"><?php esc_html_e('Importing...', 'jobportal'); ?></p>
            </div>

            <div class="jobportal-step-actions">
                <a href="<?php echo esc_url(admin_url('themes.php?page=jobportal-setup&step=done')); ?>" class="jobportal-btn-skip">
                    <?php esc_html_e('Skip & Finish', 'jobportal'); ?>
                </a>
            </div>
        </div>
        <?php
    }

    /**
     * Step 5: Done
     */
    private function step_done() {
        update_option('jobportal_setup_complete', true);
        ?>
        <div class="jobportal-step-content jobportal-step-done">
            <div class="jobportal-done-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h2><?php esc_html_e('Your Website is Ready!', 'jobportal'); ?></h2>
            <p class="jobportal-done-desc">
                <?php esc_html_e('Congratulations! Your JobPortal theme is now set up and ready to customize.', 'jobportal'); ?>
            </p>

            <div class="jobportal-next-steps">
                <h3><?php esc_html_e('What\'s Next?', 'jobportal'); ?></h3>
                <div class="jobportal-next-grid">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="jobportal-next-item" target="_blank">
                        <span class="next-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </span>
                        <span class="next-text">
                            <strong><?php esc_html_e('View Your Site', 'jobportal'); ?></strong>
                            <small><?php esc_html_e('See how it looks', 'jobportal'); ?></small>
                        </span>
                    </a>

                    <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="jobportal-next-item">
                        <span class="next-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                        </span>
                        <span class="next-text">
                            <strong><?php esc_html_e('Customize Theme', 'jobportal'); ?></strong>
                            <small><?php esc_html_e('Colors, fonts & more', 'jobportal'); ?></small>
                        </span>
                    </a>

                    <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>" class="jobportal-next-item">
                        <span class="next-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </span>
                        <span class="next-text">
                            <strong><?php esc_html_e('Edit Pages', 'jobportal'); ?></strong>
                            <small><?php esc_html_e('Modify content', 'jobportal'); ?></small>
                        </span>
                    </a>

                    <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="jobportal-next-item">
                        <span class="next-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </span>
                        <span class="next-text">
                            <strong><?php esc_html_e('Setup Menus', 'jobportal'); ?></strong>
                            <small><?php esc_html_e('Navigation links', 'jobportal'); ?></small>
                        </span>
                    </a>
                </div>
            </div>

            <div class="jobportal-support-box">
                <h4><?php esc_html_e('Need Help?', 'jobportal'); ?></h4>
                <p><?php esc_html_e('Check out our documentation or contact support.', 'jobportal'); ?></p>
                <div class="support-links">
                    <a href="#" class="jobportal-btn-secondary"><?php esc_html_e('Documentation', 'jobportal'); ?></a>
                    <a href="#" class="jobportal-btn-outline"><?php esc_html_e('Contact Support', 'jobportal'); ?></a>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Get required plugins list
     */
    private function get_required_plugins() {
        return array(
            array(
                'name' => 'Contact Form 7',
                'slug' => 'contact-form-7',
                'description' => __('Create beautiful contact forms easily.', 'jobportal'),
                'required' => true,
            ),
            array(
                'name' => 'One Click Demo Import',
                'slug' => 'one-click-demo-import',
                'description' => __('Import demo content with one click.', 'jobportal'),
                'required' => true,
            ),
            array(
                'name' => 'Elementor',
                'slug' => 'elementor',
                'description' => __('Drag & drop page builder for advanced customization.', 'jobportal'),
                'required' => false,
            ),
            array(
                'name' => 'WooCommerce',
                'slug' => 'woocommerce',
                'description' => __('Sell products and services online.', 'jobportal'),
                'required' => false,
            ),
            array(
                'name' => 'UpdraftPlus Backup',
                'slug' => 'updraftplus',
                'description' => __('Backup your website automatically.', 'jobportal'),
                'required' => false,
            ),
        );
    }

    /**
     * Get default pages to create
     */
    private function get_default_pages() {
        return array(
            array(
                'title' => __('Home', 'jobportal'),
                'slug' => 'home',
                'template' => '',
                'template_name' => __('Front Page', 'jobportal'),
                'description' => __('Your landing page with hero, features, pricing & more', 'jobportal'),
            ),
            array(
                'title' => __('About Us', 'jobportal'),
                'slug' => 'about',
                'template' => 'page-about.php',
                'template_name' => __('About Us Template', 'jobportal'),
                'description' => __('Tell your story with team & values sections', 'jobportal'),
            ),
            array(
                'title' => __('Services', 'jobportal'),
                'slug' => 'services',
                'template' => 'page-services.php',
                'template_name' => __('Services Template', 'jobportal'),
                'description' => __('Showcase your services with beautiful cards', 'jobportal'),
            ),
            array(
                'title' => __('Contact', 'jobportal'),
                'slug' => 'contact',
                'template' => 'page-contact.php',
                'template_name' => __('Contact Template', 'jobportal'),
                'description' => __('Contact form with map & company info', 'jobportal'),
            ),
            array(
                'title' => __('Blog', 'jobportal'),
                'slug' => 'blog',
                'template' => '',
                'template_name' => __('Blog Page', 'jobportal'),
                'description' => __('Your blog posts page', 'jobportal'),
            ),
            array(
                'title' => __('Privacy Policy', 'jobportal'),
                'slug' => 'privacy-policy',
                'template' => 'page-privacy.php',
                'template_name' => __('Privacy Policy Template', 'jobportal'),
                'description' => __('GDPR compliant privacy policy page', 'jobportal'),
            ),
            array(
                'title' => __('Terms of Service', 'jobportal'),
                'slug' => 'terms',
                'template' => 'page-terms.php',
                'template_name' => __('Terms Template', 'jobportal'),
                'description' => __('Legal terms and conditions page', 'jobportal'),
            ),
        );
    }

    /**
     * Check if plugin is active
     */
    private function is_plugin_active($slug) {
        $active_plugins = get_option('active_plugins', array());
        foreach ($active_plugins as $plugin) {
            if (strpos($plugin, $slug) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * AJAX handler for setup steps
     */
    public function ajax_setup_step() {
        check_ajax_referer('jobportal_setup_nonce', 'nonce');

        if (!current_user_can('edit_theme_options')) {
            wp_send_json_error(array('message' => __('Permission denied.', 'jobportal')));
        }

        $action = isset($_POST['setup_action']) ? sanitize_text_field($_POST['setup_action']) : '';

        switch ($action) {
            case 'install_plugin':
                $this->ajax_install_plugin();
                break;
            case 'create_pages':
                $this->ajax_create_pages();
                break;
            case 'import_demo':
                $this->ajax_import_demo();
                break;
            default:
                wp_send_json_error(array('message' => __('Invalid action.', 'jobportal')));
        }
    }

    /**
     * Install plugin via AJAX
     */
    private function ajax_install_plugin() {
        $slug = isset($_POST['plugin']) ? sanitize_text_field($_POST['plugin']) : '';

        if (empty($slug)) {
            wp_send_json_error(array('message' => __('Plugin slug required.', 'jobportal')));
        }

        include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $api = plugins_api('plugin_information', array(
            'slug' => $slug,
            'fields' => array('sections' => false),
        ));

        if (is_wp_error($api)) {
            wp_send_json_error(array('message' => $api->get_error_message()));
        }

        $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());
        $result = $upgrader->install($api->download_link);

        if (is_wp_error($result)) {
            wp_send_json_error(array('message' => $result->get_error_message()));
        }

        // Activate plugin
        $plugin_file = $slug . '/' . $slug . '.php';
        $activate = activate_plugin($plugin_file);

        if (is_wp_error($activate)) {
            wp_send_json_success(array('message' => __('Installed but not activated.', 'jobportal')));
        }

        wp_send_json_success(array('message' => __('Plugin installed and activated!', 'jobportal')));
    }

    /**
     * Create pages via AJAX
     */
    private function ajax_create_pages() {
        $pages = isset($_POST['pages']) ? array_map('sanitize_text_field', $_POST['pages']) : array();
        $default_pages = $this->get_default_pages();
        $created = array();

        foreach ($default_pages as $page_data) {
            if (!in_array($page_data['slug'], $pages)) {
                continue;
            }

            // Check if page exists
            $existing = get_page_by_path($page_data['slug']);
            if ($existing) {
                $created[] = $page_data['title'] . ' (exists)';
                continue;
            }

            // Create page
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $page_data['slug'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => '',
            ));

            if ($page_id && !empty($page_data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }

            // Set home page
            if ($page_data['slug'] === 'home' && $page_id) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_id);
            }

            // Set blog page
            if ($page_data['slug'] === 'blog' && $page_id) {
                update_option('page_for_posts', $page_id);
            }

            $created[] = $page_data['title'];
        }

        // Create menu
        $this->create_primary_menu();

        wp_send_json_success(array(
            'message' => sprintf(__('%d pages created!', 'jobportal'), count($created)),
            'pages' => $created,
        ));
    }

    /**
     * Create primary menu
     */
    private function create_primary_menu() {
        $menu_name = 'Primary Menu';
        $menu_exists = wp_get_nav_menu_object($menu_name);

        if ($menu_exists) {
            return;
        }

        $menu_id = wp_create_nav_menu($menu_name);

        $pages = array(
            'home' => __('Home', 'jobportal'),
            'about' => __('About', 'jobportal'),
            'services' => __('Services', 'jobportal'),
            'blog' => __('Blog', 'jobportal'),
            'contact' => __('Contact', 'jobportal'),
        );

        $order = 1;
        foreach ($pages as $slug => $title) {
            $page = get_page_by_path($slug);
            if ($page) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => $title,
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => $page->ID,
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish',
                    'menu-item-position' => $order,
                ));
                $order++;
            }
        }

        // Assign menu to location
        $locations = get_theme_mod('nav_menu_locations', array());
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    /**
     * Import demo content via AJAX
     */
    private function ajax_import_demo() {
        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'minimal';

        // Create demo services
        $this->create_demo_services();

        // Create demo testimonials
        $this->create_demo_testimonials();

        // Create demo pricing
        $this->create_demo_pricing();

        // Create demo FAQs
        $this->create_demo_faqs();

        // Create demo blog posts
        if ($type === 'full') {
            $this->create_demo_posts();
        }

        wp_send_json_success(array('message' => __('Demo content imported!', 'jobportal')));
    }

    /**
     * Create demo services
     */
    private function create_demo_services() {
        $services = array(
            array('title' => 'Lightning Fast Performance', 'icon' => 'zap', 'desc' => 'Optimized for speed with sub-second response times and efficient resource usage.'),
            array('title' => 'Enterprise Security', 'icon' => 'shield', 'desc' => 'Bank-level encryption and security protocols to keep your data safe.'),
            array('title' => 'Advanced Analytics', 'icon' => 'chart', 'desc' => 'Gain actionable insights with our powerful analytics dashboard.'),
            array('title' => 'Global Infrastructure', 'icon' => 'globe', 'desc' => 'Deploy worldwide with our distributed cloud infrastructure.'),
            array('title' => 'Developer API', 'icon' => 'code', 'desc' => 'Comprehensive REST API with SDKs for all major languages.'),
            array('title' => '24/7 Support', 'icon' => 'headphones', 'desc' => 'Round-the-clock support from our expert team.'),
        );

        foreach ($services as $index => $service) {
            $existing = get_page_by_title($service['title'], OBJECT, 'jobportal_service');
            if ($existing) continue;

            $post_id = wp_insert_post(array(
                'post_title' => $service['title'],
                'post_content' => $service['desc'],
                'post_excerpt' => $service['desc'],
                'post_status' => 'publish',
                'post_type' => 'jobportal_service',
                'menu_order' => $index,
            ));

            if ($post_id) {
                update_post_meta($post_id, '_jobportal_service_icon', $service['icon']);
            }
        }
    }

    /**
     * Create demo testimonials
     */
    private function create_demo_testimonials() {
        $testimonials = array(
            array('author' => 'Sarah Johnson', 'position' => 'CEO', 'company' => 'TechCorp', 'content' => 'This platform has completely transformed how we operate. The features are incredible and the support team is always there when we need them.', 'rating' => 5),
            array('author' => 'Michael Chen', 'position' => 'CTO', 'company' => 'StartupX', 'content' => 'We saw a 300% increase in productivity since switching to this platform. Best decision we ever made for our business.', 'rating' => 5),
            array('author' => 'Emily Davis', 'position' => 'Founder', 'company' => 'GrowthLab', 'content' => 'The ease of use combined with powerful features makes this the perfect solution for any business looking to scale.', 'rating' => 5),
        );

        foreach ($testimonials as $testimonial) {
            $existing = get_page_by_title($testimonial['author'], OBJECT, 'jobportal_testimonial');
            if ($existing) continue;

            $post_id = wp_insert_post(array(
                'post_title' => $testimonial['author'],
                'post_content' => $testimonial['content'],
                'post_status' => 'publish',
                'post_type' => 'jobportal_testimonial',
            ));

            if ($post_id) {
                update_post_meta($post_id, '_jobportal_testimonial_author', $testimonial['author']);
                update_post_meta($post_id, '_jobportal_testimonial_position', $testimonial['position']);
                update_post_meta($post_id, '_jobportal_testimonial_company', $testimonial['company']);
                update_post_meta($post_id, '_jobportal_testimonial_rating', $testimonial['rating']);
            }
        }
    }

    /**
     * Create demo pricing plans
     */
    private function create_demo_pricing() {
        $plans = array(
            array('title' => 'Basic', 'monthly' => 29, 'yearly' => 290, 'features' => "5 Projects\n10GB Storage\nBasic Analytics\nEmail Support", 'popular' => false),
            array('title' => 'Professional', 'monthly' => 79, 'yearly' => 790, 'features' => "Unlimited Projects\n100GB Storage\nAdvanced Analytics\nPriority Support\nAPI Access\nTeam Collaboration", 'popular' => true),
            array('title' => 'Enterprise', 'monthly' => 199, 'yearly' => 1990, 'features' => "Everything in Pro\nUnlimited Storage\nCustom Integrations\nDedicated Manager\nSLA Guarantee\nWhite Label", 'popular' => false),
        );

        foreach ($plans as $index => $plan) {
            $existing = get_page_by_title($plan['title'], OBJECT, 'jobportal_pricing');
            if ($existing) continue;

            $post_id = wp_insert_post(array(
                'post_title' => $plan['title'],
                'post_status' => 'publish',
                'post_type' => 'jobportal_pricing',
                'menu_order' => $index,
            ));

            if ($post_id) {
                update_post_meta($post_id, '_jobportal_pricing_monthly', $plan['monthly']);
                update_post_meta($post_id, '_jobportal_pricing_yearly', $plan['yearly']);
                update_post_meta($post_id, '_jobportal_pricing_features', $plan['features']);
                update_post_meta($post_id, '_jobportal_pricing_popular', $plan['popular']);
                update_post_meta($post_id, '_jobportal_pricing_button_text', __('Get Started', 'jobportal'));
                update_post_meta($post_id, '_jobportal_pricing_button_url', '#');
            }
        }
    }

    /**
     * Create demo FAQs
     */
    private function create_demo_faqs() {
        $faqs = array(
            array('q' => 'How do I get started?', 'a' => 'Simply sign up for a free trial and you can start using all features immediately. No credit card required for the trial period.'),
            array('q' => 'Can I cancel my subscription anytime?', 'a' => 'Yes, you can cancel your subscription at any time. There are no long-term contracts or cancellation fees.'),
            array('q' => 'Is there a free trial available?', 'a' => 'Yes! We offer a 14-day free trial with full access to all features. No credit card required to start.'),
            array('q' => 'Do you offer refunds?', 'a' => 'We offer a 30-day money-back guarantee. If you are not satisfied, contact us for a full refund.'),
            array('q' => 'What payment methods do you accept?', 'a' => 'We accept all major credit cards, PayPal, and bank transfers for annual plans.'),
            array('q' => 'Is my data secure?', 'a' => 'Yes, we use enterprise-grade encryption and security measures to protect your data. We are SOC 2 compliant.'),
        );

        foreach ($faqs as $index => $faq) {
            $existing = get_page_by_title($faq['q'], OBJECT, 'jobportal_faq');
            if ($existing) continue;

            wp_insert_post(array(
                'post_title' => $faq['q'],
                'post_content' => $faq['a'],
                'post_status' => 'publish',
                'post_type' => 'jobportal_faq',
                'menu_order' => $index,
            ));
        }
    }

    /**
     * Create demo blog posts
     */
    private function create_demo_posts() {
        $posts = array(
            array('title' => '10 Tips to Boost Your Productivity', 'content' => 'Discover proven strategies to maximize your efficiency and get more done in less time...'),
            array('title' => 'The Future of Remote Work', 'content' => 'Explore how technology is shaping the way we work and collaborate from anywhere...'),
            array('title' => 'How to Scale Your Startup Successfully', 'content' => 'Learn the key principles that successful founders use to grow their businesses...'),
            array('title' => 'Security Best Practices for 2024', 'content' => 'Stay protected with these essential security tips for your online presence...'),
            array('title' => 'Getting Started with Our Platform', 'content' => 'A comprehensive guide to help you make the most of all our features...'),
        );

        foreach ($posts as $post) {
            $existing = get_page_by_title($post['title'], OBJECT, 'post');
            if ($existing) continue;

            wp_insert_post(array(
                'post_title' => $post['title'],
                'post_content' => $post['content'],
                'post_status' => 'publish',
                'post_type' => 'post',
            ));
        }
    }
}

// Initialize
JobPortal_Theme_Setup::get_instance();
