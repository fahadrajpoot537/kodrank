@php
  $ct = $ct ?? [];
  $fields = $ct['fields'] ?? [];
  $defaultService = $ct['default_service'] ?? ($page->name ?? '');
  $simple = $simple ?? (!empty($fields['name_label']) || empty($fields['first_name_label']));
  $points = $ct['points'] ?? [];
  $meta = $ct['meta'] ?? [];
@endphp
<section id="contact" class="sec-mist">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-side">
        <span class="eyebrow">{{ $ct['eyebrow'] ?? 'Get In Touch' }}</span>
        <h2>
          @if(!empty($ct['title_html'])){!! $ct['title_html'] !!}@else{{ $ct['title'] ?? '' }}@endif
        </h2>
        @if(!empty($ct['lede']))<p>{{ $ct['lede'] }}</p>@endif

        @if(!empty($points))
          <ul class="compare-list" style="margin-top:22px">
            @foreach($points as $point)
              <li><span class="mark v">✓</span> {{ is_array($point) ? ($point['text'] ?? '') : $point }}</li>
            @endforeach
          </ul>
        @endif

        @if(!empty($meta))
          <div class="contact-meta">
            @foreach($meta as $m)
              @php
                $metaLabel = $m['label'] ?? '';
                $metaValue = $m['value'] ?? '';
                if (stripos($metaLabel, 'email') !== false && $metaValue === '') { $metaValue = $c['site']['email'] ?? ''; }
                if ((stripos($metaLabel, 'phone') !== false || stripos($metaLabel, 'call') !== false) && $metaValue === '') { $metaValue = $c['site']['phone'] ?? ''; }
                $metaHref = null;
                if (stripos($metaLabel, 'email') !== false && $metaValue !== '') { $metaHref = 'mailto:'.$metaValue; }
                elseif ((stripos($metaLabel, 'phone') !== false || stripos($metaLabel, 'call') !== false) && $metaValue !== '') { $metaHref = 'tel:'.preg_replace('/[^\d+]/', '', $metaValue); }
              @endphp
              <div class="cm-item">
                <div class="cm-icon">@include('services.partials.digital-marketing.icon', ['key' => $m['icon_key'] ?? 'email'])</div>
                <div>
                  <div class="label">{{ $metaLabel }}</div>
                  <div class="value">@if($metaHref)<a href="{{ $metaHref }}">{{ $metaValue }}</a>@else{{ $metaValue }}@endif</div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>

      <form class="contact-card" method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="{{ $ct['page_type'] ?? 'on_page' }}">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">
        @if(empty($ct['service_options']) && $defaultService !== '')
          <input type="hidden" name="service_name" value="{{ $defaultService }}">
        @endif
        @if($simple)
          <input type="hidden" name="firstName" value="">
          <input type="hidden" name="lastName" value="">
        @endif

        @if(session('contact_success'))
          <p class="contact-flash" role="status" style="margin:0 0 16px;color:var(--signal-deep);font-weight:600">{{ session('contact_success') }}</p>
        @endif

        <div class="form-row">
          @if($simple)
            <div class="form-field full">
              <label for="dm-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
              <input type="text" id="dm-name" name="name" value="{{ old('name') }}" required>
              @error('name')<span class="field-err">{{ $message }}</span>@enderror
            </div>
          @else
            <div class="form-field">
              <label for="fn">{{ $fields['first_name_label'] ?? 'First Name' }}</label>
              <input type="text" id="fn" name="firstName" value="{{ old('firstName') }}" required>
              @error('name')<span class="field-err">{{ $message }}</span>@enderror
            </div>
            <div class="form-field">
              <label for="ln">{{ $fields['last_name_label'] ?? 'Last Name' }}</label>
              <input type="text" id="ln" name="lastName" value="{{ old('lastName') }}" required>
            </div>
          @endif
          <div class="form-field">
            <label for="em">{{ $fields['email_label'] ?? 'Work Email' }}</label>
            <input type="email" id="em" name="email" value="{{ old('email') }}" required>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          @if(!empty($fields['phone_label']) || !$simple)
            <div class="form-field">
              <label for="ph">{{ $fields['phone_label'] ?? 'Phone (Optional)' }}</label>
              <input type="tel" id="ph" name="phone" value="{{ old('phone') }}" @if(!empty($fields['phone_required']) || !empty($ct['phone_required'])) required @endif>
              @error('phone')<span class="field-err">{{ $message }}</span>@enderror
            </div>
          @endif
          @if(!empty($fields['company_label']))
            <div class="form-field">
              <label for="co">{{ $fields['company_label'] }}</label>
              <input type="text" id="co" name="company" value="{{ old('company') }}">
            </div>
          @endif
          @include('partials.country-field', ['id' => ($page->slug ?? 'service').'-country', 'label' => $fields['country_label'] ?? 'Country'])
          <div class="form-field">
            <label for="web">{{ $fields['website_label'] ?? 'Website URL' }}</label>
            <input type="text" id="web" name="website" value="{{ old('website') }}" placeholder="https://">
          </div>
          @if(!empty($ct['service_options']))
            <div class="form-field">
              <label for="sv">{{ $fields['service_label'] ?? "I'm Interested In" }}</label>
              <select id="sv" name="service_name" required>
                <option value="">Select…</option>
                @foreach($ct['service_options'] as $opt)
                  <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
                @endforeach
              </select>
            </div>
          @endif
          <div class="form-field full">
            <label for="ms">{{ $fields['message_label'] ?? "What's the main goal?" }}</label>
            <textarea id="ms" name="message" rows="4" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
            @error('message')<span class="field-err">{{ $message }}</span>@enderror
          </div>
        </div>
        @include('partials.recaptcha')
        <button type="submit" class="btn btn-primary form-submit">
          {{ $ct['submit_text'] ?? 'Send & Get A Personal Reply' }}
          <span class="arw">→</span>
        </button>
      </form>
    </div>
  </div>
</section>
