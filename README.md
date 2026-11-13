# TuriPotosí

Sistema web de gestión y reserva de tours turísticos en la ciudad de Potosí, desarrollado como proyecto para la asignatura INF-560.

## Descripción del proyecto

TuriPotosí es una aplicación web que permite explorar tours turísticos, consultar sus características y realizar reservas. También ofrece herramientas de administración para gestionar tours y reservas, y un espacio para que los guías consulten los tours que tienen asignados.

El sistema cuenta con tres roles principales: administrador, guía y turista.

## Tecnologías utilizadas

- **Backend:** Laravel 13.
- **Lenguaje:** PHP.
- **Base de datos:** PostgreSQL.
- **Frontend:** Blade y Tailwind CSS 4.
- **Herramientas de compilación:** Vite y npm.
- **Autenticación:** Laravel Breeze.
- **Gestión de roles y permisos:** Spatie Laravel Permission.

## Funcionalidades principales

### Visitantes

- Consultar el catálogo público de tours.
- Filtrar y explorar las opciones turísticas.
- Consultar los detalles de cada tour.
- Registrarse como turista e iniciar sesión.

### Turistas

- Explorar tours disponibles.
- Realizar reservas indicando la cantidad de personas.
- Consultar sus reservas.
- Cancelar sus propias reservas cuando corresponda.

### Guías

- Iniciar sesión con una cuenta asignada por el administrador.
- Consultar los tours que tienen asignados.
- Revisar información, servicios y reservas de sus tours.

### Administradores

- Administrar los tours turísticos.
- Crear, editar y eliminar tours.
- Asignar guías a los tours.
- Gestionar imágenes, categorías y servicios de los tours.
- Consultar las reservas registradas.
- Actualizar el estado de las reservas.

## Requisitos para ejecutar el proyecto

Antes de instalar el proyecto, se necesita:

- PHP 8.3 o superior.
- Composer.
- Node.js y npm.
- PostgreSQL.
- Git.

## Instalación

### 1. Clonar el repositorio

Clonar el repositorio desde GitHub y entrar a la carpeta del proyecto:

```powershell
git clone https://github.com/gogo604/INF560-EP2-HUALLPA__TARQUI.git
cd TuriPotosi
```

### 2. Instalar dependencias de PHP

```powershell
composer install
```

### 3. Instalar dependencias de JavaScript

```powershell
npm install
```

### 4. Configurar las variables de entorno

Crear el archivo `.env` a partir del archivo de ejemplo:

```powershell
Copy-Item .env.example .env
```

Generar la clave de la aplicación:

```powershell
php artisan key:generate
```

### 5. Configurar PostgreSQL

Crear una base de datos en PostgreSQL y configurar los siguientes valores en el archivo `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=turpotosi
DB_USERNAME=postgres
DB_PASSWORD=
```

La contraseña debe corresponder a la configurada en la instalación local de PostgreSQL.

### 6. Ejecutar las migraciones y los seeders

```powershell
php artisan migrate --seed
```

Este comando crea las tablas necesarias y carga los datos iniciales del sistema, incluidos roles, usuarios, categorías, servicios, tours y reservas.

### 7. Crear el enlace de almacenamiento

```powershell
php artisan storage:link
```

### 8. Compilar los archivos del frontend

```powershell
npm run build
```

### 9. Iniciar el servidor

```powershell
php artisan serve
```

Abrir en el navegador:

```text
http://127.0.0.1:8000
```

## Cuentas de prueba

El proyecto incluye cuentas de prueba para los diferentes roles. Todas utilizan la siguiente contraseña:

```text
password
```

| Rol | Correo electrónico |
|---|---|
| Administrador | admin@turipotosi.test |
| Guía 1 | guia1@turipotosi.test |
| Guía 2 | guia2@turipotosi.test |
| Turista 1 | turista1@turipotosi.test |
| Turista 2 | turista2@turipotosi.test |

Estas credenciales son únicamente para pruebas y desarrollo local. No deben utilizarse en un entorno de producción.

## Estructura general del sistema

- `app/Models`: modelos y relaciones de la aplicación.
- `app/Http/Controllers`: controladores del sistema.
- `app/Http/Requests`: validaciones de formularios.
- `app/Policies`: políticas de autorización.
- `database/migrations`: estructura de la base de datos.
- `database/seeders`: datos iniciales.
- `resources/views`: vistas Blade.
- `resources/css`: estilos del frontend.
- `routes/web.php`: rutas de la aplicación.
- `public/images`: imágenes públicas del proyecto.

## Seguridad

- Los visitantes pueden registrarse únicamente como turistas.
- Los roles de administrador y guía son asignados por usuarios autorizados.
- Las rutas administrativas y de guías están protegidas mediante middleware.
- Las reservas están protegidas mediante autenticación y políticas de autorización.
- Se valida la disponibilidad de cupos antes de registrar reservas.

## Autor

Proyecto académico desarrollado para la asignatura INF-560.
