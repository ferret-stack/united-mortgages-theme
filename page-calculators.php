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
    <section class="calculator-hero um-calc-page">
        <div class="hp-container">
            <div class="um-calc-hero">
                <div class="hp-pill">Free &amp; instant &middot; no obligation</div>
                <h1 class="um-calc-hero__title">Our <span class="um-calc-hero__accent">Calculators</span></h1>
                <p class="um-calc-hero__subtitle">Try our mortgage calculators to estimate how much you could borrow and what your monthly payments might look like.</p>
            </div>

            <div class="calculator-container">
                <!-- Calculator Tabs -->
                <div class="calculator-tabs">
                    <button class="calculator-tab active" data-calculator="borrow">HOW MUCH CAN I BORROW?</button>
                    <button class="calculator-tab" data-calculator="repayment">REPAYMENT CALCULATOR</button>
                    <button class="calculator-tab" data-calculator="overpayment">OVERPAYMENT CALCULATOR</button>
                    <button class="calculator-tab" data-calculator="stampduty">STAMP DUTY CALCULATOR</button>
                    <button class="calculator-tab" data-calculator="incometax">INCOME TAX CALCULATOR</button>
                    <button class="calculator-tab" data-calculator="dividend">DIVIDEND TAX CALCULATOR</button>
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

                            <!-- Mandatory popup: Typical vs Enhanced (compliance-approved copy) -->
                            <div id="borrow-range-popup" class="popup-overlay">
                                <div class="popup-content">
                                    <div class="popup-header">
                                        <h2>Typical vs Enhanced</h2>
                                        <button type="button" class="popup-close" onclick="closeBorrowRangePopup()" aria-label="Close">&times;</button>
                                    </div>
                                    <div class="popup-body">
                                        <p>These figures are estimates only. They are not guaranteed and actual lending depends on individual lender criteria, your credit history and full financial circumstances.</p>
                                        <p>The <strong>Enhanced</strong> figure reflects income multiples of up to 6x now offered by a number of UK lenders. This tier is generally only available to higher earners - commonly &pound;75,000+ income - and is subject to lender-specific eligibility criteria. Most borrowers will not qualify for the Enhanced figure even though it is a real, current market rate. Your <strong>Typical</strong> figure is a more representative starting point for most applicants.</p>
                                    </div>
                                    <div class="popup-footer">
                                        <button type="button" class="popup-button" onclick="closeBorrowRangePopup()">Got it</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="repayment-calculator" class="calculator-form">
                            <form id="repayment-form" class="mortgage-calculator-form">

                        <!-- Repayment type toggle -->
                        <div class="form-group">
                            <label>Mortgage Type</label>
                            <div class="repayment-toggle">
                                <label class="toggle-option active" id="toggle-label-repayment">
                                    <input type="radio" name="repaymentType" value="repayment" checked>
                                    Repayment
                                </label>
                                <label class="toggle-option" id="toggle-label-interest-only">
                                    <input type="radio" name="repaymentType" value="interest-only">
                                    Interest Only
                                </label>
                            </div>
                        </div>
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

                    <!-- Dividend Tax Calculator -->
                    <div id="dividend-calculator" class="calculator-form">
                        <form id="dividend-form" class="mortgage-calculator-form">
                            <div class="form-group">
                                <label for="dividend-salary">
                                    Annual Salary (£)
                                    <span class="info-tooltip" data-tooltip="Your gross salary before tax. Using your personal allowance of £12,570 as salary is the most tax-efficient approach for director/shareholder setups.">ⓘ</span>
                                </label>
                                <input type="text" id="dividend-salary" name="salary" required class="number-input">
                            </div>
                            <div class="form-group">
                                <label for="dividend-amount">
                                    Annual Dividends (£)
                                    <span class="info-tooltip" data-tooltip="Total dividends drawn in the tax year. Dividends are taxed as the top slice of your income.">ⓘ</span>
                                </label>
                                <input type="text" id="dividend-amount" name="dividends" required class="number-input">
                            </div>
                            <button type="submit" class="btn-calculate">CALCULATE</button>

                            <!-- Info Box -->
                            <div class="info-box-container" style="margin-top: 30px;">
                                <div class="calc-info-box" style="grid-column: 1 / -1;">
                                    <h4>2026/27 Dividend Tax Rates (England, Wales & NI)</h4>
                                    <p><strong>Dividend Allowance:</strong> £500 at 0%</p>
                                    <p><strong>Basic rate band:</strong> 10.75% &nbsp;|&nbsp; <strong>Higher rate band:</strong> 35.75% &nbsp;|&nbsp; <strong>Additional rate:</strong> 39.35%</p>
                                    <p>Dividends are the top slice of income. Scotland differs.</p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Income Tax Calculator -->
                    <div id="incometax-calculator" class="calculator-form">
                        <form id="incometax-form" class="mortgage-calculator-form">
                            <div class="form-group">
                                <label for="incometax-salary">
                                    Annual Gross Salary (£)
                                    <span class="info-tooltip" data-tooltip="Your total gross salary before any tax, NI or other deductions.">ⓘ</span>
                                </label>
                                <input type="text" id="incometax-salary" name="salary" required class="number-input">
                            </div>
                            <div class="form-group">
                                <label for="incometax-student-loan">Student Loan Plan</label>
                                <select id="incometax-student-loan" name="studentLoan">
                                    <option value="none">None</option>
                                    <option value="plan1">Plan 1 — repay 9% above £26,900</option>
                                    <option value="plan2">Plan 2 — repay 9% above £29,385</option>
                                    <option value="plan4">Plan 4 (Scotland) — repay 9% above £33,795</option>
                                    <option value="plan5">Plan 5 — repay 9% above £25,000</option>
                                    <option value="postgrad">Postgraduate — repay 6% above £21,000</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-calculate">CALCULATE</button>

                            <!-- Info Box -->
                            <div class="info-box-container" style="margin-top: 30px;">
                                <div class="calc-info-box" style="grid-column: 1 / -1;">
                                    <h4>2026/27 Income Tax Rates (England, Wales & NI)</h4>
                                    <p><strong>Personal Allowance:</strong> £12,570 (tapered above £100,000, lost at £125,140)</p>
                                    <p><strong>Basic rate (20%):</strong> £12,571–£50,270 &nbsp;|&nbsp; <strong>Higher rate (40%):</strong> £50,271–£125,140 &nbsp;|&nbsp; <strong>Additional rate (45%):</strong> above £125,140</p>
                                    <p><strong>Employee NI:</strong> 8% on £12,570–£50,270 &nbsp;|&nbsp; 2% above £50,270. NI calculated on annualised basis. Scotland differs for income tax.</p>
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

    // Borrowing multiple range shown as "Typical" (low) / "Enhanced" (high).
    // Names are deliberately decoupled from the display labels — a future
    // label change (compliance review, A/B test) should only touch copy.
    // Source: market check July 2026 — 20+ lenders now offer 6x+ LTI
    // (incl. Barclays, NatWest, HSBC, Nationwide, Leeds BS); the top end is
    // eligibility-restricted (commonly £75k+ income), hence the popup below.
    // Review by: 2027-01-16
    const MULTIPLE_LOW = 4.5;
    const MULTIPLE_HIGH = 6.0;
    const SALARY_WEIGHT = 1.0; // 100%
    const BONUS_WEIGHT = 0.6; // 60%

    // Dividend Tax Constants — 2026/27 (England, Wales & NI)
    const PERSONAL_ALLOWANCE   = 12570;
    const PA_TAPER_START       = 100000;
    const BASIC_RATE_LIMIT     = 50270;   // top of basic band
    const ADDITIONAL_RATE_FROM = 125140;  // top of higher band / start of additional
    const DIVIDEND_ALLOWANCE   = 500;
    const DIV_ORDINARY         = 0.1075;  // basic band
    const DIV_UPPER            = 0.3575;  // higher band
    const DIV_ADDITIONAL       = 0.3935;  // additional rate band

    // Income Tax Constants — 2026/27 (England, Wales & NI)
    const BASIC_BAND_WIDTH    = 37700;   // width of basic rate band on taxable income
    const HIGHER_BAND_WIDTH   = 74870;   // width of higher rate band on taxable income
    const RATE_BASIC          = 0.20;
    const RATE_HIGHER         = 0.40;
    const RATE_ADDITIONAL     = 0.45;

    // Employee NI (Class 1) — 2026/27, annualised
    const NI_PRIMARY_THRESHOLD = 12570;
    const NI_UPPER_LIMIT       = 50270;
    const NI_MAIN_RATE         = 0.08;
    const NI_UPPER_RATE        = 0.02;

    // Student Loan Repayment Thresholds — 2026/27 (verified gov.uk)
    const SL_PLAN1_THRESHOLD    = 26900;
    const SL_PLAN2_THRESHOLD    = 29385;
    const SL_PLAN4_THRESHOLD    = 33795;
    const SL_PLAN5_THRESHOLD    = 25000;
    const SL_POSTGRAD_THRESHOLD = 21000;
    const SL_UNDERGRAD_RATE     = 0.09;
    const SL_POSTGRAD_RATE      = 0.06;

    // Variables to store calculated values for inter-calculator navigation
    window.lastBorrowAmountTypical = 0;
    window.lastBorrowAmountEnhanced = 0;
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
                'stamp-duty-calculator': 'stampduty',
                'incometax': 'incometax',
                'income-tax': 'incometax',
                'income-tax-calculator':'incometax',
                'tax': 'incometax',
                'ni': 'incometax',
                'dividend': 'dividend',
                'dividend-tax': 'dividend',
                'dividend-calculator':'dividend',
                'dividends': 'dividend',
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
    const dividendForm = document.getElementById('dividend-form');
    const incometaxForm = document.getElementById('incometax-form');
    
    if (borrowForm) {
        borrowForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateBorrow();
        });
    }

    if (incometaxForm) {
    incometaxForm.addEventListener('submit', function(e) {
        e.preventDefault();
        calculateIncomeTax();
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

    if (dividendForm) {
        dividendForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculateDividend();
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

        // Step 2: Apply the low/high income multiples
        const grossBorrowingCapacityTypical = weightedIncome * MULTIPLE_LOW;
        const grossBorrowingCapacityEnhanced = weightedIncome * MULTIPLE_HIGH;

        // Step 3: Annualise committed expenditure
        const annualExpenditure = monthlyExpenditure * 12;

        // Step 4: Calculate actual borrowing capacity range
        const borrowingCapacityTypical = Math.max(0, grossBorrowingCapacityTypical - annualExpenditure);
        const borrowingCapacityEnhanced = Math.max(0, grossBorrowingCapacityEnhanced - annualExpenditure);

        // Store for use in other calculator — user picks which figure to carry forward
        window.lastBorrowAmountTypical = borrowingCapacityTypical;
        window.lastBorrowAmountEnhanced = borrowingCapacityEnhanced;

        // Step 5: Calculate upper budget (what you can buy) at each end of the range
        const upperBudgetTypical = borrowingCapacityTypical + deposit;
        const upperBudgetEnhanced = borrowingCapacityEnhanced + deposit;

        // Build results object — each figure carries its own "use in repayment"
        // link so the action reads as one choice per number, not two abstract
        // buttons bolted on afterwards.
        const typicalUseLink = borrowingCapacityTypical > 0
            ? '<button type="button" class="use-in-repayment-link" onclick="useBorrowAmountTypical()">Use in Repayment Calculator</button>'
            : '';
        const enhancedUseLink = borrowingCapacityEnhanced > 0
            ? '<button type="button" class="use-in-repayment-link" onclick="useBorrowAmountEnhanced()">Use in Repayment Calculator</button>'
            : '';

        const results = {
            'Typical': '<span class="highlight-gold">£' + formatNumber(borrowingCapacityTypical) + '</span>' + typicalUseLink,
            'Enhanced <button type="button" class="range-info-trigger" onclick="openBorrowRangePopup()" aria-label="What does Enhanced mean?">ⓘ</button>': '<span class="highlight-blue">£' + formatNumber(borrowingCapacityEnhanced) + '</span>' + enhancedUseLink
        };

        // Only show deposit and upper budget if deposit was provided
        if (deposit > 0) {
            results['Typical Upper Budget'] = '£' + formatNumber(upperBudgetTypical);
            results['Enhanced Upper Budget'] = '£' + formatNumber(upperBudgetEnhanced);
        }

        displayResults(results, 'borrow');

        // Static caveat/rate-sensitivity/pension notes — ship with the range, not after
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML +=
                '<p class="borrow-note borrow-pension-note">This calculator does not take pension contributions into account. Speak to one of our advisers for a more tailored picture of your borrowing potential.</p>';
        }

        // Add AIP CTA
        addAipCta();
    }
    
    // Repayment Calculator — V1.4 (adds interest-only branch)
    function calculateRepayment() {
        const loanAmount    = parseNumberInput(document.getElementById('repayment-loan'));
        const annualRate    = parseFloat(document.getElementById('repayment-rate').value) || 0;
        const loanTermYears = parseFloat(document.getElementById('repayment-term-yrs').value) || 0;
        const loanTermMths  = parseFloat(document.getElementById('repayment-term-mths').value) || 0;
        const loanTerm      = loanTermYears + (loanTermMths / 12);

const isInterestOnly = document.querySelector('input[name="repaymentType"]:checked')?.value === 'interest-only';

        // Store for carry-over (always store, regardless of branch)
        window.lastRepaymentLoan     = loanAmount;
        window.lastRepaymentRate     = annualRate;
        window.lastRepaymentTermYrs  = loanTermYears;
        window.lastRepaymentTermMths = loanTermMths;

        if (isInterestOnly) {
            // ── Interest-only branch ──────────────────────────────────────────
            // monthlyPayment = balance × (annualRate / 100) / 12
            // Capital is NOT repaid; it remains due at term end.
            const monthlyPayment = loanAmount * (annualRate / 100) / 12;
            const months         = loanTerm * 12;
            const totalInterest  = monthlyPayment * months;
            const totalRepaid    = totalInterest + loanAmount; // interest + capital balloon

            displayResults({
                'Monthly Payment':   '<span class="highlight-gold">£' + formatNumber(monthlyPayment) + '</span>',
                'Total Interest Paid': '£' + formatNumber(totalInterest),
                'Capital Still Owed': '<span class="highlight-blue">£' + formatNumber(loanAmount) + '</span>',
                'Total Cost (interest + capital)': '£' + formatNumber(totalRepaid)
            }, 'repayment');

            // Prominent capital-still-owed warning
            const resultsDisplay = document.getElementById('results-display');
            if (resultsDisplay) {
                resultsDisplay.innerHTML +=
                    '<div class="interest-only-warning">' +
                    '⚠️ At the end of the term you will still owe the full ' +
                    '<strong>£' + formatNumber(loanAmount) + '</strong> capital. ' +
'Interest-only payments do not reduce what you owe - you need a separate plan to repay the capital.' +
                    '</div>';
            }

            // Carry-over button is intentionally suppressed for interest-only:
            // the overpayment calculator assumes an amortising loan and would
            // produce nonsense figures on an interest-only balance.

        } else {
            // ── Repayment (amortising) branch — unchanged from V1.3 ──────────
            const monthlyRate      = annualRate / 100 / 12;
            const numberOfPayments = loanTerm * 12;

            let monthlyPayment;
            if (monthlyRate === 0) {
                monthlyPayment = loanAmount / numberOfPayments;
            } else {
                monthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) /
                                (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
            }

            const totalPayment  = monthlyPayment * numberOfPayments;
            const totalInterest = totalPayment - loanAmount;

            displayResults({
                'Monthly Payment': '<span class="highlight-gold">£' + formatNumber(monthlyPayment) + '</span>',
                'Total Payment':   '£' + formatNumber(totalPayment),
                'Total Interest':  '<span class="highlight-blue">£' + formatNumber(totalInterest) + '</span>'
            }, 'repayment');

            // Carry-over button (repayment only — not interest-only)
            const resultsDisplay = document.getElementById('results-display');
            if (resultsDisplay && loanAmount > 0) {
                resultsDisplay.innerHTML +=
                    '<div class="results-actions">' +
                    '<button class="use-borrow-button" onclick="useRepaymentAmount()">Use these values in Overpayment Calculator</button>' +
                    '</div>';
            }
        }

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

    // Website V 3.8; adding new calculators

    // Income Tax + NI Calculator — 2026/27 (England, Wales & NI)
    function calculateIncomeTax() {
        const gross = parseNumberInput(document.getElementById('incometax-salary'));
        const studentLoanPlan = document.getElementById('incometax-student-loan').value;

        if (gross < 0) {
            displayError('Please enter a valid salary.');
            return;
        }

        // ── Personal Allowance (tapered above £100,000) ───────────────────────
        let pa = PERSONAL_ALLOWANCE;
        if (gross > PA_TAPER_START) {
            pa = Math.max(0, PERSONAL_ALLOWANCE - Math.floor((gross - PA_TAPER_START) / 2));
        }
        const paTapered = pa < PERSONAL_ALLOWANCE && pa > 0;
        const paLost    = pa === 0;

        // ── Income Tax ────────────────────────────────────────────────────────
        // Fixed band widths on taxable income remain correct even when PA tapers,
        // because 12,570 + 37,700 + 74,870 = 125,140 (the point PA hits zero).
        const taxable    = Math.max(0, gross - pa);
        const inBasic    = Math.min(taxable, BASIC_BAND_WIDTH);
        const inHigher   = Math.min(Math.max(taxable - BASIC_BAND_WIDTH, 0), HIGHER_BAND_WIDTH);
        const inAdditional = Math.max(taxable - BASIC_BAND_WIDTH - HIGHER_BAND_WIDTH, 0);

        const incomeTax = (inBasic * RATE_BASIC) + (inHigher * RATE_HIGHER) + (inAdditional * RATE_ADDITIONAL);

        // ── Employee NI (Class 1, annualised) ─────────────────────────────────
        const niMain  = Math.min(Math.max(gross - NI_PRIMARY_THRESHOLD, 0), NI_UPPER_LIMIT - NI_PRIMARY_THRESHOLD) * NI_MAIN_RATE;
        const niUpper = Math.max(gross - NI_UPPER_LIMIT, 0) * NI_UPPER_RATE;
        const nationalInsurance = niMain + niUpper;

        // ── Student Loan ──────────────────────────────────────────────────────
        let studentLoan = 0;
        let slThreshold = 0;
        let slRate = SL_UNDERGRAD_RATE;

        if (studentLoanPlan === 'plan1') {
            slThreshold = SL_PLAN1_THRESHOLD;
        } else if (studentLoanPlan === 'plan2') {
            slThreshold = SL_PLAN2_THRESHOLD;
        } else if (studentLoanPlan === 'plan4') {
            slThreshold = SL_PLAN4_THRESHOLD;
        } else if (studentLoanPlan === 'plan5') {
            slThreshold = SL_PLAN5_THRESHOLD;
        } else if (studentLoanPlan === 'postgrad') {
            slThreshold = SL_POSTGRAD_THRESHOLD;
            slRate = SL_POSTGRAD_RATE;
        }

        if (studentLoanPlan !== 'none') {
            studentLoan = Math.max(0, gross - slThreshold) * slRate;
        }

        // ── Take-home ─────────────────────────────────────────────────────────
        const totalDeductions = incomeTax + nationalInsurance + studentLoan;
        const netAnnual  = gross - totalDeductions;
        const netMonthly = netAnnual / 12;
        const effectiveRate = gross > 0 ? (totalDeductions / gross) * 100 : 0;

        // ── Build results ─────────────────────────────────────────────────────
        const results = {};

        results['Gross Annual Salary'] = '£' + formatNumber(gross);

        // Personal allowance line
        let paLabel = 'Personal Allowance';
        if (paLost)         paLabel += ' (fully withdrawn — 60% trap applies)';
        else if (paTapered) paLabel += ' (tapered)';
        results[paLabel] = '£' + formatNumber(pa);

        // Income tax breakdown — only show bands with taxable income
        if (inBasic > 0) {
            results['Basic Rate (20%) on £' + formatNumber(inBasic)] = '£' + formatNumber(inBasic * RATE_BASIC);
        }
        if (inHigher > 0) {
            results['Higher Rate (40%) on £' + formatNumber(inHigher)] = '£' + formatNumber(inHigher * RATE_HIGHER);
        }
        if (inAdditional > 0) {
            results['Additional Rate (45%) on £' + formatNumber(inAdditional)] = '£' + formatNumber(inAdditional * RATE_ADDITIONAL);
        }

        results['Income Tax'] = '<span class="highlight-blue">£' + formatNumber(incomeTax) + '</span>';
        results['Employee NI (annualised)'] = '£' + formatNumber(nationalInsurance);

        if (studentLoanPlan !== 'none') {
            results['Student Loan Repayment'] = '£' + formatNumber(studentLoan);
        }

        results['Net Annual Take-Home']  = '<span class="highlight-gold">£' + formatNumber(netAnnual) + '</span>';
        results['Net Monthly Take-Home'] = '<span class="highlight-gold">£' + formatNumber(netMonthly) + '</span>';
        results['Effective Tax Rate']    = effectiveRate.toFixed(1) + '%';

        displayResults(results, 'incometax');

        // Notes
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML +=
                '<p style="font-size:0.8rem;color:#888;margin-top:12px;">' +
                'NI calculated on annualised income. Actual NI is assessed per pay period and may differ slightly. ' +
                'England, Wales & Northern Ireland rates. Scotland differs for income tax.' +
                '</p>';
        }

        addAipCta();
    }

    // Dividend Tax Calculator — 2026/27 (England, Wales & NI)
    function calculateDividend() {
        const salary    = parseNumberInput(document.getElementById('dividend-salary'));
        const dividends = parseNumberInput(document.getElementById('dividend-amount'));

        if (salary < 0 || dividends < 0) {
            displayError('Please enter valid positive amounts.');
            return;
        }

        const total = salary + dividends;

        // ── Personal allowance (tapered above £100,000) ───────────────────────
        let pa = PERSONAL_ALLOWANCE;
        if (total > PA_TAPER_START) {
            pa = Math.max(0, PERSONAL_ALLOWANCE - Math.floor((total - PA_TAPER_START) / 2));
        }
        const paTapered = pa < PERSONAL_ALLOWANCE;
        const paLost    = pa === 0;

        // ── Stacking: salary sits at the bottom, dividends on top ────────────
        // Any personal allowance not used by salary can shelter dividends.
        const remainingPA  = Math.max(0, pa - salary);
        const divAfterPA   = Math.max(0, dividends - remainingPA);

        // £500 allowance at 0% — taxable dividends are what's left after it.
        const divTaxable   = Math.max(0, divAfterPA - DIVIDEND_ALLOWANCE);

        // ── Find where the taxable dividends sit in the bands ─────────────────
        // Floor = the amount of band already consumed by salary (or PA, whichever
        // is higher) plus the 0% allowance slice.
        const floor       = Math.max(salary, pa) + DIVIDEND_ALLOWANCE;
        const basicRoom   = Math.max(0, BASIC_RATE_LIMIT   - floor);
        const higherRoom  = Math.max(0, ADDITIONAL_RATE_FROM - Math.max(floor, BASIC_RATE_LIMIT));

        const inBasic      = Math.min(divTaxable, basicRoom);
        const inHigher     = Math.min(Math.max(divTaxable - inBasic, 0), higherRoom);
        const inAdditional = Math.max(divTaxable - inBasic - inHigher, 0);

        const dividendTax  = (inBasic * DIV_ORDINARY) + (inHigher * DIV_UPPER) + (inAdditional * DIV_ADDITIONAL);
        const netDividends = dividends - dividendTax;

        // ── Build results ─────────────────────────────────────────────────────
        const results = {};

        results['Annual Salary']   = '£' + formatNumber(salary);
        results['Annual Dividends'] = '£' + formatNumber(dividends);
        results['Total Income']    = '£' + formatNumber(total);

        // Personal allowance line
        let paLabel = 'Personal Allowance';
        if (paLost)    paLabel += ' (fully withdrawn)';
        else if (paTapered) paLabel += ' (tapered)';
        results[paLabel] = '£' + formatNumber(pa);

        // Dividend allowance
        const allowanceUsed = Math.min(divAfterPA, DIVIDEND_ALLOWANCE);
        results['Dividend Allowance (0%)'] = '£' + formatNumber(allowanceUsed);

        // Per-band breakdown — only show bands with taxable income
        if (inBasic > 0) {
            results['Basic Rate Band (10.75%)'] = '£' + formatNumber(inBasic * DIV_ORDINARY);
        }
        if (inHigher > 0) {
            results['Higher Rate Band (35.75%)'] = '£' + formatNumber(inHigher * DIV_UPPER);
        }
        if (inAdditional > 0) {
            results['Additional Rate Band (39.35%)'] = '£' + formatNumber(inAdditional * DIV_ADDITIONAL);
        }

        results['Total Dividend Tax'] = '<span class="highlight-blue">£' + formatNumber(dividendTax) + '</span>';
        results['Net Dividends (after tax)'] = '<span class="highlight-gold">£' + formatNumber(netDividends) + '</span>';

        displayResults(results, 'dividend');

        // Region note
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML +=
                '<p style="font-size:0.8rem;color:#888;margin-top:12px;">' +
                'England, Wales & Northern Ireland rates. Scotland differs.' +
                '</p>';
        }

        addAipCta();
    }


    
    // Add AIP CTA button to results
    function addAipCta() {
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay && !resultsDisplay.querySelector('.results-cta')) {
            const ctaHtml = '<div class="results-cta">' +
                '<a href="<?php echo home_url('/aip-overview'); ?>" class="btn-primary">Get your agreement in principle today!</a>' + '<div class="spacer"></div>' +
                '<p style="color:#676767;">This calculator is an interactive tool which should be used for your guidance only and must not form part of your financial decision making process.</p>' +
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

    // Carry a borrow amount into the repayment calculator's loan field.
    // amountKey is the window.* variable name holding the figure to use.
    function useBorrowAmount(amountKey) {
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
                    loanInput.value = Math.round(window[amountKey]).toLocaleString('en-GB');

                    // Focus on the interest rate field
                    const rateInput = document.getElementById('repayment-rate');
                    if (rateInput) {
                        rateInput.focus();
                    }
                }
            }, 100);
        }
    }

    // Function to use the Typical borrow amount in repayment calculator
    window.useBorrowAmountTypical = function() {
        useBorrowAmount('lastBorrowAmountTypical');
    };

    // Function to use the Enhanced borrow amount in repayment calculator
    window.useBorrowAmountEnhanced = function() {
        useBorrowAmount('lastBorrowAmountEnhanced');
    };

    // Mandatory popup explaining the Typical/Enhanced range (compliance-approved copy)
    window.openBorrowRangePopup = function() {
        const popup = document.getElementById('borrow-range-popup');
        if (popup) {
            popup.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeBorrowRangePopup = function() {
        const popup = document.getElementById('borrow-range-popup');
        if (popup) {
            popup.classList.remove('show');
            document.body.style.overflow = '';
        }
    };

    document.addEventListener('click', function(event) {
        const popup = document.getElementById('borrow-range-popup');
        if (popup && event.target === popup) {
            window.closeBorrowRangePopup();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            window.closeBorrowRangePopup();
        }
    });

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
