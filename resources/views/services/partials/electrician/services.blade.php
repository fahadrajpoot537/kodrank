@php
  $d = $s['services'] ?? [];
  $cards = $d['cards'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $check = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
  $ico = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>';
@endphp
<section class="sec-mist" id="services">
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
                <span class="svc-ico">{!! $ico !!}</span>
                <span class="badge">{!! $check !!}</span>
              </div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
              <a href="#contact" class="tlink">Start Here <span aria-hidden="true">→</span></a>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
