@php
  $d = $s['compare'] ?? [];
  $other = $d['other'] ?? [];
  $us = $d['us'] ?? [];
  $x = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>';
  $v = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
@endphp
<section class="paper">
  <div class="wrap">
    <div class="head-block rv">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="cmp-grid">
      <div class="cmp cmp-bad rv">
        <span class="tag">{{ $other['tag'] ?? $other['title'] ?? 'Typical DIY / Template Site' }}</span>
        <ul>
          @foreach($other['items'] ?? [] as $item)
            <li><span class="ic">{!! $x !!}</span> {{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="cmp cmp-good rv">
        <span class="tag">{{ $us['tag'] ?? $us['title'] ?? 'KodRank-Built Site' }}</span>
        <ul>
          @foreach($us['items'] ?? [] as $item)
            <li><span class="ic">{!! $v !!}</span> {{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
