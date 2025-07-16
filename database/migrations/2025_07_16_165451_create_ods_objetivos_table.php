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
        Schema::create('ods_objetivos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // Ejemplo: ODS1, ODS2...
            $table->string('nombre'); // Nombre del objetivo ODS
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ods_objetivos');
    }
};
