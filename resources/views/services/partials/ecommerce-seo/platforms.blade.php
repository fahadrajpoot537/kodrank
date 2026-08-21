@php
  $d = $s['platforms'] ?? [];
  $items = $d['items'] ?? $d['cards'] ?? [];
  $cards = [];
  foreach ($items as $item) {
      if (is_string($item)) {
          $cards[] = ['title' => $item];
      } elseif (is_array($item)) {
          $cards[] = [
              'title' => $item['title'] ?? $item['label'] ?? '',
              'body' => $item['body'] ?? $item['text'] ?? '',
              'icon_key' => $item['icon_key'] ?? null,
          ];
      }
  }
  $d['cards'] = $cards;
@endphp
@include('services.partials.shared.dm.cards', [
  'd' => $d,
  'secId' => 'platforms',
  'secClass' => 'sec-mist',
  'ink' => false,
])
