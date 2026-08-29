@php
  $d = $s['hero'] ?? [];
  $items = $d['items'] ?? [];
@endphp
<section class="industries-hub-hero">
  <div class="wrap">
    @include('services.partials.shared.breadcrumb', [
      'crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Industries', 'url' => ''],
      ],
      'navClass' => 'breadcrumb',
    ])
    @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
    <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
    @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    @if(!empty($d['stats']))
      <div class="promo-stats">
        @foreach($d['stats'] as $st)
          <div class="st"><b>{{ $st['value'] ?? '' }}</b><small>{{ $st['label'] ?? '' }}</small></div>
        @endforeach
      </div>
    @endif
    @if(!empty($d['cta_text']))
      <a href="{{ $d['cta_url'] ?? '/contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="arw">→</span></a>
    @endif
  </div>
</section>

<section class="industries-hub-grid sec-paper">
  <div class="wrap">
    <div class="ind-grid">
      @foreach($items as $item)
        <a class="ind" href="{{ $item['url'] ?? '/contact' }}">
          <span class="t">{{ $item['title'] ?? '' }}<span class="arw">→</span></span>
          <p>{{ $item['body'] ?? '' }}</p>
        </a>
      @endforeach
    </div>
  </div>
</section>
