<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoPlansTable extends Migration
{
    public function up(): void
    {
        Schema::create('estado_plans', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Ej: borrador, enviado, aprobado, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estado_plans');
    }
}
