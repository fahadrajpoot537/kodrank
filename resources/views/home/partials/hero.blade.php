<section class="hero" id="top">
  <div class="hero-media">
    <img
      class="hero-poster"
      src="{{ asset('media/hero-poster.jpg') }}"
      alt="{{ $c['site']['hero_image_alt'] ?? ($c['hero']['video_alt'] ?? 'KodRank web development and SEO services') }}"
      width="1920"
      height="1080"
      decoding="async"
      fetchpriority="high"
    >
    <video id="heroVideo"
      autoplay muted loop playsinline disablepictureinpicture preload="metadata"
      poster="{{ asset('media/hero-poster.jpg') }}"
      aria-label="{{ $c['hero']['video_alt'] ?? 'KodRank web development and SEO services background video' }}">
      <source src="{{ asset('media/hero.webm') }}" type="video/webm">
      <source src="{{ asset('media/hero.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-scrim" aria-hidden="true"></div>
  </div>

  <div class="hero-in">
    <h1>{{ $c['hero']['title'] ?? '' }}@if(!empty($c['hero']['title_em'])) <em>{{ $c['hero']['title_em'] }}</em>@endif</h1>
    @if(!empty($c['hero']['sub']))
      <p class="hero-sub">{{ $c['hero']['sub'] }}</p>
    @endif
    @if(!empty($c['hero']['supporting']))
      <p class="hero-supporting">{{ $c['hero']['supporting'] }}</p>
    @endif
    <div class="hero-actions">
      @if(!empty($c['hero']['primary_cta_text']))
        <a class="btn btn-primary" href="{{ $c['hero']['primary_cta_url'] ?? '#contact' }}">{{ $c['hero']['primary_cta_text'] }}
          <svg viewBox="0 0 16 16" fill="none"><path d="M2 8h11m0 0-4.2-4.2M13 8l-4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      @endif
      @if(!empty($c['hero']['secondary_cta_text']))
        <a class="btn btn-ghost-light" href="{{ $c['hero']['secondary_cta_url'] ?? '#process' }}">{{ $c['hero']['secondary_cta_text'] }}</a>
      @endif
    </div>
  </div>
</section>
