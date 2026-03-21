# 🖱️ Career Hub - Professional Cursor Manager

## Ultra-Creative Cursor Styles for Elite UX

Manage your website's cursor style from WordPress Admin with **5 stunning cursor options** + live preview!

---

## 🎯 How to Access

1. **Login to WordPress Admin**
2. Go to: **Appearance → Cursor Styles**
3. Select your preferred cursor
4. Preview in real-time
5. Click "Save Cursor Style"

---

## ✨ Available Cursor Styles

### 1. 🔲 Default Cursor
- **Type:** Classic
- **Description:** Standard browser cursor. Clean and simple.
- **Best For:** Professional sites, minimal design
- **Performance:** Excellent (no custom code)

### 2. 💫 Gradient Ring
- **Type:** Premium
- **Description:** Smooth animated ring with Career Hub gradient (Cyan → Teal)
- **Effect:** Expands on click, smooth follow animation
- **Best For:** Modern, creative websites
- **Performance:** Great (CSS-based)

### 3. ⚡ Neon Trail
- **Type:** Futuristic
- **Description:** Glowing cursor with animated neon trail
- **Effect:** Pulsing glow effect, cyberpunk aesthetic
- **Best For:** Tech startups, innovative brands
- **Performance:** Good (slight glow animation)

### 4. ✨ Particle Burst
- **Type:** Magical
- **Description:** Particles burst on every click
- **Effect:** 8 particles explode outward on click
- **Best For:** Interactive, playful websites
- **Performance:** Good (lightweight particles)

### 5. 🧲 Magnetic Dot
- **Type:** Elegant
- **Description:** Elegant dot that magnetically attracts to links
- **Effect:** Expands when hovering over links/buttons
- **Best For:** Portfolio sites, luxury brands
- **Performance:** Excellent (smooth transitions)

---

## 🎨 Cursor Preview System

### Live Preview Features
- ✅ **Real-time preview** in admin panel
- ✅ **Interactive preview area** for each cursor
- ✅ **Test buttons** to see click effects
- ✅ **Visual badges** showing cursor type
- ✅ **Hover effects** to test interactions

### Preview Area
Each cursor card has:
- 200px preview zone
- "Move your mouse here" text
- Interactive button to test clicks
- Smooth background gradient
- Cursor-specific animations

---

## 🛠️ Technical Details

### CSS-Based Cursors
- **Gradient Ring:** Pure CSS gradient border
- **Neon Trail:** CSS box-shadow + keyframes
- **Magnetic Dot:** CSS transitions + JavaScript hover detection

### JavaScript Features
- **Smooth following:** 60fps cursor tracking
- **Easing animation:** Cubic-bezier for smooth movement
- **Event handling:** Click, hover, mousedown detection
- **Particle system:** Dynamic DOM elements with animations

### Performance Optimization
- Uses `requestAnimationFrame` for smooth 60fps
- Minimal DOM manipulation
- CSS transforms (hardware accelerated)
- No heavy libraries required
- Conditional loading (only loads selected cursor)

---

## 📱 Responsive Behavior

### Desktop (Recommended)
- All cursor styles work perfectly
- Smooth 60fps animations
- Interactive hover effects

### Mobile/Tablet
- Cursor styles automatically disabled
- Reverts to native touch interaction
- No performance impact

### Detection
```javascript
// Auto-disabled on touch devices
if ('ontouchstart' in window) {
    // Use default cursor
}
```

---

## 🎯 Usage Recommendations

### For Different Site Types

**Corporate/Professional:**
- ✅ Default Cursor
- ✅ Magnetic Dot (subtle elegance)

**Creative Agency:**
- ✅ Gradient Ring
- ✅ Particle Burst

**Tech Startup:**
- ✅ Neon Trail
- ✅ Gradient Ring

**Portfolio:**
- ✅ Magnetic Dot
- ✅ Gradient Ring

**E-commerce:**
- ✅ Default Cursor (best UX)
- ✅ Magnetic Dot (if creative brand)

---

## ⚙️ Settings Location

```
WordPress Admin → Appearance → Cursor Styles
```

### Saved In Database
```php
Option: 'careerhub_cursor_style'
Values: 'none', 'gradient-ring', 'neon-trail', 'particle-burst', 'magnetic-dot'
```

---

