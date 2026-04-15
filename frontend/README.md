# Frontend - Actividad 2 Nopanini

Aplicación web desarrollada con Angular para la gestión y visualización de contenido relacionado con libros, usuarios y biblioteca. El proyecto incluye autenticación, navegación por rutas, catálogo y componentes reutilizables para una experiencia moderna en el navegador.

## Descripción general

Este frontend está construido como una Single Page Application usando Angular 21 y Angular Material. A partir de la estructura del proyecto, la aplicación contempla módulos y servicios para:

- autenticación de usuarios
- registro e inicio de sesión
- visualización de libros
- categorías
- autores
- editoriales
- inventario
- biblioteca
- órdenes
- reproducción de video
- manejo de errores y rutas no válidas

## Tecnologías utilizadas

- Angular 21.1.4
- Angular Material 21.1.4
- Angular CDK 21.1.4
- TypeScript 5.9.2
- RxJS 7.8
- Vitest 4
- npm 11.6.2

### Requisitos recomendados

Aunque el proyecto no fija una versión exacta de Node.js en el archivo de configuración, por la versión de Angular utilizada se recomienda trabajar con una versión moderna y compatible, por ejemplo:

- Node.js 20.19 o superior
- o Node.js 22.12 o superior

## Rutas principales

La aplicación actualmente define las siguientes rutas:

- `/home` página principal
- `/login`  inicio de sesión
- `/register`  registro de usuario
- `**`  pantalla de error para rutas no encontradas

## Instalación del proyecto

1. Clonar el repositorio.

2. Instalar las dependencias:

```bash
npm install
```

3. Iniciar el servidor de desarrollo con node:

```bash
npm start
```

4. Iniciar el servidor de desarrollo con Angular CLI

En caso de tener instalado angular CLI, se puede levantar el proyecto haciendo uso de los comandos propios de angular como lo es el siguiete:
```bash
ng serve
```
> Este comando es opcional ya que el archivo de package.json esta configurado para lanzar este comando al momento de ejecutar `npm start`


5. Abrir en el navegador:

```text
http://localhost:4200/
```

## Comandos de interes

### Levantar el proyecto en desarrollo

```bash
npm start
```

### Compilar para producción

```bash
npm run build
```

### Compilar en modo observación

```bash
npm run watch
```

### Ejecutar pruebas

```bash
npm test
```

## Estructura general del proyecto

La carpeta principal de código fuente está en `src/` y contiene:

- `app/` → componentes, rutas y configuración principal
- `components/` → interfaz de usuario dividida por funcionalidades
- `models/` → modelos de datos de la aplicación
- `services/` → servicios para acceso y gestión de la información
- `environments/` → configuración por entorno
- `public/assets/` → recursos estáticos, incluidos videos

## Componentes destacados

Entre los componentes identificados en el proyecto se encuentran:

- Home
- Header
- Footer
- Books
- Categories
- Book Detail Modal
- Video Viewer
- Login
- Register
- Error

## Notas de desarrollo

- El proyecto utiliza Angular Material para extender algunas funcionalidades del aspecto visual.
- La navegación se realiza mediante Angular Router.
- La suite de pruebas está configurada con Vitest (No se profundizo en pruebas para este proyecto).
