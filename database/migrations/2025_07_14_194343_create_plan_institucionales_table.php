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
        Schema::create('plan_institucionales', function (Blueprint $table) {
            $table->id();

            $table->string('entidad');
            $table->string('nivel_gobierno');
            $table->string('estado_institucional');
            $table->string('codigo_institucional');

            $table->string('nombre');
            $table->string('codigo_plan')->nullable(); // renombrado de "codigo" por claridad
            $table->date('anio_inicio');
            $table->date('anio_fin');

            $table->foreignId('unidad_id')->nullable()->constrained('unidad_organizacionales');
            //$table->enum('estado', ['borrador', 'en_revision', 'aprobado'])->default('borrador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_institucionales');
    }
};
