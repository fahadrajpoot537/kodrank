@php
  $d = $s['hero'] ?? [];
  $heroImg = asset($d['image'] ?? 'media/services/web-design/hero.jpg');
@endphp
<header class="hero">
  <div class="hero-bg" style="background-image:url('{{ $heroImg }}')"></div>
  <div class="hero-blur"></div>
  <div class="hero-in">
    <div class="hero-inner">
      @include('services.partials.shared.breadcrumb', ['crumbs' => $d['breadcrumb'] ?? null])
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
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
      <div class="hero-ctas">
        <a href="{{ $d['cta_url'] ?? '#cta' }}" class="btn btn-primary">
          {{ $d['cta_text'] ?? 'Start Your Project' }}
          <span class="arrow">→</span>
        </a>
      </div>
      @if(!empty($d['badges']))
        <div class="hero-badges">
          @foreach($d['badges'] as $badge)
            <div class="hero-badge"><span class="dot"></span> {{ $badge['label'] ?? '' }}</div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</header>
