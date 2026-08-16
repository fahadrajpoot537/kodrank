@php
  $phone = $c['site']['phone'] ?? '';
  $email = $c['site']['email'] ?? '';
  $telHref = $phone !== '' ? 'tel:' . preg_replace('/[^\d+]/', '', $phone) : '#';
  $auditUrl = $c['footer']['audit_url'] ?? '/contact';
  $auditText = $c['footer']['audit_text'] ?? 'Free Site Audit';
  if ($auditUrl === '' || $auditUrl === '#contact' || $auditUrl === '#') {
      $auditUrl = route('contact');
  } elseif (! str_starts_with($auditUrl, 'http') && ! str_starts_with($auditUrl, '#')) {
      $auditUrl = url($auditUrl);
  }
  $socialIcons = [
    'facebook' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.25-1.5 1.5-1.5h1.6V3.6c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.5-4 4.2v2.2H7v3.1h2.7V21h3.8Z"/></svg>',
    'x' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 3h3l-6.6 7.6L21.8 21h-6l-4.7-6.1L5.6 21H2.6l7-8.1L2.2 3h6.1l4.3 5.6L17.5 3Zm-1 16.2h1.7L7.6 4.7H5.8l10.7 14.5Z"/></svg>',
    'youtube' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12s0-3.1-.4-4.6a2.4 2.4 0 0 0-1.7-1.7C18.4 5.3 12 5.3 12 5.3s-6.4 0-7.9.4A2.4 2.4 0 0 0 2.4 7.4C2 8.9 2 12 2 12s0 3.1.4 4.6a2.4 2.4 0 0 0 1.7 1.7c1.5.4 7.9.4 7.9.4s6.4 0 7.9-.4a2.4 2.4 0 0 0 1.7-1.7C22 15.1 22 12 22 12Zm-12 3V9l5 3-5 3Z"/></svg>',
    'instagram' => '<svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="3.5" width="17" height="17" rx="5" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="3.6" stroke="currentColor" stroke-width="1.7"/><circle cx="17" cy="7" r="1.1" fill="currentColor"/></svg>',
    'linkedin' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M4.5 8.5H8V20H4.5V8.5ZM6.25 3.5a2 2 0 1 1 0 4 2 2 0 0 1 0-4ZM10.5 8.5H14v1.6c.5-.9 1.7-1.9 3.6-1.9 3.2 0 4.4 2 4.4 5.2V20H18.5v-5.3c0-1.4-.5-2.4-1.8-2.4-1 0-1.6.7-1.9 1.4-.1.2-.1.6-.1.9V20H10.5s.05-10.6 0-11.5Z"/></svg>',
  ];
@endphp
<footer>
  <div class="wrap">
    <div class="f-top f-top-5">
      <div class="f-brandcol">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ $c['site']['brand_name'] ?? 'KodRank' }} home">
          <img class="brand-logo" src="{{ asset('logo.png') }}" alt="{{ $c['site']['brand_name'] ?? 'KodRank' }}" width="168" height="40" decoding="async">
        </a>
        @if(!empty($c['footer']['blurb']))
          <p class="f-blurb">{{ $c['footer']['blurb'] }}</p>
        @endif
        <div class="f-social">
          @foreach($c['footer']['social'] ?? [] as $social)
            @php $key = strtolower($social['label'] ?? ''); @endphp
            <a href="{{ $social['url'] ?? '#' }}" aria-label="{{ ucfirst($key) }}">
              {!! $socialIcons[$key] ?? '<span>'.e($social['label'] ?? '').'</span>' !!}
            </a>
          @endforeach
        </div>
      </div>

      @foreach($c['footer']['columns'] ?? [] as $col)
        @continue(strcasecmp($col['title'] ?? '', 'Industries') === 0)
        @php
          $links = collect($col['links'] ?? [])->reject(function ($link) {
              $label = strtolower(trim((string) ($link['label'] ?? '')));
              return in_array($label, ['free site audit', 'contact', 'contact us'], true);
          })->values();
        @endphp
        <div class="f-col">
          <h4>{{ $col['title'] ?? '' }}</h4>
          <ul>
            @foreach($links as $link)
              <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
            @endforeach
          </ul>
        </div>
      @endforeach

      <div class="f-col f-contact-col">
        <h4>Contact</h4>
        <ul class="f-contact-list">
          @if($phone)
            <li><a href="{{ $telHref }}">{{ $phone }}</a></li>
          @endif
          @if($email)
            <li><a href="mailto:{{ $email }}">{{ $email }}</a></li>
          @endif
        </ul>
        <a class="f-audit-btn" href="{{ $auditUrl }}">{{ $auditText }}</a>
      </div>
    </div>

    <div class="f-bot">
      <span>{{ $c['site']['copyright'] ?? '' }}</span>
      <nav aria-label="Legal">
        <a href="#top">Terms &amp; Conditions</a>
        <a href="#top">Privacy Policy</a>
        <a href="{{ route('contact') }}">Contact Us</a>
      </nav>
    </div>
  </div>
</footer>
