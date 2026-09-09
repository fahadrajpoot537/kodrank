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
  if ($slug === 'shopify-seo-services') {
      $scope = 'shopifyseo-theme-page';
  }

  // Strip mid-page FINAL CTA bands from all theme-html bodies.
  // GEO CTA embeds multi-MB base64 — use comment/class anchored cuts, not naive .*? regex.
  if ($html !== '') {
      if (preg_match('/<!--\s*FINAL CTA\s*-->/i', $html, $m, PREG_OFFSET_CAPTURE)) {
          $start = (int) $m[0][1];
          $after = substr($html, $start);
          if (preg_match('/^<!--\s*FINAL CTA\s*-->\s*<section\b[^>]*>/i', $after, $open)) {
              $rest = substr($after, strlen($open[0]));
              $endPos = stripos($rest, '</section>');
              if ($endPos !== false) {
                  $endPos += strlen('</section>');
                  while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                      $endPos++;
                  }
                  $html = substr($html, 0, $start).substr($rest, $endPos);
              }
          }
      }
      $html = preg_replace(
          '/<!--\s*[^>]*CTA BAND[^>]*-->\s*<section\b[^>]*>.*?<\/section>\s*/is',
          '',
          $html
      ) ?? $html;
      // Lightweight class anchors (skip if already removed)
      foreach (['cta-final', 'cta-sec', 'cta-bg', 'cta-band', 'sec-cta-bg', 'sec-cta'] as $ctaClass) {
          if (! str_contains($html, $ctaClass)) {
              continue;
          }
          if (preg_match('/<section\b[^>]*\b'.preg_quote($ctaClass, '/').'\b[^>]*>/i', $html, $m, PREG_OFFSET_CAPTURE)) {
              $start = (int) $m[0][1];
              $rest = substr($html, $start + strlen($m[0][0]));
              $endPos = stripos($rest, '</section>');
              if ($endPos !== false) {
                  $endPos += strlen('</section>');
                  while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                      $endPos++;
                  }
                  $html = substr($html, 0, $start).substr($rest, $endPos);
              }
          }
      }
      // Replace theme HTML contact / quote / form blocks with the shared Laravel form below.
      foreach (['contact', 'quote'] as $formId) {
          if (preg_match('/<section\b[^>]*\bid=["\']'.preg_quote($formId, '/').'["\'][^>]*>/i', $html, $m, PREG_OFFSET_CAPTURE)) {
              $start = (int) $m[0][1];
              $rest = substr($html, $start + strlen($m[0][0]));
              $endPos = stripos($rest, '</section>');
              if ($endPos !== false) {
                  $endPos += strlen('</section>');
                  while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
                      $endPos++;
                  }
                  $html = substr($html, 0, $start).substr($rest, $endPos);
              }
          }
      }
      // Any leftover section that still embeds a <form> (theme contact clones).
      while (preg_match('/<section\b[^>]*>[\s\S]*?<form\b/i', $html, $m, PREG_OFFSET_CAPTURE)) {
          $start = (int) $m[0][1];
          if (! preg_match('/<section\b[^>]*>/i', substr($html, $start), $open)) {
              break;
          }
          $rest = substr($html, $start + strlen($open[0]));
          $endPos = stripos($rest, '</section>');
          if ($endPos === false) {
              break;
          }
          $endPos += strlen('</section>');
          while ($endPos < strlen($rest) && ctype_space($rest[$endPos])) {
              $endPos++;
          }
          $html = substr($html, 0, $start).substr($rest, $endPos);
      }

      // details.faq: unwrap <summary><button>…</button></summary> so native accordion works
      // (interactive button inside summary blocks toggle in Chromium/WebKit).
      $html = preg_replace(
          '/(<summary[^>]*>)\s*<button\b[^>]*>(.*?)<\/button>\s*(<\/summary>)/is',
          '$1$2$3',
          $html
      ) ?? $html;
  }

  $defaultContactMeta = [
      ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
      ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
      ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
  ];

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
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
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
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
          ],
          'fields' => [
              'name_label' => 'Name',
              'email_label' => 'Email',
              'phone_label' => 'Phone (optional)',
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
      'technical-seo-services' => [
          'eyebrow' => '— Talk to Us',
          'title' => 'Get Your Free Technical SEO Audit',
          'lede' => "Tell us about your site and we'll come back with real findings — not a generic sales pitch.",
          'points' => [
              'A real technical SEO specialist reviews your site — not an automated report generator.',
              "You'll hear back within one business day with next steps.",
              'No lock-in contracts — start with a single audit if that\'s all you need.',
          ],
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
              'message_label' => "What's going on with your rankings?",
              'message_placeholder' => 'Tell us what prompted you to look for technical SEO services…',
          ],
          'phone_required' => true,
          'page_type' => 'technical',
          'default_service' => 'Technical SEO Services',
          'submit_text' => 'Request My Free Audit',
      ],
      'aeo-services' => [
          'eyebrow' => 'Get In Touch',
          'title' => "Tell Us What You Sell. We'll Show You Where AEO Services Would Help First.",
          'lede' => "Fill this out and within one business day you'll get a personal note from a strategist — with three specific things we found in your AI visibility audit, not a form-letter pitch.",
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Within 1 Business Day', 'icon_key' => 'clock'],
          ],
          'fields' => [
              'first_name_label' => 'First name',
              'last_name_label' => 'Last name',
              'email_label' => 'Work email',
              'phone_label' => 'Phone (optional)',
              'website_label' => 'Website URL',
              'message_label' => 'What do you need most?',
              'message_placeholder' => 'e.g. Free AI Visibility Audit, schema, citations…',
          ],
          'phone_required' => false,
          'page_type' => 'aeo',
          'default_service' => 'AEO Services',
          'submit_text' => 'Get My Free AI Visibility Audit',
      ],
      'geo-services' => [
          'eyebrow' => 'GET IN TOUCH',
          'title' => "Let's find out if you need GEO services.",
          'lede' => "Tell us a little about your business and we'll run your free AI visibility audit — real answers from real AI platforms, no obligation attached.",
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
          ],
          'fields' => [
              'first_name_label' => 'First name',
              'last_name_label' => 'Last name',
              'email_label' => 'Work email',
              'phone_label' => 'Phone (optional)',
              'website_label' => 'Website URL',
              'message_label' => "What's prompting the search? (optional)",
              'message_placeholder' => 'e.g. Invisible in ChatGPT, losing AI Overview citations…',
          ],
          'phone_required' => false,
          'page_type' => 'geo',
          'default_service' => 'GEO Services',
          'submit_text' => 'Send it, get my audit',
      ],
      'monthly-seo-services' => [
          'eyebrow' => 'Start now',
          'title' => 'Get Your Free Monthly SEO Plan',
          'lede' => "Tell us about your site and where you want to grow. We'll send back a straight-talking plan — the keywords worth chasing, what's holding you back, and how our monthly SEO services would get you there.",
          'points' => [
              'A free audit of your biggest ranking gaps',
              'Upfront pricing — no obligation, no pressure',
              'A reply from a real SEO strategist, not a bot',
          ],
          'meta' => [
              ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
              ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
              ['label' => 'Response time', 'value' => 'Within one business day', 'icon_key' => 'clock'],
          ],
          'fields' => [
              'name_label' => 'Full name',
              'email_label' => 'Work email',
              'phone_label' => 'Phone (optional)',
              'website_label' => 'Website URL',
              'message_label' => 'Anything else? (optional)',
              'message_placeholder' => 'e.g. Grow organic traffic, recover lost rankings…',
          ],
          'phone_required' => false,
          'page_type' => 'monthly',
          'default_service' => 'Monthly SEO Services',
          'submit_text' => 'Send Me My Free Plan',
      ],
  ];

  $themeHtmlContact = array_merge(
      [
          'eyebrow' => 'Get In Touch',
          'title' => 'Tell us about your '.($page->name ?? 'project'),
          'lede' => 'Share a few details and we\'ll reply within one business day with clear next steps — no spam, no hard sell.',
          'meta' => $defaultContactMeta,
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
  // Always keep phone/email visible even if a slug override omitted meta.
  if (empty($themeHtmlContact['meta']) || ! is_array($themeHtmlContact['meta'])) {
      $themeHtmlContact['meta'] = $defaultContactMeta;
  }
@endphp
@php
  $webdevRefClass = (\App\Support\WpRefDesign::appliesTo($slug) && $slug !== 'off-page-seo-services') ? ' webdev-ref' : '';
@endphp
@if($html !== '')
  @php
    $html = \App\Support\ServiceInternalLinks::linkifyHtml($html, $slug);
  @endphp
  <div class="{{ $scope }} theme-html-root{{ $webdevRefClass }}">
    {!! $html !!}
  </div>
@endif
@include('services.partials.shared.related-services', ['page' => $page])
@include('services.partials.shared.dm.contact', ['ct' => $themeHtmlContact])
