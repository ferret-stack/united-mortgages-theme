/**
 * Awards nomination form (page-awards.php).
 *
 * Validates in the browser, then posts JSON to the Flask backend, which
 * emails the nomination to United Mortgages. The backend repeats every
 * check, so these rules must stay in step with /api/submit-awards in
 * app.py: 1 to 4 awards; nominee first name, last name and email required
 * for "Someone else"; 500 characters for the first two text boxes.
 * Inline success and error states only: no alert().
 */
(function () {
    'use strict';

    var form = document.querySelector('[data-um-awards]');
    if (!form) {
        return;
    }

    var MAX_AWARDS = 4;
    var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var PHONE = '0333 091 4776';
    var host = window.location.hostname;
    var isLocal = host === 'localhost' || host === '127.0.0.1' || host === 'united-mortgages.local';
    var API_URL = isLocal
        ? 'http://localhost:5000/api/submit-awards'
        : 'https://unitedmortgages.eu.pythonanywhere.com/api/submit-awards';

    var MESSAGES = {
        awardsNone: 'Choose at least one award.',
        awardsTooMany: 'You can choose up to four awards.',
        first_name: 'Enter your first name.',
        last_name: 'Enter your last name.',
        phone: 'Enter your phone number.',
        email: 'Enter your email.',
        emailInvalid: 'Enter a valid email address.',
        nominating: 'Tell us who you\'re nominating.',
        nominee_first_name: 'Enter the nominee\'s first name.',
        nominee_last_name: 'Enter the nominee\'s last name.',
        nominee_email: 'Enter the nominee\'s email address.',
        nomineeEmailInvalid: 'Enter a valid email address for the nominee.',
        tooLong: 'Keep this to 500 characters or fewer.',
        consent: 'Please tick the box to confirm.',
        failed: 'Sorry, your nomination didn\'t go through. Please try again in a few minutes, or call us on ' + PHONE + '.'
    };

    var errorBox = form.querySelector('[data-um-awards-error]');
    var submitButton = form.querySelector('[data-um-awards-submit]');
    var successBox = document.querySelector('[data-um-awards-success]');
    var awardBoxes = form.querySelectorAll('input[name="awards"]');
    var nominating = form.elements.nominating;
    var sending = false;

    function value(name) {
        var el = form.elements[name];
        return el ? String(el.value || '').trim() : '';
    }

    function checkedAwards() {
        var list = [];
        for (var i = 0; i < awardBoxes.length; i++) {
            if (awardBoxes[i].checked) {
                list.push(awardBoxes[i].value);
            }
        }
        return list;
    }

    function controlsFor(name) {
        return name === 'awards' ? awardBoxes : [form.elements[name]];
    }

    function showFieldError(name, message) {
        var slot = form.querySelector('[data-error-for="' + name + '"]');
        var field = form.querySelector('[data-field="' + name + '"]');
        if (!slot) {
            return false;
        }
        slot.textContent = message;
        slot.hidden = false;
        if (field) {
            field.classList.add('is-invalid');
        }
        var controls = controlsFor(name);
        for (var i = 0; i < controls.length; i++) {
            if (controls[i]) {
                controls[i].setAttribute('aria-invalid', 'true');
            }
        }
        return true;
    }

    function clearFieldError(name) {
        var slot = form.querySelector('[data-error-for="' + name + '"]');
        var field = form.querySelector('[data-field="' + name + '"]');
        if (slot) {
            slot.textContent = '';
            slot.hidden = true;
        }
        if (field) {
            field.classList.remove('is-invalid');
        }
        var controls = controlsFor(name);
        for (var i = 0; i < controls.length; i++) {
            if (controls[i]) {
                controls[i].removeAttribute('aria-invalid');
            }
        }
    }

    function showFormError(message) {
        errorBox.textContent = message;
        errorBox.hidden = false;
    }

    function clearFormError() {
        errorBox.textContent = '';
        errorBox.hidden = true;
    }

    function focusFirstError() {
        var field = form.querySelector('.is-invalid');
        if (!field) {
            return;
        }
        var control = field.querySelector('input, select, textarea');
        if (control) {
            control.focus();
        }
    }

    // Returns {field: message} for every problem, in form order.
    function validate() {
        var errors = {};
        var awards = checkedAwards();
        if (awards.length === 0) {
            errors.awards = MESSAGES.awardsNone;
        } else if (awards.length > MAX_AWARDS) {
            errors.awards = MESSAGES.awardsTooMany;
        }
        ['first_name', 'last_name', 'phone', 'email'].forEach(function (name) {
            if (!value(name)) {
                errors[name] = MESSAGES[name];
            }
        });
        if (value('email') && !EMAIL_RE.test(value('email'))) {
            errors.email = MESSAGES.emailInvalid;
        }
        if (value('nominating') !== 'Myself' && value('nominating') !== 'Someone else') {
            errors.nominating = MESSAGES.nominating;
        }
        if (value('nominating') === 'Someone else') {
            ['nominee_first_name', 'nominee_last_name', 'nominee_email'].forEach(function (name) {
                if (!value(name)) {
                    errors[name] = MESSAGES[name];
                }
            });
        }
        if (value('nominee_email') && !EMAIL_RE.test(value('nominee_email'))) {
            errors.nominee_email = MESSAGES.nomineeEmailInvalid;
        }
        ['why_deserve', 'example_story'].forEach(function (name) {
            if (value(name).length > 500) {
                errors[name] = MESSAGES.tooLong;
            }
        });
        if (!form.elements.consent.checked) {
            errors.consent = MESSAGES.consent;
        }
        return errors;
    }

    function clearAllErrors() {
        var slots = form.querySelectorAll('[data-error-for]');
        for (var i = 0; i < slots.length; i++) {
            clearFieldError(slots[i].getAttribute('data-error-for'));
        }
        clearFormError();
    }

    function payload() {
        var data = {
            awards: checkedAwards(),
            consent: form.elements.consent.checked,
            um_hp: form.elements.um_hp ? form.elements.um_hp.value : ''
        };
        ['first_name', 'last_name', 'phone', 'email', 'company', 'job_title', 'nominating',
            'nominee_first_name', 'nominee_last_name', 'nominee_email', 'nominee_job_title',
            'nominee_company', 'why_deserve', 'example_story', 'anything_else'
        ].forEach(function (name) {
            data[name] = value(name);
        });
        return data;
    }

    function setSending(on) {
        sending = on;
        submitButton.disabled = on;
        submitButton.textContent = on ? 'Sending…' : 'Submit nomination';
    }

    function showSuccess() {
        form.hidden = true;
        successBox.hidden = false;
        successBox.focus();
    }

    // Block a fifth award as it is ticked.
    for (var i = 0; i < awardBoxes.length; i++) {
        awardBoxes[i].addEventListener('change', function (event) {
            var count = checkedAwards().length;
            if (event.target.checked && count > MAX_AWARDS) {
                event.target.checked = false;
                showFieldError('awards', MESSAGES.awardsTooMany);
            } else if (count > 0 && count <= MAX_AWARDS) {
                clearFieldError('awards');
            }
        });
    }

    // Show the nominee fields' required marks when they apply.
    function syncNomineeRequired() {
        var required = value('nominating') === 'Someone else';
        var marks = form.querySelectorAll('[data-required-for-someone-else]');
        for (var j = 0; j < marks.length; j++) {
            marks[j].hidden = !required;
        }
        ['nominee_first_name', 'nominee_last_name', 'nominee_email'].forEach(function (name) {
            form.elements[name].required = required;
            if (!required) {
                clearFieldError(name);
            }
        });
    }
    nominating.addEventListener('change', syncNomineeRequired);
    syncNomineeRequired();

    // Live character counts for the two 500-character boxes.
    ['why_deserve', 'example_story'].forEach(function (name) {
        var box = form.elements[name];
        var counter = form.querySelector('[data-count-for="' + name + '"]');
        var update = function () {
            counter.textContent = box.value.length + ' / 500';
        };
        box.addEventListener('input', update);
        update();
    });

    // Clear a field's error once the visitor changes it.
    form.addEventListener('input', function (event) {
        var name = event.target && event.target.name;
        if (name && name !== 'awards') {
            clearFieldError(name);
        }
    });
    form.addEventListener('change', function (event) {
        var name = event.target && event.target.name;
        if (name === 'consent' || name === 'nominating') {
            clearFieldError(name);
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (sending) {
            return;
        }
        clearAllErrors();

        var errors = validate();
        var names = Object.keys(errors);
        if (names.length) {
            names.forEach(function (name) {
                showFieldError(name, errors[name]);
            });
            focusFirstError();
            return;
        }

        setSending(true);
        fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload())
        }).then(function (response) {
            return response.json().catch(function () {
                return {};
            }).then(function (result) {
                if (response.ok && result.success) {
                    showSuccess();
                    return;
                }
                // 400s name the field when they can; 429 and 5xx carry a
                // message written for visitors.
                if (result.field && result.error && showFieldError(result.field, result.error)) {
                    focusFirstError();
                } else if ((response.status === 400 || response.status === 429) && result.error) {
                    showFormError(result.error);
                } else {
                    showFormError(MESSAGES.failed);
                }
            });
        }).catch(function () {
            showFormError(MESSAGES.failed);
        }).then(function () {
            setSending(false);
        });
    });
})();
