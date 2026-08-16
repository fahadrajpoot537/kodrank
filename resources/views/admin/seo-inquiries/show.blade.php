@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Inquiry from {{ $inquiry->name }}</h1>
<p class="admin-sub">{{ $inquiry->created_at->format('M j, Y g:ia') }} · {{ strtoupper(str_replace('_', '-', $inquiry->status)) }}</p>

<div class="admin-card">
  <p><strong>Page:</strong> {{ $inquiry->page_type === 'on_page' ? 'On-Page SEO' : 'Off-Page SEO' }}</p>
  <p><strong>Service:</strong> {{ $inquiry->service_name ?: '—' }}</p>
  <p><strong>Email:</strong> <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p>
  <p><strong>Phone:</strong> {{ $inquiry->phone ?: '—' }}</p>
  <p><strong>Company:</strong> {{ $inquiry->company ?: '—' }}</p>
  <p><strong>Website:</strong> {{ $inquiry->website ?: '—' }}</p>
  <p><strong>IP:</strong> {{ $inquiry->ip ?: '—' }}</p>
  <p><strong>Message:</strong></p>
  <p style="white-space:pre-wrap">{{ $inquiry->message }}</p>

  <div style="display:flex;gap:10px;margin-top:18px;flex-wrap:wrap">
    <a class="btn btn-ghost" href="{{ route('admin.seo-inquiries.index') }}">Back</a>

    <form method="post" action="{{ route('admin.seo-inquiries.mark-read', $inquiry) }}">
      @csrf
      <button class="btn btn-ghost" type="submit">Mark read</button>
    </form>

    <form method="post" action="{{ route('admin.seo-inquiries.mark-replied', $inquiry) }}">
      @csrf
      <button class="btn btn-ghost" type="submit">Mark replied</button>
    </form>

    <form method="post" action="{{ route('admin.seo-inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?')">
      @csrf
      @method('DELETE')
      <button class="btn" type="submit" style="background:#b42318">Delete</button>
    </form>
  </div>
</div>
@endsection
