<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
</head>
<body>

<h1>Crear nuevo producto</h1>

@if ($errors->any())
    <div>
        <strong>Se han encontrado errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a href="/">Volver al inicio</a>
<br><br>
<a href="/panel/productos">Ver listado de productos</a>

<form action="/panel/productos" method="POST">
    @csrf

    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea><br><br>

    <label for="precio">Precio:</label><br>
    <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}"><br><br>

    <label for="stock">Stock:</label><br>
    <input type="number" name="stock" id="stock" value="{{ old('stock') }}"><br><br>

    <label for="imagen">Nombre de la imagen:</label><br>
    <input type="text" name="imagen" id="imagen" value="{{ old('imagen') }}"><br><br>

    <button type="submit">Guardar producto</button><br><br>

    <label for="activo">Activo:</label><br>
    <select name="activo" id="activo">
    <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>Sí</option>
    <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>No</option>
    </select>
    <br><br>
</form>

</body>
</html>