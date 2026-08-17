@php $d = $s['services'] ?? []; @endphp
<section class="section sec-mist" id="services">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous services">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <article class="svc svc-slide">
              <div class="svc-top">
                <span class="tile">@include('services.partials.cms.icon', ['key' => $card['icon_key'] ?? 'code'])</span>
                <span class="badge">@include('services.partials.cms.icon', ['key' => 'check', 'strokeWidth' => '2.4'])</span>
              </div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>@if(!empty($card['body_html'])){!! $card['body_html'] !!}@else{{ $card['body'] ?? '' }}@endif</p>
              @if(!empty($card['link_text']))
                <a href="{{ $card['link_url'] ?: '#contact' }}" class="tlink">{{ $card['link_text'] }}
                  <svg class="arw" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
              @endif
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next services">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
