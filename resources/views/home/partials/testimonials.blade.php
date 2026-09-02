@php
  $star = '<svg viewBox="0 0 20 20"><path d="m10 1.6 2.5 5.4 5.9.7-4.4 4 1.2 5.8L10 14.6 4.8 17.5 6 11.7 1.6 7.7l5.9-.7L10 1.6Z"/></svg>';
@endphp
<section class="sec-mist" id="testimonials">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['testimonials']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['testimonials']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['testimonials']['lede'] ?? '' }}</p>
    </div>

    <div class="svc-carousel quotes-carousel rv" data-svc-carousel data-per-desktop="3">
      <div class="svc-viewport">
        <div class="svc-track">
          @foreach($c['testimonials']['items'] ?? [] as $t)
            @php
              $name = $t['name'] ?? '';
              $initials = trim((string) ($t['initials'] ?? ''));
              if ($initials === '') {
                  $parts = preg_split('/\s+/', trim($name)) ?: [];
                  foreach (array_slice($parts, 0, 2) as $part) {
                      $initials .= mb_strtoupper(mb_substr($part, 0, 1));
                  }
              }
            @endphp
            <figure class="quote svc-slide">
              <div class="stars" aria-label="Rated 5 out of 5">
                {!! str_repeat($star, 5) !!}
              </div>
              <blockquote>&ldquo;{{ $t['quote'] ?? '' }}&rdquo;</blockquote>
              <figcaption class="who">
                <span class="av">{{ $initials }}</span>
                <span>
                  <b>{{ $name }}</b>
                  <span>{{ $t['role'] ?? '' }}</span>
                </span>
              </figcaption>
            </figure>
          @endforeach
        </div>
      </div>
      <div class="home-carousel-foot">
        <div class="home-carousel-nav-wrap" role="group" aria-label="Testimonials carousel navigation">
          <button type="button" class="home-carousel-nav home-carousel-prev" aria-label="Previous testimonials">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <button type="button" class="home-carousel-nav home-carousel-next" aria-label="Next testimonials">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
        <div class="svc-dots" data-svc-dots aria-hidden="true"></div>
      </div>
    </div>
  </div>
</section>
