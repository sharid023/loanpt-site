<?php if (!defined('ABSPATH')) exit; get_header(); ?>

<!-- HERO -->
<section class="hero">
  <div class="wrap">
    <div>
      <span class="eyebrow"><?php echo esc_html(loanpt_opt('eyebrow', 'Credit in Pocket')); ?></span>
      <h1><?php echo loanpt_headline_html(); ?></h1>
      <p class="lead"><?php echo esc_html(loanpt_opt('subtext', 'Personal Loan, Overdraft & Balance Transfer offers from HDFC, Kotak, ICICI, Axis, Bajaj & more — matched to your profile. Check eligibility free and apply in minutes.')); ?></p>
      <div class="trust">
        <span><span class="tick">&#10003;</span> 100% free to apply</span>
        <span><span class="tick">&#10003;</span> All major banks &amp; NBFCs</span>
        <span><span class="tick">&#10003;</span> Minimal paperwork</span>
        <span><span class="tick">&#10003;</span> Fully managed by us</span>
      </div>
    </div>
    <div class="formcard" id="apply">
      <h2>Get your best loan offer</h2>
      <p class="fsub">60 seconds. Our team calls you with the right bank option.</p>
      <div class="err" id="err"></div>
      <form id="leadForm" novalidate>
        <div class="field"><label for="name">Full name</label>
          <input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required></div>
        <div class="field"><label for="mobile">Mobile number</label>
          <input id="mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile" required></div>
        <div class="row2">
          <div class="field"><label for="product">I need</label>
            <select id="product" name="product">
              <option>Personal Loan</option><option>Overdraft</option>
              <option>Balance Transfer</option><option>Credit Card</option>
            </select></div>
          <div class="field"><label for="amount">Amount (&#8377;)</label>
            <input id="amount" name="amount" type="text" inputmode="numeric" placeholder="e.g. 5,00,000"></div>
        </div>
        <div class="field"><label for="city">City</label>
          <input id="city" name="city" type="text" autocomplete="address-level2" placeholder="e.g. Noida"></div>
        <button type="submit" class="btn btn-pri" id="submitBtn">Get my best offer &rarr;</button>
        <p class="fnote">By submitting you agree to be contacted by LoanPt. We never ask for OTP, card or account details.</p>
      </form>
      <div class="ok" id="ok">
        <div class="big">&#127881;</div><h3>Thank you!</h3>
        <p>Our team will call you shortly with your best bank option. For a faster reply, message us on WhatsApp.</p>
        <a class="wa" id="waLink" href="#">&#128172; Chat on WhatsApp</a>
      </div>
    </div>
  </div>
</section>

<!-- PROMO CAROUSEL -->
<section class="promo"><div class="wrap">
  <div class="promo-box">
    <a class="promo-slide s1 is-active" href="<?php echo esc_url(home_url('/personal-loan/')); ?>">
      <div class="promo-txt"><span class="promo-tag">PERSONAL LOAN</span><strong>Up to &#8377;50 Lakh at the lowest rate</strong><span class="promo-sub">Quick disbursal &middot; Minimal paperwork &middot; Offers from every bank</span></div>
      <span class="promo-cta">Apply now &rarr;</span>
    </a>
    <a class="promo-slide s2" href="<?php echo esc_url(home_url('/balance-transfer/')); ?>">
      <div class="promo-txt"><span class="promo-tag">BALANCE TRANSFER</span><strong>Cut your EMI &mdash; move to a lower rate</strong><span class="promo-sub">Lower interest + top-up &middot; Save on total interest</span></div>
      <span class="promo-cta">Check savings &rarr;</span>
    </a>
    <a class="promo-slide s3" href="<?php echo esc_url(home_url('/overdraft/')); ?>">
      <div class="promo-txt"><span class="promo-tag">OVERDRAFT</span><strong>Pay interest only on what you use</strong><span class="promo-sub">A credit limit you dip into anytime &middot; No fixed EMI</span></div>
      <span class="promo-cta">Explore OD &rarr;</span>
    </a>
    <a class="promo-slide s4" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>">
      <div class="promo-txt"><span class="promo-tag">FREE CHECK</span><strong>See how much you qualify for &mdash; in 60 sec</strong><span class="promo-sub">No documents &middot; No impact on your credit score</span></div>
      <span class="promo-cta">Check free &rarr;</span>
    </a>
    <div class="promo-dots" id="promoDots">
      <button type="button" data-i="0" class="is-on" aria-label="Slide 1"></button>
      <button type="button" data-i="1" aria-label="Slide 2"></button>
      <button type="button" data-i="2" aria-label="Slide 3"></button>
      <button type="button" data-i="3" aria-label="Slide 4"></button>
    </div>
  </div>
</div></section>

<!-- TRUST BAR -->
<div class="trustbar"><div class="wrap">
  <div class="stat"><b>8+</b><span>Partner banks &amp; NBFCs</span></div>
  <div class="stat"><b>&#8377;0</b><span>Cost to you</span></div>
  <div class="stat"><b>24 hrs</b><span>Typical callback</span></div>
  <div class="stat"><b>100%</b><span>Managed by us</span></div>
</div></div>

<!-- PRODUCT & TOOL TILES (quick access) -->
<section class="tiles">
  <div class="wrap">
    <div class="sec-head" style="margin-bottom:22px"><div class="kicker">One place for everything</div><h2>Loans, Cards &amp; Free Tools</h2><p>Pick what you need — compare offers from every major bank in minutes.</p></div>
    <div class="tilegrid">
      <a class="tile" href="<?php echo esc_url(home_url('/personal-loan/')); ?>"><span class="tile-ico"><span class="tile-ic">&#128176;</span><span class="tile-badge">Lowest rate</span></span><span class="tile-name">Personal Loan</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/overdraft/')); ?>"><span class="tile-ico"><span class="tile-ic">&#128260;</span><span class="tile-badge">Flexible</span></span><span class="tile-name">Overdraft</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/balance-transfer/')); ?>"><span class="tile-ico"><span class="tile-ic">&#128201;</span><span class="tile-badge">Save EMI</span></span><span class="tile-name">Balance Transfer</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/instant-loan/')); ?>"><span class="tile-ico"><span class="tile-ic">&#9889;</span><span class="tile-badge">Instant</span></span><span class="tile-name">Instant Loan</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/credit-card/')); ?>"><span class="tile-ico"><span class="tile-ic">&#128179;</span></span><span class="tile-name">Credit Card</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/business-loan/')); ?>"><span class="tile-ico"><span class="tile-ic">&#127970;</span></span><span class="tile-name">Business Loan</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/home-loan/')); ?>"><span class="tile-ico"><span class="tile-ic">&#127968;</span></span><span class="tile-name">Home Loan</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/cibil-score/')); ?>"><span class="tile-ico"><span class="tile-ic">&#128202;</span><span class="tile-badge">Free</span></span><span class="tile-name">Credit Score</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>"><span class="tile-ico"><span class="tile-ic">&#9989;</span><span class="tile-badge">Free</span></span><span class="tile-name">Check Eligibility</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/#calc')); ?>"><span class="tile-ico"><span class="tile-ic">&#129518;</span></span><span class="tile-name">EMI Calculator</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/#compare')); ?>"><span class="tile-ico"><span class="tile-ic">&#127974;</span></span><span class="tile-name">Compare Banks</span></a>
      <a class="tile" href="<?php echo esc_url(home_url('/blog/')); ?>"><span class="tile-ico"><span class="tile-ic">&#128218;</span></span><span class="tile-name">Loan Guides</span></a>
    </div>
  </div>
</section>

<!-- PARTNER BANKS -->
<div class="partners"><div class="wrap">
  <span class="lbl">We compare offers across</span>
  <span>HDFC</span><span>ICICI</span><span>Axis</span><span>Kotak</span><span>Bajaj Finserv</span><span>IDFC First</span><span>&amp; more</span>
</div></div>

<!-- EMI CALCULATOR (lead magnet) -->
<section id="calc">
  <div class="wrap">
    <div class="sec-head"><div class="kicker">Plan your loan</div><h2>EMI Calculator</h2><p>See your monthly EMI instantly, then get the best rate for it.</p></div>
    <div class="calc" data-calc="emi" data-cfg="{}">
      <div>
        <div class="ctrl"><div class="top"><span>Loan amount</span><input type="text" inputmode="numeric" class="val" data-val="amount" data-fmt="money" aria-label="Loan amount"></div>
          <input type="range" data-role="amount" data-fmt="money" min="50000" max="5000000" step="10000" value="500000"></div>
        <div class="ctrl"><div class="top"><span>Interest rate (p.a.)</span><input type="text" inputmode="decimal" class="val" data-val="rate" data-fmt="pct" aria-label="Interest rate"></div>
          <input type="range" data-role="rate" data-fmt="pct" min="9" max="24" step="0.25" value="11"></div>
        <div class="ctrl"><div class="top"><span>Tenure</span><input type="text" inputmode="numeric" class="val" data-val="tenure" data-fmt="months" aria-label="Tenure"></div>
          <input type="range" data-role="tenure" data-fmt="months" min="6" max="84" step="6" value="36"></div>
      </div>
      <div class="result">
        <div class="lbl" data-main-label>Your monthly EMI</div>
        <div class="emi" data-main>&#8377;16,369</div>
        <div class="meta" data-rows></div>
        <a class="btn btn-pri" href="#apply">Get this at the best rate &rarr;</a>
      </div>
    </div>
  </div>
</section>

<!-- POPULAR CALCULATORS STRIP (engagement + internal links) -->
<section class="calcstrip-sec" aria-label="Popular free calculators">
  <div class="wrap">
    <div class="sec-head" style="margin-bottom:18px">
      <div class="kicker">Free tools</div>
      <h2>Plan smart with calculators</h2>
      <p>Tap any tool &mdash; EMI, eligibility, prepayment savings &amp; more. 100% free, no login needed.</p>
    </div>
  </div>
  <div class="calcstrip" role="list">
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/personal-loan-emi-calculator/')); ?>"><span class="cs-ic">&#128181;</span><strong>EMI Calculator</strong><em>Your monthly instalment in seconds</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/personal-loan-eligibility-calculator/')); ?>"><span class="cs-ic">&#9989;</span><strong>Eligibility</strong><em>How much loan can you get?</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/balance-transfer-savings-calculator/')); ?>"><span class="cs-ic">&#128260;</span><strong>Balance Transfer</strong><em>See how much you can save</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/loan-prepayment-calculator/')); ?>"><span class="cs-ic">&#128201;</span><strong>Prepayment</strong><em>Cut your interest &amp; tenure</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/home-loan-emi-calculator/')); ?>"><span class="cs-ic">&#127968;</span><strong>Home Loan EMI</strong><em>Plan your home purchase</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/car-loan-emi-calculator/')); ?>"><span class="cs-ic">&#128664;</span><strong>Car Loan EMI</strong><em>Budget your next car</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/gold-loan-emi-calculator/')); ?>"><span class="cs-ic">&#129689;</span><strong>Gold Loan EMI</strong><em>Unlock value from gold</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/business-loan-emi-calculator/')); ?>"><span class="cs-ic">&#128188;</span><strong>Business Loan EMI</strong><em>Fund your business growth</em></a>
    <a class="calcstrip-card" role="listitem" href="<?php echo esc_url(home_url('/sip-calculator/')); ?>"><span class="cs-ic">&#128200;</span><strong>SIP Calculator</strong><em>Grow your savings monthly</em></a>
    <a class="calcstrip-card cs-all" role="listitem" href="<?php echo esc_url(home_url('/calculators/')); ?>"><span class="cs-ic">&#129518;</span><strong>All calculators</strong><em>See every free tool &rarr;</em></a>
  </div>
