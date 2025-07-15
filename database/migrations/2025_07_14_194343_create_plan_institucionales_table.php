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
            $table->string('nombre');
            $table->string('codigo')->nullable();
            $table->year('periodo_inicio');
            $table->year('periodo_fin');
            $table->foreignId('unidad_id')->constrained('unidad_organizacionales');  // Asumiendo tabla 'unidades'
            $table->enum('estado', ['borrador', 'en_revision', 'aprobado'])->default('borrador');
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
