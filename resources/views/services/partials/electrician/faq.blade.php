@php $f = $s['faq'] ?? []; @endphp
<section class="sec-mist" id="faq">
  <div class="wrap">
    <div class="head-block rv">
      @if(!empty($f['eyebrow']))<span class="eyebrow">{{ $f['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($f['title_html'])){!! $f['title_html'] !!}
        @else{{ $f['title'] ?? '' }}@endif
      </h2>
      @if(!empty($f['lede']))<p class="lede">{{ $f['lede'] }}</p>@endif
    </div>
    <div class="faq-wrap">
      @foreach($f['items'] ?? [] as $i => $item)
        <details class="faq rv" @if($i === 0) open @endif>
          <summary>
            <button type="button">
              {{ $item['q'] ?? $item['question'] ?? '' }}
              <span class="tog"><span class="plus">+</span><span class="minus">−</span></span>
            </button>
          </summary>
          <div class="ans">{{ $item['a'] ?? $item['answer'] ?? '' }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>
