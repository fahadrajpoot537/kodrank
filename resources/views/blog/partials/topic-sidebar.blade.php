@php
  /** @var string $catSlug */
  /** @var \Illuminate\Support\Collection<string,int>|array<string,int> $topics */
  $topics = $topics ?? collect();
@endphp
<aside class="cat-sidebar">
  <div class="cs-title">Browse By Topic</div>
  <ul>
    @forelse($topics as $label => $count)
      <li>
        <a href="{{ route('blog.index', ['category' => $catSlug, 'tag' => $label]) }}" class="{{ ($tag ?? '') === $label ? 'active' : '' }}">
          <span>{{ $label }}</span>
          <span class="n">{{ $count }}</span>
        </a>
      </li>
    @empty
      <li><span class="blog-empty">No topics yet</span></li>
    @endforelse
  </ul>
</aside>
