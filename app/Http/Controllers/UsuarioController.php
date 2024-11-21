<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Sede;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $sedes = Sede::all(); // Obtener todas las sedes
        return view('usuarios.create', compact('sedes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:usuarios',
            'contraseña' => 'required|min:8',
            'sede_id' => 'required|exists:sedes,id',
            'cargo' => 'required|in:Mesero,Cajero,Administrador',
        ]);

        Usuario::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'contraseña' => bcrypt($request->contraseña),
            'sede_id' => $request->sede_id,
            'cargo' => $request->cargo,
        ]);

        return redirect()->route('usuarios.index');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $sedes = Sede::all();
        return view('usuarios.edit', compact('usuario', 'sedes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'contraseña' => 'nullable|min:8',
            'sede_id' => 'required|exists:sedes,id',
            'cargo' => 'required|in:Mesero,Cajero,Administrador',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'contraseña' => $request->contraseña ? bcrypt($request->contraseña) : $usuario->contraseña,
            'sede_id' => $request->sede_id,
            'cargo' => $request->cargo,
        ]);

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuarios.index');
    }
}

