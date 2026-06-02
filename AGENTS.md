# Sistema de Laboratorios — AGENTS.md

Vanilla PHP app (no framework) for lab management. XAMPP + MySQL + Bootstrap 5.

## Estructura

```
index.php → app/FrontController.php (switch por ?route=XXX, 17 rutas)
app/Controllers/   → 17 archivos PHP planos con namespace App\Controllers;
app/Models/        → vacío (crear clases con namespace App\Models)
app/Views/         → PHP/HTML, login.php es standalone, el resto usa layouts/main.php
app/config/database/DbConnect.php → clase abstracta PDO, namespace App\config\database
asset/css|js|img/  → Bootstrap 5 local + Bootstrap Icons
```

## Namespaces (PSR-4)

- `composer.json` mapea `App\` → `app/`
- **Controllers**: solo `namespace App\Controllers;` (archivos planos, NO clases)
- **DbConnect**: `namespace App\config\database;` (clase abstracta)
- **Models** (futuros): `namespace App\Models;`
- **FrontController** (futuro): `namespace App;` (clase)

## Routing

- `index.php?route=XXX` → switch en `FrontController.php`
- Auth: sesión `$_SESSION['logged_in']` requerida en todo excepto `login`
- Agregar ruta: añadir `case` al switch + crear archivo en `Controllers/`

## Controller Convention

Cada controlador setea variables globales e incluye layout:
```php
$pageTitle = "...";
$activeRoute = "routeName";
$viewPath = "app/Views/vista.php";
include "app/Views/layouts/main.php";
```
LoginController no usa layout, incluye `login.php` directo.

## Base de Datos

- `DbConnect.php`: PDO MySQL, credenciales hardcodeadas (root / 31574578.s / practica)
- No hay `.env` — las creds están en el código fuente

## Dependencias

```bash
composer install        # solo vendor/autoload.php, sin paquetes externos
composer dump-autoload  # regenerar después de cambios de namespace
```

## Ausente (a considerar)

- No hay `.gitignore` (vendor/ no está excluido)
- No hay tests, CI, linter, formatter
- No hay migraciones ni schema SQL
