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
        Schema::create('venta', function (Blueprint $table) {
            $table->id('nro_venta');
            $table->unsignedInteger('nro_cliente')->comment('Campo que contiene el id del cliente');
            $table->decimal('monto_total', 20, 2)->comment('Campo debe ser llenado automaticamente con la suma de los precios venta de cada producto');
            $table->decimal('monto_total_bs', 20, 2)->comment('Campo debe ser llenado automaticamente con la suma de los precios venta de cada producto y convertido a bolivares');
            // $table->string('estado', 25)->comment('refleja el estafo de la venta, en proceso, pendiente o facturada');
            $table->unsignedInteger('usuario')->comment('Campo con el id del usuario que genera o modifica la orden de venta');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('nro_cliente', 'VENTAFK1')->references('nro_cliente')->on('clientes');
            $table->foreign('usuario', 'VENTAFK2')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
