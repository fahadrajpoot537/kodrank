@php $d = $s['testimonials'] ?? []; @endphp
<section class="sec-mist" id="work">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
    </div>
    <div class="svc-carousel page-svc-carousel" data-sp-carousel data-per-desktop="3">
      <button type="button" class="svc-nav svc-prev" aria-label="Previous"><svg viewBox="0 0 24 24" fill="none"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-viewport"><div class="svc-track">
        @foreach($d['items'] ?? [] as $item)
          <div class="tst-card svc-slide">
            <div class="stars" aria-hidden="true">
              @for($i = 0; $i < 5; $i++)
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3L22 9.3l-5 4.7 1.2 6.9L12 17.8 5.8 20.9 7 14 2 9.3l7.1-1z"/></svg>
              @endfor
            </div>
            <p>{{ $item['quote'] ?? '' }}</p>
            <div class="tst-who">
              <span class="avatar">{{ $item['initials'] ?? '' }}</span>
              <div>
                <b>{{ $item['name'] ?? '' }}</b>
                <span class="role">{{ $item['role'] ?? '' }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div></div>
      <button type="button" class="svc-nav svc-next" aria-label="Next"><svg viewBox="0 0 24 24" fill="none"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
      <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
    </div>
  </div>
</section>
