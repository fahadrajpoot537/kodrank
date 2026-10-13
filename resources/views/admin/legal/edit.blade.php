@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">{{ $page->slug === 'privacy-policy' ? 'Privacy Policy' : 'Terms & Conditions' }}</h1>
    <p class="admin-sub">The title is the only heading on the public page. The description is the page body. The public page stays a plain white document.</p>
  </div>
  <a class="btn btn-ghost" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview ↗</a>
</div>

<div class="admin-card">
  <form method="post" action="{{ route('admin.legal.update', $page->slug) }}">
    @csrf
    @method('PUT')

    <div class="field">
      <label for="legal-title">Title</label>
      <input id="legal-title" type="text" name="title" value="{{ old('title', $title) }}" required maxlength="200">
      @error('title')<p class="field-err">{{ $message }}</p>@enderror
    </div>

    <div class="field">
      <label for="legal-html">Description</label>
      <textarea id="legal-html" name="html" rows="18">{{ old('html', $html) }}</textarea>
      @error('html')<p class="field-err">{{ $message }}</p>@enderror
    </div>

    <div class="admin-actions">
      <button class="btn" type="submit">Save</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const uploadUrl = @json(route('admin.blog.posts.editor-image'));
  const csrf = @json(csrf_token());

  tinymce.init({
    selector: '#legal-html',
    menubar: false,
    branding: false,
    promotion: false,
    height: 520,
    plugins: 'lists link image code table autoresize',
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
    style_formats: [
      { title: 'Paragraph', format: 'p' },
      { title: 'Heading 2', format: 'h2' },
      { title: 'Heading 3', format: 'h3' },
    ],
    content_style: 'body{font-family:Poppins,sans-serif;font-size:15px;line-height:1.7;color:#18313A} img{max-width:100%;height:auto}',
    images_upload_handler: (blobInfo) => new Promise((resolve, reject) => {
      const form = new FormData();
      form.append('image', blobInfo.blob(), blobInfo.filename());
      fetch(uploadUrl, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        body: form,
      })
        .then(async (response) => {
          if (!response.ok) throw new Error('Upload failed');
          const data = await response.json();
          if (!data.url) throw new Error('Missing image URL');
          resolve(data.url);
        })
        .catch((error) => reject(error.message || 'Image upload failed'));
    }),
    automatic_uploads: true,
    convert_urls: false,
    relative_urls: false,
    remove_script_host: false,
  });

  document.querySelector('.admin-card form')?.addEventListener('submit', () => {
    if (window.tinymce) window.tinymce.triggerSave();
  });
});
</script>
@endpush
