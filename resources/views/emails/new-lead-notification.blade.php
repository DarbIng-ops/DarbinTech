<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuevo lead</title>
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
                Nuevo lead recibido
              </h1>

              <p style="margin:0 0 28px 0;font-size:14px;color:#6B7280;line-height:1.5;">
                Un visitante completó el formulario de pre-registro.
              </p>

              {{-- Datos del lead --}}
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="width:100%;margin:0 0 28px 0;">
                <tr>
                  <td style="background-color:#F9FAFB;border-radius:8px;padding:24px;border:1px solid #E5E7EB;">

                    <p style="margin:0 0 14px 0;font-size:14px;color:#6B7280;">
                      <strong style="color:#111111;display:inline-block;min-width:60px;">Nombre:</strong>
                      {{ $preRegistration->name }}
                    </p>

                    <p style="margin:0 0 14px 0;font-size:14px;color:#6B7280;">
                      <strong style="color:#111111;display:inline-block;min-width:60px;">Email:</strong>
                      <a href="mailto:{{ $preRegistration->email }}"
                         style="color:#111111;text-decoration:underline;">{{ $preRegistration->email }}</a>
                    </p>

                    <hr style="border:none;border-top:1px solid #E5E7EB;margin:14px 0;">

                    <p style="margin:0 0 6px 0;font-size:11px;color:#6B7280;text-transform:uppercase;letter-spacing:0.6px;">
                      Idea
                    </p>
                    <p style="margin:0;font-size:14px;color:#111111;line-height:1.7;">
                      {{ $preRegistration->idea }}
                    </p>

                  </td>
                </tr>
              </table>

              {{-- CTA admin --}}
              <table cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td>
                    <a href="{{ route('admin.pre-registrations.index') }}"
                       style="display:inline-block;padding:13px 32px;background-color:#F2B705;color:#111111;text-decoration:none;border-radius:8px;font-size:14px;font-weight:bold;letter-spacing:0.2px;">
                      Ver en el panel admin
                    </a>
                  </td>
                </tr>
              </table>

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
