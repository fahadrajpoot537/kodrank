@php
  $d = $s['hero'] ?? [];
  $heroImg = asset($d['image'] ?? 'media/services/web-design/hero.jpg');
  $crumbs = $d['breadcrumb'] ?? [
    ['label' => 'Home', 'url' => route('home')],
    ['label' => 'Services', 'url' => '#'],
    ['label' => $page->name ?? 'Web Design and Development', 'url' => ''],
  ];
@endphp
<header class="hero">
  <div class="hero-bg" style="background-image:url('{{ $heroImg }}')"></div>
  <div class="hero-blur"></div>
  <div class="hero-in">
    <div class="hero-inner">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          @foreach($crumbs as $i => $crumb)
            @php
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
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
      <h1>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h1>
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
      <div class="hero-ctas">
        <a href="{{ $d['cta_url'] ?? '#cta' }}" class="btn btn-primary">
          {{ $d['cta_text'] ?? 'Start Your Project' }}
          <span class="arrow">→</span>
        </a>
      </div>
      @if(!empty($d['badges']))
        <div class="hero-badges">
          @foreach($d['badges'] as $badge)
            <div class="hero-badge"><span class="dot"></span> {{ $badge['label'] ?? '' }}</div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</header>
