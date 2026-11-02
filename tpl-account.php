<?php
/* Template Name: LoanPt Customer Account */
if (!defined('ABSPATH')) exit;
get_header();
$gcid = loanpt_opt('google_client_id', defined('LOANPT_GOOGLE_CLIENT_ID') ? LOANPT_GOOGLE_CLIENT_ID : '');
?>
<section class="acct"><div class="wrap" style="max-width:720px">

  <!-- LOGIN (shown when logged out) -->
  <div id="acctLogin" class="acct-card" style="max-width:480px;margin:0 auto" data-gcid="<?php echo esc_attr($gcid); ?>">
    <span class="eyebrow eyebrow-dark">Customer Login</span>
    <h1>Welcome Back</h1>
    <p class="acct-sub">Sign in to track your loan application, see approvals and apply for new offers. Same account as the LoanPt app.</p>
    <div class="err" id="loginErr"></div>
    <?php if ($gcid): ?>
      <div class="gwrap"><div id="gbtn"></div></div>
      <p class="acct-secure">&#128274; Secure sign-in with your Google account</p>
    <?php else: ?>
      <div class="acct-empty">Customer login is being set up and will be available shortly. Meanwhile, please <a href="<?php echo esc_url(home_url('/contact/')); ?>">contact our team</a> for your application status.</div>
    <?php endif; ?>
    <p class="fnote">We only use your name &amp; email to create your account. We never post anything, and never ask for card, account or password details.</p>
  </div>

  <!-- DASHBOARD (shown when logged in) -->
  <div id="acctDash" class="acct-card acct-dash" hidden>
    <div class="dash-head">
      <div class="dash-ava" id="dashAva">U</div>
      <div class="dash-id">
        <strong id="dashName">Customer</strong>
        <span class="dash-email" id="dashEmail"></span>
        <span class="dash-mobile" id="dashMobile"></span>
      </div>
      <button type="button" class="acct-logout" id="custLogout">Logout</button>
    </div>

    <div class="dash-tiles">
      <div class="dash-tile"><span class="dt-ic">&#128176;</span><b data-prod="Personal Loan">0</b><span>Personal Loan</span></div>
      <div class="dash-tile"><span class="dt-ic">&#128179;</span><b data-prod="Credit Card">0</b><span>Credit Card</span></div>
      <div class="dash-tile"><span class="dt-ic">&#128260;</span><b data-prod="Overdraft">0</b><span>Overdraft</span></div>
      <div class="dash-tile"><span class="dt-ic">&#128201;</span><b data-prod="Balance Transfer">0</b><span>Balance Transfer</span></div>
    </div>

    <h2 class="acct-h2">Your applications</h2>
    <div id="dashApps" class="acct-apps"><div class="acct-empty">Loading&hellip;</div></div>

    <h2 class="acct-h2" style="margin-top:24px">Quick actions</h2>
    <div class="dash-actions">
      <a class="dash-act" href="<?php echo esc_url(home_url('/instant-loan/')); ?>"><span>&#9889;</span>Apply for a loan</a>
      <a class="dash-act" href="<?php echo esc_url(home_url('/loan-eligibility/')); ?>"><span>&#9989;</span>Check eligibility</a>
      <a class="dash-act" href="<?php echo esc_url(home_url('/personal-loan/')); ?>"><span>&#127974;</span>Compare offers</a>
      <a class="dash-act" href="https://wa.me/<?php echo esc_attr(loanpt_opt('wa', LOANPT_WA)); ?>"><span>&#128172;</span>Help &amp; support</a>
    </div>
  </div>

</div></section>
<?php if ($gcid): ?><script src="https://accounts.google.com/gsi/client" async defer></script><?php endif; ?>
<?php get_footer(); ?>
