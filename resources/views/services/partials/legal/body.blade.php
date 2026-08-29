@php
  $d = $s['body'] ?? [];
  $html = $d['html'] ?? '';
  $updated = $d['updated'] ?? null;
  $eyebrow = $d['eyebrow'] ?? 'Legal';
@endphp
@if($html !== '')
<section class="legal-doc" id="legal-content">
  <div class="wrap">
    <div class="legal-inner">
      <div class="legal-prose">
        <div class="legal-meta">
          <span class="pill">{{ $eyebrow }}</span>
          @if($updated)
            <span>Last updated: {{ $updated }}</span>
          @endif
        </div>
        {!! $html !!}
      </div>
    </div>
  </div>
</section>
@endif
