/**
 * Inline Calendly booking (template-parts/team-contact.php)
 *
 * Mounts Calendly's inline booking calendar into .um-calendly-inline once the
 * contact section scrolls near the viewport. Nothing from Calendly is
 * requested before that. The link inside the container is the no-JS
 * fallback, and it stays in place if the widget fails to load.
 *
 * Calendly's own cookie banner is deliberately left on (no hide_gdpr_banner):
 * the theme has no consent mechanism of its own.
 */
(function () {
    'use strict';

    var WIDGET_JS  = 'https://assets.calendly.com/assets/external/widget.js';
    var WIDGET_CSS = 'https://assets.calendly.com/assets/external/widget.css';
    var LOAD_MARGIN = '600px 0px'; // start loading about a screen before it's visible

    // Display params use existing theme tokens: --hp-accent, --hp-ink, white.
    // Colour params only take effect on paid Calendly plans.
    var URL_PARAMS = {
        utm_source: 'team_contact',
        hide_event_type_details: '1',
        hide_landing_page_details: '1',
        primary_color: '109dff',
        text_color: '16241f',
        background_color: 'ffffff'
    };

    var widgetPromise = null;

    function buildCalendlyUrl(baseUrl) {
        var url = new URL(baseUrl, window.location.href);
        Object.keys(URL_PARAMS).forEach(function (key) {
            url.searchParams.set(key, URL_PARAMS[key]);
        });
        return url.toString();
    }

    function loadWidget() {
        if (window.Calendly && typeof window.Calendly.initInlineWidget === 'function') {
            return Promise.resolve();
        }
        if (widgetPromise) return widgetPromise;

        widgetPromise = new Promise(function (resolve, reject) {
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = WIDGET_CSS;
            document.head.appendChild(link);

            var script = document.createElement('script');
            script.src = WIDGET_JS;
            script.async = true;
            script.onload = function () {
                if (window.Calendly && typeof window.Calendly.initInlineWidget === 'function') {
                    resolve();
                } else {
                    reject(new Error('Calendly widget unavailable'));
                }
            };
            script.onerror = function () {
                reject(new Error('Calendly widget failed to load'));
            };
            document.head.appendChild(script);
        });

        return widgetPromise;
    }

    function removeLoading(container) {
        var loading = container.querySelector('.um-calendly-loading');
        if (loading) loading.remove();
    }

    function mount(container) {
        if (container.getAttribute('data-calendly-mounted')) return;
        container.setAttribute('data-calendly-mounted', 'pending');

        var url = buildCalendlyUrl(container.getAttribute('data-calendly-url'));

        loadWidget().then(function () {
            var fallback = container.querySelector('.um-calendly-fallback');
            if (fallback) fallback.remove();
            removeLoading(container);
            window.Calendly.initInlineWidget({ url: url, parentElement: container });
            container.setAttribute('data-calendly-mounted', 'true');
        }).catch(function (error) {
            // Bring the fallback link back; the visitor can still book.
            removeLoading(container);
            container.classList.remove('is-js');
            container.setAttribute('data-calendly-mounted', 'failed');
            console.warn('[Calendly] inline widget not loaded:', error.message);
        });
    }

    function init() {
        var containers = document.querySelectorAll('.um-calendly-inline[data-calendly-url]');
        if (!containers.length) return;

        // JS is running: swap the fallback button for a quiet loading line
        // until the calendar mounts (or fails, which restores the button).
        containers.forEach(function (container) {
            container.classList.add('is-js');
        });

        if (!('IntersectionObserver' in window)) {
            containers.forEach(mount);
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    observer.unobserve(entry.target);
                    mount(entry.target);
                }
            });
        }, { rootMargin: LOAD_MARGIN });

        containers.forEach(function (container) {
            observer.observe(container);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    window.umBuildCalendlyUrl = buildCalendlyUrl;
})();
