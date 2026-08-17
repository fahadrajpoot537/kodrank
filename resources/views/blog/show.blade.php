@extends('layouts.blog')

@section('content')
@php
  $avatar = $post->authorAvatarPath();
  $date = $post->formattedDate();
  $contentHtml = (string) $post->content_html;
  $shareUrlRaw = $post->canonical_url ?: url('/blogs/'.$post->slug);
  $shareUrl = urlencode($shareUrlRaw);
  $shareTitle = urlencode($post->title);
  $authorLinkedIn = $post->authorLinkedInUrl();
  $categoryFilter = $post->category?->slug;
  // Shared blog listing hero art only — never the post thumbnail.
  $heroBg = $settings['hero_background'] ?? 'media/blog/hero-background.jpg';

  $hasEmbeddedTags = str_contains($contentHtml, 'post-tags');
  $hasEmbeddedAuthor = str_contains($contentHtml, 'author-card');
  $hasEmbeddedCta = str_contains($contentHtml, 'cta-inline');
  $tags = array_filter(array_map('trim', explode(',', (string) $post->post_tags)));

  // TOC from h2 only; prefer existing theme ids; never dual-id
  $toc = [];
  $sectionIndex = 0;
  $contentHtml = preg_replace_callback(
      '/<h2(\s[^>]*)?>(.*?)<\/h2>/is',
      function ($m) use (&$toc, &$sectionIndex) {
          $attrs = $m[1] ?? '';
          $inner = $m[2];
          $labelInner = preg_replace('/<span[^>]*\bclass=["\'][^"\']*\bn\b[^"\']*["\'][^>]*>.*?<\/span>/is', '', $inner) ?? $inner;
          $label = trim(preg_replace('/\s+/', ' ', strip_tags($labelInner)));
          if ($label === '') {
              return $m[0];
          }

          $id = null;
          if (preg_match('/\bid\s*=\s*["\']([^"\']+)["\']/i', $attrs, $idMatch)) {
              $id = $idMatch[1];
              // Drop any extra id attributes that may have been injected earlier
              $attrs = preg_replace('/\s*\bid\s*=\s*["\'][^"\']*["\']/i', '', $attrs) ?? $attrs;
          } else {
              $sectionIndex++;
              $id = 'section-'.$sectionIndex;
          }

          $toc[] = [
              'id' => $id,
              'text' => $label,
          ];

          return '<h2'.rtrim($attrs).' id="'.e($id).'">'.$inner.'</h2>';
      },
      $contentHtml
  ) ?? $contentHtml;

  // Theme-style title highlight (e.g. "best pages.")
  $heroTitleHtml = e($post->title);
  if (preg_match('/^(.*?\b)(best pages\.)$/iu', $post->title, $tm)) {
      $heroTitleHtml = e($tm[1]).'<span class="hl">'.e($tm[2]).'</span>';
  }
@endphp

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $post->title,
    'description' => $post->excerpt,
    'image' => $post->og_image ?: $post->featured_image,
    'datePublished' => optional($post->published_at)->toAtomString(),
    'dateModified' => optional($post->updated_at)->toAtomString(),
    'author' => [
        '@type' => 'Person',
        'name' => $post->author_name ?: 'KodRank',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'KodRank',
        'url' => url('/'),
    ],
    'mainEntityOfPage' => url('/blogs/'.$post->slug),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush

