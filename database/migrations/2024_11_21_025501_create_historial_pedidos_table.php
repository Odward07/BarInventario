<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPedidosTable extends Migration
{
    public function up()
    {
        Schema::create('historial_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->string('nombre_producto');
            $table->integer('cantidad');
            $table->integer('mesa');
            $table->timestamp('procesado_en')->useCurrent();

            // Agregar índices y referencias si es necesario
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_pedidos');
    }
}

