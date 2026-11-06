<?php
/* Template Name: LoanPt Page */
if (!defined('ABSPATH')) exit;
get_header();

$slug = get_post_field('post_name', get_queried_object_id());
$info = loanpt_info_data();
$d = isset($info[$slug]) ? $info[$slug] : null;

if (!$d) {
    while (have_posts()) { the_post(); ?>
      <section><div class="wrap" style="max-width:860px"><article style="background:#fff;border:1px solid var(--line);border-radius:16px;padding:30px"><h1 style="font-size:32px;margin-bottom:14px"><?php the_title(); ?></h1><div style="line-height:1.75"><?php the_content(); ?></div></article></div></section>
    <?php }
    get_footer();
    return;
}
$phone = loanpt_opt('phone', LOANPT_PHONE);
$wa    = loanpt_opt('wa', LOANPT_WA);
$email = loanpt_opt('email', LOANPT_EMAIL);
$gromo = loanpt_opt('gromo_url', '');
?>

<!-- HERO -->
<section class="hero" style="padding:0"><div class="wrap" style="display:block;padding-top:48px;padding-bottom:44px">
  <span class="eyebrow">Credit in Pocket</span>
  <h1 style="margin:16px 0 12px;max-width:18ch"><?php echo esc_html($d['h1']); ?></h1>
  <p class="lead" style="max-width:62ch"><?php echo esc_html($d['intro']); ?></p>
</div></section>

<?php if ($slug === 'services'): ?>
<!-- SERVICES: product cards -->
<section><div class="wrap">
  <div class="prods">
    <div class="prod"><div class="ic">&#128176;</div><h3>Personal Loan</h3><p>Collateral-free funds for anything — wedding, medical, travel or consolidation. Fixed EMI, quick disbursal.</p><a class="go" href="<?php echo esc_url(home_url('/personal-loan/')); ?>">Compare personal loans &rarr;</a></div>
    <div class="prod"><div class="ic">&#128260;</div><h3>Overdraft (OD)</h3><p>A credit limit you dip into anytime. Pay interest only on what you use. Ideal for cash-flow.</p><a class="go" href="<?php echo esc_url(home_url('/overdraft/')); ?>">Explore overdraft &rarr;</a></div>
    <div class="prod"><div class="ic">&#128201;</div><h3>Balance Transfer</h3><p>Move your existing loan to a lower rate, cut your EMI, or take a top-up. Save on interest.</p><a class="go" href="<?php echo esc_url(home_url('/balance-transfer/')); ?>">Lower my EMI &rarr;</a></div>
    <div class="prod"><div class="ic">&#128179;</div><h3>Credit Card</h3><p>Get matched to the right card for your profile — rewards, cashback and EMI options.</p><a class="go" href="<?php echo esc_url(home_url('/#apply')); ?>">Check eligibility &rarr;</a></div>
  </div>
</div></section>
<section style="background:#fff;border-top:1px solid var(--line)"><div class="wrap">
  <div class="sec-head"><div class="kicker">Simple &amp; fast</div><h2>How it works</h2></div>
  <div class="steps">
    <div class="step"><div class="num">1</div><h3>Share your details</h3><p>Fill a 60-second form — no documents needed to start.</p></div>
    <div class="step"><div class="num">2</div><h3>We find your best offer</h3><p>We compare partner-bank options and pick the right fit for your profile.</p></div>
    <div class="step"><div class="num">3</div><h3>Apply &amp; get funds</h3><p>We guide you through documents and the fastest bank journey to disbursal.</p></div>
  </div>
</div></section>

<?php elseif ($slug === 'about'): ?>
<!-- ABOUT: why us + trust -->
<section class="why"><div class="wrap">
  <div class="sec-head" style="margin-bottom:28px"><h2 style="color:#fff">Why LoanPt</h2></div>
  <div class="grid">
    <div><div class="ic">&#127379;</div><h3>Zero cost to you</h3><p>Free to compare &amp; apply. We earn from the lender.</p></div>
    <div><div class="ic">&#127974;</div><h3>All banks, one place</h3><p>Compare every major bank &amp; NBFC in minutes.</p></div>
    <div><div class="ic">&#129309;</div><h3>Fully managed</h3><p>A real person handles your file end-to-end.</p></div>
    <div><div class="ic">&#128274;</div><h3>Safe &amp; honest</h3><p>No OTP/card asks. No false promises. Ever.</p></div>
  </div>
