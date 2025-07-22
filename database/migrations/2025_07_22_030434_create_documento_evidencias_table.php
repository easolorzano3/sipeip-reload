<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoEvidenciasTable extends Migration
{
    public function up()
    {
        Schema::create('documentos_evidencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos_inversion')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('tipo');
            $table->text('descripcion')->nullable();
            $table->string('archivo'); // ruta del archivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_evidencias');
    }
}
