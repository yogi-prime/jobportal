/**
 * Scroll Reveal Animations
 * Triggers animations when elements come into viewport
 *
 * @package JobPortal
 */

(function() {
    'use strict';

    // Intersection Observer for scroll animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const animateOnScroll = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Unobserve after animation to improve performance
                animateOnScroll.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Initialize on DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        initScrollAnimations();
        initCardHoverEffects();
        initParallaxEffect();
        initCounterAnimations();
    });

    /**
     * Initialize Scroll Animations
     */
    function initScrollAnimations() {
        // Find all elements with data-animate attribute
        const animatedElements = document.querySelectorAll('[data-animate], [data-animate-stagger]');

        animatedElements.forEach(el => {
            animateOnScroll.observe(el);
        });

        // Auto-add animations to common elements
        autoAddAnimations();
    }

    /**
     * Auto-add animations to elements without data attributes
     */
    function autoAddAnimations() {
        // Animate stat cards
        const statCards = document.querySelectorAll('.jobportal-stat-card');
        statCards.forEach((card, index) => {
            if (!card.hasAttribute('data-animate')) {
                card.setAttribute('data-animate', 'fade-up');
                card.style.transitionDelay = (index * 0.1) + 's';
                animateOnScroll.observe(card);
            }
        });

        // Animate job cards
        const jobCards = document.querySelectorAll('.jobportal-job-card');
        jobCards.forEach((card, index) => {
            if (!card.hasAttribute('data-animate')) {
                card.setAttribute('data-animate', 'fade-up');
                card.style.transitionDelay = (index * 0.1) + 's';
                card.classList.add('jobportal-card-3d');
                animateOnScroll.observe(card);
            }
        });

        // Animate application cards
        const appCards = document.querySelectorAll('.jobportal-applications-table');
        appCards.forEach(card => {
            if (!card.hasAttribute('data-animate')) {
                card.setAttribute('data-animate', 'fade-up');
                animateOnScroll.observe(card);
            }
        });
    }

    /**
     * Initialize Card Hover Effects
     */
    function initCardHoverEffects() {
        const cards = document.querySelectorAll('.jobportal-job-card, .jobportal-stat-card');

        cards.forEach(card => {
            // Add tilt effect on mouse move
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = ((y - centerY) / centerY) * 5; // Max 5deg
                const rotateY = ((centerX - x) / centerX) * 5; // Max 5deg

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`;
            });

            // Reset on mouse leave
            card.addEventListener('mouseleave', function() {
                card.style.transform = '';
            });
        });
    }

    /**
     * Initialize Parallax Effect
     */
    function initParallaxEffect() {
        const parallaxElements = document.querySelectorAll('.jobportal-parallax, [data-parallax]');

        if (parallaxElements.length === 0) return;

        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;

            parallaxElements.forEach(el => {
                const speed = el.dataset.parallaxSpeed || 0.5;
                const yPos = -(scrolled * speed);
                el.style.transform = `translateY(${yPos}px)`;
            });
        });
    }

    /**
     * Animated Counter for Numbers
     */
    function initCounterAnimations() {
        const counters = document.querySelectorAll('.jobportal-stat-value, [data-count-up]');

        const counterObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    animateCounter(target);
                    counterObserver.unobserve(target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });
    }

    /**
     * Animate Counter Function
     */
    function animateCounter(element) {
        const text = element.textContent.trim();
        const number = parseFloat(text.replace(/[^0-9.]/g, ''));

        if (isNaN(number)) return;

        const duration = 2000; // 2 seconds
        const frameDuration = 1000 / 60; // 60 FPS
        const totalFrames = Math.round(duration / frameDuration);
        let frame = 0;

        const suffix = text.replace(/[0-9.,]/g, '').trim();
        const hasDecimal = text.includes('.');

        const counter = setInterval(() => {
            frame++;
            const progress = frame / totalFrames;
            const currentNumber = number * progress;

            if (hasDecimal) {
                element.textContent = currentNumber.toFixed(1) + suffix;
            } else {
                element.textContent = Math.round(currentNumber).toLocaleString() + suffix;
            }

            if (frame === totalFrames) {
                clearInterval(counter);
                if (hasDecimal) {
                    element.textContent = number.toFixed(1) + suffix;
                } else {
                    element.textContent = Math.round(number).toLocaleString() + suffix;
                }
            }
        }, frameDuration);
    }

    /**
     * Button Ripple Effect
     */
    function addRippleEffect(button, event) {
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();

        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;

        button.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    }

    // Add ripple to all buttons
    document.addEventListener('click', function(e) {
        const button = e.target.closest('.jobportal-btn, .jobportal-submit-btn, button[type="submit"]');
        if (button && !button.classList.contains('no-ripple')) {
            button.style.position = button.style.position || 'relative';
            button.style.overflow = 'hidden';
            addRippleEffect(button, e);
        }
    });

    // Add ripple animation keyframes
    if (!document.getElementById('ripple-animation')) {
        const style = document.createElement('style');
        style.id = 'ripple-animation';
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

})();
