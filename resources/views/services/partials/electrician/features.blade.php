@php
  $d = $s['features'] ?? [];
  $cards = $d['cards'] ?? [];
  if (empty($cards)) {
      $cards = [
          ['title' => 'Local Keyword Targeting', 'body' => 'We research what your customers actually type — "emergency electrician near me," "EV charger install" — and build pages around it.'],
          ['title' => 'Schema & Map Pack Signals', 'body' => 'Structured data for your hours, service areas, and reviews helps Google surface you in the local pack and rich results.'],
          ['title' => 'Mobile-First Indexing', 'body' => 'Google ranks the mobile version first. So do we — every page is optimized for the phone before the desktop.'],
          ['title' => 'Conversion Rate Optimization', 'body' => 'Strategic CTA placement and layout tuning turn the traffic you rank for into booked, billable jobs.'],
      ];
  }
  if (empty($d['eyebrow']) && empty($d['title_html']) && empty($d['title'])) {
      $d['eyebrow'] = 'Found First, Not Buried';
      $d['title_html'] = "An Electrician Website Design That's Wired to Rank Locally";
      $d['lede'] = "A beautiful site nobody can find is worthless. SEO isn't an afterthought in our process — it's the foundation. We build your site so Google reads it as the authority when someone nearby loses power.";
  }
  $arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
  $check = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
@endphp
<section class="sec-mist elec-seo" id="seo">
  <div class="wrap seo-grid">
    <div class="rv">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? '' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
      <a href="#contact" class="tlink" style="margin-top:26px">Talk Local SEO {!! $arrow !!}</a>
    </div>
    <div class="seo-pillars rv">
      @foreach($cards as $card)
        <div class="pillar">
          <span class="chk">{!! $check !!}</span>
          <div>
            <h4>{{ $card['title'] ?? '' }}</h4>
            <p>{{ $card['body'] ?? $card['text'] ?? '' }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
