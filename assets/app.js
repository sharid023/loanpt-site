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
