<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
</head>
<body>

<h1>Editar producto</h1>

<a href="/">Volver al inicio</a>
<br><br>
<a href="/panel/productos">Volver al listado</a>

<form action="/panel/productos/{{ $producto->id }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}"><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" id="descripcion">{{ $producto->descripcion }}</textarea><br><br>

    <label for="precio">Precio:</label><br>
    <input type="number" step="0.01" name="precio" id="precio" value="{{ $producto->precio }}"><br><br>

    <label for="stock">Stock:</label><br>
    <input type="number" name="stock" id="stock" value="{{ $producto->stock }}"><br><br>

    <label for="imagen">Imagen:</label><br>
    <input type="text" name="imagen" id="imagen" value="{{ $producto->imagen }}"><br><br>

    <button type="submit">Actualizar producto</button>
</form>

</body>
</html>