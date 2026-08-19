@php $d = $s['process'] ?? []; @endphp
<section class="sec-ink" id="process">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel page-svc-carousel--ink" data-sp-carousel data-per-desktop="4">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous"><svg viewBox="0 0 24 24" fill="none"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-viewport"><div class="svc-track">
        @foreach($d['steps'] ?? [] as $step)
          <div class="loop-card svc-slide">
            <div class="loop-top">
              <span class="loop-num">{{ $step['num'] ?? '' }}</span>
              <span class="loop-ico"><svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="M21 21l-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
            </div>
            <h4>{{ $step['title'] ?? '' }}</h4>
            <p>{{ $step['body'] ?? '' }}</p>
          </div>
        @endforeach
      </div></div>
      <button type="button" class="svc-nav svc-next" aria-label="Next"><svg viewBox="0 0 24 24" fill="none"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
