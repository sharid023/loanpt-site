<?php
/* Template Name: LoanPt Quiz */
if (!defined('ABSPATH')) exit;
get_header();
?>
<section class="hero" style="padding:0"><div class="wrap" style="display:block;padding:46px 18px 38px">
  <span class="eyebrow">60-second check</span>
  <h1 style="margin:14px 0 8px">Check Your Loan Eligibility</h1>
  <p class="lead" style="max-width:56ch">Answer a few quick questions to see how much you may be eligible for — free, no documents, and no impact on your credit score.</p>
</div></section>

<section><div class="wrap" style="max-width:620px">
  <div id="lpquiz" class="quizcard">
    <div class="qprogress"><div class="qbar" id="qbar"></div></div>

    <div class="qstep" data-step="1">
      <h3>What is your employment type?</h3>
      <div class="qopts">
        <button type="button" class="qopt" data-field="employment" data-val="Salaried">&#128188; Salaried</button>
        <button type="button" class="qopt" data-field="employment" data-val="Self-employed">&#129333; Self-employed</button>
      </div>
    </div>

    <div class="qstep" data-step="2" hidden>
      <h3>Your monthly income (take-home)</h3>
      <div class="qrange"><input type="range" id="qincome" min="15000" max="300000" step="5000" value="50000"><div class="qval">&#8377;<span id="qincomeout">50,000</span> <small>/ month</small></div></div>
      <button type="button" class="btn btn-pri qnext">Continue &rarr;</button>
    </div>

    <div class="qstep" data-step="3" hidden>
      <h3>Your existing monthly EMIs (if any)</h3>
      <div class="qrange"><input type="range" id="qemi" min="0" max="150000" step="2000" value="0"><div class="qval">&#8377;<span id="qemiout">0</span> <small>/ month</small></div></div>
      <button type="button" class="btn btn-pri qnext">Continue &rarr;</button>
    </div>

    <div class="qstep" data-step="4" hidden>
      <h3>How much do you need, and where?</h3>
      <div class="field"><label for="qamount">Loan amount (&#8377;)</label><input id="qamount" type="text" inputmode="numeric" placeholder="e.g. 5,00,000"></div>
      <div class="field"><label for="qcity">City</label><input id="qcity" type="text" placeholder="e.g. Noida"></div>
      <button type="button" class="btn btn-pri qnext">See my eligibility &rarr;</button>
    </div>

    <div class="qstep" data-step="5" hidden>
      <div class="qresult">
        <div class="qlbl">You may be eligible for up to</div>
        <div class="qamt" id="qresultamt">&#8377;0</div>
        <div class="qnote">Indicative estimate based on your inputs. The final amount and rate are decided by the lender after approval.</div>
      </div>
      <p style="text-align:center;margin:16px 0 8px;font-weight:700;color:var(--green2)">Get your exact offer — our team will call you.</p>
      <div class="err" id="err"></div>
      <form id="leadForm" novalidate>
        <div class="field"><label for="name">Full name</label><input id="name" name="name" type="text" autocomplete="name" placeholder="Your name" required></div>
        <div class="field"><label for="mobile">Mobile number</label><input id="mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile" required></div>
        <input type="hidden" id="product" name="product" value="Personal Loan">
        <input type="hidden" id="amount" name="amount" value="">
        <input type="hidden" id="city" name="city" value="">
        <button type="submit" class="btn btn-pri" id="submitBtn" style="width:100%">Get my offer &rarr;</button>
        <p class="fnote">We never ask for OTP, card or account details.</p>
      </form>
      <div class="ok" id="ok"><div class="big">&#127881;</div><h3>Thank you!</h3><p>Our team will call you shortly with your best offer.</p><a class="wa" id="waLink" href="#">&#128172; Chat on WhatsApp</a></div>
    </div>
  </div>
</div></section>
<?php get_footer(); ?>
