@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Blog categories</h1>
<p class="admin-sub">Organize posts into SEO, Web Development, AEO &amp; GEO, etc.</p>

<div class="admin-card" style="margin-bottom:24px">
  <h2 style="font-size:1.05rem;margin-bottom:12px">Add category</h2>
  <form method="post" action="{{ route('admin.blog.categories.store') }}">
    @csrf
    <div class="field">
      <label>Name</label>
      <input type="text" name="name" required>
    </div>
    <div class="field">
      <label>Slug (optional)</label>
      <input type="text" name="slug" placeholder="Auto from name">
    </div>
    <div class="field">
      <label>Sort order</label>
      <input type="number" name="sort_order" value="0" min="0">
    </div>
    <button class="btn" type="submit">Add category</button>
  </form>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr><th>Name</th><th>Slug</th><th>Posts</th><th>Sort</th><th></th></tr>
      </thead>
      <tbody>
        @forelse($categories as $category)
          <tr>
            <td colspan="5">
              <form method="post" action="{{ route('admin.blog.categories.update', $category) }}" style="display:grid;grid-template-columns:1.4fr 1fr .6fr .6fr auto;gap:10px;align-items:end">
                @csrf
                @method('PUT')
                <div class="field" style="margin:0">
                  <label>Name</label>
                  <input type="text" name="name" value="{{ $category->name }}" required>
                </div>
                <div class="field" style="margin:0">
                  <label>Slug</label>
                  <input type="text" name="slug" value="{{ $category->slug }}" required>
                </div>
                <div class="field" style="margin:0">
                  <label>Posts</label>
                  <input type="text" value="{{ $category->posts_count }}" disabled>
                </div>
                <div class="field" style="margin:0">
                  <label>Sort</label>
                  <input type="number" name="sort_order" value="{{ $category->sort_order }}" min="0">
                </div>
                <div style="display:flex;gap:8px">
                  <button class="btn" type="submit">Save</button>
                </div>
              </form>
              <form method="post" action="{{ route('admin.blog.categories.destroy', $category) }}" onsubmit="return confirm('Delete category?')" style="margin-top:8px">
                @csrf
                @method('DELETE')
                <button class="btn btn-ghost" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No categories yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
