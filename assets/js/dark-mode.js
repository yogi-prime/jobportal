/**
 * Dark Mode Toggle System
 * Premium dark mode with smooth transitions
 *
 * @package JobPortal
 */

(function() {
    'use strict';

    // Check for saved theme preference or default to 'light'
    const currentTheme = localStorage.getItem('jobportal-theme') || 'light';

    // Apply theme on page load
    document.documentElement.setAttribute('data-theme', currentTheme);

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Create dark mode toggle button
        createDarkModeToggle();

        // Initialize theme
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }

        // Listen for toggle clicks
        const toggle = document.getElementById('jobportal-dark-mode-toggle');
        if (toggle) {
            toggle.addEventListener('click', toggleDarkMode);
        }
    });

    /**
     * Create Dark Mode Toggle Button
     */
    function createDarkModeToggle() {
        const header = document.querySelector('.jobportal-header-actions') ||
                      document.querySelector('header .jobportal-container > div:last-child');

        if (!header) return;

        const toggleBtn = document.createElement('button');
        toggleBtn.id = 'jobportal-dark-mode-toggle';
        toggleBtn.className = 'jobportal-dark-mode-toggle';
        toggleBtn.setAttribute('aria-label', 'Toggle Dark Mode');
        toggleBtn.innerHTML = `
            <span class="sun-icon">☀️</span>
            <span class="moon-icon">🌙</span>
        `;

        // Insert before login/register buttons
        const firstChild = header.firstElementChild;
        header.insertBefore(toggleBtn, firstChild);
    }

    /**
     * Toggle Dark Mode
     */
    function toggleDarkMode() {
        const body = document.body;
        const isDark = body.classList.contains('dark-mode');

        if (isDark) {
            // Switch to light mode
            body.classList.remove('dark-mode');
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('jobportal-theme', 'light');
        } else {
            // Switch to dark mode
            body.classList.add('dark-mode');
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('jobportal-theme', 'dark');
        }

        // Add transition class
        body.classList.add('theme-transitioning');
        setTimeout(() => {
            body.classList.remove('theme-transitioning');
        }, 300);
    }

})();
