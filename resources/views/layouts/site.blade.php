<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@php
  $site = $c['site'] ?? [];
  $pageTitle = $pageTitle ?? null;
  $seoTitle = $pageTitle ?? ($site['seo_title'] ?? ($site['meta_title'] ?? ($site['brand_name'] ?? 'KodRank')));
  $seoDescription = $pageDescription ?? ($site['seo_description'] ?? ($site['meta_description'] ?? ''));
  $ogTitle = $site['og_title'] ?? $seoTitle;
  $ogDescription = $site['og_description'] ?? $seoDescription;
  $ogImagePath = !empty($pageOgImage) ? $pageOgImage : ($site['og_image'] ?? 'media/hero-poster.jpg');
  $ogImage = str_starts_with($ogImagePath, 'http') ? $ogImagePath : asset(ltrim($ogImagePath, '/'));
  $canonical = !empty($site['canonical_url']) && empty($pageTitle) ? $site['canonical_url'] : url()->current();
  $robots = $site['robots'] ?? 'index, follow';
  $keywords = $site['keywords'] ?? 'web development, SEO services, technical SEO, custom websites, KodRank';
  $brand = $site['brand_name'] ?? 'KodRank';
  $ogType = $site['og_type'] ?? 'website';
  $twitterCard = $site['twitter_card'] ?? 'summary_large_image';
  $twitterSite = $site['twitter_site'] ?? '';
  $locale = str_replace('_', '-', app()->getLocale());
  $bodyClass = trim((string) ($bodyClass ?? ''));
@endphp
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
@if($keywords !== '')
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robots }}">
<meta name="author" content="{{ $brand }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph --}}
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ $brand }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:alt" content="{{ $site['og_image_alt'] ?? ($site['hero_image_alt'] ?? $brand.' — web development and SEO services') }}">
<meta property="og:locale" content="{{ $locale }}">

{{-- Twitter / X --}}
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="{{ $site['og_image_alt'] ?? ($site['hero_image_alt'] ?? $brand.' — web development and SEO services') }}">
@if($twitterSite !== '')
<meta name="twitter:site" content="{{ $twitterSite }}">
@endif

{{-- Theme color / mobile --}}
<meta name="theme-color" content="#0A1A22">
<meta name="format-detection" content="telephone=yes">
@include('partials.favicon')

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $brand,
    'url' => url('/'),
    'logo' => asset('media/hero-poster.jpg'),
    'email' => $site['email'] ?? null,
    'telephone' => $site['phone'] ?? null,
    'description' => $seoDescription,
    'sameAs' => array_values(array_filter(array_map(
        fn ($s) => (($s['url'] ?? '') !== '' && ($s['url'] ?? '') !== '#') ? $s['url'] : null,
        $c['footer']['social'] ?? []
    ))),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $brand,
    'url' => url('/'),
    'description' => $seoDescription,
    'publisher' => [
        '@type' => 'Organization',
        'name' => $brand,
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@if(!empty($c['faq']['items']))
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
    ], $c['faq']['items']),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ @filemtime(public_path('css/home.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/home-extra.css') }}?v={{ @filemtime(public_path('css/home-extra.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/page-industries.css') }}?v={{ @filemtime(public_path('css/page-industries.css')) ?: time() }}">
@stack('head')
</head>
@php $bodyClassAttr = $bodyClass !== '' ? ' class="'.e($bodyClass).'"' : ''; @endphp
<body{!! $bodyClassAttr !!}>
@yield('content')
<script src="{{ asset('js/home.js') }}" defer></script>
@include('partials.recaptcha-script')
@stack('scripts')
</body>
</html>
