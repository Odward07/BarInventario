<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa',
        'mesero',  // Aquí se guarda el nombre del mesero (cadena de texto)
        'producto',  // Aquí se guarda el nombre del producto (cadena de texto)
        'cantidad',
        'precio_publico',
        'total',
        'fecha',
    ];

    // Relaciones si es necesario, aunque no se usarán para guardar los nombres
    public function mesero()
    {
        return $this->belongsTo(User::class, 'mesero_id'); 
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

