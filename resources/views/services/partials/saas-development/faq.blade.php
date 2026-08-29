@php $f = $s['faq'] ?? []; @endphp
<section class="sec" id="faq">
  <div class="wrap">
    <div class="head-block rev" style="text-align:center;margin:0 auto">
      @if(!empty($f['eyebrow']))<span class="eyebrow">{{ $f['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($f['title_html'])){!! $f['title_html'] !!}
        @else{{ $f['title'] ?? '' }}@endif
      </h2>
      @if(!empty($f['lede']))<p class="lede">{{ $f['lede'] }}</p>@endif
    </div>
    <div class="faq-wrap">
      @foreach($f['items'] ?? [] as $item)
        <details class="faq rev">
          <summary>{{ $item['q'] ?? $item['question'] ?? '' }}<span class="tog">+</span></summary>
          <div class="ans"><p>{{ $item['a'] ?? $item['answer'] ?? '' }}</p></div>
        </details>
      @endforeach
    </div>
  </div>
</section>
