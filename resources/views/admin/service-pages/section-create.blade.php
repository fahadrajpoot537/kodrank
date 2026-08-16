@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Add section — {{ $page->name }}</h1>
<p class="admin-sub">Pick a section type. You’ll edit the fields on the next screen.</p>

@if($errors->any())
  <div class="flash" style="background:#FDECEC;border-color:#f5c2c0;color:#b42318">
    {{ $errors->first() }}
  </div>
@endif

<div class="admin-card">
  <form method="post" action="{{ route('admin.service-pages.sections.store', $page) }}">
    @csrf

    <div class="field">
      <label>Section type</label>
      <select name="type" required>
        @foreach($types as $key => $type)
          <option value="{{ $key }}" @selected(old('type') === $key)>{{ $type['label'] }} ({{ $key }})</option>
        @endforeach
      </select>
    </div>

    <div class="field">
      <label>Key (unique on this page)</label>
      <input type="text" name="key" value="{{ old('key') }}" required pattern="[a-z0-9_]+" placeholder="e.g. hero or extra_cards">
    </div>

    <div class="field">
      <label>Label (admin only)</label>
      <input type="text" name="label" value="{{ old('label') }}" required placeholder="e.g. Hero">
    </div>

    <div class="field">
      <label>Sort order</label>
      <input type="number" name="sort_order" value="{{ old('sort_order') }}" min="0" max="999" placeholder="Auto if empty">
    </div>

    <div class="admin-actions">
      <button class="btn" type="submit">Add section</button>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.index') }}">Cancel</a>
    </div>
  </form>
</div>
@endsection
