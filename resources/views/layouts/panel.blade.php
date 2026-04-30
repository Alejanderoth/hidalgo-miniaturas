<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel interno</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

<div class="panel-header">

    <div class="panel-top">
        <h1>Panel de gestión</h1>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="boton-panel">Salir</button>
        </form>
    </div>

    <div class="panel-nav">
        <a href="/panel">Inicio</a>
        <a href="/panel/productos">Productos</a>
        <a href="/panel/pedidos">Pedidos</a>
        <a href="/">Tienda</a>
    </div>

</div>

<div class="panel-container">
    @yield('content')
</div>

</body>
</html>