@php $p = $s['problem'] ?? []; @endphp
<section class="sec-ink problem-bg">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $p['eyebrow'] ?? 'The Problem' }}</span>
      <h2>
        @if(!empty($p['title_html']))
          {!! $p['title_html'] !!}
        @else
          {{ $p['title'] ?? '' }}
          @if(!empty($p['title_accent']))
            <span class="hl">{{ $p['title_accent'] }}</span>
          @endif
        @endif
      </h2>
      <p class="lede">{{ $p['lede'] ?? '' }}</p>
    </div>

    <div class="problem-grid">
      @foreach($p['cards'] ?? [] as $card)
        <div class="problem-card">
          <div class="icon">
            @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'clock'])
          </div>
          <h4>{{ $card['title'] ?? '' }}</h4>
          <p>{{ $card['body'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
