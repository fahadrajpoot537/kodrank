@php
  $ct = $s['contact'] ?? [];
  $fields = $ct['fields'] ?? [];
  $points = $ct['points'] ?? [];
  $defaultService = $ct['default_service'] ?? ($page->name ?? 'New electrician website design');
  $serviceOptions = $ct['service_options'] ?? [
      'New electrician website design',
      'Redesign my existing website',
      'Local SEO & Google ranking',
      'Not sure yet — need advice',
  ];
  $arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
  $check = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
@endphp
<section class="paper" id="contact">
  <div class="wrap contact-grid">
    <div class="contact-copy rv">
      @if(!empty($ct['eyebrow']))<span class="eyebrow">{{ $ct['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($ct['title_html'])){!! $ct['title_html'] !!}
        @else{{ $ct['title'] ?? '' }}@endif
      </h2>
      @if(!empty($ct['lede']))<p class="lede">{{ $ct['lede'] }}</p>@endif
      @if(!empty($points))
        <ul class="contact-points">
          @foreach($points as $point)
            <li><span class="ic">{!! $check !!}</span> {{ is_array($point) ? ($point['text'] ?? '') : preg_replace('/^✓\s*/u', '', (string) $point) }}</li>
          @endforeach
        </ul>
      @endif
    </div>
    <div class="form-card rv">
      <h3>{{ $ct['subtitle'] ?? 'Get Your Free Website Audit' }}</h3>
      <p class="sub">{{ $ct['form_sub'] ?? "We'll reply within one business day." }}</p>
      <form method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="{{ $ct['page_type'] ?? 'on_page' }}">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">
        <input type="hidden" name="firstName" value="">
        <input type="hidden" name="lastName" value="">
        <input type="hidden" name="website" value="">

        @if(session('contact_success'))
          <p class="form-note" role="status" style="color:var(--signal-deep);font-weight:600;margin-bottom:14px">{{ session('contact_success') }}</p>
        @endif

        <div class="field">
          <label for="elec-name">{{ $fields['name_label'] ?? 'Name' }}</label>
          <input id="elec-name" type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
          @error('name')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
          <label for="elec-phone">{{ $fields['phone_label'] ?? 'Phone' }}</label>
          <input id="elec-phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="Best number to reach you">
        </div>
        <div class="field">
          <label for="elec-email">{{ $fields['email_label'] ?? 'Email' }}</label>
          <input id="elec-email" type="email" name="email" value="{{ old('email') }}" placeholder="you@company.com" required>
          @error('email')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
          <label for="elec-service">{{ $fields['service_label'] ?? 'What do you need?' }}</label>
          <select id="elec-service" name="service_name" required>
            @foreach($serviceOptions as $opt)
              <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
        <div class="field">
          <label for="elec-msg">{{ $fields['message_label'] ?? 'Service area / details' }}</label>
          <textarea id="elec-msg" name="message" placeholder="{{ $fields['message_placeholder'] ?? 'City you serve and anything we should know' }}" required>{{ old('message') }}</textarea>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        @include('partials.recaptcha')
        <button type="submit" class="btn btn-primary">{{ $ct['submit_text'] ?? 'Send My Free Audit' }} {!! $arrow !!}</button>
        <p class="form-note">{{ $ct['disclaimer'] ?? 'No spam. No obligation. Just a clear plan.' }}</p>
      </form>
    </div>
  </div>
</section>