</section>

<!-- COMPARISON -->
<section id="compare" style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)">
  <div class="wrap">
    <div class="sec-head"><div class="kicker">Compare &amp; save</div><h2>Personal Loan — Bank Comparison</h2><p>Indicative offers across leading banks &amp; NBFCs. We match you to the best one for your profile.</p></div>
    <div class="tablewrap"><table class="cmp">
      <thead><tr><th>Bank / NBFC</th><th>Interest (from)*</th><th>Loan up to</th><th>Tenure</th><th>Processing fee</th><th></th></tr></thead>
      <tbody>
      <?php foreach (loanpt_banks() as $b): ?>
        <tr>
          <td><span class="bankname"><?php echo esc_html($b[0]); ?></span></td>
          <td class="rate"><?php echo esc_html($b[1]); ?> <span class="mini">p.a.</span></td>
          <td><?php echo esc_html($b[2]); ?></td>
          <td><?php echo esc_html($b[3]); ?></td>
          <td><?php echo esc_html($b[4]); ?></td>
          <td><a class="btn btn-pri" href="#apply">Get offer</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table></div>
    <p class="disc">*Interest rates are indicative, starting-from figures and vary by lender, product and applicant profile. Final rate, amount, fees and approval are decided solely by the lender. LoanPt is a loan facilitator, not a lender.</p>
  </div>
