@extends('layouts.app')

@section('content')
    <h1>Agregar Sede</h1>
    <form action="{{ route('sedes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_sede">Nombre de Sede</label>
            <input type="text" name="nombre_sede" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
