@php
  /** @var \App\Models\BlogPost $post */
  $date = $post->formattedDate();
@endphp
<a href="{{ route('blog.show', $post->slug) }}" class="rel-card">
  <div class="rel-shot">
    @if($post->featured_image)
      <img src="{{ asset(ltrim($post->featured_image, '/')) }}" alt="{{ $post->featured_image_alt ?: $post->title }}" loading="lazy">
    @else
      <svg viewBox="0 0 400 250" aria-hidden="true"><rect width="400" height="250" fill="#0A1A22"/><path d="M0 180 L100 120 L200 150 L300 90 L400 130 L400 250 L0 250 Z" fill="#163B44"/><circle cx="100" cy="120" r="5" fill="#F47A1F"/><circle cx="300" cy="90" r="5" fill="#F47A1F"/></svg>
    @endif
  </div>
  <div class="rel-body">
    @if($post->tag_label || $post->category)
      <p class="rel-cat">{{ $post->tag_label ?: $post->category?->name }}</p>
    @endif
    <h4>{{ $post->title }}</h4>
    @if($post->excerpt)
      <p>{{ \Illuminate\Support\Str::limit($post->excerpt, 110) }}</p>
    @endif
    <div class="rel-meta">
      @if($post->author_name)<span>{{ $post->author_name }}</span>@endif
      @if($post->read_minutes)<span>· {{ $post->read_minutes }} min read</span>@endif
    </div>
  </div>
</a>
