@extends('admin.layout')

@section('content')
<h1 class="admin-h1">{{ $page->name }} — {{ $section->label }}</h1>
<p class="admin-sub">Edit this part of the page, then save.</p>
<p><a class="btn btn-ghost" href="{{ route('admin.service-pages.content', $page) }}">All content</a></p>

@include('admin.service-pages.partials.section-form', ['allowDelete' => true])
@endsection
