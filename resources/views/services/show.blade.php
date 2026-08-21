@extends('layouts.service')

@section('content')
@php
  $theme = ($seo['theme'] ?? null)
    ?: (($page->slug ?? '') === 'web-design-and-development-services' ? 'web-development' : 'digital-marketing');
  $partialBase = 'services.partials.'.$theme.'.';
@endphp
@foreach($page->sections as $section)
  @continue($section->key === 'cta')
  @includeIf($partialBase.$section->key)
@endforeach
@endsection
