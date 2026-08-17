@php $d = $s['cta'] ?? []; @endphp
<section class="sec-ink ctaband bgwrap cta-sec">
  <div class="bg-img"></div><div class="bg-ov"></div>
  <div class="wrap">
    @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
    <h2>{{ $d['title'] ?? '' }}</h2>
    @if(!empty($d['body']))<p class="lede">{{ $d['body'] }}</p>@endif
    @if(!empty($d['cta_text']))
      <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="ar">→</span></a>
    @endif
  </div>
</section>
