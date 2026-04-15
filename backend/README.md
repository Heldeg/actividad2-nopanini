# Backend - Actividad 2 Nopanini

API REST construida con Laravel 12 para la gestion de librerias, libros, autores, editoriales, categorias, inventarios, pedidos y usuarios con autenticacion por tokens (Laravel Sanctum).

## Tecnologias

- PHP 8.2+
- Laravel 12
- Laravel Sanctum
- MySQL 8.4 (en entorno Sail)
- Redis, Meilisearch y Mailpit (incluidos en Sail)
- Vite + TailwindCSS (assets)

## Requisitos

### Opcion A: Docker + Sail (recomendada)

- Docker Desktop / Docker Engine

#### Instalar Sail (detalle)

En este proyecto, Sail ya esta declarado en `composer.json` como dependencia de desarrollo (`laravel/sail`).

Por eso, para instalarlo solo necesitas:

```bash
composer install
```
El siguiente comando solo se ejecuta en linux por lo que si se esta trabajando en windows, abrir una terminal de `WSL` y ejecutar el siguiente comando para instalar las dependencias del proyecto (vendor)

```bash
docker run --rm \
	-u "$(id -u):$(id -g)" \
	-v "$(pwd):/var/www/html" \
	-w /var/www/html \
	laravelsail/php84-composer:latest \
	composer install --ignore-platform-reqs
```

Si trabajas desde WSL sobre una ruta montada en `/mnt/c` (por ejemplo OneDrive), agrega este paso antes de instalar dependencias para evitar timeouts de Composer durante descompresion:

```bash
composer config process-timeout 0
```

`composer install` crea la carpeta `vendor/` en la raiz de este backend (misma altura de `app/`, `routes/`, etc.).

`vendor/` no se sube al repositorio (esta ignorada en `.gitignore`), por lo que cada clon del proyecto debe ejecutar `composer install` para regenerarla.

Ademas, el comando `./vendor/bin/sail` solo existe despues de instalar dependencias con Composer.


Eso descargara Sail dentro de `vendor/` y dejara disponible el ejecutable:

```bash
./vendor/bin/sail
```

Si vienes de un proyecto Laravel donde Sail no existe todavia, puedes instalarlo con:

```bash
composer require laravel/sail --dev
php artisan sail:install
```

Luego inicia los servicios con:

```bash
./vendor/bin/sail up -d
```

### Opcion B: entorno local

- PHP 8.2+
- Composer
- Node.js 20+
- Base de datos compatible (MySQL recomendado para este proyecto)

## Puesta en marcha

### 1) Instalar dependencias

Antes de instalar dependencias, si estas en WSL usando una ruta en `/mnt/c`, ejecuta:

```bash
composer config process-timeout 0
```

```bash
composer install
npm install
```


### 2) Configurar entorno

```bash
cp .env.example .env
./vendor/bin/sailartisan key:generate
```

Si usas Sail, valida que en `.env` tengas configuradas las variables de base de datos para MySQL.

### 3) Levantar contenedores (Sail)

```bash
./vendor/bin/sail up -d
```

### 4) Migrar y sembrar datos

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

Si no usas Sail:

```bash
php artisan migrate:fresh --seed
```

API disponible en `http://localhost/api`.
> comprobar el puerto en el archivo .env


## Comandos utiles

Con Sail:

```bash
./vendor/bin/sail artisan route:list
./vendor/bin/sail artisan test
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail logs -f
```

Sin Sail:

```bash
php artisan route:list
php artisan test
php artisan migrate:fresh --seed
```

## Estructura relevante

- `routes/api.php`: definicion de endpoints REST
- `app/Http/Controllers`: logica de negocio
- `app/Http/Middleware/CheckRole.php`: control de acceso por rol
- `app/Models`: modelos Eloquent
- `database/migrations`: esquema de base de datos
- `database/seeders`: datos iniciales
