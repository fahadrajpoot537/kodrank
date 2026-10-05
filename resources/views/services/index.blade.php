@extends('layouts.site')

@php
  $idx = $idx ?? array_merge(\App\Support\CmsPageDefaults::servicesIndex(), is_array($c['services_index'] ?? null) ? $c['services_index'] : []);
  $seoGroup = $groups->firstWhere('slug', $idx['seo_group_slug'] ?? 'digital-marketing-services');
  $webGroup = $groups->firstWhere('slug', $idx['web_group_slug'] ?? 'web-design-and-development-services');

  $icons = [
    'digital-marketing-services' => '<path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
    'monthly-seo-services' => '<path d="M3 3v18h18"/><path d="M7 14l4-4 3 3 5-6"/>',
    'on-page-seo-services' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 8h10M7 12h7M7 16h5"/>',
    'off-page-seo-services' => '<path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/>',
    'technical-seo-services' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9c.36 0 .7.07 1 .2"/>',
    'saas-seo-services' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
    'aeo-services' => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/><path d="M11 8v6M8 11h6"/>',
    'geo-services' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'b2b-seo-services' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>',
    'ecommerce-seo-services' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>',
    'wordpress-seo-services' => '<circle cx="12" cy="12" r="10"/><path d="m5 8 4 10 3-8 3 8 4-10"/>',
    'web-design-and-development-services' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>',
    'wordpress-development-services' => '<circle cx="12" cy="12" r="10"/><path d="m5 8 4 10 3-8 3 8 4-10"/>',
    'shopify-development-services' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>',
    'cms-development-services' => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14a9 3 0 0 0 18 0V5"/><path d="M3 12a9 3 0 0 0 18 0"/>',
    'website-redesign-services' => '<path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/>',
    'ai-chatbot-development-services' => '<rect x="3" y="8" width="18" height="12" rx="3"/><path d="M12 8V5M8 3h8M8 14h.01M16 14h.01"/>',
  ];

  $defaultIcon = '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12h8"/>';

  $seoPages = collect();
  if ($seoGroup) {
      $seoPages->push($seoGroup);
      $seoPages = $seoPages->merge($seoGroup->children);
  }

  $webPages = collect();
  if ($webGroup) {
      $webPages->push($webGroup);
      $webPages = $webPages->merge($webGroup->children);
  }

  $totalServices = $seoPages->count() + $webPages->count();
@endphp

@push('head')
<link rel="stylesheet" href="{{ asset('css/services-index.css') }}?v={{ @filemtime(public_path('css/services-index.css')) ?: time() }}">
@endpush

@section('content')
@include('home.partials.nav')

<section class="svc-index-hero" id="top">
  <div class="wrap svc-index-hero-grid">
    <div>
      @include('services.partials.shared.breadcrumb', [
        'crumbs' => [
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Services', 'url' => ''],
        ],
      ])
      <h1>{{ $idx['hero_title'] ?? 'Everything you need to' }} <span class="accent">{{ $idx['hero_title_accent_1'] ?? 'rank higher' }}</span> {{ $idx['hero_title_and'] ?? 'and' }} <span class="accent">{{ $idx['hero_title_accent_2'] ?? 'convert more' }}</span>.</h1>
      <p class="lede">{{ $idx['hero_lede'] ?? '' }}</p>
      <div class="svc-index-actions">
        <a href="{{ route('contact') }}" class="svc-index-btn svc-index-btn-primary">{{ $idx['cta_primary'] ?? 'Book A Free Audit' }} <span class="arw">→</span></a>
        <a href="#seo" class="svc-index-btn svc-index-btn-ghost">{{ $idx['cta_secondary'] ?? 'Browse Services' }} <span class="arw">→</span></a>
      </div>
    </div>
    <div class="svc-index-stats">
      <div class="stat"><div class="num">{{ $totalServices ?: 14 }}</div><div class="lbl">{{ $idx['stat_1_label'] ?? 'Specialist Services' }}</div></div>
      <div class="stat"><div class="num">{{ $idx['stat_2_value'] ?? '2' }}</div><div class="lbl">{{ $idx['stat_2_label'] ?? 'Core Disciplines' }}</div></div>
      <div class="stat"><div class="num">{{ $idx['stat_3_value'] ?? '100%' }}</div><div class="lbl">{{ $idx['stat_3_label'] ?? 'In-House Team' }}</div></div>
    </div>
  </div>
</section>

<div class="svc-index-jump">
  <div class="wrap svc-index-jump-inner">
    <span class="jump-label">{{ $idx['jump_label'] ?? 'Jump to' }}</span>
    <a href="#seo" class="chip"><span class="dot"></span>{{ $idx['jump_seo'] ?? 'SEO & Search Growth' }}</a>
    <a href="#webdev" class="chip"><span class="dot"></span>{{ $idx['jump_web'] ?? 'Web Design & Development' }}</a>
    <a href="#cta" class="chip"><span class="dot"></span>{{ $idx['jump_cta'] ?? 'Talk To Us' }}</a>
  </div>
