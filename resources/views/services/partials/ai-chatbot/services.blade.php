@php $d = $s['services'] ?? []; @endphp
<section class="sec-ink" id="services">
  <div class="wrap">
    <div class="sec-head">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h2>
      @if(!empty($d['lede']))<p>{{ $d['lede'] }}</p>@endif
    </div>
    <div class="svc-grid">
      @foreach($d['cards'] ?? [] as $card)
        <article class="svc">
          <div class="svc-ico" aria-hidden="true">@include('services.partials.ai-chatbot.icon', ['key' => $card['icon_key'] ?? 'message'])</div>
          <div class="svc-badge" aria-hidden="true">✓</div>
          <h3>{{ $card['title'] ?? '' }}</h3>
          <p>@if(!empty($card['body_html'])){!! $card['body_html'] !!}@else{{ $card['body'] ?? '' }}@endif</p>
          @if(!empty($card['link_text']))
            <a href="{{ $card['link_url'] ?: '#contact' }}" class="tlink">{{ $card['link_text'] }} <span class="arw">→</span></a>
          @endif
        </article>
      @endforeach
    </div>
  </div>
</section>
