@php
  $p = $s['problem'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec-ink problem-bg">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $p['eyebrow'] ?? 'The Problem' }}</span>
      <h2>
        @if(!empty($p['title_html']))
          {!! $p['title_html'] !!}
        @else
          {{ $p['title'] ?? '' }}
          @if(!empty($p['title_accent']))
            <span class="hl">{{ $p['title_accent'] }}</span>
          @endif
        @endif
      </h2>
      <p class="lede">{{ $p['lede'] ?? '' }}</p>
    </div>

    <div class="svc-carousel page-svc-stack page-svc-stack--ink page-svc-stack--pair" data-sp-stack data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous cards">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($p['cards'] ?? [] as $card)
            <div class="problem-card svc-slide">
              <div class="icon">
                @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'clock'])
              </div>
              <h4>{{ $card['title'] ?? '' }}</h4>
              <p>{{ $card['body'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next cards">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
