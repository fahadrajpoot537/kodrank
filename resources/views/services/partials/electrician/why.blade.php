@php
  $w = $s['why'] ?? [];
  $cards = $w['cards'] ?? [];
  $stats = $w['stats'] ?? ($s['stats']['items'] ?? []);
  if (empty($stats)) {
      $stats = [
          ['value' => '4–6 wks', 'label' => 'Typical build to launch'],
          ['value' => '100%', 'label' => 'Mobile-first, every page', 'plain' => true],
          ['value' => 'Local', 'label' => 'SEO built in from day one'],
          ['value' => 'Yours', 'label' => 'Full ownership, no lock-in', 'plain' => true],
      ];
  }
  $ico = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 4 6v6c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V6z"/></svg>';
@endphp
<section class="sec-ink">
  <div class="wrap">
    <div class="head-block rv">
      @if(!empty($w['eyebrow']))<span class="eyebrow">{{ $w['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($w['title_html'])){!! $w['title_html'] !!}
        @else{{ $w['title'] ?? '' }}@endif
      </h2>
      @if(!empty($w['lede']))<p class="lede">{{ $w['lede'] }}</p>@endif
    </div>
    <div class="edge-grid">
      @foreach($cards as $card)
        <div class="edge rv">
          <div class="edge-ico">{!! $ico !!}</div>
          <h4>{{ $card['title'] ?? '' }}</h4>
          <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
    <div class="stats-row rv">
      @foreach($stats as $stat)
        @php
          $val = $stat['value'] ?? $stat['num'] ?? '';
          $plain = !empty($stat['plain']) || preg_match('/^(100%|Yours)$/i', (string) $val);
        @endphp
        <div class="stat">
          <div class="s-num{{ $plain ? ' plain' : '' }}">{{ $val }}</div>
          <div class="s-lab">{{ $stat['label'] ?? '' }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
