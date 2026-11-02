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
        wrap.innerHTML = '<div class="acct-empty">No applications yet. Use a Quick action below to apply — we\'ll find you the best offer.</div>';
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
    '<div class="acctmenu-pop" hidden>' +
      '<a href="' + home + 'customer/#overview">My Applications</a>' +
      '<a href="' + home + 'customer/#profile">My Profile</a>' +
      '<a href="' + home + 'customer/#documents">Documents</a>' +
      '<a href="' + home + 'customer/#refer">Refer &amp; Earn</a>' +
      '<button type="button" class="am-logout">Logout</button>' +
    '</div>';
  var callBtn = navBar.querySelector('.btn-call');
  if (callBtn) navBar.insertBefore(m, callBtn); else navBar.appendChild(m);

  var btn = m.querySelector('.acctmenu-btn'), pop = m.querySelector('.acctmenu-pop');
  function setOpen(o) { pop.hidden = !o; btn.setAttribute('aria-expanded', o ? 'true' : 'false'); m.classList.toggle('open', o); }
  btn.addEventListener('click', function (e) { e.stopPropagation(); setOpen(pop.hidden); });
  document.addEventListener('click', function (e) { if (!m.contains(e.target)) setOpen(false); });
  m.querySelector('.am-logout').addEventListener('click', function () {
    try { localStorage.removeItem(TK); localStorage.removeItem(RK); localStorage.removeItem(PK); } catch (e) {}
    try { if (window.google && google.accounts && google.accounts.id) google.accounts.id.disableAutoSelect(); } catch (e) {}
    location.href = home;
  });
})();
