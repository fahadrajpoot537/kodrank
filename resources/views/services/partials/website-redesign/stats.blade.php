@php $d = $s['stats'] ?? []; @endphp
<section class="sec-ink bgwrap stats-sec">
  <div class="bg-img"></div><div class="bg-ov"></div>
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2 class="h">{{ $d['title'] ?? '' }}</h2>
    </div>
    <div class="stats">
      @foreach($d['items'] ?? [] as $item)
        <div class="stat">
          <div class="n {{ !empty($item['signal']) ? 'hot' : 'cool' }}">{{ $item['value'] ?? '' }}</div>
          <div class="l">{{ $item['label'] ?? '' }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
