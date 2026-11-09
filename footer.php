<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="wrap">
    <div class="cols">
      <div>
        <a href="<?php echo esc_url(home_url('/')); ?>" style="display:inline-block;margin-bottom:12px"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo-light.svg'); ?>" alt="LoanPt — Credit in Pocket" style="height:46px;width:auto;display:block"></a>
        <p style="max-width:34ch">We help salaried &amp; self-employed professionals compare and get personal loans, overdraft &amp; balance transfer at the best available rates — at zero cost.</p>
        <p style="margin-top:12px;color:#fff">&#128222; <?php echo esc_html(loanpt_opt('phone', LOANPT_PHONE)); ?> &middot; &#9993; <?php echo esc_html(loanpt_opt('email', LOANPT_EMAIL)); ?></p>
      </div>
      <div>
        <h4>Products</h4>
        <a href="<?php echo esc_url(home_url('/personal-loan/')); ?>">Personal Loan</a>
        <a href="<?php echo esc_url(home_url('/overdraft/')); ?>">Overdraft</a>
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
      </div>
      <div>
        <h4>Popular</h4>
        <a href="<?php echo esc_url(home_url('/urgent-personal-loan/')); ?>">Urgent Personal Loan</a>
        <a href="<?php echo esc_url(home_url('/instant-personal-loan/')); ?>">Instant Personal Loan</a>
        <a href="<?php echo esc_url(home_url('/zero-processing-fee-personal-loan/')); ?>">Zero-Fee Personal Loan</a>
        <a href="<?php echo esc_url(home_url('/low-interest-personal-loan/')); ?>">Low Interest Personal Loan</a>
        <a href="<?php echo esc_url(home_url('/personal-loan-for-salaried/')); ?>">Personal Loan for Salaried</a>
        <a href="<?php echo esc_url(home_url('/personal-loan-for-self-employed/')); ?>">Personal Loan (Self-Employed)</a>
        <a href="<?php echo esc_url(home_url('/personal-loan-delhi-ncr/')); ?>">Personal Loan in Delhi NCR</a>
        <a href="<?php echo esc_url(home_url('/personal-loan-emi-calculator/')); ?>">EMI Calculator</a>
        <a href="<?php echo esc_url(home_url('/calculators/')); ?>">Loan Calculators</a>
      </div>
      <div>
        <h4>Company</h4>
        <a href="#how">How it works</a>
        <a href="#faq">FAQ</a>
        <a href="<?php echo esc_url(home_url('/career/')); ?>">Careers</a>
        <a href="tel:+91<?php echo esc_attr(loanpt_opt('phone', LOANPT_PHONE)); ?>">Contact us</a>
        <a href="https://wa.me/<?php echo esc_attr(loanpt_opt('wa', LOANPT_WA)); ?>">WhatsApp</a>
      </div>
      <div>
        <h4>Login</h4>
        <a href="<?php echo esc_url(home_url('/customer/')); ?>">&#128100; Customer Login</a>
        <a href="<?php echo esc_url(loanpt_opt('connector_url', LOANPT_CONNECTOR_URL)); ?>">&#128100; Connector Login</a>
        <a href="<?php echo esc_url(loanpt_opt('team_url', LOANPT_TEAM_URL)); ?>">&#128274; Team Login</a>
        <a href="<?php echo esc_url(loanpt_opt('connector_url', LOANPT_CONNECTOR_URL)); ?>">Become a connector</a>
      </div>
    </div>
    <div class="legal">
      <p style="margin-bottom:10px">
        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" style="display:inline;color:#cfe9db">Privacy Policy</a>
        &nbsp;&middot;&nbsp;
        <a href="<?php echo esc_url(home_url('/terms/')); ?>" style="display:inline;color:#cfe9db">Terms &amp; Conditions</a>
      </p>
      LoanPt is a loan facilitation service (DSA / referral partner), not a lender or a bank. All loans are sanctioned and disbursed solely at the discretion of the respective bank / NBFC, subject to their eligibility and documentation. Interest rates and features shown are indicative and subject to change. LoanPt does not guarantee loan approval or any specific rate. &copy; <?php echo esc_html(date('Y')); ?> LoanPt &middot; Credit in Pocket.
    </div>
  </div>
