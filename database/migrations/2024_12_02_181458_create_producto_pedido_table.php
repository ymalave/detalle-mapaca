<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producto_pedido', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nro_pedido');
            $table->bigInteger('cod_producto');
            $table->integer('cantidad');
            $table->decimal('monto', 15, 2);
            $table->boolean('recibido')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cod_producto', 'SFK_PRODUCTO_PEDIDO_1')->references('cod_producto')->on('producto');
            $table->foreign('nro_pedido', 'SFK_PRODUCTO_PEDIDO_2')->references('nro_pedido')->on('pedido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_pedido');
    }
};
