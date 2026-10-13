@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Newsletter subscribers</h1>
<p class="admin-sub">Emails entered on the blog subscribe forms are listed here. A new signup gets a confirmation from the site mailbox, and each newly published article is emailed to active subscribers.</p>

<form method="get" class="admin-card" style="display:grid;gap:12px;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));align-items:end">
  <div class="field" style="margin:0">
    <label for="q">Search email</label>
    <input id="q" name="q" value="{{ $q }}" placeholder="name@example.com">
  </div>
  <div class="row-actions">
    <button type="submit" class="btn">Search</button>
    @if($q !== '')<a href="{{ route('admin.newsletter.index') }}" class="btn btn-ghost">Clear</a>@endif
  </div>
</form>

<div class="admin-card">
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>Email</th>
          <th>Source</th>
          <th>Subscribed</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($subscribers as $subscriber)
          <tr>
            <td>{{ $subscriber->email }}</td>
            <td>{{ $subscriber->source ?: '—' }}</td>
            <td>{{ optional($subscriber->subscribed_at)->format('M j, Y g:ia') ?: '—' }}</td>
            <td>
              @if($subscriber->is_active)
                <span class="badge badge-ok">Active</span>
              @else
                <span class="badge badge-muted">Inactive</span>
              @endif
            </td>
            <td>
              <div class="row-actions">
                <form method="post" action="{{ route('admin.newsletter.toggle', $subscriber) }}">
                  @csrf
                  <button type="submit" class="btn btn-ghost btn-xs">{{ $subscriber->is_active ? 'Deactivate' : 'Activate' }}</button>
                </form>
                <form method="post" action="{{ route('admin.newsletter.destroy', $subscriber) }}" onsubmit="return confirm('Delete this subscriber?')">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn-link-danger">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No newsletter subscribers yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($subscribers->hasPages())
    <div style="margin-top:16px">{{ $subscribers->links() }}</div>
  @endif
</div>
@endsection
