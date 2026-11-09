<?php
/* Template Name: LoanPt Career */
if (!defined('ABSPATH')) exit;
get_header();

$roles = array(
    array('Tele-caller / Tele-sales Executive', 'Call warm leads, explain loan options honestly, and book applications. Great for confident communicators.'),
    array('Loan Sales Executive / Relationship Manager', 'Own the customer journey from enquiry to disbursal. Build relationships, hit targets, earn strong incentives.'),
    array('Field Sales Executive', 'Meet customers across Noida & NCR, collect documents and close loans. Travel allowance + incentives.'),
    array('Team Leader — Sales', 'Lead, train and grow a team of loan executives. For experienced sales performers ready to manage.'),
    array('Digital Marketing Executive', 'Run social media, campaigns and content that bring in leads. Help build our digital-first brand.'),
    array('HR / Admin Executive', 'Hiring, onboarding and smooth office operations. Keep the engine running.'),
    array('Connector / DSA Partner (commission)', 'Bring loan leads and earn per disbursal — flexible, work on your own terms. Perfect as a side income.'),
);
$apply_url = esc_url(rest_url('loanpt/v1/apply'));
?>
<style>
  .car-why{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:6px}
  .car-why .w{background:#fff;border:1px solid var(--line);border-radius:14px;padding:18px}
  .car-why .w .ic{font-size:26px}
  .car-why .w h3{font-size:16px;margin:8px 0 5px;color:var(--green2)}
  .car-why .w p{color:var(--muted);font-size:13.5px}
  .jobs{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-top:6px}
  .job{background:#fff;border:1px solid var(--line);border-radius:14px;padding:18px 20px;display:flex;flex-direction:column}
  .job h3{font-size:17px;color:var(--green2);margin:0 0 6px}
  .job p{color:var(--muted);font-size:14px;flex:1;margin:0}
  .job .apply{margin-top:12px;align-self:flex-start;background:var(--mint-soft);color:var(--mint2);font-weight:700;font-size:13.5px;border:none;border-radius:9px;padding:9px 15px;cursor:pointer;font-family:inherit}
  .job .apply:hover{background:var(--mint);color:#06281a}
  .car-form{background:#fff;border:1px solid var(--line);border-radius:18px;padding:26px;max-width:620px;margin:0 auto;box-shadow:0 10px 34px rgba(20,63,41,.07)}
  .car-form .fld{margin-bottom:14px}
  .car-form label{display:block;font-weight:700;font-size:13.5px;margin-bottom:6px;color:var(--ink)}
  .car-form label .opt{color:var(--muted);font-weight:500}
  .car-form input,.car-form select,.car-form textarea{width:100%;min-width:0;padding:12px 14px;border:1.5px solid var(--line);border-radius:11px;font-size:15px;font-family:inherit;background:#fff;color:var(--ink)}
  .car-form input:focus,.car-form select:focus,.car-form textarea:focus{outline:none;border-color:var(--mint)}
  .car-form textarea{resize:vertical;min-height:90px}
  .car-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
  .car-form .btn-pri{width:100%;margin-top:6px}
  .car-note{text-align:center;color:var(--muted);font-size:13px;margin-top:14px}
  .car-msg{display:none;padding:12px 14px;border-radius:11px;font-size:14px;margin-bottom:14px}
  .car-msg.err{display:block;background:#fdecea;color:#b3261e;border:1px solid #f5c6c0}
  .car-ok{display:none;text-align:center;padding:30px 10px}
  .car-ok .big{font-size:46px}
  .car-ok h3{font-size:22px;color:var(--green2);margin:10px 0 6px}
  .car-ok p{color:var(--muted)}
  @media(max-width:760px){
    .car-why{grid-template-columns:1fr 1fr}
    .jobs{grid-template-columns:1fr}
  }
  @media(max-width:480px){
    .car-why{grid-template-columns:1fr}
    .car-row{grid-template-columns:1fr}
    .car-form{padding:20px 16px}
  }
</style>

<section class="hero" style="padding:0"><div class="wrap" style="display:block;padding:48px 18px 40px">
  <span class="eyebrow">We're hiring</span>
  <h1 style="margin:14px 0 10px">Careers at LoanPt</h1>
  <p class="lead" style="max-width:62ch">India ki digital-first loan company bana rahe hain — Noida se. Agar tum tez, honest aur growth-hungry ho, to LoanPt me tumhara swagat hai. Neeche openings dekho aur 2 minute me apply karo.</p>
</div></section>

<section><div class="wrap">
  <div class="sec-head" style="margin-bottom:20px"><div class="kicker">Why LoanPt</div><h2>Yahan kaam kyun karein</h2></div>
  <div class="car-why">
    <div class="w"><div class="ic">&#128640;</div><h3>Fast growth</h3><p>Young, fast-growing company — accha perform karo, jaldi aage badho.</p></div>
    <div class="w"><div class="ic">&#128176;</div><h3>Strong incentives</h3><p>Fixed salary + performance incentives — jitna karoge, utna kamao.</p></div>
    <div class="w"><div class="ic">&#129309;</div><h3>Learning + support</h3><p>Loans, banking aur sales seekho — team poori help karti hai.</p></div>
    <div class="w"><div class="ic">&#127968;</div><h3>Noida-based</h3><p>Office Noida me — local candidates ke liye easy commute.</p></div>
  </div>
</div></section>

<section style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)"><div class="wrap">
  <div class="sec-head" style="margin-bottom:20px"><div class="kicker">Open positions</div><h2>Current openings</h2><p>Jo role fit lage, "Apply" dabao — form me position apne-aap bhar jaayegi.</p></div>
  <div class="jobs">
    <?php foreach ($roles as $r): ?>
      <div class="job">
        <h3><?php echo esc_html($r[0]); ?></h3>
        <p><?php echo esc_html($r[1]); ?></p>
        <button type="button" class="apply" data-pos="<?php echo esc_attr($r[0]); ?>">Apply &rarr;</button>
      </div>
    <?php endforeach; ?>
  </div>
</div></section>

<section id="apply"><div class="wrap">
  <div class="sec-head" style="margin-bottom:20px"><div class="kicker">Apply now</div><h2>Apply in 2 minutes</h2><p>Details bharo — hamari team tumse jaldi sampark karegi.</p></div>

  <form class="car-form" id="carForm" data-url="<?php echo $apply_url; ?>" novalidate>
    <div class="car-msg err" id="carErr"></div>

    <div class="fld">
      <label for="carName">Full name</label>
      <input type="text" id="carName" name="name" autocomplete="name" placeholder="Your name" required>
    </div>

    <div class="car-row">
      <div class="fld">
        <label for="carMobile">Mobile number</label>
        <input type="tel" id="carMobile" name="mobile" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder="10-digit mobile" required>
      </div>
      <div class="fld">
        <label for="carEmail">Email <span class="opt">(optional)</span></label>
        <input type="email" id="carEmail" name="email" autocomplete="email" placeholder="you@email.com">
      </div>
    </div>

    <div class="car-row">
      <div class="fld">
        <label for="carPos">Position</label>
        <select id="carPos" name="position" required>
          <option value="">Select a role</option>
          <?php foreach ($roles as $r): ?>
            <option value="<?php echo esc_attr($r[0]); ?>"><?php echo esc_html($r[0]); ?></option>
          <?php endforeach; ?>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="fld">
        <label for="carExp">Experience</label>
        <select id="carExp" name="experience">
          <option value="Fresher">Fresher</option>
          <option value="0-1 years">0-1 years</option>
          <option value="1-3 years">1-3 years</option>
          <option value="3-5 years">3-5 years</option>
          <option value="5+ years">5+ years</option>
        </select>
      </div>
    </div>

    <div class="car-row">
      <div class="fld">
        <label for="carCity">Current city</label>
        <input type="text" id="carCity" name="city" placeholder="e.g. Noida">
      </div>
      <div class="fld">
        <label for="carResume">Resume / LinkedIn link <span class="opt">(optional)</span></label>
        <input type="url" id="carResume" name="resume" placeholder="Google Drive or LinkedIn URL">
      </div>
    </div>

    <div class="fld">
      <label for="carMsg">Message <span class="opt">(optional)</span></label>
      <textarea id="carMsg" name="message" placeholder="Apne baare me 1-2 line, ya koi sawaal"></textarea>
    </div>

    <button type="submit" class="btn btn-pri" id="carSubmit">Submit application &rarr;</button>
    <p class="car-note">Resume email karna chaahein? <strong><?php echo esc_html(loanpt_opt('email', LOANPT_EMAIL)); ?></strong> par bhej dein (position ke saath).</p>
  </form>

  <div class="car-form car-ok" id="carOk" style="display:none">
    <div class="big">&#127881;</div>
    <h3>Application mil gaya!</h3>
    <p>Shukriya. Hamari team tumhare details review karke jaldi sampark karegi.</p>
  </div>
</div></section>

<script>
(function(){
  var form=document.getElementById('carForm');
  if(!form) return;
  var errBox=document.getElementById('carErr');
  var okBox=document.getElementById('carOk');
  var btn=document.getElementById('carSubmit');
  var url=form.getAttribute('data-url');

  // "Apply" buttons prefill the position + scroll to form
  [].slice.call(document.querySelectorAll('.job .apply')).forEach(function(b){
    b.addEventListener('click',function(){
      var sel=document.getElementById('carPos');
      if(sel){ sel.value=b.getAttribute('data-pos')||''; }
      document.getElementById('apply').scrollIntoView({behavior:'smooth',block:'start'});
      setTimeout(function(){ var n=document.getElementById('carName'); if(n) n.focus(); },400);
    });
  });

  function showErr(m){ errBox.textContent=m; errBox.style.display='block'; }
  function hideErr(){ errBox.style.display='none'; }

  form.addEventListener('submit',function(e){
    e.preventDefault();
    hideErr();
    var name=(document.getElementById('carName').value||'').trim();
    var mobile=(document.getElementById('carMobile').value||'').replace(/\D/g,'');
    var pos=(document.getElementById('carPos').value||'').trim();
    if(name.length<2){ showErr('Apna naam likhein.'); return; }
    if(!/^[6-9]\d{9}$/.test(mobile)){ showErr('Sahi 10-digit mobile number likhein.'); return; }
    if(!pos){ showErr('Position select karein.'); return; }

    var data={
      name:name, mobile:mobile, position:pos,
      email:(document.getElementById('carEmail').value||'').trim(),
      experience:(document.getElementById('carExp').value||'').trim(),
      city:(document.getElementById('carCity').value||'').trim(),
      resume:(document.getElementById('carResume').value||'').trim(),
      message:(document.getElementById('carMsg').value||'').trim()
    };
    btn.disabled=true; var orig=btn.textContent; btn.textContent='Submitting...';
    fetch(url,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(data)})
      .then(function(r){return r.json().catch(function(){return {ok:true};});})
      .then(function(res){
        if(res && res.ok===false){ showErr(res.error||'Kuch galat hua, dobara try karein.'); btn.disabled=false; btn.textContent=orig; return; }
        form.style.display='none'; okBox.style.display='block';
        okBox.scrollIntoView({behavior:'smooth',block:'center'});
        try{ if(window.loanptLead) window.loanptLead('career'); }catch(e){}
      })
      .catch(function(){ showErr('Network issue — thodi der me dobara try karein, ya email kar dein.'); btn.disabled=false; btn.textContent=orig; });
  });
})();
</script>

<?php get_footer(); ?>
