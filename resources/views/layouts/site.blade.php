<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="La0Efnwf3komQ9_YBkgrh6FM0y_BiiBlKWhkjiO1b-k" />
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

@if(request()->routeIs('home'))
{{-- Homepage JSON-LD schema (frontend theme head) --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "OnlineBusiness",
      "@id": "https://kodrank.com/#organization",
      "name": "KodRank",
      "url": "https://kodrank.com/",
      "logo": {
        "@type": "ImageObject",
        "@id": "https://kodrank.com/#logo",
        "url": "https://kodrank.com/logo.png",
        "contentUrl": "https://kodrank.com/logo.png",
        "caption": "KodRank"
      },
      "image": {
        "@id": "https://kodrank.com/#logo"
      },
      "description": "KodRank builds fast, technically sound websites with SEO engineered in from the first line of code, so your site launches indexed, structured and ready to rank. One team, one package, no second invoice.",
      "slogan": "Built to be found.",
      "email": "info@kodrank.com",
      "telephone": "+92-305-9202732",
      "areaServed": "Worldwide",
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service",
        "telephone": "+92-305-9202732",
        "email": "info@kodrank.com",
        "url": "https://kodrank.com/contact",
        "areaServed": "Worldwide",
        "availableLanguage": ["English"]
      },
      "sameAs": [
        "https://www.facebook.com/kodrank/",
        "https://x.com/kodrank_",
        "https://www.youtube.com/@KodRank_official",
        "https://www.instagram.com/kodrank_official/",
        "https://www.linkedin.com/company/kodrank"
      ],
      "knowsAbout": [
        "Web Development",
        "Search Engine Optimization",
        "Technical SEO",
        "On-Page SEO",
        "Off-Page SEO",
        "Answer Engine Optimization",
        "Generative Engine Optimization",
        "WordPress Development",
        "Shopify Development",
        "E-commerce Development",
        "AI Chatbot Development",
        "Schema Markup",
        "Core Web Vitals"
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "KodRank Services",
        "url": "https://kodrank.com/services",
        "itemListElement": [
          {
            "@type": "OfferCatalog",
            "name": "Web Design and Development Services",
            "url": "https://kodrank.com/web-design-and-development-services",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Custom Website Development", "url": "https://kodrank.com/web-design-and-development-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "WordPress Development Services", "url": "https://kodrank.com/wordpress-development-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Shopify Development Services", "url": "https://kodrank.com/shopify-development-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "AI Chatbot Development Services", "url": "https://kodrank.com/ai-chatbot-development-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "CMS Development Services", "url": "https://kodrank.com/cms-development-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Website Redesign Services", "url": "https://kodrank.com/website-redesign-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "SaaS Software Development Services", "url": "https://kodrank.com/saas-software-development-services" } }
            ]
          },
          {
            "@type": "OfferCatalog",
            "name": "Digital Marketing Services",
            "url": "https://kodrank.com/digital-marketing-services",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Technical SEO Services", "url": "https://kodrank.com/technical-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "On-Page SEO Services", "url": "https://kodrank.com/on-page-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Off-Page SEO Services", "url": "https://kodrank.com/off-page-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Monthly SEO Services", "url": "https://kodrank.com/monthly-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Guest Posting Services", "url": "https://kodrank.com/guest-posting-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "AEO Services", "url": "https://kodrank.com/aeo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "GEO Services", "url": "https://kodrank.com/geo-services" } }
            ]
          },
          {
            "@type": "OfferCatalog",
            "name": "Industry SEO Services",
            "url": "https://kodrank.com/industries",
            "itemListElement": [
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "B2B SEO Services", "url": "https://kodrank.com/b2b-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "SaaS SEO Services", "url": "https://kodrank.com/saas-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Ecommerce SEO Services", "url": "https://kodrank.com/ecommerce-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Healthcare SEO Services", "url": "https://kodrank.com/healthcare-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Real Estate SEO Services", "url": "https://kodrank.com/real-estate-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Restaurant SEO Services", "url": "https://kodrank.com/restaurant-seo-services" } },
              { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Electrician Website Design Services", "url": "https://kodrank.com/electrician-website-design-services" } }
            ]
          }
        ]
      }
    },
    {
      "@type": "WebSite",
      "@id": "https://kodrank.com/#website",
      "url": "https://kodrank.com/",
      "name": "KodRank",
      "description": "Web development and SEO services under one roof.",
      "inLanguage": "en",
      "publisher": {
        "@id": "https://kodrank.com/#organization"
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://kodrank.com/#webpage",
      "url": "https://kodrank.com/",
      "name": "Web Development & SEO Services in One Build | KodRank",
      "description": "KodRank builds fast, technically sound websites with SEO engineered in from the first line of code, so your site launches indexed, structured and ready to rank. One team, one package, no second invoice.",
      "inLanguage": "en",
      "isPartOf": {
        "@id": "https://kodrank.com/#website"
      },
      "about": {
        "@id": "https://kodrank.com/#organization"
      },
      "primaryImageOfPage": {
        "@type": "ImageObject",
        "url": "https://kodrank.com/media/hero-poster.jpg",
        "contentUrl": "https://kodrank.com/media/hero-poster.jpg",
        "caption": "KodRank — custom web development and SEO services built to rank from launch day"
      },
      "breadcrumb": {
        "@id": "https://kodrank.com/#breadcrumb"
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "https://kodrank.com/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://kodrank.com/"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "@id": "https://kodrank.com/#faq",
      "isPartOf": {
        "@id": "https://kodrank.com/#webpage"
      },
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Do I still need to hire an SEO agency after you build my site?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No — that’s the entire point. Your website leaves our hands technically sound and fully optimized: structured content, schema, clean code, fast load times, and keyword-targeted pages. There’s no cleanup project waiting for you, because the SEO work is built into the development itself."
          }
        },
        {
          "@type": "Question",
          "name": "What does “web development and SEO services in one package” actually include?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "A complete build: custom development, technical SEO, on-page optimization, keyword research and strategy, SEO content writing, and conversion-first design — delivered together as one ranking-ready website, for one price, by one team."
          }
        },
        {
          "@type": "Question",
          "name": "How is this different from a normal web design agency?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "A design agency hands you a site that looks good and hopes it ranks. We architect every decision — sitemap, URLs, code, content — around how search engines crawl and how buyers convert. Search is the blueprint, not an afterthought bolted on once the site is live."
          }
        },
        {
          "@type": "Question",
          "name": "Will my new site actually load fast and pass Core Web Vitals?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. Speed is engineered at the code level from the first commit — clean markup, optimized assets, and lean frameworks rather than bloated templates. Passing Core Web Vitals is a default of how we build, not a fix we sell you later."
          }
        },
        {
          "@type": "Question",
          "name": "Is the content written by real people or AI?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Real people. Every page and blog is human-written and mapped to genuine search intent — engaging enough to read, and structured to win featured snippets. We use research tools to guide the strategy, but the words are written to be read."
          }
        }
      ]
    }
  ]
}
</script>
@else
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "OnlineBusiness",
      "@id": "https://kodrank.com/#organization",
      "name": "KodRank",
      "url": "https://kodrank.com/",
      "logo": {
        "@type": "ImageObject",
        "@id": "https://kodrank.com/#logo",
        "url": "https://kodrank.com/logo.png",
        "contentUrl": "https://kodrank.com/logo.png",
        "caption": "KodRank"
      },
      "image": { "@id": "https://kodrank.com/#logo" },
      "description": "KodRank builds fast, technically sound websites with SEO engineered in from the first line of code, so your site launches indexed, structured and ready to rank. One team, one package, no second invoice.",
      "slogan": "Built to be found.",
      "email": "info@kodrank.com",
      "telephone": "+92-305-9202732",
      "areaServed": "Worldwide",
      "sameAs": [
        "https://www.facebook.com/kodrank/",
        "https://x.com/kodrank_",
        "https://www.youtube.com/@KodRank_official",
        "https://www.instagram.com/kodrank_official/",
        "https://www.linkedin.com/company/kodrank"
      ]
    },
    {
      "@type": "WebSite",
      "@id": "https://kodrank.com/#website",
      "url": "https://kodrank.com/",
      "name": "KodRank",
      "description": "Web development and SEO services under one roof.",
      "inLanguage": "en",
      "publisher": { "@id": "https://kodrank.com/#organization" }
    }
  ]
}
</script>
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ @filemtime(public_path('css/home.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/home-extra.css') }}?v={{ @filemtime(public_path('css/home-extra.css')) ?: time() }}">
<link rel="stylesheet" href="{{ asset('css/page-industries.css') }}?v={{ @filemtime(public_path('css/page-industries.css')) ?: time() }}">
@include('partials.clarity')
@stack('head')
</head>
@php $bodyClassAttr = $bodyClass !== '' ? ' class="'.e($bodyClass).'"' : ''; @endphp
<body{!! $bodyClassAttr !!}>
@yield('content')
<script src="{{ asset('js/home.js') }}?v={{ @filemtime(public_path('js/home.js')) ?: time() }}" defer></script>
@include('partials.recaptcha-script')
@stack('scripts')
</body>
</html>
