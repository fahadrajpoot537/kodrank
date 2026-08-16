@extends('admin.layout')

@section('content')
<h1 class="admin-h1">{{ $page->name }} — SEO &amp; settings</h1>
<p class="admin-sub">Page metadata used for title tags, Open Graph, and robots.</p>

@if($errors->any())
  <div class="flash" style="background:#FDECEC;border-color:#f5c2c0;color:#b42318">
    {{ $errors->first() }}
  </div>
@endif

<div class="admin-card">
  <form method="post" action="{{ route('admin.service-pages.seo.update', $page) }}">
    @csrf
    @method('PUT')

    <div class="field">
      <label>Page name</label>
      <input type="text" name="name" value="{{ old('name', $page->name) }}" required>
    </div>

    <div class="field">
      <label>URL slug</label>
      <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required pattern="[a-z0-9]+(?:-[a-z0-9]+)*">
      <p class="admin-hint">Live URL: <code>/{{ $page->slug }}</code></p>
    </div>

    <div class="field">
      <label>Parent (optional)</label>
      <select name="parent_id">
        <option value="">— Main service —</option>
        @foreach($parents as $p)
          <option value="{{ $p->id }}" @selected((int) old('parent_id', $page->parent_id) === (int) $p->id)>
            {{ $p->parent_id ? '↳ ' : '' }}{{ $p->name }}
          </option>
        @endforeach
      </select>
      <p class="admin-hint">Sub service parent ke under navbar me dikhegi. Sub ke under aur sub bhi set kar sakte ho.</p>
    </div>

    <div class="field">
      <label>Sort order</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order) }}" min="0" max="9999">
    </div>

    <div class="field">
      <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $page->is_active))> Active</label>
    </div>

    @foreach([
      'theme' => 'Theme key (digital-marketing / web-development / seo-service / about / wordpress / ai-chatbot)',
      'seo_title' => 'SEO title',
      'seo_description' => 'SEO description',
      'og_title' => 'OG title',
      'og_description' => 'OG description',
      'og_image' => 'OG image path',
      'og_type' => 'OG type',
      'twitter_card' => 'Twitter card',
      'keywords' => 'Keywords',
      'robots' => 'Robots',
      'canonical_url' => 'Canonical URL (empty = current)',
      'schema_json' => 'Schema JSON (optional)',
    ] as $key => $label)
      <div class="field">
        <label>{{ $label }}</label>
        @if(str_contains($key, 'description') || $key === 'schema_json')
          <textarea name="seo[{{ $key }}]" rows="{{ $key === 'schema_json' ? 6 : 3 }}">{{ old('seo.'.$key, $seo[$key] ?? '') }}</textarea>
        @else
          <input type="text" name="seo[{{ $key }}]" value="{{ old('seo.'.$key, $seo[$key] ?? '') }}">
        @endif
      </div>
    @endforeach

    <div class="admin-actions">
      <button class="btn" type="submit">Save SEO</button>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.content', $page) }}">Edit all content</a>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.index') }}">Back</a>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.sections.create', $page) }}">+ Add section</a>
      <a class="btn btn-ghost" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview</a>
    </div>
  </form>
</div>
@endsection
