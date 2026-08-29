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
  $ogImagePath = $seo['og_image'] ?? ($site['og_image'] ?? 'media/blog/hero-background.jpg');
  $ogImage = str_starts_with($ogImagePath, 'http') ? $ogImagePath : asset(ltrim($ogImagePath, '/'));
  $canonical = !empty($seo['canonical_url']) ? $seo['canonical_url'] : url()->current();
  $robots = $seo['robots'] ?? ($site['robots'] ?? 'index, follow');
  $brand = $site['brand_name'] ?? 'KodRank';
  $ogType = $seo['og_type'] ?? 'website';
  $twitterCard = $site['twitter_card'] ?? 'summary_large_image';
  $twitterSite = $site['twitter_site'] ?? '';
  $locale = str_replace('_', '-', app()->getLocale());
@endphp
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="robots" content="{{ $robots }}">
<meta name="author" content="{{ $brand }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="{{ $brand }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
@if(!empty($seo['og_image_alt']))
<meta property="og:image:alt" content="{{ $seo['og_image_alt'] }}">
@endif
<meta property="og:locale" content="{{ $locale }}">

<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">
@if($twitterSite !== '')
<meta name="twitter:site" content="{{ $twitterSite }}">
@endif

<meta name="theme-color" content="#0A1A22">
@include('partials.favicon')

@stack('schema')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ @filemtime(public_path('css/home.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/home-extra.css') }}?v={{ @filemtime(public_path('css/home-extra.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/page-industries.css') }}?v={{ @filemtime(public_path('css/page-industries.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/service-page-extra.css') }}?v={{ @filemtime(public_path('css/service-page-extra.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ @filemtime(public_path('css/blog.css')) ?: time() }}">
@stack('head')
</head>
<body class="page-service page-blog">
@php $navStuck = false; @endphp
@include('home.partials.nav')
@yield('content')
@include('home.partials.footer')
<script src="{{ asset('js/home.js') }}?v={{ @filemtime(public_path('js/home.js')) ?: time() }}" defer></script>
@include('partials.recaptcha-script')
@stack('scripts')
</body>
</html>
