<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Política de Privacidad — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: var(--db-bg); color: var(--db-text);">

<div class="min-h-screen px-4 py-12">

    {{-- Header con logo y volver --}}
    <div class="max-w-3xl mx-auto mb-10 flex items-center justify-between">
        <a href="https://darbin.tech/" class="inline-block">
            <span class="text-2xl font-bold tracking-tight">
                <span style="color: var(--db-text);">Darbin</span><span style="color: var(--db-blue);">Tech</span>
            </span>
        </a>
        <a href="{{ route('pre-registro') }}"
           class="text-sm hover:underline"
           style="color: var(--db-blue);">
            &larr; Volver al formulario
        </a>
    </div>

    {{-- Card principal --}}
    <div class="max-w-3xl mx-auto rounded-2xl p-8 md:p-12"
         style="background-color: var(--db-surface); border: 1px solid var(--db-navy);">

        {{-- Título --}}
        <div class="mb-8" style="border-bottom: 1px solid var(--db-navy); padding-bottom: 24px;">
            <h1 class="text-2xl font-bold mb-2" style="color: var(--db-text);">
                Política de Privacidad
            </h1>
            <p class="text-sm" style="color: var(--db-muted);">
                Última actualización: {{ \Carbon\Carbon::now()->format('d \d\e F \d\e Y') }}
            </p>
        </div>

        {{-- Sección 1: Responsable del tratamiento --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                1. Responsable del tratamiento de datos
            </h2>
            <p class="text-sm leading-relaxed" style="color: var(--db-muted);">
                El responsable del tratamiento de los datos personales recolectados a través
                de este sitio web es <strong style="color: var(--db-text);">Darbin Tech</strong>,
                con domicilio de contacto electrónico en
                <a href="mailto:info@darbin.tech" style="color: var(--db-blue);" class="hover:underline">info@darbin.tech</a>.
            </p>
        </div>

        {{-- Sección 2: Datos que recolectamos --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                2. Datos personales que recolectamos
            </h2>
            <p class="text-sm leading-relaxed mb-3" style="color: var(--db-muted);">
                A través del formulario de pre-registro ("Enviar mi idea") recolectamos
                exclusivamente los siguientes datos personales:
            </p>
            <ul class="text-sm space-y-2" style="color: var(--db-muted);">
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Nombre completo:</strong> para identificarte y dirigirnos a vos correctamente.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Dirección de correo electrónico:</strong> para comunicarnos con vos sobre tu consulta.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Descripción de tu idea o proyecto:</strong> para evaluar tu solicitud y ofrecerte una propuesta adecuada.</span>
                </li>
            </ul>
            <p class="text-sm leading-relaxed mt-3" style="color: var(--db-muted);">
                No recolectamos datos sensibles en el sentido del artículo 18 de la
                Ley N.° 18.331, ni datos de menores de edad.
            </p>
        </div>

        {{-- Sección 3: Finalidad del tratamiento --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                3. Finalidad del tratamiento
            </h2>
            <p class="text-sm leading-relaxed mb-3" style="color: var(--db-muted);">
                Los datos recolectados se utilizan con las siguientes finalidades:
            </p>
            <ul class="text-sm space-y-2" style="color: var(--db-muted);">
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span>Responder tu consulta y contactarte para continuar la conversación sobre tu proyecto.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span>Evaluar la viabilidad y alcance de tu solicitud para preparar una propuesta.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span>Enviarte información directamente relacionada con tu consulta o presupuesto.</span>
                </li>
            </ul>
            <p class="text-sm leading-relaxed mt-3" style="color: var(--db-muted);">
                No utilizamos tus datos para fines de marketing no solicitado ni para
                elaborar perfiles automatizados de comportamiento.
            </p>
        </div>

        {{-- Sección 4: No compartimos datos con terceros --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                4. Comunicación a terceros
            </h2>
            <p class="text-sm leading-relaxed" style="color: var(--db-muted);">
                Tus datos personales <strong style="color: var(--db-text);">no son cedidos, vendidos ni compartidos</strong>
                con terceros, salvo obligación legal expresa. El acceso a los datos está
                restringido al equipo interno de Darbin Tech que interviene en la atención
                de tu consulta. Los proveedores de infraestructura tecnológica que utilizamos
                (alojamiento de correo, servidor web) operan bajo acuerdos de
                confidencialidad y no tienen autorización para usar tus datos con fines propios.
            </p>
        </div>

        {{-- Sección 5: Base legal --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                5. Base legal del tratamiento
            </h2>
            <p class="text-sm leading-relaxed" style="color: var(--db-muted);">
                El tratamiento de tus datos personales se realiza sobre la base de tu
                <strong style="color: var(--db-text);">consentimiento libre, previo, expreso e informado</strong>,
                conforme al artículo 9 de la
                <strong style="color: var(--db-text);">Ley N.° 18.331 de Protección de Datos Personales y Acción de Habeas Data</strong>
                de la República Oriental del Uruguay, y su Decreto Reglamentario N.° 414/009.
                Este consentimiento es otorgado al marcar la casilla correspondiente en el
                formulario de pre-registro.
            </p>
        </div>

        {{-- Sección 6: Derechos del titular --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                6. Derechos del titular de los datos
            </h2>
            <p class="text-sm leading-relaxed mb-3" style="color: var(--db-muted);">
                En virtud de la Ley N.° 18.331, tenés derecho a:
            </p>
            <ul class="text-sm space-y-2" style="color: var(--db-muted);">
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Acceso:</strong> solicitar información sobre los datos personales que tenemos sobre vos.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Rectificación:</strong> corregir datos inexactos o incompletos.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Supresión (baja):</strong> solicitar la eliminación de tus datos cuando ya no sean necesarios para la finalidad informada.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span style="color: var(--db-blue); margin-top: 2px;">&#8250;</span>
                    <span><strong style="color: var(--db-text);">Oposición:</strong> oponerte al tratamiento de tus datos en los casos previstos por la ley.</span>
                </li>
            </ul>
            <p class="text-sm leading-relaxed mt-3" style="color: var(--db-muted);">
                El ejercicio de estos derechos es gratuito y puede realizarse en cualquier momento.
                Atendemos las solicitudes dentro de los plazos previstos por la Ley N.° 18.331
                (cinco días hábiles para confirmar la recepción y treinta días hábiles para
                dar respuesta de fondo).
            </p>
        </div>

        {{-- Sección 7: Conservación de los datos --}}
        <div class="mb-8">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                7. Conservación de los datos
            </h2>
            <p class="text-sm leading-relaxed" style="color: var(--db-muted);">
                Conservamos tus datos mientras exista una relación comercial activa o en
                curso contigo, o durante el tiempo necesario para atender tu consulta.
                Una vez concluida la finalidad del tratamiento, los datos son eliminados
                de nuestros sistemas de forma segura, salvo que la ley exija conservarlos
                por un período determinado.
            </p>
        </div>

        {{-- Sección 8: Contacto --}}
        <div class="mb-0">
            <h2 class="text-base font-semibold mb-3" style="color: var(--db-blue);">
                8. Contacto para consultas y ejercicio de derechos
            </h2>
            <p class="text-sm leading-relaxed mb-3" style="color: var(--db-muted);">
                Para ejercer tus derechos o realizar cualquier consulta relacionada con
                el tratamiento de tus datos personales, podés escribirnos a:
            </p>
            <div class="rounded-lg px-5 py-4" style="background-color: var(--db-navy); border-left: 4px solid var(--db-blue);">
                <p class="text-sm font-medium" style="color: var(--db-text);">Darbin Tech</p>
                <p class="text-sm mt-1" style="color: var(--db-muted);">
                    <a href="mailto:info@darbin.tech" style="color: var(--db-blue);" class="hover:underline">info@darbin.tech</a>
                </p>
            </div>
            <p class="text-sm leading-relaxed mt-4" style="color: var(--db-muted);">
                Asimismo, si considerás que el tratamiento de tus datos no se ajusta a la
                normativa vigente, tenés derecho a presentar una reclamación ante la
                <strong style="color: var(--db-text);">Unidad Reguladora y de Control de Datos Personales (URCDP)</strong>
                de Uruguay (<a href="https://www.gub.uy/unidad-reguladora-control-datos-personales" target="_blank" rel="noopener noreferrer" style="color: var(--db-blue);" class="hover:underline">www.gub.uy/urcdp</a>).
            </p>
        </div>

    </div>

    {{-- Footer --}}
    <div class="max-w-3xl mx-auto mt-8 text-center">
        <p class="text-xs" style="color: var(--db-muted);">
            &copy; {{ date('Y') }} Darbin Tech &middot;
            <a href="mailto:info@darbin.tech" style="color: var(--db-muted);" class="hover:underline">info@darbin.tech</a>
        </p>
    </div>

</div>

</body>
</html>
