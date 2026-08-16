@php $d = $s['problem'] ?? []; $panel = $d['panel'] ?? []; @endphp
<section class="sec-mist" id="problem">
  <div class="wrap">
    <div class="prob-grid">
      <div class="prob-head">
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
        @if(!empty($d['lede']))<p class="prob-lede">{{ $d['lede'] }}</p>@endif
        @if(!empty($d['items']))
          <div class="prob-list">
            @foreach($d['items'] as $item)
              <div class="prob-item">
                <span class="prob-x" aria-hidden="true">✕</span>
                <div><b>{{ $item['title'] ?? '' }}</b><p>{{ $item['body'] ?? '' }}</p></div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
      @if(!empty($panel))
        <div class="prob-panel">
          @if(!empty($panel['big']))<div class="big">{{ $panel['big'] }}</div>@endif
          @if(!empty($panel['title']))<h3>{{ $panel['title'] }}</h3>@endif
          @if(!empty($panel['body']))<p>{{ $panel['body'] }}</p>@endif
          <div class="rule"></div>
          @if(!empty($panel['flip_html']))<p class="flip">{!! $panel['flip_html'] !!}</p>@endif
        </div>
      @endif
    </div>
  </div>
</section>
