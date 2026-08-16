@extends('admin.layout')

@section('content')
<h1 class="admin-h1">SEO service inquiries</h1>
<p class="admin-sub">Leads from On-Page and Off-Page SEO service pages.</p>

<form method="get" class="admin-card" style="margin-bottom:16px;display:grid;gap:12px;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));align-items:end">
  <div class="field" style="margin:0">
    <label>Search</label>
    <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Name, email, company…">
  </div>
  <div class="field" style="margin:0">
    <label>Page</label>
    <select name="page_type">
      <option value="">All</option>
      <option value="on_page" @selected($filters['page_type'] === 'on_page')>On-Page</option>
      <option value="off_page" @selected($filters['page_type'] === 'off_page')>Off-Page</option>
    </select>
  </div>
  <div class="field" style="margin:0">
    <label>Status</label>
    <select name="status">
      <option value="">All</option>
      <option value="new" @selected($filters['status'] === 'new')>New</option>
      <option value="read" @selected($filters['status'] === 'read')>Read</option>
      <option value="replied" @selected($filters['status'] === 'replied')>Replied</option>
    </select>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <button class="btn" type="submit">Filter</button>
    <a class="btn btn-ghost" href="{{ route('admin.seo-inquiries.export', request()->query()) }}">Export CSV</a>
  </div>
</form>

<div class="admin-card">
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>From</th>
          <th>Page</th>
          <th>Service</th>
          <th>Status</th>
          <th>Received</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($inquiries as $inquiry)
          <tr>
            <td>
              {{ $inquiry->name }}
              @if($inquiry->status === 'new')<span class="badge">new</span>@endif
              <div style="font-size:.85rem;opacity:.75">{{ $inquiry->email }}</div>
            </td>
            <td>{{ $inquiry->page_type === 'on_page' ? 'On-Page' : 'Off-Page' }}</td>
            <td>{{ $inquiry->service_name ?: '—' }}</td>
            <td>{{ $inquiry->status }}</td>
            <td>{{ $inquiry->created_at->format('M j, Y g:ia') }}</td>
            <td><a class="btn btn-ghost" href="{{ route('admin.seo-inquiries.show', $inquiry) }}">Open</a></td>
          </tr>
        @empty
          <tr><td colspan="6">No inquiries yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="margin-top:16px">{{ $inquiries->links() }}</div>
</div>
@endsection