<article class="blog-article">
  <header class="hero-grad">
    <div class="hero-grad-bg" style="background-image:url('{{ asset(ltrim($heroBg, '/')) }}')"></div>
    <div class="hero-grad-overlay"></div>
    <div class="wrap hero-grad-inner">
      <nav class="breadcrumb breadcrumb-hero" aria-label="Breadcrumb">
        <ol>
          <li><a href="{{ route('home') }}">KodRank</a></li>
          <li><a href="{{ route('blog.index') }}">Blog</a></li>
          @if($post->category)
            <li><a href="{{ route('blog.index', ['category' => $categoryFilter]) }}">{{ $post->category->name }}</a></li>
          @endif
          <li aria-current="page">{{ \Illuminate\Support\Str::limit($post->title, 42) }}</li>
        </ol>
      </nav>

      <h1 class="hero-grad-title">{!! $heroTitleHtml !!}</h1>

      <div class="hero-grad-meta">
        @if($post->author_name)
          <span>Author: <a href="#author">{{ $post->author_name }}</a></span>
        @endif
        @if($post->read_minutes)
          <span class="meta-sep">|</span>
          <span>{{ $post->read_minutes }} min read</span>
        @endif
        @if($date !== '')
          <span class="meta-sep">|</span>
          <span>{{ $date }}</span>
        @endif
      </div>
    </div>
  </header>

  <div class="sec-paper">
    <div class="wrap share-under-hero">
      <span class="share-label">Share</span>
      <div class="share-row" aria-label="Share this article">
        <a class="share-btn" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.5 9v9M6.5 6.2v.1M11 18V9m0 4c0-2.8 6-3 6 0v5"/></svg></a>
        <a class="share-btn" href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener" aria-label="Share on X"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4l16 16M20 4L4 20"/></svg></a>
        <a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 8h-2a2 2 0 00-2 2v10M9 13h6"/></svg></a>
        <button type="button" class="share-btn" data-native-share data-share-url="{{ $shareUrlRaw }}" data-share-title="{{ $post->title }}" aria-label="Share on Instagram"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17" cy="7" r="1.1" fill="currentColor"/></svg></button>
        <a class="share-btn" href="mailto:?subject={{ $shareTitle }}&body={{ $shareUrl }}" aria-label="Share via email"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></a>
      </div>
    </div>
  </div>

  <section class="article-wrap sec-paper">
    <div class="wrap article-grid">
      <aside class="side-stack">
        @if($toc !== [])
          <nav class="toc" aria-label="Table of contents">
            <h4>On this page</h4>
            <ol>
              @foreach($toc as $i => $item)
                <li><a href="#{{ $item['id'] }}" @class(['active' => $i === 0])>{{ $item['text'] }}</a></li>
              @endforeach
            </ol>
          </nav>
        @endif

        <div class="side-cta">
          <div class="tile">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2l3 6 6 1-4.5 4.5 1 6.5L12 17l-5.5 3 1-6.5L3 9l6-1z"/></svg>
          </div>
          <h4>Not sure how your site performs in search?</h4>
          <p>We'll run a free 20-point SEO audit and send you a clear, prioritized breakdown — no strings attached.</p>
          <a href="{{ $post->inline_cta_url ?: '/contact' }}" class="btn btn-primary btn-sm" style="width:100%;justify-content:center">
            {{ $post->inline_cta_text ?: 'Get My Free Audit' }}
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
          </a>
        </div>

        <div class="side-share">
          <h4>Share</h4>
          <div class="share-row">
            <a class="share-btn" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.5 9v9M6.5 6.2v.1M11 18V9m0 4c0-2.8 6-3 6 0v5"/></svg></a>
            <a class="share-btn" href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener" aria-label="Share on X"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4l16 16M20 4L4 20"/></svg></a>
            <a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 8h-2a2 2 0 00-2 2v10M9 13h6"/></svg></a>
            <button type="button" class="share-btn" data-native-share data-share-url="{{ $shareUrlRaw }}" data-share-title="{{ $post->title }}" aria-label="Share on Instagram"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17" cy="7" r="1.1" fill="currentColor"/></svg></button>
            <button type="button" class="share-btn" data-copy-link="{{ $shareUrlRaw }}" aria-label="Copy link">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 13a5 5 0 007 0l3-3a5 5 0 00-7-7l-1 1"/><path d="M14 11a5 5 0 00-7 0l-3 3a5 5 0 007 7l1-1"/></svg>
            </button>
          </div>
        </div>
      </aside>

      <article class="content">
        @if($contentHtml !== '')
          {!! $contentHtml !!}
        @else
          @foreach(preg_split("/\n\s*\n/", (string) $post->body) as $para)
            @if(trim($para) !== '')
              <p>{{ trim($para) }}</p>
            @endif
          @endforeach
        @endif

        @if(! $hasEmbeddedCta && ($post->inline_cta_title || $post->inline_cta_body))
          <div class="cta-inline">
            <div>
              <h3>{{ $post->inline_cta_title ?: 'Want us to run this audit on your site?' }}</h3>
              @if($post->inline_cta_body)<p>{{ $post->inline_cta_body }}</p>@endif
            </div>
            <div class="cta-side">
              <a class="btn btn-primary" href="{{ $post->inline_cta_url ?: '/contact' }}">
                {{ $post->inline_cta_text ?: 'Get a free audit' }}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>
        @endif

        @if(! $hasEmbeddedTags && $tags !== [])
          <div class="post-tags">
            @foreach($tags as $tag)<span class="tag">{{ $tag }}</span>@endforeach
          </div>
        @endif

        @if(! $hasEmbeddedAuthor && ($post->author_name || $post->author_bio))
          <div class="author-card" id="author">
            <div class="author-top">
              @if($avatar)
                <img src="{{ asset($avatar) }}" alt="{{ $post->author_name }}" class="author-avatar" style="object-fit:cover">
              @else
                <div class="author-avatar">{{ $post->authorInitials() }}</div>
              @endif
              <div class="author-id">
                <p class="author-eyebrow">— Written by</p>
                <div class="author-name-row">
                  <h3 class="author-name">{{ $post->author_name ?: 'KodRank' }}</h3>
                  @if($authorLinkedIn)
                    <div class="author-socials">
                      <a href="{{ $authorLinkedIn }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg viewBox="0 0 24 24"><path d="M6.5 9v9M6.5 6.2v.1M11 18V9m0 4c0-2.8 6-3 6 0v5"/></svg></a>
                    </div>
                  @endif
                </div>
                @if($post->author_role)<p class="author-role">{{ $post->author_role }}</p>@endif
              </div>
            </div>
            @if($post->author_bio)
              <div class="author-bio">{!! $post->author_bio !!}</div>
            @endif
          </div>
        @endif
      </article>
    </div>
  </section>
