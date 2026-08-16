@php $d = $s['testimonials'] ?? []; @endphp
<section class="sec-mist">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
    </div>
    <div class="tst-grid">
      @foreach($d['cards'] ?? [] as $card)
        <div class="tst">
          <div class="stars" aria-hidden="true">★★★★★</div>
          <q>{{ $card['quote'] ?? '' }}</q>
          <div class="tst-who">
            <span class="tst-av" aria-hidden="true">{{ $card['initials'] ?? '' }}</span>
            <div><b>{{ $card['name'] ?? '' }}</b><span>{{ $card['role'] ?? '' }}</span></div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
