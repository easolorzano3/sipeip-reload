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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_id')->constrained('metas')->onDelete('cascade');
            $table->string('nombre');
            $table->string('unidad')->nullable();
            $table->string('frecuencia')->nullable(); // Ej: mensual, trimestral
            $table->integer('valor_referencia')->nullable();
            $table->integer('valor_meta')->nullable();
            $table->text('metodologia')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadors');
    }
};
