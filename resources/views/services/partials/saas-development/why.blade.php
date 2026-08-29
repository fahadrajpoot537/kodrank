@php
  $w = $s['why'] ?? [];
  $cards = $w['cards'] ?? [];
  $stats = $w['stats'] ?? ($s['stats']['items'] ?? []);
  if (empty($stats)) {
      $stats = [
          ['value' => '120+', 'label' => 'SaaS Products Shipped'],
          ['value' => '99.9%', 'label' => 'Average Uptime Held'],
          ['value' => '2–4 wk', 'label' => 'To Sprint-One Build', 'wide' => true],
          ['value' => '40%', 'label' => 'Avg Infra Cost Cut'],
      ];
  }
@endphp
<section class="sec sec-ink" id="why">
  <div class="wrap why-grid">
    <div class="rev">
      @if(!empty($w['eyebrow']))<span class="eyebrow">{{ $w['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($w['title_html'])){!! $w['title_html'] !!}
        @else{{ $w['title'] ?? '' }}@endif
      </h2>
      @if(!empty($w['lede']))<p class="lede" style="margin-top:14px">{{ $w['lede'] }}</p>@endif
      <ul class="why-list">
        @foreach($cards as $card)
          <li>
            <span class="tick">✓</span>
            <div>
              <b>{{ $card['title'] ?? '' }}</b>
              <span>{{ $card['body'] ?? $card['text'] ?? '' }}</span>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="stats rev">
      @foreach($stats as $stat)
        @php
          $val = $stat['value'] ?? $stat['num'] ?? '';
          $wide = !empty($stat['wide']) || preg_match('/wk/i', (string) $val);
        @endphp
        <div class="stat">
          <b @class(['w' => $wide])>{{ $val }}</b>
          <span>{{ $stat['label'] ?? '' }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
