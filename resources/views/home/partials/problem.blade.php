<section id="problem">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['problem']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['problem']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['problem']['lede'] ?? '' }}</p>
    </div>

    <div class="grid g3 mt-lg">
      @foreach($c['problem']['cards'] ?? [] as $card)
        <article class="card card-problem rv">
          <span class="card-num">{{ $card['num'] ?? '' }}</span>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>{!! $card['body'] ?? '' !!}</p>
        </article>
      @endforeach
    </div>

    @if(!empty($c['problem']['statement']))
      <div class="statement rv">
        <p>{!! $c['problem']['statement'] !!}</p>
      </div>
    @endif
  </div>
</section>
