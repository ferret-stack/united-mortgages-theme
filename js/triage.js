/**
 * United Mortgages — capture-on-commit triage flow.
 *
 * Drives the step machine on page-triage.php. Collects and transmits
 * NOTHING: no fetch, no beacon, no storage. Every answer lives in memory
 * for the length of the visit and is used only to decide which step to
 * show next. If this file ever grows a network call, that is a bug.
 *
 * Progressive enhancement: without JS every step and outcome renders in
 * document order and all links still work. The `is-js` class is what
 * collapses it down to one step at a time.
 */
(function () {
    'use strict';

    var root = document.querySelector('[data-um-triage]');
    if (!root) {
        return;
    }

    var steps = Array.prototype.slice.call(root.querySelectorAll('[data-um-step]'));
    var backBtn = root.querySelector('[data-um-back]');
    if (!steps.length) {
        return;
    }

    // Entry points the homepage buttons can jump straight to.
    var INTENT_STEPS = {
        buying: 'buy-use',
        remortgaging: 'rem-property'
    };

    var FIRST_STEP = 'intent';

    // Steps visited, oldest first. Drives the Back button.
    var trail = [];

    // How many history entries this document has actually pushed. Arriving
    // via ?intent= seeds the trail with a step the visitor answered on the
    // homepage, so trail.length can be > 1 while nothing has been pushed —
    // calling history.back() then would leave the site entirely.
    var pushed = 0;

    function stepEl(id) {
        for (var i = 0; i < steps.length; i++) {
            if (steps[i].getAttribute('data-um-step') === id) {
                return steps[i];
            }
        }
        return null;
    }

    /**
     * Show one step and hide the rest.
     *
     * @param {string}  id          Step id.
     * @param {boolean} moveFocus   Move focus to the step heading. False on
     *                              first paint so we don't yank the page.
     */
    function show(id, moveFocus) {
        var target = stepEl(id);
        if (!target) {
            return;
        }

        steps.forEach(function (el) {
            el.hidden = (el !== target);
        });

        if (backBtn) {
            backBtn.hidden = (trail.length < 2);
        }

        if (moveFocus) {
            var heading = target.querySelector('.um-triage__question');
            if (heading) {
                heading.focus();
            }
            // Keep the flow in view when steps differ in height.
            var top = root.getBoundingClientRect().top + window.pageYOffset - 100;
            window.scrollTo({ top: top > 0 ? top : 0, behavior: 'smooth' });
        }
    }

    function goTo(id, options) {
        var opts = options || {};

        if (!stepEl(id)) {
            return;
        }

        trail.push(id);
        show(id, opts.focus !== false);

        if (opts.push !== false && window.history && window.history.pushState) {
            window.history.pushState({ umStep: id }, '', '#' + id);
            pushed++;
        }
    }

    function goBack() {
        if (trail.length < 2) {
            return;
        }

        // Only hand off to the browser when there is an entry of ours to go
        // back to; otherwise history.back() would navigate off the page.
        if (pushed > 0 && window.history && window.history.pushState) {
            window.history.back(); // popstate does the actual step change
            return;
        }

        trail.pop();
        show(trail[trail.length - 1], true);
        if (window.history && window.history.replaceState) {
            window.history.replaceState({ umStep: trail[trail.length - 1] }, '', '#' + trail[trail.length - 1]);
        }
    }

    root.classList.add('is-js');

    // Option buttons.
    steps.forEach(function (step) {
        var options = step.querySelectorAll('[data-um-next]');
        Array.prototype.forEach.call(options, function (btn) {
            btn.addEventListener('click', function () {
                // Mark the chosen option so Back shows what was picked.
                Array.prototype.forEach.call(options, function (sibling) {
                    sibling.classList.toggle('is-chosen', sibling === btn);
                });
                goTo(btn.getAttribute('data-um-next'));
            });
        });
    });

    if (backBtn) {
        backBtn.addEventListener('click', goBack);
    }

    // Browser back/forward.
    window.addEventListener('popstate', function () {
        pushed = pushed > 0 ? pushed - 1 : 0;
        if (trail.length > 1) {
            trail.pop();
            show(trail[trail.length - 1], true);
        } else {
            show(trail[0] || FIRST_STEP, true);
        }
    });

    /**
     * Opening step.
     *
     * Priority: an explicit #hash (someone shared or refreshed a deep step),
     * then the ?intent= param from the homepage buttons, then the top.
     */
    var hash = (window.location.hash || '').replace('#', '');
    var intent = root.getAttribute('data-um-intent');
    var start = FIRST_STEP;

    if (hash && stepEl(hash)) {
        start = hash;
    } else if (intent && INTENT_STEPS[intent]) {
        start = INTENT_STEPS[intent];
        // The intent step was answered on the homepage — keep it in the trail
        // so Back from here returns to the question rather than dead-ending.
        trail.push(FIRST_STEP);
    }

    goTo(start, { focus: false, push: false });
    if (window.history && window.history.replaceState) {
        window.history.replaceState({ umStep: start }, '', '#' + start);
    }
})();
