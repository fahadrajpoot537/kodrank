@php
  $pad = 12 + ($depth * 22);
  $type = $depth === 0 ? 'Main' : ($depth === 1 ? 'Sub' : 'Sub · '.$depth);
  $theme = $page->seo['theme'] ?? '—';
@endphp
<tr>
  <td style="padding-left:{{ $pad }}px">
    @if($depth > 0)<span style="color:#9fb3bb;margin-right:6px">↳</span>@endif
    <strong>{{ $page->name }}</strong>
    <div style="margin-top:4px;font-size:.8rem;color:#4B5B62">
      Theme: <code>{{ $theme }}</code>
      · {{ $page->sections?->count() ?? 0 }} sections
    </div>
  </td>
  <td><span class="badge">{{ $type }}</span></td>
  <td><code>{{ $page->slug }}</code></td>
  <td>{{ $page->is_active ? 'Active' : 'Inactive' }}</td>
  <td>
    <div class="row-actions">
      <a class="btn" href="{{ route('admin.service-pages.content', $page) }}">Edit content</a>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.seo', $page) }}">SEO</a>
      <a class="btn btn-ghost" href="{{ url('/'.$page->slug) }}" target="_blank" rel="noopener">Preview</a>
      <a class="btn btn-ghost" href="{{ route('admin.service-pages.create', ['parent' => $page->id]) }}">+ Sub</a>
      <form method="post" action="{{ route('admin.service-pages.destroy', $page) }}" onsubmit="return confirm('Delete this service? Children will become top-level.');">
        @csrf
        @method('DELETE')
        <button class="btn-link-danger" type="submit">Delete</button>
      </form>
    </div>
  </td>
</tr>
@foreach($page->childrenRecursive as $child)
  @include('admin.service-pages.partials.tree-row', ['page' => $child, 'depth' => $depth + 1])
@endforeach
