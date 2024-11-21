@extends('layouts.app')

@section('content')
    <h1>Sedes</h1>
    <a href="{{ route('sedes.create') }}" class="btn btn-primary">Agregar Sede</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sedes as $sede)
                <tr>
                    <td>{{ $sede->nombre_sede }}</td>
                    <td>{{ $sede->direccion }}</td>
                    <td>{{ $sede->ciudad }}</td>
                    <td>
                        <a href="{{ route('sedes.edit', $sede->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('sedes.destroy', $sede->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
