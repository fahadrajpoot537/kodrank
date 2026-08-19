<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@php
  $site = $c['site'] ?? [];
  $seo = $seo ?? [];
  $seoTitle = $seo['seo_title'] ?? ($site['seo_title'] ?? ($site['meta_title'] ?? ($site['brand_name'] ?? 'KodRank')));
  $seoDescription = $seo['seo_description'] ?? ($site['seo_description'] ?? ($site['meta_description'] ?? ''));
  $ogTitle = $seo['og_title'] ?? ($site['og_title'] ?? $seoTitle);
  $ogDescription = $seo['og_description'] ?? ($site['og_description'] ?? $seoDescription);
  $ogImagePath = $seo['og_image'] ?? ($site['og_image'] ?? 'media/hero-poster.jpg');
  $ogImage = str_starts_with($ogImagePath, 'http') ? $ogImagePath : asset(ltrim($ogImagePath, '/'));
  $canonical = !empty($seo['canonical_url']) ? $seo['canonical_url'] : (!empty($site['canonical_url']) ? $site['canonical_url'] : url()->current());
  $robots = $seo['robots'] ?? ($site['robots'] ?? 'index, follow');
  $keywords = $seo['keywords'] ?? ($site['keywords'] ?? 'digital marketing services, SEO services, KodRank');
  $brand = $site['brand_name'] ?? 'KodRank';
  $ogType = $seo['og_type'] ?? ($site['og_type'] ?? 'website');
  $twitterCard = $seo['twitter_card'] ?? ($site['twitter_card'] ?? 'summary_large_image');
  $twitterSite = $site['twitter_site'] ?? '';
  $locale = str_replace('_', '-', app()->getLocale());
@endphp
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
@if($keywords !== '')
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robots }}">
<meta name="author" content="{{ $brand }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ $brand }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:locale" content="{{ $locale }}">

<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">
@if($twitterSite !== '')
<meta name="twitter:site" content="{{ $twitterSite }}">
@endif

<meta name="theme-color" content="#0A1A22">
<meta name="format-detection" content="telephone=yes">
@include('partials.favicon')

@if(!empty($s['faq']['items']))
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($item) => [
        '@type' => 'Question',
        'name' => $item['q'] ?? '',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $item['a'] ?? '',
        ],
    ], $s['faq']['items']),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endif
@if(!empty($seo['schema_json']))
  @php
    $schemaJson = is_string($seo['schema_json']) ? trim($seo['schema_json']) : '';
    $schemaDecoded = $schemaJson !== '' ? json_decode($schemaJson, true) : null;
  @endphp
  @if(is_array($schemaDecoded))
<script type="application/ld+json">
{!! json_encode($schemaDecoded, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
  @endif
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ @filemtime(public_path('css/home.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/home-extra.css') }}?v={{ @filemtime(public_path('css/home-extra.css')) ?: time() }}">
@php
  $serviceTheme = ($seo['theme'] ?? null)
    ?: (($page->slug ?? '') === 'web-design-and-development-services' ? 'web-development' : 'digital-marketing');
  // about + seo-service reuse the digital-marketing visual system
  $cssTheme = $serviceTheme === 'web-development' ? 'web-development' : 'digital-marketing';
  $bodyExtras = '';
  if ($serviceTheme === 'seo-service') {
      $bodyExtras .= ' page-seo-service';
  }
  if ($serviceTheme === 'about') {
      $bodyExtras .= ' page-about';
  }
  if ($serviceTheme === 'wordpress') {
      $bodyExtras .= ' page-wordpress';
  }
  if ($serviceTheme === 'ai-chatbot') {
      $bodyExtras .= ' page-ai-chatbot';
  }
  // themes that ship a complete, self-scoped component sheet
  $standaloneThemes = ['wordpress', 'ai-chatbot', 'cms', 'website-redesign', 'shopify', 'saas-seo', 'monthly-seo'];
@endphp
@if(in_array($serviceTheme, $standaloneThemes, true))
  {{-- these themes ship their own complete component sheet; loading another theme sheet would fight it --}}
@elseif($cssTheme === 'web-development')
  <link rel="stylesheet" href="{{ asset('css/service-web-development.css') }}?v={{ @filemtime(public_path('css/service-web-development.css')) ?: time() }}">
  <link rel="stylesheet" href="{{ asset('css/service-web-extra.css') }}?v={{ @filemtime(public_path('css/service-web-extra.css')) ?: time() }}">
@else
  <link rel="stylesheet" href="{{ asset('css/service-digital-marketing.css') }}?v={{ @filemtime(public_path('css/service-digital-marketing.css')) ?: time() }}">
@endif
<link rel="stylesheet" href="{{ asset('css/service-page-extra.css') }}?v={{ @filemtime(public_path('css/service-page-extra.css')) ?: time() }}">
@if($serviceTheme === 'about')
  <link rel="stylesheet" href="{{ asset('css/service-about.css') }}?v={{ @filemtime(public_path('css/service-about.css')) ?: time() }}">
@endif
@if($serviceTheme === 'wordpress')
  <link rel="stylesheet" href="{{ asset('css/service-wordpress.css') }}?v={{ @filemtime(public_path('css/service-wordpress.css')) ?: time() }}">
@endif
@if($serviceTheme === 'ai-chatbot')
  <link rel="stylesheet" href="{{ asset('css/service-ai-chatbot.css') }}?v={{ @filemtime(public_path('css/service-ai-chatbot.css')) ?: time() }}">
@endif
@if($serviceTheme === 'cms')
  <link rel="stylesheet" href="{{ asset('css/service-cms.css') }}?v={{ @filemtime(public_path('css/service-cms.css')) ?: time() }}">
@endif
@if($serviceTheme === 'website-redesign')
  <link rel="stylesheet" href="{{ asset('css/service-redesign.css') }}?v={{ @filemtime(public_path('css/service-redesign.css')) ?: time() }}">
@endif
@if($serviceTheme === 'shopify')
  <link rel="stylesheet" href="{{ asset('css/service-shopify.css') }}?v={{ @filemtime(public_path('css/service-shopify.css')) ?: time() }}">
@endif
@if($serviceTheme === 'saas-seo')
  <link rel="stylesheet" href="{{ asset('css/service-saas.css') }}?v={{ @filemtime(public_path('css/service-saas.css')) ?: time() }}">
@endif
@if($serviceTheme === 'monthly-seo')
  <link rel="stylesheet" href="{{ asset('css/service-monthly.css') }}?v={{ @filemtime(public_path('css/service-monthly.css')) ?: time() }}">
@endif
@stack('head')
</head>
<body class="page-service{{ $cssTheme === 'web-development' ? ' page-web-dev' : '' }}{{ $bodyExtras }}">
@php $navStuck = false; @endphp
@include('home.partials.nav')
@php
  $pageWrapper = match ($serviceTheme) {
      'ai-chatbot' => 'ac-page',
      'cms' => 'cms-page',
      'website-redesign' => 'rd-page',
      'shopify' => 'shop-page',
      'saas-seo' => 'saas-page',
      'monthly-seo' => 'mo-page',
      default => null,
  };
@endphp
@if($pageWrapper)
  <main class="{{ $pageWrapper }}">@yield('content')</main>
@else
  @yield('content')
@endif
@include('home.partials.footer')
<script src="{{ asset('js/home.js') }}?v={{ @filemtime(public_path('js/home.js')) ?: time() }}" defer></script>
<script src="{{ asset('js/service-page.js') }}?v={{ @filemtime(public_path('js/service-page.js')) ?: time() }}" defer></script>
@stack('scripts')
</body>
</html>
