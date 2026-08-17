@php $d = $s['faq'] ?? []; @endphp
<section class="section sec-mist" id="faq">
  <div class="wrap">
    <div class="sec-head" style="text-align:center;margin-left:auto;margin-right:auto">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>{{ $d['title'] ?? '' }}</h2>
    </div>
    <div class="faq">
      @foreach($d['items'] ?? [] as $i => $item)
        <details class="qa" @if($i === 0) open @endif>
          <summary>{{ $item['q'] ?? '' }}<span class="tog"></span></summary>
          <div class="ans">{{ $item['a'] ?? '' }}</div>
        </details>
      @endforeach
    </div>
  </div>
</section>
