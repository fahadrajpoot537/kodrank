@php
  $key = $key ?? 'wordpress';
  $size = $size ?? 24;
@endphp
@switch($key)
  @case('wordpress')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8"/><path d="M2.5 9.5L8 22l3-9 3 9 5.5-12.5" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
    @break
  @case('shopify')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 7h12l-1.5 12a2 2 0 0 1-2 1.8H9.5a2 2 0 0 1-2-1.8L6 7z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 10V6a3 3 0 1 1 6 0v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    @break
  @case('chatbot')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="6" width="18" height="12" rx="3" stroke="currentColor" stroke-width="1.8"/><circle cx="9" cy="12" r="1.4" fill="currentColor"/><circle cx="15" cy="12" r="1.4" fill="currentColor"/><path d="M12 3v3M8 21l1-3M16 21l-1-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    @break
  @case('redesign')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 12a9 9 0 0 1 15.5-6.3M21 12a9 9 0 0 1-15.5 6.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M17 3v4h4M7 21v-4H3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('cms')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4" width="18" height="4" rx="1.2" stroke="currentColor" stroke-width="1.8"/><rect x="3" y="10" width="18" height="4" rx="1.2" stroke="currentColor" stroke-width="1.8"/><rect x="3" y="16" width="18" height="4" rx="1.2" stroke="currentColor" stroke-width="1.8"/><circle cx="6.5" cy="6" r=".8" fill="currentColor"/><circle cx="6.5" cy="12" r=".8" fill="currentColor"/><circle cx="6.5" cy="18" r=".8" fill="currentColor"/></svg>
    @break
  @case('ui')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 4h16v16H4z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M4 9h16M9 4v16" stroke="currentColor" stroke-width="1.8"/></svg>
    @break
  @case('onpage')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3v18M3 12h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
    @break
  @case('vitals')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M13 3L4 14h7l-1 7 9-11h-7l1-7z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
    @break
  @case('schema')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 3v4M16 3v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
    @break
  @case('mobile')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="4" y="2" width="16" height="20" rx="3" stroke="currentColor" stroke-width="1.8"/><path d="M9 18h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    @break
  @case('security')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('analytics')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 20V10M12 20V4M20 20v-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    @break
  @case('urls')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 5H4v14h16V9" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M14 3h7v7M21 3l-9 9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('copy')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16M4 12h10M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    @break
  @case('sitemap')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M3 12h18M12 3a13 13 0 0 1 0 18M12 3a13 13 0 0 0 0 18" stroke="currentColor" stroke-width="1.8"/></svg>
    @break
  @case('training')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="6" width="18" height="12" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M7 10h4M7 14h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    @break
  @case('support')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2v6M12 22v-2M4 12H2M22 12h-2M6 6L4.5 4.5M19.5 19.5L18 18M6 18l-1.5 1.5M19.5 4.5L18 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/></svg>
    @break
  @default
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/></svg>
@endswitch
