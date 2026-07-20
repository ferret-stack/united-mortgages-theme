# United Mortgages — Sitewide Redesign Handover

**Purpose of this document**: brief a new Claude Code session on extending the homepage
redesign (Option 2a — "warm & balanced, blue") to the rest of the site, and on replacing
the current 14k-line `style.css` with a new, lean stylesheet.

Read this whole document before touching anything. It captures decisions already made,
mistakes already made (so you don't repeat them), and the mechanics you need to know
about this specific WordPress theme.

## 1. Where things stand right now

- Branch: `claude/united-mortgages-homepage-2e3nxq` (not yet merged at time of writing —
  check `git log`/`git status` and confirm with the user before assuming this is current).
- The **homepage only** (`index.php`) has been redesigned, matching Option 2a from the
  client-approved design canvas. It's been visually verified (see §7) and the user has
  confirmed it's correct.
- `header.php` has one line changed to conditionally add a body class:
  `body_class( is_front_page() ? 'is-front-redesign' : '' )`. Every redesign CSS rule
  that touches shared markup (header nav, mortgage grid, calculator, team contact form,
  partners grid) is scoped under `.is-front-redesign` or a unique `.hp-` wrapper class
  so **every other page currently looks completely untouched**.
- `footer.php` was **not modified** — it's already a neutral dark footer that doesn't
  clash with the new palette, so it was left alone rather than reskinned.
- The new design system lives at the bottom of `style.css`, under the comment marker
  `HOMEPAGE REDESIGN — Option 2a (warm & balanced, blue)`. Search for that string —
  don't rely on line numbers, they'll drift.
- `design-reference/homepage-2a-source.html` in this repo is the exact approved mockup
  fragment the homepage was built from (colors, spacing, copy, verbatim). The original
  design zip the client uploaded lived in an ephemeral session scratch directory and is
  **not available to you** — this file, plus the live implementation, is the full
  surviving record of the approved design. Treat the live implementation as the source
  of truth for anything that isn't in this reference file (real functional components
  the mockup didn't cover — see §5).

## 2. The two decisions already made for you

The user was asked and gave explicit answers — don't re-litigate these:

1. **Phased migration, not a big-bang rewrite.** Migrate page by page, in separate
   sessions/PRs if needed. Keep the old `style.css` rules working for any page you
   haven't gotten to yet. Don't try to do all ~29 templates in one pass.
2. **Header goes sitewide first.** Before migrating individual page bodies, make the
   redesigned header the default everywhere (not homepage-only). This is a one-line
   change — see §4.

## 3. Design system reference

All current tokens (`style.css`, top of the file, inside `:root`):

```css
--hp-cream: #faf7f2;        /* page background */
--hp-cream-blue: #eef7ff;   /* "most mortgage advice" section bg */
--hp-cream-2: #f3efe6;      /* testimonials section bg */
--hp-pill-bg: #e7f3ff;      /* eyebrow pill / icon chip bg */
--hp-ink: #16241f;          /* headings, dark chip bg (also real footer's dark tone) */
--hp-body: #3c4a44;         /* body copy */
--hp-body-2: #2c352f;       /* slightly darker body copy (list items, quotes) */
--hp-muted: #6b7871;        /* secondary/meta text */
--hp-muted-2: #8b968f;      /* tertiary/fine-print text */
--hp-border: #e3ded3;       /* card borders, dividers */
--hp-accent: #109dff;       /* primary blue — same value as the site's existing
                                --dannyboy-blue, this is not a new brand color */
--hp-accent-text: #0a7fd6;  /* slightly deeper blue used for small text-on-tint (pill text) */
--hp-font-display: 'Space Grotesk', ...;   /* headings, numbers, labels */
--hp-font-body: 'Inter', ...;              /* body copy */
```

Component recipes (see the CSS block for full rules):

- **Buttons** (`.hp-btn`): solid `--hp-accent` fill, white text, `border-radius:100px`
  (full pill), `box-shadow: 0 8px 20px -8px rgba(16,157,255,.5)`, lifts on hover
  (`translateY(-2px)` + stronger shadow). Inverse variant (`.hp-btn--inverse`) for use on
  blue backgrounds: white fill, accent-colored text.
- **Eyebrow pill** (`.hp-pill`): small rounded chip, `background:var(--hp-pill-bg)`,
  `color:var(--hp-accent-text)`, `border-radius:100px`.
- **Cards** (mortgage cards, testimonial cards): white background, `1px solid
  var(--hp-border)`, `border-radius:16px`, `padding:26px`, lift + border→accent on hover.
- **Section container**: `.hp-container` — `max-width:1160px; margin:0 auto; padding:0
  48px`. This is the layout width used throughout; keep using it for consistency.
- **Icon chips** (mortgage card icons): small rounded-square badge,
  `background:var(--hp-pill-bg)`, icon tinted blue via
  `filter: invert(37%) sepia(93%) saturate(1352%) hue-rotate(180deg) brightness(93%) contrast(101%)`
  (the source SVGs are black line art; this filter recipe is how you tint arbitrary
  black artwork to `--hp-accent` — reuse it rather than re-deriving the values).
- **Dark chips for partner/third-party logos**: partner logos in `assets/partners/` are
  white/light artwork made for a dark background. Putting them on a light card makes
  them invisible — this was caught and fixed during the homepage build. Any page that
  reuses the partners grid must keep dark chips (`background:var(--hp-ink)`).

## 4. Step one: make the header sitewide

`header.php` currently has:

```php
<body <?php body_class( is_front_page() ? 'is-front-redesign' : '' ); ?>>
```

Change this to apply unconditionally:

```php
<body <?php body_class( 'is-front-redesign' ); ?>>
```

(Rename the class to something that isn't "front" if you want — `is-front-redesign` was
named for the homepage-only scoping era and the name stops making sense once it's
global. If you rename it, update every `.is-front-redesign` selector in `style.css`
accordingly — grep for it first.)

This alone makes the new nav (cream background, pill CTA, muted contact links) show up
on every page immediately. It will look correct against every page's content because
the header/footer were already neutral enough — but double check visually (§7) since
some inner pages use a transparent-over-hero-image header treatment that this override
needs to beat. Search `style.css` for `.hero-section` and the `.site-header` rules to
confirm nothing fights the new fixed-cream-header look on pages with a full-bleed hero.

## 5. Real functional components — do not break these

These are not mockup content, they're live product/compliance features. When you
migrate a page that includes one of these, **reskin, don't rewrite**:

- **`template-parts/calculator-borrow-embed.php`** — the interactive borrow calculator.
  Contains real affordability-calculation logic and FCA-compliance copy (the
  Typical/Enhanced disclaimer popup, rate-sensitivity note, pension note). There's even
  a `Review by: 2027-01-16` comment in the JS — this content has a compliance review
  cadence. Don't touch the calculation constants, the disclaimer text, or the popup
  logic. You can restyle it — the homepage does, via a `--dannyboy-blue: var(--hp-accent)`
  scoped custom-property override, which is the least invasive way to reskin it (see
  `.hp-calc-wrap` in `style.css`).
- **`template-parts/team-contact.php`** — embeds a real HubSpot form via a `<script>` +
  `data-form-id` div. You can't meaningfully restyle the form fields (they render inside
  HubSpot's own widget), only the outer container.
- **Partners loop** (`index.php`, the `scandir('assets/partners/')` block) — dynamically
  lists real partner logos with real outbound links. If you rebuild this on another page,
  keep the PHP loop logic identical; only change the wrapping markup/classes.
- **Footer legal text** (`footer.php`, `.footer-legal`) — the FCA/regulatory disclaimer
  paragraphs. Carry over verbatim, never shorten or paraphrase, on any page.
- **Homepage testimonials** — the "People, not a processing queue" names/quotes/star
  ratings on the homepage are **placeholder content from the approved mockup**, not real
  reviews. There's an inline PHP comment flagging this in `index.php`. Do not copy these
  placeholder testimonials onto other pages as if they were genuine — if another page
  needs a testimonials section, ask the user for real content or reuse the same
  clearly-flagged placeholder with the same caveat comment.

## 6. Building the new stylesheet

The user wants a genuinely new, lean CSS file — not just more rules appended to the
existing 14,000-line `style.css` (which has accumulated substantial duplication; at
least two near-complete copies of old `:root`/header rules exist in it from earlier
theme versions).

**Constraint you can't avoid**: WordPress requires the active theme to have a file
literally named `style.css` at the theme root with a metadata header comment
(`Theme Name:`, `Author:`, etc. — see the top of the current file) for the theme to be
recognized at all. You cannot delete `style.css` outright.

Recommended approach:

1. Create a new file, e.g. `assets/css/redesign.css`. This is "the new stylesheet" —
   organize it clearly (suggested structure below). Seed it with the Option 2a block
   from the bottom of the current `style.css` as your starting point (it's already
   organized by component/section and has been visually verified), then generalize it:
   rename the `hp-` prefix to something that reads sitewide rather than
   homepage-specific (e.g. `um-` for United Mortgages, or a BEM-ish scheme — pick one and
   be consistent), and expand it with whatever new components each migrated page needs.
2. In `functions.php`, enqueue it **after** `style.css` with a dependency, so it loads
   later in the cascade and can override old rules without needing `!important`:
   ```php
   function mytheme_enqueue_scripts() {
       wp_enqueue_style( 'main-style', get_stylesheet_uri() );
       wp_enqueue_style( 'um-redesign', get_template_directory_uri() . '/assets/css/redesign.css', [ 'main-style' ], '1.0' );
   }
   ```
3. As you migrate each page, **delete that page's now-dead rules from `style.css`**
   rather than leaving them to rot. `style.css`'s job by the end of this project should
   be: the mandatory theme header comment, the Google Fonts `@import`s, and nothing else
   page-specific. Everything real lives in `redesign.css`.
4. Suggested internal structure for `redesign.css` (roughly what the current Option 2a
   block already does, just promoted to the whole file):
   - `:root` tokens
   - base reset / typography defaults
   - layout helpers (`.container`-equivalent)
   - buttons, pills, form inputs
   - cards
   - header / nav
   - footer (if it ever needs real changes, currently it doesn't)
   - one section per page-level component, grouped and commented by which page(s) use it

Don't try to solve "delete all 14k lines in one commit" — that's exactly the big-bang
risk the user chose to avoid in §2. Shrink `style.css` incrementally as pages migrate.

## 7. How to verify changes (no real WordPress environment available)

There's no WP install/database in this sandbox. The way the homepage redesign was
verified:

1. Write a small PHP bootstrap that stubs the WordPress functions the templates call
   (`get_header`, `get_footer`, `get_template_part`, `home_url`, `get_template_directory_uri`,
   `body_class`, `is_front_page`, `wp_head`, `wp_footer`, `bloginfo`, etc.) and then
   `include`s the real template file, so you're rendering the actual production PHP, not
   a copy.
2. Serve it with PHP's built-in server: `php -S localhost:PORT -t <theme-dir> router.php`,
   where `router.php` routes `/` to your bootstrap and returns `false` for everything
   else so static assets (`/assets/...`, `/style.css`) are served directly from the
   theme directory.
3. Screenshot with Playwright/Chromium (pre-installed in this environment at
   `/opt/pw-browsers/chromium`; Node's `playwright` package is at
   `/opt/node22/lib/node_modules` — set `NODE_PATH` to find it).
4. **Known gotchas hit last time**, so you don't lose time rediscovering them:
   - `get_template_directory_uri()` must return a URI that actually resolves against
     your test server's docroot (e.g. `http://localhost:PORT`, not a fake
     `/wp-content/themes/...` path) or every asset will 404.
   - PHP's built-in dev server is single-threaded; a page with many concurrent
     image/asset requests can produce transient `500`s under Playwright's `networkidle`
     wait. Use `waitUntil: 'load'` + a short explicit `waitForTimeout`, and if you see
     failures, just retry the screenshot once before assuming it's a real bug — check
     with a second run before treating a failed asset load as a genuine issue.
   - Only external network requests (Google Fonts, HubSpot embed, Font Awesome CDN)
     will fail in this sandbox — that's expected and not a signal of a real problem.

Check both a desktop viewport and a narrow mobile viewport (this theme's breakpoints
are `1024px` and `768px` in most places) for every page you touch.

## 8. Mistakes made in the first pass — don't repeat them

- **Confirm the exact design option before building.** The source design file
  (`design-reference/homepage-2a-source.html` is the *only* surviving fragment — the
  original had four variants: 1a, 1b, 2a, 2b, all visually similar but with different
  copy, colors, and button shapes) was ambiguous about which variant was wanted. Get
  explicit confirmation of the option ID before writing code, and re-confirm it's still
  correct partway through if anything about the request seems inconsistent with what
  you're building.
- **Carry over approved copy verbatim.** The first pass paraphrased/rewrote headline and
  section copy instead of copying it exactly from the mockup. This was called out and
  had to be redone. Treat mockup copy as approved copy — don't improve on it.
- **Don't silently drop content to make room for real functionality.** When a real
  interactive component (the calculator) needed to replace a mockup's static
  illustrative content, the first instinct was to just swap it in. The correct approach
  (and what the current homepage does) is to add the real component *alongside* the
  approved copy rather than removing approved copy — e.g. the homepage keeps the
  mockup's exact worked-example card ("What you could borrow — honestly", £58,000 /
  £32,000 / £243,600) and adds the live calculator underneath as "Or run your own
  numbers", rather than deleting the mockup content to make space.

