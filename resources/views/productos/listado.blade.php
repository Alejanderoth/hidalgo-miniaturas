@extends('layouts.panel')

@section('content')

<h2>Gestión de productos</h2>

<a class="boton" href="/panel/productos/crear">Crear producto</a>

<table class="tabla">

    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Activo</th>
        <th>Acciones</th>
    </tr>

    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->category ? $producto->category->nombre : '-' }}</td>
            <td class="precio">{{ $producto->precio }} €</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->activo ? 'Sí' : 'No' }}</td>

            <td>
                <a href="/panel/productos/{{ $producto->id }}/editar" class="boton boton-tabla">Editar</a>

                <form action="/panel/productos/{{ $producto->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="boton-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach

</table>

@endsection