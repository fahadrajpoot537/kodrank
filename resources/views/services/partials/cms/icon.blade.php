@php
  $key = $key ?? 'code';
  $icons = [
    'code' => '<path d="M7 8l-4 4 4 4M17 8l4 4-4 4M14 4l-4 16"/>',
    'ui' => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>',
    'migrate' => '<path d="M4 7V5a1 1 0 011-1h14a1 1 0 011 1v2M4 7h16M4 7l2 12a1 1 0 001 1h10a1 1 0 001-1l2-12M12 11v5M9 14h6"/>',
    'integration' => '<circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><circle cx="18" cy="6" r="2.5"/><path d="M8.5 6H15M6 8.5v7a2.5 2.5 0 002.5 2.5H15"/>',
    'seo' => '<path d="M12 3l7 4v5c0 4.4-3 8.3-7 9-4-0.7-7-4.6-7-9V7l7-4z"/><path d="M9.5 12l1.8 1.8L15 10"/>',
    'support' => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M18.4 5.6l-2.1 2.1M7.7 16.3l-2.1 2.1"/><circle cx="12" cy="12" r="3.2"/>',
    'bolt' => '<path d="M13 2L4.5 13H11l-1 9 8.5-11H12l1-9z"/>',
    'edit' => '<path d="M12 20h9M4 20h4M4 20V8a2 2 0 012-2h9M16 4l4 4-9 9-4 1 1-4 8-8z"/>',
    'scale' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
    'lock' => '<rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 018 0v3"/>',
    'wordpress' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 2.5 15 0 18M12 3c-2.5 2.5-2.5 15 0 18"/>',
    'strapi' => '<rect x="4" y="4" width="16" height="16" rx="3"/><path d="M9 9h6v6H9z"/>',
    'sanity' => '<path d="M12 3l9 5v8l-9 5-9-5V8l9-5z"/>',
    'contentful' => '<circle cx="12" cy="12" r="8"/><path d="M8 12h8M12 8v8"/>',
    'web' => '<path d="M4 6h16M4 12h16M4 18h10"/>',
    'shopify' => '<path d="M6 7l6-3 6 3v6l-6 3-6-3V7z"/><path d="M9 20h6"/>',
    'statamic' => '<path d="M4 17l6-6-6-6M12 19h8"/>',
    'stack' => '<path d="M12 3v18M5 8l7-5 7 5M5 16l7 5 7-5"/>',
    'check' => '<path d="M5 13l4 4L19 7"/>',
    'email' => '<path d="M4 6h16v12H4z"/><path d="M4 7l8 6 8-6"/>',
    'phone' => '<path d="M5 4h4l2 5-3 2a12 12 0 005 5l2-3 5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z"/>',
    'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
  ];
  $body = $icons[$key] ?? $icons['code'];
  $strokeWidth = $strokeWidth ?? '1.9';
@endphp
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $strokeWidth }}" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $body !!}</svg>
