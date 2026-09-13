@php $t = $s['trust'] ?? []; @endphp
<div class="trust shopify-trust-strip" aria-label="{{ $t['label'] ?? 'Trusted across store types' }}">
  <div class="wrap trust-inner">
    <span class="trust-label">{{ $t['label'] ?? 'Trusted across store types' }}</span>
    <div class="trust-logos">
      @foreach($t['logos'] ?? $t['items'] ?? [] as $logo)
        <span class="trust-logo">{{ is_array($logo) ? ($logo['label'] ?? $logo['title'] ?? '') : $logo }}</span>
      @endforeach
    </div>
  </div>
</div>
