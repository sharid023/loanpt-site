(function () {
  'use strict';
  var CFG = window.LOANPT || {};

  /* ---------- Lead form ---------- */
  var form = document.getElementById('leadForm');
  if (form) {
    var errBox = document.getElementById('err');
    var okBox = document.getElementById('ok');
    var btn = document.getElementById('submitBtn');
    var mobileEl = document.getElementById('mobile');
    var wa = document.getElementById('waLink');
    if (wa && CFG.wa) wa.href = CFG.wa;

    mobileEl.addEventListener('input', function () {
      this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });

    function showErr(m) { if (errBox) { errBox.textContent = m; errBox.style.display = 'block'; } }
    function done() { form.style.display = 'none'; if (okBox) okBox.style.display = 'block'; }
    function reset() { btn.disabled = false; btn.innerHTML = 'Get my best offer &rarr;'; }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (errBox) errBox.style.display = 'none';
      var name = document.getElementById('name').value.trim();
      var mobile = mobileEl.value.trim();
      if (name.length < 2) return showErr('Please enter your name.');
      if (!/^[6-9]\d{9}$/.test(mobile)) return showErr('Please enter a valid 10-digit mobile number.');
      btn.disabled = true; btn.textContent = 'Submitting…';
      var payload = {
        name: name, mobile: mobile,
        product: document.getElementById('product').value,
        amount: document.getElementById('amount').value.trim(),
        city: document.getElementById('city').value.trim(),
        tool: 'wp_home'
      };
      fetch(CFG.leadUrl, {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      }).then(function (r) { return r.json().catch(function () { return {}; }); })
        .then(function (d) { if (d && d.ok !== false) { done(); } else { showErr((d && d.error) || 'Something went wrong. Please call 9625913455.'); reset(); } })
        .catch(function () { done(); });
    });
  }

  /* ---------- EMI calculator ---------- */
  var amt = document.getElementById('amt'), rate = document.getElementById('rate'), ten = document.getElementById('ten');
  if (amt && rate && ten) {
    var fmt = function (n) { return '₹' + Math.round(n).toLocaleString('en-IN'); };
    function calc() {
      var P = +amt.value, R = (+rate.value) / 12 / 100, N = +ten.value;
      var emi = R === 0 ? P / N : (P * R * Math.pow(1 + R, N)) / (Math.pow(1 + R, N) - 1);
      var total = emi * N, interest = total - P;
      document.getElementById('amtOut').textContent = fmt(P);
      document.getElementById('rateOut').textContent = (+rate.value) + '%';
      document.getElementById('tenOut').textContent = N + ' months';
      document.getElementById('emiOut').textContent = fmt(emi);
      document.getElementById('totOut').textContent = 'Total payable: ' + fmt(total);
      document.getElementById('intOut').textContent = 'Total interest: ' + fmt(interest);
    }
    [amt, rate, ten].forEach(function (el) { el.addEventListener('input', calc); });
    calc();
  }
})();

/* ---------- Flingable (slingshot) WhatsApp button ---------- */
(function () {
  var fab = document.querySelector('.wa-float');
  if (!fab) return;
  var clamp = function (v, a, b) { return Math.max(a, Math.min(b, v)); };
  var w = 60, h = 60, x = 0, y = 0, vx = 0, vy = 0;
  var dragging = false, moved = false, offX = 0, offY = 0, lastX = 0, lastY = 0, lastT = 0, raf = null;
  function bounds() { w = fab.offsetWidth; h = fab.offsetHeight; }
  function render() { fab.style.left = x + 'px'; fab.style.top = y + 'px'; fab.style.right = 'auto'; fab.style.bottom = 'auto'; }
  function save() { try { localStorage.setItem('loanpt_wa_pos', JSON.stringify({ left: x, top: y })); } catch (e) {} }

  bounds();
  var r0 = fab.getBoundingClientRect(); x = r0.left; y = r0.top;
  try { var s = JSON.parse(localStorage.getItem('loanpt_wa_pos') || 'null'); if (s && typeof s.left === 'number') { x = s.left; y = s.top; } } catch (e) {}
  x = clamp(x, 6, window.innerWidth - w - 6); y = clamp(y, 6, window.innerHeight - h - 6); render();

  function animate() {
    vx *= 0.93; vy *= 0.93;          // friction
    x += vx; y += vy;
    var mx = window.innerWidth - w - 6, my = window.innerHeight - h - 6;
    if (x < 6) { x = 6; vx = -vx * 0.62; }       // bounce off walls
    if (x > mx) { x = mx; vx = -vx * 0.62; }
    if (y < 6) { y = 6; vy = -vy * 0.62; }
    if (y > my) { y = my; vy = -vy * 0.62; }
    render();
    if (Math.abs(vx) > 0.35 || Math.abs(vy) > 0.35) { raf = requestAnimationFrame(animate); }
    else { raf = null; save(); }
  }

  fab.addEventListener('pointerdown', function (e) {
    dragging = true; moved = false;
    if (raf) { cancelAnimationFrame(raf); raf = null; }
    bounds();
    var r = fab.getBoundingClientRect(); x = r.left; y = r.top;
    offX = e.clientX - x; offY = e.clientY - y;
    lastX = e.clientX; lastY = e.clientY; lastT = Date.now(); vx = 0; vy = 0;
    fab.style.transition = 'none';
    try { fab.setPointerCapture(e.pointerId); } catch (e2) {}
  });
  fab.addEventListener('pointermove', function (e) {
    if (!dragging) return;
    if (Math.abs(e.clientX - lastX) > 3 || Math.abs(e.clientY - lastY) > 3) moved = true;
    var t = Date.now(), dt = Math.max(t - lastT, 1);
    vx = (e.clientX - lastX) / dt * 16; vy = (e.clientY - lastY) / dt * 16;  // velocity for the fling
    lastX = e.clientX; lastY = e.clientY; lastT = t;
    x = clamp(e.clientX - offX, 6, window.innerWidth - w - 6);
    y = clamp(e.clientY - offY, 6, window.innerHeight - h - 6);
    render();
  });
  function end() {
    if (!dragging) return;
    dragging = false; fab.style.transition = '';
    if (moved) {
      vx = clamp(vx, -45, 45); vy = clamp(vy, -45, 45);   // cap launch speed
      if (!raf) raf = requestAnimationFrame(animate);      // fling!
    }
  }
  fab.addEventListener('pointerup', end);
  fab.addEventListener('pointercancel', end);
  fab.addEventListener('click', function (e) { if (moved) { e.preventDefault(); moved = false; } });
  window.addEventListener('resize', function () { bounds(); x = clamp(x, 6, window.innerWidth - w - 6); y = clamp(y, 6, window.innerHeight - h - 6); render(); });
})();

