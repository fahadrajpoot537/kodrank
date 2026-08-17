@php $d = $s['included'] ?? []; @endphp
<section class="section sec-mist" id="platforms">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="4">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous platforms">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['tiles'] ?? [] as $tile)
            <div class="ptile svc-slide">
              <span class="pt">@include('services.partials.cms.icon', ['key' => $tile['icon_key'] ?? 'stack', 'strokeWidth' => '1.8'])</span>{{ $tile['title'] ?? '' }}
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next platforms">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
    @if(!empty($d['note_html']) || !empty($d['note']))
      <p class="plat-note">@if(!empty($d['note_html'])){!! $d['note_html'] !!}@else{{ $d['note'] }}@endif</p>
    @endif
  </div>
</section>
