@php
  $d = $d ?? [];
  $secClass = $secClass ?? 'sec-mist';
  $secId = $secId ?? 'services';
  $ink = $ink ?? str_contains($secClass, 'ink');
  $cards = $d['cards'] ?? $d['items'] ?? $d['tiles'] ?? [];
  $stack = $stack ?? false;
  $bg = $d['image'] ?? $d['background_image'] ?? $bg ?? null;
  if ($bg && !str_contains($secClass, 'services-bg')) {
      $secClass .= ' services-bg';
  }
@endphp
<section class="{{ $secClass }}" id="{{ $secId }}"@if($bg) style="--services-bg-image:url('{{ asset($bg) }}')"@endif>
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede_html']))
        <p class="lede">{!! $d['lede_html'] !!}</p>
      @elseif(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>
    <div class="svc-carousel {{ $stack ? 'page-svc-stack page-svc-stack--pair' : 'page-svc-carousel' }}{{ $ink ? ' page-svc-carousel--ink' : '' }}" data-{{ $stack ? 'sp-stack' : 'sp-carousel' }} data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($cards as $card)
            <article class="svc-card svc-slide">
              <div class="tile">
                @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'onpage'])
              </div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
              @if(!empty($card['bullets']))
                <ul class="compare-list" style="margin-top:14px">
                  @foreach($card['bullets'] as $bullet)
                    <li><span class="mark v">✓</span> {{ is_array($bullet) ? ($bullet['text'] ?? '') : $bullet }}</li>
                  @endforeach
                </ul>
              @endif
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
