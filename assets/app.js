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
