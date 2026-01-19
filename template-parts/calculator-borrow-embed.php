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
        <h2 class="section-heading">Run the <span class="bold-text">Numbers</span></h2>
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
        // Constants for calculations
        const INCOME_MULTIPLE = 4.5;
        const SALARY_WEIGHT = 1.0;
        const BONUS_WEIGHT = 0.6;
        
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
            
            // Apply income multiple
            const grossBorrowingCapacity = weightedIncome * INCOME_MULTIPLE;
            
            // Annualise committed expenditure
            const annualExpenditure = monthlyExpenditure * 12;
            
            // Calculate actual borrowing capacity
            const borrowingCapacity = Math.max(0, grossBorrowingCapacity - annualExpenditure);
            
            // Calculate upper budget
            const upperBudget = borrowingCapacity + deposit;
            
            // Display results
            displayResults(borrowingCapacity, upperBudget, deposit);
        }
        
        // Display results
        function displayResults(borrowingCapacity, upperBudget, deposit) {
            const resultsDisplay = document.getElementById('embed-results-display');
            if (!resultsDisplay) return;
            
            let html = '';
            
            // Maximum Borrowing
            html += '<div class="result-item total">';
            html += '<div class="result-label">Maximum Borrowing</div>';
            html += '<div class="result-value"><span class="highlight-gold">£' + formatNumber(borrowingCapacity) + '</span></div>';
            html += '</div>';
            
            // Upper Budget (only if deposit provided)
            if (deposit > 0) {
                html += '<div class="result-item">';
                html += '<div class="result-label">Likely Upper Budget</div>';
                html += '<div class="result-value"><span class="highlight-blue">£' + formatNumber(upperBudget) + '</span></div>';
                html += '</div>';
            }
            
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