</div>

@if($seoPages->isNotEmpty())
<section class="svc-index-sec sec-ink" id="seo">
  <div class="wrap">
    <div class="svc-index-head">
      <span class="svc-index-eyebrow">{{ $idx['seo_eyebrow'] ?? 'SEO & Search Growth' }}</span>
      <h2>{{ $idx['seo_title_h2'] ?? 'Get found where your customers are' }} <span class="accent">{{ $idx['seo_title_accent'] ?? 'searching' }}</span>.</h2>
      <p>{{ $idx['seo_lede'] ?? '' }}</p>
    </div>
    <div class="svc-index-grid">
      @foreach($seoPages as $svc)
        @php
          $cardTag = \App\Support\ServiceListingCopy::tag($svc);
          $cardBlurb = \App\Support\ServiceListingCopy::blurb($svc);
          $cardIcon = trim((string) ($svc->seo['listing_icon'] ?? ''));
        @endphp
        <a href="/{{ ltrim($svc->slug, '/') }}" class="svc-card svc-card-dark">
          @if($cardTag !== '')
            <span class="svc-tag">{{ $cardTag }}</span>
          @endif
          <div class="icn-tile" aria-hidden="true">
            @if($cardIcon !== '')
              <img src="{{ asset(ltrim($cardIcon, '/')) }}" alt="" width="24" height="24">
            @else
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$svc->slug] ?? $defaultIcon !!}</svg>
            @endif
          </div>
          <h3>{{ $svc->name }}</h3>
          <p>{{ $cardBlurb }}</p>
          <span class="tlink">{{ $idx['card_cta'] ?? 'Explore service' }} <span class="arw">→</span></span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@if($webPages->isNotEmpty())
<section class="svc-index-sec sec-mist" id="webdev">
  <div class="wrap">
    <div class="svc-index-head">
      <span class="svc-index-eyebrow">{{ $idx['web_eyebrow'] ?? 'Web Design & Development' }}</span>
      <h2>{{ $idx['web_title_h2'] ?? 'Websites built to' }} <span class="accent-deep">{{ $idx['web_title_accent'] ?? 'perform' }}</span>{{ $idx['web_title_after'] ?? ', not just look good.' }}</h2>
      <p>{{ $idx['web_lede'] ?? '' }}</p>
    </div>
    <div class="svc-index-grid">
      @foreach($webPages as $svc)
        @php
          $cardTag = \App\Support\ServiceListingCopy::tag($svc);
          $cardBlurb = \App\Support\ServiceListingCopy::blurb($svc);
          $cardIcon = trim((string) ($svc->seo['listing_icon'] ?? ''));
        @endphp
        <a href="/{{ ltrim($svc->slug, '/') }}" class="svc-card svc-card-light">
          @if($cardTag !== '')
            <span class="svc-tag">{{ $cardTag }}</span>
          @endif
          <div class="icn-tile" aria-hidden="true">
            @if($cardIcon !== '')
              <img src="{{ asset(ltrim($cardIcon, '/')) }}" alt="" width="24" height="24">
            @else
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$svc->slug] ?? $defaultIcon !!}</svg>
            @endif
          </div>
          <h3>{{ $svc->name }}</h3>
          <p>{{ $cardBlurb }}</p>
          <span class="tlink">{{ $idx['card_cta'] ?? 'Explore service' }} <span class="arw">→</span></span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<section class="svc-index-cta" id="cta">
  <div class="wrap">
    <div class="svc-index-cta-card">
      <div>
        <span class="svc-index-eyebrow">{{ $idx['bottom_eyebrow'] ?? 'Ready When You Are' }}</span>
        <h2>{{ $idx['bottom_title'] ?? 'Not sure which service you need?' }} <span class="accent">{{ $idx['bottom_title_accent'] ?? 'Let\'s map it out.' }}</span></h2>
        <p>{{ $idx['bottom_lede'] ?? '' }}</p>
      </div>
      <div class="svc-index-cta-actions">
        <a href="{{ route('contact') }}" class="svc-index-btn svc-index-btn-primary">{{ $idx['bottom_cta_primary'] ?? 'Get A Free Quote' }} <span class="arw">→</span></a>
        <a href="{{ route('contact') }}" class="svc-index-btn svc-index-btn-ghost">{{ $idx['bottom_cta_secondary'] ?? 'Book A Strategy Call' }} <span class="arw">→</span></a>
      </div>
    </div>
  </div>
</section>

@include('home.partials.footer')
@endsection
