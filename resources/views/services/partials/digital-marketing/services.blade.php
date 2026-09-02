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

    <div class="service-grid">
      @foreach($svc['cards'] ?? [] as $card)
        <article class="svc-card">
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
</section>
