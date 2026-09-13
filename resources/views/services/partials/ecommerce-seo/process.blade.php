@include('services.partials.shared.dm.process', [
  'pr' => $s['process'] ?? [],
  'secClass' => ($s['process']['section_class'] ?? null) ?: 'sec-paper',
  'perDesktop' => (int) (($s['process']['per_desktop'] ?? null) ?: 3),
])
