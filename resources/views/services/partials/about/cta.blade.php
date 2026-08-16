@php $cta = $s['cta'] ?? []; @endphp
<section class="sec-ink about-cta-band">
  <div class="wrap">
    @if(!empty($cta['eyebrow']))
      <span class="eyebrow">{{ $cta['eyebrow'] }}</span>
    @endif
    <h2>
      @if(!empty($cta['title_html']))
        {!! $cta['title_html'] !!}
      @else
        {{ $cta['title'] ?? '' }}
      @endif
    </h2>
    @if(!empty($cta['lede'] ?? $cta['body'] ?? null))
      <p class="lede">{{ $cta['lede'] ?? $cta['body'] }}</p>
    @endif
    <div class="about-cta-actions">
      <a href="{{ $cta['cta_url'] ?? '#contact' }}" class="btn btn-primary">
        {{ $cta['cta_text'] ?? 'Get A Free Quote' }}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" width="16" height="16" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
      @if(!empty($cta['secondary_text']))
        <a href="{{ $cta['secondary_url'] ?? '/#work' }}" class="btn btn-ghost-light">
          {{ $cta['secondary_text'] }}
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" width="16" height="16" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      @endif
    </div>
  </div>
</section>
