@php
  $d = $s['testimonials'] ?? [];
  $star = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z"/></svg>';
@endphp
@if(!empty($d['items']))
<section class="sec-mist">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="testi-wrap">
      <div class="testi-track" data-wp-testi-track>
        @foreach($d['items'] as $item)
          <div class="testi">
            <div class="stars">
              @for($i = 0; $i < 5; $i++){!! $star !!}@endfor
            </div>
            <p>{{ $item['quote'] ?? '' }}</p>
            <div class="testi-person">
              <div class="testi-avatar">{{ $item['avatar'] ?? '' }}</div>
              <div>
                <div class="testi-name">{{ $item['name'] ?? '' }}</div>
                <div class="testi-role">{{ $item['role'] ?? '' }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="testi-controls">
        <button type="button" class="testi-nav" data-wp-testi-dir="prev" aria-label="Previous testimonial"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg></button>
        <button type="button" class="testi-nav" data-wp-testi-dir="next" aria-label="Next testimonial"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg></button>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  var track = document.querySelector('[data-wp-testi-track]');
  if (!track) return;
  document.querySelectorAll('[data-wp-testi-dir]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var card = track.querySelector('.testi');
      var step = card ? card.offsetWidth + 20 : 320;
      track.scrollBy({ left: btn.dataset.wpTestiDir === 'next' ? step : -step, behavior: 'smooth' });
    });
  });
})();
</script>
@endpush
@endif
