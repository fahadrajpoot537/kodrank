═══════════════════════════════════════════════════════════════
KODRANK — Restaurant SEO Services Landing Page
SEO-Optimized Image Package
═══════════════════════════════════════════════════════════════

All images are named with target keywords (restaurant-seo,
ranking, results) for file-name SEO signals. Both JPG and
WebP versions are included — serve WebP to modern browsers
for 40-55% smaller files and fall back to JPG.


───────────────────────────────────────────────────────────────
1. HERO BACKGROUND
───────────────────────────────────────────────────────────────

Files:
  restaurant-seo-services-hero-background-1920w.jpg   (desktop)
  restaurant-seo-services-hero-background-1920w.webp
  restaurant-seo-services-hero-background-1440w.jpg   (laptop)
  restaurant-seo-services-hero-background-1440w.webp
  restaurant-seo-services-hero-background-1024w.jpg   (tablet)
  restaurant-seo-services-hero-background-1024w.webp
  restaurant-seo-services-hero-background-768w.jpg    (mobile)
  restaurant-seo-services-hero-background-768w.webp
  restaurant-seo-services-hero-background-480w.jpg    (small mobile)
  restaurant-seo-services-hero-background-480w.webp

Alt text:
  "Restaurant SEO services — digital marketing dashboard showing
   local search optimization, Google Maps ranking, reviews, and
   website traffic growth for restaurants"

Implementation (CSS with responsive breakpoints):

  .hero-bg {
    background-image: url('/images/restaurant-seo-services-hero-background-1920w.webp');
    background-size: cover;
    background-position: right center;
  }
  @media (max-width: 1440px) {
    .hero-bg { background-image: url('/images/restaurant-seo-services-hero-background-1440w.webp'); }
  }
  @media (max-width: 1024px) {
    .hero-bg { background-image: url('/images/restaurant-seo-services-hero-background-1024w.webp'); }
  }
  @media (max-width: 768px) {
    .hero-bg {
      background-image: url('/images/restaurant-seo-services-hero-background-768w.webp');
      background-position: center;
    }
  }
  @media (max-width: 480px) {
    .hero-bg { background-image: url('/images/restaurant-seo-services-hero-background-480w.webp'); }
  }

JPG fallback (<picture> if using <img> instead of bg):

  <picture>
    <source srcset="restaurant-seo-services-hero-background-480w.webp"
            media="(max-width:480px)" type="image/webp">
    <source srcset="restaurant-seo-services-hero-background-768w.webp"
            media="(max-width:768px)" type="image/webp">
    <source srcset="restaurant-seo-services-hero-background-1024w.webp"
            media="(max-width:1024px)" type="image/webp">
    <source srcset="restaurant-seo-services-hero-background-1440w.webp"
            media="(max-width:1440px)" type="image/webp">
    <source srcset="restaurant-seo-services-hero-background-1920w.webp"
            type="image/webp">
    <img src="restaurant-seo-services-hero-background-1440w.jpg"
         alt="Restaurant SEO services — digital marketing dashboard showing local search optimization, Google Maps ranking, reviews, and website traffic growth for restaurants"
         width="1440" height="675" loading="eager" fetchpriority="high">
  </picture>


───────────────────────────────────────────────────────────────
2. RESULTS SECTION BACKGROUND
───────────────────────────────────────────────────────────────

Files:
  restaurant-seo-ranking-results-background-1560w.jpg  (desktop)
  restaurant-seo-ranking-results-background-1560w.webp
  restaurant-seo-ranking-results-background-1024w.jpg  (tablet)
  restaurant-seo-ranking-results-background-1024w.webp
  restaurant-seo-ranking-results-background-768w.jpg   (mobile)
  restaurant-seo-ranking-results-background-768w.webp

Alt text:
  "Restaurant SEO ranking growth — upward trend chart with
   search engine optimization data visualization showing
   improved organic traffic and local search results"

Implementation:

  .results {
    background:
      linear-gradient(90deg, #0A1A22 0%, #0A1A22 30%,
        rgba(10,26,34,.82) 55%, rgba(10,26,34,.42) 100%),
      url('/images/restaurant-seo-ranking-results-background-1560w.webp')
        right center / cover no-repeat,
      #0A1A22;
  }
  @media (max-width: 1024px) {
    .results {
      background-image:
        linear-gradient(90deg, #0A1A22 0%, rgba(10,26,34,.85) 50%,
          rgba(10,26,34,.50) 100%),
        url('/images/restaurant-seo-ranking-results-background-1024w.webp');
    }
  }
  @media (max-width: 768px) {
    .results {
      background:
        linear-gradient(180deg, rgba(10,26,34,.80), rgba(10,26,34,.93)),
        url('/images/restaurant-seo-ranking-results-background-768w.webp')
          center / cover no-repeat,
        #0A1A22;
    }
  }


───────────────────────────────────────────────────────────────
3. OPEN GRAPH / SOCIAL SHARE
───────────────────────────────────────────────────────────────

Files:
  restaurant-seo-services-og-social-share-1200x630.jpg
  restaurant-seo-services-og-social-share-1200x630.webp
  restaurant-seo-services-twitter-card-1200x600.jpg

Implementation (in <head>):

  <!-- Open Graph -->
  <meta property="og:image" content="https://kodrank.com/images/restaurant-seo-services-og-social-share-1200x630.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="KodRank Restaurant SEO Services — Get Found, Fill Tables, Own Your Local Market">
  <meta property="og:title" content="Restaurant SEO Services | KodRank">
  <meta property="og:description" content="Get your restaurant to the top of Google, the Map Pack, and AI search. More reservations, more direct orders, more walk-ins.">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:image" content="https://kodrank.com/images/restaurant-seo-services-twitter-card-1200x600.jpg">
  <meta name="twitter:image:alt" content="KodRank Restaurant SEO Services — Get Found, Fill Tables">
  <meta name="twitter:title" content="Restaurant SEO Services | KodRank">
  <meta name="twitter:description" content="Get your restaurant to the top of Google, the Map Pack, and AI search.">


───────────────────────────────────────────────────────────────
4. FAVICONS
───────────────────────────────────────────────────────────────

Files:
  kodrank-favicon-512x512.png   (PWA / app icon)
  kodrank-favicon-192x192.png   (Android Chrome)
  kodrank-favicon-32x32.png     (browser tab)

Implementation (in <head>):

  <link rel="icon" type="image/png" sizes="32x32"
        href="/images/kodrank-favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="192x192"
        href="/images/kodrank-favicon-192x192.png">
  <link rel="apple-touch-icon" sizes="512x512"
        href="/images/kodrank-favicon-512x512.png">


───────────────────────────────────────────────────────────────
5. SEO CHECKLIST FOR DEVELOPER
───────────────────────────────────────────────────────────────

[x] File names contain target keywords (restaurant-seo, ranking)
[x] WebP versions included (40-55% smaller than JPG)
[x] Multiple sizes per image for responsive srcset / media queries
[x] Progressive JPGs for faster perceived loading
[x] All images under 120KB (largest = hero 1920w at 119.9KB)
[x] Alt text provided above — use it exactly
[x] OG + Twitter card images sized to spec (1200x630 / 1200x600)
[x] Favicon set covers browser tab, Android, and PWA

Additional recommendations:
- Add loading="lazy" to all images below the fold
- Add loading="eager" + fetchpriority="high" to hero image
- Set explicit width/height on <img> tags to prevent CLS
- Consider adding JSON-LD structured data for the page
  (LocalBusiness + Service schema)
- Serve WebP with JPG fallback via <picture> or server-side
  content negotiation (Accept header)
