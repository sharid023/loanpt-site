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
    <div class="navlinks" id="navdrop">
      <nav class="menu">
        <div class="mi has-sub">
          <button type="button" class="mi-top">Loans <span class="mi-car">&#9662;</span></button>
          <div class="mi-sub">
            <a href="<?php echo esc_url(home_url('/personal-loan/')); ?>">Personal Loan</a>
            <a href="<?php echo esc_url(home_url('/overdraft/')); ?>">Overdraft (OD)</a>
            <a href="<?php echo esc_url(home_url('/balance-transfer/')); ?>">Balance Transfer</a>
            <a href="<?php echo esc_url(home_url('/business-loan/')); ?>">Business Loan</a>
            <a href="<?php echo esc_url(home_url('/home-loan/')); ?>">Home Loan</a>
            <a href="<?php echo esc_url(home_url('/loan-against-property/')); ?>">Loan Against Property</a>
            <a href="<?php echo esc_url(home_url('/car-loan/')); ?>">Car Loan</a>
            <a href="<?php echo esc_url(home_url('/used-car-loan/')); ?>">Used Car Loan</a>
            <a href="<?php echo esc_url(home_url('/two-wheeler-loan/')); ?>">Two-Wheeler Loan</a>
            <a href="<?php echo esc_url(home_url('/gold-loan/')); ?>">Gold Loan</a>
            <a href="<?php echo esc_url(home_url('/education-loan/')); ?>">Education Loan</a>
            <a href="<?php echo esc_url(home_url('/credit-card/')); ?>">Credit Card</a>
            <a href="<?php echo esc_url(home_url('/instant-loan/')); ?>">Instant Loan</a>
          </div>
        </div>
        <div class="mi has-sub">
          <button type="button" class="mi-top">Tools <span class="mi-car">&#9662;</span></button>
          <div class="mi-sub">
            <a href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>">Check Eligibility</a>
            <a href="<?php echo esc_url(home_url('/cibil-score/')); ?>">Credit Score (CIBIL)</a>
            <a href="<?php echo esc_url(home_url('/#calc')); ?>">EMI Calculator</a>
            <a href="<?php echo esc_url(home_url('/#compare')); ?>">Compare Banks</a>
          </div>
        </div>
        <div class="mi has-sub">
          <button type="button" class="mi-top">Calculators <span class="mi-car">&#9662;</span></button>
          <div class="mi-sub">
            <a href="<?php echo esc_url(home_url('/personal-loan-emi-calculator/')); ?>">Personal Loan EMI</a>
            <a href="<?php echo esc_url(home_url('/home-loan-emi-calculator/')); ?>">Home Loan EMI</a>
            <a href="<?php echo esc_url(home_url('/business-loan-emi-calculator/')); ?>">Business Loan EMI</a>
            <a href="<?php echo esc_url(home_url('/loan-against-property-emi-calculator/')); ?>">Loan Against Property EMI</a>
            <a href="<?php echo esc_url(home_url('/car-loan-emi-calculator/')); ?>">Car Loan EMI</a>
            <a href="<?php echo esc_url(home_url('/gold-loan-emi-calculator/')); ?>">Gold Loan EMI</a>
            <a href="<?php echo esc_url(home_url('/calculators/')); ?>">All calculators &rarr;</a>
          </div>
        </div>
        <div class="mi"><a class="mi-top" href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></div>
        <div class="mi has-sub">
          <button type="button" class="mi-top">Company <span class="mi-car">&#9662;</span></button>
          <div class="mi-sub">
            <a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a>
            <a href="<?php echo esc_url(home_url('/services/')); ?>">Our Services</a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
          </div>
        </div>
      </nav>
      <a class="authlnk custlogin" id="custLoginLink" href="<?php echo esc_url(home_url('/customer/')); ?>">&#128100; Customer Login</a>
      <a class="authlnk" href="<?php echo esc_url(loanpt_opt('connector_url', LOANPT_CONNECTOR_URL)); ?>">&#128100; Connector Login</a>
      <a class="authlnk" href="<?php echo esc_url(loanpt_opt('team_url', LOANPT_TEAM_URL)); ?>">&#128274; Team Login</a>
    </div>
    <a class="btn btn-elig" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>">&#9989; Check Eligibility</a>
    <a class="btn btn-call" href="tel:+91<?php echo esc_attr(loanpt_opt('phone', LOANPT_PHONE)); ?>">&#128222; <?php echo esc_html(loanpt_opt('phone', LOANPT_PHONE)); ?></a>
    <button class="navtoggle" id="navtoggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="navdrop"><span></span><span></span><span></span></button>
  </div>
</header>
