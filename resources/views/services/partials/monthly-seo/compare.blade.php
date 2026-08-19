@php
  $d = $s['compare'] ?? [];
  $other = $d['other'] ?? [];
  $us = $d['us'] ?? [];
@endphp
<section class="sec-paper" id="results">
  <div class="wrap">
    <div class="sec-head center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="cmp-grid">
      <div class="cmp-card cmp-typical">
        <h4>{{ $other['title'] ?? '' }}</h4>
        <ul class="cmp-list">
          @foreach($other['items'] ?? [] as $item)
            <li>
              <span class="mk mk-x"><svg viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/></svg></span>
              {{ is_array($item) ? ($item['text'] ?? '') : $item }}
            </li>
          @endforeach
        </ul>
      </div>
      <div class="cmp-card cmp-kod">
        @if(!empty($us['tag']))<span class="cmp-tag">{{ $us['tag'] }}</span>@endif
        <h4>{{ $us['title'] ?? '' }}</h4>
        <ul class="cmp-list">
          @foreach($us['items'] ?? [] as $item)
            <li>
              <span class="mk mk-c"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              {{ is_array($item) ? ($item['text'] ?? '') : $item }}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
