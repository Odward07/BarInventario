<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios'; // Asocia el modelo con la tabla 'usuarios'

    protected $fillable = ['nombres', 'apellidos', 'correo', 'contraseña', 'sede_id', 'cargo'];

    public $timestamps = false; // Deshabilitar marcas de tiempo

    // Ocultar la contraseña para mayor seguridad
    protected $hidden = ['contraseña'];

    // Método requerido por Laravel para obtener la columna de identificación
    public function getAuthIdentifierName()
    {
        return 'correo'; // Asegúrate de que sea el nombre correcto de la columna
    }

    // Método requerido por Laravel para obtener la contraseña
    public function getAuthPassword()
    {
        return $this->contraseña; // Asegúrate de que 'contraseña' sea el nombre de la columna en tu base de datos
    }

    // Relación con la tabla sedes
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    // Relación con la tabla pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'mesero_id');
    }
}
