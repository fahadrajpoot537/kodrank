@php
  $phone = $c['site']['phone'] ?? '';
  $email = $c['site']['email'] ?? '';
  $telHref = $phone !== '' ? 'tel:' . preg_replace('/[^\d+]/', '', $phone) : '#';
  $proofBadges = [
    '<path d="m12 3 2.5 5 5.5.8-4 3.9.9 5.5L12 21l-4.9 2.6.9-5.5-4-3.9L10.5 8 12 3Z" stroke="#CD661A" stroke-width="1.4" fill="rgba(244,122,31,.12)"/>',
    '<path d="M20 7 9.5 17.5 4 12" stroke="#CD661A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
    '<path d="M4 18V9M9.3 18V5M14.7 18v-6M20 18v-9" stroke="#CD661A" stroke-width="1.7" stroke-linecap="round"/>',
  ];
@endphp
<section class="sec-mist" id="contact">
  <div class="wrap connect-in">
    <div class="connect-left rv">
      <span class="connect-watermark" aria-hidden="true">Connect</span>
      <p class="eyebrow">{{ $c['contact']['eyebrow'] ?? '' }}</p>
      <h2>{{ $c['contact']['title'] ?? '' }}</h2>
      <p class="lede">{{ $c['contact']['lede'] ?? '' }}</p>

      @if(!empty($c['contact']['sub_title']))
        <h3 class="connect-sub">{{ $c['contact']['sub_title'] }}</h3>
      @endif
      @if(!empty($c['contact']['sub_body']))
        <p class="connect-para">{{ $c['contact']['sub_body'] }}</p>
      @endif

      @if(!empty($c['contact']['proof']))
        <div class="proof">
          @foreach($c['contact']['proof'] as $pi => $proof)
            <div class="proof-item">
              <span class="proof-badge"><svg viewBox="0 0 24 24" fill="none">{!! $proofBadges[$pi % count($proofBadges)] !!}</svg></span>
              <div><b>{{ $proof['value'] ?? '' }}</b><span>{{ $proof['label'] ?? '' }}</span></div>
            </div>
          @endforeach
        </div>
      @endif

      @if($email || $phone)
        <h3 class="connect-sub">Contact Info:</h3>
        <ul class="connect-contact">
          @if($email)
            <li>
              <span class="ci-ic"><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#CD661A" stroke-width="1.6"/><path d="m4 7 8 6 8-6" stroke="#CD661A" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              <a href="mailto:{{ $email }}">{{ $email }}</a>
            </li>
          @endif
          @if($phone)
            <li>
              <span class="ci-ic"><svg viewBox="0 0 24 24" fill="none"><path d="M5 4h3l2 5-2.5 1.5a11 11 0 0 0 5 5L14 12l5 2v3a2 2 0 0 1-2.2 2A16 16 0 0 1 3 6.2 2 2 0 0 1 5 4Z" stroke="#CD661A" stroke-width="1.6" stroke-linejoin="round"/></svg></span>
              <a href="{{ $telHref }}">{{ $phone }}</a>
            </li>
          @endif
        </ul>
      @endif
    </div>

    <div class="connect-card rv">
      <h3 class="connect-card-title">{{ $c['contact']['form_title'] ?? 'Get in Touch Now!' }}</h3>

      @if(session('contact_success'))
        <p class="contact-flash" role="status">{{ session('contact_success') }}</p>
      @endif

      <form class="connect-form" method="POST" action="{{ route('contact.store') }}" novalidate>
        @csrf
        <input type="hidden" name="redirect_to" value="{{ url('/#contact') }}">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <div class="uf">
          <input id="c-name" name="name" type="text" autocomplete="name" placeholder=" " value="{{ old('name') }}" required>
          <label for="c-name">Full Name</label>
          @error('name')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="uf">
          <input id="c-email" name="email" type="email" autocomplete="email" placeholder=" " value="{{ old('email') }}" required>
          <label for="c-email">Email</label>
          @error('email')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="uf">
          <input id="c-phone" name="phone" type="tel" autocomplete="tel" placeholder=" " value="{{ old('phone') }}">
          <label for="c-phone">Number</label>
          @error('phone')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="uf">
          <input id="c-site" name="website" type="text" placeholder=" " value="{{ old('website') }}">
          <label for="c-site">Your Website (optional)</label>
          @error('website')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="uf">
          <textarea id="c-msg" name="message" rows="3" placeholder=" " required>{{ old('message') }}</textarea>
          <label for="c-msg">Describe Your Project Need.</label>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        @if(!empty($c['contact']['consent_html']))
          <p class="connect-consent">{!! $c['contact']['consent_html'] !!}</p>
        @elseif(!empty($c['contact']['consent_text']))
          <p class="connect-consent">{{ $c['contact']['consent_text'] }} <a href="#top">Privacy Policy</a>.</p>
        @else
          <p class="connect-consent">By submitting this form, you agree to our <a href="#top">Privacy Policy</a>.</p>
        @endif
        @include('partials.recaptcha')
        <button class="btn btn-connect" type="submit">{{ $c['contact']['submit_text'] ?? 'Get In Touch' }}
          <svg viewBox="0 0 16 16" fill="none"><path d="M2 8h11m0 0-4.2-4.2M13 8l-4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </form>
    </div>
  </div>
</section>
