@extends('layouts.panel')

@section('content')

<h2>Editar producto</h2>

@if ($errors->any())
    <div class="alerta-error">
        <strong>Se han encontrado errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-card">

    <form action="/panel/productos/{{ $producto->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" id="categoria_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('categoria_id', $producto->categoria_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->nombre }}
                </option>
            @endforeach
        </select>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}">

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}">

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $producto->stock) }}">

        <label for="imagen">Nombre de la imagen:</label>
        <input type="text" name="imagen" id="imagen" value="{{ old('imagen', $producto->imagen) }}">

        <label for="activo">Activo:</label>
        <select name="activo" id="activo">
            <option value="1" {{ old('activo', $producto->activo) == '1' ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ old('activo', $producto->activo) == '0' ? 'selected' : '' }}>No</option>
        </select>

        <div class="form-acciones">
            <button type="submit" class="boton">Actualizar producto</button>
            <a href="/panel/productos" class="boton-secundario">Volver al listado</a>
        </div>
    </form>

</div>

@endsection