@php
  $d = $s['compare'] ?? [];
  $other = $d['other'] ?? [];
  $us = $d['us'] ?? [];
@endphp
<section class="sec" id="compare">
  <div class="wrap">
    <div class="head-block rev">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="cmp-grid">
      <div class="cmp rev">
        <div class="cmp-h">
          <b>{{ $other['title'] ?? 'Typical dev shop' }}</b>
          <span class="tagm bad">{{ $other['tag'] ?? 'The usual' }}</span>
        </div>
        <ul>
          @foreach($other['items'] ?? [] as $item)
            <li><span class="mk x">✕</span> {{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="cmp win rev">
        <div class="cmp-h">
          <b>{{ $us['title'] ?? 'KodRank' }}</b>
          <span class="tagm good">{{ $us['tag'] ?? 'Built to scale' }}</span>
        </div>
        <ul>
          @foreach($us['items'] ?? [] as $item)
            <li><span class="mk c">✓</span> {{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
