@php
  $indIcons = [
    'Healthcare' => '<path d="M3.5 9h3l1.5-3 3 6 1.5-3h4"/><path d="M20.5 9a3.6 3.6 0 0 0-6.2-2.4L12 9 9.7 6.6A3.6 3.6 0 0 0 3.5 9c0 4 8.5 9 8.5 9s8.5-5 8.5-9Z" opacity=".55"/>',
    'eCommerce' => '<circle cx="9" cy="20" r="1.3"/><circle cx="17" cy="20" r="1.3"/><path d="M2.5 3h2l2.2 11.2a1.5 1.5 0 0 0 1.5 1.2h8.4a1.5 1.5 0 0 0 1.5-1.2L21 6H6"/>',
    'Real Estate' => '<path d="M4 12 12 6l8 6"/><path d="M6 11v7h12v-7"/><path d="M10 18v-4h4v4"/>',
    'Finance & Banking' => '<path d="M15.5 8.5A4 4 0 0 0 8 9M8.5 15.5A4 4 0 0 0 16 15"/><path d="M17 6v3h-3M7 18v-3h3"/><circle cx="12" cy="12" r="9" opacity=".4"/>',
    'Technology' => '<circle cx="10" cy="12" r="4"/><path d="M10 4v2M10 18v2M4 12H2M6 12h.5M14 12h4"/><path d="m14.5 8.5 1.5-1.5M14.5 15.5l1.5 1.5"/><circle cx="19" cy="6" r="1.3"/><circle cx="19" cy="18" r="1.3"/><circle cx="21" cy="12" r="1.3"/>',
    'Education' => '<path d="M12 5 2.5 9.5 12 14l9.5-4.5L12 5Z"/><path d="M6 11.5V16c0 1 2.7 2.5 6 2.5s6-1.5 6-2.5v-4.5"/><path d="M21.5 9.5V15"/>',
    'Travel' => '<path d="M4 13.5 20 8l-1 3-6 4.5-2 3-1-4-6-1Z"/>',
    'Automotive' => '<path d="M4 15h16v3H4z"/><path d="M5 15l1.6-4.5A2 2 0 0 1 8.5 9h7a2 2 0 0 1 1.9 1.5L19 15"/><circle cx="7.5" cy="18" r="1.2"/><circle cx="16.5" cy="18" r="1.2"/>',
    'Retail' => '<path d="M4 9h16v10H4z"/><path d="M4 9 5.5 5h13L20 9"/><path d="M8 9v0M12 9v0M16 9v0" /><path d="M4 9c0 1.4 1.3 2.5 2.7 2.5S9.3 10.4 9.3 9M9.3 9c0 1.4 1.2 2.5 2.7 2.5S14.7 10.4 14.7 9M14.7 9c0 1.4 1.2 2.5 2.6 2.5S20 10.4 20 9"/>',
    'Food & Beverage' => '<path d="M7 3v7M9.5 3v7M7 10v11M9.5 3v18" opacity=".9"/><path d="M15 3c-1.4 0-2.5 1.8-2.5 4s1.1 4 2.5 4v10"/>',
    'Fashion & Apparel' => '<path d="M9 4 12 6l3-2 3 2.2-2.5 2.7.8 12.1H7.7l.8-12.1L6 6.2 9 4Z"/>',
    'Manufacturing' => '<path d="M4 20h16"/><path d="M4 20v-7l5 3v-3l5 3V9l5 3v8"/><circle cx="12" cy="5" r="1.6"/>',
    'Entertainment & Media' => '<path d="M4 8h16v11H4z"/><path d="m4 8 2-3 3 3M9 5l3 3M12 5l3 3M15 5l3 3"/><path d="m11 12 3 2-3 2v-4Z"/>',
    'Non-Profit' => '<path d="M12 21s-7-4.5-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.5-7 10-7 10Z"/>',
    'Legal Services' => '<path d="M12 4v16M8 20h8"/><path d="m6 8-3 4h6L6 8ZM18 8l-3 4h6l-3-4Z"/><path d="M6 5 18 8"/>',
  ];
  $indItems = $c['industries']['items'] ?? [];
@endphp
<section id="industries">
  <div class="wrap">
    <div class="rv ind-head">
      <p class="eyebrow">{{ $c['industries']['eyebrow'] ?? '' }}</p>
      <h2>{{ $c['industries']['title'] ?? '' }}</h2>
      <p class="lede">{{ $c['industries']['lede'] ?? '' }}</p>
    </div>

    <div class="ind-carousel rv" data-ind-carousel>
      <div class="ind-viewport">
        <div class="ind-track" role="list">
          @foreach($indItems as $item)
            @php
              $name = $item['name'] ?? '';
              $icon = $indIcons[$name] ?? null;
            @endphp
            <a href="{{ $item['url'] ?? '#contact' }}" class="ind-cell ind-slide" role="listitem">
              <span class="ind-ic" aria-hidden="true">
                @if($icon)
                  <svg viewBox="0 0 24 24" fill="none">{!! $icon !!}</svg>
                @endif
              </span>
              <span class="ind-name">{{ $name }}</span>
            </a>
          @endforeach
        </div>
      </div>

      <div class="home-carousel-foot">
        <div class="home-carousel-nav-wrap" role="group" aria-label="Industries carousel navigation">
          <button type="button" class="home-carousel-nav ind-prev" aria-label="Previous industries">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <button type="button" class="home-carousel-nav ind-next" aria-label="Next industries">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
        <div class="ind-dots" data-ind-dots aria-hidden="true"></div>
      </div>
    </div>
  </div>
</section>
