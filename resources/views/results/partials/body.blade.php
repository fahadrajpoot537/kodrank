@php
  $media = function (?string $path): string {
      $path = trim((string) $path);
      if ($path === '') {
          return '';
      }
      if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
          return $path;
      }

      return asset(ltrim($path, '/'));
  };
  $check = '<svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>';
@endphp

<section class="res-hero" id="top">
  @if(($p['watermark'] ?? '') !== '')
    <span class="res-hero-wm" aria-hidden="true">{{ $p['watermark'] }}</span>
  @endif
  <div class="wrap res-hero-grid">
    <div>
      <div class="crumb reveal">
        <a class="c-home" href="{{ url('/') }}">{{ $p['crumb_home'] ?? 'Home' }}</a>
        <span class="c-arrow">⟶</span>
        <span class="c-here">{{ $p['crumb_here'] ?? 'Results' }}</span>
      </div>
      <h1 class="reveal d1">{!! $p['hero_title_html'] ?? '' !!}</h1>
      @if(($p['hero_lede'] ?? '') !== '')
        <p class="lede reveal d2">{{ $p['hero_lede'] }}</p>
      @endif
      @if(!empty($p['hero_feats']))
        <ul class="res-hero-feats reveal d2">
          @foreach($p['hero_feats'] as $feat)
            @php $label = is_array($feat) ? ($feat['label'] ?? '') : $feat; @endphp
            @if($label !== '')
              <li><span class="fd"></span>{{ $label }}</li>
            @endif
          @endforeach
        </ul>
      @endif
    </div>

    <div class="res-hero-form reveal d1" id="book">
      <h2>{!! $p['form_title_html'] ?? 'Book a Free<span class="hl">Consultation</span>' !!}</h2>
      @if(($p['form_lede'] ?? '') !== '')
        <p class="fsub">{{ $p['form_lede'] }}</p>
      @endif

      @if(session('contact_success'))
        <p class="contact-flash" role="status">{{ session('contact_success') }}</p>
      @endif

      <form method="POST" action="{{ route('contact.store') }}" novalidate>
        @csrf
        <input type="hidden" name="redirect_to" value="{{ url('/results#book') }}">
        <div class="res-hp" aria-hidden="true">
          <label for="res-fax">Fax</label>
          <input id="res-fax" type="text" name="fax_number" value="" tabindex="-1" autocomplete="off">
        </div>
        <div class="fld">
          <label for="res-name">{{ $p['form_name_label'] ?? 'Full Name' }}</label>
          <input class="uline" id="res-name" name="name" type="text" autocomplete="name" placeholder="{{ $p['form_name_placeholder'] ?? '' }}" value="{{ old('name') }}" required>
          @error('name')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="fld">
          <label for="res-email">{{ $p['form_email_label'] ?? 'Email' }}</label>
          <input class="uline" id="res-email" name="email" type="email" autocomplete="email" placeholder="{{ $p['form_email_placeholder'] ?? '' }}" value="{{ old('email') }}" required>
          @error('email')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="fld">
          <label for="res-phone">{{ $p['form_phone_label'] ?? 'Number' }}</label>
          <input class="uline" id="res-phone" name="phone" type="tel" autocomplete="tel" placeholder="{{ $p['form_phone_placeholder'] ?? '' }}" value="{{ old('phone') }}">
          @error('phone')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <div class="fld">
          <label for="res-msg">{{ $p['form_message_label'] ?? 'Describe Your Project Need' }}</label>
          <textarea class="uline" id="res-msg" name="message" rows="2" placeholder="{{ $p['form_message_placeholder'] ?? '' }}" required>{{ old('message') }}</textarea>
          @error('message')<span class="field-err">{{ $message }}</span>@enderror
        </div>
        <p class="fprivacy">{!! $p['form_consent_html'] ?? '' !!}</p>
        @include('partials.recaptcha')
        @error('g-recaptcha-response')
          @unless(config('services.recaptcha.site_key'))
            <p class="field-err">{{ $message }}</p>
          @endunless
        @enderror
        <button class="btn btn-primary" type="submit">{{ $p['form_submit'] ?? 'Get In Touch' }} <span class="arw">→</span></button>
      </form>
    </div>
  </div>
</section>

@if(!empty($p['stats']))
<section class="statband">
  <div class="wrap">
    <div class="statgrid">
      @foreach($p['stats'] as $i => $st)
        <div class="st reveal @if($i === 1) d1 @elseif($i === 2) d2 @elseif($i >= 3) d3 @endif">
          @if(($st['html'] ?? '') !== '')
            <div class="num"><span class="u">{!! $st['html'] !!}</span></div>
          @else
            <div class="num" data-count="{{ $st['count'] ?? '0' }}" data-suffix="{{ $st['suffix'] ?? '' }}">0</div>
          @endif
          <div class="lbl">{{ $st['label'] ?? '' }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<section class="pad-y" id="results">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow reveal">{{ $p['seo_eyebrow'] ?? '' }}</span>
      <h2 class="reveal d1">{!! $p['seo_title_html'] ?? '' !!}</h2>
      @if(($p['seo_lede'] ?? '') !== '')
        <p class="reveal d2">{{ $p['seo_lede'] }}</p>
      @endif
    </div>
    @foreach($p['seo_cases'] ?? [] as $case)
      @include('results.partials.showcase', ['case' => $case, 'eager' => $loop->first, 'media' => $media, 'check' => $check])
    @endforeach
  </div>
</section>

<section class="sec-mist pad-y" id="projects">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow reveal">{{ $p['projects_eyebrow'] ?? '' }}</span>
      <h2 class="reveal d1">{!! $p['projects_title_html'] ?? '' !!}</h2>
      @if(($p['projects_lede'] ?? '') !== '')
        <p class="reveal d2">{{ $p['projects_lede'] }}</p>
      @endif
    </div>
    @foreach($p['project_cases'] ?? [] as $case)
      @include('results.partials.showcase', ['case' => $case, 'eager' => false, 'media' => $media, 'check' => $check])
    @endforeach
  </div>
</section>

<section class="pad-y" id="process">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow reveal">{{ $p['process_eyebrow'] ?? '' }}</span>
      <h2 class="reveal d1">{!! $p['process_title_html'] ?? '' !!}</h2>
      @if(($p['process_lede'] ?? '') !== '')
        <p class="reveal d2">{{ $p['process_lede'] }}</p>
      @endif
    </div>
    <div class="proc">
      @foreach($p['process_steps'] ?? [] as $i => $step)
        <div class="pnum reveal @if($i === 1) d1 @elseif($i >= 2) d2 @endif">
          <div class="n">{{ $step['n'] ?? '' }}</div>
          <h4>{{ $step['title'] ?? '' }}</h4>
          <p>{!! $step['body_html'] ?? '' !!}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="sec-mist pad-y" id="clients">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow reveal">{{ $p['clients_eyebrow'] ?? '' }}</span>
      <h2 class="reveal d1">{!! $p['clients_title_html'] ?? '' !!}</h2>
      @if(($p['clients_lede'] ?? '') !== '')
        <p class="reveal d2">{{ $p['clients_lede'] }}</p>
      @endif
    </div>
    <div class="clients-grid">
      @foreach($p['clients'] ?? [] as $i => $client)
        @php $src = $media($client['image'] ?? ''); @endphp
        @if($src !== '')
          <div class="ctile reveal @if($i === 1) d1 @elseif($i === 2) d2 @elseif($i >= 3) d3 @endif">
            <img src="{{ $src }}" alt="{{ $client['alt'] ?? '' }}" loading="lazy">
          </div>
        @endif
      @endforeach
    </div>
  </div>
</section>
