@php $d = $s['why'] ?? []; @endphp
<section class="section sec-ink" id="why">
  <div class="wrap why-grid">
    <div class="why-copy">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede_html']) || !empty($d['lede']))
        <p class="lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
      @endif
      @foreach($d['checks'] ?? [] as $check)
        <div class="check">
          @include('services.partials.cms.icon', ['key' => 'check', 'strokeWidth' => '2.2'])
          <span>{{ is_array($check) ? ($check['text'] ?? '') : $check }}</span>
        </div>
      @endforeach
      @if(!empty($d['cta_text']))
        <div class="why-actions">
          <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }}
            <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      @endif
    </div>
    <div class="feat-list">
      @foreach($d['features'] ?? $d['cards'] ?? [] as $feature)
        <div class="feat">
          <span class="fi">@include('services.partials.cms.icon', ['key' => $feature['icon_key'] ?? 'bolt'])</span>
          <div>
            <h3>{{ $feature['title'] ?? '' }}</h3>
            <p>{{ $feature['body'] ?? '' }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
