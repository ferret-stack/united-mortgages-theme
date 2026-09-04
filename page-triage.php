<?php
/**
 * Template Name: Get Started (Triage)
 * Description: Homepage intent split — capture-on-commit triage flow.
 *              Collects NO personal data. Every terminal node hands the
 *              visitor off to an existing endpoint (Calendly, a calculator,
 *              or the unchanged AIP form).
 *
 * Branch structure is fixed by the spec's §0.5 branch map. Do not add,
 * remove or reorder branches here without that document being updated first.
 *
 * @package UnitedMortgages
 */
/*V1.0 — capture-on-commit triage*/

/* ------------------------------------------------------------------
 * Endpoint config
 * ------------------------------------------------------------------ */

/**
 * Single generic team Calendly link.
 *
 * Per-adviser links and round-robin assignment are deliberately NOT built
 * here — see WEBDEV_LOG.md V4 §4. With the current adviser headcount a
 * general team link is the right call; revisit when rotation is genuinely
 * needed.
 */
$um_calendly_url = 'https://calendly.com/unitedmortgages/15min';

/** Borrow calculator. The calculators page maps this hash to its tab. */
$um_borrow_url = home_url( '/calculators/#borrow' );

/**
 * AIP form deep-links.
 *
 * The AIP form itself is unchanged. It now reads an optional `situation`
 * query param (whitelisted against its own existing radio values) so a
 * branch can pre-set step 1 — nothing else about that form was touched.
 *
 * Only the buy-to-let branch resolves to an unambiguous existing value.
 * The "live in it" branch does NOT: this flow never asks first-time-buyer
 * vs. moving home, and the AIP form has no "moving home" situation value,
 * so guessing one would push wrong data into HubSpot. That branch links to
 * the form with no pre-set and the visitor picks on step 1.
 */
$um_aip_url            = home_url( '/aip-form/' );
$um_aip_url_btl        = add_query_arg( 'situation', rawurlencode( 'Buy to Let' ), home_url( '/aip-form/' ) );

/**
 * "Get an AIP" is the secondary/fallback CTA on the offer-ready nodes.
 * Set to false to drop it pre-ship if it turns out to be unused.
 */
$um_triage_show_aip_fallback = true;

/**
 * TODO(Wesley): blog URLs — §0.4.
 *
 * These posts are not all published yet and no nearest-match substitute is
 * acceptable. The CTA elements below are fully wired; each stays hidden
 * (and renders an HTML comment in its place) until a real URL is filled in
 * here, so no dead link can ship by accident.
 */
$um_triage_blog_links = array(
	'buying_guides' => '', // TODO(Wesley): "simple mortgage guides" for residential buyers
	'btl_guides'    => '', // TODO(Wesley): "simple mortgage guides" for buy-to-let landlords
);

/**
 * Render a blog CTA, or an obvious TODO comment if the URL isn't in yet.
 */
if ( ! function_exists( 'um_triage_blog_cta' ) ) :
function um_triage_blog_cta( $key, $label ) {
	global $um_triage_blog_links;
	$url = isset( $um_triage_blog_links[ $key ] ) ? $um_triage_blog_links[ $key ] : '';

	if ( '' === $url ) {
		echo "\n<!-- TODO(Wesley): blog URL pending for '" . esc_html( $key ) . "' (§0.4). "
			. "CTA is wired below but hidden until \$um_triage_blog_links['" . esc_html( $key ) . "'] is set. -->\n";
		printf(
			'<a class="um-triage__cta um-triage__cta--secondary" href="#" data-um-todo="blog-url" hidden>%s</a>',
			esc_html( $label )
		);
		return;
	}

	printf(
		'<a class="um-triage__cta um-triage__cta--secondary" href="%s">%s</a>',
		esc_url( $url ),
		esc_html( $label )
	);
}
endif;

/**
 * Intent pre-set from the homepage buttons (?intent=buying|remortgaging).
 * Anything else is ignored and the visitor starts at the intent step.
 */
$um_triage_intent = isset( $_GET['intent'] ) ? sanitize_key( wp_unslash( $_GET['intent'] ) ) : '';
if ( ! in_array( $um_triage_intent, array( 'buying', 'remortgaging' ), true ) ) {
	$um_triage_intent = '';
}

get_header(); ?>

