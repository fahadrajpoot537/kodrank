@php
  $size = $size ?? 'normal';
  $siteKey = config('services.recaptcha.site_key');
@endphp
@if($siteKey)
  <div class="kr-recaptcha">
    <div class="g-recaptcha" data-sitekey="{{ $siteKey }}" data-theme="light" data-size="{{ $size }}"></div>
    @error('g-recaptcha-response')
      <p class="field-err kr-recaptcha-err">{{ $message }}</p>
    @enderror
  </div>
@endif
