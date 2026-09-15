(function () {
  'use strict';
  if (!document.body.classList.contains('page-offpage')) return;

  function cardsOf(track) {
    if (track.classList.contains('grid-cards')) {
      return Array.prototype.slice.call(track.querySelectorAll(':scope > .svc, :scope > article'));
    }
    if (track.classList.contains('why-grid')) {
      return Array.prototype.slice.call(track.querySelectorAll(':scope > .feat'));
    }
    return Array.prototype.slice.call(track.children).filter(function (el) {
      return el.nodeType === 1 && !el.classList.contains('testi-dots') && !el.classList.contains('offpage-svc-dots');
    });
  }

  function ensureShell(track) {
    if (track.parentElement && track.parentElement.classList.contains('why-mobile-carousel')) {
      return track.parentElement;
    }
    var shell = document.createElement('div');
    shell.className = 'why-mobile-carousel';
    track.parentElement.insertBefore(shell, track);
    shell.appendChild(track);
    return shell;
  }

  function isMobile() {
    try {
      return window.matchMedia('(max-width: 980px)').matches;
    } catch (e) {
      return (window.innerWidth || 0) <= 980;
    }
  }

  function bind(track) {
    if (!track || track.dataset.offpageDotsV2 === '1') return;
    var cards = cardsOf(track);
    if (cards.length < 2) return;
    track.dataset.offpageDotsV2 = '1';
    track.setAttribute('data-thm-carousel', '1');

    var shell = ensureShell(track);

    // Remove leftover sibling dots from older inits (avoid duplicates)
    var sib = shell.nextElementSibling;
    while (sib && (sib.classList.contains('thm-carousel-dots') || sib.classList.contains('thm-carousel-nav-wrap') || sib.classList.contains('testi-dots'))) {
      var next = sib.nextElementSibling;
      sib.remove();
      sib = next;
    }

    var dots = shell.querySelector(':scope > .offpage-svc-dots');
    if (!dots) {
      dots = document.createElement('div');
      dots.className = 'offpage-svc-dots testi-dots thm-carousel-dots';
      dots.setAttribute('role', 'tablist');
      dots.setAttribute('aria-label', 'Carousel slides');
      cards.forEach(function (_, i) {
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'testi-dot' + (i === 0 ? ' is-active' : '');
        btn.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
        dots.appendChild(btn);
      });
      shell.appendChild(dots);
    }

    var index = 0;
    function cardLeft(card) {
      return card.getBoundingClientRect().left - track.getBoundingClientRect().left + track.scrollLeft;
    }
    function sync() {
      var show = isMobile() || track.scrollWidth > track.clientWidth + 8;
      dots.hidden = false;
      dots.removeAttribute('hidden');
      dots.style.setProperty('display', show ? 'flex' : 'none', 'important');
      if (show) track.classList.add('thm-mobile-carousel');
      else track.classList.remove('thm-mobile-carousel');
      Array.prototype.forEach.call(dots.querySelectorAll('.testi-dot'), function (d, i) {
        var on = i === index;
        d.classList.toggle('is-active', on);
        d.setAttribute('aria-selected', on ? 'true' : 'false');
      });
    }
    function goTo(i) {
      var card = cards[i];
      if (!card) return;
      index = i;
      track.scrollTo({ left: cardLeft(card), behavior: 'smooth' });
      sync();
    }

    Array.prototype.forEach.call(dots.querySelectorAll('.testi-dot'), function (btn, i) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        goTo(i);
      });
    });

    track.addEventListener(
      'scroll',
      function () {
        var left = track.scrollLeft;
        var best = 0;
        var bestDist = Infinity;
        cards.forEach(function (card, i) {
          var dist = Math.abs(cardLeft(card) - left);
          if (dist < bestDist) {
            bestDist = dist;
            best = i;
          }
        });
        index = best;
        sync();
      },
      { passive: true }
    );

    sync();
    window.addEventListener('resize', function () {
      setTimeout(sync, 80);
    });
  }

  function run() {
    document
      .querySelectorAll(
        '.offpage-theme-page #services .grid-cards, .offpage-theme-page .sec-ink .why-grid, .offpage-theme-page .sec.sec-ink .why-grid'
      )
      .forEach(bind);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      run();
      setTimeout(run, 50);
      setTimeout(run, 400);
      setTimeout(run, 1000);
    });
  } else {
    run();
    setTimeout(run, 50);
    setTimeout(run, 400);
    setTimeout(run, 1000);
  }
  window.addEventListener('load', function () {
    setTimeout(run, 100);
  });
})();
