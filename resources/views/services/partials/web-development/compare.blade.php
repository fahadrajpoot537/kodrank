@php $d = $s['compare'] ?? []; $other = $d['other'] ?? []; $us = $d['us'] ?? []; @endphp
<section class="sec-ink">
  <div class="wrap">
    <div class="section-head reveal">
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

    <div class="compare-grid">
      <div class="compare-card other reveal">
        <h3>{{ $other['title'] ?? 'Typical Web Agency' }}</h3>
        <ul class="compare-list">
          @foreach($other['items'] ?? [] as $item)
            <li><span class="mark mark-x">✕</span> {{ $item }}</li>
          @endforeach
        </ul>
      </div>

      <div class="compare-card us reveal">
        @if(!empty($us['tag']))
          <div class="compare-tag">{{ $us['tag'] }}</div>
        @endif
        <h3>{{ $us['title'] ?? 'Web Design and Development Services by KodRank' }}</h3>
        <ul class="compare-list">
          @foreach($us['items'] ?? [] as $item)
            <li><span class="mark mark-check">✓</span> {{ $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>

    @if(!empty($d['stats']))
      <div class="stats-band reveal">
        @foreach($d['stats'] as $stat)
          <div class="stat-item">
            <span class="num{{ !empty($stat['white']) ? ' white' : '' }}">{{ $stat['num'] ?? '' }}</span>
            <span class="lab">{{ $stat['label'] ?? '' }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
