@php
  $d = $s['body'] ?? [];
  $html = trim((string) ($d['html'] ?? ''));
  $htmlPath = (string) ($d['html_path'] ?? '');
  $scope = $d['scope'] ?? 'theme-html-page';
  $slug = (string) ($page->slug ?? '');

  if ($html === '' && $htmlPath !== '') {
      $full = storage_path('app/'.$htmlPath);
      if (is_file($full)) {
          $html = trim((string) file_get_contents($full));
      }
  }

  // Guess storage path when CMS only has slug (common after incomplete seed).
  if ($html === '' && $slug !== '') {
      $guess = storage_path('app/theme-html/'.$slug.'.html');
      if (is_file($guess)) {
          $html = trim((string) file_get_contents($guess));
      }
  }

  // Recover from committed theme-body files (avoids re-parsing huge base64 theme HTML).
  if ($html === '') {
      $bodyFallbacks = [
          'saas-software-development-services' => [
              'file' => resource_path('theme-bodies/saas-software-development-services.html'),
              'scope' => 'saas-theme-page',
          ],
          'website-redesign-services' => [
              'file' => resource_path('theme-bodies/website-redesign-services.html'),
              'scope' => 'redesign-theme-page',
          ],
          'geo-services' => [
              'file' => resource_path('theme-bodies/geo-services.html'),
              'scope' => 'geo-theme-page',
          ],
      ];

      if (isset($bodyFallbacks[$slug]) && is_file($bodyFallbacks[$slug]['file'])) {
          $html = trim((string) file_get_contents($bodyFallbacks[$slug]['file']));
          if ($html !== '') {
              $scope = $bodyFallbacks[$slug]['scope'];
              try {
                  \App\Support\ThemeHtmlImporter::storeHtmlFile($slug, $html);
              } catch (\Throwable $e) {
                  // still render even if storage write fails
              }
          }
      }
  }

  // Last resort: extract from public theme HTML (skip for known huge/base64 files).
  if ($html === '') {
      $sources = [
          'website-redesign-services' => [
              'html' => public_path('theme/newservices/kodrank-website-redesign-services/website-redesign-services.html'),
              'media' => 'media/services/website-redesign',
              'store' => 'website-redesign-services',
              'scope' => 'redesign-theme-page',
          ],
          'electrician-website-design-services' => [
              'html' => public_path('theme/newone/Electrician-Website-Design-Services/electrician-website-design.html'),
              'media' => 'media/services/electrician-website',
              'store' => 'electrician-website-design-services',
              'scope' => 'elec-theme-page',
          ],
      ];
      if (isset($sources[$slug]) && is_file($sources[$slug]['html'])) {
          try {
              $extracted = \App\Support\ThemeHtmlImporter::extract($sources[$slug]['html'], $sources[$slug]['media']);
              $html = trim((string) ($extracted['html'] ?? ''));
              if ($html !== '') {
                  \App\Support\ThemeHtmlImporter::storeHtmlFile($sources[$slug]['store'], $html);
                  $scope = $sources[$slug]['scope'];
              }
          } catch (\Throwable $e) {
              // leave empty — page still shows KodRank hero
          }
      }
  }

  if ($slug === 'saas-software-development-services') {
      $scope = 'saas-theme-page';
  }
  if ($slug === 'digital-marketing-services') {
      $scope = 'dm-theme-page';
  }
  if ($slug === 'on-page-seo-services') {
      $scope = 'onpage-theme-page';
  }
  if ($slug === 'off-page-seo-services') {
      $scope = 'offpage-theme-page';
  }
  if ($slug === 'geo-services') {
      $scope = 'geo-theme-page';
  }
  if ($slug === 'wordpress-seo-services') {
      $scope = 'wpseo-theme-page';
  }
  if ($slug === 'guest-posting-services') {
      $scope = 'gp-theme-page';
  }
  if ($slug === 'healthcare-seo-services') {
      $scope = 'hc-theme-page';
  }
  if ($slug === 'technical-seo-services') {
      $scope = 'techseo-theme-page';
  }
  if ($slug === 'aeo-services') {
      $scope = 'aeo-theme-page';
  }
  if ($slug === 'monthly-seo-services') {
      $scope = 'monthly-theme-page';
  }
  if ($slug === 'saas-seo-services') {
      $scope = 'saasseo-theme-page';
  }
  if ($slug === 'b2b-seo-services') {
      $scope = 'b2b-theme-page';
  }
  if ($slug === 'ecommerce-seo-services') {
      $scope = 'ecom-theme-page';
  }
  if ($slug === 'restaurant-seo-services') {
      $scope = 'rest-theme-page';
  }
  if ($slug === 'real-estate-seo-services') {
      $scope = 're-theme-page';
  }

  // Strip mid-page FINAL CTA bands from all theme-html bodies.
  if ($html !== '') {
      $html = preg_replace(
          '/<!--\s*[^>]*FINAL CTA[^>]*-->\s*<section\b[^>]*>.*?<\/section>\s*/is',
          '',
          $html
      ) ?? $html;
      $html = preg_replace(
          '/<!--\s*[^>]*CTA BAND[^>]*-->\s*<section\b[^>]*>.*?<\/section>\s*/is',
          '',
          $html
      ) ?? $html;
      $html = preg_replace(
          '/<section\b[^>]*\b(?:cta-bg|cta-band|cta-sec|sec-cta-bg|sec-cta|ctaband|cta-final)\b[^>]*>.*?<\/section>\s*/is',
          '',
          $html
      ) ?? $html;
      // Replace theme HTML contact blocks with the shared Laravel form below.
      $html = preg_replace(
          '/<section\b[^>]*\bid=["\']contact["\'][^>]*>.*?<\/section>\s*/is',
          '',
          $html
      ) ?? $html;
  }

  $contactDefaultsBySlug = [
      'guest-posting-services' => [
          'eyebrow' => 'Get started',
          'title' => "Ready for guest posting services you'd actually put your name on?",
          'lede' => "Tell us your target pages and niche. We'll come back with a free, no-pressure link plan — real publishers, honest pricing, and a shortlist you approve.",
          'points' => [
              'Free link plan within one business day',
              'Real publishers — you approve every site',
              'No spam, no lock-in contracts',
          ],
          'fields' => [
              'name_label' => 'Full name',
              'email_label' => 'Work email',
              'phone_label' => 'Contact number',
              'website_label' => 'Your website',
              'message_label' => 'Target pages or niche (optional)',
              'message_placeholder' => 'e.g. SaaS blog, DR 40+, US traffic…',
          ],
          'default_service' => 'Guest Posting Services',
          'submit_text' => 'Get my free link plan',
      ],
      'wordpress-seo-services' => [
          'eyebrow' => 'Get started',
          'title' => "Let's find out what's capping your rankings.",
          'lede' => "Tell us about your site and we'll send back a free audit — the real reasons you're not ranking, and exactly what we'd fix first. No pressure, no jargon.",
          'points' => [
              'Free technical & content audit',
              'Reply within one business day',
              'No contracts, no obligation',
          ],
          'fields' => [
              'name_label' => 'Name',
              'email_label' => 'Email',
              'website_label' => 'Website URL',
              'message_label' => "What's your biggest SEO frustration?",
              'message_placeholder' => 'e.g. Slow site, stuck rankings, no organic leads…',
          ],
          'default_service' => 'WordPress SEO Services',
          'submit_text' => 'Send my free audit request',
      ],
      'on-page-seo-services' => [
          'eyebrow' => 'Start here',
          'title' => 'Tell us where you want to rank.',
          'lede' => "Share a little about your site and goals. We'll come back with a plain-English read on your biggest on-page opportunities — usually within one business day.",
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
          ],
          'fields' => [
              'first_name_label' => 'First name',
              'last_name_label' => 'Last name',
              'email_label' => 'Work email',
              'phone_label' => 'Phone',
              'website_label' => 'Website URL',
              'message_label' => "What's not ranking?",
              'message_placeholder' => 'Tell us which pages or keywords matter most…',
          ],
          'phone_required' => true,
          'page_type' => 'on_page',
          'default_service' => 'On-Page SEO Services',
          'submit_text' => 'Get My Free Audit',
      ],
      'off-page-seo-services' => [
          'eyebrow' => 'Get started',
          'title' => 'Tell us about your site',
          'lede' => "Send us your domain and your biggest ranking headache. You'll get an honest audit and a plan back within two working days — not a sales script.",
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Audit back within 48 working hours', 'icon_key' => 'clock'],
          ],
          'fields' => [
              'first_name_label' => 'First name',
              'last_name_label' => 'Last name',
              'email_label' => 'Work email',
              'phone_label' => 'Phone',
              'website_label' => 'Website URL',
              'message_label' => 'How can we help?',
              'message_placeholder' => 'e.g. Stuck on page two for our main service keyword…',
          ],
          'phone_required' => true,
          'page_type' => 'off_page',
          'default_service' => 'Off-Page SEO Services',
          'submit_text' => 'Send & get my audit',
      ],
  ];

  $themeHtmlContact = array_merge(
      [
          'eyebrow' => 'Get In Touch',
          'title' => 'Tell us about your '.($page->name ?? 'project'),
          'lede' => 'Share a few details and we\'ll reply within one business day with clear next steps — no spam, no hard sell.',
          'fields' => [
              'name_label' => 'Full name',
              'email_label' => 'Work email',
              'phone_label' => 'Phone (optional)',
              'website_label' => 'Website URL',
              'message_label' => 'How can we help?',
          ],
          'default_service' => $page->name ?? '',
          'submit_text' => 'Send & Get A Personal Reply',
      ],
      $contactDefaultsBySlug[$slug] ?? [],
      $s['contact'] ?? []
  );
@endphp
@php
  $webdevRefClass = (\App\Support\WpRefDesign::appliesTo($slug) && $slug !== 'off-page-seo-services') ? ' webdev-ref' : '';
@endphp
@if($html !== '')
  <div class="{{ $scope }} theme-html-root{{ $webdevRefClass }}">
    {!! $html !!}
  </div>
@endif
@include('services.partials.shared.dm.contact', ['ct' => $themeHtmlContact])
