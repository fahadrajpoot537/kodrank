@php
  $src = $media($case['image'] ?? '');
  $thumb = $media($case['image_thumb'] ?? '');
  $pos = $case['badge_pos'] ?? 'tr';
  if (! in_array($pos, ['tr', 'bl2'], true)) {
      $pos = 'tr';
  }
  $icon = $case['badge_icon'] ?? 'trend';
  $lazy = empty($eager) ? 'lazy' : 'eager';
@endphp
<div class="showcase @if(!empty($case['flip'])) flip @endif">
  <div class="sc-media reveal">
    <span class="glow"></span>
    @if(($case['badge_value'] ?? '') !== '')
      <div class="badge {{ $pos }}" data-badge>
        <div class="bi">
          @if($icon === 'bolt')
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
          @else
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8"/><path d="M21 7v6h-6"/></svg>
          @endif
        </div>
        <div>
          <div class="bn">{{ $case['badge_value'] }}</div>
          <div class="bl">{{ $case['badge_label'] ?? '' }}</div>
        </div>
      </div>
    @endif
    @if($src !== '')
      <div class="frame">
        <div class="frame-bar"><span class="dots"><i></i><i></i><i></i></span><span class="lbl">{{ $case['frame_label'] ?? '' }}</span></div>
        <img src="{{ $src }}" alt="{{ $case['image_alt'] ?? ($case['frame_label'] ?? '') }}" loading="{{ $lazy }}">
      </div>
    @endif
    @if($thumb !== '')
      <div class="sc-thumb">
        <div class="frame-bar"><span class="dots"><i></i><i></i><i></i></span><span class="lbl">{{ $case['frame_thumb_label'] ?? '' }}</span></div>
        <img src="{{ $thumb }}" alt="{{ $case['image_thumb_alt'] ?? ($case['frame_thumb_label'] ?? '') }}" loading="lazy">
      </div>
    @endif
  </div>
  <div class="sc-copy reveal">
    @if(($case['tag'] ?? '') !== '')
      <span class="rc-tag"><span class="d"></span>{{ $case['tag'] }}</span>
    @endif
    <h3>{{ $case['title'] ?? '' }}</h3>
    @if(($case['body_html'] ?? '') !== '')
      <p class="p">{!! $case['body_html'] !!}</p>
    @endif
    @if(!empty($case['metrics']))
      <div class="rstrip">
        @foreach($case['metrics'] as $m)
          <div class="r">
            <div class="rn">{{ $m['value'] ?? '' }}@if(($m['suffix'] ?? '') !== '')<span class="u">{{ $m['suffix'] }}</span>@endif</div>
            <div class="rl">{{ $m['label'] ?? '' }}</div>
          </div>
        @endforeach
      </div>
    @endif
    @if(!empty($case['chips']))
      <div class="chips">
        @foreach($case['chips'] as $chip)
          @php $chipLabel = is_array($chip) ? ($chip['label'] ?? '') : $chip; @endphp
          @if($chipLabel !== '')
            <span class="stk">{{ $chipLabel }}</span>
          @endif
        @endforeach
      </div>
    @endif
    @if(!empty($case['feats']))
      <ul class="feats">
        @foreach($case['feats'] as $feat)
          @php $featLabel = is_array($feat) ? ($feat['label'] ?? '') : $feat; @endphp
          @if($featLabel !== '')
            <li><span class="ck">{!! $check !!}</span>{{ $featLabel }}</li>
          @endif
        @endforeach
      </ul>
    @endif
  </div>
</div>
