@php
  $d = $s['why'] ?? [];
  $bg = $d['image'] ?? $d['background_image'] ?? 'media/services/guest-posting/Guest-posting-services-hero.webp';
  $cards = $d['cards'] ?? [];
  $cols = count($cards) >= 4 ? 4 : (count($cards) === 2 ? 2 : 3);
@endphp
@if(!empty($cards))
<section id="why" class="sec-ink seo-why why-bg" style="--why-bg-image:url('{{ asset(ltrim($bg, '/')) }}')">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>

    <div class="why-grid why-grid--{{ $cols }}">
      @foreach($cards as $card)
        <div class="why-card">
          <div class="tile">
            @include('services.partials.digital-marketing.icon', [
              'key' => $card['icon_key'] ?? 'authority',
              'fillNone' => true,
            ])
          </div>
          @if(!empty($card['num']))
            <div class="why-num">{{ $card['num'] }}</div>
          @endif
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>{{ $card['body'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
