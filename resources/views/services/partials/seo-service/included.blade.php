@php $d = $s['included'] ?? []; @endphp
<section id="included" class="sec-ink seo-included">
  <div class="wrap">
    <div class="section-head">
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
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="svc-carousel page-svc-carousel page-svc-carousel--ink" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous items">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <article class="svc-card svc-slide">
              <div class="tile">
                @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'onpage'])
              </div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next items">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
