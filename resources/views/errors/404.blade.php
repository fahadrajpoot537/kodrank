@php
  $pageTitle = 'Page not found — KodRank';
  $pageDescription = 'The page you requested could not be found.';
  $navStuck = true;
@endphp
@extends('layouts.site')

@section('content')
@include('home.partials.nav')
<section class="sec-mist" style="padding-top:calc(84px + clamp(48px,8vw,96px));padding-bottom:clamp(64px,10vw,120px);min-height:50vh">
  <div class="wrap" style="max-width:720px;text-align:center">
    <p class="eyebrow">404</p>
    <h1 style="margin-top:12px">This page doesn&apos;t exist.</h1>
    <p class="lede" style="margin:18px auto 0;max-width:48ch">The link may be outdated or the URL was typed wrong. Head back home or browse our services.</p>
    <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:32px">
      <a class="btn btn-primary" href="{{ url('/') }}">Back to home</a>
      <a class="btn btn-ghost-dark" href="{{ url('/services') }}">View all services</a>
      <a class="btn btn-ghost-dark" href="{{ route('contact') }}">Contact us</a>
    </div>
  </div>
</section>
@include('home.partials.footer')
@endsection
