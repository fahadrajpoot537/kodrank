@extends('layouts.admin')

@section('content')
<div class="admin-head">
  <div>
    <h1>Newsletter subscribers</h1>
    <p>Blog newsletter signups are saved here. Each new signup also creates a mail notification in the Laravel log while the mailer is set to <code>log</code>.</p>
  </div>
</div>

<form method="get" class="admin-card" style="margin-bottom:16px;display:flex;gap:12px;align-items:end;flex-wrap:wrap">
  <div class="field" style="min-width:260px;flex:1">
    <label for="q">Search email</label>
    <input id="q" name="q" value="{{ $q }}" placeholder="name@example.com">
  </div>
  <button type="submit" class="btn-admin">Search</button>
  @if($q !== '')<a href="{{ route('admin.newsletter.index') }}" class="btn-admin btn-admin-muted">Clear</a>@endif
</form>

<div class="admin-card">
  @if($subscribers->isEmpty())
    <p>No newsletter subscribers yet.</p>
  @else
    <div class="admin-table-wrap">
      <table class="admin-table">
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
          @foreach($subscribers as $subscriber)
            <tr>
              <td>{{ $subscriber->email }}</td>
              <td>{{ $subscriber->source }}</td>
              <td>{{ optional($subscriber->subscribed_at)->format('M j, Y H:i') }}</td>
              <td>{{ $subscriber->is_active ? 'Active' : 'Inactive' }}</td>
              <td style="white-space:nowrap">
                <form method="post" action="{{ route('admin.newsletter.toggle', $subscriber) }}" style="display:inline">
                  @csrf
                  <button type="submit" class="btn-admin btn-admin-muted">{{ $subscriber->is_active ? 'Deactivate' : 'Activate' }}</button>
                </form>
                <form method="post" action="{{ route('admin.newsletter.destroy', $subscriber) }}" style="display:inline" onsubmit="return confirm('Delete this subscriber?')">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn-admin btn-admin-danger">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="admin-pagination">{{ $subscribers->links() }}</div>
  @endif
</div>
@endsection
