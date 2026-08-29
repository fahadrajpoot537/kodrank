@extends('layouts.blog')

@section('content')
@php
  $heroBg = $settings['hero_background'] ?? 'media/blog/hero-background.jpg';
  $pillQuery = array_filter(['q' => $q !== '' ? $q : null]);
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => 'KodRank Blog',
    'url' => url('/blogs'),
    'description' => $settings['seo_description'] ?? '',
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'KodRank',
        'url' => url('/'),
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => url('/blogs')],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush

<header class="blog-hero" style="--blog-hero-bg:url('{{ asset(ltrim($heroBg, '/')) }}')">
  <div class="wrap">
    <h1 class="blog-title">{{ $settings['hero_title'] ?? 'The KodRank Blog' }}</h1>
    <p class="lede">{{ $settings['hero_lede'] ?? '' }}</p>

    <form class="blog-search" method="get" action="{{ route('blog.index') }}" role="search">
      @if($category !== 'all')
        <input type="hidden" name="category" value="{{ $category }}">
      @endif
      <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      <input type="search" name="q" value="{{ $q }}" placeholder="{{ $settings['search_placeholder'] ?? 'Search articles…' }}" aria-label="Search articles">
      <button type="submit" class="btn btn-primary btn-sm">Search</button>
    </form>

    <div class="cat-pills" role="navigation" aria-label="Blog categories">
      <a href="{{ route('blog.index', $pillQuery) }}" class="cat-pill{{ $category === 'all' ? ' active' : '' }}"@if($category === 'all') aria-current="page"@endif>All</a>
      @foreach($categories as $cat)
        @php
          $href = route('blog.index', array_merge($pillQuery, ['category' => $cat->slug]));
          $active = $category === $cat->slug;
        @endphp
        <a href="{{ $href }}" class="cat-pill{{ $active ? ' active' : '' }}"@if($active) aria-current="page"@endif>{{ $cat->name }}</a>
      @endforeach
    </div>
  </div>
</header>

@if($isFiltered)
<section class="sec-paper" id="results">
  <div class="wrap">
    <div class="section-head">
      <div class="htext">
        <span class="eyebrow">Filtered</span>
        <h2>{{ $filterLabel }}</h2>
        <p class="lede" style="margin-top:8px">{{ $filtered->count() }} {{ $filtered->count() === 1 ? 'article' : 'articles' }} found</p>
      </div>
      <a href="{{ route('blog.index') }}" class="tlink">Clear filters <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
    </div>

    <div class="blog-grid">
      @forelse($filtered as $i => $post)
        @include('blog.partials.card', ['post' => $post, 'featured' => $i === 0])
      @empty
        <p class="blog-empty">No articles match this filter. Try another category or clear search.</p>
      @endforelse
    </div>
  </div>
</section>
@else
<section class="sec-paper" id="latest">
  <div class="wrap">
    <div class="section-head">
      <div class="htext">
        <span class="eyebrow">Fresh This Month</span>
        <h2>Latest articles</h2>
      </div>
      <a href="{{ route('blog.index', ['category' => 'all']) }}" class="tlink">View All Posts <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
    </div>

    <div class="blog-grid">
      @forelse($latest as $i => $post)
        @include('blog.partials.card', ['post' => $post, 'featured' => $i === 0 && $post->is_featured])
      @empty
        <p>No articles yet. Check back soon.</p>
      @endforelse
    </div>
  </div>
</section>

@if($editorsPicks->isNotEmpty())
<section class="sec-mist" id="editors">
  <div class="wrap">
    <div class="section-head">
      <div class="htext">
        <span class="eyebrow">Start Here</span>
        <h2>Editor's picks — the cornerstone guides</h2>
      </div>
    </div>
    <div class="blog-grid cols-4">
      @foreach($editorsPicks as $post)
        @include('blog.partials.card', ['post' => $post, 'dark' => true])
      @endforeach
    </div>
  </div>
</section>
@endif

@foreach($categories as $cat)
  @php $posts = $byCategory[$cat->slug] ?? collect(); @endphp
  @if($posts->isNotEmpty())
  <section class="{{ $loop->even ? 'sec-ink' : 'sec-paper' }}" id="{{ $cat->slug }}">
    <div class="wrap">
      <div class="section-head">
        <div class="htext">
          <span class="eyebrow">Category</span>
          <h2>{{ $cat->name }}</h2>
        </div>
        <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="tlink">View all {{ $cat->name }} <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M13 5l7 7-7 7"/></svg></a>
      </div>
      <div class="cat-section-grid">
        @include('blog.partials.topic-sidebar', ['catSlug' => $cat->slug, 'topics' => $topicCounts[$cat->slug] ?? []])
        <div class="blog-grid cols-2">
          @foreach($posts as $post)
            @include('blog.partials.card', ['post' => $post])
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif
@endforeach
@endif

<section class="sec-ink" id="news">
  <div class="wrap">
    <div class="news-cta">
      <span class="eyebrow center">{{ $settings['newsletter_eyebrow'] ?? 'Stay Sharp' }}</span>
      <h2>{!! $settings['newsletter_title_html'] ?? e($settings['newsletter_title'] ?? '') !!}</h2>
      <p>{{ $settings['newsletter_copy'] ?? '' }}</p>
      @if(session('newsletter_success'))
        <p class="newsletter-status" role="status">{{ session('newsletter_success') }}</p>
      @endif
      <form class="newsletter-signup" method="post" action="{{ route('newsletter.store') }}">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ url('/blogs') }}#news">
        <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
        <div class="newsletter-form">
          <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ $settings['newsletter_placeholder'] ?? 'you@company.com' }}" required aria-label="Email address">
          <button type="submit" class="btn btn-primary btn-sm">
            Subscribe
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
          </button>
        </div>
        @include('partials.recaptcha', ['size' => 'compact'])
      </form>
      <div class="fine">{{ $settings['newsletter_fine'] ?? '' }}</div>
    </div>
  </div>
</section>
@endsection
