# JobPortal Elite - Usage Guide

Welcome to **JobPortal Elite**, a premium WordPress job board theme with 5 unique elite features!

## 📋 Table of Contents

1. [Installation](#installation)
2. [Theme Setup](#theme-setup)
3. [Elite Features Setup](#elite-features-setup)
4. [Creating Pages](#creating-pages)
5. [Customization](#customization)
6. [Troubleshooting](#troubleshooting)

---

## 📦 Installation

### Step 1: Upload the Theme

1. Download the `jobportal` theme folder
2. ZIP the folder: Right-click → "Compress to ZIP" (or use any compression tool)
3. Go to WordPress Admin → Appearance → Themes
4. Click "Add New" → "Upload Theme"
5. Choose the ZIP file and click "Install Now"
6. Click "Activate" when installation is complete

### Step 2: Install Required Plugins (Optional but Recommended)

- **Elementor** - For advanced page building
- **Contact Form 7** - For contact forms
- **Yoast SEO** - For SEO optimization

---

## 🎨 Theme Setup

### 1. Homepage Setup

The theme automatically displays a job portal homepage when activated.

**What's Included:**
- Hero section with job search form
- Job statistics (jobs, companies, seekers)
- Featured jobs display
- Elite tools showcase
- Call-to-action section

**No additional setup required!** The homepage works out of the box with sample data.

### 2. Menu Setup

1. Go to **Appearance → Menus**
2. Create a new menu (e.g., "Main Menu")
3. Add pages:
   - Home
   - Browse Jobs
   - Resume Builder
   - Job Matcher
   - Salary Calculator
   - For Employers
   - Blog
   - Contact
4. Assign to "Primary Menu" location
5. Save Menu

### 3. Important Pages to Create

Create these pages for full functionality:

#### Jobs Page (Browse All Jobs)
- Create a new page titled "Jobs" or "Browse Jobs"
- The theme will automatically use `archive-job.php` template for job listings
- **URL:** `yoursite.com/jobs`

---

## ⭐ Elite Features Setup

JobPortal Elite includes **5 UNIQUE features** that competitors don't have. Here's how to set them up:

### 1. 📄 Resume Builder (Drag & Drop with Live Preview)

**Create the Page:**
1. Go to **Pages → Add New**
2. Title: "Resume Builder"
3. In the right sidebar, under **Template**, select: **Resume Builder**
4. Publish the page

**What It Does:**
- Drag-and-drop interface for building resumes
- Live preview as users type
- Multiple professional templates
- Export to PDF functionality

**Shortcode:** `[jobportal_resume_builder]`

---

### 2. 🎯 Job Matcher (AI-Powered Algorithm)

**Create the Page:**
1. Go to **Pages → Add New**
2. Title: "Find Your Match"
3. Template: **Job Matcher**
4. Publish

**What It Does:**
- 4-question personality quiz
- AI-powered job recommendations
- Personalized results based on skills, interests, and experience
- Displays matching jobs with compatibility scores

**Shortcode:** `[jobportal_job_matcher]`

---

### 3. 💰 Salary Calculator (Industry Data + Negotiation Tips)

**Create the Page:**
1. Go to **Pages → Add New**
2. Title: "Salary Calculator"
3. Template: **Salary Calculator**
4. Publish

**What It Does:**
- Calculate market value based on role, experience, location
- Industry benchmarks and salary ranges
- Negotiation tips and insights
- Skills impact analysis

**Shortcode:** `[jobportal_salary_calculator]`

---

### 4. 📊 ATS Dashboard (Applicant Tracking System for Employers)

**Create the Page:**
1. Go to **Pages → Add New**
2. Title: "Employer Dashboard"
3. Template: **ATS Dashboard**
4. Publish

**What It Does:**
- Track all job applications in one dashboard
- Filter by status (New, Reviewing, Shortlisted, Rejected)
- View applicant profiles and resumes
- Manage job postings
- Analytics and insights

**Shortcode:** `[jobportal_ats_dashboard]`

---

### 5. 📅 Interview Scheduler (Calendar Integration)

**Create the Page:**
1. Go to **Pages → Add New**
2. Title: "Schedule Interview"
3. Template: **Interview Scheduler**
4. Publish

**What It Does:**
- Calendar view of available interview slots
- Timezone detection and conversion
- Automatic email confirmations
- Reschedule functionality
- Google Calendar integration support

**Shortcode:** `[jobportal_interview_scheduler]`

---

## 📄 Creating Pages

### Job Listings Page (Archive)

The `archive-job.php` template displays all jobs with:
- Search and filter functionality
- Job cards with company, location, salary, type
- Pagination
- 8 sample jobs (replace with real job posts)

**To add real jobs:** Create posts in the "Jobs" custom post type (if installed via plugin)

### Single Job Page

The `single-job.php` template shows individual job details with:
- Job description
- Requirements and responsibilities
- Benefits and perks
- Company information
- Similar jobs section
- Apply button

### Blog Pages

Blog styling is automatically applied to:
- Blog archive (`index.php`, `archive.php`)
- Single blog posts (`single.php`)
- Categories and tags

**Features:**
- Blue gradient header matching job portal theme
- Grid layout for blog posts
- Post categories with color badges
- Reading time estimate
- Social share buttons
- Post navigation (previous/next)
- Sidebar widgets

---

## 🎨 Customization

### Customize Colors

1. Go to **Appearance → Customize**
2. Navigate to **Colors**
3. Change primary color (default: #4facfe - blue)
4. Change secondary colors

### Customize Logo

1. Go to **Appearance → Customize**
2. Navigate to **Site Identity**
3. Upload your logo
4. Set site title and tagline

### Customize Homepage

Edit `front-page.php` to change:
- Hero section text
- Job statistics
- Featured jobs
- Elite tools showcase
- Call-to-action text

### Customize Job Listings

Edit `archive-job.php` to:
- Change sample jobs array (lines 48-57)
- Modify job card layout
- Adjust search filters
- Update pagination

### Customize Single Job Template

Edit `single-job.php` to:
- Modify job details sections
- Change benefits display
- Update company info sidebar
- Adjust similar jobs section

---

## 🔧 Troubleshooting

### Issue: Homepage Not Showing

**Solution:**
1. Go to **Settings → Reading**
2. Set "Your homepage displays" to "Your latest posts"
3. WordPress will automatically use `front-page.php`

### Issue: Job Pages Not Found (404)

**Solution:**
1. Go to **Settings → Permalinks**
2. Click "Save Changes" (even without changing anything)
3. This flushes the permalink cache
4. Try accessing the job pages again

### Issue: Elite Features Not Displaying

**Solution:**
1. Make sure you created the pages with the correct **Template** selected
2. Check that the shortcodes are present in the page content
3. Clear browser cache and WordPress cache

### Issue: Blog Styling Not Applied

**Solution:**
1. Make sure `blog-jobportal.css` is in `assets/css/` folder
2. Check that it's enqueued in `functions.php` (line 181-187)
3. Clear browser cache
4. Regenerate CSS in **Appearance → Customize**

### Issue: Buttons Not Working

**Solution:**
The current theme uses sample data. To make buttons functional:
1. Create actual job posts (custom post type)
2. Update URLs in templates to point to real pages
3. Add JavaScript for interactive features (save job, apply modal, etc.)

---

## 📚 Additional Resources

### File Structure

```
jobportal/
├── front-page.php              # Homepage
├── archive-job.php             # Job listings archive
├── single-job.php              # Single job detail page
├── page-resume-builder.php     # Resume Builder template
├── page-job-matcher.php        # Job Matcher template
├── page-salary-calculator.php  # Salary Calculator template
├── page-ats-dashboard.php      # ATS Dashboard template
├── page-interview-scheduler.php # Interview Scheduler template
├── index.php                   # Blog archive
├── single.php                  # Single blog post
├── archive.php                 # Category/tag archives
├── header.php                  # Header template
├── footer.php                  # Footer template
├── functions.php               # Theme functions
├── style.css                   # Main stylesheet
├── assets/
│   └── css/
│       ├── main.css           # Additional styles
│       └── blog-jobportal.css # Blog-specific styles
├── inc/
│   ├── unique-features/
│   │   ├── resume-builder.php
│   │   ├── job-matching.php
│   │   ├── ats-dashboard.php
│   │   ├── salary-calculator.php
│   │   └── interview-scheduler.php
│   ├── theme-setup.php
│   ├── customizer.php
│   └── admin-panel.php
└── template-parts/
    └── content.php            # Blog post content template
```

### Shortcodes Reference

```
[jobportal_resume_builder]
[jobportal_job_matcher]
[jobportal_salary_calculator]
[jobportal_ats_dashboard]
[jobportal_interview_scheduler]
```

### CSS Variables (Design Tokens)

The theme uses CSS custom properties for easy customization:

```css
--jobportal-primary: #4facfe;          /* Primary blue */
--jobportal-secondary: #43e97b;        /* Secondary green */
--jobportal-gray-800: #1e293b;         /* Dark text */
--jobportal-gray-500: #64748b;         /* Muted text */
```

Edit these in `style.css` (lines 50+) to change the entire theme's color scheme.

---

## 🚀 Going Live Checklist

Before launching your job portal:

- [ ] Replace sample jobs with real job postings
- [ ] Update company logos and images
- [ ] Set up contact forms
- [ ] Configure email notifications
- [ ] Test all elite features
- [ ] Add privacy policy and terms of service
- [ ] Set up Google Analytics
- [ ] Configure SEO settings
- [ ] Test on mobile devices
- [ ] Set up SSL certificate
- [ ] Create necessary pages (About, Contact, etc.)
- [ ] Test job search functionality
- [ ] Test apply button functionality

---

## 💡 Pro Tips

1. **Use Real Data:** The theme ships with sample data. Replace it with real jobs, companies, and content for best results.

2. **Test Elite Features:** All 5 elite features are functional with frontend UI. Test them thoroughly before going live.

3. **Mobile Responsive:** The theme is mobile-responsive. Test on various devices to ensure perfect display.

4. **Performance:** The theme uses inline styles for demo purposes. For production, consider moving inline styles to CSS files for better performance.

5. **Customize Gradients:** The blue gradient (`#4facfe` to `#00f2fe`) is used throughout. You can change this in CSS variables for consistent branding.

6. **Blog Content:** Add quality blog content about job search tips, career advice, and industry news to attract more visitors.

---

## 📞 Support

If you encounter any issues:

1. Check this guide first
2. Review the code comments in template files
3. Check WordPress error logs
4. Ensure you're using WordPress 6.0+ and PHP 7.4+

---

## 🎉 You're All Set!

Your JobPortal Elite theme is now ready to help job seekers find their dream jobs and employers find top talent!

**Key Features Recap:**
- ✅ Professional job portal homepage
- ✅ Job listings with search & filters
- ✅ Single job detail pages
- ✅ 5 Elite features (Resume Builder, Job Matcher, ATS, Salary Calculator, Interview Scheduler)
- ✅ Beautiful blog styling
- ✅ Mobile responsive
- ✅ SEO optimized

**Start building your job portal empire today!** 🚀
