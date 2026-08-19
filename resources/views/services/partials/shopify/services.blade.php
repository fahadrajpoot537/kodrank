@php $d = $s['services'] ?? []; @endphp
<section class="section sec-ink" id="services">
  <div class="wrap">
    <div class="head-block">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>

    <div class="svc-carousel page-svc-carousel page-svc-carousel--ink" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous services">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <article class="svc-card svc-slide">
              <span class="svc-badge">@include('services.partials.shopify.icon', ['key' => 'check', 'strokeWidth' => '3'])</span>
              <span class="tile">@include('services.partials.shopify.icon', ['key' => $card['icon_key'] ?? 'theme'])</span>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next services">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>

    @if(!empty($d['stats']))
      <div class="stats">
        @foreach($d['stats'] as $stat)
          <div class="stat">
            <div class="num">{!! $stat['value_html'] ?? e($stat['value'] ?? '') !!}</div>
            <div class="lbl">{{ $stat['label'] ?? '' }}</div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
