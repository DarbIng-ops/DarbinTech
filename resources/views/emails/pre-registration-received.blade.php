<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recibimos tu idea</title>
</head>
<body style="margin:0;padding:0;background-color:#F9FAFB;font-family:Arial,Helvetica,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
         style="background-color:#F9FAFB;padding:48px 16px;">
    <tr>
      <td align="center">
        <table width="560" cellpadding="0" cellspacing="0" role="presentation"
               style="max-width:560px;width:100%;">

          {{-- Logo --}}
          <tr>
            <td style="padding-bottom:28px;">
              <span style="font-size:22px;font-weight:bold;color:#111111;letter-spacing:-0.5px;">Darbin</span><span style="font-size:22px;font-weight:bold;color:#F2B705;letter-spacing:-0.5px;">Tech</span>
            </td>
          </tr>

          {{-- Card --}}
          <tr>
            <td style="background-color:#FFFFFF;border-radius:12px;padding:40px;border:1px solid #E5E7EB;">

              <h1 style="margin:0 0 6px 0;font-size:24px;font-weight:bold;color:#111111;line-height:1.3;">
                ¡Recibimos tu idea!
              </h1>

              <p style="margin:0 0 24px 0;font-size:14px;color:#6B7280;line-height:1.5;">
                Hola, <strong style="color:#111111;">{{ $preRegistration->name }}</strong>.
              </p>

              <p style="margin:0 0 20px 0;font-size:15px;color:#111111;line-height:1.7;">
                Gracias por contactarte con nosotros. Recibimos tu propuesta y nos
                pondremos en contacto a la brevedad para conversar sobre los detalles.
              </p>

              {{-- Idea destacada --}}
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="width:100%;margin:0 0 28px 0;">
                <tr>
                  <td style="background-color:#F9FAFB;border-radius:8px;padding:20px 24px;border-left:4px solid #F2B705;">
                    <p style="margin:0 0 6px 0;font-size:11px;color:#6B7280;text-transform:uppercase;letter-spacing:0.6px;">
                      Tu idea
                    </p>
                    <p style="margin:0;font-size:14px;color:#111111;line-height:1.7;">
                      {{ $preRegistration->idea }}
                    </p>
                  </td>
                </tr>
              </table>

              <hr style="border:none;border-top:1px solid #E5E7EB;margin:0 0 24px 0;">

              <p style="margin:0;font-size:13px;color:#6B7280;line-height:1.6;">
                ¿Tenés preguntas? Escribinos a
                <a href="mailto:info@darbin.tech" style="color:#111111;text-decoration:underline;">info@darbin.tech</a>.
                Estamos para ayudarte.
              </p>

            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td style="padding-top:24px;text-align:center;">
              <p style="margin:0;font-size:12px;color:#6B7280;">
                &copy; {{ date('Y') }} Darbin Tech &middot;
                <a href="mailto:info@darbin.tech" style="color:#6B7280;text-decoration:none;">info@darbin.tech</a>
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
