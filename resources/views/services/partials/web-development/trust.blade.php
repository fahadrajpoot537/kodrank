@php $t = $s['trust'] ?? []; @endphp
<section class="trust">
  <div class="wrap trust-inner">
    <span class="trust-label">{{ $t['label'] ?? 'Trusted by growth teams' }}</span>
    <div class="trust-logos">
      @foreach($t['logos'] ?? [] as $logo)
        <span class="trust-logo">{{ is_array($logo) ? ($logo['label'] ?? '') : $logo }}</span>
      @endforeach
    </div>
  </div>
</section>
