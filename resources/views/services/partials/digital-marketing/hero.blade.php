@php $h = $s['hero'] ?? []; @endphp
<header class="hero">
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            @foreach($h['breadcrumb'] ?? [['label' => 'Home', 'url' => route('home')], ['label' => 'Services', 'url' => '#'], ['label' => $page->name ?? 'Digital Marketing', 'url' => '']] as $i => $crumb)
              @php
                $isLast = $i === count($h['breadcrumb'] ?? [1,2,3]) - 1;
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
        <p class="lede">{{ $h['lede'] ?? '' }}</p>
        <div class="hero-cta">
          <a href="{{ $h['cta_url'] ?? '#contact' }}" class="btn btn-primary">
            {{ $h['cta_text'] ?? 'Get A Free Marketing Proposal' }}
            @include('services.partials.digital-marketing.icon', ['key' => 'arrow', 'fillNone' => true, 'attrs' => 'stroke="currentColor" stroke-width="2.2"'])
          </a>
        </div>
        @if(!empty($h['badges']))
          <div class="hero-badges">
            @foreach($h['badges'] as $badge)
              <div class="hero-badge">
                <span class="num">{{ $badge['num'] ?? '' }}</span>
                <span class="lbl">{{ $badge['label'] ?? '' }}</span>
              </div>
            @endforeach
          </div>
        @endif
      </div>
      <div class="hero-visual" role="img" aria-label="{{ $h['visual_aria_label'] ?? '' }}">
        <img class="hero-img"
             src="{{ asset($h['image'] ?? 'media/services/digital-marketing/hero.png') }}"
             alt="{{ $h['image_alt'] ?? 'Digital marketing services' }}"
             loading="eager">
      </div>
    </div>
  </div>
</header>
