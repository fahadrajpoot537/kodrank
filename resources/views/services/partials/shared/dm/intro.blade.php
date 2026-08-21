@php $d = $d ?? []; @endphp
<section class="sec-paper dm-intro" id="intro">
  <div class="wrap">
    <div class="dm-intro-grid">
      <div>
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h2 class="dm-intro-title">{{ $d['title'] ?? '' }}</h2>
        @foreach($d['paragraphs_html'] ?? ($d['paragraphs'] ?? []) as $p)
          <p class="lede" style="margin-bottom:14px">
            @if(is_array($p) && !empty($p['html'])){!! $p['html'] !!}
            @elseif(is_array($p)){{ $p['text'] ?? '' }}
            @else{{ $p }}@endif
          </p>
        @endforeach
      </div>
      @if(!empty($d['card_value']) || !empty($d['card_rows']))
        <aside class="dm-intro-card">
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
        </aside>
      @endif
    </div>
  </div>
</section>
