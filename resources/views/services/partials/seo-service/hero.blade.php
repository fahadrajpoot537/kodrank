@php $h = $s['hero'] ?? []; @endphp
<header class="hero">
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            @foreach($h['breadcrumb'] ?? [['label' => 'Home', 'url' => route('home')], ['label' => 'Services', 'url' => '#'], ['label' => $page->name ?? 'SEO Services', 'url' => '']] as $i => $crumb)
              @php
                $crumbs = $h['breadcrumb'] ?? [1, 2, 3];
                $isLast = $i === count($crumbs) - 1;
                $label = $crumb['label'] ?? '';
                $url = $crumb['url'] ?? '';
                if ($label === 'Home') $url = route('home');
                if ($label === 'Services' && ($url === '' || $url === '/services/')) $url = '#';
              @endphp
              <li @if($isLast || $url === '') aria-current="page" @endif>
                @if(!$isLast && $url !== '')
                  <a href="{{ $url }}">{{ $label }}</a>
                @else
                  {{ $label }}
                @endif
              </li>
            @endforeach
          </ol>
        </nav>
        @if(!empty($h['eyebrow']))
          <span class="eyebrow">{{ $h['eyebrow'] }}</span>
        @endif
        <h1>
          @if(!empty($h['title_html']))
            {!! $h['title_html'] !!}
          @else
            {{ $h['title'] ?? '' }}
            @if(!empty($h['title_accent']))
              <span class="accent">{{ $h['title_accent'] }}</span>
            @endif
          @endif
        </h1>
        @if(!empty($h['subtitle']))
          <p class="hero-sub">{{ $h['subtitle'] }}</p>
        @endif
        <p class="lede">{{ $h['lede'] ?? $h['hero_description'] ?? '' }}</p>
        <div class="hero-cta">
          <a href="{{ $h['cta_url'] ?? $h['hero_button_link'] ?? '#contact' }}" class="btn btn-primary">
            {{ $h['cta_text'] ?? $h['hero_button_text'] ?? 'Get A Free Proposal' }}
            @include('services.partials.digital-marketing.icon', ['key' => 'arrow', 'fillNone' => true, 'attrs' => 'stroke="currentColor" stroke-width="2.2"'])
          </a>
          @if(!empty($h['secondary_text']))
            <a href="{{ $h['secondary_url'] ?? '#problem' }}" class="btn btn-ghost-light">
              {{ $h['secondary_text'] }}
            </a>
          @endif
        </div>
        @if(!empty($h['badges']))
          <div class="hero-badges">
            @foreach($h['badges'] as $badge)
              <div class="hero-badge{{ empty($badge['num']) ? ' hero-badge--text' : '' }}">
                @if(!empty($badge['num']))
                  <span class="num">{{ $badge['num'] }}</span>
                @endif
                <span class="lbl">{{ $badge['label'] ?? '' }}</span>
              </div>
            @endforeach
          </div>
        @endif
      </div>
      <div class="hero-visual" role="img" aria-label="{{ $h['visual_aria_label'] ?? '' }}">
        <img class="hero-img"
             src="{{ asset($h['image'] ?? 'media/services/on-page-seo/on-page-seo-services-agency-banner.jpg') }}"
             alt="{{ $h['image_alt'] ?? ($page->name ?? 'SEO services') }}"
             width="720"
             height="540"
             loading="eager"
             decoding="async"
             fetchpriority="high">
      </div>
    </div>
  </div>
</header>
