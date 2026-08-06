<?php
/**
 * Mortgage type grid — single source of truth for the "who we help" /
 * "our mortgages" card grid used on the homepage, Our Mortgages, and
 * Our Story pages.
 *
 * The homepage only has room for a taster (3 cards), so pass
 * array( 'limit' => 3 ) as the $args to get_template_part() to trim
 * the list; omit $args (or pass no limit) to render all of them.
 * Every page pulls from the same $mortgage_types array below, so
 * updating copy or links here updates every page that uses it.
 *
 * @package UnitedMortgages
 */

$mortgage_types = array(
    array(
        'icon'  => 'first-time-buyers.svg',
        'alt'   => 'First Time Buyers',
        'title' => 'FIRST TIME BUYERS',
        'text'  => 'Buying your first home is a lot of "what happens next." You\'ll have one adviser from application to completion who actually knows your file - not a call centre rotation.',
        'href'  => '/first-time-buyers',
        'label' => "I'M A FIRST TIME BUYER",
    ),
    array(
        'icon'  => 'moving-home.svg',
        'alt'   => 'Moving Home',
        'title' => 'MOVING HOME',
        'text'  => 'Whether you need more space or less, we source the right deal for your next move and manage the process end&#8209;to&#8209;end, alongside your existing mortgage where relevant.',
        'href'  => '/moving-home',
        'label' => "I'M MOVING HOME",
    ),
    array(
        'icon'  => 'remortgaging.svg',
        'alt'   => 'Remortgaging',
        'title' => 'REMORTGAGING',
        'text'  => 'If your fixed rate is ending or you want to release equity, we\'ll compare the market and tell you honestly whether moving is worth it &#8209; not just find you a deal.',
        'href'  => '/remortgaging',
        'label' => "I'M REMORTGAGING",
    ),
    array(
        'icon'  => 'self-employed.svg',
        'alt'   => 'Entrepreneurs, Founders, and Self-Employed',
        'title' => 'Entrepreneurs, Founders, and Self-Employed',
        'text'  => 'We started United as founders ourselves, so we know business income doesn\'t look like a payslip. Our advisers know which lenders read dividends, day rates, and equity comp properly &#8209; and how to present yours the way they want to see it.',
        'href'  => '/efse',
        'label' => "I'M SELF EMPLOYED",
    ),
    array(
        'icon'  => 'handshake.svg',
        'alt'   => 'Expats',
        'title' => 'EXPATS',
        'text'  => 'You\'ve put in the miles, and we\'ll go the distance. A mortgage in the UK shouldn\'t feel out of reach; we understand which lenders offer expat mortgages and their expat mortgage criteria.',
        'href'  => '/expats',
        'label' => "I'M AN EXPAT",
    ),
    array(
        'icon'  => 'other-mortgages.svg',
        'alt'   => 'BtL Investors',
        'title' => 'Buy-to-Let Investors',
        'text'  => 'Portfolio lending runs on rental yield and stress-test maths, not personal income. We work with specialist BTL lenders who assess it that way.',
        'href'  => '/buy-to-let',
        'label' => "I'M AN INVESTOR",
    ),
);

$um_grid_limit  = isset( $args['limit'] ) ? (int) $args['limit'] : count( $mortgage_types );
$mortgage_types = array_slice( $mortgage_types, 0, $um_grid_limit );
?>
<div class="mortgage-services-grid">
    <?php foreach ( $mortgage_types as $type ) : ?>
        <div class="mortgage-service-card">
            <div class="service-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/our-mortgages/<?php echo esc_attr( $type['icon'] ); ?>" alt="<?php echo esc_attr( $type['alt'] ); ?>">
            </div>
            <h3><?php echo esc_html( $type['title'] ); ?></h3>
            <p><?php echo wp_kses_post( $type['text'] ); ?></p>
            <a href="<?php echo esc_url( home_url( $type['href'] ) ); ?>" class="btn-service"><?php echo esc_html( $type['label'] ); ?></a>
        </div>
    <?php endforeach; ?>
</div>
