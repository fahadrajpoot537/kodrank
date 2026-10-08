@if($posts->hasPages())
<nav class="blog-pagination" aria-label="Blog pages">
  @if($posts->onFirstPage())
    <span class="is-disabled">Prev</span>
  @else
    <a href="{{ $posts->previousPageUrl() }}" rel="prev">Prev</a>
  @endif

  @php
    $current = $posts->currentPage();
    $last = $posts->lastPage();
    $start = max(1, $current - 2);
    $end = min($last, $current + 2);
  @endphp

  @if($start > 1)
    <a href="{{ $posts->url(1) }}">1</a>
    @if($start > 2)
      <span class="is-gap" aria-hidden="true">…</span>
    @endif
  @endif

  @for($page = $start; $page <= $end; $page++)
    @if($page === $current)
      <span class="is-current" aria-current="page">{{ $page }}</span>
    @else
      <a href="{{ $posts->url($page) }}">{{ $page }}</a>
    @endif
  @endfor

  @if($end < $last)
    @if($end < $last - 1)
      <span class="is-gap" aria-hidden="true">…</span>
    @endif
    <a href="{{ $posts->url($last) }}">{{ $last }}</a>
  @endif

  @if($posts->hasMorePages())
    <a href="{{ $posts->nextPageUrl() }}" rel="next">Next</a>
  @else
    <span class="is-disabled">Next</span>
  @endif
</nav>
@endif
