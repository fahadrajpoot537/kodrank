@php
  $d = $s['intro'] ?? [];
  $painCards = $s['pain']['cards'] ?? [];
  $paras = $d['paragraphs_html'] ?? ($d['paragraphs'] ?? []);
  $chk = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>';
@endphp
<section class="paper">
  <div class="wrap intro-grid">
    <div class="intro-copy rv">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h3>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? '' }}@endif
      </h3>
      @foreach($paras as $p)
        <p>
          @if(is_array($p) && !empty($p['html'])){!! $p['html'] !!}
          @elseif(is_array($p)){{ $p['text'] ?? '' }}
          @else{!! $p !!}@endif
        </p>
      @endforeach
    </div>
    @if(!empty($painCards))
      <div class="pain-list rv">
        @foreach($painCards as $card)
          <div class="pain">
            <span class="pi">{!! $chk !!}</span>
            <div>
              <h4>{{ $card['title'] ?? '' }}</h4>
              <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
