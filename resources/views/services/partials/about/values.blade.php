@php $w = $s['values'] ?? []; @endphp
<section id="values" class="sec-mist">
  <div class="wrap">
    <div class="about-head">
      @if(!empty($w['eyebrow']))
        <span class="eyebrow">{{ $w['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($w['title_html']))
          {!! $w['title_html'] !!}
        @else
          {{ $w['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($w['lede_html']))
        <p class="lede">{!! $w['lede_html'] !!}</p>
      @elseif(!empty($w['lede']))
        <p class="lede">{{ $w['lede'] }}</p>
      @endif
    </div>

    <div class="about-values-grid">
      @foreach($w['cards'] ?? [] as $card)
        <article class="about-value-card">
          <div class="about-icon-tile">
            @include('services.partials.digital-marketing.icon', [
              'key' => $card['icon_key'] ?? 'check',
              'fillNone' => true,
              'attrs' => 'stroke="currentColor" stroke-width="2"',
            ])
          </div>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>{{ $card['body'] ?? '' }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
