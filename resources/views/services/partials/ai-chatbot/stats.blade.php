@php $d = $s['stats'] ?? []; @endphp
<section class="sec-ink sec-stats">
  <div class="wrap">
    <div class="sec-head tight">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
    </div>
    <div class="stats">
      @foreach($d['items'] ?? [] as $item)
        <div class="stat{{ !empty($item['highlight']) ? ' hi' : '' }}">
          <b>{{ $item['value'] ?? '' }}</b><span>{{ $item['label'] ?? '' }}</span>
        </div>
      @endforeach
    </div>
    @if(!empty($d['note']))<p class="stats-note">{{ $d['note'] }}</p>@endif
  </div>
</section>
