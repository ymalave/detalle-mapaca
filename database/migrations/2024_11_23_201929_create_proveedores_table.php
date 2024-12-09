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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('cod_proveedor');
            $table->string('rif', 50)->comment('Cedula o rif del proveedor o empresa, comienza con letra');
            $table->string('nombre', 50)->comment('Nombre del proveedor o empresa');
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 50);
            $table->string('email', 50)->nullable();
            $table->integer('cedula_representante');
            $table->string('nombre_representante', 50);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
