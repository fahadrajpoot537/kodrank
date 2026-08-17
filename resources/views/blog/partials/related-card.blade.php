@php
  /** @var \App\Models\BlogPost $post */
  $avatar = $post->authorAvatarPath();
  $category = $post->tag_label ?: $post->category?->name;
@endphp
<article class="rel-card">
  <div class="rel-body">
    @if($category)
      <span class="rel-cat">{{ $category }}</span>
    @endif
    <h4>
      <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
    </h4>
    @if($post->excerpt)
      <p class="rel-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}</p>
    @endif
    <div class="rel-meta">
      @if($avatar)
        <img class="rel-avatar" src="{{ asset($avatar) }}" alt="{{ $post->author_name }}">
      @elseif($post->author_name)
        <span class="rel-avatar-fallback" aria-hidden="true">{{ $post->authorInitials() }}</span>
      @endif
      <div class="rel-meta-text">
        @if($post->author_name)<span class="rel-author">{{ $post->author_name }}</span>@endif
        @if($post->read_minutes)<span class="rel-read">{{ $post->read_minutes }} min read</span>@endif
      </div>
    </div>
    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-ghost-dark btn-sm rel-btn">
      Read article
      <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
</article>
