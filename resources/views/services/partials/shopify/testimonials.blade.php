@php
  $d = $s['testimonials'] ?? [];
  $star = '<svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="m12 2 3 6.9 7.5.6-5.7 5 1.7 7.5L12 24l-6.5-2 1.7-7.5-5.7-5 7.5-.6z"/></svg>';
@endphp
<section class="section sec-mist" id="work">
  <div class="wrap">
    <div class="head-block">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous testimonials">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($d['items'] ?? [] as $item)
            @php
              $name = $item['name'] ?? '';
              $initials = $item['initials'] ?? collect(explode(' ', $name))->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');
            @endphp
            <article class="tst svc-slide">
              <div class="stars" aria-label="5 out of 5 stars">{!! str_repeat($star, 5) !!}</div>
              <q>{{ $item['quote'] ?? '' }}</q>
              <div class="who">
                <span class="av">{{ $initials }}</span>
                <div><b>{{ $name }}</b><span>{{ $item['role'] ?? '' }}</span></div>
              </div>
            </article>
          @endforeach
        </div>
      </div>
      <button type="button" class="svc-nav svc-next" aria-label="Next testimonials">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
