<div class="strip">
  <div class="wrap strip-in">
    @foreach($c['strip']['items'] ?? [] as $item)
      <span class="strip-item">{{ $item }}</span>
    @endforeach
  </div>
</div>
