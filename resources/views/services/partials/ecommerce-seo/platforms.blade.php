@php
  $d = $s['platforms'] ?? [];
  $items = $d['items'] ?? $d['cards'] ?? [];

  $iconMap = [
      'digital agencies' => 'team',
      'web studios' => 'onpage',
      'freelance consultants' => 'human',
      'marketing collectives' => 'pr',
      'b2b saas agencies' => 'saas',
  ];

  $cards = [];
  foreach ($items as $item) {
      if (is_string($item)) {
          $title = $item;
          $body = '';
          $icon = $iconMap[strtolower(trim($item))] ?? 'whitelabel';
      } elseif (is_array($item)) {
          $title = (string) ($item['title'] ?? $item['label'] ?? '');
          $body = (string) ($item['body'] ?? $item['text'] ?? '');
          $icon = $item['icon_key'] ?? ($iconMap[strtolower(trim($title))] ?? 'whitelabel');
      } else {
          continue;
      }
      $cards[] = [
          'title' => $title,
          'body' => $body,
          'icon_key' => $icon,
      ];
  }
  $d['cards'] = $cards;
@endphp
@include('services.partials.shared.dm.cards', [
  'd' => $d,
  'secId' => 'platforms',
  'secClass' => 'sec-mist platforms-sec',
  'ink' => false,
])
