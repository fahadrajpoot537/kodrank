@php
  $body = $s['body'] ?? [];
  $hero = $s['hero'] ?? [];
  $title = trim((string) ($body['title'] ?? ''));
  if ($title === '') {
      $title = trim(html_entity_decode(strip_tags((string) ($hero['title_html'] ?? ($page->name ?? ''))), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
  }
  $html = (string) ($body['html'] ?? '');
@endphp
<article class="plain-doc">
  <div class="plain-doc-inner">
    <h1>{{ $title }}</h1>
    @if($html !== '')
      <div class="plain-doc-body">{!! $html !!}</div>
    @endif
  </div>
</article>