## 9. Suggested migration order

Not mandated, just a reasonable default — check with the user if you want to confirm
priority. Highest-traffic / most conversion-relevant pages first, long-form legal
content last (lowest visual-design payoff, highest risk of accidentally altering
regulated text):

1. `page-our-mortgages.php`, `page-first-time-buyers.php`, `page-moving-home.php`,
   `page-remortgaging.php` — direct extensions of the homepage's "Our Mortgages" cards.
2. `page-calculators.php`, `page-aip-overview.php`, `page-aip-form.php` — core
   conversion funnel.
3. `page-our-story.php`, `page-membership.php`, `page-high-earners.php`,
   `page-expats.php`, `page-btl.php`, `page-efse.php`, `page-nhs-mortgage.php`,
   `page-construction.php`, `page-other-mortgages.php` — secondary content pages.
4. `page-chorleywood.php`, `page-rickmansworth.php`, `page-northwood.php` — local/branch
   landing pages.
5. `single.php`, `archive.php` — blog. Different layout concerns (long-form reading),
   treat as its own mini design pass rather than forcing homepage components onto it.
6. `page-fee-structure.php`, `page-privacy-policy.php`, `page-complaints-policy.php`,
   `page-tcf.php` — legal/policy pages last. Restyle typography/layout only; get sign-off
   before touching any wording, these are regulated documents.

## 10. Questions worth asking the user before you start

- Confirm this document and branch are still current (nothing may have merged/changed
  since it was written).
- Confirm the renamed CSS prefix (if you're moving away from `hp-`) and the new
  stylesheet's file path/name before generating a lot of code against it.
- Confirm whether inner pages should keep their current hero photos/imagery or whether
  new photography is expected (the homepage reused an existing theme asset,
  `hero-v2.png`; other pages may not have an equally suitable existing asset).
