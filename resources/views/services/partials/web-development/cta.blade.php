@php
  $d = $s['cta'] ?? [];
  $bg = asset($d['image'] ?? 'media/services/web-design/cta-bg.webp');
  $primary = $d['primary'] ?? [];
  $secondary = $d['secondary'] ?? [];
@endphp
<section class="sec-paper" id="cta">
  <div class="wrap">
    <div class="cta-card reveal" style="--cta-bg:url('{{ $bg }}')" data-bg="{{ $bg }}">
      @if(!empty($d['eyebrow']))
        <span class="eyebrow" style="color: var(--signal);">{{ $d['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($d['title_html']))
          {!! $d['title_html'] !!}
        @else
          {{ $d['title'] ?? '' }}
        @endif
      </h2>
      @if(!empty($d['body']))
        <p>{{ $d['body'] }}</p>
      @endif
      <div class="cta-ctas">
        <a href="{{ $primary['url'] ?? '#contact' }}" class="btn btn-primary">
          {{ $primary['text'] ?? 'Get A Free Proposal' }}
          <span class="arrow">→</span>
        </a>
        <a href="{{ $secondary['url'] ?? '#contact' }}" class="btn btn-ghost-light">
          {{ $secondary['text'] ?? 'Book A 20-Min Call' }}
          <span class="arrow">→</span>
        </a>
      </div>
    </div>
  </div>
</section>
