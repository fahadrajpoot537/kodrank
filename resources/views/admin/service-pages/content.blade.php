@extends('admin.layout')

@section('content')
<div class="admin-page-head">
  <div>
    <h1 class="admin-h1">Edit content — {{ $page->name }}</h1>
    <p class="admin-sub">
      One section at a time. Save updates only the section that is open.
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

@php
  $panels = [[
      'id' => 'listing',
      'label' => 'Services card',
      'type' => 'listing',
  ]];
  foreach ($editors as $editor) {
      $fields = $editor['contentFields'] ?? [];
      $mediaFields = $editor['mediaFields'] ?? [];
      if ($fields === []) {
          $panels[] = [
              'id' => $editor['section']->key,
              'label' => $editor['section']->label,
              'type' => 'section',
              'editor' => $editor,
              'showPhoto' => true,
              'showStructured' => true,
              'partial' => false,
              'fields' => [],
              'mediaFields' => $mediaFields,
          ];
          continue;
      }

      if (\App\Support\ServiceSectionPhoto::ownsField($page->slug, $editor['section']->key)) {
          $panels[] = [
              'id' => $editor['section']->key.'__photo',
              'label' => 'Section photo',
              'type' => 'section',
              'editor' => $editor,
              'showPhoto' => true,
              'showStructured' => false,
              'partial' => true,
              'fields' => [],
          ];
      }

      $groups = [];
      foreach ($fields as $field) {
          $name = trim((string) ($field['group'] ?? ''));
          if ($name === '') {
              $name = strstr((string) $field['label'], ' · ', true);
              $name = ($name !== false && $name !== '') ? $name : 'Page';
          }
          $groups[$name][] = $field;
      }
      $used = [];
      foreach ($groups as $name => $groupFields) {
          $slug = \Illuminate\Support\Str::slug($name);
          if ($slug === '') {
              $slug = 'group';
          }
          $id = $editor['section']->key.'__'.$slug;
          if (isset($used[$id])) {
              $used[$id]++;
              $id .= '-'.$used[$id];
          } else {
              $used[$id] = 1;
          }
          $groupMedia = [];
          foreach ($mediaFields as $mediaIndex => $mediaField) {
              if (($mediaField['group'] ?? '') !== $name) {
                  continue;
              }
              $groupMedia[] = $mediaField;
              unset($mediaFields[$mediaIndex]);
          }
          $panels[] = [
              'id' => $id,
              'label' => $name,
              'type' => 'section',
              'editor' => $editor,
              'showPhoto' => false,
              'showStructured' => false,
              'partial' => true,
              'fields' => $groupFields,
              'mediaFields' => $groupMedia,
              'shortLabels' => true,
          ];
      }
      $extraMedia = [];
      foreach ($mediaFields as $mediaField) {
          $name = trim((string) ($mediaField['group'] ?? 'Images'));
          $extraMedia[$name !== '' ? $name : 'Images'][] = $mediaField;
      }
      foreach ($extraMedia as $name => $groupMedia) {
          $slug = \Illuminate\Support\Str::slug($name);
          $id = $editor['section']->key.'__'.($slug !== '' ? $slug : 'images');
          if (isset($used[$id])) {
              $used[$id]++;
              $id .= '-'.$used[$id];
          } else {
              $used[$id] = 1;
          }
          $panels[] = [
              'id' => $id,
              'label' => $name,
              'type' => 'section',
              'editor' => $editor,
              'showPhoto' => false,
              'showStructured' => false,
              'partial' => true,
              'fields' => [],
              'mediaFields' => $groupMedia,
              'shortLabels' => true,
          ];
      }
  }
  $active = (string) request('part', '');
  $panelIds = array_column($panels, 'id');
  if (! in_array($active, $panelIds, true)) {
      $active = $panels[1]['id'] ?? $panels[0]['id'];
  }
@endphp

@if($panels === [])
  <div class="admin-card">
    <p>No sections yet. <a href="{{ route('admin.service-pages.sections.create', $page) }}">Add the first section</a></p>
  </div>
@else
  <div class="svc-edit">
    <nav class="svc-edit-nav" aria-label="Page sections">
      @foreach($panels as $panel)
        <a href="{{ route('admin.service-pages.content', ['page' => $page, 'part' => $panel['id']]) }}" class="{{ $panel['id'] === $active ? 'is-active' : '' }}">{{ $panel['label'] }}</a>
      @endforeach
    </nav>
    <div class="svc-edit-main">
      <label class="svc-edit-jump">
        <span>Section</span>
        <select onchange="if (this.value) window.location = this.value">
          @foreach($panels as $panel)
            <option value="{{ route('admin.service-pages.content', ['page' => $page, 'part' => $panel['id']]) }}" @selected($panel['id'] === $active)>{{ $panel['label'] }}</option>
          @endforeach
        </select>
      </label>

      @foreach($panels as $panel)
        @if($panel['id'] !== $active)
          @continue
        @endif
        @if($panel['type'] === 'listing')
          <div class="admin-card">
            <h2 class="admin-h1" style="font-size:1.15rem;margin-bottom:6px">Services card</h2>
            <p class="admin-hint" style="margin-top:0">This is the card on /services: title, small label, and description.</p>
            <form method="post" action="{{ route('admin.service-pages.listing', $page) }}">
              @csrf
              @method('PUT')
              <div class="field">
                <label>Card title</label>
                <input type="text" name="name" value="{{ old('name', $page->name) }}" required maxlength="160">
              </div>
              <div class="field">
                <label>Small label</label>
                <input type="text" name="listing_tag" value="{{ old('listing_tag', $listingTag ?? '') }}" maxlength="40" placeholder="Leave blank if this card has no label">
              </div>
              <div class="field">
                <label>Card description</label>
                <textarea name="listing_blurb" rows="3" maxlength="320">{{ old('listing_blurb', $listingBlurb ?? '') }}</textarea>
              </div>
              <button class="btn" type="submit">Save services card</button>
            </form>
          </div>
        @else
          @include('admin.service-pages.partials.section-form', array_merge($panel['editor'], [
            'allowDelete' => false,
            'showMeta' => false,
            'showPhoto' => $panel['showPhoto'],
            'showStructured' => $panel['showStructured'],
            'partialData' => $panel['partial'],
            'contentFields' => $panel['fields'],
            'mediaFields' => $panel['mediaFields'] ?? [],
            'formTitle' => $panel['label'],
            'returnPart' => $panel['id'],
            'shortLabels' => $panel['shortLabels'] ?? false,
          ]))
        @endif
      @endforeach

      <div class="svc-edit-foot">
        <form method="post" action="{{ route('admin.service-pages.toggle', $page) }}">
          @csrf
          <button class="btn btn-ghost" type="submit">Status: {{ $page->is_active ? 'Active' : 'Inactive' }}</button>
        </form>
        <a class="btn btn-ghost" href="{{ route('admin.service-pages.index') }}">All services</a>
      </div>
    </div>
  </div>
@endif
@endsection
