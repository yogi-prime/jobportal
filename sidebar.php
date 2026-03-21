<?php
/**
 * Sidebar Template - Clean Minimal Design
 *
 * @package JobPortal
 */

if (!is_active_sidebar('sidebar-main')) {
    return;
}
?>

<style>
/* AGGRESSIVE CSS RESET FOR SIDEBAR */
.jobportal-sidebar-inner {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.jobportal-sidebar-inner * {
    box-sizing: border-box;
}

/* Widget Container */
.jobportal-sidebar-inner .widget,
.jobportal-sidebar-inner aside {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    margin: 0 !important;
}

.jobportal-sidebar-inner .widget:hover {
    border-color: #cbd5e1;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}

/* ALL WIDGET TITLES - FORCE SMALL SIZE */
.jobportal-sidebar-inner h2,
.jobportal-sidebar-inner h3,
.jobportal-sidebar-inner h4,
.jobportal-sidebar-inner .widget-title,
.jobportal-sidebar-inner .widgettitle {
    font-size: 15px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    margin: 0 0 14px 0 !important;
    padding: 0 !important;
    border: none !important;
    background: none !important;
    line-height: 1.4 !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
}

.jobportal-sidebar-inner .widget-title::before,
.jobportal-sidebar-inner .widgettitle::before {
    display: none !important;
}

/* Search Widget - Premium Modern Design */
.jobportal-sidebar-inner .widget_search {
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%) !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 12px !important;
    padding: 24px !important;
    position: relative;
    overflow: hidden;
}

.jobportal-sidebar-inner .widget_search::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(79, 172, 254, 0.08) 0%, transparent 70%);
    pointer-events: none;
}

.jobportal-sidebar-inner .widget_search .search-form {
    position: relative;
    display: flex;
    margin: 0;
    background: white;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    border: 2px solid #e2e8f0;
    transition: all 0.3s;
}

.jobportal-sidebar-inner .widget_search .search-form:focus-within {
    border-color: #00B4D8;
    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.25), inset 0 1px 0 rgba(255, 255, 255, 1);
    transform: translateY(-2px);
}

.jobportal-sidebar-inner .widget_search .search-form::before {
    content: '';
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%234facfe" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>') center/contain no-repeat;
    z-index: 1;
    opacity: 0.7;
}

.jobportal-sidebar-inner .widget_search .search-field {
    width: 100%;
    padding: 14px 60px 14px 46px !important;
    border: none !important;
    border-radius: 50px !important;
    font-size: 14px !important;
    outline: none !important;
    transition: all 0.3s !important;
    background: transparent !important;
    box-shadow: none !important;
    margin: 0 !important;
    height: auto !important;
    color: #1e293b !important;
    font-weight: 500 !important;
}

.jobportal-sidebar-inner .widget_search .search-field::placeholder {
    color: #94a3b8 !important;
    font-weight: 400 !important;
}

.jobportal-sidebar-inner .widget_search .search-field:focus {
    background: transparent !important;
    box-shadow: none !important;
}

.jobportal-sidebar-inner .widget_search .search-submit {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    padding: 11px 22px !important;
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%) !important;
    color: white !important;
    border: none !important;
    border-radius: 50px !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    height: auto !important;
    line-height: 1 !important;
    box-shadow: 0 3px 10px rgba(30, 41, 59, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
    text-shadow: none !important;
    letter-spacing: 0.3px !important;
    text-transform: uppercase !important;
}

.jobportal-sidebar-inner .widget_search .search-submit:hover {
    background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%) !important;
    box-shadow: 0 5px 18px rgba(79, 172, 254, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.25) !important;
    transform: translateY(-50%) translateY(-1px) scale(1.03) !important;
}

.jobportal-sidebar-inner .widget_search .search-submit:active {
    transform: translateY(-50%) translateY(0px) scale(0.98) !important;
    box-shadow: 0 2px 6px rgba(30, 41, 59, 0.3) !important;
}

