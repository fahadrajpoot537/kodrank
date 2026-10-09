@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Service pages</h1>
    <p class="admin-sub">A main service is a menu column. Sub-services are the links under it. A sub-service can have its own sub-services.</p>
  </div>
  <a class="btn" href="{{ route('admin.service-pages.create') }}">+ Main service</a>
</div>

<div class="admin-card">
  <div class="table-wrap">
  <table class="table">
    <thead>
      <tr>
        <th>Service</th>
        <th>Type</th>
        <th>Slug</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($pages as $page)
        @include('admin.service-pages.partials.tree-row', ['page' => $page, 'depth' => 0])
      @empty
        <tr><td colspan="5">No services yet. Add a main service first.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
