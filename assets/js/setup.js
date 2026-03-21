/**
 * JobPortal Theme Setup Wizard JavaScript
 *
 * @package JobPortal
 */

(function($) {
    'use strict';

    var JobPortalSetup = {
        /**
         * Initialize
         */
        init: function() {
            this.bindEvents();
        },

        /**
         * Bind events
         */
        bindEvents: function() {
            // Install plugins button
            $('#jobportal-install-plugins').on('click', this.installPlugins.bind(this));

            // Create pages button
            $('#jobportal-create-pages').on('click', this.createPages.bind(this));

            // Demo import buttons
            $('[data-import]').on('click', this.importDemo.bind(this));
        },

        /**
         * Install selected plugins
         */
        installPlugins: function(e) {
            e.preventDefault();

            var $button = $(e.currentTarget);
            var $plugins = $('.jobportal-plugin-item');
            var selectedPlugins = [];

            // Get selected plugins
            $plugins.each(function() {
                var $item = $(this);
                var $checkbox = $item.find('input[type="checkbox"]');

                if ($checkbox.is(':checked') && !$item.hasClass('installed')) {
                    selectedPlugins.push({
                        slug: $item.data('slug'),
                        element: $item
                    });
                }
            });

            if (selectedPlugins.length === 0) {
                this.goToNextStep('pages');
                return;
            }

            $button.prop('disabled', true).text(jobportalSetup.strings.installing);

            // Install plugins sequentially
            this.installPluginSequence(selectedPlugins, 0, function() {
                setTimeout(function() {
                    JobPortalSetup.goToNextStep('pages');
                }, 1000);
            });
        },

        /**
         * Install plugin in sequence
         */
        installPluginSequence: function(plugins, index, callback) {
            if (index >= plugins.length) {
                callback();
                return;
            }

            var plugin = plugins[index];
            var $item = plugin.element;

            $item.addClass('installing');

            $.ajax({
                url: jobportalSetup.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'jobportal_setup_step',
                    setup_action: 'install_plugin',
                    plugin: plugin.slug,
                    nonce: jobportalSetup.nonce
                },
                success: function(response) {
                    $item.removeClass('installing').addClass('installed');

                    // Continue with next plugin
                    JobPortalSetup.installPluginSequence(plugins, index + 1, callback);
                },
                error: function() {
                    $item.removeClass('installing');
                    // Continue anyway
                    JobPortalSetup.installPluginSequence(plugins, index + 1, callback);
                }
            });
        },

        /**
         * Create selected pages
         */
        createPages: function(e) {
            e.preventDefault();

            var $button = $(e.currentTarget);
            var selectedPages = [];

            // Get selected pages
            $('.jobportal-page-item').each(function() {
                var $item = $(this);
                var $checkbox = $item.find('input[type="checkbox"]');

                if ($checkbox.is(':checked')) {
                    selectedPages.push($item.data('page'));
                    $item.addClass('creating');
                }
            });

            if (selectedPages.length === 0) {
                this.goToNextStep('demo');
                return;
            }

            $button.prop('disabled', true).text(jobportalSetup.strings.creating);

            $.ajax({
                url: jobportalSetup.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'jobportal_setup_step',
                    setup_action: 'create_pages',
                    pages: selectedPages,
                    nonce: jobportalSetup.nonce
                },
                success: function(response) {
                    $('.jobportal-page-item.creating').removeClass('creating').addClass('created');

                    setTimeout(function() {
                        JobPortalSetup.goToNextStep('demo');
                    }, 1000);
                },
                error: function() {
                    $('.jobportal-page-item.creating').removeClass('creating');
                    $button.prop('disabled', false).html(
                        'Create Selected Pages <span class="btn-arrow">&rarr;</span>'
                    );
                    alert(jobportalSetup.strings.error);
                }
            });
        },

        /**
         * Import demo content
         */
        importDemo: function(e) {
            e.preventDefault();

            var $button = $(e.currentTarget);
            var type = $button.data('import');
            var $progress = $('.jobportal-import-progress');
            var $progressFill = $progress.find('.progress-fill');
            var $progressText = $progress.find('.progress-text');

            // Disable all buttons
            $('[data-import]').prop('disabled', true);

            // Show progress
            $progress.slideDown();
            $button.closest('.jobportal-demo-item').addClass('active');

            // Animate progress
            var progress = 0;
            var progressInterval = setInterval(function() {
                progress += Math.random() * 15;
                if (progress > 90) progress = 90;
                $progressFill.css('width', progress + '%');
            }, 500);

            $.ajax({
                url: jobportalSetup.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'jobportal_setup_step',
                    setup_action: 'import_demo',
                    type: type,
                    nonce: jobportalSetup.nonce
                },
                success: function(response) {
                    clearInterval(progressInterval);
                    $progressFill.css('width', '100%');
                    $progressText.text(jobportalSetup.strings.complete);

                    setTimeout(function() {
                        JobPortalSetup.goToNextStep('done');
                    }, 1000);
                },
                error: function() {
                    clearInterval(progressInterval);
                    $progressText.text(jobportalSetup.strings.error);
                    $('[data-import]').prop('disabled', false);
                }
            });
        },

        /**
         * Go to next step
         */
        goToNextStep: function(step) {
            window.location.href = jobportalSetup.ajaxUrl.replace('admin-ajax.php', 'themes.php?page=jobportal-setup&step=' + step);
        }
    };

    // Initialize on document ready
    $(document).ready(function() {
        JobPortalSetup.init();
    });

})(jQuery);
