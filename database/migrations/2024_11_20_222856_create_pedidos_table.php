<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('mesa');
            $table->unsignedBigInteger('mesero_id');  // Este campo será utilizado para almacenar el ID del mesero
            $table->unsignedBigInteger('producto_id');  // Este campo será utilizado para almacenar el ID del producto
            $table->integer('cantidad');
            $table->decimal('precio_publico', 8, 2);
            $table->decimal('total', 8, 2);
            $table->timestamp('fecha')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
