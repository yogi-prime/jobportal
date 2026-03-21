/**
 * Advanced Job Filters with AJAX
 * Real-time filtering without page reload
 *
 * @package JobPortal
 */

(function($) {
    'use strict';

    let filterTimeout;

    $(document).ready(function() {
        initJobFilters();
    });

    /**
     * Initialize Job Filters
     */
    function initJobFilters() {
        const $filtersForm = $('#jobportal-filters-form');
        if ($filtersForm.length === 0) return;

        // Listen to all filter changes
        $filtersForm.on('change', 'select, input[type="checkbox"], input[type="radio"]', function() {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(applyFilters, 500);
        });

        // Salary range slider
        const $salarySlider = $('#salary-range');
        if ($salarySlider.length) {
            $salarySlider.on('input', function() {
                const value = $(this).val();
                $('#salary-range-value').text('$' + parseInt(value).toLocaleString());
                clearTimeout(filterTimeout);
                filterTimeout = setTimeout(applyFilters, 800);
            });
        }

        // Search input
        $('#job-search-input').on('keyup', function() {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(applyFilters, 800);
        });

        // Clear all filters
        $('#clear-filters').on('click', function(e) {
            e.preventDefault();
            clearAllFilters();
        });

        // Load filters from URL on page load
        loadFiltersFromURL();
    }

    /**
     * Apply Filters via AJAX
     */
    function applyFilters() {
        const filters = getFilterValues();

        // Show loading state
        showLoadingState();

        // Update URL
        updateURL(filters);

        // AJAX request
        $.ajax({
            url: jobportalAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_jobs',
                nonce: jobportalAjax.nonce,
                ...filters
            },
            success: function(response) {
                if (response.success) {
                    // Update jobs grid
                    $('#jobs-grid').html(response.data.html);

                    // Update count
                    $('#jobs-count').text(response.data.count + ' Jobs Found');

                    // Re-apply animations
                    if (typeof animateOnScroll !== 'undefined') {
                        const newCards = document.querySelectorAll('#jobs-grid .jobportal-job-card');
                        newCards.forEach(card => {
                            card.setAttribute('data-animate', 'fade-up');
                            animateOnScroll.observe(card);
                        });
                    }

                    // Scroll to results
                    $('html, body').animate({
                        scrollTop: $('#jobs-grid').offset().top - 120
                    }, 500);
                }
                hideLoadingState();
            },
            error: function() {
                hideLoadingState();
                alert('Error loading jobs. Please try again.');
            }
        });
    }

    /**
     * Get Current Filter Values
     */
    function getFilterValues() {
        const filters = {};

        // Search
        filters.search = $('#job-search-input').val();

        // Location
        filters.location = $('#filter-location').val();

        // Job Type
        filters.job_type = $('#filter-job-type').val();

        // Experience Level
        filters.experience_level = $('#filter-experience').val();

        // Salary Range
        filters.salary_min = $('#salary-range').val();

        // Remote option
        filters.remote = $('#filter-remote').is(':checked') ? '1' : '0';

        // Categories (checkboxes)
        const categories = [];
        $('input[name="categories[]"]:checked').each(function() {
            categories.push($(this).val());
        });
        filters.categories = categories.join(',');

        return filters;
    }

    /**
     * Clear All Filters
     */
    function clearAllFilters() {
        // Reset form
        $('#jobportal-filters-form')[0].reset();

        // Reset salary slider display
        $('#salary-range-value').text('$0');

        // Clear URL
        window.history.pushState({}, '', window.location.pathname);

        // Apply filters (will show all jobs)
        applyFilters();
    }

    /**
     * Update URL with Filter Parameters
     */
    function updateURL(filters) {
        const params = new URLSearchParams();

        Object.keys(filters).forEach(key => {
            if (filters[key] && filters[key] !== '' && filters[key] !== '0') {
                params.set(key, filters[key]);
            }
        });

        const newURL = params.toString()
            ? window.location.pathname + '?' + params.toString()
            : window.location.pathname;

        window.history.pushState({}, '', newURL);
    }

    /**
     * Load Filters from URL Parameters
     */
    function loadFiltersFromURL() {
        const params = new URLSearchParams(window.location.search);

        params.forEach((value, key) => {
            const $element = $(`#filter-${key}, #${key}`);

            if ($element.length) {
                if ($element.is(':checkbox') || $element.is(':radio')) {
                    $element.prop('checked', value === '1');
                } else {
                    $element.val(value);
                }
            }

            // Update salary slider display
            if (key === 'salary_min') {
                $('#salary-range-value').text('$' + parseInt(value).toLocaleString());
            }
        });

        // Apply filters if any URL params exist
        if (params.toString()) {
            applyFilters();
        }
    }

    /**
     * Show Loading State
     */
    function showLoadingState() {
        $('#jobs-grid').addClass('loading');

        // Add skeleton loading cards
        const skeletonHTML = `
            <div class="jobportal-skeleton-card">
                <div class="jobportal-skeleton jobportal-skeleton-title"></div>
                <div class="jobportal-skeleton jobportal-skeleton-text"></div>
                <div class="jobportal-skeleton jobportal-skeleton-text"></div>
            </div>
        `.repeat(6);

        $('#jobs-grid').html(skeletonHTML);
    }

    /**
     * Hide Loading State
     */
    function hideLoadingState() {
        $('#jobs-grid').removeClass('loading');
    }

})(jQuery);
