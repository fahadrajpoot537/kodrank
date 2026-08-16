@php
  $cta = $s['cta'] ?? [];
  $bg = $cta['image'] ?? $cta['background_image'] ?? null;
@endphp
<section class="sec-ink cta-bg"@if($bg) style="--cta-bg-image:url('{{ asset($bg) }}')"@endif>
  <div class="wrap">
    <div class="cta-wrap">
      @if(!empty($cta['eyebrow']))
        <span class="eyebrow">{{ $cta['eyebrow'] }}</span>
      @endif
      <h2>
        @if(!empty($cta['title_html']))
          {!! $cta['title_html'] !!}
        @else
          {{ $cta['title'] ?? '' }}
        @endif
      </h2>
      <p>{{ $cta['body'] ?? '' }}</p>
      <div class="cta-buttons">
        <a href="{{ $cta['cta_url'] ?? '#contact' }}" class="btn btn-primary">
          {{ $cta['cta_text'] ?? 'Book A Free Strategy Call' }}
          @include('services.partials.digital-marketing.icon', ['key' => 'arrow', 'fillNone' => true, 'attrs' => 'stroke="currentColor" stroke-width="2.2"'])
        </a>
      </div>
    </div>
  </div>
</section>
