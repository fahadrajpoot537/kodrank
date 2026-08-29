@php
  $p = $s['pain'] ?? [];
  $cards = $p['cards'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $ico = '<svg viewBox="0 0 24 24" fill="none"><path d="M3 12h4l2 5 4-12 2 7h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec sec-ink" id="problems">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($p['eyebrow']))<span class="eyebrow">{{ $p['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($p['title_html'])){!! $p['title_html'] !!}
        @else{{ $p['title'] ?? '' }}@endif
      </h2>
      @if(!empty($p['lede']))<p class="lede">{{ $p['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-stack page-svc-stack--pair page-svc-stack--ink" data-sp-stack data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($cards as $card)
            <div class="pain svc-slide">
              <div class="pi">{!! $ico !!}</div>
              <h4>{{ $card['title'] ?? '' }}</h4>
              <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
