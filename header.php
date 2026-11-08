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
            <a href="<?php echo esc_url(home_url('/personal-loan-eligibility-calculator/')); ?>">Loan Eligibility</a>
            <a href="<?php echo esc_url(home_url('/loan-prepayment-calculator/')); ?>">Prepayment Calculator</a>
            <a href="<?php echo esc_url(home_url('/balance-transfer-savings-calculator/')); ?>">Balance Transfer Savings</a>
            <a href="<?php echo esc_url(home_url('/sip-calculator/')); ?>">SIP Calculator</a>
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
    <div class="hdr-mobicons">
      <div class="hdr-support">
        <button type="button" class="hdr-ic" id="hdrSupportBtn" aria-label="Call or email support" aria-expanded="false" aria-controls="hdrSupportPop">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
        </button>
        <div class="hdr-support-pop" id="hdrSupportPop" hidden>
          <span class="hdr-sup-title">We're here to help &mdash; free</span>
          <a href="tel:+91<?php echo esc_attr(loanpt_opt('phone', LOANPT_PHONE)); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><strong><?php echo esc_html(loanpt_opt('phone', LOANPT_PHONE)); ?></strong><em>Call us &middot; Mon&ndash;Sat</em></span></a>
          <a href="mailto:<?php echo esc_attr(loanpt_opt('email', LOANPT_EMAIL)); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22,6 12,13 2,6"/></svg><span><strong><?php echo esc_html(loanpt_opt('email', LOANPT_EMAIL)); ?></strong><em>Email us anytime</em></span></a>
        </div>
      </div>
      <a class="hdr-ic" href="<?php echo esc_url(home_url('/customer/')); ?>" aria-label="Customer login">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </a>
    </div>
    <button class="navtoggle" id="navtoggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="navdrop"><span></span><span></span><span></span></button>
  </div>
</header>
