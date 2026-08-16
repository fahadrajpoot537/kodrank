@php
  $w = $s['why_us'] ?? [];
  $isOffPage = str_contains($page->slug ?? '', 'off-page');
@endphp
<section id="why-us" class="{{ $isOffPage ? 'sec-ink seo-why' : 'sec-paper' }}">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $w['eyebrow'] ?? 'Why KodRank' }}</span>
      <h2>
        @if(!empty($w['title_html']))
          {!! $w['title_html'] !!}
        @else
          {{ $w['title'] ?? '' }}
        @endif
      </h2>
      <p class="{{ $isOffPage ? 'lede' : '' }}">{{ $w['lede'] ?? '' }}</p>
    </div>

    <div class="why-grid">
      @foreach($w['cards'] ?? [] as $card)
        <div class="why-card">
          <div class="tile">
            @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'senior'])
          </div>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>{{ $card['body'] ?? '' }}</p>
          @if(!empty($card['bullets']))
            <ul>
              @foreach($card['bullets'] as $bullet)
                <li>{{ $bullet }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
