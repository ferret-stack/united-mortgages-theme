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
    var progress = root.querySelector('[data-um-progress]');
    var progressTrack = root.querySelector('[data-um-progress-track]');
    var progressLabel = root.querySelector('[data-um-progress-label]');
    if (!steps.length) {
        return;
    }

    /**
     * Branch graph, read off the markup so the two never drift apart.
     * { stepId: [nextStepId, ...] } — outcome nodes map to an empty array.
     */
    var graph = {};
    steps.forEach(function (step) {
        var nexts = step.querySelectorAll('[data-um-next]');
        graph[step.getAttribute('data-um-step')] = Array.prototype.map.call(nexts, function (btn) {
            return btn.getAttribute('data-um-next');
        });
    });

    /**
     * Questions still to answer from `id` onwards, counting `id` itself.
     * Outcome nodes are 0. Where a branch forks to different lengths this
     * takes the longest, so the total never grows underneath the visitor.
     */
    var depthCache = {};
    function questionsFrom(id) {
        if (id in depthCache) {
            return depthCache[id];
        }
        var nexts = graph[id] || [];
        if (!nexts.length) {
            depthCache[id] = 0;
            return 0;
        }
        depthCache[id] = 0; // guards against a cycle if the map ever gains one
        var deepest = 0;
        nexts.forEach(function (next) {
            deepest = Math.max(deepest, questionsFrom(next));
        });
        depthCache[id] = deepest + 1;
        return depthCache[id];
    }

    function isOutcome(id) {
        return !(graph[id] || []).length;
    }

    /**
     * "Step 2 of 3" plus a matching dot track.
     *
     * Totals are per-branch: remortgaging is genuinely two questions and
     * buying is three, so a single hard-coded total would misreport one of
     * them. Hidden on outcome nodes — there's no step left to be on.
     */
    function renderProgress(id) {
        if (!progress || !progressTrack || !progressLabel) {
            return;
        }

        if (isOutcome(id)) {
            progress.hidden = true;
            return;
        }

        var answered = trail.filter(function (step) {
            return !isOutcome(step);
        }).length;
        var position = Math.max(1, answered);
        var total = Math.max(position, (position - 1) + questionsFrom(id));

        progress.hidden = false;
        progressLabel.textContent = 'Step ' + position + ' of ' + total;

        progressTrack.textContent = '';
        for (var i = 1; i <= total; i++) {
            var dot = document.createElement('li');
            dot.className = 'um-triage__progress-dot'
                + (i < position ? ' is-done' : '')
                + (i === position ? ' is-current' : '');
            progressTrack.appendChild(dot);
        }
    }

    // Entry points the homepage buttons can jump straight to.
    var INTENT_STEPS = {
        buying: 'buy-use',
        remortgaging: 'rem-term'
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

        renderProgress(id);

        var heading = target.querySelector('.um-triage__question');

        // Announce progress along with the question for screen reader users,
        // who don't get the dot track. Set on every render, not just focused
        // ones — the first step is painted without moving focus.
        if (heading) {
            if (progress && progressLabel && !progress.hidden) {
                heading.setAttribute('aria-describedby', 'um-triage-progress-label');
            } else {
                heading.removeAttribute('aria-describedby');
            }
        }

        if (moveFocus) {
            if (heading) {
                // preventScroll: focusing alone would otherwise yank the
                // page, which is the jump we're trying to avoid below.
                try {
                    heading.focus({ preventScroll: true });
                } catch (error) {
                    heading.focus();
                }
            }

            // Only scroll when the flow has actually been scrolled out of
            // view. Previously this ran on every choice, so the first click
            // from the top of the page jumped the window down for no reason.
            var rect = root.getBoundingClientRect();
            if (rect.top < 0) {
                window.scrollTo({
                    top: rect.top + window.pageYOffset - 100,
                    behavior: 'smooth'
                });
            }
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
