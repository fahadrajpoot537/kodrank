@php
  $p = $p ?? array_merge(\App\Support\CmsPageDefaults::contactPage(), is_array($c['contact_page'] ?? null) ? $c['contact_page'] : []);
  $phone = $c['site']['phone'] ?? '';
  $email = $c['site']['email'] ?? 'info@kodrank.com';
  $telHref = $phone !== '' ? 'tel:' . preg_replace('/[^\d+]/', '', $phone) : '#';
  $displayPhone = $phone !== '' ? $phone : '+1 (555) 123-4567';
  $crumbs = [
    ['label' => 'Home', 'url' => route('home')],
    ['label' => 'Contact', 'url' => ''],
  ];
  $stats = is_array($p['stats'] ?? null) && $p['stats'] !== [] ? $p['stats'] : [
    ['value' => '24h', 'label' => "Response\nTime"],
    ['value' => 'Free', 'label' => "Audit &\nProposal"],
    ['value' => '180+', 'label' => "Sites\nRanked"],
  ];
  $steps = is_array($p['steps'] ?? null) && $p['steps'] !== [] ? $p['steps'] : [];
  $serviceOptions = is_array($p['service_options'] ?? null) && $p['service_options'] !== [] ? $p['service_options'] : ['SEO','Web Development','Local SEO','E-commerce','Technical SEO','Content & Copy','Not sure yet'];
  $timelineOptions = is_array($p['timeline_options'] ?? null) && $p['timeline_options'] !== [] ? $p['timeline_options'] : [];
  $offices = is_array($p['offices'] ?? null) && $p['offices'] !== [] ? $p['offices'] : [];
  $faqs = is_array($p['faqs'] ?? null) && $p['faqs'] !== [] ? $p['faqs'] : [];
