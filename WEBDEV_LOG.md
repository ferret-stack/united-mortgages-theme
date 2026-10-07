# United Mortgages — Webdev Log

Scoped future work and known deviations, logged so they can be picked up
without re-deriving context. Newest version block at the top.

**Versioning:** Vx.y.z — x major, y minor, z patch. The first block (V4) is
V4.0.0. The theme header (`style.css` `Version:`) had already reached 4.1.3
before this scheme was adopted, so the log skips 4.1.x and goes to V4.2.0,
keeping the version number going up. From V4.2.0 the log and the theme
header move together.

> No webdev log existed in this repo when V4 was written. `REDESIGN_HANDOVER.md`
> is a handover brief for the sitewide restyle, not a log, so this file was
> created rather than appending future-work items to it.

---

## V4.4.0 — Gunsling: AIP to soft fact-find, awards form off HubSpot

Part of Gunsling (moving UM off HubSpot before 3 Nov 2026). Both forms now
go Flask to email; a person at UM keys the details into the CRM. The backend
(`united-aip-api`, private) ships first: `/api/submit-aip` emails each AIP,
and the new `/api/submit-awards` emails each nomination.

### Shipped

- **AIP trimmed to a soft fact-find.** Removed: all document uploads (the
  `DocumentUploads` component and the additional self-employed income
  question that only chose which documents to ask for), NI number, date of
  birth, current and previous street and county, and employer address.
  Everything else is unchanged. The review step shows town and postcode only.
- **AIP drafts** move to `united_mortgages_aip_draft_v2`. The old key, which
  can hold NI numbers, is deleted unread on load, so a returning visitor with
  an old draft starts again.
- **AIP errors** quote 0333 091 4776 (the old alert quoted 0208 446 4488) and
  no longer depend on the word "HubSpot". Server messages are shown for
  400/429, a generic message otherwise. Still `alert()`, as before.
- **AIP progress indicator now works.** It sat outside `#aip-app`, so Vue
  never compiled it and no step was ever highlighted. Moved inside the mount;
  no CSS change. On phones it now sits inside the margins instead of 5px
  off-screen.
- **Awards nomination form** replaces the HubSpot embed in `page-awards.php`:
  same fields, labels and options, plus **Nominee Email** (approved 7 Oct),
  required with the nominee's names when nominating someone else.
  `js/awards-form.js`, vanilla, inline success and error states. Award
  options and the consent line each live in one place at the top of the
  template. The heading, intro and key dates are unchanged.
- **Honeypot** field on both forms; the server discards any submission that
  fills it.
- **Caching.** Both AIP scripts and `awards-form.js` carry
  `?ver=<file modified time>`. `redesign.css` moves from a fixed `'1.0'` to
  its modified time, which means **a one-off cache refresh for every visitor**
  on this deploy. `style.css` still uses WordPress's default version.
- Deleted the unused `js/aip-form-app-v2.js` and `js/aip-form-components-v2.js`.
- Privacy policy: form-data passages updated for the email route, plus the
  "Secure Storage" bullet. Wording shown in full in the PR; it merges only
  once Wesley approves it.

### Still open

- **Lower the Flask upload limit 48 hours after this theme deploy.** The
  backend accepts up to 50 MB only so that cached copies of the old form,
  which cannot submit without files, still go through (files are discarded
  unread). Change `MAX_CONTENT_LENGTH` to 256 KB. Steps in the backend's
  `DEPLOY.md`.
- **Nominee notification is manual.** Each nomination email for someone else
  ends with an action line asking UM to tell the nominee. The server never
  mails the nominee.
