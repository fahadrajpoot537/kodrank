<section class="sec-ink" id="process">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['process']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['process']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['process']['lede'] ?? '' }}</p>
    </div>

    <div class="grid g4 mt-lg">
      @foreach($c['process']['steps'] ?? [] as $step)
        <article class="step rv">
          <div class="step-ix"><b>{{ $step['num'] ?? '' }}</b><i></i></div>
          <h3>{{ $step['title'] ?? '' }}</h3>
          <p>{{ $step['body'] ?? '' }}</p>
          @if(!empty($step['tag']))
            <span class="step-tag">{{ $step['tag'] }}</span>
          @endif
        </article>
      @endforeach
    </div>
  </div>
</section>

