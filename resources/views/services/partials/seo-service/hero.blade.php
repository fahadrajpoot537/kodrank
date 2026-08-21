@php
  $h = $s['hero'] ?? [];
  $img = $h['image'] ?? 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg';
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
  $lede = $h['lede'] ?? $h['hero_description'] ?? null;
  $ledeHtml = $h['lede_html'] ?? null;
@endphp
<section class="hero" id="top">
  <div class="hero-bg" aria-hidden="true" style="background-image:url('{{ $imgUrl }}')"></div>
  <div class="hero-veil" aria-hidden="true"></div>
  <div class="wrap">
    <div class="hero-copy">
      @include('services.partials.shared.breadcrumb', ['crumbs' => $h['breadcrumb'] ?? null])
      <h1>
        @if(!empty($h['title_html']))
          {!! $h['title_html'] !!}
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
        <p class="sub">{{ $lede }}</p>
      @endif
      <div class="hero-actions">
        <a href="{{ $h['cta_url'] ?? $h['hero_button_link'] ?? '#contact' }}" class="btn btn-primary">
          {{ $h['cta_text'] ?? $h['hero_button_text'] ?? 'Get A Free Proposal' }}
          <span class="arw">→</span>
        </a>
        @if(!empty($h['secondary_text']))
          <a href="{{ $h['secondary_url'] ?? '#contact' }}" class="btn btn-ghost-light">{{ $h['secondary_text'] }}</a>
        @endif
      </div>
      @if(!empty($badges))
        <div class="hero-trust">
          @foreach($badges as $badge)
            <div class="ht">
              @if(!empty($badge['num']))<b>{{ $badge['num'] }}</b>@endif
              <span>{{ $badge['label'] ?? '' }}</span>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