- Vue loads twice on the AIP page (`united_enqueue_vue` in `functions.php`
  and the template's own tag), both the **unpinned dev build** `vue@3`. A new
  Vue minor release reaches the form untested, whatever our own `?ver=` says.
- AIP submit errors still use `alert()`; the awards form uses inline states.
- The page's award headings ("Scale Award", "Agency of the Year") don't match
  the form's options ("National Agency of the Year (25+ branches)", "Estate
  Agency of the Year"), which were kept verbatim from the old HubSpot form.
- HubSpot embeds remain on `page-other-mortgages.php` and
  `page-high-earners.php`, plus the referral links and
  `template-parts/hero-form.php`. Outside this release.
- Walk-through ran in a stubbed harness (real templates and CSS, local
  Flask, Chromium), not on WordPress. Real sends are checked at deploy.

---

## V4.3.1 — Inline Calendly booking: visual polish

Patch: presentation and copy only. No behaviour change to loading, URL
params or fallback.

### Shipped

- Card heading **"Pick a time with your adviser"** above the calendar. It
  replaces the event details that `hide_event_type_details=1` hides.
- Left-column copy in `template-parts/team-contact.php`: "Reach out below and
  that's who you'll speak to" becomes "Book a time and that's who you'll speak
  to". On desktop the calendar sits beside the copy, not below it.
- With JS on, a quiet "Loading available times…" line shows until the
  calendar mounts, instead of the fallback button flashing. If the widget
  fails to load, the button comes back. Without JS, the button shows as before.
- The copy column is vertically centred against the taller calendar card
  (`.team-contact-wrapper { align-items: center; }` in `redesign.css`).

### Resolved from V4.3.0

- Colour params: the account is on a **paid Calendly plan**, so
  `primary_color` / `text_color` / `background_color` apply live.

### Still open

- Calendly's cookie banner inside the embed (no site consent banner yet).
- Fixed 700px height; the iframe can scroll internally on small screens.
- Real calendar not rendered in the sandbox. **Check it visually on the live
  site.**

---

## V4.3.0 — Inline Calendly booking in the contact section

### Shipped

- **Inline booking calendar** — `template-parts/team-contact.php` now embeds
  Calendly's inline widget in the contact card instead of the V4.2.0 button +
  popup. `js/calendly-contact.js` mounts it when the section comes within
  ~600px of the viewport (IntersectionObserver; immediate mount if
  unsupported). Nothing from Calendly loads before that. URL params:
  `utm_source=team_contact`, `hide_event_type_details=1`,
  `hide_landing_page_details=1`, and existing theme colours
  (`primary_color=109dff` = `--hp-accent`, `text_color=16241f` = `--hp-ink`,
  `background_color=ffffff`).
- The calendar area reserves 700px to avoid layout shift. The plain booking
  link inside it is the no-JS fallback and stays if the widget fails to load.

### Removed

- The V4.2.0 "Book a call" button popup behaviour. No popup remains on the site.

### Known gaps

- **Calendly's cookie banner shows inside the embed** for UK/EU visitors. It
  was left on deliberately (no `hide_gdpr_banner`) because the theme has no
  consent mechanism. Hide it only once a site-wide consent banner exists and
  gates Calendly.
- Colour params only take effect on paid Calendly plans. If the account is on
  the free tier, the calendar uses Calendly's default blue.
- The fixed 700px height means Calendly's iframe can scroll internally on small
  screens, for example after a date is picked on mobile. Calendly's
  auto-resize option was not used.
- The section is now ~700px taller on all 17 templates that include it, and
  every visitor who scrolls near it loads Calendly's script and iframe
  (third-party content and cookies).
- The real calendar could not be rendered in the sandbox (Calendly is
  blocked). Verified with a stubbed `widget.js`: lazy mount, single init,
  URL params, and the fallback when the widget is blocked. **Check the live
  calendar visually after deploy.**

---

## V4.2.0 — Calendly contact button + AIP saved-progress notices

Part of Gunslinger (moving UM off HubSpot by 3 Nov).

### Shipped

- **Calendly contact button** — `template-parts/team-contact.php` no longer
  embeds the HubSpot form. It shows a `.hp-btn` "Book a call with an adviser"
  linking to `https://calendly.com/unitedmortgages/15min?utm_source=team_contact`,
  plus a "Prefer to talk now?" line with the header/footer phone and email.
  `js/calendly-contact.js` (sitewide, footer) injects Calendly's `widget.css` /
  `widget.js` on the **first click only** and opens the popup. Nothing from
  Calendly loads on page load. Without JS, or if the widget is blocked, the
  link goes straight to the Calendly page. This applies to every template that
  includes the part (17, including `page-calculators.php`, which was not edited).
- **AIP saved-progress notices** — inline, non-modal, in `page-aip-form.php`:
  "Your answers are saved on this device." after a successful localStorage
  write, and "Welcome back. We've restored your answers." with a **Start
  over** link when a draft is restored on load. Start over clears the draft
  and reloads, keeping `?situation=`. Neither notice shows if storage throws.
- **AIP draft expiry** — drafts older than **7 days** are discarded on load
  (new). Clear-on-successful-submit already existed and is unchanged.

What the draft holds: localStorage key `united_mortgages_aip_draft` =
`{timestamp, currentStep, data}`. `data` is the full `formData`
(`applicant_type`, `applicant_situation`, `privacy_accepted`, and every
applicant 1/2 field, including contact, address, income and credit details).
Uploaded files are **not** stored (`File` objects are nulled).

### Removed

- **Exit-intent popup** (`js/aip-exit-popup.js` and its `functions.php`
  enqueue). It fired on mouseleave toward the top (desktop) and on
  `visibilitychange` (mobile).
- **Email-resume capture** — the popup's email + consent form and its
  "pick up right from where you left off" prompt. It POSTed
  `{email, exit_intent_consent, form_step_reached}` to the **relative**
  `/api/exit-intent-submit`, i.e. the WordPress origin, not the Flask service
  at `unitedmortgages.eu.pythonanywhere.com`. That is the likely reason the
  email never arrived. `app.py` is not in this repo, so this is unconfirmed.

### Known gaps

- A restored draft does not bring back uploaded documents. The visitor has
  to re-upload them, and the banner doesn't say so.
- The draft is saved on field changes, not on step navigation, so a
  restore lands on the step of the last edit.
- A `?situation=` deep link pre-selects a radio, which writes a draft. A
  visitor who only landed via the triage flow will see "Welcome back" next time.
- Orphan `.exit-popup-*` rules remain in `style.css` (that file was limited
  to the `Version:` line in this pass).
- The AIP submit-error alert still quotes `0208 446 4488`. The header, footer
  and the new contact line use `0333 091 4776`. Needs confirming which is right.
- No cookie-consent mechanism exists in the theme. GA loads unconditionally,
  and the AIP draft (which includes PII) sits in localStorage for up to 7 days
  on the device.
- HubSpot is still live elsewhere: form embeds in `template-parts/hero-form.php`,
  `page-other-mortgages.php`, `page-high-earners.php` and `page-awards.php`;
  hsforms share links in `footer.php`, `page-chorleywood.php` and
  `page-northwood.php`; and the AIP submission path via Flask. No HubSpot
  tracking script (`hs-scripts`) is loaded by the theme itself. HubSpot
  removal is V5.0.0.
- Calendly could not be loaded in the verification sandbox. Only the URL and
  the lazy-load requests were checked, not the popup itself.

### Deferred

- Resume-by-email: removed because the email never fired; revisit only if AIP abandonment becomes measurable.

---

## V4.0.0 — Homepage intent split + capture-on-commit triage flow

Shipped in this pass: homepage intent buttons, `/get-started/` triage flow,
Calendly handoff, whitelisted `?situation=` deep-link into the existing
(otherwise unchanged) AIP form.

The items below were **deliberately not built**. Each is blocked on a
decision or a dependency outside this pass — not on effort or scope.

### 1. Live-rates comparison — "Compare live mortgage deals" / "Compare live mortgage rates"

**Status:** Not built. **Blocker:** mortgage sourcing vendor decision is unresolved.

Candidates under consideration: Twenty7Tec, Mortgage Brain, Iress, MBT,
Air Sourcing. No sourcing data feed exists, so there is nothing to render.

Two triage nodes are the intended homes for this CTA, and both carry an
inline `FUTURE BUILD` comment marking the insertion point:

- `page-triage.php` → `out-buy-live-research` (residential: "Compare live mortgage deals")
- `page-triage.php` → `out-btl-research` (buy-to-let: "Compare live mortgage rates")

This does **not** affect the Borrow calculator on those same nodes, which is
live and wired.

**Unblocks when:** a sourcing vendor is chosen and a feed/API is contracted.

### 2. Rate-expiry alert tracker — "Track your mortgage"

**Status:** Not built. **Blocker:** separate roadmap item, not yet built.

Tracked in Differentiation Strategy §6. It is its own product surface (stored
expiry dates, scheduled notifications, an identity for the person being
notified), not a CTA that can be dropped into the triage flow — note that
storing an expiry date against a person means capturing contact details,
which the current flow explicitly does not do.

Intended home: `page-triage.php` → `out-rem-later` (the "more than 6 months /
unsure" remortgage node), marked with an inline `FUTURE BUILD` comment.

**Unblocks when:** the tracker itself is scoped and built.

### 3. Remortgage calculator

**Status:** Not built. **Blocker:** no existing calculator is confirmed as the right fit.

Neither `#repayment` nor `#overpayment` has been confirmed as a substitute,
and a dedicated calculator is being scoped/built separately by Wesley. No
guess was made and no existing calculator was linked in its place — the
remortgage branch currently offers the adviser conversation only.

Intended home: `page-triage.php` → `out-rem-later`, marked with an inline
`FUTURE BUILD` comment.

**Unblocks when:** the dedicated calculator exists and has an endpoint/anchor
on `/calculators/`.

### 4. Adviser round-robin assignment (spec Phase 5)

**Status:** Not built. **Blocker:** deferred by decision, and it has no home in this repo.

Two separate reasons, both of which need to clear:

1. **Decision:** with the current adviser headcount a single generic team
   Calendly link (`https://calendly.com/unitedmortgages/15min`) is sufficient.
   Rotation is revisited when there are genuinely enough advisers to need it.
2. **Dependency:** the assignment logic has to run wherever HubSpot writes
   happen. That is the Flask service at
   `https://unitedmortgages.eu.pythonanywhere.com/api/submit-aip` — `app.py`
   is **not in this repository**. It cannot be built here regardless of the
   decision above.

Also unconfirmed and required before this can start: whether HubSpot's
**native Calendly integration** is connected on portal `146069825` (eu1).
That integration is the trigger point the assignment logic attaches to.
Nothing in this repo can confirm it — it needs a look at the portal's
connected apps.

When it is built, the logic is fixed by the spec and should not be
improvised: check the contact for an existing `assigned_adviser` property;
if set, use it and do **not** re-run rotation; only if unset, assign the next
adviser in rotation (Mike / Muki / DeAndre) and write the property once. The
existing-property check is what keeps the continuity claim true. Launch
default is all three advisers, no filtering by situation type, no manual
override.

**Unblocks when:** adviser headcount justifies rotation, the native Calendly
integration is confirmed on, and the Flask service is available to change.

### 5. Accent colour fails WCAG AA — known deviation

**Status:** Accepted for now, by decision ("use existing CSS").

The spec called for `--um-action` / `--um-brand` tokens. **Neither exists in
this theme.** The sitewide accent is `--hp-accent: #109dff`, which is the
exact value the spec flagged as failing: white text on it gives **2.88:1**,
against the 4.5:1 AA needs for normal-size text. `--hp-accent-text: #0a7fd6`
is better at **4.18:1** but still short, and the hover shade `#0d84d9` is
**3.95:1**. No colour currently in the theme passes AA for button text.

The instruction was to use existing CSS, so the triage flow and the hero
intent buttons reuse `--hp-accent` and inherit that debt. Everything that
*could* meet AA without a new colour does: body and heading copy use
`--hp-ink` / `--hp-body`, and secondary CTAs put `--hp-accent-text` on white.

This is pre-existing, not introduced here — `.hp-btn` on the homepage hero
already had it.

**To fix:** define one token, e.g. `--um-action: #0a78cc` (**4.64:1** on
white, passes AA, visually close to brand), and point `.hp-btn` and
`.um-triage__cta--primary` at it. One-line change once the value is approved.

### 6. `calculators.js` enqueued from a path that doesn't exist

**Status:** Not fixed — flagged only, out of scope for this pass.

`functions.php` → `um_enqueue_calculator_scripts()` enqueues
`get_template_directory_uri() . '/assets/js/calculators.js'`. There is no
`assets/js/` directory; the file lives at `js/calculators.js`. Every
calculators page load 404s that request.

Harmless today only because `page-calculators.php` carries its own inline
copy of the calculator JS, which is what actually runs. So there are two
copies of this logic, one dead and 404ing, one live and inline — whoever
edits `js/calculators.js` expecting it to take effect will lose time.

**To fix:** either correct the path to `/js/calculators.js` and delete the
inline block, or drop the enqueue. Pick one; don't leave both.

### 7. Four triage questions removed — resolved

**Status:** Closed. Cut on 2026-09-04 by decision.

The §0.5 branch map specified four questions that did not change which CTAs
appeared and were not persisted anywhere (this flow stores and transmits
nothing by design):

- Buy-to-let: "Are you buying through a company?"
- Buy-to-let: "How many buy-to-let mortgages do you have?"
- Remortgage: "Do you live in this property, or let it out?" (and the
  live-in/let-out answer, which did not alter the endpoint either)

Each was a step the visitor had to complete for no change in outcome, so all
three steps were removed. The branch map in the source spec is now ahead of
the build on this point — if these questions come back, they need to route
somewhere different or be captured, otherwise they are pure friction.

Effect on flow length: buying is 3 questions, remortgaging is 2.

### 8. AIP deep-link has no situation value for the "buying to live in it" branch

**Status:** Working as specified — flagged as a data-quality gap.

The buy-to-let offer-ready node deep-links the AIP form with
`?situation=Buy to Let`, which maps cleanly to an existing value.

The residential ("live in it") offer-ready node deep-links the form with **no
situation pre-set**. The flow never asks first-time-buyer vs. moving home, and
the AIP form has no "moving home" value at all — its options are
`First-time-buyer`, `Remortgage`, `Shared ownership/help to buy`,
`Buy to Let`, `Guarantor`, `Commercial`. Defaulting a home-mover to
`First-time-buyer` would push wrong data into HubSpot, so nothing is guessed
and the visitor picks on step 1 as they do today.

**To close:** either add a first-time-buyer/moving-home question to the
residential branch, or add a "Moving home" situation value to the AIP form.
Both are outside this pass.
