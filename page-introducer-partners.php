<?php
/**
 * Template Name: Introducer Partners (Do Not Link)
 *
 * Plain, minimal referral-partner list — NOT a client-facing page.
 *
 * Intentionally not added to primary nav, footer nav, or linked from any
 * client-facing page (per direction). It's reachable only by direct URL
 * (e.g. for David to send agents the link), so this deliberately skips
 * get_header()/get_footer() — no site nav, no client-facing chrome, no
 * trust-signal iconography, no "why this matters to you" framing.
 *
 * Page-scoped `noindex, nofollow` meta tag applied below per confirmation —
 * keeps this out of search results without touching sitewide robots.txt.
 *
 * @package UnitedMortgages
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Introducer Partners | <?php bloginfo( 'name' ); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?php wp_head(); ?>
    <style>
        .um-introducers {
            max-width: 560px;
            margin: 60px auto;
            padding: 0 24px;
            font-family: var(--hp-font-body, sans-serif);
            color: var(--hp-body, #3c4a44);
        }
        .um-introducers h1 {
            font-family: var(--hp-font-display, sans-serif);
            font-size: 20px;
            font-weight: 600;
            color: var(--hp-ink, #16241f);
            margin: 0 0 24px;
        }
        .um-introducers__list {
            list-style: none;
            margin: 0;
            padding: 0;
            border-top: 1px solid var(--hp-border, #e3ded3);
        }
        .um-introducers__list li {
            padding: 14px 0;
            border-bottom: 1px solid var(--hp-border, #e3ded3);
        }
        .um-introducers__name {
            font-weight: 600;
            color: var(--hp-ink, #16241f);
            text-decoration: none;
        }
        .um-introducers__name:hover {
            text-decoration: underline;
        }
        .um-introducers__role {
            color: var(--hp-muted, #6b7871);
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
    $introducer_agents = [
        [
            'name' => 'Mark Newton',
            'role' => 'eXp UK, Estate Agent',
            'url'  => 'https://marknewton.exp.uk.com/',
        ],
        [
            'name' => 'Paul Berg',
            'role' => 'eXp UK, Estate Agent',
            'url'  => 'https://paulberg.exp.uk.com/',
        ],
        [
            'name' => 'Benn Colling',
            'role' => 'eXp UK, Estate Agent',
            'url'  => 'https://benncolling.exp.uk.com/',
        ],
        [
            'name' => 'Michal Sikora',
            'role' => 'eXp UK, Estate Agent',
            'url'  => 'https://michalsikora.exp.uk.com/',
        ],
        [
            'name' => 'Grant Boonzaier',
            'role' => 'eXp UK, Estate Agent',
            'url'  => 'https://grantboonzaier.exp.uk.com/',
        ],
        [
            'name' => 'Richard Aves',
            'role' => 'eXp UK, Estate Agent',
            'url'  => 'https://richardaves.exp.uk.com/',
        ],
    ];
?>
<div class="um-introducers">
    <h1>Introducer Partners</h1>
    <ul class="um-introducers__list">
        <?php foreach ($introducer_agents as $agent) : ?>
        <li>
            <a class="um-introducers__name" href="<?php echo $agent['url']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $agent['name']; ?></a>
            &mdash; <span class="um-introducers__role"><?php echo $agent['role']; ?><!-- TODO(content): confirm area --></span>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php wp_footer(); ?>
</body>
</html>
