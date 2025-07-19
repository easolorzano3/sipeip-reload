<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosRevisionTable extends Migration
{
    public function up()
    {
        Schema::create('envios_revision', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('plan_id'); // Relación con plan institucional
            $table->string('estado_envio')->default('Pendiente'); // Estado del envío: Pendiente, Enviado, Aprobado, Rechazado
            $table->text('observaciones')->nullable(); // Comentarios adicionales
            $table->date('fecha_envio')->nullable();
            $table->date('fecha_respuesta')->nullable();
            $table->text('respuesta')->nullable(); // Comentario del revisor

            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plan_institucionales')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('envios_revision');
    }
}
