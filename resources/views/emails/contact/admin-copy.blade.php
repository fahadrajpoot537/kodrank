@php
  $rows = [
    'Source' => $lead['source'] ?? 'Website form',
    'Name' => $lead['name'] ?? '—',
    'Email' => $lead['email'] ?? '—',
    'Phone' => $lead['phone'] ?? '—',
    'Company' => $lead['company'] ?? '—',
    'Website' => $lead['website'] ?? '—',
    'Service' => $lead['service'] ?? '—',
  ];
  $message = trim((string) ($lead['message'] ?? ''));
@endphp
@component('emails.layouts.kodrank', ['heading' => 'New inquiry copy', 'title' => 'New inquiry copy'])
  <p style="margin:0 0 18px;">A copy of a website form submission is below. Reply to this email to write the visitor directly.</p>
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #E1E9E5;border-radius:12px;overflow:hidden;margin:0 0 18px;">
    @foreach($rows as $label => $value)
      @if(trim((string) $value) !== '' && $value !== '—')
        <tr>
          <td style="width:132px;padding:10px 14px;background:#F1F5F3;color:#4B5B62;font-size:12px;letter-spacing:.04em;text-transform:uppercase;font-weight:700;border-bottom:1px solid #E1E9E5;">{{ $label }}</td>
          <td style="padding:10px 14px;color:#0D2029;font-size:14px;border-bottom:1px solid #E1E9E5;">{{ $value }}</td>
        </tr>
      @endif
    @endforeach
  </table>
  @if($message !== '')
    <p style="margin:0 0 8px;color:#4B5B62;font-size:12px;letter-spacing:.04em;text-transform:uppercase;font-weight:700;">Message</p>
    <p style="margin:0;padding:14px 16px;background:#F1F5F3;border-radius:12px;white-space:pre-wrap;color:#0D2029;font-size:14px;line-height:1.6;">{{ $message }}</p>
  @endif
@endcomponent