</footer>

<a class="wa-float" href="https://wa.me/<?php echo esc_attr(loanpt_opt('wa', LOANPT_WA)); ?>?text=<?php echo rawurlencode('Hi LoanPt, I want to know about a loan.'); ?>" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
  <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16 3C8.82 3 3 8.82 3 16c0 2.3.62 4.46 1.7 6.32L3 29l6.86-1.67A12.9 12.9 0 0 0 16 29c7.18 0 13-5.82 13-13S23.18 3 16 3z" fill="#fff"/><path d="M12.3 9.6c-.24-.53-.5-.54-.72-.55l-.62-.01c-.21 0-.56.08-.85.4-.29.32-1.12 1.1-1.12 2.67 0 1.57 1.15 3.09 1.31 3.3.16.21 2.22 3.55 5.48 4.84 2.71 1.07 3.26.86 3.85.8.59-.05 1.9-.78 2.17-1.53.27-.75.27-1.39.19-1.53-.08-.13-.29-.21-.61-.37-.32-.16-1.9-.94-2.19-1.04-.29-.11-.5-.16-.72.16-.21.32-.82 1.04-1.01 1.25-.19.21-.37.24-.69.08-.32-.16-1.35-.5-2.57-1.59-.95-.85-1.59-1.89-1.78-2.21-.19-.32-.02-.49.14-.65.14-.14.32-.37.48-.56.16-.19.21-.32.32-.53.11-.21.05-.4-.03-.56-.08-.16-.7-1.74-.96-2.38z" fill="#25D366"/></svg>
</a>

<!-- Chat assistant -->
<div class="lpchat" id="lpchat">
  <button class="lpchat-launch" id="lpchatLaunch" type="button" aria-label="Chat with LoanPt">
    <span class="lpchat-ico">&#128172;</span><span class="lpchat-lbl">Need help?</span>
  </button>
  <div class="lpchat-panel" id="lpchatPanel" hidden>
    <div class="lpchat-head">
      <div class="lpchat-ava">L</div>
      <div><strong>LoanPt Assistant</strong><span>Typically replies instantly</span></div>
      <button class="lpchat-close" id="lpchatClose" type="button" aria-label="Close chat">&times;</button>
    </div>
    <div class="lpchat-body" id="lpchatBody"></div>
    <div class="lpchat-quick" id="lpchatQuick"></div>
  </div>
</div>

<!-- Lead popup (exit-intent) -->
<div class="lp-modal" id="lpModal" hidden>
  <div class="lp-modal-ov" id="lpModalOv"></div>
  <div class="lp-modal-box" role="dialog" aria-modal="true" aria-label="Get your best loan rate">
    <button class="lp-modal-x" id="lpModalX" type="button" aria-label="Close">&times;</button>
    <span class="lp-modal-badge">100% FREE</span>
    <h3>Get your lowest loan rate</h3>
    <p class="lp-modal-sub">Leave your number — our team compares every bank &amp; NBFC and calls you with your best offer.</p>
    <div class="lp-modal-err" id="lpModalErr"></div>
    <form id="lpModalForm" novalidate>
      <input id="lpmName" type="text" autocomplete="name" placeholder="Your name" required>
      <input id="lpmMobile" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile number" required>
      <select id="lpmProduct" aria-label="Loan type">
        <option>Personal Loan</option><option>Home Loan</option><option>Business Loan</option>
        <option>Loan Against Property</option><option>Car Loan</option><option>Gold Loan</option>
        <option>Credit Card</option><option>Other</option>
      </select>
      <button type="submit" class="btn btn-pri" id="lpmSubmit">Get my best offer &rarr;</button>
      <p class="lp-modal-note">We never ask for OTP, card or account details.</p>
    </form>
    <div class="lp-modal-ok" id="lpModalOk" hidden><div class="lp-modal-big">&#127881;</div><strong>Thank you!</strong><p>Our team will call you shortly with your best bank option.</p></div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
