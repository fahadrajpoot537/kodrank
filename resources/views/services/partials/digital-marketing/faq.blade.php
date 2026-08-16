@php $f = $s['faq'] ?? []; @endphp
<section id="faq" class="sec-paper">
  <div class="wrap">
    <div class="section-head faq-head">
      <span class="eyebrow">{{ $f['eyebrow'] ?? 'Common Questions' }}</span>
      <h2>
        @if(!empty($f['title_html']))
          {!! $f['title_html'] !!}
        @else
          {{ $f['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($f['lede']))
        <p>{{ $f['lede'] }}</p>
      @endif
    </div>

    <div class="faq">
      @foreach($f['items'] ?? [] as $item)
        <details class="faq-item">
          <summary>{{ $item['q'] ?? '' }} <span class="faq-toggle">+</span></summary>
          <div class="faq-body">{{ $item['a'] ?? '' }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>
