@php
  $workShots = [
    'Northline Interiors' => <<<'SVG'
<svg viewBox="0 0 340 190" role="img" aria-label="E-commerce storefront mockup">
  <rect x="0" y="0" width="340" height="190" rx="10" fill="#fff" stroke="#E1E9E5"/>
  <rect x="0" y="0" width="340" height="26" rx="10" fill="#0A1A22"/><rect x="0" y="16" width="340" height="10" fill="#0A1A22"/>
  <circle cx="14" cy="13" r="3" fill="#3C6570"/><circle cx="24" cy="13" r="3" fill="#3C6570"/>
  <rect x="16" y="40" width="70" height="8" rx="4" fill="#F47A1F"/>
  <rect x="16" y="56" width="150" height="12" rx="4" fill="#0D2029" opacity=".85"/>
  <rect x="16" y="80" width="98" height="70" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="122" y="80" width="98" height="70" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="228" y="80" width="98" height="70" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <circle cx="65" cy="106" r="14" fill="#DCEDE2"/><circle cx="171" cy="106" r="14" fill="#DCEDE2"/><circle cx="277" cy="106" r="14" fill="#DCEDE2"/>
  <rect x="40" y="130" width="50" height="6" rx="3" fill="#C9D6D0"/><rect x="146" y="130" width="50" height="6" rx="3" fill="#C9D6D0"/><rect x="252" y="130" width="50" height="6" rx="3" fill="#C9D6D0"/>
  <rect x="16" y="164" width="60" height="14" rx="7" fill="#F47A1F"/>
</svg>
SVG,
    'Verta Analytics' => <<<'SVG'
<svg viewBox="0 0 340 190" role="img" aria-label="Analytics dashboard mockup">
  <rect x="0" y="0" width="340" height="190" rx="10" fill="#fff" stroke="#E1E9E5"/>
  <rect x="0" y="0" width="340" height="26" rx="10" fill="#0A1A22"/><rect x="0" y="16" width="340" height="10" fill="#0A1A22"/>
  <circle cx="14" cy="13" r="3" fill="#3C6570"/><circle cx="24" cy="13" r="3" fill="#3C6570"/>
  <rect x="16" y="40" width="88" height="46" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="26" y="52" width="34" height="7" rx="3.5" fill="#C9D6D0"/><rect x="26" y="66" width="52" height="11" rx="4" fill="#0D2029" opacity=".8"/>
  <rect x="112" y="40" width="88" height="46" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="122" y="52" width="34" height="7" rx="3.5" fill="#C9D6D0"/><rect x="122" y="66" width="44" height="11" rx="4" fill="#CD661A"/>
  <rect x="208" y="40" width="116" height="46" rx="8" fill="#0A1A22"/>
  <rect x="218" y="52" width="34" height="7" rx="3.5" fill="#3C6570"/><rect x="218" y="66" width="56" height="11" rx="4" fill="#F47A1F"/>
  <rect x="16" y="96" width="308" height="78" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <path d="M32 158 L74 150 L112 138 L152 140 L192 122 L232 116 L272 100 L308 88" stroke="#F47A1F" stroke-width="2.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
  <circle cx="308" cy="88" r="4" fill="#CD661A"/>
</svg>
SVG,
    'BrightPath Clinics' => <<<'SVG'
<svg viewBox="0 0 340 190" role="img" aria-label="Local search map pack mockup">
  <rect x="0" y="0" width="340" height="190" rx="10" fill="#fff" stroke="#E1E9E5"/>
  <rect x="0" y="0" width="340" height="26" rx="10" fill="#0A1A22"/><rect x="0" y="16" width="340" height="10" fill="#0A1A22"/>
  <circle cx="14" cy="13" r="3" fill="#3C6570"/><circle cx="24" cy="13" r="3" fill="#3C6570"/>
  <rect x="16" y="40" width="150" height="134" rx="8" fill="#EEF4F1" stroke="#E1E9E5"/>
  <path d="M16 92h150M16 132h150M60 40v134M112 40v134" stroke="#DDE7E2" stroke-width="1.4"/>
  <path d="M91 84a10 10 0 1 0-14 0l7 12 7-12Z" fill="#F47A1F"/><circle cx="84" cy="76" r="3.4" fill="#0A1A22"/>
  <rect x="178" y="40" width="146" height="38" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="190" y="52" width="60" height="7" rx="3.5" fill="#CD661A"/><rect x="190" y="64" width="96" height="6" rx="3" fill="#C9D6D0"/>
  <rect x="178" y="88" width="146" height="38" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="190" y="100" width="50" height="7" rx="3.5" fill="#C9D6D0"/><rect x="190" y="112" width="86" height="6" rx="3" fill="#DDE7E2"/>
  <rect x="178" y="136" width="146" height="38" rx="8" fill="#F1F5F3" stroke="#E1E9E5"/>
  <rect x="190" y="148" width="56" height="7" rx="3.5" fill="#C9D6D0"/><rect x="190" y="160" width="78" height="6" rx="3" fill="#DDE7E2"/>
</svg>
SVG,
  ];
  $workShotFallback = array_values($workShots);
@endphp
<section id="work">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['work']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['work']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{!! $c['work']['lede'] ?? '' !!}</p>
    </div>

    <div class="work mt-md">
      @foreach($c['work']['cases'] ?? [] as $i => $case)
        @php
          $title = $case['title'] ?? '';
          $shot = $workShots[$title] ?? ($workShotFallback[$i] ?? null);
          if ($shot && !empty($case['image_alt'])) {
              $shot = preg_replace('/aria-label="[^"]*"/', 'aria-label="'.e($case['image_alt']).'"', $shot, 1);
          }
        @endphp
        <article class="work-card rv">
          <div class="work-shot @if(!$shot) placeholder tone-{{ ($i % 3) + 1 }} @endif">
            @if($shot)
              {!! $shot !!}
            @endif
          </div>
          <div class="work-body">
            @if(!empty($case['tag']))
              <span class="work-tag">{{ $case['tag'] }}</span>
            @endif
            <h3>{{ $title }}</h3>
            <p>{{ $case['body'] ?? '' }}</p>
            <div class="work-metrics">
              <div>
                <b>{{ $case['metric1_value'] ?? '' }}</b>
                <span>{{ $case['metric1_label'] ?? '' }}</span>
              </div>
              <div>
                <b>{{ $case['metric2_value'] ?? '' }}</b>
                <span>{{ $case['metric2_label'] ?? '' }}</span>
              </div>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
