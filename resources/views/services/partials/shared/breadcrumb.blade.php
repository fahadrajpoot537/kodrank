@php
  $raw = $crumbs ?? ($items ?? null);
  $normalize = static function ($crumb): array {
      $label = trim((string) ($crumb['label'] ?? $crumb['title'] ?? $crumb['name'] ?? ''));
      $url = trim((string) ($crumb['url'] ?? $crumb['href'] ?? $crumb['link'] ?? ''));

      return ['label' => $label, 'url' => $url];
  };

  $crumbs = [];
  if (is_array($raw) && count($raw) > 0) {
      foreach ($raw as $crumb) {
          if (! is_array($crumb)) {
              continue;
          }
          $n = $normalize($crumb);
          if ($n['label'] !== '') {
              $crumbs[] = $n;
          }
      }
  }

  // Always ensure Home › Services › [optional parent] › Current page
  if (count($crumbs) < 2) {
      $crumbs = [
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Services', 'url' => route('services.index')],
      ];
      $parent = $page->parent ?? null;
      if ($parent) {
          $crumbs[] = [
              'label' => $parent->name,
              'url' => url('/'.$parent->slug),
          ];
      }
      $crumbs[] = [
          'label' => $page->name ?? 'Services',
          'url' => '',
      ];
  } else {
      // Normalize Home / Services links even when CMS supplied crumbs
      foreach ($crumbs as $i => $crumb) {
          $labelLower = strtolower($crumb['label']);
          if ($labelLower === 'home') {
              $crumbs[$i]['url'] = route('home');
          }
          if ($labelLower === 'services') {
              $crumbs[$i]['url'] = route('services.index');
          }
      }
      // Last crumb is always the current page (no link)
      $last = count($crumbs) - 1;
      $crumbs[$last]['url'] = '';
      if (($crumbs[$last]['label'] ?? '') === '' && ! empty($page->name)) {
          $crumbs[$last]['label'] = $page->name;
      }
  }

  $navClass = $navClass ?? 'breadcrumb';
@endphp
<nav class="{{ $navClass }}" aria-label="Breadcrumb">
  <ol>
    @foreach($crumbs as $i => $crumb)
      @php
        $isLast = $i === count($crumbs) - 1;
        $label = $crumb['label'];
        $url = $crumb['url'];
      @endphp
      <li @if($isLast) aria-current="page" @endif>
        @if(! $isLast && $url !== '')
          <a href="{{ $url }}">{{ $label }}</a>
        @else
          <span>{{ $label }}</span>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
