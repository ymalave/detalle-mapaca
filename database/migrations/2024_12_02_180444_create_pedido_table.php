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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id('nro_pedido');

            $table->bigInteger('cod_proveedor');
            $table->timestamp('fecha_solicitud')->comment('fecha en la que se hace la solicitud');
            $table->timestamp('fecha_recepcion')->comment('fecha de recepción del pedido');
            $table->boolean('cerrado')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cod_proveedor', 'SFK_PRODUCTO1')->references('cod_proveedor')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