## 🎨 Customization

### Change Cursor Colors

Edit `inc/cursor-manager.php` and modify the CSS:

```css
/* Gradient Ring - Change colors */
background: linear-gradient(135deg, #YOUR_COLOR1, #YOUR_COLOR2) border-box;

/* Neon Trail - Change glow color */
box-shadow: 0 0 20px #YOUR_COLOR;

/* Particle Burst - Change particle colors */
background: linear-gradient(135deg, #YOUR_COLOR1, #YOUR_COLOR2);
```

### Change Cursor Size

```css
/* Gradient Ring */
width: 40px;  /* Change this */
height: 40px; /* And this */

/* Magnetic Dot */
width: 12px;  /* Smaller = more subtle */
height: 12px;
```

### Change Animation Speed

```javascript
// In cursor-manager.php, find:
cursorX += (mouseX - cursorX) * 0.2;  // 0.2 = speed (0.1-0.5 recommended)
```

---

## 🐛 Troubleshooting

### Cursor Not Showing?
1. **Clear browser cache** (Ctrl + Shift + Del)
2. **Hard refresh** (Ctrl + F5)
3. Check if saved: Go to admin and verify selection
4. Check browser console for errors

### Cursor Lagging?
1. Reduce cursor size in CSS
2. Disable other animations on page
3. Check browser performance
4. Try a simpler cursor style

### Cursor Not Following Mouse?
1. Check JavaScript console for errors
2. Ensure `cursor: none` is applied globally
3. Verify `custom-cursor` element exists in DOM

### Preview Not Working in Admin?
1. JavaScript might be blocked
2. Check browser console
3. Ensure you're on the Cursor Styles page

---

## 💡 Pro Tips

1. **Match Your Brand:** Choose cursor that matches your website aesthetic
2. **Test First:** Always preview before saving
3. **Consider Performance:** Simpler cursors = better performance
4. **Mobile Users:** They won't see custom cursor (normal behavior)
5. **Accessibility:** Some users prefer default cursor - provide option
6. **A/B Test:** Try different styles to see what users prefer

---

## 🔄 Switching Cursors

You can change cursor style anytime:
1. Go to **Appearance → Cursor Styles**
2. Select new cursor
3. Preview it
4. Save

Changes apply **immediately** to the frontend!

---

## 📊 Cursor Comparison

| Cursor | Performance | Interactivity | Visual Impact | Best Use |
|--------|------------|---------------|---------------|----------|
| Default | ⭐⭐⭐⭐⭐ | ⭐⭐ | ⭐⭐ | Professional |
| Gradient Ring | ⭐⭐⭐⭐ | ⭐⭐⭐⭐ | ⭐⭐⭐⭐ | Creative |
| Neon Trail | ⭐⭐⭐ | ⭐⭐⭐ | ⭐⭐⭐⭐⭐ | Futuristic |
| Particle Burst | ⭐⭐⭐ | ⭐⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ | Interactive |
| Magnetic Dot | ⭐⭐⭐⭐⭐ | ⭐⭐⭐⭐ | ⭐⭐⭐ | Elegant |

---

## 🎓 Developer Notes

### Adding New Cursor Styles

1. **Add to Admin Page** (`cursor-manager.php` line 60+):
```php
<div class="cursor-style-card">
    <div class="cursor-preview-area" data-cursor="your-style">
        <!-- Preview content -->
    </div>
    <!-- Cursor info -->
</div>
```

2. **Add CSS** (in `careerhub_get_cursor_css()` function):
```php
case 'your-style':
    $css .= "
    .custom-cursor {
        /* Your custom cursor CSS */
    }
    ";
    break;
```

3. **Add JavaScript** (in `careerhub_get_cursor_js()` function):
```php
<?php if ($style === 'your-style'): ?>
// Your custom JavaScript
<?php endif; ?>
```

---

## 📝 Version History

- **v2.0.0** - Initial release with 5 cursor styles
- Features: Live preview, admin panel, performance optimization
- Colors: Updated to Career Hub brand colors

---

## 🆘 Support

**Need Help?**
- Check WordPress admin for cursor preview
- Test in different browsers
- Clear cache if changes don't appear
- Contact theme support for customization help

---

**Created for Career Hub Theme** | Designed by 10-year UX/UI Expert 🎨