<main id="primary" class="site-main um-triage-page">

	<section class="um-triage">
		<div class="hp-container">

			<div class="um-triage__intro">
				<h1 class="um-triage__title">Let's find the <span class="um-triage__accent">right next step</span></h1>
				<p class="um-triage__lead">A few quick questions — no personal details, nothing submitted anywhere.</p>
			</div>

			<div class="um-triage__flow"
				data-um-triage
				data-um-intent="<?php echo esc_attr( $um_triage_intent ); ?>">

				<button type="button" class="um-triage__back" data-um-back hidden>
					<span aria-hidden="true">&larr;</span> Back
				</button>

				<!-- ==========================================================
				     STEP: intent
				     ========================================================== -->
				<section class="um-triage__step" data-um-step="intent" aria-labelledby="um-step-intent-h">
					<h2 class="um-triage__question" id="um-step-intent-h" tabindex="-1">What are you looking to do?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="buy-use">I'm buying a home</button>
						<button type="button" class="um-triage__option" data-um-next="rem-property">I'm remortgaging</button>
					</div>
				</section>

				<!-- ==========================================================
				     BUYING A HOME
				     ========================================================== -->
				<section class="um-triage__step" data-um-step="buy-use" aria-labelledby="um-step-buy-use-h">
					<h2 class="um-triage__question" id="um-step-buy-use-h" tabindex="-1">Will you live in the property?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="buy-live-stage">Yes, I'll live in it</button>
						<button type="button" class="um-triage__option" data-um-next="btl-company">No, I'll let it out</button>
					</div>
				</section>

				<section class="um-triage__step" data-um-step="buy-live-stage" aria-labelledby="um-step-buy-live-stage-h">
					<h2 class="um-triage__question" id="um-step-buy-live-stage-h" tabindex="-1">Where are you up to?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="out-buy-live-research">Still researching or viewing</button>
						<button type="button" class="um-triage__option" data-um-next="out-buy-live-offer">Ready to offer, or offer accepted</button>
					</div>
				</section>

				<section class="um-triage__step um-triage__step--outcome" data-um-step="out-buy-live-research" aria-labelledby="um-out-buy-live-research-h">
					<h2 class="um-triage__question" id="um-out-buy-live-research-h" tabindex="-1">Good place to start</h2>
					<p class="um-triage__outcome-lead">Get a realistic sense of your range, then talk it through when you're ready.</p>
					<div class="um-triage__ctas">
						<a class="um-triage__cta um-triage__cta--primary" href="<?php echo esc_url( $um_borrow_url ); ?>">See how much I could borrow</a>
						<a class="um-triage__cta um-triage__cta--secondary" href="<?php echo esc_url( $um_calendly_url ); ?>">Talk to an adviser</a>
						<?php um_triage_blog_cta( 'buying_guides', 'Read our simple mortgage guides' ); ?>
					</div>
					<?php
					/*
					 * FUTURE BUILD, NOT THIS PHASE: "Compare live mortgage deals."
					 * Blocked on the mortgage sourcing vendor decision (Twenty7Tec /
					 * Mortgage Brain / Iress / MBT / Air Sourcing — unresolved).
					 * See WEBDEV_LOG.md V4 §1. Does NOT apply to the Borrow
					 * calculator above, which is live.
					 */
					?>
				</section>

				<section class="um-triage__step um-triage__step--outcome" data-um-step="out-buy-live-offer" aria-labelledby="um-out-buy-live-offer-h">
					<h2 class="um-triage__question" id="um-out-buy-live-offer-h" tabindex="-1">Let's get moving</h2>
					<p class="um-triage__outcome-lead">At this stage a conversation moves things faster than a calculator.</p>
					<div class="um-triage__ctas">
						<a class="um-triage__cta um-triage__cta--primary" href="<?php echo esc_url( $um_calendly_url ); ?>">Talk to an adviser</a>
						<?php if ( $um_triage_show_aip_fallback ) : ?>
							<a class="um-triage__cta um-triage__cta--secondary" href="<?php echo esc_url( $um_aip_url ); ?>">Get an Agreement in Principle</a>
						<?php endif; ?>
					</div>
				</section>

				<!-- ==========================================================
				     BUY TO LET
				     ========================================================== -->
				<section class="um-triage__step" data-um-step="btl-company" aria-labelledby="um-step-btl-company-h">
					<h2 class="um-triage__question" id="um-step-btl-company-h" tabindex="-1">Are you buying through a company?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="btl-count">Yes</button>
						<button type="button" class="um-triage__option" data-um-next="btl-count">No</button>
						<button type="button" class="um-triage__option" data-um-next="btl-count">Not sure yet</button>
					</div>
				</section>

				<section class="um-triage__step" data-um-step="btl-count" aria-labelledby="um-step-btl-count-h">
					<h2 class="um-triage__question" id="um-step-btl-count-h" tabindex="-1">How many buy-to-let mortgages do you have?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="btl-stage">This would be my first</button>
						<button type="button" class="um-triage__option" data-um-next="btl-stage">1 to 3</button>
						<button type="button" class="um-triage__option" data-um-next="btl-stage">4 or more</button>
					</div>
				</section>

				<section class="um-triage__step" data-um-step="btl-stage" aria-labelledby="um-step-btl-stage-h">
					<h2 class="um-triage__question" id="um-step-btl-stage-h" tabindex="-1">Where are you up to?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="out-btl-research">Still researching or viewing</button>
						<button type="button" class="um-triage__option" data-um-next="out-btl-offer">Ready to offer, or offer accepted</button>
					</div>
				</section>

				<section class="um-triage__step um-triage__step--outcome" data-um-step="out-btl-research" aria-labelledby="um-out-btl-research-h">
					<h2 class="um-triage__question" id="um-out-btl-research-h" tabindex="-1">Good place to start</h2>
					<p class="um-triage__outcome-lead">Work out the numbers first, then bring an adviser in.</p>
					<div class="um-triage__ctas">
						<a class="um-triage__cta um-triage__cta--primary" href="<?php echo esc_url( $um_borrow_url ); ?>">See what I could borrow</a>
						<a class="um-triage__cta um-triage__cta--secondary" href="<?php echo esc_url( $um_calendly_url ); ?>">Talk to an adviser</a>
						<?php um_triage_blog_cta( 'btl_guides', 'Read our simple mortgage guides' ); ?>
					</div>
					<?php
					/*
					 * FUTURE BUILD, NOT THIS PHASE: "Compare live mortgage rates."
					 * Same sourcing vendor blocker as the residential branch.
					 * See WEBDEV_LOG.md V4 §1.
					 */
					?>
				</section>

				<section class="um-triage__step um-triage__step--outcome" data-um-step="out-btl-offer" aria-labelledby="um-out-btl-offer-h">
					<h2 class="um-triage__question" id="um-out-btl-offer-h" tabindex="-1">Let's get moving</h2>
					<p class="um-triage__outcome-lead">Buy-to-let lending criteria vary a lot between lenders — worth a conversation.</p>
					<div class="um-triage__ctas">
						<a class="um-triage__cta um-triage__cta--primary" href="<?php echo esc_url( $um_calendly_url ); ?>">Talk to an adviser</a>
						<?php if ( $um_triage_show_aip_fallback ) : ?>
							<a class="um-triage__cta um-triage__cta--secondary" href="<?php echo esc_url( $um_aip_url_btl ); ?>">Get an Agreement in Principle</a>
						<?php endif; ?>
					</div>
				</section>

				<!-- ==========================================================
				     REMORTGAGING
				     ========================================================== -->
				<section class="um-triage__step" data-um-step="rem-property" aria-labelledby="um-step-rem-property-h">
					<h2 class="um-triage__question" id="um-step-rem-property-h" tabindex="-1">Do you live in this property, or let it out?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="rem-term">I live in it</button>
						<button type="button" class="um-triage__option" data-um-next="rem-term">I let it out</button>
					</div>
				</section>

				<section class="um-triage__step" data-um-step="rem-term" aria-labelledby="um-step-rem-term-h">
					<h2 class="um-triage__question" id="um-step-rem-term-h" tabindex="-1">When does your fixed term end?</h2>
					<div class="um-triage__options">
						<button type="button" class="um-triage__option" data-um-next="out-rem-urgent">It's already ended, or ends within 6 months</button>
						<button type="button" class="um-triage__option" data-um-next="out-rem-later">More than 6 months away</button>
						<button type="button" class="um-triage__option" data-um-next="out-rem-later">I'm not sure</button>
					</div>
				</section>

				<section class="um-triage__step um-triage__step--outcome" data-um-step="out-rem-urgent" aria-labelledby="um-out-rem-urgent-h">
					<h2 class="um-triage__question" id="um-out-rem-urgent-h" tabindex="-1">Worth speaking to someone now</h2>
					<p class="um-triage__outcome-lead">If your term has ended or is close to it, you may already be on a higher rate. An adviser can look at your actual deal.</p>
					<div class="um-triage__ctas">
						<a class="um-triage__cta um-triage__cta--primary" href="<?php echo esc_url( $um_calendly_url ); ?>">Talk to an adviser</a>
					</div>
					<?php
					/*
					 * No calculator is offered on this node by design — this branch
					 * is urgency-driven, per the §0.5 branch map.
					 */
					?>
				</section>

				<section class="um-triage__step um-triage__step--outcome" data-um-step="out-rem-later" aria-labelledby="um-out-rem-later-h">
					<h2 class="um-triage__question" id="um-out-rem-later-h" tabindex="-1">Plenty of time to plan</h2>
					<p class="um-triage__outcome-lead">Most lenders let you lock a new rate up to six months ahead. An adviser can tell you when to start.</p>
					<div class="um-triage__ctas">
						<a class="um-triage__cta um-triage__cta--primary" href="<?php echo esc_url( $um_calendly_url ); ?>">Speak to an expert</a>
					</div>
					<?php
					/*
					 * FUTURE BUILD, NOT THIS PHASE: "Track your mortgage" —
					 * rate-expiry alert tool. Separate roadmap item
					 * (Differentiation Strategy §6). See WEBDEV_LOG.md V4 §2.
					 *
					 * FUTURE BUILD, NOT THIS PHASE: remortgage calculator. No
					 * existing UM calculator (#repayment / #overpayment) is
					 * confirmed as the right fit — a dedicated tool is being
					 * scoped separately. Deliberately NOT linked to a guessed
					 * substitute. See WEBDEV_LOG.md V4 §3.
					 */
					?>
				</section>

			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
