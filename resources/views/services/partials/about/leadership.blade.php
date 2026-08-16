@php
  $l = $s['leadership'] ?? [];
  $bg = $l['background_image'] ?? 'media/about/kodrank-leadership-bg.jpg';
@endphp
<section id="leadership" class="sec-ink about-team-sec" style="--about-team-bg:url('{{ asset($bg) }}')">
  <div class="wrap">
    <div class="about-head-row">
      <div class="about-head">
        @if(!empty($l['eyebrow']))
          <span class="eyebrow">{{ $l['eyebrow'] }}</span>
        @endif
        <h2>
          @if(!empty($l['title_html']))
            {!! $l['title_html'] !!}
          @else
            {{ $l['title'] ?? '' }}
          @endif
        </h2>
      </div>
      @if(!empty($l['lede']))
        <p class="lede">{{ $l['lede'] }}</p>
      @endif
    </div>

    <div class="about-team-grid">
      @foreach($l['members'] ?? [] as $member)
        <article class="about-team-card">
          <div class="about-avatar{{ !empty($member['image']) ? ' has-photo' : ' is-placeholder' }}">
            @if(!empty($member['image']))
              <img src="{{ asset($member['image']) }}?v={{ @filemtime(public_path($member['image'])) ?: time() }}"
                   alt="{{ $member['name'] ?? '' }}"
                   width="480"
                   height="600"
                   loading="lazy"
                   decoding="async"
                   @if(!empty($member['image_position'])) style="object-position:{{ $member['image_position'] }}" @endif>
            @else
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true">
                <circle cx="12" cy="8" r="3.4"/>
                <path d="M4.5 20a7.5 7.5 0 0 1 15 0"/>
              </svg>
              @if(!empty($member['photo_note']))
                <span class="about-avatar-note">{{ $member['photo_note'] }}</span>
              @endif
            @endif
          </div>
          <div class="about-team-meta">
            <div>
              <h3>{{ $member['name'] ?? '' }}</h3>
              <div class="about-role-row">
                <span class="about-role">{{ $member['role'] ?? '' }}</span>
                @if(!empty($member['linkedin']))
                  <a href="{{ $member['linkedin'] }}"
                     class="about-li-link"
                     target="_blank"
                     rel="noopener"
                     aria-label="{{ ($member['name'] ?? 'Team member').' on LinkedIn' }}">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                      <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.15 1.45-2.15 2.94v5.67H9.34V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29ZM5.34 7.43a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13ZM7.12 20.45H3.56V9h3.56v11.45Z"/>
                    </svg>
                  </a>
                @endif
              </div>
            </div>
          </div>
          <p>{{ $member['bio'] ?? '' }}</p>
          @if(!empty($member['tags']))
            <div class="about-tags">
              @foreach($member['tags'] as $tag)
                <span>{{ $tag }}</span>
              @endforeach
            </div>
          @endif
        </article>
      @endforeach
    </div>
  </div>
</section>
