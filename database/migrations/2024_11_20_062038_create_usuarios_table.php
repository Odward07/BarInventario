<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id(); // Autoincrement
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('correo')->unique();
        $table->string('contraseña');
        $table->unsignedBigInteger('sede_id'); // Relación con la tabla sedes
        $table->enum('cargo', ['Mesero', 'Cajero', 'Administrador']); // Lista desplegable para cargos
        $table->timestamps();
        
        // Relación con la tabla de sedes
        $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
