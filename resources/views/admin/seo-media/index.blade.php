@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Page media library</h1>
<p class="admin-sub">Upload, preview, crop, and delete images for service / about pages. Stored under <code>storage/app/public/seo-services</code>. Copy the public path into a section image field (e.g. <code>storage/seo-services/about/team.jpg</code>), or upload directly while editing a section.</p>

<form method="get" class="admin-card" style="margin-bottom:16px;display:flex;gap:12px;align-items:end;flex-wrap:wrap">
  <div class="field" style="margin:0">
    <label>Folder</label>
    <select name="folder" onchange="this.form.submit()">
      @foreach($folders as $value => $label)
        <option value="{{ $value }}" @selected($folder === $value)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
</form>

<div class="admin-card" style="margin-bottom:16px">
  <h2 class="admin-h2" style="margin-top:0">Upload / crop</h2>
  <form method="post" action="{{ route('admin.seo-media.store') }}" enctype="multipart/form-data" class="admin-form">
    @csrf
    <input type="hidden" name="folder" value="{{ $folder }}">
    <div class="field">
      <label>Image</label>
      <input type="file" name="image" accept="image/*" required>
      @error('image')<p class="field-err">{{ $message }}</p>@enderror
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,minmax(80px,1fr));gap:10px">
      <div class="field"><label>Crop X</label><input type="number" name="crop_x" min="0" step="1" placeholder="0"></div>
      <div class="field"><label>Crop Y</label><input type="number" name="crop_y" min="0" step="1" placeholder="0"></div>
      <div class="field"><label>Crop W</label><input type="number" name="crop_w" min="1" step="1" placeholder="optional"></div>
      <div class="field"><label>Crop H</label><input type="number" name="crop_h" min="1" step="1" placeholder="optional"></div>
    </div>
    <p class="admin-hint">Leave crop fields empty to store the original. Crop uses GD when available.</p>
    <button class="btn" type="submit">Upload</button>
  </form>
</div>

<div class="admin-card">
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr><th>Preview</th><th>File</th><th>Public path</th><th>Size</th><th></th></tr>
      </thead>
      <tbody>
        @forelse($files as $file)
          <tr>
            <td><img src="{{ $file['url'] }}" alt="" style="width:72px;height:48px;object-fit:cover;border-radius:6px" loading="lazy"></td>
            <td>{{ $file['name'] }}</td>
            <td><code>storage/{{ $file['path'] }}</code></td>
            <td>{{ number_format($file['size'] / 1024, 1) }} KB</td>
            <td>
              <a class="btn btn-ghost" href="{{ $file['url'] }}" target="_blank" rel="noopener">Preview</a>
              <form method="post" action="{{ route('admin.seo-media.destroy') }}" style="display:inline" onsubmit="return confirm('Delete this image?')">
                @csrf
                @method('DELETE')
                <input type="hidden" name="path" value="{{ $file['path'] }}">
                <button class="btn" type="submit" style="background:#b42318">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No images in this folder yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
