@php $d = $s['answer'] ?? []; $viz = $d['viz'] ?? []; @endphp
<section class="sec-ink">
  <div class="wrap">
    <div class="answer-grid">
      <div class="answer-copy reveal">
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
        @if(!empty($d['lede_html']))
          <p class="lede">{!! $d['lede_html'] !!}</p>
        @elseif(!empty($d['lede']))
          <p class="lede">{{ $d['lede'] }}</p>
        @endif

        <ul class="answer-list">
          @foreach($d['items'] ?? [] as $item)
            <li>
              <span class="check">✓</span>
              <div class="txt">
                <strong>{{ $item['title'] ?? '' }}</strong>
                <span>{{ $item['body'] ?? '' }}</span>
              </div>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="answer-visual reveal">
        <div class="answer-viz-card">
          <div class="viz-header">
            <div class="viz-title">{{ $viz['title'] ?? 'PageSpeed Report — After Launch' }}</div>
            <div class="viz-badge">{{ $viz['badge'] ?? 'Live' }}</div>
          </div>
          @foreach($viz['rows'] ?? [] as $row)
            <div class="viz-row">
              <span class="viz-label">{{ $row['label'] ?? '' }}</span>
              <span class="viz-val{{ !empty($row['good']) ? ' good' : '' }}">{{ $row['value'] ?? '' }}</span>
            </div>
          @endforeach
          <div class="viz-foot">
            <div class="viz-score">{{ $viz['score'] ?? 'A+' }}</div>
            <div class="note">{{ $viz['note'] ?? '' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
