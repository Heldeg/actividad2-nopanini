# Proyecto Nopanini

Monorepo para una plataforma de gestion de biblioteca, construido con:

- Backend API REST en Laravel 12
- Frontend SPA en Angular 21

El proyecto incluye modulos para libros, autores, editoriales, categorias, inventario, usuarios y autenticacion.

## Documentacion por carpeta

> [!IMPORTANT]
> Este README funciona como guia general del monorepo.
> Para configuracion y detalle tecnico de cada capa, revisa:

- Backend (Laravel): [Backend/README.md](backend/README.md)
- Frontend (Angular): [Frontend/README.md](frontend/README.md)

## Estructura del monorepo

```text
actividad2-nopanini/
|- backend/   # API Laravel + base de datos + seeders
|- frontend/  # SPA Angular
|- README.md  # Guia general (este archivo)
```

## Requisitos

- Git
- Docker Desktop (recomendado para backend con Sail)
- Node.js y npm (para frontend Angular)

## Inicio rapido

### 1. Clonar el repositorio

```bash
git clone https://github.com/Heldeg/actividad2-nopanini.git
cd actividad2-nopanini
```

### 2. Levantar backend (Laravel)

```bash
./vendor/bin/sail up -d
```

API disponible en `http://localhost/api`.

### 3. Levantar frontend (Angular)

Desde la raiz del repositorio:

```bash
cd frontend
npm install
npm start
```

Frontend disponible en `http://localhost:4200`.

## Flujo recomendado de trabajo

1. Levantar backend y validar migraciones/seeders.
2. Levantar frontend y probar flujos principales (login, catalogo, navegacion).
3. Consultar los README internos para comandos avanzados, pruebas y estructura por modulo.

## Notas

- El backend usa Laravel Sanctum para autenticacion por tokens.
- El frontend esta desarrollado con Angular Material.
- Si necesitas detalle de endpoints, comandos o pruebas, usa la documentacion interna:
    - [backend/README.md](backend/README.md)
    - [frontend/README.md](frontend/README.md)
