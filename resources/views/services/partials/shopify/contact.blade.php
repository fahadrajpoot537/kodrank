@php
  $d = $s['contact'] ?? [];
  $fields = $d['fields'] ?? [];
  $defaultService = $d['default_service'] ?? '';
@endphp
<section class="section sec-mist" id="contact">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-copy">
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h2>{{ $d['title'] ?? '' }}</h2>
        @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
        <div class="contact-list">
          @foreach($d['meta'] ?? [] as $meta)
            @php
              $label = $meta['label'] ?? '';
              $value = $meta['value'] ?? '';
              $labelLower = strtolower($label.' '.$value);
              if ($value === '' && str_contains($labelLower, 'email')) { $value = $c['site']['email'] ?? 'info@kodrank.com'; }
              if ($value === '' && (str_contains($labelLower, 'call') || str_contains($labelLower, 'phone'))) {
                  $value = $c['site']['phone'] ?? '+92 305 9202732';
              }
              $href = $meta['url'] ?? null;
              if (!$href && str_contains($labelLower, 'email') && str_contains($value, '@')) {
                  $href = 'mailto:'.$value;
              } elseif (!$href && (str_contains($labelLower, 'call') || str_contains($labelLower, 'phone')) && preg_match('/\d/', $value)) {
                  $href = 'tel:'.preg_replace('/[^\d+]/', '', $value);
              }
            @endphp
            <div class="ci">
              <span class="k">@include('services.partials.shopify.icon', ['key' => $meta['icon_key'] ?? 'email'])</span>
              <div>
                <b>@if($href)<a href="{{ $href }}">{{ $label !== '' ? $label : $value }}</a>@else{{ $label !== '' ? $label : $value }}@endif</b>
                <span>{{ $meta['hint'] ?? $value }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <form class="form-card" method="POST" action="{{ route('seo-services.inquiry.store') }}">
        @csrf
        <input type="hidden" name="page_type" value="on_page">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="redirect_to" value="{{ url()->current() }}#contact">

        @if(session('contact_success'))
          <p class="form-flash" role="status">{{ session('contact_success') }}</p>
        @endif

        <div class="two">
          <div class="field">
            <label for="shop-name">{{ $fields['name_label'] ?? 'Your name' }}</label>
            <input id="shop-name" name="name" type="text" value="{{ old('name') }}" placeholder="Jordan Lee" autocomplete="name" required>
            @error('name')<span class="field-err">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <label for="shop-email">{{ $fields['email_label'] ?? 'Work email' }}</label>
            <input id="shop-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@brand.com" autocomplete="email" required>
            @error('email')<span class="field-err">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="two">
          <div class="field">
            <label for="shop-website">{{ $fields['website_label'] ?? 'Store URL' }}</label>
            <input id="shop-website" name="website" type="text" value="{{ old('website') }}" placeholder="yourstore.com">
          </div>
          @if(!empty($d['service_options']))
            <div class="field">
              <label for="shop-service">{{ $fields['service_label'] ?? 'What you need' }}</label>
              <select id="shop-service" name="service_name">
                @foreach($d['service_options'] as $opt)
                  <option value="{{ $opt }}" @selected(old('service_name', $defaultService) === $opt)>{{ $opt }}</option>
                @endforeach
              </select>
            </div>
          @endif
        </div>
        <div class="field">
          <label for="shop-message">{{ $fields['message_label'] ?? "Where's it stuck?" }}</label>
          <textarea id="shop-message" name="message" rows="3" placeholder="{{ $fields['message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        @include('partials.recaptcha')
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">{{ $d['submit_text'] ?? 'Send my teardown request' }}
          <svg class="arw" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
        </button>
        @if(!empty($d['disclaimer']))
          <p class="form-note">{{ $d['disclaimer'] }}</p>
        @endif
      </form>
    </div>
  </div>
</section>
