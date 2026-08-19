@php $d = $s['services'] ?? []; @endphp
<section class="sec-ink" id="services">
  <div class="wrap">
    <div class="shead">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel page-svc-carousel--ink" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous"><svg viewBox="0 0 24 24" fill="none"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-viewport"><div class="svc-track">
        @foreach($d['cards'] ?? [] as $card)
          <div class="svc svc-slide">
            <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg></div>
            <h4>{{ $card['title'] ?? '' }}</h4>
            <p>{{ $card['body'] ?? '' }}</p>
          </div>
        @endforeach
      </div></div>
      <button type="button" class="svc-nav svc-next" aria-label="Next"><svg viewBox="0 0 24 24" fill="none"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
