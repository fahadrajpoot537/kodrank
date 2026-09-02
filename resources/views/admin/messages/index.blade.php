@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Contact messages</h1>
<p class="admin-sub">Leads submitted from the homepage contact form.</p>

<div class="admin-card">
  <div class="table-wrap">
  <table class="table">
    <thead>
      <tr><th>From</th><th>Email</th><th>Country</th><th>Received</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($messages as $message)
        <tr>
          <td>
            {{ $message->name }}
            @unless($message->is_read)<span class="badge">new</span>@endunless
          </td>
          <td>{{ $message->email }}</td>
          <td>{{ $message->country ?: '—' }}</td>
          <td>{{ $message->created_at->format('M j, Y g:ia') }}</td>
          <td><a class="btn btn-ghost" href="{{ route('admin.messages.show', $message) }}">Open</a></td>
        </tr>
      @empty
        <tr><td colspan="5">No messages yet.</td></tr>
      @endforelse
    </tbody>
  </table>
  </div>
  <div style="margin-top:16px">{{ $messages->links() }}</div>
</div>
@endsection
