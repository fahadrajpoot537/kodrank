@php
  $d = $s['contact'] ?? [];
  $fields = $d['fields'] ?? [];
  $defaultService = $d['default_service'] ?? '';
@endphp
<section class="sec-mist" id="contact">
  <div class="wrap ct-grid">
    <div class="ct-copy">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
      <ul class="ct-list">
        @foreach($d['points'] ?? [] as $point)
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>{{ is_array($point) ? ($point['text'] ?? '') : $point }}</li>
        @endforeach
      </ul>
    </div>
    <div class="ct-card">
      <form method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="on_page">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">
        @if(session('contact_success'))
          <p class="form-flash" role="status">{{ session('contact_success') }}</p>
        @endif
        <div class="fld">
          <label for="saas-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
          <input id="saas-name" name="name" type="text" value="{{ old('name') }}" placeholder="Jordan Lee" required>
          @error('name')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="fld">
          <label for="saas-email">{{ $fields['email_label'] ?? 'Work email' }}</label>
          <input id="saas-email" name="email" type="email" value="{{ old('email') }}" placeholder="jordan@yourcompany.com" required>
          @error('email')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="fld">
          <label for="saas-website">{{ $fields['website_label'] ?? 'Website / domain' }}</label>
          <input id="saas-website" name="website" type="text" value="{{ old('website') }}" placeholder="yourcompany.com">
        </div>
        @if(!empty($d['service_options']))
          <div class="fld">
            <label for="saas-service">{{ $fields['service_label'] ?? 'Current MRR range' }}</label>
            <select id="saas-service" name="service_name">
              @foreach($d['service_options'] as $opt)
                <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
              @endforeach
            </select>
          </div>
        @endif
        <div class="fld">
          <label for="saas-message">{{ $fields['message_label'] ?? 'Where are you stuck?' }}</label>
          <textarea id="saas-message" name="message" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $d['submit_text'] ?? 'Send my audit request' }} <span class="arw">→</span></button>
      </form>
    </div>
  </div>
</section>
