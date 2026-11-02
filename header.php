<?php if (!defined('ABSPATH')) exit; ?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#143f29">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
  <div class="wrap nav">
    <?php if (has_custom_logo()): ?>
      <a class="logo logo-img" href="<?php echo esc_url(home_url('/')); ?>"><?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array('alt' => get_bloginfo('name'), 'class' => 'logo-pic')); ?></a>
    <?php else: ?>
      <a class="logo logo-img" href="<?php echo esc_url(home_url('/')); ?>"><img class="logo-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name') ?: 'LoanPt'); ?>"></a>
    <?php endif; ?>
    <span class="sp"></span>
    <?php if (has_nav_menu('primary')): ?>
      <nav class="menu"><?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'depth' => 1, 'fallback_cb' => false)); ?></nav>
    <?php else: ?>
      <nav class="menu">
        <a href="<?php echo esc_url(home_url('/#compare')); ?>">Compare</a>
        <a href="<?php echo esc_url(home_url('/#calc')); ?>">EMI Calculator</a>
        <a href="<?php echo esc_url(home_url('/personal-loan/')); ?>">Personal Loan</a>
        <a href="<?php echo esc_url(home_url('/#faq')); ?>">FAQ</a>
      </nav>
    <?php endif; ?>
    <a class="authlnk" href="<?php echo esc_url(loanpt_opt('connector_url', LOANPT_CONNECTOR_URL)); ?>">&#128100; Connector Login</a>
    <a class="authlnk" href="<?php echo esc_url(loanpt_opt('team_url', LOANPT_TEAM_URL)); ?>">&#128274; Team Login</a>
    <a class="btn btn-call" href="tel:+91<?php echo esc_attr(loanpt_opt('phone', LOANPT_PHONE)); ?>">&#128222; <?php echo esc_html(loanpt_opt('phone', LOANPT_PHONE)); ?></a>
  </div>
</header>
