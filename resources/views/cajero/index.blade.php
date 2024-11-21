@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Gestión de Órdenes</h3>

    {{-- Botón para regresar al listado de inventario --}}
    <a href="{{ route('cajero.inventario') }}" class="btn btn-secondary mb-4">Ver Inventario</a>

    {{-- Mensajes de éxito y errores --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Formulario para procesar pedidos --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Descargar Pedido</h5>
            <form action="{{ route('cajero.descargarInventario') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pedido_id" class="form-label">ID del Pedido</label>
                    <input type="number" name="pedido_id" id="pedido_id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Procesar Pedido</button>
            </form>
        </div>
    </div>

    {{-- Tabla de órdenes --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Órdenes Pendientes</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Mesa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->producto }}</td>
                            <td>{{ $pedido->cantidad }}</td>
                            <td>{{ $pedido->mesa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
