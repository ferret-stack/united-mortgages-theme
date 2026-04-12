<?php
/**
 * Template Name: calculators
 * 
 * @package UnitedMortgages
 */
/*V1.3 - Added inter-calculator navigation (borrow→repayment→overpayment) + AIP CTAs*/
get_header(); ?>

<!-- Calculator Container -->

    <!-- Calculator Hero Section -->
    <section class="hero-section calculator-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Our <span class="highlight">Calculators</span></h1>
                <p class="hero-subtitle">Try our mortgage calculators to estimate how much you could borrow and what your monthly payments might look like</p>
            </div>


            <div class="calculator-container">
                <!-- Calculator Tabs -->
                <div class="calculator-tabs">
                    <button class="calculator-tab active" data-calculator="borrow">HOW MUCH CAN I BORROW?</button>
                    <button class="calculator-tab" data-calculator="repayment">REPAYMENT CALCULATOR</button>
                    <button class="calculator-tab" data-calculator="overpayment">OVERPAYMENT CALCULATOR</button>
                    <button class="calculator-tab" data-calculator="stampduty">STAMP DUTY CALCULATOR</button>
                </div>
                
                <!-- Calculator Content Area -->
                <div class="calculator-content-wrapper">
                    <!-- Left Side - Calculator Forms -->
                    <div class="calculator-forms">
                        <!-- How Much Can I Borrow Calculator -->
                        <div id="borrow-calculator" class="calculator-form active">
                            <form id="borrow-form" class="mortgage-calculator-form">
                                <div class="form-group">
                                    <label for="borrow-income">
                                        Annual Income (£)
                                        <span class="info-tooltip" data-tooltip="Include total yearly gross salary of all applicants">ⓘ</span>
                                    </label>
                                    <input type="text" id="borrow-income" name="income" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="borrow-additional-income">
                                        Additional Annual Income (£)
                                        <span class="info-tooltip" data-tooltip="Include regular additional income, such as bonuses, commission, overtime, etc.">ⓘ</span>
                                    </label>
                                    <input type="text" id="borrow-additional-income" name="additionalIncome" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="borrow-expenditure">
                                        Monthly Committed Expenditure (£)
                                        <span class="info-tooltip" data-tooltip="Include committed monthly outgoijngs such as loan repayments, car finance, hire purchases, etc.">ⓘ</span>
                                    </label>
                                    <input type="text" id="borrow-expenditure" name="expenditure" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="borrow-deposit">
                                        Deposit Amount (£)
                                        <span class="info-tooltip" data-tooltip="A higher deposit may result in a higher overall budget">ⓘ</span>
                                    </label>
                                    <input type="text" id="borrow-deposit" name="deposit" class="number-input" placeholder="Optional">
                                </div>
                                <button type="submit" class="btn-calculate">CALCULATE</button>
                            </form>
                        </div>
                        
                        <!-- Repayment Calculator -->
                        <div id="repayment-calculator" class="calculator-form">
                            <form id="repayment-form" class="mortgage-calculator-form">
                                <div class="form-group">
                                    <label for="repayment-loan">Loan Amount (£)</label>
                                    <input type="text" id="repayment-loan" name="loanAmount" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="repayment-rate">Interest Rate (%)
                                    <span class="info-tooltip" data-tooltip="A higher interest rate increases your monthly payments and total repaid">ⓘ</span>
                                    </label>
                                    <input type="number" id="repayment-rate" name="interestRate" required min="0" max="100" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="repayment-term-yrs">Loan Term (years)
                                    <span class="info-tooltip" data-tooltip="Maximum term is 40 years. Longer terms reduce monthly payments but increase total interest paid; shorter terms lead to interest savings">ⓘ</span>
                                    </label>
                                    <input type="number" id="repayment-term-yrs" name="loanTerm-yrs" required min="1" max="40" step="1">
                                </div>

                                <div class="form-group">
                                    <label for="repayment-term-mths">Loan Term (months)
                                    <input type="number" id="repayment-term-mths" name="loanTerm-mths" required min="0" max="11" step="1">
                                </div>
                                <button type="submit" class="btn-calculate">CALCULATE</button>
                                
                                <!-- Info Boxes -->
                                <div class="info-box-container">
                                    <div class="calc-info-box">
                                        <h4>Interest Rate Impact</h4>
                                        <p>A higher interest rate increases your monthly payments and total amount repaid. Even a 0.5% difference can mean thousands more over the loan term.</p>
                                    </div>
                                    <div class="calc-info-box gold-accent">
                                        <h4>Loan Term Impact</h4>
                                        <p>Longer terms reduce monthly payments but increase total interest paid. Shorter terms mean higher monthly payments but significant interest savings.</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Overpayment Calculator -->
                        <div id="overpayment-calculator" class="calculator-form">
                            <form id="overpayment-form" class="mortgage-calculator-form">
                                <div class="form-group">
                                    <label for="overpayment-loan">Loan Amount (£)</label>
                                    <input type="text" id="overpayment-loan" name="loanAmount" required class="number-input">
                                </div>
                                <div class="form-group">
                                    <label for="overpayment-rate">Interest Rate (%)</label>
                                    <input type="number" id="overpayment-rate" name="interestRate" required min="0" max="100" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="overpayment-term-yrs">Loan Term (years)</label>
                                    <input type="number" id="overpayment-term-yrs" name="loanTermYears" required min="1" max="40" step="1">
                                </div>
                                <div class="form-group">
                                    <label for="overpayment-term-mths">Loan Term (months)</label>
                                    <input type="number" id="overpayment-term-mths" name="loanTermMths" required min="0" max="11" step="1">
                                </div>
                                <div class="form-group">
                                    <label for="overpayment-amount">Monthly Overpayment Amount (£)</label>
                                    <input type="text" id="overpayment-amount" name="overpaymentAmount" required class="number-input">
                                </div>
                                <button type="submit" class="btn-calculate">CALCULATE</button>
                            </form>
                        </div>

                    <div id="stampduty-calculator" class="calculator-form">
                        <form id="stampduty-form" class="mortgage-calculator-form">
                            <div class="form-group">
                                <label for="stampduty-price">
                                    Property Price (£)</label>
                                <input type="text" id="stampduty-price" name="propertyPrice" required class="number-input">
                            </div>
                            <div class="form-group">
                                <label for="stampduty-type">Buyer Type</label>
                                <select id="stampduty-type" name="buyerType" required>
                                    <option value="standard">Standard Buyer</option>
                                    <option value="first-time">First Time Buyer</option>
                                    <option value="additional">Additional Property (5% Surcharge)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-calculate">CALCULATE</button>

                            <!-- Info Box -->
                            <div class="info-box-container" style="margin-top: 30px;">
                                <div class="calc-info-box" style="grid-column: 1 / -1;">
                                    <h4>UK Stamp Duty Rates (April 2025 onwards)</h4>
                                    <p><strong>Standard Buyers:</strong> 0% up to £125k, 2% up to £250k, 5% up to £925k, 10% up to £1.5m, 12% above</p>
                                    <p><strong>First Time Buyers:</strong> 0% up to £300k, 5% up to £500k, then standard rates</p>
                                    <p><strong>Additional Properties:</strong> Standard rates + 5% surcharge on entire amount</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    
                    <!-- Right Side - Results -->
                    <div class="calculator-results">
                        <h2>Your Results</h2>
                        <div id="results-display" class="results-content">
                            <div class="results-placeholder">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/calculator-icon.svg" alt="Calculator" class="placeholder-icon">
                                <p>Enter values and click calculate to see your results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Constants for calculations
    const INCOME_MULTIPLE = 4.5;
    const SALARY_WEIGHT = 1.0; // 100%
    const BONUS_WEIGHT = 0.6; // 60%

    // Variables to store calculated values for inter-calculator navigation
    window.lastBorrowAmount = 0;
    window.lastRepaymentLoan = 0;
    window.lastRepaymentRate = 0;
    window.lastRepaymentTerm = 0;

    // Format number input with commas
    function formatNumberInput(input) {
        // Remove existing commas
        let value = input.value.replace(/,/g, '');
        
        // Check if it's a valid number
        if (!isNaN(value) && value !== '') {
            // Format with commas
            input.value = Number(value).toLocaleString('en-GB');
        }
    }

    // Parse number from formatted input
    function parseNumberInput(input) {
        return parseFloat(input.value.replace(/,/g, '')) || 0;
    }

    // Add formatting to all number inputs
    const numberInputs = document.querySelectorAll('.number-input');
    numberInputs.forEach(input => {
        // Format on blur (when user leaves the field)
        input.addEventListener('blur', function() {
            formatNumberInput(this);
        });

        // Remove formatting on focus for easier editing
        input.addEventListener('focus', function() {
            this.value = this.value.replace(/,/g, '');
        });
    });

    // Tab switching functionality
    const tabs = document.querySelectorAll('.calculator-tab');
    const forms = document.querySelectorAll('.calculator-form');
    
    // Function to switch to a specific calculator
    function switchToCalculator(calculatorType) {
        // Update active tab
        tabs.forEach(t => t.classList.remove('active'));
        const targetTab = document.querySelector(`[data-calculator="${calculatorType}"]`);
        if (targetTab) {
            targetTab.classList.add('active');
        }
        
        // Show corresponding calculator
        forms.forEach(f => f.classList.remove('active'));
        const targetForm = document.getElementById(calculatorType + '-calculator');
        if (targetForm) {
            targetForm.classList.add('active');
        }
        
        // Clear results when switching tabs
        clearResults();
    }
    
    // Handle URL hash on page load
    function handleInitialHash() {
        const hash = window.location.hash.replace('#', '');
        if (hash) {
            // Map hash values to calculator types
            const hashMap = {
                'borrow': 'borrow',
                'how-much-can-i-borrow': 'borrow',
                'repayment': 'repayment',
                'repayment-calculator': 'repayment',
                'overpayment': 'overpayment',
                'overpayment-calculator': 'overpayment',
                'stampduty': 'stampduty',
                'stamp-duty': 'stampduty',
                'stamp-duty-calculator': 'stampduty'
            };
            
            const calculatorType = hashMap[hash.toLowerCase()];
            if (calculatorType) {
                switchToCalculator(calculatorType);
            }
        }
    }
    
    // Handle hash changes while on the page
    window.addEventListener('hashchange', function() {
        handleInitialHash();
    });
    
    // Check for hash on initial load
    handleInitialHash();
    
    // Original tab click functionality
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const calculatorType = this.getAttribute('data-calculator');
            
            // Update URL hash without triggering scroll
            history.replaceState(null, null, '#' + calculatorType);
            
            switchToCalculator(calculatorType);
        });
    });
    
    // Handle form submissions
    const borrowForm = document.getElementById('borrow-form');
    const repaymentForm = document.getElementById('repayment-form');
    const overpaymentForm = document.getElementById('overpayment-form');
    const stampdutyForm = document.getElementById('stampduty-form');
    
    if (borrowForm) {
        borrowForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateBorrow();
        });
    }
    
    if (repaymentForm) {
        repaymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateRepayment();
        });
    }
    
    if (overpaymentForm) {
        overpaymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateOverpayment();
        });
    }

    if (stampdutyForm) {
        stampdutyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateStampDuty();
        });
    }
    
    // Calculator Functions
    
    // Borrow Calculator
    function calculateBorrow() {
        const income = parseNumberInput(document.getElementById('borrow-income'));
        const additionalIncome = parseNumberInput(document.getElementById('borrow-additional-income'));
        const monthlyExpenditure = parseNumberInput(document.getElementById('borrow-expenditure'));
        const deposit = parseNumberInput(document.getElementById('borrow-deposit'));
        
        // Step 1: Calculate weighted income
        const weightedIncome = (income * SALARY_WEIGHT) + (additionalIncome * BONUS_WEIGHT);
        
        // Step 2: Apply income multiple
        const grossBorrowingCapacity = weightedIncome * INCOME_MULTIPLE;
        
        // Step 3: Annualise committed expenditure
        const annualExpenditure = monthlyExpenditure * 12;
        
        // Step 4: Calculate actual borrowing capacity
        const borrowingCapacity = Math.max(0, grossBorrowingCapacity - annualExpenditure);

        // Store for use in other calculator
        window.lastBorrowAmount = borrowingCapacity;
        
        // Step 5: Calculate upper budget (what you can buy)
        const upperBudget = borrowingCapacity + deposit;
        
        // Build results object
        const results = {
            'Maximum Borrowing': '<span class="highlight-gold">£' + formatNumber(borrowingCapacity) + '</span>'
        };
        
        // Only show deposit and upper budget if deposit was provided
        if (deposit > 0) {
            results['Likely Upper Budget'] = '<span class="highlight-blue">£' + formatNumber(upperBudget) + '</span>';
        }
        
        displayResults(results, 'borrow');
        
        // Add buttons: use in repayment calculator + AIP CTA
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay && borrowingCapacity > 0) {
            const buttonsHtml = '<div class="results-actions">' +
                '<button class="use-borrow-button" onclick="useBorrowAmount()">Use this amount in Repayment Calculator</button>' +
                '</div>' +
                '<div class="results-cta">' +
                '<a href="<?php echo home_url('/aip-overview'); ?>" class="btn-primary">Get your agreement in principle today!</a>' +
                '</div>';
            resultsDisplay.innerHTML += buttonsHtml;
        }
    }
    
    // Repayment Calculator
    function calculateRepayment() {
        const loanAmount = parseNumberInput(document.getElementById('repayment-loan'));
        const annualRate = parseFloat(document.getElementById('repayment-rate').value) || 0;
        const loanTermYears = parseFloat(document.getElementById('repayment-term-yrs').value) || 0;
        const loanTermMths = parseFloat(document.getElementById('repayment-term-mths').value) || 0;
        const loanTerm = loanTermYears + (loanTermMths / 12);

        // Store for use in overpayment calculator
        window.lastRepaymentLoan = loanAmount;
        window.lastRepaymentRate = annualRate;
        window.lastRepaymentTermYrs = loanTermYears;
        window.lastRepaymentTermMths = loanTermMths;
        
        // Convert to monthly values
        const monthlyRate = annualRate / 100 / 12;
        const numberOfPayments = loanTerm * 12;
        
        // Calculate monthly payment using PMT formula
        let monthlyPayment;
        if (monthlyRate === 0) {
            monthlyPayment = loanAmount / numberOfPayments;
        } else {
            monthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                           (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
        }
        
        // Calculate total payment and interest
        const totalPayment = monthlyPayment * numberOfPayments;
        const totalInterest = totalPayment - loanAmount;
        
        displayResults({
            'Monthly Payment': '<span class="highlight-gold">£' + formatNumber(monthlyPayment) + '</span>',
            'Total Payment': '£' + formatNumber(totalPayment),
            'Total Interest': '<span class="highlight-blue">£' + formatNumber(totalInterest) + '</span>'
        }, 'repayment');
        
        // Add buttons: use in overpayment calculator + AIP CTA
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay && loanAmount > 0) {
            const buttonsHtml = '<div class="results-actions">' +
                '<button class="use-borrow-button" onclick="useRepaymentAmount()">Use these values in Overpayment Calculator</button>' +
                '</div>';
            resultsDisplay.innerHTML += buttonsHtml;
        }
        
        // Add AIP CTA
        addAipCta();
    }
    
    // Overpayment Calculator
    function calculateOverpayment() {
        const loanAmount = parseNumberInput(document.getElementById('overpayment-loan'));
        const annualRate = parseFloat(document.getElementById('overpayment-rate').value) || 0;
        const loanTermYears = parseFloat(document.getElementById('overpayment-term-yrs').value) || 0;
        const loanTermMths = parseFloat(document.getElementById('overpayment-term-mths').value) || 0;
        const loanTerm = loanTermYears + (loanTermMths / 12);
        const monthlyOverpayment = parseNumberInput(document.getElementById('overpayment-amount'));

        // Convert to monthly values
        const monthlyRate = annualRate / 100 / 12;
        const numberOfPayments = loanTerm * 12;
        
        // Calculate standard monthly payment
        let standardMonthlyPayment;
        if (monthlyRate === 0) {
            standardMonthlyPayment = loanAmount / numberOfPayments;
        } else {
            standardMonthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                                   (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
        }
        
        // Calculate with overpayment
        const totalMonthlyPayment = standardMonthlyPayment + monthlyOverpayment;
        
        // Check if overpayment is too low
        const minimumPayment = loanAmount * monthlyRate;
        if (totalMonthlyPayment <= minimumPayment && monthlyRate > 0) {
            displayError('Overpayment amount is too low. Please increase your overpayment.');
            return;
        }
        
        // Calculate new term with overpayment using NPER formula
        let newTermMonths;
        if (monthlyRate === 0) {
            newTermMonths = loanAmount / totalMonthlyPayment;
        } else {
            newTermMonths = Math.log(totalMonthlyPayment / (totalMonthlyPayment - loanAmount * monthlyRate)) / 
                          Math.log(1 + monthlyRate);
        }
        
        const newTermYears = newTermMonths / 12;
        
        // Calculate interest without overpayment
        const totalWithoutOverpayment = standardMonthlyPayment * numberOfPayments;
        const interestWithoutOverpayment = totalWithoutOverpayment - loanAmount;
        
        // Calculate interest with overpayment
        const totalWithOverpayment = totalMonthlyPayment * newTermMonths;
        const interestWithOverpayment = totalWithOverpayment - loanAmount;
        
        // Calculate savings
        const interestSaved = interestWithoutOverpayment - interestWithOverpayment;
        const timeSaved = loanTerm - newTermYears;
        
        displayResults({
            'Standard Monthly Payment': '£' + formatNumber(standardMonthlyPayment),
            'Total Monthly Payment': '<span class="highlight-gold">£' + formatNumber(totalMonthlyPayment) + '</span>',
            'New Term': '<span class="highlight-blue">' + newTermYears.toFixed(1) + ' years</span>',
            'Original Total Interest': '£' + formatNumber(interestWithoutOverpayment),
            'New Total Interest': '£' + formatNumber(interestWithOverpayment),
            'Interest Saved': '<span class="highlight-gold">£' + formatNumber(interestSaved) + '</span>',
            'Time Saved': '<span class="highlight-blue">' + timeSaved.toFixed(1) + ' years</span>'
        }, 'overpayment');
        
        // Add AIP CTA
        addAipCta();
    }

    // Stamp Duty Calculator - UPDATED FOR 2025/26 RATES
    function calculateStampDuty() {
        const propertyPrice = parseNumberInput(document.getElementById('stampduty-price'));
        const buyerType = document.getElementById('stampduty-type').value;
        
        let stampDuty = 0;
        let breakdown = [];
        
        // Define tax bands based on buyer type - UPDATED FOR 2025/26
        let bands;
        
        if (buyerType === 'first-time') {
            // First time buyer rates - Updated for 2025/26
            if (propertyPrice <= 500000) {
                bands = [
                    { threshold: 300000, rate: 0 },
                    { threshold: 500000, rate: 0.05 }
                ];
            } else {
                // First time buyers pay standard rates above £500k
                bands = [
                    { threshold: 125000, rate: 0 },
                    { threshold: 250000, rate: 0.02 },
                    { threshold: 925000, rate: 0.05 },
                    { threshold: 1500000, rate: 0.10 },
                    { threshold: Infinity, rate: 0.12 }
                ];
            }
        } else {
            // Standard buyer rates - Updated for 2025/26
            bands = [
                { threshold: 125000, rate: 0 },
                { threshold: 250000, rate: 0.02 },
                { threshold: 925000, rate: 0.05 },
                { threshold: 1500000, rate: 0.10 },
                { threshold: Infinity, rate: 0.12 }
            ];
        }
        
        // Calculate stamp duty based on bands
        let remainingValue = propertyPrice;
        let previousThreshold = 0;
        
        for (const band of bands) {
            if (remainingValue <= 0) break;
            
            const taxableAmount = Math.min(remainingValue, band.threshold - previousThreshold);
            const taxForBand = taxableAmount * band.rate;
            
            if (taxForBand > 0) {
                breakdown.push({
                    from: previousThreshold,
                    to: previousThreshold + taxableAmount,
                    rate: band.rate * 100,
                    tax: taxForBand
                });
            }
            
            stampDuty += taxForBand;
            remainingValue -= taxableAmount;
            previousThreshold = band.threshold;
        }
        
        // Add 5% surcharge for additional properties (updated from 3% to 5% for 2025/26)
        let surcharge = 0;
        if (buyerType === 'additional') {
            surcharge = propertyPrice * 0.05;
            stampDuty += surcharge;
        }
        
        // Calculate effective rate
        const effectiveRate = propertyPrice > 0 ? (stampDuty / propertyPrice) * 100 : 0;
        
        // Display results
        const results = {};
        
        // Add breakdown
        if (breakdown.length > 0) {
            breakdown.forEach(band => {
                results[`£${formatNumber(band.from)} - £${formatNumber(band.to)} @ ${band.rate}%`] = 
                    '£' + formatNumber(band.tax);
            });
        }
        
        if (surcharge > 0) {
            results['5% Surcharge'] = '<span class="highlight-gold">£' + formatNumber(surcharge) + '</span>';
        }
        
        results['Total Stamp Duty'] = '<span class="highlight-blue">£' + formatNumber(stampDuty) + '</span>';
        results['Effective Rate'] = effectiveRate.toFixed(2) + '%';
        
        displayResults(results, 'stampduty');
        
        // Add AIP CTA
        addAipCta();
    }
    
    // Display results function
    function displayResults(results, calculatorType) {
        let html = '';
        
        for (const [label, value] of Object.entries(results)) {
            let itemClass = 'result-item';
            if (label.includes('Total') || label.includes('Maximum') || label.includes('Budget')) {
                itemClass += ' total';
            }
            if (label.includes('Saved')) {
                itemClass += ' savings';
            }
            
            html += '<div class="' + itemClass + '">';
            html += '<div class="result-label">' + label + '</div>';
            html += '<div class="result-value">' + value + '</div>';
            html += '</div>';
        }
        
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML = html;
        }
    }
    
    // Add AIP CTA button to results
    function addAipCta() {
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay && !resultsDisplay.querySelector('.results-cta')) {
            const ctaHtml = '<div class="results-cta">' +
                '<a href="<?php echo home_url('/aip-overview'); ?>" class="btn-primary">Get your agreement in principle today!</a>' +
                '</div>';
            resultsDisplay.innerHTML += ctaHtml;
        }
    }

    // Display error message
    function displayError(message) {
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML = '<div class="error-message">' + message + '</div>';
        }
    }
    
    // Clear results
    function clearResults() {
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML = '<div class="results-placeholder"><img src="<?php echo get_template_directory_uri(); ?>/assets/calculator-icon.svg" alt="Calculator" class="placeholder-icon"><p>Enter values and click calculate to see your results</p></div>';
        }
    }
    
    // Format number with commas
    function formatNumber(num) {
        return num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // Function to use borrow amount in repayment calculator
    window.useBorrowAmount = function() {
        // Find the repayment tab button
        const repaymentTab = document.querySelector('[data-calculator="repayment"]');
        
        if (repaymentTab) {
            // Trigger click on the tab
            repaymentTab.click();
            
            // Small delay to ensure tab has switched
            setTimeout(function() {
                // Set the loan amount
                const loanInput = document.getElementById('repayment-loan');
                
                if (loanInput) {
                    loanInput.value = Math.round(window.lastBorrowAmount).toLocaleString('en-GB');
                    
                    // Focus on the interest rate field
                    const rateInput = document.getElementById('repayment-rate');
                    if (rateInput) {
                        rateInput.focus();
                    }
                }
            }, 100);
        }
    };

    // Function to use repayment values in overpayment calculator
    window.useRepaymentAmount = function() {
        // Find the overpayment tab button
        const overpaymentTab = document.querySelector('[data-calculator="overpayment"]');
        
        if (overpaymentTab) {
            // Trigger click on the tab
            overpaymentTab.click();
            
            // Small delay to ensure tab has switched
            setTimeout(function() {
                // Set the loan amount
                const loanInput = document.getElementById('overpayment-loan');
                const rateInput = document.getElementById('overpayment-rate');
                const termInputYrs = document.getElementById('overpayment-term-yrs');
                const termInputMths = document.getElementById('overpayment-term-mths');
                const overpaymentInput = document.getElementById('overpayment-amount');
                
                if (loanInput) {
                    loanInput.value = Math.round(window.lastRepaymentLoan).toLocaleString('en-GB');
                }
                if (rateInput) {
                    rateInput.value = window.lastRepaymentRate;
                }
                if (termInputYrs) {
                    termInputYrs.value = window.lastRepaymentTermYrs;
                }
                if (termInputMths) {
                    termInputMths.value = window.lastRepaymentTermMths;
                }
                // Focus on the overpayment amount field
                if (overpaymentInput) {
                    overpaymentInput.focus();
                }
            }, 100);
        }
    };
});
</script>

<?php get_template_part('template-parts/team-contact'); ?>

</main>
<?php
get_footer();
