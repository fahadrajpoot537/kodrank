@extends('admin.layout')

@section('content')
<div class="admin-head-row" style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap">
  <div>
    <h1 class="admin-h1">Blog posts</h1>
    <p class="admin-sub">Manage KodRank blog articles.</p>
  </div>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <a class="btn btn-ghost" href="{{ route('admin.blog.categories.index') }}">Categories</a>
    <a class="btn btn-ghost" href="{{ route('admin.blog.settings.edit') }}">Page settings</a>
    <a class="btn" href="{{ route('admin.blog.posts.create') }}">+ New post</a>
  </div>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Flags</th>
          <th>Published</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($posts as $post)
          <tr>
            <td>
              <strong>{{ $post->title }}</strong>
              <div style="font-size:.8rem;opacity:.7">/blogs/{{ $post->slug }}</div>
            </td>
            <td>{{ $post->category?->name ?? '—' }}</td>
            <td style="font-size:.8rem">
              @if($post->is_featured) featured @endif
              @if($post->is_editors_pick) editors @endif
              @if($post->show_in_latest) latest @endif
              @unless($post->is_published) <span class="badge">draft</span> @endunless
            </td>
            <td>{{ $post->published_at?->format('M j, Y') ?? '—' }}</td>
            <td style="white-space:nowrap">
              <a class="btn btn-ghost" href="{{ route('admin.blog.posts.edit', $post) }}">Edit</a>
              <form method="post" action="{{ route('admin.blog.posts.destroy', $post) }}" style="display:inline" onsubmit="return confirm('Delete this post?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-ghost" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No posts yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="margin-top:16px">{{ $posts->links() }}</div>
</div>
@endsection
