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
        Schema::create('dictamen_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos_inversion')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_dictamen');
            $table->enum('estado_dictamen', ['aprobado', 'observado', 'no_viable']);
            $table->enum('prioridad', ['alta', 'media', 'baja', 'ninguna'])->default('ninguna');
            $table->string('codigo_dictamen')->unique();
            $table->text('justificacion_tecnica');
            $table->text('evaluacion_financiera')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->string('archivo_dictamen')->nullable(); // futuro PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictamen_tecnicos');
    }
};
