@php $d = $s['faq'] ?? []; @endphp
<section class="sec-paper" id="faq">
  <div class="wrap">
    <div class="sec-head center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
    </div>
    <div class="faq">
      @foreach($d['items'] ?? [] as $i => $item)
        <details class="faq-item" @if($i === 0) open @endif>
          <summary class="faq-q">{{ $item['q'] ?? '' }}<span class="faq-tog"></span></summary>
          <div class="faq-a"><div class="faq-a-inner">{{ $item['a'] ?? '' }}</div></div>
        </details>
      @endforeach
    </div>
  </div>
</section>
