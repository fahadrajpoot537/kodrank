@php
  $d = $s['compare'] ?? [];
  $other = $d['other'] ?? [];
  $us = $d['us'] ?? [];
@endphp
<section class="sec-compare" id="work">
  <div class="wrap">
    <div class="sec-head center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2 class="h">{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="compare">
      <div class="cmp x-card">
        <div class="tag">{{ $other['tag'] ?? 'Your site today' }}</div>
        <h3>{{ $other['title'] ?? 'Working against you' }}</h3>
        <ul>
          @foreach($other['items'] ?? [] as $item)
            <li class="x"><span class="mk">✕</span>{{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="cmp win">
        <div class="tag">{{ $us['tag'] ?? 'After a KodRank redesign' }}</div>
        <h3>{{ $us['title'] ?? 'Working for you' }}</h3>
        <ul>
          @foreach($us['items'] ?? [] as $item)
            <li class="c"><span class="mk">✓</span>{{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
