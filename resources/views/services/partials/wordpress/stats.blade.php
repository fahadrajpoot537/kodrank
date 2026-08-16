@php $d = $s['stats'] ?? []; @endphp
<section class="sec-ink stats-bg">
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
