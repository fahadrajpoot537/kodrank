@extends('layouts.site')

@push('head')
<link rel="stylesheet" href="{{ \App\Support\PublicCss::href('css/contact-page.css') }}">
@endpush

@section('content')
@include('home.partials.nav')
@include('contact.partials.body')
@include('home.partials.footer')
@endsection

@push('scripts')
<script src="{{ asset('js/contact-page.js') }}" defer></script>
@endpush
