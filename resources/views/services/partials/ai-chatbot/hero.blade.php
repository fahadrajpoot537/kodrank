@php $d = $s['hero'] ?? []; $chat = $d['chat'] ?? []; @endphp
<section class="hero" aria-label="{{ $page->name ?? 'Service' }} hero">
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-copy">
        @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h1>@if(!empty($d['title_html'])){!! $d['title_html'] !!}@else{{ $d['title'] ?? '' }}@endif</h1>
        @if(!empty($d['lede_html']) || !empty($d['lede']))
          <p class="hero-lede">@if(!empty($d['lede_html'])){!! $d['lede_html'] !!}@else{{ $d['lede'] }}@endif</p>
        @endif
        @if(!empty($d['cta_text']))
          <div class="hero-actions">
            <a href="{{ $d['cta_url'] ?: '#contact' }}" class="btn btn-primary">{{ $d['cta_text'] }} <span class="arw">→</span></a>
          </div>
        @endif
        @if(!empty($d['trust']))
          <div class="hero-trust">
            @foreach($d['trust'] as $item)
              <div class="ht"><b>{{ $item['value'] ?? '' }}</b><span>{{ $item['label'] ?? '' }}</span></div>
            @endforeach
          </div>
        @endif
      </div>

      @if(!empty($chat))
        <div class="chat" aria-hidden="true">
          <div class="chat-top">
            <span class="chat-av">{{ $chat['avatar'] ?? 'K' }}</span>
            <div><b>{{ $chat['title'] ?? '' }}</b><small>{{ $chat['subtitle'] ?? '' }}</small></div>
            <span class="dot-on"></span>
          </div>
          <div class="msgs" id="acMsgs">
            @foreach($chat['messages'] ?? [] as $msg)
              <div class="msg {{ ($msg['role'] ?? 'b') === 'u' ? 'u' : 'b' }}">
                {{ $msg['text'] ?? '' }}@if(!empty($msg['pill']))<span class="pill">{{ $msg['pill'] }}</span>@endif
              </div>
            @endforeach
          </div>
          <div class="chat-in"><span>{{ $chat['input_placeholder'] ?? 'Ask anything…' }}</span><b>↑</b></div>
        </div>
      @endif
    </div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  var msgs = document.getElementById('acMsgs');
  if (!msgs) return;
  Array.prototype.slice.call(msgs.children).forEach(function(node, i){
    node.style.opacity = 0;
    node.style.transform = 'translateY(8px)';
    node.style.transition = '.4s ease';
    setTimeout(function(){ node.style.opacity = 1; node.style.transform = 'none'; }, 350 + i * 650);
  });
})();
</script>
@endpush
