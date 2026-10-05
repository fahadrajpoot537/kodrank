@php
  $d = $s['stats'] ?? [];
  $bg = $d['results_background_image'] ?? $d['image'] ?? $d['background_image'] ?? null;
@endphp
<section class="sec-ink stats-bg"@if($bg) style="--stats-bg-image:url('{{ asset(ltrim($bg, '/')) }}');--wp-stats-bg:url('{{ asset(ltrim($bg, '/')) }}')"@endif>
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="stats">
      @foreach($d['items'] ?? [] as $item)
        <div class="stat">
          <span class="num{{ !empty($item['signal']) ? ' signal' : '' }}">{{ $item['value'] ?? '' }}</span>
          <span class="lbl">{{ $item['label'] ?? '' }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
