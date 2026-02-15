# Proyecto Nopanini: Angular + Laravel

Monorepo configurado con Laravel (Backend/API) usando Docker Sail y Angular (Frontend).

## Requisitos
* Docker Desktop (Corriendo)
* Node.js y NPM
* Git

---

## 🚀 1. Instalación y Configuración

### 1. Clonar el repositorio
```bash
git clone [https://github.com/TU_USUARIO/TU_REPO.git](https://github.com/TU_USUARIO/TU_REPO.git)
cd actividad2-nopanini
```

### 2. Configurar Backend (Laravel)
1. Entra a la carpeta backend: 
```cd backend```
2. Crea el archivo de entorno: 
```cp .env.example .env```
3. Instalar dependencias (Usa este comando para hacerlo vía Docker):
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```
4. Levantar el servidor:
```./vendor/bin/sail up -d```
5. Generar llave y base de datos:
```
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
```

### 3. Configurar Frontend (Angular)
1. Entra a la carpeta frontend (desde la raíz):
```cd ../frontend```
2. Instalar dependencias:
```npm install```
3. Iniciar servidor:
```ng serve```
