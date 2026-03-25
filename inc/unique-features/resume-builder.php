<?php
/**
 * ELITE FEATURE #1: Resume Builder - GOD-LEVEL VERSION 3.0
 *
 * 3-Step Wizard • 10 Professional Templates • Drag-Drop •  Live Preview • PDF Export
 * ATS-Optimized • Auto-Save • Beautiful UI/UX • Animations
 *
 * @package JobPortal
 * @version 3.0.0 ELITE - GOD-LEVEL
 */

// Register shortcode
function jobportal_resume_builder_shortcode() {
    ob_start();
    ?>

    <style>
    * { box-sizing: border-box; }

    /* ============================================
       WIZARD CONTAINER & PROGRESS
       ============================================ */
    .resume-wizard {
        max-width: 1600px;
        margin: 0 auto;
        padding: 40px 20px;
        min-height: 80vh;
    }

    .wizard-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .wizard-header h2 {
        font-size: 48px;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 800;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }

    .wizard-subtitle {
        font-size: 18px;
        color: #64748b;
        margin-bottom: 40px;
    }

    /* Progress Steps */
    .wizard-progress {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 60px;
        flex-wrap: wrap;
    }

    .progress-step {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 28px;
        border-radius: 50px;
        background: #f1f5f9;
        color: #94a3b8;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .progress-step.active {
        background: linear-gradient(135deg, #00B4D8, #00C896);
        color: white;
        box-shadow: 0 4px 20px rgba(0, 180, 216, 0.3);
        transform: scale(1.05);
    }

    .progress-step.completed {
        background: #e0f2fe;
        color: #0284c7;
        border-color: #00B4D8;
    }

    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
    }

    .progress-step.active .step-number {
        background: rgba(255,255,255,0.3);
    }

    .progress-step.completed .step-number::before {
        content: '✓';
        font-size: 18px;
    }

    .progress-connector {
        width: 60px;
        height: 2px;
        background: #e2e8f0;
        transition: all 0.3s ease;
    }

    .progress-connector.completed {
        background: #00B4D8;
    }

    /* ============================================
       WIZARD STEPS
       ============================================ */
    .wizard-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .wizard-step.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideIn {
        from { transform: translateX(-20px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes scaleIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    /* ============================================
       STEP 1: TEMPLATE SELECTION
       ============================================ */
    .step-title {
        text-align: center;
        font-size: 32px;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 700;
    }

    .step-description {
        text-align: center;
        font-size: 16px;
        color: #64748b;
        margin-bottom: 50px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .template-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .template-card {
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.4s ease forwards;
        opacity: 0;
    }

    .template-card:nth-child(1) { animation-delay: 0.05s; }
    .template-card:nth-child(2) { animation-delay: 0.1s; }
    .template-card:nth-child(3) { animation-delay: 0.15s; }
    .template-card:nth-child(4) { animation-delay: 0.2s; }
    .template-card:nth-child(5) { animation-delay: 0.25s; }
    .template-card:nth-child(6) { animation-delay: 0.3s; }
    .template-card:nth-child(7) { animation-delay: 0.35s; }
    .template-card:nth-child(8) { animation-delay: 0.4s; }
    .template-card:nth-child(9) { animation-delay: 0.45s; }
    .template-card:nth-child(10) { animation-delay: 0.5s; }

    .template-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        border-color: #00B4D8;
    }

    .template-card.selected {
        border: 3px solid #00B4D8;
        background: linear-gradient(135deg, rgba(0,180,216,0.05), rgba(0,200,150,0.05));
        box-shadow: 0 8px 30px rgba(0,180,216,0.2);
        transform: translateY(-4px);
    }

    .template-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #00B4D8, #00C896);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .template-card.selected::before,
    .template-card:hover::before {
        opacity: 1;
    }

    .template-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: linear-gradient(135deg, #f59e0b, #f97316);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 10px rgba(245,158,11,0.3);
    }

    .template-preview {
        width: 100%;
        height: 200px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        position: relative;
    }

    .template-preview-icon {
        font-size: 48px;
        opacity: 0.3;
        color: #00B4D8;
    }

    .template-info {
        text-align: center;
    }

    .template-name {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .template-description {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    .template-tags {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .template-tag {
        padding: 4px 12px;
        background: #f1f5f9;
        border-radius: 12px;
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
    }

    .template-card.selected .template-tag {
        background: rgba(0,180,216,0.1);
        color: #00B4D8;
    }

    /* ============================================
       STEP 2: FORM & PREVIEW
       ============================================ */
    .form-preview-container {
        display: grid;
        grid-template-columns: minmax(400px, 40%) 1fr;
        gap: 40px;
        align-items: start;
    }

    @media (max-width: 1200px) {
        .form-preview-container {
            grid-template-columns: 1fr;
        }

        .resume-preview-wrapper {
            position: sticky;
            top: 20px;
        }
    }

    /* Form Styles */
    .builder-form {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .form-section {
        margin-bottom: 32px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 12px;
        cursor: pointer;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .section-header:hover {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-color: #cbd5e1;
    }

    .section-header h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-toggle {
        transition: transform 0.3s ease;
        font-size: 14px;
        color: #64748b;
    }

    .section-header.collapsed .section-toggle {
        transform: rotate(-90deg);
    }

    .section-content {
        padding: 0 4px;
        max-height: 2000px;
        overflow: hidden;
        transition: max-height 0.3s ease, opacity 0.3s ease;
    }

    .section-content.hidden {
        max-height: 0;
        opacity: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #334155;
        font-size: 14px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #00B4D8;
        box-shadow: 0 0 0 3px rgba(0,180,216,0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* Dynamic Items (Experience/Education) */
    .experience-item,
    .education-item {
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 20px;
        border: 2px solid #e2e8f0;
        position: relative;
        transition: all 0.3s ease;
    }

    .experience-item:hover,
    .education-item:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .btn-remove-item {
        position: absolute;
        top: 16px;
        right: 16px;
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-remove-item:hover {
        background: #fecaca;
        transform: scale(1.05);
    }

    .btn-add-item {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #00B4D8, #00C896);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .btn-add-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,180,216,0.3);
    }

    /* Progress Indicator */
    .completion-progress {
        margin-bottom: 24px;
        padding: 20px;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        border-radius: 12px;
        border: 1px solid #bae6fd;
    }

    .progress-text {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #0284c7;
    }

    .progress-bar {
        height: 8px;
        background: #e0f2fe;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #00B4D8, #00C896);
        border-radius: 10px;
        transition: width 0.5s ease;
        width: 0%;
    }

    /* Preview Panel */
    .resume-preview-wrapper {
        background: #f8fafc;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow-x: auto;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f1f5f9;
    }

    .preview-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
    }

    .zoom-controls {
        display: flex;
        gap: 8px;
    }

    .zoom-btn {
        width: 36px;
        height: 36px;
        border: 2px solid #e2e8f0;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 700;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .zoom-btn:hover {
        border-color: #00B4D8;
        color: #00B4D8;
        background: #f0f9ff;
    }

    .resume-canvas {
        width: 100%;
        max-width: 794px;
        min-height: 1123px;
        padding: 60px;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border-radius: 8px;
        transform-origin: top center;
        transition: transform 0.3s ease;
        overflow: visible;
        margin: 0 auto;
    }

    @media (max-width: 1400px) {
        .resume-canvas {
            transform: scale(0.85);
            transform-origin: top center;
            margin-bottom: -150px;
        }
    }

    @media (max-width: 1200px) {
        .resume-canvas {
            transform: scale(0.75);
            transform-origin: top center;
            margin-bottom: -250px;
        }
    }

    /* A4 Page Breaks */
    .resume-page {
        width: 794px;
        min-height: 1123px;
        padding: 60px;
        background: white;
        margin-bottom: 20px;
        page-break-after: always;
    }

    @media print {
        .resume-canvas {
            width: 210mm;
            min-height: 297mm;
            box-shadow: none;
            border-radius: 0;
        }

        .resume-page {
            width: 210mm;
            min-height: 297mm;
            page-break-after: always;
        }
    }

    /* ============================================
       STEP 3: EXPORT
       ============================================ */
    .export-container {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
    }

    .export-preview {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 40px;
    }

    .export-preview-canvas {
        max-width: 600px;
        margin: 0 auto;
        padding: 40px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px dashed #cbd5e1;
    }

    .customization-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 40px;
    }

    .customization-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .customization-card:hover {
        border-color: #00B4D8;
        box-shadow: 0 6px 30px rgba(0,180,216,0.15);
    }

    .customization-card h4 {
        margin-bottom: 16px;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
    }

    .color-picker {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .color-option {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 8px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.2s ease;
    }

    .color-option:hover {
        transform: scale(1.1);
    }

    .color-option.selected {
        border-color: #1e293b;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .font-options {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .font-option {
        padding: 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: left;
    }

    .font-option:hover {
        border-color: #00B4D8;
        background: #f0f9ff;
    }

    .font-option.selected {
        border-color: #00B4D8;
        background: linear-gradient(135deg, rgba(0,180,216,0.1), rgba(0,200,150,0.1));
    }

    .export-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary,
    .btn-secondary {
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #00B4D8, #00C896);
        color: white;
        box-shadow: 0 4px 20px rgba(0,180,216,0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 30px rgba(0,180,216,0.4);
    }

    .btn-secondary {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    /* Navigation Buttons */
    .wizard-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        gap: 16px;
    }

    .btn-back,
    .btn-next {
        padding: 14px 28px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .btn-next {
        background: linear-gradient(135deg, #00B4D8, #00C896);
        color: white;
        margin-left: auto;
    }

    .btn-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,180,216,0.3);
    }

    .btn-next:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* Success Animation */
    .success-message {
        text-align: center;
        padding: 60px 40px;
        animation: scaleIn 0.5s ease;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #00B4D8, #00C896);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        animation: bounce 0.6s ease;
    }

    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .success-icon svg {
        color: white;
        width: 40px;
        height: 40px;
    }

    .success-message h3 {
        font-size: 28px;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .success-message p {
        font-size: 16px;
        color: #64748b;
    }

    /* Confetti Effect */
    .confetti {
        position: fixed;
        width: 10px;
        height: 10px;
        top: -10px;
        z-index: 9999;
        animation: confetti-fall 3s linear;
    }

    @keyframes confetti-fall {
        to {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }

    /* ============================================
       TEMPLATE STYLES (Simplified - will be expanded)
       ============================================ */
    .resume-header {
        text-align: center;
        margin-bottom: 36px;
        padding-bottom: 28px;
        border-bottom: 3px solid #00B4D8;
        background: linear-gradient(to bottom, #f8fafc 0%, white 100%);
        padding-top: 20px;
        margin: -60px -60px 36px -60px;
        padding-left: 60px;
        padding-right: 60px;
    }

    .resume-canvas h1 {
        font-size: 38px;
        margin-bottom: 10px;
        color: #1e293b;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .resume-canvas h2 {
        font-size: 17px;
        color: #00B4D8;
        font-weight: 600;
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .resume-canvas h3 {
        font-size: 20px;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 2px solid #00B4D8;
    }

    .resume-section {
        margin-bottom: 24px;
    }

    .contact-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px 40px;
        margin-top: 24px;
        padding: 20px 0;
        font-size: 13px;
        color: #475569;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .contact-info span,
    .contact-info a {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: #475569;
        text-decoration: none;
        padding: 4px 0;
    }

    .contact-info a:hover {
        color: #00B4D8;
    }

    .contact-info svg {
        width: 18px;
        height: 18px;
        color: #00B4D8;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .contact-info {
            grid-template-columns: 1fr;
        }
    }

    .skills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .skill-tag {
        padding: 6px 14px;
        background: #f0f9ff;
        color: #0284c7;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .job-entry,
    .edu-entry {
        margin-bottom: 20px;
    }

    .job-header,
    .edu-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .job-title,
    .edu-degree {
        font-weight: 700;
        color: #1e293b;
        font-size: 15px;
    }

    .company-name,
    .school-name {
        color: #00B4D8;
        font-weight: 600;
        font-size: 14px;
    }

    .date-range {
        color: #94a3b8;
        font-size: 13px;
        font-weight: 500;
    }

    .job-desc {
        color: #475569;
        line-height: 1.6;
        font-size: 13px;
        margin-top: 8px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .wizard-header h2 {
            font-size: 32px;
        }

        .template-grid {
            grid-template-columns: 1fr;
        }

        .form-preview-container {
            grid-template-columns: 1fr;
        }

        .customization-options {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .wizard-progress {
            gap: 10px;
        }

        .progress-step {
            padding: 12px 20px;
            font-size: 14px;
        }

        .progress-connector {
            width: 30px;
        }
    }
    </style>

    <div class="resume-wizard">
        <!-- Wizard Header -->
        <div class="wizard-header">
            <h2>
                <span style="color: #00B4D8;"><?php echo jobportal_get_icon('file-text', 40); ?></span>
                Professional Resume Builder
            </h2>
            <p class="wizard-subtitle">Create a stunning, ATS-optimized resume in 3 simple steps</p>
        </div>

        <!-- Progress Steps -->
        <div class="wizard-progress">
            <div class="progress-step active" data-step="1">
                <div class="step-number">1</div>
                <span>Choose Template</span>
            </div>
            <div class="progress-connector"></div>
            <div class="progress-step" data-step="2">
                <div class="step-number">2</div>
                <span>Fill Information</span>
            </div>
            <div class="progress-connector"></div>
            <div class="progress-step" data-step="3">
                <div class="step-number">3</div>
                <span>Download</span>
            </div>
        </div>

        <!-- Step 1: Choose Template -->
        <div class="wizard-step active" data-step="1">
            <h3 class="step-title">Choose Your Perfect Template</h3>
            <p class="step-description">Select from 10 professionally designed templates optimized for ATS systems</p>

            <div class="template-grid">
                <div class="template-card selected" data-template="modern">
                    <div class="template-badge">Most Popular</div>
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('file-text', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Modern</div>
                        <div class="template-description">Clean and contemporary design perfect for tech and creative roles</div>
                        <div class="template-tags">
                            <span class="template-tag">Professional</span>
                            <span class="template-tag">ATS-Friendly</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="classic">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('book', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Classic</div>
                        <div class="template-description">Timeless traditional layout ideal for corporate positions</div>
                        <div class="template-tags">
                            <span class="template-tag">Traditional</span>
                            <span class="template-tag">Corporate</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="creative">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('pen-tool', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Creative</div>
                        <div class="template-description">Bold and artistic design for designers and creative professionals</div>
                        <div class="template-tags">
                            <span class="template-tag">Design</span>
                            <span class="template-tag">Creative</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="minimal">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('circle', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Minimal</div>
                        <div class="template-description">Ultra-clean minimalist style that lets your content shine</div>
                        <div class="template-tags">
                            <span class="template-tag">Minimal</span>
                            <span class="template-tag">Simple</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="tech">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('laptop', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Tech</div>
                        <div class="template-description">Modern tech-focused design for developers and engineers</div>
                        <div class="template-tags">
                            <span class="template-tag">Tech</span>
                            <span class="template-tag">Developer</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="executive">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('award', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Executive</div>
                        <div class="template-description">Prestigious layout for senior leadership positions</div>
                        <div class="template-tags">
                            <span class="template-tag">Executive</span>
                            <span class="template-tag">Leadership</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="designer">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('zap', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Designer</div>
                        <div class="template-description">Visually striking layout showcasing design skills</div>
                        <div class="template-tags">
                            <span class="template-tag">Design</span>
                            <span class="template-tag">Portfolio</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="academic">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('graduation-cap', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Academic</div>
                        <div class="template-description">Scholarly format perfect for research and education</div>
                        <div class="template-tags">
                            <span class="template-tag">Academic</span>
                            <span class="template-tag">Research</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="startup">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('trending-up', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">Startup</div>
                        <div class="template-description">Dynamic and energetic design for startup culture</div>
                        <div class="template-tags">
                            <span class="template-tag">Startup</span>
                            <span class="template-tag">Innovative</span>
                        </div>
                    </div>
                </div>

                <div class="template-card" data-template="international">
                    <div class="template-preview">
                        <div class="template-preview-icon"><?php echo jobportal_get_icon('globe', 60); ?></div>
                    </div>
                    <div class="template-info">
                        <div class="template-name">International</div>
                        <div class="template-description">Globally recognized format for international opportunities</div>
                        <div class="template-tags">
                            <span class="template-tag">International</span>
                            <span class="template-tag">Global</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wizard-navigation">
                <button class="btn-next" onclick="goToStep(2)">
                    Continue to Fill Information
                    <span>→</span>
                </button>
            </div>
        </div>

        <!-- Step 2: Fill Information -->
        <div class="wizard-step" data-step="2">
            <div class="form-preview-container">
                <!-- Left: Form -->
                <div class="builder-form">
                    <!-- Completion Progress -->
                    <div class="completion-progress">
                        <div class="progress-text">
                            <span>Profile Completion</span>
                            <span class="progress-percentage">0%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill"></div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="form-section">
                        <div class="section-header">
                            <h4>👤 Personal Information</h4>
                            <span class="section-toggle">▼</span>
                        </div>
                        <div class="section-content">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-input" id="fullName" placeholder="John Doe" value="Michael Anderson">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Professional Title *</label>
                                <input type="text" class="form-input" id="jobTitle" placeholder="Senior Software Engineer" value="Senior Full-Stack Developer">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-input" id="email" placeholder="john@example.com" value="michael.anderson@techmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone *</label>
                                    <input type="tel" class="form-input" id="phone" placeholder="+1 234 567 8900" value="+1 415-789-4562">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-input" id="location" placeholder="San Francisco, CA" value="San Francisco, California, USA">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-input" id="linkedin" placeholder="linkedin.com/in/johndoe" value="linkedin.com/in/michaelanderson">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Professional Summary</label>
                                <textarea class="form-textarea" id="summary" placeholder="Brief overview of your professional background...">Results-driven software engineer with 8+ years of experience building scalable web applications. Expertise in full-stack development, cloud architecture, and leading cross-functional teams. Passionate about writing clean, maintainable code and mentoring junior developers.</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Work Experience -->
                    <div class="form-section">
                        <div class="section-header">
                            <h4><?php echo jobportal_get_icon('briefcase', 20); ?> Work Experience</h4>
                            <span class="section-toggle">▼</span>
                        </div>
                        <div class="section-content">
                            <div id="experienceContainer">
                                <div class="experience-item">
                                    <div class="form-group">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" class="form-input exp-title" placeholder="Senior Developer" value="Senior Software Engineer">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-input exp-company" placeholder="Company Name" value="TechCorp Inc.">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <input type="text" class="form-input exp-start" placeholder="Jan 2020" value="Jan 2020">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <input type="text" class="form-input exp-end" placeholder="Present" value="Present">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-textarea exp-desc" placeholder="Your responsibilities and achievements...">Led development of core platform features serving 1M+ users. Architected microservices infrastructure using Node.js and AWS. Mentored team of 5 junior developers and established code review best practices. Reduced API response time by 40% through optimization.</textarea>
                                    </div>
                                </div>

                                <div class="experience-item">
                                    <div class="form-group">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" class="form-input exp-title" placeholder="Senior Developer" value="Software Engineer">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-input exp-company" placeholder="Company Name" value="InnovateTech Solutions">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <input type="text" class="form-input exp-start" placeholder="Jan 2020" value="Jun 2017">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <input type="text" class="form-input exp-end" placeholder="Present" value="Dec 2019">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-textarea exp-desc" placeholder="Your responsibilities and achievements...">Developed and maintained RESTful APIs for e-commerce platform handling 500K+ daily transactions. Implemented automated testing suite achieving 85% code coverage. Collaborated with product team to design and launch 3 major features. Optimized database queries reducing load time by 60%.</textarea>
                                    </div>
                                </div>

                                <div class="experience-item">
                                    <div class="form-group">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" class="form-input exp-title" placeholder="Senior Developer" value="Junior Developer">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-input exp-company" placeholder="Company Name" value="StartupHub Inc.">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <input type="text" class="form-input exp-start" placeholder="Jan 2020" value="Jul 2016">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <input type="text" class="form-input exp-end" placeholder="Present" value="May 2017">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-textarea exp-desc" placeholder="Your responsibilities and achievements...">Built responsive web applications using React and Redux. Participated in daily stand-ups and sprint planning. Fixed 100+ bugs and implemented new UI components. Gained experience with Git, Agile methodologies, and code reviews.</textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn-add-item" onclick="addExperience()">+ Add Experience</button>
                        </div>
                    </div>

                    <!-- Education -->
                    <div class="form-section">
                        <div class="section-header">
                            <h4><?php echo jobportal_get_icon('graduation-cap', 20); ?> Education</h4>
                            <span class="section-toggle">▼</span>
                        </div>
                        <div class="section-content">
                            <div id="educationContainer">
                                <div class="education-item">
                                    <div class="form-group">
                                        <label class="form-label">Degree</label>
                                        <input type="text" class="form-input edu-degree" placeholder="Bachelor of Science" value="Bachelor of Science in Computer Science">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">University</label>
                                        <input type="text" class="form-input edu-school" placeholder="University Name" value="Stanford University">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Year</label>
                                            <input type="text" class="form-input edu-year" placeholder="2016" value="2012 - 2016">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">GPA (Optional)</label>
                                            <input type="text" class="form-input edu-gpa" placeholder="3.8/4.0" value="3.8/4.0">
                                        </div>
                                    </div>
                                </div>

                                <div class="education-item">
                                    <div class="form-group">
                                        <label class="form-label">Degree</label>
                                        <input type="text" class="form-input edu-degree" placeholder="Bachelor of Science" value="Master of Science in Software Engineering">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">University</label>
                                        <input type="text" class="form-input edu-school" placeholder="University Name" value="MIT">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Year</label>
                                            <input type="text" class="form-input edu-year" placeholder="2016" value="2016 - 2018">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">GPA (Optional)</label>
                                            <input type="text" class="form-input edu-gpa" placeholder="3.8/4.0" value="3.9/4.0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn-add-item" onclick="addEducation()">+ Add Education</button>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="form-section">
                        <div class="section-header">
                            <h4><?php echo jobportal_get_icon('target', 20); ?> Skills</h4>
                            <span class="section-toggle">▼</span>
                        </div>
                        <div class="section-content">
                            <div class="form-group">
                                <label class="form-label">Add Skills (comma separated)</label>
                                <textarea class="form-textarea" id="skills" placeholder="JavaScript, React, Node.js, Python...">JavaScript, React, Node.js, Python, AWS, Docker, MongoDB, Git, REST APIs, Agile, TypeScript, GraphQL</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Preview -->
                <div class="resume-preview-wrapper">
                    <div class="preview-header">
                        <h3>Live Preview</h3>
                        <div class="zoom-controls">
                            <button class="zoom-btn" onclick="zoomOut()" title="Zoom Out">−</button>
                            <button class="zoom-btn" onclick="zoomIn()" title="Zoom In">+</button>
                        </div>
                    </div>
                    <div class="resume-canvas" id="resumeCanvas">
                        <!-- Live preview content will be rendered here -->
                    </div>
                </div>
            </div>

            <div class="wizard-navigation">
                <button class="btn-back" onclick="goToStep(1)">
                    <span>←</span>
                    Back to Templates
                </button>
                <button class="btn-next" onclick="goToStep(3)">
                    Continue to Download
                    <span>→</span>
                </button>
            </div>
        </div>

        <!-- Step 3: Export -->
        <div class="wizard-step" data-step="3">
            <div class="export-container">
                <div class="success-message">
                    <div class="success-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <h3>Your Resume is Ready!</h3>
                    <p>Make final customizations and download your professional resume</p>
                </div>

                <div class="customization-options">
                    <div class="customization-card">
                        <h4>Choose Color Theme</h4>
                        <div class="color-picker">
                            <div class="color-option selected" data-color="#00B4D8" style="background: #00B4D8;" onclick="changeColor('#00B4D8')"></div>
                            <div class="color-option" data-color="#8b5cf6" style="background: #8b5cf6;" onclick="changeColor('#8b5cf6')"></div>
                            <div class="color-option" data-color="#ef4444" style="background: #ef4444;" onclick="changeColor('#ef4444')"></div>
                            <div class="color-option" data-color="#f59e0b" style="background: #f59e0b;" onclick="changeColor('#f59e0b')"></div>
                            <div class="color-option" data-color="#10b981" style="background: #10b981;" onclick="changeColor('#10b981')"></div>
                            <div class="color-option" data-color="#ec4899" style="background: #ec4899;" onclick="changeColor('#ec4899')"></div>
                            <div class="color-option" data-color="#6366f1" style="background: #6366f1;" onclick="changeColor('#6366f1')"></div>
                            <div class="color-option" data-color="#14b8a6" style="background: #14b8a6;" onclick="changeColor('#14b8a6')"></div>
                        </div>
                    </div>

                    <div class="customization-card">
                        <h4>Select Font Style</h4>
                        <div class="font-options">
                            <div class="font-option selected" data-font="system" onclick="changeFont('system')">
                                <div style="font-family: -apple-system, system-ui;"><strong>System Default</strong> - Clean & Professional</div>
                            </div>
                            <div class="font-option" data-font="georgia" onclick="changeFont('georgia')">
                                <div style="font-family: Georgia, serif;"><strong>Georgia</strong> - Classic & Elegant</div>
                            </div>
                            <div class="font-option" data-font="arial" onclick="changeFont('arial')">
                                <div style="font-family: Arial, sans-serif;"><strong>Arial</strong> - Modern & Simple</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="export-preview">
                    <p style="color: #64748b; margin-bottom: 20px;">Preview with selected customizations</p>
                    <div class="export-preview-canvas" id="exportPreviewCanvas">
                        <!-- Final preview -->
                    </div>
                </div>

                <div class="export-actions">
                    <button class="btn-primary" onclick="exportResume()">
                        <span>💾</span>
                        Download as PDF
                    </button>
                    <button class="btn-secondary" onclick="window.print()">
                        <span>🖨️</span>
                        Print Resume
                    </button>
                    <button class="btn-secondary" onclick="createNew()">
                        <span>✨</span>
                        Create Another
                    </button>
                </div>

                <div class="wizard-navigation">
                    <button class="btn-back" onclick="goToStep(2)">
                        <span>←</span>
                        Back to Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // ============================================
    // STATE MANAGEMENT
    // ============================================
    let currentStep = 1;
    let currentTemplate = 'modern';
    let currentZoom = 1;
    let currentColor = '#00B4D8';
    let currentFont = 'system';
    let autoSaveInterval;

    // ============================================
    // INITIALIZATION
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        loadFromLocalStorage();
        setupEventListeners();

        // Select the modern template by default if no template is selected
        if (!document.querySelector('.template-card.selected')) {
            const modernCard = document.querySelector('[data-template="modern"]');
            if (modernCard) {
                modernCard.classList.add('selected');
            }
        }

        updatePreview();
        calculateProgress();
        startAutoSave();
    });

    function setupEventListeners() {
        // Template selection
        document.querySelectorAll('.template-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.template-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                currentTemplate = this.dataset.template;
                updatePreview(); // Update preview when template changes
                saveToLocalStorage();
            });
        });

        // Form inputs - live update
        document.querySelectorAll('.form-input, .form-textarea').forEach(input => {
            input.addEventListener('input', function() {
                updatePreview();
                calculateProgress();
            });
        });

        // Section toggles
        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('click', function() {
                this.classList.toggle('collapsed');
                const content = this.nextElementSibling;
                content.classList.toggle('hidden');
            });
        });
    }

    // ============================================
    // WIZARD NAVIGATION
    // ============================================
    function goToStep(step) {
        // Validate current step before proceeding
        if (currentStep === 1 && step > 1) {
            // Template must be selected
            if (!currentTemplate) {
                alert('Please select a template first!');
                return;
            }
        }

        if (currentStep === 2 && step > 2) {
            // Basic validation
            if (!document.getElementById('fullName').value) {
                alert('Please fill in at least your name before continuing!');
                return;
            }
        }

        // Hide all steps
        document.querySelectorAll('.wizard-step').forEach(s => {
            s.classList.remove('active');
        });

        // Show target step
        document.querySelector(`.wizard-step[data-step="${step}"]`).classList.add('active');

        // Update progress indicators
        document.querySelectorAll('.progress-step').forEach(s => {
            const stepNum = parseInt(s.dataset.step);
            s.classList.remove('active', 'completed');

            if (stepNum === step) {
                s.classList.add('active');
            } else if (stepNum < step) {
                s.classList.add('completed');
            }
        });

        // Update connectors
        document.querySelectorAll('.progress-connector').forEach((conn, index) => {
            if (index < step - 1) {
                conn.classList.add('completed');
            } else {
                conn.classList.remove('completed');
            }
        });

        currentStep = step;

        // Special actions for step 3
        if (step === 3) {
            updateExportPreview();
            showConfetti();
        }

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        saveToLocalStorage();
    }

    // ============================================
    // PREVIEW UPDATE
    // ============================================
    function updatePreview() {
        const canvas = document.getElementById('resumeCanvas');

        // Get form data
        const data = {
            name: document.getElementById('fullName')?.value || 'Your Name',
            title: document.getElementById('jobTitle')?.value || 'Your Title',
            email: document.getElementById('email')?.value || 'email@example.com',
            phone: document.getElementById('phone')?.value || 'Phone',
            location: document.getElementById('location')?.value || 'Location',
            linkedin: document.getElementById('linkedin')?.value || 'LinkedIn',
            summary: document.getElementById('summary')?.value || '',
            skills: document.getElementById('skills')?.value?.split(',').map(s => s.trim()).filter(s => s) || [],
            experience: collectExperience(),
            education: collectEducation()
        };

        // Render template
        canvas.innerHTML = renderTemplate(currentTemplate, data);

        // Auto-save
        saveToLocalStorage();
    }

    function collectExperience() {
        const items = [];
        document.querySelectorAll('.experience-item').forEach(item => {
            const title = item.querySelector('.exp-title')?.value || '';
            const company = item.querySelector('.exp-company')?.value || '';
            const start = item.querySelector('.exp-start')?.value || '';
            const end = item.querySelector('.exp-end')?.value || '';
            const desc = item.querySelector('.exp-desc')?.value || '';

            if (title || company) {
                items.push({ title, company, start, end, desc });
            }
        });
        return items;
    }

    function collectEducation() {
        const items = [];
        document.querySelectorAll('.education-item').forEach(item => {
            const degree = item.querySelector('.edu-degree')?.value || '';
            const school = item.querySelector('.edu-school')?.value || '';
            const year = item.querySelector('.edu-year')?.value || '';
            const gpa = item.querySelector('.edu-gpa')?.value || '';

            if (degree || school) {
                items.push({ degree, school, year, gpa });
            }
        });
        return items;
    }

    // ============================================
    // TEMPLATE RENDERER
    // ============================================
    function renderTemplate(template, data) {
        // Icons
        const mailIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>';
        const phoneIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
        const locationIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>';
        const linkedinIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>';

        // Route to specific template
        if (template === 'classic') return renderClassicTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'creative') return renderCreativeTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'minimal') return renderMinimalTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'tech') return renderTechTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'executive') return renderExecutiveTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'designer') return renderDesignerTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'academic') return renderAcademicTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'startup') return renderStartupTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
        if (template === 'international') return renderInternationalTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);

        // Default: Modern template
        return renderModernTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon);
    }

    // Modern Template - Clean & Professional (Centered Header)
    function renderModernTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div class="resume-header">
                <h1>${data.name}</h1>
                <h2>${data.title}</h2>
                <div class="contact-info">
                    ${data.email ? `<a href="mailto:${data.email}">${mailIcon} ${data.email}</a>` : ''}
                    ${data.phone ? `<a href="tel:${data.phone.replace(/\s/g, '')}">${phoneIcon} ${data.phone}</a>` : ''}
                    ${data.location ? `<span>${locationIcon} ${data.location}</span>` : ''}
                    ${data.linkedin ? `<a href="https://${data.linkedin}" target="_blank" rel="noopener">${linkedinIcon} ${data.linkedin}</a>` : ''}
                </div>
            </div>

            ${data.summary ? `
                <div class="resume-section">
                    <h3>Professional Summary</h3>
                    <p style="line-height: 1.8;">${data.summary}</p>
                </div>
            ` : ''}

            ${data.experience.length > 0 ? `
                <div class="resume-section">
                    <h3>Work Experience</h3>
                    ${data.experience.map(exp => `
                        <div class="job-entry">
                            <div class="job-header">
                                <div>
                                    <div class="job-title">${exp.title}</div>
                                    <div class="company-name">${exp.company}</div>
                                </div>
                                <div class="date-range">${exp.start} - ${exp.end}</div>
                            </div>
                            ${exp.desc ? `<div class="job-desc">${exp.desc}</div>` : ''}
                        </div>
                    `).join('')}
                </div>
            ` : ''}

            ${data.skills.length > 0 ? `
                <div class="resume-section">
                    <h3>Technical Skills</h3>
                    <div class="skills-grid">
                        ${data.skills.map(skill => `<span class="skill-tag">${skill}</span>`).join('')}
                    </div>
                </div>
            ` : ''}

            ${data.education.length > 0 ? `
                <div class="resume-section">
                    <h3>Education</h3>
                    ${data.education.map(edu => `
                        <div class="edu-entry">
                            <div class="edu-header">
                                <div>
                                    <div class="edu-degree">${edu.degree}</div>
                                    <div class="school-name">${edu.school}</div>
                                </div>
                                <div class="date-range">${edu.year}${edu.gpa ? ` • GPA: ${edu.gpa}` : ''}</div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            ` : ''}

            <div class="resume-section">
                <h3>Certifications & Achievements</h3>
                <div class="job-entry">
                    <div class="job-desc">
                        • AWS Certified Solutions Architect - Professional (2023)<br>
                        • Google Cloud Professional Developer (2022)<br>
                        • MongoDB Certified Developer (2021)<br>
                        • Speaker at TechConf 2023 - "Building Scalable Microservices"<br>
                        • Winner of Company Hackathon 2022 - Best Innovation Award
                    </div>
                </div>
            </div>

            <div class="resume-section">
                <h3>Key Projects</h3>
                <div class="job-entry">
                    <div class="job-title">E-Commerce Platform Modernization</div>
                    <div class="job-desc" style="margin-top: 8px;">
                        Led migration of legacy monolith to microservices architecture. Reduced infrastructure costs by 35% and improved system reliability to 99.9% uptime.
                    </div>
                </div>
                <div class="job-entry" style="margin-top: 16px;">
                    <div class="job-title">Real-time Analytics Dashboard</div>
                    <div class="job-desc" style="margin-top: 8px;">
                        Built real-time data visualization platform processing 10M+ events daily. Enabled data-driven decision making across organization.
                    </div>
                </div>
            </div>
        `;
    }

    // Classic Template - Traditional with Sidebar (Left sidebar with photo placeholder)
    function renderClassicTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="display: grid; grid-template-columns: 220px 1fr; gap: 30px;">
                <!-- Left Sidebar -->
                <div style="background: #f8fafc; padding: 20px; border-radius: 8px;">
                    <!-- Photo Placeholder -->
                    <div style="width: 160px; height: 160px; background: linear-gradient(135deg, #00B4D8, #00C896); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: 700;">${data.name.charAt(0)}</div>

                    <div style="margin-bottom: 24px;">
                        <h3 style="font-size: 14px; color: #00B4D8; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Contact</h3>
                        <div style="font-size: 11px; line-height: 1.8; color: #475569;">
                            ${data.email ? `<div style="margin-bottom: 8px; word-break: break-all;">${mailIcon} ${data.email}</div>` : ''}
                            ${data.phone ? `<div style="margin-bottom: 8px;">${phoneIcon} ${data.phone}</div>` : ''}
                            ${data.location ? `<div style="margin-bottom: 8px;">${locationIcon} ${data.location}</div>` : ''}
                        </div>
                    </div>

                    ${data.skills.length > 0 ? `
                        <div>
                            <h3 style="font-size: 14px; color: #00B4D8; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Skills</h3>
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                ${data.skills.slice(0, 8).map(skill => `<div style="font-size: 11px; padding: 6px 10px; background: white; border-radius: 4px; color: #475569; font-weight: 500;">${skill}</div>`).join('')}
                            </div>
                        </div>
                    ` : ''}
                </div>

                <!-- Main Content -->
                <div>
                    <div style="margin-bottom: 24px;">
                        <h1 style="font-size: 32px; margin-bottom: 6px; color: #1e293b;">${data.name}</h1>
                        <h2 style="font-size: 16px; color: #00B4D8; font-weight: 600; margin-bottom: 16px;">${data.title}</h2>
                        ${data.summary ? `<p style="color: #475569; line-height: 1.6; font-size: 13px;">${data.summary}</p>` : ''}
                    </div>

                    ${data.experience.length > 0 ? `
                        <div style="margin-bottom: 24px;">
                            <h3 style="font-size: 18px; color: #1e293b; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #00B4D8;">Experience</h3>
                            ${data.experience.map(exp => `
                                <div style="margin-bottom: 20px;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
                                        <div>
                                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">${exp.title}</div>
                                            <div style="color: #00B4D8; font-size: 13px; font-weight: 600;">${exp.company}</div>
                                        </div>
                                        <div style="font-size: 12px; color: #94a3b8;">${exp.start} - ${exp.end}</div>
                                    </div>
                                    ${exp.desc ? `<div style="color: #475569; font-size: 12px; line-height: 1.6;">${exp.desc}</div>` : ''}
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}

                    ${data.education.length > 0 ? `
                        <div>
                            <h3 style="font-size: 18px; color: #1e293b; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #00B4D8;">Education</h3>
                            ${data.education.map(edu => `
                                <div style="margin-bottom: 16px;">
                                    <div style="font-weight: 700; color: #1e293b; font-size: 14px;">${edu.degree}</div>
                                    <div style="color: #00B4D8; font-size: 13px; font-weight: 600;">${edu.school}</div>
                                    <div style="font-size: 12px; color: #94a3b8;">${edu.year}${edu.gpa ? ` • GPA: ${edu.gpa}` : ''}</div>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    // Minimal Template - Ultra Clean (No borders, minimal styling)
    function renderMinimalTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="padding: 20px 0;">
                <h1 style="font-size: 42px; margin-bottom: 4px; color: #1e293b; font-weight: 300; letter-spacing: -1px;">${data.name}</h1>
                <h2 style="font-size: 14px; color: #64748b; font-weight: 400; margin-bottom: 20px; letter-spacing: 2px;">${data.title.toUpperCase()}</h2>
                <div style="display: flex; gap: 20px; font-size: 12px; color: #64748b; margin-bottom: 40px; flex-wrap: wrap;">
                    ${data.email ? `<span>${data.email}</span>` : ''}
                    ${data.phone ? `<span>${data.phone}</span>` : ''}
                    ${data.location ? `<span>${data.location}</span>` : ''}
                </div>

                ${data.summary ? `
                    <div style="margin-bottom: 36px;">
                        <p style="color: #475569; line-height: 1.9; font-size: 13px; font-weight: 300;">${data.summary}</p>
                    </div>
                ` : ''}

                ${data.experience.length > 0 ? `
                    <div style="margin-bottom: 36px;">
                        <h3 style="font-size: 12px; color: #94a3b8; margin-bottom: 20px; letter-spacing: 3px; font-weight: 600;">EXPERIENCE</h3>
                        ${data.experience.map(exp => `
                            <div style="margin-bottom: 24px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                                    <div style="font-weight: 600; color: #1e293b; font-size: 14px;">${exp.title} • ${exp.company}</div>
                                    <div style="font-size: 12px; color: #94a3b8;">${exp.start} - ${exp.end}</div>
                                </div>
                                ${exp.desc ? `<div style="color: #64748b; font-size: 12px; line-height: 1.7; font-weight: 300;">${exp.desc}</div>` : ''}
                            </div>
                        `).join('')}
                    </div>
                ` : ''}

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 36px;">
                    ${data.education.length > 0 ? `
                        <div>
                            <h3 style="font-size: 12px; color: #94a3b8; margin-bottom: 16px; letter-spacing: 3px; font-weight: 600;">EDUCATION</h3>
                            ${data.education.map(edu => `
                                <div style="margin-bottom: 16px;">
                                    <div style="font-weight: 600; color: #1e293b; font-size: 13px;">${edu.degree}</div>
                                    <div style="color: #64748b; font-size: 12px;">${edu.school}</div>
                                    <div style="font-size: 11px; color: #94a3b8;">${edu.year}</div>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}

                    ${data.skills.length > 0 ? `
                        <div>
                            <h3 style="font-size: 12px; color: #94a3b8; margin-bottom: 16px; letter-spacing: 3px; font-weight: 600;">SKILLS</h3>
                            <div style="font-size: 12px; color: #64748b; line-height: 1.8; font-weight: 300;">
                                ${data.skills.join(' • ')}
                            </div>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    // Creative Template - Bold & Colorful (Asymmetric layout)
    function renderCreativeTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; margin: -60px -60px 24px -60px; color: white;">
                <h1 style="font-size: 40px; margin-bottom: 8px; font-weight: 900;">${data.name}</h1>
                <h2 style="font-size: 18px; opacity: 0.9; font-weight: 400;">${data.title}</h2>
            </div>

            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;">
                <div>
                    ${data.summary ? `
                        <div style="margin-bottom: 28px; background: #f0fdf4; padding: 20px; border-left: 4px solid #10b981; border-radius: 8px;">
                            <h3 style="font-size: 16px; color: #059669; margin-bottom: 12px; font-weight: 700;">About Me</h3>
                            <p style="color: #065f46; line-height: 1.7; font-size: 13px;">${data.summary}</p>
                        </div>
                    ` : ''}

                    ${data.experience.length > 0 ? `
                        <div>
                            <h3 style="font-size: 20px; color: #667eea; margin-bottom: 20px; font-weight: 800;">Work Experience</h3>
                            ${data.experience.map(exp => `
                                <div style="margin-bottom: 24px; padding-left: 20px; border-left: 3px solid #e0e7ff;">
                                    <div style="font-weight: 700; color: #4338ca; font-size: 15px; margin-bottom: 4px;">${exp.title}</div>
                                    <div style="color: #6366f1; font-size: 14px; font-weight: 600; margin-bottom: 4px;">${exp.company} • ${exp.start} - ${exp.end}</div>
                                    ${exp.desc ? `<div style="color: #475569; font-size: 12px; line-height: 1.6;">${exp.desc}</div>` : ''}
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>

                <div>
                    <div style="background: #fef3c7; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                        <h3 style="font-size: 16px; color: #d97706; margin-bottom: 12px; font-weight: 700;">Contact</h3>
                        <div style="font-size: 11px; color: #92400e; line-height: 2;">
                            ${data.email ? `<div>${data.email}</div>` : ''}
                            ${data.phone ? `<div>${data.phone}</div>` : ''}
                            ${data.location ? `<div>${data.location}</div>` : ''}
                        </div>
                    </div>

                    ${data.skills.length > 0 ? `
                        <div style="background: #dbeafe; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                            <h3 style="font-size: 16px; color: #1d4ed8; margin-bottom: 12px; font-weight: 700;">Skills</h3>
                            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                ${data.skills.map(skill => `<span style="background: #3b82f6; color: white; padding: 5px 12px; border-radius: 20px; font-size: 10px; font-weight: 600;">${skill}</span>`).join('')}
                            </div>
                        </div>
                    ` : ''}

                    ${data.education.length > 0 ? `
                        <div style="background: #fce7f3; padding: 20px; border-radius: 12px;">
                            <h3 style="font-size: 16px; color: #be185d; margin-bottom: 12px; font-weight: 700;">Education</h3>
                            ${data.education.map(edu => `
                                <div style="margin-bottom: 12px;">
                                    <div style="font-weight: 600; color: #9f1239; font-size: 12px;">${edu.degree}</div>
                                    <div style="color: #be185d; font-size: 11px;">${edu.school}</div>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    // Tech Template - Code Style (Monospace, dark theme elements)
    function renderTechTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="font-family: 'Courier New', monospace; background: #1e293b; color: #e2e8f0; padding: 24px; margin: -60px -60px 24px -60px; border-radius: 8px;">
                <div style="color: #10b981; font-size: 14px; margin-bottom: 8px;">// Software Developer</div>
                <h1 style="font-size: 36px; margin-bottom: 8px; color: #f8fafc;">${data.name}</h1>
                <h2 style="font-size: 16px; color: #64748b;">&lt;${data.title} /&gt;</h2>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
                <div>
                    ${data.summary ? `
                        <div style="margin-bottom: 24px; font-family: 'Courier New', monospace;">
                            <div style="color: #10b981; font-size: 14px; margin-bottom: 8px;">/** About **/</div>
                            <p style="color: #475569; line-height: 1.7; font-size: 12px; border-left: 3px solid #10b981; padding-left: 16px;">${data.summary}</p>
                        </div>
                    ` : ''}

                    ${data.experience.length > 0 ? `
                        <div style="margin-bottom: 24px;">
                            <h3 style="font-size: 18px; color: #1e293b; margin-bottom: 16px; font-family: 'Courier New', monospace;">&gt; Experience_</h3>
                            ${data.experience.map(exp => `
                                <div style="margin-bottom: 20px; background: #f8fafc; padding: 16px; border-radius: 8px; border-left: 4px solid #3b82f6;">
                                    <div style="font-weight: 700; color: #1e293b; font-size: 14px; font-family: 'Courier New', monospace;">{${exp.title}}</div>
                                    <div style="color: #3b82f6; font-size: 13px; margin: 4px 0; font-family: 'Courier New', monospace;">@ ${exp.company} | ${exp.start} - ${exp.end}</div>
                                    ${exp.desc ? `<div style="color: #475569; font-size: 12px; line-height: 1.6; margin-top: 8px;">${exp.desc}</div>` : ''}
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>

                <div>
                    <div style="background: #0f172a; color: #e2e8f0; padding: 20px; border-radius: 8px; margin-bottom: 20px; font-family: 'Courier New', monospace;">
                        <div style="color: #10b981; margin-bottom: 12px; font-size: 13px;">// Contact</div>
                        <div style="font-size: 11px; line-height: 2; color: #94a3b8;">
                            ${data.email ? `<div>📧 ${data.email}</div>` : ''}
                            ${data.phone ? `<div>📱 ${data.phone}</div>` : ''}
                            ${data.location ? `<div>📍 ${data.location}</div>` : ''}
                        </div>
                    </div>

                    ${data.skills.length > 0 ? `
                        <div style="background: #f1f5f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                            <div style="color: #3b82f6; margin-bottom: 12px; font-size: 13px; font-family: 'Courier New', monospace; font-weight: 700;">const skills = [</div>
                            <div style="padding-left: 16px; font-size: 11px; color: #475569; line-height: 1.8; font-family: 'Courier New', monospace;">
                                ${data.skills.map(skill => `"${skill}",`).join('<br>')}
                            </div>
                            <div style="color: #3b82f6; font-family: 'Courier New', monospace; font-weight: 700;">];</div>
                        </div>
                    ` : ''}

                    ${data.education.length > 0 ? `
                        <div style="background: #f1f5f9; padding: 20px; border-radius: 8px;">
                            <div style="color: #8b5cf6; margin-bottom: 12px; font-size: 13px; font-family: 'Courier New', monospace;">&lt;Education&gt;</div>
                            ${data.education.map(edu => `
                                <div style="margin-bottom: 12px; padding-left: 12px; border-left: 2px solid #8b5cf6;">
                                    <div style="font-weight: 600; color: #1e293b; font-size: 12px;">${edu.degree}</div>
                                    <div style="color: #64748b; font-size: 11px;">${edu.school}</div>
                                </div>
                            `).join('')}
                            <div style="color: #8b5cf6; font-family: 'Courier New', monospace;">&lt;/Education&gt;</div>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    // Executive Template - Premium with Photo
    function renderExecutiveTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="display: grid; grid-template-columns: 180px 1fr; gap: 40px; margin-bottom: 32px; padding-bottom: 32px; border-bottom: 3px solid #1e293b;">
                <div style="width: 160px; height: 160px; background: linear-gradient(135deg, #1e293b, #475569); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 56px; font-weight: 700; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">${data.name.charAt(0)}</div>
                <div>
                    <h1 style="font-size: 40px; margin-bottom: 8px; color: #1e293b; font-weight: 700;">${data.name}</h1>
                    <h2 style="font-size: 18px; color: #64748b; font-weight: 500; margin-bottom: 16px;">${data.title}</h2>
                    <div style="display: flex; gap: 24px; font-size: 12px; color: #64748b;">
                        ${data.email ? `<span>${mailIcon} ${data.email}</span>` : ''}
                        ${data.phone ? `<span>${phoneIcon} ${data.phone}</span>` : ''}
                        ${data.location ? `<span>${locationIcon} ${data.location}</span>` : ''}
                    </div>
                </div>
            </div>

            ${data.summary ? `
                <div style="background: #f8fafc; padding: 24px; border-radius: 8px; margin-bottom: 28px; border-left: 4px solid #1e293b;">
                    <h3 style="font-size: 16px; color: #1e293b; margin-bottom: 12px; font-weight: 700;">Executive Summary</h3>
                    <p style="color: #475569; line-height: 1.8; font-size: 13px;">${data.summary}</p>
                </div>
            ` : ''}

            ${data.experience.length > 0 ? `
                <div style="margin-bottom: 28px;">
                    <h3 style="font-size: 22px; color: #1e293b; margin-bottom: 20px; font-weight: 700;">Professional Experience</h3>
                    ${data.experience.map(exp => `
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                <div>
                                    <div style="font-weight: 700; color: #1e293b; font-size: 16px;">${exp.title}</div>
                                    <div style="color: #3b82f6; font-size: 14px; font-weight: 600;">${exp.company}</div>
                                </div>
                                <div style="font-size: 13px; color: #64748b; font-weight: 500; white-space: nowrap; margin-left: 20px;">${exp.start} - ${exp.end}</div>
                            </div>
                            ${exp.desc ? `<div style="color: #475569; font-size: 13px; line-height: 1.7;">${exp.desc}</div>` : ''}
                        </div>
                    `).join('')}
                </div>
            ` : ''}

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 28px;">
                ${data.education.length > 0 ? `
                    <div>
                        <h3 style="font-size: 18px; color: #1e293b; margin-bottom: 16px; font-weight: 700;">Education</h3>
                        ${data.education.map(edu => `
                            <div style="margin-bottom: 16px;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 14px;">${edu.degree}</div>
                                <div style="color: #3b82f6; font-size: 13px; font-weight: 600;">${edu.school}</div>
                                <div style="font-size: 12px; color: #64748b;">${edu.year}</div>
                            </div>
                        `).join('')}
                    </div>
                ` : ''}

                ${data.skills.length > 0 ? `
                    <div>
                        <h3 style="font-size: 18px; color: #1e293b; margin-bottom: 16px; font-weight: 700;">Core Competencies</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                            ${data.skills.map(skill => `<div style="font-size: 12px; color: #475569; padding: 8px 12px; background: #f1f5f9; border-radius: 6px; font-weight: 500;">• ${skill}</div>`).join('')}
                        </div>
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Designer Template - Portfolio Focused with Right Sidebar
    function renderDesignerTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="display: grid; grid-template-columns: 1fr 280px; gap: 36px;">
                <div>
                    <div style="margin-bottom: 32px;">
                        <h1 style="font-size: 48px; margin-bottom: 8px; color: #0f172a; font-weight: 900; letter-spacing: -2px; line-height: 1;">${data.name}</h1>
                        <h2 style="font-size: 20px; color: #f97316; font-weight: 600; text-transform: uppercase; letter-spacing: 4px;">${data.title}</h2>
                    </div>

                    ${data.summary ? `
                        <div style="margin-bottom: 32px;">
                            <div style="display: inline-block; background: #0f172a; color: white; padding: 6px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px;">Profile</div>
                            <p style="color: #475569; line-height: 1.8; font-size: 14px;">${data.summary}</p>
                        </div>
                    ` : ''}

                    ${data.experience.length > 0 ? `
                        <div style="margin-bottom: 32px;">
                            <div style="display: inline-block; background: #0f172a; color: white; padding: 6px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px;">Experience</div>
                            ${data.experience.map(exp => `
                                <div style="margin-bottom: 24px; position: relative; padding-left: 24px; border-left: 4px solid #f97316;">
                                    <div style="font-weight: 800; color: #0f172a; font-size: 16px; margin-bottom: 4px;">${exp.title}</div>
                                    <div style="color: #f97316; font-size: 14px; font-weight: 600; margin-bottom: 6px;">${exp.company} • ${exp.start} - ${exp.end}</div>
                                    ${exp.desc ? `<div style="color: #64748b; font-size: 13px; line-height: 1.7;">${exp.desc}</div>` : ''}
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}

                    ${data.education.length > 0 ? `
                        <div>
                            <div style="display: inline-block; background: #0f172a; color: white; padding: 6px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px;">Education</div>
                            ${data.education.map(edu => `
                                <div style="margin-bottom: 16px;">
                                    <div style="font-weight: 700; color: #0f172a; font-size: 14px;">${edu.degree}</div>
                                    <div style="color: #f97316; font-size: 13px; font-weight: 600;">${edu.school}</div>
                                    <div style="font-size: 12px; color: #64748b;">${edu.year}</div>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>

                <div>
                    <div style="background: #0f172a; color: white; padding: 24px; border-radius: 12px; margin-bottom: 20px;">
                        <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #f97316, #ea580c); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 900; box-shadow: 0 8px 24px rgba(249,115,22,0.3);">${data.name.charAt(0)}</div>
                        <div style="font-size: 11px; line-height: 2.2; color: #cbd5e1; word-break: break-word;">
                            ${data.email ? `<div style="margin-bottom: 8px;">${mailIcon} ${data.email}</div>` : ''}
                            ${data.phone ? `<div style="margin-bottom: 8px;">${phoneIcon} ${data.phone}</div>` : ''}
                            ${data.location ? `<div style="margin-bottom: 8px;">${locationIcon} ${data.location}</div>` : ''}
                            ${data.linkedin ? `<div>${linkedinIcon} ${data.linkedin}</div>` : ''}
                        </div>
                    </div>

                    ${data.skills.length > 0 ? `
                        <div style="background: #fff7ed; padding: 20px; border-radius: 12px; border: 2px solid #f97316;">
                            <h3 style="font-size: 14px; color: #0f172a; margin-bottom: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Skills</h3>
                            <div>
                                ${data.skills.map(skill => `
                                    <div style="margin-bottom: 12px;">
                                        <div style="font-size: 11px; color: #0f172a; font-weight: 600; margin-bottom: 4px;">${skill}</div>
                                        <div style="background: #ffedd5; height: 6px; border-radius: 3px; overflow: hidden;">
                                            <div style="background: linear-gradient(90deg, #f97316, #ea580c); height: 100%; width: ${85 + Math.random() * 15}%; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    // Academic Template - Traditional CV Style
    function renderAcademicTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="text-align: center; border-bottom: 2px solid #1e293b; padding-bottom: 24px; margin-bottom: 28px;">
                <h1 style="font-size: 36px; margin-bottom: 8px; color: #1e293b; font-weight: 700; font-family: Georgia, serif;">${data.name}</h1>
                <h2 style="font-size: 16px; color: #64748b; font-weight: 400; margin-bottom: 16px; font-style: italic;">${data.title}</h2>
                <div style="font-size: 12px; color: #475569; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                    ${data.email ? `<span>${data.email}</span>` : ''}
                    ${data.phone ? `<span>•</span><span>${data.phone}</span>` : ''}
                    ${data.location ? `<span>•</span><span>${data.location}</span>` : ''}
                </div>
            </div>

            ${data.summary ? `
                <div style="margin-bottom: 28px;">
                    <h3 style="font-size: 16px; color: #1e293b; margin-bottom: 12px; font-weight: 700; font-family: Georgia, serif; border-bottom: 1px solid #cbd5e1; padding-bottom: 6px;">Research Interests</h3>
                    <p style="color: #475569; line-height: 1.9; font-size: 13px; text-align: justify;">${data.summary}</p>
                </div>
            ` : ''}

            ${data.education.length > 0 ? `
                <div style="margin-bottom: 28px;">
                    <h3 style="font-size: 16px; color: #1e293b; margin-bottom: 12px; font-weight: 700; font-family: Georgia, serif; border-bottom: 1px solid #cbd5e1; padding-bottom: 6px;">Education</h3>
                    ${data.education.map(edu => `
                        <div style="margin-bottom: 16px; padding-left: 20px; position: relative;">
                            <div style="position: absolute; left: 0; top: 6px; width: 6px; height: 6px; background: #1e293b; border-radius: 50%;"></div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">${edu.degree}</div>
                            <div style="color: #475569; font-size: 13px; font-style: italic;">${edu.school}, ${edu.year}</div>
                            ${edu.gpa ? `<div style="font-size: 12px; color: #64748b;">GPA: ${edu.gpa}</div>` : ''}
                        </div>
                    `).join('')}
                </div>
            ` : ''}

            ${data.experience.length > 0 ? `
                <div style="margin-bottom: 28px;">
                    <h3 style="font-size: 16px; color: #1e293b; margin-bottom: 12px; font-weight: 700; font-family: Georgia, serif; border-bottom: 1px solid #cbd5e1; padding-bottom: 6px;">Professional Experience</h3>
                    ${data.experience.map(exp => `
                        <div style="margin-bottom: 20px; padding-left: 20px; position: relative;">
                            <div style="position: absolute; left: 0; top: 6px; width: 6px; height: 6px; background: #1e293b; border-radius: 50%;"></div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 14px;">${exp.title}</div>
                                <div style="font-size: 12px; color: #64748b; white-space: nowrap; margin-left: 20px;">${exp.start} - ${exp.end}</div>
                            </div>
                            <div style="color: #475569; font-size: 13px; font-style: italic; margin-bottom: 6px;">${exp.company}</div>
                            ${exp.desc ? `<div style="color: #64748b; font-size: 12px; line-height: 1.7; text-align: justify;">${exp.desc}</div>` : ''}
                        </div>
                    `).join('')}
                </div>
            ` : ''}

            ${data.skills.length > 0 ? `
                <div style="margin-bottom: 28px;">
                    <h3 style="font-size: 16px; color: #1e293b; margin-bottom: 12px; font-weight: 700; font-family: Georgia, serif; border-bottom: 1px solid #cbd5e1; padding-bottom: 6px;">Technical Skills & Competencies</h3>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; padding-left: 20px;">
                        ${data.skills.map(skill => `<div style="font-size: 12px; color: #475569;">• ${skill}</div>`).join('')}
                    </div>
                </div>
            ` : ''}

            <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid #cbd5e1;">
                <div style="background: #f8fafc; padding: 16px; border-left: 4px solid #1e293b; font-size: 11px; color: #64748b; font-style: italic;">
                    <strong style="color: #1e293b;">Publications & Research:</strong> Available upon request
                </div>
            </div>
        `;
    }

    // Startup Template - Energetic with Metrics Focus
    function renderStartupTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 32px; margin: -60px -60px 32px -60px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                <div style="position: relative; z-index: 1;">
                    <h1 style="font-size: 44px; margin-bottom: 8px; color: white; font-weight: 900;">${data.name}</h1>
                    <h2 style="font-size: 18px; color: rgba(255,255,255,0.9); font-weight: 600;">${data.title}</h2>
                    <div style="margin-top: 20px; display: flex; gap: 20px; font-size: 12px; color: rgba(255,255,255,0.95); flex-wrap: wrap;">
                        ${data.email ? `<span style="background: rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 20px;">${data.email}</span>` : ''}
                        ${data.phone ? `<span style="background: rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 20px;">${data.phone}</span>` : ''}
                        ${data.location ? `<span style="background: rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 20px;">${data.location}</span>` : ''}
                    </div>
                </div>
            </div>

            ${data.summary ? `
                <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); padding: 24px; border-radius: 16px; margin-bottom: 28px; border: 2px solid #10b981;">
                    <h3 style="font-size: 18px; color: #065f46; margin-bottom: 12px; font-weight: 800;">🚀 Mission Statement</h3>
                    <p style="color: #047857; line-height: 1.8; font-size: 14px; font-weight: 500;">${data.summary}</p>
                </div>
            ` : ''}

            ${data.experience.length > 0 ? `
                <div style="margin-bottom: 32px;">
                    <h3 style="font-size: 22px; color: #1e293b; margin-bottom: 20px; font-weight: 800;">💼 Impact & Experience</h3>
                    <div style="display: grid; gap: 20px;">
                        ${data.experience.map((exp, idx) => `
                            <div style="background: ${idx % 2 === 0 ? '#f0fdfa' : '#fef3c7'}; padding: 20px; border-radius: 12px; border-left: 6px solid ${idx % 2 === 0 ? '#14b8a6' : '#fbbf24'}; position: relative;">
                                <div style="position: absolute; top: 20px; right: 20px; background: ${idx % 2 === 0 ? '#14b8a6' : '#f59e0b'}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 700;">ACHIEVEMENT</div>
                                <div style="font-weight: 800; color: ${idx % 2 === 0 ? '#0f766e' : '#92400e'}; font-size: 16px; margin-bottom: 6px;">${exp.title}</div>
                                <div style="color: ${idx % 2 === 0 ? '#14b8a6' : '#f59e0b'}; font-size: 14px; font-weight: 700; margin-bottom: 8px;">${exp.company} • ${exp.start} - ${exp.end}</div>
                                ${exp.desc ? `<div style="color: #475569; font-size: 13px; line-height: 1.7;">${exp.desc}</div>` : ''}
                            </div>
                        `).join('')}
                    </div>
                </div>
            ` : ''}

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                ${data.skills.length > 0 ? `
                    <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); padding: 24px; border-radius: 16px; border: 2px solid #0ea5e9;">
                        <h3 style="font-size: 18px; color: #0c4a6e; margin-bottom: 16px; font-weight: 800;">⚡ Tech Stack</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            ${data.skills.map(skill => `<span style="background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; padding: 8px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; box-shadow: 0 2px 8px rgba(14,165,233,0.3);">${skill}</span>`).join('')}
                        </div>
                    </div>
                ` : ''}

                ${data.education.length > 0 ? `
                    <div style="background: linear-gradient(135deg, #fdf4ff, #fae8ff); padding: 24px; border-radius: 16px; border: 2px solid #a855f7;">
                        <h3 style="font-size: 18px; color: #581c87; margin-bottom: 16px; font-weight: 800;">🎓 Education</h3>
                        ${data.education.map(edu => `
                            <div style="margin-bottom: 12px;">
                                <div style="font-weight: 700; color: #6b21a8; font-size: 13px;">${edu.degree}</div>
                                <div style="color: #a855f7; font-size: 12px; font-weight: 600;">${edu.school}</div>
                                <div style="font-size: 11px; color: #9333ea;">${edu.year}</div>
                            </div>
                        `).join('')}
                    </div>
                ` : ''}
            </div>
        `;
    }

    // International Template - Europass Style
    function renderInternationalTemplate(data, mailIcon, phoneIcon, locationIcon, linkedinIcon) {
        return `
            <div style="background: #1e40af; color: white; padding: 24px 32px; margin: -60px -60px 32px -60px;">
                <div style="display: grid; grid-template-columns: auto 1fr; gap: 24px; align-items: center;">
                    <div style="width: 100px; height: 100px; background: white; color: #1e40af; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 700; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">${data.name.charAt(0)}</div>
                    <div>
                        <h1 style="font-size: 32px; margin-bottom: 6px; font-weight: 700;">${data.name}</h1>
                        <h2 style="font-size: 16px; opacity: 0.9; font-weight: 500;">${data.title}</h2>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 300px 1fr; gap: 32px;">
                <div>
                    <div style="margin-bottom: 24px;">
                        <h3 style="background: #1e40af; color: white; padding: 8px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">Contact Information</h3>
                        <div style="font-size: 11px; color: #475569; line-height: 2.2;">
                            ${data.email ? `<div style="margin-bottom: 8px;"><strong style="color: #1e293b;">Email:</strong><br>${data.email}</div>` : ''}
                            ${data.phone ? `<div style="margin-bottom: 8px;"><strong style="color: #1e293b;">Phone:</strong><br>${data.phone}</div>` : ''}
                            ${data.location ? `<div style="margin-bottom: 8px;"><strong style="color: #1e293b;">Location:</strong><br>${data.location}</div>` : ''}
                            ${data.linkedin ? `<div><strong style="color: #1e293b;">LinkedIn:</strong><br>${data.linkedin}</div>` : ''}
                        </div>
                    </div>

                    ${data.skills.length > 0 ? `
                        <div style="margin-bottom: 24px;">
                            <h3 style="background: #1e40af; color: white; padding: 8px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">Professional Skills</h3>
                            <div style="font-size: 11px; color: #475569; line-height: 2;">
                                ${data.skills.map(skill => `
                                    <div style="margin-bottom: 10px;">
                                        <div style="font-weight: 600; color: #1e293b; margin-bottom: 3px;">${skill}</div>
                                        <div style="background: #e0e7ff; height: 8px; border-radius: 4px;">
                                            <div style="background: #1e40af; height: 100%; width: ${80 + Math.random() * 20}%; border-radius: 4px;"></div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    ` : ''}

                    <div style="background: #f1f5f9; padding: 16px; border-radius: 8px; border-left: 4px solid #1e40af;">
                        <h4 style="font-size: 11px; color: #1e293b; margin-bottom: 8px; font-weight: 700;">Language Skills</h4>
                        <div style="font-size: 10px; color: #64748b; line-height: 1.8;">
                            <div style="margin-bottom: 6px;"><strong>English:</strong> Fluent (C2)</div>
                            <div style="margin-bottom: 6px;"><strong>Spanish:</strong> Intermediate (B1)</div>
                            <div><strong>German:</strong> Basic (A2)</div>
                        </div>
                    </div>
                </div>

                <div>
                    ${data.summary ? `
                        <div style="margin-bottom: 28px;">
                            <h3 style="background: #1e40af; color: white; padding: 8px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: inline-block;">Professional Profile</h3>
                            <p style="color: #475569; line-height: 1.8; font-size: 13px; text-align: justify;">${data.summary}</p>
                        </div>
                    ` : ''}

                    ${data.experience.length > 0 ? `
                        <div style="margin-bottom: 28px;">
                            <h3 style="background: #1e40af; color: white; padding: 8px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: inline-block;">Work Experience</h3>
                            ${data.experience.map(exp => `
                                <div style="margin-bottom: 20px; border-left: 3px solid #cbd5e1; padding-left: 16px;">
                                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 16px; margin-bottom: 6px;">
                                        <div>
                                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">${exp.title}</div>
                                            <div style="color: #1e40af; font-size: 13px; font-weight: 600;">${exp.company}</div>
                                        </div>
                                        <div style="background: #dbeafe; color: #1e40af; padding: 6px 12px; font-size: 11px; font-weight: 600; border-radius: 6px; height: fit-content;">${exp.start} - ${exp.end}</div>
                                    </div>
                                    ${exp.desc ? `<div style="color: #64748b; font-size: 12px; line-height: 1.7;">${exp.desc}</div>` : ''}
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}

                    ${data.education.length > 0 ? `
                        <div>
                            <h3 style="background: #1e40af; color: white; padding: 8px 16px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: inline-block;">Education & Training</h3>
                            ${data.education.map(edu => `
                                <div style="margin-bottom: 16px; border-left: 3px solid #cbd5e1; padding-left: 16px;">
                                    <div style="font-weight: 700; color: #1e293b; font-size: 13px;">${edu.degree}</div>
                                    <div style="color: #1e40af; font-size: 12px; font-weight: 600;">${edu.school}</div>
                                    <div style="font-size: 11px; color: #64748b;">${edu.year}</div>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }

    // ============================================
    // DYNAMIC ITEMS (Experience/Education)
    // ============================================
    function addExperience() {
        const container = document.getElementById('experienceContainer');
        const item = document.createElement('div');
        item.className = 'experience-item';
        item.innerHTML = `
            <button class="btn-remove-item" onclick="this.parentElement.remove(); updatePreview(); calculateProgress();">Remove</button>
            <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" class="form-input exp-title" placeholder="Senior Developer">
            </div>
            <div class="form-group">
                <label class="form-label">Company</label>
                <input type="text" class="form-input exp-company" placeholder="Company Name">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="text" class="form-input exp-start" placeholder="Jan 2020">
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="text" class="form-input exp-end" placeholder="Present">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-textarea exp-desc" placeholder="Your responsibilities and achievements..."></textarea>
            </div>
        `;
        container.appendChild(item);

        // Add event listeners to new inputs
        item.querySelectorAll('.form-input, .form-textarea').forEach(input => {
            input.addEventListener('input', function() {
                updatePreview();
                calculateProgress();
            });
        });

        updatePreview();
    }

    function addEducation() {
        const container = document.getElementById('educationContainer');
        const item = document.createElement('div');
        item.className = 'education-item';
        item.innerHTML = `
            <button class="btn-remove-item" onclick="this.parentElement.remove(); updatePreview(); calculateProgress();">Remove</button>
            <div class="form-group">
                <label class="form-label">Degree</label>
                <input type="text" class="form-input edu-degree" placeholder="Bachelor of Science">
            </div>
            <div class="form-group">
                <label class="form-label">University</label>
                <input type="text" class="form-input edu-school" placeholder="University Name">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Year</label>
                    <input type="text" class="form-input edu-year" placeholder="2016">
                </div>
                <div class="form-group">
                    <label class="form-label">GPA (Optional)</label>
                    <input type="text" class="form-input edu-gpa" placeholder="3.8/4.0">
                </div>
            </div>
        `;
        container.appendChild(item);

        // Add event listeners to new inputs
        item.querySelectorAll('.form-input, .form-textarea').forEach(input => {
            input.addEventListener('input', function() {
                updatePreview();
                calculateProgress();
            });
        });

        updatePreview();
    }

    // ============================================
    // PROGRESS CALCULATION
    // ============================================
    function calculateProgress() {
        const fields = {
            name: !!document.getElementById('fullName')?.value,
            title: !!document.getElementById('jobTitle')?.value,
            email: !!document.getElementById('email')?.value,
            phone: !!document.getElementById('phone')?.value,
            summary: !!document.getElementById('summary')?.value,
            experience: document.querySelectorAll('.experience-item').length > 0,
            education: document.querySelectorAll('.education-item').length > 0,
            skills: !!document.getElementById('skills')?.value
        };

        const completed = Object.values(fields).filter(Boolean).length;
        const total = Object.keys(fields).length;
        const percentage = Math.round((completed / total) * 100);

        const percentageEl = document.querySelector('.progress-percentage');
        const fillEl = document.querySelector('.progress-bar-fill');

        if (percentageEl) percentageEl.textContent = `${percentage}%`;
        if (fillEl) fillEl.style.width = `${percentage}%`;
    }

    // ============================================
    // ZOOM CONTROLS
    // ============================================
    function zoomIn() {
        if (currentZoom < 1.5) {
            currentZoom += 0.1;
            document.getElementById('resumeCanvas').style.transform = `scale(${currentZoom})`;
        }
    }

    function zoomOut() {
        if (currentZoom > 0.5) {
            currentZoom -= 0.1;
            document.getElementById('resumeCanvas').style.transform = `scale(${currentZoom})`;
        }
    }

    // ============================================
    // CUSTOMIZATION (Step 3)
    // ============================================
    function changeColor(color) {
        currentColor = color;
        document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('selected'));
        event.target.classList.add('selected');
        updateExportPreview();
        saveToLocalStorage();
    }

    function changeFont(font) {
        currentFont = font;
        document.querySelectorAll('.font-option').forEach(opt => opt.classList.remove('selected'));
        event.target.classList.add('selected');
        updateExportPreview();
        saveToLocalStorage();
    }

    function updateExportPreview() {
        const preview = document.getElementById('exportPreviewCanvas');
        if (preview) {
            preview.innerHTML = document.getElementById('resumeCanvas').innerHTML;
            preview.style.color = currentColor;

            // Apply font
            if (currentFont === 'georgia') {
                preview.style.fontFamily = 'Georgia, serif';
            } else if (currentFont === 'arial') {
                preview.style.fontFamily = 'Arial, sans-serif';
            } else {
                preview.style.fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';
            }
        }
    }

    // ============================================
    // AUTO-SAVE & LOCAL STORAGE
    // ============================================
    function saveToLocalStorage() {
        const data = {
            template: currentTemplate,
            step: currentStep,
            color: currentColor,
            font: currentFont,
            formData: {
                name: document.getElementById('fullName')?.value || '',
                title: document.getElementById('jobTitle')?.value || '',
                email: document.getElementById('email')?.value || '',
                phone: document.getElementById('phone')?.value || '',
                location: document.getElementById('location')?.value || '',
                linkedin: document.getElementById('linkedin')?.value || '',
                summary: document.getElementById('summary')?.value || '',
                skills: document.getElementById('skills')?.value || ''
            },
            timestamp: Date.now()
        };

        localStorage.setItem('resumeBuilder', JSON.stringify(data));
    }

    function loadFromLocalStorage() {
        const saved = localStorage.getItem('resumeBuilder');
        if (saved) {
            try {
                const data = JSON.parse(saved);

                // Check if data is recent (within 7 days)
                if (Date.now() - data.timestamp < 7 * 24 * 60 * 60 * 1000) {
                    // Restore template selection
                    if (data.template) {
                        currentTemplate = data.template;
                        document.querySelectorAll('.template-card').forEach(card => {
                            if (card.dataset.template === data.template) {
                                card.classList.add('selected');
                            }
                        });
                    }

                    // Restore form data
                    if (data.formData) {
                        Object.keys(data.formData).forEach(key => {
                            const el = document.getElementById(key);
                            if (el) el.value = data.formData[key];
                        });
                    }

                    // Restore customization
                    if (data.color) currentColor = data.color;
                    if (data.font) currentFont = data.font;
                }
            } catch (e) {
                console.error('Error loading saved data:', e);
            }
        }
    }

    function startAutoSave() {
        autoSaveInterval = setInterval(saveToLocalStorage, 30000); // Every 30 seconds
    }

    // ============================================
    // EXPORT
    // ============================================
    function exportResume() {
        showConfetti();
        alert('PDF Export functionality would use a library like jsPDF or html2pdf.js in production.\n\nFor now, you can use your browser Print function (Ctrl+P / Cmd+P) to save as PDF!\n\nTip: Make sure to select "Save as PDF" as your printer destination.');
        window.print();
    }

    function createNew() {
        if (confirm('Are you sure you want to create a new resume? Current progress will be lost.')) {
            localStorage.removeItem('resumeBuilder');
            location.reload();
        }
    }

    // ============================================
    // CONFETTI ANIMATION
    // ============================================
    function showConfetti() {
        const colors = ['#00B4D8', '#00C896', '#f59e0b', '#ec4899', '#8b5cf6'];
        const confettiCount = 50;

        for (let i = 0; i < confettiCount; i++) {
            setTimeout(() => {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 3 + 's';
                document.body.appendChild(confetti);

                setTimeout(() => confetti.remove(), 3000);
            }, i * 30);
        }
    }
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_resume_builder', 'jobportal_resume_builder_shortcode');
