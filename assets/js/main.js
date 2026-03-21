/**
 * JobPortal Theme Main JavaScript
 *
 * @package JobPortal
 */

(function($) {
    'use strict';

    // Global variables
    const JobPortal = {
        init: function() {
            this.preloader();
            this.stickyHeader();
            this.mobileMenu();
            this.smoothScroll();
            this.pricingToggle();
            this.faqAccordion();
            this.animations();
            this.forms();
            this.counterAnimation();
        },

        // Preloader
        preloader: function() {
            const preloader = document.getElementById('preloader');
            if (!preloader) return;

            window.addEventListener('load', function() {
                preloader.classList.add('jobportal-preloader-hidden');
                document.body.classList.remove('jobportal-loading');
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            });
        },

        // Sticky Header
        stickyHeader: function() {
            const header = document.getElementById('masthead');
            if (!header) return;

            let lastScroll = 0;
            const headerHeight = header.offsetHeight;

            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;

                if (currentScroll > headerHeight) {
                    header.classList.add('jobportal-header-sticky');

                    if (currentScroll > lastScroll && currentScroll > headerHeight * 2) {
                        header.classList.add('jobportal-header-hidden');
                    } else {
                        header.classList.remove('jobportal-header-hidden');
                    }
                } else {
                    header.classList.remove('jobportal-header-sticky');
                    header.classList.remove('jobportal-header-hidden');
                }

                lastScroll = currentScroll;
            });
        },

        // Mobile Menu
        mobileMenu: function() {
            const toggle = document.getElementById('mobile-toggle');
            const close = document.getElementById('mobile-close');
            const menu = document.getElementById('mobile-menu');
            const overlay = document.getElementById('mobile-overlay');

            if (!toggle || !menu) return;

            const openMenu = function() {
                menu.classList.add('jobportal-mobile-menu-open');
                menu.setAttribute('aria-hidden', 'false');
                toggle.setAttribute('aria-expanded', 'true');
                document.body.classList.add('jobportal-menu-open');
                if (overlay) overlay.classList.add('active');
            };

            const closeMenu = function() {
                menu.classList.remove('jobportal-mobile-menu-open');
                menu.setAttribute('aria-hidden', 'true');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('jobportal-menu-open');
                if (overlay) overlay.classList.remove('active');
            };

            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                if (menu.classList.contains('jobportal-mobile-menu-open')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            if (close) {
                close.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMenu();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', closeMenu);
            }

            // Close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && menu.classList.contains('jobportal-mobile-menu-open')) {
                    closeMenu();
                }
            });

            // Submenu toggle
            const subMenuToggles = menu.querySelectorAll('.menu-item-has-children > a');
            subMenuToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    const parent = this.parentElement;
                    const submenu = parent.querySelector('.sub-menu');

                    if (submenu) {
                        e.preventDefault();
                        parent.classList.toggle('submenu-open');
                    }
                });
            });
        },

        // Smooth Scroll
        smoothScroll: function() {
            document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#' || href === '#0') return;

                    const target = document.querySelector(href);
                    if (!target) return;

                    e.preventDefault();

                    const headerHeight = document.getElementById('masthead')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (mobileMenu?.classList.contains('jobportal-mobile-menu-open')) {
                        document.getElementById('mobile-close')?.click();
                    }
                });
            });
        },

        // Pricing Toggle
        pricingToggle: function() {
            const toggle = document.getElementById('pricing-toggle');
            if (!toggle) return;

            const labels = document.querySelectorAll('.jobportal-pricing-label');
            const prices = document.querySelectorAll('.jobportal-price-amount');

            toggle.addEventListener('click', function() {
                const isYearly = toggle.getAttribute('aria-pressed') === 'true';
                toggle.setAttribute('aria-pressed', !isYearly);

                labels.forEach(function(label) {
                    label.classList.toggle('active');
                });

                prices.forEach(function(price) {
                    const monthly = price.dataset.monthly;
                    const yearly = price.dataset.yearly;
                    price.textContent = isYearly ? monthly : yearly;
                });
            });
        },

        // FAQ Accordion
        faqAccordion: function() {
            const questions = document.querySelectorAll('.jobportal-faq-question');

            questions.forEach(function(question) {
                question.addEventListener('click', function() {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    const parent = this.parentElement;

                    // Close all other items
                    questions.forEach(function(q) {
                        if (q !== question) {
                            q.setAttribute('aria-expanded', 'false');
                            q.parentElement.classList.remove('active');
                        }
                    });

                    // Toggle current item
                    this.setAttribute('aria-expanded', !isExpanded);
                    parent.classList.toggle('active');
                });
            });
        },

        // AOS Animations
        animations: function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50,
                    delay: 0,
                });
            }

            // GSAP Animations
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // Hero parallax
                const heroImage = document.querySelector('.jobportal-hero-image-wrapper');
                if (heroImage) {
                    gsap.to(heroImage, {
                        y: 100,
                        scrollTrigger: {
                            trigger: '.jobportal-hero',
                            start: 'top top',
                            end: 'bottom top',
                            scrub: 1,
                        },
                    });
                }

                // Feature cards stagger
                gsap.utils.toArray('.jobportal-feature-card').forEach(function(card, i) {
                    gsap.from(card, {
                        y: 50,
                        opacity: 0,
                        duration: 0.8,
                        delay: i * 0.1,
                        scrollTrigger: {
                            trigger: card,
                            start: 'top 80%',
                            toggleActions: 'play none none none',
                        },
                    });
                });
            }
        },

        // Forms
        forms: function() {
            var self = this;

            // Contact Form
            $(document).on('submit', '.jobportal-contact-form', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.text();

                submitBtn.prop('disabled', true).text(jobportalData.i18n.sending);

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_contact_form',
                        nonce: jobportalData.nonce,
                        name: form.find('[name="name"]').val(),
                        email: form.find('[name="email"]').val(),
                        subject: form.find('[name="subject"]').val(),
                        message: form.find('[name="message"]').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            form[0].reset();
                            self.showNotification(response.data.message, 'success');
                        } else {
                            self.showNotification(response.data.message, 'error');
                        }
                    },
                    error: function() {
                        self.showNotification(jobportalData.i18n.error, 'error');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text(originalText);
                    },
                });
            });

            // Newsletter Form
            $(document).on('submit', '.jobportal-newsletter-form', function(e) {
                e.preventDefault();

                var form = $(this);
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.text();

                submitBtn.prop('disabled', true).text(jobportalData.i18n.subscribe);

                $.ajax({
                    url: jobportalData.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'jobportal_newsletter',
                        nonce: jobportalData.nonce,
                        email: form.find('[name="email"]').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            form[0].reset();
                            self.showNotification(response.data.message, 'success');
                        } else {
                            self.showNotification(response.data.message, 'error');
                        }
                    },
                    error: function() {
                        self.showNotification(jobportalData.i18n.error, 'error');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text(originalText);
                    },
                });
            });
        },

        // Counter Animation
        counterAnimation: function() {
            const counters = document.querySelectorAll('.jobportal-stat-number[data-count]');

            if (!counters.length) return;

            const animateCounter = function(counter) {
                const target = parseInt(counter.dataset.count);
                const duration = 2000;
                const start = 0;
                const startTime = performance.now();

                const updateCounter = function(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                    const current = Math.floor(start + (target - start) * easeOutQuart);

                    counter.textContent = current.toLocaleString() + (counter.textContent.includes('+') ? '+' : '') + (counter.textContent.includes('%') ? '%' : '');

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    }
                };

                requestAnimationFrame(updateCounter);
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(function(counter) {
                observer.observe(counter);
            });
        },

        // Show Notification
        showNotification: function(message, type) {
            const notification = document.createElement('div');
            notification.className = 'jobportal-notification jobportal-notification-' + type;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(function() {
                notification.classList.add('show');
            }, 10);

            setTimeout(function() {
                notification.classList.remove('show');
                setTimeout(function() {
                    notification.remove();
                }, 300);
            }, 4000);
        },
    };

    // Initialize on DOM ready
    $(document).ready(function() {
        JobPortal.init();
    });

})(jQuery);
