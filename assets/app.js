/* Fire a lead conversion to GA4 + Meta Pixel (no-op until those are configured). */
function loanptLead(src) {
  try { if (window.gtag) gtag('event', 'generate_lead', { event_category: 'lead', event_label: src || 'website' }); } catch (e) {}
  try { if (window.fbq) fbq('track', 'Lead'); } catch (e) {}
}

(function () {
  'use strict';
  var CFG = window.LOANPT || {};

  // Capture & remember a referral code (?ref=...) so it rides along on the lead.
  function loanptRef() {
    try {
      var u = new URLSearchParams(location.search).get('ref');
      if (u) localStorage.setItem('loanpt_ref', u);
      return localStorage.getItem('loanpt_ref') || '';
    } catch (e) { return ''; }
  }
  loanptRef();

  /* ---------- Lead form ---------- */
  var form = document.getElementById('leadForm');
  if (form) {
    var errBox = document.getElementById('err');
    var okBox = document.getElementById('ok');
    var btn = document.getElementById('submitBtn');
    var mobileEl = document.getElementById('mobile');
    var wa = document.getElementById('waLink');
    if (wa && CFG.wa) wa.href = CFG.wa;

    // Add an Email field (lets the customer track the loan online + links it to their account)
    if (!document.getElementById('email')) {
      var mobWrap = mobileEl.closest('.field');
      if (mobWrap && mobWrap.parentNode) {
        var ef = document.createElement('div');
        ef.className = 'field';
        ef.innerHTML = '<label for="email">Email <span style="color:var(--muted);font-weight:400">(track your loan online)</span></label>' +
          '<input id="email" name="email" type="email" autocomplete="email" placeholder="you@email.com">';
        mobWrap.parentNode.insertBefore(ef, mobWrap.nextSibling);
      }
    }
    // Pre-fill known details for a logged-in customer
    try {
      var _p = JSON.parse(localStorage.getItem('loanpt_cust_profile') || '{}') || {};
      var _n = document.getElementById('name'), _e = document.getElementById('email');
      if (_n && _p.name && !_n.value) _n.value = _p.name;
      if (_e && _p.email && !_e.value) _e.value = _p.email;
      if (mobileEl && _p.mobile && !mobileEl.value) mobileEl.value = String(_p.mobile).replace(/\D/g, '').slice(-10);
    } catch (e) {}

    mobileEl.addEventListener('input', function () {
      this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });

    function showErr(m) { if (errBox) { errBox.textContent = m; errBox.style.display = 'block'; } }
    function done() {
      loanptLead('website');
      var redir = form.getAttribute('data-redirect');
      form.style.display = 'none';
      if (okBox) {
        if (redir) {
          var h = okBox.querySelector('h3'), p = okBox.querySelector('p');
          if (h) h.textContent = 'Thank you!';
          if (p) p.textContent = 'Taking you to our partner for instant processing…';
        }
        okBox.style.display = 'block';
      }
      if (redir) setTimeout(function () { location.href = redir; }, 1800);
    }
    function reset() { btn.disabled = false; btn.innerHTML = 'Get my best offer &rarr;'; }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (errBox) errBox.style.display = 'none';
      var name = document.getElementById('name').value.trim();
      var mobile = mobileEl.value.trim();
      if (name.length < 2) return showErr('Please enter your name.');
      if (!/^[6-9]\d{9}$/.test(mobile)) return showErr('Please enter a valid 10-digit mobile number.');
      function fv(id) { var el = document.getElementById(id); return el ? el.value.trim() : ''; }
      var emailVal = fv('email');
      if (emailVal && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(emailVal)) return showErr('Please enter a valid email, or leave it blank.');
      btn.disabled = true; btn.textContent = 'Submitting…';
      var payload = {
        name: name, mobile: mobile,
        product: fv('product'),
        amount: fv('amount'),
        city: fv('city'),
        email: emailVal,
        ref: loanptRef(),
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
  var dragging = false, moved = false, offX = 0, offY = 0, lastX = 0, lastY = 0, lastT = 0, raf = null, placed = false;
  function bounds() { w = fab.offsetWidth; h = fab.offsetHeight; }
  function render() { fab.style.left = x + 'px'; fab.style.top = y + 'px'; fab.style.right = 'auto'; fab.style.bottom = 'auto'; }
  function save() { try { localStorage.setItem('loanpt_wa_pos', JSON.stringify({ left: x, top: y })); } catch (e) {} }

  bounds();
  // Only take over positioning if the user has dragged before (a saved position
  // exists). Otherwise leave the CSS to rest it at bottom-left, above the sticky
  // CTA bar — deriving the start position from getBoundingClientRect() on init was
  // unreliable (landed top-left over the logo on mobile).
  try {
    var s = JSON.parse(localStorage.getItem('loanpt_wa_pos') || 'null');
    if (s && typeof s.left === 'number') {
      x = clamp(s.left, 6, window.innerWidth - w - 6);
      y = clamp(s.top, 6, window.innerHeight - h - 6);
      placed = true; render();
    }
  } catch (e) {}

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
    dragging = true; moved = false; placed = true;
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
  window.addEventListener('resize', function () { if (!placed) return; bounds(); x = clamp(x, 6, window.innerWidth - w - 6); y = clamp(y, 6, window.innerHeight - h - 6); render(); });
})();

/* ---------- Customer account (Google login + dashboard) ---------- */
(function () {
  var loginCard = document.getElementById('acctLogin');
  var dash = document.getElementById('acctDash');
  if (!loginCard || !dash) return;
  var CFG = window.LOANPT || {};
  var API = 'https://loanpt-crm.onrender.com/api/v1';
  var TK = 'loanpt_cust_token', RK = 'loanpt_cust_refresh', PK = 'loanpt_cust_profile';
  function token() { try { return localStorage.getItem(TK); } catch (e) { return null; } }
  function setToken(t) { try { t ? localStorage.setItem(TK, t) : localStorage.removeItem(TK); } catch (e) {} }
  function refreshTok() { try { return localStorage.getItem(RK); } catch (e) { return null; } }
  function setRefresh(t) { try { t ? localStorage.setItem(RK, t) : localStorage.removeItem(RK); } catch (e) {} }
  function parseJwt(t) {
    try {
      var b = t.split('.')[1].replace(/-/g, '+').replace(/_/g, '/');
      return JSON.parse(decodeURIComponent(escape(atob(b))));
    } catch (e) { return {}; }
  }
  var err = document.getElementById('loginErr');
  function showErr(m) { if (err) { err.textContent = m; err.style.display = 'block'; } }
  function clearErr() { if (err) err.style.display = 'none'; }

  // Keep the session alive across the short-lived access token using the refresh token.
  var refreshing = null;
  function doRefresh() {
    var rt = refreshTok();
    if (!rt) return Promise.resolve(false);
    if (refreshing) return refreshing;
    refreshing = fetch(API + '/auth/refresh', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ refreshToken: rt }) })
      .then(function (r) { return r.ok ? r.json() : null; })
      .then(function (d) {
        if (d && d.accessToken) { setToken(d.accessToken); if (d.refreshToken) setRefresh(d.refreshToken); return true; }
        setToken(null); setRefresh(null); return false;
      })
      .catch(function () { return false; })
      .then(function (v) { refreshing = null; return v; });
    return refreshing;
  }
  function api(path, opts) {
    opts = opts || {};
    var baseHeaders = Object.assign({ 'Content-Type': 'application/json' }, opts.headers || {});
    function go() {
      var t = token();
      var h = Object.assign({}, baseHeaders);
      if (t) h.Authorization = 'Bearer ' + t;
      return fetch(API + path, Object.assign({}, opts, { headers: h }));
    }
    return go().then(function (r) {
      if (r.status === 401 && refreshTok()) {
        return doRefresh().then(function (ok) { return ok ? go() : r; });
      }
      return r;
    }).then(function (r) {
      return r.json().catch(function () { return {}; }).then(function (d) { return { ok: r.ok, status: r.status, d: d }; });
    });
  }

  // ----- Google Sign-In -----
  var gcid = loginCard.getAttribute('data-gcid') || '';
  var gbtn = document.getElementById('gbtn');
  function onGoogle(resp) {
    if (!resp || !resp.credential) return;
    clearErr();
    try {
      var p = parseJwt(resp.credential);
      localStorage.setItem(PK, JSON.stringify({ name: p.name, email: p.email, picture: p.picture }));
    } catch (e) {}
    if (gbtn) gbtn.style.opacity = '.5';
    api('/auth/customer/google', { method: 'POST', body: JSON.stringify({ idToken: resp.credential }) }).then(function (res) {
      if (res.ok && res.d && res.d.accessToken) { setToken(res.d.accessToken); setRefresh(res.d.refreshToken || null); load(); }
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
    setToken(null); setRefresh(null);
    try { localStorage.removeItem(PK); } catch (e) {}
    try { if (window.google && google.accounts && google.accounts.id) google.accounts.id.disableAutoSelect(); } catch (e) {}
    location.href = CFG.home || '/';
  });

  function money(n) { if (n == null || n === '') return '—'; return '₹' + Number(n).toLocaleString('en-IN'); }
  function fmtDate(s) { try { return new Date(s).toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' }); } catch (e) { return ''; } }
  function esc(s) { return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); }
  function pill(s) { var k = String(s || '').toLowerCase().replace(/[^a-z_]/g, ''); return '<span class="pill pill-' + k + '">' + esc(String(s || '—').replace(/_/g, ' ')) + '</span>'; }

  // ----- Tabs -----
  var tabs = dash.querySelectorAll('.dtab');
  tabs.forEach(function (t) {
    t.addEventListener('click', function () {
      tabs.forEach(function (x) { x.classList.toggle('is-active', x === t); });
      var name = t.getAttribute('data-tab');
      dash.querySelectorAll('.dpane').forEach(function (p) { p.hidden = p.getAttribute('data-pane') !== name; });
    });
  });

  // ----- Profile completion meter -----
  var curMe = {}, docTypes = {};
  function updateMeter() {
    var items = [
      !!(curMe.fullName && curMe.fullName !== 'Customer'),
      !!(curMe.personalEmail || curMe.email),
      !!curMe.officialEmail,
      !!curMe.address,
      !!curMe.pan,
      !!docTypes.pan,
      !!(docTypes.salary_slip || docTypes.bank_statement)
    ];
    var pct = Math.round(items.filter(Boolean).length / items.length * 100);
    var fill = document.getElementById('pmFill'), pctEl = document.getElementById('pmPct'), hint = document.getElementById('pmHint');
    if (fill) fill.style.width = pct + '%';
    if (pctEl) pctEl.textContent = pct + '%';
    if (hint) hint.textContent = pct >= 100 ? 'Great — your profile is complete! 🎉' : 'Complete your profile & documents to speed up loan approvals.';
  }
  function setVal(id, v) { var el = document.getElementById(id); if (el) el.value = (v == null ? '' : v); }

  // ----- Profile form (save) -----
  var pf = document.getElementById('profileForm');
  if (pf) pf.addEventListener('submit', function (e) {
    e.preventDefault();
    var pfErr = document.getElementById('pfErr'), pfOk = document.getElementById('pfOk');
    if (pfErr) pfErr.style.display = 'none';
    if (pfOk) pfOk.style.display = 'none';
    var pan = (document.getElementById('pfPan').value || '').trim().toUpperCase();
    if (pan && !/^[A-Z]{5}[0-9]{4}[A-Z]$/.test(pan)) {
      if (pfErr) { pfErr.textContent = 'Please enter a valid PAN (e.g. ABCDE1234F).'; pfErr.style.display = 'block'; }
      return;
    }
    var body = {
      fullName: (document.getElementById('pfName').value || '').trim(),
      personalEmail: (document.getElementById('pfPmail').value || '').trim(),
      officialEmail: (document.getElementById('pfOmail').value || '').trim(),
      address: (document.getElementById('pfAddr').value || '').trim(),
      pan: pan
    };
    var btn = document.getElementById('pfSave'); btn.disabled = true; btn.textContent = 'Saving…';
    api('/customer/me', { method: 'PATCH', body: JSON.stringify(body) }).then(function (res) {
      btn.disabled = false; btn.textContent = 'Save changes';
      if (res.ok) {
        curMe.fullName = body.fullName || curMe.fullName;
        curMe.personalEmail = body.personalEmail; curMe.officialEmail = body.officialEmail;
        curMe.address = body.address; curMe.pan = body.pan;
        var nm = document.getElementById('dashName'); if (nm && body.fullName) nm.textContent = body.fullName;
        if (pfOk) pfOk.style.display = 'block';
        updateMeter();
      } else if (pfErr) { pfErr.textContent = (res.d && res.d.message) || 'Could not save. Please try again.'; pfErr.style.display = 'block'; }
    }).catch(function () {
      btn.disabled = false; btn.textContent = 'Save changes';
      if (pfErr) { pfErr.textContent = 'Network error. Please try again.'; pfErr.style.display = 'block'; }
    });
  });

  // ----- Documents (upload + status) -----
  function apiUpload(path, fd) {
    var t = token();
    return fetch(API + path, { method: 'POST', headers: t ? { Authorization: 'Bearer ' + t } : {}, body: fd })
      .then(function (r) { return r.json().catch(function () { return {}; }).then(function (d) { return { ok: r.ok, status: r.status, d: d }; }); });
  }
  function setDocStatus(card, text, done) {
    var s = card.querySelector('.doc-status'); if (s) s.textContent = text;
    card.classList.toggle('is-done', !!done);
    var b = card.querySelector('.doc-up span'); if (b) b.textContent = done ? 'Replace' : 'Upload';
  }
  var grid = document.getElementById('docGrid');
  if (grid) grid.addEventListener('change', function (e) {
    var input = e.target; if (!input || input.type !== 'file') return;
    var card = input.closest('.doc-card'); if (!card) return;
    var type = card.getAttribute('data-type');
    var file = input.files && input.files[0]; if (!file) return;
    if (file.size > 10 * 1024 * 1024) { setDocStatus(card, 'Max file size 10 MB', false); input.value = ''; return; }
    setDocStatus(card, 'Uploading…', false);
    var fd = new FormData(); fd.append('file', file); fd.append('type', type);
    apiUpload('/customer/profile/documents', fd).then(function (res) {
      if (res.ok) { docTypes[type] = true; setDocStatus(card, 'Uploaded ✓', true); updateMeter(); }
      else { setDocStatus(card, 'Upload failed — retry', false); }
    }).catch(function () { setDocStatus(card, 'Upload failed — retry', false); });
    input.value = '';
  });
  function loadDocs() {
    api('/customer/profile/documents').then(function (res) {
      if (!res.ok || !Array.isArray(res.d)) return;
      docTypes = {};
      res.d.forEach(function (d) { docTypes[d.type] = true; });
      Object.keys(docTypes).forEach(function (type) {
        var card = grid && grid.querySelector('.doc-card[data-type="' + type + '"]');
        if (card) setDocStatus(card, 'Uploaded ✓', true);
      });
      updateMeter();
    }).catch(function () {});
  }

  // ----- Application status timeline (WhatsApp-tracking style) -----
  var STAGES = ['Applied', 'In review', 'Documents', 'Bank login', 'Approved', 'Disbursed'];
  function stageIndex(status) {
    var s = String(status || '').toLowerCase();
    if (s === 'rejected' || s === 'dropped' || s === 'closed') return -1;
    var map = { 'new': 0, 'contacted': 1, 'documents_pending': 2, 'documents_received': 2, 'bank_login_done': 3, 'under_process': 3, 'approved': 4, 'disbursed': 5 };
    return map[s] == null ? 0 : map[s];
  }
  function trackHtml(status) {
    var idx = stageIndex(status);
    if (idx === -1) return '<div class="lptrack lptrack-closed">This application is closed. <a href="' + (CFG.home || '/') + 'instant-loan/">Apply again &rarr;</a></div>';
    var out = '<div class="lptrack">';
    for (var i = 0; i < STAGES.length; i++) {
      var cls = i < idx ? 'is-done' : (i === idx ? 'is-now' : '');
      out += '<div class="lpstep ' + cls + '"><i></i><span>' + STAGES[i] + '</span></div>';
    }
    return out + '</div>';
  }

  // ----- Refer & Earn: copy link -----
  var refCopy = document.getElementById('refCopy');
  if (refCopy) refCopy.addEventListener('click', function () {
    var el = document.getElementById('refLink'); if (!el) return;
    el.select(); el.setSelectionRange(0, 99999);
    var done = false;
    try { if (navigator.clipboard) { navigator.clipboard.writeText(el.value); done = true; } } catch (e) {}
    if (!done) { try { document.execCommand('copy'); } catch (e2) {} }
    refCopy.textContent = 'Copied!'; setTimeout(function () { refCopy.textContent = 'Copy'; }, 1500);
  });

  // ----- Deep-link a tab from the URL hash (header menu) -----
  function openHashTab() {
    var h = (location.hash || '').replace('#', '');
    if (!h) return;
    var t = dash.querySelector('.dtab[data-tab="' + h + '"]');
    if (t && !dash.hidden) t.click();
  }
  window.addEventListener('hashchange', openHashTab);

  function load() {
    if (!token() && !refreshTok()) { loginCard.hidden = false; dash.hidden = true; return; }
    var prof = {};
    try { prof = JSON.parse(localStorage.getItem(PK) || '{}') || {}; } catch (e) {}
    api('/customer/me').then(function (res) {
      if (!res.ok) { setToken(null); loginCard.hidden = false; dash.hidden = true; return null; }
      var me = res.d || {};
      var name = me.fullName || prof.name || 'Customer';
      document.getElementById('dashName').textContent = name;
      var emailEl = document.getElementById('dashEmail');
      if (emailEl) emailEl.textContent = me.email || prof.email || '';
      var mobEl = document.getElementById('dashMobile');
      if (mobEl) mobEl.textContent = me.mobile ? ('+91 ' + me.mobile) : '';
      var ava = document.getElementById('dashAva');
      if (ava) {
        if (prof.picture) { ava.innerHTML = '<img referrerpolicy="no-referrer" alt="" src="' + encodeURI(prof.picture) + '">'; }
        else { ava.textContent = (name.trim().charAt(0) || 'U').toUpperCase(); }
      }
      curMe = me;
      try {
        var cp = JSON.parse(localStorage.getItem(PK) || '{}') || {};
        cp.name = me.fullName || cp.name; cp.email = me.email || cp.email; if (me.mobile) cp.mobile = me.mobile;
        localStorage.setItem(PK, JSON.stringify(cp));
      } catch (e) {}
      setVal('pfName', (me.fullName && me.fullName !== 'Customer') ? me.fullName : (prof.name || ''));
      setVal('pfPmail', me.personalEmail || prof.email || '');
      setVal('pfOmail', me.officialEmail || '');
      setVal('pfAddr', me.address || '');
      setVal('pfPan', me.pan || '');
      updateMeter();
      loadDocs();
      loginCard.hidden = true; dash.hidden = false;
      var refLink = document.getElementById('refLink');
      if (refLink && me.id) {
        var link = (CFG.home || (location.origin + '/')) + '?ref=' + encodeURIComponent(me.id);
        refLink.value = link;
        var waBtn = document.getElementById('refWa');
        if (waBtn) waBtn.href = 'https://wa.me/?text=' + encodeURIComponent('Get a personal loan easily with LoanPt — compare offers from every bank, free. Apply here: ' + link);
      }
      openHashTab();
      return api('/customer/applications');
    }).then(function (res) {
      if (!res) return;
      var wrap = document.getElementById('dashApps');
      var apps = Array.isArray(res.d) ? res.d : [];
      var counts = {};
      apps.forEach(function (a) { var p = a.product || 'Other'; counts[p] = (counts[p] || 0) + 1; });
      document.querySelectorAll('.dash-tile b[data-prod]').forEach(function (b) {
        b.textContent = counts[b.getAttribute('data-prod')] || 0;
      });
      if (!apps.length) {
        wrap.innerHTML = '<div class="acct-empty">No applications linked to your account yet.<br>Already applied with our team? Make sure you signed in with the <b>same email</b> you shared with us — or <a href="' + (CFG.home || '/') + 'contact/">contact us</a> to link it. New here? Use a Quick action below to apply.</div>';
        return;
      }
      wrap.innerHTML = apps.map(function (a) {
        var ap = a.application || {};
        var amt = ap.disbursedAt ? ('Disbursed ' + money(ap.approvedAmt != null ? ap.approvedAmt : a.loanAmount))
          : (ap.approvedAmt != null ? ('Approved ' + money(ap.approvedAmt)) : ('Requested ' + money(a.loanAmount)));
        return '<div class="acct-app"><div class="acct-app-top"><strong>' + esc(a.product || 'Loan') + '</strong>' + pill(a.status) + '</div>' +
          '<div class="acct-app-meta">' + (a.referenceCode ? ('Ref ' + esc(a.referenceCode) + ' · ') : '') + fmtDate(a.createdAt) + '</div>' +
          '<div class="acct-app-amt">' + amt + '</div>' + trackHtml(a.status) + '</div>';
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

/* ---------- Header support popup (phone + email) ---------- */
(function () {
  var btn = document.getElementById('hdrSupportBtn');
  var pop = document.getElementById('hdrSupportPop');
  if (!btn || !pop) return;
  function set(open) { pop.hidden = !open; btn.setAttribute('aria-expanded', open ? 'true' : 'false'); }
  btn.addEventListener('click', function (e) { e.stopPropagation(); set(pop.hidden); });
  document.addEventListener('click', function (e) { if (!pop.contains(e.target) && !btn.contains(e.target)) set(false); });
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

/* ---------- Header "My Account" menu (all pages, when logged in) ---------- */
(function () {
  var CFG = window.LOANPT || {};
  var TK = 'loanpt_cust_token', RK = 'loanpt_cust_refresh', PK = 'loanpt_cust_profile';
  var loggedIn = false;
  try { loggedIn = !!(localStorage.getItem(TK) || localStorage.getItem(RK)); } catch (e) {}
  if (!loggedIn) return;
  var navBar = document.querySelector('.nav');
  if (!navBar) return;
  var loginLink = document.getElementById('custLoginLink');
  if (loginLink) loginLink.style.display = 'none';

  var prof = {}; try { prof = JSON.parse(localStorage.getItem(PK) || '{}') || {}; } catch (e) {}
  var first = (prof.name || 'My Account').split(' ')[0];
  var initial = (prof.name || 'U').trim().charAt(0).toUpperCase() || 'U';
  var home = CFG.home || '/';
  var ava = prof.picture
    ? '<span class="am-ava"><img referrerpolicy="no-referrer" alt="" src="' + encodeURI(prof.picture) + '"></span>'
    : '<span class="am-ava">' + initial + '</span>';

  var m = document.createElement('div');
  m.className = 'acctmenu';
  m.innerHTML =
    '<button type="button" class="acctmenu-btn" aria-haspopup="true" aria-expanded="false">' + ava +
      '<span class="am-name">' + first + '</span><span class="am-caret">&#9662;</span></button>' +
    '<div class="acctmenu-pop">' +
      '<a href="' + home + 'customer/#overview">My Applications</a>' +
      '<a href="' + home + 'customer/#profile">My Profile</a>' +
      '<a href="' + home + 'customer/#documents">Documents</a>' +
      '<a href="' + home + 'customer/#refer">Refer &amp; Earn</a>' +
      '<button type="button" class="am-logout">Logout</button>' +
    '</div>';
  var callBtn = navBar.querySelector('.btn-call');
  if (callBtn) navBar.insertBefore(m, callBtn); else navBar.appendChild(m);

  var btn = m.querySelector('.acctmenu-btn');
  function setOpen(o) { m.classList.toggle('open', o); btn.setAttribute('aria-expanded', o ? 'true' : 'false'); }
  btn.addEventListener('click', function (e) { e.stopPropagation(); setOpen(!m.classList.contains('open')); });
  document.addEventListener('click', function (e) { if (!m.contains(e.target)) setOpen(false); });
  m.querySelector('.am-logout').addEventListener('click', function () {
    try { localStorage.removeItem(TK); localStorage.removeItem(RK); localStorage.removeItem(PK); } catch (e) {}
    try { if (window.google && google.accounts && google.accounts.id) google.accounts.id.disableAutoSelect(); } catch (e) {}
    location.href = home;
  });
})();

/* ---------- Header category dropdowns ---------- */
(function () {
  var items = document.querySelectorAll('.nav .menu .mi.has-sub');
  if (!items.length) return;
  items.forEach(function (mi) {
    var top = mi.querySelector('.mi-top');
    if (!top) return;
    top.addEventListener('click', function (e) {
      e.stopPropagation();
      var wasOpen = mi.classList.contains('open');
      items.forEach(function (x) { x.classList.remove('open'); });
      if (!wasOpen) mi.classList.add('open');
    });
  });
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.mi')) items.forEach(function (x) { x.classList.remove('open'); });
  });
})();

/* ---------- Promo carousel ---------- */
(function () {
  var box = document.querySelector('.promo-box');
  if (!box) return;
  var slides = box.querySelectorAll('.promo-slide');
  var dots = box.querySelectorAll('.promo-dots button');
  if (slides.length < 2) return;
  var i = 0, timer = null;
  function show(n) {
    i = (n + slides.length) % slides.length;
    slides.forEach(function (s, k) { s.classList.toggle('is-active', k === i); });
    dots.forEach(function (d, k) { d.classList.toggle('is-on', k === i); });
  }
  function start() { stop(); timer = setInterval(function () { show(i + 1); }, 5000); }
  function stop() { if (timer) { clearInterval(timer); timer = null; } }
  dots.forEach(function (d) {
    d.addEventListener('click', function () { show(+d.getAttribute('data-i')); start(); });
  });
  box.addEventListener('mouseenter', stop);
  box.addEventListener('mouseleave', start);
  show(0); start();
})();

/* ---------- Chat assistant (rule-based + lead capture) ---------- */
(function () {
  var root = document.getElementById('lpchat');
  if (!root) return;
  var CFG = window.LOANPT || {};
  var launch = document.getElementById('lpchatLaunch');
  var panel = document.getElementById('lpchatPanel');
  var closeBtn = document.getElementById('lpchatClose');
  var body = document.getElementById('lpchatBody');
  var quick = document.getElementById('lpchatQuick');

  var LBL = {
    elig: 'Am I eligible?', docs: 'Documents needed', rates: 'Interest rates',
    how: 'How it works', loans: 'Which loans?', fees: 'Fees & charges',
    time: 'How long to get it?', amount: 'How much can I get?', cibil: 'Low credit score?',
    selfemp: "I'm self-employed", rejected: 'Rejected before?', safe: 'Is it safe & free?',
    contact: 'Contact us', more: 'More questions →',
    pl: 'Personal Loan', od: 'Overdraft', bt: 'Balance Transfer',
    callback: '📞 Get a callback', check: '✅ Check eligibility', back: '← Main menu'
  };
  var KB = {
    start: { bot: "Hi! 👋 I'm the LoanPt assistant — here to help with loans. What would you like to know?", replies: ['elig', 'rates', 'docs', 'loans', 'more', 'callback'] },
    more: { bot: "Sure — here are more common questions:", replies: ['fees', 'time', 'amount', 'cibil', 'selfemp', 'rejected', 'safe', 'contact', 'back'] },
    elig: { bot: "You're likely eligible if you're a salaried or self-employed resident of India (18+) with a steady income and a fair credit score. We check your profile across multiple banks — free. Want to see how much you qualify for?", replies: ['check', 'callback', 'back'] },
    docs: { bot: "Usually just: PAN + Aadhaar, recent salary slips (or 2 years' ITR if self-employed), and a 3–6 month bank statement. We tell you the exact list for the bank you qualify for.", replies: ['callback', 'selfemp', 'back'] },
    rates: { bot: "Interest starts around 10.5%* p.a. and is set by the lender based on your profile. We compare offers from every major bank & NBFC to get you the lowest rate you qualify for — at zero cost to you.", replies: ['check', 'fees', 'back'] },
    how: { bot: "3 simple steps:\n1️⃣ Share your details (60 sec)\n2️⃣ We compare banks & find your best offer\n3️⃣ Apply & get funds — we handle the paperwork and keep you updated.", replies: ['callback', 'check', 'back'] },
    loans: { bot: "We arrange these — tap one to know more:", replies: ['pl', 'od', 'bt', 'callback'] },
    pl: { bot: "Personal Loan — collateral-free funds up to ₹50 Lakh for anything (wedding, medical, travel, emergencies). Fixed EMI, quick disbursal. Want our team to find your best offer?", replies: ['callback', 'check', 'back'] },
    od: { bot: "Overdraft (OD) — a sanctioned credit limit you dip into anytime, paying interest only on the amount & days you use. No fixed EMI — great for cash-flow needs.", replies: ['callback', 'check', 'back'] },
    bt: { bot: "Balance Transfer — move your existing loan to a lower interest rate to cut your EMI, often with a top-up for extra funds. We check if it actually saves you money.", replies: ['callback', 'check', 'back'] },
    fees: { bot: "LoanPt is 100% free to you — we're paid by the lender. The bank/NBFC may charge its own processing fee (typically ~0.5%–2% of the loan), shown to you upfront before you proceed. No hidden charges from us.", replies: ['callback', 'rates', 'back'] },
    time: { bot: "It depends on the lender and your documents. With complete papers, many personal loans are approved in 1–3 working days — and our Instant Loan options are even faster. We route you to the bank with the quickest journey for your profile.", replies: ['callback', 'check', 'back'] },
    amount: { bot: "It depends on your income, existing EMIs and credit profile — personal loans go up to ₹50 Lakh+. The quickest way is our free 60-second eligibility check, which gives you an indicative amount instantly.", replies: ['check', 'callback', 'back'] },
    cibil: { bot: "A low credit score makes it harder, but not always impossible — some lenders still consider a fair score with strong income proof. We check multiple banks to find who may approve you, and can guide you on improving your score. Want our team to review your case?", replies: ['callback', 'check', 'back'] },
    selfemp: { bot: "Yes! Self-employed & business owners can apply. You'll usually need 1–2 years' ITR, a 6–12 month current-account statement, and business proof (GST/registration). We match you to lenders comfortable with self-employed profiles.", replies: ['callback', 'docs', 'back'] },
    rejected: { bot: "Don't worry — one bank's rejection doesn't mean all will. We compare multiple lenders and often find a fit, and can tell you what to improve (credit score, income proof, existing EMIs). Shall our team review your case?", replies: ['callback', 'check', 'back'] },
    safe: { bot: "100% safe. LoanPt is free for you, and we never ask for your OTP, card number, CVV or any password. We only use your details to find your best offer and contact you.", replies: ['callback', 'back'] },
    contact: { bot: "Reach our team anytime:\n📞 Call 9625913455\n✉️ connect@loanpt.com\nOr tap 'Get a callback' and we'll call you.", replies: ['callback', 'back'] },
    check: { link: 'loan-eligibility/', bot: "Opening our free 60-second eligibility check… ✅" },
    callback: { bot: "Sure! Share your name & mobile and our team will call you with your best offer. We never ask for OTP, card or passwords. 🔒", form: true },
    back: { bot: "What else can I help with?", replies: ['elig', 'rates', 'docs', 'loans', 'more', 'callback'] }
  };

  function openChat() { panel.hidden = false; launch.classList.add('hidden'); if (!body.childElementCount) go('start'); }
  function closeChat() { panel.hidden = true; launch.classList.remove('hidden'); }
  launch.addEventListener('click', openChat);
  closeBtn.addEventListener('click', closeChat);

  function addMsg(html, who) {
    var m = document.createElement('div'); m.className = 'lpc-msg lpc-' + who;
    m.innerHTML = String(html).replace(/\n/g, '<br>');
    body.appendChild(m); body.scrollTop = body.scrollHeight; return m;
  }
  function setQuick(keys) {
    quick.innerHTML = '';
    (keys || []).forEach(function (k) {
      var b = document.createElement('button'); b.type = 'button'; b.className = 'lpc-qr'; b.textContent = LBL[k] || k;
      b.addEventListener('click', function () { addMsg(LBL[k] || k, 'user'); setQuick([]); go(k); });
      quick.appendChild(b);
    });
  }
  function typing(cb) {
    var t = addMsg('<span class="lpc-dots"><i></i><i></i><i></i></span>', 'bot');
    setTimeout(function () { t.remove(); cb(); }, 480);
  }
  function go(key) {
    var node = KB[key]; if (!node) return;
    if (node.link) { typing(function () { addMsg(node.bot, 'bot'); setTimeout(function () { location.href = (CFG.home || '/') + node.link; }, 650); }); return; }
    typing(function () {
      if (node.bot) addMsg(node.bot, 'bot');
      if (node.form) renderForm(); else setQuick(node.replies);
    });
  }
  function renderForm() {
    var f = document.createElement('form'); f.className = 'lpc-form';
    f.innerHTML = '<input id="lpcName" placeholder="Your name" autocomplete="name"><input id="lpcMob" placeholder="10-digit mobile" inputmode="numeric" maxlength="10" autocomplete="tel"><button type="submit">Request callback &rarr;</button><div class="lpc-err" id="lpcErr"></div>';
    body.appendChild(f); body.scrollTop = body.scrollHeight;
    var mob = f.querySelector('#lpcMob');
    mob.addEventListener('input', function () { this.value = this.value.replace(/\D/g, '').slice(0, 10); });
    f.addEventListener('submit', function (e) {
      e.preventDefault();
      var name = f.querySelector('#lpcName').value.trim(), m = mob.value.trim(), err = f.querySelector('#lpcErr');
      if (name.length < 2) { err.textContent = 'Please enter your name.'; return; }
      if (!/^[6-9]\d{9}$/.test(m)) { err.textContent = 'Enter a valid 10-digit mobile.'; return; }
      var btn = f.querySelector('button'); btn.disabled = true; btn.textContent = 'Sending…';
      var ref = ''; try { ref = localStorage.getItem('loanpt_ref') || ''; } catch (e2) {}
      fetch(CFG.leadUrl, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ name: name, mobile: m, product: 'Personal Loan', tool: 'chatbot', ref: ref }) })
        .then(function () { done(name); }).catch(function () { done(name); });
      function done(nm) { f.remove(); addMsg('Thanks ' + nm + '! ✅ Our team will call you shortly with your best offer.', 'bot'); waOffer(); loanptLead('chatbot'); }
    });
  }
  function waOffer() {
    if (CFG.wa) { var a = document.createElement('a'); a.className = 'lpc-wa'; a.href = CFG.wa; a.target = '_blank'; a.rel = 'noopener'; a.textContent = '💬 Chat on WhatsApp instead'; body.appendChild(a); body.scrollTop = body.scrollHeight; }
    setQuick(['back']);
  }
})();

/* ---------- Generic tool calculators (prepay / BT / eligibility / SIP / FD / GST) ---------- */
(function () {
  var nodes = document.querySelectorAll('.calc[data-calc]');
  if (!nodes.length) return;
  var money = function (n) { return '₹' + Math.round(n).toLocaleString('en-IN'); };
  var num = function (n) { return (+n).toLocaleString('en-IN'); };
  function fmt(v, f) {
    v = +v;
    if (f === 'money') return money(v);
    if (f === 'pct') return v + '%';
    if (f === 'years') return v + (v === 1 ? ' year' : ' years');
    if (f === 'months') return v + ' months';
    return num(v);
  }
  // Indian-system number to words
  var ONES = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
  var TENS = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
  function tw2(n) { if (n === 0) return ''; if (n < 20) return ONES[n]; var t = Math.floor(n / 10), o = n % 10; return TENS[t] + (o ? '-' + ONES[o] : ''); }
  function tw3(n) { var h = Math.floor(n / 100), r = n % 100, s = ''; if (h) s += ONES[h] + ' hundred'; if (r) s += (s ? ' ' : '') + tw2(r); return s; }
  function inWords(n) {
    n = Math.round(n);
    if (n === 0) return 'zero';
    if (n < 0) return 'minus ' + inWords(-n);
    var cr = Math.floor(n / 10000000); n %= 10000000;
    var la = Math.floor(n / 100000); n %= 100000;
    var th = Math.floor(n / 1000); n %= 1000;
    var parts = [];
    if (cr) parts.push((cr > 999 ? inWords(cr) : tw3(cr)) + ' crore');
    if (la) parts.push(tw2(la) + ' lakh');
    if (th) parts.push(tw2(th) + ' thousand');
    if (n) parts.push(tw3(n));
    return parts.join(' ');
  }
  function rupeesWords(n) {
    var r = Math.round(n), w = inWords(r);
    return w.charAt(0).toUpperCase() + w.slice(1) + ' rupee' + (r === 1 ? '' : 's');
  }
  function emiOf(P, annualRate, nMonths) {
    var r = annualRate / 12 / 100;
    return r === 0 ? P / nMonths : (P * r * Math.pow(1 + r, nMonths)) / (Math.pow(1 + r, nMonths) - 1);
  }
  var engines = {
    emi: function (v) {
      var P = v.amount, emi = emiOf(P, v.rate, v.tenure), total = emi * v.tenure, interest = total - P;
      return { mainLabel: 'Your monthly EMI', main: money(emi), mainNum: emi, rows: [
        'Total payable: ' + money(total),
        'Total interest: ' + money(interest) ] };
    },
    prepay: function (v) {
      var P = v.amount, rate = v.rate, N = v.tenure, L = v.prepay;
      var emi = emiOf(P, rate, N), r = rate / 12 / 100;
      var totalInt0 = emi * N - P;
      var Pn = Math.max(0, P - L), newN, newInt;
      if (Pn <= 0) { newN = 0; newInt = 0; }
      else if (r === 0) { newN = Pn / emi; newInt = 0; }
      else { var ratio = 1 - (Pn * r) / emi; newN = ratio <= 0 ? N : -Math.log(ratio) / Math.log(1 + r); newInt = emi * newN - Pn; }
      var saved = Math.max(0, totalInt0 - newInt), monthsSaved = Math.max(0, Math.round(N - newN));
      return { mainLabel: 'Interest you save', main: money(saved), mainNum: saved, rows: [
        'New tenure: ' + Math.ceil(newN) + ' months (' + monthsSaved + ' months shorter)',
        'Interest without prepayment: ' + money(totalInt0),
        'Interest after prepayment: ' + money(newInt) ] };
    },
    bt: function (v) {
      var O = v.amount, emiCur = emiOf(O, v.crate, v.tenure), emiNew = emiOf(O, v.nrate, v.tenure);
      var monthlySave = emiCur - emiNew, totalSave = monthlySave * v.tenure;
      return { mainLabel: totalSave >= 0 ? 'You could save' : 'Extra cost', main: money(Math.abs(totalSave)), mainNum: Math.abs(totalSave), rows: [
        'New EMI: ' + money(emiNew) + ' (' + (monthlySave >= 0 ? 'down ' : 'up ') + money(Math.abs(monthlySave)) + '/month)',
        'Current EMI: ' + money(emiCur),
        'Over ' + v.tenure + ' months remaining' ] };
    },
    eligibility: function (v, cfg) {
      var foir = (cfg && cfg.foir) || 0.5;
      var capacity = Math.max(0, v.income * foir - v.emi), r = v.rate / 12 / 100, N = v.tenure;
      var loan = r === 0 ? capacity * N : capacity * (Math.pow(1 + r, N) - 1) / (r * Math.pow(1 + r, N));
      return { mainLabel: 'You may be eligible for', main: money(loan), mainNum: loan, rows: [
        'Max affordable EMI: ' + money(capacity),
        'At ' + v.rate + '% for ' + N + ' months',
        'Based on ~' + Math.round(foir * 100) + '% of income (FOIR)' ] };
    },
    sip: function (v) {
      var M = v.monthly, i = v.rate / 12 / 100, n = v.years * 12;
      var mat = i === 0 ? M * n : M * (Math.pow(1 + i, n) - 1) / i * (1 + i), invested = M * n;
      return { mainLabel: 'Estimated maturity value', main: money(mat), mainNum: mat, rows: [
        'You invest: ' + money(invested),
        'Est. returns: ' + money(mat - invested),
        'Over ' + v.years + ' years' ] };
    },
    fd: function (v) {
      var A = v.amount * Math.pow(1 + (v.rate / 400), 4 * v.years);
      return { mainLabel: 'Maturity value', main: money(A), mainNum: A, rows: [
        'Principal: ' + money(v.amount),
        'Interest earned: ' + money(A - v.amount),
        'Over ' + v.years + ' years (quarterly compounding)' ] };
    },
    gst: function (v) {
      var tax = v.amount * v.gst / 100;
      return { mainLabel: 'Total (incl. GST)', main: money(v.amount + tax), mainNum: v.amount + tax, rows: [
        'GST (' + v.gst + '%): ' + money(tax),
        'Base amount: ' + money(v.amount) ] };
    }
  };
  nodes.forEach(function (box) {
    var engine = engines[box.getAttribute('data-calc')];
    if (!engine) return;
    var cfg = {}; try { cfg = JSON.parse(box.getAttribute('data-cfg') || '{}'); } catch (e) {}
    var sliders = box.querySelectorAll('input[data-role]');
    var mainLabelEl = box.querySelector('[data-main-label]'), mainEl = box.querySelector('[data-main]'), rowsEl = box.querySelector('[data-rows]');
    var vals = {};
    sliders.forEach(function (sl) { vals[sl.getAttribute('data-role')] = parseFloat(sl.value); });
    function wordsEl(sl) {
      var ctrl = sl.closest ? sl.closest('.ctrl') : null; if (!ctrl) return null;
      var w = ctrl.querySelector('.calc-words');
      if (!w) { w = document.createElement('div'); w.className = 'calc-words'; ctrl.appendChild(w); }
      return w;
    }
    function render(skipRole) {
      sliders.forEach(function (sl) {
        var role = sl.getAttribute('data-role'), f = sl.getAttribute('data-fmt');
        var disp = box.querySelector('.val[data-val="' + role + '"]');
        if (disp && role !== skipRole && document.activeElement !== disp) {
          if ('value' in disp) disp.value = fmt(vals[role], f); else disp.textContent = fmt(vals[role], f);
        }
        if (f === 'money') { var w = wordsEl(sl); if (w) w.textContent = vals[role] > 0 ? rupeesWords(vals[role]) : ''; }
      });
      var out = engine(vals, cfg);
      if (mainLabelEl) mainLabelEl.textContent = out.mainLabel;
      if (mainEl) {
        mainEl.textContent = out.main;
        var mw = box.querySelector('[data-main-words]');
        if (!mw) { mw = document.createElement('div'); mw.className = 'calc-words-main'; mw.setAttribute('data-main-words', ''); mainEl.insertAdjacentElement('afterend', mw); }
        mw.textContent = (typeof out.mainNum === 'number' && isFinite(out.mainNum)) ? rupeesWords(out.mainNum) : '';
      }
      if (rowsEl) rowsEl.innerHTML = out.rows.map(function (r) { return '<span>' + r + '</span>'; }).join('<br>');
    }
    sliders.forEach(function (sl) {
      sl.addEventListener('input', function () { vals[sl.getAttribute('data-role')] = parseFloat(sl.value); render(); });
    });
    // Free-hand typing: no upper limit — type any amount; slider tracks (capped visually).
    box.querySelectorAll('input.val[data-val]').forEach(function (inp) {
      var role = inp.getAttribute('data-val'), sl = box.querySelector('input[data-role="' + role + '"]');
      if (!sl) return;
      inp.addEventListener('input', function () {
        var raw = inp.value.replace(/[^0-9.]/g, '');
        if (raw === '' || raw === '.') return;
        var numv = parseFloat(raw);
        if (isNaN(numv)) return;
        var mn = parseFloat(sl.min); if (numv < mn) numv = mn;
        vals[role] = numv;
        var mx = parseFloat(sl.max); sl.value = numv > mx ? mx : numv;
        render(role);
      });
      inp.addEventListener('blur', function () { render(); });
      inp.addEventListener('change', function () { render(); });
      inp.addEventListener('focus', function () { inp.select(); });
    });
    render();
  });
})();

/* ---------- Sticky CTA + exit-intent lead popup ---------- */
(function () {
  var modal = document.getElementById('lpModal');
  if (!modal) return;
  // Don't show the loan lead popup on the Careers page (job seekers, not borrowers).
  if (/tpl-career/.test(document.body.className)) { modal.hidden = true; return; }
  var CFG = window.LOANPT || {};
  function ls(k, v) { try { if (v === undefined) return localStorage.getItem(k); localStorage.setItem(k, v); } catch (e) { return null; } }
  var src = 'exit_popup';
  function open(from) {
    if (document.body.getAttribute('data-lpmodal') === 'open') return;
    src = from || 'exit_popup';
    document.body.setAttribute('data-lpmodal', 'open');
    modal.hidden = false;
    var n = document.getElementById('lpmName'); if (n) { try { n.focus(); } catch (e) {} }
  }
  function close() { modal.hidden = true; document.body.removeAttribute('data-lpmodal'); }
  var x = document.getElementById('lpModalX'); if (x) x.addEventListener('click', close);
  var ov = document.getElementById('lpModalOv'); if (ov) ov.addEventListener('click', close);
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
  var sc = document.getElementById('lpStickyCta'); if (sc) sc.addEventListener('click', function () { open('sticky_cta'); });

  function canExit() { return ls('loanpt_lead_done') !== '1' && ls('loanpt_exit_shown') !== '1'; }
  if (canExit()) {
    var armed = false;
    setTimeout(function () { armed = true; }, 4000);
    document.addEventListener('mouseout', function (e) {
      if (!armed || !canExit()) return;
      if (e.clientY <= 0 && !e.relatedTarget) { ls('loanpt_exit_shown', '1'); open('exit_popup'); }
    });
    var mobileFired = false;
    function mobileTry() {
      if (mobileFired || !armed || !canExit() || window.innerWidth > 760) return;
      mobileFired = true; ls('loanpt_exit_shown', '1'); open('exit_popup');
    }
    window.addEventListener('scroll', function () {
      var sp = (window.scrollY + window.innerHeight) / (document.body.scrollHeight || 1);
      if (sp > 0.55) mobileTry();
    }, { passive: true });
    setTimeout(mobileTry, 32000);
  }

  var f = document.getElementById('lpModalForm');
  if (f) f.addEventListener('submit', function (e) {
    e.preventDefault();
    var errBox = document.getElementById('lpModalErr');
    if (errBox) errBox.style.display = 'none';
    var name = document.getElementById('lpmName').value.trim();
    var mobile = document.getElementById('lpmMobile').value.replace(/\D/g, '');
    var product = document.getElementById('lpmProduct').value;
    function err(m) { if (errBox) { errBox.textContent = m; errBox.style.display = 'block'; } }
    if (name.length < 2) { err('Please enter your name.'); return; }
    if (mobile.length !== 10) { err('Please enter a valid 10-digit mobile number.'); return; }
    var btn = document.getElementById('lpmSubmit'); btn.disabled = true; btn.textContent = 'Sending…';
    var ref = ''; try { ref = localStorage.getItem('loanpt_ref') || ''; } catch (e2) {}
    fetch(CFG.leadUrl, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ name: name, mobile: mobile, product: product, tool: src, ref: ref }) })
      .then(done).catch(done);
    function done() {
      ls('loanpt_lead_done', '1');
      f.hidden = true;
      var ok = document.getElementById('lpModalOk'); if (ok) ok.hidden = false;
      if (typeof loanptLead === 'function') loanptLead(src);
    }
  });
})();
