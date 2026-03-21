<?php
/**
 * Single Job Template - Individual Job Details Page
 *
 * Displays detailed information for a single job posting
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

get_header();
?>

<div class="jobportal-single-job">

<!-- Job Header -->
<section style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 60px 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: start; gap: 24px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <h1 style="font-size: 42px; margin-bottom: 12px;">Senior Frontend Developer</h1>
                <div style="font-size: 20px; opacity: 0.95; margin-bottom: 16px;">TechCorp Inc.</div>
                <div style="display: flex; gap: 20px; flex-wrap: wrap; font-size: 16px;">
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('map-pin', 18); ?> San Francisco, CA</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('briefcase', 18); ?> Full-Time</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('dollar-sign', 18); ?> $120K - $160K</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('clock', 18); ?> Posted 2 days ago</span>
                </div>
            </div>
            <div style="display: flex; gap: 12px; align-items: center;">
                <button style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border: 2px solid white; border-radius: 10px; color: white; font-size: 20px; cursor: pointer;">♡</button>
                <button style="padding: 16px 40px; background: white; color: #4facfe; border: none; border-radius: 10px; font-size: 18px; font-weight: 700; cursor: pointer;">Apply Now</button>
            </div>
        </div>
    </div>
</section>

<!-- Job Content -->
<section style="padding: 60px 20px;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">

        <!-- Main Content -->
        <div>
            <!-- Job Description -->
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; border: 2px solid #e2e8f0;">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b;">Job Description</h2>
                <div style="color: #475569; line-height: 1.8; font-size: 16px;">
                    <p>We're looking for a talented Senior Frontend Developer to join our growing team. You'll be responsible for building beautiful, responsive user interfaces using modern web technologies.</p>
                    <p style="margin-top: 16px;">As a key member of our engineering team, you'll work closely with designers, product managers, and backend engineers to deliver exceptional user experiences.</p>
                </div>
            </div>

            <!-- Responsibilities -->
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; border: 2px solid #e2e8f0;">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b;">Key Responsibilities</h2>
                <ul style="color: #475569; line-height: 2; font-size: 16px; padding-left: 24px;">
                    <li>Build reusable, scalable UI components using React</li>
                    <li>Collaborate with UX/UI designers to implement pixel-perfect designs</li>
                    <li>Optimize applications for maximum speed and scalability</li>
                    <li>Write clean, maintainable, and well-documented code</li>
                    <li>Participate in code reviews and mentor junior developers</li>
                    <li>Stay up-to-date with emerging frontend technologies</li>
                </ul>
            </div>

            <!-- Requirements -->
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; border: 2px solid #e2e8f0;">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b;">Requirements</h2>
                <ul style="color: #475569; line-height: 2; font-size: 16px; padding-left: 24px;">
                    <li>5+ years of experience in frontend development</li>
                    <li>Expert knowledge of React, TypeScript, and modern CSS</li>
                    <li>Strong understanding of responsive design principles</li>
                    <li>Experience with state management (Redux, Context API)</li>
                    <li>Proficiency with build tools (Webpack, Vite)</li>
                    <li>Excellent problem-solving and communication skills</li>
                    <li>Bachelor's degree in Computer Science or equivalent experience</li>
                </ul>
            </div>

            <!-- Nice to Have -->
            <div style="background: white; padding: 40px; border-radius: 12px; margin-bottom: 24px; border: 2px solid #e2e8f0;">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b;">Nice to Have</h2>
                <ul style="color: #475569; line-height: 2; font-size: 16px; padding-left: 24px;">
                    <li>Experience with Next.js or other SSR frameworks</li>
                    <li>Knowledge of testing frameworks (Jest, React Testing Library)</li>
                    <li>Familiarity with GraphQL</li>
                    <li>Contributions to open-source projects</li>
                    <li>Experience with design systems</li>
                </ul>
            </div>

            <!-- Benefits -->
            <div style="background: white; padding: 40px; border-radius: 12px; border: 2px solid #e2e8f0;">
                <h2 style="font-size: 28px; margin-bottom: 20px; color: #1e293b;">Benefits & Perks</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                    <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                        <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;"><?php echo jobportal_get_icon('heart', 24); ?></div>
                        <div style="font-weight: 600; color: #1e293b;">Health Insurance</div>
                        <div style="font-size: 14px; color: #64748b;">Medical, Dental, Vision</div>
                    </div>
                    <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                        <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;"><?php echo jobportal_get_icon('home', 24); ?></div>
                        <div style="font-weight: 600; color: #1e293b;">Remote Work</div>
                        <div style="font-size: 14px; color: #64748b;">Work from anywhere</div>
                    </div>
                    <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                        <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;"><?php echo jobportal_get_icon('book', 24); ?></div>
                        <div style="font-weight: 600; color: #1e293b;">Learning Budget</div>
                        <div style="font-size: 14px; color: #64748b;">$2,000/year for courses</div>
                    </div>
                    <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                        <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;"><?php echo jobportal_get_icon('sun', 24); ?></div>
                        <div style="font-weight: 600; color: #1e293b;">Unlimited PTO</div>
                        <div style="font-size: 14px; color: #64748b;">Take time when you need</div>
                    </div>
                    <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                        <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;"><?php echo jobportal_get_icon('dollar-sign', 24); ?></div>
                        <div style="font-weight: 600; color: #1e293b;">401(k) Match</div>
                        <div style="font-size: 14px; color: #64748b;">Up to 5% matching</div>
                    </div>
                    <div style="padding: 16px; background: #f8fafc; border-radius: 8px;">
                        <div style="color: #4facfe; margin-bottom: 8px; display: flex; justify-content: flex-start;"><?php echo jobportal_get_icon('gamepad', 24); ?></div>
                        <div style="font-weight: 600; color: #1e293b;">Team Events</div>
                        <div style="font-size: 14px; color: #64748b;">Quarterly offsites</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Apply Card -->
            <div style="background: white; padding: 32px; border-radius: 12px; margin-bottom: 24px; border: 2px solid #e2e8f0; position: sticky; top: 20px;">
                <h3 style="font-size: 22px; margin-bottom: 20px; color: #1e293b;">Apply for this Job</h3>
                <button style="width: 100%; padding: 16px; background: #4facfe; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; margin-bottom: 12px;">Apply Now</button>
                <button style="width: 100%; padding: 16px; background: #f8fafc; color: #1e293b; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;">Save for Later</button>

                <div style="margin-top: 24px; padding-top: 24px; border-top: 2px solid #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; margin-bottom: 8px;">Share this job:</div>
                    <div style="display: flex; gap: 8px;">
                        <button style="flex: 1; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b;"><?php echo jobportal_get_icon('link', 18); ?></button>
                        <button style="flex: 1; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b;"><?php echo jobportal_get_icon('mail', 18); ?></button>
                        <button style="flex: 1; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b;"><?php echo jobportal_get_icon('smartphone', 18); ?></button>
                    </div>
                </div>
            </div>

            <!-- Company Info -->
            <div style="background: white; padding: 32px; border-radius: 12px; border: 2px solid #e2e8f0;">
                <h3 style="font-size: 22px; margin-bottom: 20px; color: #1e293b;">About TechCorp Inc.</h3>
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; color: white;">TC</div>
                <p style="color: #475569; line-height: 1.7; font-size: 15px; margin-bottom: 16px;">TechCorp is a leading technology company building innovative solutions for modern businesses. We're passionate about creating products that make a difference.</p>
                <div style="font-size: 14px; color: #64748b; line-height: 2;">
                    <div style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('building', 16); ?> <strong>Industry:</strong> Technology</div>
                    <div style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('users', 16); ?> <strong>Company Size:</strong> 500-1000</div>
                    <div style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('map-pin', 16); ?> <strong>HQ:</strong> San Francisco, CA</div>
                    <div style="display: flex; align-items: center; gap: 8px;"><?php echo jobportal_get_icon('globe', 16); ?> <strong>Website:</strong> <a href="#" style="color: #4facfe;">techcorp.com</a></div>
                </div>
                <a href="#" style="display: block; margin-top: 20px; padding: 12px; text-align: center; background: #f8fafc; color: #1e293b; text-decoration: none; border-radius: 8px; font-weight: 600; border: 1px solid #e2e8f0;">View All Jobs</a>
            </div>
        </div>

    </div>
</section>

<!-- Similar Jobs -->
<section style="padding: 60px 20px; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 32px; margin-bottom: 32px; text-align: center;">Similar Jobs</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px;">

            <div style="background: white; padding: 28px; border-radius: 12px; border: 2px solid #e2e8f0;">
                <h3 style="font-size: 20px; margin-bottom: 8px;"><a href="#" style="color: #1e293b; text-decoration: none;">React Developer</a></h3>
                <div style="color: #64748b; margin-bottom: 12px;">WebCorp</div>
                <div style="font-size: 14px; color: #64748b; margin-bottom: 16px; display: flex; align-items: center; gap: 16px;">
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('map-pin', 14); ?> Remote</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('dollar-sign', 14); ?> $100K - $140K</span>
                </div>
                <a href="#" style="display: inline-block; padding: 10px 24px; background: #4facfe; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">View Job</a>
            </div>

            <div style="background: white; padding: 28px; border-radius: 12px; border: 2px solid #e2e8f0;">
                <h3 style="font-size: 20px; margin-bottom: 8px;"><a href="#" style="color: #1e293b; text-decoration: none;">UI/UX Engineer</a></h3>
                <div style="color: #64748b; margin-bottom: 12px;">DesignLabs</div>
                <div style="font-size: 14px; color: #64748b; margin-bottom: 16px; display: flex; align-items: center; gap: 16px;">
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('map-pin', 14); ?> New York, NY</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('dollar-sign', 14); ?> $110K - $150K</span>
                </div>
                <a href="#" style="display: inline-block; padding: 10px 24px; background: #4facfe; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">View Job</a>
            </div>

            <div style="background: white; padding: 28px; border-radius: 12px; border: 2px solid #e2e8f0;">
                <h3 style="font-size: 20px; margin-bottom: 8px;"><a href="#" style="color: #1e293b; text-decoration: none;">Lead Frontend Engineer</a></h3>
                <div style="color: #64748b; margin-bottom: 12px;">StartupHub</div>
                <div style="font-size: 14px; color: #64748b; margin-bottom: 16px; display: flex; align-items: center; gap: 16px;">
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('map-pin', 14); ?> Austin, TX</span>
                    <span style="display: flex; align-items: center; gap: 6px;"><?php echo jobportal_get_icon('dollar-sign', 14); ?> $130K - $170K</span>
                </div>
                <a href="#" style="display: inline-block; padding: 10px 24px; background: #4facfe; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">View Job</a>
            </div>

        </div>
    </div>
</section>

</div>

<?php get_footer(); ?>