</div></section>
<!-- CEO MESSAGE -->
<section class="ceo"><div class="wrap">
  <div class="sec-head"><div class="kicker">Leadership</div><h2>A Message from Our CEO</h2></div>
  <div class="ceo-card">
    <div class="ceo-media">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/ceo.jpg'); ?>" alt="Tanveer Zehra Rizvi, CEO of LoanPt" loading="lazy" width="340" height="340">
      <div class="ceo-sign">
        <strong>Tanveer Zehra Rizvi</strong>
        <span>Chief Executive Officer, LoanPt</span>
      </div>
    </div>
    <div class="ceo-msg">
      <span class="ceo-quote" aria-hidden="true">&ldquo;</span>
      <p>India is living through one of the most exciting chapters in its financial history. As one of the world's fastest-growing economies, millions of Indians are ready to build, grow and dream bigger &mdash; and access to the right credit, at the right time, is what turns those dreams into decisions. At LoanPt, we exist to make that access simple, honest and within everyone's reach.</p>
      <p>We built LoanPt on one belief: getting a loan should never feel confusing, intimidating or unfair. So we bring every major bank and NBFC into one place, match each person to the offer that genuinely fits their profile, and stay with them through every step &mdash; with no hidden cost and no false promise. <em>&ldquo;Credit in Pocket&rdquo;</em> isn't just our tagline; it's the standard we hold ourselves to.</p>
      <p>As the industry moves digital, we're building LoanPt to be fast, transparent and genuinely on your side &mdash; pairing smart technology with a real person who owns your file from first call to disbursal. Whether you need a personal loan, an overdraft or a balance transfer, our promise stays the same: your best interest, always first.</p>
      <p>Thank you for trusting us with your journey. We are only getting started &mdash; and we are glad to have you with us.</p>
    </div>
  </div>
</div></section>
<section><div class="wrap" style="max-width:820px">
  <div class="sec-head"><div class="kicker">Our promise</div><h2>Honest, transparent lending help</h2></div>
  <p style="font-size:17px;color:#2e3f36;line-height:1.8">We believe getting a loan should be simple and honest. That's why LoanPt compares offers across leading banks and NBFCs, matches you to the lowest rate your profile qualifies for, and handles the paperwork — so you don't run from bank to bank. We never charge you, never ask for OTP, card or account details, and never promise a rate or approval we can't stand behind. Whatever your need — a personal loan, an overdraft or a balance transfer — we help you get the right credit, the right way.</p>
</div></section>

<?php elseif ($slug === 'contact'): ?>
<!-- CONTACT: methods + form -->
<section><div class="wrap">
  <div class="prods" style="grid-template-columns:repeat(3,1fr)">
    <a class="prod" style="text-decoration:none" href="tel:+91<?php echo esc_attr($phone); ?>"><div class="ic">&#128222;</div><h3>Call us</h3><p><?php echo esc_html($phone); ?></p><span class="go">Tap to call &rarr;</span></a>
    <a class="prod" style="text-decoration:none" href="https://wa.me/<?php echo esc_attr($wa); ?>"><div class="ic">&#128172;</div><h3>WhatsApp</h3><p>Chat with our team</p><span class="go">Message us &rarr;</span></a>
    <a class="prod" style="text-decoration:none" href="mailto:<?php echo esc_attr($email); ?>"><div class="ic">&#9993;</div><h3>Email</h3><p><?php echo esc_html($email); ?></p><span class="go">Write to us &rarr;</span></a>
  </div>
