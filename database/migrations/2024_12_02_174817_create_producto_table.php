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
        Schema::create('producto', function (Blueprint $table) {
            $table->id('cod_producto');
            $table->string('nombre', 100)->comment('Nombre del producto');
            $table->string('marca', 100)->nullable();
            $table->bigInteger('cod_proveedor');
            $table->integer('cant_stock');
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('precio_proveedor', 10, 2);

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
        Schema::dropIfExists('producto');
    }
};
