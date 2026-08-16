@php
  $d = $s['why_exist'] ?? [];
  $columns = $d['columns'] ?? [];
  $xIcon = '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M18 6 6 18M6 6l12 12"/></svg>';
  $vIcon = '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"/></svg>';
@endphp
<section class="sec-paper" id="why-exist">
  <div class="wrap">
    <div class="about-head">
      @if(!empty($d['eyebrow']))
        <span class="eyebrow">{{ $d['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($d['lede']))
        <p class="lede">{{ $d['lede'] }}</p>
      @endif
    </div>

    <div class="about-compare">
      @foreach($columns as $i => $col)
        @php $isUs = ($col['variant'] ?? '') === 'pro' || $i === 1; @endphp
        <div class="about-compare-card{{ $isUs ? ' us' : '' }}">
          @if(!empty($col['tag']))
            <span class="about-compare-tag">{{ $col['tag'] }}</span>
          @endif
          <h3>{{ $col['title'] ?? '' }}</h3>
          <ul class="about-compare-list">
            @foreach($col['items'] ?? [] as $item)
              @php
                $text = is_array($item) ? ($item['text'] ?? '') : $item;
                $mark = is_array($item) ? ($item['mark'] ?? ($isUs ? 'v' : 'x')) : ($isUs ? 'v' : 'x');
                $isHtml = is_array($item) && !empty($item['html']);
              @endphp
              <li>
                {!! $mark === 'v' ? $vIcon : $xIcon !!}
                <span>@if($isHtml){!! $text !!}@else{{ $text }}@endif</span>
              </li>
            @endforeach
          </ul>
          @if(!empty($col['footer']))
            <div class="about-compare-price">{{ $col['footer'] }}</div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
