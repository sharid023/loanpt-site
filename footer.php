<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="wrap">
    <div class="cols">
      <div>
        <div class="logo" style="color:#fff;margin-bottom:10px"><span class="mk">L</span>Loan<b style="color:var(--mint)">Pt</b></div>
        <p style="max-width:34ch">Credit in Pocket. We help salaried professionals compare and get personal loans, overdraft &amp; balance transfer at the best available rates — at zero cost.</p>
        <p style="margin-top:12px;color:#fff">&#128222; <?php echo esc_html(LOANPT_PHONE); ?> &middot; &#9993; <?php echo esc_html(LOANPT_EMAIL); ?></p>
      </div>
      <div>
        <h4>Products</h4>
        <a href="#apply">Personal Loan</a>
        <a href="#apply">Overdraft</a>
        <a href="#apply">Balance Transfer</a>
        <a href="#apply">Credit Card</a>
      </div>
      <div>
        <h4>Company</h4>
        <a href="#how">How it works</a>
        <a href="#faq">FAQ</a>
        <a href="tel:+91<?php echo esc_attr(LOANPT_PHONE); ?>">Contact us</a>
        <a href="https://wa.me/<?php echo esc_attr(LOANPT_WA); ?>">WhatsApp</a>
      </div>
      <div>
        <h4>Login</h4>
        <a href="<?php echo esc_url(LOANPT_CONNECTOR_URL); ?>">&#128100; Connector Login</a>
        <a href="<?php echo esc_url(LOANPT_TEAM_URL); ?>">&#128274; Team Login</a>
        <a href="<?php echo esc_url(LOANPT_CONNECTOR_URL); ?>">Become a connector</a>
      </div>
    </div>
    <div class="legal">
      LoanPt is a loan facilitation service (DSA / referral partner), not a lender or a bank. All loans are sanctioned and disbursed solely at the discretion of the respective bank / NBFC, subject to their eligibility and documentation. Interest rates and features shown are indicative and subject to change. LoanPt does not guarantee loan approval or any specific rate. &copy; <?php echo esc_html(date('Y')); ?> LoanPt &middot; Credit in Pocket.
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
