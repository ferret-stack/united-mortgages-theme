/**
 * United Mortgages Calculator Functions
 */

document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Tab switching functionality
    const tabs = document.querySelectorAll('.calculator-tab');
    const forms = document.querySelectorAll('.calculator-form');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const calculatorType = this.getAttribute('data-calculator');
            
            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding calculator
            forms.forEach(f => f.classList.remove('active'));
            const targetForm = document.getElementById(calculatorType + '-calculator');
            if (targetForm) {
                targetForm.classList.add('active');
            }
            
            // Clear results when switching tabs
            clearResults();
        });
    });
    
    // Handle form submissions
    const borrowForm = document.getElementById('borrow-form');
    const repaymentForm = document.getElementById('repayment-form');
    const overpaymentForm = document.getElementById('overpayment-form');
    
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
    
    // Calculator Functions

    // Borrowing multiple range shown as "Typical" (low) / "Enhanced" (high).
    // Kept in sync with page-calculators.php — see that file for sourcing/review-date notes.
    // Review by: 2027-01-16
    const MULTIPLE_LOW = 4.5;
    const MULTIPLE_HIGH = 6.0;
    const SALARY_WEIGHT = 1.0;
    const BONUS_WEIGHT = 0.6;

    // How Much Can I Borrow
    function calculateBorrow() {
        const incomeEl = document.getElementById('borrow-income');
        const additionalIncomeEl = document.getElementById('borrow-additional-income');
        const expenditureEl = document.getElementById('borrow-expenditure');
        const depositEl = document.getElementById('borrow-deposit');
        if (!incomeEl || !additionalIncomeEl || !expenditureEl) return;

        const income = parseFloat(incomeEl.value.replace(/,/g, '')) || 0;
        const additionalIncome = parseFloat(additionalIncomeEl.value.replace(/,/g, '')) || 0;
        const monthlyExpenditure = parseFloat(expenditureEl.value.replace(/,/g, '')) || 0;
        const deposit = depositEl ? (parseFloat(depositEl.value.replace(/,/g, '')) || 0) : 0;

        // Weighted income, low/high multiples, annualised expenditure
        const weightedIncome = (income * SALARY_WEIGHT) + (additionalIncome * BONUS_WEIGHT);
        const annualExpenditure = monthlyExpenditure * 12;

        const borrowingCapacityTypical = Math.max(0, (weightedIncome * MULTIPLE_LOW) - annualExpenditure);
        const borrowingCapacityEnhanced = Math.max(0, (weightedIncome * MULTIPLE_HIGH) - annualExpenditure);

        const results = {
            'Typical': '£' + formatNumber(borrowingCapacityTypical),
            'Enhanced <button type="button" class="range-info-trigger" onclick="openBorrowRangePopup()" aria-label="What does Enhanced mean?">ⓘ</button>': '£' + formatNumber(borrowingCapacityEnhanced)
        };

        if (deposit > 0) {
            results['Typical Upper Budget'] = '£' + formatNumber(borrowingCapacityTypical + deposit);
            results['Enhanced Upper Budget'] = '£' + formatNumber(borrowingCapacityEnhanced + deposit);
        }

        displayResults(results);

        // Static caveat/rate-sensitivity/pension notes — ship with the range, not after
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML +=
                '<p class="borrow-note borrow-disclaimer">These figures are estimates only. They are not guaranteed and actual lending depends on individual lender criteria, your credit history and full financial circumstances.</p>' +
                '<p class="borrow-note borrow-rate-note">Mortgage rates can rise as well as fall. These figures are based on current lending conditions — if you\'re considering a fix shorter than 5 years, it\'s worth discussing how a future rate change could affect what you can borrow.</p>' +
                '<p class="borrow-note borrow-pension-note">This calculator does not take pension contributions into account. Speak to one of our advisers for a more tailored picture of your borrowing potential.</p>';
        }
    }
    
    // Calculator 2: Subtract values and calculate percentage
    function calculateRepayment() {
        const value1 = parseFloat(document.getElementById('repayment-value1').value) || 0;
        const value2 = parseFloat(document.getElementById('repayment-value2').value) || 0;
        const percentage = parseFloat(document.getElementById('repayment-percentage').value) || 0;
        
        const difference = value1 - value2;
        const percentageAmount = (Math.abs(difference) * percentage) / 100;
        const total = difference + (difference >= 0 ? percentageAmount : -percentageAmount);
        
        displayResults({
            'Value 1': formatNumber(value1),
            'Value 2': formatNumber(value2),
            'Difference (Value 1 - Value 2)': formatNumber(difference),
            'Percentage': percentage + '%',
            'Percentage Amount': '£' + formatNumber(percentageAmount),
            'Total': '£' + formatNumber(total)
        });
    }
    
    // Calculator 3: Multiply values and calculate percentage
    function calculateOverpayment() {
        const value1 = parseFloat(document.getElementById('overpayment-value1').value) || 0;
        const value2 = parseFloat(document.getElementById('overpayment-value2').value) || 0;
        const percentage = parseFloat(document.getElementById('overpayment-percentage').value) || 0;
        
        const product = value1 * value2;
        const percentageAmount = (product * percentage) / 100;
        const total = product + percentageAmount;
        
        displayResults({
            'Value 1': formatNumber(value1),
            'Value 2': formatNumber(value2),
            'Product (Value 1 × Value 2)': formatNumber(product),
            'Percentage': percentage + '%',
            'Percentage Amount': '£' + formatNumber(percentageAmount),
            'Total': '£' + formatNumber(total)
        });
    }
    
    // Display results function
    function displayResults(results) {
        let html = '';
        
        for (const [label, value] of Object.entries(results)) {
            html += `
                <div class="result-item">
                    <div class="result-label">${label}</div>
                    <div class="result-value">${value}</div>
                </div>
            `;
        }
        
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML = html;
        }
    }
    
    // Clear results
    function clearResults() {
        const resultsDisplay = document.getElementById('results-display');
        if (resultsDisplay) {
            resultsDisplay.innerHTML = '<p class="results-placeholder">Enter values and click calculate to see your results</p>';
        }
    }
    
    // Format number with commas
    function formatNumber(num) {
        return num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    
});