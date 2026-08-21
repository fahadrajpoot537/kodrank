@php
  $d = $s['hero'] ?? [];
  $image = trim((string) ($d['image'] ?? ''));
  $arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>';
@endphp
<header class="wp-hero">
  @if($image !== '')
    <div class="wp-hero-visual">
      <img class="wp-hero-img" src="{{ asset(ltrim($image, '/')) }}" alt="{{ $d['image_alt'] ?? '' }}" loading="eager" fetchpriority="high">
    </div>
  @endif
  <div class="wrap">
    <div class="wp-hero-grid">
      <div class="wp-hero-copy">
        @include('services.partials.shared.breadcrumb', [
          'crumbs' => $d['breadcrumb'] ?? null,
          'navClass' => 'breadcrumb wp-breadcrumb',
        ])

        <h1>
          @if(!empty($d['title_html']))
            {!! $d['title_html'] !!}
          @else
            {{ $d['title'] ?? '' }}
          @endif
        </h1>

        @if(!empty($d['lede']))
          <p class="lede">{{ $d['lede'] }}</p>
        @endif

        <div class="wp-hero-cta">
          @if(!empty($d['cta_text']))
            <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} {!! $arrow !!}</a>
          @endif
          @if(!empty($d['cta2_text']))
            <a href="{{ $d['cta2_url'] ?: '#services' }}" class="btn btn-ghost-light">{{ $d['cta2_text'] }}</a>
          @endif
        </div>

        @if(!empty($d['badges']))
          <div class="wp-hero-badges">
            @foreach($d['badges'] as $badge)
              <div class="wp-hero-badge">
                <span class="num">
                  {{ $badge['num'] ?? '' }}@if(!empty($badge['unit']))<span class="unit">{{ $badge['unit'] }}</span>@endif
                </span>
                <span class="lbl">{{ $badge['label'] ?? '' }}</span>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</header>
