@php $t = $s['trust'] ?? []; @endphp
<div class="trust">
  <div class="wrap trust-inner">
    <span class="trust-label">{{ $t['label'] ?? 'Trusted by growth teams at' }}</span>
    <div class="trust-logos">
      @foreach($t['logos'] ?? [] as $logo)
        <span class="trust-logo">{{ $logo }}</span>
      @endforeach
    </div>
  </div>
</div>