@endphp
<main class="cp-main">
  <header class="hero cp-hero" aria-label="Contact">
    <div class="wrap">
      <div class="hero-grid">
        <div class="hero-copy">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              @foreach($crumbs as $i => $crumb)
                @php
                  $isLast = $i === count($crumbs) - 1;
                  $label = $crumb['label'] ?? '';
                  $url = $crumb['url'] ?? '';
                @endphp
                <li @if($isLast || $url === '') aria-current="page" @endif>
                  @if(!$isLast && $url !== '')
                    <a href="{{ $url }}">{{ $label }}</a>
                  @else
                    {{ $label }}
                  @endif
                </li>
              @endforeach
            </ol>
          </nav>
          <p class="eyebrow">{{ $p['hero_eyebrow'] ?? 'Get in touch' }}</p>
          <h1>{{ $p['hero_title'] ?? 'Let\'s build a site that' }} <span class="accent">{{ $p['hero_title_accent'] ?? 'ranks. And converts.' }}</span></h1>
          <p class="lede">{{ $p['hero_lede'] ?? '' }}</p>
          <div class="hero-stats" role="list">
            @foreach($stats as $stat)
            <div class="stat" role="listitem">
              <div class="stat-num">{{ $stat['value'] ?? '' }}</div>
              <div class="stat-label">{!! nl2br(e($stat['label'] ?? '')) !!}</div>
            </div>
            @endforeach
          </div>
        </div>
        <aside class="hero-quote">
          <div class="hero-quote-stars" aria-hidden="true">
            @for($i = 0; $i < 5; $i++)
              <svg viewBox="0 0 20 20"><path d="M10 1l2.6 5.6 6 .6-4.5 4.1 1.3 6-5.4-3-5.4 3 1.3-6L1.4 7.2l6-.6L10 1z"/></svg>
            @endfor
          </div>
          <p>{{ $p['quote'] ?? '' }}</p>
          <div class="hero-quote-author">
            <div class="hero-quote-avatar">{{ $p['quote_initials'] ?? 'SC' }}</div>
            <div>
              <div class="hero-quote-name">{{ $p['quote_name'] ?? '' }}</div>
              <div class="hero-quote-role">{{ $p['quote_role'] ?? '' }}</div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </header>

  <section class="sec-mist" id="form">
    <div class="wrap">
      <nav class="breadcrumb cp-bc-mobile" aria-label="Breadcrumb">
        <ol>
          @foreach($crumbs as $i => $crumb)
            @php
              $isLast = $i === count($crumbs) - 1;
              $label = $crumb['label'] ?? '';
              $url = $crumb['url'] ?? '';
            @endphp
            <li @if($isLast || $url === '') aria-current="page" @endif>
              @if(!$isLast && $url !== '')
                <a href="{{ $url }}">{{ $label }}</a>
              @else
                {{ $label }}
              @endif
            </li>
          @endforeach
        </ol>
      </nav>
      <div class="contact-grid">
        <aside class="info-panel">
          <span class="eyebrow">{{ $p['how_eyebrow'] ?? 'Here\'s how it works' }}</span>
          <h2>{{ $p['how_title'] ?? 'What happens after you hit send.' }}</h2>
          <p class="lede">{{ $p['how_lede'] ?? '' }}</p>

          <ul class="steps">
            @foreach($steps as $step)
            <li class="step">
              <div class="step-num">{{ $step['num'] ?? '' }}</div>
              <div>
                <div class="step-title">{{ $step['title'] ?? '' }}</div>
                <div class="step-desc">{{ $step['desc'] ?? '' }}</div>
                <span class="step-meta">{{ $step['meta'] ?? '' }}</span>
              </div>
            </li>
            @endforeach
          </ul>

          <div class="direct-contact">
            <div class="direct-contact-title">{{ $p['skip_title'] ?? 'Prefer to skip the form?' }}</div>
            <div class="contact-methods">
              <a href="mailto:{{ $email }}" class="contact-method">
                <div class="contact-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                </div>
                <div>
                  <div class="contact-label">Email us</div>
                  <div class="contact-value">{{ $email }}</div>
                </div>
              </a>
              @if($phone)
              <a href="{{ $telHref }}" class="contact-method">
                <div class="contact-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <div>
                  <div class="contact-label">{{ $p['call_hours'] ?? 'Call us — Mon–Fri, 9a–6p PKT' }}</div>
                  <div class="contact-value">{{ $displayPhone }}</div>
                </div>
              </a>
              @endif
              <div class="contact-method">
                <div class="contact-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                  <div class="contact-label">{{ $p['studios_label'] ?? 'Studios' }}</div>
                  <div class="contact-value">{{ $p['studios_value'] ?? 'Lahore · Dubai · Remote' }}</div>
                </div>
              </div>
            </div>
          </div>
        </aside>

        <div class="form-card" id="contact">
          <div class="form-header">
            <span class="eyebrow">{{ $p['form_eyebrow'] ?? 'Let\'s get started' }}</span>
            <h2>{{ $p['form_title'] ?? 'Tell us about your project.' }}</h2>
            <p>{{ $p['form_lede'] ?? '' }}</p>
          </div>

          @if(session('contact_success'))
            <div class="form-status show success" role="status">
              <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10l4 4 8-8"/></svg>
              <span>{{ session('contact_success') }}</span>
            </div>
          @endif

          @if($errors->any())
            <div class="form-status show error" role="alert">
              <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="8"/><path d="M10 6v4M10 14h.01"/></svg>
              <span>{{ $errors->first() }}</span>
            </div>
          @endif

          <form id="contact-form" method="POST" action="{{ route('contact.store') }}" novalidate autocomplete="on">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ route('contact') }}#form">

            <div class="hp-field" aria-hidden="true">
              <label for="fax_number">Fax number (leave blank)</label>
              <input type="text" name="fax_number" id="fax_number" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-row">
              <div class="field{{ $errors->has('name') ? ' error' : '' }}" data-field="first_name">
                <label for="first_name">First name<span class="req">*</span></label>
                <input type="text" name="first_name" id="first_name" placeholder="Jane" required maxlength="100" autocomplete="given-name" value="{{ old('first_name') }}">
                <div class="field-error-msg">Please enter your first name.</div>
              </div>
              <div class="field" data-field="last_name">
                <label for="last_name">Last name<span class="req">*</span></label>
                <input type="text" name="last_name" id="last_name" placeholder="Doe" required maxlength="100" autocomplete="family-name" value="{{ old('last_name') }}">
                <div class="field-error-msg">Please enter your last name.</div>
              </div>
            </div>

            <div class="form-row">
              <div class="field{{ $errors->has('email') ? ' error' : '' }}" data-field="email">
                <label for="email">Business email<span class="req">*</span></label>
                <input type="email" name="email" id="email" placeholder="you@company.com" required maxlength="200" autocomplete="email" value="{{ old('email') }}">
                <div class="field-error-msg">Please enter a valid email address.</div>
              </div>
              <div class="field" data-field="phone">
                <label for="phone">Phone <span class="opt">(optional)</span></label>
                <input type="tel" name="phone" id="phone" placeholder="+1 555 000 0000" maxlength="40" autocomplete="tel" value="{{ old('phone') }}">
              </div>
            </div>

            <div class="form-row single">
              <div class="field" data-field="website">
                <label for="website">Company website or URL <span class="opt">(optional)</span></label>
                <input type="url" name="website" id="website" placeholder="https://yourcompany.com" maxlength="300" autocomplete="url" value="{{ old('website') }}">
              </div>
            </div>

            <div class="form-row single">
              <div class="field" data-field="services">
                <label>What are you interested in? <span class="opt">(select all that apply)</span></label>
                <div class="pill-group" data-multi data-target="services">
                  @foreach($serviceOptions as $pill)
                    @php $pillLabel = is_array($pill) ? ($pill['label'] ?? $pill['value'] ?? '') : $pill; $pillVal = is_array($pill) ? ($pill['value'] ?? $pillLabel) : $pill; @endphp
                    <div class="pill" data-value="{{ $pillVal }}">
                      <svg class="pill-check" viewBox="0 0 14 14" fill="none"><path d="M2 7l3.5 3.5L12 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                      {{ $pillLabel }}
                    </div>
                  @endforeach
                </div>
                <input type="hidden" name="services" id="hidden-services" value="{{ old('services') }}">
              </div>
            </div>

            <div class="form-row single">
              <div class="field" data-field="timeline">
                <label>When do you want to start? <span class="opt">(optional)</span></label>
                <div class="pill-group" data-single data-target="timeline">
                  @foreach($timelineOptions as $opt)
                    @php
                      $val = is_array($opt) ? ($opt['value'] ?? '') : $opt;
                      $label = is_array($opt) ? ($opt['label'] ?? $val) : $opt;
                    @endphp
                    <div class="pill{{ old('timeline') === $val ? ' active' : '' }}" data-value="{{ $val }}">{{ $label }}</div>
                  @endforeach
                </div>
                <input type="hidden" name="timeline" id="hidden-timeline" value="{{ old('timeline') }}">
              </div>
            </div>

            <div class="form-row single">
              <div class="field" data-field="message">
                <label for="message">Tell us about your project <span class="opt">(optional)</span></label>
                <textarea name="message" id="message" maxlength="3000" placeholder="{{ $p['message_placeholder'] ?? '' }}">{{ old('message') }}</textarea>
              </div>
            </div>

            <label class="consent">
              <input type="checkbox" id="consent" name="consent" value="1" required @checked(old('consent'))>
              <span class="consent-label">{!! $p['consent_html'] ?? '' !!}</span>
            </label>

            <div class="form-status" id="form-status" role="alert" aria-live="polite"></div>

            @include('partials.recaptcha')

            <div class="form-submit">
              <div class="trust-row">
                <span class="trust-item">
                  <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="7" width="10" height="7" rx="1.5"/><path d="M5.5 7V4.5a2.5 2.5 0 0 1 5 0V7"/></svg>
                  Secure &amp; encrypted
                </span>
                <span class="trust-item">
                  <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="6.5"/><path d="M8 4v4l2.5 2.5" stroke-linecap="round"/></svg>
                  24-hour reply
                </span>
              </div>
              <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                <span class="btn-label">{{ $p['submit_text'] ?? 'Get My Free Proposal' }}</span>
                <svg width="16" height="16" viewBox="0 0 14 14" fill="none"><path d="M1 7H13M13 7L7.5 1.5M13 7L7.5 12.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="sec-ink">
    <div class="wrap">
      <div class="offices-head">
        <div>
          <span class="eyebrow">{{ $p['offices_eyebrow'] ?? 'Not a new project?' }}</span>
          <h2>{{ $p['offices_title'] ?? 'Reach the right team, faster.' }}</h2>
        </div>
        <p class="lede">{{ $p['offices_lede'] ?? '' }}</p>
      </div>

      <div class="offices-grid">
        @foreach($offices as $office)
        <div class="office-card">
          <div class="office-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          </div>
          <h3>{{ $office['title'] ?? '' }}</h3>
          <p>{{ $office['body'] ?? '' }}</p>
          <div class="office-info">
            <a href="mailto:{{ $email }}">{{ $email }}</a>
            <span>{{ $office['meta'] ?? '' }}</span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="faq" class="cp-faq">
    <div class="wrap faq-wrap">
      <div class="rv" style="text-align:center;margin-bottom:clamp(36px,4vw,52px)">
        <p class="eyebrow" style="justify-content:center">{{ $p['faq_eyebrow'] ?? 'Before you send' }}</p>
        <h2>{{ $p['faq_title'] ?? 'Quick answers, so you don\'t have to ask.' }}</h2>
      </div>

      <div class="faq rv">
        @foreach($faqs as $i => $item)
          <details @if($i === 0) open @endif>
            <summary>{{ $item['q'] ?? '' }}</summary>
            <div class="faq-a"><p>{{ $item['a'] ?? '' }}</p></div>
          </details>
        @endforeach
      </div>
    </div>
  </section>
</main>
