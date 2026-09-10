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
  $trustPoints = $h['trust_points'] ?? [];
  if (empty($trustPoints) && !empty($badges)) {
      $labelOnly = array_values(array_filter($badges, static fn ($badge) => ($badge['num'] ?? '') === '' && ($badge['label'] ?? '') !== ''));
      if ($labelOnly !== [] && count($labelOnly) === count($badges)) {
          $trustPoints = array_map(static fn ($badge) => $badge['label'], $labelOnly);
          $badges = [];
      }
  }
  // Mis-parsed stats (e.g. ["3.2x","Avg. Organic Lead Growth"]) → badge, not ticks
  if (!empty($trustPoints) && count($trustPoints) === 2 && empty($badges)) {
      $a = trim(html_entity_decode((string) (is_array($trustPoints[0]) ? ($trustPoints[0]['text'] ?? $trustPoints[0]['label'] ?? '') : $trustPoints[0]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
      $b = trim(html_entity_decode((string) (is_array($trustPoints[1]) ? ($trustPoints[1]['text'] ?? $trustPoints[1]['label'] ?? '') : $trustPoints[1]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
      $looksMetric = $a !== '' && preg_match('/^[\d.+×xX%+\-–—\/\s]+$/u', $a) && mb_strlen($a) <= 12;
      $looksLabel = $b !== '' && mb_strlen($b) > 8 && ! preg_match('/^[\d.+×xX%+\-–—\/\s]+$/u', $b);
      if ($looksMetric && $looksLabel) {
          $badges = [['num' => $a, 'label' => $b]];
          $trustPoints = [];
      }
  }
  // Decode entities in trust lines (&amp; etc.)
  if (!empty($trustPoints)) {
      $trustPoints = array_map(static function ($point) {
          if (is_array($point)) {
              foreach (['text', 'label'] as $k) {
                  if (isset($point[$k]) && is_string($point[$k])) {
                      $point[$k] = html_entity_decode($point[$k], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                  }
              }

              return $point;
          }

          return html_entity_decode((string) $point, ENT_QUOTES | ENT_HTML5, 'UTF-8');
      }, $trustPoints);
  }
  $lede = $h['lede'] ?? $h['hero_description'] ?? null;
  $ledeHtml = $h['lede_html'] ?? null;
  $titleHtml = $h['title_html'] ?? $h['titleHtml'] ?? null;
  $ctaText = $h['cta_text'] ?? $h['ctaText'] ?? $h['hero_button_text'] ?? 'Get A Free Proposal';
  // Hero always renders its own arrow — strip trailing → so "Get Plan →" does not become "→ →"
  $ctaText = trim(preg_replace('/\s*(?:→|->|»|›)+\s*$/u', '', (string) $ctaText));
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
      @if(!empty($trustPoints))
        <div class="hero-trust hero-trust-checks">
          @foreach($trustPoints as $point)
            <span>
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
              {{ is_array($point) ? ($point['text'] ?? $point['label'] ?? '') : $point }}
            </span>
          @endforeach
        </div>
      @endif
      <div class="hero-actions">
        <a href="{{ $ctaUrl }}" class="btn btn-primary">
          {{ $ctaText }}
          <span class="arw">→</span>
        </a>
        @if(!empty($h['secondary_text']))
          <a href="{{ $h['secondary_url'] ?? '#contact' }}" class="btn btn-ghost-light">{{ $h['secondary_text'] }}</a>
        @endif
        @if(!empty($h['proof_chip']))
          @php $proof = is_array($h['proof_chip']) ? $h['proof_chip'] : ['text' => (string) $h['proof_chip']]; @endphp
          <div class="proof-chip">
            @if(!empty($proof['stars']))
              <span class="stars">{{ trim(preg_replace('/\s+/u', '', (string) $proof['stars'])) }}</span>
            @endif
            @if(!empty($proof['html']))
              <small>{!! $proof['html'] !!}</small>
            @elseif(!empty($proof['text']))
              <small>{{ trim(preg_replace('/\s+/u', ' ', (string) $proof['text'])) }}</small>
            @endif
          </div>
        @endif
      </div>
    </div>
    @if(!empty($badges))
      <div class="hero-badges hero-trust" role="list">
        @foreach($badges as $badge)
          <div class="hero-badge ht" role="listitem">
            @if(($badge['num'] ?? '') !== '')
              <span class="num">{{ html_entity_decode((string) ($badge['num'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8') }}</span>
            @endif
            @if(($badge['label'] ?? '') !== '')
              <span class="lbl">{{ html_entity_decode((string) ($badge['label'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8') }}</span>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
