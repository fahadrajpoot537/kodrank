@php $d = $s['testimonials'] ?? []; @endphp
<section class="sec-testi">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2 class="h">{{ $d['title'] ?? '' }}</h2>
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
            <div class="quote svc-slide">
              <div class="stars" aria-hidden="true">★★★★★</div>
              <p>“{{ $item['quote'] ?? '' }}”</p>
              <div class="who">
                <div class="avatar">{{ $initials }}</div>
                <div><strong>{{ $name }}</strong><span>{{ $item['role'] ?? '' }}</span></div>
              </div>
            </div>
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
