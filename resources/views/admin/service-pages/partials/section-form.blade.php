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
      @if($page->slug === 'ai-chatbot-development-services')
        <p class="admin-hint">Section photo is the background on “Good conversational AI pays for itself”. “Why KodRank” stays without a photo. Leave the path blank to keep the current stats photo.</p>
      @elseif($page->slug === 'web-design-and-development-services')
        <p class="admin-hint">Included section photo is the background on “Included in every package”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'shopify-development-services')
        <p class="admin-hint">Section photo is the background on “Why Shopify”. Upload a new image here, or leave the path blank to keep the current photo.</p>
      @elseif($page->slug === 'electrician-website-design-services')
        <p class="admin-hint">Section photo is the background on “Why KodRank”. Upload a new image here, or leave the path blank to keep that section a solid dark color. The “Found First, Not Buried” section stays solid dark.</p>
      @elseif($page->slug === 'website-redesign-services')
        <p class="admin-hint">Section photo is the background on “The numbers our redesigns move”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'real-estate-seo-services')
        <p class="admin-hint">Section photo is the background on “Rankings Are Nice. Leads Pay the Bills.” Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'restaurant-seo-services')
        <p class="admin-hint">Section photo is the background on the “What better rankings look like on the calendar” card. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'ecommerce-seo-services')
        <p class="admin-hint">Section photo is the background on “A web dev and SEO team under one roof”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'b2b-seo-services')
        <p class="admin-hint">Section photo is the background on “SEO that shows up on the revenue line”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'off-page-seo-services')
        <p class="admin-hint">Section photo is the background on “The numbers our clients care about”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'geo-services')
        <p class="admin-hint">Section photo is the background on “Search stopped being a list of blue links.” Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'aeo-services')
        <p class="admin-hint">Section photo is the background on “Old Playbook vs. New Playbook”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'cms-development-services')
        <p class="admin-hint">Section photo is the background on “The numbers”. Upload a new image here, or leave the path blank to keep the current photo. The dark color layer stays on top of the image.</p>
      @elseif($page->slug === 'wordpress-development-services')
        <p class="admin-hint">Section photo is the background on “By the numbers”. Why WordPress photo is the background on “Why WordPress, built right”. Leave a path blank to keep that photo.</p>
      @else
        <p class="admin-hint">Section photo is the picture on this page’s dark image section. Leave the path blank to keep the current image.</p>
      @endif
      @include('admin.partials.dynamic-fields', ['fieldsData' => $photoFields, 'fieldsPrefix' => 'data'])
    @endif
    @if(!empty($contentFields) || !empty($mediaFields))
      <input type="hidden" name="data[html_path]" value="{{ $themeHtmlPath }}">
      <input type="hidden" name="data[scope]" value="{{ $themeHtmlScope }}">
      <input type="hidden" name="data[html]" value="">
    @endif
    @if(!empty($contentFields))
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

    @if(!empty($mediaFields))
      <p class="admin-hint">Pictures in this section. Upload a file to replace one. Leave the file empty to keep the current picture. Backgrounds that live only in the stylesheet stay on Section photo.</p>
      @foreach($mediaFields as $media)
        <div class="field">
          <label>{{ $media['label'] }}</label>
          @if(!empty($media['embedded']))
            <p class="admin-hint">This picture is embedded in the page.</p>
          @elseif(!empty($media['src']))
            @php $mediaSrc = $media['src']; @endphp
            @if(!str_starts_with($mediaSrc, 'data:'))
              <div style="margin:8px 0"><img src="{{ str_starts_with($mediaSrc, 'http') || str_starts_with($mediaSrc, '/') ? $mediaSrc : asset(ltrim($mediaSrc, '/')) }}" alt="" style="max-width:220px;max-height:120px;object-fit:cover;border-radius:10px;border:1px solid #E1E9E5"></div>
            @endif
          @endif
          @if(($media['kind'] ?? 'image') === 'image')
            <label class="admin-hint" style="display:block;margin-bottom:4px">Alt text</label>
            <input type="text" name="theme_media_alt[{{ $media['id'] }}]" value="{{ $media['alt'] }}" maxlength="180">
          @endif
          <label class="admin-hint" style="display:block;margin:8px 0 4px">Replace image</label>
          <input type="file" name="theme_media[{{ $media['id'] }}]" accept="image/jpeg,image/png,image/webp,image/gif">
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
