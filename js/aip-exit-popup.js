/**
 * AIP Form Exit-Intent Popup
 * Captures email + explicit consent from users abandoning the AIP form.
 *
 * Triggers:
 *  - Desktop: mouseleave toward top of viewport (exit-intent)
 *  - Mobile:  visibilitychange (tab switch / home button / back)
 *
 * Deliberately NOT loaded globally — enqueue only on is_page('aip-form').
 * See functions.php for enqueue hook.
 */

(function () {
    'use strict';

    // ─── Config ──────────────────────────────────────────────────────────────
    const SESSION_KEY   = 'um_exit_popup_shown';   // sessionStorage key — once per session
    const MIN_STEP      = 2;                        // Don't trigger on step 1 (user hasn't invested yet)
    const MOUSE_Y_THRESHOLD = 50;                  // px from top to consider an exit intent

    // ─── State ───────────────────────────────────────────────────────────────
    let popupShown   = false;
    let mouseInPage  = false;
    let isMobile     = /Mobi|Android|iPhone|iPad/i.test(navigator.userAgent);

    // ─── Helpers ─────────────────────────────────────────────────────────────

    /**
     * Read the current step from the Vue app's state.
     * Falls back to 0 if Vue hasn't mounted yet.
     */
    function getCurrentStep() {
        const app = document.getElementById('aip-app')?.__vue_app__;
        if (!app) return 0;
        // Vue 3: walk the vnode tree to find the root component instance
        const instance = app._instance;
        return instance?.data?.currentStep ?? instance?.proxy?.currentStep ?? 0;
    }

    /**
     * Try to pre-fill the email field from Vue state (step 1 already collects it).
     */
    function getEmailFromForm() {
        const app = document.getElementById('aip-app')?.__vue_app__;
        if (!app) return '';
        const instance = app._instance;
        const proxy = instance?.proxy;
        return proxy?.formData?.applicant1?.email ?? '';
    }

    // ─── Popup HTML ──────────────────────────────────────────────────────────

    function injectPopupHTML() {
        if (document.getElementById('aip-exit-popup')) return; // already injected

        const html = `
        <div id="aip-exit-popup" class="popup-overlay" role="dialog" aria-modal="true" aria-labelledby="exit-popup-title">
            <div class="popup-content exit-popup-content">

                <div class="popup-header">
                    <h2 id="exit-popup-title">Don't lose your progress</h2>
                    <button class="popup-close" id="exit-popup-close" aria-label="Close">&times;</button>
                </div>

                <div class="popup-body">
                    <p>Want us to send you a link so you can finish your application when you're ready?<br><br><em>You can pick up right from where you left off</em></p>

                    <div id="exit-popup-form">
                        <div class="exit-popup-field">
                            <label for="exit-popup-email">Email address</label>
                            <input
                                type="email"
                                id="exit-popup-email"
                                name="exit_email"
                                placeholder="you@example.com"
                                autocomplete="email"
                            />
                            <span class="exit-popup-field-error" id="exit-popup-email-error"></span>
                        </div>

                        <div class="exit-popup-consent">
                            <label class="exit-popup-checkbox-label">
                                <input type="checkbox" id="exit-popup-consent" name="exit_consent" />
                                <span>Yes: Email me a reminder and relevant mortgage updates from United Mortgages</span>
                            </label>
                        </div>

                        <p class="exit-popup-privacy-note">
                            By opting in, you consent to United Mortgages contacting you to help complete
                            your mortgage application and sending you relevant mortgage information.
                            You can unsubscribe at any time.
                            <a href="/privacy-policy" target="_blank" rel="noopener">Privacy Policy</a>.
                        </p>

                        <div id="exit-popup-success" class="exit-popup-success" style="display:none;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11" stroke="#22c55e" stroke-width="2"/>
                                <path d="M7 12.5l3.5 3.5 6.5-7" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p>Got it - we'll be in touch.</p>
                        </div>
                    </div>
                </div>

                <div class="popup-footer exit-popup-footer">
                    <button class="popup-button" id="exit-popup-submit">Send Me the Link</button>
                    <button class="exit-popup-dismiss" id="exit-popup-dismiss">No thanks, I'll start over next time</button>
                </div>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', html);
    }

    // ─── Show / Hide ─────────────────────────────────────────────────────────

    function showPopup() {
        if (popupShown) return;
        if (sessionStorage.getItem(SESSION_KEY)) return;

        const step = getCurrentStep();
        if (step < MIN_STEP) return; // User hasn't engaged enough

        popupShown = true;
        sessionStorage.setItem(SESSION_KEY, '1');

        injectPopupHTML();
        wireEvents();

        // Pre-fill email if already entered
        const emailInput = document.getElementById('exit-popup-email');
        if (emailInput) {
            const existing = getEmailFromForm();
            if (existing) emailInput.value = existing;
        }

        const popup = document.getElementById('aip-exit-popup');
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';

        // Focus trap: move focus into popup
        setTimeout(() => {
            document.getElementById('exit-popup-email')?.focus();
        }, 100);
    }

    function closePopup() {
        const popup = document.getElementById('aip-exit-popup');
        if (!popup) return;
        popup.classList.remove('show');
        document.body.style.overflow = '';
    }

    // ─── Submission ──────────────────────────────────────────────────────────

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
    }

    function handleSubmit() {
        const emailInput   = document.getElementById('exit-popup-email');
        const consentInput = document.getElementById('exit-popup-consent');
        const emailError   = document.getElementById('exit-popup-email-error');
        const submitBtn    = document.getElementById('exit-popup-submit');

        emailError.textContent = '';

        const email   = emailInput.value.trim();
        const consent = consentInput.checked;

        if (!email) {
            emailError.textContent = 'Please enter your email address.';
            emailInput.focus();
            return;
        }
        if (!validateEmail(email)) {
            emailError.textContent = 'Please enter a valid email address.';
            emailInput.focus();
            return;
        }
        if (!consent) {
            emailError.textContent = 'Please tick the box if you\'d like us to follow up.';
            consentInput.focus();
            return;
        }

        // Disable button during submission
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending…';

        const payload = {
            email:              email,
            exit_intent_consent: true,
            form_step_reached:  getCurrentStep()
        };

        fetch('/api/exit-intent-submit', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify(payload)
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(function () {
            document.getElementById('exit-popup-form').style.display    = 'none';
            document.getElementById('exit-popup-success').style.display = 'flex';
            document.querySelector('.exit-popup-footer').style.display  = 'none';
            // Auto-close after 3s
            setTimeout(closePopup, 3000);
        })
        .catch(function (err) {
            console.error('[AIP Exit Popup] Submission error:', err);
            emailError.textContent = 'Something went wrong - please try again.';
            submitBtn.disabled    = false;
            submitBtn.textContent = 'Remind me later';
        });
    }

    // ─── Event Wiring ────────────────────────────────────────────────────────

    function wireEvents() {
        // Close button
        document.getElementById('exit-popup-close')
            ?.addEventListener('click', closePopup);

        // Dismiss link
        document.getElementById('exit-popup-dismiss')
            ?.addEventListener('click', closePopup);

        // Submit button
        document.getElementById('exit-popup-submit')
            ?.addEventListener('click', handleSubmit);

        // Enter key in email field
        document.getElementById('exit-popup-email')
            ?.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') handleSubmit();
            });

        // Click outside popup content
        document.getElementById('aip-exit-popup')
            ?.addEventListener('click', function (e) {
                if (e.target === this) closePopup();
            });

        // Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closePopup();
        });
    }

    // ─── Trigger Detection ───────────────────────────────────────────────────

    function initDesktopTrigger() {
        // Track when mouse enters the page (prevents false fires on load)
        document.documentElement.addEventListener('mouseenter', function () {
            mouseInPage = true;
        });

        // mouseleave on documentElement fires when cursor leaves the rendered page
        // into browser chrome (tab bar, address bar) — exactly what we want
        document.documentElement.addEventListener('mouseleave', function (e) {
            if (mouseInPage && e.clientY < MOUSE_Y_THRESHOLD) {
                showPopup();
            }
        });
    }

    function initMobileTrigger() {
        // Page visibility change: covers tab switch, home button, multitasking
        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState === 'hidden') {
                showPopup();
            }
        });
    }

    // ─── Init ────────────────────────────────────────────────────────────────

    document.addEventListener('DOMContentLoaded', function () {
        if (isMobile) {
            initMobileTrigger();
        } else {
            initDesktopTrigger();
        }
    });

})();
