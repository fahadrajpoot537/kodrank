{{-- Related services: icon + title cards in a continuous RTL marquee --}}
@php
  use App\Models\ServicePage;

  $currentSlug = trim((string) ($page->slug ?? $currentSlug ?? ''), '/');

  $devSlugs = [
      'web-design-and-development-services',
      'wordpress-development-services',
      'shopify-development-services',
      'ai-chatbot-development-services',
      'cms-development-services',
      'website-redesign-services',
      'electrician-website-design-services',
      'saas-software-development-services',
  ];
  $isDevRelated = in_array($currentSlug, $devSlugs, true);

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
      'shopify-seo-services' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>',
      'guest-posting-services' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>',
      'restaurant-seo-services' => '<path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/>',
      'healthcare-seo-services' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
      'real-estate-seo-services' => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/>',
      'white-label-seo-services' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12h8M12 8v8"/>',
      'web-design-and-development-services' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>',
      'wordpress-development-services' => '<circle cx="12" cy="12" r="10"/><path d="m5 8 4 10 3-8 3 8 4-10"/>',
      'shopify-development-services' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>',
      'ai-chatbot-development-services' => '<rect x="3" y="8" width="18" height="12" rx="3"/><path d="M12 8V5M8 3h8M8 14h.01M16 14h.01"/>',
      'cms-development-services' => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14a9 3 0 0 0 18 0V5"/><path d="M3 12a9 3 0 0 0 18 0"/>',
      'website-redesign-services' => '<path d="M21 12a9 9 0 1 1-3-6.7L21 8"/><path d="M21 3v5h-5"/>',
      'electrician-website-design-services' => '<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/>',
      'saas-software-development-services' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
  ];
  $defaultIcon = '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12h8"/>';

  $relatedPages = collect();

  if ($isDevRelated) {
      $webGroup = ServicePage::query()
          ->where('slug', 'web-design-and-development-services')
          ->where('is_active', true)
          ->with(['children' => static fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
          ->first();

      if ($webGroup) {
          $relatedPages->push($webGroup);
          $relatedPages = $relatedPages->merge($webGroup->children ?? []);
      }

      // Ensure every development page appears even if parent/children link is missing.
      $have = $relatedPages->pluck('slug')->all();
      foreach ($devSlugs as $extraSlug) {
          if (in_array($extraSlug, $have, true)) {
              continue;
          }
          $extra = ServicePage::query()->where('slug', $extraSlug)->where('is_active', true)->first();
          if ($extra) {
              $relatedPages->push($extra);
          }
      }

      $relatedEyebrow = 'Web Design &amp; Development';
      $relatedTitle = 'Build faster. Convert more. <span class="hl">Ship better</span>.';
      $relatedLede = 'From custom sites and WordPress to Shopify, CMS, AI chatbots, and SaaS — development services engineered for speed, clarity, and growth.';
      $relatedAria = 'Related development services';
  } else {
      $seoGroup = ServicePage::query()
          ->where('slug', 'digital-marketing-services')
          ->where('is_active', true)
          ->with(['children' => static fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
          ->first();

      if ($seoGroup) {
          $relatedPages->push($seoGroup);
          $relatedPages = $relatedPages->merge($seoGroup->children ?? []);
      }

      $extraSlugs = [
          'shopify-seo-services',
          'guest-posting-services',
          'restaurant-seo-services',
          'healthcare-seo-services',
          'real-estate-seo-services',
          'white-label-seo-services',
          'monthly-seo-services',
      ];
      $have = $relatedPages->pluck('slug')->all();
      foreach ($extraSlugs as $extraSlug) {
          if (in_array($extraSlug, $have, true)) {
              continue;
          }
          $extra = ServicePage::query()->where('slug', $extraSlug)->where('is_active', true)->first();
          if ($extra) {
              $relatedPages->push($extra);
          }
      }

      $relatedEyebrow = 'SEO &amp; Search Growth';
      $relatedTitle = 'Get found where your customers are <span class="hl">searching</span>.';
      $relatedLede = 'Classic search, AI answers, and generative results — we optimize for all of it, so your business shows up first no matter how people search.';
      $relatedAria = 'Related SEO services';
  }

  $relatedPages = $relatedPages
      ->unique('slug')
      ->reject(static fn ($svc) => trim((string) $svc->slug, '/') === $currentSlug)
      ->values();
@endphp
@if($relatedPages->isNotEmpty())
<section class="sec-ink kr-related-services" aria-label="{{ $relatedAria }}">
  <div class="wrap">
    <div class="kr-related-head">
      <span class="eyebrow">{!! $relatedEyebrow !!}</span>
      <h2>{!! $relatedTitle !!}</h2>
      <p class="lede">{{ $relatedLede }}</p>
    </div>
  </div>
  <div class="kr-related-carousel" data-kr-related-marquee>
    <div class="kr-related-track" data-kr-related-track>
      @foreach([0, 1] as $loopCopy)
        <div class="kr-related-set" aria-hidden="{{ $loopCopy === 1 ? 'true' : 'false' }}">
          @foreach($relatedPages as $svc)
            @php
              $slug = trim((string) $svc->slug, '/');
              $cardIcon = trim((string) ($svc->seo['listing_icon'] ?? ''));
            @endphp
            <a href="/{{ $slug }}" class="kr-related-card"@if($loopCopy === 1) tabindex="-1"@endif>
              <span class="icn-tile" aria-hidden="true">
                @if($cardIcon !== '')
                  <img src="{{ asset(ltrim($cardIcon, '/')) }}" alt="" width="22" height="22">
                @else
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$slug] ?? $defaultIcon !!}</svg>
                @endif
              </span>
              <h3>{{ $svc->name }}</h3>
            </a>
          @endforeach
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
