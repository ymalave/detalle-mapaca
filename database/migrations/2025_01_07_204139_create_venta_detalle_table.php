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
        Schema::create('venta_detalle', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nro_venta');
            $table->bigInteger('cod_producto');
            $table->integer('cantidad');
            $table->decimal('monto', 15, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cod_producto', 'SFK_VENTA_DETALLE_1')->references('cod_producto')->on('producto');
            $table->foreign('nro_venta', 'SFK_VENTA_DETALLE_2')->references('nro_venta')->on('venta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalle');
    }
};
