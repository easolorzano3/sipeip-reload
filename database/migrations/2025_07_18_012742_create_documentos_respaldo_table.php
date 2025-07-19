<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosRespaldoTable extends Migration
{
    public function up()
    {
        Schema::create('documentos_respaldo', function (Blueprint $table) {
            $table->id();
            
            // Relación con el plan institucional
            $table->unsignedBigInteger('plan_id');

            // Nombre descriptivo del documento
            $table->string('nombre_documento');

            // Ruta del archivo almacenado
            $table->string('archivo');

            // Tipo de documento (ej. Diagnóstico, Metodología, Evidencia, etc.)
            $table->string('tipo')->nullable();

            // Fecha de carga
            $table->date('fecha_carga')->nullable();

            $table->timestamps();

            // Clave foránea
            $table->foreign('plan_id')->references('id')->on('plan_institucionales')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_respaldo');
    }
}
