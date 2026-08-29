@php
  $ct = $s['contact'] ?? [];
  $fields = $ct['fields'] ?? [];
  $points = $ct['points'] ?? [];
  $defaultService = $ct['default_service'] ?? ($page->name ?? 'SaaS software development');
  $serviceOptions = $ct['service_options'] ?? [
      'SaaS MVP development',
      'Full-cycle SaaS build',
      'Migration / re-architecture',
      'Not sure yet — need advice',
  ];
@endphp
<section class="sec sec-mist" id="contact">
  <div class="wrap contact-grid">
    <div class="contact-copy rev">
      @if(!empty($ct['eyebrow']))<span class="eyebrow">{{ $ct['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($ct['title_html'])){!! $ct['title_html'] !!}
        @else{{ $ct['title'] ?? '' }}@endif
      </h2>
      @if(!empty($ct['lede']))<p class="lede">{{ $ct['lede'] }}</p>@endif
      @if(!empty($points))
        <ul class="contact-points">
          @foreach($points as $point)
            <li><span class="tick">✓</span> {{ is_array($point) ? ($point['text'] ?? '') : preg_replace('/^✓\s*/u', '', (string) $point) }}</li>
          @endforeach
        </ul>
      @endif
    </div>
    <form class="form-card rev" method="POST" action="{{ route('seo-services.inquiry.store') }}">
      @csrf
      <input type="hidden" name="page_type" value="{{ $ct['page_type'] ?? 'on_page' }}">
      <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">
      <input type="hidden" name="firstName" value="">
      <input type="hidden" name="lastName" value="">
      <input type="hidden" name="website" value="">
      <input type="hidden" name="service_name" value="{{ $defaultService }}">

      @if(session('contact_success'))
        <p class="form-note" role="status" style="color:var(--signal-deep);font-weight:600;margin-bottom:14px">{{ session('contact_success') }}</p>
      @endif

      <div class="field">
        <label for="saas-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
        <input id="saas-name" type="text" name="name" value="{{ old('name') }}" placeholder="Jane Cooper" required>
        @error('name')<span class="field-err">{{ $message }}</span>@enderror
      </div>
      <div class="field">
        <label for="saas-email">{{ $fields['email_label'] ?? 'Work email' }}</label>
        <input id="saas-email" type="email" name="email" value="{{ old('email') }}" placeholder="jane@company.com" required>
        @error('email')<span class="field-err">{{ $message }}</span>@enderror
      </div>
      <div class="field">
        <label for="saas-company">{{ $fields['company_label'] ?? 'Company' }}</label>
        <input id="saas-company" type="text" name="company" value="{{ old('company') }}" placeholder="Company name">
      </div>
      <div class="field">
        <label for="saas-msg">{{ $fields['message_label'] ?? 'What are you building?' }}</label>
        <textarea id="saas-msg" name="message" placeholder="{{ $fields['message_placeholder'] ?? 'A quick line on your product or the problem you\'re solving…' }}" required>{{ old('message') }}</textarea>
        @error('message')<span class="field-err">{{ $message }}</span>@enderror
      </div>
      @include('partials.recaptcha')
      <button class="btn btn-primary" type="submit">{{ $ct['submit_text'] ?? 'Get my project estimate' }} <span class="arrow">→</span></button>
      <p class="form-note">{{ $ct['disclaimer'] ?? "We'll never share your details. No spam, ever." }}</p>
    </form>
  </div>
</section>