</article>

@if($related->isNotEmpty())
<section class="sec-mist">
  <div class="wrap">
    <div class="section-head" style="max-width:700px;margin-bottom:36px">
      <p class="eyebrow">Keep reading</p>
      <h2>@if($post->category)More from {{ $post->category->name }}.@else Related articles.@endif</h2>
    </div>
    <div class="related-grid">
      @foreach($related as $relatedPost)
        @include('blog.partials.related-card', ['post' => $relatedPost])
      @endforeach
    </div>
  </div>
</section>
@endif

<section class="sec-ink" id="news">
  <div class="wrap news-box">
    <div class="news-copy">
      <p class="eyebrow">{{ $settings['newsletter_eyebrow'] ?? 'Straight to your inbox' }}</p>
      <h2>{!! $settings['newsletter_title_html'] ?? e($settings['newsletter_title'] ?? 'One technical SEO breakdown, every other week.') !!}</h2>
      <p style="margin-top:12px">{{ $settings['newsletter_copy'] ?? 'No fluff, no “10 tips” listicles — just the audits, log-file findings, and fixes our team is running right now.' }}</p>
      @if(session('newsletter_success'))
        <p class="newsletter-status" role="status">{{ session('newsletter_success') }}</p>
      @endif
    </div>
    <form class="news-form" method="post" action="{{ route('newsletter.store') }}">
      @csrf
      <input type="hidden" name="redirect_to" value="{{ url('/blogs/'.$post->slug) }}#news">
      <input type="hidden" name="fax_number" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ $settings['newsletter_placeholder'] ?? 'you@company.com' }}" required aria-label="Email address">
      <button type="submit" class="btn btn-primary">
        Subscribe
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
      </button>
    </form>
  </div>
</section>

@push('scripts')
<script>
(() => {
  // Legacy deep-link from earlier section-N ids → theme anchors
  const legacy = { 'section-1': 'what-is', 'section-2': 'signs', 'section-3': 'audit', 'section-4': 'fixes', 'section-5': 'monitor', 'section-6': 'faq' };
  const hash = (location.hash || '').slice(1);
  if (legacy[hash]) {
    history.replaceState(null, '', '#' + legacy[hash]);
  }

  const copy = async (url) => {
    try {
      await navigator.clipboard.writeText(url);
      return true;
    } catch (e) {
      return false;
    }
  };

  document.querySelectorAll('[data-copy-link]').forEach((btn) => {
    btn.addEventListener('click', async () => {
      const copied = await copy(btn.getAttribute('data-copy-link'));
      if (copied) {
        btn.setAttribute('aria-label', 'Link copied');
      }
    });
  });

  document.querySelectorAll('[data-native-share]').forEach((btn) => {
    btn.addEventListener('click', async () => {
      const url = btn.getAttribute('data-share-url');
      const title = btn.getAttribute('data-share-title');
      try {
        if (navigator.share) {
          await navigator.share({ title, url });
          return;
        }
        await copy(url);
        btn.setAttribute('aria-label', 'Link copied — paste it into Instagram');
      } catch (e) {
        // Share cancellation is expected; do not show an error.
      }
    });
  });

  const links = Array.from(document.querySelectorAll('.toc a[href^="#"]'));
  const sections = links
    .map((a) => document.getElementById(a.getAttribute('href').slice(1)))
    .filter(Boolean);

  if (!links.length || !sections.length || !('IntersectionObserver' in window)) return;

  const setActive = (id) => {
    links.forEach((a) => a.classList.toggle('active', a.getAttribute('href') === '#' + id));
  };

  const io = new IntersectionObserver((entries) => {
    const visible = entries
      .filter((e) => e.isIntersecting)
      .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
    if (visible?.target?.id) setActive(visible.target.id);
  }, { rootMargin: '-20% 0px -55% 0px', threshold: [0.1, 0.4, 0.7] });

  sections.forEach((s) => io.observe(s));
})();
</script>
@endpush
@endsection
