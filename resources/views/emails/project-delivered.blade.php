<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>¡Tu proyecto fue entregado!</title>
</head>
<body style="margin:0;padding:0;background-color:#0F1E38;font-family:Arial,Helvetica,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
         style="background-color:#0F1E38;padding:48px 16px;">
    <tr>
      <td align="center">
        <table width="560" cellpadding="0" cellspacing="0" role="presentation"
               style="max-width:560px;width:100%;">

          {{-- Logo --}}
          <tr>
            <td style="padding-bottom:28px;">
              <span style="font-size:22px;font-weight:bold;color:#E8EFF8;letter-spacing:-0.5px;">Darbin</span><span style="font-size:22px;font-weight:bold;color:#2E7AB8;letter-spacing:-0.5px;">Tech</span>
            </td>
          </tr>

          {{-- Card --}}
          <tr>
            <td style="background-color:#162844;border-radius:12px;padding:40px;border:1px solid #1A3A6B;">

              <h1 style="margin:0 0 6px 0;font-size:24px;font-weight:bold;color:#E8EFF8;line-height:1.3;">
                ¡Felicitaciones! 🚀
              </h1>

              <p style="margin:0 0 28px 0;font-size:14px;color:#7A9BBF;line-height:1.5;">
                Hola, <strong style="color:#E8EFF8;">{{ $project->user->name }}</strong>
              </p>

              <p style="margin:0 0 16px 0;font-size:15px;color:#E8EFF8;line-height:1.7;">
                Con mucho orgullo te informamos que tu proyecto ha sido
                <strong style="color:#6DB33F;">entregado oficialmente</strong>.
                Ha sido un placer trabajar contigo y esperamos que el resultado supere tus expectativas.
              </p>

              {{-- Project name highlight --}}
              <table cellpadding="0" cellspacing="0" role="presentation"
                     style="width:100%;margin:24px 0 28px 0;">
                <tr>
                  <td style="background-color:#1A3A6B;border-radius:8px;padding:20px 24px;border-left:4px solid #6DB33F;">
                    <p style="margin:0 0 4px 0;font-size:12px;color:#7A9BBF;text-transform:uppercase;letter-spacing:0.5px;">
                      Proyecto entregado
                    </p>
                    <p style="margin:0;font-size:18px;font-weight:bold;color:#E8EFF8;">
                      {{ $project->name }}
                    </p>
                  </td>
                </tr>
              </table>

              <p style="margin:0 0 32px 0;font-size:15px;color:#7A9BBF;line-height:1.7;">
                Si en el futuro necesitas soporte, actualizaciones o tienes un nuevo proyecto en mente,
                no dudes en contactarnos. ¡Seguimos a tu disposición!
              </p>

              <hr style="border:none;border-top:1px solid #1A3A6B;margin:0 0 24px 0;">

              <p style="margin:0;font-size:13px;color:#7A9BBF;line-height:1.6;">
                ¿Tienes comentarios o necesitas soporte post-entrega? Escríbenos al
                <a href="https://wa.me/573059343294" style="color:#2E7AB8;text-decoration:none;">+57 305 934 3294</a>.
              </p>

            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td style="padding-top:28px;text-align:center;">
              <p style="margin:0;font-size:12px;color:#7A9BBF;">
                © {{ date('Y') }} DarbinTech · Todos los derechos reservados.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
