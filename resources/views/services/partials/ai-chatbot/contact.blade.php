@php
  $ct = $s['contact'] ?? [];
  $fields = $ct['fields'] ?? [];
  $defaultService = $ct['default_service'] ?? '';
@endphp
<section class="sec-mist" id="contact">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-info">
        @if(!empty($ct['eyebrow']))<span class="eyebrow">{{ $ct['eyebrow'] }}</span>@endif
        <h2>{{ $ct['title'] ?? '' }}</h2>
        @if(!empty($ct['lede']))<p>{{ $ct['lede'] }}</p>@endif
        <div class="ci-list">
          @foreach($ct['meta'] ?? [] as $meta)
            @php
              $label = $meta['label'] ?? '';
              $value = $meta['value'] ?? '';
              $labelLower = strtolower($label);
              if ($value === '' && str_contains($labelLower, 'email')) { $value = $c['site']['email'] ?? ''; }
              if ($value === '' && (str_contains($labelLower, 'call') || str_contains($labelLower, 'phone'))) {
                  $value = $c['site']['phone'] ?? '';
              }
              $href = null;
              if (str_contains($labelLower, 'email') && $value !== '' && str_contains($value, '@')) {
                  $href = 'mailto:'.$value;
              } elseif ((str_contains($labelLower, 'call') || str_contains($labelLower, 'phone')) && preg_match('/\d/', $value)) {
                  $href = 'tel:'.preg_replace('/[^\d+]/', '', $value);
              }
            @endphp
            <div class="ci">
              <span class="ci-ic">@include('services.partials.ai-chatbot.icon', ['key' => $meta['icon_key'] ?? 'mail'])</span>
              <div>
                <b>{{ $label }}</b>
                <span>@if($href)<a href="{{ $href }}">{{ $value }}</a>@else{{ $value }}@endif</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <form class="form" method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="on_page">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">

        @if(session('contact_success'))
          <p class="form-flash" role="status">{{ session('contact_success') }}</p>
        @endif

        <div class="row">
          <div class="fld">
            <label for="ac-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
            <input id="ac-name" name="name" type="text" value="{{ old('name') }}" placeholder="{{ $fields['name_placeholder'] ?? '' }}" required>
            @error('name')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="fld">
            <label for="ac-email">{{ $fields['email_label'] ?? 'Work email' }}</label>
            <input id="ac-email" name="email" type="email" value="{{ old('email') }}" placeholder="{{ $fields['email_placeholder'] ?? '' }}" required>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="row">
          <div class="fld">
            <label for="ac-company">{{ $fields['company_label'] ?? 'Company' }}</label>
            <input id="ac-company" name="company" type="text" value="{{ old('company') }}" placeholder="{{ $fields['company_placeholder'] ?? '' }}">
          </div>
          <div class="fld">
            <label for="ac-type">{{ $fields['service_label'] ?? 'Chatbot type' }}</label>
            <select id="ac-type" name="service_name">
              @foreach($ct['service_options'] ?? [] as $opt)
                <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="fld">
          <label for="ac-msg">{{ $fields['message_label'] ?? 'What should your chatbot do?' }}</label>
          <textarea id="ac-msg" name="message" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <button class="btn btn-primary" type="submit">{{ $ct['submit_text'] ?? 'Get My Free Quote' }} <span class="arw">→</span></button>
        @if(!empty($ct['disclaimer']))<small>{{ $ct['disclaimer'] }}</small>@endif
      </form>
    </div>
  </div>
</section>
