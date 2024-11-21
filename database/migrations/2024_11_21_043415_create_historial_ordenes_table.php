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
        Schema::create('historial_ordenes', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->integer('mesa'); // Número de mesa
            $table->string('mesero'); // Nombre del mesero
            $table->string('producto'); // Nombre del producto
            $table->integer('cantidad'); // Cantidad del producto
            $table->decimal('precio_publico', 8, 2); // Precio público del producto
            $table->decimal('total', 10, 2); // Total calculado
            $table->timestamp('fecha'); // Fecha del pedido
            $table->timestamps(); // created_at y updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_ordenes');
    }
};
