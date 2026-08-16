<section class="sec-ink sec-tech">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['tech']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['tech']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['tech']['lede'] ?? '' }}</p>
    </div>
    <div class="tech mt-lg">
      @foreach($c['tech']['columns'] ?? [] as $col)
        <div class="tech-col rv">
          <h3>{{ $col['title'] ?? '' }}</h3>
          <div class="chips">
            @foreach($col['chips'] ?? [] as $chip)
              <span class="chip">{{ $chip }}</span>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