</section>

<!-- PRODUCTS -->
<section id="products">
  <div class="wrap">
    <div class="sec-head"><div class="kicker">What we arrange</div><h2>One place for all your credit needs</h2></div>
    <div class="prods">
      <div class="prod"><div class="ic">&#128176;</div><h3>Personal Loan</h3><p>Funds for anything — wedding, medical, travel or emergencies. Fixed EMI, quick disbursal.</p><a class="go" href="<?php echo esc_url(home_url('/personal-loan/')); ?>">Compare personal loans &rarr;</a></div>
      <div class="prod"><div class="ic">&#128260;</div><h3>Overdraft (OD)</h3><p>A credit limit you dip into anytime. Pay interest only on what you use. Great for cash-flow.</p><a class="go" href="<?php echo esc_url(home_url('/overdraft/')); ?>">Explore overdraft &rarr;</a></div>
      <div class="prod"><div class="ic">&#128201;</div><h3>Balance Transfer</h3><p>Move your existing loan to a lower rate, cut your EMI, or take a top-up. Save on interest.</p><a class="go" href="<?php echo esc_url(home_url('/balance-transfer/')); ?>">Lower my EMI &rarr;</a></div>
      <div class="prod"><div class="ic">&#128188;</div><h3>Business Loan</h3><p>Working capital, expansion or new equipment — flexible funding to grow your business.</p><a class="go" href="<?php echo esc_url(home_url('/business-loan/')); ?>">Explore business loans &rarr;</a></div>
    </div>
  </div>
