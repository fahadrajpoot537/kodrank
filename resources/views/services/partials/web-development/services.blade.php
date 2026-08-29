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

    <div class="service-grid">
      @foreach($d['cards'] ?? [] as $card)
        <div class="svc-card service-card{{ !empty($card['large']) ? ' svc-card-lg' : '' }} reveal in">
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
</section>
