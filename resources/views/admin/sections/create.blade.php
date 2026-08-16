@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Add homepage section</h1>
<p class="admin-sub">New CMS blocks appear in the sidebar. Wire them into a Blade view if you need them on the live homepage.</p>

@if($errors->any())
  <div class="flash" style="background:#FDECEC;border-color:#f5c2c0;color:#b42318">
    {{ $errors->first() }}
  </div>
@endif

<div class="admin-card">
  <form method="post" action="{{ route('admin.sections.store') }}">
    @csrf

    <div class="field">
      <label>Section type</label>
      <select name="type" required>
        @foreach($types as $key => $type)
          <option value="{{ $key }}" @selected(old('type') === $key)>{{ $type['label'] }}</option>
        @endforeach
      </select>
    </div>

    <div class="field">
      <label>Key</label>
      <input type="text" name="key" value="{{ old('key') }}" required pattern="[a-z0-9_]+" placeholder="e.g. promo_banner">
    </div>

    <div class="field">
      <label>Label</label>
      <input type="text" name="label" value="{{ old('label') }}" required placeholder="e.g. Promo banner">
    </div>

    <div class="field">
      <label>Sort order</label>
      <input type="number" name="sort_order" value="{{ old('sort_order') }}" min="0" max="999" placeholder="Auto if empty">
    </div>

    <div class="admin-actions">
      <button class="btn" type="submit">Create section</button>
      <a class="btn btn-ghost" href="{{ route('admin.dashboard') }}">Cancel</a>
    </div>
  </form>
</div>
@endsection
