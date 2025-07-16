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
        Schema::create('pnd_objetivos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // Ejemplo: PND1, PND2...
            $table->string('nombre'); // Nombre del objetivo
            $table->text('descripcion')->nullable(); // Explicación del objetivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnd_objetivos');
    }
};
