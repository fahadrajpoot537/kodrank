(function () {
  'use strict';

  // Testimonials carousel (DM + any .testi-slider)
  document.querySelectorAll('.testi-slider').forEach((slider) => {
    const track = slider.querySelector('.testi-track') || slider.querySelector('#testiTrack');
    if (!track) return;
    const prev = slider.querySelector('.testi-nav[data-dir="prev"]');
    const next = slider.querySelector('.testi-nav[data-dir="next"]');
    const dotsWrap = slider.querySelector('[data-testi-dots]');
    const cards = () => Array.from(track.querySelectorAll('.testi'));
    const isMobileCarousel = () => {
      try {
        return window.matchMedia('(max-width: 767px)').matches;
      } catch (e) {
        return (window.innerWidth || 0) <= 767;
      }
    };

    const setDotsVisible = () => {
      if (!dotsWrap) return;
      const show = isMobileCarousel() && cards().length > 1;
      dotsWrap.hidden = !show;
      dotsWrap.style.display = show ? 'flex' : 'none';
    };

    const bindDots = () => {
      if (!dotsWrap) return;
      dotsWrap.querySelectorAll('.testi-dot').forEach((btn, i) => {
        if (btn.dataset.testiBound === '1') return;
        btn.dataset.testiBound = '1';
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          const card = cards()[i];
          if (card) {
            track.scrollTo({ left: card.offsetLeft, behavior: 'smooth' });
          }
        });
      });
    };

    const syncDots = () => {
      if (!dotsWrap || dotsWrap.hidden) return;
      const scrollLeft = track.scrollLeft;
      let best = 0;
      let bestDist = Infinity;
      cards().forEach((card, i) => {
        const dist = Math.abs(card.offsetLeft - scrollLeft);
        if (dist < bestDist) {
          bestDist = dist;
          best = i;
        }
      });
      dotsWrap.querySelectorAll('.testi-dot').forEach((d, i) => {
        const active = i === best;
        d.classList.toggle('is-active', active);
        d.setAttribute('aria-selected', active ? 'true' : 'false');
      });
    };

    const step = () => {
      const card = track.querySelector('.testi');
      if (!card) return 0;
      const styles = window.getComputedStyle(track);
      const gap = parseFloat(styles.columnGap || styles.gap) || 20;
      return card.getBoundingClientRect().width + gap;
    };

    const maxScroll = () => Math.max(0, track.scrollWidth - track.clientWidth);

    const go = (dir) => {
      const max = maxScroll();
      if (max <= 4) return;
      let left = track.scrollLeft + step() * dir;
      if (left > max - 4) left = 0;
      else if (left < 4 && dir < 0) left = max;
      track.scrollTo({ left, behavior: 'smooth' });
    };

    const updateBtns = () => {
      const max = maxScroll();
      if (prev) prev.disabled = max <= 4;
      if (next) next.disabled = max <= 4;
      syncDots();
    };

    if (prev) prev.addEventListener('click', () => go(-1));
    if (next) next.addEventListener('click', () => go(1));
    track.addEventListener('scroll', updateBtns, { passive: true });
    window.addEventListener('resize', () => {
      setDotsVisible();
      updateBtns();
    });

    let timer = null;
    const prefersReduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const startAuto = () => {
      stopAuto();
      if (prefersReduce || cards().length < 2) return;
      if (window.innerWidth > 767) return;
      timer = window.setInterval(() => go(1), 5000);
    };
    const stopAuto = () => {
      if (timer) {
        window.clearInterval(timer);
        timer = null;
      }
    };

    slider.addEventListener('pointerenter', stopAuto);
    slider.addEventListener('pointerleave', startAuto);
    track.addEventListener('touchstart', stopAuto, { passive: true });
    track.addEventListener('touchend', startAuto, { passive: true });

    bindDots();
    setDotsVisible();
    updateBtns();
    startAuto();
  });

  document.querySelectorAll('.carousel').forEach((carousel) => {
    const track = carousel.querySelector('.carousel-track');
    if (!track) return;
    const btns = carousel.querySelectorAll('.carousel-nav');
    if (!btns.length) return;
    const cardStep = () => {
      const card = track.firstElementChild;
      if (!card) return 0;
      const styles = window.getComputedStyle(track);
      const gap = parseFloat(styles.columnGap || styles.gap) || 20;
      return card.getBoundingClientRect().width + gap;
    };
    btns.forEach((btn) => {
      btn.addEventListener('click', () => {
        const dir = btn.getAttribute('data-dir') === 'next' ? 1 : -1;
        track.scrollBy({ left: cardStep() * dir, behavior: 'smooth' });
      });
    });
  });

  document.querySelectorAll('.faq-item').forEach((item) => {
    item.addEventListener('toggle', () => {
      if (item.open) {
        document.querySelectorAll('.faq-item').forEach((other) => {
          if (other !== item) other.open = false;
        });
      }
    });
  });

  // Website redesign theme FAQ (.faq > button + .faq-body)
  document.querySelectorAll('.redesign-theme-page .faq > button').forEach((btn) => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq');
      if (!item) return;
      const body = item.querySelector('.faq-body');
      const willOpen = !item.classList.contains('open');
      document.querySelectorAll('.redesign-theme-page .faq.open').forEach((other) => {
        if (other === item) return;
        other.classList.remove('open');
        const p = other.querySelector('.faq-body');
        if (p) p.style.maxHeight = null;
        const ob = other.querySelector('button');
        if (ob) ob.setAttribute('aria-expanded', 'false');
      });
      item.classList.toggle('open', willOpen);
      btn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
      if (body) {
        body.style.maxHeight = willOpen ? body.scrollHeight + 'px' : null;
      }
    });
  });

  // GEO / theme-html FAQ buttons (.faq-q + .faq-a panels)
  document.querySelectorAll('.faq-q').forEach((btn) => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      if (!item) return;
      if (item.tagName === 'DETAILS') return;
      const panel = item.querySelector('.faq-a');
      const willOpen = !item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach((other) => {
        if (other === item) return;
        other.classList.remove('open');
        const p = other.querySelector('.faq-a');
        if (p) p.style.maxHeight = '0';
      });
      item.classList.toggle('open', willOpen);
      if (panel) {
        panel.style.maxHeight = willOpen ? panel.scrollHeight + 'px' : '0';
      }
    });
  });

  // Theme reveal (.reveal / .fade-up / .rv / .rev → .in)
  // WP reference cards are always visible; keep IO but don't leave nodes at opacity:0.
  try {
    const nodes = document.querySelectorAll('.reveal, .fade-up, .rv, .rev');
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
      setTimeout(() => nodes.forEach((n) => n.classList.add('in')), 400);
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

  // ─── Theme-html: mark card grids (WP reference roles) — activate mobile-only ───
  // Reference /wordpress-development-services:
  //   problem-grid → carousel | service-grid → stack | feature-grid → carousel | process-list → stack
  (function prepareThemeHtmlCardBehaviors() {
    const roots = document.querySelectorAll('.theme-html-root, .webdev-ref');
    if (!roots.length) return;

    // Services + process equivalents → scroll-stack
    const STACK_SELS_FULL = [
      '.service-grid',
      '.svc-grid',
      '.serv-grid',
      '.grid-cards',
      '.process-list',
      '.process-grid',
      '.proc-grid',
      '.loop-grid',
      '.steps',
      '.proc:has(> .proc-step)',
      '.proc:has(> .pstep)',
      '.proc:has(> .step)',
      '.grid:has(> .svc)',
      '.grid:has(> .svc-card)',
      '.grid:has(> .step)',
      '.grid:has(> .proc-card)',
      '.grid:has(> .process-card)',
      '#services > .wrap > .grid',
      '#services > .wrap > .grid-cards',
      '#included > .wrap > .grid',
      '#process > .wrap > .grid',
      '#process > .wrap > .proc',
      'section#services .grid.g-3',
      'section#services .grid.g-4',
      'section#services .grid.g3',
      'section#process .grid.g-3',
      'section#process .grid.g-4',
      'section#process .steps',
      'section#included .grid.g-3',
      'section#included .grid.g3',
      'section#included .svc-grid',
      'section#results > .wrap > .svc-grid',
      'section#results .svc-grid',
    ].join(',');

    // Pain/problem + feature/why equivalents → carousel
    const CAROUSEL_SELS_FULL = [
      '.problem-grid',
      '.pain-grid',
      '.pain-list',
      '#why .pain-list',
      '.prob-list',
      '.feature-grid',
      '.why-bg .feature-grid',
      '.why-feats',
      '.why-grid',
      '.plat-grid',
      '.edge-grid',
      '.industry-grid',
      '.ind-grid',
      '.grid:has(> .pain)',
      '.grid.g3:has(> .pain)',
      '.grid.g-3:has(> .pain)',
      '.grid.g-4:has(> .pain)',
      '#problem .grid.g3',
      '#problem .grid.g-3',
      '.grid:has(> .pain-card)',
      '.grid:has(> .feat)',
      '.grid:has(> .why)',
      '.grid:has(> .problem-card)',
      '.grid:has(> .tcard)',
      '.grid.g3:has(> .tcard)',
      '#results .grid:has(> .tcard)',
      '.feat-list:has(> .feat)',
      '.tst-grid',
      '.test-grid',
      '.testi-grid',
      '.tgrid',
      '.grid-cards',
      '#testiTrack',
      '.carousel-track:has(> .testi)',
      '.testi-track',
      '#pain > .wrap > .grid',
      '#problem > .wrap > .grid',
      '#why > .wrap > .grid',
      '#problems .pain-grid',
      '#why .pain-grid',
      'section#pain .grid.g-3',
      'section#pain .grid.g-4',
      '.grid:has(> .quote)',
      '.sec-testi .grid',
      'section#pain .pain-list',
      'section#deliver > .wrap > .grid',
      'section#vetting .grid',
      '.stack-groups',
    ].join(',');

    const STACK_SELS_WP = '.service-grid, .process-list';
    const CAROUSEL_SELS_WP =
      '.problem-grid, .feature-grid, .why-bg .feature-grid, #why-us .why-grid, .why-grid';

    const isEl = (el) => el && el.nodeType === 1;
    const kids = (el) => Array.prototype.filter.call(el.children, isEl);

    const isStatsOnly = (el) => {
      const c = kids(el);
      if (!c.length) return true;
      return c.every((k) =>
        /^(stat|stat-card|stat-tile|metric|intro)/i.test(k.className || '') ||
        k.classList.contains('stat') ||
        k.classList.contains('stat-card') ||
        k.classList.contains('stat-tile') ||
        k.classList.contains('metric')
      );
    };

    const isLayoutComposite = (el) =>
      !!(
        el.querySelector(':scope > .why-feats') ||
        el.querySelector(':scope > .compare') ||
        el.querySelector(':scope > .prob-panel') ||
        el.querySelector(':scope > .prob-list') ||
        el.querySelector(':scope > .head-block') ||
        el.querySelector(':scope > .why-copy') ||
        el.querySelector(':scope > .why-list') ||
        el.querySelector(':scope > .feat-list') ||
        el.querySelector(':scope > .intro-copy') ||
        el.querySelector(':scope > .stats-row') ||
        el.querySelector(':scope > .stats') ||
        (el.classList.contains('why-grid') && el.querySelector('.why-list, .stats-row, .stat, .stats'))
      );

    const SKIP_CAROUSEL_STACK = /(?:^|\s)(intro-grid|contact-grid|contact-wrap|form-grid|form-card|stats-row|stats-grid|stats-bg|cmp-grid|compare-wrap|compare|faq-wrap|faq-list|plat-grid|seo-grid|ct-grid|tech-grid|tech-list|why-wrap|why-copy|carousel-track|testi-track)(?:\s|$)/;

    const isTestiCarousel = (el) =>
      el.id === 'testiTrack' ||
      el.classList.contains('testi-track') ||
      !!(el.classList.contains('carousel-track') && el.querySelector(':scope > .testi, :scope > .testi-card'));

    const isPlatCarousel = (el) =>
      el.classList.contains('plat-grid') && !!el.querySelector(':scope > .plat');

    const skipCommon = (el) => {
      if (!el) return true;
      if (isTestiCarousel(el)) {
        if (kids(el).length < 2) return true;
        return false;
      }
      if (isPlatCarousel(el)) {
        if (kids(el).length < 2) return true;
        return false;
      }
      if (el.classList.contains('why-grid') && el.querySelector('.why-list, .stats-row, .stat, .stats')) return true;
      if (el.classList.contains('carousel-track') || el.classList.contains('testi-track')) return true;
      if (SKIP_CAROUSEL_STACK.test(el.className || '')) return true;
      if (el.querySelector(':scope > .svc-viewport') || el.querySelector(':scope > .svc-track')) return true;
      if (kids(el).length < 2) return true;
      return false;
    };

    Array.prototype.forEach.call(roots, (root) => {
      const isWpOnly =
        root.classList.contains('wpdev-theme-page') && !root.classList.contains('webdev-ref');
      const STACK_SELS = isWpOnly ? STACK_SELS_WP : STACK_SELS_FULL;
      const CAROUSEL_SELS = isWpOnly ? CAROUSEL_SELS_WP : CAROUSEL_SELS_FULL;

      const isOffpage = root.classList.contains('offpage-theme-page');
      const isDmServicesCarousel =
        root.classList.contains('webdev-ref') &&
        document.body.classList.contains('page-dm');
      const seenStack = new Set();
      Array.prototype.forEach.call(root.querySelectorAll(STACK_SELS), (grid) => {
        if (seenStack.has(grid) || skipCommon(grid)) return;
        // Off-page: services + testimonials scroll as carousels (match on-page UX)
        if (isOffpage && grid.classList.contains('grid-cards')) return;
        // Digital marketing blade: #services cards carousel on mobile/tablet
        if (
          isDmServicesCarousel &&
          grid.classList.contains('service-grid') &&
          grid.closest('#services')
        ) {
          return;
        }
        seenStack.add(grid);
        grid.setAttribute('data-thm-stack', '1');
      });

      const markCarousel = (track) => {
        if (seenCar.has(track) || skipCommon(track)) return;
        if (track.hasAttribute('data-thm-stack')) return;
        if (isStatsOnly(track)) return;
        if (isLayoutComposite(track)) return;
        seenCar.add(track);
        track.setAttribute('data-thm-carousel', '1');
      };

      const seenCar = new Set();
      try {
        Array.prototype.forEach.call(root.querySelectorAll(CAROUSEL_SELS), markCarousel);
      } catch (e) {}
      Array.prototype.forEach.call(
        root.querySelectorAll('.testi-grid, .tst-grid, .test-grid, .tgrid, #testiTrack, .testi-track, .carousel-track:has(> .testi), .plat-grid, .grid:has(> .tcard), .grid:has(> .tst), .grid:has(> .prob), .plat'),
        markCarousel
      );

      if (!isWpOnly) {
        Array.prototype.forEach.call(
          root.querySelectorAll('#pain .svc-track, #problem .svc-track, #why .svc-track'),
          (track) => {
            if (kids(track).length < 2) return;
            if (track.closest('#services, #process, #included')) return;
            track.setAttribute('data-thm-carousel', '1');
          }
        );
        Array.prototype.forEach.call(
          root.querySelectorAll('#services .carousel-track, #services .svc-track'),
          (grid) => {
            if (kids(grid).length < 2) return;
            if (grid.hasAttribute('data-thm-carousel')) return;
            grid.setAttribute('data-thm-stack', '1');
          }
        );
        Array.prototype.forEach.call(root.querySelectorAll('.included-grid, #why .why-grid'), markCarousel);
        if (document.body.classList.contains('page-dm')) {
          Array.prototype.forEach.call(root.querySelectorAll('#services .service-grid'), markCarousel);
        }
      }
    });
  })();

  // ─── Service-page stacking cards (sticky wrapper + scale on inner face) ───
  (function initSpStacks() {
    const roots = document.querySelectorAll(
      '[data-sp-stack], .page-svc-stack, [data-thm-stack]'
    );
    if (!roots.length) return;

    let reduce = false;
    try {
      reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    } catch (e) {}

    const stacks = [];

    const isPairable = (root) => {
      // Theme-html: never pair — match WP reference (1 card per sticky layer)
      if (
        root.hasAttribute('data-thm-stack') ||
        root.closest('.theme-html-root') ||
        root.closest('.webdev-ref')
      ) {
        return false;
      }
      return (
        root.classList.contains('page-svc-stack--pair') ||
        !!root.closest('#pain, #problem, #process, .seo-problem')
      );
    };

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
      if (!found.length) {
        Array.prototype.forEach.call(track.children, (child) => {
          if (child.nodeType !== 1) return;
          if (
            child.classList.contains('svc-card') ||
            child.classList.contains('svc') ||
            child.classList.contains('serv-card') ||
            child.classList.contains('feat-card') ||
            child.classList.contains('feat') ||
            child.classList.contains('proc') ||
            child.classList.contains('proc-card') ||
            child.classList.contains('proc-step') ||
            child.classList.contains('process-card') ||
            child.classList.contains('process-step') ||
            child.classList.contains('pstep') ||
            child.classList.contains('step') ||
            child.classList.contains('loop-card') ||
            child.classList.contains('pain-card') ||
            child.classList.contains('pain') ||
            child.classList.contains('feat') ||
            child.classList.contains('feat-card') ||
            child.classList.contains('why') ||
            child.classList.contains('why-card') ||
            child.classList.contains('svc-card') ||
            child.classList.contains('problem-card') ||
            child.classList.contains('testi') ||
            child.classList.contains('tst-card') ||
            child.classList.contains('tcard')
          ) {
            push(child);
          }
        });
      }
      if (!found.length) {
        Array.prototype.forEach.call(track.children, (child) => {
          if (child.nodeType === 1) push(child);
        });
      }
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

    const isDesktop = () => {
      try {
        return window.matchMedia('(min-width: 901px)').matches;
      } catch (e) {
        const w = window.innerWidth || document.documentElement.clientWidth || 0;
        return w > 900;
      }
    };

    roots.forEach((root) => {
      if (root.dataset.spStackReady === '1') return;
      root.dataset.spStackReady = '1';

      const isThm = root.hasAttribute('data-thm-stack');

      root.querySelectorAll('.svc-nav, [data-svc-dots]').forEach((el) => {
        el.hidden = true;
        el.setAttribute('aria-hidden', 'true');
      });

      // Theme-html desktop: leave original DOM untouched (no wrappers)
      if (isThm && isDesktop()) {
        stacks.push({
          root: root,
          items: [],
          cardTop: 96,
          cardHeight: 200,
          peek: 14,
          listening: false,
          themeHtml: true,
        });
        return;
      }

      if (isThm) {
        root.classList.add('page-svc-stack');
        root.setAttribute('data-sp-stack', '');
        Array.prototype.forEach.call(root.children, (child) => {
          if (child.nodeType !== 1) return;
          if (
            child.classList.contains('svc-stack-item') ||
            child.classList.contains('svc-nav') ||
            child.classList.contains('svc-dots')
          ) {
            return;
          }
          child.classList.add('svc-slide');
        });
        const section = root.closest('section');
        if (section) section.classList.add('has-page-svc-stack');
      }

      const items = buildLayout(root);
      if (reduce || !items.length) return;

      stacks.push({
        root: root,
        items: items,
        cardTop: 96,
        cardHeight: 200,
        peek: 14,
        listening: false,
        themeHtml: isThm,
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
      // Desktop: static grid only — no sticky-scale animation
      if (isDesktop()) {
        clearScales(stack);
        return;
      }
      if (!stack.items.length) return;
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
      if (isDesktop()) {
        stack.root.classList.add('is-desktop-static');
        clearScales(stack);
        return;
      }
      stack.root.classList.remove('is-desktop-static');
      if (!stack.items.length) return;
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

    const activateThemeHtmlMobile = (stack) => {
      const root = stack.root;
      root.classList.add('page-svc-stack');
      root.setAttribute('data-sp-stack', '');
      Array.prototype.forEach.call(root.children, (child) => {
        if (child.nodeType !== 1) return;
        if (child.classList.contains('svc-stack-item')) return;
        child.classList.add('svc-slide');
      });
      const section = root.closest('section');
      if (section) section.classList.add('has-page-svc-stack');
      stack.items = buildLayout(root);
    };

    const deactivateThemeHtmlDesktop = (stack) => {
      clearScales(stack);
      if (stack.items.length) {
        clearLayout(stack.root);
        stack.items = [];
      }
      stack.root.classList.remove('page-svc-stack', 'is-paired', 'is-desktop-static');
      stack.root.removeAttribute('data-sp-stack');
      stack.root.style.removeProperty('--numcards');
      delete stack.root.dataset.spPaired;
      // Keep has-page-svc-stack off when inactive
      const section = stack.root.closest('section');
      if (section && !section.querySelector('.page-svc-stack')) {
        section.classList.remove('has-page-svc-stack');
      }
      stop(stack);
    };

    const relayout = (stack) => {
      if (stack.themeHtml || stack.root.hasAttribute('data-thm-stack')) {
        if (isDesktop()) {
          deactivateThemeHtmlDesktop(stack);
          return;
        }
        if (!stack.items.length) {
          activateThemeHtmlMobile(stack);
        } else {
          const want = shouldPair(stack.root) ? '1' : '0';
          if (stack.root.dataset.spPaired !== want) {
            clearScales(stack);
            stack.items = buildLayout(stack.root);
          } else {
            measure(stack);
          }
        }
        if (stack.listening) animate(stack);
        else start(stack);
        return;
      }

      if (isDesktop()) {
        stack.root.classList.add('is-desktop-static');
        clearScales(stack);
        stop(stack);
        return;
      }
      stack.root.classList.remove('is-desktop-static');
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

      // Desktop (>900): static grid. Mobile/tablet: carousel.
      // Use matchMedia so DevTools device mode matches CSS breakpoints.
      const isDesktopGrid = () => {
        try {
          return window.matchMedia('(min-width: 901px)').matches;
        } catch (e) {
          const w = window.innerWidth || document.documentElement.clientWidth || 0;
          return w > 900;
        }
      };

      const getPer = () => {
        try {
          if (window.matchMedia('(max-width: 680px)').matches) return 1;
          if (window.matchMedia('(max-width: 900px)').matches) {
            return Math.min(2, desktopPer);
          }
          return desktopPer;
        } catch (e) {
          const w = window.innerWidth || document.documentElement.clientWidth || 0;
          if (w <= 680) return 1;
          if (w <= 900) return Math.min(2, desktopPer);
          return desktopPer;
        }
      };

      const maxIndex = () => Math.max(0, slides.length - per);

      const syncNav = () => {
        const mobileScroll =
          root.hasAttribute('data-sp-mobile-scroll') && !isDesktopGrid();
        const show = !isDesktopGrid() && !mobileScroll && maxIndex() > 0;
        [prev, next].forEach((btn) => {
          if (!btn) return;
          btn.hidden = !show;
          btn.style.display = show ? '' : 'none';
          btn.setAttribute('aria-hidden', show ? 'false' : 'true');
        });
      };

      const clearCarouselStyles = () => {
        trackEl.style.removeProperty('transform');
        trackEl.style.removeProperty('width');
        trackEl.style.removeProperty('display');
        trackEl.style.removeProperty('flex-wrap');
        trackEl.style.removeProperty('transition');
        viewport.style.removeProperty('overflow');
        slides.forEach((slide) => {
          slide.style.removeProperty('flex');
          slide.style.removeProperty('width');
          slide.style.removeProperty('min-width');
          slide.style.removeProperty('max-width');
          slide.style.removeProperty('box-sizing');
        });
      };

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
          slideW = Math.max(1, vw - gap);
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

      const applyDesktopGrid = () => {
        root.classList.remove('is-mobile-scroll');
        root.classList.add('is-desktop-grid');
        stopAuto();
        stopScrollAuto();
        clearCarouselStyles();
        trackEl.style.removeProperty('transform');
        viewport.style.removeProperty('overflow-x');
        viewport.style.removeProperty('scroll-snap-type');
        root.style.setProperty('--svc-per', String(desktopPer));
        if (dotsWrap) {
          dotsWrap.hidden = true;
          dotsWrap.innerHTML = '';
        }
        syncNav();
      };

      const applyCarousel = () => {
        root.classList.remove('is-desktop-grid');
        root.classList.remove('is-mobile-scroll');
        stopScrollAuto();
        // Clear any desktop inline --svc-per so CSS/mobile measure wins
        root.style.removeProperty('--svc-per');
        measure();
        buildDots();
        goTo(Math.min(index, maxIndex()));
        startAuto();
        syncNav();
      };

      // Mobile-only native swipe row (scroll-snap) — reliable in DevTools device mode
      const useMobileScroll = () =>
        root.hasAttribute('data-sp-mobile-scroll') && !isDesktopGrid();

      const syncScrollDots = () => {
        if (!dotsWrap || dotsWrap.hidden) return;
        const scrollLeft = viewport.scrollLeft;
        let best = 0;
        let bestDist = Infinity;
        slides.forEach((slide, i) => {
          const dist = Math.abs(slide.offsetLeft - scrollLeft);
          if (dist < bestDist) {
            bestDist = dist;
            best = i;
          }
        });
        index = best;
        dotsWrap.querySelectorAll('.svc-dot').forEach((d, i) => {
          d.classList.toggle('is-active', i === best);
        });
      };

      const applyMobileScroll = () => {
        root.classList.remove('is-desktop-grid');
        root.classList.add('is-mobile-scroll');
        stopAuto();
        stopScrollAuto();
        clearCarouselStyles();
        trackEl.style.removeProperty('transform');
        trackEl.style.setProperty('display', 'flex', 'important');
        trackEl.style.setProperty('flex-wrap', 'nowrap', 'important');
        trackEl.style.setProperty('width', 'max-content', 'important');
        trackEl.style.setProperty('gap', '16px', 'important');
        trackEl.style.setProperty('transform', 'none', 'important');
        trackEl.style.setProperty('transition', 'none', 'important');
        viewport.style.setProperty('overflow-x', 'auto', 'important');
        viewport.style.setProperty('overflow-y', 'hidden', 'important');
        viewport.style.setProperty('scroll-snap-type', 'x mandatory', 'important');
        viewport.style.setProperty('-webkit-overflow-scrolling', 'touch');
        viewport.style.setProperty('width', '100%', 'important');

        const vw = viewport.clientWidth || root.clientWidth || 320;
        const cardPx = Math.round(Math.min(vw * 0.88, 340));
        const gapPx = 16;
        slides.forEach((slide) => {
          slide.style.setProperty('flex', '0 0 ' + cardPx + 'px', 'important');
          slide.style.setProperty('width', cardPx + 'px', 'important');
          slide.style.setProperty('min-width', cardPx + 'px', 'important');
          slide.style.setProperty('max-width', cardPx + 'px', 'important');
          slide.style.setProperty('scroll-snap-align', 'start', 'important');
          slide.style.setProperty('box-sizing', 'border-box', 'important');
        });
        trackEl.style.width = cardPx * slides.length + gapPx * Math.max(0, slides.length - 1) + 'px';

        per = 1;
        root.style.setProperty('--svc-per', '1');
        if (dotsWrap) {
          dotsWrap.innerHTML = '';
          if (slides.length <= 1) {
            dotsWrap.hidden = true;
          } else {
            dotsWrap.hidden = false;
            slides.forEach((_, i) => {
              const b = document.createElement('button');
              b.type = 'button';
              b.className = 'svc-dot' + (i === 0 ? ' is-active' : '');
              b.setAttribute('aria-label', 'Go to card ' + (i + 1));
              b.addEventListener('click', (e) => {
                e.preventDefault();
                scrollToSlide(i);
              });
              dotsWrap.appendChild(b);
            });
          }
        }
        if (!viewport._spScrollBound) {
          viewport._spScrollBound = true;
          viewport.addEventListener('scroll', syncScrollDots, { passive: true });
          viewport.addEventListener('touchstart', stopScrollAuto, { passive: true });
          viewport.addEventListener('touchend', () => {
            setTimeout(startScrollAuto, 3500);
          }, { passive: true });
        }
        syncScrollDots();
        startScrollAuto();
      };

      let scrollAutoTimer = null;
      const stopScrollAuto = () => {
        if (scrollAutoTimer) {
          clearInterval(scrollAutoTimer);
          scrollAutoTimer = null;
        }
      };
      const scrollToSlide = (i) => {
        const slide = slides[i];
        if (!slide) return;
        viewport.scrollTo({ left: slide.offsetLeft, behavior: 'smooth' });
        index = i;
        syncScrollDots();
      };
      const startScrollAuto = () => {
        stopScrollAuto();
        if (!useMobileScroll() || reduce || slides.length <= 1) return;
        scrollAutoTimer = setInterval(() => {
          const next = (index + 1) % slides.length;
          scrollToSlide(next);
        }, AUTO_MS);
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
        if (isDesktopGrid()) return;
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
        if (isDesktopGrid()) return;
        measure();
        // Move by one card so next/prev always advance
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
        if (isDesktopGrid() || reduce || maxIndex() <= 0) return;
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
        if (isDesktopGrid() || useMobileScroll()) return;
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
      // Avoid autoplay restart on desktop hover leave
      if (canHover) {
        root.addEventListener('mouseenter', stopAuto);
        root.addEventListener('mouseleave', () => {
          if (!isDesktopGrid()) startAuto();
        });
      }

      const refresh = () => {
        if (trackEl.hasAttribute('data-thm-stack')) {
          if (isDesktopGrid()) applyDesktopGrid();
          else {
            stopAuto();
            stopScrollAuto();
            clearCarouselStyles();
            root.classList.remove('is-desktop-grid', 'is-mobile-scroll');
            if (dotsWrap) {
              dotsWrap.hidden = true;
              dotsWrap.innerHTML = '';
            }
          }
          return;
        }
        if (trackEl.hasAttribute('data-thm-carousel')) {
          stopAuto();
          stopScrollAuto();
          clearCarouselStyles();
          root.classList.remove('is-mobile-scroll');
          try {
            if (window.matchMedia('(min-width: 768px)').matches) {
              root.classList.add('is-desktop-grid');
            } else {
              root.classList.remove('is-desktop-grid');
            }
          } catch (e) {
            root.classList.remove('is-desktop-grid');
          }
          if (dotsWrap) {
            dotsWrap.hidden = true;
            dotsWrap.innerHTML = '';
          }
          return;
        }
        if (isDesktopGrid()) applyDesktopGrid();
        else if (useMobileScroll()) applyMobileScroll();
        else applyCarousel();
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

  // ─── Theme-html mobile autoplay carousels (WP reference: problem + feature) ───
  (function initThemeHtmlMobileAutoCarousels() {
    // why-bg { overflow:hidden } clips an overflowing grid. Scroll on a shell
    // around .feature-grid — same as Blade /wordpress .why-mobile-carousel.
    Array.prototype.forEach.call(
      document.querySelectorAll(
        [
          '.wpdev-theme-page .why-bg .feature-grid',
          '.page-wordpress .why-bg .feature-grid',
          '.theme-html-root .why-bg .feature-grid',
          '.wpdev-theme-page #why-us .why-grid',
          '.wpdev-theme-page .why-grid',
          '.webdev-ref #why .why-grid',
          '.page-web-dev #why .why-grid',
          '.webdev-ref .problem-grid',
          '.page-web-dev .problem-grid',
          '.webdev-ref #why-us .why-grid',
          '.webdev-ref .why-grid',
          '.page-web-dev .included-grid',
          '.shopify-theme-page .pain-grid',
          '.shopify-theme-page .why-feats',
          '.shopify-theme-page .ind-grid',
          '.shopify-theme-page .tst-grid',
          '.aibot-theme-page .prob-list',
          '.aibot-theme-page #why .why-grid',
          '.aibot-theme-page .tst-grid',
          '.cms-theme-page #problem .grid',
          '.cms-theme-page .feat-list',
          '.cms-theme-page #work .grid',
          '.cms-theme-page .plat',
          '.redesign-theme-page #pain .grid',
          '.redesign-theme-page #deliver .grid',
          '.redesign-theme-page .sec-testi .grid',
          '.elec-theme-page .pain-list',
          '.elec-theme-page .edge-grid',
          '.saas-theme-page .pain-grid',
          '.saas-theme-page .stack-groups',
          '.offpage-theme-page #why .pain-list',
          '.offpage-theme-page .sec-ink .why-grid',
          '.offpage-theme-page #services .grid-cards',
          '.offpage-theme-page .tgrid',
          '.page-dm .webdev-ref #services .service-grid',
        ].join(', ')
      ),
      (grid) => {
        const parent = grid.parentElement;
        if (!parent || parent.classList.contains('why-mobile-carousel')) return;
        if (
          grid.querySelector(
            ':scope > .stat, :scope > .stats, :scope > .why-list, :scope > .stats-row, :scope > .why-feats, :scope > .compare, :scope > .why-copy, :scope > .feat-list, :scope > .prob-panel, :scope > .intro-copy'
          ) ||
          (grid.classList.contains('why-grid') && grid.querySelector('.why-list, .stats'))
        ) {
          return;
        }
        const shell = document.createElement('div');
        shell.className = 'why-mobile-carousel';
        parent.insertBefore(shell, grid);
        shell.appendChild(grid);
      }
    );

    const tracks = Array.prototype.slice.call(
      document.querySelectorAll(
        [
          '.theme-html-root [data-thm-carousel]',
          '.webdev-ref [data-thm-carousel]',
          '.why-mobile-carousel > .problem-grid',
          '.why-mobile-carousel > .why-grid',
          '.why-mobile-carousel > .grid',
          '.why-mobile-carousel > .pain-list',
          '.why-mobile-carousel > .grid-cards',
          '.why-mobile-carousel > .tgrid',
          '.why-mobile-carousel > .service-grid',
        ].join(', ')
      )
    );
    if (!tracks.length) return;

    const MQ = '(max-width: 767px)';
    const AUTO_MS = 4000;
    let reduce = false;
    try {
      reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    } catch (e) {}

    const trackMq = (track) => {
      if (track.closest('.offpage-theme-page')) {
        return '(max-width: 980px)';
      }
      if (
        document.body.classList.contains('page-dm') &&
        track.classList.contains('service-grid') &&
        track.closest('#services')
      ) {
        return '(max-width: 980px)';
      }
      if (track.classList.contains('feat-list')) {
        return '(max-width: 767px)';
      }
      if (track.closest('.redesign-theme-page') && track.closest('#pain')) {
        return '(max-width: 980px)';
      }
      if (track.closest('.saas-theme-page') && (track.classList.contains('pain-grid') || track.closest('#problems'))) {
        return '(max-width: 980px)';
      }
      if (
        track.classList.contains('why-grid') ||
        track.classList.contains('prob-list') ||
        track.closest('#why-us, #why, #problem, #pain')
      ) {
        return '(max-width: 980px)';
      }
      return MQ;
    };

    const isMobile = (track) => {
      const q = track ? trackMq(track) : MQ;
      try {
        return window.matchMedia(q).matches;
      } catch (e) {
        return (window.innerWidth || 0) <= (q.indexOf('980') !== -1 ? 980 : 767);
      }
    };

    tracks.forEach((track) => {
      if (!track || track.dataset.thmCarouselReady === '1') return;
      if (track.hasAttribute('data-thm-stack')) return;
      if (
        track.closest('.testi-slider') ||
        track.classList.contains('testi-track') ||
        track.id === 'testiTrack'
      ) {
        return;
      }
      track.dataset.thmCarouselReady = '1';

      const scroller = track;
      const shell = track.closest('.why-mobile-carousel');
      const cards = Array.prototype.filter.call(track.children, (el) => el.nodeType === 1);
      if (cards.length < 2) return;

      let index = 0;
      let timer = null;
      let resumeTimer = null;

      const navWrap = document.createElement('div');
      navWrap.className = 'thm-carousel-nav-wrap';
      navWrap.setAttribute('role', 'group');
      navWrap.setAttribute('aria-label', 'Carousel navigation');
      const prevBtn = document.createElement('button');
      prevBtn.type = 'button';
      prevBtn.className = 'thm-carousel-nav thm-carousel-prev';
      prevBtn.setAttribute('aria-label', 'Previous slide');
      prevBtn.innerHTML =
        '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
      const nextBtn = document.createElement('button');
      nextBtn.type = 'button';
      nextBtn.className = 'thm-carousel-nav thm-carousel-next';
      nextBtn.setAttribute('aria-label', 'Next slide');
      nextBtn.innerHTML =
        '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
      navWrap.appendChild(prevBtn);
      navWrap.appendChild(nextBtn);

      const dotsWrap = document.createElement('div');
      dotsWrap.className = 'testi-dots thm-carousel-dots';
      dotsWrap.setAttribute('data-thm-carousel-dots', '');
      dotsWrap.setAttribute('role', 'tablist');
      dotsWrap.setAttribute('aria-label', 'Carousel slides');
      cards.forEach((_, i) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'testi-dot' + (i === 0 ? ' is-active' : '');
        btn.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
        btn.setAttribute('role', 'tab');
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          goTo(i, true);
          pauseThenResume();
        });
        dotsWrap.appendChild(btn);
      });
      const host = shell && shell.parentElement ? shell.parentElement : scroller.parentElement;
      if (host) {
        host.insertBefore(navWrap, (shell || scroller).nextSibling);
        host.insertBefore(dotsWrap, navWrap.nextSibling);
      }

      const syncNav = () => {
        const show = isMobile(track) && cards.length > 1;
        navWrap.hidden = !show;
        navWrap.style.display = show ? 'flex' : 'none';
      };

      const syncDots = () => {
        if (!dotsWrap) return;
        const show = isMobile(track);
        dotsWrap.hidden = !show;
        dotsWrap.style.display = show ? 'flex' : 'none';
        if (!show) return;
        dotsWrap.querySelectorAll('.testi-dot').forEach((d, i) => {
          const active = i === index;
          d.classList.toggle('is-active', active);
          d.setAttribute('aria-selected', active ? 'true' : 'false');
        });
      };

      const syncCarouselClass = () => {
        if (isMobile(track)) {
          track.classList.add('thm-mobile-carousel');
          if (shell) shell.classList.remove('thm-mobile-carousel');
        } else {
          track.classList.remove('thm-mobile-carousel');
          if (shell) shell.classList.remove('thm-mobile-carousel');
          scroller.scrollTo({ left: 0, behavior: 'auto' });
          index = 0;
        }
        syncNav();
        syncDots();
      };

      const stop = () => {
        if (timer) {
          clearInterval(timer);
          timer = null;
        }
        if (resumeTimer) {
          clearTimeout(resumeTimer);
          resumeTimer = null;
        }
      };

      const cardLeft = (card) => {
        const sRect = scroller.getBoundingClientRect();
        const cRect = card.getBoundingClientRect();
        return cRect.left - sRect.left + scroller.scrollLeft;
      };

      const goTo = (i, smooth) => {
        const card = cards[i];
        if (!card) return;
        index = i;
        scroller.scrollTo({
          left: cardLeft(card),
          behavior: smooth === false ? 'auto' : 'smooth',
        });
        syncDots();
      };

      const next = () => {
        if (!isMobile(track)) return;
        goTo((index + 1) % cards.length, true);
      };

      const prev = () => {
        if (!isMobile(track)) return;
        goTo((index - 1 + cards.length) % cards.length, true);
      };

      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        prev();
        pauseThenResume();
      });
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        next();
        pauseThenResume();
      });

      const start = () => {
        stop();
        if (!isMobile(track) || reduce) return;
        timer = setInterval(next, AUTO_MS);
      };

      const pauseThenResume = () => {
        stop();
        resumeTimer = setTimeout(start, 5000);
      };

      const syncIndexFromScroll = () => {
        const left = scroller.scrollLeft;
        let best = 0;
        let bestDist = Infinity;
        cards.forEach((card, i) => {
          const dist = Math.abs(cardLeft(card) - left);
          if (dist < bestDist) {
            bestDist = dist;
            best = i;
          }
        });
        index = best;
        syncDots();
      };

      scroller.addEventListener('scroll', syncIndexFromScroll, { passive: true });
      scroller.addEventListener('touchstart', pauseThenResume, { passive: true });
      scroller.addEventListener('pointerdown', pauseThenResume, { passive: true });
      scroller.addEventListener('wheel', pauseThenResume, { passive: true });

      const onResize = () => {
        stop();
        syncCarouselClass();
        if (isMobile(track)) {
          syncIndexFromScroll();
          start();
        }
      };

      window.addEventListener('resize', () => setTimeout(onResize, 150));
      window.addEventListener('orientationchange', () => setTimeout(onResize, 200));

      syncCarouselClass();
      if (isMobile(track)) start();
    });
  })();
})();
