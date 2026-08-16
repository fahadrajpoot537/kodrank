@php $svc = $s['services'] ?? []; @endphp
<section id="services" class="sec-mist">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $svc['eyebrow'] ?? 'What We Do' }}</span>
      <h2>
        @if(!empty($svc['title_html']))
          {!! $svc['title_html'] !!}
        @else
          {{ $svc['title'] ?? '' }}
        @endif
      </h2>
      <p>{{ $svc['lede'] ?? '' }}</p>
    </div>

    @if(!empty($svc['group_label']))
      <h3 style="text-align:center;margin-bottom:36px;font-size:1.1rem;color:var(--slate);font-weight:500;letter-spacing:.02em;">
        {{ $svc['group_label'] }}
      </h3>
    @endif

    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous services">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($svc['cards'] ?? [] as $card)
            <article class="svc-card svc-slide">
              @if(!empty($card['num']))
                <span class="num">{{ $card['num'] }}</span>
              @else
                <div class="check">
                  @include('services.partials.digital-marketing.icon', ['key' => 'check', 'fillNone' => true, 'attrs' => 'width="14" height="14" stroke="currentColor" stroke-width="3"'])
                </div>
              @endif
              <div class="tile">
                @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'onpage'])
              </div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
              @if(!empty($card['link_text']))
                <a href="{{ $card['link_url'] ?? '#contact' }}" class="tlink">
                  {{ $card['link_text'] }}
                  @include('services.partials.digital-marketing.icon', ['key' => 'arrow', 'fillNone' => true, 'attrs' => 'stroke="currentColor" stroke-width="2.4"'])
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
  </div>
</section>
