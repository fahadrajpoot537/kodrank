@php
  $d = $s['pain'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec-mist">
  <div class="wrap">
    <div class="section-head-flex reveal in">
      <div>
        @if(!empty($d['eyebrow']))
          <span class="eyebrow">{{ $d['eyebrow'] }}</span>
        @endif
        <h2>
          @if(!empty($d['title_html']))
            {!! $d['title_html'] !!}
          @else
            {{ $d['title'] ?? '' }}
          @endif
        </h2>
      </div>
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="svc-carousel page-svc-stack page-svc-stack--pair" data-sp-stack data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous cards">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <div class="pain-card svc-slide reveal in">
              <span class="pain-num">{{ $card['num'] ?? '' }}</span>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>
                @if(!empty($card['body_html']))
                  {!! $card['body_html'] !!}
                @else
                  {{ $card['body'] ?? '' }}
                @endif
              </p>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next cards">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
