# Darbin Tech — Portal de Clientes

**Proyecto Productivo SENA - Análisis y Desarrollo de Software (ADSO)**  
**Ficha:** 2977408 | **Centro:** CENIGRAF  
**Founder & CEO:** Alirio Portilla | **GitHub:** [DarbIng-ops](https://github.com/DarbIng-ops)

---

## Descripción del Proyecto

**Darbin Tech Portal** es el sistema interno de gestión de proyectos entre Darbin Tech y sus
clientes. Permite al equipo administrar solicitudes de servicio, usuarios y proyectos; y a los
clientes hacer seguimiento en tiempo real del avance de su sitio web.

Desarrollado con **Laravel 13 + Livewire 4** como proyecto productivo para el programa ADSO del
SENA. Diseñado para desplegarse en portal.darbin.tech (deploy aún pendiente, ver sección Estado Actual).

---

## Stack Técnico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| **Backend** | Laravel (PHP) | 13.15.0 / PHP 8.4.0 |
| **Frontend reactivo** | Livewire | 4.3.1 |
| **Estilos** | Tailwind CSS | 3.x |
| **JS interactivo** | Alpine.js | 3.x |
| **Build tool** | Vite | 8.x |
| **Base de datos** | MySQL / MariaDB | 8.0+ |
| **Autenticación** | Laravel Breeze | 2.4.x |
| **Testing** | PHPUnit | 12.x |

---

## Instalación desde Cero

```bash
git clone https://github.com/DarbIng-ops/DarbinTech.git
cd DarbinTech
composer install
cp .env.example .env
php artisan key:generate
```

Configurá `.env` con tus credenciales de base de datos (`DB_HOST`, `DB_DATABASE`,
`DB_USERNAME`, `DB_PASSWORD`), luego:

```bash
php artisan migrate
php artisan db:seed   # crea admin (admin@darbintech.test / admin1234) y cliente de prueba
npm install
npm run dev           # desarrollo con hot-reload
# o: npm run build   # build para producción
php artisan serve     # servidor local en http://127.0.0.1:8000
```

> **Atajo:** `composer run setup` ejecuta todos los pasos anteriores en un solo comando.

---

## Roles del Sistema

| Rol | Acceso | Descripción |
|-----|--------|-------------|
| **Admin** | `/admin/*` | CRUD de usuarios, proyectos y pre-registros. Aprueba solicitudes de servicio. |
| **Cliente** | `/dashboard`, `/projects/{id}` | Visualiza el progreso de su proyecto y revisiones disponibles. Puede editar la información básica. |

---

## Flujo Principal del Sistema

1. **Solicitud de servicio** — el visitante llega a `/acceder` y hace clic en "Solicitar
   servicio" → rellena el formulario en `/pre-registro` (nombre, correo, idea de proyecto).
2. **Revisión admin** — el administrador ve la solicitud en `/admin/pre-registrations`
   con estado *pendiente* y puede aprobarla o rechazarla.
3. **Aprobación** — al aprobar, el sistema crea automáticamente el usuario (rol `client`)
   y el proyecto vinculado. Si el email ya existe, vincula el proyecto al usuario existente
   sin duplicarlo.
4. **Notificación por email** — el cliente recibe un correo con sus credenciales de acceso
   (contraseña temporal generada automáticamente).
5. **Acceso del cliente** — el cliente inicia sesión en `/acceder`, llega a su dashboard
   (`/dashboard`) y puede ver el detalle de su proyecto en `/projects/{id}`.
6. **Seguimiento del proyecto** — el admin actualiza las etapas y el porcentaje de avance.
   El cliente lo ve reflejado en tiempo real.
   - Etapas: `briefing → wireframe → diseño UI → desarrollo → revisión → listo para entrega → entregado`

---

## Rutas Principales

### Públicas

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/` | Página de bienvenida |
| GET | `/acceder` | Página de acceso / login (solo visitantes sin sesión) |
| GET | `/pre-registro` | Formulario de solicitud de servicio |
| POST | `/pre-registro` | Enviar solicitud |

### Cliente (requiere `auth` + rol `client`)

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/dashboard` | Panel del cliente: resumen de proyectos |
| GET | `/projects/{project}` | Detalle de proyecto: etapa, progreso, revisiones |
| GET / PATCH / DELETE | `/profile` | Edición de perfil |

### Admin (requiere `auth` + rol `admin`, prefijo `/admin`)

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/admin/dashboard` | Panel admin: métricas globales |
| GET/POST/PATCH/DELETE | `/admin/users` | CRUD de usuarios |
| GET/POST/PATCH/DELETE | `/admin/projects` | CRUD de proyectos |
| GET | `/admin/pre-registrations` | Lista de solicitudes pendientes / historial |
| PATCH | `/admin/pre-registrations/{id}` | Aprobar o rechazar solicitud |

---

## Estado Actual del Proyecto

### Funcional

- [x] Autenticación con roles (`admin` / `client`) — Laravel Breeze
- [x] Flujo completo de pre-registro: solicitud → revisión → aprobación → alta automática de usuario y proyecto
- [x] Email automático al cliente con credenciales tras aprobación
- [x] Manejo de pre-registro con email de cliente existente (vincula proyecto sin duplicar usuario)
- [x] Dashboard admin: listado y CRUD de usuarios, proyectos y pre-registros
- [x] Dashboard cliente: progreso, etapa actual y revisiones disponibles
- [x] Página `/acceder` como punto de entrada unificado para visitantes y clientes
- [x] Cascade delete de pre-registros al eliminar un usuario cliente

### Pendiente

- [ ] Deploy a `portal.darbin.tech` (Hostinger Business)
- [ ] Validaciones adicionales en formularios del admin
- [ ] Subida de archivos de avance por parte del admin
- [ ] Notificaciones internas en el portal
- [ ] Tests automatizados (PHPUnit / Pest)

---

## Documentación Técnica Complementaria

Ver [README-portal.md](./README-portal.md) para detalles adicionales sobre la estructura
de carpetas, seeders y roadmap extendido.

---

## Contacto

| Canal | Detalle |
|-------|----------------------------------|
| **Email** | info@darbin.tech |
| **Sitio Web** | https://darbin.tech/ |
| **GitHub** | https://github.com/DarbIng-ops |
| **Portfolio** | https://cvalirio.darbin.tech/ |

---

## Licencia

Proyecto SENA - Uso educativo y comercial permitido.  
Código personalizado © 2026 Alirio Portilla / Darbin Tech.

---

**Última actualización:** Julio 2026  
**Estado del proyecto:** En desarrollo activo — Deploy pendiente
