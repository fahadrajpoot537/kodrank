@php $d = $s['pain'] ?? []; @endphp
<section class="section sec-paper" id="problem">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous problems">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <div class="prob svc-slide">
              <div class="num">{{ $card['num'] ?? '' }}</div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>@if(!empty($card['body_html'])){!! $card['body_html'] !!}@else{{ $card['body'] ?? '' }}@endif</p>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next problems">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
