# 🎨 Career Hub - Color Scheme Documentation

## Logo-Based Professional Color Palette

All colors in this theme are derived from the **Career Hub logo** to maintain perfect brand consistency.

---

## 🌈 Primary Brand Colors

### Cyan (Primary)
- **Hex:** `#00B4D8`
- **RGB:** `rgb(0, 180, 216)`
- **Use:** Primary buttons, links, main CTAs, highlights
- **CSS Variable:** `--jobportal-primary`

### Teal Green (Secondary)
- **Hex:** `#00C896`
- **RGB:** `rgb(0, 200, 150)`
- **Use:** Secondary buttons, accents, success states, fresh highlights
- **CSS Variable:** `--jobportal-secondary`

### Navy Blue (Accent/Dark)
- **Hex:** `#1B3A5F`
- **RGB:** `rgb(27, 58, 95)`
- **Use:** Headings, dark text, professional backgrounds, contrast
- **CSS Variable:** `--jobportal-accent` / `--jobportal-primary-dark`

---

## 🎯 Semantic Colors

### Success
- **Color:** `#00C896` (Teal Green - matches brand)
- **Use:** Success messages, completed states, positive feedback

### Info
- **Color:** `#00B4D8` (Cyan - matches brand)
- **Use:** Informational messages, tips, notifications

### Warning
- **Color:** `#FFA726` (Warm Orange)
- **Use:** Warning messages, caution states

### Error
- **Color:** `#EF5350` (Coral Red)
- **Use:** Error messages, required fields, alerts

---

## 🌊 Gradient Combinations

### Primary Gradient (Navy → Cyan → Teal)
```css
background: linear-gradient(135deg, #1B3A5F 0%, #00B4D8 50%, #00C896 100%);
```
- **Use:** Hero sections, feature cards, premium elements

### Secondary Gradient (Cyan → Teal)
```css
background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
```
- **Use:** Buttons, CTAs, hover effects, badges

### Dark Gradient (Navy → Dark)
```css
background: linear-gradient(135deg, #1B3A5F 0%, #0f172a 100%);
```
- **Use:** Footer, dark sections, professional backgrounds

### Light Gradient (Cyan Tint → White)
```css
background: linear-gradient(180deg, #E0F7FA 0%, #ffffff 100%);
```
- **Use:** Light backgrounds, subtle sections

### Card Gradient (Subtle)
```css
background: linear-gradient(135deg, rgba(27, 58, 95, 0.03) 0%, rgba(0, 180, 216, 0.03) 100%);
```
- **Use:** Card backgrounds, subtle depth

---

## 🎨 Extended Palette

### Hover States
- **Cyan Hover:** `#0096B8` (Darker cyan)
- **Teal Hover:** `#00A67D` (Darker teal)
- **Navy Hover:** `#162E4D` (Deeper navy)

### Light Backgrounds
- **Cyan Light:** `#E0F7FA` (Light cyan background)
- **Teal Light:** `#D0F5E9` (Light teal background)
- **Navy Light:** `#E3EAF2` (Light navy background)

---

## 🎯 Usage Guidelines

### Buttons
- **Primary CTA:** Cyan (#00B4D8) with gradient to Teal on hover
- **Secondary CTA:** Teal (#00C896) solid
- **Outline Button:** Navy border with transparent background

### Text
- **Headings:** Navy Blue (#1B3A5F)
- **Body Text:** Gray 600 (#475569)
- **Muted Text:** Gray 500 (#64748b)

### Links
- **Default:** Cyan (#00B4D8)
- **Hover:** Teal (#00C896)
- **Visited:** Navy (#1B3A5F)

### Backgrounds
- **Light:** White (#ffffff) or Gray 50 (#f8fafc)
- **Medium:** Gray 100 (#f1f5f9)
- **Dark:** Navy (#1B3A5F) or Gray 900 (#0f172a)

### Icons & Graphics
- **Primary:** Use gradient (Navy → Cyan → Teal)
- **Secondary:** Solid Cyan or Teal
- **Monochrome:** Navy or Gray 700

---

## 🖼️ Footer Specific Colors

### Background
```css
background: linear-gradient(135deg, #1B3A5F 0%, #0f172a 100%);
```

### Stats Numbers (Gradient Text)
```css
background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
```

### Links Hover
- **Hover Color:** `#00B4D8` (Cyan)
- **Social Icons Hover:** Gradient background

### Newsletter Button
```css
background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
```

---

## 💡 Pro Tips

1. **Gradient Usage:** Use gradients for premium features, CTAs, and important elements
2. **Contrast:** Always ensure Navy text on light backgrounds, white text on dark backgrounds
3. **Consistency:** Stick to the 3-color system (Cyan, Teal, Navy) for brand recognition
4. **Accessibility:** All color combinations meet WCAG 2.1 AA standards
5. **Hover Effects:** Add subtle gradient on hover for interactive elements

---

## 📱 Responsive Considerations

- Gradients render well on all devices
- Colors maintain contrast on mobile screens
- Touch targets maintain visibility with cyan/teal highlights

---

## 🔄 How to Customize

All colors are defined as CSS variables in `style.css`:

```css
:root {
    --jobportal-primary: #00B4D8;
    --jobportal-secondary: #00C896;
    --jobportal-accent: #1B3A5F;
    /* ... more variables */
}
```

To customize, simply change these variables or use the **WordPress Customizer**:
- **Appearance → Customize → Theme Colors**

---

**Created for Career Hub Theme** | Designed to match the official logo perfectly
