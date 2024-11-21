@extends('layouts.app')

@section('content')
    <h1>Editar Sede</h1>
    <form action="{{ route('sedes.update', $sede->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_sede">Nombre de Sede</label>
            <input type="text" name="nombre_sede" class="form-control" value="{{ $sede->nombre_sede }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $sede->direccion }}" required>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" class="form-control" value="{{ $sede->ciudad }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
