@php
  $d = $s['stack'] ?? [];
  $cards = $d['cards'] ?? [];
  $fallback = [
      ['title' => 'Frontend', 'pills' => ['React', 'Next.js', 'TypeScript', 'Tailwind', 'Vue']],
      ['title' => 'Backend', 'pills' => ['Node.js', 'Python', 'Go', 'Laravel', '.NET']],
      ['title' => 'Data & Cloud', 'pills' => ['PostgreSQL', 'AWS', 'GCP', 'Azure', 'Redis']],
      ['title' => 'Ops & Billing', 'pills' => ['Docker', 'Kubernetes', 'Stripe', 'CI/CD', 'Terraform']],
  ];
  if (empty($cards)) {
      $cards = $fallback;
  } else {
      $byTitle = [];
      foreach ($fallback as $fb) {
          $byTitle[strtolower($fb['title'])] = $fb['pills'];
      }
      foreach ($cards as &$card) {
          if (empty($card['pills'])) {
              $key = strtolower(trim((string) ($card['title'] ?? '')));
              $card['pills'] = $byTitle[$key] ?? [];
          }
      }
      unset($card);
  }
@endphp
<section class="sec sec-mist" id="stack">
  <div class="wrap">
    <div class="head-block rev">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>
        @if(!empty($d['title_html'])){!! $d['title_html'] !!}
        @else{{ $d['title'] ?? 'Proven tools, chosen for your product — not our habits' }}@endif
      </h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="stack-groups">
      @foreach($cards as $card)
        <div class="stack-card rev">
          <h4>{{ $card['title'] ?? '' }}</h4>
          <div class="pills">
            @foreach($card['pills'] ?? [] as $pill)
              <span class="pill">{{ is_array($pill) ? ($pill['text'] ?? '') : $pill }}</span>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
