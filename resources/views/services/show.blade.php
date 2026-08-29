@extends('layouts.service')

@section('content')
@php
  $theme = ($seo['theme'] ?? null)
    ?: (($page->slug ?? '') === 'web-design-and-development-services' ? 'web-development' : 'digital-marketing');
@endphp
@if($theme === 'theme-html')
  {{-- KodRank shared hero + site nav/footer; theme HTML is body-only --}}
  @include('services.partials.shared.dm.hero', ['h' => $s['hero'] ?? []])
  @include('services.partials.theme-html.body')
@else
  @php
    $partialBase = 'services.partials.'.$theme.'.';
    $bodyWrap = match ($theme) {
        'electrician' => 'elec-page',
        'saas-development' => 'saas-dev-page',
        'restaurant-seo' => 'rest-page',
        'real-estate-seo' => 're-page',
        'healthcare-seo' => 'hc-page',
        'guest-posting' => 'gp-page',
        default => null,
    };
  @endphp
  @if($bodyWrap)
  <div class="{{ $bodyWrap }}">
  @endif
  @php
    $webdevRefWrap = \App\Support\WpRefDesign::appliesTo($page->slug ?? '');
    $useSharedHero = ($page->slug ?? '') === 'web-design-and-development-services';
  @endphp
  @foreach($page->sections as $section)
    @continue($section->key !== 'hero')
    @if($useSharedHero)
      @include('services.partials.shared.dm.hero', ['h' => $s['hero'] ?? []])
    @else
      @includeIf($partialBase.$section->key)
    @endif
  @endforeach
  @if($webdevRefWrap)
  <div class="webdev-ref">
  @endif
  @foreach($page->sections as $section)
    @continue($section->key === 'hero' || $section->key === 'cta')
    @includeIf($partialBase.$section->key)
  @endforeach
  @if($webdevRefWrap)
  </div>
  @endif
  @if($bodyWrap)
  </div>
  @endif
@endif
@endsection
