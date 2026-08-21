@php $d = $s['hero'] ?? []; @endphp
<section class="hero">
  <div class="hero-bg" aria-hidden="true">
    <img src="{{ asset($d['image'] ?? 'media/services/shopify-development/shopify-development-services-custom-store-build.jpg') }}"
         alt="{{ $d['image_alt'] ?? ($page->name ?? 'Shopify development services') }}">
  </div>
  <div class="wrap hero-inner">
    <div class="hero-copy">
      @include('services.partials.shared.breadcrumb', ['crumbs' => $d['breadcrumb'] ?? null])
      <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
      @if(!empty($d['cta_text']))
        <div class="hero-actions">
          <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }}
            <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
          </a>
        </div>
      @endif
      @if(!empty($d['strip']))
        <div class="hero-stats">
          @foreach($d['strip'] as $item)
            <div class="hs">
              <div class="hn">{!! $item['value_html'] ?? e($item['value'] ?? '') !!}</div>
              <div class="hl">{{ $item['label'] ?? '' }}</div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
