<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('resoluciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plan_institucionales')->onDelete('cascade');
            $table->string('numero');      // Número de resolución
            $table->date('fecha');         // Fecha de resolución
            $table->string('archivo');     // Ruta del archivo PDF
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Usuario que publica
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('resoluciones');
    }
};
