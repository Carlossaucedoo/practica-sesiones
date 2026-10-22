# Práctica Sesiones (Laravel 13 + SQLite)

Login y logout con sesiones a partir del ejercicio de los modelos `User` y `Token`.

- **Login**: comprueba la contraseña con `Hash::check`, crea un `Token` y guarda en la sesión el token y el nombre de usuario con `session(['token' => $token, 'name' => $user->name])`.
- **Logout**: borra el token, invalida la sesión (`invalidate()` + `regenerateToken()`) y redirige al login.
- **Header**: sin token muestra los botones *Iniciar sesión* y *Crear cuenta*; con token muestra *Hola, nombre* y el botón *Cerrar sesión*.

## Instalación

```bash
git clone <url-del-repo> practica-sesiones
cd practica-sesiones
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Usuarios de prueba creados por el seeder:

| Name | Email            | Contraseña  |
|------|------------------|-------------|
| ana  | ana@example.com  | password123 |
| luis | luis@example.com | password123 |

## Rutas

| Método | URL         | Controlador                   | Descripción                      |
|--------|-------------|-------------------------------|----------------------------------|
| GET    | `/`         | `PageController@home`         | Página de inicio                 |
| GET    | `/login`    | `AuthController@showLogin`    | Formulario de login              |
| POST   | `/login`    | `AuthController@login`        | Inicia sesión y guarda el token  |
| GET    | `/register` | `AuthController@showRegister` | Formulario para crear cuenta     |
| POST   | `/register` | `AuthController@register`     | Crea el usuario                  |
| POST   | `/logout`   | `AuthController@logout`       | Cierra la sesión                 |

## Estructura

```
app/Http/Controllers/AuthController.php
app/Http/Controllers/PageController.php
resources/views/layouts/app.blade.php
resources/views/partials/header.blade.php
resources/views/partials/footer.blade.php
resources/views/pages/home.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
public/css/estilos.css
routes/web.php
```
