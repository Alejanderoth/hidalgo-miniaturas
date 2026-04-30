@extends('layouts.panel')

@section('content')

<h2>Crear producto</h2>

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

    <form action="/panel/productos" method="POST">
        @csrf

        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id" id="categoria_id">
            <option value="">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('categoria_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nombre }}
                </option>
            @endforeach
        </select>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}">

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock') }}">

        <label for="imagen">Nombre de la imagen:</label>
        <input type="text" name="imagen" id="imagen" value="{{ old('imagen') }}">

        <label for="activo">Activo:</label>
        <select name="activo" id="activo">
            <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>No</option>
        </select>

        <div class="form-acciones">
            <button type="submit" class="boton">Crear producto</button>
            <a href="/panel/productos" class="boton-secundario">Volver al listado</a>
        </div>

    </form>

</div>

@endsection