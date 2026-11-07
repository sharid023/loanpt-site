<?php
/* Template Name: LoanPt Calculator */
if (!defined('ABSPATH')) exit;
get_header();

$slug = get_post_field('post_name', get_queried_object_id());
$calc = loanpt_calc_defs();
$d = isset($calc[$slug]) ? $calc[$slug] : null;

if (!$d) {
    while (have_posts()) { the_post(); ?>
      <section><div class="wrap" style="max-width:860px"><article style="background:#fff;border:1px solid var(--line);border-radius:16px;padding:30px"><h1 style="font-size:32px;margin-bottom:14px"><?php the_title(); ?></h1><div style="line-height:1.75"><?php the_content(); ?></div></article></div></section>
    <?php }
    get_footer();
    return;
}
$a = $d['amt']; $r = $d['rate']; $t = $d['ten'];
$products = array('Personal Loan', 'Home Loan', 'Business Loan', 'Loan Against Property', 'Car Loan', 'Used Car Loan', 'Two-Wheeler Loan', 'Gold Loan', 'Education Loan', 'Overdraft', 'Balance Transfer', 'Credit Card');
?>

<!-- HERO + LEAD FORM -->
<section class="hero"><div class="wrap">
  <div>
    <span class="eyebrow">Free calculator</span>
    <h1><?php echo wp_kses($d['h1'], array('em' => array())); ?></h1>
    <p class="lead"><?php echo esc_html($d['intro']); ?></p>
    <div class="trust">
      <span><span class="tick">&#10003;</span> Free &amp; instant</span>
      <span><span class="tick">&#10003;</span> No sign-up needed</span>
      <span><span class="tick">&#10003;</span> Then get the lowest rate</span>
    </div>
  </div>
  <div class="formcard" id="apply">
    <h2>Get this loan at the best rate</h2>
    <p class="fsub">60 seconds. Our team calls you with the right bank option.</p>
    <div class="err" id="err"></div>
    <form id="leadForm" novalidate>
      <div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required></div>
      <div class="field"><label for="mobile">Mobile number</label><input id="mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile" required></div>
      <div class="row2">
        <div class="field"><label for="product">I need</label>
          <select id="product" name="product">
            <?php foreach ($products as $p): ?>
              <option<?php echo ($p === $d['product']) ? ' selected' : ''; ?>><?php echo esc_html($p); ?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="field"><label for="amount">Amount (&#8377;)</label><input id="amount" name="amount" type="text" inputmode="numeric" placeholder="e.g. 5,00,000"></div>
      </div>
      <div class="field"><label for="city">City</label><input id="city" name="city" type="text" autocomplete="address-level2" placeholder="e.g. Noida"></div>
      <button type="submit" class="btn btn-pri" id="submitBtn">Get my best offer &rarr;</button>
      <p class="fnote">We never ask for OTP, card or account details.</p>
    </form>
    <div class="ok" id="ok"><div class="big">&#127881;</div><h3>Thank you!</h3><p>Our team will call you shortly with your best bank option.</p><a class="wa" id="waLink" href="#">&#128172; Chat on WhatsApp</a></div>
  </div>
</div></section>

<!-- CALCULATOR -->
<section id="calc"><div class="wrap">
  <div class="sec-head"><div class="kicker">Plan your loan</div><h2><?php echo esc_html($d['product']); ?> EMI Calculator</h2><p>Move the sliders to see your monthly EMI instantly, then get the best rate for it.</p></div>
  <div class="calc" data-calc="emi" data-cfg="{}">
    <div>
      <div class="ctrl"><div class="top"><span>Loan amount</span><input type="text" inputmode="numeric" class="val" data-val="amount" data-fmt="money" aria-label="Loan amount"></div>
        <input type="range" data-role="amount" data-fmt="money" min="<?php echo esc_attr($a[0]); ?>" max="<?php echo esc_attr($a[1]); ?>" step="<?php echo esc_attr($a[3]); ?>" value="<?php echo esc_attr($a[2]); ?>"></div>
      <div class="ctrl"><div class="top"><span>Interest rate (p.a.)</span><input type="text" inputmode="decimal" class="val" data-val="rate" data-fmt="pct" aria-label="Interest rate"></div>
        <input type="range" data-role="rate" data-fmt="pct" min="<?php echo esc_attr($r[0]); ?>" max="<?php echo esc_attr($r[1]); ?>" step="<?php echo esc_attr($r[3]); ?>" value="<?php echo esc_attr($r[2]); ?>"></div>
      <div class="ctrl"><div class="top"><span>Tenure</span><input type="text" inputmode="numeric" class="val" data-val="tenure" data-fmt="months" aria-label="Tenure"></div>
        <input type="range" data-role="tenure" data-fmt="months" min="<?php echo esc_attr($t[0]); ?>" max="<?php echo esc_attr($t[1]); ?>" step="<?php echo esc_attr($t[3]); ?>" value="<?php echo esc_attr($t[2]); ?>"></div>
    </div>
    <div class="result">
      <div class="lbl" data-main-label>Your monthly EMI</div>
      <div class="emi" data-main>&#8377;0</div>
      <div class="meta" data-rows></div>
      <a class="btn btn-pri" href="#apply">Get this at the best rate &rarr;</a>
    </div>
  </div>
  <p class="disc" style="margin-top:14px">*The EMI shown is indicative, based on the interest rate you enter. Your actual rate, amount and EMI are decided by the lender after approval. LoanPt is a loan facilitator, not a lender.</p>
</div></section>

<!-- OTHER CALCULATORS (interlink) -->
<section style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)"><div class="wrap">
  <div class="sec-head"><div class="kicker">More tools</div><h2>Other loan calculators</h2></div>
  <div class="tilegrid">
    <?php foreach ($calc as $cs => $cd): if ($cs === $slug) continue; ?>
      <a class="tile" href="<?php echo esc_url(home_url('/' . $cs . '/')); ?>"><span class="tile-ico"><span class="tile-ic">&#129518;</span></span><span class="tile-name"><?php echo esc_html($cd['product']); ?> EMI</span></a>
    <?php endforeach; ?>
    <a class="tile" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>"><span class="tile-ico"><span class="tile-ic">&#9989;</span></span><span class="tile-name">Check Eligibility</span></a>
  </div>
</div></section>

<!-- FAQ -->
<section id="faq"><div class="wrap" style="max-width:800px">
  <div class="sec-head"><div class="kicker">Good to know</div><h2>Frequently asked questions</h2></div>
  <?php $i = 0; foreach ($d['faq'] as $q => $ans): ?>
    <details<?php echo ($i === 0) ? ' open' : ''; ?>><summary><?php echo esc_html($q); ?></summary><div class="a"><?php echo esc_html($ans); ?></div></details>
  <?php $i++; endforeach; ?>
</div></section>

<!-- CTA -->
<section style="padding-top:0"><div class="wrap"><div class="ctaband">
  <h2>Like your EMI? Get it at the best rate.</h2><p>Check your eligibility free — our team finds you the lowest rate across every bank.</p><a class="btn" href="#apply">Get my best offer &rarr;</a>
</div></div></section>

<?php get_footer(); ?>
