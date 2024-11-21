<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_producto' => 'required',
            'nombre_producto' => 'required',
            'tipo_producto' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio_compra' => 'required|numeric|min:0',
            'precio_publico' => 'required|numeric|min:0',
        ]);
    
        // Buscar si el producto ya existe por su código
        $productoExistente = Producto::where('codigo_producto', $request->codigo_producto)->first();
    
        if ($productoExistente) {
            // Si el producto ya existe, sumar la cantidad
            $productoExistente->cantidad += $request->cantidad;
            $productoExistente->save();
            return redirect()->route('productos.index')->with('success', 'Cantidad del producto actualizada exitosamente');
        } else {
            // Si el producto no existe, crearlo
            Producto::create($request->all());
            return redirect()->route('productos.index')->with('success', 'Producto agregado exitosamente');
        }
    }
    

    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }
}

