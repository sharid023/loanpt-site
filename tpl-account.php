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

    <div class="dash-tabs">
      <button type="button" class="dtab is-active" data-tab="overview">Overview</button>
      <button type="button" class="dtab" data-tab="profile">My Profile</button>
      <button type="button" class="dtab" data-tab="documents">Documents</button>
    </div>

    <!-- OVERVIEW -->
    <div class="dpane" data-pane="overview">
      <div class="pmeter">
        <div class="pmeter-top"><span>Profile completeness</span><b id="pmPct">0%</b></div>
        <div class="pmeter-bar"><i id="pmFill"></i></div>
        <p class="pmeter-hint" id="pmHint">Complete your profile &amp; documents to speed up loan approvals.</p>
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

    <!-- MY PROFILE -->
    <div class="dpane" data-pane="profile" hidden>
      <form id="profileForm" novalidate>
        <div class="field"><label for="pfName">Full name</label><input id="pfName" name="fullName" type="text" placeholder="Your full name"></div>
        <div class="row2">
          <div class="field"><label for="pfPmail">Personal email</label><input id="pfPmail" name="personalEmail" type="email" placeholder="you@gmail.com"></div>
          <div class="field"><label for="pfOmail">Official / work email</label><input id="pfOmail" name="officialEmail" type="email" placeholder="you@company.com"></div>
        </div>
        <div class="field"><label for="pfAddr">Address</label><textarea id="pfAddr" name="address" rows="2" placeholder="House, street, area, city, PIN code"></textarea></div>
        <div class="field"><label for="pfPan">PAN number</label><input id="pfPan" name="pan" type="text" maxlength="10" placeholder="ABCDE1234F" style="text-transform:uppercase"></div>
        <div class="err" id="pfErr"></div>
        <div class="ok2" id="pfOk">&#9989; Profile saved successfully.</div>
        <button type="submit" class="btn btn-pri" id="pfSave" style="width:100%;justify-content:center">Save changes</button>
      </form>
    </div>

    <!-- DOCUMENTS -->
    <div class="dpane" data-pane="documents" hidden>
      <p class="doc-note">&#128274; Your documents are encrypted and used only to process your loan with the lender. We never post or sell them — and never ask for OTP, card or password details.</p>
      <div class="doc-grid" id="docGrid">
        <div class="doc-card" data-type="pan"><div class="doc-ic">&#129534;</div><div class="doc-info"><strong>PAN Card</strong><span class="doc-status">Not uploaded</span></div><label class="doc-up"><input type="file" accept="image/*,application/pdf" hidden><span>Upload</span></label></div>
        <div class="doc-card" data-type="aadhaar"><div class="doc-ic">&#128196;</div><div class="doc-info"><strong>Aadhaar Card</strong><span class="doc-status">Not uploaded</span></div><label class="doc-up"><input type="file" accept="image/*,application/pdf" hidden><span>Upload</span></label></div>
        <div class="doc-card" data-type="salary_slip"><div class="doc-ic">&#128181;</div><div class="doc-info"><strong>Salary Slip</strong><span class="doc-status">Not uploaded</span></div><label class="doc-up"><input type="file" accept="image/*,application/pdf" hidden><span>Upload</span></label></div>
        <div class="doc-card" data-type="bank_statement"><div class="doc-ic">&#127974;</div><div class="doc-info"><strong>Bank Statement</strong><span class="doc-status">Not uploaded</span></div><label class="doc-up"><input type="file" accept="image/*,application/pdf" hidden><span>Upload</span></label></div>
      </div>
    </div>
  </div>

</div></section>
<?php if ($gcid): ?><script src="https://accounts.google.com/gsi/client" async defer></script><?php endif; ?>
<?php get_footer(); ?>
