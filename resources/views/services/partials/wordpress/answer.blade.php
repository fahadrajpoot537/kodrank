@php
  $d = $s['answer'] ?? [];
@endphp
<section class="sec-ink why-bg">
  <div class="wrap">
    <div class="section-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>

    <div class="why-mobile-carousel">
      <div class="feature-grid">
        @foreach($d['items'] ?? [] as $item)
          <div class="feat-card">
            <div class="ic">@include('services.partials.wordpress.icon', ['key' => $item['icon_key'] ?? 'default'])</div>
            <h3>{{ $item['title'] ?? '' }}</h3>
            <p>{{ $item['body'] ?? '' }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
