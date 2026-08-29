@php
  $d = $s['services'] ?? [];
  $cards = $d['cards'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $ico = '<svg viewBox="0 0 24 24" fill="none"><path d="M12 2l3 7 7 .5-5.5 4.5L18 21l-6-4-6 4 1.5-7L2 9.5 9 9z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec" id="services">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($cards as $card)
            <article class="svc svc-slide">
              <div class="svc-top">
                <div class="svc-icon">{!! $ico !!}</div>
                <span class="svc-badge">✓</span>
              </div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
