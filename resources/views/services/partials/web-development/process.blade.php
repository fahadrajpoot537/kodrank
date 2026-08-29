@php $d = $s['process'] ?? []; @endphp
<section class="sec-paper" id="process">
  <div class="wrap">
    <div class="section-head reveal in">
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="process-list">
      @foreach($d['steps'] ?? [] as $step)
        <div class="proc process-step reveal in">
          <div class="step-badge num">{{ $step['num'] ?? '' }}</div>
          <h3>{{ $step['title'] ?? '' }}</h3>
          <p>{{ $step['body'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
