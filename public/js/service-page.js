(function () {
  'use strict';

  // Testimonials (DM)
  const track = document.getElementById('testiTrack');
  if (track) {
    const btns = document.querySelectorAll('.testi-nav');
    const updateBtns = () => {
      const prev = document.querySelector('.testi-nav[data-dir="prev"]');
      const next = document.querySelector('.testi-nav[data-dir="next"]');
      if (!prev || !next) return;
      const maxScroll = track.scrollWidth - track.clientWidth;
      prev.disabled = track.scrollLeft <= 2;
      next.disabled = track.scrollLeft >= maxScroll - 2;
    };
    btns.forEach((btn) => {
      btn.addEventListener('click', () => {
        const card = track.querySelector('.testi');
        if (!card) return;
        const gap = 20;
        const dist = card.offsetWidth + gap;
        const dir = btn.dataset.dir === 'next' ? 1 : -1;
        track.scrollBy({ left: dist * dir, behavior: 'smooth' });
      });
    });
    track.addEventListener('scroll', updateBtns, { passive: true });
    window.addEventListener('resize', updateBtns);
    updateBtns();
  }

  document.querySelectorAll('.faq-item').forEach((item) => {
    item.addEventListener('toggle', () => {
      if (item.open) {
        document.querySelectorAll('.faq-item').forEach((other) => {
          if (other !== item) other.open = false;
        });
      }
    });
  });

  // Theme reveal (.reveal → .in)
  try {
    const nodes = document.querySelectorAll('.reveal');
    if (nodes.length && 'IntersectionObserver' in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) {
            e.target.classList.add('in');
            io.unobserve(e.target);
          }
        });
      }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
      nodes.forEach((n) => io.observe(n));
      setTimeout(() => nodes.forEach((n) => n.classList.add('in')), 3500);
    } else {
      nodes.forEach((n) => n.classList.add('in'));
    }
  } catch (e) {}

  const form = document.getElementById('svcContactForm');
  if (form) {
    form.addEventListener('submit', () => {
      const first = (form.querySelector('[name="firstName"]')?.value || '').trim();
      const last = (form.querySelector('[name="lastName"]')?.value || '').trim();
      const nameField = form.querySelector('[name="name"]');
      if (nameField) {
        nameField.value = [first, last].filter(Boolean).join(' ');
      }
    });
  }

  // ─── Service-page card carousels (transform + autoplay) ───
  (function initSpCarousels() {
    const roots = document.querySelectorAll('[data-sp-carousel], [data-svc-carousel].page-svc-carousel');
    if (!roots.length) return;

    const AUTO_MS = 4000;
    let reduce = false;
    try {
      reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    } catch (e) {}

    roots.forEach((root) => {
      if (root.dataset.spReady === '1') return;
      root.dataset.spReady = '1';

      const viewport = root.querySelector('.svc-viewport');
      const trackEl = root.querySelector('.svc-track');
      const slides = Array.prototype.slice.call(root.querySelectorAll('.svc-slide'));
      const prev = root.querySelector('.svc-prev');
      const next = root.querySelector('.svc-next');
      const dotsWrap = root.querySelector('[data-svc-dots]');
      if (!viewport || !trackEl || !slides.length) return;

      const desktopPer = parseInt(root.getAttribute('data-per-desktop') || '3', 10) || 3;
      let per = desktopPer;
      let index = 0;
      let autoTimer = null;
      let slideW = 0;
      let gap = 20;
      let startX = 0;
      let deltaX = 0;
      let dragging = false;
      let didSwipe = false;

      const getPer = () => {
        const w = window.innerWidth || document.documentElement.clientWidth || 0;
        if (w <= 680) return 1;
        if (w <= 900) return Math.min(2, desktopPer);
        return desktopPer;
      };

      const maxIndex = () => Math.max(0, slides.length - per);

      const measure = () => {
        per = getPer();
        root.style.setProperty('--svc-per', String(per));
        const g = parseFloat(window.getComputedStyle(trackEl).gap);
        gap = Number.isFinite(g) && g > 0 ? g : 20;
        // Use real viewport width only — never inflate past what is visible
        let vw = viewport.getBoundingClientRect().width || viewport.clientWidth;
        if (vw < 2) {
          vw = Math.max(200, (root.getBoundingClientRect().width || root.clientWidth) - 56);
        }
        slideW = Math.max(1, (vw - (per - 1) * gap) / per);
        slides.forEach((slide) => {
          slide.style.boxSizing = 'border-box';
          slide.style.setProperty('flex', '0 0 ' + slideW + 'px', 'important');
          slide.style.setProperty('width', slideW + 'px', 'important');
          slide.style.setProperty('min-width', slideW + 'px', 'important');
          slide.style.setProperty('max-width', slideW + 'px', 'important');
        });
        trackEl.style.display = 'flex';
        trackEl.style.flexWrap = 'nowrap';
        trackEl.style.width = slideW * slides.length + gap * Math.max(0, slides.length - 1) + 'px';
        viewport.style.overflow = 'hidden';
      };

      const buildDots = () => {
        if (!dotsWrap) return;
        const pages = Math.ceil(slides.length / Math.max(per, 1));
        dotsWrap.innerHTML = '';
        if (pages <= 1) {
          dotsWrap.hidden = true;
          return;
        }
        dotsWrap.hidden = false;
        for (let i = 0; i < pages; i++) {
          const b = document.createElement('button');
          b.type = 'button';
          b.className = 'svc-dot' + (i === 0 ? ' is-active' : '');
          b.setAttribute('aria-label', 'Go to slide group ' + (i + 1));
          b.addEventListener('click', (e) => {
            e.preventDefault();
            goTo(i * per);
            startAuto();
          });
          dotsWrap.appendChild(b);
        }
      };

      const syncDots = () => {
        if (!dotsWrap) return;
        const dots = dotsWrap.querySelectorAll('.svc-dot');
        const page = Math.floor(index / Math.max(per, 1));
        dots.forEach((d, i) => d.classList.toggle('is-active', i === page));
      };

      const goTo = (i) => {
        if (slideW < 2) measure();
        index = Math.max(0, Math.min(i, maxIndex()));
        trackEl.style.setProperty(
          'transform',
          'translate3d(' + -(index * (slideW + gap)) + 'px,0,0)',
          'important'
        );
        syncDots();
        if (prev) {
          prev.disabled = false;
          prev.removeAttribute('disabled');
        }
        if (next) {
          next.disabled = false;
          next.removeAttribute('disabled');
        }
      };

      const step = (dir) => {
        measure();
        // Move by one card so next/prev always advance; desktop still shows `per` cards
        let i = index + dir;
        if (i > maxIndex()) i = 0;
        if (i < 0) i = maxIndex();
        goTo(i);
        startAuto();
      };

      const stopAuto = () => {
        if (autoTimer) {
          clearInterval(autoTimer);
          autoTimer = null;
        }
      };

      const startAuto = () => {
        stopAuto();
        if (reduce || maxIndex() <= 0) return;
        autoTimer = setInterval(() => {
          if (dragging) return;
          let n = index + 1;
          if (n > maxIndex()) n = 0;
          goTo(n);
        }, AUTO_MS);
      };

      if (prev) {
        prev.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          step(-1);
        });
      }
      if (next) {
        next.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          step(1);
        });
      }

      const onDown = (x) => {
        dragging = true;
        didSwipe = false;
        startX = x;
        deltaX = 0;
        stopAuto();
        trackEl.style.transition = 'none';
      };
      const onMove = (x) => {
        if (!dragging) return;
        deltaX = x - startX;
        if (Math.abs(deltaX) > 8) didSwipe = true;
        trackEl.style.setProperty(
          'transform',
          'translate3d(' + -(index * (slideW + gap) - deltaX) + 'px,0,0)',
          'important'
        );
      };
      const onUp = () => {
        if (!dragging) return;
        dragging = false;
        trackEl.style.transition = '';
        if (Math.abs(deltaX) > 40) step(deltaX < 0 ? 1 : -1);
        else {
          goTo(index);
          startAuto();
        }
        deltaX = 0;
      };

      if (window.PointerEvent) {
        trackEl.addEventListener('pointerdown', (e) => {
          if (e.pointerType === 'mouse' && e.button !== 0) return;
          onDown(e.clientX);
          try {
            trackEl.setPointerCapture(e.pointerId);
          } catch (err) {}
        });
        trackEl.addEventListener('pointermove', (e) => onMove(e.clientX));
        trackEl.addEventListener('pointerup', onUp);
        trackEl.addEventListener('pointercancel', onUp);
      } else {
        trackEl.addEventListener(
          'touchstart',
          (e) => {
            if (e.touches && e.touches[0]) onDown(e.touches[0].clientX);
          },
          { passive: true }
        );
        trackEl.addEventListener(
          'touchmove',
          (e) => {
            if (dragging && e.touches && e.touches[0]) {
              onMove(e.touches[0].clientX);
              if (didSwipe && e.cancelable) e.preventDefault();
            }
          },
          { passive: false }
        );
        trackEl.addEventListener('touchend', onUp);
        trackEl.addEventListener('touchcancel', onUp);
      }

      trackEl.addEventListener(
        'click',
        (e) => {
          if (didSwipe) {
            e.preventDefault();
            e.stopPropagation();
            didSwipe = false;
          }
        },
        true
      );

      let canHover = false;
      try {
        canHover = window.matchMedia('(hover:hover) and (pointer:fine)').matches;
      } catch (e) {}
      if (canHover) {
        root.addEventListener('mouseenter', stopAuto);
        root.addEventListener('mouseleave', startAuto);
      }

      const refresh = () => {
        measure();
        buildDots();
        goTo(Math.min(index, maxIndex()));
        startAuto();
      };

      window.addEventListener('resize', () => setTimeout(refresh, 120));
      window.addEventListener('orientationchange', () => setTimeout(refresh, 200));
      refresh();
      requestAnimationFrame(() => {
        refresh();
        setTimeout(refresh, 300);
      });
      window.addEventListener('load', () => setTimeout(refresh, 80));
    });
  })();
})();
