(function () {
  'use strict';

  function initCountrySelect(root) {
    if (!root || root.dataset.krCountryReady === '1') return;
    root.dataset.krCountryReady = '1';

    let countries = [];
    try {
      countries = JSON.parse(root.dataset.countries || '[]');
    } catch (e) {
      countries = [];
    }

    const wrap = root.querySelector('.kr-country-wrap');
    const trigger = root.querySelector('.kr-country-trigger');
    const valueEl = root.querySelector('.kr-country-value');
    const hidden = root.querySelector('input[type="hidden"][name="country"]');
    const panel = root.querySelector('.kr-country-panel');
    const search = root.querySelector('.kr-country-search');
    const list = root.querySelector('.kr-country-list');
    const empty = root.querySelector('.kr-country-empty');
    const err = root.querySelector('.kr-country-err');

    if (!wrap || !trigger || !valueEl || !hidden || !panel || !search || !list) return;

    const placeholder = valueEl.dataset.placeholder || 'Select your country';
    let filtered = countries.slice();
    let activeIndex = -1;

    function syncDisplay() {
      const val = hidden.value.trim();
      valueEl.textContent = val || '';
      valueEl.classList.toggle('is-placeholder', val === '');
      if (val === '') {
        valueEl.textContent = placeholder;
      }
      root.classList.toggle('has-value', val !== '');
    }

    function renderList() {
      list.innerHTML = '';
      filtered.forEach((name, index) => {
        const li = document.createElement('li');
        li.className = 'kr-country-option';
        li.setAttribute('role', 'option');
        li.setAttribute('data-index', String(index));
        li.textContent = name;
        if (hidden.value === name) {
          li.setAttribute('aria-selected', 'true');
          li.classList.add('is-selected');
        }
        list.appendChild(li);
      });
      if (empty) {
        empty.hidden = filtered.length > 0;
      }
      activeIndex = filtered.length ? 0 : -1;
      highlightActive();
    }

    function highlightActive() {
      list.querySelectorAll('.kr-country-option').forEach((el, i) => {
        el.classList.toggle('is-active', i === activeIndex);
      });
    }

    function filterList(query) {
      const q = query.trim().toLowerCase();
      filtered = q === ''
        ? countries.slice()
        : countries.filter((name) => name.toLowerCase().includes(q));
      renderList();
    }

    function openPanel() {
      panel.hidden = false;
      trigger.setAttribute('aria-expanded', 'true');
      root.classList.add('is-open');
      filterList('');
      search.value = '';
      requestAnimationFrame(() => search.focus());
    }

    function closePanel() {
      panel.hidden = true;
      trigger.setAttribute('aria-expanded', 'false');
      root.classList.remove('is-open');
      activeIndex = -1;
    }

    function selectCountry(name) {
      hidden.value = name;
      syncDisplay();
      closePanel();
      if (err) err.hidden = true;
      root.classList.remove('is-invalid');
      trigger.focus();
    }

    trigger.addEventListener('click', () => {
      if (panel.hidden) openPanel();
      else closePanel();
    });

    search.addEventListener('input', () => filterList(search.value));

    search.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowDown') {
        e.preventDefault();
        if (activeIndex < filtered.length - 1) activeIndex += 1;
        highlightActive();
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        if (activeIndex > 0) activeIndex -= 1;
        highlightActive();
      } else if (e.key === 'Enter') {
        e.preventDefault();
        if (activeIndex >= 0 && filtered[activeIndex]) {
          selectCountry(filtered[activeIndex]);
        }
      } else if (e.key === 'Escape') {
        e.preventDefault();
        closePanel();
        trigger.focus();
      }
    });

    list.addEventListener('click', (e) => {
      const option = e.target.closest('.kr-country-option');
      if (!option) return;
      selectCountry(option.textContent.trim());
    });

    document.addEventListener('click', (e) => {
      if (!root.contains(e.target)) closePanel();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !panel.hidden) {
        closePanel();
        trigger.focus();
      }
    });

    const form = root.closest('form');
    if (form) {
      form.addEventListener('submit', (e) => {
        if (hidden.hasAttribute('required') && !hidden.value.trim()) {
          e.preventDefault();
          if (err) err.hidden = false;
          root.classList.add('is-invalid');
          openPanel();
        }
      });
    }

    syncDisplay();
    renderList();
  }

  function boot() {
    document.querySelectorAll('[data-kr-country]').forEach(initCountrySelect);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
