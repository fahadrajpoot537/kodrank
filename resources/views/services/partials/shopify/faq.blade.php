@php $d = $s['faq'] ?? []; @endphp
<section class="section sec-paper" id="faq">
  <div class="wrap">
    <div class="head-block">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="faq">
      @foreach($d['items'] ?? [] as $i => $item)
        <details @if($i === 0) open @endif>
          <summary>{{ $item['q'] ?? '' }}<span class="tog" aria-hidden="true"></span></summary>
          <div class="ans">{{ $item['a'] ?? '' }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>
