@php $d = $s['pain'] ?? []; @endphp
<section class="sec-paper" id="pain">
  <div class="wrap">
    <div class="section-head-flex reveal in">
      <div>
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
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="problem-grid">
      @foreach($d['cards'] ?? [] as $card)
        <div class="problem-card pain-card reveal in">
          <span class="pain-num">{{ $card['num'] ?? '' }}</span>
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
