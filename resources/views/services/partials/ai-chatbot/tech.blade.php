@php $d = $s['tech'] ?? []; @endphp
<section id="tech">
  <div class="wrap">
    <div class="tech-grid">
      <div class="tech-head">
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
        @if(!empty($d['lede']))<p class="tech-lede">{{ $d['lede'] }}</p>@endif
        <div class="tech-list">
          @foreach($d['items'] ?? [] as $item)
            <div class="tech-item">
              <span class="tech-check" aria-hidden="true">✓</span>
              <div><b>{{ $item['title'] ?? '' }}</b><p>{{ $item['body'] ?? '' }}</p></div>
            </div>
          @endforeach
        </div>
      </div>
      <div>
        <div class="chips">
          @foreach($d['chips'] ?? [] as $chip)
            <span class="chip"><span class="d"></span>{{ $chip }}</span>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
