@php
  $d = $s['contact'] ?? [];
  $fields = $d['fields'] ?? [];
  $defaultService = $d['default_service'] ?? '';
@endphp
<section class="section sec-mist" id="contact">
  <div class="wrap contact-grid">
    <div class="contact-copy">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
      <div class="clist">
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
            if (str_contains($labelLower, 'email') && str_contains($value, '@')) {
                $href = 'mailto:'.$value;
            } elseif ((str_contains($labelLower, 'call') || str_contains($labelLower, 'phone')) && preg_match('/\d/', $value)) {
                $href = 'tel:'.preg_replace('/[^\d+]/', '', $value);
            }
          @endphp
          <div class="cl">
            <span class="ci">@include('services.partials.cms.icon', ['key' => $meta['icon_key'] ?? 'email'])</span>
            <div>
              <b>{{ $label }}</b>
              <span>@if($href)<a href="{{ $href }}">{{ $value }}</a>@else{{ $value }}@endif</span>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <form class="cform" method="POST" action="{{ route('seo-services.inquiry.store') }}">
      @csrf
      <input type="hidden" name="page_type" value="on_page">
      <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">

      @if(session('contact_success'))
        <p class="form-flash" role="status">{{ session('contact_success') }}</p>
      @endif

      <div class="form-row">
        <div class="field">
          <label for="cms-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
          <input id="cms-name" name="name" type="text" value="{{ old('name') }}" placeholder="Jane Doe" autocomplete="name" required>
          @error('name')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
          <label for="cms-email">{{ $fields['email_label'] ?? 'Work email' }}</label>
          <input id="cms-email" name="email" type="email" value="{{ old('email') }}" placeholder="jane@company.com" autocomplete="email" required>
          @error('email')<span class="field-err">{{ $message }}</span>@enderror
        </div>
      </div>
      <div class="form-row">
        <div class="field">
          <label for="cms-company">{{ $fields['company_label'] ?? 'Company' }}</label>
          <input id="cms-company" name="company" type="text" value="{{ old('company') }}" placeholder="Company name">
        </div>
        <div class="field">
          <label for="cms-website">{{ $fields['website_label'] ?? 'Website URL' }}</label>
          <input id="cms-website" name="website" type="text" value="{{ old('website') }}" placeholder="company.com">
        </div>
      </div>
      @if(!empty($d['service_options']))
        <div class="field">
          <label for="cms-service">{{ $fields['service_label'] ?? 'What do you need?' }}</label>
          <select id="cms-service" name="service_name">
            @foreach($d['service_options'] as $opt)
              <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
            @endforeach
          </select>
        </div>
      @endif
      <div class="field">
        <label for="cms-message">{{ $fields['message_label'] ?? 'What do you need help with?' }}</label>
        <textarea id="cms-message" name="message" rows="3" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
        @error('message')<span class="field-err">{{ $message }}</span>@enderror
      </div>
      <button class="btn btn-primary" type="submit" style="width:100%;justify-content:center">{{ $d['submit_text'] ?? 'Send my request' }}
        <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
    </form>
  </div>
</section>
