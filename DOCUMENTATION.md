# JobPortal Theme Documentation

## Table of Contents
1. [Installation](#installation)
2. [Quick Setup](#quick-setup)
3. [Customization Guide](#customization-guide)
4. [Adding Content](#adding-content)
5. [WooCommerce Setup](#woocommerce-setup)
6. [Troubleshooting](#troubleshooting)

---

## Installation

### Method 1: WordPress Admin (Recommended)
1. Download the `jobportal.zip` file
2. Go to **Appearance → Themes → Add New**
3. Click **Upload Theme**
4. Choose the `jobportal.zip` file
5. Click **Install Now**
6. Click **Activate**

### Method 2: FTP Upload
1. Extract `jobportal.zip`
2. Upload the `jobportal` folder to `/wp-content/themes/`
3. Go to **Appearance → Themes**
4. Activate **JobPortal**

---

## Quick Setup

### Step 1: Setup Wizard
After activation, you'll see a setup wizard. Follow these steps:

1. **Welcome** - Click "Let's Go"
2. **Plugins** - Install recommended plugins (Contact Form 7, One Click Demo Import)
3. **Demo Content** - Import demo content (optional)
4. **Complete** - Click "Start Customizing"

### Step 2: Import Demo Content (Optional)
1. Install **One Click Demo Import** plugin
2. Go to **Appearance → Import Demo Data**
3. Click **Import** button
4. Wait for completion (2-5 minutes)

---

## Customization Guide

### Change Your Logo

**Option 1: Via Customizer**
1. Go to **Appearance → Customize**
2. Click **Site Identity**
3. Click **Select Logo**
4. Upload your logo image (recommended: 300x100px PNG)
5. Adjust logo height if needed
6. Click **Publish**

**Option 2: Via Admin**
1. Go to **Appearance → Customize → Site Identity**
2. Upload logo
3. Save

### Change Text Content

#### Hero Section Text
1. **Appearance → Customize → Hero Section → Hero Content**
2. Edit these fields:
   - Badge Text (e.g., "New Features Available")
   - Hero Title (main heading)
   - Hero Subtitle (description)
3. Click **Publish**

#### Button Text & Links
1. **Appearance → Customize → Hero Section → Hero Buttons**
2. Edit:
   - Primary Button Text
   - Primary Button URL
   - Secondary Button Text
   - Secondary Button URL
3. Click **Publish**

#### Other Sections
- **Features Section:** Customize → Features Section
- **Pricing Section:** Customize → Pricing Section
- **Testimonials:** Customize → Testimonials Section
- **CTA Section:** Customize → CTA Section
- **Footer:** Customize → Footer Settings

### Change Colors

1. Go to **Appearance → Customize → Theme Colors**
2. **Primary Colors:**
   - Primary Color (default: #4facfe)
   - Secondary Color (default: #00f2fe)
   - Accent Color (default: #43e97b)
3. **Text Colors:**
   - Heading Color
   - Body Text Color
4. Click **Publish**

### Change Fonts

1. **Appearance → Customize → Typography**
2. Select:
   - Heading Font (Plus Jakarta Sans, Inter, Poppins, etc.)
   - Body Font (Inter, Roboto, Open Sans, etc.)
3. Click **Publish**

### Header Settings

1. **Appearance → Customize → Header Settings**
2. Options:
   - Header Style (Default, Centered, Minimal, Full Width)
   - Sticky Header (Enable/Disable)
   - Transparent Header (Enable/Disable)
   - Header Colors
   - CTA Button

### Footer Settings

1. **Appearance → Customize → Footer Settings**
2. Options:
   - Footer Style (Default, Centered, Minimal)
   - Footer Background Color
   - Footer Text Color
   - Copyright Text

---

## Adding Content

### Add Services

1. Go to **Services → Add New**
2. Enter service title
3. Add description in editor
4. **Service Details** (meta box):
   - Icon class (e.g., "dashicons-chart-line")
   - Short description
5. Click **Publish**

### Add Testimonials

1. Go to **Testimonials → Add New**
2. Enter testimonial content
3. **Testimonial Details** (meta box):
   - Author Name
   - Position (e.g., "CEO")
   - Company Name
   - Rating (1-5)
4. Set featured image (author photo)
5. Click **Publish**

### Add Pricing Plans

1. Go to **Pricing Plans → Add New**
2. Enter plan name (e.g., "Pro Plan")
3. **Pricing Details** (meta box):
   - Monthly Price (e.g., 49)
   - Yearly Price (e.g., 399)
   - Features (one per line)
   - Popular Plan (checkbox)
   - Button Text
   - Button URL
4. Click **Publish**

### Add FAQs

1. Go to **FAQs → Add New**
2. Enter question as title
3. Enter answer in editor
4. **FAQ Settings:**
   - Order (for sorting)
5. Click **Publish**

### Create Pages

**About Page:**
1. **Pages → Add New**
2. Title: "About Us"
3. Template: **About Template**
4. Click **Publish**

**Services Page:**
1. **Pages → Add New**
2. Title: "Services"
3. Template: **Services Template**
4. Click **Publish**

**Contact Page:**
1. **Pages → Add New**
2. Title: "Contact"
3. Template: **Contact Template**
4. Edit contact information in **Customize → Contact Information**
5. Click **Publish**

### Setup Navigation Menu

1. **Appearance → Menus**
2. Create new menu (e.g., "Primary Menu")
3. Add pages:
   - Home
   - About
   - Services
   - Pricing
   - Blog
   - Contact
4. **Menu Settings:**
   - Check "Primary Menu"
5. Click **Save Menu**

---

## WooCommerce Setup

### Install WooCommerce

1. **Plugins → Add New**
2. Search "WooCommerce"
3. Install and activate
4. Follow WooCommerce setup wizard

### Configure Shop Page

1. **WooCommerce → Settings → Products**
2. Set shop page display
3. Set products per page

### Add Shop Sidebar Widgets

1. **Appearance → Widgets**
2. Find **Shop Sidebar**
3. Add widgets:
   - WooCommerce Product Search
   - WooCommerce Product Categories
   - WooCommerce Price Filter

---

## Troubleshooting

### Logo Not Showing?
- Go to **Customize → Site Identity**
- Re-upload logo
- Check logo height setting (default: 50px)

### Text Not Changing?
- Make sure you're editing in **Customize** not **Pages**
- Clear browser cache
- Clear WordPress cache (if caching plugin installed)

### Demo Content Not Importing?
- Check PHP memory limit (minimum 256MB)
- Increase max execution time
- Try importing in parts

### WooCommerce Shop Page Blank?
- Go to **WooCommerce → Settings → Products**
- Set shop page
- Add products

### Contact Form Not Working?
- Install Contact Form 7 plugin
- Or use built-in AJAX form (no plugin needed)
- Check admin email in **Settings → General**

---

## Support

For support questions, please contact:
- Email: support@jobportaltheme.com
- Documentation: https://jobportaltheme.com/docs

---

## Tips for Best Results

1. **Use High-Quality Images**
   - Hero image: 1400x900px
   - Service icons: 64x64px
   - Testimonial photos: 100x100px

2. **Keep Text Concise**
   - Hero title: 8-12 words
   - Hero subtitle: 15-25 words
   - Feature descriptions: 50-100 characters

3. **Test on Mobile**
   - Check responsive design
   - Test all forms
   - Verify images load properly

4. **SEO Optimization**
   - Install Yoast SEO plugin
   - Set focus keywords
   - Optimize images with alt text

5. **Performance**
   - Install caching plugin (WP Rocket, W3 Total Cache)
   - Optimize images (Smush, ShortPixel)
   - Use CDN for faster loading

---

**Version:** 1.0.0
**Last Updated:** 2024
**Theme URI:** https://jobportaltheme.com