/* ALL LISTS - FORCE CLEAN STYLE */
.jobportal-sidebar-inner ul,
.jobportal-sidebar-inner ol {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

.jobportal-sidebar-inner li {
    list-style: none !important;
    margin: 0 0 8px 0 !important;
    padding: 0 0 8px 0 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    font-size: 13px !important;
    line-height: 1.5 !important;
}

.jobportal-sidebar-inner li:last-child {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
    border-bottom: none !important;
}

/* ALL LINKS - FORCE CLEAN STYLE */
.jobportal-sidebar-inner a {
    color: #475569 !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    font-size: 13px !important;
    line-height: 1.5 !important;
    display: block !important;
    transition: all 0.3s !important;
    padding: 0 !important;
    background: none !important;
    border: none !important;
}

.jobportal-sidebar-inner a:hover {
    color: #00B4D8 !important;
    padding-left: 4px !important;
}

/* Recent Posts Widget - With Thumbnails */
.jobportal-recent-posts-widget {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

.jobportal-recent-post-item {
    display: flex !important;
    gap: 12px !important;
    margin-bottom: 14px !important;
    padding-bottom: 14px !important;
    border-bottom: 1px solid #f1f5f9 !important;
    align-items: flex-start !important;
}

.jobportal-recent-post-item:last-child {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
    border-bottom: none !important;
}

.jobportal-recent-post-thumb {
    flex-shrink: 0 !important;
    width: 60px !important;
    height: 60px !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    display: block !important;
    transition: all 0.3s !important;
}

.jobportal-recent-post-thumb:hover {
    transform: scale(1.05) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.jobportal-recent-post-thumb img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    display: block !important;
}

.jobportal-recent-post-content {
    flex: 1 !important;
    min-width: 0 !important;
}

.jobportal-recent-post-title {
    display: block !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    line-height: 1.4 !important;
    color: #334155 !important;
    margin-bottom: 6px !important;
    text-decoration: none !important;
    transition: all 0.3s !important;
}

.jobportal-recent-post-title:hover {
    color: #00B4D8 !important;
}

.jobportal-recent-post-date {
    display: block !important;
    font-size: 11px !important;
    color: #94a3b8 !important;
    font-weight: 400 !important;
}

/* Default Recent Posts Widget (fallback) */
.jobportal-sidebar-inner .widget_recent_entries li a {
    display: block !important;
    padding: 0 !important;
}

.jobportal-sidebar-inner .widget_recent_entries .post-date {
    display: block !important;
    font-size: 11px !important;
    color: #94a3b8 !important;
    margin-top: 4px !important;
    font-weight: 400 !important;
}

/* Recent Comments */
.jobportal-sidebar-inner .widget_recent_comments li {
    padding: 8px !important;
    background: #f8fafc !important;
    border-radius: 6px !important;
    border-left: 2px solid #00B4D8 !important;
    border-bottom: none !important;
    font-size: 12px !important;
    color: #64748b !important;
    margin-bottom: 8px !important;
}

.jobportal-sidebar-inner .widget_recent_comments a {
    display: inline !important;
    color: #00B4D8 !important;
    font-weight: 600 !important;
    font-size: 12px !important;
}

/* Archives & Categories */
.jobportal-sidebar-inner .widget_archive li,
.jobportal-sidebar-inner .widget_categories li {
    border: none !important;
    padding: 0 !important;
    margin-bottom: 4px !important;
}

.jobportal-sidebar-inner .widget_archive a,
.jobportal-sidebar-inner .widget_categories a {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 7px 10px !important;
    background: #f8fafc !important;
    border-radius: 6px !important;
    font-size: 12px !important;
    transition: all 0.3s !important;
}

.jobportal-sidebar-inner .widget_archive a:hover,
.jobportal-sidebar-inner .widget_categories a:hover {
    background: #e0f2fe !important;
    color: #00B4D8 !important;
    padding-left: 14px !important;
}

/* Count badges */
.jobportal-sidebar-inner .count {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 20px !important;
    height: 20px !important;
    padding: 0 5px !important;
    background: white !important;
    border-radius: 4px !important;
    font-size: 10px !important;
    font-weight: 700 !important;
    color: #64748b !important;
    margin-left: auto !important;
}

.jobportal-sidebar-inner a:hover .count {
    background: #00B4D8 !important;
    color: white !important;
}

/* Tag Cloud */
.jobportal-sidebar-inner .widget_tag_cloud .tagcloud {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 5px !important;
}

.jobportal-sidebar-inner .widget_tag_cloud a {
    display: inline-block !important;
    padding: 5px 10px !important;
    background: #f1f5f9 !important;
    color: #64748b !important;
    border-radius: 12px !important;
    font-size: 11px !important;
    font-weight: 500 !important;
}

.jobportal-sidebar-inner .widget_tag_cloud a:hover {
    background: #00B4D8 !important;
    color: white !important;
    padding-left: 10px !important;
}

/* Calendar */
.jobportal-sidebar-inner .widget_calendar table {
    width: 100% !important;
    border-collapse: collapse !important;
}

.jobportal-sidebar-inner .widget_calendar caption {
    font-size: 13px !important;
    font-weight: 600 !important;
    margin-bottom: 8px !important;
    color: #1e293b !important;
}

.jobportal-sidebar-inner .widget_calendar th,
.jobportal-sidebar-inner .widget_calendar td {
    padding: 6px !important;
    text-align: center !important;
    border: 1px solid #f1f5f9 !important;
    font-size: 11px !important;
}

.jobportal-sidebar-inner .widget_calendar th {
    background: #f8fafc !important;
    color: #64748b !important;
    font-weight: 600 !important;
    font-size: 10px !important;
}

.jobportal-sidebar-inner .widget_calendar td a {
    display: block !important;
    color: #00B4D8 !important;
    font-weight: 600 !important;
    padding: 2px !important;
}

.jobportal-sidebar-inner .widget_calendar td a:hover {
    background: #00B4D8 !important;
    color: white !important;
    border-radius: 3px !important;
}

/* Text Widget */
.jobportal-sidebar-inner .widget_text .textwidget,
.jobportal-sidebar-inner .widget_text .textwidget p {
    font-size: 13px !important;
    line-height: 1.6 !important;
    color: #64748b !important;
    margin: 0 !important;
}

.jobportal-sidebar-inner .widget_text .textwidget p + p {
    margin-top: 10px !important;
}

/* Meta Widget */
.jobportal-sidebar-inner .widget_meta li {
    border: none !important;
    padding: 0 !important;
    margin-bottom: 4px !important;
}

.jobportal-sidebar-inner .widget_meta a {
    padding: 7px 10px !important;
    background: #f8fafc !important;
    border-radius: 6px !important;
    font-size: 12px !important;
}

.jobportal-sidebar-inner .widget_meta a:hover {
    background: #e0f2fe !important;
    color: #00B4D8 !important;
    padding-left: 14px !important;
}

/* RSS Widget */
.jobportal-sidebar-inner .widget_rss li {
    border-bottom: 1px solid #f1f5f9 !important;
    padding-bottom: 10px !important;
    margin-bottom: 10px !important;
}

.jobportal-sidebar-inner .widget_rss a.rsswidget {
    font-size: 13px !important;
    font-weight: 500 !important;
}

.jobportal-sidebar-inner .widget_rss .rss-date,
.jobportal-sidebar-inner .widget_rss cite {
    display: block !important;
    font-size: 11px !important;
    color: #94a3b8 !important;
    margin-top: 4px !important;
    font-style: normal !important;
}

/* Remove any WordPress default spacing */
.jobportal-sidebar-inner .widget select {
    width: 100% !important;
    padding: 8px !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 6px !important;
    font-size: 13px !important;
    background: #f8fafc !important;
}

/* Responsive */
@media (max-width: 767px) {
    .jobportal-sidebar-inner .widget {
        padding: 16px;
        border-radius: 8px;
    }

    .jobportal-sidebar-inner h2,
    .jobportal-sidebar-inner h3,
    .jobportal-sidebar-inner .widget-title,
    .jobportal-sidebar-inner .widgettitle {
        font-size: 14px !important;
        margin-bottom: 12px !important;
    }
}
</style>

<div class="jobportal-sidebar-inner">
    <?php dynamic_sidebar('sidebar-main'); ?>
</div>
