@php
  $sectionPhotoCss = \App\Support\ServiceSectionPhoto::css($page);
@endphp
@if($sectionPhotoCss !== '')
  <style>{!! $sectionPhotoCss !!}</style>
@endif
