@php $d = $s['included'] ?? []; @endphp
<section class="sec-ink" id="deliver">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2 class="h">{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel page-svc-carousel--ink" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous deliverables">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['tiles'] ?? [] as $tile)
            <div class="feat svc-slide">
              <div class="ic" aria-hidden="true">{{ $tile['icon'] ?? '◎' }}</div>
              <h3>{{ $tile['title'] ?? '' }}</h3>
              @if(!empty($tile['body']))<p>{{ $tile['body'] }}</p>@endif
              @if(!empty($tile['bullets']))
                <ul class="check">
                  @foreach($tile['bullets'] as $bullet)
                    <li>{{ is_array($bullet) ? ($bullet['text'] ?? '') : $bullet }}</li>
                  @endforeach
                </ul>
              @endif
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next deliverables">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
