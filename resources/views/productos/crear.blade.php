<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
</head>
<body>

<h1>Crear nuevo producto</h1>

<a href="/">Volver al inicio</a>
<br><br>
<a href="/panel/productos">Ver listado de productos</a>

<form action="/panel/productos" method="POST">
    @csrf

    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre"><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" id="descripcion"></textarea><br><br>

    <label for="precio">Precio:</label><br>
    <input type="number" step="0.01" name="precio" id="precio"><br><br>

    <label for="stock">Stock:</label><br>
    <input type="number" name="stock" id="stock"><br><br>

    <label for="imagen">Imagen:</label><br>
    <input type="text" name="imagen" id="imagen"><br><br>

    <button type="submit">Guardar producto</button>
</form>

</body>
</html>