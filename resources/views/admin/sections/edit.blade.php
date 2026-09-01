@extends('admin.layout')

@section('content')
<h1 class="admin-h1">{{ $section->label }}</h1>
<p class="admin-sub">Update this content. Use “Add item” for lists. Image fields have an upload button — Save to apply.</p>

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
      <a class="btn btn-ghost" href="{{ route('admin.homepage.index') }}">All content sections</a>
      <a class="btn btn-ghost" href="{{ route('home') }}" target="_blank" rel="noopener">Preview site</a>
      @if($section->key === 'results_page')
        <a class="btn btn-ghost" href="{{ route('results') }}" target="_blank" rel="noopener">Preview /results</a>
      @endif
    </div>
  </form>

    @php
      $protected = array_merge(['site', 'nav', 'footer'], array_keys(\App\Support\CmsPageDefaults::sections()));
    @endphp
    @unless(in_array($section->key, $protected, true))
    <form method="post" action="{{ route('admin.sections.destroy', $section->key) }}" class="danger-zone" onsubmit="return confirm('Delete this section?');">
      @csrf
      @method('DELETE')
      <button class="btn-link-danger" type="submit">Delete section</button>
    </form>
    @endunless
</div>
@endsection