/* ---------- Customer account (Google login + dashboard) ---------- */
(function () {
  var loginCard = document.getElementById('acctLogin');
  var dash = document.getElementById('acctDash');
  if (!loginCard || !dash) return;
  var API = 'https://loanpt-crm.onrender.com/api/v1';
  var TK = 'loanpt_cust_token';
  function token() { try { return localStorage.getItem(TK); } catch (e) { return null; } }
  function setToken(t) { try { t ? localStorage.setItem(TK, t) : localStorage.removeItem(TK); } catch (e) {} }
  var err = document.getElementById('loginErr');
  function showErr(m) { if (err) { err.textContent = m; err.style.display = 'block'; } }
  function clearErr() { if (err) err.style.display = 'none'; }

  function api(path, opts) {
    opts = opts || {};
    opts.headers = Object.assign({ 'Content-Type': 'application/json' }, opts.headers || {});
    var t = token(); if (t) opts.headers.Authorization = 'Bearer ' + t;
    return fetch(API + path, opts).then(function (r) {
      return r.json().catch(function () { return {}; }).then(function (d) { return { ok: r.ok, status: r.status, d: d }; });
    });
  }

  // ----- Google Sign-In -----
  var gcid = loginCard.getAttribute('data-gcid') || '';
  var gbtn = document.getElementById('gbtn');
  function onGoogle(resp) {
    if (!resp || !resp.credential) return;
    clearErr();
    if (gbtn) gbtn.style.opacity = '.5';
    api('/auth/customer/google', { method: 'POST', body: JSON.stringify({ idToken: resp.credential }) }).then(function (res) {
      if (res.ok && res.d && res.d.accessToken) { setToken(res.d.accessToken); load(); }
      else { if (gbtn) gbtn.style.opacity = '1'; showErr((res.d && res.d.message) || 'Google sign-in failed. Please try again.'); }
    }).catch(function () { if (gbtn) gbtn.style.opacity = '1'; showErr('Network error. Please try again.'); });
  }
  function initGoogle() {
    if (!(window.google && google.accounts && google.accounts.id)) return false;
    google.accounts.id.initialize({ client_id: gcid, callback: onGoogle, ux_mode: 'popup' });
    google.accounts.id.renderButton(gbtn, { theme: 'outline', size: 'large', shape: 'pill', text: 'continue_with', logo_alignment: 'center', width: 300 });
    return true;
  }
  if (gcid && gbtn && !token()) {
    var tries = 0;
    var iv = setInterval(function () { if (initGoogle() || ++tries > 40) clearInterval(iv); }, 150);
  }

  // ----- Logout -----
  var logoutBtn = document.getElementById('custLogout');
  if (logoutBtn) logoutBtn.addEventListener('click', function () {
    setToken(null);
    try { if (window.google && google.accounts && google.accounts.id) google.accounts.id.disableAutoSelect(); } catch (e) {}
    dash.hidden = true; loginCard.hidden = false;
  });

  function money(n) { if (n == null || n === '') return '—'; return '₹' + Number(n).toLocaleString('en-IN'); }
  function fmtDate(s) { try { return new Date(s).toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' }); } catch (e) { return ''; } }
  function esc(s) { return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); }
  function pill(s) { var k = String(s || '').toLowerCase().replace(/[^a-z_]/g, ''); return '<span class="pill pill-' + k + '">' + esc(String(s || '—').replace(/_/g, ' ')) + '</span>'; }

  function load() {
    if (!token()) { loginCard.hidden = false; dash.hidden = true; return; }
    api('/customer/me').then(function (res) {
      if (!res.ok) { setToken(null); loginCard.hidden = false; dash.hidden = true; return null; }
      var me = res.d || {};
      document.getElementById('dashName').textContent = me.fullName || 'Customer';
      document.getElementById('dashCount').textContent = me.applicationCount || 0;
      document.getElementById('dashMobile').textContent = me.mobile || '—';
      loginCard.hidden = true; dash.hidden = false;
      return api('/customer/applications');
    }).then(function (res) {
      if (!res) return;
      var wrap = document.getElementById('dashApps');
      var apps = Array.isArray(res.d) ? res.d : [];
      if (!apps.length) { wrap.innerHTML = '<div class="acct-empty">No applications yet. Tap below to apply — we\'ll find you the best offer.</div>'; return; }
      wrap.innerHTML = apps.map(function (a) {
        var ap = a.application || {};
        var amt = ap.disbursedAt ? ('Disbursed ' + money(ap.approvedAmt != null ? ap.approvedAmt : a.loanAmount))
          : (ap.approvedAmt != null ? ('Approved ' + money(ap.approvedAmt)) : ('Requested ' + money(a.loanAmount)));
        return '<div class="acct-app"><div class="acct-app-top"><strong>' + esc(a.product || 'Loan') + '</strong>' + pill(a.status) + '</div>' +
          '<div class="acct-app-meta">' + (a.referenceCode ? ('Ref ' + esc(a.referenceCode) + ' · ') : '') + fmtDate(a.createdAt) + '</div>' +
          '<div class="acct-app-amt">' + amt + '</div></div>';
      }).join('');
    }).catch(function () {});
  }
  load();
})();

/* ---------- Mobile nav toggle ---------- */
(function () {
  var t = document.getElementById('navtoggle');
  var d = document.getElementById('navdrop');
  if (!t || !d) return;
  function set(open) {
    d.classList.toggle('open', open);
    t.classList.toggle('open', open);
    t.setAttribute('aria-expanded', open ? 'true' : 'false');
    t.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  }
  t.addEventListener('click', function (e) { e.stopPropagation(); set(!d.classList.contains('open')); });
  d.addEventListener('click', function (e) { if (e.target.closest('a')) set(false); });
  document.addEventListener('click', function (e) { if (!d.contains(e.target) && e.target !== t && !t.contains(e.target)) set(false); });
  window.addEventListener('resize', function () { if (window.innerWidth > 860) set(false); });
})();

/* ---------- Eligibility quiz ---------- */
(function () {
  var quiz = document.getElementById('lpquiz');
  if (!quiz) return;
  var steps = quiz.querySelectorAll('.qstep');
  var bar = document.getElementById('qbar');
  var total = steps.length, cur = 1;
  var data = { employment: '', income: 50000, emi: 0, amount: '', city: '' };
  var fmt = function (n) { return Math.round(n).toLocaleString('en-IN'); };

  function show(n) {
    cur = n;
    steps.forEach(function (s) { s.hidden = (parseInt(s.getAttribute('data-step'), 10) !== n); });
    if (bar) bar.style.width = Math.round((n - 1) / (total - 1) * 100) + '%';
    if (n === 5) result();
  }
  function result() {
    var maxEmi = Math.max(0, data.income * 0.5 - data.emi);   // ~50% FOIR
    var loan = maxEmi / 2275 * 100000;                        // ~EMI per lakh at ~13% / 5yr
    loan = Math.min(loan, 5000000);                           // cap at ₹50L
    loan = Math.max(0, Math.round(loan / 10000) * 10000);
    var out = document.getElementById('qresultamt');
    if (out) out.innerHTML = '&#8377;' + fmt(loan);
    var a = document.getElementById('amount'), c = document.getElementById('city');
    if (a) a.value = data.amount || String(loan);
    if (c) c.value = data.city;
  }

  quiz.querySelectorAll('.qopt').forEach(function (b) {
    b.addEventListener('click', function () { data.employment = b.getAttribute('data-val'); show(2); });
  });
  var inc = document.getElementById('qincome'), incOut = document.getElementById('qincomeout');
  if (inc) inc.addEventListener('input', function () { data.income = +inc.value; incOut.textContent = fmt(inc.value); });
  var emi = document.getElementById('qemi'), emiOut = document.getElementById('qemiout');
  if (emi) emi.addEventListener('input', function () { data.emi = +emi.value; emiOut.textContent = fmt(emi.value); });
  quiz.querySelectorAll('.qnext').forEach(function (b) {
    b.addEventListener('click', function () {
      if (cur === 4) {
        data.amount = (document.getElementById('qamount').value || '').replace(/[^\d]/g, '');
        data.city = document.getElementById('qcity').value.trim();
      }
      show(cur + 1);
    });
  });
})();
