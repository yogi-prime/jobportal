# JobPortal - Troubleshooting Guide

## 🔧 Common Issues and Solutions

---

## ❌ Issue: "Page Not Found" (404 Errors)

### Symptoms:
- `/jobs` - Page not found
- `/resume-builder` - Page not found
- `/job-matcher` - Page not found
- `/salary-calculator` - Page not found
- `/post-job` - Page not found
- `/ats-dashboard` - Page not found

### Why This Happens:
The theme creates pages automatically when activated, but if:
1. You activated the theme BEFORE this update
2. Pages got deleted accidentally
3. Theme wasn't properly activated

Then these pages don't exist yet.

---

## ✅ Solution 1: Reactivate the Theme (EASIEST)

This will automatically create all missing pages.

**Steps:**
1. Go to **WordPress Admin → Appearance → Themes**
2. Activate any OTHER theme (like Twenty Twenty-Four)
3. Then activate **JobPortal Elite** again
4. All pages will be created automatically!

**Pages That Will Be Created:**
- ✅ Resume Builder (`/resume-builder`)
- ✅ Job Matcher (`/job-matcher`)
- ✅ Salary Calculator (`/salary-calculator`)
- ✅ Interview Scheduler (`/interview-scheduler`)
- ✅ Employer Dashboard (`/ats-dashboard`)
- ✅ Browse Jobs (`/jobs`)
- ✅ Post a Job (`/post-job`)
- ✅ Blog (`/blog`)
- ✅ About Us (`/about`)
- ✅ Contact (`/contact`)

---

## ✅ Solution 2: Create Pages Manually

If reactivation doesn't work, create pages manually:

### 1. Resume Builder Page
1. Go to **Pages → Add New**
2. Title: `Resume Builder`
3. In the right sidebar, under **Template**, select: `Resume Builder`
4. Click **Publish**

### 2. Job Matcher Page
1. **Pages → Add New**
2. Title: `Job Matcher`
3. Template: `Job Matcher`
4. Publish

### 3. Salary Calculator Page
1. **Pages → Add New**
2. Title: `Salary Calculator`
3. Template: `Salary Calculator`
4. Publish

### 4. Interview Scheduler Page
1. **Pages → Add New**
2. Title: `Interview Scheduler`
3. Template: `Interview Scheduler`
3. Publish

### 5. ATS Dashboard Page
1. **Pages → Add New**
2. Title: `Employer Dashboard`
3. URL slug: `ats-dashboard`
4. Template: `ATS Dashboard`
5. Publish

### 6. Browse Jobs Page
1. **Pages → Add New**
2. Title: `Browse Jobs`
3. URL slug: `jobs`
4. Content: Add shortcode `[jobportal_jobs_archive]`
5. Publish

### 7. Post a Job Page
1. **Pages → Add New**
2. Title: `Post a Job`
3. URL slug: `post-job`
4. Content: Add shortcode `[jobportal_post_job_form]`
5. Publish

### 8. Blog Page
1. **Pages → Add New**
2. Title: `Blog`
3. Leave content empty
4. Publish
5. Go to **Settings → Reading**
6. Under "Your homepage displays", set "Posts page" to `Blog`

### 9. About & Contact Pages
1. Create pages with titles: `About Us` and `Contact`
2. Add your own content
3. Publish

---

## ✅ Solution 3: Flush Permalinks

After creating pages, you MUST flush permalinks:

