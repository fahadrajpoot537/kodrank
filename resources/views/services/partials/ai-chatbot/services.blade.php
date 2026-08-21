@php
  $d = $s['services'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<section class="sec-ink" id="services">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel page-svc-carousel--ink" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous services">{!! $arrow !!}</button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['cards'] ?? [] as $card)
            <article class="svc svc-slide">
              <div class="svc-ico" aria-hidden="true">@include('services.partials.ai-chatbot.icon', ['key' => $card['icon_key'] ?? 'message'])</div>
              <div class="svc-badge" aria-hidden="true">✓</div>
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>@if(!empty($card['body_html'])){!! $card['body_html'] !!}@else{{ $card['body'] ?? '' }}@endif</p>
              @if(!empty($card['link_text']))
                <a href="{{ $card['link_url'] ?: '#contact' }}" class="tlink">{{ $card['link_text'] }} <span class="arw">→</span></a>
              @endif
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next services">{!! $arrowNext !!}</button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
