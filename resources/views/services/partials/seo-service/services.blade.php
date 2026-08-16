@php
  $svc = $s['services'] ?? [];
  $isExplain = ! empty($svc['list']) || ! empty($svc['list_title']);
  $check = '<svg viewBox="0 0 24 24" fill="none" stroke="#0A1A22" stroke-width="3" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>';
@endphp

@if($isExplain)
<section class="sec-mist seo-explain" id="services">
  <div class="wrap seo-explain-split">
    <div class="seo-explain-copy">
      @if(!empty($svc['eyebrow']))
        <span class="eyebrow">{{ $svc['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($svc['title_html']))
          {!! $svc['title_html'] !!}
        @else
          {{ $svc['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($svc['lede_html']))
        <p class="lede">{!! $svc['lede_html'] !!}</p>
      @elseif(!empty($svc['lede']))
        <p class="lede">{{ $svc['lede'] }}</p>
      @endif
      @if(!empty($svc['body_html']))
        <p class="seo-explain-p">{!! $svc['body_html'] !!}</p>
      @elseif(!empty($svc['body']))
        <p class="seo-explain-p">{{ $svc['body'] }}</p>
      @endif
      @if(!empty($svc['note']))
        <p class="seo-explain-p">{{ $svc['note'] }}</p>
      @endif
    </div>

    <aside class="seo-def-card">
      @if(!empty($svc['list_title']))
        <h3>{{ $svc['list_title'] }}</h3>
      @endif
      @if(!empty($svc['list_lede']))
        <p>{{ $svc['list_lede'] }}</p>
      @endif
      @if(!empty($svc['list']))
        <ul class="seo-def-list">
          @foreach($svc['list'] as $item)
            <li>
              <span class="seo-def-check">{!! $check !!}</span>
              <span>{{ is_array($item) ? ($item['text'] ?? '') : $item }}</span>
            </li>
          @endforeach
        </ul>
      @endif
    </aside>
  </div>
</section>
@else
  @include('services.partials.digital-marketing.services')
@endif
