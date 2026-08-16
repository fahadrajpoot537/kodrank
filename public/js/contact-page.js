(function () {
  'use strict';

  // Pill selectors
  document.querySelectorAll('.cp-main .pill-group').forEach(function (group) {
    var isMulti = group.hasAttribute('data-multi');
    var targetId = 'hidden-' + group.getAttribute('data-target');
    var hidden = document.getElementById(targetId);

    var syncHidden = function () {
      var values = Array.prototype.slice
        .call(group.querySelectorAll('.pill.active'))
        .map(function (p) { return p.getAttribute('data-value'); });
      if (hidden) hidden.value = values.join(', ');
      var field = group.closest('.field');
      if (field) field.classList.remove('error');
    };

    group.querySelectorAll('.pill').forEach(function (pill) {
      pill.addEventListener('click', function () {
        if (isMulti) {
          pill.classList.toggle('active');
        } else {
          group.querySelectorAll('.pill').forEach(function (p) { p.classList.remove('active'); });
          pill.classList.add('active');
        }
        syncHidden();
      });
    });

    // Restore active pills from hidden value (old input)
    if (hidden && hidden.value) {
      var selected = hidden.value.split(',').map(function (s) { return s.trim(); });
      group.querySelectorAll('.pill').forEach(function (pill) {
        if (selected.indexOf(pill.getAttribute('data-value')) !== -1) {
          pill.classList.add('active');
        }
      });
    }
  });

  // Clear field errors while typing
  document.querySelectorAll('.cp-main .field input, .cp-main .field textarea').forEach(function (el) {
    el.addEventListener('input', function () {
      var field = el.closest('.field');
      if (field) field.classList.remove('error');
    });
  });

  var form = document.getElementById('contact-form');
  if (!form) return;

  var statusEl = document.getElementById('form-status');
  var submitBtn = document.getElementById('submit-btn');

  var showStatus = function (type, message) {
    if (!statusEl) return;
    statusEl.className = 'form-status show ' + type;
    var icon = type === 'success'
      ? '<svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10l4 4 8-8"/></svg>'
      : '<svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14h.01"/></svg>';
    statusEl.innerHTML = icon + '<span>' + message + '</span>';
  };

  form.addEventListener('submit', function (e) {
    var ok = true;
    ['first_name', 'last_name', 'email'].forEach(function (name) {
      var field = form.querySelector('[data-field="' + name + '"]');
      var input = form.querySelector('[name="' + name + '"]');
      var val = ((input && input.value) || '').trim();
      if (!val) {
        if (field) field.classList.add('error');
        ok = false;
      } else if (field) {
        field.classList.remove('error');
      }
    });

    var emailEl = form.querySelector('[name="email"]');
    if (emailEl && emailEl.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value.trim())) {
      var ef = form.querySelector('[data-field="email"]');
      if (ef) ef.classList.add('error');
      ok = false;
    }

    var consent = document.getElementById('consent');
    if (consent && !consent.checked) {
      showStatus('error', 'Please agree to the privacy policy to continue.');
      ok = false;
    }

    if (!ok) {
      e.preventDefault();
      if (statusEl && !statusEl.classList.contains('show')) {
        showStatus('error', 'Please fill in the required fields highlighted above.');
      }
      return;
    }

    if (submitBtn) {
      submitBtn.disabled = true;
      var label = submitBtn.querySelector('.btn-label');
      if (label) label.textContent = 'Sending...';
    }
  });
})();
