<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('objetivos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_institucional_id');
            $table->unsignedBigInteger('eje_estrategico_id');
            $table->unsignedBigInteger('politica_nacional_id')->nullable();
            $table->string('nombre', 200);
            $table->text('descripcion');
            $table->date('periodo_inicio');
            $table->date('periodo_fin');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('plan_institucional_id')->references('id')->on('plan_institucionales')->onDelete('cascade');
            $table->foreign('eje_estrategico_id')->references('id')->on('ejes_estrategicos');
            $table->foreign('politica_nacional_id')->references('id')->on('politicas_nacionales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivos_estrategicos');
    }
};
