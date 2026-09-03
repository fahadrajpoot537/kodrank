@php $tm = $s['testimonials'] ?? []; @endphp
<section class="sec-mist">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">{{ $tm['eyebrow'] ?? 'What Clients Say' }}</span>
      <h2>
        @if(!empty($tm['title_html']))
          {!! $tm['title_html'] !!}
        @else
          {{ $tm['title'] ?? '' }}
        @endif
      </h2>
      <p>{{ $tm['lede'] ?? '' }}</p>
    </div>

    <div class="testi-slider">
      <div class="testi-track" id="testiTrack">
        @foreach($tm['items'] ?? [] as $item)
          <div class="testi">
            <div class="stars">{{ $item['stars'] ?? '★★★★★' }}</div>
            <p class="quote">"{{ $item['quote'] ?? '' }}"</p>
            <div class="testi-person">
              <div class="avatar">{{ $item['initials'] ?? $item['avatar'] ?? \Illuminate\Support\Str::substr($item['name'] ?? 'KR', 0, 2) }}</div>
              <div>
                <div class="name">{{ $item['name'] ?? '' }}</div>
                <div class="role">{{ $item['role'] ?? '' }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="testi-controls">
        <div class="testi-dots" data-testi-dots role="tablist" aria-label="Testimonial slides">
          @foreach($tm['items'] ?? [] as $index => $item)
            <button
              type="button"
              class="testi-dot{{ $index === 0 ? ' is-active' : '' }}"
              data-testi-dot="{{ $index }}"
              aria-label="Go to review {{ $index + 1 }}"
              aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
              role="tab"
            ></button>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
