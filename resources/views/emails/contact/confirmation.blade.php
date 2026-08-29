@php
  $name = trim((string) ($lead['name'] ?? 'there'));
  $first = explode(' ', $name)[0] ?: 'there';
@endphp
@component('emails.layouts.kodrank', ['heading' => 'We have your request.', 'title' => 'We received your request'])
  <p style="margin:0 0 16px;">Hi {{ $first }},</p>
  <p style="margin:0 0 16px;">Thank you for writing to KodRank. We have received your message and a member of our team will contact you <strong>within 24 hours</strong> with a clear next step.</p>
  <p style="margin:0 0 16px;">You do not need to resend anything. If your brief changes before we reply, just answer this email — it reaches the same inbox.</p>
  <p style="margin:0 0 16px;">For anything urgent, you can also reach us directly at <a href="mailto:info@kodrank.com" style="color:#CD661A;text-decoration:none;font-weight:600;">info@kodrank.com</a>.</p>
@endcomponent
