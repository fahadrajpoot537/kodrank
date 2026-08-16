@php
  $st = $s['stats'] ?? [];
  $bg = $st['image'] ?? $st['background_image'] ?? null;
  $compact = ! empty($st['compact']) || (empty($st['title']) && empty($st['title_html']) && empty($st['eyebrow']));
@endphp
<section class="sec-ink stats-bg{{ $compact ? ' seo-stats-compact' : '' }}"@if($bg) style="--stats-bg-image:url('{{ asset($bg) }}')"@endif>
  <div class="wrap">
    @unless($compact)
      <div class="section-head left">
        @if(!empty($st['eyebrow']))
          <span class="eyebrow">{{ $st['eyebrow'] }}</span>
        @endif
        <h2>
          @if(!empty($st['title_html']))
            {!! $st['title_html'] !!}
          @else
            {{ $st['title'] ?? '' }}
          @endif
        </h2>
        @if(!empty($st['lede']))
          <p class="lede" style="max-width:640px">{{ $st['lede'] }}</p>
        @endif
      </div>
    @endunless

    <div class="stats">
      @foreach($st['items'] ?? [] as $item)
        <div class="stat">
          <span class="num {{ !empty($item['signal']) ? 'signal' : '' }}">{{ $item['value'] ?? '' }}</span>
          <span class="lbl">{{ $item['label'] ?? '' }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>
