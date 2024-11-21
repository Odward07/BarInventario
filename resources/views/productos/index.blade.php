@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Formulario a la izquierda -->
    <div class="col-md-4">
        <h3>Agregar Producto</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="codigo_producto" class="form-label">Código de Producto</label>
                <input type="text" name="codigo_producto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre_producto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipo_producto" class="form-label">Tipo de Producto</label>
                <select name="tipo_producto" class="form-select" required>
                    <option value="Cerveza">Cerveza</option>
                    <option value="Vino">Vino</option>
                    <option value="Whisky">Whisky</option>
                    <option value="Ron">Ron</option>
                    <option value="Tequila">Tequila</option>
                    <option value="Vodka">Vodka</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="precio_compra" class="form-label">Precio de Compra</label>
                <input type="number" step="0.01" name="precio_compra" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="precio_publico" class="form-label">Precio al Público</label>
                <input type="number" step="0.01" name="precio_publico" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- Lista de productos a la derecha -->
    <div class="col-md-8">
        <h3>Lista de Productos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Público</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->codigo_producto }}</td>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->tipo_producto }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>${{ number_format($producto->precio_compra, 2) }}</td>
                    <td>${{ number_format($producto->precio_publico, 2) }}</td>
                    <td>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
