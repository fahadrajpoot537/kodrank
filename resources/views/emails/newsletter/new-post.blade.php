@php
  $excerpt = trim(html_entity_decode(strip_tags((string) ($post->excerpt ?: $post->body)), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
  if (mb_strlen($excerpt) > 280) {
      $excerpt = rtrim(mb_substr($excerpt, 0, 277)).'…';
  }
  $postUrl = url('/blogs/'.$post->slug);
@endphp
@component('emails.layouts.kodrank', ['heading' => 'A new article is up.', 'title' => 'New KodRank article'])
  <p style="margin:0 0 16px;">You subscribed to KodRank insights. Here is the latest article.</p>
  <p style="margin:0 0 8px;font-size:20px;line-height:1.35;font-weight:700;color:#0A1A22;">{{ $post->title }}</p>
  @if($excerpt !== '')
    <p style="margin:0 0 20px;">{{ $excerpt }}</p>
  @endif
  <p style="margin:0 0 16px;">
    <a href="{{ $postUrl }}" style="color:#CD661A;font-weight:700;text-decoration:none;">Read the article</a>
  </p>
@endcomponent
