@php
  $showMeta = $showMeta ?? true;
  $showStructured = $showStructured ?? true;
  $showPhotoBlock = $showPhoto ?? true;
  $formTitle = $formTitle ?? $section->label;
  $returnPart = $returnPart ?? '';
  $partialData = $partialData ?? false;
  $shortLabels = $shortLabels ?? false;
@endphp
<div class="admin-card" id="section-{{ $section->key }}" style="margin-bottom:18px">
  <h2 class="admin-h1" style="font-size:1.15rem;margin-bottom:4px">{{ $formTitle }}</h2>
  <p class="admin-hint" style="margin-top:0">Edit this section, then save. The rest of the page stays as it is.</p>
  <form method="post" action="{{ route('admin.service-pages.sections.update', [$page, $section->key]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if($returnPart !== '')
      <input type="hidden" name="return_part" value="{{ $returnPart }}">
    @endif
    @if($partialData)
      <input type="hidden" name="partial_data" value="1">
    @endif

    @if($showMeta)
    <div class="grid2">
      <div class="field">
        <label>Section name</label>
        <input type="text" name="label" value="{{ old('label', $section->label) }}">
      </div>
      <div class="field">
        <label>Sort order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" min="0" max="999">
      </div>
    </div>
    @endif

    @php
      $sectionFields = is_array($section->data) ? $section->data : [];
      $photoFields = [];
      if (\App\Support\ServiceSectionPhoto::ownsField($page->slug, $section->key)) {
          foreach (\App\Support\ServiceSectionPhoto::fieldKeys($page->slug) as $photoKey) {
              if (array_key_exists($photoKey, $sectionFields) && ! is_array($sectionFields[$photoKey])) {
                  $photoFields[$photoKey] = $sectionFields[$photoKey];
                  unset($sectionFields[$photoKey]);
              }
          }
      }
    @endphp
    @if($showPhotoBlock && $photoFields !== [])
      @if($page->slug === 'web-design-and-development-services')
        <p class="admin-hint">Included section photo is the background on “Included in every package”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'shopify-development-services')
        <p class="admin-hint">Section photo is the background on “Why Shopify”. Upload a new image here, or leave the path blank to keep the current photo.</p>
      @elseif($page->slug === 'electrician-website-design-services')
        <p class="admin-hint">Section photo is the background on “Why KodRank”. Upload a new image here, or leave the path blank to keep that section a solid dark color. The “Found First, Not Buried” section stays solid dark.</p>
      @elseif($page->slug === 'website-redesign-services')
        <p class="admin-hint">Section photo is the background on “The numbers our redesigns move”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'cms-development-services')
        <p class="admin-hint">Section photo is the background on “The numbers”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'wordpress-development-services')
        <p class="admin-hint">Section photo is the background on “By the numbers”. Why WordPress photo is the background on “Why WordPress, built right”. Leave a path blank to keep that photo.</p>
      @else
        <p class="admin-hint">Section photo is the picture on this page’s dark image section. Leave the path blank to keep the current image.</p>
      @endif
      @include('admin.partials.dynamic-fields', ['fieldsData' => $photoFields, 'fieldsPrefix' => 'data'])
    @endif
    @if(!empty($contentFields))
      <input type="hidden" name="data[html_path]" value="{{ $themeHtmlPath }}">
      <input type="hidden" name="data[scope]" value="{{ $themeHtmlScope }}">
      <input type="hidden" name="data[html]" value="">
      @foreach($contentFields as $field)
        @php
          $fieldLabel = $field['label'];
          if ($shortLabels && str_contains($fieldLabel, ' · ')) {
              $fieldLabel = trim(substr($fieldLabel, strrpos($fieldLabel, ' · ') + strlen(' · ')));
          }
          if ($shortLabels) {
              $preview = trim(preg_replace('/\s+/u', ' ', (string) ($field['value'] ?? '')) ?? '');
              if ($preview !== '') {
                  if (mb_strlen($preview) > 48) {
                      $preview = rtrim(mb_substr($preview, 0, 45)).'…';
                  }
                  $fieldLabel .= ' — '.$preview;
              }
          }
        @endphp
        <div class="field">
          <label>{{ $fieldLabel }}</label>
          @if(($field['rows'] ?? 1) > 1)
            <textarea name="content_blocks[{{ $field['id'] }}]" rows="{{ (int) $field['rows'] }}">{{ $field['value'] }}</textarea>
          @else
            <input type="text" name="content_blocks[{{ $field['id'] }}]" value="{{ $field['value'] }}">
          @endif
        </div>
      @endforeach
    @endif

    @if($showStructured)
      @include('admin.partials.dynamic-fields', ['fieldsData' => $sectionFields ?? ($section->data ?? []), 'fieldsPrefix' => 'data'])
    @endif

    <div class="admin-actions">
      <button class="btn" type="submit">Save {{ $section->label }}</button>
      <a class="btn btn-ghost" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview page</a>
    </div>
  </form>

  @if(!empty($allowDelete))
    <form method="post" action="{{ route('admin.service-pages.sections.destroy', [$page, $section->key]) }}" class="danger-zone" onsubmit="return confirm('Delete this section permanently?');">
      @csrf
      @method('DELETE')
      <button class="btn-link-danger" type="submit">Delete section</button>
    </form>
  @endif
</div>