1. Go to **Settings → Permalinks**
2. Click **Save Changes** (don't change anything, just save)
3. This refreshes WordPress URL structure
4. Try visiting `/jobs`, `/resume-builder`, etc. again

**Why this works:** WordPress caches URL structure. Saving permalinks clears the cache.

---

## ❌ Issue: Homepage is Blank or Shows Blog Posts

### Solution:
1. Go to **Settings → Reading**
2. Under "Your homepage displays", select: **Your latest posts**
3. Leave "Homepage" dropdown empty
4. Save Changes

WordPress will automatically use `front-page.php` template which shows the JobPortal homepage.

---

## ❌ Issue: No Jobs Showing on /jobs Page

### Why:
Demo jobs weren't seeded yet.

### Solution 1: Reactivate Theme
1. Switch to another theme
2. Switch back to JobPortal Elite
3. 40 demo jobs will be created automatically

### Solution 2: Create Jobs Manually
1. Go to **Posts → Add New**
2. Create job posts
3. Add custom fields:
   - `job_company`
   - `job_location`
   - `job_type`
   - `job_salary`

---

## ❌ Issue: Logo Not Showing

### Why:
WordPress hasn't loaded the logo yet.

### Solution:
1. Go to **Appearance → Customize**
2. Navigate to **Site Identity**
3. The JobPortal logo should appear automatically
4. OR upload your own logo

**Default Logo Location:**
`/wp-content/themes/jobportal/assets/images/logo.svg`

---

## ❌ Issue: Navigation Menu Not Showing

### Why:
Menu hasn't been assigned yet.

### Solution:
The theme shows a default fallback menu automatically with:
- Home
- Browse Jobs
- Resume Builder
- Job Matcher
- Salary Calculator
- Blog

**To customize the menu:**
1. Go to **Appearance → Menus**
2. Create a new menu
3. Add pages you want
4. Assign to "Primary Menu" location
5. Save

---

## ❌ Issue: Elite Features Not Working

### Symptoms:
- Resume Builder page shows shortcode `[jobportal_resume_builder]`
- Job Matcher shows `[jobportal_job_matcher]`
- Etc.

### Why:
The shortcode files aren't loaded.

### Solution:
Check that these files exist:
- `inc/unique-features/resume-builder.php`
- `inc/unique-features/job-matching.php`
- `inc/unique-features/salary-calculator.php`
- `inc/unique-features/ats-dashboard.php`
- `inc/unique-features/interview-scheduler.php`

All should be included in the theme. If missing, redownload the theme.

---

## ❌ Issue: Can't Post Jobs (Form Not Working)

### Solution:
Make sure the `/post-job` page has the shortcode:
```
[jobportal_post_job_form]
```

If it's missing:
1. Edit the "Post a Job" page
2. Add the shortcode
3. Update

---

## ❌ Issue: CSS Not Loading / Site Looks Broken

### Solution 1: Clear Cache
1. Clear browser cache (Ctrl + Shift + Delete)
2. If using a caching plugin, clear WordPress cache
3. Refresh page (Ctrl + F5)

### Solution 2: Check Files
Make sure these CSS files exist:
- `style.css`
- `assets/css/main.css`
- `assets/css/blog-jobportal.css`

### Solution 3: Regenerate CSS
1. Go to **Appearance → Customize**
2. Change any color
3. Click **Publish**
4. This regenerates CSS

---

## ❌ Issue: Search Not Finding Jobs

### Solution:
WordPress search searches posts, not pages. To search jobs:
1. Jobs are created as regular blog posts
2. Tagged with "job" tag
3. Search should work automatically

If not working:
1. Check jobs exist: **Posts → All Posts**
2. Make sure they're published
3. Try creating a new job manually

---

## ❌ Issue: Permalink Structure Not Working

### Symptoms:
- All pages show 404 except homepage
- URLs don't work at all

### Solution:
1. Go to **Settings → Permalinks**
2. Select **Post name** (recommended)
3. Click **Save Changes**
4. Try visiting pages again

**Note:** Some servers require `.htaccess` file to be writable. Contact your host if this doesn't work.

---

## ❌ Issue: Theme Won't Activate

### Symptoms:
- "The theme is missing the style.css stylesheet"
- Theme activation fails

### Why:
You might have uploaded the wrong folder.

### Solution:
Make sure you upload the `jobportal` folder, NOT the parent folder.

**Correct structure:**
```
wp-content/themes/jobportal/
├── style.css
├── functions.php
├── header.php
├── footer.php
└── ...
```

**Wrong:**
```
wp-content/themes/jobportal-master/
└── jobportal/
    ├── style.css
    └── ...
```

---

## ❌ Issue: 40 Demo Jobs Not Created

### Solution:
The job seeder runs on theme activation. To manually trigger:

**Option 1: Reactivate Theme**
1. Switch to another theme
2. Switch back to JobPortal Elite

**Option 2: Run Function Manually**
Add this code temporarily to `functions.php`:
```php
add_action('init', 'jobportal_seed_demo_jobs');
```

Visit your site, then remove the code.

---

## ❌ Issue: "Fatal Error" or White Screen

### Symptoms:
- White screen of death
- PHP fatal error

### Common Causes:
1. **PHP Version Too Old**
   - Requires PHP 7.4+
   - Check: **Tools → Site Health**
   - Contact host to upgrade PHP

2. **Memory Limit Too Low**
   - Add to `wp-config.php`:
     ```php
     define('WP_MEMORY_LIMIT', '256M');
     ```

3. **Plugin Conflict**
   - Deactivate all plugins
   - Activate theme
   - Reactivate plugins one by one to find culprit

---

## 🔍 How to Debug Issues

### Enable WordPress Debug Mode:

Add to `wp-config.php` (above "That's all, stop editing!"):
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Errors will be logged to: `wp-content/debug.log`

### Check PHP Error Log:
Ask your host where PHP error logs are located.

### Browser Console:
Press F12 in browser → Console tab → Look for JavaScript errors

---

## 📞 Still Having Issues?

### Before Asking for Help:

1. ✅ Try reactivating the theme
2. ✅ Flush permalinks (Settings → Permalinks → Save)
3. ✅ Clear all caches
4. ✅ Deactivate all plugins temporarily
5. ✅ Check WordPress and PHP versions
6. ✅ Review this troubleshooting guide

### When Asking for Help, Provide:

1. WordPress version
2. PHP version
3. Active plugins list
4. Exact error message
5. Screenshot of issue
6. What you already tried

---

## ✅ Quick Fixes Checklist

Run through this checklist if ANYTHING isn't working:

- [ ] Reactivate the theme (switch to another theme, then back)
- [ ] Flush permalinks (Settings → Permalinks → Save)
- [ ] Clear browser cache (Ctrl + Shift + Delete)
- [ ] Clear WordPress cache (if using caching plugin)
- [ ] Deactivate all plugins temporarily
- [ ] Check all pages exist (Pages → All Pages)
- [ ] Verify PHP version is 7.4+ (Tools → Site Health)
- [ ] Check file permissions (755 for folders, 644 for files)
- [ ] Ensure .htaccess is writable
- [ ] Verify all template files exist in theme folder

---

## 🚀 Prevention Tips

To avoid issues in the future:

1. **Always backup before updating** theme or WordPress
2. **Test on staging site** before production
3. **Keep WordPress, theme, and plugins updated**
4. **Use compatible plugins** (check plugin descriptions)
5. **Don't edit core theme files** (use child theme instead)
6. **Monitor site regularly** for errors
7. **Keep good hosting** (avoid cheap shared hosting)

---

## 📚 Related Documentation

- `USAGE_GUIDE.md` - Installation and setup
- `WHAT_CAN_YOU_DO.md` - Complete features guide
- `README.md` - Theme overview

---

**Most issues are fixed by:**
1. Reactivating the theme
2. Flushing permalinks
3. Clearing caches

Try these first! 🎯
