# Hidalgo Miniaturas · Tienda online y panel de gestión

Aplicación web desarrollada como **Trabajo de Fin de Grado del CFGS de Desarrollo de Aplicaciones Web** (CESUR, 2026) para **Hidalgo Miniaturas**, una empresa familiar que fabrica y vende miniaturas históricas de metal y resina.

La empresa gestionaba los pedidos por correo electrónico y el stock a mano. Este proyecto los reúne en una sola aplicación con dos partes:

- **Tienda online:** catálogo público, carrito de compra y pedidos de los clientes.
- **Panel interno:** gestión de productos, categorías y estado de los pedidos para los empleados.

## Funcionalidades

**Tienda online**

- Catálogo público con los productos activos, filtrado por categorías y ficha de cada producto.
- Carrito de compra guardado en la sesión: añadir productos, cambiar cantidades, eliminar y vaciar, con subtotales y total.
- Confirmación del pedido: se guardan el cliente, la fecha, el estado, el total y las líneas del pedido, y se descuenta el stock.
- Registro e inicio de sesión, y área «Mi cuenta» con los datos del usuario y el historial de pedidos.
- Páginas de información: sobre nosotros, contacto y aviso legal.

**Panel interno** (`/panel`)

- Alta, consulta, edición y eliminación de productos, con validación de los formularios.
- Asignación de categoría e imagen a cada producto, y campo «activo» para ocultar un producto sin borrarlo.
- Listado y detalle de los pedidos, con cambio de estado.

## Usuarios y permisos

| Rol | Qué puede hacer |
| --- | --- |
| Visitante (sin sesión) | Ver el catálogo y usar el carrito |
| Cliente | Lo anterior, confirmar pedidos y consultar sus pedidos |
| Empleado | Acceder al panel interno y gestionar productos y pedidos |
| Administrador | Todo lo anterior |

Las rutas del panel están protegidas con el middleware de autenticación de Laravel y con un middleware propio de roles (`role:empleado,administrador`).

## Tecnologías

- **Backend:** PHP 8.2, Laravel 12, Laravel Breeze (autenticación)
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Vite
- **Base de datos:** MySQL (migraciones y modelos Eloquent)
- **Entorno:** XAMPP (Apache y MySQL), Composer, npm
- **Pruebas:** sistema de testing de Laravel (PHPUnit)
- **Control de versiones:** Git y GitHub

## Modelo de datos

Tablas principales: `users`, `roles`, `categories`, `productos`, `pedidos` y `detalle_pedidos`.

- Cada usuario tiene un rol (`role_id`).
- Cada producto pertenece a una categoría (`categoria_id`).
- Cada pedido pertenece a un usuario y tiene varias líneas en `detalle_pedidos` (producto, cantidad y precio).

## Instalación en local

Requisitos: PHP 8.2 o superior, Composer, Node.js con npm y un servidor MySQL (por ejemplo, el de XAMPP).

```bash
git clone https://github.com/Alejanderoth/hidalgo-miniaturas.git
cd hidalgo-miniaturas
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Edita el archivo `.env` con los datos de tu base de datos MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hidalgo_miniaturas
DB_USERNAME=root
DB_PASSWORD=
```

Crea las tablas con los datos iniciales (roles y un usuario de prueba), compila los estilos y arranca el servidor:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

La aplicación queda disponible en `http://127.0.0.1:8000`.

## Pruebas

```bash
php artisan test
```

Pruebas automáticas incluidas en `tests/Feature`:

- Acceso al catálogo público.
- Protección de las rutas internas (un visitante es redirigido al inicio de sesión).
- Validación al crear productos.
- Creación de un pedido a partir del carrito.

## Estado del proyecto y mejoras futuras

El proyecto cubre el flujo completo de compra hasta la confirmación del pedido. Quedan como mejoras:

- Integración con una pasarela de pago (PayPal Checkout), ya contemplada en el diseño.
- Generación automática de facturas.
- Varias imágenes por producto y subida de imágenes desde el panel.

## Autor

**Alejandro Hidalgo Santos** · [GitHub](https://github.com/Alejanderoth)
