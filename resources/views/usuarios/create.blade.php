@extends('layouts.app')

@section('content')
    <h1>Agregar Usuario</h1>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="contraseña" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sede_id">Sede</label>
            <select name="sede_id" class="form-control" required>
                @foreach($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->nombre_sede }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <select name="cargo" class="form-control" required>
                <option value="Mesero">Mesero</option>
                <option value="Cajero">Cajero</option>
                <option value="Administrador">Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
