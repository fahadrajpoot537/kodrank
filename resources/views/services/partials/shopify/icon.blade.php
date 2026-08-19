@php
  $key = $key ?? 'theme';
  $icons = [
    'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
    'phone' => '<rect x="7" y="2" width="10" height="20" rx="2"/><path d="M11 18h2"/>',
    'cart' => '<path d="M6 2h12l-1 7H7z"/><path d="M5 22h14l-2-9H7z"/>',
    'search' => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
    'migrate' => '<path d="M12 3v6m0 0 3-3m-3 3L9 6"/><path d="M4 13a8 8 0 0 0 16 0"/>',
    'vanish' => '<path d="M4 12h16"/><path d="M9 6 4 12l5 6"/>',
    'theme' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M7 4v5"/>',
    'arrow' => '<path d="M4 12h16m-6-6 6 6-6 6"/><path d="M4 6v12"/>',
    'bolt' => '<path d="m13 2-9 12h7l-1 8 9-12h-7z"/>',
    'chart' => '<path d="M3 3v18h18"/><path d="m7 14 3-4 4 3 5-7"/>',
    'plus' => '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 21h8M12 18v3"/>',
    'shield' => '<path d="M12 3 4 7v5c0 5 8 9 8 9s8-4 8-9V7z"/>',
    'grow' => '<path d="M12 20v-6M6 20v-4M18 20v-9"/><path d="M4 20h16"/>',
    'check' => '<path d="M20 6 9 17l-5-5"/>',
    'x' => '<path d="M18 6 6 18M6 6l12 12"/>',
    'bag' => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>',
    'spark' => '<path d="M12 2a7 7 0 0 0-7 7c0 3 2 5 2 7h10c0-2 2-4 2-7a7 7 0 0 0-7-7z"/><path d="M9 21h6"/>',
    'wholesale' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/>',
    'globe' => '<path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="9"/>',
    'electronics' => '<path d="M4 4h16v12H4z"/><path d="M2 20h20"/>',
    'food' => '<path d="M3 10h18M7 15h2M12 15h5"/><rect x="3" y="5" width="18" height="14" rx="2"/>',
    'home' => '<path d="M3 21V8l9-5 9 5v13"/><path d="M9 21v-6h6v6"/>',
    'email' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
    'call' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
  ];
  $body = $icons[$key] ?? $icons['theme'];
  $strokeWidth = $strokeWidth ?? '1.9';
@endphp
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $strokeWidth }}" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $body !!}</svg>
