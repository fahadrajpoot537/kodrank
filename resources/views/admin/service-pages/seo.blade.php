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
  <form method="post" action="{{ route('admin.service-pages.seo.update', $page) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="field">
      <label>Page name</label>
      <input type="text" name="name" value="{{ old('name', $page->name) }}" required>
    </div>

    <div class="field">
      <label>URL slug</label>
      <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required pattern="[a-z0-9]+(?:-[a-z0-9]+)*">
      <p class="admin-hint">Live URL: <code>/{{ $page->slug }}</code>. Changing this slug automatically 301-redirects the old URL so Google and bookmarks keep working.</p>
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
      <label><input type="checkbox" name="hide_from_nav" value="1" @checked(old('hide_from_nav', !empty($seo['hide_from_nav'])))> Hide from Services dropdown</label>
      <p class="admin-hint">Page stays live and listed on View all services. It will not appear in the navbar mega menu.</p>
    </div>

    <div class="field">
      <label>Services listing blurb</label>
      <textarea name="seo[listing_blurb]" rows="3" placeholder="Short card copy on /services">{{ old('seo.listing_blurb', $seo['listing_blurb'] ?? '') }}</textarea>
      <p class="admin-hint">Shown on the /services grid. Leave empty to use the built-in fallback or SEO description.</p>
    </div>

    <div class="field">
      <label>Services listing tag</label>
      <input type="text" name="seo[listing_tag]" value="{{ old('seo.listing_tag', $seo['listing_tag'] ?? '') }}" placeholder="e.g. For SaaS">
    </div>

    <div class="field">
      <label>Listing icon path</label>
      <input type="text" name="seo[listing_icon]" value="{{ old('seo.listing_icon', $seo['listing_icon'] ?? '') }}" placeholder="storage/service-media/...">
      @if(!empty($seo['listing_icon']))
        <div style="margin:8px 0"><img src="{{ asset(ltrim($seo['listing_icon'], '/')) }}" alt="" width="48" height="48" style="object-fit:contain;border:1px solid #E1E9E5;border-radius:8px;background:#fff;padding:6px"></div>
      @endif
      <label class="admin-hint" style="display:block;margin:8px 0 4px">Or upload a listing icon</label>
      <input type="file" name="listing_icon_file" accept="image/jpeg,image/png,image/webp,image/gif">
    </div>

    @foreach([
      'theme' => 'Theme key (digital-marketing / web-development / seo-service / about / wordpress / ai-chatbot / cms / website-redesign / shopify / saas-seo / monthly-seo / b2b-seo / ecommerce-seo / wordpress-seo / theme-html / industries)',
      'css' => 'Extra CSS path (e.g. css/page-privacy.css)',
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

    <div class="field">
      <label>Upload OG image</label>
      @if(!empty($seo['og_image']))
        <div style="margin:0 0 10px"><img src="{{ asset(ltrim($seo['og_image'], '/')) }}" alt="" style="max-width:240px;max-height:120px;object-fit:cover;border-radius:10px;border:1px solid #E1E9E5"></div>
      @endif
      <input type="file" name="og_image_file" accept="image/jpeg,image/png,image/webp,image/gif">
      <p class="admin-hint">Upload replaces the OG image path above after Save.</p>
    </div>

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
