@php $pr = $s['process'] ?? []; @endphp
<section id="process" class="sec-paper">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $pr['eyebrow'] ?? 'How We Work' }}</span>
      <h2>
        @if(!empty($pr['title_html']))
          {!! $pr['title_html'] !!}
        @else
          {{ $pr['title'] ?? '' }}
        @endif
      </h2>
      <p>{{ $pr['lede'] ?? '' }}</p>
    </div>

    <div class="process-list">
      @foreach($pr['steps'] ?? [] as $step)
        <div class="proc">
          <span class="num">{{ $step['num'] ?? '' }}</span>
          <h4>{{ $step['title'] ?? '' }}</h4>
          <p>{{ $step['body'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
