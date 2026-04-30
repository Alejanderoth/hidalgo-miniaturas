<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }}</title>
</head>
<body>

<h1>{{ $producto->nombre }}</h1>

<a href="/">Inicio</a>
<br><br>
<a href="/catalogo">Volver al catálogo</a>
<br><br>
<a href="/carrito">Ver carrito</a>

<hr>

<div style="display:flex; gap:40px; align-items:flex-start;">

    <div>
        @if($producto->imagen)
            <img src="{{ asset('img/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="300">
        @else
            <p>Sin imagen</p>
        @endif
    </div>

    <div style="max-width:500px;">
        <p><strong>Categoría:</strong> {{ $producto->category ? $producto->category->nombre : 'Sin categoría' }}</p>

        <p><strong>Descripción:</strong></p>
        <p>{{ $producto->descripcion }}</p>

        <p><strong>Precio:</strong> {{ number_format($producto->precio, 2) }} €</p>

        <p><strong>Stock disponible:</strong> {{ $producto->stock }}</p>

        @if($producto->stock > 0)
            <form action="/carrito/agregar/{{ $producto->id }}" method="POST">
                @csrf
                <button type="submit">Añadir al carrito</button>
            </form>
        @else
            <p>Producto sin stock disponible.</p>
        @endif
    </div>

</div>

<hr>

<h2>Información del producto</h2>

<p>
    Figura histórica perteneciente a la categoría {{ $producto->category ? $producto->category->nombre : 'sin categoría' }}.
    Producto orientado a coleccionismo y modelismo histórico.
</p>

<p><strong>Nota:</strong> Las figuras se entregan sin montar ni pintar.</p>

</body>
</html>