@php
  $d = $s['compare'] ?? [];
  $columns = $d['columns'] ?? [];
@endphp
<section class="sec-mist" id="compare">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>

    <div class="compare-wrap">
      @foreach($columns as $column)
        @php
          $isPro = ($column['variant'] ?? '') === 'pro';
          $badge = $column['badge'] ?? ($isPro ? 'KodRank' : '');
        @endphp
        <div class="compare-card {{ $isPro ? 'pro' : 'muted' }}"@if($isPro && $badge !== '') data-badge="{{ $badge }}"@endif>
          @if($isPro && $badge !== '')
            <span class="compare-pro-badge">{{ $badge }}</span>
          @endif
          <h3>{{ $column['title'] ?? '' }}</h3>
          @if(!empty($column['subtitle']))
            <p class="compare-sub">{{ $column['subtitle'] }}</p>
          @endif
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
</section>
