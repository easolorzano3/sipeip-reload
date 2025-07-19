<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('versiones_historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->string('accion'); // Ej: Creación, Modificación, Envío a Revisión, etc.
            $table->text('descripcion')->nullable(); // Descripción de la acción realizada
            $table->unsignedBigInteger('usuario_id'); // Usuario que realizó la acción
            $table->timestamp('fecha_accion')->useCurrent();
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plan_institucionales')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('versiones_historial');
    }
};
