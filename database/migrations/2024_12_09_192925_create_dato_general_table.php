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
        Schema::create('dato_general', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 50)->comment('Nombre del dato');
            $table->string('valor', 50)->comment('Valor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dato_general');
    }
};
