@php $d = $s['pain'] ?? []; @endphp
<section class="section sec-paper" id="problem">
  <div class="wrap">
    <div class="head-block">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>

    <div class="svc-carousel page-svc-stack page-svc-stack--pair" data-sp-stack data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous problems">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <article class="pain-card svc-slide">
              <span class="ico">@include('services.partials.shopify.icon', ['key' => $card['icon_key'] ?? 'clock'])</span>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next problems">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>

    @if(!empty($d['footer_html']) || !empty($d['cta_text']))
      <div class="pain-line">
        @if(!empty($d['footer_html']) || !empty($d['footer']))
          <p>@if(!empty($d['footer_html'])){!! $d['footer_html'] !!}@else{{ $d['footer'] }}@endif</p>
        @endif
        @if(!empty($d['cta_text']))
          <a href="{{ $d['cta_url'] ?: '#services' }}" class="tlink">{{ $d['cta_text'] }}
            <svg class="arw" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
          </a>
        @endif
      </div>
    @endif
  </div>
</section>
