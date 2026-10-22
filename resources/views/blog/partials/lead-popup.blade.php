@push('head')
<link rel="stylesheet" href="{{ asset('css/blog-lead-popup.css') }}?v={{ @filemtime(public_path('css/blog-lead-popup.css')) ?: time() }}">
@endpush
<div class="krp-overlay" id="krp" aria-hidden="true">
  <div class="krp-modal" role="dialog" aria-modal="true" aria-labelledby="krp-title">

    <button class="krp-close" type="button" aria-label="Close" data-krp-close>
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
    </button>
    <div class="krp-handle" id="krp-handle" aria-hidden="true"></div>

    <div class="krp-scroll" id="krp-scroll">
    <!-- LEFT -->
    <aside class="krp-side">
      <div>
        <p class="krp-eyebrow">— Sound familiar?</p>
        <h3>Your website should be your best salesperson. <em>Right now it’s on leave.</em></h3>
      </div>

      <ul class="krp-pains">
        <li><span class="krp-x"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></span>
          <div><strong>Invisible on Google</strong><span>Competitors take the clicks you should get.</span></div></li>
        <li><span class="krp-x"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></span>
          <div><strong>Slow website</strong><span>Mobile visitors leave before it loads.</span></div></li>
        <li><span class="krp-x"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></span>
          <div><strong>Traffic, no leads</strong><span>People read and leave without calling.</span></div></li>
        <li><span class="krp-x"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></span>
          <div><strong>Wasted agency fees</strong><span>Past agencies sent reports, not customers.</span></div></li>
      </ul>

      <div class="krp-fixlabel">How we fix it</div>

      <div class="krp-services">
        <div class="krp-svc">
          <div class="krp-svc-head">
            <span class="krp-svc-icon"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 18 10 12 14 15 20 6"/><path d="M15 6h5v5"/></svg></span>
            <h4>SEO Services</h4>
          </div>
          <div class="krp-metric"><div><span class="from">#<span data-count-from="27">27</span></span></div><span class="arrow">→</span><div><span class="to">#<span id="krp-rank">27</span></span><small>Target position</small></div></div>
          <ul>
            <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg>Keyword &amp; competitor research</li>
            <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg>Technical &amp; on-page SEO</li>
            <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg>Local SEO &amp; backlinks</li>
          </ul>
        </div>
        <div class="krp-svc">
          <div class="krp-svc-head">
            <span class="krp-svc-icon"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m8 8-4 4 4 4M16 8l4 4-4 4M13.5 5l-3 14"/></svg></span>
            <h4>Web &amp; Software Dev</h4>
          </div>
          <div class="krp-metric"><div><span class="from">6.8s</span></div><span class="arrow">→</span><div><span class="to"><span id="krp-speed">6.8</span>s</span><small>Target load time</small></div></div>
          <ul>
            <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg>Fast, mobile-first websites</li>
            <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg>Custom software &amp; web apps</li>
            <li><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg>SEO-ready from day one</li>
          </ul>
        </div>
      </div>
    </aside>

    <!-- RIGHT -->
    <div class="krp-main" id="krp-main">
      <div class="krp-form-wrap">
        <span class="krp-offer"><i><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg></i>Free consultation + website audit</span>
        <p class="krp-eyebrow">— Get more customers online</p>
        <h2 id="krp-title">More rankings. More traffic. <em>More customers.</em></h2>
        <p class="krp-lede">Tell us what you need. We’ll send a <strong>free audit and a custom plan</strong> within 24 hours. No obligation.</p>

        <form id="krp-form" novalidate>
          <p class="krp-q" id="krp-q">What do you need help with? <small>Pick one or more</small></p>
          <p class="krp-chip-err">Pick at least one service to continue.</p>
          <div class="krp-chips" id="krp-chips" role="group" aria-labelledby="krp-q">
            <button type="button" class="krp-chip" aria-pressed="false" data-value="SEO">
              <span class="krp-tick"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg></span>
              <span class="krp-tile"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></span>
              <span>SEO <span class="krp-lg">services</span></span>
            </button>
            <button type="button" class="krp-chip" aria-pressed="false" data-value="Website Development">
              <span class="krp-tick"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg></span>
              <span class="krp-tile"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 9h18M8 21h8"/></svg></span>
              <span>Website <span class="krp-lg">development</span></span>
            </button>
            <button type="button" class="krp-chip" aria-pressed="false" data-value="Software Development">
              <span class="krp-tick"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg></span>
              <span class="krp-tile"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m8 8-4 4 4 4M16 8l4 4-4 4M13.5 5l-3 14"/></svg></span>
              <span>Software <span class="krp-lg">development</span></span>
            </button>
          </div>
          <input type="hidden" name="service" id="krp-service">

          <div class="krp-fields">
            <div class="krp-field">
              <label for="krp-name">Name</label>
              <input id="krp-name" name="name" type="text" autocomplete="name" placeholder="Your name" required>
              <p class="krp-err">Enter your name</p>
            </div>
            <div class="krp-field">
              <label for="krp-phone">Phone / WhatsApp</label>
              <input id="krp-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" placeholder="+92 300 1234567" required>
              <p class="krp-err">Enter a valid number</p>
            </div>
            <div class="krp-field full">
              <label for="krp-email">Email</label>
              <input id="krp-email" name="email" type="email" autocomplete="email" placeholder="you@company.com" required>
              <p class="krp-err">Enter a valid email, like you@company.com</p>
            </div>
            <div class="krp-field full">
              <label for="krp-msg">Message <small>(optional)</small></label>
              <textarea id="krp-msg" name="message" rows="1" maxlength="400" placeholder="e.g. I need an online store"></textarea>
            </div>
            <div class="krp-hp" aria-hidden="true"><label>Leave empty<input name="company_fax" tabindex="-1" autocomplete="off"></label></div>
          </div>

          <button type="submit" class="krp-btn krp-btn-primary" id="krp-submit">
            Get my free plan
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </button>
          <p class="krp-form-err" id="krp-form-err" role="alert">Your request didn’t go through. Check your connection and send it again.</p>

          <div class="krp-trust">
            <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>Your details stay private</span>
            <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>Reply within 24 hours</span>
          </div>
        </form>
      </div>

      <div class="krp-done" aria-live="polite">
        <div class="krp-done-badge"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5 10 17 19 7"/></svg></div>
        <h2>Request received. <em>We’re on it.</em></h2>
        <p class="krp-lede" id="krp-done-lede">Here’s what happens next.</p>
        <ol class="krp-next">
          <li><b>01</b><div><strong>We review your business</strong><span>Your site, your competitors and your search market.</span></div></li>
          <li><b>02</b><div><strong>You get a free plan</strong><span>Audit plus clear next steps, within 24 hours.</span></div></li>
          <li><b>03</b><div><strong>Quick call, if you want one</strong><span>Ask questions. No pressure to sign.</span></div></li>
        </ol>
        <button type="button" class="krp-btn krp-btn-ink" data-krp-close>
          Back to the article
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </div>

      <div class="krp-skip"><button type="button" data-krp-close>No thanks, continue reading</button></div>
    </div>
    </div><!-- /.krp-scroll -->
  </div>
</div>

<button class="krp-teaser" id="krp-teaser" type="button" aria-label="Open free consultation offer">
  <i><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><path d="M4 18 10 12 14 15 20 6"/></svg></i>
  Free SEO &amp; website plan
</button>
@push('scripts')
<script>
window.KRP_CONFIG = {
  endpoint: @json(route('blog.lead.store')),
  csrf: @json(csrf_token())
};
</script>
<script src="{{ asset('js/blog-lead-popup.js') }}?v={{ @filemtime(public_path('js/blog-lead-popup.js')) ?: time() }}"></script>
@endpush
