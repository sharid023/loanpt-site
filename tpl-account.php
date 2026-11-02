<?php
/* Template Name: LoanPt Customer Account */
if (!defined('ABSPATH')) exit;
get_header();
$gcid = defined('LOANPT_GOOGLE_CLIENT_ID') ? LOANPT_GOOGLE_CLIENT_ID : loanpt_opt('google_client_id', '');
?>
<section class="acct"><div class="wrap" style="max-width:540px">

  <!-- LOGIN (shown when logged out) -->
  <div id="acctLogin" class="acct-card" data-gcid="<?php echo esc_attr($gcid); ?>">
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
  <div id="acctDash" class="acct-card" hidden>
    <div class="acct-top">
      <div><span class="acct-hi">Welcome back,</span><strong id="dashName">Customer</strong></div>
      <button type="button" class="acct-logout" id="custLogout">Logout</button>
    </div>
    <div class="acct-stats">
      <div class="acct-stat"><b id="dashCount">0</b><span>Applications</span></div>
      <div class="acct-stat"><b id="dashMobile">&mdash;</b><span>Mobile</span></div>
    </div>
    <h2 class="acct-h2">Your applications</h2>
    <div id="dashApps" class="acct-apps"><div class="acct-empty">Loading&hellip;</div></div>
    <a class="btn btn-pri" href="<?php echo esc_url(home_url('/instant-loan/')); ?>" style="width:100%;justify-content:center;margin-top:14px">Apply for a new loan &rarr;</a>
    <a class="acct-help" href="https://wa.me/<?php echo esc_attr(loanpt_opt('wa', LOANPT_WA)); ?>">Need help? Chat with our team on WhatsApp</a>
  </div>

</div></section>
<?php if ($gcid): ?><script src="https://accounts.google.com/gsi/client" async defer></script><?php endif; ?>
<?php get_footer(); ?>
