@include('services.partials.shared.dm.problem', [
  'p' => $s['pain'] ?? [],
  'secId' => 'pain',
  'secClass' => ($s['pain']['section_class'] ?? null) ?: 'sec-paper',
])
