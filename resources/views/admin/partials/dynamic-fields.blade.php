@php
  if (! function_exists('admin_render_fields_v2')) {
      function admin_blank_from_sample(mixed $sample): mixed
      {
          if (! is_array($sample)) {
              return '';
          }
          $isList = $sample === [] || array_keys($sample) === range(0, count($sample) - 1);
          if ($isList) {
              return [admin_blank_from_sample($sample[0] ?? '')];
          }
          $blank = [];
          foreach ($sample as $k => $v) {
              $blank[$k] = is_array($v) ? admin_blank_from_sample($v) : '';
          }

          return $blank;
      }

      function admin_is_image_field_key(string $key): bool
      {
          $k = strtolower($key);
          if (str_ends_with($k, '_alt') || str_ends_with($k, '_position') || str_ends_with($k, '_note') || str_contains($k, 'aria')) {
              return false;
          }

          return (bool) preg_match('/(^|_)(image|photo|poster|logo|background_image|og_image|hero_image)(_|$)/', $k)
              || in_array($k, ['image', 'photo', 'background_image', 'og_image'], true);
      }

      function admin_image_public_url(?string $path): ?string
      {
          $path = trim((string) $path);
          if ($path === '') {
              return null;
          }
          if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
              return $path;
          }

          return asset(ltrim($path, '/'));
      }

      function admin_upload_input_name(string $dataNameBase): string
      {
          // data[members][0][image] → uploads[members][0][image]
          if (str_starts_with($dataNameBase, 'data')) {
              return 'uploads'.substr($dataNameBase, 4);
          }

          return 'uploads['.$dataNameBase.']';
      }

      function admin_render_fields_v2($data, $prefix = 'data'): string
      {
          $html = '';
          foreach ($data as $key => $value) {
              $nameBase = $prefix.'['.$key.']';
              $label = ucwords(str_replace('_', ' ', (string) $key));

              if (is_array($value)) {
                  $isList = $value === [] || array_keys($value) === range(0, count($value) - 1);
                  if ($isList) {
                      $sample = $value[0] ?? '';
                      $blank = admin_blank_from_sample(is_array($sample) ? $sample : '');
                      $templateHtml = '';
                      if (is_array($blank) && (array_keys($blank) !== range(0, max(count($blank) - 1, 0)))) {
                          $templateHtml = admin_render_fields_v2($blank, $nameBase.'[__INDEX__]');
                      } else {
                          $templateHtml = '<div class="field"><label>Item</label><input type="text" name="'.$nameBase.'[__INDEX__]" value=""></div>';
                      }

                      $html .= '<div class="rep-block js-repeater" data-prefix="'.e($nameBase).'">';
                      $html .= '<div class="rep-head"><div class="rep-title">'.e($label).'</div>';
                      $html .= '<button type="button" class="btn btn-ghost btn-xs js-add-item">+ Add item</button></div>';
                      $html .= '<div class="js-repeater-items">';

                      if (count($value) === 0) {
                          $html .= '<p class="rep-empty">No items yet. Click “Add item”.</p>';
                      }

                      foreach ($value as $i => $item) {
                          $html .= '<div class="rep-block rep-item" style="background:#fff" data-index="'.$i.'">';
                          $html .= '<div class="rep-head"><div class="rep-title">#'.($i + 1).'</div>';
                          $html .= '<button type="button" class="btn-link-danger js-remove-item">Remove</button></div>';
                          if (is_array($item)) {
                              $html .= admin_render_fields_v2($item, $nameBase.'['.$i.']');
                          } else {
                              $html .= '<div class="field"><label>'.e($label).' item</label><input type="text" name="'.$nameBase.'['.$i.']" value="'.e((string) $item).'"></div>';
                          }
                          $html .= '</div>';
                      }

                      $html .= '</div>';
                      $html .= '<template class="js-item-template">';
                      $html .= '<div class="rep-block rep-item" style="background:#fff" data-index="__INDEX__">';
                      $html .= '<div class="rep-head"><div class="rep-title">#__NUM__</div>';
                      $html .= '<button type="button" class="btn-link-danger js-remove-item">Remove</button></div>';
                      $html .= $templateHtml;
                      $html .= '</div></template>';
                      $html .= '</div>';
                  } else {
                      $html .= '<div class="rep-block"><div class="rep-title">'.e($label).'</div>';
                      $html .= admin_render_fields_v2($value, $nameBase);
                      $html .= '</div>';
                  }
              } else {
                  $isImage = admin_is_image_field_key((string) $key);
                  $isLong = is_string($value) && (strlen($value) > 120 || str_contains($value, "\n") || str_contains((string) $value, '<'));
                  $html .= '<div class="field'.($isImage ? ' field-image' : '').'"><label>'.e($label).'</label>';

                  if ($isImage) {
                      $url = admin_image_public_url((string) $value);
                      $uploadName = admin_upload_input_name($nameBase);
                      if ($url) {
                          $html .= '<div class="admin-img-preview" style="margin:0 0 10px">';
                          $html .= '<img src="'.e($url).'" alt="" style="width:120px;height:120px;object-fit:cover;object-position:center top;border-radius:10px;border:1px solid #E1E9E5;background:#F1F5F3" loading="lazy">';
                          $html .= '</div>';
                      }
                      $html .= '<input type="text" name="'.e($nameBase).'" value="'.e((string) $value).'" placeholder="media/about/photo.jpg or storage/...">';
                      $html .= '<label class="admin-hint" style="display:block;margin:8px 0 4px">Or upload a new image</label>';
                      $html .= '<input type="file" name="'.e($uploadName).'" accept="image/jpeg,image/png,image/webp,image/gif">';
                      $html .= '<p class="admin-hint">Upload replaces the path above after Save. Max 5MB.</p>';
                  } elseif ($isLong) {
                      $html .= '<textarea name="'.e($nameBase).'" rows="4">'.e((string) $value).'</textarea>';
                  } else {
                      $html .= '<input type="text" name="'.e($nameBase).'" value="'.e((string) $value).'">';
                  }
                  $html .= '</div>';
              }
          }

          return $html;
      }
  }
@endphp

{!! admin_render_fields_v2($fieldsData ?? [], $fieldsPrefix ?? 'data') !!}
