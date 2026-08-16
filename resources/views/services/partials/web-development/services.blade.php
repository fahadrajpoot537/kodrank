@php $d = $s['services'] ?? []; @endphp
<section class="sec-paper" id="services">
  <div class="wrap">
    <div class="section-head reveal">
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous services">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <div class="service-card svc-slide{{ !empty($card['large']) ? ' svc-card-lg' : '' }} reveal in">
              <div class="svc-icon">
                @include('services.partials.web-development.icon', ['key' => $card['icon_key'] ?? 'wordpress'])
              </div>
              <div class="svc-check">✓</div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? '' }}</p>
              @if(!empty($card['tags']))
                <div class="tags">
                  @foreach($card['tags'] as $tag)
                    <span class="tag">{{ $tag }}</span>
                  @endforeach
                </div>
              @endif
              <a href="{{ url($card['link_url'] ?? '#') }}" class="btn btn-primary btn-sm">
                {{ $card['link_text'] ?? 'Explore Service' }} <span class="arrow">→</span>
              </a>
            </div>
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
