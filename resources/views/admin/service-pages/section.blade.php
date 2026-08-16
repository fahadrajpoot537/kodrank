@extends('admin.layout')

@section('content')
<h1 class="admin-h1">{{ $page->name }} — {{ $section->label }}</h1>
<p class="admin-sub">Update this section. Use “Add item” for lists (cards, FAQs, steps, etc.).</p>

<div class="admin-card">
  <form method="post" action="{{ route('admin.service-pages.sections.update', [$page, $section->key]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid2">
      <div class="field">
        <label>Label</label>
        <input type="text" name="label" value="{{ old('label', $section->label) }}">
      </div>
      <div class="field">
        <label>Sort order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" min="0" max="999">
      </div>
    </div>

    <p class="admin-hint" style="margin-top:0">Text, cards, FAQs, team members — sab edit / add / remove. Image fields pe path likho ya naya file upload karo.</p>

    @include('admin.partials.dynamic-fields', ['fieldsData' => $section->data ?? [], 'fieldsPrefix' => 'data'])

    <div class="admin-actions">
      <button class="btn" type="submit">Save section</button>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.content', $page) }}">All sections</a>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.index') }}">All services</a>
      <a class="btn btn-ghost" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview page</a>
    </div>
  </form>

  <form method="post" action="{{ route('admin.service-pages.sections.destroy', [$page, $section->key]) }}" class="danger-zone" onsubmit="return confirm('Delete this section permanently?');">
    @csrf
    @method('DELETE')
    <button class="btn-link-danger" type="submit">Delete section</button>
  </form>
</div>
@endsection
