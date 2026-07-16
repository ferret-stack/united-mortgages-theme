<?php
/**
 * Template Part: Borrow Calculator Embed
 * 
 * Desktop: Embedded "How Much Can I Borrow" calculator
 * Mobile: CTA card linking to full calculators page
 * 
 * @package UnitedMortgages
 */
?>

<!-- Run the Numbers Section -->
<section class="run-the-numbers-section" id="calculator">
    <div class="container">
        <h2 class="section-heading">Run your <span class="bold-text">Numbers</span></h2>
        <p class="section-subheading">See how much you could borrow to secure <b>your dream home</b></p>
        
        <!-- Desktop: Embedded Calculator -->
        <div class="calculator-embed-desktop">
            <div class="calculator-container calculator-embed">
                <!-- Calculator Content Area -->
                <div class="calculator-content-wrapper">
                    <!-- Left Side - Borrow Calculator Form -->
                    <div class="calculator-forms">
                        <div id="borrow-calculator-embed" class="calculator-form active">
                            <form id="borrow-form-embed" class="mortgage-calculator-form">
                                <div class="form-group">
                                    <label for="embed-borrow-income">
                                        Annual Income (£)
                                        <span class="info-tooltip" data-tooltip="Include total yearly gross salary of all applicants">ⓘ</span>
                                    </label>
                                    <input type="text" id="embed-borrow-income" name="income" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="embed-borrow-additional-income">
                                        Additional Annual Income (£)
                                        <span class="info-tooltip" data-tooltip="Include regular additional income, such as bonuses, commission, overtime, etc.">ⓘ</span>
                                    </label>
                                    <input type="text" id="embed-borrow-additional-income" name="additionalIncome" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="embed-borrow-expenditure">
                                        Monthly Committed Expenditure (£)
                                        <span class="info-tooltip" data-tooltip="Include committed monthly outgoings such as loan repayments, car finance, hire purchases, etc.">ⓘ</span>
                                    </label>
                                    <input type="text" id="embed-borrow-expenditure" name="expenditure" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="embed-borrow-deposit">
                                        Deposit Amount (£)
                                        <span class="info-tooltip" data-tooltip="A higher deposit may result in a higher overall budget">ⓘ</span>
                                    </label>
                                    <input type="text" id="embed-borrow-deposit" name="deposit" class="number-input" placeholder="Optional">
                                </div>
                                <button type="submit" class="btn-calculate">CALCULATE</button>
                            </form>

                            <!-- Mandatory popup: Typical vs Enhanced (compliance-approved copy) -->
                            <div id="embed-borrow-range-popup" class="popup-overlay">
                                <div class="popup-content">
                                    <div class="popup-header">
                                        <h2>Typical vs Enhanced</h2>
                                        <button type="button" class="popup-close" onclick="closeEmbedBorrowRangePopup()" aria-label="Close">&times;</button>
                                    </div>
                                    <div class="popup-body">
                                        <p>These figures are estimates only. They are not guaranteed and actual lending depends on individual lender criteria, your credit history and full financial circumstances.</p>
                                        <p>The <strong>Enhanced</strong> figure reflects income multiples of up to 6x now offered by a number of UK lenders. This tier is generally only available to higher earners &mdash; commonly &pound;75,000+ income &mdash; and is subject to lender-specific eligibility criteria. Most borrowers will not qualify for the Enhanced figure even though it is a real, current market rate. Your <strong>Typical</strong> figure is a more representative starting point for most applicants.</p>
                                    </div>
                                    <div class="popup-footer">
                                        <button type="button" class="popup-button" onclick="closeEmbedBorrowRangePopup()">Got it</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Results -->
                    <div class="calculator-results">
                        <h2>Your Results</h2>
                        <div id="embed-results-display" class="results-content">
                            <div class="results-placeholder">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/calculator-icon.svg" alt="Calculator" class="placeholder-icon">
                                <p>Enter your details and click calculate to see how much you could borrow</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Link to full calculators page -->
            <div class="calculator-more-link">
                <a href="<?php echo home_url('/calculators'); ?>">View all calculators →</a>
            </div>
        </div>
        
        <!-- Mobile: CTA Card -->
        <div class="calculator-embed-mobile">
            <div class="calculator-cta-card">
                <div class="cta-card-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/gold-calc.png" alt="Calculator">
                </div>
                <h3>How Much Can I Borrow?</h3>
                <p>Use our calculator to see how much you could borrow based on your income and circumstances.</p>
                <a href="<?php echo home_url('/calculators#borrow'); ?>" class="btn-secondary">Calculate Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Calculator Embed JavaScript - Lazy Loaded -->
