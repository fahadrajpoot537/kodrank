@php $d = $s['process'] ?? []; @endphp
<section class="sec-mist" id="process">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="proc">
      @foreach($d['steps'] ?? [] as $step)
        <div class="pstep">
          <div class="pn">{{ $step['num'] ?? $loop->iteration }}</div>
          <h4>{{ $step['title'] ?? '' }}</h4>
          <p>{{ $step['body'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
