@php
  $d = $s['contact'] ?? [];
  $fields = $d['fields'] ?? [];
  $defaultService = $d['default_service'] ?? '';
@endphp
<section class="sec-mist" id="contact">
  <div class="wrap contact-grid">
    <div class="contact-info">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2 class="h">{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
      @foreach($d['meta'] ?? [] as $meta)
        @php
          $label = $meta['label'] ?? '';
          $value = $meta['value'] ?? '';
          $labelLower = strtolower($label);
          if ($value === '' && str_contains($labelLower, 'email')) { $value = $c['site']['email'] ?? ''; }
          if ($value === '' && (str_contains($labelLower, 'call') || str_contains($labelLower, 'phone'))) {
              $value = $c['site']['phone'] ?? '';
          }
          $href = null;
          if (str_contains($value, '@')) {
              $href = 'mailto:'.$value;
          } elseif ((str_contains($labelLower, 'call') || str_contains($labelLower, 'phone')) && preg_match('/\d/', $value)) {
              $href = 'tel:'.preg_replace('/[^\d+]/', '', $value);
          }
        @endphp
        <div class="ci-item">
          <div class="ic" aria-hidden="true">{{ $meta['icon'] ?? '◎' }}</div>
          <div>
            <strong>@if($href)<a href="{{ $href }}">{{ $value }}</a>@else{{ $value }}@endif</strong>
            <span>{{ $meta['note'] ?? $label }}</span>
          </div>
        </div>
      @endforeach
    </div>
    <div class="form-card">
      <form method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="on_page">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">

        @if(session('contact_success'))
          <p class="form-flash" role="status">{{ session('contact_success') }}</p>
        @endif

        <div class="form-row">
          <div class="field">
            <label for="rd-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
            <input id="rd-name" name="name" type="text" value="{{ old('name') }}" placeholder="Jane Doe" autocomplete="name" required>
            @error('name')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <label for="rd-email">{{ $fields['email_label'] ?? 'Email' }}</label>
            <input id="rd-email" name="email" type="email" value="{{ old('email') }}" placeholder="jane@company.com" autocomplete="email" required>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="form-row">
          <div class="field">
            <label for="rd-site">{{ $fields['website_label'] ?? 'Current website' }}</label>
            <input id="rd-site" name="website" type="text" value="{{ old('website') }}" placeholder="yourcompany.com">
          </div>
          <div class="field">
            <label for="rd-service">{{ $fields['service_label'] ?? 'What do you need?' }}</label>
            <select id="rd-service" name="service_name">
              @foreach($d['service_options'] ?? [] as $opt)
                <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="field">
          <label for="rd-msg">{{ $fields['message_label'] ?? 'What’s wrong with your current site?' }}</label>
          <textarea id="rd-msg" name="message" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        @include('partials.recaptcha')
        <button type="submit" class="btn btn-primary">{{ $d['submit_text'] ?? 'Get my free audit' }} <span class="ar">→</span></button>
      </form>
    </div>
  </div>
</section>
