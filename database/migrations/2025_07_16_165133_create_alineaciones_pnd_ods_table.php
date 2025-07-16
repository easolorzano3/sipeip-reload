<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alineaciones_pnd_ods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objetivo_estrategico_id')->constrained('objetivos_estrategicos')->onDelete('cascade');
            $table->foreignId('pnd_id')->nullable()->constrained('pnd_objetivos')->onDelete('set null');
            $table->foreignId('ods_id')->nullable()->constrained('ods_objetivos')->onDelete('set null');
            $table->string('indicador')->nullable();
            $table->text('justificacion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alineaciones_pnd_ods');
    }
};
