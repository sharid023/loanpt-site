<?php
/* Template Name: LoanPt Calculators Hub */
if (!defined('ABSPATH')) exit;
get_header();
$calc = loanpt_calc_defs();
?>

<section class="hero"><div class="wrap" style="grid-template-columns:1fr;max-width:820px;text-align:center">
  <div>
    <span class="eyebrow">Free tools</span>
    <h1>Free Loan <em>Calculators</em></h1>
    <p class="lead" style="margin-left:auto;margin-right:auto">Plan any loan in seconds — work out your EMI, then let LoanPt find you the lowest rate across every bank. Free, and no sign-up.</p>
  </div>
</div></section>

<section><div class="wrap">
  <div class="sec-head"><div class="kicker">EMI calculators</div><h2>Work out your monthly EMI</h2><p>Pick your loan to calculate the EMI, then get the best rate for it.</p></div>
  <div class="prods" style="grid-template-columns:repeat(3,1fr)">
    <?php foreach ($calc as $cs => $cd): ?>
      <a class="prod" style="text-decoration:none" href="<?php echo esc_url(home_url('/' . $cs . '/')); ?>">
        <div class="ic">&#129518;</div>
        <h3 style="margin:0;font-size:17px"><?php echo esc_html($cd['product']); ?> EMI Calculator</h3>
        <span class="go">Calculate EMI &rarr;</span>
      </a>
    <?php endforeach; ?>
  </div>
</div></section>

<section style="background:#fff;border-top:1px solid var(--line)"><div class="wrap">
  <div class="sec-head"><div class="kicker">Eligibility &amp; score</div><h2>Check what you can get</h2></div>
  <div class="prods" style="grid-template-columns:repeat(2,1fr)">
    <a class="prod" style="text-decoration:none" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>"><div class="ic">&#9989;</div><h3 style="margin:0;font-size:17px">Loan Eligibility Calculator</h3><span class="go">Check in 60 seconds &rarr;</span></a>
    <a class="prod" style="text-decoration:none" href="<?php echo esc_url(home_url('/cibil-score/')); ?>"><div class="ic">&#128202;</div><h3 style="margin:0;font-size:17px">Check Your Credit Score</h3><span class="go">Know your score &rarr;</span></a>
  </div>
</div></section>

<section><div class="wrap"><div class="ctaband">
  <h2>Ready to get started?</h2><p>Check your eligibility free — it takes less than a minute.</p><a class="btn" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>">Check eligibility &rarr;</a>
</div></div></section>

<?php get_footer(); ?>
