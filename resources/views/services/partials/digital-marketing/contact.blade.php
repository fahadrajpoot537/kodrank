@php
  $ct = $s['contact'] ?? [];
  $fields = $ct['fields'] ?? [];
@endphp
<section id="contact" class="sec-mist">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-side">
        <span class="eyebrow">{{ $ct['eyebrow'] ?? 'Get In Touch' }}</span>
        <h2>{{ $ct['title'] ?? '' }}</h2>
        <p>{{ $ct['lede'] ?? '' }}</p>

        <div class="contact-meta">
          @foreach($ct['meta'] ?? [] as $meta)
            @php
              $label = $meta['label'] ?? '';
              $value = $meta['value'] ?? '';
              if ($label === 'Email' && empty($value)) { $value = $c['site']['email'] ?? ''; }
              if ($label === 'Phone' && empty($value)) { $value = $c['site']['phone'] ?? ''; }
              $href = null;
              if (strcasecmp($label, 'Email') === 0 && $value !== '') {
                  $href = 'mailto:'.$value;
              } elseif (strcasecmp($label, 'Phone') === 0 && $value !== '') {
                  $href = 'tel:'.preg_replace('/[^\d+]/', '', $value);
              }
            @endphp
            <div class="cm-item">
              <div class="cm-icon">
                @include('services.partials.digital-marketing.icon', ['key' => $meta['icon_key'] ?? 'email'])
              </div>
              <div>
                <div class="label">{{ $label }}</div>
                <div class="value">
                  @if($href)
                    <a href="{{ $href }}">{{ $value }}</a>
                  @else
                    {{ $value }}
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <form class="contact-card" id="svcContactForm" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <input type="hidden" name="name" value="{{ old('name') }}">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">

        @if(session('contact_success'))
          <p class="contact-flash" role="status" style="margin:0 0 16px;color:var(--signal-deep);font-weight:600">{{ session('contact_success') }}</p>
        @endif

        <div class="form-row">
          <div class="form-field">
            <label for="fn">{{ $fields['first_name_label'] ?? 'First Name' }}</label>
            <input type="text" id="fn" name="firstName" value="{{ old('firstName') }}" required>
            @error('name')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="form-field">
            <label for="ln">{{ $fields['last_name_label'] ?? 'Last Name' }}</label>
            <input type="text" id="ln" name="lastName" value="{{ old('lastName') }}" required>
          </div>
          <div class="form-field">
            <label for="em">{{ $fields['email_label'] ?? 'Work Email' }}</label>
            <input type="email" id="em" name="email" value="{{ old('email') }}" required>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="form-field">
            <label for="ph">{{ $fields['phone_label'] ?? 'Phone (Optional)' }}</label>
            <input type="tel" id="ph" name="phone" value="{{ old('phone') }}">
          </div>
          <div class="form-field">
            <label for="co">{{ $fields['company_label'] ?? 'Company' }}</label>
            <input type="text" id="co" name="company" value="{{ old('company') }}">
          </div>
          <div class="form-field">
            <label for="sv">{{ $fields['service_label'] ?? "I'm Interested In" }}</label>
            <select id="sv" name="service" required>
              <option value="">Select a service…</option>
              @foreach($ct['service_options'] ?? [] as $opt)
                <option value="{{ $opt }}" @selected(old('service') === $opt)>{{ $opt }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-field full">
            <label for="ms">{{ $fields['message_label'] ?? "What's the main goal?" }}</label>
            <textarea id="ms" name="message" placeholder="{{ $fields['message_placeholder'] ?? '' }}" rows="4" required>{{ old('message') }}</textarea>
            @error('message')<span class="field-err">{{ $message }}</span>@enderror
          </div>
        </div>
        <button type="submit" class="btn btn-primary form-submit">
          {{ $ct['submit_text'] ?? 'Send & Get A Personal Reply' }}
          @include('services.partials.digital-marketing.icon', ['key' => 'arrow', 'fillNone' => true, 'attrs' => 'stroke="currentColor" stroke-width="2.2"'])
        </button>
      </form>
    </div>
  </div>
</section>
