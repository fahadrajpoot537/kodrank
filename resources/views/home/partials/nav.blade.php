@php
  $navUrl = function (?string $url) {
      $url = trim((string) $url);
      if ($url === '' || $url === '#' ) {
          return '#';
      }
      if (str_starts_with($url, '#') || str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'tel:')) {
          return $url;
      }
      // Prefer root-relative paths so nav works on any host/port (8001, XAMPP, live)
      if ($url === '/') {
          return '/';
      }
      if (! str_starts_with($url, '/')) {
          $url = '/'.ltrim($url, '/');
      }

      return $url;
  };

  $navLinks = $c['nav']['links'] ?? [];
  $homeLink = null;
  $restLinks = [];
  $hasInsightsLink = false;
  foreach ($navLinks as $link) {
      $label = strtolower(trim((string) ($link['label'] ?? '')));
      // Company links live in the footer; keep the primary nav task-focused.
      if (in_array($label, ['faq', 'about us', 'about', 'process'], true)) {
          continue;
      }
      if ($homeLink === null && $label === 'home') {
          $homeLink = $link;
      } else {
          $restLinks[] = $link;
      }
      if ($label === 'insights') {
          $hasInsightsLink = true;
      }
  }
  if (! $hasInsightsLink) {
      $restLinks[] = ['label' => 'Insights', 'url' => '/blogs'];
  }
  $mega = $c['nav']['mega'] ?? [];
  $mainServices = \App\Models\ServicePage::navTree();
  $arrow = '<svg viewBox="0 0 16 16" fill="none"><path d="M2 8h11m0 0-4.2-4.2M13 8l-4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<header class="nav{{ !empty($navStuck) ? ' stuck' : '' }}" id="nav">
  <div class="nav-in">
    <a class="brand" href="/" aria-label="{{ $c['site']['brand_name'] ?? 'KodRank' }} home">
      <img class="brand-logo" src="{{ asset('logo.png') }}" alt="{{ $c['site']['brand_name'] ?? 'KodRank' }}" width="168" height="40" decoding="async">
    </a>
    <nav class="nav-links" aria-label="Primary">
      @if($homeLink)
        <a href="{{ $navUrl($homeLink['url'] ?? '/') }}">{{ $homeLink['label'] ?? 'Home' }}</a>
      @else
        <a href="/">Home</a>
      @endif

      <div class="nav-item has-mega">
        <button type="button" class="nav-mega-trigger" aria-expanded="false" aria-haspopup="true">Services
          <svg class="nav-caret" viewBox="0 0 12 12" fill="none"><path d="M2.5 4.5 6 8l3.5-3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="mega" role="menu">
          <div class="mega-in">
            <div class="mega-intro">
              <p class="eyebrow">{{ $mega['eyebrow'] ?? 'What we do' }}</p>
              <h4>{{ $mega['title'] ?? 'Built to be found.' }}</h4>
              <p>{{ $mega['body'] ?? '' }}</p>
              @if(!empty($mega['cta_text']))
                <a class="mega-cta" href="{{ $navUrl($mega['cta_url'] ?? '/contact') }}">{{ $mega['cta_text'] }}
                  {!! $arrow !!}
                </a>
              @endif
            </div>

            @forelse($mainServices as $main)
              @php $subs = $main->navDescendants(); @endphp
              <div class="mega-col">
                <a class="mega-head" href="/{{ ltrim($main->slug, '/') }}">{{ $main->name }}</a>
                @if($subs->isNotEmpty())
                  <ul>
                    @foreach($subs as $sub)
                      <li>
                        <a href="/{{ ltrim($sub->slug, '/') }}" @if(request()->is($sub->slug)) aria-current="page" @endif>
                          {{ $sub->name }}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>
            @empty
              @foreach($mega['columns'] ?? [] as $col)
                <div class="mega-col">
                  <a class="mega-head" href="{{ $navUrl($col['url'] ?? '#') }}">{{ $col['title'] ?? '' }}</a>
                  <ul>
                    @foreach($col['links'] ?? [] as $item)
                      <li><a href="{{ $navUrl($item['url'] ?? '#') }}">{{ $item['label'] ?? '' }}</a></li>
                    @endforeach
                  </ul>
                </div>
              @endforeach
            @endforelse
          </div>
          <div class="mega-foot">
            <a class="mega-all-btn" href="/services">View all services</a>
          </div>
        </div>
      </div>

      @foreach($restLinks as $link)
        <a href="{{ $navUrl($link['url'] ?? '#') }}">{{ $link['label'] ?? '' }}</a>
      @endforeach
    </nav>
    <div class="nav-cta">
      <a class="btn nav-quote" href="{{ route('contact') }}">{{ $c['nav']['cta_text'] ?? 'Get A Quote' }}</a>
    </div>
    <button class="nav-burger" type="button" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
  </div>
</header>
