/**
 * Calendly contact button (template-parts/team-contact.php)
 *
 * The button is a plain link to the Calendly URL, so it works without JS.
 * With JS, the first click lazy-loads Calendly's widget.css + widget.js and
 * opens the booking popup. Nothing from Calendly is requested on page load.
 */
(function () {
    'use strict';

    var WIDGET_JS  = 'https://assets.calendly.com/assets/external/widget.js';
    var WIDGET_CSS = 'https://assets.calendly.com/assets/external/widget.css';
    var UTM_SOURCE = 'team_contact';

    var widgetPromise = null;

    // Always sends utm_source=team_contact, whatever the markup carries.
    function buildCalendlyUrl(baseUrl) {
        var url = new URL(baseUrl, window.location.href);
        url.searchParams.set('utm_source', UTM_SOURCE);
        return url.toString();
    }

    function loadWidget() {
        if (window.Calendly && typeof window.Calendly.initPopupWidget === 'function') {
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
                if (window.Calendly && typeof window.Calendly.initPopupWidget === 'function') {
                    resolve();
                } else {
                    reject(new Error('Calendly widget unavailable'));
                }
            };
            script.onerror = function () {
                reject(new Error('Calendly widget failed to load'));
            };
            document.head.appendChild(script);
        }).catch(function (error) {
            widgetPromise = null; // allow a retry on the next click
            throw error;
        });

        return widgetPromise;
    }

    document.addEventListener('click', function (event) {
        var button = event.target.closest ? event.target.closest('.um-calendly-btn') : null;
        if (!button) return;

        // Let modified clicks (new tab/window) behave as a normal link.
        if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button > 0) return;

        event.preventDefault();

        var url = buildCalendlyUrl(button.getAttribute('data-calendly-url') || button.href);

        loadWidget().then(function () {
            window.Calendly.initPopupWidget({ url: url });
        }).catch(function () {
            // Widget blocked or offline: fall back to the booking page itself.
            window.location.href = url;
        });
    });

    window.umBuildCalendlyUrl = buildCalendlyUrl;
})();
