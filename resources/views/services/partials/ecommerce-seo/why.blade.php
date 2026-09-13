@php
  $d = $s['why'] ?? [];
@endphp
@include('services.partials.shared.dm.cards', [
  'd' => $d,
  'secId' => 'why',
  'secClass' => ($d['section_class'] ?? null) ?: 'sec-ink',
  'ink' => true,
  'stack' => false,
])
