@php
  $d = $s['why'] ?? [];
  $other = $d['other'] ?? [];
  $us = $d['us'] ?? [];
@endphp
<section class="section sec-ink" id="why">
  <div class="why-bg" aria-hidden="true">
    <img src="{{ asset($d['image'] ?? 'media/services/shopify-development/shopify-seo-friendly-store-development.jpg') }}"
         alt="{{ $d['image_alt'] ?? 'SEO-optimized Shopify development by KodRank' }}">
  </div>
  <div class="wrap">
    <div class="head-block">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
    </div>
    <div class="why-grid">
      <div class="why-feats">
        @foreach($d['features'] ?? [] as $feature)
          <div class="feat">
            <span class="fi">@include('services.partials.shopify.icon', ['key' => $feature['icon_key'] ?? 'search'])</span>
            <div>
              <h3>{{ $feature['title'] ?? '' }}</h3>
              <p>{{ $feature['body'] ?? '' }}</p>
            </div>
          </div>
        @endforeach
      </div>
      <div class="compare">
        <div class="cmp typ">
          <div class="ct">{{ $other['tag'] ?? 'A typical dev shop' }}</div>
          <ul>
            @foreach($other['items'] ?? [] as $item)
              <li>@include('services.partials.shopify.icon', ['key' => 'x', 'strokeWidth' => '2.4']) {{ is_array($item) ? ($item['text'] ?? '') : $item }}</li>
            @endforeach
          </ul>
        </div>
        <div class="cmp win">
          <div class="ct">{{ $us['tag'] ?? 'KodRank' }}</div>
          <ul>
            @foreach($us['items'] ?? [] as $item)
              <li>@include('services.partials.shopify.icon', ['key' => 'check', 'strokeWidth' => '2.4'])
                <span>@if(is_array($item) && !empty($item['html'])){!! $item['html'] !!}@else{{ is_array($item) ? ($item['text'] ?? '') : $item }}@endif</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
