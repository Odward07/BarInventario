<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\HistorialOrdenes; // Asegúrate de incluir el modelo HistorialOrdenes
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function create()
    {
        // Traer los usuarios con el cargo "mesero" desde la tabla "usuarios"
        $meseros = Usuario::where('cargo', 'mesero')->select('id', 'nombres')->get(); 
        
        // Traer los productos disponibles
        $productos = Producto::all();

        return view('pedidos.create', compact('meseros', 'productos'));
    }

    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'mesa' => 'required|integer', 
            'mesero' => 'required|string|in:' . implode(',', Usuario::where('cargo', 'mesero')->pluck('nombres')->toArray()), 
            'producto' => 'required|string|in:' . implode(',', Producto::pluck('nombre_producto')->toArray()), 
            'cantidad' => 'required|integer|min:1', 
        ]);

        // Obtener el precio público del producto seleccionado
        $producto = Producto::where('nombre_producto', $request->producto)->first();
        $precio_publico = $producto->precio_publico;

        // Verificar si hay suficiente inventario antes de crear el pedido
        if ($request->cantidad > $producto->cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente inventario para el producto seleccionado.']);
        }

        // Calcular el total
        $total = $request->cantidad * $precio_publico;

        // Crear el pedido
        $pedido = Pedido::create([
            'mesa' => $request->mesa,
            'mesero' => $request->mesero,
            'producto' => $request->producto,
            'cantidad' => $request->cantidad,
            'precio_publico' => $precio_publico,
            'total' => $total,
            'fecha' => now(),
        ]);

        // Registrar también en la tabla historial_ordenes
        HistorialOrdenes::create([
            'mesa' => $pedido->mesa,
            'mesero' => $pedido->mesero,
            'producto' => $pedido->producto,
            'cantidad' => $pedido->cantidad,
            'precio_publico' => $pedido->precio_publico,
            'total' => $pedido->total,
            'fecha' => $pedido->fecha,
        ]);

        // Actualizar el inventario del producto
        $producto->decrement('cantidad', $request->cantidad);

        // Redirigir con mensaje de éxito
        return redirect()->route('pedidos.create')->with('success', 'Pedido registrado exitosamente.');
    }
}
