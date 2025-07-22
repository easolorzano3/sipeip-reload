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
        Schema::create('planificaciones_ejecutivas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id'); // Proyecto relacionado
            $table->string('hito');                    // Nombre del hito (ej. Inicio de obra)
            $table->date('fecha');                     // Fecha programada
            $table->string('responsable')->nullable(); // Persona/responsable del hito
            $table->text('observacion')->nullable();   // Comentarios u observaciones
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('proyectos_inversion')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planificacion_ejecutivas');
    }
};
