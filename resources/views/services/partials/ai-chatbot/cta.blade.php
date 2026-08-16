@php $d = $s['cta'] ?? []; @endphp
<section class="sec-ink sec-cta">
  <div class="wrap">
    <div class="cta-band">
      @if(!empty($d['eyebrow']))<span class="eyebrow center">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['body']))<p>{{ $d['body'] }}</p>@endif
      <div class="cta-actions">
        @if(!empty($d['cta_text']))
          <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="arw">→</span></a>
        @endif
        @if(!empty($d['cta2_text']))
          <a href="{{ $d['cta2_url'] ?: '#services' }}" class="btn btn-ghost-light">{{ $d['cta2_text'] }} <span class="arw">→</span></a>
        @endif
      </div>
    </div>
  </div>
</section>
