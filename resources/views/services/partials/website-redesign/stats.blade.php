@php
  $d = $s['stats'] ?? [];
  $bg = $d['results_background_image'] ?? $d['image'] ?? $d['background_image'] ?? null;
@endphp
<section class="sec-ink bgwrap stats-sec">
  <div class="bg-img"@if($bg) style="background-image:url('{{ asset(ltrim($bg, '/')) }}')"@endif></div><div class="bg-ov"></div>
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