<script>
(function() {
    'use strict';
    
    let calculatorInitialised = false;
    
    // Lazy load: Only initialise when section comes into view
    function initLazyLoad() {
        const section = document.querySelector('.run-the-numbers-section');
        if (!section) return;
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !calculatorInitialised) {
                    initCalculator();
                    calculatorInitialised = true;
                    observer.disconnect();
                }
            });
        }, {
            rootMargin: '100px' // Start loading slightly before it's in view
        });
        
        observer.observe(section);
    }
    
    // Calculator initialisation
    function initCalculator() {
        // Borrowing multiple range shown as "Typical" (low) / "Enhanced" (high).
        // Kept in sync with page-calculators.php — see that file for sourcing/review-date notes.
        // Review by: 2027-01-16
        const MULTIPLE_LOW = 4.5;
        const MULTIPLE_HIGH = 6.0;
        const SALARY_WEIGHT = 1.0;
        const BONUS_WEIGHT = 0.6;

        // Mandatory popup explaining the Typical/Enhanced range (compliance-approved copy)
        window.openEmbedBorrowRangePopup = function() {
            const popup = document.getElementById('embed-borrow-range-popup');
            if (popup) {
                popup.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeEmbedBorrowRangePopup = function() {
            const popup = document.getElementById('embed-borrow-range-popup');
            if (popup) {
                popup.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        document.addEventListener('click', function(event) {
            const popup = document.getElementById('embed-borrow-range-popup');
            if (popup && event.target === popup) {
                window.closeEmbedBorrowRangePopup();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                window.closeEmbedBorrowRangePopup();
            }
        });
        
        // Format number input with commas
        function formatNumberInput(input) {
            let value = input.value.replace(/,/g, '');
            if (!isNaN(value) && value !== '') {
                input.value = Number(value).toLocaleString('en-GB');
            }
        }
        
        // Parse number from formatted input
        function parseNumberInput(input) {
            return parseFloat(input.value.replace(/,/g, '')) || 0;
        }
        
        // Format number for display
        function formatNumber(num) {
            return num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
        
        // Add formatting to number inputs
        const numberInputs = document.querySelectorAll('.calculator-embed .number-input');
        numberInputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                formatNumberInput(this);
            });
            input.addEventListener('focus', function() {
                this.value = this.value.replace(/,/g, '');
            });
        });
        
        // Handle form submission
        const borrowForm = document.getElementById('borrow-form-embed');
        if (borrowForm) {
            borrowForm.addEventListener('submit', function(e) {
                e.preventDefault();
                calculateBorrow();
            });
        }
        
        // Borrow calculation
        function calculateBorrow() {
            const income = parseNumberInput(document.getElementById('embed-borrow-income'));
            const additionalIncome = parseNumberInput(document.getElementById('embed-borrow-additional-income'));
            const monthlyExpenditure = parseNumberInput(document.getElementById('embed-borrow-expenditure'));
            const deposit = parseNumberInput(document.getElementById('embed-borrow-deposit'));

            // Calculate weighted income
            const weightedIncome = (income * SALARY_WEIGHT) + (additionalIncome * BONUS_WEIGHT);

            // Apply the low/high income multiples
            const grossBorrowingCapacityTypical = weightedIncome * MULTIPLE_LOW;
            const grossBorrowingCapacityEnhanced = weightedIncome * MULTIPLE_HIGH;

            // Annualise committed expenditure
            const annualExpenditure = monthlyExpenditure * 12;

            // Calculate actual borrowing capacity range
            const borrowingCapacityTypical = Math.max(0, grossBorrowingCapacityTypical - annualExpenditure);
            const borrowingCapacityEnhanced = Math.max(0, grossBorrowingCapacityEnhanced - annualExpenditure);

            // Calculate upper budget at each end of the range
            const upperBudgetTypical = borrowingCapacityTypical + deposit;
            const upperBudgetEnhanced = borrowingCapacityEnhanced + deposit;

            // Display results
            displayResults(borrowingCapacityTypical, borrowingCapacityEnhanced, upperBudgetTypical, upperBudgetEnhanced, deposit);
        }

        // Display results
        function displayResults(borrowingCapacityTypical, borrowingCapacityEnhanced, upperBudgetTypical, upperBudgetEnhanced, deposit) {
            const resultsDisplay = document.getElementById('embed-results-display');
            if (!resultsDisplay) return;

            let html = '';

            // Typical
            html += '<div class="result-item">';
            html += '<div class="result-label">Typical</div>';
            html += '<div class="result-value"><span class="highlight-gold">£' + formatNumber(borrowingCapacityTypical) + '</span></div>';
            html += '</div>';

            // Enhanced (with mandatory popup trigger)
            html += '<div class="result-item">';
            html += '<div class="result-label">Enhanced <button type="button" class="range-info-trigger" onclick="openEmbedBorrowRangePopup()" aria-label="What does Enhanced mean?">ⓘ</button></div>';
            html += '<div class="result-value"><span class="highlight-blue">£' + formatNumber(borrowingCapacityEnhanced) + '</span></div>';
            html += '</div>';

            // Upper Budget (only if deposit provided)
            if (deposit > 0) {
                html += '<div class="result-item">';
                html += '<div class="result-label">Typical Upper Budget</div>';
                html += '<div class="result-value">£' + formatNumber(upperBudgetTypical) + '</div>';
                html += '</div>';
                html += '<div class="result-item">';
                html += '<div class="result-label">Enhanced Upper Budget</div>';
                html += '<div class="result-value">£' + formatNumber(upperBudgetEnhanced) + '</div>';
                html += '</div>';
            }

            // Static caveat/rate-sensitivity/pension notes — ship with the range, not after
            html += '<p class="borrow-note borrow-disclaimer">These figures are estimates only. They are not guaranteed and actual lending depends on individual lender criteria, your credit history and full financial circumstances.</p>';
            html += '<p class="borrow-note borrow-rate-note">Mortgage rates can rise as well as fall. These figures are based on current lending conditions — if you\'re considering a fix shorter than 5 years, it\'s worth discussing how a future rate change could affect what you can borrow.</p>';
            html += '<p class="borrow-note borrow-pension-note">This calculator does not take pension contributions into account. Speak to one of our advisers for a more tailored picture of your borrowing potential.</p>';

            // CTA
            html += '<div class="results-cta">';
            html += '<a href="<?php echo home_url('/aip-overview'); ?>" class="btn-primary">Get your Agreement in Principle today!</a>';
            html += '</div>';

            resultsDisplay.innerHTML = html;
        }
    }
    
    // Start lazy loading when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLazyLoad);
    } else {
        initLazyLoad();
    }
})();
</script>