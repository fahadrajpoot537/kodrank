@php $d = $s['stats'] ?? []; @endphp
<section class="sec-ink stats-sec" id="results">
  <div class="stats-bg" aria-hidden="true"></div>
  <div class="stats-veil"></div>
  <div class="wrap">
    <div class="shead">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="stat-row">
      @foreach($d['items'] ?? [] as $item)
        <div class="stat"><b>{{ $item['value'] ?? '' }}</b><span>{{ $item['label'] ?? '' }}</span></div>
      @endforeach
    </div>
    @if(!empty($d['note']))<p class="stat-note">{{ $d['note'] }}</p>@endif
  </div>
</section>
