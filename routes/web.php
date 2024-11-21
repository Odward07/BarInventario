<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CajeroController;

// Página principal (home) o vista de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Ruta para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Rutas para el administrador (admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('sedes', SedeController::class);
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('productos', ProductoController::class)
            ->only(['index', 'store', 'destroy']); // Solo las acciones necesarias
    });

    // Rutas para el cajero
    Route::middleware('role:cajero')->group(function () {
        Route::get('/cajero', [CajeroController::class, 'index'])->name('cajero.index');
        Route::post('/cajero/descargar-inventario', [CajeroController::class, 'descargarInventario'])
            ->name('cajero.descargarInventario');
        Route::get('/cajero/inventario', [CajeroController::class, 'inventario'])->name('cajero.inventario');
    });

    // Rutas para el mesero
    Route::middleware('role:mesero')->group(function () {
        Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
        Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    });

    // Ruta para la página de bienvenida para usuarios autenticados
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});

