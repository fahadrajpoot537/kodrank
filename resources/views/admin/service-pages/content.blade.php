@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Edit content — {{ $page->name }}</h1>
    <p class="admin-sub">
      Hero, cards, buttons, aur neeche ka sara text isi page par hai. Jo section change karo, usi ka Save dabao.
      @if($page->parent)
        Parent: <strong>{{ $page->parent->name }}</strong> ·
      @endif
      URL: <code>/{{ $page->slug }}</code>
    </p>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview ↗</a>
    <a class="btn btn-ghost" href="{{ route('admin.service-pages.seo', $page) }}">SEO &amp; settings</a>
    <a class="btn btn-ghost" href="{{ route('admin.service-pages.sections.create', $page) }}">+ Add section</a>
  </div>
</div>

<div class="admin-card" style="margin-bottom:16px">
  <h2 class="admin-h1" style="font-size:1.15rem;margin-bottom:6px">Services grid card</h2>
  <p class="admin-hint" style="margin-top:0">Yeh text /services par is service ke card par dikhta hai — chhota label, title, aur description.</p>
  <form method="post" action="{{ route('admin.service-pages.listing', $page) }}">
    @csrf
    @method('PUT')
    <div class="field">
      <label>Card title</label>
      <input type="text" name="name" value="{{ old('name', $page->name) }}" required maxlength="160">
    </div>
    <div class="field">
      <label>Small label</label>
      <input type="text" name="listing_tag" value="{{ old('listing_tag', $listingTag ?? '') }}" maxlength="40" placeholder="AI Search, For SaaS, B2B — khali chhoro agar label nahi chahiye">
    </div>
    <div class="field">
      <label>Card description</label>
      <textarea name="listing_blurb" rows="3" maxlength="320">{{ old('listing_blurb', $listingBlurb ?? '') }}</textarea>
    </div>
    <button class="btn" type="submit">Save card</button>
  </form>
</div>

<div class="admin-card" style="margin-bottom:16px">
  <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center">
    <form method="post" action="{{ route('admin.service-pages.toggle', $page) }}">
      @csrf
      <button class="btn btn-ghost" type="submit">
        Status: {{ $page->is_active ? 'Active' : 'Inactive' }} (toggle)
      </button>
    </form>
    <a class="btn btn-ghost" href="{{ route('admin.service-pages.index') }}">← All services</a>
  </div>
</div>

@if(empty($editors))
  <div class="admin-card">
    <p>No sections yet. <a href="{{ route('admin.service-pages.sections.create', $page) }}">Add the first section</a></p>
  </div>
@else
  <div class="admin-card" style="margin-bottom:16px">
    <p class="admin-hint" style="margin:0">Jump to</p>
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:8px">
      @foreach($editors as $editor)
        <a class="btn btn-ghost" href="#section-{{ $editor['section']->key }}">{{ $editor['section']->label }}</a>
      @endforeach
    </div>
  </div>
  @foreach($editors as $editor)
    @include('admin.service-pages.partials.section-form', $editor + ['allowDelete' => false])
  @endforeach
@endif
@endsection
