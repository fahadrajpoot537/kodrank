@php $d = $s['industries'] ?? []; @endphp
<section class="section sec-paper" id="industries">
  <div class="wrap">
    <div class="head-block">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="4">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous industries">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <article class="ind svc-slide">
              <span class="ii">@include('services.partials.shopify.icon', ['key' => $card['icon_key'] ?? 'bag'])</span>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next industries">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
