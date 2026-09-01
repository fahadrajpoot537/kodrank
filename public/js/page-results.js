(function () {
  var reduce = false;
  try {
    reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  } catch (e) {}

  var reveal = document.querySelectorAll('.page-results .reveal');
  if ('IntersectionObserver' in window && !reduce) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add('in');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.14 });
    for (var i = 0; i < reveal.length; i++) io.observe(reveal[i]);
  } else {
    for (var r = 0; r < reveal.length; r++) reveal[r].classList.add('in');
  }

  var badges = document.querySelectorAll('.page-results [data-badge]');
  if ('IntersectionObserver' in window && !reduce) {
    var bio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add('in');
          bio.unobserve(e.target);
        }
      });
    }, { threshold: 0.3 });
    for (var b = 0; b < badges.length; b++) bio.observe(badges[b]);
  } else {
    for (var bb = 0; bb < badges.length; bb++) badges[bb].classList.add('in');
  }

  function countUp(el) {
    var t = parseFloat(el.dataset.count);
    var dec = parseInt(el.dataset.dec || '0', 10);
    var suf = el.dataset.suffix || '';
    var dur = 1400;
    var s = performance.now();
    function tick(n) {
      var p = Math.min((n - s) / dur, 1);
      p = 1 - Math.pow(1 - p, 3);
      el.textContent = (t * p).toFixed(dec) + suf;
      if (p < 1) requestAnimationFrame(tick);
      else el.textContent = t.toFixed(dec) + suf;
    }
    requestAnimationFrame(tick);
  }

  var counters = document.querySelectorAll('.page-results [data-count]');
  if ('IntersectionObserver' in window) {
    var cio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (!e.isIntersecting) return;
        var el = e.target;
        if (el.dataset.count) {
          if (reduce) {
            el.textContent = parseFloat(el.dataset.count).toFixed(el.dataset.dec || 0) + (el.dataset.suffix || '');
          } else {
            countUp(el);
          }
        }
        cio.unobserve(el);
      });
    }, { threshold: 0.6 });
    for (var c = 0; c < counters.length; c++) cio.observe(counters[c]);
  }
})();
