/**
 * Job Comparison Tool
 * Compare up to 3 jobs side by side
 *
 * @package JobPortal
 */

(function() {
    'use strict';

    let comparisonList = [];
    const maxComparisons = 3;

    document.addEventListener('DOMContentLoaded', function() {
        initJobComparison();
        loadComparisonFromStorage();
    });

    /**
     * Initialize Job Comparison
     */
    function initJobComparison() {
        // Add compare buttons to job cards
        addCompareButtons();

        // Listen for compare button clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('.jobportal-compare-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.jobportal-compare-btn');
                const jobId = btn.dataset.jobId;
                toggleComparison(jobId, btn);
            }

            // View comparison
            if (e.target.closest('#view-comparison-btn')) {
                e.preventDefault();
                openComparisonModal();
            }

            // Remove from comparison
            if (e.target.closest('.remove-from-comparison')) {
                e.preventDefault();
                const jobId = e.target.closest('.remove-from-comparison').dataset.jobId;
                removeFromComparison(jobId);
            }

            // Close modal
            if (e.target.closest('.close-comparison-modal')) {
                closeComparisonModal();
            }
        });

        // Create comparison badge
        createComparisonBadge();
    }

    /**
     * Add Compare Buttons to Job Cards
     */
    function addCompareButtons() {
        const jobCards = document.querySelectorAll('.jobportal-job-card');

        jobCards.forEach(card => {
            const jobId = card.dataset.jobId || Math.random().toString(36).substr(2, 9);
            card.dataset.jobId = jobId;

            // Check if button already exists
            if (card.querySelector('.jobportal-compare-btn')) return;

            const compareBtn = document.createElement('button');
            compareBtn.className = 'jobportal-compare-btn';
            compareBtn.dataset.jobId = jobId;
            compareBtn.innerHTML = `
                <span class="compare-icon">⚖️</span>
                <span class="compare-text">Compare</span>
            `;

            // Add to card
            const actionsDiv = card.querySelector('[style*="display: flex; gap: 12px"]');
            if (actionsDiv) {
                compareBtn.style.cssText = 'width: 44px; height: 44px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s; font-size: 18px;';
                compareBtn.title = 'Add to comparison';
                actionsDiv.appendChild(compareBtn);
            }
        });
    }

    /**
     * Toggle Job Comparison
     */
    function toggleComparison(jobId, btn) {
        const index = comparisonList.indexOf(jobId);

        if (index > -1) {
            // Remove from comparison
            comparisonList.splice(index, 1);
            btn.classList.remove('active');
            btn.style.background = '#f8fafc';
        } else {
            // Add to comparison
            if (comparisonList.length >= maxComparisons) {
                alert(`You can compare up to ${maxComparisons} jobs at a time.`);
                return;
            }

            comparisonList.push(jobId);
            btn.classList.add('active');
            btn.style.background = '#00B4D8';
            btn.style.color = 'white';
            btn.style.borderColor = '#00B4D8';
        }

        updateComparisonBadge();
        saveComparisonToStorage();
    }

    /**
     * Create Comparison Badge
     */
    function createComparisonBadge() {
        const badge = document.createElement('div');
        badge.id = 'comparison-badge';
        badge.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 50px;
            box-shadow: 0 8px 24px rgba(79, 172, 254, 0.4);
            cursor: pointer;
            z-index: 9999;
            display: none;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
        `;

        badge.innerHTML = `
            <span class="badge-icon">⚖️</span>
            <span class="badge-text">Compare (<span id="comparison-count">0</span>)</span>
        `;

        badge.id = 'view-comparison-btn';
        document.body.appendChild(badge);

        // Hover effect
        badge.addEventListener('mouseenter', () => {
            badge.style.transform = 'scale(1.05) translateY(-4px)';
            badge.style.boxShadow = '0 12px 32px rgba(79, 172, 254, 0.5)';
        });

        badge.addEventListener('mouseleave', () => {
            badge.style.transform = '';
            badge.style.boxShadow = '0 8px 24px rgba(79, 172, 254, 0.4)';
        });
    }

    /**
     * Update Comparison Badge
     */
    function updateComparisonBadge() {
        const badge = document.getElementById('view-comparison-btn');
        const count = document.getElementById('comparison-count');

        if (comparisonList.length > 0) {
            badge.style.display = 'flex';
            count.textContent = comparisonList.length;
        } else {
            badge.style.display = 'none';
        }
    }

    /**
     * Open Comparison Modal
     */
    function openComparisonModal() {
        if (comparisonList.length === 0) return;

        // Create modal
        const modal = document.createElement('div');
        modal.id = 'comparison-modal';
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        `;

        modal.innerHTML = `
            <div style="background: white; border-radius: 20px; max-width: 1200px; width: 100%; max-height: 90vh; overflow-y: auto; position: relative;">
                <div style="position: sticky; top: 0; background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%); padding: 24px; border-radius: 20px 20px 0 0; z-index: 10;">
                    <button class="close-comparison-modal" style="position: absolute; top: 20px; right: 20px; width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border: none; border-radius: 50%; color: white; font-size: 24px; cursor: pointer;">×</button>
                    <h2 style="color: white; font-size: 28px; font-weight: 800; margin: 0;">Job Comparison</h2>
                    <p style="color: rgba(255, 255, 255, 0.9); margin: 8px 0 0;">Compare ${comparisonList.length} jobs side by side</p>
                </div>

                <div style="padding: 32px;">
                    <div id="comparison-grid" style="display: grid; grid-template-columns: repeat(${comparisonList.length}, 1fr); gap: 24px;">
                        <!-- Job comparison cards will be inserted here -->
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Load and display jobs
        displayComparisonJobs();

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    /**
     * Close Comparison Modal
     */
    function closeComparisonModal() {
        const modal = document.getElementById('comparison-modal');
        if (modal) {
            modal.remove();
            document.body.style.overflow = '';
        }
    }

    /**
     * Display Comparison Jobs
     */
    function displayComparisonJobs() {
        const grid = document.getElementById('comparison-grid');
        if (!grid) return;

        comparisonList.forEach(jobId => {
            const jobCard = document.querySelector(`[data-job-id="${jobId}"]`);
            if (!jobCard) return;

            // Extract job data
            const title = jobCard.querySelector('.jobportal-job-title, h3')?.textContent.trim() || 'Job Title';
            const company = jobCard.querySelector('.jobportal-company-name, p')?.textContent.trim() || 'Company';

            // Create comparison card
            const card = document.createElement('div');
            card.style.cssText = 'background: #f8fafc; padding: 24px; border-radius: 16px; border: 2px solid #e2e8f0;';
            card.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0;">${title}</h3>
                    <button class="remove-from-comparison" data-job-id="${jobId}" style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">Remove</button>
                </div>
                <p style="color: #64748b; margin-bottom: 16px;">${company}</p>
                <div style="space-y: 12px;">
                    <div style="padding: 12px; background: white; border-radius: 8px; margin-bottom: 8px;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px;">LOCATION</div>
                        <div style="color: #1e293b; font-weight: 600;">📍 Location Info</div>
                    </div>
                    <div style="padding: 12px; background: white; border-radius: 8px; margin-bottom: 8px;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px;">JOB TYPE</div>
                        <div style="color: #1e293b; font-weight: 600;">💼 Full-Time</div>
                    </div>
                    <div style="padding: 12px; background: white; border-radius: 8px; margin-bottom: 8px;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px;">SALARY</div>
                        <div style="color: #1e293b; font-weight: 600;">💰 Competitive</div>
                    </div>
                </div>
            `;

            grid.appendChild(card);
        });
    }

    /**
     * Remove from Comparison
     */
    function removeFromComparison(jobId) {
        const index = comparisonList.indexOf(jobId);
        if (index > -1) {
            comparisonList.splice(index, 1);

            // Update button state
            const btn = document.querySelector(`.jobportal-compare-btn[data-job-id="${jobId}"]`);
            if (btn) {
                btn.classList.remove('active');
                btn.style.background = '#f8fafc';
                btn.style.color = '';
                btn.style.borderColor = '#e2e8f0';
            }

            updateComparisonBadge();
            saveComparisonToStorage();

            // Refresh modal if open
            if (document.getElementById('comparison-modal')) {
                closeComparisonModal();
                if (comparisonList.length > 0) {
                    openComparisonModal();
                }
            }
        }
    }

    /**
     * Save Comparison to LocalStorage
     */
    function saveComparisonToStorage() {
        localStorage.setItem('jobportal_comparison', JSON.stringify(comparisonList));
    }

    /**
     * Load Comparison from LocalStorage
     */
    function loadComparisonFromStorage() {
        const saved = localStorage.getItem('jobportal_comparison');
        if (saved) {
            comparisonList = JSON.parse(saved);
            updateComparisonBadge();

            // Update button states
            comparisonList.forEach(jobId => {
                const btn = document.querySelector(`.jobportal-compare-btn[data-job-id="${jobId}"]`);
                if (btn) {
                    btn.classList.add('active');
                    btn.style.background = '#00B4D8';
                    btn.style.color = 'white';
                    btn.style.borderColor = '#00B4D8';
                }
            });
        }
    }

    // Make functions globally available
    window.jobportalComparison = {
        toggle: toggleComparison,
        open: openComparisonModal,
        close: closeComparisonModal
    };

})();
