<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'tipo_producto',
        'cantidad',
        'fecha_ingreso',
        'precio_compra',
        'precio_publico'
    ];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'producto_id');
    }
}

