# Darbin Tech — Portal de Clientes

**Proyecto Productivo SENA - Análisis y Desarrollo de Software (ADSO)**
Ficha: 2977408 | Centro: CENIGRAF
Fundador y CEO: Alirio Portilla | GitHub: DarbIng-ops

---

## Descripción

Portal web para gestión de proyectos entre Darbin Tech y sus clientes.
Permite al equipo administrar usuarios y proyectos, y a los clientes hacer seguimiento del avance de su sitio web en tiempo real.

URL producción: portal.darbin.tech

---

## Roles

| Rol | Acceso |
|-----|--------|
| Admin | CRUD usuarios, proyectos, pre-registros |
| Cliente | Ver progreso de sus proyectos y revisiones disponibles |

---

## Funcionalidades

- Autenticación con roles (admin / cliente)
- Dashboard admin: gestión completa de usuarios y proyectos
- Dashboard cliente: barra de progreso, etapas y revisiones
- Etapas de proyecto: briefing → wireframe → diseño UI → desarrollo → revisión → listo para entrega → entregado
- Pre-registro público: el visitante deja su correo e idea, llega por email al admin
- Email automático cuando el proyecto está listo para entrega
- Email automático cuando el proyecto es entregado

---

## Stack técnico

| Capa | Tecnología |
|------|-----------|
| Backend | Laravel 13 + PHP 8.4 |
| Frontend | Livewire 3 + Tailwind CSS + Blade |
| Base de datos | MariaDB / MySQL 8+ |
| Hosting | Hostinger Business |
| Subdominio | portal.darbin.tech |
| Versionamiento | GitHub — DarbIng-ops |

---

## Instalación local

```bash
git clone https://github.com/DarbIng-ops/DarbinTech.git
cd DarbinTech/Desktop/Shop-DarbinTech/portal/portal
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configurá `.env` con tus credenciales de base de datos, luego:

```bash
php artisan migrate
php artisan db:seed
npm run dev
php -S 127.0.0.1:8000 -t public
```

---

## Credenciales de prueba

| Rol | Email | Contraseña |
|-----|-------|-----------|
| Admin | alirioportilla96@gmail.com | admin1234 |
| Cliente | cliente@test.com | cliente1234 |

> Cambiar credenciales antes de deploy a producción.

---

## Estructura del proyecto

```
portal/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Auth + Admin + Cliente
│   │   └── Middleware/     # CheckRole
│   ├── Livewire/           # Componentes reactivos
│   ├── Mail/               # ProjectReadyMail, ProjectDeliveredMail
│   └── Models/             # User, Project, PreRegistration
├── database/
│   ├── migrations/         # Tablas: users, projects, pre_registrations
│   └── seeders/            # Admin + cliente + proyecto de prueba
├── resources/views/
│   ├── layouts/            # portal.blade.php
│   ├── admin/              # Dashboard, usuarios, proyectos, pre-registros
│   └── client/             # Dashboard, detalle de proyecto
└── routes/
    └── web.php             # Rutas por rol
```

---

## Roadmap

- [ ] Deploy a portal.darbin.tech (Hostinger)
- [ ] Conectar botón "Acceder" de darbin.tech al portal
- [ ] Ajustes visuales del dashboard
- [ ] Notificaciones internas en el portal
- [ ] Subida de archivos de avance por parte del admin

---

## Contacto

| Canal | Detalle |
|-------|---------|
| WhatsApp | +573059343294 |
| Email | alirioportilla96@gmail.com |
| Web | darbin.tech |
| Portfolio | cvalirio.darbin.tech |
