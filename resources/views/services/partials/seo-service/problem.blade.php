@php
  $p = $s['problem'] ?? [];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $arrowNext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  $check = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>';
  $hasClose = !empty($p['note_title']) || !empty($p['note']) || !empty($p['note_list']);
@endphp
<section class="sec-paper seo-problem" id="problem">
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

    <div class="seo-problem-layout{{ $hasClose ? ' seo-problem-layout--with-close' : '' }}">
      <div class="svc-carousel page-svc-stack page-svc-stack--pair" data-sp-stack data-per-desktop="{{ $hasClose ? '2' : '3' }}">
        <button type="button" class="svc-nav svc-prev" aria-label="Previous cards">{!! $arrow !!}</button>
        <div class="svc-viewport">
          <div class="svc-track">
            @foreach($p['cards'] ?? [] as $card)
              <div class="problem-card svc-slide">
                <div class="icon">
                  @include('services.partials.digital-marketing.icon', ['key' => $card['icon_key'] ?? 'clock'])
                </div>
                <h4>{{ $card['title'] ?? '' }}</h4>
                <p>{{ $card['body'] ?? '' }}</p>
              </div>
            @endforeach
          </div>
        </div>
        <button type="button" class="svc-nav svc-next" aria-label="Next cards">{!! $arrowNext !!}</button>
        <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
      </div>

      @if($hasClose)
        <aside class="seo-close">
          @if(!empty($p['note_title']))
            <h3>{{ $p['note_title'] }}</h3>
          @endif
          @if(!empty($p['note']))
            <p>{{ $p['note'] }}</p>
          @endif
          @if(!empty($p['note_list']))
            <ul>
              @foreach($p['note_list'] as $item)
                <li>{!! $check !!}<span>{{ is_array($item) ? ($item['text'] ?? '') : $item }}</span></li>
              @endforeach
            </ul>
          @endif
        </aside>
      @endif
    </div>
  </div>
</section>
