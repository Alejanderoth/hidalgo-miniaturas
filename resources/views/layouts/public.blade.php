<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hidalgo Miniaturas</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

<div class="header">
    <img src="{{ asset('img/logo.png') }}">

    <div class="nav">
        <a href="/">Inicio</a>
        <a href="/catalogo">Catálogo</a>
        <a href="/carrito">Cesta</a>

        @auth

            <a href="/mi-cuenta">Mi cuenta</a>

            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button type="submit" class="boton-logout">Salir</button>
            </form>

        @else
        <a href="/login">Login</a>
        <a href="/register">Registro</a>
        @endauth
    </div>
</div>

<div class="aviso">
    Información importante: Las figuras se entregan sin montar ni pintar
</div>

@yield('content')

<div class="footer">

    <div class="footer-grid">

    <a href="/sobre-nosotros" class="bloque-info">
        Sobre nosotros
    </a>

    <a href="/contacto" class="bloque-info">
        Contacto
    </a>

    <a href="/aviso-legal" class="bloque-info">
        Aviso legal
    </a>

</div>

</div>
</body>
</html>