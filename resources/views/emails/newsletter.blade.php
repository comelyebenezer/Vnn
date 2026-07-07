<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #1a1a2e; padding: 30px 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 800;">VERVE NEWS NETWORK</h1>
                            <p style="margin: 8px 0 0; color: #dc2626; font-size: 12px; text-transform: uppercase; letter-spacing: 3px;">Newsletter</p>
                        </td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 16px; color: #666; font-size: 14px;">Hello {{ $subscriber->name ?: 'there' }},</p>

                            <div style="color: #333; font-size: 15px; line-height: 1.7;">
                                {!! $newsletter->content !!}
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 24px 40px; border-top: 1px solid #eee;">
                            <p style="margin: 0; color: #999; font-size: 12px; text-align: center;">
                                You received this because you subscribed to VNN Newsletter.<br>
                                <a href="{{ $unsubscribeUrl }}" style="color: #dc2626; text-decoration: underline;">Unsubscribe</a> from future emails.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
