@php
  $w = $w ?? [];
  $cards = $w['cards'] ?? $w['features'] ?? [];
@endphp
<section id="why" class="sec-paper">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($w['eyebrow']))<span class="eyebrow">{{ $w['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($w['title_html'])){!! $w['title_html'] !!}@else{{ $w['title'] ?? '' }}@endif
      </h2>
      @if(!empty($w['lede_html']))
        <p class="lede">{!! $w['lede_html'] !!}</p>
      @elseif(!empty($w['lede']))
        <p class="lede">{{ $w['lede'] }}</p>
      @endif
    </div>
    @if(!empty($cards))
      <div class="why-grid">
        @foreach($cards as $card)
          <div class="why-card">
            <div class="icon">@include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'check'])</div>
            <h3>{{ $card['title'] ?? '' }}</h3>
            <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
          </div>
        @endforeach
      </div>
    @endif
    @if(!empty($w['checks']))
      <ul class="compare-list" style="margin-top:28px;max-width:720px">
        @foreach($w['checks'] as $check)
          <li><span class="mark v">✓</span> {{ is_array($check) ? ($check['text'] ?? '') : $check }}</li>
        @endforeach
      </ul>
    @endif
  </div>
</section>
