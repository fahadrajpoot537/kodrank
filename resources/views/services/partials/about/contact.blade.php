@php $ct = $s['contact'] ?? []; @endphp
<section id="contact" class="sec-mist">
  <div class="wrap">
    <div class="about-head">
      @if(!empty($ct['eyebrow']))
        <span class="eyebrow">{{ $ct['eyebrow'] }}</span>
      @endif
      <h2>{{ $ct['title'] ?? '' }}</h2>
      @if(!empty($ct['lede']))
        <p class="lede">{{ $ct['lede'] }}</p>
      @endif
    </div>

    <div class="about-contact-grid">
      @foreach($ct['cards'] ?? [] as $card)
        <article class="about-contact-card">
          <div class="about-icon-tile">
            @include('services.partials.digital-marketing.icon', [
              'key' => $card['icon_key'] ?? 'email',
              'fillNone' => true,
              'attrs' => 'stroke="currentColor" stroke-width="2"',
            ])
          </div>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>{{ $card['body'] ?? '' }}</p>
          @if(!empty($card['link_text']))
            <a href="{{ $card['link_url'] ?? '#' }}" class="about-textlink">
              {{ $card['link_text'] }}
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          @endif
        </article>
      @endforeach
    </div>
  </div>
</section>
