<?php
/**
 * Career Hub - Professional Cursor Manager
 *
 * 5 Ultra-Creative Cursor Styles for Elite UX
 * Managed from WordPress Admin Panel
 *
 * @package CareerHub
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Cursor Manager to WordPress Admin Menu
 */
function careerhub_cursor_manager_menu() {
    add_theme_page(
        __('Cursor Style Manager', 'jobportal'),
        __('Cursor Styles', 'jobportal'),
        'manage_options',
        'cursor-manager',
        'careerhub_cursor_manager_page'
    );
}
add_action('admin_menu', 'careerhub_cursor_manager_menu');

/**
 * Cursor Manager Admin Page
 */
function careerhub_cursor_manager_page() {
    // Save settings
    if (isset($_POST['cursor_style']) && check_admin_referer('save_cursor_style', 'cursor_nonce')) {
        update_option('careerhub_cursor_style', sanitize_text_field($_POST['cursor_style']));
        echo '<div class="notice notice-success"><p><strong>Cursor style saved successfully!</strong></p></div>';
    }

    $current_style = get_option('careerhub_cursor_style', 'none');
    ?>

    <div class="wrap cursor-manager-wrap">
        <h1>🖱️ Career Hub - Cursor Style Manager</h1>
        <p class="description">Choose your website's cursor style. Preview each style before applying!</p>

        <form method="post" action="">
            <?php wp_nonce_field('save_cursor_style', 'cursor_nonce'); ?>

            <div class="cursor-styles-grid">

                <!-- Style 1: None (Default) -->
                <div class="cursor-style-card">
                    <div class="cursor-preview-area" data-cursor="none">
                        <div class="preview-content">
                            <span class="preview-text">Move your mouse here</span>
                            <button class="preview-btn">Click Me</button>
                        </div>
                    </div>
                    <div class="cursor-info">
                        <h3>
                            <label>
                                <input type="radio" name="cursor_style" value="none" <?php checked($current_style, 'none'); ?>>
                                Default Cursor
                            </label>
                        </h3>
                        <p>Standard browser cursor. Clean and simple.</p>
                        <span class="cursor-badge">Classic</span>
                    </div>
                </div>

                <!-- Style 2: Gradient Ring -->
                <div class="cursor-style-card">
                    <div class="cursor-preview-area" data-cursor="gradient-ring">
                        <div class="preview-content">
                            <span class="preview-text">Move your mouse here</span>
                            <button class="preview-btn">Click Me</button>
                        </div>
                    </div>
                    <div class="cursor-info">
                        <h3>
                            <label>
                                <input type="radio" name="cursor_style" value="gradient-ring" <?php checked($current_style, 'gradient-ring'); ?>>
                                Gradient Ring
                            </label>
                        </h3>
                        <p>Smooth animated ring with Career Hub gradient.</p>
                        <span class="cursor-badge premium">Premium</span>
                    </div>
                </div>

                <!-- Style 3: Neon Trail -->
                <div class="cursor-style-card">
                    <div class="cursor-preview-area" data-cursor="neon-trail">
                        <div class="preview-content">
                            <span class="preview-text">Move your mouse here</span>
                            <button class="preview-btn">Click Me</button>
                        </div>
                    </div>
                    <div class="cursor-info">
                        <h3>
                            <label>
                                <input type="radio" name="cursor_style" value="neon-trail" <?php checked($current_style, 'neon-trail'); ?>>
                                Neon Trail
                            </label>
                        </h3>
                        <p>Futuristic cursor with glowing trail effect.</p>
                        <span class="cursor-badge futuristic">Futuristic</span>
                    </div>
                </div>

                <!-- Style 4: Particle Burst -->
                <div class="cursor-style-card">
                    <div class="cursor-preview-area" data-cursor="particle-burst">
                        <div class="preview-content">
                            <span class="preview-text">Move your mouse here</span>
                            <button class="preview-btn">Click Me</button>
                        </div>
                    </div>
                    <div class="cursor-info">
                        <h3>
                            <label>
                                <input type="radio" name="cursor_style" value="particle-burst" <?php checked($current_style, 'particle-burst'); ?>>
                                Particle Burst
                            </label>
                        </h3>
                        <p>Magical particles burst on click. Interactive!</p>
                        <span class="cursor-badge magical">Magical</span>
                    </div>
                </div>

                <!-- Style 5: Magnetic Dot -->
                <div class="cursor-style-card">
                    <div class="cursor-preview-area" data-cursor="magnetic-dot">
                        <div class="preview-content">
                            <span class="preview-text">Move your mouse here</span>
                            <button class="preview-btn">Click Me</button>
                        </div>
                    </div>
                    <div class="cursor-info">
                        <h3>
                            <label>
                                <input type="radio" name="cursor_style" value="magnetic-dot" <?php checked($current_style, 'magnetic-dot'); ?>>
                                Magnetic Dot
                            </label>
                        </h3>
                        <p>Elegant dot that magnetically attracts to links.</p>
                        <span class="cursor-badge elegant">Elegant</span>
                    </div>
                </div>

            </div>

            <div class="cursor-actions">
                <button type="submit" class="button button-primary button-hero">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save Cursor Style
                </button>
                <p class="description">
                    Current Style: <strong><?php echo ucwords(str_replace('-', ' ', $current_style)); ?></strong>
                </p>
            </div>
        </form>
    </div>

    <style>
    .cursor-manager-wrap {
        max-width: 1400px;
        margin: 20px 20px 20px 0;
    }

    .cursor-manager-wrap h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .cursor-styles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin: 32px 0;
    }

    .cursor-style-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .cursor-style-card:hover {
        border-color: #00B4D8;
        box-shadow: 0 8px 24px rgba(0, 180, 216, 0.15);
        transform: translateY(-4px);
    }

    .cursor-style-card:has(input:checked) {
        border-color: #00B4D8;
        background: linear-gradient(135deg, rgba(0, 180, 216, 0.05), rgba(0, 200, 150, 0.05));
        box-shadow: 0 8px 24px rgba(0, 180, 216, 0.2);
    }

    .cursor-preview-area {
        height: 200px;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    .cursor-preview-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="1" fill="%2300B4D8" opacity="0.1"/></svg>');
        pointer-events: none;
    }

    .preview-content {
        text-align: center;
        z-index: 1;
    }

    .preview-text {
        display: block;
        color: #64748b;
        font-size: 14px;
        margin-bottom: 16px;
        font-weight: 500;
    }

    .preview-btn {
        padding: 10px 24px;
        background: linear-gradient(135deg, #00B4D8, #00C896);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .preview-btn:hover {
        transform: scale(1.05);
    }

    .cursor-info {
        padding: 20px;
    }

    .cursor-info h3 {
        margin: 0 0 8px;
        font-size: 18px;
        color: #1e293b;
    }

    .cursor-info h3 label {
        display: flex;
        align-items: center;
        cursor: pointer;
        gap: 10px;
    }

    .cursor-info input[type="radio"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #00B4D8;
        margin: 0;
        vertical-align: middle;
        position: relative;
        top: -1px;
    }

    .cursor-info p {
        color: #64748b;
        font-size: 14px;
        margin: 8px 0 12px;
        line-height: 1.6;
    }

    .cursor-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #e2e8f0;
        color: #475569;
    }

    .cursor-badge.premium {
        background: linear-gradient(135deg, #00B4D8, #00C896);
        color: white;
    }

    .cursor-badge.futuristic {
        background: linear-gradient(135deg, #00C896, #00B4D8);
        color: white;
    }

    .cursor-badge.magical {
        background: linear-gradient(135deg, #1B3A5F, #00B4D8);
        color: white;
    }

    .cursor-badge.elegant {
        background: linear-gradient(135deg, #00B4D8, #1B3A5F);
        color: white;
    }

    .cursor-actions {
        background: white;
        padding: 24px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        text-align: center;
    }

    .cursor-actions .button-hero {
        font-size: 16px;
        padding: 12px 32px;
        background: linear-gradient(135deg, #00B4D8, #00C896);
        border: none;
        box-shadow: 0 4px 12px rgba(0, 180, 216, 0.3);
    }

    .cursor-actions .button-hero:hover {
        background: linear-gradient(135deg, #0096B8, #00A67D);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 180, 216, 0.4);
    }

    .cursor-actions .description {
        margin-top: 16px;
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cursor-styles-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>

    <script>
    // Advanced preview cursor with dual elements and smart detection
    document.addEventListener('DOMContentLoaded', function() {
        const previewAreas = document.querySelectorAll('.cursor-preview-area');

        previewAreas.forEach(area => {
            const cursorType = area.dataset.cursor;

            if (cursorType !== 'none') {
                area.style.cursor = 'none';

                // Create main cursor
                const cursor = document.createElement('div');
                cursor.className = 'preview-cursor';
                cursor.style.cssText = 'position: absolute; pointer-events: none; z-index: 9999; opacity: 0; transition: all 0.15s ease;';

                // Create follower
                const follower = document.createElement('div');
                follower.className = 'preview-follower';
                follower.style.cssText = 'position: absolute; pointer-events: none; z-index: 9998; opacity: 0; transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);';

                // Style based on cursor type
                if (cursorType === 'gradient-ring') {
                    cursor.style.cssText += 'width: 8px; height: 8px; background: linear-gradient(135deg, #00B4D8, #00C896); border-radius: 50%; transform: translate(-50%, -50%); mix-blend-mode: difference;';
                    follower.style.cssText += 'width: 40px; height: 40px; border: 2px solid transparent; background: linear-gradient(white, white) padding-box, linear-gradient(135deg, #00B4D8, #00C896) border-box; border-radius: 50%; transform: translate(-50%, -50%);';
                } else if (cursorType === 'neon-trail') {
                    cursor.style.cssText += 'width: 24px; height: 24px; background: linear-gradient(135deg, #00B4D8, #00C896); border-radius: 50%; box-shadow: 0 0 20px rgba(0, 180, 216, 0.8); transform: translate(-50%, -50%);';
                    follower.style.cssText += 'width: 100px; height: 100px; background: radial-gradient(circle, rgba(0, 180, 216, 0.2) 0%, transparent 70%); border-radius: 50%; transform: translate(-50%, -50%); filter: blur(15px);';
                } else if (cursorType === 'particle-burst') {
                    cursor.style.cssText += 'width: 20px; height: 20px; background: linear-gradient(135deg, #00B4D8, #00C896); border-radius: 50%; transform: translate(-50%, -50%); box-shadow: 0 4px 12px rgba(0, 180, 216, 0.3);';
                    follower.style.cssText += 'width: 60px; height: 60px; background: radial-gradient(circle, rgba(0, 180, 216, 0.2) 0%, transparent 70%); border-radius: 50%; transform: translate(-50%, -50%);';
                } else if (cursorType === 'magnetic-dot') {
                    cursor.style.cssText += 'width: 10px; height: 10px; background: linear-gradient(135deg, #00B4D8, #00C896); border-radius: 50%; transform: translate(-50%, -50%); box-shadow: 0 2px 8px rgba(0, 180, 216, 0.4);';
                    follower.style.cssText += 'width: 40px; height: 40px; border: 2px solid rgba(0, 180, 216, 0.3); border-radius: 50%; transform: translate(-50%, -50%);';
                }

                area.appendChild(cursor);
                area.appendChild(follower);

                let mouseX = 0, mouseY = 0;
                let cursorX = 0, cursorY = 0;
                let followerX = 0, followerY = 0;
                let animating = false;

                // Smooth animation
                function animate() {
                    cursorX += (mouseX - cursorX) * 0.25;
                    cursorY += (mouseY - cursorY) * 0.25;
                    followerX += (mouseX - followerX) * 0.12;
                    followerY += (mouseY - followerY) * 0.12;

                    cursor.style.left = cursorX + 'px';
                    cursor.style.top = cursorY + 'px';
                    follower.style.left = followerX + 'px';
                    follower.style.top = followerY + 'px';

                    if (animating) {
                        requestAnimationFrame(animate);
                    }
                }

                area.addEventListener('mousemove', (e) => {
                    const rect = area.getBoundingClientRect();
                    mouseX = e.clientX - rect.left;
                    mouseY = e.clientY - rect.top;
                });

                area.addEventListener('mouseenter', () => {
                    cursor.style.opacity = '1';
                    follower.style.opacity = '1';
                    animating = true;
                    animate();
                });

                area.addEventListener('mouseleave', () => {
                    cursor.style.opacity = '0';
                    follower.style.opacity = '0';
                    animating = false;
                });

                // Button hover effect
                const btn = area.querySelector('.preview-btn');
                if (btn) {
                    btn.addEventListener('mouseenter', () => {
                        cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
                        follower.style.width = '60px';
                        follower.style.height = '60px';
                    });
                    btn.addEventListener('mouseleave', () => {
                        cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                        if (cursorType === 'gradient-ring') {
                            follower.style.width = '40px';
                            follower.style.height = '40px';
                        }
                    });
                }
            }
        });
    });
    </script>
    <?php
}

/**
 * Enqueue Cursor Styles on Frontend
 */
function careerhub_enqueue_cursor_styles() {
    $cursor_style = get_option('careerhub_cursor_style', 'none');

    if ($cursor_style !== 'none') {
        wp_add_inline_style('jobportal-style', careerhub_get_cursor_css($cursor_style));
        wp_add_inline_script('jobportal-main', careerhub_get_cursor_js($cursor_style));
    }
}
add_action('wp_enqueue_scripts', 'careerhub_enqueue_cursor_styles', 999);

/**
 * Get CSS for Selected Cursor Style
 */
function careerhub_get_cursor_css($style) {
    $css = "
    * {
        cursor: none !important;
    }

    .custom-cursor {
        position: fixed;
        pointer-events: none;
        z-index: 9999;
    }

    .cursor-follower {
        position: fixed;
        pointer-events: none;
        z-index: 9998;
    }
    ";

    switch ($style) {
        case 'gradient-ring':
            $css .= "
            /* Main Cursor Dot */
            .custom-cursor {
                width: 8px;
                height: 8px;
                background: linear-gradient(135deg, #00B4D8, #00C896);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.15s ease;
                mix-blend-mode: difference;
            }

            /* Follower Ring */
            .cursor-follower {
                width: 40px;
                height: 40px;
                border: 2px solid transparent;
                background: linear-gradient(white, white) padding-box,
                            linear-gradient(135deg, #00B4D8, #00C896) border-box;
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            /* Hover on Links/Buttons */
            .cursor-follower.hover-link {
                width: 60px;
                height: 60px;
                background: linear-gradient(white, white) padding-box,
                            linear-gradient(135deg, #00C896, #00B4D8) border-box;
            }

            /* Hover on Images */
            .cursor-follower.hover-image {
                width: 80px;
                height: 80px;
                border-width: 3px;
                border-radius: 12px;
                mix-blend-mode: exclusion;
            }

            /* Click State */
            .cursor-follower.clicking {
                width: 30px;
                height: 30px;
            }

            .custom-cursor.clicking {
                transform: translate(-50%, -50%) scale(1.5);
            }
            ";
            break;

        case 'neon-trail':
            $css .= "
            /* Main Cursor */
            .custom-cursor {
                width: 24px;
                height: 24px;
                background: linear-gradient(135deg, #00B4D8, #00C896);
                border-radius: 50%;
                box-shadow:
                    0 0 20px rgba(0, 180, 216, 0.8),
                    0 0 40px rgba(0, 200, 150, 0.6),
                    0 0 60px rgba(0, 180, 216, 0.4);
                transform: translate(-50%, -50%);
                transition: all 0.2s ease;
                animation: neonPulse 2s infinite;
            }

            /* Follower Trail */
            .cursor-follower {
                width: 150px;
                height: 150px;
                background: radial-gradient(
                    circle,
                    rgba(0, 180, 216, 0.15) 0%,
                    rgba(0, 200, 150, 0.1) 30%,
                    transparent 70%
                );
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                filter: blur(20px);
            }

            @keyframes neonPulse {
                0%, 100% {
                    box-shadow:
                        0 0 20px rgba(0, 180, 216, 0.8),
                        0 0 40px rgba(0, 200, 150, 0.6);
                }
                50% {
                    box-shadow:
                        0 0 30px rgba(0, 200, 150, 1),
                        0 0 60px rgba(0, 180, 216, 0.8),
                        0 0 80px rgba(0, 200, 150, 0.6);
                }
            }

            /* Hover States */
            .custom-cursor.hover-link {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #00C896, #1B3A5F);
            }

            .cursor-follower.hover-link {
                width: 200px;
                height: 200px;
            }

            .custom-cursor.hover-image {
                border-radius: 8px;
                animation: neonRotate 1s infinite;
            }

            @keyframes neonRotate {
                0%, 100% { transform: translate(-50%, -50%) rotate(0deg); }
                50% { transform: translate(-50%, -50%) rotate(180deg); }
            }
            ";
            break;

        case 'particle-burst':
            $css .= "
            /* Main Cursor */
            .custom-cursor {
                width: 20px;
                height: 20px;
                background: linear-gradient(135deg, #00B4D8, #00C896);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.15s ease;
                box-shadow: 0 4px 12px rgba(0, 180, 216, 0.3);
            }

            /* Follower Glow */
            .cursor-follower {
                width: 60px;
                height: 60px;
                background: radial-gradient(
                    circle,
                    rgba(0, 180, 216, 0.2) 0%,
                    transparent 70%
                );
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.3s ease;
            }

            /* Particles */
            .particle {
                position: fixed;
                width: 6px;
                height: 6px;
                background: linear-gradient(135deg, #00B4D8, #00C896);
                border-radius: 50%;
                pointer-events: none;
                z-index: 9997;
                animation: particleFloat 1s forwards;
            }

            @keyframes particleFloat {
                0% {
                    opacity: 1;
                    transform: translate(0, 0) scale(1);
                }
                100% {
                    opacity: 0;
                    transform: translate(var(--tx), var(--ty)) scale(0);
                }
            }

            /* Hover States */
            .custom-cursor.hover-link {
                width: 30px;
                height: 30px;
                background: linear-gradient(135deg, #1B3A5F, #00B4D8);
            }

            .cursor-follower.hover-link {
                width: 80px;
                height: 80px;
                background: radial-gradient(
                    circle,
                    rgba(0, 200, 150, 0.3) 0%,
                    transparent 70%
                );
            }

            .custom-cursor.hover-image {
                border-radius: 8px;
            }
            ";
            break;

        case 'magnetic-dot':
            $css .= "
            /* Main Cursor */
            .custom-cursor {
                width: 10px;
                height: 10px;
                background: linear-gradient(135deg, #00B4D8, #00C896);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                box-shadow: 0 2px 8px rgba(0, 180, 216, 0.4);
            }

            /* Follower Circle */
            .cursor-follower {
                width: 40px;
                height: 40px;
                border: 2px solid rgba(0, 180, 216, 0.3);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            /* Magnetic Pull to Links */
            .custom-cursor.hover-link {
                width: 50px;
                height: 50px;
                background: linear-gradient(135deg, #00B4D8, #00C896);
                box-shadow: 0 8px 24px rgba(0, 180, 216, 0.6);
            }

            .cursor-follower.hover-link {
                width: 80px;
                height: 80px;
                border-color: rgba(0, 200, 150, 0.6);
                border-width: 3px;
            }

            /* On Buttons */
            .custom-cursor.hover-button {
                width: 60px;
                height: 60px;
                border-radius: 12px;
                background: linear-gradient(135deg, #1B3A5F, #00C896);
            }

            /* On Images */
            .custom-cursor.hover-image {
                width: 80px;
                height: 80px;
                border-radius: 16px;
                background: linear-gradient(135deg, rgba(0, 180, 216, 0.3), rgba(0, 200, 150, 0.3));
                backdrop-filter: blur(10px);
            }

            .cursor-follower.hover-image {
                width: 100px;
                height: 100px;
                border-radius: 16px;
            }
            ";
            break;
    }

    return $css;
}

/**
 * Get JavaScript for Selected Cursor Style
 */
function careerhub_get_cursor_js($style) {
    ob_start();
    ?>

    (function() {
        // Create main cursor and follower
        const cursor = document.createElement('div');
        cursor.className = 'custom-cursor';
        document.body.appendChild(cursor);

        const follower = document.createElement('div');
        follower.className = 'cursor-follower';
        document.body.appendChild(follower);

        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;
        let followerX = 0, followerY = 0;

        // Mouse move tracking
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        // Smooth cursor animation with different speeds
        function animateCursor() {
            // Main cursor follows quickly
            cursorX += (mouseX - cursorX) * 0.25;
            cursorY += (mouseY - cursorY) * 0.25;

            // Follower follows slowly (laggy effect)
            followerX += (mouseX - followerX) * 0.12;
            followerY += (mouseY - followerY) * 0.12;

            cursor.style.left = cursorX + 'px';
            cursor.style.top = cursorY + 'px';

            follower.style.left = followerX + 'px';
            follower.style.top = followerY + 'px';

            requestAnimationFrame(animateCursor);
        }

        animateCursor();

        // Smart element detection
        const interactiveElements = document.querySelectorAll('a, button, input[type="submit"], input[type="button"], .jobportal-btn');
        const images = document.querySelectorAll('img');
        const textElements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span');

        // Hover on Links/Buttons
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.classList.add('hover-link');
                follower.classList.add('hover-link');

                // Special for buttons
                if (el.tagName === 'BUTTON' || el.classList.contains('jobportal-btn')) {
                    cursor.classList.add('hover-button');
                }
            });

            el.addEventListener('mouseleave', () => {
                cursor.classList.remove('hover-link', 'hover-button');
                follower.classList.remove('hover-link');
            });
        });

        // Hover on Images
        images.forEach(img => {
            img.addEventListener('mouseenter', () => {
                cursor.classList.add('hover-image');
                follower.classList.add('hover-image');
            });

            img.addEventListener('mouseleave', () => {
                cursor.classList.remove('hover-image');
                follower.classList.remove('hover-image');
            });
        });

        // Click effects
        document.addEventListener('mousedown', () => {
            cursor.classList.add('clicking');
            follower.classList.add('clicking');
        });

        document.addEventListener('mouseup', () => {
            cursor.classList.remove('clicking');
            follower.classList.remove('clicking');
        });

        <?php if ($style === 'particle-burst'): ?>
        // Particle Burst - Enhanced particles on click
        document.addEventListener('click', (e) => {
            const particleCount = 12; // More particles
            const colors = ['#00B4D8', '#00C896', '#1B3A5F'];

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const angle = (Math.PI * 2 * i) / particleCount;
                const distance = 60 + Math.random() * 40;
                const color = colors[Math.floor(Math.random() * colors.length)];

                particle.style.background = color;
                particle.style.setProperty('--tx', Math.cos(angle) * distance + 'px');
                particle.style.setProperty('--ty', Math.sin(angle) * distance + 'px');
                particle.style.left = e.clientX + 'px';
                particle.style.top = e.clientY + 'px';

                document.body.appendChild(particle);
                setTimeout(() => particle.remove(), 1000);
            }
        });
        <?php endif; ?>

        <?php if ($style === 'magnetic-dot'): ?>
        // Magnetic attraction effect
        interactiveElements.forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const elCenterX = rect.left + rect.width / 2;
                const elCenterY = rect.top + rect.height / 2;

                // Pull cursor towards element center
                const pullStrength = 0.3;
                mouseX += (elCenterX - mouseX) * pullStrength * 0.1;
                mouseY += (elCenterY - mouseY) * pullStrength * 0.1;
            });
        });
        <?php endif; ?>

        // Hide cursor when mouse leaves window
        document.addEventListener('mouseleave', () => {
            cursor.style.opacity = '0';
            follower.style.opacity = '0';
        });

        document.addEventListener('mouseenter', () => {
            cursor.style.opacity = '1';
            follower.style.opacity = '1';
        });

        // Performance: Pause animation when tab is hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                cursor.style.display = 'none';
                follower.style.display = 'none';
            } else {
                cursor.style.display = 'block';
                follower.style.display = 'block';
            }
        });
    })();

    <?php
    return ob_get_clean();
}
