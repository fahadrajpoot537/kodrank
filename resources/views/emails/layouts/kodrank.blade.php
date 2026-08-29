<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'KodRank' }}</title>
</head>
<body style="margin:0;padding:0;background:#eef2f0;font-family:Georgia,'Times New Roman',serif;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#eef2f0;padding:28px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 18px 40px rgba(10,26,34,.08);">
          <tr>
            <td style="background:#0A1A22;padding:28px 36px 24px;">
              <div style="font-family:Arial,Helvetica,sans-serif;font-size:13px;letter-spacing:.14em;text-transform:uppercase;color:#F47A1F;font-weight:700;margin-bottom:10px;">KodRank</div>
              <h1 style="margin:0;font-family:Georgia,'Times New Roman',serif;font-size:26px;line-height:1.25;color:#ffffff;font-weight:700;">{{ $heading }}</h1>
            </td>
          </tr>
          <tr>
            <td style="height:4px;background:#F47A1F;font-size:0;line-height:0;">&nbsp;</td>
          </tr>
          <tr>
            <td style="padding:32px 36px 12px;color:#0D2029;font-size:16px;line-height:1.7;font-family:Arial,Helvetica,sans-serif;">
              {!! $slot !!}
            </td>
          </tr>
          <tr>
            <td style="padding:8px 36px 36px;font-family:Arial,Helvetica,sans-serif;">
              <p style="margin:0 0 18px;color:#4B5B62;font-size:15px;line-height:1.6;">
                Warm regards,<br>
                <strong style="color:#0A1A22;">The KodRank Team</strong>
              </p>
              <table role="presentation" cellspacing="0" cellpadding="0">
                <tr>
                  <td style="background:#F47A1F;border-radius:999px;">
                    <a href="{{ url('/') }}" style="display:inline-block;padding:12px 22px;color:#0A1A22;text-decoration:none;font-weight:700;font-size:14px;">Visit kodrank.com</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="background:#F1F5F3;padding:18px 36px;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:1.5;color:#6B7A80;">
              KodRank · Web development &amp; SEO<br>
              <a href="mailto:info@kodrank.com" style="color:#CD661A;text-decoration:none;">info@kodrank.com</a>
              &nbsp;·&nbsp; This email was sent because a form was submitted on our website.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
