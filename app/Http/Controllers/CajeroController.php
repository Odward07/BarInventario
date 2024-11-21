<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\HistorialPedido;
use Illuminate\Http\Request;

class CajeroController extends Controller
{
    // Función para procesar y descargar el inventario
    public function descargarInventario(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
    
        // Busca el pedido solicitado
        $pedido = Pedido::find($pedidoId);
    
        if (!$pedido) {
            return redirect()->route('cajero.index')->withErrors(['error' => 'El pedido no existe.']);
        }
    
        // Busca el producto relacionado
        $producto = Producto::where('nombre_producto', $pedido->producto)->first();
    
        if (!$producto) {
            return redirect()->route('cajero.index')->withErrors(['error' => 'El producto relacionado no existe en el inventario.']);
        }
    
        // Verifica si hay suficiente cantidad en el inventario
        if ($producto->cantidad < $pedido->cantidad) {
            return redirect()->route('cajero.index')->withErrors(['error' => 'Cantidad insuficiente en el inventario para procesar el pedido.']);
        }
    
        // Resta la cantidad del inventario
        $producto->cantidad -= $pedido->cantidad;
        $producto->save();
    
    
        // Elimina el pedido de la tabla `pedidos`
        $pedido->delete();
    
        return redirect()->route('cajero.index')->with('success', 'Pedido procesado y registrado en el historial.');
    }
    

    // Función para ver los pedidos
    public function index()
    {
        $pedidos = Pedido::all();
        return view('cajero.index', compact('pedidos'));
    }

    // Función para ver inventario
    public function inventario()
    {
        $productos = Producto::all();
        return view('cajero.inventario', compact('productos'));
    }
}
