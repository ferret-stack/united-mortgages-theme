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
    
    // Calculator 1: Add values and calculate percentage
    function calculateBorrow() {
        const value1 = parseFloat(document.getElementById('borrow-value1').value) || 0;
        const value2 = parseFloat(document.getElementById('borrow-value2').value) || 0;
        const percentage = parseFloat(document.getElementById('borrow-percentage').value) || 0;
        
        const sum = value1 + value2;
        const percentageAmount = (sum * percentage) / 100;
        const total = sum + percentageAmount;
        
        displayResults({
            'Value 1': formatNumber(value1),
            'Value 2': formatNumber(value2),
            'Sum (Value 1 + Value 2)': formatNumber(sum),
            'Percentage': percentage + '%',
            'Percentage Amount': '£' + formatNumber(percentageAmount),
            'Total': '£' + formatNumber(total)
        });
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