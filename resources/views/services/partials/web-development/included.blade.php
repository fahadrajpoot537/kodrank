@php
  $d = $s['included'] ?? [];
  $bg = asset($d['image'] ?? 'media/services/web-design/included-bg.jpg');
@endphp
<section class="sec-ink sec-included-bg" style="--included-bg:url('{{ $bg }}')" data-bg="{{ $bg }}">
  <div class="wrap">
    <div class="section-head reveal">
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="included-grid">
      @foreach($d['tiles'] ?? [] as $tile)
        <div class="include-tile reveal">
          <div class="include-tile-ic">
            @include('services.partials.web-development.icon', ['key' => $tile['icon_key'] ?? 'ui', 'size' => 20])
          </div>
          <h4>{{ $tile['title'] ?? '' }}</h4>
          <p>{{ $tile['body'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
