@php
  $getIcons = [
    '<path d="M8.5 16.5 4 12l4.5-4.5M15.5 7.5 20 12l-4.5 4.5"/>',
    '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
    '<path d="M5 3h14v18l-7-4-7 4V3Z"/><path d="M9 8h6M9 12h4"/>',
    '<path d="M4 18V9M9.3 18V5M14.7 18v-6M20 18v-9"/>',
  ];
@endphp
<section id="get">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['get']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['get']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['get']['lede'] ?? '' }}</p>
    </div>

    <div class="grid g2 mt-lg">
      @foreach($c['get']['cards'] ?? [] as $i => $card)
        <article class="get-card rv">
          <div class="get-head">
            <span class="get-ico"><svg viewBox="0 0 24 24">{!! $getIcons[$i % count($getIcons)] !!}</svg></span>
            <div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
            </div>
          </div>
          <ul class="get-checks">
            @foreach($card['checks'] ?? [] as $check)
              <li>{{ $check }}</li>
            @endforeach
          </ul>
        </article>
      @endforeach
    </div>
  </div>
</section>
