@php
  $d = $s['testimonials'] ?? [];
  $star = '<svg viewBox="0 0 24 24"><path d="M12 2l3 6.5 7 .8-5.2 4.7L18.2 21 12 17.3 5.8 21l1.4-7L2 9.3l7-.8L12 2z"/></svg>';
@endphp
<section class="section sec-paper" id="work">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
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
            <div class="tst svc-slide">
              <div class="stars">{!! str_repeat($star, 5) !!}</div>
              <q>{{ $item['quote'] ?? '' }}</q>
              <div class="who">
                <span class="av">{{ $initials }}</span>
                <div><b>{{ $name }}</b><span>{{ $item['role'] ?? '' }}</span></div>
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
