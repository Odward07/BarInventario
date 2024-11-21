<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = ['nombre_sede', 'direccion', 'ciudad'];
    public $timestamps = false; // Deshabilita las marcas de tiempo
}
