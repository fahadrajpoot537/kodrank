@php
  $m = $s['mission'] ?? [];
  $check = '<svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 6 9 17l-5-5"/></svg>';
@endphp
<section id="mission" class="sec-paper">
  <div class="wrap">
    <div class="about-mission">
      <div>
        @if(!empty($m['num']))
          <div class="about-mission-num">{{ $m['num'] }}</div>
        @endif
        @if(!empty($m['eyebrow']))
          <span class="eyebrow">{{ $m['eyebrow'] }}</span>
        @endif
        <h2 style="margin-top:12px">
          @if(!empty($m['title_html']))
            {!! $m['title_html'] !!}
          @else
            {{ $m['title'] ?? '' }}
          @endif
        </h2>
      </div>
      <div>
        @if(!empty($m['lede']))
          <p class="lede">{{ $m['lede'] }}</p>
        @endif
        <ul class="about-mission-list">
          @foreach($m['items'] ?? [] as $item)
            <li>
              {!! $check !!}
              <span>
                @if(!empty($item['title']))
                  <b>{{ $item['title'] }}</b>
                @endif
                {{ $item['body'] ?? '' }}
              </span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
