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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('nro_cliente');
            $table->unsignedInteger('cedula_cliente')->unique()->comment('Nro de cedula del cliente');
            $table->string('nombres', 50)->comment('Nombres del cliente');
            $table->string('apellidos', 50)->comment('Apellidos del cliente');
            $table->string('direccion', 50)->comment('Dirección del cliente')->nullable();
            $table->string('email', 50)->comment('Email del cliente')->nullable();
            $table->string('nro_telefono', 50)->comment('Telefono del cliente')->nullable();
            $table->string('sexo',1)->comment('F para Femenino, M masculino');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