</section>

<!-- HOW -->
<section id="how" style="background:#fff;border-top:1px solid var(--line)">
  <div class="wrap">
    <div class="sec-head"><div class="kicker">Simple &amp; fast</div><h2>How it works</h2></div>
    <div class="steps">
      <div class="step"><div class="num">1</div><h3>Share your details</h3><p>Fill the 60-second form — no documents needed to start.</p></div>
      <div class="step"><div class="num">2</div><h3>We find your best offer</h3><p>Our team compares partner-bank options and picks the right fit.</p></div>
      <div class="step"><div class="num">3</div><h3>Apply &amp; get funds</h3><p>We guide you through documents and the fastest bank journey to disbursal.</p></div>
    </div>
  </div>
</section>

<!-- WHY -->
<section class="why">
  <div class="wrap">
    <div class="sec-head" style="margin-bottom:28px"><h2 style="color:#fff">Why LoanPt</h2></div>
    <div class="grid">
      <div><div class="ic">&#127379;</div><h3>Zero cost to you</h3><p>Free to compare &amp; apply. We earn from the lender.</p></div>
      <div><div class="ic">&#127974;</div><h3>All banks, one place</h3><p>Compare every major bank &amp; NBFC in minutes.</p></div>
      <div><div class="ic">&#129309;</div><h3>Fully managed</h3><p>A real person handles your file end-to-end.</p></div>
      <div><div class="ic">&#128274;</div><h3>Safe &amp; honest</h3><p>No OTP/card asks. No false promises. Ever.</p></div>
    </div>
  </div>
</section>

<!-- LOAN DISCLOSURE (rates, APR, tenure, representative example) -->
<?php echo loanpt_loan_disclosure(); ?>

<!-- FAQ -->
<section id="faq">
  <div class="wrap" style="max-width:800px">
    <div class="sec-head"><div class="kicker">Good to know</div><h2>Frequently asked questions</h2></div>
    <details open><summary>Is LoanPt free to use?</summary><div class="a">Yes — comparing offers and applying through LoanPt is completely free for you. We are paid by the lender, never by you.</div></details>
    <details><summary>Which banks can I compare?</summary><div class="a">Leading banks and NBFCs including HDFC, Kotak, ICICI, Axis, Bajaj Finserv, IDFC First and more. We match you to the best option for your profile.</div></details>
    <details><summary>What interest rate will I get?</summary><div class="a">Rates depend on the lender, the product and your profile, so they're decided case-by-case by the lender. We never promise a fixed rate upfront.</div></details>
    <details><summary>Do you charge any fee?</summary><div class="a">No fee from you. Lenders may charge their own processing fee (shown transparently). LoanPt's service is free to you.</div></details>
    <details><summary>Is my data safe?</summary><div class="a">Yes. We only use your details to find you the best offer and contact you. We never ask for OTP, card or account numbers.</div></details>
  </div>
</section>

<!-- CTA -->
<section style="padding-top:0">
  <div class="wrap"><div class="ctaband">
    <h2>Ready to find your best loan?</h2>
    <p>Check your eligibility free — it takes less than a minute.</p>
    <a class="btn" href="#apply">Get my best offer &rarr;</a>
  </div></div>
</section>

<?php get_footer(); ?>
