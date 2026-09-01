@extends('layouts.site')

@push('head')
<link rel="stylesheet" href="{{ asset('css/page-results.css') }}?v={{ @filemtime(public_path('css/page-results.css')) ?: time() }}">
@endpush

@section('content')
@include('home.partials.nav')
@include('results.partials.body')
@include('home.partials.footer')
@endsection

@push('scripts')
<script src="{{ asset('js/page-results.js') }}" defer></script>
@endpush
