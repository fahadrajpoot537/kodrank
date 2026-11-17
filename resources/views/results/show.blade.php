@extends('layouts.site')

@push('head')
<link rel="stylesheet" href="{{ \App\Support\PublicCss::href('css/page-results.css') }}">
@endpush

@section('content')
@include('home.partials.nav')
@include('results.partials.body')
@include('home.partials.footer')
@endsection

@push('scripts')
<script src="{{ asset('js/page-results.js') }}" defer></script>
@endpush
