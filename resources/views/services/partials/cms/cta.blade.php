@php $d = $s['cta'] ?? []; @endphp
<section class="section sec-ink">
  <div class="wrap cta-band">
    @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
    <h2>{{ $d['title'] ?? '' }}</h2>
    @if(!empty($d['body']))<p class="lede">{{ $d['body'] }}</p>@endif
    <div class="hero-cta">
      @if(!empty($d['cta_text']))
        <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }}
          <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      @endif
      @if(!empty($d['cta2_text']))
        <a href="{{ $d['cta2_url'] ?: '#services' }}" class="btn btn-ghost-light">{{ $d['cta2_text'] }}
          <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      @endif
    </div>
  </div>
</section>