</div></section>
<section style="background:#fff;border-top:1px solid var(--line)"><div class="wrap" style="max-width:560px">
  <div class="sec-head"><div class="kicker">Get a call back</div><h2>Request a call</h2><p>Share your details and our team will call you with the right option.</p></div>
  <div class="formcard" id="apply" style="box-shadow:0 8px 26px rgba(20,63,41,.1)">
    <div class="err" id="err"></div>
    <form id="leadForm" novalidate>
      <div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required></div>
      <div class="field"><label for="mobile">Mobile number</label><input id="mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile" required></div>
      <div class="row2">
        <div class="field"><label for="product">I need</label>
          <select id="product" name="product"><option>Personal Loan</option><option>Overdraft</option><option>Balance Transfer</option><option>Credit Card</option></select></div>
        <div class="field"><label for="city">City</label><input id="city" name="city" type="text" placeholder="e.g. Noida"></div>
      </div>
      <button type="submit" class="btn btn-pri" id="submitBtn">Request a call &rarr;</button>
      <p class="fnote">We never ask for OTP, card or account details.</p>
    </form>
    <div class="ok" id="ok"><div class="big">&#127881;</div><h3>Thank you!</h3><p>Our team will call you shortly.</p><a class="wa" id="waLink" href="#">&#128172; Chat on WhatsApp</a></div>
  </div>
</div></section>

<?php elseif ($slug === 'instant-loan'): ?>
<!-- INSTANT LOAN: apply form + fast steps -->
<section style="padding-top:36px"><div class="wrap" style="max-width:560px">
  <div class="formcard" id="apply" style="box-shadow:0 12px 34px rgba(20,63,41,.12)">
    <h2>Apply in 60 seconds</h2><p class="fsub"><?php echo $gromo ? 'Share your details, then we take you to our partner for instant processing.' : 'Our team calls you right away with the fastest option.'; ?></p>
    <div class="err" id="err"></div>
    <form id="leadForm"<?php if ($gromo): ?> data-redirect="<?php echo esc_url($gromo); ?>"<?php endif; ?> novalidate>
      <div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required></div>
      <div class="field"><label for="mobile">Mobile number</label><input id="mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile" required></div>
      <div class="row2">
        <div class="field"><label for="amount">Amount (&#8377;)</label><input id="amount" name="amount" type="text" inputmode="numeric" placeholder="e.g. 5,00,000"></div>
        <div class="field"><label for="city">City</label><input id="city" name="city" type="text" placeholder="e.g. Noida"></div>
      </div>
      <input type="hidden" id="product" name="product" value="Personal Loan">
      <button type="submit" class="btn btn-pri" id="submitBtn">Get my instant offer &rarr;</button>
      <p class="fnote">We never ask for OTP, card or account details.</p>
    </form>
    <div class="ok" id="ok"><div class="big">&#127881;</div><h3>Thank you!</h3><p>Our team will call you right away.</p><a class="wa" id="waLink" href="#">&#128172; Chat on WhatsApp</a></div>
  </div>
</div></section>
<section style="background:#fff;border-top:1px solid var(--line)"><div class="wrap">
  <div class="sec-head"><div class="kicker">Why it's fast</div><h2>Funds without the wait</h2></div>
  <div class="steps">
    <div class="step"><div class="num">1</div><h3>60-second eligibility</h3><p>Share a few details — no documents to start.</p></div>
    <div class="step"><div class="num">2</div><h3>Instantly matched</h3><p>We route you to the bank or NBFC with the fastest journey for your profile.</p></div>
    <div class="step"><div class="num">3</div><h3>Quick disbursal</h3><p>Minimal paperwork, digital where possible — funds reach you fast.</p></div>
  </div>
</div></section>
<?php endif; ?>

<!-- CTA -->
<section style="padding-top:0"><div class="wrap"><div class="ctaband">
  <h2>Ready to get started?</h2><p>Check your eligibility free — it takes less than a minute.</p><a class="btn" href="<?php echo esc_url(home_url('/#apply')); ?>">Get my best offer &rarr;</a>
</div></div></section>

<?php get_footer(); ?>
