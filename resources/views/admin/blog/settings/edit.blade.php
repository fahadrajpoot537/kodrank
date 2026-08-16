@extends('admin.layout')

@section('content')
<h1 class="admin-h1">Blog page settings</h1>
<p class="admin-sub">Hero, search, newsletter, and SEO chrome for /blogs.</p>

@if($errors->any())
  <div class="flash" style="background:#FDECEC;border-color:#f5c2c0;color:#b42318">{{ $errors->first() }}</div>
@endif

<div class="admin-card">
  <form method="post" enctype="multipart/form-data" action="{{ route('admin.blog.settings.update') }}">
    @csrf
    @method('PUT')

    <div class="field">
      <label>Hero title</label>
      <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" required>
    </div>
    <div class="field">
      <label>Hero lede</label>
      <textarea name="hero_lede" rows="3" required>{{ old('hero_lede', $settings['hero_lede'] ?? '') }}</textarea>
    </div>
    <div class="field">
      <label>Search placeholder</label>
      <input type="text" name="search_placeholder" value="{{ old('search_placeholder', $settings['search_placeholder'] ?? '') }}">
    </div>
    <div class="field">
      <label>Hero background path</label>
      <input type="text" name="hero_background" value="{{ old('hero_background', $settings['hero_background'] ?? '') }}">
    </div>
    <div class="field">
      <label>Upload hero background</label>
      <input type="file" name="hero_background_file" accept="image/*">
    </div>

    <div class="field">
      <label>Newsletter eyebrow</label>
      <input type="text" name="newsletter_eyebrow" value="{{ old('newsletter_eyebrow', $settings['newsletter_eyebrow'] ?? '') }}">
    </div>
    <div class="field">
      <label>Newsletter title</label>
      <input type="text" name="newsletter_title" value="{{ old('newsletter_title', $settings['newsletter_title'] ?? '') }}">
    </div>
    <div class="field">
      <label>Newsletter title HTML</label>
      <textarea name="newsletter_title_html" rows="2">{{ old('newsletter_title_html', $settings['newsletter_title_html'] ?? '') }}</textarea>
    </div>
    <div class="field">
      <label>Newsletter copy</label>
      <textarea name="newsletter_copy" rows="3">{{ old('newsletter_copy', $settings['newsletter_copy'] ?? '') }}</textarea>
    </div>
    <div class="field">
      <label>Newsletter fine print</label>
      <input type="text" name="newsletter_fine" value="{{ old('newsletter_fine', $settings['newsletter_fine'] ?? '') }}">
    </div>
    <div class="field">
      <label>Newsletter email placeholder</label>
      <input type="text" name="newsletter_placeholder" value="{{ old('newsletter_placeholder', $settings['newsletter_placeholder'] ?? '') }}">
    </div>

    <div class="field">
      <label>SEO title</label>
      <input type="text" name="seo_title" value="{{ old('seo_title', $settings['seo_title'] ?? '') }}">
    </div>
    <div class="field">
      <label>SEO description</label>
      <textarea name="seo_description" rows="3">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
    </div>
    <div class="field">
      <label>OG title</label>
      <input type="text" name="og_title" value="{{ old('og_title', $settings['og_title'] ?? '') }}">
    </div>
    <div class="field">
      <label>OG description</label>
      <textarea name="og_description" rows="3">{{ old('og_description', $settings['og_description'] ?? '') }}</textarea>
    </div>

    <div class="admin-actions">
      <button class="btn" type="submit">Save settings</button>
      <a class="btn btn-ghost" href="{{ route('admin.blog.posts.index') }}">Back to posts</a>
    </div>
  </form>
</div>
@endsection
