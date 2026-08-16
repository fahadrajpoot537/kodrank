(function () {
  var shell = document.querySelector('.admin-shell');
  var btn = document.getElementById('adminMenuBtn');
  var closeBtn = document.getElementById('adminSideClose');
  var backdrop = document.getElementById('adminBackdrop');

  if (shell && btn) {
    var open = function () {
      shell.classList.add('nav-open');
      document.body.classList.add('admin-nav-open');
      btn.setAttribute('aria-expanded', 'true');
      if (backdrop) backdrop.hidden = false;
    };
    var close = function () {
      shell.classList.remove('nav-open');
      document.body.classList.remove('admin-nav-open');
      btn.setAttribute('aria-expanded', 'false');
      if (backdrop) backdrop.hidden = true;
    };

    btn.addEventListener('click', function () {
      if (shell.classList.contains('nav-open')) close();
      else open();
    });
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (backdrop) backdrop.addEventListener('click', close);

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') close();
    });

    var links = shell.querySelectorAll('.admin-nav a');
    for (var i = 0; i < links.length; i++) {
      links[i].addEventListener('click', function () {
        if (window.innerWidth <= 1024) close();
      });
    }

    window.addEventListener('resize', function () {
      if (window.innerWidth > 1024) close();
    });
  }

  // Dynamic list add / remove
  document.addEventListener('click', function (e) {
    var addBtn = e.target.closest('.js-add-item');
    if (addBtn) {
      e.preventDefault();
      var repeater = addBtn.closest('.js-repeater');
      if (!repeater) return;
      var items = repeater.querySelector('.js-repeater-items');
      var tpl = repeater.querySelector('.js-item-template');
      if (!items || !tpl) return;

      var empty = items.querySelector('.rep-empty');
      if (empty) empty.remove();

      var nextIndex = 0;
      items.querySelectorAll('.rep-item').forEach(function (el) {
        var idx = parseInt(el.getAttribute('data-index'), 10);
        if (!isNaN(idx) && idx >= nextIndex) nextIndex = idx + 1;
      });

      var html = tpl.innerHTML
        .replace(/__INDEX__/g, String(nextIndex))
        .replace(/__NUM__/g, String(nextIndex + 1));

      var wrap = document.createElement('div');
      wrap.innerHTML = html.trim();
      var node = wrap.firstElementChild;
      if (node) items.appendChild(node);
      return;
    }

    var removeBtn = e.target.closest('.js-remove-item');
    if (removeBtn) {
      e.preventDefault();
      var item = removeBtn.closest('.rep-item');
      var parent = item && item.parentElement;
      if (!item || !parent) return;
      item.remove();
      parent.querySelectorAll('.rep-item').forEach(function (el, i) {
        var title = el.querySelector('.rep-head .rep-title');
        if (title) title.textContent = '#' + (i + 1);
      });
      if (!parent.querySelector('.rep-item')) {
        var p = document.createElement('p');
        p.className = 'rep-empty';
        p.textContent = 'No items yet. Click “Add item”.';
        parent.appendChild(p);
      }
    }
  });
})();
