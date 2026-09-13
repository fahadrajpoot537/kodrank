@php
  $d = $s['intro'] ?? [];
  $stats = $d['stats'] ?? [];
  $paragraphs = $d['paragraphs_html'] ?? ($d['paragraphs'] ?? []);
  $lead = null;
  $body = [];
  foreach ($paragraphs as $i => $p) {
      if ($i === 0 && is_array($p) && !empty($p['html']) && empty($d['lead_html'])) {
          $lead = $p['html'];
          continue;
      }
      $body[] = $p;
  }
  if (!empty($d['lead_html'])) {
      $lead = $d['lead_html'];
      $body = $paragraphs;
  }
@endphp
<section class="sec-paper dm-intro service-intro" id="intro">
  <div class="wrap">
    <div class="dm-intro-grid">
      <div class="service-intro-body">
        @if(!empty($d['eyebrow']))
          <span class="eyebrow">{{ $d['eyebrow'] }}</span>
        @endif
        @if(!empty($d['title_html']))
          <h2 class="dm-intro-title">{!! $d['title_html'] !!}</h2>
        @elseif(!empty($d['title']))
          <h2 class="dm-intro-title">{{ $d['title'] }}</h2>
        @endif
        @if(!empty($lead))
          <h3 class="service-intro-h3">{!! $lead !!}</h3>
        @endif
        @foreach($body as $p)
          <p>
            @if(is_array($p) && !empty($p['html'])){!! $p['html'] !!}
            @elseif(is_array($p)){{ $p['text'] ?? '' }}
            @else{{ $p }}@endif
          </p>
        @endforeach
      </div>

      @if(!empty($stats) || !empty($d['card_value']) || !empty($d['card_rows']))
        <aside class="dm-intro-card service-intro-side" aria-label="{{ $d['card_title'] ?? 'Results at a glance' }}">
          @if(!empty($d['card_title']))
            <h4>{{ $d['card_title'] }}</h4>
          @endif

          @if(!empty($stats))
            <div class="service-intro-stats">
              @foreach($stats as $stat)
                <div class="service-intro-stat">
                  <div class="num">{{ $stat['num'] ?? $stat['value'] ?? '' }}</div>
                  <span class="lbl">{{ $stat['label'] ?? $stat['lbl'] ?? '' }}</span>
                </div>
              @endforeach
            </div>
          @else
            @if(!empty($d['card_value']))
              <div class="dm-intro-big">{{ $d['card_value'] }}</div>
            @endif
            @if(!empty($d['card_label']))
              <div class="dm-intro-lbl">{{ $d['card_label'] }}</div>
            @endif
            @if(!empty($d['card_rows']))
              <hr>
              <ul class="compare-list">
                @foreach($d['card_rows'] as $row)
                  <li><span class="mark v">✓</span> {{ is_array($row) ? ($row['text'] ?? '') : $row }}</li>
                @endforeach
              </ul>
            @endif
          @endif
        </aside>
      @endif
    </div>
  </div>
</section>
