@php
  $st = $st ?? [];
  $bg = $st['image'] ?? $st['background_image'] ?? null;
  $items = $st['items'] ?? [];
  $tone = $st['tone'] ?? $tone ?? 'light';
  $isDark = $tone === 'dark' || (!empty($st['dark']) && empty($st['light']));
  $secClass = $st['section_class'] ?? ($isDark ? 'sec-ink stats-bg' : 'sec-paper stats-light');
@endphp
<section class="{{ $secClass }}" id="results"@if($isDark && $bg) style="--stats-bg-image:url('{{ asset($bg) }}')"@endif>
  <div class="wrap">
    <div class="section-head left">
      @if(!empty($st['eyebrow']))<span class="eyebrow">{{ $st['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($st['title_html'])){!! $st['title_html'] !!}@else{{ $st['title'] ?? '' }}@endif
      </h2>
      @if(!empty($st['lede']))
        <p class="lede" style="max-width:640px">{{ $st['lede'] }}</p>
      @endif
    </div>
    <div class="stats">
      @foreach($items as $item)
        <div class="stat">
          <span class="num {{ !empty($item['signal']) ? 'signal' : '' }}">{{ $item['value'] ?? $item['num'] ?? '' }}</span>
          <span class="lbl">{{ $item['label'] ?? '' }}</span>
        </div>
      @endforeach
    </div>
    @if(!empty($st['note']))
      <p class="lede" style="margin-top:28px;max-width:60ch">{{ $st['note'] }}</p>
    @endif
  </div>
</section>
