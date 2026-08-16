<section id="faq">
  <div class="wrap faq-wrap">
    <div class="rv" style="text-align:center;margin-bottom:clamp(36px,4vw,52px)">
      <p class="eyebrow" style="justify-content:center">{{ $c['faq']['eyebrow'] ?? '' }}</p>
      <h2>{{ $c['faq']['title'] ?? '' }}</h2>
    </div>

    <div class="faq rv">
      @foreach($c['faq']['items'] ?? [] as $i => $item)
        <details @if($i === 0) open @endif>
          <summary>{{ $item['q'] ?? '' }}</summary>
          <div class="faq-a"><p>{{ $item['a'] ?? '' }}</p></div>
        </details>
      @endforeach
    </div>
  </div>
</section>
