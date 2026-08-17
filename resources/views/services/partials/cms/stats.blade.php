@php $d = $s['stats'] ?? []; @endphp
<section class="section sec-ink numbers">
  <div class="wrap numbers-in">
    <div class="sec-head sec-head--tight">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
    </div>
    <div class="stats">
      @foreach($d['items'] ?? [] as $item)
        <div class="stat">
          <b>{{ $item['value'] ?? '' }}@if(!empty($item['unit']))<span class="u">{{ $item['unit'] }}</span>@endif</b>
          <span>{{ $item['label'] ?? '' }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
