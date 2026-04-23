/**
 * FAQ Accordion
 * United Mortgages — product pages
 * No dependencies. Wrap answer content in .faq-answer-inner for smooth animation.
 */
(function () {
    'use strict';

    function initFaqAccordion() {
        var items = document.querySelectorAll('.faq-item');
        if (!items.length) return;

        // Wrap answer content in inner div for grid-template-rows animation
        items.forEach(function (item) {
            var answer = item.querySelector('.faq-answer');
            if (!answer || answer.querySelector('.faq-answer-inner')) return;
            var inner = document.createElement('div');
            inner.className = 'faq-answer-inner';
            while (answer.firstChild) {
                inner.appendChild(answer.firstChild);
            }
            answer.appendChild(inner);
        });

        // Bind click handlers
        items.forEach(function (item) {
            var btn = item.querySelector('.faq-question');
            if (!btn) return;

            btn.addEventListener('click', function () {
                var isOpen = item.classList.contains('is-open');

                // Close all
                items.forEach(function (other) {
                    other.classList.remove('is-open');
                    var otherBtn = other.querySelector('.faq-question');
                    if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                });

                // Open clicked (if it was closed)
                if (!isOpen) {
                    item.classList.add('is-open');
                    btn.setAttribute('aria-expanded', 'true');
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFaqAccordion);
    } else {
        initFaqAccordion();
    }
})();