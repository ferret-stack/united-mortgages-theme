<?php
/**
 * Risk warnings for blog posts (L6 Group 2).
 *
 * Wording is Flexi Onboarding Pack p9, verbatim. Do not paraphrase, merge or edit.
 *
 * Included twice by single.php (above the calendar section and under the sidebar
 * CTA), so this file must not declare functions or constants.
 */

// Warning text, keyed by type. Flexi p9 wording, exact.
$um_risk_warning_text = array(
    'regulated'  => 'Your home may be repossessed if you do not keep up repayments on your mortgage.',
    'remortgage' => 'Think carefully before securing other debts against your home. Your home may be repossessed if you do not keep up repayments on your mortgage.',
    'buy_to_let' => 'The Financial Conduct Authority does not regulate most buy-to-let mortgages.',
    'protection' => 'Cover is subject to underwriting and to terms and conditions. Please refer to the policy documents for full details. As with all insurance policies, conditions and exclusions will apply.',
);

// Lookup: tag or category slug => warning key.
// PLACEHOLDER slugs, to be replaced by the relaunch tagging architecture.
$um_risk_warning_lookup = array(
    'remortgage' => 'remortgage',
    'buy-to-let' => 'buy_to_let',
    'protection' => 'protection',
);

// Slugs of this post's tags and categories.
$um_risk_post_slugs = wp_get_post_terms( get_the_ID(), array( 'post_tag', 'category' ), array( 'fields' => 'slugs' ) );
if ( is_wp_error( $um_risk_post_slugs ) ) {
    $um_risk_post_slugs = array();
}

$um_risk_matched = array();
foreach ( $um_risk_post_slugs as $um_risk_slug ) {
    if ( isset( $um_risk_warning_lookup[ $um_risk_slug ] ) ) {
        $um_risk_matched[ $um_risk_warning_lookup[ $um_risk_slug ] ] = true;
    }
}

// Rules: Remortgages line replaces the default Regulated line (it already
// contains the repossession sentence). Buy-to-let and Protection are added
// in addition. Keys make each line appear at most once.
$um_risk_show = array();
$um_risk_show[] = isset( $um_risk_matched['remortgage'] ) ? 'remortgage' : 'regulated';
if ( isset( $um_risk_matched['buy_to_let'] ) ) {
    $um_risk_show[] = 'buy_to_let';
}
if ( isset( $um_risk_matched['protection'] ) ) {
    $um_risk_show[] = 'protection';
}

// Display variant. 'cta' = plain text inside the sidebar CTA (no box).
$um_risk_variant_class = ( isset( $args['variant'] ) && 'cta' === $args['variant'] ) ? ' um-risk-warnings--cta' : '';
?>
<div class="um-risk-warnings<?php echo esc_attr( $um_risk_variant_class ); ?>" role="note">
    <?php foreach ( $um_risk_show as $um_risk_key ) : ?>
        <p class="um-risk-warnings__item"><?php echo esc_html( $um_risk_warning_text[ $um_risk_key ] ); ?></p>
    <?php endforeach; ?>
</div>
