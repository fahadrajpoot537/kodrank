@php $d = $s['trust'] ?? []; @endphp
@if(!empty($d['logos']))
<section class="wp-trust">
  <div class="wrap wp-trust-inner">
    <span class="wp-trust-label">{{ $d['label'] ?? 'Trusted by' }}</span>
    <div class="wp-trust-logos">
      @foreach($d['logos'] as $logo)
        <span class="wp-trust-logo">{{ is_array($logo) ? ($logo['label'] ?? '') : $logo }}</span>
      @endforeach
    </div>
  </div>
</section>
@endif
