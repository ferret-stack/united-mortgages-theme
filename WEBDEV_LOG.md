# United Mortgages — Webdev Log

Scoped future work and known deviations, logged so they can be picked up
without re-deriving context. Newest version block at the top.

> No webdev log existed in this repo when V4 was written. `REDESIGN_HANDOVER.md`
> is a handover brief for the sitewide restyle, not a log, so this file was
> created rather than appending future-work items to it.

---

## V4 — Homepage intent split + capture-on-commit triage flow

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

### 7. Triage answers that currently go nowhere

**Status:** Working as specified — flagged for a product decision.

Four questions in the §0.5 branch map do not change which CTAs appear and are
not persisted anywhere (this flow stores and transmits nothing by design):

- Buy-to-let: "Are you buying through a company?"
- Buy-to-let: "How many buy-to-let mortgages do you have?"
- Remortgage: "Do you live in this property, or let it out?"
- Remortgage branch: the live-in/let-out answer, which does not alter the
  endpoint either

They were built because the branch map specifies them, but each one is a step
a visitor must complete for no change in outcome. Either they should route to
different CTAs/copy, or they should be dropped to shorten the flow. Worth a
decision before the copy pass.

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
