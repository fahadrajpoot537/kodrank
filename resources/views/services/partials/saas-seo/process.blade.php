@php $d = $s['process'] ?? []; @endphp
<section class="sec-paper" id="process">
  <div class="wrap">
    <div class="shead">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="4">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous"><svg viewBox="0 0 24 24" fill="none"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-viewport"><div class="svc-track">
        @foreach($d['steps'] ?? [] as $step)
          <div class="step on svc-slide">
            <div class="num">{{ $step['num'] ?? '' }}</div>
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
