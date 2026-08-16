<section class="band">
  <div class="wrap band-in">
    <div class="rv">
      @if(!empty($c['band']['eyebrow']))
        <p class="eyebrow">{{ $c['band']['eyebrow'] }}</p>
      @endif
      <h2>{{ $c['band']['title'] ?? '' }}</h2>
      @if(!empty($c['band']['body']))
        <p>{{ $c['band']['body'] }}</p>
      @endif
      <div class="band-actions">
        @if(!empty($c['band']['cta_text']))
          <a class="btn btn-primary" href="{{ $c['band']['cta_url'] ?? '#contact' }}">{{ $c['band']['cta_text'] }}
            <svg viewBox="0 0 16 16" fill="none"><path d="M2 8h11m0 0-4.2-4.2M13 8l-4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        @endif
        @if(!empty($c['band']['secondary_cta_text']))
          <a class="btn btn-ghost-light" href="{{ $c['band']['secondary_cta_url'] ?? '#contact' }}">{{ $c['band']['secondary_cta_text'] }}</a>
        @endif
      </div>
    </div>
    @if(!empty($c['band']['items']))
      <ul class="band-list rv">
        @foreach($c['band']['items'] as $item)
          <li><b>{{ $item['num'] ?? '' }}</b><span>{{ $item['text'] ?? '' }}</span></li>
        @endforeach
      </ul>
    @endif
  </div>
</section>
