@include('services.partials.shared.dm.cards', [
  'd' => $s['services'] ?? [],
  'secId' => 'services',
  'secClass' => 'sec-mist',
  'ink' => false,
])
