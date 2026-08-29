@php $d = $s['why'] ?? []; @endphp
<section class="sec-ink" id="why">
  <div class="wrap">
    <div class="section-head reveal">
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h2>
    </div>

    <div class="why-grid">
      @foreach($d['cards'] ?? [] as $card)
        <div class="why-card reveal in">
          <span class="why-num">{{ $card['num'] ?? '' }}</span>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>
            @if(!empty($card['body_html']))
              {!! $card['body_html'] !!}
            @else
              {{ $card['body'] ?? '' }}
            @endif
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
