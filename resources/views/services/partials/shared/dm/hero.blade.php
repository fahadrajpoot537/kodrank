@php
  $h = $h ?? [];
  $defaultImage = $defaultImage ?? 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg';
  $img = $h['image'] ?? $defaultImage;
  $imgUrl = asset(ltrim($img, '/'));
  $badges = $h['badges'] ?? [];
  if (empty($badges) && !empty($h['trust'])) {
      foreach ($h['trust'] as $item) {
          $badges[] = [
              'num' => $item['num'] ?? $item['value'] ?? '',
              'label' => $item['label'] ?? '',
          ];
      }
  }
  if (empty($badges) && !empty($h['stats'])) {
      foreach ($h['stats'] as $item) {
          $badges[] = [
              'num' => $item['num'] ?? $item['value'] ?? (strip_tags($item['value_html'] ?? '')),
              'label' => $item['label'] ?? '',
          ];
      }
  }
  // Normalize badge keys (seeders use value|num)
  if (!empty($badges)) {
      $badges = array_map(static function ($badge) {
          return [
              'num' => $badge['num'] ?? $badge['value'] ?? '',
              'label' => $badge['label'] ?? '',
          ];
      }, $badges);
  }
  $lede = $h['lede'] ?? $h['hero_description'] ?? null;
  $ledeHtml = $h['lede_html'] ?? null;
  $titleHtml = $h['title_html'] ?? $h['titleHtml'] ?? null;
  $ctaText = $h['cta_text'] ?? $h['ctaText'] ?? $h['hero_button_text'] ?? 'Get A Free Proposal';
  $ctaUrl = $h['cta_url'] ?? $h['ctaUrl'] ?? $h['hero_button_link'] ?? '#contact';
@endphp
<section class="hero" id="top">
  <div class="hero-bg" aria-hidden="true" style="background-image:url('{{ $imgUrl }}')"></div>
  <div class="hero-veil" aria-hidden="true"></div>
  <div class="wrap">
    <div class="hero-copy">
      @include('services.partials.shared.breadcrumb', ['crumbs' => $h['breadcrumb'] ?? null])
      @if(!empty($h['eyebrow']))
        <span class="eyebrow hero-eyebrow">{{ $h['eyebrow'] }}</span>
      @endif
      <h1>
        @if(!empty($titleHtml))
          {!! $titleHtml !!}
        @else
          {{ $h['title'] ?? '' }}
          @if(!empty($h['title_accent']))
            <span class="hl">{{ $h['title_accent'] }}</span>
          @endif
        @endif
      </h1>
      @if(!empty($h['subtitle']))
        <p class="hero-sub">{{ $h['subtitle'] }}</p>
      @endif
      @if($ledeHtml)
        <p class="sub">{!! $ledeHtml !!}</p>
      @elseif($lede)
        <p class="sub lede">{{ $lede }}</p>
      @endif
      <div class="hero-actions">
        <a href="{{ $ctaUrl }}" class="btn btn-primary">
          {{ $ctaText }}
          <span class="arw">→</span>
        </a>
        @if(!empty($h['secondary_text']))
          <a href="{{ $h['secondary_url'] ?? '#contact' }}" class="btn btn-ghost-light">{{ $h['secondary_text'] }}</a>
        @endif
      </div>
    </div>
    @if(!empty($badges))
      <div class="hero-badges hero-trust" role="list">
        @foreach($badges as $badge)
          <div class="hero-badge ht" role="listitem">
            @if(($badge['num'] ?? '') !== '')
              <span class="num">{{ $badge['num'] }}</span>
            @endif
            @if(($badge['label'] ?? '') !== '')
              <span class="lbl">{{ $badge['label'] }}</span>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
