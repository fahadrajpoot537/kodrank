@php
  $p = $p ?? [];
  $secClass = $secClass ?? 'sec-paper';
  $secId = $secId ?? 'problem';
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $cards = $p['cards'] ?? $p['items'] ?? [];
@endphp
<section class="{{ $secClass }}" id="{{ $secId }}">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($p['eyebrow']))<span class="eyebrow">{{ $p['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($p['title_html'])){!! $p['title_html'] !!}@else{{ $p['title'] ?? '' }}@endif
      </h2>
      @if(!empty($p['lede_html']))
        <p class="lede">{!! $p['lede_html'] !!}</p>
      @elseif(!empty($p['lede']))
        <p class="lede">{{ $p['lede'] }}</p>
      @endif
    </div>
    <div class="svc-carousel page-svc-stack page-svc-stack--pair" data-sp-stack data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous cards">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($cards as $card)
            <div class="problem-card svc-slide">
              <div class="icon">
                @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'clock'])
              </div>
              <h4>{{ $card['title'] ?? '' }}</h4>
              <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next cards">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
