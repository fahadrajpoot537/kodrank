@php
  $d = $d ?? [];
  $secClass = $d['section_class'] ?? ($secClass ?? 'sec-mist');
  $columns = $d['columns'] ?? [];
  if (empty($columns) && (!empty($d['other']) || !empty($d['us']))) {
      $other = $d['other'] ?? [];
      $us = $d['us'] ?? [];
      $mapItems = function ($items, $defaultMark) {
          $out = [];
          foreach ($items ?? [] as $item) {
              if (is_array($item)) {
                  $out[] = ['text' => $item['text'] ?? '', 'mark' => $item['mark'] ?? $defaultMark];
              } else {
                  $out[] = ['text' => $item, 'mark' => $defaultMark];
              }
          }
          return $out;
      };
      $columns = [
          [
              'title' => $other['title'] ?? $other['tag'] ?? '',
              'subtitle' => $other['tag'] ?? ($other['subtitle'] ?? ''),
              'items' => $mapItems($other['items'] ?? [], 'x'),
          ],
          [
              'title' => $us['title'] ?? $us['tag'] ?? '',
              'subtitle' => $us['tag'] ?? ($us['subtitle'] ?? ''),
              'items' => $mapItems($us['items'] ?? [], 'v'),
          ],
      ];
  }
  $left = $columns[0] ?? [];
  $right = $columns[1] ?? [];
  $proBadge = $d['pro_badge'] ?? ($d['us']['tag'] ?? '');
@endphp
<section class="{{ $secClass }}" id="compare">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="compare-wrap">
      <div class="compare-card muted">
        <h3>{{ $left['title'] ?? '' }}</h3>
        @if(!empty($left['subtitle']))<p class="compare-sub">{{ $left['subtitle'] }}</p>@endif
        <ul class="compare-list">
          @foreach($left['items'] ?? [] as $item)
            @php
              $text = is_array($item) ? ($item['text'] ?? '') : $item;
              $mark = is_array($item) ? ($item['mark'] ?? 'x') : 'x';
            @endphp
            <li><span class="mark {{ $mark === 'v' ? 'v' : 'x' }}">{{ $mark === 'v' ? '✓' : '✕' }}</span> {{ $text }}</li>
          @endforeach
        </ul>
      </div>
      <div class="compare-card pro"@if($proBadge !== '') style="--seo-pro-badge:'{{ $proBadge }}'"@endif>
        @if($proBadge !== '')
          <span class="compare-pro-badge">{{ $proBadge }}</span>
        @endif
        <h3>{{ $right['title'] ?? '' }}</h3>
        @if(!empty($right['subtitle']))<p class="compare-sub">{{ $right['subtitle'] }}</p>@endif
        <ul class="compare-list">
          @foreach($right['items'] ?? [] as $item)
            @php
              $text = is_array($item) ? ($item['text'] ?? '') : $item;
              $mark = is_array($item) ? ($item['mark'] ?? 'v') : 'v';
            @endphp
            <li><span class="mark {{ $mark === 'x' ? 'x' : 'v' }}">{{ $mark === 'x' ? '✕' : '✓' }}</span> {{ $text }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
