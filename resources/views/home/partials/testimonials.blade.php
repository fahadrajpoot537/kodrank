@php
  $star = '<svg viewBox="0 0 20 20"><path d="m10 1.6 2.5 5.4 5.9.7-4.4 4 1.2 5.8L10 14.6 4.8 17.5 6 11.7 1.6 7.7l5.9-.7L10 1.6Z"/></svg>';
@endphp
<section class="sec-mist">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['testimonials']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['testimonials']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['testimonials']['lede'] ?? '' }}</p>
    </div>

    <div class="quotes mt-lg">
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
        <figure class="quote rv" style="margin:0">
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
</section>
