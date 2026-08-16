@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Dashboard</h1>
<p class="admin-sub">Home, main services, aur sub-services ka saara content yahan se edit karein.</p>

<div class="grid2" style="margin-bottom:18px">
  <div class="admin-card">
    <h3 style="margin:0 0 8px">Homepage</h3>
    <p style="margin:0 0 14px;color:#4B5B62">Hero, nav, services, FAQ, footer, contact — har block editable.</p>
    <a class="btn" href="{{ route('admin.homepage.index') }}">Edit homepage content</a>
  </div>
  <div class="admin-card">
    <h3 style="margin:0 0 8px">Services &amp; sub-services</h3>
    <p style="margin:0 0 14px;color:#4B5B62">Digital Marketing, On-Page SEO, Off-Page SEO, Web Design — har page / har section.</p>
    <a class="btn" href="{{ route('admin.service-pages.index') }}">Manage service pages</a>
  </div>
</div>

<div class="admin-card">
  <h3 style="margin:0 0 14px">Quick stats</h3>
  <div class="grid2">
    <div><strong>{{ $sections->count() }}</strong><div style="color:#4B5B62">Homepage sections</div></div>
    <div><strong>{{ $unread }}</strong><div style="color:#4B5B62">Unread messages</div></div>
    <div><strong>{{ $unreadInquiries ?? 0 }}</strong><div style="color:#4B5B62">New SEO inquiries</div></div>
  </div>
  <p style="margin:16px 0 0;display:flex;gap:10px;flex-wrap:wrap">
    <a class="btn btn-ghost" href="{{ route('admin.service-pages.create') }}">+ New service page</a>
    <a class="btn btn-ghost" href="{{ route('admin.cache.clear') }}">Clear cache</a>
  </p>
</div>

<div class="admin-card">
  <div class="admin-page-head" style="margin-bottom:14px">
    <h3 style="margin:0">Homepage sections</h3>
    <a class="btn btn-ghost" href="{{ route('admin.homepage.index') }}">View all</a>
  </div>
  <div class="table-wrap">
  <table class="table">
    <thead><tr><th>Section</th><th>Key</th><th></th></tr></thead>
    <tbody>
      @foreach($sections->take(8) as $section)
        <tr>
          <td>{{ $section->label }}</td>
          <td><code>{{ $section->key }}</code></td>
          <td><a class="btn btn-ghost" href="{{ route('admin.sections.edit', $section->key) }}">Edit</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

<div class="admin-card">
  <h3 style="margin:0 0 14px">Recent messages</h3>
  @forelse($messages as $message)
    <div style="padding:10px 0;border-bottom:1px solid #E1E9E5">
      <a href="{{ route('admin.messages.show', $message) }}"><strong>{{ $message->name }}</strong></a>
      <span style="color:#4B5B62"> · {{ $message->email }} · {{ $message->created_at->diffForHumans() }}</span>
      @unless($message->is_read)<span class="badge">new</span>@endunless
    </div>
  @empty
    <p style="color:#4B5B62;margin:0">No messages yet.</p>
  @endforelse
</div>

<div class="admin-card">
  <div class="admin-page-head" style="margin-bottom:14px">
    <h3 style="margin:0">Recent SEO inquiries</h3>
    <a class="btn btn-ghost" href="{{ route('admin.seo-inquiries.index') }}">View all</a>
  </div>
  @forelse($inquiries ?? [] as $inquiry)
    <div style="padding:10px 0;border-bottom:1px solid #E1E9E5">
      <a href="{{ route('admin.seo-inquiries.show', $inquiry) }}"><strong>{{ $inquiry->name }}</strong></a>
      <span style="color:#4B5B62"> · {{ $inquiry->email }} · {{ $inquiry->created_at->diffForHumans() }}</span>
      @if($inquiry->status === \App\Models\SeoServiceInquiry::STATUS_NEW)<span class="badge">new</span>@endif
    </div>
  @empty
    <p style="color:#4B5B62;margin:0">No SEO inquiries yet.</p>
  @endforelse
</div>
@endsection
