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

  // ─── Service-page stacking cards (sticky wrapper + scale on inner face) ───
  (function initSpStacks() {
    const roots = document.querySelectorAll('[data-sp-stack], .page-svc-stack');
    if (!roots.length) return;

    let reduce = false;
    try {
      reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    } catch (e) {}

    const stacks = [];

    const isPairable = (root) =>
      root.classList.contains('page-svc-stack--pair') ||
      !!root.closest('#pain, #problem, #process, .seo-problem');

    const shouldPair = (root) => {
      if (!isPairable(root)) return false;
      const w = window.innerWidth || document.documentElement.clientWidth || 0;
      return w > 680;
    };

    const collectCards = (root) => {
      const track = root.querySelector('.svc-track') || root;
      const found = [];
      const seen = new Set();
      const push = (el) => {
        if (!el || seen.has(el)) return;
        if (
          el.classList.contains('svc-stack-item') ||
          el.classList.contains('svc-stack-pair') ||
          el.classList.contains('svc-nav') ||
          el.classList.contains('svc-dots') ||
          el.classList.contains('svc-viewport') ||
          el.classList.contains('svc-track')
        ) {
          return;
        }
        seen.add(el);
        found.push(el);
      };

      Array.prototype.forEach.call(
        track.querySelectorAll('.svc-stack-pair > *'),
        push
      );
      Array.prototype.forEach.call(
        track.querySelectorAll('.svc-stack-item > *:not(.svc-stack-pair)'),
        push
      );
      Array.prototype.forEach.call(track.children, (child) => {
        if (child.classList.contains('svc-slide') && !child.classList.contains('svc-stack-item')) {
          push(child);
        }
      });
      return found;
    };

    const clearLayout = (root) => {
      const track = root.querySelector('.svc-track') || root;
      const cards = collectCards(root);
      cards.forEach((card) => {
        card.classList.add('svc-slide');
        ['flex', 'width', 'min-width', 'max-width', 'transform'].forEach((prop) => {
          card.style.removeProperty(prop);
        });
        track.appendChild(card);
      });
      Array.prototype.slice
        .call(track.querySelectorAll('.svc-stack-item, .svc-stack-pair'))
        .forEach((el) => el.remove());
      return cards;
    };

    const buildLayout = (root) => {
      const track = root.querySelector('.svc-track') || root;
      const cards = clearLayout(root);
      if (!cards.length) return [];

      const pair = shouldPair(root);
      root.classList.toggle('is-paired', pair);
      root.dataset.spPaired = pair ? '1' : '0';

      const items = [];
      if (pair) {
        for (let i = 0; i < cards.length; i += 2) {
          const wrap = document.createElement('div');
          wrap.className = 'svc-slide svc-stack-item';
          wrap.style.setProperty('--index', String(items.length + 1));
          wrap.style.setProperty('--index0', String(items.length));
          const row = document.createElement('div');
          row.className = 'svc-stack-pair';
          cards[i].classList.remove('svc-slide');
          row.appendChild(cards[i]);
          if (cards[i + 1]) {
            cards[i + 1].classList.remove('svc-slide');
            row.appendChild(cards[i + 1]);
          }
          wrap.appendChild(row);
          track.appendChild(wrap);
          items.push(wrap);
        }
      } else {
        cards.forEach((slide, i) => {
          const wrap = document.createElement('div');
          wrap.className = 'svc-slide svc-stack-item';
          wrap.style.setProperty('--index', String(i + 1));
          wrap.style.setProperty('--index0', String(i));
          slide.classList.remove('svc-slide');
          wrap.appendChild(slide);
          track.appendChild(wrap);
          items.push(wrap);
        });
      }

      root.style.setProperty('--numcards', String(items.length));
      return items;
    };

    roots.forEach((root) => {
      if (root.dataset.spStackReady === '1') return;
      root.dataset.spStackReady = '1';

      root.querySelectorAll('.svc-nav, [data-svc-dots]').forEach((el) => {
        el.hidden = true;
        el.setAttribute('aria-hidden', 'true');
      });

      const items = buildLayout(root);
      if (reduce || !items.length) return;

      stacks.push({
        root: root,
        items: items,
        cardTop: 96,
        cardHeight: 200,
        peek: 14,
        listening: false,
      });
    });

    if (!stacks.length) return;

    const measure = (stack) => {
      const first = stack.items[0];
      if (!first) return;
      const cs = window.getComputedStyle(first);
      const top = parseFloat(cs.top);
      const gap = parseFloat(cs.marginBottom);
      stack.cardTop = Number.isFinite(top) ? top : 96;
      stack.cardHeight = first.offsetHeight || 200;
      stack.peek = Number.isFinite(gap) && gap > 0 ? gap : 20;
    };

    const clearScales = (stack) => {
      stack.items.forEach((item) => {
        const face = item.firstElementChild;
        if (!face) return;
        face.style.removeProperty('transform');
        face.style.removeProperty('opacity');
        face.style.setProperty('opacity', '1', 'important');
      });
    };

    const animate = (stack) => {
      const top = stack.root.getBoundingClientRect().top;
      stack.items.forEach((item, i) => {
        const face = item.firstElementChild;
        if (!face) return;
        // Always fully opaque — scaled cards must cover text underneath
        face.style.setProperty('opacity', '1', 'important');
        face.querySelectorAll('*').forEach((el) => {
          if (el.style && el.style.opacity && el.style.opacity !== '1') {
            el.style.setProperty('opacity', '1', 'important');
          }
        });
        const scrolling = stack.cardTop - top - i * (stack.cardHeight + stack.peek);
        if (scrolling > 0) {
          // Subtle scale only (was 0.85 — looked washed / see-through)
          const scale = Math.max(0.94, (stack.cardHeight - scrolling * 0.03) / stack.cardHeight);
          face.style.setProperty('transform', 'scale(' + scale + ')', 'important');
        } else {
          face.style.removeProperty('transform');
        }
      });
    };

    const active = [];
    let ticking = false;
    const onScroll = () => {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(() => {
        ticking = false;
        active.forEach(animate);
      });
    };

    const start = (stack) => {
      if (stack.listening) return;
      stack.listening = true;
      measure(stack);
      active.push(stack);
      if (active.length === 1) {
        window.addEventListener('scroll', onScroll, { passive: true });
      }
      onScroll();
    };

    const stop = (stack) => {
      if (!stack.listening) return;
      stack.listening = false;
      const i = active.indexOf(stack);
      if (i !== -1) active.splice(i, 1);
      if (!active.length) {
        window.removeEventListener('scroll', onScroll);
      }
    };

    const relayout = (stack) => {
      const want = shouldPair(stack.root) ? '1' : '0';
      if (stack.root.dataset.spPaired === want && stack.items.length) {
        measure(stack);
        if (stack.listening) animate(stack);
        return;
      }
      clearScales(stack);
      stack.items = buildLayout(stack.root);
      measure(stack);
      if (stack.listening) animate(stack);
    };

    stacks.forEach((stack) => {
      if (!('IntersectionObserver' in window)) {
        start(stack);
        return;
      }
      const io = new IntersectionObserver(
        (entries) => {
          if (entries[0] && entries[0].isIntersecting) start(stack);
          else stop(stack);
        },
        { root: null, threshold: 0, rootMargin: '120px 0px' }
      );
      io.observe(stack.root);
    });

    let resizeTimer = null;
    window.addEventListener(
      'resize',
      () => {
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          stacks.forEach(relayout);
        }, 120);
      },
      { passive: true }
    );
  })();

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
      if (root.hasAttribute('data-sp-stack') || root.classList.contains('page-svc-stack')) return;
      if (root.dataset.spReady === '1') return;
      root.dataset.spReady = '1';

      const viewport = root.querySelector('.svc-viewport');
      const trackEl = root.querySelector('.svc-track');
      const slides = Array.prototype.slice.call(root.querySelectorAll('.svc-slide'));
      const prev = root.querySelector('.svc-prev');
      const next = root.querySelector('.svc-next');
      const dotsWrap = root.querySelector('[data-svc-dots]');
      if (!viewport || !trackEl || !slides.length) return;

      if (prev) {
        prev.hidden = true;
        prev.setAttribute('aria-hidden', 'true');
      }
      if (next) {
        next.hidden = true;
        next.setAttribute('aria-hidden', 'true');
      }

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
        let vw = viewport.getBoundingClientRect().width || viewport.clientWidth;
        if (vw < 2) {
          vw = Math.max(200, root.getBoundingClientRect().width || root.clientWidth);
        }
        // Mobile: 1 full card + ~10% of the next card peeking
        if (per === 1) {
          slideW = Math.max(1, (vw - gap) / 1.1);
        } else {
          slideW = Math.max(1, (vw - (per - 1) * gap) / per);
        }
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
