<?php
/**
 * ELITE UNIQUE FEATURE: Applicant Tracking System (ATS)
 * JobPortal Theme - Employer Dashboard
 *
 * @package JobPortal
 * @version 2.0.0 ELITE
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ATS Dashboard Shortcode
 * Usage: [jobportal_ats_dashboard]
 */
function jobportal_ats_dashboard_shortcode() {
    // Check if user is employer
    if (!is_user_logged_in()) {
        return '<p>' . __('Please login to access the ATS dashboard.', 'jobportal') . '</p>';
    }

    ob_start();
    ?>
    <div class="jp-ats-dashboard">

        <!-- Dashboard Header -->
        <div class="jp-ats-header">
            <div class="jp-ats-title">
                <h1><?php esc_html_e('Applicant Tracking System', 'jobportal'); ?></h1>
                <p><?php esc_html_e('Manage all job applications in one place', 'jobportal'); ?></p>
            </div>
            <div class="jp-ats-actions">
                <button class="jp-btn jp-btn-outline"><?php esc_html_e('Export CSV', 'jobportal'); ?></button>
                <button class="jp-btn jp-btn-primary"><?php esc_html_e('Post New Job', 'jobportal'); ?></button>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="jp-ats-stats">
            <div class="jp-stat-card">
                <div class="jp-stat-icon" style="background: #e0e7ff;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="jp-stat-content">
                    <div class="jp-stat-value">248</div>
                    <div class="jp-stat-label"><?php esc_html_e('Total Applications', 'jobportal'); ?></div>
                </div>
            </div>

            <div class="jp-stat-card">
                <div class="jp-stat-icon" style="background: #fef3c7;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="jp-stat-content">
                    <div class="jp-stat-value">42</div>
                    <div class="jp-stat-label"><?php esc_html_e('Under Review', 'jobportal'); ?></div>
                </div>
            </div>

            <div class="jp-stat-card">
                <div class="jp-stat-icon" style="background: #d1fae5;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="jp-stat-content">
                    <div class="jp-stat-value">18</div>
                    <div class="jp-stat-label"><?php esc_html_e('Shortlisted', 'jobportal'); ?></div>
                </div>
            </div>

            <div class="jp-stat-card">
                <div class="jp-stat-icon" style="background: #fee2e2;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <div class="jp-stat-content">
                    <div class="jp-stat-value">188</div>
                    <div class="jp-stat-label"><?php esc_html_e('Rejected', 'jobportal'); ?></div>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="jp-ats-filters">
            <div class="jp-filter-search">
                <input type="text" placeholder="<?php esc_attr_e('Search candidates...', 'jobportal'); ?>" class="jp-search-input">
            </div>

            <div class="jp-filter-tabs">
                <button class="jp-tab active" data-status="all"><?php esc_html_e('All', 'jobportal'); ?> (248)</button>
                <button class="jp-tab" data-status="new"><?php esc_html_e('New', 'jobportal'); ?> (42)</button>
                <button class="jp-tab" data-status="reviewing"><?php esc_html_e('Reviewing', 'jobportal'); ?> (28)</button>
                <button class="jp-tab" data-status="shortlisted"><?php esc_html_e('Shortlisted', 'jobportal'); ?> (18)</button>
                <button class="jp-tab" data-status="rejected"><?php esc_html_e('Rejected', 'jobportal'); ?> (188)</button>
            </div>

            <div class="jp-filter-sort">
                <select class="jp-select">
                    <option><?php esc_html_e('Latest First', 'jobportal'); ?></option>
                    <option><?php esc_html_e('Oldest First', 'jobportal'); ?></option>
                    <option><?php esc_html_e('Highest Rating', 'jobportal'); ?></option>
                    <option><?php esc_html_e('Most Experienced', 'jobportal'); ?></option>
                </select>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="jp-ats-table-container">
            <table class="jp-ats-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="jp-checkbox-all"></th>
                        <th><?php esc_html_e('Candidate', 'jobportal'); ?></th>
                        <th><?php esc_html_e('Position', 'jobportal'); ?></th>
                        <th><?php esc_html_e('Experience', 'jobportal'); ?></th>
                        <th><?php esc_html_e('Applied', 'jobportal'); ?></th>
                        <th><?php esc_html_e('Status', 'jobportal'); ?></th>
                        <th><?php esc_html_e('Rating', 'jobportal'); ?></th>
                        <th><?php esc_html_e('Actions', 'jobportal'); ?></th>
                    </tr>
                </thead>
                <tbody id="applications-tbody">
                    <?php
                    // Sample data (in real implementation, fetch from database)
                    $applications = array(
                        array(
                            'id' => 1,
                            'name' => 'Sarah Johnson',
                            'email' => 'sarah@example.com',
                            'position' => 'Senior Frontend Developer',
                            'experience' => '5 years',
                            'applied' => '2 days ago',
                            'status' => 'new',
                            'rating' => 0
                        ),
                        array(
                            'id' => 2,
                            'name' => 'Michael Chen',
                            'email' => 'michael@example.com',
                            'position' => 'Full Stack Engineer',
                            'experience' => '7 years',
                            'applied' => '5 days ago',
                            'status' => 'shortlisted',
                            'rating' => 5
                        ),
                        array(
                            'id' => 3,
                            'name' => 'Emma Williams',
                            'email' => 'emma@example.com',
                            'position' => 'UX Designer',
                            'experience' => '3 years',
                            'applied' => '1 week ago',
                            'status' => 'reviewing',
                            'rating' => 4
                        ),
                        array(
                            'id' => 4,
                            'name' => 'David Martinez',
                            'email' => 'david@example.com',
                            'position' => 'Product Manager',
                            'experience' => '8 years',
                            'applied' => '2 weeks ago',
                            'status' => 'rejected',
                            'rating' => 2
                        ),
                    );

                    foreach ($applications as $app) :
                        $status_class = 'jp-status-' . $app['status'];
                        $status_text = ucfirst($app['status']);
                    ?>
                        <tr class="jp-application-row" data-status="<?php echo esc_attr($app['status']); ?>">
                            <td><input type="checkbox" class="jp-checkbox"></td>
                            <td>
                                <div class="jp-candidate-info">
                                    <div class="jp-candidate-avatar">
                                        <?php echo esc_html(substr($app['name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <div class="jp-candidate-name"><?php echo esc_html($app['name']); ?></div>
                                        <div class="jp-candidate-email"><?php echo esc_html($app['email']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo esc_html($app['position']); ?></td>
                            <td><?php echo esc_html($app['experience']); ?></td>
                            <td><?php echo esc_html($app['applied']); ?></td>
                            <td>
                                <span class="jp-status <?php echo esc_attr($status_class); ?>">
                                    <?php echo esc_html($status_text); ?>
                                </span>
                            </td>
                            <td>
                                <div class="jp-rating">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <span class="jp-star <?php echo $i <= $app['rating'] ? 'filled' : ''; ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                            </td>
                            <td>
                                <div class="jp-actions">
                                    <button class="jp-action-btn" title="<?php esc_attr_e('View Profile', 'jobportal'); ?>">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                    <button class="jp-action-btn" title="<?php esc_attr_e('Download Resume', 'jobportal'); ?>">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                    </button>
                                    <button class="jp-action-btn" title="<?php esc_attr_e('Send Email', 'jobportal'); ?>">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions -->
        <div class="jp-bulk-actions">
            <select class="jp-select">
                <option><?php esc_html_e('Bulk Actions', 'jobportal'); ?></option>
                <option value="shortlist"><?php esc_html_e('Move to Shortlisted', 'jobportal'); ?></option>
                <option value="reject"><?php esc_html_e('Reject', 'jobportal'); ?></option>
                <option value="delete"><?php esc_html_e('Delete', 'jobportal'); ?></option>
                <option value="export"><?php esc_html_e('Export Selected', 'jobportal'); ?></option>
            </select>
            <button class="jp-btn jp-btn-secondary"><?php esc_html_e('Apply', 'jobportal'); ?></button>
        </div>

    </div>

    <style>
    .jp-ats-dashboard {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .jp-ats-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .jp-ats-title h1 {
        margin: 0 0 8px 0;
        color: #1e293b;
        font-size: 32px;
    }

    .jp-ats-title p {
        margin: 0;
        color: #64748b;
    }

    .jp-ats-actions {
        display: flex;
        gap: 12px;
    }

    .jp-btn {
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .jp-btn-primary {
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: #fff;
    }

    .jp-btn-outline {
        background: #fff;
        border: 2px solid #00B4D8;
        color: #00B4D8;
    }

    .jp-btn-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .jp-ats-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .jp-stat-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 24px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .jp-stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .jp-stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 4px;
    }

    .jp-stat-label {
        font-size: 14px;
        color: #64748b;
    }

    .jp-ats-filters {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
        align-items: center;
    }

    .jp-filter-search {
        flex: 1;
        min-width: 250px;
    }

    .jp-search-input {
        width: 100%;
        padding: 10px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 14px;
    }

    .jp-filter-tabs {
        display: flex;
        gap: 8px;
        background: #f8fafc;
        padding: 4px;
        border-radius: 8px;
    }

    .jp-tab {
        padding: 8px 16px;
        background: transparent;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        color: #64748b;
        transition: all 0.2s;
    }

    .jp-tab.active {
        background: #fff;
        color: #00B4D8;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .jp-select {
        padding: 10px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 14px;
        background: #fff;
        cursor: pointer;
    }

    .jp-ats-table-container {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .jp-ats-table {
        width: 100%;
        border-collapse: collapse;
    }

    .jp-ats-table th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .jp-ats-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .jp-application-row:hover {
        background: #f8fafc;
    }

    .jp-candidate-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .jp-candidate-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
    }

    .jp-candidate-name {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .jp-candidate-email {
        font-size: 13px;
        color: #94a3b8;
    }

    .jp-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .jp-status-new {
        background: #e0e7ff;
        color: #4f46e5;
    }

    .jp-status-reviewing {
        background: #fef3c7;
        color: #f59e0b;
    }

    .jp-status-shortlisted {
        background: #d1fae5;
        color: #10b981;
    }

    .jp-status-rejected {
        background: #fee2e2;
        color: #ef4444;
    }

    .jp-rating {
        display: flex;
        gap: 2px;
    }

    .jp-star {
        color: #e2e8f0;
        font-size: 18px;
    }

    .jp-star.filled {
        color: #fbbf24;
    }

    .jp-actions {
        display: flex;
        gap: 8px;
    }

    .jp-action-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        cursor: pointer;
        color: #64748b;
        transition: all 0.2s;
    }

    .jp-action-btn:hover {
        background: #00B4D8;
        border-color: #00B4D8;
        color: #fff;
    }

    .jp-bulk-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    @media (max-width: 1024px) {
        .jp-ats-table-container {
            overflow-x: auto;
        }

        .jp-ats-table {
            min-width: 900px;
        }
    }
    </style>

    <script>
    (function() {
        // Tab filtering
        document.querySelectorAll('.jp-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.jp-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const status = this.dataset.status;
                const rows = document.querySelectorAll('.jp-application-row');

                rows.forEach(row => {
                    if (status === 'all' || row.dataset.status === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality
        document.querySelector('.jp-search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.jp-application-row');

            rows.forEach(row => {
                const name = row.querySelector('.jp-candidate-name').textContent.toLowerCase();
                const email = row.querySelector('.jp-candidate-email').textContent.toLowerCase();
                const position = row.cells[2].textContent.toLowerCase();

                if (name.includes(searchTerm) || email.includes(searchTerm) || position.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Select all checkbox
        document.querySelector('.jp-checkbox-all').addEventListener('change', function() {
            document.querySelectorAll('.jp-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('jobportal_ats_dashboard', 'jobportal_ats_dashboard_shortcode');
