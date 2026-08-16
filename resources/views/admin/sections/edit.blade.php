@extends('admin.layout')

@section('content')
<h1 class="admin-h1">{{ $section->label }}</h1>
<p class="admin-sub">Update this homepage section. Use “Add item” for lists.</p>

<div class="admin-card">
  <form method="post" action="{{ route('admin.sections.update', $section->key) }}" enctype="multipart/form-data">
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

    @include('admin.partials.dynamic-fields', ['fieldsData' => $section->data ?? [], 'fieldsPrefix' => 'data'])

    <div class="admin-actions">
      <button class="btn" type="submit">Save section</button>
      <a class="btn btn-ghost" href="{{ route('admin.homepage.index') }}">All homepage sections</a>
      <a class="btn btn-ghost" href="{{ route('home') }}" target="_blank" rel="noopener">Preview site</a>
    </div>
  </form>

  <form method="post" action="{{ route('admin.sections.destroy', $section->key) }}" class="danger-zone" onsubmit="return confirm('Delete this homepage section?');">
    @csrf
    @method('DELETE')
    <button class="btn-link-danger" type="submit">Delete section</button>
  </form>
</div>
@endsection
