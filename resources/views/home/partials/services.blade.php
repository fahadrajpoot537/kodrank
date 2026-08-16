@php
  $groupBadges = [
    '<path d="M8.5 16.5 4 12l4.5-4.5M15.5 7.5 20 12l-4.5 4.5"/>',
    '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
    '<path d="M12 3.5 13.6 8l4.5 1.6L13.6 11l-1.6 4.5L10.4 11 6 9.6 10.4 8 12 3.5Z"/>',
  ];
  $svcIcons = [
    'Custom Website Development' => '<rect x="3" y="4" width="18" height="15" rx="2"/><path d="M3 8h18"/><circle cx="5.6" cy="6" r=".5"/><circle cx="7.4" cy="6" r=".5"/><path d="M9.5 15 7 12.5 9.5 10M14.5 10l2.5 2.5L14.5 15"/>',
    'E-Commerce Development' => '<circle cx="9" cy="20" r="1.3"/><circle cx="17" cy="20" r="1.3"/><path d="M2.5 4h2l2.2 10.4a1.5 1.5 0 0 0 1.5 1.2h8.1a1.5 1.5 0 0 0 1.5-1.2L19.5 8H6"/>',
    'Website Redesign & Migration' => '<path d="M4 12a8 8 0 0 1 13.7-5.6L20 8M20 3v5h-5"/><path d="M20 12a8 8 0 0 1-13.7 5.6L4 16M4 21v-5h5"/>',
    'Technical SEO' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 8h18"/><circle cx="5.6" cy="6" r=".5"/><circle cx="7.4" cy="6" r=".5"/><circle cx="12" cy="14" r="2.3"/><path d="M12 10.5v-.7M12 18.2v-.7M8.4 14h-.7M16.3 14h-.7"/>',
    'On-Page SEO' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/>',
    'Keyword Research & Strategy' => '<rect x="3" y="4" width="18" height="15" rx="2"/><path d="M3 8h18"/><path d="M6.5 12h4M6.5 15h5"/><circle cx="16" cy="13.5" r="2.6"/><path d="m18 15.5 1.8 1.8"/>',
    'SEO Content Writing' => '<path d="M5 3h9l5 5v13H5z"/><path d="M14 3v5h5"/><path d="M8 12h8M8 15.5h8M8 19h5"/>',
    'Local SEO' => '<path d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/><circle cx="12" cy="10" r="2.6"/>',
    'SEO Audit & Reporting' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 15l3-3 2.5 2.5L17 9"/><path d="M14 9h3v3"/>',
    'AEO Services' => '<path d="M4 5h16a1.5 1.5 0 0 1 1.5 1.5v8A1.5 1.5 0 0 1 20 16h-6l-4 4v-4H4a1.5 1.5 0 0 1-1.5-1.5v-8A1.5 1.5 0 0 1 4 5Z"/><path d="M8 10.2 10 12l4-4"/>',
    'GEO Services' => '<path d="M12 3.5 13.6 8l4.5 1.6L13.6 11l-1.6 4.5L10.4 11 6 9.6 10.4 8 12 3.5Z"/><circle cx="18.5" cy="17.5" r="1.6"/><circle cx="5.5" cy="16.5" r="1.6"/><path d="M12 15.5 6.9 16.3M13.4 12.4l3.7 3.9"/>',
  ];
  $svcIconFallback = '<rect x="3" y="4" width="18" height="15" rx="2"/><path d="M3 8h18"/><circle cx="5.6" cy="6" r=".5"/><circle cx="7.4" cy="6" r=".5"/><path d="M9.5 15 7 12.5 9.5 10M14.5 10l2.5 2.5L14.5 15"/>';
  $arrow = '<svg viewBox="0 0 16 16" fill="none"><path d="M2 8h11m0 0-4.2-4.2M13 8l-4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $check = '<svg viewBox="0 0 24 24" fill="none"><path d="M6 12.5 10 16.5 18 8" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec-mist" id="services">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['services']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['services']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['services']['lede'] ?? '' }}</p>
    </div>

    @foreach($c['services']['groups'] ?? [] as $gi => $group)
      @php
        $isAeoGeo = ($gi === 2) || (($group['layout'] ?? '') === 'aeo-geo');
        $items = $group['items'] ?? [];
      @endphp
      <div class="svc-group rv" @if($gi === 0) style="margin-top:clamp(44px,5vw,68px)" @else style="margin-top:clamp(40px,5vw,64px)" @endif>
        <div class="svc-label">
          <span class="svc-badge"><svg viewBox="0 0 24 24">{!! $groupBadges[$gi % count($groupBadges)] !!}</svg></span>
          {{ $group['title'] ?? '' }}
          @if(!empty($group['subtitle']))
            <em>{{ $group['subtitle'] }}</em>
          @endif
        </div>
      </div>

      <div class="svc-carousel rv{{ $isAeoGeo ? ' is-aeo' : '' }}" data-svc-carousel data-per-desktop="{{ $isAeoGeo ? 2 : 3 }}">
        <button type="button" class="svc-nav svc-prev" aria-label="Previous services">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="svc-viewport">
          <div class="svc-track">
            @foreach($items as $item)
              @php
                $svcTitle = $item['title'] ?? '';
                $svcIcon = $svcIcons[$svcTitle] ?? $svcIconFallback;
              @endphp
              <article class="card svc-card svc-slide">
                <span class="svc-check" aria-hidden="true">{!! $check !!}</span>
                <span class="svc-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none">{!! $svcIcon !!}</svg></span>
                <h3>{{ $svcTitle }}</h3>
                <p>{{ $item['body'] ?? '' }}</p>
                @if(!empty($item['link_text']))
                  <a class="card-link textlink" href="{{ $item['link_url'] ?? '#' }}">{{ $item['link_text'] }}
                    {!! $arrow !!}
                  </a>
                @endif
              </article>
            @endforeach
          </div>
        </div>
        <button type="button" class="svc-nav svc-next" aria-label="Next services">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
      </div>

      @if($gi === 0 && !empty($c['services']['web_cta_text']))
        <div class="svc-viewall rv">
          <a class="btn btn-ghost-dark" href="{{ $c['services']['web_cta_url'] ?? '#' }}">{{ $c['services']['web_cta_text'] }}
            {!! $arrow !!}
          </a>
        </div>
      @endif
      @if($gi === 1 && !empty($c['services']['seo_cta_text']))
        <div class="svc-viewall rv">
          <a class="btn btn-ghost-dark" href="{{ $c['services']['seo_cta_url'] ?? '#' }}">{{ $c['services']['seo_cta_text'] }}
            {!! $arrow !!}
          </a>
        </div>
      @endif
    @endforeach
  </div>
</section>
