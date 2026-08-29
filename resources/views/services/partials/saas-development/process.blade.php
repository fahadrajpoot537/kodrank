@php
  $pr = $s['process'] ?? [];
  $steps = $pr['steps'] ?? $pr['cards'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec sec-mist" id="process">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($pr['eyebrow']))<span class="eyebrow">{{ $pr['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($pr['title_html'])){!! $pr['title_html'] !!}
        @else{{ $pr['title'] ?? '' }}@endif
      </h2>
      @if(!empty($pr['lede']))<p class="lede">{{ $pr['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-stack page-svc-stack--pair" data-sp-stack data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous steps">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($steps as $i => $step)
            <div class="step svc-slide">
              <div class="num">{{ $step['num'] ?? str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</div>
              <h4>{{ $step['title'] ?? '' }}</h4>
              <p>{{ $step['body'] ?? $step['text'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next steps">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
