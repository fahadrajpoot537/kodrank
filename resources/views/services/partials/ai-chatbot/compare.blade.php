@php
  $d = $s['compare'] ?? [];
  $bad = $d['bad'] ?? [];
  $good = $d['good'] ?? [];
@endphp
<section class="sec-ink">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="cmp">
      <div class="cmp-card">
        @if(!empty($bad['tag']))<span class="tag">{{ $bad['tag'] }}</span>@endif
        <h3>{{ $bad['title'] ?? '' }}</h3>
        <ul>
          @foreach($bad['items'] ?? [] as $item)
            <li><span class="ic no" aria-hidden="true">✕</span> {{ $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="cmp-card win">
        @if(!empty($good['tag']))<span class="tag">{{ $good['tag'] }}</span>@endif
        <h3>{{ $good['title'] ?? '' }}</h3>
        <ul>
          @foreach($good['items'] ?? [] as $item)
            <li><span class="ic yes" aria-hidden="true">✓</span> {{ $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
