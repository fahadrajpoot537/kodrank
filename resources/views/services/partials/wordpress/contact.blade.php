@php
  $ct = $s['contact'] ?? [];
  $fields = $ct['fields'] ?? [];
  $defaultService = $ct['default_service'] ?? ($page->name ?? '');
  $arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>';
@endphp
<section id="contact" class="sec-mist">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-side">
        @if(!empty($ct['eyebrow']))<span class="eyebrow">{{ $ct['eyebrow'] }}</span>@endif
        <h2>{{ $ct['title'] ?? '' }}</h2>
        @if(!empty($ct['lede']))<p>{{ $ct['lede'] }}</p>@endif

        <div class="contact-meta">
          @foreach($ct['meta'] ?? [] as $meta)
            @php
              $label = $meta['label'] ?? '';
              $value = $meta['value'] ?? '';
              if ($label === 'Email' && $value === '') { $value = $c['site']['email'] ?? ''; }
              if ($label === 'Phone' && $value === '') { $value = $c['site']['phone'] ?? ''; }
              $href = null;
              if (strcasecmp($label, 'Email') === 0 && $value !== '') {
                  $href = 'mailto:'.$value;
              } elseif (strcasecmp($label, 'Phone') === 0 && $value !== '') {
                  $href = 'tel:'.preg_replace('/[^\d+]/', '', $value);
              }
            @endphp
            <div class="cm-item">
              <div class="cm-icon">@include('services.partials.wordpress.icon', ['key' => $meta['icon_key'] ?? 'email'])</div>
              <div>
                <div class="label">{{ $label }}</div>
                <div class="value">
                  @if($href)<a href="{{ $href }}">{{ $value }}</a>@else{{ $value }}@endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <form class="contact-card" method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="on_page">
        <input type="hidden" name="name" value="{{ old('name') }}">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">

        @if(session('contact_success'))
          <p class="contact-flash" role="status" style="margin:0 0 16px;color:var(--signal-deep);font-weight:600">{{ session('contact_success') }}</p>
        @endif

        <div class="form-row">
          <div class="form-field">
            <label for="wp-fn">{{ $fields['first_name_label'] ?? 'First Name' }}</label>
            <input type="text" id="wp-fn" name="firstName" value="{{ old('firstName') }}" required>
            @error('name')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="form-field">
            <label for="wp-ln">{{ $fields['last_name_label'] ?? 'Last Name' }}</label>
            <input type="text" id="wp-ln" name="lastName" value="{{ old('lastName') }}" required>
          </div>
          <div class="form-field">
            <label for="wp-em">{{ $fields['email_label'] ?? 'Work Email' }}</label>
            <input type="email" id="wp-em" name="email" value="{{ old('email') }}" required>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="form-field">
            <label for="wp-ph">{{ $fields['phone_label'] ?? 'Phone (Optional)' }}</label>
            <input type="tel" id="wp-ph" name="phone" value="{{ old('phone') }}">
          </div>
          <div class="form-field">
            <label for="wp-cw">{{ $fields['company_label'] ?? 'Current Website (If Any)' }}</label>
            <input type="text" id="wp-cw" name="company" value="{{ old('company') }}" placeholder="yoursite.com">
          </div>
          <div class="form-field">
            <label for="wp-sv">{{ $fields['service_label'] ?? "I'm Interested In" }}</label>
            <select id="wp-sv" name="service_name" required>
              <option value="">Select a service…</option>
              @foreach($ct['service_options'] ?? [] as $opt)
                <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-field full">
            <label for="wp-ms">{{ $fields['message_label'] ?? "What's going on with your site?" }}</label>
            <textarea id="wp-ms" name="message" rows="4" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
            @error('message')<span class="field-err">{{ $message }}</span>@enderror
          </div>
        </div>

        <button type="submit" class="btn btn-primary form-submit">
          {{ $ct['submit_text'] ?? 'Send & Get A Personal Reply' }} {!! $arrow !!}
        </button>
      </form>
    </div>
  </div>
</section>
