@php $d = $s['faq'] ?? []; @endphp
<section class="sec-paper" id="faq">
  <div class="wrap">
    <div class="shead center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
    </div>
    <div class="faq-list">
      @foreach($d['items'] ?? [] as $i => $item)
        <details class="faq-item" @if($i === 0) open @endif>
          <summary class="faq-q">
            <span class="faq-q-text">{{ $item['q'] ?? '' }}</span>
            <span class="faq-tog" aria-hidden="true"></span>
          </summary>
          <div class="faq-a"><p>{{ $item['a'] ?? '' }}</p></div>
        </details>
      @endforeach
    </div>
  </div>
</section>
