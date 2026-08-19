@php
  $d = $s['compare'] ?? [];
  $other = $d['other'] ?? [];
  $us = $d['us'] ?? [];
@endphp
<section class="sec-mist" id="compare">
  <div class="wrap">
    <div class="shead">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="cmp-grid">
      <div class="cmp typ">
        <div class="tag">{{ $other['tag'] ?? '' }}</div>
        <h4>{{ $other['title'] ?? '' }}</h4>
        <ul>
          @foreach($other['items'] ?? [] as $item)
            <li><svg class="x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>{{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="cmp best">
        <div class="tag">{{ $us['tag'] ?? '' }}</div>
        <h4>{{ $us['title'] ?? '' }}</h4>
        <ul>
          @foreach($us['items'] ?? [] as $item)
            <li><svg class="ck" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>{{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
