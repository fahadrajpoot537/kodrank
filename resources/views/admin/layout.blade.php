@extends('layouts.admin')

@section('body')
<div class="admin-shell">
  <div class="admin-backdrop" id="adminBackdrop" hidden></div>

  <aside class="admin-side" id="adminSide">
    <div class="admin-side-top">
      <a class="brand" href="{{ route('admin.dashboard') }}">KodRank CMS</a>
      <button type="button" class="admin-side-close" id="adminSideClose" aria-label="Close menu">×</button>
    </div>
    <nav class="admin-nav">
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
      <a href="{{ route('admin.homepage.index') }}" class="{{ request()->routeIs('admin.homepage.*') || request()->routeIs('admin.sections.*') ? 'active' : '' }}">Homepage content</a>
      <a href="{{ route('admin.service-pages.index') }}" class="{{ request()->routeIs('admin.service-pages.*') ? 'active' : '' }}">Services &amp; sub-services</a>
      <a href="{{ route('admin.service-pages.create') }}">+ Add service</a>
      <a href="{{ route('admin.blog.posts.index') }}" class="{{ request()->routeIs('admin.blog.posts.*') ? 'active' : '' }}">Blog posts</a>
      <a href="{{ route('admin.blog.posts.create') }}">+ New post</a>
      <a href="{{ route('admin.blog.categories.index') }}" class="{{ request()->routeIs('admin.blog.categories.*') ? 'active' : '' }}">Blog categories</a>
      <a href="{{ route('admin.blog.settings.edit') }}" class="{{ request()->routeIs('admin.blog.settings.*') ? 'active' : '' }}">Blog settings</a>
      <a href="{{ route('admin.newsletter.index') }}" class="{{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">Newsletter subscribers</a>
      <a href="{{ route('admin.cache.clear') }}">Clear cache</a>
      <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">Messages @if(($unread ?? 0) > 0)<span class="badge">{{ $unread }}</span>@endif</a>
      <a href="{{ route('admin.seo-inquiries.index') }}" class="{{ request()->routeIs('admin.seo-inquiries.*') ? 'active' : '' }}">SEO inquiries @if(($unreadInquiries ?? 0) > 0)<span class="badge">{{ $unreadInquiries }}</span>@endif</a>
      <a href="{{ route('admin.seo-media.index') }}" class="{{ request()->routeIs('admin.seo-media.*') ? 'active' : '' }}">Media library</a>

      <div class="nav-group-label">Homepage sections</div>
      <a href="{{ route('admin.sections.create') }}" class="{{ request()->routeIs('admin.sections.create') ? 'active' : '' }}">+ Add homepage section</a>
      @foreach(($sections ?? \App\Models\CmsSection::orderBy('sort_order')->get()) as $sec)
        <a href="{{ route('admin.sections.edit', $sec->key) }}" class="{{ request()->routeIs('admin.sections.edit') && request()->route('key') === $sec->key ? 'active' : '' }}">{{ $sec->label }}</a>
      @endforeach

      <a href="{{ route('home') }}" target="_blank" rel="noopener">View website ↗</a>
    </nav>
    <form method="post" action="{{ route('admin.logout') }}" class="admin-logout-form">
      @csrf
      <button class="logout" type="submit">Logout</button>
    </form>
  </aside>

  <div class="admin-main-wrap">
    <header class="admin-topbar">
      <button type="button" class="admin-menu-btn" id="adminMenuBtn" aria-label="Open menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <div class="admin-topbar-title">KodRank Admin</div>
      <a class="admin-topbar-link" href="{{ route('home') }}" target="_blank" rel="noopener">Site ↗</a>
    </header>

    <main class="admin-main">
      @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
      @endif
      @yield('content')
    </main>
  </div>
</div>
@endsection
