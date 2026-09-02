@php
  $fieldId = $id ?? 'country';
  $fieldName = $name ?? 'country';
  $fieldLabel = $label ?? 'Country';
  $fieldValue = old($fieldName, $value ?? '');
  $variant = $variant ?? 'service';
  $required = $required ?? true;
  $countries = \App\Support\Countries::names();
  $wrapperClass = $variant === 'home'
    ? trim('kr-country kr-country--home '.($class ?? ''))
    : trim('form-field kr-country kr-country--service '.($class ?? ''));
@endphp
@once
  @push('head')
    <link rel="stylesheet" href="{{ asset('css/country-select.css') }}?v={{ @filemtime(public_path('css/country-select.css')) ?: time() }}">
  @endpush
  @push('scripts')
    <script src="{{ asset('js/country-select.js') }}?v={{ @filemtime(public_path('js/country-select.js')) ?: time() }}" defer></script>
  @endpush
@endonce
<div class="{{ $wrapperClass }}" data-kr-country data-countries='@json($countries)'>
  @if($variant === 'home')
    <div class="kr-country-wrap">
      <button type="button" class="kr-country-trigger" id="{{ $fieldId }}-trigger" aria-haspopup="listbox" aria-expanded="false" aria-labelledby="{{ $fieldId }}-label">
        <span class="kr-country-value" data-placeholder="{{ $fieldLabel }}">{{ $fieldValue !== '' ? $fieldValue : '' }}</span>
        <svg class="kr-country-chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5"/></svg>
      </button>
      <label id="{{ $fieldId }}-label" for="{{ $fieldId }}-search">{{ $fieldLabel }}</label>
      <input type="hidden" name="{{ $fieldName }}" value="{{ $fieldValue }}" @if($required) required @endif>
      <div class="kr-country-panel" hidden>
        <input type="search" class="kr-country-search" id="{{ $fieldId }}-search" placeholder="Search country…" autocomplete="off" aria-label="Search countries">
        <ul class="kr-country-list" role="listbox" aria-label="{{ $fieldLabel }}"></ul>
        <p class="kr-country-empty" hidden>No countries found</p>
      </div>
    </div>
  @else
    <label for="{{ $fieldId }}-trigger">{{ $fieldLabel }}</label>
    <div class="kr-country-wrap">
      <button type="button" class="kr-country-trigger" id="{{ $fieldId }}-trigger" aria-haspopup="listbox" aria-expanded="false">
        <span class="kr-country-value" data-placeholder="Select your country">{{ $fieldValue !== '' ? $fieldValue : '' }}</span>
        <svg class="kr-country-chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5"/></svg>
      </button>
      <input type="hidden" name="{{ $fieldName }}" value="{{ $fieldValue }}" @if($required) required @endif>
      <div class="kr-country-panel" hidden>
        <input type="search" class="kr-country-search" id="{{ $fieldId }}-search" placeholder="Search country…" autocomplete="off" aria-label="Search countries">
        <ul class="kr-country-list" role="listbox" aria-label="{{ $fieldLabel }}"></ul>
        <p class="kr-country-empty" hidden>No countries found</p>
      </div>
    </div>
  @endif
  @error($fieldName)<span class="field-err">{{ $message }}</span>@enderror
  <span class="field-err kr-country-err" hidden>Please select your country.</span>
</div>
