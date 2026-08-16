@php
  $phone = $c['site']['phone'] ?? '';
  $email = $c['site']['email'] ?? 'info@kodrank.com';
  $telHref = $phone !== '' ? 'tel:' . preg_replace('/[^\d+]/', '', $phone) : '#';
  $displayPhone = $phone !== '' ? $phone : '+1 (555) 123-4567';
  $crumbs = [
    ['label' => 'Home', 'url' => route('home')],
    ['label' => 'Contact', 'url' => ''],
  ];
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
          <p class="eyebrow">Get in touch</p>
          <h1>Let's build a site that <span class="accent">ranks. And converts.</span></h1>
          <p class="lede">Tell us what you're working on. We'll come back within 24 hours with honest input — a realistic scope, a plain-English plan, and a number you can actually use.</p>
          <div class="hero-stats" role="list">
            <div class="stat" role="listitem">
              <div class="stat-num">24h</div>
              <div class="stat-label">Response<br>Time</div>
            </div>
            <div class="stat" role="listitem">
              <div class="stat-num">Free</div>
              <div class="stat-label">Audit &amp;<br>Proposal</div>
            </div>
            <div class="stat" role="listitem">
              <div class="stat-num">180+</div>
              <div class="stat-label">Sites<br>Ranked</div>
            </div>
          </div>
        </div>
        <aside class="hero-quote">
          <div class="hero-quote-stars" aria-hidden="true">
            @for($i = 0; $i < 5; $i++)
              <svg viewBox="0 0 20 20"><path d="M10 1l2.6 5.6 6 .6-4.5 4.1 1.3 6-5.4-3-5.4 3 1.3-6L1.4 7.2l6-.6L10 1z"/></svg>
            @endfor
          </div>
          <p>The scoping call itself was worth more than the last two agencies we hired. Rebuilt our platform and doubled organic leads in four months.</p>
          <div class="hero-quote-author">
            <div class="hero-quote-avatar">SC</div>
            <div>
              <div class="hero-quote-name">Sarah Chen</div>
              <div class="hero-quote-role">CMO, Nexus Retail</div>
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
          <span class="eyebrow">Here's how it works</span>
          <h2>What happens after you hit send.</h2>
          <p class="lede">No sales-y follow-ups. No 40-page proposals. Just a real conversation with the person who'd do the work.</p>

          <ul class="steps">
            <li class="step">
              <div class="step-num">01</div>
              <div>
                <div class="step-title">You send the form</div>
                <div class="step-desc">The more context you share, the sharper our first reply. Rough is fine — we'll ask the rest.</div>
                <span class="step-meta">Takes 2 minutes</span>
              </div>
            </li>
            <li class="step">
              <div class="step-num">02</div>
              <div>
                <div class="step-title">We reply within 24 hours</div>
                <div class="step-desc">A real message from a strategist — not a booking link. If we're not the right fit, we'll tell you and point you somewhere better.</div>
                <span class="step-meta">One human, one email</span>
              </div>
            </li>
            <li class="step">
              <div class="step-num">03</div>
              <div>
                <div class="step-title">30-minute discovery call</div>
                <div class="step-desc">We walk your site, look at the numbers, and sketch a plan. You leave with an audit whether we work together or not.</div>
                <span class="step-meta">Free, no pressure</span>
              </div>
            </li>
          </ul>

          <div class="direct-contact">
            <div class="direct-contact-title">Prefer to skip the form?</div>
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
                  <div class="contact-label">Call us — Mon–Fri, 9a–6p PKT</div>
                  <div class="contact-value">{{ $displayPhone }}</div>
                </div>
              </a>
              @endif
              <div class="contact-method">
                <div class="contact-icon">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                  <div class="contact-label">Studios</div>
                  <div class="contact-value">Lahore · Dubai · Remote</div>
                </div>
              </div>
            </div>
          </div>
        </aside>

        <div class="form-card" id="contact">
          <div class="form-header">
            <span class="eyebrow">Let's get started</span>
            <h2>Tell us about your project.</h2>
            <p>Seven fields. Two minutes. A real reply from a strategist — not an auto-responder.</p>
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
                  @foreach(['SEO','Web Development','Local SEO','E-commerce','Technical SEO','Content & Copy','Not sure yet'] as $pill)
                    <div class="pill" data-value="{{ $pill }}">
                      <svg class="pill-check" viewBox="0 0 14 14" fill="none"><path d="M2 7l3.5 3.5L12 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                      {{ $pill }}
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
                  @foreach(['ASAP' => 'ASAP', '1–3 months' => 'In 1–3 months', '3–6 months' => 'In 3–6 months', 'Just exploring' => 'Just exploring'] as $val => $label)
                    <div class="pill{{ old('timeline') === $val ? ' active' : '' }}" data-value="{{ $val }}">{{ $label }}</div>
                  @endforeach
                </div>
                <input type="hidden" name="timeline" id="hidden-timeline" value="{{ old('timeline') }}">
              </div>
            </div>

            <div class="form-row single">
              <div class="field" data-field="message">
                <label for="message">Tell us about your project <span class="opt">(optional)</span></label>
                <textarea name="message" id="message" maxlength="3000" placeholder="What are you trying to achieve? What's not working today? Any specific challenges — traffic that isn't converting, a rebuild that stalled, a rank drop after an update? The more you tell us, the sharper we can be.">{{ old('message') }}</textarea>
              </div>
            </div>

            <label class="consent">
              <input type="checkbox" id="consent" name="consent" value="1" required @checked(old('consent'))>
              <span class="consent-label">I agree to KodRank's <a href="{{ url('/') }}">Privacy Policy</a> and to receive project-related communications. No spam, no lists, no third parties — ever.</span>
            </label>

            <div class="form-status" id="form-status" role="alert" aria-live="polite"></div>

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
                <span class="btn-label">Get My Free Proposal</span>
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
          <span class="eyebrow">Not a new project?</span>
          <h2>Reach the right team, faster.</h2>
        </div>
        <p class="lede">If you're an existing client, a partner, or looking for something outside a project quote — these go to a real person on that team, not a shared inbox.</p>
      </div>

      <div class="offices-grid">
        <div class="office-card">
          <div class="office-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
          </div>
          <h3>New business</h3>
          <p>Quotes, discovery calls, and RFPs. You'll hear back from our strategy lead within one working day.</p>
          <div class="office-info">
            <a href="mailto:{{ $email }}">{{ $email }}</a>
            <span>Response: within 24 hours</span>
          </div>
        </div>
        <div class="office-card">
          <div class="office-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
          </div>
          <h3>Existing clients</h3>
          <p>Support tickets, campaign questions, reporting requests. Goes straight to your dedicated account lead.</p>
          <div class="office-info">
            <a href="mailto:{{ $email }}">{{ $email }}</a>
            <span>Response: same working day</span>
          </div>
        </div>
        <div class="office-card">
          <div class="office-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h3>Careers &amp; partners</h3>
          <p>Job openings, contractor rosters, tool integrations, and co-marketing. Talk to our ops lead directly.</p>
          <div class="office-info">
            <a href="mailto:{{ $email }}">{{ $email }}</a>
            <span>Response: within 3 working days</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="cp-faq">
    <div class="wrap faq-wrap">
      <div class="rv" style="text-align:center;margin-bottom:clamp(36px,4vw,52px)">
        <p class="eyebrow" style="justify-content:center">Before you send</p>
        <h2>Quick answers, so you don't have to ask.</h2>
      </div>

      @php
        $faqs = [
          ['q' => 'How fast will I actually hear back?', 'a' => 'Within 24 hours on any working day. If you send the form on a Friday evening, you\'ll hear back Monday morning at the latest. A real strategist reads every submission — not a bot, not an SDR pipeline.'],
          ['q' => 'What size projects do you usually take?', 'a' => 'Most engagements start at $2k/month for SEO retainers and $8k+ for site builds. If your budget is smaller, we\'ll be honest about it and often point you to a solid alternative. Being straight upfront saves everyone time.'],
          ['q' => 'Do I need to have a website already?', 'a' => 'Nope. Roughly a third of our projects are ground-up builds. If you have something existing, we\'ll audit it. If you don\'t, we\'ll design and build from scratch — with SEO wired in from the first line of code, not bolted on later.'],
          ['q' => 'Do you work with clients outside Pakistan?', 'a' => 'Yes — most of our clients are in the US, UK, UAE, and Australia. We work across time zones with overlap hours guaranteed, and every client has a dedicated account lead in their preferred time zone.'],
          ['q' => 'Am I signing a long contract?', 'a' => 'No 12-month lock-ins. SEO retainers are month-to-month after a 90-day initial period (needed to actually see results move). Web builds are milestone-based. If we\'re not delivering, you can walk — and you own everything we\'ve built.'],
          ['q' => 'What info should I have ready?', 'a' => 'Not much — just your site URL (if you have one) and a rough sense of what you\'re trying to fix or build. If you have GSC or GA4 data, even better, but it\'s not required. We\'ll ask for what we need.'],
        ];
      @endphp

      <div class="faq rv">
        @foreach($faqs as $i => $item)
          <details @if($i === 0) open @endif>
            <summary>{{ $item['q'] }}</summary>
            <div class="faq-a"><p>{{ $item['a'] }}</p></div>
          </details>
        @endforeach
      </div>
    </div>
  </section>
</main>
