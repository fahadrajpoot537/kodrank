@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Homepage content</h1>
    <p class="admin-sub">Home page ka har block yahan se edit karein — hero, services, FAQ, footer, SEO (site), nav, contact, etc.</p>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn btn-ghost" href="{{ route('home') }}" target="_blank" rel="noopener">Preview home ↗</a>
    <a class="btn" href="{{ route('admin.sections.create') }}">+ Add section</a>
  </div>
</div>

<div class="admin-card">
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
        @foreach($sections as $section)
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
