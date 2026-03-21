</main>

<?php if (get_theme_mod('jobportal_cta_enable', true) && is_front_page()) : ?>
<section class="jobportal-cta-section" data-aos="fade-up">
    <div class="jobportal-container">
        <div class="jobportal-cta-wrapper">
            <div class="jobportal-cta-content">
                <h2 class="jobportal-cta-title">
                    <?php echo esc_html(get_theme_mod('jobportal_cta_title', __('Ready to Get Started?', 'jobportal'))); ?>
                </h2>
                <p class="jobportal-cta-text">
                    <?php echo esc_html(get_theme_mod('jobportal_cta_text', __('Join thousands of satisfied customers today.', 'jobportal'))); ?>
                </p>
            </div>
            <div class="jobportal-cta-actions">
                <?php
                $cta_btn_text = get_theme_mod('jobportal_cta_button_text', __('Start Your Free Trial', 'jobportal'));
                $cta_btn_url = get_theme_mod('jobportal_cta_button_url', '#');
                ?>
                <a href="<?php echo esc_url($cta_btn_url); ?>" class="jobportal-btn jobportal-btn-white jobportal-btn-lg">
                    <?php echo esc_html($cta_btn_text); ?>
                    <?php jobportal_icon('arrow-right', 20); ?>
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<footer id="colophon" class="jobportal-footer-modern">
    <!-- Main Footer -->
    <div class="jobportal-footer-main" style="background: linear-gradient(135deg, #1B3A5F 0%, #0f172a 100%); padding: 80px 0 40px; position: relative; overflow: hidden;">
        <!-- Background Pattern -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.03; background-image: radial-gradient(circle at 25px 25px, white 2%, transparent 0%), radial-gradient(circle at 75px 75px, white 2%, transparent 0%); background-size: 100px 100px; pointer-events: none;"></div>

        <div class="jobportal-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 1;">

            <!-- Footer Grid -->
            <div style="display: grid; grid-template-columns: 1.8fr 1fr 1fr 1fr 1.2fr; gap: 50px; margin-bottom: 60px;">

                <!-- Brand Column -->
                <div class="jobportal-footer-brand">
                    <div class="footer-logo" style="margin-bottom: 28px;">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-vertical.png'); ?>" alt="Career Hub" style="height: 140px; width: auto;">
                    </div>

                    <p style="color: #94a3b8; line-height: 1.8; margin-bottom: 28px; font-size: 15px; max-width: 340px;">
                        Your trusted career partner connecting talented professionals with amazing opportunities worldwide.
                    </p>

                    <!-- Social Links -->
                    <div class="footer-social" style="display: flex; gap: 12px; margin-bottom: 28px;">
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; backdrop-filter: blur(10px);" onmouseover="this.style.background='linear-gradient(135deg, #00B4D8, #00C896)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; backdrop-filter: blur(10px);" onmouseover="this.style.background='linear-gradient(135deg, #00B4D8, #00C896)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; backdrop-filter: blur(10px);" onmouseover="this.style.background='linear-gradient(135deg, #00B4D8, #00C896)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; backdrop-filter: blur(10px);" onmouseover="this.style.background='linear-gradient(135deg, #00B4D8, #00C896)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div style="display: flex; gap: 24px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                        <div>
                            <div style="font-size: 24px; font-weight: 800; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">2.5M+</div>
                            <div style="font-size: 12px; color: #64748b;">Jobs</div>
                        </div>
                        <div>
                            <div style="font-size: 24px; font-weight: 800; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">50K+</div>
                            <div style="font-size: 12px; color: #64748b;">Companies</div>
                        </div>
                    </div>
                </div>

                <!-- Job Seekers Links -->
                <div class="jobportal-footer-links">
                    <h4 style="font-size: 14px; font-weight: 700; color: white; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">For Job Seekers</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/jobs'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Browse Jobs</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/resume-builder'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Resume Builder</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/job-matcher'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Job Matcher</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/salary-calculator'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Salary Calculator</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/interview-scheduler'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Interview Scheduler</a></li>
                    </ul>
                </div>

                <!-- Employers Links -->
                <div class="jobportal-footer-links">
                    <h4 style="font-size: 14px; font-weight: 700; color: white; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">For Employers</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/companies'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Companies</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/pricing'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Pricing Plans</a></li>
                    </ul>
                </div>

                <!-- Company Links -->
                <div class="jobportal-footer-links">
                    <h4 style="font-size: 14px; font-weight: 700; color: white; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">Company</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/about'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">About Us</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/contact'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Contact Us</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/blog'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Blog</a></li>
                        <li style="margin-bottom: 14px;"><a href="<?php echo home_url('/sitemap'); ?>" style="color: #94a3b8; text-decoration: none; font-size: 15px; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#00B4D8'; this.style.paddingLeft='8px'" onmouseout="this.style.color='#94a3b8'; this.style.paddingLeft='0'">Sitemap</a></li>
                    </ul>
                </div>

                <!-- Newsletter Column -->
                <div class="jobportal-footer-newsletter">
                    <h4 style="font-size: 14px; font-weight: 700; color: white; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.5px;">Stay Updated</h4>
                    <p style="color: #94a3b8; font-size: 14px; margin-bottom: 16px; line-height: 1.7;">
                        Get latest job alerts in your inbox.
                    </p>
                    <form style="margin-bottom: 0;">
                        <input type="email" placeholder="your@email.com" style="width: 100%; padding: 12px 16px; border: 2px solid rgba(255, 255, 255, 0.1); background: rgba(255, 255, 255, 0.05); border-radius: 8px; font-size: 14px; margin-bottom: 10px; outline: none; transition: all 0.3s; color: white;" onfocus="this.style.borderColor='#00B4D8'; this.style.background='rgba(255, 255, 255, 0.08)'" onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(255, 255, 255, 0.05)'">
                        <button type="submit" style="width: 100%; padding: 12px 16px; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(0, 180, 216, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="jobportal-footer-bottom" style="background: #020617; padding: 24px 0; border-top: 1px solid rgba(255, 255, 255, 0.05);">
        <div class="jobportal-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <!-- Copyright -->
                <div style="color: #64748b; font-size: 14px;">
                    © <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. All rights reserved.
                    <span style="margin: 0 12px; opacity: 0.4;">|</span>
                    Designed by <a href="http://codaiman.com/" target="_blank" rel="noopener noreferrer" style="color: #00B4D8; font-weight: 600; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#00C896'" onmouseout="this.style.color='#00B4D8'">Codaiman</a>
                </div>

                <!-- Legal Links -->
                <nav style="display: flex; gap: 24px; flex-wrap: wrap;">
                    <a href="<?php echo home_url('/privacy'); ?>" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#00B4D8'" onmouseout="this.style.color='#64748b'">Privacy</a>
                    <a href="<?php echo home_url('/terms'); ?>" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#00B4D8'" onmouseout="this.style.color='#64748b'">Terms</a>
                    <a href="<?php echo home_url('/cookie-policy'); ?>" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#00B4D8'" onmouseout="this.style.color='#64748b'">Cookie Policy</a>
                    <a href="<?php echo home_url('/accessibility'); ?>" style="color: #64748b; text-decoration: none; font-size: 14px; transition: color 0.3s;" onmouseover="this.style.color='#00B4D8'" onmouseout="this.style.color='#64748b'">Accessibility</a>
                </nav>
            </div>
        </div>
    </div>
</footer>

<!-- Responsive Footer Styles -->
<style>
/* Tablet (max-width: 1023px) */
@media (max-width: 1023px) {
    .jobportal-footer-main > div > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr 1fr !important;
        gap: 40px !important;
    }

    .jobportal-footer-brand {
        grid-column: 1 / -1 !important;
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
    }

    .jobportal-footer-newsletter {
        grid-column: 1 / -1 !important;
        max-width: 400px;
        margin: 0 auto;
    }

    .footer-social {
        justify-content: center !important;
    }

    .jobportal-footer-brand > div[style*="display: flex"] {
        justify-content: center !important;
    }
}

/* Mobile (max-width: 767px) */
@media (max-width: 767px) {
    .jobportal-footer-main {
        padding: 50px 0 30px !important;
    }

    .jobportal-footer-main > div > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 40px !important;
        margin-bottom: 40px !important;
    }

    .jobportal-footer-brand {
        text-align: center;
    }

    .jobportal-footer-links {
        text-align: center;
    }

    .jobportal-footer-links h4 {
        justify-content: center !important;
    }

    .jobportal-footer-newsletter {
        text-align: center;
    }

    .jobportal-footer-newsletter h4 {
        justify-content: center !important;
    }

    .footer-social {
        justify-content: center !important;
    }

    .jobportal-footer-brand > div[style*="display: flex"] {
        justify-content: center !important;
    }

    .jobportal-footer-bottom > div > div {
        flex-direction: column !important;
        text-align: center;
        gap: 16px !important;
    }

    .jobportal-footer-bottom nav {
        justify-content: center !important;
        flex-direction: column;
        gap: 12px !important;
    }
}
</style>

<?php
// Include Job Application Modal
get_template_part('template-parts/job-application-modal');
?>

<?php wp_footer(); ?>

</body>
</html>
