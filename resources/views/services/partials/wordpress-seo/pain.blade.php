@php
  $d = $s['pain'] ?? [];
  $aside = $d['aside'] ?? [];
  $introData = [
    'eyebrow' => $d['eyebrow'] ?? null,
    'title' => $d['title'] ?? '',
    'paragraphs_html' => $d['paragraphs_html'] ?? ($d['paragraphs'] ?? []),
    'card_value' => $aside['title'] ?? null,
    'card_label' => $aside['eyebrow'] ?? null,
    'card_rows' => $aside['items'] ?? [],
  ];
  $problemData = [
    'eyebrow' => $d['pain_eyebrow'] ?? null,
    'title' => $d['pain_title'] ?? '',
    'title_html' => $d['pain_title_html'] ?? null,
    'cards' => $d['cards'] ?? [],
  ];
@endphp
@include('services.partials.shared.dm.intro', ['d' => $introData])
@include('services.partials.shared.dm.problem', ['p' => $problemData, 'secId' => 'pain'])
