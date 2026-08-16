@php $pl = $s['platforms'] ?? []; @endphp
<section class="sec-mist">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $pl['eyebrow'] ?? 'The Difference' }}</span>
      <h2>
        @if(!empty($pl['title_html']))
          {!! $pl['title_html'] !!}
        @else
          {{ $pl['title'] ?? '' }}
        @endif
      </h2>
      <p>{{ $pl['lede'] ?? '' }}</p>
    </div>

    <div class="compare-wrap">
      @foreach($pl['columns'] ?? [] as $col)
        <div class="compare-card {{ ($col['variant'] ?? '') === 'pro' ? 'pro' : 'muted' }}">
          <h3>{{ $col['title'] ?? '' }}</h3>
          <ul class="compare-list">
            @foreach($col['items'] ?? [] as $item)
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
</section>
