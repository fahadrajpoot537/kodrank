@php
  /** @var \App\Models\BlogPost $post */
  $avatar = $post->authorAvatarPath();
  $date = $post->formattedDate();
@endphp
<article class="blog-card{{ !empty($featured) ? ' blog-featured' : '' }}{{ !empty($dark) ? ' blog-card-dark' : '' }}">
  <div class="blog-thumb">
    @if($post->featured_image)
      <img src="{{ asset(ltrim($post->featured_image, '/')) }}" alt="{{ $post->featured_image_alt ?: $post->title }}" loading="lazy">
    @else
      <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
    @endif
  </div>
  <div class="blog-body">
    @if($post->tag_label)
      <span class="blog-tag">{{ $post->tag_label }}</span>
    @endif
    <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
    @if($post->excerpt)
      <p>{{ $post->excerpt }}</p>
    @endif
    <div class="blog-meta">
      @if($avatar)
        <img class="avatar-img" src="{{ asset($avatar) }}" alt="{{ $post->author_name }}">
      @else
        <div class="avatar-sm">{{ $post->authorInitials() }}</div>
      @endif
      @if($post->author_name)
        <span class="m-name">{{ $post->author_name }}</span>
      @endif
      @if($post->read_minutes)
        <span class="dot"></span>
        <span>{{ $post->read_minutes }} min read</span>
      @endif
      @if($date !== '')
        <span class="dot"></span>
        <span>{{ $date }}</span>
      @endif
    </div>
  </div>
</article>
