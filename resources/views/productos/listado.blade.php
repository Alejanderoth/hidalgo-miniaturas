<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
</head>
<body>

<h1>Listado de productos</h1>

<a href="/">Volver al inicio</a>
<br><br>

<a href="/panel/productos/crear">Crear producto</a>
<br><br>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                @if($producto->imagen)
                    <img src="{{ asset('img/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="80">
                @else
                    Sin imagen
                @endif
                </td>
                <td>
                    <a href="/panel/productos/{{ $producto->id }}/editar">Editar</a>
                    <form action="/panel/productos/{{ $producto->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>