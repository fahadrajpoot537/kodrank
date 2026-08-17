@php $d = $s['hero'] ?? []; @endphp
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="wrap">
    <div class="hero-copy">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
      @if(!empty($d['cta_text']))
        <div class="hero-cta">
          <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="ar">→</span></a>
        </div>
      @endif
      @if(!empty($d['strip']))
        <div class="hero-trust">
          @foreach($d['strip'] as $item)
            <div><div class="n">{{ $item['value'] ?? '' }}</div><div class="l">{{ $item['label'] ?? '' }}</div></div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
