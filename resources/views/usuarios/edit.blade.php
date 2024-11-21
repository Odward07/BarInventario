@extends('layouts.app')

@section('content')
    <h1>Editar Usuario</h1>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" class="form-control" value="{{ $usuario->nombres }}" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" value="{{ $usuario->apellidos }}" required>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ $usuario->correo }}" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" placeholder="Dejar vacío para no modificar">
            </div>
            <div class="form-group">
                <label for="sede_id">Sede</label>
                <select name="sede_id" class="form-control" required>
                    @foreach($sedes as $sede)
                        <option value="{{ $sede->id }}" {{ $usuario->sede_id == $sede->id ? 'selected' : '' }}>
                            {{ $sede->nombre_sede }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <select name="cargo" class="form-control" required>
                    <option value="Mesero" {{ $usuario->cargo == 'Mesero' ? 'selected' : '' }}>Mesero</option>
                    <option value="Cajero" {{ $usuario->cargo == 'Cajero' ? 'selected' : '' }}>Cajero</option>
                    <option value="Administrador" {{ $usuario->cargo == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    @endsection
    