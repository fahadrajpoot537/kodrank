@php $d = $s['hero'] ?? []; @endphp
<section class="hero" id="top">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="wrap">
    <div class="hero-inner">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
      <div class="hero-actions">
        @if(!empty($d['cta_text']))
          <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="arw">→</span></a>
        @endif
        @if(!empty($d['note']))
          <div class="hero-note">
            <svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            {{ $d['note'] }}
          </div>
        @endif
      </div>
      @if(!empty($d['stats']))
        <div class="stats">
          @foreach($d['stats'] as $item)
            <div class="stat @if(!empty($item['highlight'])) on @endif">
              <b>@if(!empty($item['value_html'])){!! $item['value_html'] !!}@else{{ $item['value'] ?? '' }}@endif</b>
              <span>{{ $item['label'] ?? '' }}</span>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
