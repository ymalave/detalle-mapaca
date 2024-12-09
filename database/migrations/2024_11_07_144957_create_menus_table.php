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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->smallInteger('padre');
            $table->smallInteger('orden');
            $table->boolean('activo')->default(true);
            $table->string('url_destino', 200);
            $table->string('icono', 50);
            $table->string('descripcion', 200)->nullable();
            $table->unsignedBigInteger('id_permission')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
