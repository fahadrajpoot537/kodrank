@php $d = $s['why'] ?? []; @endphp
<section id="why">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="why-grid">
      @foreach($d['cards'] ?? [] as $card)
        <div class="why">
          <div class="num">{{ $card['num'] ?? '' }}</div>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>@if(!empty($card['body_html'])){!! $card['body_html'] !!}@else{{ $card['body'] ?? '' }}@endif</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
