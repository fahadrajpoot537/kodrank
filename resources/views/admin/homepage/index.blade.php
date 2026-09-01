@extends('admin.layout')

@section('content')
@php
  $siteKeys = ['site', 'nav', 'footer', 'contact_page', 'services_index', 'blog_authors', 'results_page'];
  $siteSections = $sections->filter(fn ($s) => in_array($s->key, $siteKeys, true))->values();
  $homeSections = $sections->reject(fn ($s) => in_array($s->key, $siteKeys, true))->values();
@endphp
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Site &amp; page content</h1>
    <p class="admin-sub">Har page ka copy, images, nav, logo, contact, services listing, results, aur homepage blocks yahan se add / update / delete karein. Service URLs aur blog slugs Services / Blog screens se change hote hain (purani URL 301 redirect ho jati hai).</p>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn btn-ghost" href="{{ route('home') }}" target="_blank" rel="noopener">Preview home ↗</a>
    <a class="btn btn-ghost" href="{{ route('results') }}" target="_blank" rel="noopener">Preview /results ↗</a>
    <a class="btn" href="{{ route('admin.sections.create') }}">+ Add section</a>
  </div>
</div>

<div class="admin-card">
  <h3 style="margin:0 0 12px">Site-wide &amp; standalone pages</h3>
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>Page</th>
          <th>Key</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($siteSections as $section)
          <tr>
            <td><strong>{{ $section->label }}</strong></td>
            <td><code>{{ $section->key }}</code></td>
            <td><a class="btn" href="{{ route('admin.sections.edit', $section->key) }}">Edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="admin-card">
  <h3 style="margin:0 0 12px">Homepage blocks</h3>
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Section</th>
          <th>Key</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($homeSections as $section)
          <tr>
            <td>{{ $section->sort_order }}</td>
            <td><strong>{{ $section->label }}</strong></td>
            <td><code>{{ $section->key }}</code></td>
            <td><a class="btn" href="{{ route('admin.sections.edit', $section->key) }}">Edit</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
