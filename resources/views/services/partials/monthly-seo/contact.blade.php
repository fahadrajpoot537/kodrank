@php
  $d = $s['contact'] ?? [];
  $fields = $d['fields'] ?? [];
  $defaultService = $d['default_service'] ?? '';
@endphp
<section class="sec-mist" id="contact">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-copy">
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
        @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
        <ul class="contact-points">
          @foreach($d['points'] ?? [] as $point)
            <li>
              <span class="chk"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              {{ is_array($point) ? ($point['text'] ?? '') : $point }}
            </li>
          @endforeach
        </ul>
      </div>

      <div class="form-card">
        <form method="POST" action="{{ route('seo-services.inquiry.store') }}">
          @csrf
          <input type="hidden" name="page_type" value="on_page">
          <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">
          <h3>{{ $d['form_title'] ?? 'Request your plan' }}</h3>
          @if(!empty($d['form_sub']))<p class="sub">{{ $d['form_sub'] }}</p>@endif
          @if(session('contact_success'))
            <p class="form-flash" role="status">{{ session('contact_success') }}</p>
          @endif
          <div class="field">
            <input id="mo-name" name="name" type="text" value="{{ old('name') }}" placeholder=" " autocomplete="name" required>
            <label for="mo-name">{{ $fields['name_label'] ?? 'Full name' }}</label>
            @error('name')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <input id="mo-email" name="email" type="email" value="{{ old('email') }}" placeholder=" " autocomplete="email" required>
            <label for="mo-email">{{ $fields['email_label'] ?? 'Work email' }}</label>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <input id="mo-site" name="website" type="text" value="{{ old('website') }}" placeholder=" " required>
            <label for="mo-site">{{ $fields['website_label'] ?? 'Website URL' }}</label>
          </div>
          @if(!empty($d['service_options']))
            <div class="field">
              <select id="mo-service" name="service_name" required>
                <option value="" disabled @selected(old('service_name', $defaultService) === '')></option>
                @foreach($d['service_options'] as $opt)
                  <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
                @endforeach
              </select>
              <label for="mo-service">{{ $fields['service_label'] ?? 'Primary goal' }}</label>
            </div>
          @endif
          <div class="field">
            <textarea id="mo-message" name="message" placeholder=" " required>{{ old('message') }}</textarea>
            <label for="mo-message">{{ $fields['message_label'] ?? 'Anything else we should know?' }}</label>
            @error('message')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <button type="submit" class="btn btn-primary">{{ $d['submit_text'] ?? 'Send Me My Free Plan' }} <span class="arw">→</span></button>
        </form>
      </div>
    </div>
  </div>
</section>
