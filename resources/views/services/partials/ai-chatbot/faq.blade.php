@php $d = $s['faq'] ?? []; @endphp
<section id="faq">
  <div class="wrap">
    <div class="sec-head center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="faq">
      @foreach($d['items'] ?? [] as $item)
        <details class="qa" @if($loop->first) open @endif>
          <summary>{{ $item['q'] ?? '' }} <span class="tog" aria-hidden="true">+</span></summary>
          <div class="ans">{{ $item['a'] ?? '' }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>
