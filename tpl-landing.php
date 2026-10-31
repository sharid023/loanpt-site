<?php
/* Template Name: LoanPt Landing */
if (!defined('ABSPATH')) exit;
get_header();

$slug = get_post_field('post_name', get_queried_object_id());
$data = loanpt_landing_data();
$d = isset($data[$slug]) ? $data[$slug] : null;

if (!$d) {
    // Not one of our landing slugs — fall back to normal page content.
    while (have_posts()) { the_post(); ?>
      <section><div class="wrap" style="max-width:860px"><article style="background:#fff;border:1px solid var(--line);border-radius:16px;padding:30px"><h1 style="font-size:32px;margin-bottom:14px"><?php the_title(); ?></h1><div style="line-height:1.75"><?php the_content(); ?></div></article></div></section>
    <?php }
    get_footer();
    return;
}
$products = array('Personal Loan', 'Overdraft', 'Balance Transfer', 'Credit Card');
?>

<!-- HERO -->
<section class="hero"><div class="wrap">
  <div>
    <span class="eyebrow">Credit in Pocket</span>
    <h1><?php echo wp_kses($d['h1'], array('em' => array())); ?></h1>
    <p class="lead">Check your eligibility free — our team compares partner-bank offers and finds you the best option, with minimal paperwork.</p>
    <div class="trust">
      <span><span class="tick">&#10003;</span> 100% free to apply</span>
      <span><span class="tick">&#10003;</span> All major banks &amp; NBFCs</span>
      <span><span class="tick">&#10003;</span> Fully managed by us</span>
    </div>
  </div>
  <div class="formcard" id="apply">
    <h2>Get your best offer</h2>
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

<!-- INTRO + WHAT YOU GET -->
<section><div class="wrap" style="max-width:900px">
  <p style="font-size:18px;color:#2e3f36;line-height:1.75"><?php echo esc_html($d['intro']); ?></p>
  <div class="prods" style="grid-template-columns:repeat(2,1fr);margin-top:26px">
    <?php foreach ($d['bullets'] as $b): ?>
      <div class="prod" style="padding:16px 18px;display:flex;gap:10px;align-items:center"><span class="tick" style="color:var(--mint2);font-weight:800">&#10003;</span> <span style="font-size:15.5px;font-weight:600;color:#1b3328"><?php echo esc_html($b); ?></span></div>
    <?php endforeach; ?>
  </div>
</div></section>

<?php
$ncr = array('noida' => 'Noida', 'delhi' => 'Delhi', 'gurugram' => 'Gurugram', 'ghaziabad' => 'Ghaziabad', 'faridabad' => 'Faridabad', 'greater-noida' => 'Greater Noida');
if ($d['product'] === 'Personal Loan'): ?>
<!-- NCR CITY INTERLINKS -->
<section style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)"><div class="wrap">
  <div class="sec-head"><div class="kicker">Local</div><h2>Personal Loan across NCR</h2><p>We help salaried &amp; self-employed applicants across the National Capital Region.</p></div>
  <div class="prods" style="grid-template-columns:repeat(3,1fr)">
    <?php foreach ($ncr as $cs => $cn): if ($slug === 'personal-loan-' . $cs) continue; ?>
      <a class="prod" style="text-decoration:none" href="<?php echo esc_url(home_url('/personal-loan-' . $cs . '/')); ?>"><h3 style="margin:0;font-size:18px"><?php echo esc_html('Personal Loan in ' . $cn); ?></h3><span class="go">Compare offers &rarr;</span></a>
    <?php endforeach; ?>
  </div>
</div></section>
<?php endif; ?>

<?php if (!empty($d['compare'])): ?>
<!-- COMPARISON -->
<section id="compare" style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)"><div class="wrap">
  <div class="sec-head"><div class="kicker">Compare &amp; save</div><h2>Bank Comparison</h2><p>Indicative offers across leading banks &amp; NBFCs. We match you to the best one for your profile.</p></div>
  <div class="tablewrap"><table class="cmp">
    <thead><tr><th>Bank / NBFC</th><th>Interest (from)*</th><th>Loan up to</th><th>Tenure</th><th>Processing fee</th><th></th></tr></thead>
    <tbody>
    <?php foreach (loanpt_banks() as $b): ?>
      <tr><td><span class="bankname"><?php echo esc_html($b[0]); ?></span></td><td class="rate"><?php echo esc_html($b[1]); ?> <span class="mini">p.a.</span></td><td><?php echo esc_html($b[2]); ?></td><td><?php echo esc_html($b[3]); ?></td><td><?php echo esc_html($b[4]); ?></td><td><a class="btn btn-pri" href="#apply">Get offer</a></td></tr>
    <?php endforeach; ?>
    </tbody>
  </table></div>
  <p class="disc">*Interest rates are indicative, starting-from figures and vary by lender, product and applicant profile. Final rate, amount, fees and approval are decided solely by the lender. LoanPt is a loan facilitator, not a lender.</p>
</div></section>
<?php endif; ?>

<!-- FAQ -->
<section id="faq"><div class="wrap" style="max-width:800px">
  <div class="sec-head"><div class="kicker">Good to know</div><h2>Frequently asked questions</h2></div>
  <?php $i = 0; foreach ($d['faq'] as $q => $a): ?>
    <details<?php echo ($i === 0) ? ' open' : ''; ?>><summary><?php echo esc_html($q); ?></summary><div class="a"><?php echo esc_html($a); ?></div></details>
  <?php $i++; endforeach; ?>
</div></section>

<!-- CTA -->
<section style="padding-top:0"><div class="wrap"><div class="ctaband">
  <h2>Ready to get started?</h2><p>Check your eligibility free — it takes less than a minute.</p><a class="btn" href="#apply">Get my best offer &rarr;</a>
</div></div></section>

<?php get_footer(); ?>
