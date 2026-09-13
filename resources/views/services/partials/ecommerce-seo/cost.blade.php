@php
  $c = $s['cost'] ?? [];
  $items = $c['items'] ?? [];
  $list = $c['list'] ?? $c['points'] ?? [];
  $bg = $c['image'] ?? $c['background_image'] ?? null;
@endphp
<section class="sec-ink wl-cost" id="cost"@if($bg) style="--wl-cost-bg:url('{{ asset($bg) }}')"@endif>
  <div class="wrap">
    <div class="section-head">
      @if(!empty($c['eyebrow']))
        <span class="eyebrow">{{ $c['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($c['title_html'])){!! $c['title_html'] !!}@else{{ $c['title'] ?? '' }}@endif
      </h2>
      @if(!empty($c['lede_html']))
        <p class="lede">{!! $c['lede_html'] !!}</p>
      @elseif(!empty($c['lede']))
        <p class="lede">{{ $c['lede'] }}</p>
      @endif
    </div>

    @if(!empty($list))
      <ul class="wl-cost-list">
        @foreach($list as $row)
          <li>
            @if(is_array($row) && !empty($row['html']))
              {!! $row['html'] !!}
            @elseif(is_array($row))
              @if(!empty($row['title']))<b>{{ $row['title'] }}</b>@endif
              {{ $row['body'] ?? $row['text'] ?? '' }}
            @else
              {{ $row }}
            @endif
          </li>
        @endforeach
      </ul>
    @endif

    @if(!empty($c['closing_html']))
      <p class="lede wl-cost-closing">{!! $c['closing_html'] !!}</p>
    @elseif(!empty($c['closing']))
      <p class="lede wl-cost-closing">{{ $c['closing'] }}</p>
    @endif

    @if(!empty($items))
      <div class="wl-cost-stats">
        @foreach($items as $item)
          <div class="wl-cost-stat">
            <span class="num">{{ $item['value'] ?? $item['num'] ?? '' }}</span>
            <span class="lbl">{{ $item['label'] ?? '' }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
