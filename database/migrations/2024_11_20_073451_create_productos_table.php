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
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('codigo_producto')->unique();
            $table->string('nombre_producto');
            $table->enum('tipo_producto', ['Cerveza', 'Vino', 'Whisky', 'Ron', 'Tequila', 'Vodka']); // Lista desplegable
            $table->integer('cantidad');
            $table->date('fecha_ingreso')->default(now()); // Automática
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_publico', 8, 2);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
