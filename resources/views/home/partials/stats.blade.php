<section class="sec-ink stats-sec">
  <div class="wrap">
    <dl class="stats rv">
      @foreach($c['stats']['items'] ?? [] as $stat)
        <div>
          <dt>
            @if(!empty($stat['suffix']))
              {{ $stat['value'] ?? '' }}<span>{{ $stat['suffix'] }}</span>
            @elseif(!empty($stat['accent']))
              @php
                $accentVal = (string) ($stat['value'] ?? '');
                $accentNum = $accentVal;
                $accentSfx = '';
                if (preg_match('/^(.*?)(%)$/u', $accentVal, $m)) {
                    $accentNum = $m[1];
                    $accentSfx = $m[2];
                }
              @endphp
              {{ $accentNum }}@if($accentSfx !== '')<span>{{ $accentSfx }}</span>@endif
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
