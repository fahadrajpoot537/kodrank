@php $pb = $s['playbook'] ?? []; @endphp
<section class="sec-ink playbook-bg">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $pb['eyebrow'] ?? 'Platform & Industry SEO' }}</span>
      <h2>
        @if(!empty($pb['title_html']))
          {!! $pb['title_html'] !!}
        @else
          {{ $pb['title'] ?? '' }}
        @endif
      </h2>
      <p class="lede">{{ $pb['lede'] ?? '' }}</p>
    </div>

    <div class="industry-grid">
      @foreach($pb['cards'] ?? [] as $card)
        <article class="ind-card">
          <div class="ic">
            @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'b2b'])
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
          @if(!empty($card['link_text']))
            <a href="{{ $card['link_url'] ?? '#' }}" class="ind-cta">
              {{ $card['link_text'] }}
              @include('services.partials.digital-marketing.icon', ['key' => 'arrow'])
            </a>
          @endif
        </article>
      @endforeach
    </div>
  </div>
</section>
