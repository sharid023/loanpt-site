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
      <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"><span class="mk">L</span>Loan<b>Pt</b></a>
    <?php endif; ?>
    <span class="sp"></span>
    <nav class="menu">
      <a href="#compare">Compare</a>
      <a href="#calc">EMI Calculator</a>
      <a href="#products">Products</a>
      <a href="#faq">FAQ</a>
    </nav>
    <a class="authlnk" href="<?php echo esc_url(loanpt_opt('connector_url', LOANPT_CONNECTOR_URL)); ?>">&#128100; Connector Login</a>
    <a class="authlnk" href="<?php echo esc_url(loanpt_opt('team_url', LOANPT_TEAM_URL)); ?>">&#128274; Team Login</a>
    <a class="btn btn-call" href="tel:+91<?php echo esc_attr(loanpt_opt('phone', LOANPT_PHONE)); ?>">&#128222; <?php echo esc_html(loanpt_opt('phone', LOANPT_PHONE)); ?></a>
  </div>
</header>
