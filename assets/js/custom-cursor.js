/**
 * Custom Cursor
 * Premium interactive cursor
 *
 * @package JobPortal
 */

(function() {
    'use strict';

    // Only run on desktop
    if (window.matchMedia('(hover: none) and (pointer: coarse)').matches) {
        return;
    }

    let cursor, cursorFollower;
    let mouseX = 0, mouseY = 0;
    let followerX = 0, followerY = 0;

    document.addEventListener('DOMContentLoaded', function() {
        initCustomCursor();
    });

    /**
     * Initialize Custom Cursor
     */
    function initCustomCursor() {
        // Create cursor elements
        cursor = document.createElement('div');
        cursor.className = 'jobportal-cursor';

        cursorFollower = document.createElement('div');
        cursorFollower.className = 'jobportal-cursor-follower';

        document.body.appendChild(cursor);
        document.body.appendChild(cursorFollower);

        // Track mouse movement
        document.addEventListener('mousemove', onMouseMove);

        // Track mouse click
        document.addEventListener('mousedown', onMouseDown);
        document.addEventListener('mouseup', onMouseUp);

        // Track hover states
        trackHoverStates();

        // Animate cursor follower
        requestAnimationFrame(animateCursor);
    }

    /**
     * Mouse Move Handler
     */
    function onMouseMove(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;

        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
    }

    /**
     * Animate Cursor Follower (Smooth trailing)
     */
    function animateCursor() {
        // Smooth follow with easing
        const dx = mouseX - followerX;
        const dy = mouseY - followerY;

        followerX += dx * 0.1;
        followerY += dy * 0.1;

        cursorFollower.style.left = followerX + 'px';
        cursorFollower.style.top = followerY + 'px';

        requestAnimationFrame(animateCursor);
    }

    /**
     * Mouse Down Handler
     */
    function onMouseDown() {
        cursor.classList.add('click');
    }

    /**
     * Mouse Up Handler
     */
    function onMouseUp() {
        cursor.classList.remove('click');
    }

    /**
     * Track Hover States
     */
    function trackHoverStates() {
        // Buttons and links
        const hoverElements = document.querySelectorAll('a, button, .jobportal-btn, input[type="submit"], .jobportal-job-card, .jobportal-stat-card');

        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.classList.add('hover');
                cursorFollower.classList.add('hover');
            });

            el.addEventListener('mouseleave', () => {
                cursor.classList.remove('hover');
                cursorFollower.classList.remove('hover');
            });
        });

        // Text inputs
        const textElements = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], textarea');

        textElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.classList.add('text');
            });

            el.addEventListener('mouseleave', () => {
                cursor.classList.remove('text');
            });
        });

        // Re-observe on DOM changes (for dynamically added elements)
        observeDOMChanges();
    }

    /**
     * Observe DOM Changes
     */
    function observeDOMChanges() {
        const observer = new MutationObserver(() => {
            trackHoverStates();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

})();
