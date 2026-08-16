@php $d = $s['faq'] ?? []; @endphp
<section class="sec-mist" id="faq">
  <div class="wrap">
    <div class="section-head center reveal">
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

    <div class="faq-wrap">
      @foreach($d['items'] ?? [] as $item)
        <details class="faq-item reveal">
          <summary class="faq-q">
            <span>{{ $item['q'] ?? '' }}</span>
            <span class="faq-toggle">+</span>
          </summary>
          <div class="faq-a">
            <div class="faq-a-inner">{!! $item['a'] ?? '' !!}</div>
          </div>
        </details>
      @endforeach
    </div>
  </div>
</section>
