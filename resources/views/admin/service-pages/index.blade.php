@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Service pages</h1>
    <p class="admin-sub">A main service is a menu column. Sub-services are the links under it. A sub-service can have its own sub-services.</p>
  </div>
  <a class="btn" href="{{ route('admin.service-pages.create') }}">+ Main service</a>
</div>

<div class="admin-card" style="margin-bottom:14px">
  <div class="field" style="margin:0">
    <label for="svc-find">Find a service</label>
    <input id="svc-find" type="search" placeholder="Title, slug, or URL" autocomplete="off">
  </div>
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
        <th>SEO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($pages as $page)
        @include('admin.service-pages.partials.tree-row', ['page' => $page, 'depth' => 0])
      @empty
        <tr><td colspan="6">No services yet. Add a main service first.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
</div>
<script>
  (function () {
    var input = document.getElementById('svc-find');
    if (!input) return;
    input.addEventListener('input', function () {
      var q = input.value.trim().toLowerCase();
      document.querySelectorAll('tr[data-svc]').forEach(function (row) {
        var hay = row.getAttribute('data-svc') || '';
        row.style.display = q === '' || hay.indexOf(q) !== -1 ? '' : 'none';
      });
    });
  })();
</script>
@endsection
