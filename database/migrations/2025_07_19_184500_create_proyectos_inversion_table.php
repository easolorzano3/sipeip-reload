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
        Schema::create('proyectos_inversion', function (Blueprint $table) {
        $table->id();

        $table->foreignId('plan_id')->constrained('plan_institucionales')->onDelete('cascade');
        $table->foreignId('programa_id')->nullable()->constrained('programas_inversion')->onDelete('set null');
        $table->foreignId('actividad_poa_id')->nullable()->constrained('actividades_poa')->onDelete('set null');

        $table->string('nombre');
        $table->string('codigo')->nullable();
        $table->text('objetivo_general')->nullable();
        $table->decimal('monto_estimado', 15, 2)->nullable()->default(0);
        $table->string('cobertura')->nullable();

        $table->date('cronograma_inicio')->nullable();
        $table->date('cronograma_fin')->nullable();

        $table->string('estado')->default('borrador');
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

        $table->timestamps();
    });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos_inversion');
    }
};
