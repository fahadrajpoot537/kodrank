@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Message from {{ $message->name }}</h1>
<p class="admin-sub">{{ $message->created_at->format('M j, Y g:ia') }}</p>

<div class="admin-card">
  <p><strong>Email:</strong> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
  <p><strong>Phone:</strong> {{ $message->phone ?: '—' }}</p>
  <p><strong>Website:</strong> {{ $message->website ?: '—' }}</p>
  <p><strong>Message:</strong></p>
  <p style="white-space:pre-wrap">{{ $message->message }}</p>
  <div style="display:flex;gap:10px;margin-top:18px">
    <a class="btn btn-ghost" href="{{ route('admin.messages.index') }}">Back</a>
    <form method="post" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
      @csrf
      @method('DELETE')
      <button class="btn" type="submit" style="background:#b42318">Delete</button>
    </form>
  </div>
</div>
@endsection
