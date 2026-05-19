# 🎬 VideoClub App — Gestión de Videoclub con Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![TMDB](https://img.shields.io/badge/API-TMDB-01B4E4?style=flat-square&logo=themoviedatabase&logoColor=white)
![REST API](https://img.shields.io/badge/REST-API-brightgreen?style=flat-square)
![Status](https://img.shields.io/badge/Status-Academic%20Project-blue?style=flat-square)

> Aplicación web fullstack desarrollada con **Laravel** que simula las gestiones de un videoclub — alquileres, copias, valoraciones y panel de administración — con **API REST propia** e integración automática de carátulas vía **TMDB API**.

---

## 📋 Descripción

VideoClub App es una aplicación MVC construida sobre Laravel que cubre tanto la experiencia del usuario final como la gestión administrativa completa. Incluye un sistema de autenticación con **verificación de email**, gestión de copias físicas de películas, alquileres y valoraciones.

Destaca por dos capas de acceso diferenciadas: una **interfaz web Blade** para los usuarios y una **API REST JSON** para el acceso programático a los recursos, ambas gestionando el mismo modelo de datos.

---

## ⚙️ Tecnologías

| Capa | Tecnologías |
|------|------------|
| Backend | PHP · Laravel · Eloquent ORM · Route Model Binding |
| Validación | Laravel Form Requests (`PeliculaCreateRequest`, `PeliculaEditRequest`) |
| Frontend | Blade · HTML5 · CSS3 · JavaScript |
| Base de datos | MySQL |
| API externa | TMDB (The Movie Database) — clase `TmdbService` |
| Autenticación | Laravel Auth con verificación de email |
| Almacenamiento | Laravel Storage (disco `public`) |

---

## ✨ Funcionalidades

### 👤 Usuario público
- Consulta del catálogo de películas y copias disponibles
- Registro e inicio de sesión con **verificación de email**

### 🔐 Usuario autenticado
- Gestión de sus **alquileres**
- Publicación y edición de **valoraciones** en películas

### 🛠️ Administrador
- **CRUD completo de películas** con carga automática de carátula vía TMDB
- **CRUD de copias** — gestión del inventario físico
- **CRUD de clientes**
- **CRUD de alquileres**
- Edición de la página de inicio (`HomeController`)

---

## 🎯 API REST

El proyecto expone una **API REST JSON** para el recurso `Pelicula` con las siguientes características:

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/peliculas?page=N&limit=M` | Listado paginado |
| GET | `/api/peliculas/{id}` | Detalle de película |
| POST | `/api/peliculas` | Crear película |
| PUT | `/api/peliculas/{id}` | Actualizar película |
| DELETE | `/api/peliculas/{id}` | Eliminar película |

**Características de la API:**
- Respuestas JSON estándar con `success`, `data` y `message`
- Códigos HTTP semánticos (200, 201, 204, 500)
- Paginación con metadatos (`total`, `current_page`, `links`...)
- Manejo de errores con `try/catch`
- Validación mediante **Form Requests**
- Route Model Binding en todos los endpoints

---

## 🖼️ Integración con TMDB API

Al crear una película sin carátula manual, el sistema actúa automáticamente:

1. Busca el título en la **TMDB API** mediante `TmdbService`
2. Obtiene la URL del póster del primer resultado
3. Descarga la imagen y la almacena en el disco `public`
4. Asocia la ruta al modelo — sin intervención del administrador

Si se sube una imagen manualmente, se usa esa y se omite la consulta a TMDB.

---

## 🗄️ Modelo de datos

```
users          → Autenticación y verificación de email
peliculas      → Catálogo de películas (con portada)
copias         → Inventario físico de copias por película
clientes       → Datos de clientes registrados
alquileres     → Registro de alquileres (cliente + copia)
valoracions    → Valoraciones y comentarios por película
```

---

## 🚀 Instalación

### Requisitos
- PHP 8.x · Composer · MySQL
- Clave de API de TMDB (gratuita en [themoviedb.org](https://www.themoviedb.org/settings/api))

```bash
# 1. Clona el repositorio
git clone https://github.com/Raul-Labrador/videoclubApp.git
cd videoclubApp

# 2. Instala dependencias
composer install

# 3. Configura el entorno
cp .env.example .env
php artisan key:generate

# 4. Configura .env con tus credenciales
DB_DATABASE=videoclub
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
TMDB_API_KEY=tu_api_key

# 5. Migraciones y seeders
php artisan migrate --seed

# 6. Enlace de storage
php artisan storage:link

# 7. Lanza el servidor
php artisan serve
```

Accede en: `http://localhost:8000`

---

## 📁 Estructura relevante

```
videoclubApp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── PeliculaApiController.php  # API REST + lógica TMDB
│   │   │   ├── PeliculaController.php          # Controlador web (Blade)
│   │   │   ├── AlquilerController.php
│   │   │   ├── CopiaController.php
│   │   │   ├── ClienteController.php
│   │   │   ├── ValoracionController.php
│   │   │   └── HomeController.php
│   │   └── Requests/
│   │       ├── PeliculaCreateRequest.php       # Validación de creación
│   │       └── PeliculaEditRequest.php         # Validación de edición
│   ├── Models/
│   │   └── Pelicula.php
│   └── Services/
│       └── TmdbService.php                     # Comunicación con TMDB API
├── database/migrations/
├── resources/views/                            # Plantillas Blade
└── routes/
    ├── web.php                                 # Rutas web con middleware auth
    └── api.php                                 # Rutas API REST
```

---

## 👨‍💻 Contexto académico

Proyecto desarrollado durante el **Grado Superior de Desarrollo de Aplicaciones Web (DAW)** como práctica avanzada de Laravel. Comenzó como una aplicación web MVC y fue expandido con una capa de **API REST** como práctica de la asignatura optativa.

---

## 📄 Licencia

Proyecto académico compartido con fines de portfolio. No está permitida su distribución o uso comercial sin autorización expresa del autor.
