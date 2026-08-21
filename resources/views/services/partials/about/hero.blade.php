@php
  $h = $s['hero'] ?? [];
  $heroImg = $h['image'] ?? 'media/about/kodrank-hero-team.jpg';
@endphp
<section class="sec-ink hero about-hero" style="--about-hero-image:url('{{ asset($heroImg) }}')">
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-copy">
        @include('services.partials.shared.breadcrumb', ['crumbs' => $h['breadcrumb'] ?? null])
        <h1>
          @if(!empty($h['title_html']))
            {!! $h['title_html'] !!}
          @else
            {{ $h['title'] ?? '' }}
          @endif
        </h1>
      </div>
      <div class="hero-side">
        @if(!empty($h['lede_html']))
          <p class="lede">{!! $h['lede_html'] !!}</p>
        @elseif(!empty($h['lede']))
          <p class="lede">{{ $h['lede'] }}</p>
        @endif
      </div>
    </div>

    @if(!empty($h['stats']))
      <div class="about-stat-row">
        @foreach($h['stats'] as $stat)
          <div>
            <div class="about-stat-num">
              @if(!empty($stat['num_html']))
                {!! $stat['num_html'] !!}
              @elseif(!empty($stat['value']))
                <span class="u">{{ $stat['value'] }}</span>{{ $stat['suffix'] ?? '' }}
              @else
                {{ $stat['num'] ?? '' }}
              @endif
            </div>
            <div class="about-stat-label">{{ $stat['label'] ?? '' }}</div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
