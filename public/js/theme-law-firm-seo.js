/**
 * Law Firm SEO page only.
 * Process steps: 3-up / 2-up from CSS. Phones (≤640px) use the swipe-up stack.
 */
(function () {
  if (!document.body.classList.contains('page-lawseo')) return;

  var qas = document.querySelectorAll('.law-theme-page .qa');
  qas.forEach(function (d) {
    d.addEventListener('toggle', function () {
      if (!d.open) return;
      qas.forEach(function (o) {
        if (o !== d) o.open = false;
      });
    });
  });

  var steps = document.querySelector('.law-theme-page #process .steps');
  if (!steps) return;

  var mobileQuery = window.matchMedia('(max-width: 640px)');

  function enableStack() {
    steps.classList.add('page-svc-stack');
    steps.setAttribute('data-sp-stack', '');
    var section = steps.closest('section');
    if (section) section.classList.add('has-page-svc-stack');
    Array.prototype.forEach.call(steps.children, function (child) {
      if (!child.classList || !child.classList.contains('step')) return;
      var wrap = document.createElement('div');
      wrap.className = 'svc-stack-item';
      steps.insertBefore(wrap, child);
      wrap.appendChild(child);
    });
    var items = steps.querySelectorAll(':scope > .svc-stack-item');
    Array.prototype.forEach.call(items, function (item, i) {
      item.style.setProperty('--index', String(i + 1));
      item.style.setProperty('--index0', String(i));
    });
    steps.style.setProperty('--numcards', String(items.length));
  }

  function disableStack() {
    var wraps = steps.querySelectorAll(':scope > .svc-stack-item');
    Array.prototype.forEach.call(wraps, function (wrap) {
      var face = wrap.querySelector('.step');
      if (face) {
        face.style.removeProperty('transform');
        face.style.removeProperty('opacity');
        steps.insertBefore(face, wrap);
      }
      wrap.remove();
    });
    steps.classList.remove('page-svc-stack');
    steps.removeAttribute('data-sp-stack');
    steps.style.removeProperty('--numcards');
    var section = steps.closest('section');
    if (section && !section.querySelector('.page-svc-stack')) {
      section.classList.remove('has-page-svc-stack');
    }
  }

  function sync() {
    if (mobileQuery.matches) {
      if (!steps.classList.contains('page-svc-stack')) enableStack();
      return;
    }
    if (steps.classList.contains('page-svc-stack')) disableStack();
  }

  sync();
  if (typeof mobileQuery.addEventListener === 'function') {
    mobileQuery.addEventListener('change', sync);
  } else if (typeof mobileQuery.addListener === 'function') {
    mobileQuery.addListener(sync);
  }
})();
