@php
  $d = $s['compare'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec-mist">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>

    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="2">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous comparison">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['columns'] ?? [] as $column)
            @php $isPro = ($column['variant'] ?? '') === 'pro'; @endphp
            <div class="compare-card svc-slide {{ $isPro ? 'pro' : 'muted' }}" @if($isPro) data-badge="{{ $column['badge'] ?? 'KodRank' }}" @endif>
              <h3>{{ $column['title'] ?? '' }}</h3>
              <ul class="compare-list">
                @foreach($column['items'] ?? [] as $item)
                  <li>
                    <span class="mark {{ ($item['mark'] ?? 'x') === 'v' ? 'v' : 'x' }}">{{ ($item['mark'] ?? 'x') === 'v' ? '✓' : '✕' }}</span>
                    {{ $item['text'] ?? '' }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next comparison">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
