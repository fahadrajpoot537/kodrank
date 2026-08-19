@php $d = $s['pain'] ?? []; @endphp
<section class="sec-paper" id="services">
  <div class="wrap">
    <div class="intro-grid">
      <div class="intro-copy">
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h3>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h3>
        @foreach($d['paragraphs_html'] ?? ($d['paragraphs'] ?? []) as $p)
          <p>@if(!empty($p['html'])){!! $p['html'] !!}@else{{ is_array($p) ? ($p['text'] ?? '') : $p }}@endif</p>
        @endforeach
      </div>
      @php $aside = $d['aside'] ?? []; @endphp
      @if($aside)
        <aside class="intro-aside">
          @if(!empty($aside['eyebrow']))<span class="eyebrow">{{ $aside['eyebrow'] }}</span>@endif
          @if(!empty($aside['title']))<h4>{{ $aside['title'] }}</h4>@endif
          <ul class="mini-list">
            @foreach($aside['items'] ?? [] as $item)
              <li>
                <span class="chk"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                {{ is_array($item) ? ($item['text'] ?? '') : $item }}
              </li>
            @endforeach
          </ul>
        </aside>
      @endif
    </div>

    @if(!empty($d['cards']))
      <div class="pain-head">
        @if(!empty($d['pain_eyebrow']))<span class="eyebrow">{{ $d['pain_eyebrow'] }}</span>@endif
        @if(!empty($d['pain_title_html']) || !empty($d['pain_title']))
          <h2>@if(!empty($d['pain_title_html'])){!! $d['pain_title_html'] !!}@else{{ $d['pain_title'] }}@endif</h2>
        @endif
      </div>
      <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="4">
        <button type="button" class="svc-nav svc-prev" aria-label="Previous"><svg viewBox="0 0 24 24" fill="none"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        <div class="svc-viewport"><div class="svc-track">
          @foreach($d['cards'] as $i => $card)
            <div class="pain-card svc-slide">
              <div class="pain-num">{{ $card['num'] ?? str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</div>
              <h4>{{ $card['title'] ?? '' }}</h4>
              <p>{{ $card['body'] ?? '' }}</p>
            </div>
          @endforeach
        </div></div>
        <button type="button" class="svc-nav svc-next" aria-label="Next"><svg viewBox="0 0 24 24" fill="none"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
      </div>
    @endif
  </div>
</section>
