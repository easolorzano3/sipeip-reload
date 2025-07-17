<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesPoaTable extends Migration
{
    public function up()
    {
        Schema::create('actividades_poa', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('plan_id'); // Relación con el plan institucional
            $table->unsignedBigInteger('objetivo_estrategico_id');
            $table->unsignedBigInteger('meta_id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();

            $table->unsignedBigInteger('responsable_id'); // usuario o unidad ejecutora
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->decimal('presupuesto_estimado', 12, 2);
            $table->string('fuente_financiamiento')->nullable();

            $table->string('indicador_resultado')->nullable();

            $table->timestamps();

            // Relaciones (puedes activar si ya existen estas tablas)
            $table->foreign('plan_id')->references('id')->on('plan_institucionales')->onDelete('cascade');
            $table->foreign('objetivo_estrategico_id')->references('id')->on('objetivos_estrategicos')->onDelete('cascade');
            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('actividades_poa');
    }
}
