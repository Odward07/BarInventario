<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de que esta vista exista
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'correo' => 'required|email', // Validar que el correo sea un email válido
            'contraseña' => 'required|string|min:6', // Validar que la contraseña no esté vacía
        ]);

        // Credenciales para la autenticación
        $credentials = [
            'correo' => $request->correo,
            'contraseña' => $request->contraseña, // Laravel usará "getAuthPassword()" del modelo
        ];

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Redirigir según el rol del usuario autenticado
            $role = Auth::user()->cargo;

            switch ($role) {
                case 'admin':
                    return redirect()->route('sedes.index');
                case 'cajero':
                    return redirect()->route('cajero.index');
                case 'mesero':
                    return redirect()->route('pedidos.create');
                default:
                    return redirect()->route('welcome');
            }
        }

        // Si las credenciales son incorrectas
        return back()->withErrors(['correo' => 'Credenciales incorrectas.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
