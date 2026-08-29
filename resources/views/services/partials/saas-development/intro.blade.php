@php
  $d = $s['intro'] ?? [];
  $paras = $d['paragraphs_html'] ?? ($d['paragraphs'] ?? []);
  $bullets = $d['bullets'] ?? $d['card_rows'] ?? [];
  $sideTitle = $d['side_title'] ?? $d['card_value'] ?? 'What that means for you';
@endphp
<section class="sec" id="intro">
  <div class="wrap intro-grid">
    <div class="intro-copy rev">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h3>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? '' }}@endif
      </h3>
      @if(!empty($d['lede']))
        <p class="lede" style="margin-top:14px">{{ $d['lede'] }}</p>
      @endif
      @foreach($paras as $p)
        <p>
          @if(is_array($p) && !empty($p['html'])){!! $p['html'] !!}
          @elseif(is_array($p)){{ $p['text'] ?? '' }}
          @else{!! $p !!}@endif
        </p>
      @endforeach
    </div>
    @if(!empty($bullets))
      <aside class="intro-side rev">
        <h4>{{ $sideTitle }}</h4>
        <ul class="intro-list">
          @foreach($bullets as $b)
            @php $text = is_array($b) ? ($b['text'] ?? '') : (string) $b; @endphp
            <li><span class="tick">✓</span> {{ preg_replace('/^✓\s*/u', '', $text) }}</li>
          @endforeach
        </ul>
      </aside>
    @endif
  </div>
</section>
