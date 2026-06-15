# `page-calculators.php` — How It Works

A summary of the **Calculators** page template in the United Mortgages WordPress
theme.

- **File:** `page-calculators.php`
- **Template Name:** `calculators` (assign a Page to this template in WP admin)
- **Current version:** V1.3 — adds inter-calculator navigation
  (borrow → repayment → overpayment) and "Agreement in Principle" (AIP) CTAs.

The page is self-contained: markup, a tabbed UI, and **all** calculation logic
live in this one file. The logic sits in a single inline `<script>` block that
runs on `DOMContentLoaded`.

---

## 1. Page structure

```
get_header()
└── <section class="hero-section calculator-hero">
    ├── hero title / subtitle
    └── <div class="calculator-container">
        ├── <div class="calculator-tabs">         ← 4 tab buttons (data-calculator)
        └── <div class="calculator-content-wrapper">
            ├── <div class="calculator-forms">     ← 4 forms (one per calculator)
            └── <div class="calculator-results">    ← #results-display (output panel)
template-parts/team-contact
get_footer()
```

Key elements:

| Element | Purpose |
| --- | --- |
| `.calculator-tab[data-calculator]` | Tab buttons: `borrow`, `repayment`, `overpayment`, `stampduty` |
| `.calculator-form` / `#<type>-calculator` | One form container per calculator; `.active` shows the current one |
| `#results-display` | Right-hand panel where results, action buttons and the CTA are injected |
| `.number-input` | Text inputs that auto-format with thousands separators |

The active tab/form is tracked with the `active` CSS class.

---

## 2. Tab switching & deep linking

- `switchToCalculator(type)` toggles the `active` class on the matching tab and
  form, and calls `clearResults()`.
- Clicking a tab also updates the URL hash via `history.replaceState` (e.g.
  `#repayment`) without scrolling.
- `handleInitialHash()` reads the URL hash on load and on `hashchange`, mapping
  it through a `hashMap` of aliases so links like `#stamp-duty-calculator` or
  `#how-much-can-i-borrow` resolve to the right calculator.

---

## 3. Number input handling

Inputs with class `.number-input`:

- **On blur** → `formatNumberInput()` adds `en-GB` thousands separators.
- **On focus** → commas are stripped for easy editing.
- Reading a value → `parseNumberInput()` strips commas and returns a float (0 if blank).

Output formatting uses `formatNumber(num)` → fixed to 2 decimals with comma
grouping.

---

## 4. The four calculators

Each form's `submit` is intercepted (`preventDefault`) and routed to its
`calculate*()` function. Every calculation ends by calling `addAipCta()`.

### 4a. How Much Can I Borrow — `calculateBorrow()`

Inputs: annual income, additional income, monthly committed expenditure,
optional deposit.

Constants:

```
INCOME_MULTIPLE = 4.5
SALARY_WEIGHT   = 1.0   (100% of salary)
BONUS_WEIGHT    = 0.6   (60% of additional income)
```

Logic:

```
weightedIncome          = income*1.0 + additionalIncome*0.6
grossBorrowingCapacity  = weightedIncome * 4.5
annualExpenditure       = monthlyExpenditure * 12
borrowingCapacity       = max(0, grossBorrowingCapacity - annualExpenditure)
upperBudget             = borrowingCapacity + deposit   (only if deposit > 0)
```

Outputs: **Maximum Borrowing**, and **Likely Upper Budget** when a deposit was
entered. Stores `window.lastBorrowAmount` and offers a button to carry the
amount into the Repayment calculator.

### 4b. Repayment — `calculateRepayment()`

Inputs: loan amount, interest rate (%), term in years + months.

Uses the standard **PMT amortisation** formula (term = years + months/12):

```
r = annualRate / 100 / 12          (monthly rate)
n = term * 12                       (number of payments)
monthlyPayment = L*r*(1+r)^n / ((1+r)^n - 1)   (or L/n when r == 0)
totalPayment   = monthlyPayment * n
totalInterest  = totalPayment - L
```

Outputs: **Monthly Payment**, **Total Payment**, **Total Interest**. Stores the
loan/rate/term in `window.lastRepayment*` and offers a button to carry the
values into the Overpayment calculator.

### 4c. Overpayment — `calculateOverpayment()`

Inputs: loan amount, rate, term (yrs + mths), monthly overpayment.

Calculates the standard PMT payment, then the shortened term using the **NPER**
(logarithm) formula:

```
totalMonthlyPayment = standardPayment + overpayment
newTermMonths = log( totalMonthlyPayment / (totalMonthlyPayment - L*r) ) / log(1+r)
```

Guards against an overpayment too small to amortise the loan
(`displayError(...)`). Compares interest with vs without overpayment.

Outputs: standard & total monthly payment, new term, original/new total
interest, **Interest Saved**, **Time Saved**.

### 4d. Stamp Duty — `calculateStampDuty()`

Inputs: property price, buyer type (`standard`, `first-time`, `additional`).

Uses **2025/26 UK SDLT bands**, applied marginally per band:

| Buyer type | Bands |
| --- | --- |
| Standard | 0% ≤ £125k, 2% ≤ £250k, 5% ≤ £925k, 10% ≤ £1.5m, 12% above |
| First-time (≤ £500k) | 0% ≤ £300k, 5% £300k–£500k |
| First-time (> £500k) | Standard bands apply |
| Additional property | Standard bands **+ 5% surcharge** on the whole price |

Produces a per-band breakdown, the surcharge line (if any), the **Total Stamp
Duty**, and the **Effective Rate** (`stampDuty / price * 100`).

---

## 5. Inter-calculator carry-over (V1.3)

Values flow forward through results buttons and `window.last*` globals:

- `useBorrowAmount()` — switches to the Repayment tab, fills the loan amount
  from `window.lastBorrowAmount`, focuses the rate field.
- `useRepaymentAmount()` — switches to the Overpayment tab, fills loan, rate and
  term (years/months) from the `window.lastRepayment*` globals, focuses the
  overpayment field.

Both use a short `setTimeout` so the tab switch completes before fields are set.

---

## 6. Shared helpers & CTA

| Function | Role |
| --- | --- |
| `displayResults(results, type)` | Renders an object of `label → value` into `#results-display`; adds `.total` / `.savings` classes based on the label text |
| `addAipCta()` | Appends a CTA linking to `home_url('/aip-overview')` plus the guidance disclaimer (only once per result set) |
| `displayError(message)` | Shows an error message in the results panel |
| `clearResults()` | Restores the placeholder (icon + prompt); called on tab switch |
| `formatNumber(num)` | Formats numbers to 2dp with comma grouping |

The disclaimer reminds users the calculators are for guidance only and must not
form part of their financial decision making.

---

## 7. Extending it — adding a new calculator

1. Add a tab button: `<button class="calculator-tab" data-calculator="mytype">…</button>`.
2. Add a form container: `<div id="mytype-calculator" class="calculator-form">…</div>`.
3. Wire up the submit handler in the script (mirror the existing
   `if (myForm) { myForm.addEventListener('submit', …) }` blocks).
4. Write `calculateMyType()` that reads inputs, computes results, calls
   `displayResults({...}, 'mytype')`, and finishes with `addAipCta()`.
5. (Optional) add a `hashMap` alias for deep linking.
