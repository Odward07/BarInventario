@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Inventario Disponible</h3>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>{{ $producto->precio_publico }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('cajero.index') }}" class="btn btn-secondary">Volver a la Gestión de Pedidos</a>
</div>
@endsection
