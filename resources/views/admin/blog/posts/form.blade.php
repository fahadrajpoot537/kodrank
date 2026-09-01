@extends('admin.layout')

@section('content')
@php $editing = $post->exists; @endphp
<h1 class="admin-h1">{{ $editing ? 'Edit post' : 'New post' }}</h1>
<p class="admin-sub">{{ $editing ? 'Update article content and placement flags.' : 'Create a new blog article.' }}</p>

@if($errors->any())
  <div class="flash" style="background:#FDECEC;border-color:#f5c2c0;color:#b42318">{{ $errors->first() }}</div>
@endif

<div class="admin-card">
  <form method="post" enctype="multipart/form-data" action="{{ $editing ? route('admin.blog.posts.update', $post) : route('admin.blog.posts.store') }}">
    @csrf
    @if($editing) @method('PUT') @endif

    <div class="field">
      <label>Title</label>
      <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
    </div>

    <div class="field">
      <label>Slug (optional)</label>
      <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Auto from title">
      <p class="admin-hint">Live at <code>/blogs/{{ $post->slug ?: '…' }}</code>. Changing the slug 301-redirects the old URL.</p>
    </div>

    <div class="field">
      <label>Category</label>
      <select name="category_id">
        <option value="">— None —</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" @selected((string) old('category_id', $post->category_id) === (string) $cat->id)>{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="field">
      <label>Tag label</label>
      <input type="text" name="tag_label" value="{{ old('tag_label', $post->tag_label) }}" placeholder="e.g. Technical SEO">
    </div>

    <div class="field">
      <label>Post tags</label>
      <input type="text" name="post_tags" value="{{ old('post_tags', $post->post_tags) }}" placeholder="crawl budget, technical SEO, indexing">
      <p class="admin-hint">Comma-separated tags shown at the end of the article.</p>
    </div>

    <div class="field">
      <label>Excerpt</label>
      <textarea name="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
    </div>

    <div class="field">
      <label>Body</label>
      <textarea name="body" rows="8">{{ old('body', $post->body) }}</textarea>
      <p class="admin-hint">Optional fallback plain text if article HTML is empty.</p>
    </div>

    <div class="field">
      <label>Article content</label>
      <textarea id="content_html" name="content_html" rows="18">{{ old('content_html', $post->content_html) }}</textarea>
      <p class="admin-hint">Use the toolbar for headings, links, lists, and images (left/right align).</p>
    </div>

    <div class="field">
      <label>Author</label>
      <select name="author_key" id="author_key">
        <option value="custom" @selected(old('author_key', $authorKey ?? '') === 'custom' || old('author_key', $authorKey ?? '') === '')>Custom (type name below)</option>
        @foreach(($authors ?? []) as $key => $author)
          <option
            value="{{ $key }}"
            @selected(old('author_key', $authorKey ?? '') === $key)
            data-name="{{ $author['name'] }}"
            data-role="{{ $author['role'] }}"
            data-linkedin="{{ $author['linkedin'] }}"
            data-image="{{ $author['image'] }}"
            data-image-url="{{ asset($author['image']) }}"
            data-bio="{{ $author['bio'] }}"
          >{{ $author['name'] }}</option>
        @endforeach
      </select>
      <p class="admin-hint">Roster authors live under <a href="{{ route('admin.sections.edit', 'blog_authors') }}">Blog authors</a>. Pick one, or choose Custom and fill name / photo / bio.</p>
    </div>

    <div class="field" style="display:flex;align-items:center;gap:14px">
      <img id="author_preview" src="{{ asset(old('author_image', $post->author_image ?: (($authors[$authorKey ?? '']['image'] ?? null) ?: 'media/blog/hidayatul-haq.jpg'))) }}" alt="Author preview" width="72" height="72" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:1px solid #E1E9E5;background:#F7FAF8">
      <div>
        <div style="font-weight:700" id="author_preview_name">{{ old('author_name', $post->author_name) }}</div>
        <div style="color:#4B5B62;font-size:.9rem" id="author_preview_role">{{ old('author_role', $post->author_role) }}</div>
      </div>
    </div>

    <div class="field">
      <label>Author name</label>
      <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $post->author_name) }}">
    </div>
    <input type="hidden" name="author_image" id="author_image" value="{{ old('author_image', $post->author_image) }}">

    <div class="field">
      <label>Author role</label>
      <input type="text" name="author_role" id="author_role" value="{{ old('author_role', $post->author_role) }}" placeholder="Founder, KodRank · SEO Strategist">
    </div>

    <div class="field">
      <label>Author bio (E-E-A-T card)</label>
      <textarea id="author_bio" name="author_bio" rows="10">{{ old('author_bio', $post->author_bio) }}</textarea>
      <p class="admin-hint">Auto-filled from the selected author. You can still edit it.</p>
    </div>

    <div class="field">
      <label>Author LinkedIn URL</label>
      <input type="url" name="author_linkedin" id="author_linkedin" value="{{ old('author_linkedin', $post->author_linkedin) }}" placeholder="https://linkedin.com/in/...">
    </div>

    <div class="field">
      <label>Upload author photo</label>
      <input type="file" name="author_image_file" accept="image/*">
      <p class="admin-hint">Optional. Overrides the roster photo for this post only.</p>
    </div>

    <div class="field">
      <label>Featured image path</label>
      <input type="text" name="featured_image" value="{{ old('featured_image', $post->featured_image) }}" placeholder="media/blog/...">
    </div>

    <div class="field">
      <label>Upload featured image</label>
      <input type="file" name="featured_image_file" accept="image/*">
    </div>

    <div class="field">
      <label>Featured image alt text</label>
      <input type="text" name="featured_image_alt" value="{{ old('featured_image_alt', $post->featured_image_alt) }}" placeholder="Describe the image for accessibility and SEO">
    </div>

    <div class="field">
      <label>Read minutes</label>
      <input type="number" name="read_minutes" min="1" max="120" value="{{ old('read_minutes', $post->read_minutes ?? 8) }}">
    </div>

    <div class="field">
      <label>Published at</label>
      <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\\TH:i')) }}">
    </div>

    <div class="field">
      <label>Sort order</label>
      <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $post->sort_order ?? 0) }}">
    </div>

    <div class="field" style="display:grid;gap:10px">
      <label><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published))> Published</label>
      <label><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))> Featured (latest hero card)</label>
      <label><input type="checkbox" name="is_editors_pick" value="1" @checked(old('is_editors_pick', $post->is_editors_pick))> Editor's pick</label>
      <label><input type="checkbox" name="show_in_latest" value="1" @checked(old('show_in_latest', $post->show_in_latest ?? true))> Show in latest</label>
    </div>

    <details class="admin-card" style="margin-top:20px">
      <summary style="cursor:pointer;font-weight:700">SEO &amp; social metadata</summary>
      <div style="padding-top:18px">
        <div class="field">
          <label>SEO title</label>
          <input type="text" name="seo_title" value="{{ old('seo_title', $post->seo_title) }}" maxlength="255" placeholder="Defaults to post title">
        </div>
        <div class="field">
          <label>Meta description</label>
          <textarea name="seo_description" rows="3" maxlength="500" placeholder="Defaults to excerpt">{{ old('seo_description', $post->seo_description) }}</textarea>
        </div>
        <div class="field">
          <label>Focus keywords</label>
          <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $post->seo_keywords) }}" placeholder="keyword one, keyword two">
        </div>
        <div class="field">
          <label>Canonical URL</label>
          <input type="text" name="canonical_url" value="{{ old('canonical_url', $post->canonical_url) }}" placeholder="Defaults to the public post URL">
        </div>
        <div class="field">
          <label>Robots</label>
          <input type="text" name="robots" value="{{ old('robots', $post->robots ?? 'index, follow') }}" placeholder="index, follow">
        </div>
        <div class="field">
          <label>Open Graph title</label>
          <input type="text" name="og_title" value="{{ old('og_title', $post->og_title) }}" placeholder="Defaults to SEO title">
        </div>
        <div class="field">
          <label>Open Graph description</label>
          <textarea name="og_description" rows="3" maxlength="500" placeholder="Defaults to meta description">{{ old('og_description', $post->og_description) }}</textarea>
        </div>
        <div class="field">
          <label>Open Graph image path</label>
          <input type="text" name="og_image" value="{{ old('og_image', $post->og_image) }}" placeholder="Defaults to featured image">
        </div>
        <div class="field">
          <label>Open Graph image alt text</label>
          <input type="text" name="og_image_alt" value="{{ old('og_image_alt', $post->og_image_alt) }}" placeholder="Describe the social sharing image">
        </div>
      </div>
    </details>

    <details class="admin-card" style="margin-top:20px">
      <summary style="cursor:pointer;font-weight:700">Article call to action</summary>
      <div style="padding-top:18px">
        <div class="field">
          <label>CTA title</label>
          <input type="text" name="inline_cta_title" value="{{ old('inline_cta_title', $post->inline_cta_title) }}" placeholder="Want us to run this audit on your site?">
        </div>
        <div class="field">
          <label>CTA body</label>
          <textarea name="inline_cta_body" rows="3">{{ old('inline_cta_body', $post->inline_cta_body) }}</textarea>
        </div>
        <div class="field">
          <label>CTA button text</label>
          <input type="text" name="inline_cta_text" value="{{ old('inline_cta_text', $post->inline_cta_text) }}" placeholder="Get a free audit">
        </div>
        <div class="field">
          <label>CTA URL</label>
          <input type="text" name="inline_cta_url" value="{{ old('inline_cta_url', $post->inline_cta_url) }}" placeholder="/contact">
        </div>
      </div>
    </details>

    <div class="admin-actions">
      <button class="btn" type="submit">{{ $editing ? 'Save changes' : 'Create post' }}</button>
      <a class="btn btn-ghost" href="{{ route('admin.blog.posts.index') }}">Cancel</a>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const authorSelect = document.getElementById('author_key');
    const applyAuthor = () => {
    const option = authorSelect?.selectedOptions?.[0];
    if (!option || option.value === 'custom') return;

    const name = option.dataset.name || '';
    const role = option.dataset.role || '';
    const linkedin = option.dataset.linkedin || '';
    const image = option.dataset.image || '';
    const imageUrl = option.dataset.imageUrl || '';
    const bio = option.dataset.bio || '';

    const nameInput = document.getElementById('author_name');
    const roleInput = document.getElementById('author_role');
    const linkedinInput = document.getElementById('author_linkedin');
    const imageInput = document.getElementById('author_image');
    const preview = document.getElementById('author_preview');
    const previewName = document.getElementById('author_preview_name');
    const previewRole = document.getElementById('author_preview_role');

    if (nameInput) nameInput.value = name;
    if (roleInput) roleInput.value = role;
    if (linkedinInput) linkedinInput.value = linkedin;
    if (imageInput) imageInput.value = image;
    if (preview && imageUrl) preview.src = imageUrl;
    if (previewName) previewName.textContent = name;
    if (previewRole) previewRole.textContent = role;

    if (window.tinymce) {
      const bioEditor = window.tinymce.get('author_bio');
      if (bioEditor) bioEditor.setContent(bio);
    } else {
      const bioField = document.getElementById('author_bio');
      if (bioField) bioField.value = bio;
    }
  };

  authorSelect?.addEventListener('change', applyAuthor);

  const uploadUrl = @json(route('admin.blog.posts.editor-image'));
  const csrf = @json(csrf_token());

  const imageUploadHandler = (blobInfo) => new Promise((resolve, reject) => {
    const form = new FormData();
    form.append('image', blobInfo.blob(), blobInfo.filename());

    fetch(uploadUrl, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrf,
        'Accept': 'application/json',
      },
      body: form,
    })
      .then(async (response) => {
        if (!response.ok) throw new Error('Upload failed');
        const data = await response.json();
        if (!data.url) throw new Error('Missing image URL');
        resolve(data.url);
      })
      .catch((error) => reject(error.message || 'Image upload failed'));
  });

  const common = {
    menubar: false,
    branding: false,
    promotion: false,
    plugins: 'lists link image code table autoresize',
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
    style_formats: [
      { title: 'Paragraph', format: 'p' },
      { title: 'Heading 2', format: 'h2' },
      { title: 'Heading 3', format: 'h3' },
    ],
    content_style: 'body{font-family:Poppins,sans-serif;font-size:15px;line-height:1.7;color:#18313A} img{max-width:100%;height:auto;border-radius:8px} figure{margin:16px 0} figure.align-left,img.align-left{float:left;margin:4px 16px 10px 0;max-width:42%} figure.align-right,img.align-right{float:right;margin:4px 0 10px 16px;max-width:42%}',
    images_upload_handler: imageUploadHandler,
    automatic_uploads: true,
    file_picker_types: 'image',
    convert_urls: false,
    relative_urls: false,
    remove_script_host: false,
    height: 420,
    setup(editor) {
      editor.ui.registry.addButton('alignleftimg', {
        text: 'Img L',
        tooltip: 'Float image left',
        onAction() {
          const node = editor.selection.getNode();
          const target = node.closest('figure') || (node.nodeName === 'IMG' ? node : null);
          if (!target) return;
          target.classList.remove('align-right');
          target.classList.add('align-left');
        },
      });
      editor.ui.registry.addButton('alignrightimg', {
        text: 'Img R',
        tooltip: 'Float image right',
        onAction() {
          const node = editor.selection.getNode();
          const target = node.closest('figure') || (node.nodeName === 'IMG' ? node : null);
          if (!target) return;
          target.classList.remove('align-left');
          target.classList.add('align-right');
        },
      });
    },
  };

  tinymce.init({
    ...common,
    selector: '#content_html',
    toolbar: common.toolbar + ' | alignleftimg alignrightimg',
    height: 520,
  });

  tinymce.init({
    ...common,
    selector: '#author_bio',
    toolbar: common.toolbar + ' | alignleftimg alignrightimg',
    height: 280,
  });

  const form = document.querySelector('.admin-card form');
  form?.addEventListener('submit', () => {
    if (window.tinymce) window.tinymce.triggerSave();
  });
});
</script>
@endpush
