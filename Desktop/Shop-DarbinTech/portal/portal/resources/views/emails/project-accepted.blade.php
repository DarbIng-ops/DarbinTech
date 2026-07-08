<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>¡Tu proyecto fue aceptado!</title>
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
                ¡Bienvenido/a al portal!
              </h1>

              <p style="margin:0 0 24px 0;font-size:14px;color:#6B7280;line-height:1.5;">
                Hola, <strong style="color:#111111;">{{ $user->name }}</strong>.
              </p>

              <p style="margin:0 0 20px 0;font-size:15px;color:#111111;line-height:1.7;">
                Nos alegra informarte que hemos recibido y aceptado tu solicitud de proyecto.
                Ya podés acceder a tu panel para hacer seguimiento del avance en tiempo real.
              </p>

              {{-- Proyecto destacado --}}
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="width:100%;margin:0 0 28px 0;">
                <tr>
                  <td style="background-color:#F9FAFB;border-radius:8px;padding:20px 24px;border-left:4px solid #F2B705;">
                    <p style="margin:0 0 4px 0;font-size:11px;color:#6B7280;text-transform:uppercase;letter-spacing:0.6px;">
                      Proyecto aceptado
                    </p>
                    <p style="margin:0;font-size:18px;font-weight:bold;color:#111111;">
                      {{ $project->name }}
                    </p>
                  </td>
                </tr>
              </table>

              {{-- Credenciales --}}
              <p style="margin:0 0 12px 0;font-size:15px;font-weight:bold;color:#111111;">
                Tus credenciales de acceso:
              </p>
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="width:100%;margin:0 0 20px 0;">
                <tr>
                  <td style="background-color:#F9FAFB;border-radius:8px;padding:18px 24px;border:1px solid #E5E7EB;">
                    <p style="margin:0 0 10px 0;font-size:14px;color:#6B7280;">
                      <strong style="color:#111111;">Email:</strong>&nbsp;{{ $user->email }}
                    </p>
                    <p style="margin:0;font-size:14px;color:#6B7280;">
                      <strong style="color:#111111;">Contraseña:</strong>&nbsp;<span style="font-family:Courier New,Courier,monospace;background-color:#E5E7EB;padding:3px 8px;border-radius:4px;color:#111111;font-size:14px;">{{ $plainPassword }}</span>
                    </p>
                  </td>
                </tr>
              </table>

              {{-- Aviso de cambio de contraseña --}}
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="width:100%;margin:0 0 28px 0;">
                <tr>
                  <td style="background-color:rgba(242,183,5,0.1);border-radius:8px;padding:14px 20px;border:1px solid #F2B705;">
                    <p style="margin:0;font-size:13px;color:#111111;line-height:1.6;">
                      &#9888;&#65039; Por seguridad, te pediremos que cambies tu contraseña la primera vez que ingreses al portal.
                    </p>
                  </td>
                </tr>
              </table>

              {{-- CTA --}}
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="margin:0 0 32px 0;">
                <tr>
                  <td>
                    <a href="{{ route('acceder') }}"
                       style="display:inline-block;padding:13px 32px;background-color:#F2B705;color:#111111;text-decoration:none;border-radius:8px;font-size:14px;font-weight:bold;letter-spacing:0.2px;">
                      Acceder al portal
                    </a>
                  </td>
                </tr>
              </table>

              <hr style="border:none;border-top:1px solid #E5E7EB;margin:0 0 24px 0;">

              <p style="margin:0;font-size:13px;color:#6B7280;line-height:1.6;">
                ¿Tenés preguntas? Respondé este email o escribinos a
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
