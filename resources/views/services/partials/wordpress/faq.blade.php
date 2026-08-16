@php $d = $s['faq'] ?? []; @endphp
<section id="faq" class="sec-paper">
  <div class="wrap">
    <div class="section-head center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="faq-list">
      @foreach($d['items'] ?? [] as $item)
        <details class="faq-item" @if($loop->first) open @endif>
          <summary>{{ $item['q'] ?? '' }} <span class="faq-toggle">+</span></summary>
          <div class="faq-body">{{ $item['a'] ?? '' }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>
