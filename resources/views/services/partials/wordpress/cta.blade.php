@php
  $d = $s['cta'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>';
@endphp
<section class="sec-ink cta-bg">
  <div class="wrap">
    <div class="cta-band">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['body']))<p>{{ $d['body'] }}</p>@endif
      @if(!empty($d['cta_text']))
        <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} {!! $arrow !!}</a>
      @endif
    </div>
  </div>
</section>
