@php
  $crumbs = $crumbs ?? ($items ?? null);
  if (empty($crumbs) || !is_array($crumbs)) {
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
  }
  $navClass = $navClass ?? 'breadcrumb';
@endphp
<nav class="{{ $navClass }}" aria-label="Breadcrumb">
  <ol>
    @foreach($crumbs as $i => $crumb)
      @php
        $isLast = $i === count($crumbs) - 1;
        $label = trim((string) ($crumb['label'] ?? ''));
        $url = trim((string) ($crumb['url'] ?? ''));
        if ($label === 'Home') {
            $url = route('home');
        }
        if ($label === 'Services' && ($url === '' || $url === '#' || $url === '/services' || $url === '/services/')) {
            $url = route('services.index');
        }
      @endphp
      <li @if($isLast || $url === '') aria-current="page" @endif>
        @if(!$isLast && $url !== '')
          <a href="{{ $url }}">{{ $label }}</a>
        @else
          <span>{{ $label }}</span>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
