@extends('layouts.site')

@push('head')
<link rel="stylesheet" href="{{ asset('css/contact-page.css') }}?v={{ @filemtime(public_path('css/contact-page.css')) ?: time() }}">
@endpush

@section('content')
@include('home.partials.nav')
@include('contact.partials.body')
@include('home.partials.footer')
@endsection

@push('scripts')
<script src="{{ asset('js/contact-page.js') }}" defer></script>
@endpush
