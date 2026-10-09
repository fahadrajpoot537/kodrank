@extends('admin.layout')

@section('content')
<h1 class="admin-h1">{{ $parent ? 'Add sub service' : 'Add main service' }}</h1>
<p class="admin-sub">
  @if($parent)
    Sub-service under <strong>{{ $parent->name }}</strong>. This link appears under that column in the navbar.
  @else
    A main service becomes a <strong>column heading</strong> in the Services menu. Add sub-services under it.
  @endif
</p>

@if($errors->any())
  <div class="flash" style="background:#FDECEC;border-color:#f5c2c0;color:#b42318">
    {{ $errors->first() }}
  </div>
@endif

<div class="admin-card">
  <form method="post" action="{{ route('admin.service-pages.store') }}">
    @csrf

    <div class="field">
      <label>Parent</label>
      <select name="parent_id">
        <option value="">— Main service (no parent) —</option>
        @foreach($parents as $p)
          <option value="{{ $p->id }}" @selected((int) old('parent_id', $parent?->id) === (int) $p->id)>
            {{ $p->parent_id ? '↳ ' : '' }}{{ $p->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="field">
      <label>Name</label>
      <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. On-Page SEO Services" autofocus>
    </div>

    <div class="field">
      <label>URL slug (optional)</label>
      <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Leave blank — auto from name">
    </div>

    <div class="field">
      <label>Theme / layout</label>
      <select name="theme">
        @php
          $defaultTheme = old('theme', ($parent?->seo['theme'] ?? 'digital-marketing'));
        @endphp
        <option value="digital-marketing" @selected($defaultTheme === 'digital-marketing')>Digital Marketing layout</option>
        <option value="seo-service" @selected($defaultTheme === 'seo-service')>SEO service layout (On/Off-page / GEO / Technical)</option>
        <option value="about" @selected($defaultTheme === 'about')>About Us layout</option>
        <option value="web-development" @selected($defaultTheme === 'web-development')>Web Development layout</option>
        <option value="wordpress" @selected($defaultTheme === 'wordpress')>WordPress Development layout</option>
        <option value="ai-chatbot" @selected($defaultTheme === 'ai-chatbot')>AI Chatbot Development layout</option>
        <option value="shopify" @selected($defaultTheme === 'shopify')>Shopify Development layout</option>
        <option value="cms" @selected($defaultTheme === 'cms')>CMS Development layout</option>
        <option value="website-redesign" @selected($defaultTheme === 'website-redesign')>Website Redesign layout</option>
        <option value="saas-seo" @selected($defaultTheme === 'saas-seo')>SaaS SEO layout</option>
        <option value="monthly-seo" @selected($defaultTheme === 'monthly-seo')>Monthly SEO layout</option>
        <option value="b2b-seo" @selected($defaultTheme === 'b2b-seo')>B2B SEO layout</option>
        <option value="ecommerce-seo" @selected($defaultTheme === 'ecommerce-seo')>eCommerce SEO layout</option>
        <option value="wordpress-seo" @selected($defaultTheme === 'wordpress-seo')>WordPress SEO layout</option>
        <option value="theme-html" @selected($defaultTheme === 'theme-html')>Full HTML import layout (theme pages)</option>
        <option value="industries" @selected($defaultTheme === 'industries')>Industries hub layout</option>
      </select>
      <p class="admin-hint">The theme sets this page’s design. You can change it later under SEO &amp; settings.</p>
    </div>

    <input type="hidden" name="is_active" value="1">
    <input type="hidden" name="with_template" value="1">

    <div class="admin-actions">
      <button class="btn" type="submit">Create &amp; edit content</button>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.index') }}">Cancel</a>
    </div>
  </form>
</div>
@endsection
