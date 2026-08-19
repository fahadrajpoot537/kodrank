@php $d = $s['hero'] ?? []; @endphp
<section class="hero" id="top">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="hero-veil"></div>
  <div class="wrap">
    <div class="hero-copy">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="sub">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
      @if(!empty($d['cta_text']))
        <div class="hero-actions">
          <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="arw">→</span></a>
        </div>
      @endif
      @if(!empty($d['trust']))
        <div class="hero-trust">
          @foreach($d['trust'] as $item)
            <div class="ht"><b>{{ $item['value'] ?? '' }}</b><span>{{ $item['label'] ?? '' }}</span></div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
