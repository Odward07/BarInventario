<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialOrdenes extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa',
        'mesero',
        'producto',
        'cantidad',
        'precio_publico',
        'total',
        'fecha',
    ];
    public $timestamps = false; // Deshabilita las marcas de tiempo
}
