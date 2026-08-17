@php $d = $s['faq'] ?? []; @endphp
<section class="sec-mist" id="faq">
  <div class="wrap">
    <div class="sec-head center">
      @if(!empty($d['eyebrow']))<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
      <h2 class="h">{{ $d['title'] ?? '' }}</h2>
      @if(!empty($d['lede']))<p class="lede">{{ $d['lede'] }}</p>@endif
    </div>
    <div class="faq-list" id="rdFaq">
      @foreach($d['items'] ?? [] as $item)
        <div class="faq">
          <button type="button" aria-expanded="false">{{ $item['q'] ?? '' }}<span class="tog"></span></button>
          <div class="faq-body"><p>{{ $item['a'] ?? '' }}</p></div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  var list = document.getElementById('rdFaq');
  if (!list) return;
  list.addEventListener('click', function(e){
    var btn = e.target.closest('.faq > button');
    if (!btn) return;
    var item = btn.parentElement;
    var body = item.querySelector('.faq-body');
    var isOpen = item.classList.toggle('open');
    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    body.style.maxHeight = isOpen ? body.scrollHeight + 'px' : null;
  });
})();
</script>
@endpush
