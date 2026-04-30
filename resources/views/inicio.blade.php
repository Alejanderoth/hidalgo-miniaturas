<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Hidalgo Miniaturas</title>
</head>
<body>

<h1>Hidalgo Miniaturas</h1>
<p>Sistema de digitalización para la gestión de productos.</p>

<h2>Menú principal</h2>

<ul>

    <!-- PÚBLICO (todos) -->
    <li><a href="/catalogo">Ver catálogo</a></li>
    <li><a href="/carrito">Ver carrito</a></li>

    @auth

        <!-- CLIENTE -->
        @if(auth()->user()->role && auth()->user()->role->nombre === 'cliente')
            <li><a href="/mi-cuenta">Mi cuenta</a></li>
        @endif

        <!-- EMPLEADO / ADMIN -->
        @if(auth()->user()->role && 
            (auth()->user()->role->nombre === 'administrador' || auth()->user()->role->nombre === 'empleado'))
            
            <li><a href="/panel">Panel interno</a></li>
            <li><a href="/panel/productos">Gestión de productos</a></li>
            <li><a href="/panel/productos/crear">Crear producto</a></li>
            <li><a href="/panel/pedidos">Gestión de pedidos</a></li>

        @endif

    @endauth

</ul>

<h2>Categorías</h2>

<ul>
    @foreach($categories as $category)
        <li>
            <a href="/categoria/{{ $category->id }}">{{ $category->nombre }}</a>
        </li>
    @endforeach
</ul>

<hr>

@auth
    <p>Usuario: {{ auth()->user()->name }}</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
@else
    <a href="/login">Iniciar sesión</a>
    <br>
    <a href="/register">Registrarse</a>
@endauth

</body>
</html>