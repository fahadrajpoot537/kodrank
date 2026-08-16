@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Edit content — {{ $page->name }}</h1>
    <p class="admin-sub">
      Har section ka har text / card / FAQ / image path yahan se edit hota hai.
      @if($page->parent)
        Parent: <strong>{{ $page->parent->name }}</strong> ·
      @endif
      Theme: <code>{{ $theme }}</code> · URL: <code>/{{ $page->slug }}</code>
    </p>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <a class="btn" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview ↗</a>
    <a class="btn btn-ghost" href="{{ route('admin.service-pages.seo', $page) }}">SEO &amp; settings</a>
    <a class="btn btn-ghost" href="{{ route('admin.service-pages.sections.create', $page) }}">+ Add section</a>
  </div>
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

<div class="admin-card">
  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Section</th>
          <th>Key</th>
          <th>What you can edit</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($page->sections as $section)
          @php
            $hints = [
              'hero' => 'Title, subtitle, CTA, badges, hero image path / upload, breadcrumb',
              'problem' => 'Headings + problem cards (title, body, icon) + close-it note',
              'services' => 'Service cards, links, icons',
              'included' => 'Deliverable cards',
              'process' => 'Steps list',
              'compare' => 'Comparison columns & items',
              'stats' => 'Numbers / metrics + optional background image',
              'why_us' => 'Why us cards',
              'testimonials' => 'Quotes & names',
              'faq' => 'Questions & answers',
              'cta' => 'CTA title, body, buttons, background image',
              'contact' => 'Form labels, service options, contact cards',
              'trust' => 'Trust logos / label',
              'playbook' => 'Playbook cards',
              'platforms' => 'Platform / industry cards',
              'why_exist' => 'Agency vs KodRank compare columns',
              'values' => 'Value cards (add / remove)',
              'leadership' => 'Team members — name, role, bio, photo upload, LinkedIn, tags',
              'mission' => 'Vision number, title, checklist items',
            ];
          @endphp
          <tr>
            <td>{{ $section->sort_order }}</td>
            <td><strong>{{ $section->label }}</strong></td>
            <td><code>{{ $section->key }}</code></td>
            <td style="color:#4B5B62;font-size:.9rem">{{ $hints[$section->key] ?? 'All fields in this section JSON' }}</td>
            <td>
              <a class="btn" href="{{ route('admin.service-pages.sections.edit', [$page, $section->key]) }}">Edit</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">
              No sections yet.
              <a href="{{ route('admin.service-pages.sections.create', $page) }}">Add first section</a>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
