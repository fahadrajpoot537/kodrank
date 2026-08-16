<section class="sec-ink stats-sec">
  <div class="wrap">
    <dl class="stats rv">
      @foreach($c['stats']['items'] ?? [] as $stat)
        <div>
          <dt>
            @if(!empty($stat['suffix']))
              {{ $stat['value'] ?? '' }}<span>{{ $stat['suffix'] }}</span>
            @elseif(!empty($stat['accent']))
              <span>{{ $stat['value'] ?? '' }}</span>
            @else
              {{ $stat['value'] ?? '' }}
            @endif
          </dt>
          <dd>{{ $stat['label'] ?? '' }}</dd>
        </div>
      @endforeach
    </dl>
  </div>
</section>
