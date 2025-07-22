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
        Schema::create('avances_financieros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->string('componente');
            $table->decimal('valor_ejecutado', 14, 2);
            $table->date('fecha_corte');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('proyecto_id')->references('id')->on('proyectos_inversion')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avance_financieros');
    }
};
