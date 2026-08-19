@php $d = $s['intro'] ?? []; @endphp
<section class="intro sec-paper">
  <div class="wrap intro-grid">
    <div>
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h3>{{ $d['title'] ?? '' }}</h3>
      @foreach($d['paragraphs_html'] ?? ($d['paragraphs'] ?? []) as $p)
        <p>@if(!empty($p['html'])){!! $p['html'] !!}@else{{ is_array($p) ? ($p['text'] ?? '') : $p }}@endif</p>
      @endforeach
    </div>
    <div class="intro-card">
      <div class="big">{{ $d['card_value'] ?? '' }}</div>
      <div class="lbl">{{ $d['card_label'] ?? '' }}</div>
      <hr>
      @foreach($d['card_rows'] ?? [] as $row)
        <div class="row">
          <svg viewBox="0 0 24 24" fill="none"><path d="M20 6 9 17l-5-5" stroke="#F47A1F" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span>{{ is_array($row) ? ($row['text'] ?? '') : $row }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
