{{-- Related SEO service links — hub of core marketing/SEO pages --}}
@php
  $currentSlug = (string) ($page->slug ?? $currentSlug ?? '');
  $hub = [
      'digital-marketing-services' => 'Digital Marketing',
      'on-page-seo-services' => 'On-Page SEO',
      'off-page-seo-services' => 'Off-Page SEO',
      'technical-seo-services' => 'Technical SEO',
      'aeo-services' => 'AEO Services',
      'geo-services' => 'GEO Services',
  ];
  $links = [];
  if (array_key_exists($currentSlug, $hub)) {
      foreach ($hub as $slug => $label) {
          if ($slug === $currentSlug) {
              continue;
          }
          $links[] = ['slug' => $slug, 'label' => $label];
      }
  }
@endphp
@if($links !== [])
<section class="sec-mist kr-related-services" aria-label="Related services">
  <div class="wrap">
    <div class="section-head" style="margin-bottom:28px">
      <span class="eyebrow">Related services</span>
      <h2>Explore more SEO &amp; growth work</h2>
      <p class="lede">Jump to another KodRank service that often pairs with this one.</p>
    </div>
    <ul class="kr-related-list">
      @foreach($links as $item)
        <li>
          <a href="/{{ $item['slug'] }}">{{ $item['label'] }} <span class="arw" aria-hidden="true">→</span></a>
        </li>
      @endforeach
    </ul>
  </div>
</section>
@endif
