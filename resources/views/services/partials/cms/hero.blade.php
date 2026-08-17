@php $d = $s['hero'] ?? []; @endphp
<section class="hero">
  <div class="wrap hero-in">
    @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
    <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
    @if(!empty($d['lede_html']) || !empty($d['lede']))
      <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
    @endif
    @if(!empty($d['cta_text']))
      <div class="hero-cta">
        <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }}
          <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    @endif
    @if(!empty($d['strip']))
      <div class="hero-strip">
        @foreach($d['strip'] as $item)
          <div><b>{{ $item['value'] ?? '' }}</b><span>{{ $item['label'] ?? '' }}</span></div>
        @endforeach
      </div>
    @endif
  </div>
</section>
